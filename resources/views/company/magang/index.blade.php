<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Lowongan Magang</title>

    {{-- Bootstrap --}}
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
            color: #fff;
            transition: 0.5s;
            background-size: 200% auto;
            border: none;
        }

        .btn-grad-hijau:hover {
            background-position: right center;
            color: #fff;
            text-decoration: none;
        }
        
        .btn-group-sm .btn {
            padding: 0.25rem 0.5rem;
        }
    </style>
</head>

<body class="bg-light">

    {{-- NAVBAR --}}
    @include('partials.navbar_company')

    <div class="container py-4">

        {{-- Alert --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-0">Daftar Lowongan Magang</h3>
                <small class="text-muted">Total: {{ $magang->total() }} lowongan magang</small>
            </div>
            
            <a href="{{ route('company.magang.create') }}" class="btn btn-sm shadow-sm btn-grad-hijau text-white">
                <i class="bi bi-plus-circle me-1"></i> Tambah Magang
            </a>
        </div>

        {{-- Search --}}
        <form method="GET" class="mb-3">
            <div class="input-group">
                <input type="text"
                       name="search"
                       class="form-control"
                       placeholder="Cari judul, lokasi, atau departemen..."
                       value="{{ $search }}">
                <button class="btn btn-secondary" type="submit">
                    <i class="bi bi-search"></i> Cari
                </button>
            </div>
        </form>

        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th width="50" class="text-center">No</th>
                            <th>Posisi Magang</th>
                            <th class="text-center">Departemen</th>
                            <th class="text-center">Lokasi</th>
                            <th class="text-center">Tipe</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Deadline</th>
                            <th class="text-center">Total Pelamar</th>
                            <th width="160" class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($magang as $item)
                        <tr>
                            {{-- No --}}
                            <td class="text-center">
                                {{ ($magang->currentPage() - 1) * $magang->perPage() + $loop->iteration }}
                            </td>

                            {{-- Judul & Deskripsi --}}
                            <td>
                                <strong class="text-dark">{{ $item->title }}</strong>
                                <br>
                                <small class="text-muted">{{ Str::limit($item->deskripsi, 50) }}</small>
                            </td>

                            {{-- Departemen --}}
                            <td class="text-center text-dark">
                                {{ $item->department ?? '-' }}
                            </td>

                            {{-- Lokasi --}}
                            <td class="text-center text-dark">
                                {{ $item->lokasi }}
                            </td>

                            {{-- Tipe --}}
                            <td class="text-center">
                                <span class="badge bg-info text-dark">
                                    {{ ucfirst($item->type) }}
                                </span>
                            </td>

                            {{-- Status --}}
                            <td class="text-center">
                                @if($item->status == 'aktif')
                                    <span class="badge bg-success text-white">
                                        <i class="bi bi-check-circle"></i> Aktif
                                    </span>
                                @elseif($item->status == 'nonaktif')
                                    <span class="badge bg-secondary text-white">
                                        <i class="bi bi-pause-circle"></i> Nonaktif
                                    </span>
                                @else
                                    <span class="badge bg-danger text-white">
                                        <i class="bi bi-x-circle"></i> Expired
                                    </span>
                                @endif
                            </td>

                            {{-- Deadline --}}
                            <td class="text-center text-dark">
                                {{ $item->deadline ? date('d M Y', strtotime($item->deadline)) : '-' }}
                            </td>

                            {{-- Total Pelamar --}}
                            <td class="text-center">
                                @php
                                    // Anda bisa menyesuaikan query ini sesuai dengan struktur database Anda
                                    // Ini adalah contoh, sesuaikan dengan model dan relasi yang ada
                                    $totalPelamar = 0; // Ganti dengan query yang sesuai
                                @endphp
                                <a href="#" class="text-dark">
                                    {{ $totalPelamar }}
                                </a>
                            </td>

                            {{-- Aksi --}}
                            <td class="text-center">
                                <div class="btn-group btn-group-sm gap-1">
                                    <a href="{{ route('company.magang.show', $item->id) }}"
                                       class="btn btn-outline-info border" 
                                       title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a href="{{ route('company.magang.edit', $item->id) }}"
                                       class="btn btn-outline-warning border"
                                       title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form action="{{ route('company.magang.destroy', $item->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus lowongan magang ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger border" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    Tidak ada lowongan magang ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination & Info --}}
        <div class="mt-3 d-flex justify-content-between align-items-center">
            <span class="text-muted">
                @if($magang->total() > 0)
                    Menampilkan {{ $magang->firstItem() }} - {{ $magang->lastItem() }}
                    dari {{ $magang->total() }} data
                @else
                    Tidak ada data
                @endif
            </span>

            {{ $magang->links() }}
        </div>

    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>