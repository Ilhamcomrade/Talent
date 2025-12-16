<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\CompaniesApplication;
use App\Models\CompaniesJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class cApplicantController extends Controller
{
    /**
     * Semua pelamar di semua lowongan perusahaan
     */
    public function index()
    {
        $company = Auth::guard('company')->user();

        $applications = CompaniesApplication::with('job')
            ->whereHas('job', function ($q) use ($company) {
                $q->where('company_id', $company->id);
            })
            ->latest()
            ->get();

        return view('company.applications.index', compact('applications'));
    }

    /**
     * Pelamar berdasarkan 1 lowongan
     */
    public function pelamarByJob($id)
    {
        $company = Auth::guard('company')->user();

        $job = CompaniesJob::where('id', $id)
            ->where('company_id', $company->id)
            ->firstOrFail();

        $applications = CompaniesApplication::with('job')
            ->where('companies_job_id', $id)
            ->latest()
            ->get();

        return view('company.applications.pelamar_by_job', compact('job', 'applications'));
    }

    /**
     * Detail pelamar + tandai sudah dibaca
     */
    public function show($id)
    {
        // Pastikan pelamar adalah milik perusahaan yang sedang login
        $companyId = Auth::guard('company')->user()->id;
        $applicant = CompaniesApplication::with('job')
            ->whereHas('job', function ($q) use ($companyId) {
                $q->where('company_id', $companyId);
            })
            ->findOrFail($id);

        // Tandai sudah dibaca
        if (!$applicant->is_read) {
            $applicant->update(['is_read' => true]);
        }

        return view('company.applications.show', compact('applicant'));
    }

    /**
     * Update status pelamar, detail wawancara, atau detail tes/tugas.
     */
    public function updateStatus(Request $request, $id)
    {
        // 1. Ambil data pelamar
        $app = CompaniesApplication::findOrFail($id);

        // 2. Tentukan jenis aksi
        $actionType = $request->input('action_type');

        if ($actionType === 'update_wawancara') {
            // Aksi: Perbarui Jadwal Wawancara
            $request->validate([
                'tanggal_wawancara' => 'nullable|date',
                'link_wawancara' => 'nullable|url|max:255',
                'desk_wawancara' => 'nullable|string',
            ]);

            $app->update([
                'tanggal_wawancara' => $request->tanggal_wawancara,
                'link_wawancara' => $request->link_wawancara,
                'desk_wawancara' => $request->desk_wawancara,
            ]);

            return back()->with('success', 'Jadwal Wawancara berhasil diperbarui.');

        } elseif ($actionType === 'update_tes') {
            // Aksi: Perbarui Detail Tes/Tugas
            $request->validate([
                'desk_tes' => 'nullable|string',
                'link_tugas' => 'nullable|url|max:255',
                'catatan' => 'nullable|string',
            ]);

            $app->update([
                'desk_tes' => $request->desk_tes,
                'link_tugas' => $request->link_tugas,
                // Menggunakan 'catatan' dari form update_tes, bukan kolom 'catatan' utama (sesuai view)
                'catatan' => $request->catatan, 
            ]);

            return back()->with('success', 'Detail Tes/Tugas berhasil diperbarui.');

        } else {
            // Aksi: Perbarui Status (Default)
            $request->validate([
                'status' => 'required|string'
            ]);

            $allowedStatus = [
                'pending', // Ubah 'masuk' menjadi 'pending' atau sesuaikan dengan nilai default di DB
                'diproses',
                'profile_lolos',
                'wawancara_lolos',
                'tes_lolos',
                'diterima',
                'ditolak'
            ];

            // Perhatikan bahwa nilai default di DB Anda adalah 'masuk', 
            // namun di logika view Anda menggunakan 'pending' untuk status awal.
            // Saya merekomendasikan untuk menggunakan satu konsistensi: 'masuk'.
            // Saya ubah di sini menjadi 'pending' untuk menyesuaikan dengan logika yang 
            // sudah ada di bagian blade view yang memproses status 'pending'.
            // Jika nilai ENUM di DB Anda adalah 'masuk', ubah 'pending' di atas ke 'masuk'.
             
            if (!in_array($request->status, $allowedStatus)) {
                return back()->with('error', 'Status tidak valid.');
            }
            
            // Tambahkan logika untuk memastikan hanya perusahaan pemilik yang bisa update
            $companyId = Auth::guard('company')->user()->id;
            if ($app->company_id != $companyId) {
                return back()->with('error', 'Anda tidak memiliki izin untuk mengubah pelamar ini.');
            }

            $app->update([
                'status' => $request->status
            ]);

            return back()->with('success', 'Status pelamar berhasil diperbarui menjadi ' . ucfirst(str_replace('_', ' ', $request->status)) . '.');
        }
    }

    /**
     * Tombol NEXT (otomatis geser ke status berikut)
     */
    public function nextProgress($id)
    {
        // ... (Logika nextProgress tidak diubah, namun sebaiknya ditambahkan 
        // pengecekan kepemilikan data seperti pada updateStatus/show)
        $companyId = Auth::guard('company')->user()->id;
        $app = CompaniesApplication::where('company_id', $companyId)->findOrFail($id);

        // Urutan progress
        $flow = [
            'pending', // Mengganti 'masuk' dengan 'pending' agar sesuai dengan logika awal di view
            'diproses',
            'profile_lolos',
            'wawancara_lolos',
            'tes_lolos',
            'diterima'
        ];
        
        // Cek jika status saat ini 'ditolak', tidak bisa lanjut
        if ($app->status == 'ditolak') {
             return back()->with('error', 'Pelamar sudah ditolak dan tidak dapat dimajukan lagi.');
        }

        $currentIndex = array_search($app->status, $flow);

        // Jika status saat ini tidak ada di flow (misalnya 'ditolak'), atau sudah di tahap terakhir
        if ($currentIndex === false || $currentIndex === count($flow) - 1) {
            return back()->with('error', 'Pelamar sudah di tahap akhir atau memiliki status yang tidak bisa dimajukan secara otomatis.');
        }

        $nextStatus = $flow[$currentIndex + 1];

        $app->update(['status' => $nextStatus]);

        return back()->with('success', 'Status pelamar berpindah ke tahap: ' . ucfirst(str_replace('_', ' ', $nextStatus)));
    }

    /**
     * Lihat CV pelamar
     */
    public function cv($id)
    {
        // Tambahkan pengecekan kepemilikan data sebelum mengakses file
        $companyId = Auth::guard('company')->user()->id;
        $app = CompaniesApplication::where('company_id', $companyId)->findOrFail($id);

        if (empty($app->cv)) {
            abort(404, 'CV tidak ditemukan pada data pelamar ini.');
        }

        $filePath = storage_path('app/public/' . $app->cv);

        if (!file_exists($filePath)) {
            abort(404, 'File CV tidak ditemukan di server.');
        }

        return response()->file($filePath);
    }
}