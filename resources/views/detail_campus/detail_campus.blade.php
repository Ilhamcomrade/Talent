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
        /* ================= TAB STYLE ================= */
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

        /* ==================== RESET LAMA TETAP DIPERTAHANKAN ==================== */
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
            /* PERUBAHAN: Mengurangi margin-top untuk menaikkan konten */
            margin-top: -45px;
        }

        /* PERUBAHAN UTAMA: Layout header dengan flexbox */
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
            /* background-color: #f5f5f5; */
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            font-weight: bold;
            color: #666;
            padding: 10px;
        }

        /* PERUBAHAN: Menyesuaikan layout info section */
        #detail-page-content .detail-info-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            /* PERUBAHAN: Menggunakan flex-start agar konten sejajar dengan logo */
            justify-content: flex-start;
            /* PERUBAHAN: Menghapus padding-top dan menggunakan margin-top pada child elements */
            padding-top: 0;
            height: 200px; /* Sesuai tinggi logo */
        }

        #detail-page-content .detail-name {
            font-size: 32px;
            font-weight: bold;
            color: #000;
            margin-bottom: 10px;
            /* PERUBAHAN: Menambahkan margin-top untuk posisi tengah */
            margin-top: 20px; /* Disesuaikan agar nama berada di tengah vertikal */
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

        #detail-page-content .detail-section-title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 25px;
            color: #000;
        }

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
            margin-bottom: 12px;
            text-align: justify;
            color: #555;
            line-height: 1.7;
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

        <!-- TAB NAV (Sekarang berada di bawah logo dan info) -->
        <div class="detail-nav-menu">
            <a href="{{ route('campus.detail', ['campus' => $campus->slug]) }}" class="detail-nav-item active">Tentang</a>
            <a href="{{ route('campus.culture', ['campus' => $campus->slug]) }}" class="detail-nav-item">Kehidupan dan Budaya</a>
            <a href="{{ route('campus.prodi', ['campus' =>$campus->slug]) }}" class="detail-nav-item">Program Studi</a>
            <a href="{{ route('campus.facility', ['campus' =>$campus->slug]) }}" class="detail-nav-item">Fasilitas</a>
            {{-- <button class="detail-nav-item">Ulasan</button> --}}
        </div>
    </div>

    <!-- Main Content -->
    <div class="detail-main-content">

        <h2 class="detail-section-title">Sekilas tentang Kampus/Sekolah</h2>

        <div class="detail-info-table">
            <div class="detail-info-row">
                <div class="detail-info-label">Nama Kampus/Sekolah</div>
                <div class="detail-info-value">{{ $campus->nama_kampus }}</div>
            </div>

            <div class="detail-info-row">
                <div class="detail-info-label">Jenis Institusi</div>
                <div class="detail-info-value">{{ $campus->jenis_institusi }}</div>
            </div>

            <div class="detail-info-row">
                <div class="detail-info-label">Jumlah Pegawai</div>
                <div class="detail-info-value">
                    {{ $campus->jumlah_pegawai }} pegawai
                </div>
            </div>

            <div class="detail-info-row">
                <div class="detail-info-label">Bergabung Sejak</div>
                <div class="detail-info-value">
                    {{ $campus->created_at->format('d F Y') }}
                </div>
            </div>


            <div class="detail-info-row">
                <div class="detail-info-label">Lokasi Utama</div>
                <div class="detail-info-value">
                    {{ $campus->provinsi }}, {{ $campus->kota }}, {{ $campus->kecamatan }},
                    {{ $campus->desa_kelurahan }}, {{ $campus->alamat_lengkap }}
                </div>
            </div>
        </div>

                <div class="detail-description">
                <h3>Deskripsi Kampus/Sekolah</h3>
                <p>
                    {{ $campus->nama_kampus }} merupakan institusi pendidikan yang berkomitmen untuk memberikan pendidikan berkualitas tinggi dan pengalaman belajar yang transformatif bagi seluruh mahasiswa.
                </p>
                <p>
                    <strong>{{ $campus->nama_kampus }} secara konsisten diakui sebagai salah satu institusi pendidikan terbaik. Kami menawarkan lingkungan belajar yang menantang dan mendukung.</strong>
                </p>
            </div>

    </div>

</div>

@include('partials.footer')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
