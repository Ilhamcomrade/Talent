<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\JobListing;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Dashboard Laporan Utama
     */
    public function index(Request $request)
    {
        // Statistik Utama
        $totalApplications = Application::count();
        $activeJobListings = JobListing::where('is_active', true)->count();
        $monthlyApplications = Application::whereMonth('applied_at', now()->month)->count();
        $weeklyApplications = Application::whereBetween('applied_at', [now()->startOfWeek(), now()->endOfWeek()])->count();

        // Data untuk tables
        $recentApplications = Application::with(['jobListing', 'user'])
                                       ->latest()
                                       ->limit(10)
                                       ->get();

        $popularJobs = JobListing::withCount('applications')
                                 ->orderByDesc('applications_count')
                                 ->limit(5)
                                 ->get();

        return view('admin.reports.index', [
            'totalApplications' => $totalApplications,
            'activeJobListings' => $activeJobListings,
            'monthlyApplications' => $monthlyApplications,
            'weeklyApplications' => $weeklyApplications,
            'recentApplications' => $recentApplications,
            'popularJobs' => $popularJobs,
        ]);
    }
    
    /**
     * Laporan Aplikasi Detail dengan Filter
     */
    public function applications(Request $request)
    {
        $query = Application::with(['jobListing', 'candidate'])
                           ->latest();

        // Filters
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('applied_at', [$request->start_date, $request->end_date]);
        }

        $applications = $query->paginate(20);

        $statusCounts = Application::select('status', DB::raw('count(*) as total'))
                                 ->groupBy('status')
                                 ->pluck('total', 'status');

        return view('admin.reports.applications', [
            'applications' => $applications,
            'statusCounts' => $statusCounts,
            'filters' => $request->all()
        ]);
    }

    /**
     * Laporan Lowongan Kerja
     */
    public function jobs(Request $request)
    {
        $query = JobListing::withCount('applications')
                          ->with('employer')
                          ->latest();

        if ($request->has('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        $jobs = $query->paginate(20);

        $jobStats = [
            'total' => JobListing::count(),
            'active' => JobListing::where('is_active', true)->count(),
            'inactive' => JobListing::where('is_active', false)->count(),
        ];

        return view('admin.reports.jobs', [
            'jobs' => $jobs,
            'jobStats' => $jobStats,
            'filters' => $request->all()
        ]);
    }
}