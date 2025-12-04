<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\CompaniesApplication;
use App\Models\CompaniesJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class cApplicantController extends Controller
{
    // Semua pelamar di semua lowongan perusahaan
    public function index()
    {
        $company = Auth::guard('company')->user();

        $applications = CompaniesApplication::whereHas('job', function ($q) use ($company) {
            $q->where('company_id', $company->id);
        })->latest()->get();

        return view('company.applications.index', compact('applications'));
    }

    // Pelamar berdasarkan 1 lowongan
    public function pelamarByJob($id)
    {
        $company = Auth::guard('company')->user();

        $job = CompaniesJob::where('id', $id)
            ->where('company_id', $company->id)
            ->firstOrFail();

        $applications = CompaniesApplication::where('companies_job_id', $id)
            ->latest()->get();

        return view('company.applications.pelamar_by_job', compact('job', 'applications'));
    }

    // Detail pelamar
    public function show($id)
    {
        $applicant = CompaniesApplication::findOrFail($id);

        return view('company.applications.show', compact('applicant'));
    }

    // Update status pelamar
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string'
        ]);

        $app = CompaniesApplication::findOrFail($id);
        $app->update(['status' => $request->status]);

        return back()->with('success', 'Status pelamar berhasil diperbarui.');
    }

    // Lihat CV
    public function cv($id)
    {
        $app = CompaniesApplication::findOrFail($id);

        return response()->file(storage_path('app/' . $app->cv));
    }
}
