<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talenthub</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body { background: #f8f9fa; }

        /* === Search Header === */
        .search-header {
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
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
            border-left: 4px solid #e6007e;
        }
        .job-card:hover { transform: translateY(-3px); box-shadow: 0 4px 10px rgba(0,0,0,0.15); }
        .job-title { font-size: 1.2rem; font-weight: bold; color: #333; }
        .salary { color: #0d6efd; font-weight: bold; }
        .skills span { display: inline-block; background: #e9ecef; border-radius: 20px; padding: 4px 12px; font-size: 0.85rem; margin: 2px; }
        .apply-btn { background: #0d6efd; color: #fff; font-weight: bold; padding: 6px 20px; border-radius: 5px; text-decoration: none; transition: all 0.3s; }
        .apply-btn:hover { background: #0b5ed7; color: #fff; transform: scale(1.05); }

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
        .filter-title:hover { color: #e6007e; }
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
            border-bottom: 2px solid #e6007e;
        }
        
        /* Badge styles */
        .badge-new { background: #28a745; }
        .badge-featured { background: #e6007e; }
        
        /* Logo styles */
        .logo-container {
            width: 80px;
            flex: 0 0 80px;
        }
        .logo-image {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }
        .logo-placeholder {
            width: 80px;
            height: 80px;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .search-header { padding: 2rem 0; }
            .sidebar { position: static; margin-bottom: 20px; }
        }
    </style>
</head>
<body>

    {{-- 1. IMPORT NAVBAR --}}
    @include('partials.navbar')

    {{-- === Search Header === --}}
    <section class="search-header" data-background="{{ asset('images/Header.png') }}">
        <div class="container">
            {{-- SEARCH FORM - method GET supaya query muncul di URL --}}
            <form class="row g-2 align-items-end search-box" method="GET" action="{{ route('jobs.index') }}" id="searchForm">
                <div class="col-12 col-md-4">
                    <label class="search-label">Pemagangan apa?</label>
                    <input name="q" type="text" class="form-control input-keyword" placeholder="Masukkan kata kunci" value="{{ request('q') }}" id="keywordInput">
                </div>

                <div class="col-12 col-md-3">
                    <label class="search-label">Klasifikasi</label>
                    <div class="dropdown w-100">
                        <button class="btn dropdown-toggle w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="dropdownKlasifikasi">
                            <span id="klasifikasiText">Semua klasifikasi</span>
                            <i class="bi bi-chevron-down"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-scrollable w-100" aria-labelledby="dropdownKlasifikasi">
                            <li>
                                <label class="dropdown-item dropdown-item-custom">
                                    <div>
                                        <input type="checkbox" class="form-check-input me-2 category-checkbox" name="categories[]" value="devops" id="devOps-infrastructure">
                                        <span>DevOps & Infrastructure</span>
                                    </div>
                                    <span class="count">1,248</span>
                                </label>
                            </li>
                            <li>
                                <label class="dropdown-item dropdown-item-custom">
                                    <div>
                                        <input type="checkbox" class="form-check-input me-2 category-checkbox" name="categories[]" value="analyst" id="analyst-consultant">
                                        <span>Analyst & Consultant</span>
                                    </div>
                                    <span class="count">5,677</span>
                                </label>
                            </li>
                            <li>
                                <label class="dropdown-item dropdown-item-custom">
                                    <div>
                                        <input type="checkbox" class="form-check-input me-2 category-checkbox" name="categories[]" value="design" id="design-ux">
                                        <span>Design & UX</span>
                                    </div>
                                    <span class="count">3,421</span>
                                </label>
                            </li>
                            <li>
                                <label class="dropdown-item dropdown-item-custom">
                                    <div>
                                        <input type="checkbox" class="form-check-input me-2 category-checkbox" name="categories[]" value="marketing" id="marketing-sales">
                                        <span>Marketing & Sales</span>
                                    </div>
                                    <span class="count">4,892</span>
                                </label>
                            </li>
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

            <div class="search-options-wrapper">
                <a href="#" class="more-options" id="moreOptionsToggle">Opsi lainnya <i class="bi bi-sliders"></i></a>
            </div>
        </div>
    </section>

    {{-- === Main Content === --}}
    <div class="container my-4">
        <div class="row">

            {{-- Sidebar Filter --}}
            <div class="col-lg-3 mb-4">
                <div class="sidebar">
                    <div class="page-header-sidebar">Filter Pemagangan</div>

                    <!-- Prioritaskan Filter -->
                    <div class="filter-section">
                        <div class="filter-title" data-bs-toggle="collapse" data-bs-target="#collapsePrioritas" aria-expanded="true">
                            Prioritaskan <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="collapse show" id="collapsePrioritas">
                            <div class="d-flex flex-wrap">
                                <button type="button" class="priority-btn active" data-priority="relevan">Paling Relevan</button>
                                <button type="button" class="priority-btn" data-priority="baru">Baru Ditambahkan</button>
                            </div>
                        </div>
                    </div>

                    <!-- Tipe Pekerjaan Filter -->
                    <div class="filter-section">
                        <div class="filter-title" data-bs-toggle="collapse" data-bs-target="#collapseTipePemagangan" aria-expanded="true">
                            Jenis Pemagangan <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="collapse show filter-options" id="collapseTipePemagangan">
                            <div class="form-check">
                                <input class="form-check-input job-type-filter" type="checkbox" name="job_types[]" value="full-time" id="tipePenuhWaktu">
                                <label class="form-check-label" for="tipePenuhWaktu">Full-time</label>
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
                            Kebijakan Pemagangan <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="collapse show filter-options" id="collapseKebijakanKerja">
                            <div class="form-check">
                                <input class="form-check-input work-policy-filter" type="checkbox" name="work_policies[]" value="magang_di_kantor" id="kantor">
                                <label class="form-check-label" for="kantor">Magang di Kantor</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input work-policy-filter" type="checkbox" name="work_policies[]" value="hybrid" id="hybrid">
                                <label class="form-check-label" for="hybrid">Hybrid</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input work-policy-filter" type="checkbox" name="work_policies[]" value="remote" id="remote">
                                <label class="form-check-label" for="remote">Remote</label>
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

                    <button type="button" class="btn btn-sm btn-primary w-100 mt-2" id="applyFilters">
                        <i class="bi bi-funnel me-2"></i>Terapkan Filter
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary w-100 mt-2" id="resetFilters">
                        <i class="bi bi-arrow-clockwise me-2"></i>Reset Filter
                    </button>
                </div>
            </div>

            {{-- Job List --}}
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">Lowongan Pemagangan Tersedia</h2>
                    <div class="text-muted">
                        <span id="jobCount">Menampilkan lowongan</span>
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
                            <div class="job-card" 
                                 data-job-type="{{ $job->type ?? 'internship' }}" 
                                 data-work-policy="{{ $job->work_policy ?? 'magang_di_kantor' }}" 
                                 data-experience="{{ $job->experience_level ?? 'belum_pengalaman' }}" 
                                 data-education="{{ $job->education_level ?? 'smk_sma' }}"
                                 data-keywords="{{ strtolower($job->title . ' ' . $job->company . ' ' . $job->location) }}">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex align-items-start flex-grow-1">
                                        {{-- Logo --}}
                                        <div class="me-3 logo-container">
                                            @if(!empty($job->company_logo))
                                                <img src="{{ $job->logo_url }}" alt="Logo {{ $job->company }}" class="rounded logo-image">
                                            @else
                                                <div class="bg-light border rounded d-flex align-items-center justify-content-center logo-placeholder">
                                                    <span class="text-muted small">No Logo</span>
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
                                                    <span class="badge badge-featured ms-1">Featured</span>
                                                @endif
                                            </div>
                                            <p class="text-muted mb-1">
                                                <i class="bi bi-building me-1"></i>{{ $job->company ?? 'Perusahaan' }} - 
                                                <i class="bi bi-geo-alt me-1 ms-2"></i>{{ $job->location ?? 'Lokasi tidak tersedia' }}
                                            </p>

                                            <p class="salary mb-1">
                                                <i class="bi bi-currency-dollar me-1"></i>
                                                {{ $job->formatted_salary ?? 'Gaji tidak ditampilkan' }}
                                            </p>

                                            <p class="mb-1 text-muted small">
                                                <span class="me-2"><span class="badge bg-info text-dark">{{ ucfirst($job->type ?? 'internship') }}</span></span>
                                                <span class="me-2"><span class="badge bg-warning text-dark">{{ ucfirst($job->work_policy ?? 'Office') }}</span></span>
                                                <i class="bi bi-clock me-1"></i>Deadline: {{ $job->deadline ? \Carbon\Carbon::parse($job->deadline)->format('d M Y') : 'Tidak ada' }}
                                            </p>

                                            <p class="mb-1">
                                                <strong>Persyaratan:</strong>
                                                {!! \Illuminate\Support\Str::limit(e($job->description ?? 'Tidak ada deskripsi'), 120) !!}
                                            </p>

                                            <div class="skills mt-2">
                                                @if($job->skills)
                                                    @foreach(explode(',', $job->skills) as $skill)
                                                        <span>{{ trim($skill) }}</span>
                                                    @endforeach
                                                @endif
                                            </div>

                                            <p class="text-muted small mt-2">
                                                @if($job->created_at && $job->created_at->greaterThan(\Carbon\Carbon::now()->subDays(7)))
                                                    <span class="badge bg-success me-2">Baru untuk kamu</span>
                                                @endif
                                                <i class="bi bi-calendar3 me-1"></i>Tayang {{ $job->created_at ? $job->created_at->diffForHumans() : '' }}
                                                @if($job->updated_at && $job->updated_at->ne($job->created_at))
                                                    · Diperbarui {{ $job->updated_at->diffForHumans() }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center ms-3">
                                        <a href="{{ route('jobs.show', $job->id) }}" class="apply-btn">Lamar</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{-- Pagination --}}
                        <div class="mt-4">
                            {{ $jobs->appends(request()->query())->links('pagination::bootstrap-5') }}
                        </div>
                    @else
                        {{-- Sample job cards --}}
                        <div class="job-card" data-job-type="internship" data-work-policy="magang_di_kantor" data-experience="belum_pengalaman" data-education="smk_sma" data-keywords="talent host live aquila indramayu jawa barat">
                            <div class="d-flex justify-content-between">
                                <div class="flex-grow-1">
                                    <div class="job-title">Talent Host Live</div>
                                    <p class="text-muted mb-1"><i class="bi bi-building me-1"></i>Aquila - <i class="bi bi-geo-alt me-1 ms-2"></i>Indramayu, Jawa Barat</p>
                                    <p class="salary"><i class="bi bi-currency-dollar me-1"></i>Rp 3 jt - 3,5 jt</p>
                                    <p class="mb-1 text-muted small">
                                        <span class="me-2"><span class="badge bg-info text-dark">Internship</span></span>
                                        <span class="me-2"><span class="badge bg-warning text-dark">Magang di Kantor</span></span>
                                    </p>
                                    <p class="mb-1">
                                        <strong>Persyaratan:</strong> Kerja di kantor · Belum memiliki pengalaman · Minimal SMA/SMK · 20-30 tahun · Perempuan saja
                                    </p>
                                    <div class="skills">
                                        <span>Teamwork</span>
                                        <span>Public Speaking</span>
                                        <span>Communicative</span>
                                    </div>
                                    <p class="text-muted small mt-2"><i class="bi bi-calendar3 me-1"></i>Tayang 4 bulan lalu · Diperbarui 9 hari lalu</p>
                                </div>
                                <div class="d-flex align-items-center ms-3">
                                    <a href="#" class="apply-btn">Lamar</a>
                                </div>
                            </div>
                        </div>

                        <div class="job-card" data-job-type="internship" data-work-policy="hybrid" data-experience="fresh_graduate" data-education="s1" data-keywords="video editor perusahaan premium jakarta">
                            <div class="d-flex justify-content-between">
                                <div class="flex-grow-1">
                                    <div class="job-title">Video Editor</div>
                                    <p class="text-muted mb-1"><i class="bi bi-building me-1"></i>Perusahaan Premium - <i class="bi bi-geo-alt me-1 ms-2"></i>Jakarta</p>
                                    <p class="salary"><i class="bi bi-currency-dollar me-1"></i>Gaji Tidak Ditampilkan</p>
                                    <p class="mb-1 text-muted small">
                                        <span class="me-2"><span class="badge bg-info text-dark">Internship</span></span>
                                        <span class="me-2"><span class="badge bg-warning text-dark">Hybrid</span></span>
                                    </p>
                                    <p class="mb-1">
                                        <strong>Persyaratan:</strong> Hybrid · Fresh Graduate · Minimal S1
                                    </p>
                                    <div class="skills">
                                        <span>Editing</span>
                                        <span>Creativity</span>
                                        <span>Teamwork</span>
                                    </div>
                                    <p class="text-muted small mt-2"><i class="bi bi-calendar3 me-1"></i>Tayang 2 minggu lalu · Diperbarui 3 hari lalu</p>
                                </div>
                                <div class="d-flex align-items-center ms-3">
                                    <a href="#" class="apply-btn">Lamar</a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- No Results Message --}}
                <div class="text-center py-5 d-none" id="noResults">
                    <i class="bi bi-search display-1 text-muted"></i>
                    <h4 class="mt-3 text-muted">Tidak ada lowongan yang ditemukan</h4>
                    <p class="text-muted">Coba ubah kriteria pencarian atau filter Anda</p>
                    <button class="btn btn-primary mt-2" id="resetSearch">Reset Pencarian</button>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. IMPORT FOOTER --}}
    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Apply background image from data attribute
            const searchHeader = document.querySelector('.search-header[data-background]');
            if (searchHeader) {
                const bgUrl = searchHeader.getAttribute('data-background');
                searchHeader.style.backgroundImage = `url('${bgUrl}')`;
            }
            
            // Elements
            const searchForm = document.getElementById('searchForm');
            const applyFiltersBtn = document.getElementById('applyFilters');
            const resetFiltersBtn = document.getElementById('resetFilters');
            const resetSearchBtn = document.getElementById('resetSearch');
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

            // Initialize
            updateKlasifikasiText();
            updateResultsDisplay(jobCards.length);

            // Update klasifikasi text based on selected categories
            categoryCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateKlasifikasiText);
            });

            function updateKlasifikasiText() {
                const selectedCategories = Array.from(categoryCheckboxes)
                    .filter(cb => cb.checked)
                    .map(cb => cb.parentElement.querySelector('span').textContent);
                
                if (selectedCategories.length === 0) {
                    klasifikasiText.textContent = 'Semua klasifikasi';
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
                    filterJobs();
                });
            });

            // Filter functionality
            function filterJobs() {
                const selectedJobTypes = getSelectedValues(jobTypeFilters);
                const selectedWorkPolicies = getSelectedValues(workPolicyFilters);
                const selectedExperiences = getSelectedValues(experienceFilters);
                const selectedEducations = getSelectedValues(educationFilters);
                const selectedPriority = document.querySelector('.priority-btn.active')?.dataset.priority || 'relevan';
                
                let visibleCount = 0;
                const visibleJobs = [];

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
                        visibleJobs.push(card);
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Sort based on priority
                if (selectedPriority === 'baru') {
                    sortJobsByDate(visibleJobs);
                }

                updateResultsDisplay(visibleCount);
            }

            function sortJobsByDate(jobs) {
                // Simple date-based sorting (you might want to implement actual date parsing)
                jobs.sort((a, b) => {
                    const textA = a.querySelector('.text-muted.small')?.textContent || '';
                    const textB = b.querySelector('.text-muted.small')?.textContent || '';
                    return textB.localeCompare(textA);
                });

                // Reorder in DOM
                const jobResults = document.getElementById('jobResults');
                jobs.forEach(job => {
                    jobResults.appendChild(job);
                });
            }

            function getSelectedValues(checkboxes) {
                return Array.from(checkboxes)
                    .filter(cb => cb.checked)
                    .map(cb => cb.value);
            }

            function updateResultsDisplay(visibleCount) {
                if (visibleCount === 0) {
                    jobResults.style.display = 'none';
                    noResults.classList.remove('d-none');
                    searchAlert.classList.add('d-none');
                } else {
                    jobResults.style.display = 'block';
                    noResults.classList.add('d-none');
                    
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
                
                // Reset priority buttons
                priorityButtons.forEach((btn, index) => {
                    btn.classList.toggle('active', index === 0);
                });
                
                // Reset category checkboxes
                categoryCheckboxes.forEach(cb => cb.checked = false);
                updateKlasifikasiText();
                
                // Reset search form
                document.getElementById('keywordInput').value = '';
                document.getElementById('locationInput').value = '';
                
                // Show all jobs
                jobCards.forEach(card => card.style.display = 'block');
                updateResultsDisplay(jobCards.length);
                
                searchAlert.classList.add('d-none');
            }

            // Event listeners
            applyFiltersBtn.addEventListener('click', filterJobs);
            resetFiltersBtn.addEventListener('click', resetAllFilters);
            if (resetSearchBtn) {
                resetSearchBtn.addEventListener('click', resetAllFilters);
            }

            // Auto-apply filters when checkbox changes
            jobTypeFilters.forEach(filter => filter.addEventListener('change', filterJobs));
            workPolicyFilters.forEach(filter => filter.addEventListener('change', filterJobs));
            experienceFilters.forEach(filter => filter.addEventListener('change', filterJobs));
            educationFilters.forEach(filter => filter.addEventListener('change', filterJobs));

            // Real-time search filtering
            const keywordInput = document.getElementById('keywordInput');
            const locationInput = document.getElementById('locationInput');
            
            function performSearch() {
                const keyword = keywordInput.value.toLowerCase();
                const location = locationInput.value.toLowerCase();
                
                let visibleCount = 0;
                
                jobCards.forEach(card => {
                    const keywords = card.getAttribute('data-keywords') || '';
                    const title = card.querySelector('.job-title').textContent.toLowerCase();
                    const company = card.querySelector('.text-muted').textContent.toLowerCase();
                    const description = card.querySelector('p.mb-1')?.textContent.toLowerCase() || '';
                    
                    const matchesKeyword = !keyword || 
                                         title.includes(keyword) || 
                                         company.includes(keyword) || 
                                         description.includes(keyword) ||
                                         keywords.includes(keyword);
                    const matchesLocation = !location || 
                                          company.includes(location) || 
                                          keywords.includes(location);
                    
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
                } else {
                    searchAlert.classList.add('d-none');
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
        });
    </script>
</body>
</html>