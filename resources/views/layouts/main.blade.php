<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Next Jobz Situs Lowongan kerja terbaik di jawa</title>
    <link rel="icon" type="image/png" href="{{ asset('1.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        /* Warna-warna khusus */
        .text-green { color: #28a745; }
        .bg-green { background-color: #28a745; }
        .btn-green {
            background-color: #28a745;
            color: white;
        }
        .btn-green:hover {
            background-color: #218838;
            color: white;
        }
        .text-orange-custom { color: #FF6633; }
        .text-custom-gray { color: #6c757d; }
        .text-red-custom { color: #e11c25; }
        .text-dark-gray { color: #495057; }

        .search-box .form-control,
        .search-box .form-select {
            border-radius: 6px;
            border: none;
            padding: 0.75rem 1rem;
        }
        .input-keyword { width: 250px; }
        .btn-pink {
            background-color: #e6007e;
            color: #fff;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s ease-in-out;
            width: 80px;
        }
        .btn-pink:hover {
            background-color: #c7006c;
            color: #fff;
            transform: translateY(-2px);
        }
        .search-label {
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
            display: block;
        }
        .search-options-wrapper {
            text-align: right;
            margin-top: 1rem;
            padding-right: 0.5rem;
        }
        .more-options {
            font-size: 0.9rem;
            font-weight: 600;
            color: #fff;
            text-decoration: none;
            padding-right: 100px;
        }
        .more-options:hover { color: #e6007e; }

        /* Hero section */
        .hero-section {
            position: relative;
            padding: 5rem 0;
            background-color: #f6f8f5;
            overflow: hidden;
            margin-top: 0;
        }
        .hero-background-image {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background-image:  url('/images/hero-image.png');

            background-size: contain;
            background-position: right 0px;
            background-repeat: no-repeat;
            opacity: 0.3;
            z-index: 0;
        }
        .hero-content {
            position: relative;
            z-index: 1;
        }
        .hero-title {
            color: #495057;
            font-weight: 500;
        }
        .hero-text { color: #6c757d; }

        /* Kategori pekerjaan */
        .category-card {
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            text-align: center;
            padding: 0.75rem;
            transition: all 0.2s ease-in-out;
            cursor: pointer;
        }
        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .category-card .card-title { font-size: 1rem; }
        .category-heading { color: #495057; }

        /* Tag "Dibutuhkan Segera" */
        .dibutuhkan-segera-tag {
            display: inline-block;
            background-color: #f7f7f7;
            color: #007bff;
            border: 1px solid #cce5ff;
            border-radius: 9999px;
            padding: 0.2rem 1rem;
            margin: 0.25rem;
            font-size: 0.9rem;
            font-weight: 400;
            transition: all 0.2s ease-in-out;
            cursor: pointer;
            text-decoration: none;
        }
        .dibutuhkan-segera-tag:hover {
            background-color: #e2e6ea;
            color: #0056b3;
            border-color: #b8daff;
        }

        /* Style tambahan untuk perusahaan terpercaya dari database */
        .trusted-companies .default-logo {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #0d47a1, #1976d2);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 14px;
            text-transform: uppercase;
            margin: 0 auto;
        }

        .trusted-companies .logo-card img {
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            object-fit: contain;
        }

        /* PERBAIKAN: Layout grid untuk 4 logo per baris */
        .trusted-companies .logo-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            row-gap: 1rem;
        }

        .trusted-companies .logo-wrapper {
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 75px;
        }

        .trusted-companies .logo-card {
            background-color: transparent;
            border: 1px solid transparent;
            border-radius: 8px;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            box-shadow: none;
        }

        .trusted-companies .logo-card:hover {
            transform: translateY(-5px);
            background-color: rgba(255, 255, 255, 0.4);
            border-color: rgba(224, 224, 224, 0.4);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.05);
        }

        .trusted-companies .logo {
            max-width: 90%;
            max-height: 70px;
            width: auto;
            height: auto;
            opacity: 0.8;
        }

        .trusted-companies .logo:hover {
            opacity: 1;
        }

        /* Responsive design untuk perusahaan terpercaya */
        @media (max-width: 768px) {
            .trusted-companies .logo-container {
                grid-template-columns: repeat(3, 1fr); /* 3 logo per baris di tablet */
            }

            .trusted-companies .logo-wrapper {
                height: 65px;
            }

            .trusted-companies .default-logo {
                width: 50px;
                height: 50px;
                font-size: 12px;
            }
        }

        @media (max-width: 576px) {
            .trusted-companies .logo-container {
                grid-template-columns: repeat(2, 1fr); /* 2 logo per baris di mobile */
            }

            .trusted-companies .logo-wrapper {
                height: 60px;
            }

            .trusted-companies .default-logo {
                width: 45px;
                height: 45px;
                font-size: 11px;
            }
        }

        .see-more-offset {
            margin-left: 20px;
        }


        /* Glints Section */
    .glints-section {
        background-color: #f6f8f5;
    }

    .glints-section h2 {
        font-size: 2.25rem;
        font-weight: 700;
    }

    .glints-section p {
        font-size: 1.1rem;
        color: #6c757d;
    }

    /* Card Testimoni */
    .testimonial-card {
        background-color: white; /* Background card dibuat putih */
        border: 1px solid #e0e0e0;
        border-radius: 0.5rem;
        padding: 2rem;
        height: 100%;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease-in-out;
        display: flex;
        flex-direction: column;
        position: relative;
        min-height: 450px; /* Tinggi minimum dinaikkan untuk foto yang lebih besar */
    }

    .testimonial-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    }

    /* Container foto untuk membuat foto di tengah */
    .testimonial-photo-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 2rem; /* Margin bawah lebih besar untuk foto yang lebih besar */
    }

    /* Foto testimoni - ukuran diperbesar */
    .testimonial-photo {
        width: 160px; /* Diperbesar dari 100px */
        height: 160px; /* Diperbesar dari 100px */
        border-radius: 50%;
        object-fit: cover; /* Memastikan foto tidak terdistorsi */
        object-position: center; /* Posisikan foto di tengah */
        border: 4px solid #f0f0f0; /* Border sedikit lebih tebal */
    }

    /* Konten testimoni */
    .testimonial-content {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    /* Kesan pesan - rata kiri */
    .testimonial-quote {
        font-size: 1rem;
        color: #495057;
        margin-bottom: 1.5rem;
        word-wrap: break-word;
        overflow-wrap: break-word;
        white-space: normal;
        text-align: left; /* Rata kiri */
        line-height: 1.6;
        flex-grow: 1; /* Mengisi ruang yang tersedia */
    }

    /* Footer testimoni - tanpa garis pemisah */
    .testimonial-footer {
        margin-top: auto; /* Paksa ke bawah */
        padding-top: 1rem;
        /* Hapus border-top: 1px solid #f0f0f0; */
        text-align: center; /* Teks di tengah */
    }

    .testimonial-author {
        font-weight: 600;
        font-size: 1.1rem;
        color: #333;
        margin-bottom: 0.25rem;
    }

    .testimonial-role {
        font-size: 0.9rem;
        color: #6c757d;
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .testimonial-card {
            padding: 1.5rem;
            min-height: 420px; /* Disesuaikan untuk ukuran tablet */
        }

        .testimonial-photo {
            width: 120px; /* Diperbesar dari 90px */
            height: 120px; /* Diperbesar dari 90px */
        }

        .testimonial-quote {
            font-size: 0.95rem;
        }
    }

    @media (max-width: 576px) {
        .testimonial-card {
            padding: 1.25rem;
            min-height: 400px; /* Disesuaikan untuk ukuran mobile */
        }

        .testimonial-photo {
            width: 100px; /* Diperbesar dari 80px */
            height: 100px; /* Diperbesar dari 80px */
        }

        .testimonial-quote {
            font-size: 0.9rem;
        }

        .testimonial-author {
            font-size: 1rem;
        }

        .testimonial-role {
            font-size: 0.85rem;
        }
    }

    /* Untuk tabel admin */
    .table-hover td {
        vertical-align: middle;
    }

    .table-hover td small {
        display: block;
        max-width: 200px;
        word-wrap: break-word;
        overflow-wrap: break-word;
        white-space: normal;
        text-align: left;
    }

            /* Statistik */
        .stats-section { background-color: #f6f8f5; }
        .stats-title { color: #495057; }
        .stats-number {
            font-size: 2.5rem;
            font-weight: 600;
        }
        .stats-text { color: #6c757d; }

        /* Dropdown Klasifikasi */
        .dropdown-menu-scrollable {
            max-height: 300px;
            overflow-y: auto;
            padding: 0;
            min-width: 400px;
        }
        .dropdown-item-custom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.5rem 1rem;
            color: #212529;
            transition: background-color 0.2s, color 0.2s;
        }
        .dropdown-item-custom:hover,
        .dropdown-item-custom:focus {
            background-color: #e9f5ff;
            color: #007bff;
        }
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

        /* Slider Styles */
        .slider-container {
            position: relative;
            width: 100%;
            height: 500px;
            overflow: hidden;
            background-color: #000;
            margin-bottom: 2rem;
        }

        .slider-wrapper {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .slider-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 0.8s ease-in-out;
        }

        .slider-slide.active {
            opacity: 1;
        }

        .slider-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        /* Slider Navigation Buttons */
        .slider-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 20;
            transition: background-color 0.3s ease;
        }

        .slider-nav:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        .slider-nav.prev {
            left: 20px;
        }

        .slider-nav.next {
            right: 20px;
        }

        .slider-nav i {
            font-size: 1.5rem;
        }

        /* Slider Pagination - Dipindahkan ke Pojok Kiri */
        .slider-pagination {
            position: absolute;
            bottom: 20px;
            left: 20px; /* Dipindahkan ke kiri */
            display: flex;
            justify-content: flex-start; /* Mengubah dari center ke flex-start */
            gap: 10px;
            z-index: 20;
        }

        .slider-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .slider-dot:hover {
            background-color: rgba(255, 255, 255, 0.8);
            transform: scale(1.2);
        }

        .slider-dot.active {
            background-color: white;
            transform: scale(1.2);
        }

        /* Responsive Slider */
        @media (max-width: 768px) {
            .slider-container {
                height: 400px;
            }

            .slider-nav {
                width: 40px;
                height: 40px;
            }

            .slider-nav i {
                font-size: 1.2rem;
            }

            .slider-nav.prev {
                left: 10px;
            }

            .slider-nav.next {
                right: 10px;
            }

            /* Pagination di mobile juga di kiri */
            .slider-pagination {
                bottom: 15px;
                left: 15px;
            }
        }

        @media (max-width: 576px) {
            .slider-container {
                height: 300px;
            }

            .slider-nav {
                width: 35px;
                height: 35px;
            }

            .slider-nav i {
                font-size: 1rem;
            }

            /* Pagination di mobile kecil */
            .slider-pagination {
                bottom: 10px;
                left: 10px;
                gap: 8px;
            }

            .slider-dot {
                width: 10px;
                height: 10px;
            }
        }

        /* Search Box di Tengah Slider - Background Hitam Transparan (TANPA BLUR) */
        .slider-search-container {
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            transform: translateY(-50%);
            z-index: 10;
            padding: 0 20px;
        }

        .slider-search-box {
            background-color: rgba(0, 0, 0, 0.5); /* Hitam transparan 50% */
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            max-width: 1200px;
            margin: 0 auto;
            border: 1px solid rgba(255, 255, 255, 0.1);
            /* HAPUS backdrop-filter agar gambar slider tetap jelas */
        }

        .slider-search-box .search-label {
            color: white; /* Warna putih untuk kontras dengan background hitam */
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
            display: block;
        }

        .slider-search-box .form-control {
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 6px;
            padding: 0.75rem 1rem;
            background-color: rgba(255, 255, 255, 0.95); /* Putih hampir solid untuk input */
            transition: all 0.3s ease;
            color: #333;
        }

        .slider-search-box .form-control:focus {
            border-color: #e6007e;
            box-shadow: 0 0 0 0.25rem rgba(230, 0, 126, 0.25);
            background-color: white;
        }

        .slider-search-box .form-control::placeholder {
            color: #666;
        }

        .slider-search-box .btn.dropdown-toggle {
            background-color: rgba(255, 255, 255, 0.95);
            color: #212529;
            border: 1px solid rgba(255, 255, 255, 0.3);
            text-align: left;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 1rem;
            width: 100%;
        }

        .slider-search-box .btn.dropdown-toggle:hover {
            border-color: rgba(255, 255, 255, 0.5);
            background-color: white;
        }

        .slider-search-box .btn-pink {
            background-color: #e6007e;
            color: #fff;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
            transition: all 0.3s ease;
            width: 100%;
            height: 100%;
        }

        .slider-search-box .btn-pink:hover {
            background-color: #c7006c;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.5);
        }

        /* Dropdown menu styling untuk search box di slider */
        .slider-search-box .dropdown-menu {
            border: 1px solid #dee2e6;
            border-radius: 6px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            margin-top: 5px;
            background-color: white;
        }

        .slider-search-box .dropdown-item-custom {
            padding: 0.75rem 1rem;
            transition: all 0.2s ease;
        }

        .slider-search-box .dropdown-item-custom:hover {
            background-color: #f8f9fa;
        }

        /* Responsive styling untuk search box di slider */
        @media (max-width: 768px) {
            .slider-search-container {
                padding: 0 15px;
            }

            .slider-search-box {
                padding: 20px;
                margin-top: 20px;
                background-color: rgba(0, 0, 0, 0.6); /* Sedikit lebih gelap di mobile */
            }

            .slider-search-box .search-label {
                font-size: 0.9rem;
            }

            .slider-search-box .form-control,
            .slider-search-box .btn.dropdown-toggle {
                padding: 0.6rem 0.8rem;
                font-size: 0.9rem;
            }
        }

        @media (max-width: 576px) {
            .slider-search-container {
                padding: 0 10px;
            }

            .slider-search-box {
                padding: 15px;
                margin-top: 30px;
                background-color: rgba(0, 0, 0, 0.65); /* Lebih gelap lagi di mobile kecil */
            }

            .slider-search-box .search-label {
                font-size: 0.85rem;
            }

            .slider-search-box .form-control,
            .slider-search-box .btn.dropdown-toggle {
                padding: 0.5rem 0.7rem;
                font-size: 0.85rem;
            }

            .slider-search-box .btn-pink {
                padding: 0.6rem 1rem;
                font-size: 0.9rem;
            }
        }

        /* Untuk tablet dan mobile, turunkan posisi search box agar tidak menutupi navigation */
        @media (max-width: 992px) {
            .slider-search-container {
                top: 60%;
                transform: translateY(-60%);
            }
        }

        /* Pastikan search box tidak overlap dengan navigation buttons */
        @media (max-width: 768px) {
            .slider-nav {
                z-index: 20; /* Navigation buttons di atas search box */
            }

            .slider-search-box {
                margin-top: 40px; /* Beri jarak dari navigation buttons */
            }
        }

        /* FAQ Section Styles - DIPERBAIKI untuk rata kiri */
        .faq-section {
            background-color: #f6f8f5;
        }

        .faq-title h2 {
            color: #333;
            font-size: 2.25rem;
            margin-bottom: 3rem;
        }

        /* Container FAQ - Memastikan rata kiri */
        .faq-container {
            width: 100%;
            text-align: left;
        }

        /* Gaya khusus untuk pertanyaan FAQ - DIPAKSA RATA KIRI */
        .accordion-button {
            background-color: #ffffff !important;
            color: #333 !important;
            font-size: 1.1rem !important;
            padding: 1.25rem 1.5rem !important;
            border: 1px solid #dee2e6 !important;
            text-align: left !important;
            display: block !important;
            width: 100% !important;
            text-align-last: left !important;
            -moz-text-align-last: left !important;
        }

        /* HAPUS EFEK WARNA BIRU SAAT TERBUKA */
        .accordion-button:not(.collapsed) {
            background-color: #ffffff !important;
            color: #333 !important; /* Tetap warna hitam, bukan biru */
            box-shadow: none !important;
            border-bottom: none !important;
        }

        .accordion-button:focus {
            box-shadow: none !important;
            border-color: rgba(0,0,0,.125) !important;
        }

        .accordion-button::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23333'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e") !important;
            float: right !important;
            margin-top: 0 !important;
        }

        /* HAPUS WARNA BIRU PADA PANAH SAAT TERBUKA */
        .accordion-button:not(.collapsed)::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23333'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e") !important;
            transform: rotate(-180deg) !important; /* Tetap rotasi panah, tapi tanpa warna biru */
        }

        .accordion-body {
            background-color: #ffffff;
            color: #555;
            font-size: 1rem;
            line-height: 1.6;
            padding: 1.5rem;
            border-top: 1px solid #dee2e6;
            text-align: left !important;
        }

        .accordion-item {
            border: 1px solid #dee2e6;
            border-radius: 8px !important;
            overflow: hidden;
            background-color: #ffffff;
        }

        .accordion-item .accordion-button {
            border-radius: 8px 8px 0 0;
        }

        .accordion-item .accordion-button.collapsed {
            border-radius: 8px;
        }

        /* Responsive FAQ */
        @media (max-width: 768px) {
            .faq-title {
                font-size: 1.75rem;
            }

            .accordion-button {
                font-size: 1rem !important;
                padding: 1rem 1.25rem !important;
            }

            .accordion-body {
                padding: 1.25rem;
            }
        }

        @media (max-width: 576px) {
            .faq-title {
                font-size: 1.5rem;
            }

            .accordion-button {
                font-size: 0.95rem !important;
                padding: 0.875rem 1rem !important;
            }
        }
    </style>
</head>

<body style="background-color: #f6f8f5;">

    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
