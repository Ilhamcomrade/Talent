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

        /* ===================== STYLE BARU UNTUK TUNJANGAN DAN KEUNTUNGAN ===================== */
        #detail-page-content .benefits-section {
            margin-bottom: 50px;
        }

        #detail-page-content .benefits-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            margin-bottom: 40px;
        }

        #detail-page-content .benefit-item {
            display: flex;
            gap: 15px;
            align-items: flex-start;
        }

        #detail-page-content .benefit-icon {
            flex-shrink: 0;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #detail-page-content .benefit-icon i {
            font-size: 24px;
            color: #333;
        }

        #detail-page-content .benefit-content {
            flex: 1;
        }

        #detail-page-content .benefit-title {
            font-size: 16px;
            font-weight: bold;
            color: #000;
            margin-bottom: 5px;
        }

        #detail-page-content .benefit-description {
            font-size: 14px;
            color: #555;
            line-height: 1.6;
        }

        /* ===================== STYLE UNTUK WHY JOIN US ===================== */
        #detail-page-content .why-join-section {
            margin-bottom: 40px;
        }

        #detail-page-content .why-join-title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #000;
        }

        #detail-page-content .why-join-text {
            font-size: 15px;
            color: #333;
            line-height: 1.8;
            margin-bottom: 15px;
            text-align: justify;
        }

        /* ===================== STYLE UNTUK ALASAN BERGABUNG ===================== */
        #detail-page-content .reasons-section {
            margin-bottom: 40px;
        }

        #detail-page-content .reasons-title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #000;
        }

        #detail-page-content .reasons-text {
            margin-top: -15px;
            font-size: 15px;
            color: #333;
            line-height: 1.8;
            margin-bottom: 15px;
            text-align: justify;
            white-space: pre-line;
        }

        /* Style khusus untuk data dari database - line height lebih rapat */
        #detail-page-content .database-content {
            line-height: 1.2 !important;
        }

        /* Style khusus untuk paragraf - line height lebih longgar */
        #detail-page-content .paragraph-content {
            line-height: 1.8 !important;
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

            #detail-page-content .benefits-grid {
                grid-template-columns: 1fr;
                gap: 20px;
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
            <a href="{{ route('company.culture', ['company' => $company->slug]) }}" class="detail-nav-item active">Kehidupan dan Budaya</a>
            <a href="{{ route('company.job', ['company' => $company->slug]) }}" class="detail-nav-item">Pekerjaan</a>
            <a href="{{ route('company.salary', ['company' => $company->slug]) }}" class="detail-nav-item">Gaji</a>
            {{-- <button class="detail-nav-item">Ulasan</button> --}}
        </div>
    </div>

    <!-- CONTENT BARU -->
    <div class="detail-main-content">

        <!-- GARIS PEMBATAS BARU - DIPINDAHKAN KE POSISI YANG TEPAT -->
        <div class="separator-line"></div>

        <!-- TUNJANGAN DAN KEUNTUNGAN -->
        <div class="benefits-section">
            <h2 class="detail-section-title">Tunjangan dan keuntungan</h2>

            <div class="benefits-grid">
                <!-- Medical -->
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="bi bi-gift-fill"></i>
                    </div>
                    <div class="benefit-content">
                        <div class="benefit-title">Medis</div>
                        <div class="benefit-description">Manfaat klaim medis untuk karyawan tetap</div>
                    </div>
                </div>

                <!-- Sports -->
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="bi bi-gift-fill"></i>
                    </div>
                    <div class="benefit-content">
                        <div class="benefit-title">Olahraga (e.g. Gym)</div>
                        <div class="benefit-description">Berbagai aktivitas olahraga untuk menjaga keseimbangan kehidupan kerja</div>
                    </div>
                </div>

                <!-- Parking -->
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="bi bi-gift-fill"></i>
                    </div>
                    <div class="benefit-content">
                        <div class="benefit-title">Parkir</div>
                        <div class="benefit-description">Parkir gratis</div>
                    </div>
                </div>

                <!-- BPJS, Annual Bonus, and THR -->
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="bi bi-gift-fill"></i>
                    </div>
                    <div class="benefit-content">
                        <div class="benefit-title">BPJS, Bonus Tahunan, dan THR</div>
                        <div class="benefit-description">Plus manfaat dana pensiun dari Indomobil Group</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ALASAN BERGABUNG -->
        <div class="reasons-section">
            <h2 class="reasons-title">Mengapa bergabung dengan kami ?</h2>

            <p class="reasons-text @if($company->alasan) paragraph-content @endif">
                @if($company->alasan)
                    {{ $company->alasan }}
                @else
Bergabung dengan perusahaan ini memberikan kesempatan untuk menjadi bagian dari tim yang berfokus pada kepuasan pelanggan dan pencapaian kinerja terbaik. Sebagai perusahaan pembiayaan terpercaya, kami menawarkan lingkungan kerja yang mendukung pengembangan karir dan peningkatan kompetensi.

Dengan jaringan cabang yang luas di seluruh Indonesia, perusahaan ini membuka peluang untuk berkembang bersama dalam industri pembiayaan yang kompetitif. Kami menghargai kontribusi setiap individu dan memberikan kesempatan untuk terlibat dalam program penjualan yang berkesinambungan serta pengelolaan dana yang optimal.

Perusahaan ini juga berkomitmen untuk menciptakan nilai tambah bagi para pemegang saham melalui pertumbuhan yang berkelanjutan dan pencapaian target pembiayaan yang ambisius.
                @endif
            </p>
        </div>

    </div>

</div>

@include('partials.footer')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
