@extends('admin.layout')

@section('title', 'Laporan')
@section('content')

<style>
    .stat-card {
        border-radius: 12px;
        border: none;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 16px rgba(0,0,0,0.15);
    }
    
    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: #667eea;
    }
    
    .stat-label {
        color: #6c757d;
        font-size: 0.9rem;
        font-weight: 500;
    }
    
    .chart-container {
        position: relative;
        height: 300px;
    }
</style>

<div class="container-fluid py-4">
    {{-- Page Title --}}
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 d-flex align-items-center">
                <i class="fas fa-chart-line me-3" style="color: #667eea;"></i>
                Laporan & Dashboard
            </h1>
        </div>
    </div>

    {{-- Statistics Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-md-6 col-lg-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="stat-label mb-2">Total Lamaran</p>
                            <p class="stat-value">{{ number_format($totalApplications) }}</p>
                        </div>
                        <div class="text-primary" style="font-size: 2rem; opacity: 0.2;">
                            <i class="fas fa-file-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="stat-label mb-2">Lowongan Aktif</p>
                            <p class="stat-value" style="color: #28a745;">{{ number_format($activeJobListings) }}</p>
                        </div>
                        <div class="text-success" style="font-size: 2rem; opacity: 0.2;">
                            <i class="fas fa-briefcase"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="stat-label mb-2">Lamaran Bulan Ini</p>
                            <p class="stat-value" style="color: #ffc107;">{{ number_format($monthlyApplications) }}</p>
                        </div>
                        <div class="text-warning" style="font-size: 2rem; opacity: 0.2;">
                            <i class="fas fa-calendar"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="stat-label mb-2">Lamaran Minggu Ini</p>
                            <p class="stat-value" style="color: #17a2b8;">{{ number_format($weeklyApplications) }}</p>
                        </div>
                        <div class="text-info" style="font-size: 2rem; opacity: 0.2;">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content Row --}}
    <div class="row g-3">
        {{-- Recent Applications Table --}}
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-history me-2"></i>Lamaran Terbaru
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 5%">#</th>
                                    <th style="width: 25%">Pelamar</th>
                                    <th style="width: 30%">Lowongan</th>
                                    <th style="width: 15%">Status</th>
                                    <th style="width: 25%">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentApplications as $index => $app)
                                    <tr>
                                        <td class="fw-semibold text-muted">{{ $index + 1 }}</td>
                                        <td>
                                            @if($app->user)
                                                {{ $app->user->name ?? 'N/A' }}
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($app->jobListing)
                                                <span class="badge bg-primary">{{ Str::limit($app->jobListing->title, 25) }}</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $statusColors = [
                                                    'pending' => 'warning',
                                                    'reviewed' => 'info',
                                                    'accepted' => 'success',
                                                    'rejected' => 'danger',
                                                ];
                                                $color = $statusColors[$app->status] ?? 'secondary';
                                            @endphp
                                            <span class="badge bg-{{ $color }}">
                                                {{ ucfirst($app->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                {{ $app->created_at->diffForHumans() }}
                                            </small>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">
                                            Tidak ada lamaran
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Popular Jobs --}}
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-fire me-2"></i>Lowongan Populer
                    </h5>
                </div>
                <div class="card-body">
                    @forelse($popularJobs as $job)
                        <div class="mb-3 pb-3 border-bottom">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">
                                        <a href="{{ route('admin.job_listings.show', $job->id) }}" class="text-decoration-none">
                                            {{ Str::limit($job->title, 30) }}
                                        </a>
                                    </h6>
                                    <p class="text-muted small mb-0">{{ $job->company }}</p>
                                </div>
                                <span class="badge bg-primary">
                                    {{ $job->applications_count }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted text-center py-4">Tidak ada lowongan</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="d-flex gap-2 justify-content-end">
                <a href="{{ route('admin.job_listings.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-briefcase me-2"></i>Kelola Lowongan
                </a>
                <a href="{{ route('admin.applicants.index') }}" class="btn btn-outline-info">
                    <i class="fas fa-users me-2"></i>Kelola Pelamar
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
