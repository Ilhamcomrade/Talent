<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talenthub</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* Warna-warna khusus */
        .text-green {
            color: #28a745;
        }

        .bg-green {
            background-color: #28a745;
        }

        .btn-green:hover {
            background-color: #218838;
        }

        .text-orange-custom {
            color: #FF6633;
        }

        /* Hero section */
        .hero-section {
            position: relative;
            padding: 5rem 0;
            background-color: #f6f8f5;
            overflow: hidden;
        }

        .hero-background-image {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background-image: url('{{ asset('images/hero-image.png') }}');
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

        .hero-text {
            color: #6c757d;
        }

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

        .category-card .card-title {
            font-size: 1rem;
        }

        .category-heading {
            color: #495057;
        }

        /* Statistik */
        .stats-section {
            background-color: #f6f8f5;
        }

        .stats-title {
            color: #495057;
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: 600;
        }

        .stats-text {
            color: #6c757d;
        }

        /* Footer */
        .footer-bg {
            background-color: #0A0A2A;
        }

        .footer-logo {
            height: 120px;
            width: auto;
            display: block;
        }

        .footer-link {
            color: #ffffff;
            text-decoration: none;
        }

        .footer-link:hover {
            color: #28a745;
        }
    </style>
</head>

<body style="background-color: #f6f8f5;">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container-fluid mx-lg-5">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('images/logo_inotal.png') }}" alt="Inotal Logo"
                    class="d-inline-block align-text-top me-2" style="height: 30px;">

            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link fw-bold" href="#">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Lowongan Kerja</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Tentang Perusahaan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Kontak</a></li>
                </ul>
                <div class="d-flex align-items-center">
                    <a href="#" class="nav-link me-2">Daftar</a>
                    <a href="#" class="nav-link">Masuk</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section text-center text-md-start">
        <div class="hero-background-image"></div>
        <div class="hero-content">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-7 mb-4 mb-md-0">
                        <h1 class="display-6 mb-3 hero-title">
                            Temukan kesempatan karir yang Anda impikan
                        </h1>
                        <p class="lead mb-4 hero-text">
                            Lebih dari 100+ posisi pekerjaan terverifikasi tersedia di perusahaan kami.
                            <br class="d-none d-md-block">
                            Bergabunglah bersama tim profesional kami dan raih karir Anda ke level selanjutnya.
                        </p>
                        <div class="row g-2">
                            <div class="col-12 col-md-5">
                                <input type="text" class="form-control form-control-lg"
                                    placeholder="Cari Nama Pekerjaan">
                            </div>
                            <div class="col-12 col-md-4">
                                <input type="text" class="form-control form-control-lg"
                                    placeholder="Kategori">
                            </div>
                            <div class="col-12 col-md-3">
                                <button class="btn btn-success btn-lg w-100">Cari</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 d-none d-md-block"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kategori Pekerjaan -->
    <section class="py-5">
        <div class="container">
            <h2 class="fs-4 mb-4 fw-bold category-heading">Kategori pekerjaan</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4">

                <div class="col">
                    <div class="card h-100 category-card">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <h5 class="card-title mb-0">DevOps & Infrastructure</h5>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100 category-card">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <h5 class="card-title mb-0">Analyst & Consultant</h5>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100 category-card">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <h5 class="card-title mb-0">Project Management</h5>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100 category-card">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <h5 class="card-title mb-0">UI/UX Design</h5>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100 category-card">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <h5 class="card-title mb-0">Database Management</h5>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100 category-card">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <h5 class="card-title mb-0">Frontend Developer</h5>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100 category-card">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <h5 class="card-title mb-0">Mobile Developer</h5>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100 category-card">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <h5 class="card-title mb-0">Backend Developer</h5>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100 category-card">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <h5 class="card-title mb-0">Cybersecurity</h5>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Statistik -->
    <section class="py-5 text-center stats-section">
        <div class="container">
            <h2 class="fs-4 fw-normal stats-title mb-2">Statistik Website Kami</h2>
            <p class="stats-text mb-5">
                Berikut adalah data keberhasilan kami dalam merekrut talenta terbaik
            </p>
            <div class="row">
                <div class="col-6 col-md-3 mb-4">
                    <h3 class="stats-number text-green">50</h3>
                    <p class="stats-text fw-semibold">Pelamar</p>
                </div>
                <div class="col-6 col-md-3 mb-4">
                    <h3 class="stats-number text-green">10</h3>
                    <p class="stats-text fw-semibold">Lowongan Terbuka</p>
                </div>
                <div class="col-6 col-md-3 mb-4">
                    <h3 class="stats-number text-green">30</h3>
                    <p class="stats-text fw-semibold">Posisi Terpenuhi</p>
                </div>
                <div class="col-6 col-md-3 mb-4">
                    <h3 class="stats-number text-green">75</h3>
                    <p class="stats-text fw-semibold">Karyawan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-5 footer-bg text-white">
        <div class="container">
            <div class="row">

                <!-- Logo + Deskripsi -->
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="mb-3">
                        <img src="{{ asset('images/inotal.png') }}" alt="INOTAL SISTEMA INTERNASIONAL"
                            class="footer-logo">
                    </div>
                    <p class="mb-1">PT INOTAL SISTEMA INTERNASIONAL</p>
                    <p>Langkah Mudah Menuju Masa Depan Karier</p>
                </div>

                <!-- Navigasi -->
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5 class="fw-bold mb-3 text-orange-custom">Navigasi</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="footer-link">Lowongan</a></li>
                        <li><a href="#" class="footer-link">Tentang</a></li>
                        <li><a href="#" class="footer-link">Kontak</a></li>
                    </ul>
                </div>

                <!-- Alamat -->
                <div class="col-md-4">
                    <h5 class="fw-bold mb-3 text-orange-custom">Alamat</h5>
                    <ul class="list-unstyled">
                        <li>
                            <p class="mb-1">
                                <i class="bi bi-geo-alt-fill me-2 text-orange-custom"></i>
                                Jl. Pratista Utara III No.2, <br>
                                Antapani Kidul, <br>
                                Kec. Antapani, Kota Bandung, <br>
                                Jawa Barat, Indonesia 4029
                            </p>
                        </li>
                        <li>
                            <p class="mb-1">
                                <i class="bi bi-telephone-fill me-2 text-orange-custom"></i>
                                +(62) 82115179879
                            </p>
                        </li>
                        <li>
                            <p class="mb-1">
                                <i class="bi bi-envelope-fill me-2 text-orange-custom"></i>
                                corporate@inotal.tech
                            </p>
                        </li>
                    </ul>
                </div>

            </div>

            <hr class="my-4" style="border-color: #FF6633;">

            <div class="text-center">
                Copyright ©2025 INOTAL SISTEMA INTERNASIONAL
            </div>
        </div>
    </footer>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
