<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Dan Ulasan Organisasi | Next Jobz</title>
    <link rel="icon" type="image/png" href="{{ asset('123.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Section Header Explore */
        html, body {
            width: 100%;
            overflow-x: hidden;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }

        .explore-wrapper {
            padding: 0;
            margin-bottom: 0;
        }

        .explore-header {
        background-color: #0b0b54;
        border-radius: 0;
        padding: 4.5rem 3rem 4.5rem 3rem;
        margin-top: 0;
        width: 100%;
        display: flex;
        flex-direction: column;
        flex-wrap: wrap;
        position: relative;
        min-height: 200px !important;
        height: 360px;
    }

        @media (min-width: 992px) {
            .image-section {
                position: absolute;
                top: 10px;
                right: 200px;
                margin: 0 !important;
            }

            .employee-image {
                width: 180px;
                height: 180px;
            }
        }

        .explore-title {
            font-size: 2.3rem;
            font-weight: 700;
            color: #fff;
            line-height: 1.3;
        }

        .explore-subtitle {
            font-size: 1.2rem;
            color: #fff;
            margin-top: 0.5rem;
            margin-bottom: 3rem;
        }

        /* STYLING BARU UNTUK KOLOM KLASIFIKASI */
        .search-container {
            width: 100%;
            display: flex;
            gap: 15px;
            margin-top: 4.5rem;
            position: relative;
        }

        .classification-container {
            position: relative;
            width: 180px; /* Lebar tetap untuk dropdown klasifikasi */
        }

        .classification-select {
            width: 100%;
            border-radius: 8px;
            padding: 0.9rem 1rem;
            font-size: 1rem;
            border: 1px solid #ddd;
            background-color: white;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 100%;
        }

        .classification-select:focus {
            border-color: #0d47a1;
            box-shadow: 0 0 6px rgba(13, 71, 161, 0.3);
        }

        .classification-options {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            display: none;
            margin-top: 5px;
        }

        .classification-options.active {
            display: block;
        }

        .classification-option {
            padding: 0.8rem 1rem;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .classification-option:hover {
            background-color: #f5f5f5;
        }

        .classification-option.active {
            background-color: #e3f2fd;
            color: #0d47a1;
            font-weight: 500;
        }

        .arrow-icon {
            transition: transform 0.3s ease;
        }

        .arrow-icon.rotated {
            transform: rotate(180deg);
        }

        .search-box {
            flex: 1;
            position: relative;
        }

        .search-input {
            border-radius: 8px;
            padding: 0.9rem 1rem 0.9rem 40px;
            font-size: 1rem;
            border: 1px solid #ddd;
            width: 100%;
            height: 100%;
        }

        .search-input:focus {
            border-color: #0d47a1;
            box-shadow: 0 0 6px rgba(13, 71, 161, 0.3);
        }

        .search-box .bi-search {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
            font-size: 1.2rem;
        }

        .search-button {
            background-color: #ff007f;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0 2rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
            white-space: nowrap;
            min-width: 120px;
        }

        .search-button:hover {
            background-color: #e60073;
        }

        .employee-image {
            border-radius: 50%;
            object-fit: cover;
            width: 250px;
            height: 250px;
        }

        .text-section {
            position: relative;
            width: 100%;
        }

        /* ===== MENU FIX SESUAI PERMINTAAN ===== */
        .career-menu {
            background-color: #002e6d;
            padding: 0;
            margin: 0;
            width: 100%;
        }

        .career-menu ul {
            list-style: none;
            margin: 0;
            padding: 0;
            width: 100%;
            display: flex;
        }

        .career-menu ul li {
            flex: 1;
            background-color: #002e6d;
            transition: background-color 0.25s ease;
            margin: 0;
            padding: 0;
        }

        .career-menu ul li a {
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            color: #fff;
            width: 100%;
            height: 70px;
            cursor: pointer;
        }

        .career-menu ul li:hover {
            background-color: #0b0b54;
        }

        .career-menu ul li.active {
            background-color: #0077f6;
        }

        .career-menu ul li a,
        .career-menu ul li:hover a,
        .career-menu ul li.active a {
            color: #ffffff !important;
            font-size: 18px !important;
            font-weight: 500 !important;
        }

        @media (max-width: 992px) {
            .career-menu ul {
                flex-wrap: wrap;
            }
            .career-menu ul li {
                flex: 1 1 50%;
            }
            .career-menu ul li a {
                height: 60px;
            }
        }

        @media (max-width: 768px) {
            .employee-image {
                width: 150px;
                height: 150px;
            }

            .explore-header {
                padding: 3rem 1.5rem 5rem 1.5rem;
            }

            .search-container {
                flex-direction: column;
                gap: 10px;
            }

            .classification-container {
                width: 100%;
            }

            .search-button {
                width: 100%;
                min-width: auto;
            }
        }

        /* Explore Companies Section */
        .companies-section {
            padding: 2rem 0;
        }
        .companies-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding: 0 3rem;
        }
        .companies-header > div {
            text-align: left;
        }
        .companies-header h2 {
            font-size: 1.7rem;
            font-weight: 700;
            margin-bottom: 0.3rem;
        }
        .companies-header p {
            font-size: 1.1rem;
            margin: 0;
            color: #555;
        }

        #companiesCarousel, #campusCarousel {
            padding: 0 3rem;
            position: relative;
        }

        /* PERBAIKAN: Ukuran card sama persis dengan halaman explore organisasi - LEBAR DAN TINGGI SAMA */
        .companies-card {
            border: 1px solid #dee2e6;
            border-radius: 12px;
            padding: 1rem;
            text-align: center;
            background: #fff;
            height: 250px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            width: 100%;
            transition: all 0.3s ease;
            /* LEBAR SAMA DENGAN CAROUSEL - menggunakan max-width yang konsisten */
            max-width: 100%;
        }

        .companies-card.highlighted {
            border: 2px solid #0d47a1;
            box-shadow: 0 0 0 3px #bbdefb;
        }

        .companies-card .logo-container {
            height: 72px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.75rem;
            width: 100%;
        }

        .companies-card img {
            max-height: 60px;
            max-width: 100%;
            object-fit: contain;
            display: block;
            margin: 0 auto;
        }
        .companies-card h5 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            line-height: 1.3;
            height: 2.6rem;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }
        .companies-card .rating {
            font-size: 0.9rem;
            color: #444;
            margin: 0.5rem 0 1rem 0;
            white-space: nowrap;
        }
        .companies-card .rating .bi-star-fill {
            color: #e91e63;
        }
        .companies-card .btn-jobs {
            font-size: 0.85rem;
            font-weight: 600;
            border-radius: 6px;
            background-color: #e3f2fd;
            color: #0d47a1;
            border: none;
            padding: 0.4rem 0.8rem;
            margin-top: auto;
            white-space: nowrap;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 3rem;
            height: 3rem;
            top: 50%;
            transform: translateY(calc(-50% - 25px));
            opacity: 1;
            margin: 0;
            background: #fff;
            border-radius: 50%;
            box-shadow: 0 2px 5px rgba(0,0,0,0.15);
            z-index: 10;
        }

        .carousel-control-prev {
            left: 0;
        }

        .carousel-control-next {
            right: 0;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-size: 65% 65%;
            width: 1.25rem;
            height: 1.25rem;
        }

        .carousel-control-prev-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000'%3e%3cpath d='M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z'/%3e%3c/svg%3e");
        }

        .carousel-control-next-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000'%3e%3cpath d='M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
        }

        .carousel-control-prev.disabled,
        .carousel-control-next.disabled {
            display: none !important;
        }

        .carousel-indicators {
            position: relative;
            margin-top: 2rem;
        }
        .carousel-indicators [data-bs-target] {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #bbb;
        }
        .carousel-indicators .active {
            background-color: #0d47a1;
        }

        .companies-header .btn-primary {
            font-size: 1.05rem;
            padding: 0.7rem 1.4rem;
        }

        .pre-apply-section {
            padding: 1rem 1rem;
            text-align: center;
            background-color: #fff;
        }
        .pre-apply-section h2 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 3rem;
            color: #333;
        }
        .pre-apply-card {
            text-align: center;
            padding: 1.5rem;
        }
        .pre-apply-card img {
            width: 120px;
            height: 120px;
            object-fit: contain;
            margin-bottom: 1.5rem;
        }
        .pre-apply-card h3 {
            font-size: 1.3rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
        }
        .pre-apply-card p {
            font-size: 1rem;
            color: #666;
            margin: 0;
        }

        .community-section {
            background-color: #fff;
            padding: 1rem 1rem;
            font-family: Arial, sans-serif;
        }
        .community-section a {
            display: block;
            font-weight: 600;
            color: #000;
            text-decoration: none;
            margin-bottom: 1.5rem;
        }
        .community-section a:hover {
            text-decoration: underline;
        }
        .community-section a i {
            margin-left: 8px;
        }

        .top-companies {
            margin-top: 5rem;
        }

        .top-companies h5 {
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .top-companies .company-list {
            display: flex;
            flex-wrap: wrap;
            gap: 1.2rem;
        }

        .top-companies a {
            color: #0d47a1; /* Diubah dari #000 menjadi biru */
            text-decoration: underline;
            font-size: 0.95rem;
            margin: 0;
        }

        .top-companies a:hover {
            text-decoration: underline;
        }

        .default-logo {
            width: 60px;
            height: 60px;
            background-color: #f8f9fa;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .fixed-columns-row {
            display: flex;
            flex-wrap: wrap;
        }
        .fixed-column {
            flex: 0 0 20%;
            max-width: 20%;
        }

        @media (max-width: 768px) {
            .fixed-column {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }

        @media (max-width: 576px) {
            .fixed-column {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

        .empty-column {
            visibility: hidden;
            height: 0;
            padding: 0;
            margin: 0;
        }

        .company-content, .campus-content {
            display: none;
        }

        .company-content.active, .campus-content.active {
            display: block;
        }

        /* PERBAIKAN: Background putih untuk halaman hasil pencarian */
        .search-results-section {
            padding: 2rem 3rem;
            background-color: #ffffff;
            min-height: 60vh;
        }

        .search-results-header {
            margin-bottom: 2rem;
        }

        .search-results-header h2 {
            font-size: 1.7rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .search-results-count {
            color: #666;
            font-size: 1.1rem;
        }

        .no-results {
            text-align: center;
            padding: 4rem 2rem;
            color: #666;
        }

        .no-results i {
            font-size: 4rem;
            color: #ccc;
            margin-bottom: 1.5rem;
        }

        .no-results h4 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #444;
        }

        .search-highlight {
            background-color: #fff3cd;
            padding: 2px 4px;
            border-radius: 3px;
            font-weight: 600;
        }

        .results-category {
            margin-bottom: 2.5rem;
        }

        .results-category h4 {
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: #333;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e9ecef;
        }

        /* PERBAIKAN BESAR: Tombol kembali dengan ukuran lebih besar dan styling permanen */
        .back-to-explore {
            display: inline-flex;
            align-items: center;
            gap: 0.7rem;
            color: #ffffff !important;
            text-decoration: none;
            font-weight: 600; /* Lebih tebal */
            margin-bottom: 2rem;
            padding: 0.8rem 1.5rem !important; /* Lebih besar */
            background-color: #0d47a1 !important;
            border: 1px solid #0d47a1 !important;
            border-radius: 8px;
            transition: all 0.3s;
            font-size: 1.1rem; /* Font lebih besar */
        }

        /* Hapus efek hover atau buat sama dengan normal state */
        .back-to-explore:hover {
            background-color: #0d47a1 !important;
            color: #ffffff !important;
            text-decoration: none;
            transform: none; /* Tidak ada efek transform */
        }

        /* PERBAIKAN: Grid layout untuk hasil pencarian dengan lebar card yang sama seperti carousel */
        .search-results-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
            width: 100%;
        }

        /* Memastikan card di hasil pencarian memiliki lebar yang sama dengan carousel */
        .search-results-section .companies-card {
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
        }

        /* Media query untuk responsive */
        @media (max-width: 1200px) {
            .search-results-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .search-results-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }

            /* PERBAIKAN: Tombol kembali di no-results lebih kecil di mobile */
            .no-results .back-to-explore {
                padding: 0.5rem 1rem !important;
                font-size: 0.9rem;
            }

            .no-results .back-to-explore i {
                font-size: 0.85rem;
            }
        }

        @media (max-width: 576px) {
            .search-results-grid {
                grid-template-columns: 1fr;
            }

            /* PERBAIKAN: Tombol kembali di no-results lebih kecil di mobile sangat kecil */
            .no-results .back-to-explore {
                padding: 0.45rem 0.9rem !important;
                font-size: 0.85rem;
            }
        }

        /* STYLE BARU UNTUK FITUR LIHAT SEMUA NAMA PERUSAHAAN */
        .view-all-container {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        .view-all-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: none;
            border: none;
            color: #0d47a1;
            font-weight: 600;
            cursor: pointer;
            padding: 0.5rem 1rem;
            transition: all 0.3s;
        }

        .view-all-btn:hover {
            color: #002e6d;
        }

        .arrow-icon {
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1); /* Animasi lebih smooth */
        }

        .arrow-icon.rotated {
            transform: rotate(180deg);
        }

        .all-companies-list, .all-campuses-list {
            display: none;
            padding: 0 3rem;
            margin-top: 2rem;
        }

        .all-companies-list.active, .all-campuses-list.active {
            display: block;
        }

        /* PERBAIKAN: Penyesuaian grid untuk perusahaan dan kampus DENGAN JARAK YANG LEBIH RAPAT */
        .company-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: -100rem; /* row-gap: 1rem, column-gap: 1.5rem */
            margin-left: 0;
            padding-left: 0;
        }

        .campus-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* 3 kolom untuk kampus */
            gap: -100rem; /* row-gap: 1rem, column-gap: 1.5rem */
            margin-left: 0;
            padding-left: 0;
        }

        .company-grid a, .campus-grid a {
            color: #0d47a1;
            text-decoration: underline;
            font-size: 0.95rem;
            padding: 0.3rem 0; /* Padding vertikal diperkecil */
            margin-left: 0;
            line-height: 1.3; /* Line height diperkecil */
        }

        .company-grid a:hover, .campus-grid a:hover {
            text-decoration: underline;
        }

        /* PERBAIKAN: Container untuk alignment yang tepat */
        .top-companies .company-list {
            display: flex;
            flex-wrap: wrap;
            gap: 1.2rem;
            align-items: flex-start;
            margin-left: 0;
            padding-left: 0;
        }

        /* PERBAIKAN: Container untuk 5 nama perusahaan dan tombol lihat semua */
        .top-companies-initial {
            display: flex;
            flex-wrap: wrap;
            gap: 1.2rem;
            width: 100%;
            margin-bottom: 0.5rem;
            margin-left: 0;
            padding-left: 0;
        }

        /* PERBAIKAN: Container untuk 4 nama kampus dan tombol lihat semua */
        .top-campuses-initial {
            display: flex;
            flex-wrap: wrap;
            gap: 1.2rem;
            width: 100%;
            margin-bottom: 0.5rem;
            margin-left: 0;
            padding-left: 0;
        }

        /* PERBAIKAN: Styling untuk nama perusahaan/kampus awal */
        .top-companies-initial a,
        .top-campuses-initial a {
            color: #0d47a1;
            text-decoration: underline;
            font-size: 0.95rem;
            margin-left: 0;
        }

        /* PERBAIKAN: Styling untuk tombol lihat semua */
        .view-all-top-btn {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            background: none;
            border: none;
            color: #0d47a1;
            font-weight: 600;
            cursor: pointer;
            padding: 0;
            text-decoration: underline;
            font-size: 0.95rem;
            margin-left: 0;
        }

        .view-all-top-btn:hover {
            color: #002e6d;
        }

        .view-all-top-btn .arrow-icon {
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* PERBAIKAN BESAR: Memastikan alignment yang tepat */
        .community-section.container {
            padding-left: 3rem !important;
            padding-right: 3rem !important;
        }

        .top-companies {
            margin-left: 0 !important;
            padding-left: 0 !important;
        }

        .all-companies-list,
        .all-campuses-list {
            margin-left: 0 !important;
            padding-left: 0 !important;
        }

        /* PERBAIKAN: Grid untuk memastikan alignment yang tepat */
        .company-grid > *,
        .campus-grid > * {
            margin-left: 0 !important;
            padding-left: 0 !important;
        }

        @media (max-width: 1200px) {
            .company-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 0.8rem 1.2rem; /* Jarak lebih rapat di tablet */
            }
            .campus-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 0.8rem 1.2rem; /* Jarak lebih rapat di tablet */
            }
        }

        @media (max-width: 992px) {
            .company-grid, .campus-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 0.8rem 1rem; /* Jarak lebih rapat di mobile landscape */
            }
        }

        @media (max-width: 768px) {
            .company-grid, .campus-grid {
                grid-template-columns: 1fr;
                gap: 0.6rem; /* Jarak lebih rapat di mobile portrait */
            }

            .top-companies-initial,
            .top-campuses-initial {
                gap: 1rem;
            }

            .community-section.container {
                padding-left: 1.5rem !important;
                padding-right: 1.5rem !important;
            }
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

    {{-- Navbar --}}
    @include('partials.navbar')

    <div class="explore-wrapper">
        <div class="explore-header">
            <div class="text-section">
                <h1 class="explore-title">
                    Temukan perusahaan/kampus/sekolah<br>
                    yang tepat untuk Anda
                </h1>
                <p class="explore-subtitle">Semua yang perlu diketahui tentang perusahaan/kampus/sekolah, di satu tempat</p>

                <form id="searchForm" method="GET" action="{{ route('explore.search') }}">
                    <div class="search-container">
                        <!-- KOLOM KLASIFIKASI BARU -->
                        <div class="classification-container">
                            <div class="classification-select" id="classificationSelect">
                                <span id="selectedOption">Perusahaan</span>
                                <i class="bi bi-chevron-down arrow-icon" id="classificationArrow"></i>
                            </div>
                            <div class="classification-options" id="classificationOptions">
                                <div class="classification-option active" data-value="company">Perusahaan</div>
                                <div class="classification-option" data-value="campus">Kampus/Sekolah</div>
                            </div>
                            <input type="hidden" name="classification" id="classificationInput" value="company">
                        </div>

                        <div class="search-box">
                            <i class="bi bi-search"></i>
                            <input type="text" class="form-control search-input" name="query" id="searchInput"
                                   placeholder="Cari perusahaan, atau kampus/sekolah" value="{{ request('query') }}">
                        </div>
                        <button type="submit" class="search-button">Cari</button>
                    </div>
                </form>
            </div>

            <div class="image-section">
                <img src="{{ asset('images/employee.png') }}" alt="Employee" class="employee-image">
            </div>
        </div>
    </div>

    <!-- Search Results Section - TAMPIL HANYA SAAT ADA PENCARIAN -->
    @if(request()->has('query') && !empty(request('query')))
    <div class="search-results-section">
        <div class="container">
            <!-- TOMBOL KEMBALI DI ATAS JUDUL - TETAP BESAR -->
            <a href="http://127.0.0.1:8000/explore-perusahaan" class="back-to-explore">
                <i class="bi bi-arrow-left"></i>
                Kembali ke Halaman Explore
            </a>

            <div class="search-results-header">
                @php
                    $classification = request('classification', 'company');
                    $searchQuery = request('query');

                    // Tentukan pesan berdasarkan klasifikasi yang dipilih
                    if ($classification === 'company') {
                        $resultMessage = 'Menampilkan hasil dari pencarian perusahaan';
                    } else {
                        $resultMessage = 'Menampilkan hasil dari pencarian Kampus/Sekolah';
                    }
                @endphp

                <p class="search-results-count">
                    {{ $resultMessage }}
                </p>
            </div>

            @php
                // Filter berdasarkan klasifikasi yang dipilih
                if ($classification === 'company') {
                    $companyResults = App\Models\Company::aktif()
                        ->whereRaw('LOWER(nama_perusahaan) LIKE ?', ['%' . strtolower($searchQuery) . '%'])
                        ->get();
                    $campusResults = collect(); // Kosongkan hasil kampus
                } else {
                    $campusResults = App\Models\Campus::where('is_active', true)
                        ->whereRaw('LOWER(nama_kampus) LIKE ?', ['%' . strtolower($searchQuery) . '%'])
                        ->get();
                    $companyResults = collect(); // Kosongkan hasil perusahaan
                }

                $totalResults = $companyResults->count() + $campusResults->count();
            @endphp

            @if($totalResults > 0)
                <!-- Company Results -->
                @if($companyResults->count() > 0)
                <div class="results-category">
                    <h4>Perusahaan ({{ $companyResults->count() }})</h4>
                    <!-- PERBAIKAN: Gunakan grid layout untuk lebar card yang konsisten -->
                    <div class="search-results-grid">
                        @foreach($companyResults as $company)
                            <a href="{{  route('company.detail', $company->slug) }}" style="text-decoration: none; color: inherit;">
                                <div class="companies-card">
                                    <div class="logo-container">
                                        @if($company->logo)
                                            <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->nama_perusahaan }}" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                            <div class="default-logo" style="display: none;">
                                                {{ substr($company->nama_perusahaan, 0, 2) }}
                                            </div>
                                        @else
                                            <div class="default-logo">
                                                {{ substr($company->nama_perusahaan, 0, 2) }}
                                            </div>
                                        @endif
                                    </div>
                                    <h5>
                                        @php
                                            $text = $company->nama_perusahaan;
                                            $searchQuery = request('query');
                                            if (!empty($searchQuery)) {
                                                $pattern = '/(' . preg_quote($searchQuery, '/') . ')/i';
                                                $replacement = '<span class="search-highlight">$1</span>';
                                                echo preg_replace($pattern, $replacement, e($text));
                                            } else {
                                                echo e($text);
                                            }
                                        @endphp
                                    </h5>
                                    <p class="rating">
                                        <i class="bi bi-star-fill"></i>
                                        4.{{ rand(0,5) }} • {{ rand(50, 300) }} Ulasan
                                    </p>
                                    <button class="btn btn-jobs">
                                        {{ rand(10, 100) }} Pekerjaan
                                    </button>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Campus Results -->
                @if($campusResults->count() > 0)
                <div class="results-category">
                    <h4>Kampus/Sekolah ({{ $campusResults->count() }})</h4>
                    <!-- PERBAIKAN: Gunakan grid layout untuk lebar card yang konsisten -->
                    <div class="search-results-grid">
                        @foreach($campusResults as $campus)
                            <a href="{{ route('campus.detail', $campus->slug) }}" style="text-decoration: none; color: inherit;">
                                <div class="companies-card">
                                    <div class="logo-container">
                                        @if($campus->logo_path)
                                            <img src="{{ asset('storage/' . $campus->logo_path) }}" alt="{{ $campus->nama_kampus }}" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                            <div class="default-logo" style="display: none;">
                                                {{ substr($campus->nama_kampus, 0, 2) }}
                                            </div>
                                        @else
                                            <div class="default-logo">
                                                {{ substr($campus->nama_kampus, 0, 2) }}
                                            </div>
                                        @endif
                                    </div>
                                    <h5>
                                        @php
                                            $text = $campus->nama_kampus;
                                            $searchQuery = request('query');
                                            if (!empty($searchQuery)) {
                                                $pattern = '/(' . preg_quote($searchQuery, '/') . ')/i';
                                                $replacement = '<span class="search-highlight">$1</span>';
                                                echo preg_replace($pattern, $replacement, e($text));
                                            } else {
                                                echo e($text);
                                            }
                                        @endphp
                                    </h5>
                                    <p class="rating">
                                        <i class="bi bi-star-fill"></i>
                                        4.{{ rand(0,5) }} • {{ rand(50, 300) }} Ulasan
                                    </p>
                                    <button class="btn btn-jobs">
                                        {{ $campus->jenis_institusi }}
                                    </button>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                @endif

            @else
                <div class="no-results">
                    <i class="bi bi-search"></i>
                    <h4>Tidak ada hasil ditemukan</h4>
                    <p>Maaf, tidak ada {{ $classification === 'company' ? 'perusahaan' : 'kampus/sekolah' }} yang sesuai dengan pencarian "<strong>{{ request('query') }}</strong>"</p>
                    <p class="text-muted mt-3">Coba gunakan kata kunci yang berbeda atau periksa ejaan Anda.</p>
                </div>
            @endif
        </div>
    </div>

    @else
    <!-- TAMPILAN NORMAL EXPLORE ORGANISASI - HANYA TAMPIL JIKA TIDAK ADA PENCARIAN -->

    <div class="career-menu">
        <ul>
            <li class="active" id="companyMenu">
                <a onclick="setActiveContent('company')">Perusahaan</a>
            </li>
            <li id="campusMenu">
                <a onclick="setActiveContent('campus')">Kampus/Sekolah</a>
            </li>
        </ul>
    </div>

    <!-- Konten Perusahaan -->
    <div class="company-content active">
        <div class="companies-section">
            <div class="companies-header">
                <div>
                    <h2>Explore companies</h2>
                    <p>Temukan lowongan baru, ulasan, budaya perusahaan, fasilitas, dan tunjangan.</p>
                </div>
                {{-- <a href="#" class="btn btn-primary">
                    <i class="fa-solid fa-pen me-2"></i> Tulis ulasan
                </a> --}}
            </div>

            <div id="companiesCarousel" class="carousel slide" data-bs-interval="false">
                <div class="carousel-inner">
                    @php
                        $companies = App\Models\Company::aktif()->get();
                        $companyChunks = $companies->chunk(5);
                        $hasCompanies = $companyChunks->count() > 0;
                    @endphp

                    @if($hasCompanies)
                        @foreach($companyChunks as $index => $chunk)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <div class="row g-3 fixed-columns-row">
                                    @foreach($chunk as $company)
                                        <div class="col-6 col-md fixed-column">
                                            <a href="{{  route('company.detail', $company->slug) }}" style="text-decoration: none; color: inherit;">
                                                <div class="companies-card">
                                                    <div class="logo-container">
                                                        @if($company->logo)
                                                            <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->nama_perusahaan }}" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                                            <div class="default-logo" style="display: none;">
                                                                {{ substr($company->nama_perusahaan, 0, 2) }}
                                                            </div>
                                                        @else
                                                            <div class="default-logo">
                                                                {{ substr($company->nama_perusahaan, 0, 2) }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <h5>{{ $company->nama_perusahaan }}</h5>
                                                    <p class="rating">
                                                        <i class="bi bi-star-fill"></i>
                                                        4.{{ rand(0,5) }} • {{ rand(50, 300) }} Ulasan
                                                    </p>
                                                    <button class="btn btn-jobs">
                                                        {{ rand(10, 100) }} Pekerjaan
                                                    </button>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach

                                    @for($i = $chunk->count(); $i < 5; $i++)
                                        <div class="col-6 col-md fixed-column empty-column">
                                            <div class="companies-card"></div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="carousel-item active">
                            <div class="row g-3">
                                <div class="col-12 text-center py-5">
                                    <p class="text-muted">Belum ada perusahaan yang terdaftar.</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                @if($hasCompanies && $companyChunks->count() > 1)
                    <button class="carousel-control-prev disabled" id="prevButton" type="button" data-bs-target="#companiesCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" id="nextButton" type="button" data-bs-target="#companiesCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>

                    <div class="carousel-indicators mt-3">
                        @for($i = 0; $i < $companyChunks->count(); $i++)
                            <button type="button" data-bs-target="#companiesCarousel" data-bs-slide-to="{{ $i }}"
                                    class="{{ $i === 0 ? 'active' : '' }}" aria-current="{{ $i === 0 ? 'true' : 'false' }}"></button>
                        @endfor
                    </div>
                @endif
            </div>
        </div>

        <!-- Konten lainnya tetap sama -->
        <div class="pre-apply-section">
            <div class="container">
                <h2 class="mb-5">Dapatkan gambaran yang jelas sebelum melamar</h2>
                <div class="row justify-content-center">
                    <div class="col-md-4 mb-4">
                        <div class="pre-apply-card">
                            <img src="{{ asset('images/heart.png') }}" alt="Budaya dan nilai">
                            <h3>Budaya dan nilai</h3>
                            <p>Cari tahu tentang budaya perusahaan</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="pre-apply-card">
                            <img src="{{ asset('images/line.png') }}" alt="Penilaian dan ulasan">
                            <h3>Penilaian dan ulasan</h3>
                            <p>Baca ulasan dari karyawan</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="pre-apply-card">
                            <img src="{{ asset('images/gift.png') }}" alt="Tunjangan dan keuntungan">
                            <h3>Tunjangan dan keuntungan</h3>
                            <p>Temukan keuntungan yang penting bagi Anda</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="community-section container">
            <a href="#">Lihat pedoman komunitas <i class="bi bi-arrow-right"></i></a>
            <a href="#">Informasi untuk perusahaan <i class="bi bi-arrow-right"></i></a>

            <div class="top-companies">
                <h5>Perusahaan teratas</h5>
                <div class="company-list">
                    <!-- PERBAIKAN: Container untuk 5 nama perusahaan dan tombol lihat semua -->
                    <div class="top-companies-initial">
                        @php
                            $topCompanies = App\Models\Company::aktif()->take(5)->get();
                        @endphp

                        @foreach($topCompanies as $company)
                            <a href="{{  route('company.detail', $company->slug) }}">{{ $company->nama_perusahaan }}</a>
                        @endforeach

                        @if($topCompanies->count() > 0)
                            <!-- TOMBOL LIHAT SEMUA UNTUK PERUSAHAAN TERATAS -->
                            <button class="view-all-top-btn" id="viewAllTopCompanies">
                                Lihat semua <i class="bi bi-chevron-down arrow-icon"></i>
                            </button>
                        @else
                            <a href="#" class="text-muted">Belum ada perusahaan</a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- DAFTAR SEMUA PERUSAHAAN (AWALNYA TERSEMBUNYI) -->
            <div class="all-companies-list" id="allCompaniesList">
                <div class="company-grid">
                    @php
                        $allCompanies = App\Models\Company::aktif()->get();
                    @endphp

                    @if($allCompanies->count() > 0)
                        @foreach($allCompanies as $company)
                            <a href="{{  route('company.detail', $company->slug) }}">{{ $company->nama_perusahaan }}</a>
                        @endforeach
                    @else
                        <p class="text-muted">Belum ada perusahaan yang terdaftar.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Konten Kampus/Sekolah -->
    <div class="campus-content">
        <div class="companies-section">
            <div class="companies-header">
                <div>
                    <h2>Explore kampus & sekolah</h2>
                    <p>Temukan program studi, ulasan, fasilitas kampus, dan kehidupan akademik.</p>
                </div>
                {{-- <a href="#" class="btn btn-primary">
                    <i class="fa-solid fa-pen me-2"></i> Tulis ulasan
                </a> --}}
            </div>

            <div id="campusCarousel" class="carousel slide" data-bs-interval="false">
                <div class="carousel-inner">
                    @php
                        $campuses = App\Models\Campus::where('is_active', true)->get();
                        $campusChunks = $campuses->chunk(5);
                        $hasCampuses = $campusChunks->count() > 0;
                    @endphp

                    @if($hasCampuses)
                        @foreach($campusChunks as $index => $chunk)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <div class="row g-3 fixed-columns-row">
                                    @foreach($chunk as $campus)
                                        <div class="col-6 col-md fixed-column">
                                            <a href="{{ route('campus.detail', $campus->slug) }}" style="text-decoration: none; color: inherit;">
                                                <div class="companies-card">
                                                    <div class="logo-container">
                                                        @if($campus->logo_path)
                                                            <img src="{{ asset('storage/' . $campus->logo_path) }}" alt="{{ $campus->nama_kampus }}" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                                            <div class="default-logo" style="display: none;">
                                                                {{ substr($campus->nama_kampus, 0, 2) }}
                                                            </div>
                                                        @else
                                                            <div class="default-logo">
                                                                {{ substr($campus->nama_kampus, 0, 2) }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <h5>{{ $campus->nama_kampus }}</h5>
                                                    <p class="rating">
                                                        <i class="bi bi-star-fill"></i>
                                                        4.{{ rand(0,5) }} • {{ rand(50, 300) }} Ulasan
                                                    </p>
                                                    <button class="btn btn-jobs">
                                                        {{ $campus->jenis_institusi }}
                                                    </button>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach

                                    @for($i = $chunk->count(); $i < 5; $i++)
                                        <div class="col-6 col-md fixed-column empty-column">
                                            <div class="companies-card"></div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="carousel-item active">
                            <div class="row g-3">
                                <div class="col-12 text-center py-5">
                                    <p class="text-muted">Belum ada kampus/sekolah yang terdaftar.</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                @if($hasCampuses && $campusChunks->count() > 1)
                    <button class="carousel-control-prev disabled" id="campusPrevButton" type="button" data-bs-target="#campusCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" id="campusNextButton" type="button" data-bs-target="#campusCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>

                    <div class="carousel-indicators mt-3">
                        @for($i = 0; $i < $campusChunks->count(); $i++)
                            <button type="button" data-bs-target="#campusCarousel" data-bs-slide-to="{{ $i }}"
                                    class="{{ $i === 0 ? 'active' : '' }}" aria-current="{{ $i === 0 ? 'true' : 'false' }}"></button>
                        @endfor
                    </div>
                @endif
            </div>
        </div>

        <div class="pre-apply-section">
            <div class="container">
                <h2 class="mb-5">Dapatkan gambaran yang jelas sebelum mendaftar</h2>
                <div class="row justify-content-center">
                    <div class="col-md-4 mb-4">
                        <div class="pre-apply-card">
                            <img src="{{ asset('images/heart.png') }}" alt="Akreditasi dan reputasi">
                            <h3>Akreditasi dan reputasi</h3>
                            <p>Ketahui akreditasi dan reputasi kampus</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="pre-apply-card">
                            <img src="{{ asset('images/line.png') }}" alt="Program studi">
                            <h3>Program studi</h3>
                            <p>Telusuri program studi yang tersedia</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="pre-apply-card">
                            <img src="{{ asset('images/gift.png') }}" alt="Fasilitas kampus">
                            <h3>Fasilitas kampus</h3>
                            <p>Lihat fasilitas yang mendukung pembelajaran</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="community-section container">
            <a href="#">Lihat pedoman komunitas <i class="bi bi-arrow-right"></i></a>
            <a href="#">Informasi untuk kampus <i class="bi bi-arrow-right"></i></a>

            <div class="top-companies">
                <h5>Kampus & sekolah teratas</h5>
                <div class="company-list">
                    <!-- PERBAIKAN: Container untuk 4 nama kampus dan tombol lihat semua -->
                    <div class="top-campuses-initial">
                        @php
                            $topCampuses = App\Models\Campus::where('is_active', true)->take(4)->get();
                        @endphp

                        @foreach($topCampuses as $campus)
                            <a href="{{ route('campus.detail', $campus->slug) }}">{{ $campus->nama_kampus }}</a>
                        @endforeach

                        @if($topCampuses->count() > 0)
                            <!-- TOMBOL LIHAT SEMUA UNTUK KAMPUS TERATAS -->
                            <button class="view-all-top-btn" id="viewAllTopCampuses">
                                Lihat semua <i class="bi bi-chevron-down arrow-icon"></i>
                            </button>
                        @else
                            <a href="#" class="text-muted">Belum ada kampus/sekolah</a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- DAFTAR SEMUA KAMPUS (AWALNYA TERSEMBUNYI) -->
            <div class="all-campuses-list" id="allCampusesList">
                <div class="campus-grid">
                    @php
                        $allCampuses = App\Models\Campus::where('is_active', true)->get();
                    @endphp

                    @if($allCampuses->count() > 0)
                        @foreach($allCampuses as $campus)
                            <a href="{{ route('campus.detail', $campus->slug) }}">{{ $campus->nama_kampus }}</a>
                        @endforeach
                    @else
                        <p class="text-muted">Belum ada kampus/sekolah yang terdaftar.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif


         <!-- INTEGRASI WHATSAPP YANG BERFUNGSI -->
    <div class="whatsapp-float">
        <a href="https://wa.me/6282115179879?text=Halo%2C%20saat%20ini%20saya%20sedang%20mengakses%20website%20Inotal%20dan%20saya%20butuh%20bantuan"
        target="_blank"
        rel="noopener noreferrer"
        class="whatsapp-link">
            <img src="{{ asset('images/whatsapp.png') }}" alt="Chat via WhatsApp" class="whatsapp-logo">
        </a>
    </div>

    {{-- Footer --}}
    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // FUNGSI UNTUK DROPDOWN KLASIFIKASI
        document.addEventListener('DOMContentLoaded', function() {
            const classificationSelect = document.getElementById('classificationSelect');
            const classificationOptions = document.getElementById('classificationOptions');
            const classificationArrow = document.getElementById('classificationArrow');
            const selectedOption = document.getElementById('selectedOption');
            const classificationInput = document.getElementById('classificationInput');
            const searchInput = document.getElementById('searchInput');

            // Toggle dropdown
            classificationSelect.addEventListener('click', function() {
                classificationOptions.classList.toggle('active');
                classificationArrow.classList.toggle('rotated');
            });

            // Pilih opsi dari dropdown
            document.querySelectorAll('.classification-option').forEach(option => {
                option.addEventListener('click', function() {
                    const value = this.getAttribute('data-value');
                    const text = this.textContent;

                    // Update tampilan
                    selectedOption.textContent = text;
                    classificationInput.value = value;

                    // Update placeholder berdasarkan pilihan
                    if (value === 'company') {
                        searchInput.placeholder = 'Cari perusahaan';
                    } else {
                        searchInput.placeholder = 'Cari kampus/sekolah';
                    }

                    // Update status aktif
                    document.querySelectorAll('.classification-option').forEach(opt => {
                        opt.classList.remove('active');
                    });
                    this.classList.add('active');

                    // Tutup dropdown
                    classificationOptions.classList.remove('active');
                    classificationArrow.classList.remove('rotated');
                });
            });

            // Tutup dropdown ketika klik di luar
            document.addEventListener('click', function(event) {
                if (!classificationSelect.contains(event.target) && !classificationOptions.contains(event.target)) {
                    classificationOptions.classList.remove('active');
                    classificationArrow.classList.remove('rotated');
                }
            });

            // Fungsi untuk mengatur konten aktif
            window.setActiveContent = function(type) {
                document.querySelectorAll('.company-content, .campus-content').forEach(content => {
                    content.classList.remove('active');
                });

                document.querySelectorAll('.career-menu li').forEach(menuItem => {
                    menuItem.classList.remove('active');
                });

                if (type === 'company') {
                    document.querySelector('.company-content').classList.add('active');
                    document.getElementById('companyMenu').classList.add('active');

                    // Update dropdown klasifikasi
                    selectedOption.textContent = 'Perusahaan';
                    classificationInput.value = 'company';
                    searchInput.placeholder = 'Cari perusahaan';

                    // Update status aktif di dropdown
                    document.querySelectorAll('.classification-option').forEach(opt => {
                        opt.classList.remove('active');
                        if (opt.getAttribute('data-value') === 'company') {
                            opt.classList.add('active');
                        }
                    });
                } else if (type === 'campus') {
                    document.querySelector('.campus-content').classList.add('active');
                    document.getElementById('campusMenu').classList.add('active');

                    // Update dropdown klasifikasi
                    selectedOption.textContent = 'Kampus/Sekolah';
                    classificationInput.value = 'campus';
                    searchInput.placeholder = 'Cari kampus/sekolah';

                    // Update status aktif di dropdown
                    document.querySelectorAll('.classification-option').forEach(opt => {
                        opt.classList.remove('active');
                        if (opt.getAttribute('data-value') === 'campus') {
                            opt.classList.add('active');
                        }
                    });
                }
            }

            // Kode carousel dan fungsi lainnya yang sudah ada
            const companyCarousel = document.getElementById('companiesCarousel');
            if (companyCarousel) {
                const prevButton = document.getElementById('prevButton');
                const nextButton = document.getElementById('nextButton');
                const carouselItems = companyCarousel.querySelectorAll('.carousel-item');
                const totalItems = carouselItems.length;

                if (totalItems > 1) {
                    function updateCarouselControls() {
                        const activeItem = companyCarousel.querySelector('.carousel-item.active');
                        const activeIndex = Array.from(carouselItems).indexOf(activeItem);

                        if (activeIndex === 0) {
                            prevButton.classList.add('disabled');
                            nextButton.classList.remove('disabled');
                        }
                        else if (activeIndex === totalItems - 1) {
                            prevButton.classList.remove('disabled');
                            nextButton.classList.add('disabled');
                        }
                        else {
                            prevButton.classList.remove('disabled');
                            nextButton.classList.remove('disabled');
                        }
                    }

                    companyCarousel.addEventListener('slid.bs.carousel', updateCarouselControls);
                    updateCarouselControls();
                }
            }

            const campusCarousel = document.getElementById('campusCarousel');
            if (campusCarousel) {
                const prevButton = document.getElementById('campusPrevButton');
                const nextButton = document.getElementById('campusNextButton');
                const carouselItems = campusCarousel.querySelectorAll('.carousel-item');
                const totalItems = carouselItems.length;

                if (totalItems > 1) {
                    function updateCampusCarouselControls() {
                        const activeItem = campusCarousel.querySelector('.carousel-item.active');
                        const activeIndex = Array.from(carouselItems).indexOf(activeItem);

                        if (activeIndex === 0) {
                            prevButton.classList.add('disabled');
                            nextButton.classList.remove('disabled');
                        }
                        else if (activeIndex === totalItems - 1) {
                            prevButton.classList.remove('disabled');
                            nextButton.classList.add('disabled');
                        }
                        else {
                            prevButton.classList.remove('disabled');
                            nextButton.classList.remove('disabled');
                        }
                    }

                    campusCarousel.addEventListener('slid.bs.carousel', updateCampusCarouselControls);
                    updateCampusCarouselControls();
                }
            }

            const searchForm = document.getElementById('searchForm');

            if (searchForm) {
                searchForm.addEventListener('submit', function(e) {
                    const query = searchInput.value.trim();
                    if (query === '') {
                        e.preventDefault();
                        alert('Silakan masukkan kata kunci pencarian');
                    }
                });
            }

            @if(request()->has('query') && !empty(request('query')))
                if (searchInput) {
                    searchInput.focus();
                    searchInput.setSelectionRange(0, searchInput.value.length);
                }
            @endif

            // FITUR LIHAT SEMUA UNTUK PERUSAHAAN TERATAS
            const viewAllTopCompanies = document.getElementById('viewAllTopCompanies');
            const allCompaniesList = document.getElementById('allCompaniesList');
            const topCompaniesIcon = viewAllTopCompanies ? viewAllTopCompanies.querySelector('i') : null;

            if (viewAllTopCompanies && allCompaniesList) {
                viewAllTopCompanies.addEventListener('click', function(e) {
                    e.preventDefault();
                    allCompaniesList.classList.toggle('active');

                    if (allCompaniesList.classList.contains('active')) {
                        viewAllTopCompanies.innerHTML = 'Lihat lebih sedikit <i class="bi bi-chevron-up arrow-icon"></i>';
                        topCompaniesIcon.classList.add('rotated');
                    } else {
                        viewAllTopCompanies.innerHTML = 'Lihat semua <i class="bi bi-chevron-down arrow-icon"></i>';
                        topCompaniesIcon.classList.remove('rotated');
                    }
                });
            }

            // FITUR LIHAT SEMUA UNTUK KAMPUS TERATAS
            const viewAllTopCampuses = document.getElementById('viewAllTopCampuses');
            const allCampusesList = document.getElementById('allCampusesList');
            const topCampusesIcon = viewAllTopCampuses ? viewAllTopCampuses.querySelector('i') : null;

            if (viewAllTopCampuses && allCampusesList) {
                viewAllTopCampuses.addEventListener('click', function(e) {
                    e.preventDefault();
                    allCampusesList.classList.toggle('active');

                    if (allCampusesList.classList.contains('active')) {
                        viewAllTopCampuses.innerHTML = 'Lihat lebih sedikit <i class="bi bi-chevron-up arrow-icon"></i>';
                        topCampusesIcon.classList.add('rotated');
                    } else {
                        viewAllTopCampuses.innerHTML = 'Lihat semua <i class="bi bi-chevron-down arrow-icon"></i>';
                        topCampusesIcon.classList.remove('rotated');
                    }
                });
            }
        });
    </script>
</body>
</html>
