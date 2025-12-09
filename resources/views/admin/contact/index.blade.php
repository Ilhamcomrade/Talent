@extends('admin.layout') {{-- sesuaikan jika layout admin Anda beda --}}

@section('content')
{{-- CSS KUSTOM UNTUK MEMENUHI PERMINTAAN --}}
<style>
    /* 1. Styling untuk badge notifikasi yang lebih kecil dan diposisikan ke kanan atas */
    .filter-badge {
        font-size: 0.65em !important;
        padding: 0.25em 0.5em; /* Kecilkan padding */
        
        /* PENTING: Mengatur posisi ke kanan atas (top-0 end-0/start-100) dan memastikan badge berukuran kecil */
        top: 0 !important;
        right: 0 !important; /* Dihapus atau diabaikan karena Bootstrap end-0 lebih dominan */
        
        /* Tambahan: Ubah ukuran agar lebih terlihat seperti lingkaran kecil */
        width: 1.25em; /* Tetapkan lebar dan tinggi yang sama */
        height: 1.25em; 
        display: flex; /* Gunakan flexbox untuk memusatkan teks */
        align-items: center;
        justify-content: center;
        line-height: 1; /* Pastikan tinggi baris 1 agar angka pas di tengah */
        border: 2px solid #fff; /* Border putih agar lebih menonjol */
    }

    /* 3. Styling untuk hover biru pada semua dropdown-item dalam menu filter */
    #innerFilterContainer .dropdown-item:hover,
    #innerFilterContainer .dropdown-item:focus {
        color: #fff; /* Teks putih saat hover */
        background-color: #0d6efd; /* Warna biru Bootstrap (primary) */
    }
    
    /* Pastikan warna teks normal tetap default saat tidak hover */
    #innerFilterContainer .dropdown-item {
        color: #212579; /* Warna teks default */
    }
    
    /* Pastikan warna teks item aktif tetap konsisten dengan Bootstrap */
    #innerFilterContainer .dropdown-item.active {
        color: #fff;
        background-color: #0d6efd;
    }

    /* paksa sel ikut warna abu-abu untuk pesan belum dibaca */
    .unread-row td {
        background-color: #f0f0f0 !important;
    }

    /* Warna putih untuk pesan sudah dibaca */
    .read-row td {
        background-color: #ffffff !important;
    }

    /* Penyesuaian agar elemen form dan filter muat di satu baris */
    .data-filter-controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px; /* Jarak dari tabel di bawahnya */
    }

    /* CSS Tambahan untuk Ikon Mata */
    .status-icon {
        width: 24px; /* Atur lebar ikon */
        height: 24px; /* Atur tinggi ikon */
        vertical-align: middle; /* Pusatkan secara vertikal */
    }

</style>

<div class="container">
    {{-- BARIS JUDUL DAN FILTER IKON --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Pesan Masuk</h4>
        
        {{-- IKON FILTER FILAMENT STYLE --}}
        @php
            // Hitung jumlah data yang dihapus untuk notifikasi badge
            $trashedCount = \App\Models\ContactMessage::onlyTrashed()->count();
            
            // Ambil filter saat ini
            $currentFilter = request()->query('status', 'without'); 
            $currentSearch = request()->query('search', '');
            $currentLimit = request()->query('limit', 10); // Default 10 data per halaman
            
            // Tentukan teks tombol filter status saat ini
            $filterText = 'Tanpa data yang dihapus';
            if ($currentFilter == 'with') {
                $filterText = 'Dengan data yang dihapus';
            } elseif ($currentFilter == 'only') {
                $filterText = 'Hanya data yang dihapus';
            }
            
            // Base URL untuk filter (mempertahankan status, search, dan limit)
            $baseRoute = route('admin.contact-messages.index');
        @endphp

        <div class="dropdown">
            {{-- Tombol Ikon Filter yang membuka dropdown --}}
            <button class="btn p-1 border-0 position-relative" 
                    type="button" 
                    id="filterDropdownButton" 
                    data-bs-toggle="dropdown" 
                    data-bs-auto-close="outside" 
                    aria-expanded="false" 
                    style="color: #6c757d; font-size: 1.5rem;">
                
                {{-- Ikon Corong (Bootstrap Icons) --}}
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-funnel-fill" viewBox="0 0 16 16">
                    <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.618V14.5a.5.5 0 0 1-.8.4l-2-2A.5.5 0 0 1 7 12.5V8.618L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2z"/>
                </svg>
                
                {{-- Notifikasi Badge Disesuaikan: PERUBAHAN DI SINI --}}
                @if($trashedCount > 0 && ($currentFilter == 'with' || $currentFilter == 'only'))
                {{-- Mengubah top-50 start-50 menjadi top-0 start-100 agar berada di kanan atas ikon --}}
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark filter-badge">
                    {{ $trashedCount }}
                    <span class="visually-hidden">data dihapus</span>
                </span>
                @endif
            </button>

            {{-- DROPDOWN MENU UTAMA (Panel Filter) --}}
            <div class="dropdown-menu dropdown-menu-end p-3 shadow-lg" aria-labelledby="filterDropdownButton" style="min-width: 300px; border-radius: 8px;">
                <h6 class="dropdown-header mb-3 fw-bold border-bottom pb-2">Filter</h6>
                
                {{-- DROPDOWN SELECT INNER --}}
                <div class="dropdown" id="innerFilterContainer"> {{-- Tambahkan ID --}}
                    {{-- Tombol yang menampilkan status filter saat ini --}}
                    <button class="btn btn-light dropdown-toggle w-100 text-start border" 
                            type="button" 
                            id="innerFilterSelect" 
                            data-bs-toggle="dropdown" 
                            aria-expanded="false">
                        {{ $filterText }}
                    </button>
                    
                    {{-- Daftar Pilihan Filter (TANPA ANGKA NOTIFIKASI) --}}
                    <ul class="dropdown-menu w-100" aria-labelledby="innerFilterSelect">
                        {{-- Opsi 1: Tanpa data yang dihapus (Default) --}}
                        {{-- Pastikan semua filter saat ini dipertahankan, kecuali 'status' dihapus/direset --}}
                        @php $params = array_filter(['search' => $currentSearch, 'limit' => $currentLimit]); @endphp
                        <li><a class="dropdown-item @if($currentFilter == 'without') active @endif" href="{{ $baseRoute }}?{{ http_build_query($params) }}">Tanpa data yang dihapus</a></li>
                        
                        {{-- Opsi 2: Dengan data yang dihapus (withTrashed) --}}
                        @php $params = array_filter(['status' => 'with', 'search' => $currentSearch, 'limit' => $currentLimit]); @endphp
                        <li><a class="dropdown-item @if($currentFilter == 'with') active @endif" href="{{ $baseRoute }}?{{ http_build_query($params) }}">Dengan data yang dihapus</a></li>
                        
                        {{-- Opsi 3: Hanya data yang dihapus (onlyTrashed) --}}
                        @php $params = array_filter(['status' => 'only', 'search' => $currentSearch, 'limit' => $currentLimit]); @endphp
                        <li><a class="dropdown-item @if($currentFilter == 'only') active @endif" href="{{ $baseRoute }}?{{ http_build_query($params) }}">Hanya data yang dihapus</a></li>
                    </ul>
                </div>
                
            </div>
        </div>
    </div>
    
    {{--- BAGIAN KONTROL PENCARIAN DAN BATAS PER HALAMAN ---}}
    <div class="data-filter-controls">
        
        {{-- KOLOM PENCARIAN --}}
        <form action="{{ $baseRoute }}" method="GET" class="d-flex me-3" style="flex-grow: 1;">
            {{-- Input tersembunyi untuk mempertahankan filter status dan limit --}}
            @if($currentFilter != 'without')
            <input type="hidden" name="status" value="{{ $currentFilter }}">
            @endif
            <input type="hidden" name="limit" value="{{ $currentLimit }}">
            
            <input type="search" 
                    name="search" 
                    class="form-control" 
                    placeholder="Cari (Nama, Email, Kontak)..." 
                    value="{{ $currentSearch }}"
                    style="width: 100%; max-width: 300px;">
            <button class="btn btn-primary ms-2" type="submit">Cari</button>
            @if($currentSearch)
            {{-- Tombol Reset: Menghapus hanya parameter 'search' --}}
            <a href="{{ $baseRoute }}?{{ http_build_query(array_filter(['status' => $currentFilter != 'without' ? $currentFilter : null, 'limit' => $currentLimit])) }}" class="btn btn-secondary ms-2">Reset</a>
            @endif
        </form>
        
        {{-- FILTER BATAS DATA PER HALAMAN --}}
        <div class="d-flex align-items-center flex-shrink-0">
            <span class="text-nowrap me-2 d-none d-sm-block">Tampilkan:</span>
            <select class="form-select form-select-sm" 
                    onchange="window.location.href = this.value" 
                    style="width: auto;">
                @foreach([10, 20, 50, 100] as $limit)
                    @php 
                        $params = array_filter([
                            // Periksa $currentFilter != 'without' untuk menghindari parameter status kosong
                            'status' => $currentFilter != 'without' ? $currentFilter : null, 
                            'search' => $currentSearch, 
                            'limit' => $limit
                        ]);
                        $url = $baseRoute . '?' . http_build_query($params);
                    @endphp
                    <option value="{{ $url }}" @if($currentLimit == $limit) selected @endif>
                        {{ $limit }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    {{--- AKHIR BAGIAN KONTROL BARU ---}}
    
    @if(session('success'))
        <div id="deleteSuccessMessage" data-message="{{ session('success') }}"></div>
    @endif
    
    <div class="card">
        <div class="card-body">
            @if($messages->count())
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kontak</th>
                        <th>Email</th>
                        <th>Waktu</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($messages as $msg)
                    <tr class="{{ $msg->status == 0 ? 'unread-row' : 'read-row' }}" data-status="{{ $msg->status }}">
                        <td>{{ ($messages->currentPage() - 1) * $messages->perPage() + $loop->iteration }}</td>

                        <td>{{ $msg->name ?? '-' }}</td>
                        <td>{{ $msg->phone ?? '-' }}</td>
                        <td>{{ $msg->email ?? '-' }}</td>

                        <td>{{ \Carbon\Carbon::parse($msg->created_at)->format('H:i d/m/Y') }}</td>

                        {{-- PERUBAHAN UTAMA: Kolom Status diganti Ikon --}}
                        <td class="text-center"> {{-- Tambahkan text-center untuk memusatkan ikon --}}
                            @php
                                $isRead = $msg->status == 1;
                                $iconPath = $isRead ? asset('images/OpenEye.png') : asset('images/ClosedEye.png');
                                $altText = $isRead ? 'Sudah Dibaca' : 'Belum Dibaca';
                            @endphp

                            {{-- Menggunakan tag img dengan path ke ikon dan kelas CSS kustom --}}
                            <img src="{{ $iconPath }}" alt="{{ $altText }}" title="{{ $altText }}" class="status-icon">
                        </td>
                        {{-- AKHIR PERUBAHAN UTAMA --}}

                        <td>
                            <a href="{{ route('admin.contact-messages.show', $msg->id) }}" class="btn btn-sm btn-primary">Lihat</a>
                            
                            @if($msg->deleted_at)
                                <form action="{{ route('admin.contact-messages.restore', $msg->id) }}"
                                    method="POST"
                                    class="restore-form"
                                    style="display:inline">
                                    @csrf
                                    <button class="btn btn-sm btn-success restore-btn" type="button">Pulihkan</button>
                                </form>
                            @else
                                <form action="{{ route('admin.contact-messages.destroy', $msg->id) }}" 
                                    method="POST" 
                                    class="delete-form" 
                                    style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger delete-btn" type="button">Hapus</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

                {{-- PERBAIKAN: Memastikan parameter query dipertahankan saat navigasi pagination --}}
                {{-- Dengan withQueryString() di controller, $messages->links() saja sudah cukup. --}}
                {{-- Namun, untuk memastikan kompatibilitas, kita tambahkan appends: --}}
                {{ $messages->appends(['search' => $currentSearch, 'limit' => $currentLimit, 'status' => $currentFilter])->links() }}
            @else
                <div class="text-center p-4 text-muted">
                    @if($currentFilter == 'only')
                        Tidak ada data pesan yang dihapus yang ditemukan.
                    @elseif($currentFilter == 'with')
                        Tidak ada pesan sama sekali (termasuk yang dihapus).
                    @else
                        Belum ada pesan masuk .
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-btn');
        const restoreButtons = document.querySelectorAll('.restore-btn'); 

        // [PERBAIKAN DROPDOWN BERSARANG]
        // Mencegah klik pada dropdown menu (filter opsi) menutup dropdown panel terluar.
        const innerFilterContainer = document.getElementById('innerFilterContainer');
        if (innerFilterContainer) {
            innerFilterContainer.addEventListener('click', function (e) {
                // Hentikan perambatan event klik dari dropdown dalam ke elemen luar
                e.stopPropagation(); 
            });
        }
        
        // LOGIC HAPUS (SOFT DELETE)
        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                const form = this.closest('form');
                Swal.fire({
                    title: 'Konfirmasi Penghapusan?',
                    text: "Pesan ini akan dihapus. Data masih dapat dipulihkan.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#dc3545' 
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // LOGIC PULIHKAN (RESTORE)
        restoreButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                const form = this.closest('form');
                Swal.fire({
                    title: 'Pulihkan Pesan?',
                    text: "Pesan ini akan ditampilkan kembali di daftar Pesan Aktif!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Pulihkan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // Tampilkan SweetAlert success setelah reload
        const successDiv = document.getElementById('deleteSuccessMessage');
        if (successDiv) {
            Swal.fire({
                title: 'Berhasil!',
                text: successDiv.dataset.message, 
                icon: 'success',
                confirmButtonText: 'OK'
            });
        }
    });
</script>
@endpush

@stack('scripts')