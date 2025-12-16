<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\CompaniesApplication;
use App\Models\CompaniesJob;
use App\Models\CompaniesMagang;

class cDashboardController extends Controller
{
    public function index()
    {
        $company = Auth::guard('company')->user();

        // ==========================
        // TOTAL STATISTIK
        // ==========================

        // Total lowongan kerja
        $totalJobs = CompaniesJob::where('company_id', $company->id)->count();

        // Total lowongan magang (PAKE TABEL companies_magang)
        $totalMagangJobs = CompaniesMagang::where('company_id', $company->id)->count();

        // Total aplikasi lamaran dari tabel companies_applications
        $totalApplicants = CompaniesApplication::whereHas('job', function ($q) use ($company) {
            $q->where('company_id', $company->id);
        })->count();

        // Total pelamar unik (berdasarkan email)
        $totalUniqueApplicants = CompaniesApplication::whereHas('job', function ($q) use ($company) {
                $q->where('company_id', $company->id);
            })
            ->distinct('email')
            ->count('email');

        // Total pelamar magang (BERDASARKAN JOB kerja bertipe 'Magang')
        // NOTE: ini cuma kepake kalau di companies_jobs ada employment_type = 'Magang'
        $totalMagangApplicants = CompaniesApplication::whereHas('job', function ($q) use ($company) {
            $q->where('company_id', $company->id)
              ->where('employment_type', 'Magang');
        })->count();

        // ==========================
        // GRAFIK: LOWONGAN KERJA PER BULAN
        // ==========================

        $monthlyJobs = CompaniesJob::where('company_id', $company->id)
            ->selectRaw('EXTRACT(MONTH FROM created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // ==========================
        // GRAFIK: LOWONGAN MAGANG PER BULAN (tabel companies_magang)
        // ==========================

        $monthlyMagangJobs = CompaniesMagang::where('company_id', $company->id)
            ->selectRaw('EXTRACT(MONTH FROM created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // ==========================
        // SIAPKAN ARRAY 12 BULAN (1–12)
        // ==========================

        $chartJobs = [];
        $chartMagang = [];

        for ($i = 1; $i <= 12; $i++) {
            $chartJobs[]   = $monthlyJobs[$i] ?? 0;
            $chartMagang[] = $monthlyMagangJobs[$i] ?? 0;
        }

        return view('company.company_dashboard', compact(
            'totalJobs',
            'totalMagangJobs',
            'totalApplicants',
            'totalUniqueApplicants',
            'totalMagangApplicants',
            'chartJobs',
            'chartMagang'
        ));
    }
}
