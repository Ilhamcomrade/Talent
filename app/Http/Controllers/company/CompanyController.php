<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Benefit;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Menampilkan halaman detail perusahaan
     */
    public function show(Company $company)
    {
        try {
            // Pastikan perusahaan aktif
            if (!$company->is_active) {
                abort(404, 'Perusahaan tidak ditemukan');
            }

            return view('detail_company.detail_company', compact('company'));

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404, 'Perusahaan tidak ditemukan');
        }
    }

    /**
     * Menampilkan halaman culture/life perusahaan
     */
    public function culture(Company $company)
    {
        try {
            // Pastikan perusahaan aktif
            if (!$company->is_active) {
                abort(404, 'Perusahaan tidak ditemukan');
            }

            // Ambil benefit aktif dari perusahaan ini
            $benefits = Benefit::where('company_id', $company->id)
                ->where('status', 'aktif') // Hanya yang status aktif
                ->orderBy('created_at', 'desc')
                ->get();

            return view('detail_company.life_company', compact('company', 'benefits'));

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404, 'Perusahaan tidak ditemukan');
        }
    }

    public function job(Company $company)
    {
        try {
            // Pastikan perusahaan aktif
            if (!$company->is_active) {
                abort(404, 'Perusahaan tidak ditemukan');
            }

            return view('detail_company.job_company', compact('company'));

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404, 'Perusahaan tidak ditemukan');
        }
    }

    public function salary(Company $company)
    {
        try {
            // Pastikan perusahaan aktif
            if (!$company->is_active) {
                abort(404, 'Perusahaan tidak ditemukan');
            }

            return view('detail_company.salary_company', compact('company'));

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404, 'Perusahaan tidak ditemukan');
        }
    }

    /**
     * Menampilkan daftar semua perusahaan (untuk explore)
     */
    public function index()
    {
        return view('explore_company');
    }
}
