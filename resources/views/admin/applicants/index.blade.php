@extends('admin.layout')

@section('title', 'jangan males yaa')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Daftar Aplikasi Pelamar</h1>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Form Pencarian dan Filter --}}
    <form method="GET" action="{{ route('admin.applicants.index') }}" class="row g-3 mb-4 align-items-end bg-white p-3 rounded shadow-sm">
        
        {{-- Input Pencarian --}}
        <div class="col-md-4 col-lg-4">
            <label for="search" class="form-label small text-muted">Cari Pelamar / Posisi</label>
            <input type="text" name="search" id="search" class="form-control" 
                   placeholder="Nama Pelamar atau Judul Lowongan..." 
                   value="{{ request('search') }}">
        </div>
        
        {{-- Dropdown Filter Status --}}
        <div class="col-md-3 col-lg-3">
            <label for="status" class="form-label small text-muted">Filter Status</label>
            <select name="status" id="status" class="form-select">
                @foreach($statuses as $key => $label)
                    <option value="{{ $key }}" {{ request('status', 'all') == $key ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Dropdown Jumlah Data Tampil --}}
        <div class="col-md-2 col-lg-2">
            <label for="per_page" class="form-label small text-muted">Data per Halaman</label>
            <select name="per_page" id="per_page" class="form-select">
                @foreach([5, 10, 20, 50] as $num)
                    <option value="{{ $num }}" {{ $perPage == $num ? 'selected' : '' }}>{{ $num }}</option>
                @endforeach
            </select>
        </div>
        
        {{-- Tombol Submit/Cari --}}
        <div class="col-md-3 col-lg-3">
            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-filter me-1"></i> Terapkan Filter
            </button>
        </div>
    </form>
    
    {{-- Tabel Daftar Pelamar --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle shadow-sm bg-white">
            <thead class="table-light">
                <tr>
                    <th style="width: 50px;">ID</th>
                    <th style="width: 25%;">Pelamar</th>
                    <th style="width: 30%;">Lowongan</th>
                    <th style="width: 15%;">Status</th>
                    <th>Tanggal Aplikasi</th>
                    <th style="width: 150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($applications as $application)
                    <tr>
                        <td class="text-center small">{{ $application->id }}</td>
                        <td>
                            <strong>{{ $application->user->name }}</strong><br>
                            <small class="text-muted">{{ $application->user->email }}</small>
                        </td>
                        <td>{{ $application->jobListing->title ?? 'Lowongan Tidak Ditemukan' }}</td>
                        <td>
                            <span class="badge {{ $application->status_badge_class ?? 'bg-secondary' }}">
                                {{ $statuses[$application->status] ?? ucfirst($application->status) }}
                            </span>
                        </td>
                        <td>{{ $application->applied_at->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('admin.applicants.show', $application->id) }}" 
                               class="btn btn-sm btn-info me-1" title="Lihat Detail">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                            
                            {{-- Tombol Hapus (Contoh Modal) --}}
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $application->id }}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>

                    {{-- Modal Konfirmasi Hapus --}}
                    <div class="modal fade" id="deleteModal{{ $application->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    Yakin ingin menghapus lamaran **{{ $application->user->name }}** untuk posisi **{{ $application->jobListing->title ?? 'N/A' }}**?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <form action="{{ route('admin.applicants.destroy', $application->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger">Ya, Hapus Permanen</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted p-4">
                            <i class="fas fa-exclamation-circle me-2"></i> Tidak ada lamaran yang ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    {{-- Pagination --}}
    @if ($applications->total() > 0)
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="text-muted small">
                Menampilkan **{{ $applications->firstItem() }} - {{ $applications->lastItem() }}** dari total **{{ $applications->total() }}** data.
            </div>
            <div>
                {{ $applications->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endif

</div>

{{-- Helper Class untuk Badge Status (Opsional, Anda bisa menambahkannya di CSS Anda) --}}
<style>
    /* Contoh helper class untuk badge */
    .bg-pending { background-color: #ffc107; color: #000; }
    .bg-reviewed { background-color: #17a2b8; }
    .bg-interview { background-color: #6f42c1; }
    .bg-rejected { background-color: #dc3545; }
    .bg-hired { background-color: #28a745; }
    /* Pastikan Anda menambahkan helper class di model Application atau di tempat lain jika perlu */
</style>
@endsection

