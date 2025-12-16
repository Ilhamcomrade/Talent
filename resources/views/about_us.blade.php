<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Perusahaan | Next Jobz</title>

    <link rel="icon" type="image/png" href="{{ asset('123.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        body {
            background-color: #fff;
        }

        /* ==================== Hero Section ==================== */
        .hero-section {
            background-color: #fff;
            padding: 60px 0;
        }

        .hero-img-wrapper {
            perspective: 1000px;
            display: inline-block;
        }

        .hero-img {
            border-radius: 12px;
            width: 100%;
            height: auto;
            object-fit: cover;
            transition: transform 0.2s ease;
            transform-style: preserve-3d;
        }

        .hero-subtitle {
            font-size: 0.9rem;
            font-weight: 600;
            color: #2c2c2c;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
            position: relative;
            padding-left: 20px;
        }

        .hero-subtitle::before {
            content: "";
            width: 8px;
            height: 8px;
            background-color: #e74c3c;
            border-radius: 50%;
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
        }

        .hero-title {
            font-size: 2rem;
            font-weight: 700;
            color: #2c2c2c;
            margin-bottom: 1rem;
        }

        .hero-text {
            font-size: 1.05rem;
            color: #6c757d;
            line-height: 1.8;
            text-align: justify;
        }

        /* ==================== Visi Misi Section ==================== */
        .vm-section {
            background-color: #fff;
            padding: 60px 0;
        }

        .vm-card {
            background-color: #f8f9fa;
            border-radius: 0;
            box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.1), 0 8px 30px rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .vm-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 300'%3E%3Cpath d='M0,150 C50,50 150,50 200,100 C250,150 350,150 400,100 L400,300 L0,300 Z' fill='%23e9ecef'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            opacity: 1;
            z-index: -1;
        }

        .vm-card.visi-card::before {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 300'%3E%3Cpath d='M0,150 C50,50 150,50 200,100 C250,150 350,150 400,100 L400,300 L0,300 Z' fill='%23e9ecef'/%3E%3C/svg%3E");
            transform: scaleX(-1);
            left: 0;
        }

        .vm-card.misi-card::before {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 300'%3E%3Cpath d='M0,150 C50,50 150,50 200,100 C250,150 350,150 400,100 L400,300 L0,300 Z' fill='%23e9ecef'/%3E%3C/svg%3E");
            right: 0;
            transform: scaleX(-1);
        }

        .vm-card-header {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .vm-icon {
            font-size: 3rem;
            color: #dc3545;
        }

        .vm-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #2c2c2c;
            margin-bottom: 0;
        }

        .vm-text-content {
            padding-left: 4.5rem;
            padding-right: 2rem;
        }

        .vm-text {
            font-size: 1.05rem;
            color: #6c757d;
            line-height: 1.8;
            text-align: justify;
        }

        /* ==================== Teknologi & Partner ==================== */
        .tech-section {
            background-color: #fff;
            padding: 60px 0;
            text-align: center;
        }

        .tech-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #2c2c2c;
            margin-bottom: 2.5rem;
        }

        .tech-logo {
            max-height: 50px;
        }
    </style>
</head>

<body>
    {{-- Memanggil navbar dari file parsial --}}
    @include('partials.navbar')

    <main>
        <section class="hero-section">
            <div class="container">
                <div class="row align-items-center g-4">
                    <div class="col-md-6 hero-img-wrapper pe-md-5">
                        <img src="{{ asset('images/city.png') }}" alt="Tentang Perusahaan" class="hero-img" id="heroImg">
                    </div>
                    <div class="col-md-6">
                        <div class="hero-subtitle">Tentang kami</div>
                        <h2 class="hero-title">Selayang Pandang</h2>
                        <p class="hero-text">
                            Dimulai 25 Agustus 2022, sebagai konsultan IT untuk kebutuhan pemerintah dan swasta. Pada 2023, PT INOTAL SISTEMA Internasional berkesempatan membangun sistem perbankan dan pada 2024 mengembangkan sistem rumah sakit. Dengannya kami senantiasa lebih profesional, terpercaya, dan berdedikasi memberikan solusi inovatif.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="vm-section">
            <div class="container vm-container">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="vm-card visi-card">
                            <div class="vm-card-header">
                                <i class="fa-solid fa-arrow-trend-up vm-icon"></i>
                                <h2 class="vm-title">Visi</h2>
                            </div>
                            <div class="vm-text-content">
                                <p class="vm-text">
                                    Visi kami adalah menjadi perusahaan layanan TI memungkinkan bisnisnya untuk berkembang di era digital dengan menyediakan solusi TI yang inovatif, andal, dan hemat biaya yang mendorong pertumbuhan dan kemakmuran bagi klien kami. Menyajikan inovasi digital yang merupakan solusi dan berguna untuk dunia yang lebih baik.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="vm-card misi-card">
                            <div class="vm-card-header">
                                <i class="fa-solid fa-rocket vm-icon"></i>
                                <h2 class="vm-title">Misi</h2>
                            </div>
                            <div class="vm-text-content">
                                <p class="vm-text">
                                    Menyajikan inovasi platform & pengembangan sistem TI bagi individu atau organisasi yang ingin bertransformasi secara digital. Sumber Daya Digital Menyajikan inovasi dalam menyediakan sumber daya manusia yang memiliki kompetensi dalam pengembangan perangkat lunak digital Platform & Transformasi Digital
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="tech-section">
            <div class="container">
                <h2 class="tech-title">Teknologi Dan Partner</h2>
                <div class="row g-5 justify-content-center align-items-center">
                    <div class="col-auto"><img src="{{ asset('images/finanstra.png') }}" alt="Finanstra" class="img-fluid tech-logo"></div>
                    <div class="col-auto"><img src="{{ asset('images/spring.png') }}" alt="Spring" class="img-fluid tech-logo"></div>
                    <div class="col-auto"><img src="{{ asset('images/equinix.png') }}" alt="Equinix" class="img-fluid tech-logo"></div>
                    <div class="col-auto"><img src="{{ asset('images/reactjs.png') }}" alt="ReactJS" class="img-fluid tech-logo"></div>
                    <div class="col-auto"><img src="{{ asset('images/java.png') }}" alt="Java" class="img-fluid tech-logo"></div>
                    <div class="col-auto"><img src="{{ asset('images/golang.png') }}" alt="Golang" class="img-fluid tech-logo"></div>
                </div>
            </div>
        </section>
    </main>

    {{-- Memanggil footer dari file parsial --}}
    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const heroImg = document.getElementById("heroImg");
        const wrapper = heroImg.parentElement;

        wrapper.addEventListener("mousemove", (e) => {
            const rect = wrapper.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;

            const rotateX = ((y - centerY) / centerY) * 10;
            const rotateY = ((x - centerX) / centerX) * -10;

            heroImg.style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.05)`;
        });

        wrapper.addEventListener("mouseleave", () => {
            heroImg.style.transform = "rotateX(0) rotateY(0) scale(1)";
        });
    </script>
</body>

</html>
