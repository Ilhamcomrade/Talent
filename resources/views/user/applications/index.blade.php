<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lamaran Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f7f9fc; /* Background abu-abu muda */
        }
        main {
            flex: 1;
        }
        .container-centered {
            max-width: 1200px;
        }
        
        /* === Gaya Sidebar === */
        .sidebar {
            min-width: 250px; /* Diperbesar sedikit agar menu lebih lega */
            background-color: white;
        }
        .sidebar .nav-link {
            color: black !important;
        }
        .sidebar .nav-link.active {
            color: #0d6efd !important;
            font-weight: bold;
        }

        .content {
            flex: 1;
        }
        .application-card {
            position: relative; 
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            background-color: white;
            transition: all 0.3s ease;
        }
        .application-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        .status-badge {
            font-size: 0.85em;
            padding: 4px 8px;
            border-radius: 4px;
        }
        /* Style untuk container kosong */
        .empty-state {
            text-align: center;
            padding: 50px 20px;
        }
        .empty-state img {
            max-width: 250px; /* Ukuran gambar disesuaikan */
            height: auto;
            margin-bottom: 20px;
            /* Jika Anda ingin efek lingkaran/garis pada gambar: */
            border-radius: 50%;
            /* box-shadow: 0 0 0 10px #e0e0e0; */
        }
        .btn-jelajahi {
            background-color: #0d6efd; /* Biru Bootstrap */
            color: white;
            border: none;
            padding: 10px 30px;
            font-size: 1.1em;
        }
    </style>
</head>

<body>

    {{-- Navbar (Asumsi partials.navbar ada) --}}
    <div class="w-100">
        @include('partials.navbar')
    </div>

    <main class="d-flex justify-content-center align-items-start pt-5">
        <div class="container container-centered d-flex gap-4">

            {{-- Kolom Kiri: Sidebar (Hitungan total lamaran dihilangkan) --}}
            <div class="sidebar border p-3 rounded shadow-sm">
                <h5>Status Lamaran</h5>

                @php
                    // Pastikan variabel ada, jika tidak, set default array kosong
                    $currentStatus = request('status');
                    $statusCounts = $statusCounts ?? [];
                    $allApplicationsCount = $allApplicationsCount ?? 0;
                    

                    // Map status supaya sesuai database ENUM 
                    $statusMap = [
                        // Diperlukan untuk mapping tampilan. Tambahkan/sesuaikan sesuai DB ENUM
                        'masuk'             => 'Dilamar',
                        'diproses'          => 'Diproses HRD',
                        'profile_lolos'     => 'Profile Lolos',
                        'wawancara_lolos'   => 'Wawancara',
                        'tes_lolos'         => 'Skill Psikotes',
                        'diterima'          => 'Diterima',
                        'ditolak'           => 'Ditolak',
                    ];
                @endphp

                <ul class="nav flex-column">

                    <li class="nav-item mb-2">
                        <a class="nav-link d-flex justify-content-between align-items-center {{ !$currentStatus ? 'active' : '' }}" 
                            href="{{ route('user.applications.index') }}">
                            <span>Semua</span>
                        </a>
                    </li>
                    
                    @foreach ($statusMap as $key => $label)
                        <li class="nav-item mb-2">
                            @php
                                $count = $statusCounts[$key] ?? 0;
                            @endphp
                            <a class="nav-link d-flex justify-content-between align-items-center {{ $currentStatus == $key ? 'active' : '' }}" 
                                href="{{ route('user.applications.index', ['status' => $key]) }}">
                                <span>{{ $label }}</span>
                            </a>
                        </li>
                    @endforeach

                </ul>
            </div>

            {{-- Kolom Kanan: Konten Lamaran / Empty State --}}
            <div class="content flex-grow-1 pt-3">
                
                @php
                    $countToDisplay = (!$currentStatus) ? ($allApplicationsCount ?? 0) : ($statusCounts[$currentStatus] ?? 0);
                @endphp
                
                <h5 class="text-secondary mb-4">
                    <i class="fas fa-history me-2"></i> {{ $countToDisplay }} lamaran dalam 90 hari terakhir
                </h5>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

               @if($applications->isEmpty())
    {{-- EMPTY STATE CONTAINER BARU --}}
    <div class="application-card empty-state">
        <img src="{{ asset('images/pelamar.png') }}" alt="Ilustrasi Pelamar" class="img-fluid">
        
        <h4 class="mt-4">Ups, belum ada lamaran pekerjaan yang aktif.</h4>
        <p class="text-muted mb-4">
            Temukan lowongan kerja dan mulai melamar!
        </p>
        
        <a href="{{ route('jobs.index') ?? '#' }}" class="btn btn-jelajahi text-uppercase">
            Jelajahi Lowongan
        </a>
    </div>
@else
    {{-- Loop untuk menampilkan daftar lamaran dalam bentuk Card --}}
    @foreach($applications as $app)
        <div class="application-card d-flex align-items-center">
            
            {{-- Stretched link menuju detail lamaran --}}
            
            <a href="{{ route('jobs.show', $app->job->id ?? '#') }}" class="stretched-link"></a>
            
            {{-- === PERBAIKAN LOGO PERUSAHAAN DIMULAI DI SINI === --}}
            @php
                // Ambil path logo perusahaan jika ada relasi job dan company
                $company = $app->job->company ?? null;
                $logoUrl = ($company && $company->logo) ? asset('storage/' . $company->logo) : null; 
            @endphp

            <div class="me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; min-width: 50px;">
                @if($logoUrl)
                    {{-- Tampilkan Logo --}}
                    <img src="{{ $logoUrl }}" 
                         alt="{{ $company->name ?? 'Logo Perusahaan' }}" 
                         class="rounded-circle border" 
                         style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    {{-- Fallback jika logo tidak ada --}}
                    <div class="p-3 bg-light rounded-circle text-primary">
                        <i class="fas fa-briefcase"></i>
                    </div>
                @endif
            </div>
            {{-- === PERBAIKAN LOGO PERUSAHAAN SELESAI === --}}


            <div class="flex-grow-1">
                <h5 class="mb-1 fw-bold">{{ $app->job->title ?? 'Lowongan dihapus' }}</h5>
                <p class="text-muted mb-2">
                    {{ $app->job->company->name ?? 'Perusahaan Tidak Dikenal' }}
                </p>
                <div class="d-flex align-items-center">
                    {{-- Ikon Kalender --}}
                    <i class="far fa-calendar-alt me-2 text-muted"></i>
                    <span class="text-muted me-3">
                        Dikirim pada {{ $app->created_at->format('d F Y, H:i') }}
                    </span>
                    
                    {{-- Status Badge --}}
                    @php
                        $badge = match($app->status) {
                            'masuk' => 'secondary', 'diproses' => 'info', 
                            'profile_lolos' => 'primary', 'wawancara_lolos' => 'warning text-dark', 
                            'tes_lolos' => 'dark', 'diterima' => 'success', 
                            'ditolak' => 'danger', default => 'light text-dark',
                        };
                        $statusLabel = $statusMap[$app->status] ?? $app->status; 
                    @endphp
                    <span class="status-badge bg-{{ $badge }} text-white">
                        {{ $statusLabel }}
                    </span>
                </div>
            </div>
            
            {{-- Tombol Aksi --}}
            <div class="ms-auto" style="position: relative; z-index: 10;">
                <form action="{{ route('user.applications.destroy', $app->id) }}" 
                        method="POST" 
                        onsubmit="return confirm('Yakin ingin hapus lamaran?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger">Hapus</button>
                </form>
            </div>
        </div>
    @endforeach
    {{-- <div class="mt-4">{{ $applications->links() }}</div> --}}
@endif
            </div>

        </div>
    </main>

    {{-- Footer (Asumsi partials.footer ada) --}}
    <div class="w-100 mt-auto">
        @include('partials.footer')
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>