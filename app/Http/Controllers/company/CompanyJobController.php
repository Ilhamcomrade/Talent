<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\CompaniesJob;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyJobController extends Controller
{
    /**
     * Menampilkan halaman pekerjaan perusahaan dengan pagination
     */
    public function index($slug, Request $request)
    {
        // Ambil data perusahaan berdasarkan slug
        $company = Company::where('slug', $slug)->firstOrFail();

        // Ambil parameter pencarian
        $search = $request->input('search');

        // Query dasar untuk lowongan pekerjaan
        $query = CompaniesJob::where('company_id', $company->id)
            ->with(['province', 'regency', 'district', 'village']);

        // Filter berdasarkan pencarian jika ada (case-insensitive)
        if ($search) {
            // Membersihkan dan memformat search term
            $searchTerm = strtolower(trim($search));

            $query->where(function($q) use ($searchTerm) {
                // Menggunakan LOWER() untuk membuat pencarian case-insensitive
                $q->where(DB::raw('LOWER(title)'), 'LIKE', "%{$searchTerm}%")
                  ->orWhere(DB::raw('LOWER(description)'), 'LIKE', "%{$searchTerm}%");
            });
        }

        // Urutkan berdasarkan tanggal dibuat (terbaru dulu)
        $query->orderBy('created_at', 'desc');

        // Pagination
        $perPage = 10; // Jumlah item per halaman
        $jobs = $query->paginate($perPage)->appends($request->query());

        // Hitung total lowongan (dengan filter jika ada)
        if ($search) {
            $searchTerm = strtolower(trim($search));

            $jobCount = CompaniesJob::where('company_id', $company->id)
                ->where(function($q) use ($searchTerm) {
                    $q->where(DB::raw('LOWER(title)'), 'LIKE', "%{$searchTerm}%")
                      ->orWhere(DB::raw('LOWER(description)'), 'LIKE', "%{$searchTerm}%");
                })
                ->count();
        } else {
            $jobCount = CompaniesJob::where('company_id', $company->id)->count();
        }

        return view('detail_company.job_company', [
            'company' => $company,
            'jobs' => $jobs,
            'jobCount' => $jobCount
        ]);
    }
}
