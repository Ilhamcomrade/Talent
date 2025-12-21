<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompaniesJob;
use App\Models\CompaniesApplication;
use Illuminate\Support\Facades\Storage;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use Illuminate\Support\Facades\Auth;

class cJobController extends Controller
{
    /**
     * INDEX + SEARCH
     */
    public function index(Request $request)
    {
        $company = Auth::guard('company')->user();
        $search = $request->input('search');

        $jobs = CompaniesJob::where('company_id', $company->id)
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'LIKE', "%$search%")
                      ->orWhere('industry', 'LIKE', "%$search%");
            })
            ->latest()
            ->paginate(10);

        // Hitung pelamar setiap job
        foreach ($jobs as $job) {
            $job->pelamar = CompaniesApplication::where('companies_job_id', $job->id)->count();
            $job->save();
        }

        return view('company.jobs.index', compact('jobs', 'search'));
    }

    /**
     * CREATE FORM
     */
    public function create()
    {
        $provinces = Province::orderBy('name')->get();
        return view('company.jobs.create', compact('provinces'));
    }

    /**
     * STORE DATA
     */
    public function store(Request $request)
    {
        $company = Auth::guard('company')->user();

        // VALIDATION
        $request->validate([
            'industry' => 'nullable|string|max:255',
            'company_logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'title' => 'required|string|max:255',
            'employment_type' => 'required|string',
            'work_mode' => 'required|string',
            'experience' => 'required|string',
            'education_level' => 'required|string',
            'job_category_id' => 'nullable|exists:job_categories,id',
        ]);

        // Upload logo jika ada
        $logoPath = null;
        if ($request->hasFile('company_logo')) {
            $logoPath = $request->file('company_logo')->store('company_logos', 'public');
        }

        // Skills array
        $skills = $request->skills
            ? array_map('trim', explode(',', $request->skills))
            : [];

        CompaniesJob::create([
            'company_id'      => $company->id,
            'company_name'    => $company->nama_perusahaan,
            'industry'        => $request->industry,
            'job_category_id' => $request->job_category_id,   // FIX
            'company_logo'    => $logoPath,
            'title'           => $request->title,
            'job_level'       => $request->job_level,
            'show_salary'     => $request->has('show_salary'),
            'salary_min'      => $request->salary_min,
            'salary_max'      => $request->salary_max,
            'employment_type' => $request->employment_type,
            'work_mode'       => $request->work_mode,
            'education_level' => $request->education_level,
            'experience'      => $request->experience,
            'skills'          => $skills,
            'requirements'    => $request->requirements,
            'description'     => $request->description,
            'tanggung_jawab'  => $request->tanggung_jawab,
            'kualifikasi'     => $request->kualifikasi,
            'nilai_tambah'    => $request->nilai_tambah,
            'provinsi_id'     => $request->provinsi_id,
            'kabupaten_id'    => $request->kabupaten_id,
            'kecamatan_id'    => $request->kecamatan_id,
            'desa_id'         => $request->desa_id,
            'is_public'       => $request->has('is_public'),
        ]);

        return redirect()->route('companiesjobs.index')
            ->with('success', 'Job berhasil dibuat!');
    }

    /**
     * EDIT FORM
     */
    public function edit($id)
    {
        $company = Auth::guard('company')->user();
        $job = CompaniesJob::findOrFail($id);

        if ($job->company_id != $company->id) {
            abort(403);
        }

        $provinces = Province::orderBy('name')->get();
        $regencies = $job->provinsi_id ? Regency::where('province_id', $job->provinsi_id)->orderBy('name')->get() : collect();
        $districts = $job->kabupaten_id ? District::where('regency_id', $job->kabupaten_id)->orderBy('name')->get() : collect();
        $villages = $job->kecamatan_id ? Village::where('district_id', $job->kecamatan_id)->orderBy('name')->get() : collect();

        return view('company.jobs.edit', compact('job', 'provinces', 'regencies', 'districts', 'villages'));
    }

    /**
     * UPDATE
     */
    public function update(Request $request, $id)
    {
        $company = Auth::guard('company')->user();
        $job = CompaniesJob::findOrFail($id);

        if ($job->company_id != $company->id) {
            abort(403);
        }

        $request->validate([
            'industry' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'job_category_id' => 'nullable|exists:job_categories,id',
        ]);

        // Update logo jika diupload ulang
        if ($request->hasFile('company_logo')) {
            if ($job->company_logo) {
                Storage::disk('public')->delete($job->company_logo);
            }
            $job->company_logo = $request->file('company_logo')->store('company_logos', 'public');
        }

        $skills = $request->skills ? array_map('trim', explode(',', $request->skills)) : [];

        $job->update([
            'industry' => $request->industry,
            'title' => $request->title,
            'job_category_id' => $request->job_category_id, // FIX
            'job_level' => $request->job_level,
            'show_salary' => $request->show_salary ? true : false,
            'salary_min' => $request->salary_min,
            'salary_max' => $request->salary_max,
            'employment_type' => $request->employment_type,
            'work_mode' => $request->work_mode,
            'education_level' => $request->education_level,
            'experience' => $request->experience,
            'skills' => $skills,
            'requirements' => $request->requirements,
            'description' => $request->description,
            'tanggung_jawab' => $request->tanggung_jawab,
            'kualifikasi' => $request->kualifikasi,
            'nilai_tambah' => $request->nilai_tambah,
            'provinsi_id' => $request->provinsi_id,
            'kabupaten_id' => $request->kabupaten_id,
            'kecamatan_id' => $request->kecamatan_id,
            'desa_id' => $request->desa_id,
            'location' => $request->location,
            'is_public' => $request->is_public ? true : false,
        ]);

        return redirect()->route('companiesjobs.index')->with('success', 'Job berhasil diperbarui!');
    }

    /**
     * DELETE
     */
    public function destroy($id)
    {
        $company = Auth::guard('company')->user();
        $job = CompaniesJob::findOrFail($id);

        if ($job->company_id != $company->id) {
            abort(403);
        }

        if ($job->company_logo) {
            Storage::disk('public')->delete($job->company_logo);
        }

        $job->delete();

        return back()->with('success', 'Job berhasil dihapus!');
    }

    /**
     * API WILAYAH
     */
    public function getRegencies($provinceId)
    {
        return Regency::where('province_id', $provinceId)->orderBy('name')->get(['id', 'name']);
    }

    public function getDistricts($regencyId)
    {
        return District::where('regency_id', $regencyId)->orderBy('name')->get(['id', 'name']);
    }

    public function getVillages($districtId)
    {
        return Village::where('district_id', $districtId)->orderBy('name')->get(['id', 'name']);
    }
}
