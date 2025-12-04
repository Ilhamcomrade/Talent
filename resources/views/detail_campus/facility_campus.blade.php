<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fasilitas Kampus | Next Jobz</title>
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

        /* ===================== STYLE UNTUK FACILITY SECTION ===================== */
        #detail-page-content .facility-header {
            margin-bottom: 30px;
        }

        #detail-page-content .facility-title {
            font-size: 28px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 12px;
        }

        #detail-page-content .facility-subtitle {
            font-size: 16px;
            color: #6b7280;
            margin-bottom: 25px;
        }

        #detail-page-content .search-container {
            position: relative;
            width: 100%;
            max-width: 100%;
            margin-bottom: 35px;
        }

        #detail-page-content .search-input {
            width: 100%;
            padding: 14px 20px;
            border: 2px solid #d1d5db;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s;
            background-color: white;
        }

        #detail-page-content .search-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        #detail-page-content .facility-section-title {
            font-size: 20px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 20px;
        }

        /* ===================== STYLE UNTUK FACILITY CARDS ===================== */
        #detail-page-content .facility-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 40px;
        }

        #detail-page-content .facility-card {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 24px;
            background: white;
            transition: all 0.3s;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #detail-page-content .facility-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border-color: #d1d5db;
        }

        #detail-page-content .facility-card-content {
            flex: 1;
        }

        #detail-page-content .facility-name {
            font-size: 16px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 8px;
        }

        #detail-page-content .facility-description {
            font-size: 15px;
            color: #6b7280;
            font-weight: 400;
        }

        #detail-page-content .facility-arrow {
            font-size: 24px;
            color: #9ca3af;
            transition: all 0.3s;
        }

        #detail-page-content .facility-card:hover .facility-arrow {
            color: #3b82f6;
            transform: translateX(5px);
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

            #detail-page-content .facility-grid {
                grid-template-columns: 1fr;
            }

            #detail-page-content .facility-title {
                font-size: 24px;
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
            <a href="{{ route('campus.prodi', ['campus' => $campus->slug]) }}" class="detail-nav-item">Program Studi</a>
            <a href="{{ route('campus.facility', ['campus' => $campus->slug]) }}" class="detail-nav-item active">Fasilitas</a>
            {{-- <button class="detail-nav-item">Ulasan</button> --}}
        </div>
    </div>

    <!-- CONTENT BARU -->
    <div class="detail-main-content">

        <!-- GARIS PEMBATAS BARU - DIPINDAHKAN KE POSISI YANG TEPAT -->
        <div class="separator-line"></div>

        <!-- FACILITY HEADER -->
        <div class="facility-header">
            <h1 class="facility-title">Fasilitas {{ $campus->nama_kampus }}</h1>
            <p class="facility-subtitle">Temukan berbagai fasilitas yang tersedia di {{ $campus->nama_kampus }} untuk mendukung kegiatan belajar mengajar dan pengembangan mahasiswa.</p>

            <!-- Search Bar -->
            <div class="search-container">
                <input type="text" class="search-input" placeholder="misalnya Perpustakaan">
            </div>
        </div>

        <!-- FACILITY SECTION TITLE -->
        <h2 class="facility-section-title">Fasilitas di {{ $campus->nama_kampus }}</h2>

        <!-- FACILITY CARDS GRID -->
        <div class="facility-grid">

            <!-- Facility Card 1 -->
            <div class="facility-card">
                <div class="facility-card-content">
                    <div class="facility-name">Perpustakaan Digital</div>
                    <div class="facility-description">Koleksi lengkap buku dan jurnal dengan sistem digital modern</div>
                </div>
                <div class="facility-arrow">›</div>
            </div>

            <!-- Facility Card 2 -->
            <div class="facility-card">
                <div class="facility-card-content">
                    <div class="facility-name">Laboratorium Komputer</div>
                    <div class="facility-description">Ruang praktikum dengan perangkat komputer terkini</div>
                </div>
                <div class="facility-arrow">›</div>
            </div>

            <!-- Facility Card 3 -->
            <div class="facility-card">
                <div class="facility-card-content">
                    <div class="facility-name">Gedung Olahraga</div>
                    <div class="facility-description">Fasilitas olahraga lengkap untuk berbagai cabang</div>
                </div>
                <div class="facility-arrow">›</div>
            </div>

            <!-- Facility Card 4 -->
            <div class="facility-card">
                <div class="facility-card-content">
                    <div class="facility-name">Ruang Seminar</div>
                    <div class="facility-description">Ruangan ber-AC dengan kapasitas 200 orang</div>
                </div>
                <div class="facility-arrow">›</div>
            </div>

            <!-- Facility Card 5 -->
            <div class="facility-card">
                <div class="facility-card-content">
                    <div class="facility-name">Kantin dan Cafeteria</div>
                    <div class="facility-description">Berbagai pilihan makanan dan minuman untuk mahasiswa</div>
                </div>
                <div class="facility-arrow">›</div>
            </div>

            <!-- Facility Card 6 -->
            <div class="facility-card">
                <div class="facility-card-content">
                    <div class="facility-name">Asrama Mahasiswa</div>
                    <div class="facility-description">Hunian nyaman dengan fasilitas lengkap untuk mahasiswa</div>
                </div>
                <div class="facility-arrow">›</div>
            </div>

            <!-- Facility Card 7 -->
            <div class="facility-card">
                <div class="facility-card-content">
                    <div class="facility-name">Klinik Kesehatan</div>
                    <div class="facility-description">Layanan kesehatan 24 jam untuk civitas akademika</div>
                </div>
                <div class="facility-arrow">›</div>
            </div>

            <!-- Facility Card 8 -->
            <div class="facility-card">
                <div class="facility-card-content">
                    <div class="facility-name">Studio Musik</div>
                    <div class="facility-description">Ruang kedap suara dengan peralatan musik profesional</div>
                </div>
                <div class="facility-arrow">›</div>
            </div>

            <!-- Facility Card 9 -->
            <div class="facility-card">
                <div class="facility-card-content">
                    <div class="facility-name">Masjid Kampus</div>
                    <div class="facility-description">Tempat ibadah yang nyaman dan bersih</div>
                </div>
                <div class="facility-arrow">›</div>
            </div>

            <!-- Facility Card 10 -->
            <div class="facility-card">
                <div class="facility-card-content">
                    <div class="facility-name">Lapangan Parkir</div>
                    <div class="facility-description">Area parkir luas untuk kendaraan mahasiswa dan dosen</div>
                </div>
                <div class="facility-arrow">›</div>
            </div>

        </div>

    </div>

</div>

@include('partials.footer')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
