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
        .job-card:hover { transform: translateY(-3px); box-shadow: 0 4px 10px rgba(0,0,0,0.15); }
        .job-title { font-size: 1.2rem; font-weight: bold; color: #333; }
        .salary { color: #0d6efd; font-weight: bold; }
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

                /* WhatsApp Floating Button - Functional */
        .whatsapp-float {
            position: fixed;
            bottom: 80px; /* Dinaikkan dari 25px menjadi 80px */
            right: 25px;
            z-index: 1000;
        }

        .whatsapp-link {
            display: block;
            text-decoration: none;
            transition: transform 0.2s ease;
        }

        .whatsapp-logo {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .whatsapp-link:hover {
            transform: scale(1.05);
        }

        /* Responsive WhatsApp */
        @media (max-width: 768px) {
            .whatsapp-float {
                bottom: 70px; /* Dinaikkan dari 20px menjadi 70px */
                right: 20px;
            }

            .whatsapp-logo {
                width: 55px;
                height: 55px;
            }
        }

        @media (max-width: 576px) {
            .whatsapp-float {
                bottom: 60px; /* Dinaikkan dari 15px menjadi 60px */
                right: 15px;
            }

            .whatsapp-logo {
                width: 50px;
                height: 50px;
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
                    <label class="search-label">Kategori</label>
                    <div class="dropdown w-100">
    <button class="btn dropdown-toggle w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="dropdownKlasifikasi">
        <span id="klasifikasiText">Semua kategori</span>
        <i class="bi bi-chevron-down"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-scrollable w-100" aria-labelledby="dropdownKlasifikasi">


        {{-- Kategori Baru Ditambahkan di Sini --}}
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
{{-- Akhir Kategori Baru --}}

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

            {{-- <div class="search-options-wrapper">
                <a href="#" class="more-options" id="moreOptionsToggle">Opsi lainnya <i class="bi bi-sliders"></i></a>
            </div> --}}
        </div>
    </section>

    {{-- === Main Content === --}}
    <div class="container my-4">
        <div class="row">

            {{-- Sidebar Filter --}}
            <div class="col-lg-3 mb-4">
                <div class="sidebar">
                    <div class="page-header-sidebar">Filter Pekerjaan</div>

                    <!-- Prioritaskan Filter -->
                    <div class="filter-section">
                        <div class="filter-title" data-bs-toggle="collapse" data-bs-target="#collapsePrioritas" aria-expanded="true">
                            Prioritaskan <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="collapse show" id="collapsePrioritas">

                        </div>
                    </div>

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
                    <div class="text-muted">
                        <span id="jobCount">Menampilkan <strong>{{ $jobs->count() ?? 2 }}</strong> lowongan</span>
                    </div>
                </div>

                {{-- Search Results Alert --}}
                <div class="alert alert-info d-none" id="searchAlert">
                    <i class="bi bi-info-circle me-2"></i>
                    <span id="alertText"></span>
                </div>

                {{-- DYNAMIC JOBS --}}
                <div id="jobResults">
                    @if(isset($jobs) && $jobs->count())
                        @foreach($jobs as $job)
                            <div class="job-card" data-job-type="{{ $job->type }}" data-work-policy="{{ $job->work_policy ?? 'office' }}" data-experience="{{ $job->experience_level }}" data-education="{{ $job->education_level }}">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex align-items-start flex-grow-1">
                                        {{-- Logo Perusahaan --}}
                                        <div class="me-3" style="flex: 0 0 80px;">
                                            @if($job->company_logo && Storage::disk('public')->exists($job->company_logo))
                                                <img src="{{ asset('storage/' . $job->company_logo) }}"
                                                     alt="Logo {{ $job->company }}"
                                                     class="company-logo"
                                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                                <div class="logo-placeholder" style="display: none;">
                                                    <span>{{ substr($job->company, 0, 2) }}</span>
                                                </div>
                                            @else
                                                <div class="logo-placeholder">
                                                    <span>{{ substr($job->company, 0, 2) }}</span>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="flex-grow-1">
                                            <div class="job-title">
                                                <a href="{{ route('jobs.show', $job->id) }}" class="text-decoration-none text-dark">{{ $job->title }}</a>
                                                @if($job->created_at && $job->created_at->greaterThan(\Carbon\Carbon::now()->subDays(3)))
                                                    <span class="badge bg-success ms-2">Baru</span>
                                                @endif
                                                @if($job->is_featured ?? false)
                                                    <span class="badge bg-danger ms-1">Featured</span>
                                                @endif
                                            </div>
                                            <p class="text-muted mb-1">
                                                <i class="bi bi-building me-1"></i>{{ $job->company }} -
                                                <i class="bi bi-geo-alt me-1 ms-2"></i>
                                                {{-- Tampilkan lokasi lengkap --}}
                                                @if($job->full_location && $job->full_location != 'Lokasi tidak tersedia')
                                                    {{ $job->full_location }}
                                                @elseif($job->province && $job->regency)
                                                    {{ $job->province->name }}, {{ $job->regency->name }}
                                                @elseif($job->province)
                                                    {{ $job->province->name }}
                                                @else
                                                    Lokasi tidak tersedia
                                                @endif
                                            </p>

                                            <p class="salary mb-1">
                                                <i class="bi bi-currency-dollar me-1"></i>
                                                {{ $job->salary_formatted ?? 'Gaji tidak ditampilkan' }}
                                            </p>

                                            <p class="mb-1 text-muted small">
                                                <span class="me-2"><span class="badge bg-info text-dark">{{ ucfirst($job->type) }}</span></span>
                                                <span class="me-2">
                                                    <span class="badge bg-warning text-dark">
                                                        @if($job->work_policy == 'kerja_di_kantor')
                                                            Kantor
                                                        @elseif($job->work_policy == 'remote')
                                                            Remote
                                                        @elseif($job->work_policy == 'hybrid')
                                                            Hybrid
                                                        @else
                                                            Office
                                                        @endif
                                                    </span>
                                                </span>
                                                <i class="bi bi-clock me-1"></i>Deadline: {{ $job->deadline ? \Carbon\Carbon::parse($job->deadline)->format('d M Y') : 'Tidak ada' }}
                                            </p>

                                            <p class="mb-1">
                                                <strong>Persyaratan:</strong>
                                                {!! \Illuminate\Support\Str::limit(e($job->description ?? 'Tidak ada deskripsi'), 120) !!}
                                            </p>

                                            <div class="skills mt-2">
                                                @if($job->skills)
                                                    @foreach(explode(',', $job->skills) as $skill)
                                                        @if(trim($skill))
                                                            <span>{{ trim($skill) }}</span>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <span class="text-muted">Tidak ada keterampilan spesifik</span>
                                                @endif
                                            </div>

                                            <p class="text-muted small mt-2">
                                                @if($job->created_at && $job->created_at->greaterThan(\Carbon\Carbon::now()->subDays(7)))
                                                    <span class="badge bg-success me-2">Baru untuk kamu</span>
                                                @endif
                                                <i class="bi bi-calendar3 me-1"></i>Tayang {{ $job->created_at ? $job->created_at->diffForHumans() : '' }}
                                                · Diperbarui {{ $job->updated_at ? $job->updated_at->diffForHumans() : '' }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center ms-3">
                                        <a href="{{ route('jobs.show', $job->id) }}" class="apply-btn">Lamar</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{-- Pagination (preserve query string) --}}
                        <div class="mt-4">
                            {{ $jobs->appends(request()->query())->links('pagination::bootstrap-5') }}
                        </div>

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

         <!-- INTEGRASI WHATSAPP YANG BERFUNGSI -->
    <div class="whatsapp-float">
        <a href="https://wa.me/6282115179879?text=Halo%2C%20saat%20ini%20saya%20sedang%20mengakses%20website%20Inotal%20dan%20saya%20butuh%20bantuan"
        target="_blank"
        rel="noopener noreferrer"
        class="whatsapp-link">
            <img src="{{ asset('images/whatsapp.png') }}" alt="Chat via WhatsApp" class="whatsapp-logo">
        </a>
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
            const noResults = document.getElementById('noResults');
            const searchAlert = document.getElementById('searchAlert');
            const alertText = document.getElementById('alertText');
            const jobCount = document.getElementById('jobCount');
            const categoryCheckboxes = document.querySelectorAll('.category-checkbox');
            const klasifikasiText = document.getElementById('klasifikasiText');

            // Priority buttons
            const priorityButtons = document.querySelectorAll('.priority-btn');

            // Filter elements
            const jobTypeFilters = document.querySelectorAll('.job-type-filter');
            const workPolicyFilters = document.querySelectorAll('.work-policy-filter');
            const experienceFilters = document.querySelectorAll('.experience-filter');
            const educationFilters = document.querySelectorAll('.education-filter');
            const updateFilters = document.querySelectorAll('.update-filter');

            // Update klasifikasi text based on selected categories
            categoryCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateKlasifikasiText();
                    filterJobs(); // Filter otomatis saat checkbox berubah
                });
            });

            function updateKlasifikasiText() {
                const selectedCategories = Array.from(categoryCheckboxes)
                    .filter(cb => cb.checked)
                    .map(cb => cb.parentElement.querySelector('span').textContent);

                if (selectedCategories.length === 0) {
                    klasifikasiText.textContent = 'Semua kategori';
                } else if (selectedCategories.length === 1) {
                    klasifikasiText.textContent = selectedCategories[0];
                } else {
                    klasifikasiText.textContent = `${selectedCategories[0]} +${selectedCategories.length - 1}`;
                }
            }

            // Priority button functionality
            priorityButtons.forEach(button => {
                button.addEventListener('click', function() {
                    priorityButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    filterJobs(); // Filter otomatis saat prioritas berubah
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
                    const jobType = card.getAttribute('data-job-type');
                    const workPolicy = card.getAttribute('data-work-policy');
                    const experience = card.getAttribute('data-experience');
                    const education = card.getAttribute('data-education');

                    const matchesJobType = selectedJobTypes.length === 0 || selectedJobTypes.includes(jobType);
                    const matchesWorkPolicy = selectedWorkPolicies.length === 0 || selectedWorkPolicies.includes(workPolicy);
                    const matchesExperience = selectedExperiences.length === 0 || selectedExperiences.includes(experience);
                    const matchesEducation = selectedEducations.length === 0 || selectedEducations.includes(education);

                    if (matchesJobType && matchesWorkPolicy && matchesExperience && matchesEducation) {
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
                    jobResults.style.display = 'none';
                    if (noResults) noResults.classList.remove('d-none');
                    searchAlert.classList.add('d-none');
                } else {
                    jobResults.style.display = 'block';
                    if (noResults) noResults.classList.add('d-none');

                    // Show alert if filters are active
                    const activeFilters = document.querySelectorAll('.filter-options input:checked');
                    if (activeFilters.length > 0) {
                        alertText.textContent = `Menampilkan ${visibleCount} lowongan berdasarkan filter yang dipilih`;
                        searchAlert.classList.remove('d-none');
                    } else {
                        searchAlert.classList.add('d-none');
                    }
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

                // Reset category checkboxes
                categoryCheckboxes.forEach(cb => cb.checked = false);
                updateKlasifikasiText();

                // Reset priority buttons
                priorityButtons.forEach((btn, index) => {
                    btn.classList.toggle('active', index === 0);
                });

                // Reset search form
                document.getElementById('keywordInput').value = '';
                document.getElementById('locationInput').value = '';

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

            // Reset event listeners
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
                    const matchesLocation = !location || company.includes(location);

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
            updateKlasifikasiText();
            updateResultsDisplay(jobCards.length);
        });
    </script>
</body>
</html>
