<?php

// namespace App\Http\Controllers\Company;

// use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Auth;
// use App\Models\CompaniesJob;
// use App\Models\CompaniesApplication;

// class cDashboardController extends Controller
// {
//     public function index()
//     {
//         $companyId = Auth::guard('company')->id();

//         return view('company.company_dashboard', [
//             'totalLowongan' => CompaniesJob::where('company_id', $companyId)->count(),

//             'totalPelamar' => CompaniesApplication::whereIn(
//                 'companies_job_id',
//                 CompaniesJob::where('company_id', $companyId)->pluck('id')
//             )->count(),

//             'lowonganAktif' => CompaniesJob::where('company_id', $companyId)
//                 ->where('status', 'aktif')
//                 ->count(),

//             'lowonganExpired' => CompaniesJob::where('company_id', $companyId)
//                 ->where('status', 'expired')
//                 ->count(),
//         ]);
//     }

//     public function detailLowongan()
//     {
//         $companyId = Auth::guard('company')->id();

//         $lowongan = CompaniesJob::where('company_id', $companyId)->get();

//         return view('company.dashboard.detail', compact('lowongan'));
//     }

//     public function detailPelamar()
//     {
//         $companyId = Auth::guard('company')->id();

//         $pelamar = CompaniesApplication::whereIn(
//             'companies_job_id',
//             CompaniesJob::where('company_id', $companyId)->pluck('id')
//         )->get();

//         return view('company.dashboard.detailpelamar', compact('pelamar'));
//     }

//     public function detailLowonganAktif()
//     {
//         $companyId = Auth::guard('company')->id();

//         $lowongan = CompaniesJob::where('company_id', $companyId)
//             ->where('status', 'aktif')
//             ->get();

//         return view('company.dashboard.detail_lowongan_aktif', compact('lowongan'));
//     }

//     public function detailLowonganExpired()
//     {
//         $companyId = Auth::guard('company')->id();

//         $lowongan = CompaniesJob::where('company_id', $companyId)
//             ->where('status', 'expired')
//             ->get();

//         return view('company.dashboard.detail_lowongan_expired', compact('lowongan'));
//     }
// }
