<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompaniesJob;
use App\Models\CompaniesApplication;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule; // Import Rule

class JobController extends Controller
{
    /**
     * PUBLIC JOB LIST
     */
    public function index(Request $request)
    {
        $search      = $request->search;
        $province_id  = $request->provinsi_id;
        $regency_id  = $request->kabupaten_id;
        $district_id  = $request->kecamatan_id;
        $village_id  = $request->desa_id;
        $industry    = $request->industry;
        $work_mode    = $request->work_mode;
        $employment_type = $request->employment_type;
        $experience  = $request->experience;
        $education_level = $request->education_level;

        $jobs = CompaniesJob::withCount('applicants')
            ->with(['province', 'regency', 'district', 'village', 'company']) // Tambahkan eager loading
            ->where('is_public', true)
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'LIKE', "%$search%")
                      ->orWhere('company_name', 'LIKE', "%$search%")
                      ->orWhere('industry', 'LIKE', "%$search%");
                });
            })
            ->when($industry, fn($q) => $q->where('industry', $industry))
            ->when($work_mode, fn($q) => $q->where('work_mode', $work_mode))
            ->when($employment_type, fn($q) => $q->where('employment_type', $employment_type))
            ->when($experience, fn($q) => $q->where('experience', $experience))
            ->when($education_level, fn($q) => $q->where('education_level', $education_level))
            ->when($province_id, fn($q) => $q->where('provinsi_id', $province_id))
            ->when($regency_id, fn($q) => $q->where('kabupaten_id', $regency_id))
            ->when($district_id, fn($q) => $q->where('kecamatan_id', $district_id))
            ->when($village_id, fn($q) => $q->where('desa_id', $village_id))
            ->orderBy('created_at', 'desc')
            ->paginate(12)
            ->withQueryString();

        // Format data untuk view
        $jobs->getCollection()->transform(function ($job) {
            $job->formatted_salary = $this->formatSalary($job);
            $job->formatted_education = $this->formatEducation($job->education_level);
            $job->location_string = $this->getLocationString($job);
            $job->skills_list = $this->parseSkills($job->skills);
            $job->requirements_list = $this->parseRequirements($job->requirements);

             // ⬇ Tambahkan ini
    $job->has_applied = $this->hasApplied($job->id);
            
            return $job;
        });

        $provinces = Province::orderBy('name')->get();

        return view('jobs.index', compact(
            'jobs',
            'search',
            'provinces',
            'province_id',
            'regency_id',
            'district_id',
            'village_id',
            'industry',
            'work_mode',
            'employment_type',
            'experience',
            'education_level'
        ));
    }

    /**
     * SHOW JOB DETAIL
     */
    public function show($id)
    {
        $job = CompaniesJob::with(['applicants', 'company', 'province', 'regency', 'district', 'village'])
            ->where('is_public', true)
            ->findOrFail($id);

        // Format data untuk view
        $job->formatted_salary = $this->formatSalary($job);
        $job->formatted_education = $this->formatEducation($job->education_level);
        $job->location_string = $this->getLocationString($job);
        $job->skills_list = $this->parseSkills($job->skills);
        $job->requirements_list = $this->parseRequirements($job->requirements);
        $job->description_list = $this->parseDescription($job->description);
        $job->tanggung_jawab_list = $this->parseTanggungJawab($job->tanggung_jawab);
        $job->kualifikasi_list = $this->parseKualifikasi($job->kualifikasi);
        $job->nilai_tambah_list = $this->parseNilaiTambah($job->nilai_tambah);
        $job->has_applied = $this->hasApplied($job->id);
        
        // Cek apakah pelamar sudah pernah melamar
        $hasApplied = false;
        if (Auth::check()) {
            $hasApplied = CompaniesApplication::where('companies_job_id', $id)
                ->where('email', Auth::user()->email) // Bisa pakai user email atau user_id jika ada relasi
                ->exists();
        }
        $job->has_applied = $hasApplied;


        // Get related jobs
        $relatedJobs = CompaniesJob::with(['province', 'regency', 'district', 'village'])
            ->where('is_public', true)
            ->where('id', '!=', $id)
            ->where(function($q) use ($job) {
                $q->where('industry', $job->industry)
                  ->orWhere('provinsi_id', $job->provinsi_id)
                  ->orWhere('company_id', $job->company_id);
            })
            ->limit(5)
            ->get()
            ->map(function($relatedJob) {
                $relatedJob->formatted_salary = $this->formatSalary($relatedJob);
                $relatedJob->location_string = $this->getLocationString($relatedJob);
                return $relatedJob;
            });

        return view('jobs.show', compact('job', 'relatedJobs'));
    }

    /**
     * SHOW APPLICATION FORM
     */
    public function applyForm($id)
    {
        $job = CompaniesJob::findOrFail($id);

        $hasApplied = false;

        // Cek apakah user login sudah melamar (menggunakan email dari user yang login)
        if (Auth::check()) {
            $hasApplied = CompaniesApplication::where('companies_job_id', $id)
                ->where('email', Auth::user()->email) 
                ->exists();
        }

        // Ambil data untuk form dinamis (opsional, tergantung implementasi view)
        $provinces = Province::orderBy('name')->get();
        // Anda mungkin perlu variabel tambahan lain di sini

        return view('jobs.apply', compact('job', 'hasApplied', 'provinces'));


    }

    /**
     * SIMPAN LAMARAN (APPLY STORE)
     */
    public function applyStore(Request $request, $id)
    {
        $job = CompaniesJob::findOrFail($id);
        
        // Cek status valid di tabel companies_applications
        $validStatuses = CompaniesApplication::getValidStatuses(); 
        // Jika tidak ada method getValidStatuses() di model, gunakan array ini:
        // $validStatuses = ['masuk', 'diproses', 'profile_lolos', 'wawancara_lolos', 'tes_lolos', 'diterima', 'ditolak'];

        $request->validate([
            // Kolom Wajib
            'nama' => 'required|string|max:255',
            'email' => [
                'required', 
                'email', 
                'max:255',
                // Pastikan email belum pernah melamar untuk lowongan ini
                Rule::unique('companies_applications')->where(function ($query) use ($id) {
                    return $query->where('companies_job_id', $id);
                })
            ],
            'cv' => 'required|file|mimes:pdf,doc,docx|max:5120', // Max 5MB

            // Kolom Tambahan (Mengacu pada tabel companies_applications)
            'telepon' => 'nullable|string|max:255',
            'surat_lamaran' => 'nullable|file|mimes:pdf,doc,docx|max:5120', // Max 5MB
            'catatan' => 'nullable|string',
            'tgl_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'pendidikan' => 'nullable|string|max:255',
            'asal_sekolah' => 'nullable|string|max:255',
            'pengalaman_kerja' => 'nullable|string', // Text area
            'keahlian' => 'nullable|string', // Text area/string
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB, hanya gambar
            'ijazah' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:5120', // Max 5MB

            // Status default: 'masuk'
            // 'status' => ['required', Rule::in($validStatuses)], 
        ]);

        // Cek apakah email sudah pernah melamar
        // Validasi Rule::unique di atas sudah mencakup ini, tapi kita biarkan sebagai redundansi
        $existing = CompaniesApplication::where('companies_job_id', $id)
            ->where('email', $request->email)
            ->first();

        if ($existing) {
            return back()->withErrors(['email' => 'Anda sudah melamar pada lowongan ini.'])->withInput();
        }

        // --- Proses Upload File ---
        $cvPath = $request->file('cv')->store('applications/cv', 'public');
        
        $suratPath = null;
        if ($request->hasFile('surat_lamaran')) {
            $suratPath = $request->file('surat_lamaran')->store('applications/surat', 'public');
        }

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('applications/foto', 'public');
        }
        
        $ijazahPath = null;
        if ($request->hasFile('ijazah')) {
            $ijazahPath = $request->file('ijazah')->store('applications/ijazah', 'public');
        }
        // --- Akhir Proses Upload File ---


        // Simpan data
        CompaniesApplication::create([
            'company_id' => $job->company_id,
            'companies_job_id' => $job->id,
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'cv' => $cvPath,
            'surat_lamaran' => $suratPath,
            'catatan' => $request->catatan,
            'status' => 'masuk', // Set status awal
            
            // Kolom baru
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
            'pendidikan' => $request->pendidikan,
            'asal_sekolah' => $request->asal_sekolah,
            'pengalaman_kerja' => $request->pengalaman_kerja,
            'keahlian' => $request->keahlian,
            'foto' => $fotoPath,
            'ijazah' => $ijazahPath,

            // Jika ada user login, simpan user_id (asumsi tidak ada kolom user_id di tabel Anda, 
            // jika ada, tambahkan baris di bawah)
            // 'user_id' => Auth::check() ? Auth::id() : null,
        ]);

        return redirect()->route('jobs.show', $id)
            ->with('success', 'Lamaran berhasil dikirim!');
    }

    // ... sisanya dari controller (checkApplication, formatSalary, dll.) tetap sama ...

    /**
     * AJAX CHECK APPLICATION STATUS
     */
    public function checkApplication(Request $request, $id)
    {
        // Perbaiki logic ini, Anda tidak memiliki kolom user_id di companies_applications, 
        // Anda harus menggunakan 'email' dari user yang sedang login.
        if (!Auth::check()) {
            return response()->json(['has_applied' => false]);
        }

        $hasApplied = CompaniesApplication::where('companies_job_id', $id)
            ->where('email', Auth::user()->email)
            ->exists();

        return response()->json(['has_applied' => $hasApplied]);
    }
    
    // ... HELPER: formatSalary, formatEducation, getLocationString, parseSkills, dll.
    // Dibiarkan sama
    
    /**
     * HELPER: Format Salary
     */
    private function formatSalary($job)
    {
        // Jika tidak ditampilkan
        if (!$job->show_salary) {
            return 'Gaji Tidak Ditampilkan';
        }

        // Jika dua-duanya kosong
        if (!$job->salary_min && !$job->salary_max) {
            return 'Gaji Tidak Ditampilkan';
        }

        // Jika ada min dan max
        if ($job->salary_min && $job->salary_max) {
            return 'Rp ' . number_format($job->salary_min, 0, ',', '.') .
                   ' - Rp ' . number_format($job->salary_max, 0, ',', '.') .
                   ' / Bulan';
        }

        // Jika hanya minimum
        if ($job->salary_min) {
            return 'Rp ' . number_format($job->salary_min, 0, ',', '.') . ' / Bulan';
        }

        // Jika hanya maksimum
        return 'Rp ' . number_format($job->salary_max, 0, ',', '.') . ' / Bulan';
    }


    /**
     * HELPER: Format Education
     */
    private function formatEducation($education)
    {
        $educationMap = [
            'sd' => 'SD',
            'smp' => 'SMP',
            'smk_sma' => 'SMK/SMA',
            'd1-d4' => 'D1 - D4',
            's1' => 'S1',
            's2' => 'S2',
            's3' => 'S3',
        ];

        return $educationMap[$education] ?? 'Tidak Diketahui';
    }

    /**
     * HELPER: Get Location String
     */
    private function getLocationString($job)
    {
        $locationParts = [];
        
        if ($job->relationLoaded('village') && $job->village) {
            $locationParts[] = $job->village->name;
        }
        if ($job->relationLoaded('district') && $job->district) {
            $locationParts[] = $job->district->name;
        }
        if ($job->relationLoaded('regency') && $job->regency) {
            $locationParts[] = $job->regency->name;
        }
        if ($job->relationLoaded('province') && $job->province) {
            $locationParts[] = $job->province->name;
        }
        
        // Jika relasi belum di-load, coba ambil dari data mentah
        if (empty($locationParts)) {
            // Load relasi jika belum
            $job->loadMissing(['village', 'district', 'regency', 'province']);
            
            if ($job->village) $locationParts[] = $job->village->name;
            if ($job->district) $locationParts[] = $job->district->name;
            if ($job->regency) $locationParts[] = $job->regency->name;
            if ($job->province) $locationParts[] = $job->province->name;
        }
        
        // Jika masih kosong, tampilkan pesan default
        if (empty($locationParts)) {
            return 'Lokasi tidak tersedia';
        }
        
        // Ambil 2-3 bagian terakhir
        return implode(', ', array_slice($locationParts, -2, 2));
    }

    /**
     * HELPER: Parse Skills from JSON or string
     */
    private function parseSkills($skills)
    {
        if (empty($skills)) {
            return [];
        }

        if (is_string($skills)) {
            $decoded = json_decode($skills, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return $decoded;
            }
            
            // Coba parse sebagai string biasa (pisahkan dengan koma)
            return array_map('trim', explode(',', $skills));
        }

        return is_array($skills) ? $skills : [];
    }

    /**
     * HELPER: Parse Requirements
     */
    private function parseRequirements($requirements)
    {
        if (empty($requirements)) {
            return [];
        }

        if (is_string($requirements)) {
            $decoded = json_decode($requirements, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return $decoded;
            }
            
            // Jika bukan JSON, split by new lines
            return array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $requirements)));
        }

        return is_array($requirements) ? $requirements : [];
    }

    /**
     * HELPER: Parse Description
     */
    private function parseDescription($description)
    {
        if (empty($description)) {
            return [];
        }

        if (is_string($description)) {
            return array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $description)));
        }

        return is_array($description) ? $description : [$description];
    }

    /**
     * HELPER: Parse Tanggung Jawab
     */
    private function parseTanggungJawab($tanggungJawab)
    {
        if (empty($tanggungJawab)) {
            return [];
        }

        if (is_string($tanggungJawab)) {
            return array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $tanggungJawab)));
        }

        return is_array($tanggungJawab) ? $tanggungJawab : [];
    }

    /**
     * HELPER: Parse Kualifikasi
     */
    private function parseKualifikasi($kualifikasi)
    {
        if (empty($kualifikasi)) {
            return [];
        }

        if (is_string($kualifikasi)) {
            return array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $kualifikasi)));
        }

        return is_array($kualifikasi) ? $kualifikasi : [];
    }

    /**
     * HELPER: Parse Nilai Tambah
     */
    private function parseNilaiTambah($nilaiTambah)
    {
        if (empty($nilaiTambah)) {
            return [];
        }

        if (is_string($nilaiTambah)) {
            return array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $nilaiTambah)));
        }

        return is_array($nilaiTambah) ? $nilaiTambah : [];
    }

    /**
     * API: Get Jobs for AJAX requests
     */
    public function apiIndex(Request $request)
    {
        $jobs = CompaniesJob::with(['province', 'regency', 'district', 'village'])
            ->where('is_public', true)
            ->orderBy('created_at', 'desc')
            ->limit(20)
            ->get()
            ->map(function ($job) {
                return [
                    'id' => $job->id,
                    'title' => $job->title,
                    'company_name' => $job->company_name,
                    'industry' => $job->industry,
                    'formatted_salary' => $this->formatSalary($job),
                    'location_string' => $this->getLocationString($job),
                    'employment_type' => $job->employment_type,
                    'work_mode' => $job->work_mode,
                    'created_at' => $job->created_at->format('d M Y'),
                    'company_logo' => $job->company_logo ? asset('storage/' . $job->company_logo) : null,
                ];
            });

        return response()->json($jobs);
    }

    /**
     * FILTER JOBS - For filter form submission
     */
    public function filterJobs(Request $request)
    {
        $query = CompaniesJob::with(['province', 'regency', 'district', 'village'])
            ->where('is_public', true);

        // Apply filters
        if ($request->has('job_types') && !empty($request->job_types)) {
            $query->whereIn('employment_type', $request->job_types);
        }

        if ($request->has('work_policies') && !empty($request->work_policies)) {
            $query->whereIn('work_mode', $request->work_policies);
        }

        if ($request->has('experience') && !empty($request->experience)) {
            $query->whereIn('experience', $request->experience);
        }

        if ($request->has('education') && !empty($request->education)) {
            $query->whereIn('education_level', $request->education);
        }

        if ($request->has('update') && $request->update != 'kapan_pun') {
            if ($request->update == 'sebulan_terakhir') {
                $query->where('created_at', '>=', now()->subMonth());
            } elseif ($request->update == 'seminggu_terakhir') {
                $query->where('created_at', '>=', now()->subWeek());
            }
        }

        // Apply search
        if ($request->has('q') && !empty($request->q)) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'LIKE', "%{$request->q}%")
                  ->orWhere('company_name', 'LIKE', "%{$request->q}%")
                  ->orWhere('industry', 'LIKE', "%{$request->q}%");
            });
        }

        // Apply location search
        if ($request->has('location') && !empty($request->location)) {
            $location = $request->location;
            $query->where(function ($q) use ($location) {
                $q->whereHas('province', function ($q2) use ($location) {
                    $q2->where('name', 'LIKE', "%{$location}%");
                })
                ->orWhereHas('regency', function ($q2) use ($location) {
                    $q2->where('name', 'LIKE', "%{$location}%");
                })
                ->orWhereHas('district', function ($q2) use ($location) {
                    $q2->where('name', 'LIKE', "%{$location}%");
                })
                ->orWhereHas('village', function ($q2) use ($location) {
                    $q2->where('name', 'LIKE', "%{$location}%");
                });
            });
        }

        $jobs = $query->orderBy('created_at', 'desc')
            ->paginate(12)
            ->withQueryString();

        // Format data
        $jobs->getCollection()->transform(function ($job) {
            $job->formatted_salary = $this->formatSalary($job);
            $job->location_string = $this->getLocationString($job);
            $job->skills_list = $this->parseSkills($job->skills);
            return $job;
        });

        return view('jobs.index', compact('jobs'));
    }
    private function hasApplied($jobId)
{
    if (!Auth::check()) {
        return false;
    }

    return CompaniesApplication::where('companies_job_id', $jobId)
        ->where('email', Auth::user()->email)
        ->exists();
}

}