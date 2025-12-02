<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Kampus | Next Jobz</title>
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
            /* Ganti margin-top dengan top dan transform */
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

        #detail-page-content .program-count {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 25px;
        }

        /* ===================== STYLE UNTUK PROGRAM CARDS ===================== */
        #detail-page-content .programs-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        #detail-page-content .program-card {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 24px;
            background: white;
            transition: all 0.3s;
            cursor: pointer;
        }

        #detail-page-content .program-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-color: #d1d5db;
        }

        #detail-page-content .program-title {
            font-size: 18px;
            font-weight: bold;
            color: #000;
            margin-bottom: 12px;
            text-decoration: none;
            display: block;
            text-decoration: underline;
            text-decoration-color: black;
        }

        #detail-page-content .program-title:hover {
            text-decoration: underline;
            text-decoration-color: black;
            color: #000;
        }

        #detail-page-content .program-faculty {
            font-size: 14px;
            color: #374151;
            margin-bottom: 12px;
        }

        #detail-page-content .program-description {
            font-size: 14px;
            color: #6b7280;
            line-height: 1.6;
            margin-bottom: 12px;
        }

        #detail-page-content .program-info {
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

            #detail-page-content .programs-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
@include('partials.navbar')

<div id="detail-page-content">

    <!-- Header Section -->
    <div class="detail-header">
        <div class="detail-header-content">

            <!-- Logo -->
            <div class="detail-logo-container">
                @if($campus->logo_path)
                    <img src="{{ asset('storage/' . $campus->logo_path) }}" class="detail-logo">
                @else
                    <div class="detail-logo">
                        {{ substr($campus->nama_kampus, 0, 2) }}
                    </div>
                @endif
            </div>

            <!-- Info Kampus dan Rating -->
            <div class="detail-info-section">
                <h1 class="detail-name">{{ $campus->nama_kampus }}</h1>
                <div class="detail-rating">
                    <i class="bi bi-star-fill"></i>
                    4.3 (80 ulasan)
                </div>
            </div>

        </div>

        <!-- TAB NAVIGATION -->
        <div class="detail-nav-menu">
            <a href="{{ route('campus.detail', ['campus' => $campus->slug]) }}" class="detail-nav-item">Tentang</a>
            <a href="{{ route('campus.culture', ['campus' => $campus->slug]) }}" class="detail-nav-item">Kehidupan dan Budaya</a>
            <a href="{{ route('campus.prodi', ['campus' =>$campus->slug]) }}" class="detail-nav-item active">Program Studi</a>
            <a href="{{ route('campus.facility', ['campus' =>$campus->slug]) }}" class="detail-nav-item">Fasilitas</a>
            {{-- <button class="detail-nav-item">Ulasan</button> --}}
        </div>
    </div>

    <!-- CONTENT BARU -->
    <div class="detail-main-content">

        <!-- GARIS PEMBATAS BARU - DIPINDAHKAN KE POSISI YANG TEPAT -->
        <div class="separator-line"></div>

        <!-- FILTER SECTION -->
        <div class="filter-section">
            <h2 class="filter-title">Filter berdasarkan jenjang pendidikan</h2>

            <div class="filter-buttons">
                <!-- Search Bar -->
                <div class="search-container">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text" class="search-input" placeholder="Masukkan kata kunci">
                </div>
                <button class="filter-btn">Tampilkan program studi</button>
            </div>

            <div class="program-count">
                <strong>48</strong> program studi di {{ $campus->nama_kampus }}
            </div>
        </div>

        <!-- PROGRAMS GRID -->
        <div class="programs-grid">

            <!-- Program Card 1 -->
            <div class="program-card">
                <a href="#" class="program-title">Teknik Informatika</a>
                <div class="program-faculty">Fakultas Teknik dan Ilmu Komputer</div>
                <div class="program-description">
                    Program studi yang mempelajari dan menerapkan prinsip-prinsip ilmu komputer dan analisis matematis dalam perancangan, pengembangan, pengujian, dan evaluasi sistem perangkat lunak.
                </div>
                <div class="program-info">Jenjang: S1 (Sarjana) • Akreditasi: A</div>
            </div>

            <!-- Program Card 2 -->
            <div class="program-card">
                <a href="#" class="program-title">Manajemen Bisnis</a>
                <div class="program-faculty">Fakultas Ekonomi dan Bisnis</div>
                <div class="program-description">
                    Program studi yang dirancang untuk mengembangkan kemampuan dalam mengelola organisasi bisnis, mulai dari perencanaan, pengorganisasian, hingga pengendalian sumber daya perusahaan.
                </div>
                <div class="program-info">Jenjang: S1 (Sarjana) • Akreditasi: A</div>
            </div>

            <!-- Program Card 3 -->
            <div class="program-card">
                <a href="#" class="program-title">Arsitektur</a>
                <div class="program-faculty">Fakultas Teknik dan Perencanaan</div>
                <div class="program-description">
                    Program studi yang mempelajari seni dan teknik merancang bangunan serta lingkungan binaan, menggabungkan aspek estetika, fungsi, dan keberlanjutan dalam setiap karya desain.
                </div>
                <div class="program-info">Jenjang: S1 (Sarjana) • Akreditasi: B</div>
            </div>

            <!-- Program Card 4 -->
            <div class="program-card">
                <a href="#" class="program-title">Psikologi</a>
                <div class="program-faculty">Fakultas Psikologi</div>
                <div class="program-description">
                    Program studi yang mempelajari perilaku dan proses mental manusia secara ilmiah, mencakup berbagai aspek seperti perkembangan, sosial, klinis, dan industri organisasi untuk memahami dan meningkatkan kesejahteraan manusia.
                </div>
                <div class="program-info">Jenjang: S1 (Sarjana) • Akreditasi: A</div>
            </div>

        </div>

    </div>

</div>

@include('partials.footer')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
