<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Lowongan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .badge-click {
            cursor: pointer;
            transition: .2s;
        }
        .badge-click:hover {
            transform: scale(1.1);
        }
        table th, table td {
            vertical-align: middle !important;
        }
        
        /* PERBAIKAN STYLE TABEL */
        .table thead th {
            font-weight: bold !important;
            background-color: #7deca2 !important;
        }
        
        .table tbody td {
            background-color: transparent !important;
            color: #000 !important;
        }
        
        .table {
            background-color: #fff !important;
        }
        
        .table-hover tbody tr:hover {
            background-color: #f8f9fa !important;
        }
        
        .card {
            background-color: #fff !important;
            border: 1px solid #dee2e6;
        }
       .btn-grad-hijau {
    background-image: linear-gradient(to right, #4CAF50 0%, #8BC34A 51%, #4c77af 100%);
    /* NILAI INI DIPERBAIKI MENJADI PUTIH MURNI (#fff) */
    color: #fff; 
    transition: 0.5s;
    background-size: 200% auto;
    border: none;
}

.btn-grad-hijau:hover {
    background-position: right center;
    /* Nilai ini sudah benar */
    color: #fff;
    text-decoration: none;
}
    </style>
</head>

<body class="bg-light">

@include('partials.navbar_company')

<div class="container py-4">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-0">Daftar Lowongan</h3>
        <small class="text-muted">Total: {{ $jobs->total() }} lowongan</small>
    </div>
    
  <a href="{{ route('companiesjobs.create') }}" class="btn btn-sm shadow-sm btn-grad-hijau text-white">
    <i class="bi bi-plus-circle me-1"></i> Tambah Lowongan
</a>
</div>

    <form method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" value="{{ $search }}"
                class="form-control" placeholder="Cari judul, kategori, atau kebijakan kerja...">
            <button class="btn btn-secondary"><i class="bi bi-search"></i> Cari</button>
        </div>
    </form>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th width="50" class="text-center">No</th>
                        <th>Posisi Pekerjaan</th>
                        <th class="text-center">Kebijakan Kerja</th>
                        <th class="text-center">Kategori</th>
                        <th class="text-center">Sub Kategori</th>
                        <th class="text-center">Gaji</th>
                        <th class="text-center">Tgl Expired</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Total Pelamar</th>
                        <th class="text-center">Diterima</th>
                        <th width="160" class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($jobs as $job)
                    <tr>
                        <td class="text-center">
                            {{ ($jobs->currentPage() - 1) * $jobs->perPage() + $loop->iteration }}
                        </td>

                        <!-- JUDUL -->
                        <td>
                            <span class="text-dark">{{ $job->title }}</span>
                            <br>
                            {{-- <small class="text-muted">{{ $job->industry ?? '-' }}</small> --}}
                        </td>

                        <!-- KEBIJAKAN KERJA -->
                        <td class="text-center">
                            <span class="text-dark">
                                {{ $job->employment_type }}
                            </span><br>
                            <span class="text-dark">
                                {{ $job->work_mode }}
                            </span>
                        </td>

                        <!-- KATEGORI -->
                        <td class="text-center text-dark">
                            {{ optional($job->category)->name ?? '-' }}
                        </td>

                        <!-- SUB -->
                        <td class="text-center text-dark">
                            {{ optional($job->subcategory)->name ?? '-' }}
                        </td>

                        <!-- GAJI -->
                        <td class="text-center">
                            @if($job->show_salary && $job->salary_min)
                                <span class="text-dark">
                                    Rp {{ number_format($job->salary_min) }} -
                                    Rp {{ number_format($job->salary_max) }}
                                </span>
                            @else
                                <span class="text-muted">Disembunyikan</span>
                            @endif
                        </td>

                        <!-- EXPIRED -->
                        <td class="text-center text-dark">
                            @if($job->expired_at)
                                {{ \Carbon\Carbon::parse($job->expired_at)->format('d M Y') }}
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>

                        <!-- PUBLIC -->
                        <td class="text-center">
                            @if($job->is_public)
                                <span class="badge bg-success text-white"><i class="bi bi-eye"></i> Publish</span>
                            @else
                                <span class="badge bg-secondary text-white"><i class="bi bi-eye-slash"></i> Draft</span>
                            @endif
                        </td>

                        <!-- TOTAL PELAMAR -->
                        <td class="text-center">
    
    <a href="{{ route('companiesjobs.applicants', $job->id) }}" class="text-dark">
        {{ $job->pelamar }}
    </a>
</td>

                        <!-- DITERIMA -->
                        <td class="text-center">
                            @php
                                $accepted = \App\Models\CompaniesApplication::where('companies_job_id', $job->id)
                                    ->where('status', 'diterima')->count();
                            @endphp
                            {{ $accepted }}
                        </td>

                        <!-- AKSI -->
                        <td class="text-center">
                            <div class="btn-group btn-group-sm gap-1">
                                <a href="{{ route('companiesjobs.edit', $job->id) }}"
                                   class="btn btn-outline-warning border "><i class="bi bi-pencil"></i></a>

                                <form action="{{ route('companiesjobs.destroy', $job->id) }}"
                                      method="POST" onsubmit="return confirm('Hapus lowongan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger border"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="11" class="text-center py-4 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                            Tidak ada lowongan ditemukan.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3 d-flex justify-content-between">
        <span class="text-muted">
            Menampilkan {{ $jobs->firstItem() }} - {{ $jobs->lastItem() }}
            dari {{ $jobs->total() }} data
        </span>

        {{ $jobs->links() }}
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>