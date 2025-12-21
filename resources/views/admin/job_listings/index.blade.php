@extends('admin.layout')

@section('title', 'Daftar Loker')
@section('content')

{{-- =================================================================== --}}
{{-- CUSTOM STYLES DENGAN AUTO COLOR CHANGING & NO GAP --}}
{{-- =================================================================== --}}
<style>
    @import url(https://fonts.googleapis.com/css?family=Roboto:400,500,300,700);
    
    /* VARIABEL WARNA DINAMIS */
    :root {
        --dark-bg: #2c2e35;
        --dark-input: #ebecf1;
        
        /* WARNA DINAMIS - akan diubah oleh JavaScript */
        --header-color: #dc3545;
        --footer-color: #dc3545;
        
        --button-blue: #0d6efd;
        --gradient-start: #25c481;
        --gradient-end: #25b7c4;
        
        /* DAFTAR WARNA UNTUK ROTASI */
        --color-red: #dc3545;
        --color-blue: #0d6efd;
        --color-green: #198754;
        --color-purple: #6f42c1;
        --color-orange: #fd7e14;
        --color-pink: #e83e8c;
        --color-teal: #20c997;
        --color-indigo: #6610f2;
    }

    /* ANIMASI PERUBAHAN WARNA */
    .tbl-header, .table tfoot {
        transition: all 0.5s ease-in-out;
    }

    /* H1 Style */
    h1.custom-header{ 
        color: #fff !important; 
        font-weight: 700 !important;
        text-align: left !important; 
        text-transform: none !important;
        margin-bottom: 25px !important;
        font-size: 2rem !important;
    }

    /* STYLE TABEL - NO GAP */
    table{
        width:100%;
        table-layout: fixed;
        border-collapse: collapse; 
        color: #fff; 
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
        margin-bottom: 0 !important; /* HILANGKAN MARGIN */
    }
    
    /* CONTENT BODY - NEMPEL LANGSUNG KE HEADER */
    .tbl-content{
        height:300px;
        overflow-x: hidden; 
        overflow-y: auto;
        margin-top: 0 !important; /* HILANGKAN MARGIN ATAS */
        background: linear-gradient(to right, var(--gradient-start), var(--gradient-end)) !important;
        border: 1px solid rgba(255,255,255,0.3);
        border-top: none !important; /* HILANGKAN BORDER ATAS */
        border-radius: 0 0 5px 5px; 
    }

    /* TABLE HEADER */
    th{
        padding: 20px 15px !important;
        text-align: left !important;
        font-weight: 700 !important;
        font-size: 14px !important; 
        color: #f7f1f1 !important;
        text-transform: uppercase !important;
        vertical-align: middle;
        border-bottom: none !important; 
        background-color: transparent !important;
    }

    /* TABLE DATA */
    td{
        padding: 15px !important;
        text-align: left !important;
        vertical-align:middle !important;
        font-weight: 300 !important;
        font-size: 12px !important;
        color: #fff !important;
        border-bottom: solid 1px rgba(255,255,255,0.2) !important;
        border-top: none !important; 
        background-color: transparent !important; 
    }
    
    /* FOOTER - NEMPEL LANGSUNG KE BODY */
    .table tfoot {
        border-top: none !important; /* HILANGKAN BORDER ATAS */
        background-color: var(--footer-color) !important;
        border-radius: 0 0 5px 5px; 
        color: white !important;
        margin-top: 0 !important; /* HILANGKAN MARGIN */
    }
    .table tfoot td {
        background-color: transparent !important; 
        color: #fff !important;
        border: none !important;
    }
    .table tfoot .text-muted {
        color: rgba(255, 255, 255, 0.8) !important;
    }
    .table tfoot strong {
        color: #fff !important;
    }

    /* FORM CONTROLS */
    .form-control, .form-select {
        background-color: var(--dark-input) !important; 
        border: 1px solid #4a4d55 !important;
        color: #fff !important;
    }

    /* TOMBOL PENCARIAN - BIRU */
    .btn-search {
        background-color: var(--button-blue) !important; 
        border-color: var(--button-blue) !important;
        color: white !important;
    }
    .btn-search:hover {
        background-color: #0b5ed7 !important;
        border-color: #0a58ca !important;
    }

    /* TOMBOL TAMBAH - BIRU */
    .btn-tambah {
        background-color: var(--button-blue) !important; 
        border-color: var(--button-blue) !important;
        color: white !important;
    }
    .btn-tambah:hover {
        background-color: #0b5ed7 !important;
        border-color: #0a58ca !important;
    }

    /* PAGINATION - PUTIH */
    .pagination .page-item .page-link {
        background-color: transparent;
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: white;
    }
    .pagination .page-item.active .page-link {
        background-color: rgba(255, 255, 255, 0.2) !important;
        border-color: rgba(255, 255, 255, 0.5) !important;
        color: white !important;
    }
    .pagination .page-item .page-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 255, 255, 0.5);
        color: white;
    }
    .pagination .page-item.disabled .page-link {
        background-color: transparent;
        border-color: rgba(255, 255, 255, 0.2);
        color: rgba(255, 255, 255, 0.5);
    }

    /* CONTROL PANEL AUTO COLOR */
    .auto-color-control {
        background: var(--dark-bg);
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        border-left: 4px solid var(--header-color);
        transition: border-left 0.5s ease;
    }
    .color-preview {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: inline-block;
        margin: 0 5px;
        border: 2px solid white;
    }
    .current-color {
        font-size: 14px;
        color: white;
        margin-left: 10px;
    }

    /* CONTAINER TABEL - NO GAP */
    .table-container {
        border-radius: 5px;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }

    /* STYLE UNTUK FILTER PAGINATION */
    .pagination-filter {
        min-width: 130px;
    }
    .pagination-filter .form-select {
        background-color: var(--dark-input) !important;
        border: 1px solid #4a4d55 !important;
        color: #fff !important;
        cursor: pointer;
    }
    .pagination-filter .form-select:focus {
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        border-color: #0d6efd !important;
    }
    
    /* FORM GROUP STYLING */
    .form-control-group {
        display: flex;
        gap: 15px;
        align-items: end;
    }

    /* COMPANY LOGO STYLE */
    .company-logo {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid rgba(255, 255, 255, 0.3);
        background: white;
        padding: 2px;
    }
    
    /* BADGE STYLES */
    .badge {
        font-size: 0.75em;
        padding: 6px 10px;
        font-weight: 500;
    }
    
    /* ICON HOVER EFFECTS */
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
    .fa-eye:hover {
        color: #6c9bff !important;
        transform: scale(1.15);
        transition: 0.2s ease;
    }
    
    /* EMPTY STATE */
    .empty-state {
        padding: 40px 0;
    }
    .empty-state i {
        opacity: 0.5;
    }
</style>

<div class="container mt-4">
    
    {{-- CONTROL PANEL AUTO COLOR --}}
    <div class="auto-color-control">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h6 class="text-white mb-2">🎨 Auto Color Changer</h6>
                <div class="d-flex align-items-center">
                    <small class="text-white">Mode: </small>
                    <span id="currentMode" class="badge bg-success ms-2">Same Color</span>
                    <span class="current-color">
                        Warna Saat Ini: <span id="currentColorName" class="fw-bold">Merah</span>
                        <span class="color-preview" id="currentColorPreview" style="background-color: #dc3545;"></span>
                    </span>
                </div>
            </div>
            <div class="col-md-6 text-end">
                <button class="btn btn-sm btn-outline-light me-2" onclick="toggleColorMode()">
                    <i class="fas fa-sync me-1"></i>Toggle Mode
                </button>
                <button class="btn btn-sm btn-outline-light" onclick="toggleAutoChange()">
                    <i class="fas fa-play me-1"></i>Start Auto
                </button>
            </div>
        </div>
    </div>

    {{-- KODE TOAST --}}
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

    {{-- FORM KONTROL DENGAN FIXED LAYOUT --}}
    <form method="GET" action="{{ route('admin.job_listings.index') }}" class="mb-4" id="filterForm">
        <div class="row g-3 align-items-end">
            {{-- KOLOM PENCARIAN --}}
            <div class="col-md-5">
                <label for="search" class="form-label text-white small">Pencarian</label>
                <div class="input-group">
                    <input type="text" name="search" id="search" class="form-control"
                           placeholder="Cari berdasarkan posisi, perusahaan, atau lokasi..."
                           value="{{ request('search') }}">
                    <button type="submit" class="btn btn-search">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            
            {{-- FILTER LOKASI --}}
            <div class="col-md-3">
                <label for="location" class="form-label text-white small">Lokasi</label>
                <div class="input-group pagination-filter">
                    <span class="input-group-text bg-transparent border-end-0 text-white">
                        <i class="fas fa-map-marker-alt"></i>
                    </span>
                    <select name="location" id="location" class="form-select border-start-0">
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
            </div>

            {{-- FILTER PAGINATION --}}
            <div class="col-md-2">
                <label for="per_page" class="form-label text-white small">Data per Halaman</label>
                <div class="input-group pagination-filter">
                    <span class="input-group-text bg-transparent border-end-0 text-white">
                        <i class="fas fa-list-ol"></i>
                    </span>
                    <select name="per_page" id="per_page" class="form-select border-start-0">
                        <option value="5" {{ request('per_page', 10) == 5 ? 'selected' : '' }}>5 Data</option>
                        <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 Data</option>
                        <option value="20" {{ request('per_page', 10) == 20 ? 'selected' : '' }}>20 Data</option>
                        <option value="50" {{ request('per_page', 10) == 50 ? 'selected' : '' }}>50 Data</option>
                    </select>
                </div>
            </div>
            
            {{-- TOMBOL TAMBAH --}}
            <div class="col-md-2">
                <label class="form-label text-white small invisible">Aksi</label>
                <a href="{{ route('admin.job_listings.create') }}" class="btn btn-primary w-100 btn-tambah">
                    <i class="fas fa-plus me-1"></i>Tambah
                </a>
            </div>

           
        </div>

      

           
        </div>
    </form>

    {{-- TABEL CONTAINER - NO GAP --}}
    <div class="table-container">
        <div class="table-responsive">
            
            {{-- HEADER - NEMPEL LANGSUNG --}}
            <div class="tbl-header">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th style="width: 8%;">Logo</th>
                            <th style="width: 20%;">Posisi</th>
                            <th style="width: 15%;">Perusahaan</th>
                            <th style="width: 12%;">Lokasi</th>
                            <th style="width: 8%;">Tipe</th>
                            <th style="width: 12%;">Gaji</th>
                            <th style="width: 10%;">Deadline</th>
                            <th style="width: 8%;">Status</th>
                            <th class="text-center" style="width: 12%;">Tindakan</th>
                        </tr>
                    </thead>
                </table>
            </div>

            {{-- CONTENT BODY - NEMPEL LANGSUNG KE HEADER --}}
            <div class="tbl-content">
                <table class="table table-hover"> 
                    <tbody>
                        @forelse($jobs as $job)
                            <tr class="align-middle"> 
                                <td class="text-center" style="width: 5%;">
                                    {{ $loop->iteration + ($jobs->currentPage() - 1) * $jobs->perPage() }}
                                </td>
                                <td class="text-center" style="width: 8%;">
                                    @if($job->company_logo && Storage::disk('public')->exists($job->company_logo))
                                        <img src="{{ asset('storage/' . $job->company_logo) }}" 
                                             class="company-logo" 
                                             alt="{{ $job->company }}"
                                             onerror="this.style.display='none'">
                                    @else
                                        <div class="company-logo d-flex align-items-center justify-content-center bg-light text-muted mx-auto">
                                            <i class="fas fa-building"></i>
                                        </div>
                                    @endif
                                </td>
                                <td style="width: 20%;">
                                    <div class="fw-semibold">{{ Str::limit($job->title, 40) }}</div>
                                    <small class="text-light">{{ $job->job_type ?? '-' }}</small>
                                </td>
                                <td style="width: 15%;">{{ Str::limit($job->company, 25) }}</td>
                                <td style="width: 12%;">
                                    @if($job->regency)
                                        <span class="text-light">{{ $job->regency->name }}</span>
                                    @elseif($job->province)
                                        <span class="text-light">{{ $job->province->name }}</span>
                                    @else
                                        <span class="text-light">-</span>
                                    @endif
                                </td>
                                <td style="width: 8%;">
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
                                <td style="width: 12%;">
                                    <span class="fw-medium">{{ $job->salary_formatted }}</span>
                                </td>
                                <td style="width: 10%;">
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
                                        <span class="text-light">-</span>
                                    @endif
                                </td>
                                <td style="width: 8%;" class="text-center">
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
                                <td class="text-center" style="width: 12%;">
                                    <div class="d-flex justify-content-center gap-2">
                                        {{-- Edit Button --}}
                                        <a href="{{ route('admin.job_listings.edit', $job->id) }}" 
                                           class="btn btn-warning btn-sm"
                                           title="Edit Lowongan">
                                            <i class="fas fa-edit"></i>
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
                                                    <h5 class="modal-title" style="color: #fff !important;">Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3" style="color: #ffc107 !important;"></i>
                                                    <p style="color: #212529;">Yakin ingin menghapus lowongan <strong>"{{ $job->title }}"</strong> di <strong>{{ $job->company }}</strong>?</p>
                                                    <p class="text-muted small">Data yang dihapus tidak dapat dikembalikan.</p>
                                                </div>
                                                <div class="modal-footer justify-content-center">
                                                    <button class="btn btn-secondary px-4" data-bs-dismiss="modal">Batal</button>
                                                    <form action="{{ route('admin.job_listings.destroy', $job->id) }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button class="btn btn-danger px-4">Ya, Hapus</button>
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
                                        <i class="fas fa-briefcase fa-3x text-light mb-3"></i>
                                        <h5 class="text-light">Tidak ada data lowongan</h5>
                                        <p class="text-light mb-4">Silakan tambah lowongan baru atau sesuaikan filter pencarian</p>
                                        <a href="{{ route('admin.job_listings.create') }}" class="btn btn-primary btn-tambah">
                                            <i class="fas fa-plus me-1"></i> Tambah Lowongan Pertama
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        {{-- FOOTER - NEMPEL LANGSUNG KE BODY --}}
        @if($jobs->hasPages() || $jobs->total() > 0)
        <div class="table-responsive">
            <table class="table" style="table-layout: fixed;"> 
                <tfoot>
                    <tr>
                        <td colspan="10" class="p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-muted small">
                                    Menampilkan <strong>{{ $jobs->firstItem() ?? 0 }}</strong> - 
                                    <strong>{{ $jobs->lastItem() ?? 0 }}</strong> dari 
                                    <strong>{{ $jobs->total() }}</strong> data
                                    | <strong>{{ $jobs->perPage() }}</strong> data per halaman
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
            </table>
        </div>
        @endif
    </div>
</div>

{{-- JAVASCRIPT UNTUK AUTO COLOR CHANGING DAN FILTER --}}
<script>
    // Daftar warna yang akan dirotasi
    const colorPalette = [
        { name: 'Merah', value: '#dc3545' },
        { name: 'Biru', value: '#0d6efd' },
        { name: 'Hijau', value: '#198754' },
        { name: 'Ungu', value: '#6f42c1' },
        { name: 'Oranye', value: '#fd7e14' },
        { name: 'Pink', value: '#e83e8c' },
        { name: 'Teal', value: '#20c997' },
        { name: 'Indigo', value: '#6610f2' }
    ];

    let currentColorIndex = 0;
    let autoChangeInterval = null;
    let colorMode = 'same'; // 'same' atau 'different'
    let isAutoChanging = false;

    // Fungsi untuk mengubah warna
    function changeColors() {
        const root = document.documentElement;
        
        if (colorMode === 'same') {
            // Mode sama: header dan footer warna sama
            const color = colorPalette[currentColorIndex];
            root.style.setProperty('--header-color', color.value);
            root.style.setProperty('--footer-color', color.value);
            
            updateColorDisplay(color.name, color.value);
        } else {
            // Mode berbeda: header dan footer warna berbeda
            const headerColor = colorPalette[currentColorIndex];
            const footerColor = colorPalette[(currentColorIndex + 2) % colorPalette.length];
            
            root.style.setProperty('--header-color', headerColor.value);
            root.style.setProperty('--footer-color', footerColor.value);
            
            updateColorDisplay(`${headerColor.name} / ${footerColor.name}`, headerColor.value);
        }
        
        // Update border color control panel
        document.querySelector('.auto-color-control').style.borderLeftColor = colorPalette[currentColorIndex].value;
        
        // Pindah ke warna berikutnya
        currentColorIndex = (currentColorIndex + 1) % colorPalette.length;
    }

    // Fungsi untuk update display
    function updateColorDisplay(colorName, colorValue) {
        document.getElementById('currentColorName').textContent = colorName;
        document.getElementById('currentColorPreview').style.backgroundColor = colorValue;
    }

    // Fungsi toggle mode
    function toggleColorMode() {
        colorMode = colorMode === 'same' ? 'different' : 'same';
        document.getElementById('currentMode').textContent = 
            colorMode === 'same' ? 'Same Color' : 'Different Colors';
        document.getElementById('currentMode').className = 
            colorMode === 'same' ? 'badge bg-success ms-2' : 'badge bg-warning ms-2';
        
        // Simpan preference
        localStorage.setItem('colorMode', colorMode);
    }

    // Fungsi toggle auto change
    function toggleAutoChange() {
        const button = document.querySelector('[onclick="toggleAutoChange()"]');
        
        if (isAutoChanging) {
            // Stop auto change
            clearInterval(autoChangeInterval);
            autoChangeInterval = null;
            button.innerHTML = '<i class="fas fa-play me-1"></i>Start Auto';
            button.className = 'btn btn-sm btn-outline-light';
            isAutoChanging = false;
        } else {
            // Start auto change (setiap 3 detik)
            autoChangeInterval = setInterval(changeColors, 3000);
            button.innerHTML = '<i class="fas fa-stop me-1"></i>Stop Auto';
            button.className = 'btn btn-sm btn-danger';
            isAutoChanging = true;
            
            // Langsung ganti warna sekali
            changeColors();
        }
    }

    // FUNGSI UNTUK FILTER
    function handleFilterChange() {
        document.getElementById('filterForm').submit();
    }

    // Load preferences saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        // Load color mode preference
        const savedColorMode = localStorage.getItem('colorMode');
        if (savedColorMode) {
            colorMode = savedColorMode;
            document.getElementById('currentMode').textContent = 
                colorMode === 'same' ? 'Same Color' : 'Different Colors';
            document.getElementById('currentMode').className = 
                colorMode === 'same' ? 'badge bg-success ms-2' : 'badge bg-warning ms-2';
        }
        
        // Event listener untuk filter
        const filterSelects = document.querySelectorAll('#location, #type, #status, #per_page');
        if (filterSelects) {
            filterSelects.forEach(select => {
                select.addEventListener('change', handleFilterChange);
            });
        }
        
        // Toast notification
        const toastEl = document.getElementById('liveToast');
        if (toastEl && typeof bootstrap !== 'undefined') {
            const toast = new bootstrap.Toast(toastEl, {
                delay: 4000,
                animation: true
            });
            toast.show();
        }
        
        // Mulai auto change otomatis setelah 2 detik
        setTimeout(() => {
            if (!isAutoChanging) {
                toggleAutoChange();
            }
        }, 2000);
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(window).on("load resize", function() {
        var $tblContent = $('.tbl-content');
        var $tblHeader = $('.tbl-header');
        
        var scrollWidth = $tblContent.width() - $tblContent[0].clientWidth;
        $tblHeader.css({'padding-right': scrollWidth});
    }).resize();
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection