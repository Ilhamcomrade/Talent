<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompaniesJob;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;

class JobController extends Controller
{
    /**
     * PUBLIC JOB LIST
     */
    public function index(Request $request)
    {
        $search       = $request->search;
        $province_id  = $request->provinsi_id;
        $regency_id   = $request->kabupaten_id;
        $district_id  = $request->kecamatan_id;
        $village_id   = $request->desa_id;
        $industry     = $request->industry;
        $work_mode    = $request->work_mode;

        $jobs = CompaniesJob::where('is_public', true) // hanya loker publik
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'ILIKE', "%$search%")
                      ->orWhere('company_name', 'ILIKE', "%$search%")
                      ->orWhere('industry', 'ILIKE', "%$search%");
                });
            })
            ->when($industry, fn($q) => $q->where('industry', $industry))
            ->when($work_mode, fn($q) => $q->where('work_mode', $work_mode))
            ->when($province_id, fn($q) => $q->where('provinsi_id', $province_id))
            ->when($regency_id, fn($q) => $q->where('kabupaten_id', $regency_id))
            ->when($district_id, fn($q) => $q->where('kecamatan_id', $district_id))
            ->when($village_id, fn($q) => $q->where('desa_id', $village_id))
            ->orderBy('created_at', 'desc')
            ->paginate(12)
            ->withQueryString();

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
            'work_mode'
        ));
    }

    public function getRegencies($provinceId)
    {
        return Regency::where('province_id', $provinceId)
            ->orderBy('name')
            ->get(['id', 'name']);
    }

    public function getDistricts($regencyId)
    {
        return District::where('regency_id', $regencyId)
            ->orderBy('name')
            ->get(['id', 'name']);
    }

    public function getVillages($districtId)
    {
        return Village::where('district_id', $districtId)
            ->orderBy('name')
            ->get(['id', 'name']);
    }

    /**
     * JOB DETAIL PUBLIC
     */
    public function show($slugOrId)
    {
        $job = CompaniesJob::where('is_public', true)
            ->where(function($q) use ($slugOrId) {
                $q->where('id', $slugOrId)
                  ->orWhere('title', 'ILIKE', str_replace('-', ' ', $slugOrId)); 
            })
            ->firstOrFail();

        return view('jobs.show', compact('job'));
    }
}
