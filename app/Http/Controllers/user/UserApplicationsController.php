<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CompaniesApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; 
use Carbon\Carbon; 

class UserApplicationsController extends Controller
{
    /**
     * Menampilkan semua lamaran milik user yang sedang login, dengan filter status,
     * hitungan 90 hari, dan hitungan per status untuk sidebar.
     */
    public function index(Request $request) 
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Anda harus login untuk mengakses halaman ini.');
        }

        $user = Auth::user();
        $userEmail = $user->email; // Ambil email user yang sedang login
        $currentStatus = $request->status;
        $ninetyDaysAgo = Carbon::now()->subDays(90);

        // --- 1. Query Utama Lamaran ---
        $applicationsQuery = CompaniesApplication::with('job.company')
            ->where('email', $userEmail);

        // Filter berdasarkan Status (dari Request/Sidebar)
        if ($currentStatus) {
            $applicationsQuery->where('status', $currentStatus);
        }

        // Ambil data lamaran
        $applications = $applicationsQuery->latest()->get();

        // --- 2. Hitung Lamaran dalam 90 Hari Terakhir ---
        // (Logika ini sudah benar: menghitung SEMUA lamaran yang dibuat dalam 90 hari)
        $recentApplicationsCount = CompaniesApplication::where('email', $userEmail)
            ->where('created_at', '>=', $ninetyDaysAgo)
            ->count();
            
        // --- 3. Hitung Jumlah Lamaran per Status untuk Sidebar ---
        $statusCounts = CompaniesApplication::select('status')
            ->where('email', $userEmail)
            ->groupBy('status')
            ->selectRaw('status, count(*) as count')
            ->pluck('count', 'status')
            ->toArray();

        // Total semua lamaran (untuk menu "Semua")
        $allApplicationsCount = array_sum($statusCounts);
        
        // Handling jika lowongan sudah dihapus (untuk menghindari error di view)
        $applications->each(function ($app) {
            if (!$app->job) {
                $app->job = (object)['title' => 'Lowongan Dihapus', 'company_name' => '-'];
            }
        });

        // 4. Kembalikan data ke view
        return view('user.applications.index', compact(
            'applications', 
            'recentApplicationsCount', 
            'statusCounts',      // Variabel baru: Jumlah per status
            'allApplicationsCount' // Variabel baru: Jumlah total semua lamaran
        ));
    }

    /**
     * Detail 1 lamaran user
     */
    public function show($id)
    {
        $user = Auth::user();

        // Pastikan lamaran milik user berdasarkan email
        $application = CompaniesApplication::with('job')
            ->where('id', $id)
            ->where('email', $user->email)
            ->firstOrFail();

        return view('jobs.show', compact('application'));
    }

    /**
     * Lihat CV yang di-upload user (Menggunakan Storage Laravel)
     */
    public function cv($id)
    {
        $user = Auth::user();

        $application = CompaniesApplication::where('id', $id)
            ->where('email', $user->email)
            ->firstOrFail();
            
        // Ganti dengan penggunaan Storage::disk('public')->path()
        $filePath = Storage::disk('public')->path($application->cv);

        if (!Storage::disk('public')->exists($application->cv)) {
            abort(404, 'File CV tidak ditemukan.');
        }
        
        // Menggunakan response()->file untuk menampilkan di browser
        return response()->file($filePath);
    }
    
    /**
     * Hapus Lamaran
     * Menghapus semua file (CV, Surat, Foto, Ijazah) terkait lamaran.
     */
    public function destroy($id)
    {
        $user = Auth::user();

        $application = CompaniesApplication::where('id', $id)
            ->where('email', $user->email)
            ->firstOrFail();

        // Daftar kolom file yang harus dihapus
        $filesToDelete = [
            $application->cv,
            $application->surat_lamaran, 
            $application->foto,          
            $application->ijazah,        
        ];
        
        // Hapus semua file yang ada di storage (lebih aman daripada unlink)
        Storage::disk('public')->delete(array_filter($filesToDelete));
        
        $application->delete();

        return back()->with('success', 'Lamaran berhasil dihapus.');
    }
    
    /**
     * Menampilkan file dokumen (surat lamaran, foto, ijazah, dll.)
     */
    public function viewFile($id, $fileType)
    {
        $user = Auth::user();

        $application = CompaniesApplication::where('id', $id)
            ->where('email', $user->email)
            ->firstOrFail();

        // Pastikan $fileType adalah kolom yang valid dan tidak null
        if (!in_array($fileType, ['cv', 'surat_lamaran', 'foto', 'ijazah']) || !$application->{$fileType}) {
             abort(404, 'Jenis file tidak valid atau data file kosong.');
        }

        $filePath = $application->{$fileType};

        if (!Storage::disk('public')->exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        // Return file
        return response()->file(Storage::disk('public')->path($filePath));
    }

}