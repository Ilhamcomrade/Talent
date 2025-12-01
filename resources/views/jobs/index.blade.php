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
            bottom: 80px;
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
                bottom: 70px;
                right: 20px;
            }

            .whatsapp-logo {
                width: 55px;
                height: 55px;
            }
        }

        @media (max-width: 576px) {
            .whatsapp-float {
                bottom: 60px;
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
                    <input name="search" type="text" class="form-control input-keyword" placeholder="Masukkan kata kunci" value="{{ request('search') }}" id="keywordInput">
                </div>

                <div class="col-12 col-md-3">
                    <label class="search-label">Industri</label>
                    <select name="industry" class="form-select" id="industrySelect">
                        <option value="">Semua industri</option>
                        <option value="sales" {{ request('industry') == 'sales' ? 'selected' : '' }}>Sales</option>
                        <option value="it" {{ request('industry') == 'it' ? 'selected' : '' }}>IT</option>
                        <option value="otomotif" {{ request('industry') == 'otomotif' ? 'selected' : '' }}>Otomotif</option>
                        <option value="administrasi" {{ request('industry') == 'administrasi' ? 'selected' : '' }}>Administrasi</option>
                        <option value="akuntansi-keuangan" {{ request('industry') == 'akuntansi-keuangan' ? 'selected' : '' }}>Akuntansi & Keuangan</option>
                        <option value="manajemen" {{ request('industry') == 'manajemen' ? 'selected' : '' }}>Manajemen</option>
                        <option value="desain-kreatif" {{ request('industry') == 'desain-kreatif' ? 'selected' : '' }}>Desain & Kreatif</option>
                        <option value="pemasaran" {{ request('industry') == 'pemasaran' ? 'selected' : '' }}>Pemasaran</option>
                        <option value="pendidikan" {{ request('industry') == 'pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                        <option value="kesehatan" {{ request('industry') == 'kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                        <option value="teknik" {{ request('industry') == 'teknik' ? 'selected' : '' }}>Teknik</option>
                        <option value="produksi" {{ request('industry') == 'produksi' ? 'selected' : '' }}>Produksi</option>
                        <option value="logistik" {{ request('industry') == 'logistik' ? 'selected' : '' }}>Logistik</option>
                        <option value="transportasi" {{ request('industry') == 'transportasi' ? 'selected' : '' }}>Transportasi</option>
                        <option value="hrd" {{ request('industry') == 'hrd' ? 'selected' : '' }}>Sumber Daya Manusia (HRD)</option>
                        <option value="hukum" {{ request('industry') == 'hukum' ? 'selected' : '' }}>Hukum</option>
                        <option value="media-komunikasi" {{ request('industry') == 'media-komunikasi' ? 'selected' : '' }}>Media & Komunikasi</option>
                        <option value="perhotelan" {{ request('industry') == 'perhotelan' ? 'selected' : '' }}>Perhotelan & Pariwisata</option>
                        <option value="ritel" {{ request('industry') == 'ritel' ? 'selected' : '' }}>Ritel & E-commerce</option>
                        <option value="lainnya" {{ request('industry') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>

                <div class="col-12 col-md-3">
                    <label class="search-label">Lokasi</label>
                    <div class="row g-1">
                        {{-- <div class="col-12 mb-1"> --}}
                            <select name="provinsi_id" class="form-select" id="provinsiSelect">
                                <option value="">Pilih Provinsi</option>
                                @foreach($provinces ?? [] as $province)
                                    <option value="{{ $province->id }}" {{ request('provinsi_id') == $province->id ? 'selected' : '' }}>
                                        {{ $province->name }}
                                    </option>
                                @endforeach
                            </select>
                        {{-- </div> --}}
                        {{-- <div class="col-12">
                            <select name="kabupaten_id" class="form-select" id="kabupatenSelect" {{ !request('provinsi_id') ? 'disabled' : '' }}>
                                <option value="">Pilih Kabupaten/Kota</option>
                            </select>
                        </div> --}}
                    </div>
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

                    <!-- Mode Kerja Filter -->
                    <div class="filter-section">
                        <div class="filter-title" data-bs-toggle="collapse" data-bs-target="#collapseWorkMode" aria-expanded="true">
                            Mode Kerja <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="collapse show filter-options" id="collapseWorkMode">
                            <div class="form-check">
                                <input class="form-check-input work-mode-filter" type="radio" name="work_mode" value="" id="workModeAll" {{ !request('work_mode') ? 'checked' : '' }}>
                                <label class="form-check-label" for="workModeAll">Semua</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input work-mode-filter" type="radio" name="work_mode" value="kerja_di_kantor" id="workModeOffice" {{ request('work_mode') == 'kerja_di_kantor' ? 'checked' : '' }}>
                                <label class="form-check-label" for="workModeOffice">Kerja di Kantor</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input work-mode-filter" type="radio" name="work_mode" value="remote" id="workModeRemote" {{ request('work_mode') == 'remote' ? 'checked' : '' }}>
                                <label class="form-check-label" for="workModeRemote">Remote</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input work-mode-filter" type="radio" name="work_mode" value="hybrid" id="workModeHybrid" {{ request('work_mode') == 'hybrid' ? 'checked' : '' }}>
                                <label class="form-check-label" for="workModeHybrid">Hybrid</label>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Reset Filter -->
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
                        <span id="jobCount">Menampilkan <strong>{{ $jobs->total() }}</strong> lowongan</span>
                    </div>
                </div>

                {{-- Search Results Alert --}}
                @if(request()->anyFilled(['search', 'industry', 'work_mode', 'provinsi_id', 'kabupaten_id']))
                <div class="alert alert-info" id="searchAlert">
                    <i class="bi bi-info-circle me-2"></i>
                    <span id="alertText">
                        Menampilkan hasil pencarian 
                        @if(request('search')) untuk "{{ request('search') }}"@endif
                        @if(request('industry')) di industri {{ request('industry') }}@endif
                        @if(request('work_mode')) dengan mode kerja {{ request('work_mode') }}@endif
                    </span>
                </div>
                @endif

                {{-- DYNAMIC JOBS --}}
                <div id="jobResults">
                    @if($jobs->count())
                        @foreach($jobs as $job)
                            <div class="job-card">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex align-items-start flex-grow-1">
                                        {{-- Logo Perusahaan --}}
                                        <div class="me-3" style="flex: 0 0 80px;">
                                            @if($job->company_logo)
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
                                                <a href="{{ route('jobs.show', $job->id) }}" class="text-decoration-none text-dark">{{ $job->title }}</a>
                                                @if($job->created_at->greaterThan(\Carbon\Carbon::now()->subDays(3)))
                                                    <span class="badge bg-success ms-2">Baru</span>
                                                @endif
                                            </div>
                                            <p class="text-muted mb-1">
                                                <i class="bi bi-building me-1"></i>{{ $job->company_name }} -
                                                <i class="bi bi-geo-alt me-1 ms-2"></i>
                                                {{ $job->province->name ?? 'Lokasi tidak tersedia' }}{{ $job->regency ? ', ' . $job->regency->name : '' }}
                                            </p>

                                            <p class="text-muted mb-1">
                                                <i class="bi bi-briefcase me-1"></i>{{ $job->industry }}
                                            </p>

                                            <p class="mb-1 text-muted small">
                                                <span class="me-2">
                                                    <span class="badge bg-warning text-dark">
                                                        @if($job->work_mode == 'kerja_di_kantor')
                                                            Kantor
                                                        @elseif($job->work_mode == 'remote')
                                                            Remote
                                                        @elseif($job->work_mode == 'hybrid')
                                                            Hybrid
                                                        @else
                                                            {{ $job->work_mode }}
                                                        @endif
                                                    </span>
                                                </span>
                                            </p>

                                            @if($job->description)
                                            <p class="mb-1">
                                                <strong>Deskripsi:</strong>
                                                {!! \Illuminate\Support\Str::limit(strip_tags($job->description), 120) !!}
                                            </p>
                                            @endif

                                            <p class="text-muted small mt-2">
                                                @if($job->created_at->greaterThan(\Carbon\Carbon::now()->subDays(7)))
                                                    <span class="badge bg-success me-2">Baru untuk kamu</span>
                                                @endif
                                                <i class="bi bi-calendar3 me-1"></i>Tayang {{ $job->created_at->diffForHumans() }}
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
            const provinsiSelect = document.getElementById('provinsiSelect');
            const kabupatenSelect = document.getElementById('kabupatenSelect');
            const workModeFilters = document.querySelectorAll('.work-mode-filter');

            // Load kabupaten when provinsi is selected
            provinsiSelect.addEventListener('change', function() {
                const provinceId = this.value;
                kabupatenSelect.disabled = !provinceId;
                
                if (provinceId) {
                    fetch(`/jobs/regencies/${provinceId}`)
                        .then(response => response.json())
                        .then(data => {
                            kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
                            data.forEach(regency => {
                                kabupatenSelect.innerHTML += `<option value="${regency.id}">${regency.name}</option>`;
                            });
                            
                            // Set selected value if exists in URL
                            const urlParams = new URLSearchParams(window.location.search);
                            const selectedRegency = urlParams.get('kabupaten_id');
                            if (selectedRegency) {
                                kabupatenSelect.value = selectedRegency;
                            }
                        });
                } else {
                    kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
                }
            });

            // Auto submit form when work mode filter changes
            workModeFilters.forEach(filter => {
                filter.addEventListener('change', function() {
                    searchForm.submit();
                });
            });

            // Reset filters functionality
            resetFiltersBtn.addEventListener('click', function() {
                // Reset form inputs
                searchForm.reset();
                
                // Reset select elements
                provinsiSelect.value = '';
                kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
                kabupatenSelect.disabled = true;
                
                // Submit the form to show all results
                searchForm.submit();
            });

            // Initialize kabupaten select if provinsi is already selected
            @if(request('provinsi_id'))
                provinsiSelect.dispatchEvent(new Event('change'));
            @endif

            // Auto-submit form when location selects change
            provinsiSelect.addEventListener('change', function() {
                searchForm.submit();
            });

            kabupatenSelect.addEventListener('change', function() {
                searchForm.submit();
            });
        });
    </script>
</body>
</html>