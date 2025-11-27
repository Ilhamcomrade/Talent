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
        /* ======================= TAB STYLE ======================= */
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
            background:  #80868b;
            border: none;
            color: white;
            border-radius: 12px 12px 0 0;
            margin-right: 0;
            transition: 0.3s;
            border-right: 2px solid rgba(255, 255, 255, 0.3);
            text-decoration: none;
            display: inline-block;
            text-align: center;
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

        /* ===================== GENERAL STYLES ===================== */
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

        #detail-page-content .detail-header {
            padding: 40px 0 10px 0;
            border-bottom: 1px solid #e0e0e0;
            margin-top: -45px;
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
            height: 200px;
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
            padding: 30px 0;
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
            color: #000; /* Diubah dari #1a73e8 (biru) menjadi #000 (hitam) */
            margin-bottom: 12px;
            text-decoration: none;
            display: block;
            text-decoration: underline;
            text-decoration-color: black;
        }

        #detail-page-content .job-title:hover {
            text-decoration: underline;
            text-decoration-color: black;
            color: #000; /* Tetap hitam saat hover */
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
            {{-- <button class="detail-nav-item">Ulasan</button> --}}
        </div>
    </div>

    <!-- CONTENT BARU - FILTER DAN JOBS -->
    <div class="detail-main-content">

        <!-- FILTER SECTION -->
        <div class="filter-section">
            <h2 class="filter-title">Filter berdasarkan tipe pekerjaan</h2>

            <div class="filter-buttons">
                <!-- Search Bar -->
                <div class="search-container">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text" class="search-input" placeholder="Masukkan kata kunci">
                </div>
                <button class="filter-btn">Tampilkan pekerjaan</button>
            </div>

            <div class="job-count">
                <strong>306</strong> pekerjaan di BFI Finance Indonesia
            </div>
        </div>

        <!-- JOBS GRID -->
        <div class="jobs-grid">

            <!-- Job Card 1 -->
            <div class="job-card">
                <a href="#" class="job-title">Management Trainee Asset Management</a>
                <div class="job-location">Tangerang, Banten</div>
                <div class="job-description">
                    Accelerate your career with comprehensive training and mentorship at a leading Indonesian finance company.
                </div>
                <div class="job-posted">14 hari yang lalu</div>
            </div>

            <!-- Job Card 2 -->
            <div class="job-card">
                <a href="#" class="job-title">Branch Manager Refinancing</a>
                <div class="job-location">Jawa Timur</div>
                <div class="job-description">
                    We are seeking a dynamic and results-driven Mortgage Branch Manager to lead our team and drive branch growth.
                </div>
                <div class="job-posted">26 hari yang lalu</div>
            </div>

            <!-- Job Card 3 -->
            <div class="job-card">
                <a href="#" class="job-title">Operations Staff</a>
                <div class="job-location">Kecamatan Tangerang, Banten</div>
                <div class="job-description">
                    Melakukan review aplikasi yang disubmit oleh cabang agar sesuai dengan ketentuan yang berlaku Melakukan aktivasi aplikasi dan memastikan dana...
                </div>
                <div class="job-posted">1 hari yang lalu</div>
            </div>

            <!-- Job Card 4 -->
            <div class="job-card">
                <a href="#" class="job-title">Customer Service Branch Pasaman Barat</a>
                <div class="job-location">Pasaman Barat, Sumatera Barat</div>
                <div class="job-description">
                    1. Bertanggung jawab terhadap kepuasan konsumen eksternal melalui pelayanan yang diberikan cabang, agar dapat mendukung peningkatan pencapaian...
                </div>
                <div class="job-posted">12 hari yang lalu</div>
            </div>

        </div>

    </div>

</div>

@include('partials.footer')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
