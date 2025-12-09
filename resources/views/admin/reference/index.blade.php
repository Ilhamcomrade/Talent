@extends('admin.layout')

@section('title', 'Reference')
@section('content')

<style>
    @import url("https://fonts.googleapis.com/css?family=Roboto:400,500,300,700");

    :root {
        --header-bg: #000;
        --footer-bg: #000;
        --row-bg: #f7f7f7;
        --text-dark: #333;
        --white: #ffffff;
    }

    .table-container {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 0 12px rgba(0, 0, 0, .15);
        background: var(--white);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }

    .tbl-header {
        background: var(--header-bg);
    }

    .tbl-header th {
        color: white !important;
        padding: 12px 6px;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .5px;
        font-weight: 600;
        text-align: center;
    }

    .tbl-content td {
        padding: 10px 6px;
        font-size: 12px;
        vertical-align: middle;
        border-bottom: 1px solid #e5e5e5;
        color: #333 !important;
        background: transparent !important;
        line-height: 1.3;
    }

    tfoot {
        background: var(--footer-bg);
        color: white;
    }

    tfoot td {
        padding: 10px !important;
    }

    .pagination {
        margin: 0;
    }

    .pagination .page-item .page-link {
        border: 1px solid #ccc;
        color: #333;
        font-size: 12px;
        padding: 4px 8px;
    }

    .pagination .page-item.active .page-link {
        background: black !important;
        color: white;
        border-color: black;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 500;
    }

    .status-active {
        background-color: #d1fae5;
        color: #065f46;
    }

    .status-inactive {
        background-color: #f3f4f6;
        color: #6b7280;
    }

    .btn-sm {
        padding: 4px 6px;
        font-size: 11px;
    }

    .form-select {
        font-size: 12px;
        padding: 4px 8px;
    }

    /* Penyesuaian alignment dan spacing */
    .col-no { text-align: center; width: 4%; }
    .col-kode { text-align: center; width: 8%; }
    .col-nama { text-align: left; width: 20%; padding-left: 10px !important; }
    .col-provinsi { text-align: left; width: 16%; padding-left: 10px !important; }
    .col-pengisi { text-align: left; width: 16%; padding-left: 10px !important; }
    .col-deskripsi { text-align: left; width: 24%; padding-left: 10px !important; }
    .col-status { text-align: center; width: 8%; }
    .col-aksi { text-align: center; width: 8%; }

    /* Submenu Navigation */
    .submenu-nav {
        background: white;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .submenu-items {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .submenu-item {
        flex: 1;
        min-width: 120px;
    }

    .submenu-link {
        display: block;
        padding: 0.75rem 1rem;
        text-align: center;
        background: #f8f9fa;
        border: 2px solid #e9ecef;
        border-radius: 6px;
        color: #495057;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        font-size: 14px;
    }

    .submenu-link:hover {
        background: #e9ecef;
        border-color: #007bff;
        color: #007bff;
        transform: translateY(-2px);
    }

    .submenu-link.active {
        background: #007bff;
        border-color: #007bff;
        color: white;
        box-shadow: 0 4px 12px rgba(0,123,255,0.3);
    }

    .submenu-link i {
        margin-right: 0.5rem;
        font-size: 16px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .submenu-items {
            flex-direction: column;
        }
        
        .submenu-item {
            min-width: 100%;
        }
    }
</style>

<div class="container mt-4">

    {{-- Judul Halaman --}}
    <div class="row mb-3">
        <div class="col-12">
            <h2 class="fw-bold text-dark">Daftar Reference</h2>
            <p class="text-muted">Kelola data referensi wilayah administratif Indonesia</p>
        </div>
    </div>

    {{-- Submenu Navigation --}}
    <div class="submenu-nav">
        <div class="submenu-items">
            <div class="submenu-item">
                <a href="{{ route('admin.reference.provinsi.index') }}" 
                   class="submenu-link {{ request()->routeIs('admin.reference.provinsi.*') ? 'active' : '' }}">
                    <i class="fas fa-map-marker-alt"></i>
                    Provinsi
                </a>
            </div>
            <div class="submenu-item">
                <a href="{{ route('admin.reference.kabupaten.index') }}" 
                   class="submenu-link {{ request()->routeIs('admin.reference.kabupaten.*') ? 'active' : '' }}">
                    <i class="fas fa-city"></i>
                    Kab/Kota
                </a>
            </div>
            <div class="submenu-item">
                <a href="{{ route('admin.reference.kecamatan.index') }}" 
                   class="submenu-link {{ request()->routeIs('admin.reference.kecamatan.*') ? 'active' : '' }}">
                    <i class="fas fa-map"></i>
                    Kecamatan
                </a>
            </div>
            <div class="submenu-item">
                <a href="{{ route('admin.reference.desa.index') }}" 
                   class="submenu-link {{ request()->routeIs('admin.reference.desa.*') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
                    Desa/Kelurahan
                </a>
            </div>
        </div>
    </div>

    {{-- Konten berdasarkan submenu yang aktif --}}
    @if(request()->routeIs('admin.reference.provinsi.*'))
        {{-- Form Filter Provinsi --}}
        <form method="GET" action="{{ route('admin.reference.provinsi.index') }}" id="filterForm" class="mb-3">
            <div class="row g-2 align-items-end">
                {{-- Search --}}
                <div class="col-md-6">
                    <label class="form-label fw-bold text-dark" style="font-size: 12px;">Pencarian Provinsi</label>
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" style="font-size: 12px; padding: 6px;"
                            placeholder="Cari berdasarkan nama provinsi atau kode..."
                            value="{{ request('search') }}" />
                        <button class="btn btn-dark" style="padding: 6px 12px;"><i class="fas fa-search"></i></button>
                    </div>
                </div>

                {{-- Tambah Provinsi --}}
                <div class="col-md-2 ms-auto">
                    <label class="form-label invisible">x</label>
                    <a href="{{ route('admin.reference.provinsi.create') }}" class="btn btn-dark w-100" style="font-size: 12px; padding: 6px;">
                        <i class="fas fa-plus me-1"></i> Tambah Provinsi
                    </a>
                </div>
            </div>
        </form>

        {{-- Table Provinsi --}}
        <div class="table-container">
            {{-- Header --}}
            <div class="tbl-header">
                <table>
                    <thead>
                        <tr>
                            <th class="col-no">No</th>
                            <th class="col-kode">Kode</th>
                            <th class="col-nama">Nama Provinsi</th>
                            <th class="col-pengisi">Ibu Kota</th>
                            <th class="col-deskripsi">Deskripsi</th>
                            <th class="col-status">Status</th>
                            <th class="col-aksi">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>

            {{-- Body --}}
            <div class="tbl-content">
                <table>
                    <tbody>
                        {{-- Data Dummy Provinsi --}}
                        <tr>
                            <td class="col-no">1</td>
                            <td class="col-kode">31</td>
                            <td class="col-nama">DKI Jakarta</td>
                            <td class="col-pengisi">Jakarta Pusat</td>
                            <td class="col-deskripsi">Daerah Khusus Ibukota Jakarta</td>
                            <td class="col-status">
                                <span class="status-badge status-active">
                                    <i class="fas fa-check-circle"></i>
                                    Aktif
                                </span>
                            </td>
                            <td class="col-aksi">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('admin.reference.provinsi.edit', 1) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="col-no">2</td>
                            <td class="col-kode">32</td>
                            <td class="col-nama">Jawa Barat</td>
                            <td class="col-pengisi">Bandung</td>
                            <td class="col-deskripsi">Provinsi Jawa Barat</td>
                            <td class="col-status">
                                <span class="status-badge status-active">
                                    <i class="fas fa-check-circle"></i>
                                    Aktif
                                </span>
                            </td>
                            <td class="col-aksi">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('admin.reference.provinsi.edit', 2) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="col-no">3</td>
                            <td class="col-kode">33</td>
                            <td class="col-nama">Jawa Tengah</td>
                            <td class="col-pengisi">Semarang</td>
                            <td class="col-deskripsi">Provinsi Jawa Tengah</td>
                            <td class="col-status">
                                <span class="status-badge status-active">
                                    <i class="fas fa-check-circle"></i>
                                    Aktif
                                </span>
                            </td>
                            <td class="col-aksi">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('admin.reference.provinsi.edit', 3) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Footer --}}
            <table>
                <tfoot>
                    <tr>
                        <td colspan="7">
                            <div class="d-flex justify-content-between align-items-center">
                                {{-- Per Page --}}
                                <div style="width:120px;">
                                    <select name="per_page" id="per_page" class="form-select" onchange="document.getElementById('filterForm').submit()">
                                        <option value="5" selected>5 Data</option>
                                        <option value="10">10 Data</option>
                                        <option value="15">15 Data</option>
                                    </select>
                                </div>

                                {{-- Pagination --}}
                                <div>
                                    <nav>
                                        <ul class="pagination mb-0">
                                            <li class="page-item disabled"><span class="page-link">Prev</span></li>
                                            <li class="page-item active"><span class="page-link">1</span></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

    @elseif(request()->routeIs('admin.reference.kabupaten.*'))
        {{-- Konten untuk Kabupaten/Kota --}}
        <form method="GET" action="{{ route('admin.reference.kabupaten.index') }}" id="filterForm" class="mb-3">
            <div class="row g-2 align-items-end">
                {{-- Search --}}
                <div class="col-md-6">
                    <label class="form-label fw-bold text-dark" style="font-size: 12px;">Pencarian Kabupaten/Kota</label>
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" style="font-size: 12px; padding: 6px;"
                            placeholder="Cari berdasarkan nama kabupaten/kota..."
                            value="{{ request('search') }}" />
                        <button class="btn btn-dark" style="padding: 6px 12px;"><i class="fas fa-search"></i></button>
                    </div>
                </div>

                {{-- Tambah Kabupaten --}}
                <div class="col-md-2 ms-auto">
                    <label class="form-label invisible">x</label>
                    <a href="{{ route('admin.reference.kabupaten.create') }}" class="btn btn-dark w-100" style="font-size: 12px; padding: 6px;">
                        <i class="fas fa-plus me-1"></i> Tambah Kabupaten
                    </a>
                </div>
            </div>
        </form>

        {{-- Table Kabupaten/Kota --}}
        <div class="table-container">
            {{-- Header --}}
            <div class="tbl-header">
                <table>
                    <thead>
                        <tr>
                            <th class="col-no">No</th>
                            <th class="col-kode">Kode</th>
                            <th class="col-nama">Nama Kabupaten/Kota</th>
                            <th class="col-provinsi">Provinsi</th>
                            <th class="col-deskripsi">Deskripsi</th>
                            <th class="col-status">Status</th>
                            <th class="col-aksi">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>

            {{-- Body --}}
            <div class="tbl-content">
                <table>
                    <tbody>
                        {{-- Data Dummy Kabupaten/Kota --}}
                        <tr>
                            <td class="col-no">1</td>
                            <td class="col-kode">3171</td>
                            <td class="col-nama">Jakarta Selatan</td>
                            <td class="col-provinsi">DKI Jakarta</td>
                            <td class="col-deskripsi">Kota Administrasi Jakarta Selatan</td>
                            <td class="col-status">
                                <span class="status-badge status-active">
                                    <i class="fas fa-check-circle"></i>
                                    Aktif
                                </span>
                            </td>
                            <td class="col-aksi">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('admin.reference.kabupaten.edit', 1) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Footer (sama seperti provinsi) --}}
            <table>
                <tfoot>
                    <tr>
                        <td colspan="7">
                            <div class="d-flex justify-content-between align-items-center">
                                {{-- Per Page --}}
                                <div style="width:120px;">
                                    <select name="per_page" id="per_page" class="form-select" onchange="document.getElementById('filterForm').submit()">
                                        <option value="5" selected>5 Data</option>
                                        <option value="10">10 Data</option>
                                        <option value="15">15 Data</option>
                                        <option value="20">20 Data</option>
                                        <option value="50">50 Data</option>
                                        <option value="100">100 Data</option>
                                    </select>
                                </div>

                                {{-- Pagination --}}
                                <div>
                                    <nav>
                                        <ul class="pagination mb-0">
                                            <li class="page-item disabled"><span class="page-link">Prev</span></li>
                                            <li class="page-item active"><span class="page-link">1</span></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

    @else
        {{-- Default content ketika belum memilih submenu --}}
        <div class="text-center py-5">
            <div class="mb-4">
                <i class="fas fa-map-marked-alt fa-4x text-muted"></i>
            </div>
            <h4 class="text-muted">Pilih Jenis Referensi</h4>
            <p class="text-muted">Silakan pilih salah satu jenis referensi wilayah dari menu di atas untuk mulai mengelola data.</p>
        </div>
    @endif

</div>

@endsection