<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Talenthub</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        /* Mengimpor font Serif untuk judul */
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap');

        body {
            background-color: #fff;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Styling untuk container utama */
        .main-container {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            position: relative;
            padding: 40px 20px 50px;
        }

        .wave-background {
            display: none;
        }

        .main-content {
            position: relative;
            z-index: 1;
            max-width: 650px;
            text-align: center;
            background-color: transparent;
            padding: 0;
            box-shadow: none;
        }

        /* Styling untuk judul utama */
        .title-glints {
            /* FONT DIUBAH agar sama dengan deskripsi */
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 30px;
            font-weight: 700;
            text-align: center;
            margin: 0;
            line-height: 1.2;
            display: inline-block;
            position: relative;
            padding-bottom: 8px;
        }

        /* Garis bawah (underline) */
        .title-glints::after {
            content: '';
            display: block;
            width: 100%;
            height: 2px;
            background-color: #333;
            position: absolute;
            bottom: 0;
            left: 0;
        }

        /* Teks deskripsi */
        .description-text {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 16px;
            line-height: 1.6;
            color: #555;
            /* Jarak dikurangi agar lebih dekat dengan judul */
            margin-top: 10px;
            margin-bottom: 40px;
        }

        .btn-container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            gap: 120px;
            width: 100%;
            margin: 0 auto;
        }

        .registration-img {
            width: 95px;
            height: 95px;
            object-fit: contain;
            margin-bottom: 15px;
            display: block;
        }

        .choice-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            flex-shrink: 0;
        }

        .btn-choose {
            width: 240px;
            height: 55px;
            font-size: 17px;
            font-weight: 600;
            border-radius: 30px;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-company {
            background-color: #0d47a1;
            color: #fff;
        }

        .btn-company:hover {
            background-color: #0b3d8b;
            color: #fff;
        }

        .btn-campus {
            background-color: #00b14f;
            color: #fff;
        }

        .btn-campus:hover {
            background-color: #029a45;
            color: #fff;
        }
        .login-text {
    margin-top: 12px;
    font-size: 14px;
}

.login-text a {
    color: #0d47a1;
    text-decoration: none;
    font-weight: 600;
}

.login-text a:hover {
    text-decoration: underline;
}

    </style>
</head>

<body>

    {{-- Navbar --}}
    @include('partials.navbar')

    <div class="main-container">
        <div class="wave-background"></div>

        <div class="main-content">
            {{-- Garis bawah kustom diterapkan menggunakan ::after --}}
            <h2 class="title-glints">Pilih jenis pendaftaran</h2>

            <p class="description-text">
                Silakan pilih jenis pendaftaran yang sesuai untuk melanjutkan ke proses registrasi.
                Pilih Daftar Perusahaan jika Anda ingin memasang lowongan pekerjaan, atau pilih Daftar Kampus jika Anda ingin memasang lowongan pemagangan/intership.
            </p>

            <div class="btn-container">
                <div class="choice-item">
                    <img src="/images/kampus.png" alt="Ilustrasi Kampus" class="registration-img">
                    <a href="/kampus" class="btn btn-choose btn-campus d-flex align-items-center justify-content-center">
                        Daftar Kampus
                    </a>
                    
                    <!-- Tambahan Login -->
                    <p class="login-text">
                        Sudah punya akun kampus? <a href="/login-kampus">Login di sini</a>
                    </p>
                </div>
                <div class="choice-item">
                    <img src="/images/perusahaan.png" alt="Ilustrasi Perusahaan" class="registration-img">
                    <a href="/company" class="btn btn-choose btn-company d-flex align-items-center justify-content-center">
                        Daftar Perusahaan
                    </a>

                     <!-- Tambahan Login -->
                    <p class="login-text">
                        Sudah punya akun perusahaan? <a href="/company/login">Login di sini</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
