@extends('admin.layout')

@section('title', 'Manajemen Kecamatan')
@section('content')

{{-- =================================================================== --}}
{{-- CUSTOM STYLES SEDERHANA --}}
{{-- =================================================================== --}}
<style>
    @import url(https://fonts.googleapis.com/css?family=Roboto:400,500,300,700);
    
    /* VARIABEL WARNA */
    :root {
        --dark-bg: #2c2e35;
        --dark-input: #3b3d45;
        --header-color: #1e3a8a;
        --footer-color: #1e3a8a;
        --table-bg: #ffffff;
        --table-text: #212529;
        --table-border: #dee2e6;
        --table-hover: #f8f9fa;
        --text-primary: #000000;
        --border-color: #dee2e6;
    }

    /* Dark mode support */
    body.dark-mode {
        --text-primary: #ffffff;
        --border-color: #495057;
    }

    /* Force dark mode for admin panel */
    body {
        --text-primary: #000000;
        --border-color: #dee2e6;
    }

    body.dark-mode {
        --text-primary: #ffffff;
        --border-color: #6c757d;
    }

    /* JUDUL UTAMA */
    .main-title {
        color: var(--text-primary) !important;
        font-weight: 700 !important;
        font-size: 1.8rem !important;
        margin-bottom: 5px !important;
        text-align: left !important;
        line-height: 1.2;
        padding-top: 8px;
    }

    /* SUB JUDUL DAFTAR KECAMATAN */
    .page-title {
        color: var(--text-primary) !important;
        font-weight: 500 !important;
        font-size: 1.1rem !important;
        margin-bottom: 0 !important;
        text-align: left !important;
        opacity: 0.9;
        line-height: 1.3;
        padding-bottom: 5px;
    }

    /* HEADER SECTION - SEJAJAR DENGAN ICON */
    .header-section {
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--border-color);
        display: flex;
        align-items: flex-start;
        gap: 15px;
        padding-top: 5px;
    }

    /* ICON SIDE */
    .header-icon {
        font-size: 1.5rem !important;
        color: var(--header-color) !important;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background: rgba(30, 58, 138, 0.1);
        border-radius: 8px;
        margin-top: 8px;
    }

    /* TEXT SIDE */
    .header-text {
        flex: 1;
        padding-top: 5px;
    }

    /* STYLE TABEL - NO GAP */
    table{
        width:100%;
        table-layout: fixed;
        border-collapse: collapse; 
        color: var(--table-text) !important; 
    }

    .table-responsive, .shadow-sm, .table, .table-hover, .table-light, thead {
        background-color: transparent !important;
        border: none !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    
    /* HEADER - NEMPEL LANGSUNG KE BODY */
    .tbl-header{
        background-color: var(--header-color) !important; 
        border: 1px solid var(--header-color); 
        border-bottom: none;
        border-radius: 5px 5px 0 0; 
        margin-bottom: 0 !important;
    }
    
    /* CONTENT BODY - NEMPEL LANGSUNG KE HEADER */
    .tbl-content{
        height:280px;
        overflow-x: hidden; 
        overflow-y: auto;
        margin-top: 0 !important;
        background-color: var(--table-bg) !important;
        border: 1px solid var(--table-border);
        border-top: none !important;
        border-radius: 0 0 5px 5px; 
    }

    /* TABLE HEADER */
    th{
        padding: 12px 8px !important;
        text-align: left !important;
        font-weight: 600 !important;
        font-size: 11px !important; 
        color: #fff !important;
        text-transform: uppercase !important;
        vertical-align: middle;
        border-bottom: none !important; 
        background-color: transparent !important;
    }

    /* TABLE DATA */
    td{
        padding: 10px 8px !important;
        text-align: left !important;
        vertical-align:middle !important;
        font-weight: 300 !important;
        font-size: 10px !important;
        color: var(--table-text) !important;
        border-bottom: solid 1px var(--table-border) !important;
        border-top: none !important; 
        background-color: transparent !important; 
    }
    
    /* KOLOM NO YANG LEBIH KECIL DAN RAPI */
    .col-no {
        width: 4% !important;
        text-align: center !important;
        padding: 10px 4px !important;
    }
    
    /* KOLOM KODE */
    .col-kode {
        width: 8% !important;
    }
    
    /* KOLOM NAMA */
    .col-nama {
        width: 14% !important;
    }
    
    /* KOLOM KABUPATEN */
    .col-kabupaten {
        width: 16% !important;
    }
    
    /* KOLOM PROVINSI */
    .col-provinsi {
        width: 16% !important;
    }
    
    /* KOLOM STATUS */
    .col-status {
        width: 12% !important;
    }
    
    /* KOLOM TINDAKAN */
    .col-actions {
        width: 12% !important;
        text-align: center !important;
    }
    
    /* ACTION BUTTONS - SMALLER */
    .btn-action {
        padding: 3px 6px !important;
        font-size: 10px !important;
        min-width: 26px !important;
        height: 26px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }

    .btn-action i {
        font-size: 10px !important;
    }

    /* ROW HOVER EFFECT */
    .table-hover tbody tr:hover {
        background-color: var(--table-hover) !important;
    }

    /* BADGE STYLE - COMPACT */
    .col-status .badge {
        font-size: 9px !important;
        padding: 3px 6px !important;
        font-weight: 500;
    }
    
    /* FOOTER - NEMPEL LANGSUNG KE BODY */
    .table tfoot {
        border-top: none !important;
        background-color: var(--footer-color) !important;
        border-radius: 0 0 5px 5px; 
        color: white !important;
        margin-top: 0 !important;
    }
    .table tfoot td {
        background-color: transparent !important; 
        color: #fff !important;
        border: none !important;
        padding: 10px 12px !important;
    }
    .table tfoot .text-muted {
        color: rgba(255, 255, 255, 0.8) !important;
    }
    .table tfoot strong {
        color: #fff !important;
    }

    /* FORM CONTROLS - PUTIH */
    .form-control, .form-select {
        background-color: #ffffff !important; 
        border: 1px solid #ced4da !important;
        color: #212529 !important;
        font-size: 11px !important;
        padding: 6px 10px !important;
    }

    /* TOMBOL PENCARIAN - BIRU */
    .btn-search {
        background-color: var(--header-color) !important; 
        border-color: var(--header-color) !important;
        color: white !important;
        padding: 6px 12px !important;
        font-size: 11px !important;
    }
    .btn-search:hover {
        background-color: #1e3a8a !important;
        border-color: #1e3a8a !important;
    }

    /* TOMBOL TAMBAH - BIRU */
    .btn-tambah {
        background-color: var(--header-color) !important; 
        border-color: var(--header-color) !important;
        color: white !important;
        padding: 6px 12px !important;
        font-size: 11px !important;
    }
    .btn-tambah:hover {
        background-color: #1e3a8a !important;
        border-color: #1e3a8a !important;
    }

    /* CONTAINER TABEL - NO GAP */
    .table-container {
        border-radius: 5px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        margin: 0 !important;
        padding: 0 !important;
    }

    /* FOOTER CONTROLS */
    .footer-controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        width: 100%;
        padding: 0;
    }
    
    .footer-info {
        font-size: 11px;
        padding: 0;
    }
    
    .pagination-filter-footer {
        width: 90px;
    }
    
    .pagination-filter-footer .form-select {
        font-size: 10px !important;
        padding: 4px 6px !important;
        min-height: auto;
    }
    
    .table-pagination .pagination {
        margin: 0 !important;
        justify-content: flex-end;
        gap: 2px;
        flex-wrap: wrap;
    }

    /* CUSTOM PAGINATION STYLING */
    .pagination-custom {
        display: flex !important;
        gap: 3px !important;
        list-style: none;
    }

    .pagination-custom .page-item {
        display: inline-block;
    }

    .pagination-custom .page-link {
        font-size: 11px !important;
        padding: 5px 8px !important;
        min-width: 28px;
        height: 28px;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #ffffff;
        border: 1px solid #dee2e6;
        color: #0d6efd;
        text-decoration: none;
        border-radius: 4px;
        transition: all 0.2s ease;
    }

    .pagination-custom .page-item.active .page-link {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        color: white !important;
        font-weight: 600;
    }

    .pagination-custom .page-item.disabled .page-link {
        background-color: #f8f9fa;
        border-color: #dee2e6;
        color: #6c757d;
        cursor: not-allowed;
    }

    .pagination-custom .page-link:hover:not(.disabled) {
        background-color: #e9ecef;
        border-color: #dee2e6;
        color: #0a58ca;
    }

    .pagination-custom .page-link i {
        font-size: 10px;
    }
    
    .table-pagination .page-link {
        font-size: 10px !important;
        padding: 4px 8px !important;
        min-width: 28px;
        height: 26px;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #ffffff;
        border: 1px solid #dee2e6;
        color: #0d6efd;
        text-decoration: none;
        border-radius: 4px;
    }
    
    .table-pagination .page-item.active .page-link {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        color: white !important;
    }
    
    .table-pagination .page-item.disabled .page-link {
        background-color: #f8f9fa;
        border-color: #dee2e6;
        color: #6c757d;
        cursor: not-allowed;
    }
    
    .table-pagination .page-link:hover {
        background-color: #e9ecef;
        border-color: #dee2e6;
        color: #0a58ca;
    }
    
    /* STYLE KHUSUS UNTUK PAGINATION DENGAN ICON */
    .pagination-icon-only .page-link span {
        display: none;
    }
    
    /* FIX SIDEBAR BACKGROUND */
    .sidebar {
        background-color: #2c2e35 !important;
    }
    
    .sidebar .nav-link {
        color: #ffffff !important;
    }
    
    .sidebar .nav-link.active {
        background-color: #0d6efd !important;
    }
    
    /* PAGINATION COMPACT */
    .pagination-compact .page-item {
        margin: 0 1px;
    }
    
    .pagination-compact .page-link {
        min-width: 24px;
        height: 24px;
        padding: 2px 6px !important;
        font-size: 9px !important;
    }

    /* CUSTOM BUTTON COLORS */
    .btn-warning {
        background-color: #fbbf24 !important;
        border-color: #fbbf24 !important;
        color: #000 !important;
    }
    .btn-warning:hover {
        background-color: #f59e0b !important;
        border-color: #f59e0b !important;
    }

    .btn-danger {
        background-color: #ef4444 !important;
        border-color: #ef4444 !important;
        color: #fff !important;
    }
    .btn-danger:hover {
        background-color: #dc2626 !important;
        border-color: #dc2626 !important;
    }

    .btn-info {
        background-color: #06b6d4 !important;
        border-color: #06b6d4 !important;
        color: #fff !important;
    }
    .btn-info:hover {
        background-color: #0891b2 !important;
        border-color: #0891b2 !important;
    }

    /* TOAST NOTIFICATION POSITION - DIPERBAIKI */
    .toast-container-custom {
        position: fixed;
        top: 0px;
        right: 20px;
        z-index: 9999;
        min-width: 350px;
    }
    
    .toast-success-custom {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%) !important;
        border: none !important;
        border-radius: 8px !important;
        box-shadow: 0 8px 24px rgba(40, 167, 69, 0.3) !important;
        padding: 16px !important;
        min-height: 80px;
        display: flex;
        align-items: center;
        animation: slideDown 0.4s ease-out;
    }
    
    .toast-success-custom .toast-body {
        padding: 0 !important;
    }
    
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* MODAL STYLES - ENSURE MODAL APPEARS ON TOP */
    .modal {
        z-index: 10000 !important;
    }
    
    .modal-backdrop {
        z-index: 9999 !important;
        opacity: 0.5 !important;
    }
    
    .modal.show {
        display: flex !important;
    }

    /* GARIS PEMISAH */
    .divider {
        border: none;
        border-top: 1px solid var(--border-color);
        margin: 20px 0;
    }
</style>

<div class="container-fluid py-4 px-4">
    {{-- HEADER SECTION --}}
    <div class="header-section">
        <div class="header-icon">
            <i class="fas fa-map-marker-alt"></i>
        </div>
        <div class="header-text">
            <h1 class="main-title">Manajemen Kecamatan</h1>
        </div>
    </div>
    
    {{-- TOAST NOTIFICATION --}}
    @if(session('success'))
    <div class="toast-container-custom">
        <div id="successToast" class="toast toast-success-custom" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="4000">
            <div class="toast-body text-white">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle me-3" style="font-size: 24px;"></i>
                        <div>
                            <strong class="d-block mb-1">Berhasil!</strong>
                            <small>{{ session('success') }}</small>
                        </div>
                    </div>
                    <div class="ms-3" id="toastTimer" style="font-size: 12px; min-width: 20px; text-align: right;">4s</div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- FORM KONTROL --}}
    <form method="GET" action="{{ route('admin.reference.kecamatan.index') }}" class="mb-4" id="filterForm">
        <div class="row g-3 align-items-end">
            {{-- KOLOM PENCARIAN --}}
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" name="search" id="search" class="form-control"
                           placeholder="Cari nama kecamatan atau kode..."
                           value="{{ request('search') }}">
                    <button type="submit" class="btn btn-search">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            
            {{-- FILTER KABUPATEN --}}
            <div class="col-md-3">
                <select name="kabupaten_id" id="kabupaten_id" class="form-select" onchange="document.getElementById('filterForm').submit();">
                    <option value="">-- Semua Kabupaten --</option>
                    @foreach($kabupatens as $kabupaten)
                        <option value="{{ $kabupaten->id }}" {{ request('kabupaten_id') == $kabupaten->id ? 'selected' : '' }}>
                            {{ $kabupaten->nama_kabupaten }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            {{-- TOMBOL TAMBAH --}}
            <div class="col-md-3">
                <a href="{{ route('admin.reference.kecamatan.create') }}" class="btn btn-primary w-100 btn-tambah">
                    <i class="fas fa-plus me-1"></i>Tambah Kecamatan
                </a>
            </div>
        </div>

        {{-- INPUT HIDDEN --}}
        <input type="hidden" name="per_page" id="per_page" value="{{ request('per_page', 10) }}">
    </form>

    {{-- GARIS PEMISAH --}}
    <hr class="divider">

    {{-- TABEL CONTAINER - NO GAP --}}
    <div class="table-container">
        <div class="table-responsive">
            
            {{-- HEADER - NEMPEL LANGSUNG --}}
            <div class="tbl-header">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="col-no">NO</th>
                            <th class="col-kode">KODE</th>
                            <th class="col-nama">NAMA KECAMATAN</th>
                            <th class="col-kabupaten">NAMA KABUPATEN</th>
                            <th class="col-provinsi">NAMA PROVINSI</th>
                            <th class="col-status">STATUS</th>
                            <th class="col-actions">TINDAKAN</th> 
                        </tr>
                    </thead>
                </table>
            </div>

            {{-- CONTENT BODY - NEMPEL LANGSUNG KE HEADER --}}
            <div class="tbl-content">
                <table class="table table-hover"> 
                    <tbody>
                        @forelse($kecamatans as $index => $kecamatan)
                            <tr class="align-middle"> 
                                <td class="col-no">{{ $kecamatans->firstItem() + $index }}</td>
                                <td class="col-kode">{{ $kecamatan->kode_kecamatan }}</td>
                                <td class="col-nama">{{ ucfirst(strtolower($kecamatan->nama_kecamatan)) }}</td>
                                <td class="col-kabupaten">{{ ucfirst(strtolower($kecamatan->kabupaten->nama_kabupaten ?? '-')) }}</td>
                                <td class="col-provinsi">{{ ucfirst(strtolower($kecamatan->kabupaten->provinsi->nama_provinsi ?? '-')) }}</td>
                                <td class="col-status">
                                    @if($kecamatan->status)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="col-actions">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('admin.reference.kecamatan.edit', $kecamatan->id) }}" title="Edit"
                                           class="btn btn-warning btn-sm btn-action">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm btn-action btn-delete"
                                                data-delete-url="{{ route('admin.reference.kecamatan.destroy', $kecamatan->id) }}"
                                                data-item-name="{{ $kecamatan->nama_kecamatan }}"
                                                data-item-id="{{ $kecamatan->id }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteModal"
                                                title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-3" style="font-size: 11px !important;">Tidak ada data kecamatan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        {{-- FOOTER - NEMPEL LANGSUNG KE BODY --}}
        @if(count($kecamatans) > 0)
        <div class="table-responsive">
            <table class="table" style="table-layout: fixed;"> 
                <tfoot>
                    <tr>
                        <td colspan="7" class="p-2">
                            <div class="footer-controls">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="text-muted footer-info">
                                        Total: <strong>{{ $kecamatans->total() }}</strong> data kecamatan
                                    </div>
                                    <div class="pagination-filter-footer">
                                        <select name="per_page_footer" id="per_page_footer" class="form-select" onchange="changePage(this.value)">
                                            <option value="5" {{ request('per_page', 10) == 5 ? 'selected' : '' }}>5 Data</option>
                                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 Data</option>
                                            <option value="20" {{ request('per_page', 10) == 20 ? 'selected' : '' }}>20 Data</option>
                                            <option value="50" {{ request('per_page', 10) == 50 ? 'selected' : '' }}>50 Data</option>
                                            <option value="100" {{ request('per_page', 10) == 100 ? 'selected' : '' }}>100 Data</option>
                                        </select>
                                    </div>
                                </div>
                                
                                {{-- PAGINATION --}}
                                @if($kecamatans->hasPages())
                                <div class="table-pagination">
                                    {{ $kecamatans->appends(request()->query())->links('vendor.pagination.custom') }}
                                </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        @endif
    </div>
</div>

{{-- SUCCESS DELETE MODAL --}}
<div class="modal fade" id="successDeleteModal" tabindex="-1" aria-labelledby="successDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-success text-white border-0">
                <h5 class="modal-title" id="successDeleteModalLabel">
                    <i class="fas fa-check-circle me-2"></i>Berhasil Dihapus
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 text-center">
                <div style="font-size: 3rem; color: #28a745; margin-bottom: 20px;">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h6 class="mb-3">Data Kecamatan Berhasil Dihapus</h6>
                <p class="text-muted mb-0">Data telah dihapus dari sistem dan tidak dapat dipulihkan.</p>
            </div>
            <div class="modal-footer border-0 bg-light">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">
                    <i class="fas fa-check me-2"></i>Selesai
                </button>
            </div>
        </div>
    </div>
</div>

{{-- DELETE MODAL --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white border-0">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Penghapusan
                </h5>
            </div>
            <div class="modal-body p-4">
                <p class="mb-3">Apakah Anda yakin ingin menghapus <strong>kecamatan berikut</strong>?</p>
                <div class="alert alert-light border border-danger" style="border-radius: 8px;">
                    <p class="mb-0 text-danger fw-bold" id="deleteItemName" style="font-size: 1.1rem;"></p>
                    <small class="text-muted">ID: <span id="deleteItemId"></span></small>
                </div>
                <div class="alert alert-warning alert-sm mb-0" style="font-size: 0.95rem;">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Catatan:</strong> Tindakan ini tidak dapat dibatalkan. Pastikan Anda benar-benar ingin menghapus data ini.
                </div>
            </div>
            <div class="modal-footer border-0 bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Batal
                </button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Check if ada session success dan trigger modal sukses
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('success'))
            const successDeleteModal = new bootstrap.Modal(document.getElementById('successDeleteModal'));
            successDeleteModal.show();
            
            // Redirect ke index setelah modal ditutup
            document.getElementById('successDeleteModal').addEventListener('hidden.bs.modal', function() {
                location.reload();
            });
        @endif
    });
    
    // Delete button handler dengan modal
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function() {
            const itemName = this.getAttribute('data-item-name');
            const itemId = this.getAttribute('data-item-id');
            const deleteUrl = this.getAttribute('data-delete-url');
            
            document.getElementById('deleteItemName').textContent = itemName;
            document.getElementById('deleteItemId').textContent = itemId;
            document.getElementById('deleteForm').action = deleteUrl;
        });
    });

    function changePage(value) {
        const form = document.getElementById('filterForm');
        document.getElementById('per_page').value = value;
        form.submit();
    }

    // Toast timer
    const successToast = document.getElementById('successToast');
    if (successToast) {
        let seconds = 4;
        const timer = setInterval(() => {
            seconds--;
            document.getElementById('toastTimer').textContent = seconds + 's';
            if (seconds <= 0) {
                clearInterval(timer);
                successToast.style.display = 'none';
            }
        }, 1000);
    }
</script>

@endsection