<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lowongan Kerja - Cari Lowongan Kerja | Next Jobz</title>

    <link rel="icon" type="image/png" href="{{ asset('123.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body { background: #f8f9fa; }

        /* === Search Header === */
        .search-header {
            background: url('/images/Header.png') no-repeat center center;
            background-size: cover;
            padding: 3rem 0;
            min-height: 200px;
            color: #fff;
            display: flex;
            align-items: center;
        }
        .search-box .form-control,
        .search-box .form-select {
            border-radius: 6px;
            border: none;
            padding: 0.75rem 1rem;
        }
        .input-keyword { width: 100%; }
        .btn-pink {
            background-color: #e6007e;
            color: #fff;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s ease-in-out;
            width: 100%;
        }
        .btn-pink:hover { background-color: #c7006c; transform: translateY(-2px); }
        .search-label { font-size: 1rem; font-weight: 500; margin-bottom: 0.5rem; display: block; }
        .search-options-wrapper { text-align: right; margin-top: 1rem; padding-right: 0.5rem; }
        .more-options { font-size: 0.9rem; font-weight: 600; color: #fff; text-decoration: none; padding-right: 100px; }
        .more-options:hover { color: #e6007e; }

        /* === Dropdown Klasifikasi === */
        .dropdown-menu-scrollable { max-height: 300px; overflow-y: auto; padding: 0; min-width: 400px; }
        .dropdown-item-custom { display: flex; align-items: center; justify-content: space-between; padding: 0.5rem 1rem; color: #212529; transition: background-color 0.2s, color 0.2s; }
        .dropdown-item-custom:hover, .dropdown-item-custom:focus { background-color: #e9f5ff; color: #007bff; }
        .search-box .btn.dropdown-toggle { 
            background-color: #fff; 
            color: #212529; 
            border: none; 
            box-shadow: none; 
            text-align: left; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            padding: 0.75rem 1rem; 
        }
        .search-box .btn.dropdown-toggle:focus { box-shadow: none; }
        .dropdown-toggle .bi-chevron-down { transition: transform 0.3s ease-in-out; }
        .dropdown-toggle[aria-expanded="true"] .bi-chevron-down { transform: rotate(180deg); }

        /* === Job Card === */
        .job-card {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: 0.3s;
            border-left: 4px solid #e7e3ee;
        }
        /* === Job Card Applied State (Warna Abu-abu) === */
.job-card.job-applied {
    /* Mengubah warna latar belakang menjadi abu-abu terang */
    background-color: #f0f0f0; /* Abu-abu lebih terang */
    
    /* Mengubah garis kiri menjadi abu-abu/sekunder (opsional) */
    border-left: 4px solid #e9ebec; 
    
    /* Mengurangi opasitas agar terlihat 'pudar' (opsional) */
    opacity: 0.7; 
    
    /* Menghilangkan efek hover pada kartu yang sudah dilamar */
    box-shadow: 0 2px 5px rgba(0,0,0,0.05); /* Mengurangi bayangan */
}

/* Opsional: Membuat teks di dalamnya terlihat lebih pudar/abu-abu */
.job-card.job-applied .job-title a {
    color: #999 !important; /* Membuat judul lebih pudar */
}

/* Opsional: Mengubah warna tombol/link yang sudah dilamar */
/* Asumsi ada link 'Lamar' di dalam job-card yang juga ingin dimatikan */
.job-card.job-applied .apply-btn {
    background: #adb5bd !important; /* Abu-abu sekunder */
    color: #fff !important;
    cursor: default;
    /* pointer-events: none; Hanya untuk memastikan tombolnya tidak bisa diklik */
    /* transform: none; */
}
        .job-card:hover { transform: translateY(-3px); box-shadow: 0 4px 10px rgba(0,0,0,0.15); }
        .job-title { font-size: 1.2rem; font-weight: bold; color: #333; }
        .salary { color: #91720d; font-weight: bold; }
        .skills span { display: inline-block; background: #e9ecef; border-radius: 20px; padding: 4px 12px; font-size: 0.85rem; margin: 2px; }
        .apply-btn { background: #0d6efd; color: #fff; font-weight: bold; padding: 6px 20px; border-radius: 5px; text-decoration: none; transition: all 0.3s; }
        .apply-btn:hover { background: #0b5ed7; color: #fff; transform: scale(1.05); }

        /* Logo perusahaan */
        .company-logo {
            width: 80px;
            height: 80px;
            object-fit: contain;
            border-radius: 8px;
            border: 1px solid #e9ecef;
            background: #fff;
            padding: 5px;
        }
        .logo-placeholder {
            width: 80px;
            height: 80px;
            background: #f8f9fa;
            border: 1px dashed #dee2e6;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            font-size: 0.8rem;
            text-align: center;
        }

        /* === Sidebar Filter === */
        .sidebar { 
            background: #fff; 
            border-radius: 10px; 
            padding: 20px; 
            box-shadow: 0 2px 10px rgba(0,0,0,0.1); 
            position: sticky; 
            top: 20px; 
        }
        .filter-section { 
            margin-bottom: 20px; 
            padding-bottom: 15px; 
            border-bottom: 1px solid #eee; 
        }
        .filter-section:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }
        .filter-title { 
            font-weight: 600; 
            font-size: 1rem; 
            color: #333; 
            cursor: pointer; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            margin-bottom: 10px; 
            padding: 5px 0;
        }
        .filter-title:hover { color: #3200e6; }
        .filter-options label { font-weight: normal; font-size: 0.9rem; }
        .filter-options .form-check { margin-bottom: 8px; }
        .priority-btn { 
            background-color: transparent; 
            border: 1px solid #ced4da; 
            color: #495057; 
            padding: 6px 15px; 
            border-radius: 20px; 
            font-size: 0.9rem; 
            transition: all 0.2s; 
            margin-right: 8px; 
            margin-bottom: 8px;
        }
        .priority-btn.active, .priority-btn:hover { 
            background-color: #eaf3ff; 
            border-color: #0d6efd; 
            color: #0d6efd; 
        }
        .page-header-sidebar { 
            font-size: 1.3rem; 
            font-weight: bold; 
            margin-bottom: 20px; 
            color: #333;
            padding-bottom: 10px;
            border-bottom: 2px solid #131313;
        }
        
        /* Badge styles */
        .badge-new { background: #28a745; }
        .badge-featured { background: #e6007e; }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .search-header { padding: 2rem 0; }
            .sidebar { position: static; margin-bottom: 20px; }
            .company-logo, .logo-placeholder {
                width: 60px;
                height: 60px;
            }
        }
    </style>
</head>
<body>

    {{-- 1. IMPORT NAVBAR --}}
    @include('partials.navbar')

    {{-- === Search Header === --}}
    <section class="search-header">
        <div class="container">
            {{-- SEARCH FORM - method GET supaya query muncul di URL --}}
            <form class="row g-2 align-items-end search-box" method="GET" action="{{ route('jobs.index') }}" id="searchForm">
                <div class="col-12 col-md-4">
                    <label class="search-label">Pekerjaan apa?</label>
                    <input name="q" type="text" class="form-control input-keyword" placeholder="Masukkan kata kunci" value="{{ request('q') }}" id="keywordInput">
                </div>

                <div class="col-12 col-md-3">
                    <label class="search-label">industri</label>
                    <div class="dropdown w-100">
                        <button class="btn dropdown-toggle w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="dropdownKlasifikasi">
                            <span id="klasifikasiText">Semua industri</span>
                            <i class="bi bi-chevron-down"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-scrollable w-100" aria-labelledby="dropdownKlasifikasi">
                            <li><a class="dropdown-item" href="#" data-value="sales">Sales</a></li>
                            <li><a class="dropdown-item" href="#" data-value="it">IT</a></li>
                            <li><a class="dropdown-item" href="#" data-value="otomotif">Otomotif</a></li>
                            <li><a class="dropdown-item" href="#" data-value="lainnya">Lainnya</a></li>
                            <li><a class="dropdown-item" href="#" data-value="administrasi">Administrasi</a></li>
                            <li><a class="dropdown-item" href="#" data-value="akuntansi-keuangan">Akuntansi & Keuangan</a></li>
                            <li><a class="dropdown-item" href="#" data-value="manajemen">Manajemen</a></li>
                            <li><a class="dropdown-item" href="#" data-value="desain-kreatif">Desain & Kreatif</a></li>
                            <li><a class="dropdown-item" href="#" data-value="pemasaran">Pemasaran</a></li>
                            <li><a class="dropdown-item" href="#" data-value="pendidikan">Pendidikan</a></li>
                            <li><a class="dropdown-item" href="#" data-value="kesehatan">Kesehatan</a></li>
                            <li><a class="dropdown-item" href="#" data-value="teknik">Teknik</a></li>
                            <li><a class="dropdown-item" href="#" data-value="produksi">Produksi</a></li>
                            <li><a class="dropdown-item" href="#" data-value="logistik">Logistik</a></li>
                            <li><a class="dropdown-item" href="#" data-value="transportasi">Transportasi</a></li>
                            <li><a class="dropdown-item" href="#" data-value="hrd">Sumber Daya Manusia (HRD)</a></li>
                            <li><a class="dropdown-item" href="#" data-value="hukum">Hukum</a></li>
                            <li><a class="dropdown-item" href="#" data-value="media-komunikasi">Media & Komunikasi</a></li>
                            <li><a class="dropdown-item" href="#" data-value="perhotelan">Perhotelan & Pariwisata</a></li>
                            <li><a class="dropdown-item" href="#" data-value="ritel">Ritel & E-commerce</a></li>
                            <li><a class="dropdown-item" href="#" data-value="freelance">Freelance</a></li>
                            <li><a class="dropdown-item" href="#" data-value="magang">Magang</a></li>
                            <li><a class="dropdown-item" href="#" data-value="remote">Remote Work</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <label class="search-label">Di mana?</label>
                    <input name="location" type="text" class="form-control" placeholder="Masukkan kota atau wilayah" value="{{ request('location') }}" id="locationInput">
                </div>

                <div class="col-12 col-md-2 d-grid">
                    <button type="submit" class="btn btn-pink">
                        <i class="bi bi-search me-2"></i>Cari
                    </button>
                </div>
            </form>
        </div>
    </section>

    {{-- === Main Content === --}}
    <div class="container my-4">
        <div class="row">

            {{-- Sidebar Filter --}}
            <div class="col-lg-3 mb-4">
                <div class="sidebar">
                    <div class="page-header-sidebar">Filter Pekerjaan</div>

                    <!-- Tipe Pekerjaan Filter -->
                    <div class="filter-section">
                        <div class="filter-title" data-bs-toggle="collapse" data-bs-target="#collapseTipePekerjaan" aria-expanded="true">
                            Jenis Pekerjaan <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="collapse show filter-options" id="collapseTipePekerjaan">
                            <div class="form-check">
                                <input class="form-check-input job-type-filter" type="checkbox" name="job_types[]" value="full-time" id="tipePenuhWaktu">
                                <label class="form-check-label" for="tipePenuhWaktu">Full-time</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input job-type-filter" type="checkbox" name="job_types[]" value="contract" id="tipeKontrak">
                                <label class="form-check-label" for="tipeKontrak">Contract</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input job-type-filter" type="checkbox" name="job_types[]" value="internship" id="tipeMagang">
                                <label class="form-check-label" for="tipeMagang">Internship</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input job-type-filter" type="checkbox" name="job_types[]" value="part-time" id="tipeParuhWaktu">
                                <label class="form-check-label" for="tipeParuhWaktu">Part-time</label>
                            </div>
                        </div>
                    </div>

                    <!-- Kebijakan Kerja Filter -->
                    <div class="filter-section">
                        <div class="filter-title" data-bs-toggle="collapse" data-bs-target="#collapseKebijakanKerja" aria-expanded="true">
                            Kebijakan Kerja <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="collapse show filter-options" id="collapseKebijakanKerja">
                            <div class="form-check">
                                <input class="form-check-input work-policy-filter" type="checkbox" name="work_policies[]" value="kerja_di_kantor" id="kantor">
                                <label class="form-check-label" for="kantor">Kerja di Kantor</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input work-policy-filter" type="checkbox" name="work_policies[]" value="remote" id="remote">
                                <label class="form-check-label" for="remote">Remote</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input work-policy-filter" type="checkbox" name="work_policies[]" value="hybrid" id="hybrid">
                                <label class="form-check-label" for="hybrid">Hybrid</label>
                            </div>
                        </div>
                    </div>

                    <!-- Tingkat Pengalaman Filter -->
                    <div class="filter-section">
                        <div class="filter-title" data-bs-toggle="collapse" data-bs-target="#collapsePengalaman" aria-expanded="true">
                            Tingkat Pengalaman <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="collapse show filter-options" id="collapsePengalaman">
                            <div class="form-check">
                                <input class="form-check-input experience-filter" type="checkbox" name="experience[]" value="belum_pengalaman" id="belumPengalaman">
                                <label class="form-check-label" for="belumPengalaman">Belum memiliki pengalaman</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input experience-filter" type="checkbox" name="experience[]" value="fresh_graduate" id="freshGraduate">
                                <label class="form-check-label" for="freshGraduate">Fresh Graduate</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input experience-filter" type="checkbox" name="experience[]" value="kurang_setahun" id="kurangSetahun">
                                <label class="form-check-label" for="kurangSetahun">Kurang dari setahun</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input experience-filter" type="checkbox" name="experience[]" value="1-3_tahun" id="satuTigaTahun">
                                <label class="form-check-label" for="satuTigaTahun">1-3 tahun</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input experience-filter" type="checkbox" name="experience[]" value="3-5_tahun" id="tigaLimaTahun">
                                <label class="form-check-label" for="tigaLimaTahun">3-5 tahun</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input experience-filter" type="checkbox" name="experience[]" value="5-10_tahun" id="limaSepuluhTahun">
                                <label class="form-check-label" for="limaSepuluhTahun">5-10 tahun</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input experience-filter" type="checkbox" name="experience[]" value="lebih_10_tahun" id="lebihSepuluhTahun">
                                <label class="form-check-label" for="lebihSepuluhTahun">Lebih dari 10 tahun</label>
                            </div>
                        </div>
                    </div>

                    <!-- Pendidikan Filter -->
                    <div class="filter-section">
                        <div class="filter-title" data-bs-toggle="collapse" data-bs-target="#collapsePendidikan" aria-expanded="true">
                            Tingkat Pendidikan <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="collapse show filter-options" id="collapsePendidikan">
                            <div class="form-check">
                                <input class="form-check-input education-filter" type="checkbox" name="education[]" value="sd" id="pendidikanSD">
                                <label class="form-check-label" for="pendidikanSD">SD</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input education-filter" type="checkbox" name="education[]" value="smp" id="pendidikanSMP">
                                <label class="form-check-label" for="pendidikanSMP">SMP</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input education-filter" type="checkbox" name="education[]" value="smk_sma" id="pendidikanSMA">
                                <label class="form-check-label" for="pendidikanSMA">SMK/SMA</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input education-filter" type="checkbox" name="education[]" value="d1-d4" id="pendidikanD1D4">
                                <label class="form-check-label" for="pendidikanD1D4">D1-D4</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input education-filter" type="checkbox" name="education[]" value="s1" id="pendidikanS1">
                                <label class="form-check-label" for="pendidikanS1">S1</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input education-filter" type="checkbox" name="education[]" value="s2" id="pendidikanS2">
                                <label class="form-check-label" for="pendidikanS2">S2</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input education-filter" type="checkbox" name="education[]" value="s3" id="pendidikanS3">
                                <label class="form-check-label" for="pendidikanS3">S3</label>
                            </div>
                        </div>
                    </div>

                    <!-- Terakhir Diperbarui Filter -->
                    <div class="filter-section">
                        <div class="filter-title" data-bs-toggle="collapse" data-bs-target="#collapseUpdate" aria-expanded="true">
                            Terakhir Diperbarui <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="collapse show filter-options" id="collapseUpdate">
                            <div class="form-check">
                                <input class="form-check-input update-filter" type="radio" name="update" value="kapan_pun" id="kapanPun" checked>
                                <label class="form-check-label" for="kapanPun">Kapan pun</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input update-filter" type="radio" name="update" value="sebulan_terakhir" id="sebulanTerakhir">
                                <label class="form-check-label" for="sebulanTerakhir">Sebulan Terakhir</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input update-filter" type="radio" name="update" value="seminggu_terakhir" id="semingguTerakhir">
                                <label class="form-check-label" for="semingguTerakhir">Seminggu Terakhir</label>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Reset Filter saja -->
                    <button type="button" class="btn btn-sm btn-outline-secondary w-100 mt-2" id="resetFilters">
                        <i class="bi bi-arrow-clockwise me-2"></i>Reset Filter
                    </button>
                </div>
            </div>

            {{-- Job List --}}
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">Lowongan Kerja Tersedia</h2>
                    {{-- <div class="text-muted">
                        <span id="jobCount">Menampilkan <strong>{{ $jobs->count() }}</strong> lowongan</span>
                    </div> --}}
                </div>

                {{-- Search Results Alert --}}
                <div class="alert alert-info d-none" id="searchAlert">
                    <i class="bi bi-info-circle me-2"></i>
                    <span id="alertText"></span>
                </div>

                {{-- DYNAMIC JOBS --}}
                <div id="jobResults">
                    @if($jobs->count())
                        @foreach($jobs as $job)
                            @php
                                // Format data dari CompaniesJob
                                $job->formatted_salary = isset($job->formatted_salary) ? $job->formatted_salary : 'Gaji Tidak Ditampilkan';
                                $job->skills_list = isset($job->skills_list) ? $job->skills_list : [];
                                $job->location_string = isset($job->location_string) ? $job->location_string : 'Lokasi Tidak Diketahui';
                                $job->formatted_education = isset($job->formatted_education) ? $job->formatted_education : ($job->education_level ?? 'Tidak Diketahui');
                            @endphp
                            
<div class="job-card @if($job->has_applied) job-applied @endif position-relative"                                 
    data-job-type="{{ $job->employment_type ?? '' }}" 
                                 data-work-policy="{{ $job->work_mode ?? '' }}" 
                                 data-experience="{{ $job->experience ?? '' }}" 
                                 data-education="{{ $job->education_level ?? '' }}">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex align-items-start flex-grow-1">
                                        {{-- Logo Perusahaan --}}
                                        <div class="me-3" style="flex: 0 0 80px;">
                                            @if($job->company_logo && Storage::disk('public')->exists($job->company_logo))
                                                <img src="{{ asset('storage/' . $job->company_logo) }}" 
                                                     alt="Logo {{ $job->company_name }}" 
                                                     class="company-logo"
                                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                                <div class="logo-placeholder" style="display: none;">
                                                    <span>{{ substr($job->company_name, 0, 2) }}</span>
                                                </div>
                                            @else
                                                <div class="logo-placeholder">
                                                    <span>{{ substr($job->company_name, 0, 2) }}</span>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="flex-grow-1">
                                            <div class="job-title">
<a href="{{ route('jobs.show', $job->id) }}" class="text-decoration-none text-dark stretched-link">{{ $job->title }}</a>                                                @if($job->created_at && $job->created_at->greaterThan(\Carbon\Carbon::now()->subDays(3)))
                                                    <span class="badge bg-success ms-2">Baru</span>
                                                @endif
                                                {{-- Jika ada field is_featured di CompaniesJob --}}
                                                @if($job->is_featured ?? false)
                                                    <span class="badge bg-danger ms-1">Featured</span>
                                                @endif
                                            </div>
                                            <p class="text-muted mb-1">
                                                <i class="bi bi-building me-1"></i>{{ $job->company_name }}
                                                @if($job->industry)
                                                    - <i class="bi bi-briefcase me-1"></i>{{ $job->industry }}
                                                @endif
                                                <br>
                                                <i class="bi bi-geo-alt me-1"></i>{{ $job->location_string }}
                                            </p>

                                            <p class="salary mb-1">
                                                <i class="bi bi-currency-dollar me-1"></i>
                                                {{ $job->formatted_salary }}
                                            </p>

                                            <p class="mb-1 text-muted small">
                                                @if($job->employment_type)
                                                    <span class="me-2">
                                                        <span class="badge bg-info text-dark">
                                                            {{ ucfirst(str_replace('_', ' ', $job->employment_type)) }}
                                                        </span>
                                                    </span>
                                                @endif
                                                @if($job->work_mode)
                                                    <span class="me-2">
                                                        <span class="badge bg-warning text-dark">
                                                            @if($job->work_mode == 'kerja_di_kantor')
                                                                Kantor
                                                            @elseif($job->work_mode == 'remote')
                                                                Remote
                                                            @elseif($job->work_mode == 'hybrid')
                                                                Hybrid
                                                            @else
                                                                {{ ucfirst($job->work_mode) }}
                                                            @endif
                                                        </span>
                                                    </span>
                                                @endif
                                                @if($job->job_level)
                                                    <span class="me-2">
                                                        <span class="badge bg-secondary text-white">{{ $job->job_level }}</span>
                                                    </span>
                                                @endif
                                            </p>

                                            @if($job->description)
                                                <p class="mb-1">
                                                    <strong>Deskripsi:</strong>
                                                    {!! \Illuminate\Support\Str::limit(e($job->description), 120) !!}
                                                </p>
                                            @endif

                                            @if($job->skills_list && count($job->skills_list) > 0)
                                                <div class="skills mt-2">
                                                    @foreach($job->skills_list as $skill)
                                                        @if(trim($skill))
                                                            <span>{{ trim($skill) }}</span>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @elseif($job->skills && is_string($job->skills))
                                                <div class="skills mt-2">
                                                    @foreach(explode(',', $job->skills) as $skill)
                                                        @if(trim($skill))
                                                            <span>{{ trim($skill) }}</span>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="skills mt-2">
                                                    <span class="text-muted">Tidak ada keterampilan spesifik</span>
                                                </div>
                                            @endif

                                            <p class="text-muted small mt-2">
                                                @if($job->created_at && $job->created_at->greaterThan(\Carbon\Carbon::now()->subDays(7)))
                                                    <span class="badge bg-success me-2">Baru untuk kamu</span>
                                                @endif
                                                <i class="bi bi-calendar3 me-1"></i>Tayang {{ $job->created_at ? $job->created_at->diffForHumans() : '' }}
                                                @if($job->updated_at && $job->updated_at != $job->created_at)
                                                    · Diperbarui {{ $job->updated_at->diffForHumans() }}
                                                @endif
                                              
                                            </p>
                                        </div>
                                    </div>

                                   <div class="d-flex align-items-center ms-3">

    @if($job->has_applied)
        <span class="badge bg-success">Sudah Dilamar</span>
    @else
        <a href="{{ route('jobs.show', $job->id) }}" class="apply-btn">Lamar</a>
    @endif

</div>

                                </div>
                            </div>
                        @endforeach

                        {{-- Pagination (preserve query string) --}}
                        {{-- <div class="mt-4">
                            {{ $jobs->appends(request()->query())->links('pagination::bootstrap-5') }}
                        </div> --}}
                    
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-search display-1 text-muted"></i>
                            <h4 class="mt-3 text-muted">Tidak ada lowongan yang ditemukan</h4>
                            <p class="text-muted">Coba ubah kriteria pencarian atau filter Anda</p>
                            <a href="{{ route('jobs.index') }}" class="btn btn-primary mt-2">Reset Pencarian</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- 2. IMPORT FOOTER --}}
    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elements
            const searchForm = document.getElementById('searchForm');
            const resetFiltersBtn = document.getElementById('resetFilters');
            const jobCards = document.querySelectorAll('.job-card');
            const jobResults = document.getElementById('jobResults');
            const searchAlert = document.getElementById('searchAlert');
            const alertText = document.getElementById('alertText');
            const jobCount = document.getElementById('jobCount');
            const klasifikasiText = document.getElementById('klasifikasiText');
            
            // Filter elements
            const jobTypeFilters = document.querySelectorAll('.job-type-filter');
            const workPolicyFilters = document.querySelectorAll('.work-policy-filter');
            const experienceFilters = document.querySelectorAll('.experience-filter');
            const educationFilters = document.querySelectorAll('.education-filter');
            const updateFilters = document.querySelectorAll('.update-filter');

            // Klasifikasi dropdown items
            const klasifikasiItems = document.querySelectorAll('.dropdown-item[data-value]');
            let selectedKlasifikasi = null;
            
            klasifikasiItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    const value = this.getAttribute('data-value');
                    const text = this.textContent;
                    
                    selectedKlasifikasi = value;
                    klasifikasiText.textContent = text;
                    
                    filterJobs();
                });
            });

            // Filter functionality
            function filterJobs() {
                const selectedJobTypes = getSelectedValues(jobTypeFilters);
                const selectedWorkPolicies = getSelectedValues(workPolicyFilters);
                const selectedExperiences = getSelectedValues(experienceFilters);
                const selectedEducations = getSelectedValues(educationFilters);
                const selectedUpdate = getSelectedRadioValue(updateFilters);
                
                let visibleCount = 0;

                jobCards.forEach(card => {
                    const jobType = card.getAttribute('data-job-type') || '';
                    const workPolicy = card.getAttribute('data-work-policy') || '';
                    const experience = card.getAttribute('data-experience') || '';
                    const education = card.getAttribute('data-education') || '';
                    
                    // Klasifikasi filtering (by industry or other criteria)
                    let matchesKlasifikasi = true;
                    if (selectedKlasifikasi) {
                        // Implement klasifikasi filtering logic here
                        // For example, check if job matches selected industry/category
                        matchesKlasifikasi = true; // Default to true for now
                    }
                    
                    const matchesJobType = selectedJobTypes.length === 0 || selectedJobTypes.includes(jobType);
                    const matchesWorkPolicy = selectedWorkPolicies.length === 0 || selectedWorkPolicies.includes(workPolicy);
                    const matchesExperience = selectedExperiences.length === 0 || selectedExperiences.includes(experience);
                    const matchesEducation = selectedEducations.length === 0 || selectedEducations.includes(education);
                    
                    // Apply time filter if needed
                    let matchesTime = true;
                    if (selectedUpdate === 'seminggu_terakhir') {
                        // Check if job was updated in the last week
                        // This would require job data to have timestamps
                        matchesTime = true;
                    } else if (selectedUpdate === 'sebulan_terakhir') {
                        // Check if job was updated in the last month
                        matchesTime = true;
                    }
                    
                    if (matchesKlasifikasi && matchesJobType && matchesWorkPolicy && matchesExperience && matchesEducation && matchesTime) {
                        card.style.display = 'block';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                updateResultsDisplay(visibleCount);
            }

            function getSelectedValues(checkboxes) {
                return Array.from(checkboxes)
                    .filter(cb => cb.checked)
                    .map(cb => cb.value);
            }

            function getSelectedRadioValue(radios) {
                const selected = Array.from(radios).find(radio => radio.checked);
                return selected ? selected.value : null;
            }

            function updateResultsDisplay(visibleCount) {
                if (visibleCount === 0) {
                    searchAlert.classList.remove('d-none');
                    alertText.textContent = 'Tidak ada lowongan yang sesuai dengan filter yang dipilih';
                } else {
                    const activeFilters = document.querySelectorAll('.filter-options input:checked').length;
                    // if (activeFilters > 0 || selectedKlasifikasi) {
                    //     alertText.textContent = `Menampilkan ${visibleCount} lowongan berdasarkan filter yang dipilih`;
                    //     searchAlert.classList.remove('d-none');
                    // } else {
                    //     searchAlert.classList.add('d-none');
                    // }
                }
                
                jobCount.innerHTML = `Menampilkan <strong>${visibleCount}</strong> lowongan`;
            }

            // Reset functionality
            function resetAllFilters() {
                // Reset checkboxes
                document.querySelectorAll('.filter-options input[type="checkbox"]').forEach(cb => {
                    cb.checked = false;
                });
                
                // Reset radio buttons
                document.querySelectorAll('.filter-options input[type="radio"]').forEach((radio, index) => {
                    radio.checked = index === 0;
                });
                
                // Reset klasifikasi
                selectedKlasifikasi = null;
                klasifikasiText.textContent = 'Semua kategori';
                
                // Show all jobs
                jobCards.forEach(card => card.style.display = 'block');
                updateResultsDisplay(jobCards.length);
                
                searchAlert.classList.add('d-none');
            }

            // Event listeners untuk filter otomatis
            jobTypeFilters.forEach(filter => {
                filter.addEventListener('change', filterJobs);
            });
            
            workPolicyFilters.forEach(filter => {
                filter.addEventListener('change', filterJobs);
            });
            
            experienceFilters.forEach(filter => {
                filter.addEventListener('change', filterJobs);
            });
            
            educationFilters.forEach(filter => {
                filter.addEventListener('change', filterJobs);
            });
            
            updateFilters.forEach(filter => {
                filter.addEventListener('change', filterJobs);
            });

            // Reset event listener
            resetFiltersBtn.addEventListener('click', resetAllFilters);

            // Real-time search filtering
            const keywordInput = document.getElementById('keywordInput');
            const locationInput = document.getElementById('locationInput');
            
            function performSearch() {
                const keyword = keywordInput.value.toLowerCase();
                const location = locationInput.value.toLowerCase();
                
                let visibleCount = 0;
                
                jobCards.forEach(card => {
                    const title = card.querySelector('.job-title').textContent.toLowerCase();
                    const company = card.querySelector('.text-muted').textContent.toLowerCase();
                    const description = card.querySelector('p.mb-1')?.textContent.toLowerCase() || '';
                    
                    const matchesKeyword = !keyword || title.includes(keyword) || company.includes(keyword) || description.includes(keyword);
                    const matchesLocation = !location || company.includes(location) || card.textContent.toLowerCase().includes(location);
                    
                    if (matchesKeyword && matchesLocation) {
                        card.style.display = 'block';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });
                
                updateResultsDisplay(visibleCount);
                
                // Show search alert if keyword or location is used
                if (keyword || location) {
                    alertText.textContent = `Menampilkan ${visibleCount} lowongan untuk pencarian "${keyword || ''}" ${location ? `di ${location}` : ''}`;
                    searchAlert.classList.remove('d-none');
                }
            }
            
            // Debounce search function
            let searchTimeout;
            function debounceSearch() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(performSearch, 300);
            }
            
            keywordInput.addEventListener('input', debounceSearch);
            locationInput.addEventListener('input', debounceSearch);

            // Initialize
            updateResultsDisplay(jobCards.length);
        });
    </script>
</body>
</html>