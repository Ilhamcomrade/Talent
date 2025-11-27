<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saran Karier | Next Jobz</title>

    <link rel="icon" type="image/png" href="{{ asset('123.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>

        /* === SLIDER STYLE (Existing) === */
        .article-slider {
            position: relative;
            max-width: 1200px;
            margin: 50px auto 60px auto;
            overflow: visible;
            border-radius: 12px;
        }

        .article-slides-wrapper {
            overflow: hidden;
            border-radius: 12px;
        }

        .article-slides {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .article-slide {
            min-width: 100%;
            display: flex;
            flex-direction: row;
            align-items: stretch;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }

        .article-slide img {
            width: 50%;
            height: 350px;
            object-fit: cover;
        }

        .article-content {
            width: 50%;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .article-content h3 {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #333;
        }

        .article-content a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
        }

        .article-content a:hover {
            text-decoration: underline;
        }

        /* Navigation Arrows (Existing) */
        .slider-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: white;
            border-radius: 50%;
            padding: 10px;
            cursor: pointer;
            box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.2);
            z-index: 10;
        }

        .slider-btn:hover {
            background: #f1f1f1;
        }

        .slider-btn.left {
            left: -50px;
        }

        .slider-btn.right {
            right: -50px;
        }

        /* Pagination dots (Existing) */
        .slider-dots {
            text-align: center;
            margin-top: -40px;
        }

        .slider-dots span {
            display: inline-block;
            height: 10px;
            width: 10px;
            margin: 0 5px;
            background-color: #d1d1d1;
            border-radius: 50%;
            cursor: pointer;
        }

        .slider-dots .active {
            background-color: #0b0b54;
        }

        /* === 3 Cards Section === */
        /* Hapus max-width dan pertahankan padding 40px untuk menentukan lebar konten */
        .career-cards {
            width: 100%;
            padding: 60px 40px; /* Jarak 40px dari kiri dan kanan */
            margin: 30px auto 60px auto;
            margin-top: 30px;
        }

        .career-cards h2 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 40px;
            color: #333;
            text-align: left;
            /* Hapus padding/margin tambahan di sini, sudah dihandle oleh .career-cards */
        }

        .career-cards .row {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: nowrap;
            /* Hapus padding/margin tambahan di sini */
        }

        .career-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 12px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            flex: 1;
            min-height: 150px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .career-card img {
            width: 90px;
            height: 90px;
            object-fit: contain;
            flex-shrink: 0;
        }

        .career-card h5 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 6px;
            color: #333;
        }

        .career-card p {
            font-size: 18px;
            color: #333;
            margin: 0;
        }

        /* === SARAN KARIR TERBARU SECTION (DIPERLEBAR) === */
        .career-latest-advice-section {
            width: 100%; /* Lebar penuh */
            padding: 0 40px; /* Menyamakan jarak 40px dari kiri dan kanan seperti .career-cards */
            margin: 0 auto 60px auto;
            /* Hapus max-width */
        }

        .advice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding: 0; /* Hapus padding yang sebelumnya 0 15px */
        }

        .advice-header h2 {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin: 0;
        }

        .advice-header a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
            font-size: 20px;
            display: flex;
            align-items: center;
        }

        .advice-header a:hover {
            text-decoration: underline;
        }

        /* Card Utama/Besar */
        .main-advice-card {
            display: flex;
            flex-direction: row;
            align-items: stretch;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            margin-left: 0; /* Hapus margin yang sebelumnya 15px */
            margin-right: 0; /* Hapus margin yang sebelumnya 15px */
        }

        .main-advice-card img {
            width: 60%;
            height: 350px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .main-advice-content {
            width: 40%;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .main-advice-content h3 {
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #333;
            line-height: 1.3;
        }

        .main-advice-content a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
            margin-top: 10px;
        }

        .main-advice-content a:hover {
            text-decoration: underline;
        }

        /* 4 Kartu Kecil di Bawah */
        .small-advice-cards-row {
            display: flex;
            gap: 20px;
            justify-content: space-between;
            padding: 0; /* Hapus padding yang sebelumnya 0 15px */
        }

        .small-advice-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            flex: 1;
            max-width: calc(25% - 15px); /* Pertahankan ini, gap 20px (3x20 = 60), (100% - 60px)/4 */
            min-height: 250px;
            display: flex;
            flex-direction: column;
        }

        .small-advice-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .small-advice-card-body {
            padding: 15px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .small-advice-card-body h4 {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            line-height: 1.4;
            margin: 0;
        }

         /* === Career Suggestions Section === */
        .career-suggestions {
        width: 100%;
        padding: 0 40px;
        margin: 60px auto;   /* ini jarak default (atas & bawah) */
        margin-top: 100px;    /* atur manual jarak dari section atas */
    }


    .career-suggestions h2 {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 25px;
        color: #333;
        text-align: left;
    }

    .career-suggestions .row {
        display: flex;
        gap: 20px;
        justify-content: flex-start;
        flex-wrap: wrap;
    }

    .career-suggestion-card {
        flex: 1;
        min-width: 300px;
        display: flex;
        align-items: center;
        gap: 15px;
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }

    .career-suggestion-card img {
        width: 90px;
        height: 90px;
        object-fit: contain;
        flex-shrink: 0;
    }

    .career-suggestion-card h5 {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 6px;
        color: #333;
    }

    .career-suggestion-card p {
        font-size: 18px;
        color: #555;
        margin: 0;
    }

    /* === Career Industry Section === */
    .career-industries {
        width: 100%;
        padding: 0 40px;
        margin: 80px auto;
        margin-top: 100px;
        text-align: left;
    }

    .career-industries h2 {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 10px;
        color: #333;
    }

    .career-industries .subtitle {
        font-size: 18px;
        color: #666;
        margin-bottom: 25px;
    }

    /* Grid untuk tombol agar rata */
    .industry-list {
        display: grid;
        grid-template-columns: repeat(5, 1fr); /* 5 kolom per baris */
        gap: 20px;
    }

    .industry-list button {
        border: 1px solid #dcdcdc;
        border-radius: 999px;
        background: #fff;
        padding: 12px 15px;
        font-size: 16px;
        font-weight: 500; /* agak bold tapi tidak terlalu tebal */
        color: #222;
        cursor: pointer;
        transition: background 0.2s ease;
        width: 100%; /* semua tombol full mengikuti grid */
        text-align: center;
    }

    .industry-list button:hover {
        background: #f5f5f5;
    }

    .see-more {
        text-align: center;
        margin-top: 25px;
    }

    .see-more a {
        font-size: 18px;
        font-weight: 500;
        color: #333;
        text-decoration: none;
    }

    .see-more a:hover {
        text-decoration: none;
    }

        /* === Career Change Section (Merubah Karir) === */
    .career-change-section {
        width: 100%;
        padding: 0 40px;
        margin: 80px auto;
        margin-top: 100px;
    }

    .change-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .change-header h2 {
        font-size: 24px;
        font-weight: 600;
        color: #333;
        margin: 0;
    }

    .change-header a {
        color: #333;
        text-decoration: none;
        font-weight: 500;
        font-size: 18px;
        display: flex;
        align-items: center;
    }

    .change-header a:hover {
        text-decoration: underline;
    }

    .change-cards-row {
        display: flex;
        gap: 20px;
        justify-content: space-between;
    }

    .change-card {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        flex: 1;
        min-height: 230px;
        display: flex;
        flex-direction: column;
    }

    .change-card img {
        width: 100%;
        height: 180px; /* semua gambar dipaksa sama */
        object-fit: cover;
        flex-shrink: 0;
    }

    .change-card-body {
        padding: 15px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .change-card-body h4 {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        line-height: 1.4;
        margin: 0;
    }

        /* === Interview Practice Section === */
        .interview-practice-section {
            width: 95%; /* beri ruang di kanan dan kiri */
            background-color: #5564cc; /* warna biru seperti di gambar */
            border-radius: 16px;
            margin: 80px auto;
            margin-top: 100px;
            padding: 80px 100px; /* perbesar isi card */
            box-sizing: border-box;
        }

        .interview-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 60px; /* beri jarak lebih lebar antara teks dan gambar */
        }

        .interview-text {
            flex: 1;
            color: #fff;
        }

        .interview-text h2 {
            font-size: 30px; /* lebih besar */
            font-weight: 600;
            margin-bottom: 15px;
        }

        .interview-text p {
            font-size: 18px;
            margin-bottom: 30px;
            color: #f0f0f0;
            white-space: nowrap; /* supaya kalimat tidak turun ke baris baru */
        }

        .interview-text button {
            background: #fff;
            color: #0b0b54;
            border: none;
            border-radius: 8px;
            padding: 12px 28px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .interview-text button:hover {
            background: #f5f5f5;
        }

        .interview-image {
            flex: 1;
            display: flex;
            justify-content: flex-end;
        }

        .interview-image img {
            max-width: 100%;
            height: auto;
            width: 420px; /* ikon lebih besar dari sebelumnya */
            object-fit: contain;
        }

                /* === Salary Trend Section (Tren Gaji & Profesi) === */
        .salary-trend-section {
            width: 100%;
            padding: 0 40px;
            margin: 80px auto;
            margin-top: 100px;
        }

        .salary-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .salary-header h2 {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin: 0;
        }

        .salary-header a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
            font-size: 18px;
            display: flex;
            align-items: center;
        }

        .salary-header a:hover {
            text-decoration: underline;
        }

        .salary-cards-row {
            display: flex;
            gap: 20px;
            justify-content: space-between;
        }

        .salary-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            flex: 1;
            min-height: 240px;
            display: flex;
            flex-direction: column;
            transition: transform 0.2s ease;
        }

        .salary-card:hover {
            transform: translateY(-3px);
        }

        .salary-card img {
            width: 100%;
            height: 150px; /* semua gambar disamakan */
            object-fit: cover;
            flex-shrink: 0;
        }

        .salary-card-body {
            padding: 15px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .salary-card-body h4 {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            line-height: 1.4;
            margin: 0;
        }

    /* === Subscription Section (Berlangganan Panduan Karir) === */
    .career-subscribe-section {
        width: 100%; /* mengikuti lebar salary-trend-section */
        padding: 0 40px; /* sama seperti salary-trend-section */
        margin: 100px auto;
        box-sizing: border-box;
    }

    .career-subscribe-card {
        background: #fff;
        border: 1px solid #dcdcdc;
        border-radius: 16px;
        padding: 40px 50px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        width: 100%;
        box-sizing: border-box;
        transition: all 0.3s ease;
    }

    .career-subscribe-card:hover {
        transform: translateY(-3px);
    }

    .career-subscribe-section h2 {
        font-size: 24px;
        font-weight: 600;
        color: #1c1c1c;
        margin-bottom: 10px;
    }

    .career-subscribe-section p {
        font-size: 18px;
        color: #333;
        margin-bottom: 30px;
    }

    .subscribe-form {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 25px;
    }

    .subscribe-form .form-group {
        flex: 1;
        min-width: 200px;
        display: flex;
        flex-direction: column;
    }

    .subscribe-form label {
        font-size: 16px;
        font-weight: 500;
        color: #333;
        margin-bottom: 6px;
    }

    .subscribe-form input {
        border: 1px solid #bfc5d2;
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 16px;
        outline: none;
        transition: border 0.2s ease;
        width: 100%;
    }

    .subscribe-form input:focus {
        border-color: #0b0b54;
    }

    .subscribe-form button {
        background: #f3f4f6;
        color: #1c1c1c;
        border: none;
        border-radius: 8px;
        padding: 10px 30px;
        font-size: 16px;
        font-weight: 600;
        align-self: flex-end;
        cursor: pointer;
        transition: background 0.3s ease;
        height: 42px;
    }

    .subscribe-form button:hover {
        background: #e6e7e8;
    }

    .career-subscribe-section small {
        font-size: 16px;
        color: #555;
        line-height: 1.6;
    }

    /* === Garis bawah permanen pada link === */
    .career-subscribe-section small a {
        color: #0b0b54;
        text-decoration: underline; /* underline permanen */
        font-weight: 500;
    }

    .career-subscribe-section small a:hover {
        text-decoration: underline; /* tetap underline saat hover */
    }

              /* WhatsApp Floating Button - Functional */
        .whatsapp-float {
            position: fixed;
            bottom: 80px; /* Dinaikkan dari 25px menjadi 80px */
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
                bottom: 70px; /* Dinaikkan dari 20px menjadi 70px */
                right: 20px;
            }

            .whatsapp-logo {
                width: 55px;
                height: 55px;
            }
        }

        @media (max-width: 576px) {
            .whatsapp-float {
                bottom: 60px; /* Dinaikkan dari 15px menjadi 60px */
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
    {{-- Memanggil navbar dari file parsial --}}
    @include('partials.navbar')


    {{-- Header Import dari File Partial --}}
    @include('partials.header_career')


    <div class="article-slider">
        <div class="article-slides-wrapper">
            <div class="article-slides">
                <div class="article-slide">
                    <img src="images/kantoran.png" alt="Slide 1">
                    <div class="article-content">
                        <h3>Panduan Bekerja Freelance dan 25 Contohnya</h3>
                        <a href="#">Cari tahu selengkapnya</a>
                    </div>
                </div>
                <div class="article-slide">
                    <img src="images/kantoran1.png" alt="Slide 2">
                    <div class="article-content">
                        <h3>10 Font Terbaik untuk Resume, Hindari 5 Jenis Font Ini</h3>
                        <a href="#">Cari tahu selengkapnya</a>
                    </div>
                </div>
                <div class="article-slide">
                    <img src="images/kantoran2.png" alt="Slide 3">
                    <div class="article-content">
                        <h3>3 Cara Jitu Jawab Pertanyaan Deskripsi Diri Saat Wawancara</h3>
                        <a href="#">Cari tahu selengkapnya</a>
                    </div>
                </div>
                <div class="article-slide">
                    <img src="images/kantoran3.png" alt="Slide 4">
                    <div class="article-content">
                        <h3>5 Soft Skills yang Wajib Dikuasai agar Karier Makin Sukses</h3>
                        <a href="#">Cari tahu selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="slider-btn left" onclick="moveSlide(-1)" id="btnLeft" style="display:none;">
            <i class="fa fa-chevron-left"></i>
        </div>
        <div class="slider-btn right" onclick="moveSlide(1)" id="btnRight">
            <i class="fa fa-chevron-right"></i>
        </div>
    </div>

    <div class="slider-dots" id="sliderDots"></div>


    <div class="career-cards">
        <h2>Ingin mengubah karier? Jelajahi karier baru di luar sana!</h2>
        <div class="row">
            <div class="career-card">
                <img src="images/icon.png" alt="Jelajahi karier">
                <div>
                    <h5>Jelajahi karier</h5>
                    <p>Pelajari tentang ribuan karier, mulai dari Akuntan hingga Penjaga Kebun Binatang.</p>
                </div>
            </div>
            <div class="career-card">
                <img src="images/icon1.png" alt="Bandingkan gaji">
                <div>
                    <h5>Bandingkan gaji</h5>
                    <p>Temukan tren gaji dan manfaat yang akan Anda dapatkan di posisi berbeda.</p>
                </div>
            </div>
            <div class="career-card">
                <img src="images/icon2.png" alt="KarirKu">
                <div>
                    <h5>KarirKu</h5>
                    <p>Bangun keterampilan karier yang banyak diminati dengan akses ke pakar industri dan konten pembelajaran gratis.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="career-latest-advice-section">
        <div class="advice-header">
            <h2>Saran karier terbaru</h2>
            <a href="#">Telusuri semua <i class="fa fa-chevron-right ms-2"></i></a>
        </div>

        <div class="main-advice-card">
            <img src="images/kantoran4.png" alt="Kenaikan Gaji">
            <div class="main-advice-content">
                <h3>Kenaikan Gaji: Ini Cara Negosiasi, Alasan, dan Persentasenya</h3>
                <a href="#">Cari tahu selengkapnya</a>
            </div>
        </div>

        <div class="small-advice-cards-row">

            <div class="small-advice-card">
                <img src="images/kantoran5.png" alt="Panel Interview">
                <div class="small-advice-card-body">
                    <h4>Panel Interview: Arti, Tujuan, Contoh Pertanyaan, dan...</h4>
                </div>
            </div>

            <div class="small-advice-card">
                <img src="images/kantoran6.png" alt="Prospek Karier Perpajakan">
                <div class="small-advice-card-body">
                    <h4>10+ Prospek Karier Jurusan Perpajakan dan Kisaran Gajinya</h4>
                </div>
            </div>

            <div class="small-advice-card">
                <img src="images/kantoran7.png" alt="Employee Referral Program">
                <div class="small-advice-card-body">
                    <h4>Apa Itu Employee Referral Program? Ini Definisi, Cara Kerja...</h4>
                </div>
            </div>

            <div class="small-advice-card">
                <img src="images/kantoran8.png" alt="Exit Interview">
                <div class="small-advice-card-body">
                    <h4>Exit Interview: Arti, Pertanyaan, dan Contoh Jawabannya</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- === Career Suggestions Section === -->
    <div class="career-suggestions">
    <h2>Dapatkan saran karier yang disesuaikan untuk...</h2>
    <div class="row">
        <div class="career-suggestion-card">
            <img src="images/icon3.png" alt="Pencarian lowongan kerja">
            <div>
                <h5>Pencarian lowongan kerja</h5>
                <p>Persiapkan lamaran dan wawancara dengan tip dari ahli.</p>
            </div>
        </div>
        <div class="career-suggestion-card">
            <img src="images/icon4.png" alt="Kehidupan kerja Anda">
            <div>
                <h5>Kehidupan kerja Anda</h5>
                <p>Temukan cara memaksimalkan karier Anda.</p>
            </div>
        </div>
    </div>
</div>

    <!-- === Career Industry Section === -->
    <div class="career-industries">
        <h2>Telusuri karir berdasarkan industri</h2>
        <p class="subtitle">Eksplorasi gaji dan tren pekerjaan berbagai karir dari setiap industri.</p>

        <div class="industry-list">
            <button>Administrasi & Dukungan Perkantoran</button>
            <button>Akuntansi</button>
            <button>Asuransi & Dana Pensiun</button>
            <button>Call Center & Layanan Konsumen</button>
            <button>CEO & Manajemen Umum</button>
            <button>Desain & Arsitektur</button>
            <button>Hospitaliti & Pariwisata</button>
            <button>Hukum</button>
            <button>Kesehatan & Medis</button>
            <button>Keterampilan & Jasa</button>
        </div>

        <div class="see-more">
            <a href="#">Lihat semua industri <i class="fa fa-chevron-down"></i></a>
        </div>
    </div>

    <!-- === Career Change Section (Merubah Karir) === -->
<div class="career-change-section">
    <div class="change-header">
        <h2>Merubah karir</h2>
        <a href="#">Telusuri semua <i class="fa fa-chevron-right ms-2"></i></a>
    </div>

    <div class="change-cards-row">
        <div class="change-card">
            <img src="images/resign.png" alt="Resign 1">
            <div class="change-card-body">
                <h4>Rincian Hak-hak Karyawan Resign yang Harus Kamu Pahami</h4>
            </div>
        </div>
        <div class="change-card">
            <img src="images/resign1.png" alt="Resign 2">
            <div class="change-card-body">
                <h4>Pelajari di Sini! Proses Administrasi Karyawan Resign</h4>
            </div>
        </div>
        <div class="change-card">
            <img src="images/kantoran9.png" alt="Karier Baru">
            <div class="change-card-body">
                <h4>Cara Pindah Jalur Karier dan Tantangan Umum yang Sering...</h4>
            </div>
        </div>
        <div class="change-card">
            <img src="images/kantoran10.png" alt="Contoh Instansi">
            <div class="change-card-body">
                <h4>Kumpulan Contoh Instansi untuk Pilihan Berkarier</h4>
            </div>
        </div>
    </div>
</div>

<!-- === Interview Practice Section === -->
<div class="interview-practice-section">
    <div class="interview-content">
        <div class="interview-text">
            <h2>Bersiap-siap untuk wawancara?</h2>
            <p>Bangun rasa percaya diri Anda dengan latihan menjawab pertanyaan umum.</p>
            <button>Alat praktik wawancara</button>
        </div>
        <div class="interview-image">
            <img src="images/icon5.png" alt="Alat Praktik Wawancara">
        </div>
    </div>
</div>

<!-- === Salary Trend Section (Tren Gaji & Profesi) === -->
<div class="salary-trend-section">
    <div class="salary-header">
        <h2>Tren gaji & profesi</h2>
        <a href="#">Telusuri semua <i class="fa fa-chevron-right ms-2"></i></a>
    </div>

    <div class="salary-cards-row">
        <div class="salary-card">
            <img src="images/kantoran11.png" alt="Hotel Salary">
            <div class="salary-card-body">
                <h4>Kisaran Gaji Karyawan Hotel dari Resepsionis hingga Jabatan...</h4>
            </div>
        </div>

        <div class="salary-card">
            <img src="images/kantoran12.png" alt="UMP 2025">
            <div class="salary-card-body">
                <h4>Daftar Lengkap UMP 2025 Terbaru untuk Setiap Provinsi di...</h4>
            </div>
        </div>

        <div class="salary-card">
            <img src="images/uang.png" alt="UMK Jawa Barat">
            <div class="salary-card-body">
                <h4>Daftar UMK Jawa Barat 2025 Terbaru, Mana yang Tertinggi?</h4>
            </div>
        </div>

        <div class="salary-card">
            <img src="images/uang1.png" alt="Perbedaan UMR UMK UMP">
            <div class="salary-card-body">
                <h4>Perbedaan UMR, UMK dan UMP: Mana yang Jadi Acuan?</h4>
            </div>
        </div>
    </div>
</div>

<!-- === Subscription Section (Berlangganan Panduan Karir) === -->
<div class="career-subscribe-section">
    <div class="career-subscribe-card">
        <h2>Berlangganan Panduan Karir</h2>
        <p>Dapatkan saran karier dari ahli yang dikirimkan ke kotak masuk Anda.</p>

        <form class="subscribe-form">
            <div class="form-group">
                <label for="firstname">Nama depan</label>
                <input type="text" id="firstname" name="firstname" placeholder="">
            </div>
            <div class="form-group">
                <label for="lastname">Nama belakang</label>
                <input type="text" id="lastname" name="lastname" placeholder="">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="">
            </div>
            <button type="submit">Berlangganan</button>
        </form>

        <small>
            Dengan memberikan informasi pribadi Anda, Anda menyetujui
            <a href="#">Pemberitahuan Pengumpulan</a> dan
            <a href="#">Kebijakan Privasi</a>. Jika Anda berusia di bawah 21 tahun, Anda memiliki izin dari orang tua agar Talenthub dan afiliasinya memproses data pribadi Anda.
            Anda dapat berhenti berlangganan kapan saja.
        </small>
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

    {{-- Memanggil footer dari file parsial --}}
    @include('partials.footer')

       {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.article-slide');
        const totalSlides = slides.length;
        const slidesContainer = document.querySelector('.article-slides');
        const btnLeft = document.getElementById('btnLeft');
        const btnRight = document.getElementById('btnRight');
        const dotsContainer = document.getElementById('sliderDots');

        // Generate dots
        for (let i = 0; i < totalSlides; i++) {
            const dot = document.createElement('span');
            dot.addEventListener('click', () => goToSlide(i));
            dotsContainer.appendChild(dot);
        }
        updateDots();

        function updateSlider() {
            slidesContainer.style.transform = `translateX(-${currentSlide * 100}%)`;
            updateDots();

            btnLeft.style.display = currentSlide === 0 ? 'none' : 'block';
            btnRight.style.display = currentSlide === totalSlides - 1 ? 'none' : 'block';
        }

        function moveSlide(direction) {
            currentSlide = Math.min(Math.max(currentSlide + direction, 0), totalSlides - 1);
            updateSlider();
        }

        function goToSlide(index) {
            currentSlide = index;
            updateSlider();
        }

        function updateDots() {
            const dots = dotsContainer.querySelectorAll('span');
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentSlide);
            });
        }

        updateSlider();
    </script>
</body>
</html>
