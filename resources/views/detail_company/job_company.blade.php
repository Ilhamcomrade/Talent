<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Perusahaan | Next Jobz</title>
    <link rel="icon" type="image/png" href="{{ asset('123.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        /* ======================= TAB STYLE BARU (SAMA SEPERTI KAMPUS) ======================= */
        #detail-page-content .detail-nav-menu {
            display: flex;
            gap: 0;
            margin-top: 5px;
            margin-bottom: 5px;
        }

        #detail-page-content .detail-nav-item {
            padding: 12px 28px;
            font-weight: bold;
            cursor: pointer;
            background: #80868b;
            border: none;
            color: white;
            border-radius: 12px 12px 0 0;
            margin-right: 0;
            position: relative;
            top: -100px;
            transition: 0.3s;
            border-right: 2px solid rgba(255, 255, 255, 0.3);
            text-decoration: none;
            display: inline-block;
            text-align: center;
            min-height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #detail-page-content .detail-nav-item:last-child {
            border-right: none;
        }

        #detail-page-content .detail-nav-item.active {
            background: linear-gradient(135deg, #8ab4f8, #6a8ddf);
            color: white !important;
        }

        #detail-page-content .detail-nav-item:hover:not(.active) {
            opacity: 0.85;
            color: white;
            text-decoration: none;
        }

        /* ===================== STYLE LAMA KAMU (DIBIARKAN UTUH TANPA DIUBAH) ===================== */
        #detail-page-content * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        #detail-page-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        #detail-page-content .detail-header-content {
            display: flex;
            align-items: flex-start;
            gap: 30px;
            margin-bottom: 15px;
        }

        #detail-page-content .detail-logo-container {
            flex-shrink: 0;
        }

        #detail-page-content .detail-logo {
            width: 200px;
            height: 100px;
            border-radius: 12px;
            object-fit: contain;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            font-weight: bold;
            color: #666;
            padding: 10px;
        }

        #detail-page-content .detail-info-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            padding-top: 0;
            height: 200px;
        }

        #detail-page-content .detail-name {
            font-size: 32px;
            font-weight: bold;
            color: #000;
            margin-bottom: 10px;
            margin-top: 20px;
        }

        #detail-page-content .detail-rating {
            font-size: 18px;
            color: #000;
            margin-bottom: 0;
        }

        #detail-page-content .detail-rating i {
            color: #ffc107;
            margin-right: 5px;
        }

        #detail-page-content .detail-main-content {
                padding: 15px 0 30px 0;
                margin-top: -90px;
                position: relative;
                z-index: 0;
        }

        #detail-page-content .detail-section-title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 25px;
            color: #000;
        }

        /* ===================== STYLE UNTUK FILTER SECTION ===================== */
        #detail-page-content .filter-section {
            margin-bottom: 30px;
            padding-top: 20px;
        }

        #detail-page-content .filter-title {
            font-size: 16px;
            font-weight: bold;
            color: #000;
            margin-bottom: 15px;
        }

        #detail-page-content .filter-buttons {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        #detail-page-content .filter-btn {
            padding: 10px 24px;
            border: 2px solid #d1d5db;
            border-radius: 25px;
            background: white;
            color: #374151;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }

        #detail-page-content .filter-btn:hover {
            border-color: #9ca3af;
            background: #f9fafb;
        }

        #detail-page-content .search-btn {
            padding: 10px 24px;
            border: 2px solid #2563eb;
            border-radius: 25px;
            background: #2563eb;
            color: white;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }

        #detail-page-content .search-btn:hover {
            background: #1d4ed8;
            border-color: #1d4ed8;
        }

        #detail-page-content .job-count {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 25px;
        }

        /* ===================== STYLE UNTUK JOB CARDS ===================== */
        #detail-page-content .jobs-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 40px;
        }

        #detail-page-content .job-card {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 24px;
            background: white;
            transition: all 0.3s;
            cursor: pointer;
        }

        #detail-page-content .job-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-color: #d1d5db;
        }

        #detail-page-content .job-title {
            font-size: 18px;
            font-weight: bold;
            color: #000;
            margin-bottom: 12px;
            text-decoration: none;
            display: block;
            text-decoration: underline;
            text-decoration-color: black;
        }

        #detail-page-content .job-title:hover {
            text-decoration: underline;
            text-decoration-color: black;
            color: #000;
        }

        #detail-page-content .job-location {
            font-size: 14px;
            color: #374151;
            margin-bottom: 12px;
        }

        #detail-page-content .job-description {
            font-size: 14px;
            color: #6b7280;
            line-height: 1.6;
            margin-bottom: 12px;
        }

        #detail-page-content .job-posted {
            font-size: 13px;
            color: #9ca3af;
        }

        /* ===================== STYLE UNTUK SEARCH BAR ===================== */
        #detail-page-content .search-container {
            position: relative;
            width: 100%;
            max-width: 500px;
        }

        #detail-page-content .search-input {
            width: 100%;
            padding: 12px 20px 12px 45px;
            border: 2px solid #d1d5db;
            border-radius: 25px;
            font-size: 14px;
            transition: all 0.3s;
            background-color: white;
        }

        #detail-page-content .search-input:focus {
            outline: none;
            border-color: #1a73e8;
            box-shadow: 0 0 0 3px rgba(26, 115, 232, 0.2);
        }

        #detail-page-content .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
        }

        /* ===================== GARIS PEMBATAS BARU ===================== */
        #detail-page-content .separator-line {
            height: 2px;
            background-color: #e0e0e0;
            margin: 20px 0;
            margin-top: -10px;
            width: 100%;
        }

        /* ===================== STYLE UNTUK PAGINATION ===================== */
        #detail-page-content .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 40px;
            margin-bottom: 60px;
        }

        #detail-page-content .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
            gap: 8px;
        }

        #detail-page-content .pagination-item {
            display: inline-block;
        }

        #detail-page-content .pagination-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            background-color: white;
            color: #374151;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s;
        }

        #detail-page-content .pagination-link:hover {
            background-color: #f3f4f6;
            border-color: #9ca3af;
        }

        #detail-page-content .pagination-link.active {
            background-color: #2563eb;
            border-color: #2563eb;
            color: white;
        }

        #detail-page-content .pagination-link.disabled {
            opacity: 0.5;
            cursor: not-allowed;
            background-color: #f9fafb;
        }

        #detail-page-content .pagination-link.disabled:hover {
            background-color: #f9fafb;
            border-color: #d1d5db;
        }

        #detail-page-content .pagination-ellipsis {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            color: #6b7280;
            font-size: 14px;
        }

        /* Loading Spinner */
        #detail-page-content .loading-spinner {
            display: none;
            text-align: center;
            padding: 40px;
        }

        #detail-page-content .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #2563eb;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* ===================== STYLE UNTUK PESAN KOSONG ===================== */
        #detail-page-content .empty-message {
            grid-column: 1 / -1;
            text-align: center;
            padding: 40px 20px;
            font-size: 16px;
            color: #6b7280;
            background: transparent;
            border: none;
            margin: 0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            #detail-page-content .detail-header-content {
                flex-direction: column;
                text-align: center;
            }

            #detail-page-content .detail-info-section {
                padding-top: 0;
                height: auto;
            }

            #detail-page-content .detail-name {
                margin-top: 20px;
            }

            #detail-page-content .detail-nav-menu {
                flex-wrap: wrap;
            }

            #detail-page-content .detail-nav-item {
                flex: 1;
                min-width: 120px;
                text-align: center;
                padding: 10px 15px;
                font-size: 14px;
            }

            #detail-page-content .filter-buttons {
                flex-direction: column;
            }

            #detail-page-content .filter-btn {
                width: 100%;
            }

            #detail-page-content .jobs-grid {
                grid-template-columns: 1fr;
            }

            #detail-page-content .pagination {
                flex-wrap: wrap;
                justify-content: center;
            }

            #detail-page-content .pagination-link {
                width: 36px;
                height: 36px;
                font-size: 13px;
            }
        }
    </style>
</head>

<body>

@include('partials.navbar')

<div id="detail-page-content">

    <!-- Header -->
    <div class="detail-header">
        <div class="detail-header-content">

            <!-- Logo -->
            <div class="detail-logo-container">
                @if($company->logo)
                    <img src="{{ asset('storage/' . $company->logo) }}" class="detail-logo">
                @else
                    <div class="detail-logo">
                        {{ substr($company->nama_perusahaan, 0, 2) }}
                    </div>
                @endif
            </div>

            <!-- Info Perusahaan dan Rating -->
            <div class="detail-info-section">
                <h1 class="detail-name">{{ $company->nama_perusahaan }}</h1>
                <div class="detail-rating">
                    <i class="bi bi-star-fill"></i>
                    4.3 (80 ulasan)
                </div>
            </div>

        </div>

        <!-- TAB NAVIGATION -->
        <div class="detail-nav-menu">
            <a href="{{ route('company.detail', ['company' => $company->slug]) }}" class="detail-nav-item">Tentang</a>
            <a href="{{ route('company.culture', ['company' => $company->slug]) }}" class="detail-nav-item">Kehidupan dan Budaya</a>
            <a href="{{ route('company.job', ['company' => $company->slug]) }}" class="detail-nav-item active">Pekerjaan</a>
            <a href="{{ route('company.salary', ['company' => $company->slug]) }}" class="detail-nav-item">Gaji</a>
        </div>
    </div>

    <!-- CONTENT BARU -->
    <div class="detail-main-content">

        <!-- GARIS PEMBATAS BARU - DIPINDAHKAN KE POSISI YANG TEPAT -->
        <div class="separator-line"></div>

        <!-- FILTER SECTION -->
        <div class="filter-section">
            <h2 class="filter-title">Cari berdasarkan nama pekerjaan</h2>

            <div class="filter-buttons">
                <!-- Search Form -->
                <form action="{{ route('company.job', ['company' => $company->slug]) }}" method="GET" id="searchForm" class="d-flex gap-3 align-items-center w-100">
                    <div class="search-container">
                        <i class="bi bi-search search-icon"></i>
                        <input type="text"
                               class="search-input"
                               name="search"
                               id="searchInput"
                               placeholder="Masukkan kata kunci"
                               value="{{ request('search') }}">
                    </div>
                    <button type="submit" class="search-btn">Cari</button>
                </form>
            </div>

            <div class="job-count">
                @if(request('search'))
                    <strong>{{ $jobs->total() }}</strong> pekerjaan ditemukan untuk "{{ request('search') }}" di {{ $company->nama_perusahaan }}
                @else
                    <strong>{{ $jobCount }}</strong> pekerjaan di {{ $company->nama_perusahaan }}
                @endif
            </div>
        </div>

        <!-- Loading Spinner -->
        <div class="loading-spinner" id="loadingSpinner">
            <div class="spinner"></div>
            <p>Mencari pekerjaan...</p>
        </div>

        <!-- JOBS GRID -->
        <div class="jobs-grid" id="jobsGrid">
            @forelse($jobs as $job)
                <!-- Job Card -->
                <div class="job-card">
                    <a href="#" class="job-title">{{ $job->title }}</a>

                    <!-- Lokasi dari tabel provinces, regencies, districts, villages -->
                    <div class="job-location">
                        @php
                            // Build location string from related models
                            $locationParts = [];

                            // Check each location level and add to array if exists
                            if ($job->regency && $job->regency->name) {
                                $locationParts[] = $job->regency->name;
                            }

                            if ($job->province && $job->province->name) {
                                $locationParts[] = $job->province->name;
                            }

                            // Join parts with comma
                            $locationString = !empty($locationParts)
                                ? implode(', ', $locationParts)
                                : 'Lokasi tidak ditentukan';
                        @endphp
                        {{ $locationString }}
                    </div>

                    <div class="job-description">
                        {{ Str::limit($job->description ?? 'Deskripsi tidak tersedia', 150) }}
                    </div>

                    <!-- Waktu posting real-time -->
                    <div class="job-posted">
                        @php
                            // Menggunakan accessor dari model untuk waktu yang lebih bersih
                            $createdAt = $job->created_at;
                            $now = now();

                            // Calculate time differences dengan pembulatan
                            $diffInSeconds = $createdAt->diffInSeconds($now);
                            $diffInMinutes = $createdAt->diffInMinutes($now);
                            $diffInHours = $createdAt->diffInHours($now);
                            $diffInDays = $createdAt->diffInDays($now);
                            $diffInMonths = $createdAt->diffInMonths($now);
                            $diffInYears = $createdAt->diffInYears($now);

                            // Format based on time difference dengan pembulatan ke integer
                            if ($diffInSeconds < 60) {
                                echo (int)$diffInSeconds . " detik yang lalu";
                            } elseif ($diffInMinutes < 60) {
                                echo (int)$diffInMinutes . " menit yang lalu";
                            } elseif ($diffInHours < 24) {
                                echo (int)$diffInHours . " jam yang lalu";
                            } elseif ($diffInDays < 30) {
                                echo (int)$diffInDays . " hari yang lalu";
                            } elseif ($diffInMonths < 12) {
                                echo (int)$diffInMonths . " bulan yang lalu";
                            } else {
                                echo (int)$diffInYears . " tahun yang lalu";
                            }
                        @endphp
                    </div>
                </div>
            @empty
                <!-- Pesan ketika tidak ada lowongan -->
                <div class="empty-message">
                    @if(request('search'))
                        Tidak ditemukan pekerjaan dengan kata kunci "{{ request('search') }}"
                    @else
                        Belum ada lowongan pekerjaan yang tersedia untuk perusahaan ini.
                    @endif
                </div>
            @endforelse
        </div>

        <!-- PAGINATION SECTION -->
        @if($jobs->hasPages())
        <div class="pagination-container" id="paginationContainer">
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if($jobs->onFirstPage())
                    <li class="pagination-item">
                        <span class="pagination-link disabled">
                            <i class="bi bi-chevron-left"></i>
                        </span>
                    </li>
                @else
                    <li class="pagination-item">
                        <a href="{{ $jobs->previousPageUrl() . (request('search') ? '&search=' . request('search') : '') }}" class="pagination-link">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @php
                    $current = $jobs->currentPage();
                    $last = $jobs->lastPage();
                    $start = max(1, $current - 2);
                    $end = min($last, $current + 2);

                    // Adjust if we're near the beginning
                    if ($current <= 3) {
                        $end = min(5, $last);
                    }

                    // Adjust if we're near the end
                    if ($current >= $last - 2) {
                        $start = max(1, $last - 4);
                    }
                @endphp

                {{-- First Page Link --}}
                @if($start > 1)
                    <li class="pagination-item">
                        <a href="{{ $jobs->url(1) . (request('search') ? '&search=' . request('search') : '') }}" class="pagination-link">1</a>
                    </li>
                    @if($start > 2)
                        <li class="pagination-item">
                            <span class="pagination-ellipsis">...</span>
                        </li>
                    @endif
                @endif

                {{-- Page Number Links --}}
                @for($i = $start; $i <= $end; $i++)
                    <li class="pagination-item">
                        @if($i == $current)
                            <span class="pagination-link active">{{ $i }}</span>
                        @else
                            <a href="{{ $jobs->url($i) . (request('search') ? '&search=' . request('search') : '') }}" class="pagination-link">{{ $i }}</a>
                        @endif
                    </li>
                @endfor

                {{-- Last Page Link --}}
                @if($end < $last)
                    @if($end < $last - 1)
                        <li class="pagination-item">
                            <span class="pagination-ellipsis">...</span>
                        </li>
                    @endif
                    <li class="pagination-item">
                        <a href="{{ $jobs->url($last) . (request('search') ? '&search=' . request('search') : '') }}" class="pagination-link">{{ $last }}</a>
                    </li>
                @endif

                {{-- Next Page Link --}}
                @if($jobs->hasMorePages())
                    <li class="pagination-item">
                        <a href="{{ $jobs->nextPageUrl() . (request('search') ? '&search=' . request('search') : '') }}" class="pagination-link">
                            <i class="bi bi-chevron-right"></i>
                        </a>
                    </li>
                @else
                    <li class="pagination-item">
                        <span class="pagination-link disabled">
                            <i class="bi bi-chevron-right"></i>
                        </span>
                    </li>
                @endif
            </ul>
        </div>
        @endif

    </div>

</div>

@include('partials.footer')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.getElementById('searchForm');
    const searchInput = document.getElementById('searchInput');
    const loadingSpinner = document.getElementById('loadingSpinner');
    const jobsGrid = document.getElementById('jobsGrid');
    const paginationContainer = document.getElementById('paginationContainer');

    // Handle form submission
    searchForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const searchTerm = searchInput.value.trim();

        if (searchTerm === '') {
            // Jika search kosong, reset ke halaman awal
            window.location.href = "{{ route('company.job', ['company' => $company->slug]) }}";
            return;
        }

        // Tampilkan loading spinner
        loadingSpinner.style.display = 'block';
        jobsGrid.style.display = 'none';
        if (paginationContainer) {
            paginationContainer.style.display = 'none';
        }

        // Submit form dengan search term
        const url = new URL("{{ route('company.job', ['company' => $company->slug]) }}");
        url.searchParams.set('search', searchTerm);
        window.location.href = url.toString();
    });

    // Clear search function
    function clearSearch() {
        searchInput.value = '';
        window.location.href = "{{ route('company.job', ['company' => $company->slug]) }}";
    }

    // Add clear button if there's search term
    if (searchInput.value) {
        const searchContainer = document.querySelector('.search-container');
        const clearBtn = document.createElement('button');
        clearBtn.type = 'button';
        clearBtn.innerHTML = '<i class="bi bi-x"></i>';
        clearBtn.style.position = 'absolute';
        clearBtn.style.right = '15px';
        clearBtn.style.top = '50%';
        clearBtn.style.transform = 'translateY(-50%)';
        clearBtn.style.background = 'transparent';
        clearBtn.style.border = 'none';
        clearBtn.style.color = '#6b7280';
        clearBtn.style.cursor = 'pointer';
        clearBtn.style.fontSize = '18px';
        clearBtn.title = 'Hapus pencarian';
        clearBtn.addEventListener('click', clearSearch);
        searchContainer.appendChild(clearBtn);
    }

    // Enter key to submit
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            searchForm.dispatchEvent(new Event('submit'));
        }
    });
});
</script>

</body>
</html>
