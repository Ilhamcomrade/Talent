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

        #detail-page-content .detail-section-title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 25px;
            color: #000;
        }

        /* ===================== STYLE UNTUK FASILITAS DAN KEUNGGULAN ===================== */
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

        <!-- TAB NAV -->
        <div class="detail-nav-menu">
            <a href="{{ route('campus.detail', ['campus' => $campus->slug]) }}" class="detail-nav-item">Tentang</a>
            <a href="{{ route('campus.culture', ['campus' => $campus->slug]) }}" class="detail-nav-item active">Kehidupan dan Budaya</a>
            <a href="{{ route('campus.prodi', ['campus' =>$campus->slug]) }}" class="detail-nav-item">Program Studi</a>
            <a href="{{ route('campus.facility', ['campus' =>$campus->slug]) }}" class="detail-nav-item">Fasilitas</a>
            {{-- <button class="detail-nav-item">Ulasan</button> --}}
        </div>
    </div>

    <!-- CONTENT BARU -->
    <div class="detail-main-content">

        <!-- FASILITAS DAN KEUNGGULAN -->
        <div class="benefits-section">
            <h2 class="detail-section-title">Fasilitas dan keunggulan</h2>

            <div class="benefits-grid">
                <!-- Perpustakaan -->
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="bi bi-gift-fill"></i>
                    </div>
                    <div class="benefit-content">
                        <div class="benefit-title">Perpustakaan Modern</div>
                        <div class="benefit-description">Perpustakaan dengan koleksi lengkap dan ruang belajar yang nyaman</div>
                    </div>
                </div>

                <!-- Laboratorium -->
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="bi bi-gift-fill"></i>
                    </div>
                    <div class="benefit-content">
                        <div class="benefit-title">Laboratorium Lengkap</div>
                        <div class="benefit-description">Fasilitas laboratorium dengan peralatan modern untuk praktikum</div>
                    </div>
                </div>

                <!-- Asrama -->
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="bi bi-gift-fill"></i>
                    </div>
                    <div class="benefit-content">
                        <div class="benefit-title">Asrama Mahasiswa</div>
                        <div class="benefit-description">Akomodasi nyaman dan aman untuk mahasiswa</div>
                    </div>
                </div>

                <!-- Beasiswa -->
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="bi bi-gift-fill"></i>
                    </div>
                    <div class="benefit-content">
                        <div class="benefit-title">Program Beasiswa</div>
                        <div class="benefit-description">Berbagai program beasiswa untuk mahasiswa berprestasi</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MENGAPA BERGABUNG DENGAN KAMI -->
        <div class="why-join-section">
            <h2 class="why-join-title">Mengapa bergabung dengan kami?</h2>

            <p class="why-join-text">
                Visi "Menjadi institusi pendidikan terkemuka yang menghasilkan lulusan berkualitas, berkarakter, dan siap
                bersaing di tingkat nasional maupun internasional dengan mengedepankan inovasi dan pengembangan ilmu pengetahuan".
            </p>

            <p class="why-join-text">
                Misi "Menyelenggarakan pendidikan berkualitas tinggi dengan kurikulum yang relevan, memfasilitasi penelitian
                dan pengabdian masyarakat, mengembangkan sumber daya manusia yang profesional, serta menciptakan lingkungan
                akademik yang kondusif untuk pengembangan potensi mahasiswa secara optimal"
            </p>
        </div>

    </div>

</div>

@include('partials.footer')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
