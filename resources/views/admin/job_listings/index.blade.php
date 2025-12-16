@extends('admin.layout')

@section('title', 'Daftar Lowongan')
@section('content')

<style>
    .fa-edit:hover {
        color: #ffda6a !important;
        transform: scale(1.15);
        transition: 0.2s ease;
    }
    .fa-trash:hover {
        color: #ff6b6b !important;
        transform: scale(1.15);
        transition: 0.2s ease;
    }
    .table tfoot {
        border-top: 2px solid #dee2e6;
    }
    .table-responsive {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .table thead {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    .table thead th {
        color: white;
        border: none;
        padding: 15px 12px;
        font-weight: 600;
    }
    .table tbody tr:hover {
        background-color: rgba(0,0,0,0.02);
        transform: translateY(-1px);
        transition: all 0.2s ease;
    }
    .badge {
        font-size: 0.75em;
        padding: 6px 10px;
    }
    .company-logo {
        width: 50px;
        height: 50px;
        object-fit: contain;
        border-radius: 6px;
        border: 1px solid #dee2e6;
        background: white;
        padding: 2px;
    }
</style>

<div class="container-fluid py-4">
    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Daftar Lowongan</h4>
                <div class="page-title-right">
                    <a href="{{ route('admin.job_listings.create') }}" class="btn btn-success">
                        <i class="fas fa-plus me-1"></i> Tambah Lowongan
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Toast Notifikasi Sukses --}}
    @if(session('success'))
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1080; margin-top: 70px;">
        <div id="liveToast"
             class="toast align-items-center text-white bg-success border-0 shadow-lg"
             role="alert"
             aria-live="assertive"
             aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body d-flex align-items-center">
                    <i class="fas fa-check-circle me-2 fs-5"></i>
                    {{ session('success') }}
                </div>
                <button type="button"
                        class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast"
                        aria-label="Close"></button>
            </div>
        </div>
    </div>
    @endif

    {{-- Form Pencarian & Filter --}}
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.job_listings.index') }}" class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label for="search" class="form-label">Cari Lowongan</label>
                <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" name="search" id="search" class="form-control"
                               placeholder="Cari posisi / perusahaan..."
                           value="{{ request('search') }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="location" class="form-label">Lokasi</label>
                    <select name="location" id="location" class="form-select">
                        <option value="">Semua Lokasi</option>
                        @php
                            try {
                                $regencies = \App\Models\Regency::orderBy('name')->get();
                            } catch (\Throwable $e) {
                                $regencies = collect([]);
                            }
                        @endphp
                        @foreach($regencies as $regency)
                            <option value="{{ $regency->id }}" {{ request('location') == $regency->id ? 'selected' : '' }}>
                                {{ $regency->name }}
                            </option>
                        @endforeach
                    </select>
            </div>
            
            <div class="col-md-2">
                    <label for="type" class="form-label">Tipe Kerja</label>
                <select name="type" id="type" class="form-select">
                    <option value="">Semua Tipe</option>
                    <option value="full-time" {{ request('type') == 'full-time' ? 'selected' : '' }}>Full-time</option>
                    <option value="part-time" {{ request('type') == 'part-time' ? 'selected' : '' }}>Part-time</option>
                    <option value="contract" {{ request('type') == 'contract' ? 'selected' : '' }}>Kontrak</option>
                    <option value="internship" {{ request('type') == 'internship' ? 'selected' : '' }}>Magang</option>
                </select>
            </div>

            <div class="col-md-2">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Kadaluarsa</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label for="per_page" class="form-label">Data per Halaman</label>
                    <select name="per_page" id="per_page" class="form-select">
                        <option value="5" {{ request('per_page', 10) == 5 ? 'selected' : '' }}>5 Data</option>
                        <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 Data</option>
                        <option value="20" {{ request('per_page', 10) == 20 ? 'selected' : '' }}>20 Data</option>
                        <option value="50" {{ request('per_page', 10) == 50 ? 'selected' : '' }}>50 Data</option>
                    </select>
                </div>

                <div class="col-md-12">
                    <div class="d-flex gap-2 justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter me-1"></i> Terapkan Filter
                        </button>
                        <a href="{{ route('admin.job_listings.index') }}" class="btn btn-secondary">
                            <i class="fas fa-refresh me-1"></i> Reset
    </a>
</div>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabel Lowongan --}}
    <div class="card">
        <div class="card-body p-0">
        <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th style="width: 5%">No</th>
                            <th style="width: 8%">Logo</th>
                            <th style="width: 20%">Posisi</th>
                            <th style="width: 15%">Perusahaan</th>
                            <th style="width: 12%">Lokasi</th>
                            <th style="width: 8%">Tipe</th>
                            <th style="width: 12%">Gaji</th>
                            <th style="width: 10%">Deadline</th>
                            <th style="width: 8%">Status</th>
                            <th style="width: 12%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jobs as $job)
                            <tr>
                                <td class="text-center fw-semibold">
                                    {{ $loop->iteration + ($jobs->currentPage() - 1) * $jobs->perPage() }}
                                </td>
                                <td class="text-center">
                                    @if($job->company_logo && Storage::disk('public')->exists($job->company_logo))
                                        <img src="{{ asset('storage/' . $job->company_logo) }}" 
                                             class="company-logo" 
                                             alt="{{ $job->company }}"
                                             onerror="this.style.display='none'">
                                    @else
                                        <div class="company-logo d-flex align-items-center justify-content-center bg-light text-muted">
                                            <i class="fas fa-building"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark">{{ Str::limit($job->title, 40) }}</div>
                                    <small class="text-muted">{{ $job->job_type ?? '-' }}</small>
                                </td>
                                <td>
                                    <div class="fw-medium">{{ Str::limit($job->company, 25) }}</div>
                                </td>
                                <td>
                                    @if($job->regency)
                                        <span class="text-dark">{{ $job->regency->name }}</span>
                                    @elseif($job->province)
                                        <span class="text-dark">{{ $job->province->name }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $typeColors = [
                                            'full-time' => 'primary',
                                            'part-time' => 'success', 
                                            'contract' => 'warning',
                                            'internship' => 'info'
                                        ];
                                        $color = $typeColors[$job->type] ?? 'secondary';
                                    @endphp
                                    <span class="badge bg-{{ $color }} text-capitalize">
                                        {{ str_replace('-', ' ', $job->type) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="fw-medium text-dark">{{ $job->salary_formatted }}</span>
                                </td>
                                <td>
                                    @if($job->deadline)
                                        @if($job->deadline->isPast())
                                            <span class="text-danger fw-semibold">
                                                {{ $job->deadline->format('d/m/Y') }}
                                            </span>
                                            <div class="text-danger small">Kadaluarsa</div>
                                        @elseif($job->deadline->diffInDays(now()) <= 7)
                                            <span class="text-warning fw-semibold">
                                                {{ $job->deadline->format('d/m/Y') }}
                                            </span>
                                            <div class="text-warning small">
                                                {{ $job->deadline->diffInDays(now()) }} hari lagi
                                            </div>
                                        @else
                                            <span class="text-success">
                                                {{ $job->deadline->format('d/m/Y') }}
                                            </span>
                                        @endif
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($job->is_public)
                                        @if($job->deadline && $job->deadline->isPast())
                                            <span class="badge bg-danger">Kadaluarsa</span>
                                        @else
                                        <span class="badge bg-success">Publish</span>
                                        @endif
                                    @else
                                        <span class="badge bg-secondary">Draft</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        {{-- Edit Button --}}
                                        <a href="{{ route('admin.job_listings.edit', $job->id) }}" 
                                           class="btn btn-warning btn-sm"
                                           title="Edit Lowongan"
                                           data-bs-toggle="tooltip">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        {{-- View Button --}}
                                        <a href="{{ route('admin.job_listings.show', $job->id) }}" 
                                           class="btn btn-info btn-sm"
                                           title="Lihat Detail"
                                           data-bs-toggle="tooltip">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        {{-- Delete Button --}}
                                        <button type="button" 
                                                class="btn btn-danger btn-sm"
                                                title="Hapus Lowongan"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteModal{{ $job->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    
                                    {{-- Delete Modal --}}
                                    <div class="modal fade" id="deleteModal{{ $job->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0 shadow-lg">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                                                    <p>Yakin ingin menghapus lowongan <strong>"{{ $job->title }}"</strong> di <strong>{{ $job->company }}</strong>?</p>
                                                    <p class="text-muted small">Data yang dihapus tidak dapat dikembalikan. Semua aplikasi yang terkait juga akan dihapus.</p>
                                                </div>
                                                <div class="modal-footer justify-content-center">
                                                    <button class="btn btn-secondary px-4" data-bs-dismiss="modal">Batal</button>
                                                    <form action="{{ route('admin.job_listings.destroy', $job->id) }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button class="btn btn-danger px-4">
                                                            <i class="fas fa-trash me-1"></i> Ya, Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="fas fa-briefcase fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">Tidak ada data lowongan</h5>
                                        <p class="text-muted mb-4">Silakan tambah lowongan baru atau sesuaikan filter pencarian</p>
                                        <a href="{{ route('admin.job_listings.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus me-1"></i> Tambah Lowongan Pertama
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
        
                    {{-- Footer dengan Pagination --}}
        @if($jobs->hasPages() || $jobs->total() > 0)
                    <tfoot class="table-light">
                    <tr>
                        <td colspan="10" class="p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                    <div class="text-muted">
                                    Menampilkan <strong>{{ $jobs->firstItem() ?? 0 }}</strong> - 
                                    <strong>{{ $jobs->lastItem() ?? 0 }}</strong> dari 
                                    <strong>{{ $jobs->total() }}</strong> data
                                        @if(request('search') || request('location') || request('type') || request('status'))
                                            <span class="ms-2">(Difilter)</span>
                                        @endif
                                </div>
                                
                                <div>
                                    {{ $jobs->appends(request()->query())->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </td>
                    </tr>
                </tfoot>
                    @endif
            </table>
        </div>
        </div>
    </div>
</div>

{{-- Script --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toast notification
        const toastEl = document.getElementById('liveToast');
        if (toastEl && typeof bootstrap !== 'undefined') {
            const toast = new bootstrap.Toast(toastEl, {
                delay: 4000,
                animation: true
            });
            toast.show();
        }
        
        // Tooltip initialization
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Auto submit form on filter change
        const filterSelects = document.querySelectorAll('#location, #type, #status, #per_page');
        filterSelects.forEach(select => {
            select.addEventListener('change', function() {
                this.closest('form').submit();
            });
        });
    });
</script>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection