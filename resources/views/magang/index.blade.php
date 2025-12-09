<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talenthub - Lowongan Magang</title>

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
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .search-header { padding: 2rem 0; }
            .sidebar { position: static; margin-bottom: 20px; }
        }
    </style>
</head>
<body>

    {{-- IMPORT NAVBAR --}}
    @include('partials.navbar')

    {{-- === Search Header === --}}
    <section class="search-header">
        <div class="container">
            {{-- SEARCH FORM - method GET supaya query muncul di URL --}}
            <form class="row g-2 align-items-end search-box" method="GET" action="{{ route('magang.index') }}" id="searchForm">
                <div class="col-12 col-md-5">
                    <label class="search-label">Cari Lowongan Magang</label>
                    <input name="search" type="text" class="form-control input-keyword" placeholder="Masukkan kata kunci (judul, perusahaan, posisi)" value="{{ $search ?? '' }}" id="keywordInput">
                </div>

                <div class="col-12 col-md-3">
                    <label class="search-label">Provinsi</label>
                    <select name="provinsi" class="form-select" id="provinsiSelect">
                        <option value="">Semua Provinsi</option>
                        @foreach($provinces as $province)
                            <option value="{{ $province->id }}" {{ $provinsi == $province->id ? 'selected' : '' }}>
                                {{ $province->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-2">
                    <label class="search-label">Kabupaten</label>
                    <select name="kabupaten" class="form-select" id="kabupatenSelect">
                        <option value="">Semua Kabupaten</option>
                        {{-- Kabupaten akan diisi via AJAX --}}
                    </select>
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
                    <div class="page-header-sidebar">Filter Magang</div>

                    <!-- Status Lowongan -->
                    <div class="filter-section">
                        <div class="filter-title">
                            Status Lowongan
                        </div>
                        <div class="filter-options">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="statusAktif" checked disabled>
                                <label class="form-check-label" for="statusAktif">
                                    Aktif
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Tipe Magang -->
                    <div class="filter-section">
                        <div class="filter-title" data-bs-toggle="collapse" data-bs-target="#collapseTipe" aria-expanded="true">
                            Tipe Magang <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="collapse show" id="collapseTipe">
                            <div class="filter-options">
                                <div class="form-check">
                                    <input class="form-check-input filter-type" type="checkbox" value="fulltime" id="fulltime">
                                    <label class="form-check-label" for="fulltime">
                                        Full Time
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input filter-type" type="checkbox" value="parttime" id="parttime">
                                    <label class="form-check-label" for="parttime">
                                        Part Time
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input filter-type" type="checkbox" value="remote" id="remote">
                                    <label class="form-check-label" for="remote">
                                        Remote
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Durasi Magang -->
                    <div class="filter-section">
                        <div class="filter-title" data-bs-toggle="collapse" data-bs-target="#collapseDurasi" aria-expanded="true">
                            Durasi Magang <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="collapse show" id="collapseDurasi">
                            <div class="filter-options">
                                <div class="form-check">
                                    <input class="form-check-input filter-duration" type="checkbox" value="1" id="durasi1">
                                    <label class="form-check-label" for="durasi1">
                                        1 Bulan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input filter-duration" type="checkbox" value="3" id="durasi3">
                                    <label class="form-check-label" for="durasi3">
                                        3 Bulan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input filter-duration" type="checkbox" value="6" id="durasi6">
                                    <label class="form-check-label" for="durasi6">
                                        6 Bulan
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-sm btn-primary w-100 mt-2" id="applyFilters">
                        <i class="bi bi-funnel me-2"></i>Terapkan Filter
                    </button>
                    <a href="{{ route('magang.index') }}" class="btn btn-sm btn-outline-secondary w-100 mt-2">
                        <i class="bi bi-arrow-clockwise me-2"></i>Reset Semua
                    </a>
                </div>
            </div>

            {{-- Job List --}}
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">Lowongan Magang Tersedia</h2>
                    <div class="text-muted">
                        <span id="jobCount">Menampilkan {{ $magang->total() }} lowongan</span>
                    </div>
                </div>

                {{-- Search Results Alert --}}
                @if($search || $provinsi || $kabupaten)
                <div class="alert alert-info" id="searchAlert">
                    <i class="bi bi-info-circle me-2"></i>
                    Menampilkan hasil pencarian 
                    @if($search) untuk "{{ $search }}" @endif
                    @if($provinsi) di provinsi {{ $provinces->where('id', $provinsi)->first()->name ?? '' }} @endif
                    @if($kabupaten) kabupaten {{ $kabupaten }} @endif
                </div>
                @endif

                {{-- DYNAMIC JOBS --}}
                <div id="jobResults">
                    @if($magang->count())
                        @foreach($magang as $job)
                            <div class="job-card" 
                                 data-job-type="{{ strtolower($job->tipe_magang) }}" 
                                 data-duration="{{ $job->durasi }}">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex align-items-start flex-grow-1">
                                        {{-- Logo Perusahaan --}}
                                        <div class="me-3" style="width:80px; flex:0 0 80px;">
                                            @if($job->logo_perusahaan)
                                                <img src="{{ asset('storage/' . $job->logo_perusahaan) }}" alt="Logo {{ $job->perusahaan }}" style="width:80px; height:80px; object-fit:contain;" class="rounded">
                                            @else
                                                <div class="bg-light border rounded d-flex align-items-center justify-content-center" style="width:80px; height:80px;">
                                                    <span class="text-muted small">No Logo</span>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="flex-grow-1">
                                            <div class="job-title">
                                                <a href="{{ route('magang.show', $job->id) }}" class="text-decoration-none text-dark">{{ $job->judul }}</a>
                                                @if($job->created_at->greaterThan(now()->subDays(7)))
                                                    <span class="badge bg-success ms-2">Baru</span>
                                                @endif
                                            </div>
                                            <p class="text-muted mb-1">
                                                <i class="bi bi-building me-1"></i>{{ $job->perusahaan }} - 
                                                <i class="bi bi-geo-alt me-1 ms-2"></i>
                                                {{ $job->regency->name ?? '' }}, {{ $job->province->name ?? '' }}
                                            </p>

                                            @if($job->gaji)
                                                <p class="salary mb-1">
                                                    <i class="bi bi-currency-dollar me-1"></i>
                                                    Rp {{ number_format($job->gaji, 0, ',', '.') }}/bulan
                                                </p>
                                            @endif

                                            <p class="mb-1 text-muted small">
                                                <span class="me-2"><span class="badge bg-info text-dark">{{ ucfirst($job->tipe_magang) }}</span></span>
                                                <span class="me-2"><span class="badge bg-warning text-dark">{{ $job->durasi }} Bulan</span></span>
                                                @if($job->deadline)
                                                    <i class="bi bi-clock me-1"></i>Deadline: {{ \Carbon\Carbon::parse($job->deadline)->format('d M Y') }}
                                                @endif
                                            </p>

                                            <p class="mb-1">
                                                <strong>Posisi:</strong> {{ $job->posisi }}
                                            </p>

                                            @if($job->requirement)
                                                <p class="mb-1">
                                                    <strong>Persyaratan:</strong>
                                                    {!! \Illuminate\Support\Str::limit($job->requirement, 150) !!}
                                                </p>
                                            @endif

                                            @if($job->skill_dibutuhkan)
                                                <div class="skills mt-2">
                                                    @foreach(explode(',', $job->skill_dibutuhkan) as $skill)
                                                        <span>{{ trim($skill) }}</span>
                                                    @endforeach
                                                </div>
                                            @endif

                                            <p class="text-muted small mt-2">
                                                <i class="bi bi-calendar3 me-1"></i>Diposting {{ $job->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center ms-3">
                                        <a href="{{ route('magang.show', $job->id) }}" class="apply-btn">Lihat Detail</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{-- Pagination --}}
                        <div class="mt-4">
                            {{ $magang->appends(request()->query())->links('pagination::bootstrap-5') }}
                        </div>
                    @else
                        {{-- No Results --}}
                        <div class="text-center py-5">
                            <i class="bi bi-search display-1 text-muted"></i>
                            <h4 class="mt-3 text-muted">Tidak ada lowongan magang yang ditemukan</h4>
                            <p class="text-muted">Coba ubah kriteria pencarian atau filter Anda</p>
                            <a href="{{ route('magang.index') }}" class="btn btn-primary mt-2">Reset Pencarian</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- IMPORT FOOTER --}}
    @include('partials.footer')

    <div id="pageData" data-initial-provinsi="{{ $provinsi ?? '' }}"></div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Load kabupaten based on selected provinsi
        function loadKabupaten(provinsiId) {
            var kabupatenSelect = document.getElementById('kabupatenSelect');
            
            if (!provinsiId) {
                kabupatenSelect.innerHTML = '<option value="">Semua Kabupaten</option>';
                return;
            }

            fetch('/api/regencies/' + provinsiId)
                .then(function(response) {
                    return response.json();
                })
                .then(function(data) {
                    kabupatenSelect.innerHTML = '<option value="">Semua Kabupaten</option>';
                    
                    for (var i = 0; i < data.length; i++) {
                        var kabupaten = data[i];
                        var option = document.createElement('option');
                        option.value = kabupaten.id;
                        option.textContent = kabupaten.name;
                        kabupatenSelect.appendChild(option);
                    }
                    
                    // Set selected kabupaten if exists in URL
                    var urlParams = new URLSearchParams(window.location.search);
                    var selectedKabupaten = urlParams.get('kabupaten');
                    if (selectedKabupaten) {
                        kabupatenSelect.value = selectedKabupaten;
                    }
                })
                .catch(function(error) {
                    console.error('Error loading kabupaten:', error);
                });
        }

        // Filter functionality
        function filterJobs() {
            var filterType = document.querySelectorAll('.filter-type');
            var filterDuration = document.querySelectorAll('.filter-duration');
            var jobCards = document.querySelectorAll('.job-card');
            
            var selectedTypes = [];
            var selectedDurations = [];

            // Get selected types
            for (var i = 0; i < filterType.length; i++) {
                if (filterType[i].checked) {
                    selectedTypes.push(filterType[i].value);
                }
            }

            // Get selected durations
            for (var i = 0; i < filterDuration.length; i++) {
                if (filterDuration[i].checked) {
                    selectedDurations.push(filterDuration[i].value);
                }
            }

            var visibleCount = 0;

            // Filter job cards
            for (var i = 0; i < jobCards.length; i++) {
                var card = jobCards[i];
                var jobType = card.getAttribute('data-job-type');
                var duration = card.getAttribute('data-duration');
                
                var matchesType = selectedTypes.length === 0 || selectedTypes.indexOf(jobType) !== -1;
                var matchesDuration = selectedDurations.length === 0 || selectedDurations.indexOf(duration) !== -1;
                
                if (matchesType && matchesDuration) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            }

            // Update job count
            var jobCountElement = document.getElementById('jobCount');
            if (jobCountElement) {
                jobCountElement.innerHTML = 'Menampilkan <strong>' + visibleCount + '</strong> lowongan';
            }
        }

        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Get initial provinsi from data attribute
            var pageDataElement = document.getElementById('pageData');
            var initialProvinsi = pageDataElement ? pageDataElement.getAttribute('data-initial-provinsi') : '';
            
            // Event listener for provinsi change
            var provinsiSelect = document.getElementById('provinsiSelect');
            if (provinsiSelect) {
                provinsiSelect.addEventListener('change', function() {
                    loadKabupaten(this.value);
                });
            }

            // Load kabupaten on page load if provinsi is selected
            if (initialProvinsi) {
                loadKabupaten(initialProvinsi);
            }

            // Apply filters button
            var applyFiltersBtn = document.getElementById('applyFilters');
            if (applyFiltersBtn) {
                applyFiltersBtn.addEventListener('click', filterJobs);
            }

            // Event listeners for filter changes
            var filterType = document.querySelectorAll('.filter-type');
            for (var i = 0; i < filterType.length; i++) {
                filterType[i].addEventListener('change', filterJobs);
            }

            var filterDuration = document.querySelectorAll('.filter-duration');
            for (var i = 0; i < filterDuration.length; i++) {
                filterDuration[i].addEventListener('change', filterJobs);
            }
        });
    </script>
    </script>
</body>
</html>