<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use App\Models\Company; // Tambahkan ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobListingController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $search = $request->get('search');
        $jobType = $request->get('job_type');
        $type = $request->get('type');
        $status = $request->get('status');

        $jobs = JobListing::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('company', 'like', "%{$search}%")
                        ->orWhereHas('province', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        })
                        ->orWhereHas('regency', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        })
                        ->orWhereHas('district', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->when($jobType, function ($query, $jobType) {
                $query->where('job_type', $jobType);
            })
            ->when($type, function ($query, $type) {
                $query->where('type', $type);
            })
            ->when($status, function ($query, $status) {
                if ($status === 'published') {
                    $query->where('is_public', true);
                } elseif ($status === 'draft') {
                    $query->where('is_public', false);
                }
            })
            ->with(['province', 'regency', 'district', 'village'])
            ->latest()
            ->paginate($perPage)
            ->appends([
                'search' => $search,
                'job_type' => $jobType,
                'type' => $type,
                'status' => $status,
                'per_page' => $perPage,
            ]);

        return view('admin.job_listings.index', compact('jobs', 'search', 'jobType', 'type', 'status', 'perPage'));
    }

    public function create()
    {
        $provinces = Province::orderBy('name')->get();
        $companies = Company::select('id', 'nama_lengkap')->orderBy('nama_lengkap')->get(); // Tambahkan ini
        return view('admin.job_listings.create', compact('provinces', 'companies')); // Tambahkan companies
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id', // Tambahkan validasi company_id
            'company_logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'provinsi_id' => 'required|string|size:2',
            'kabupaten_id' => 'required|string|size:4',
            'kecamatan_id' => 'required|string|size:7',
            'desa_id' => 'nullable|string|size:10',
            'salary_min' => 'nullable|integer',
            'salary_max' => 'nullable|integer',
            'type' => 'required|in:full-time,part-time,contract,internship',
            'job_type' => 'required|in:penuh_waktu,kontrak,magang,paruh_waktu,freelance,harian',
            'work_policy' => 'required|in:kerja_di_kantor,hybrid,remote',
            'experience_level' => 'required|in:tidak_berpengalaman,fresh_graduate,kurang_dari_setahun,1_3_tahun,3_5_tahun,5_10_tahun,lebih_dari_10_tahun',
            'education_level' => 'required|in:s3,s2,s1,d1_d4,sma_smk,smp,sd',
            'requirements' => 'nullable|string',
            'skills' => 'nullable|string',
            'qualifications' => 'nullable|string',
            'deadline' => 'nullable|date',
            'is_public' => 'required|in:0,1',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('company_logo')) {
            $validated['company_logo'] = $request->file('company_logo')->store('company_logos', 'public');
        }

        // Tambahkan field company_id ke data yang akan disimpan
        $validated['company_id'] = $request->company_id;

        JobListing::create($validated);

        return redirect()->route('admin.job_listings.index')->with('success', 'Lowongan berhasil ditambahkan.');
    }

    public function show(JobListing $jobListing)
    {
        $jobListing->load(['province', 'regency', 'district', 'village', 'company']); // Tambahkan company
        return view('admin.job_listings.show', compact('jobListing'));
    }

    public function edit(JobListing $jobListing)
    {
        $provinces = Province::orderBy('name')->get();
        $companies = Company::select('id', 'nama_lengkap')->orderBy('nama_lengkap')->get(); // Tambahkan ini
        
        // Load data wilayah yang sudah dipilih untuk auto-select
        $regencies = collect();
        $districts = collect();
        $villages = collect();

        // Jika ada provinsi_id, load kabupaten
        if ($jobListing->provinsi_id) {
            $regencies = Regency::where('province_id', $jobListing->provinsi_id)
                ->orderBy('name')
                ->get();
        }

        // Jika ada kabupaten_id, load kecamatan
        if ($jobListing->kabupaten_id) {
            $districts = District::where('regency_id', $jobListing->kabupaten_id)
                ->orderBy('name')
                ->get();
        }

        // Jika ada kecamatan_id, load desa
        if ($jobListing->kecamatan_id) {
            $villages = Village::where('district_id', $jobListing->kecamatan_id)
                ->orderBy('name')
                ->get();
        }

        return view('admin.job_listings.edit', compact(
            'jobListing', 
            'provinces',
            'companies', // Tambahkan companies
            'regencies',
            'districts',
            'villages'
        ));
    }

    public function update(Request $request, JobListing $jobListing)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id', // Tambahkan validasi company_id
            'company_logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'provinsi_id' => 'required|string|size:2',
            'kabupaten_id' => 'required|string|size:4',
            'kecamatan_id' => 'required|string|size:7',
            'desa_id' => 'nullable|string|size:10',
            'salary_min' => 'nullable|integer',
            'salary_max' => 'nullable|integer',
            'type' => 'required|in:full-time,part-time,contract,internship',
            'job_type' => 'required|in:penuh_waktu,kontrak,magang,paruh_waktu,freelance,harian',
            'work_policy' => 'required|in:kerja_di_kantor,hybrid,remote',
            'experience_level' => 'required|in:tidak_berpengalaman,fresh_graduate,kurang_dari_setahun,1_3_tahun,3_5_tahun,5_10_tahun,lebih_dari_10_tahun',
            'education_level' => 'required|in:s3,s2,s1,d1_d4,sma_smk,smp,sd',
            'requirements' => 'nullable|string',
            'skills' => 'nullable|string',
            'qualifications' => 'nullable|string',
            'deadline' => 'nullable|date',
            'is_public' => 'required|in:0,1',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('company_logo')) {
            if ($jobListing->company_logo && Storage::disk('public')->exists($jobListing->company_logo)) {
                Storage::disk('public')->delete($jobListing->company_logo);
            }
            $validated['company_logo'] = $request->file('company_logo')->store('company_logos', 'public');
        }

        // Tambahkan field company_id ke data yang akan diupdate
        $validated['company_id'] = $request->company_id;

        $jobListing->update($validated);

        return redirect()->route('admin.job_listings.index')->with('success', 'Lowongan berhasil diperbarui.');
    }

    public function destroy(JobListing $jobListing)
    {
        if ($jobListing->company_logo && Storage::disk('public')->exists($jobListing->company_logo)) {
            Storage::disk('public')->delete($jobListing->company_logo);
        }

        $jobListing->delete();

        return redirect()->route('admin.job_listings.index')->with('success', 'Lowongan berhasil dihapus.');
    }

    public function publish(JobListing $jobListing)
    {
        try {
            $jobListing->update(['is_public' => true]);
            return redirect()->route('admin.job_listings.index')
                ->with('success', 'Lowongan berhasil dipublish');
        } catch (\Exception $e) {
            return redirect()->route('admin.job_listings.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function setDraft(JobListing $jobListing)
    {
        try {
            $jobListing->update(['is_public' => false]);
            return redirect()->route('admin.job_listings.index')
                ->with('success', 'Lowongan berhasil diubah menjadi draft');
        } catch (\Exception $e) {
            return redirect()->route('admin.job_listings.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function duplicate(JobListing $jobListing)
    {
        try {
            $newJob = $jobListing->replicate();
            $newJob->title = $jobListing->title . ' (Copy)';
            $newJob->is_public = false;
            $newJob->created_at = now();
            $newJob->updated_at = now();
            $newJob->save();

            return redirect()->route('admin.job_listings.index')
                ->with('success', 'Lowongan berhasil diduplikasi');
        } catch (\Exception $e) {
            return redirect()->route('admin.job_listings.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function bulkAction(Request $request)
    {
        $action = $request->get('action');
        $ids = $request->get('selected_ids', []);

        if (empty($ids)) {
            return redirect()->back()->with('error', 'Tidak ada lowongan yang dipilih.');
        }

        try {
            switch ($action) {
                case 'publish':
                    JobListing::whereIn('id', $ids)->update(['is_public' => true]);
                    $message = 'Lowongan berhasil dipublish';
                    break;
                
                case 'draft':
                    JobListing::whereIn('id', $ids)->update(['is_public' => false]);
                    $message = 'Lowongan berhasil diubah ke draft';
                    break;
                
                case 'delete':
                    $jobs = JobListing::whereIn('id', $ids)->get();
                    foreach ($jobs as $job) {
                        if ($job->company_logo && Storage::disk('public')->exists($job->company_logo)) {
                            Storage::disk('public')->delete($job->company_logo);
                        }
                        $job->delete();
                    }
                    $message = 'Lowongan berhasil dihapus';
                    break;
                
                default:
                    return redirect()->back()->with('error', 'Aksi tidak valid.');
            }

            return redirect()->route('admin.job_listings.index')->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->route('admin.job_listings.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // API endpoints untuk dropdown bertingkat wilayah
    public function getRegencies($provinceId)
    {
        try {
            $regencies = Regency::where('province_id', $provinceId)
                ->orderBy('name')
                ->get(['id', 'name']);
            return response()->json($regencies);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to load regencies'], 500);
        }
    }

    public function getDistricts($regencyId)
    {
        try {
            $districts = District::where('regency_id', $regencyId)
                ->orderBy('name')
                ->get(['id', 'name']);
            return response()->json($districts);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to load districts'], 500);
        }
    }

    public function getVillages($districtId)
    {
        try {
            $villages = Village::where('district_id', $districtId)
                ->orderBy('name')
                ->get(['id', 'name']);
            return response()->json($villages);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to load villages'], 500);
        }
    }

    public function getLocationDetails(Request $request)
    {
        try {
            $provinceId = $request->get('provinsi_id');
            $regencyId = $request->get('kabupaten_id');
            $districtId = $request->get('kecamatan_id');
            $villageId = $request->get('desa_id');

            $locationDetails = [];

            if ($villageId) {
                $village = Village::with(['district.regency.province'])->find($villageId);
                if ($village) {
                    $locationDetails = [
                        'village' => $village->name,
                        'district' => $village->district->name,
                        'regency' => $village->district->regency->name,
                        'province' => $village->district->regency->province->name,
                        'full' => "{$village->name}, {$village->district->name}, {$village->district->regency->name}, {$village->district->regency->province->name}"
                    ];
                }
            } elseif ($districtId) {
                $district = District::with(['regency.province'])->find($districtId);
                if ($district) {
                    $locationDetails = [
                        'district' => $district->name,
                        'regency' => $district->regency->name,
                        'province' => $district->regency->province->name,
                        'full' => "{$district->name}, {$district->regency->name}, {$district->regency->province->name}"
                    ];
                }
            } elseif ($regencyId) {
                $regency = Regency::with(['province'])->find($regencyId);
                if ($regency) {
                    $locationDetails = [
                        'regency' => $regency->name,
                        'province' => $regency->province->name,
                        'full' => "{$regency->name}, {$regency->province->name}"
                    ];
                }
            } elseif ($provinceId) {
                $province = Province::find($provinceId);
                if ($province) {
                    $locationDetails = [
                        'province' => $province->name,
                        'full' => $province->name
                    ];
                }
            }

            return response()->json($locationDetails);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to load location details'], 500);
        }
    }

    public function export(Request $request)
    {
        try {
            $jobs = JobListing::with(['province', 'regency', 'district', 'village'])
                ->latest()
                ->get();

            // Implement export logic here
            return redirect()->back()->with('success', 'Export functionality will be implemented here');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengekspor data: ' . $e->getMessage());
        }
    }

    public function getStats()
    {
        try {
            $stats = [
                'total' => JobListing::count(),
                'published' => JobListing::where('is_public', true)->count(),
                'draft' => JobListing::where('is_public', false)->count(),
                'expired' => JobListing::where('deadline', '<', now())->count(),
            ];
            return response()->json($stats);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to load statistics'], 500);
        }
    }
}