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

        /* ===================== STYLE UNTUK INFORMASI PERUSAHAAN ===================== */
        #detail-page-content .detail-info-table {
            width: 100%;
            margin-bottom: 35px;
        }

        #detail-page-content .detail-info-row {
            display: flex;
            border-bottom: 1px solid #e0e0e0;
            padding: 12px 0;
        }

        #detail-page-content .detail-info-label {
            width: 200px;
            font-weight: bold;
            color: #000;
        }

        #detail-page-content .detail-info-value {
            flex: 1;
            color: #333;
        }

        #detail-page-content .detail-description {
            margin-top: 25px;
        }

        #detail-page-content .detail-description h3 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #333;
        }

        #detail-page-content .detail-description p {
            margin-top: -20px;
            margin-bottom: 12px;
            text-align: justify;
            color: #555;
            line-height: 1.7;
            white-space: pre-line;
        }

        /* Style khusus untuk data dari database - line height lebih rapat */
        #detail-page-content .database-content {
            line-height: 1.2 !important;
        }

        /* Style khusus untuk deskripsi perusahaan - line height lebih longgar */
        #detail-page-content .description-content {
            line-height: 1.8 !important;
        }

        #detail-page-content .vision {
            margin-top: 25px;
        }

        #detail-page-content .vision h3 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #333;
        }

        #detail-page-content .vision p {
            margin-top: -10px;
            margin-bottom: 12px;
            text-align: justify;
            color: #555;
            line-height: 1.7;
            white-space: pre-line;
        }

        #detail-page-content .mission {
            margin-top: 25px;
        }

        #detail-page-content .mission h3 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #333;
        }

        #detail-page-content .mission p {
            margin-top: -10px;
            margin-bottom: 12px;
            text-align: justify;
            color: #555;
            line-height: 1.7;
            white-space: pre-line;
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

            #detail-page-content .detail-info-row {
                flex-direction: column;
            }

            #detail-page-content .detail-info-label {
                width: 100%;
                margin-bottom: 5px;
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
            <a href="{{ route('company.detail', ['company' => $company->slug]) }}" class="detail-nav-item active">Tentang</a>
            <a href="{{ route('company.culture', ['company' => $company->slug]) }}" class="detail-nav-item">Kehidupan dan Budaya</a>
            <a href="{{ route('company.job', ['company' => $company->slug]) }}" class="detail-nav-item">Pekerjaan</a>
            <a href="{{ route('company.salary', ['company' => $company->slug]) }}" class="detail-nav-item">Gaji</a>
            {{-- <button class="detail-nav-item">Ulasan</button> --}}
        </div>
    </div>

    <!-- CONTENT BARU -->
    <div class="detail-main-content">

        <!-- GARIS PEMBATAS BARU - DIPINDAHKAN KE POSISI YANG TEPAT -->
        <div class="separator-line"></div>

        <h2 class="detail-section-title">Sekilas tentang perusahaan</h2>

        <div class="detail-info-table">

            <div class="detail-info-row">
                <div class="detail-info-label">Nama Perusahaan</div>
                <div class="detail-info-value">{{ $company->nama_perusahaan ?? 'Gojek' }}</div>
            </div>

            <div class="detail-info-row">
                <div class="detail-info-label">Jenis Industri</div>
                <div class="detail-info-value">{{ $company->industri ?? 'Real Estate & Property' }}</div>
            </div>

            <div class="detail-info-row">
                <div class="detail-info-label">Jumlah Karyawan</div>
                <div class="detail-info-value">{{ $company->jumlah_karyawan ?? 'More than 10,000' }}</div>
            </div>

            <div class="detail-info-row">
                <div class="detail-info-label">Bergabung Sejak</div>
                <div class="detail-info-value">
                    {{ $company->created_at->format('d F Y') }}
                </div>
            </div>

            <div class="detail-info-row">
                <div class="detail-info-label">Lokasi utama</div>
                <div class="detail-info-value">
                    @if($company->provinsi)
                        {{ $company->provinsi }}, {{ $company->kota }}, {{ $company->kecamatan }},
                        {{ $company->desa_kelurahan }}, {{ $company->alamat_lengkap }}
                    @else
                        Sinar Mas Land Plaza BSD, Jl. Grand Boulevard, BSD Green Office Park, BSD City - Tangerang
                    @endif
                </div>
            </div>

        </div>

        <!-- Deskripsi Perusahaan dari Database -->
        <div class="detail-description">
            <h3>Deskripsi Perusahaan</h3>
            <p class="@if($company->deskripsi_perusahaan) description-content @endif">
                @if($company->deskripsi_perusahaan)
                    {{ $company->deskripsi_perusahaan }}
                @else
                    Sinar Mas Land Limited (sebelumnya dikenal sebagai AFP Properties Limited), terdaftar di Bursa Efek Singapura dan berkantor pusat di Singapura, bergerak di bisnis properti melalui operasinya di Indonesia, Tiongkok, Malaysia, dan Singapura. Sinar Mas Land memiliki investasi jangka panjang di gedung-gedung komersial besar, hotel, dan resor, serta terlibat dalam pengembangan dan penyewaan properti di Indonesia, Tiongkok, Malaysia, dan Singapura.
                @endif
            </p>
        </div>

        <!-- Visi dari Database -->
        <div class="vision">
            <h3>Visi</h3>
            <p class="@if($company->visi) database-content @endif">
                @if($company->visi)
                    {{ $company->visi }}
                @else
                    Menjadi sumber pembiayaan produk-produk Indomobil Group, yang terbaik dalam hal kepuasan pelanggan, terbesar dalam jumlah pembiayaan dan perolehan tingkat keuntungan bagi para pemegang saham
                @endif
            </p>
        </div>

        <!-- Misi dari Database -->
        <div class="mission">
            <h3>Misi</h3>
            <p class="@if($company->misi) database-content @endif">
                @if($company->misi)
                    {{ $company->misi }}
                @else
1. Mengembangkan produk teknologi inovatif yang relevan dengan kebutuhan pasar.
2. Meningkatkan kualitas layanan dengan standar internasional.
3. Menciptakan lingkungan kerja kolaboratif yang mendukung kreativitas dan pertumbuhan karyawan.
4. Berperan aktif dalam pembangunan berkelanjutan melalui solusi digital ramah lingkungan.
                @endif
            </p>
        </div>

    </div>

</div>

@include('partials.footer')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
