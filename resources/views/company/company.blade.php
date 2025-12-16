<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pasang Iklan Lowongan Kerja Gratis | Next Employer</title>

    <link rel="icon" type="image/png" href="{{ asset('1.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"/>

    <style>
        body {
            background-color: #f7f9fb;
            font-family: Arial, sans-serif;
        }

        /* NAVBAR */
        .navbar {
            font-size: 1rem; /* disamakan */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            background: #fff;
            border-bottom: 1px solid #dee2e6;
            padding: 0.5rem 1rem; /* lebih mendekati ukuran bootstrap default */
        }
        .navbar-logo {
            height: 38px; /* disamakan */
            width: auto;
        }
        .btn-login {
            border-radius: 6px;
            padding: 0.35rem 1rem;
            font-weight: 600;
            font-size: 0.95rem;
            color: #0d47a1 !important;
            background-color: #fff;
            border: 2px solid #0d47a1;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            background-color: #0d47a1;
            color: #fff !important;
            border: 2px solid #0d47a1;
        }

        /* REGISTER CONTAINER - DIKECILKAN SEDIKIT */
        .register-container {
            max-width: 650px; /* DIKECILKAN SEDIKIT dari 700px */
            min-height: 450px; /* DIKECILKAN SEDIKIT dari 490px */
            margin: 35px auto 50px auto; /* DIKECILKAN SEDIKIT margin */
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            overflow: hidden;
        }

        /* Kiri - DIKECILKAN SEDIKIT */
        .register-left {
            background: #e9f6fd;
            padding: 28px 18px; /* DIKECILKAN SEDIKIT */
            max-width: 200px; /* DIKECILKAN SEDIKIT dari 220px */
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            text-align: left;
            gap: 22px; /* DIKECILKAN SEDIKIT */
            flex-shrink: 0;
        }
        .register-left .feature {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-bottom: 0;
        }
        .register-left .feature img {
            width: 45px; /* DIKECILKAN SEDIKIT dari 50px */
            height: 45px; /* DIKECILKAN SEDIKIT dari 50px */
            margin-bottom: 9px; /* DIKECILKAN SEDIKIT */
            flex-shrink: 0;
        }
        .register-left .feature img.people-img {
            width: 60px; /* DIKECILKAN SEDIKIT dari 65px */
            height: 60px; /* DIKECILKAN SEDIKIT dari 65px */
        }
        .register-left .feature h6 {
            margin: 0;
            font-weight: 600;
            font-size: 13.5px; /* DIKECILKAN SEDIKIT dari 14px */
            line-height: 1.35; /* DIKECILKAN SEDIKIT dari 1.4 */
            color: #333;
        }

        /* Kanan - DIKECILKAN SEDIKIT */
        .register-right {
            padding: 40px 45px; /* DIKECILKAN SEDIKIT dari 45px 50px */
            flex: 1;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .register-right h3 {
            font-weight: bold;
            margin-bottom: 22px; /* DIKECILKAN SEDIKIT dari 25px */
            font-size: 23px; /* DIKECILKAN SEDIKIT dari 25px */
            line-height: 1.35; /* DIKECILKAN SEDIKIT dari 1.4 */
        }
        .register-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #ddd;
            border-radius: 25px;
            padding: 11px 19px; /* DIKECILKAN SEDIKIT dari 12px 20px */
            margin: 7px 0; /* DIKECILKAN SEDIKIT dari 8px 0 */
            cursor: pointer;
            font-weight: 500;
            font-size: 0.98rem; /* DIKECILKAN SEDIKIT */
            background: #fff;
            width: 100%;
            transition: 0.3s;
            text-decoration: none;
            color: #333;
        }
        .register-btn:hover {
            background: #f8f9fa;
        }
        .register-btn img {
            width: 23px; /* DIKECILKAN SEDIKIT dari 24px */
            height: 23px; /* DIKECILKAN SEDIKIT dari 24px */
            margin-right: 11px; /* DIKECILKAN SEDIKIT dari 12px */
        }

        /* Social login - DIKECILKAN SEDIKIT */
        .social-login {
            margin-top: 18px; /* DIKECILKAN SEDIKIT dari 20px */
            margin-bottom: 14px; /* DIKECILKAN SEDIKIT dari 15px */
            display: flex;
            align-items: center;
            gap: 11px; /* DIKECILKAN SEDIKIT dari 12px */
            justify-content: center;
            width: 100%;
        }
        .social-login span {
            color: #666;
            font-weight: 500;
            font-size: 0.83rem; /* DIKECILKAN SEDIKIT dari 0.85rem */
        }
        .social-login a img {
            width: 38px; /* DIKECILKAN SEDIKIT dari 40px */
            height: 38px; /* DIKECILKAN SEDIKIT dari 40px */
            border-radius: 50%;
            border: 1px solid #ccc;
            background: #fff;
            transition: 0.3s;
            object-fit: contain;
            padding: 4.5px; /* DIKECILKAN SEDIKIT dari 5px */
        }
        .social-login a img.linkedin,
        .social-login a img.facebook {
            padding: 1px;
        }
        .social-login a img:hover {
            background: #f5f5f5;
        }

        /* Terms - DIKECILKAN SEDIKIT */
        .terms {
            margin-top: 9px; /* DIKECILKAN SEDIKIT dari 10px */
            font-size: 0.83rem; /* DIKECILKAN SEDIKIT dari 0.85rem */
            color: #6c757d;
            line-height: 1.45; /* DIKECILKAN SEDIKIT dari 1.5 */
            max-width: 90%;
        }
        .terms a {
            color: #000;
            font-weight: normal;
            text-decoration: none;
        }
        .terms a:hover {
            text-decoration: underline;
        }

        /* Login link - DIKECILKAN SEDIKIT */
        .login-link {
            margin-top: 14px; /* DIKECILKAN SEDIKIT dari 15px */
            font-size: 0.98rem; /* DIKECILKAN SEDIKIT dari 1rem */
            color: #6c757d;
        }
        .login-link a {
            color: #4393fc;
            font-weight: 600;
            text-decoration: none;
        }
        .login-link a:hover {
            text-decoration: underline;
        }

        /* QR Code Floating - DIKECILKAN SEDIKIT */
        .qr-code-float {
            position: fixed;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 14px; /* DIKECILKAN SEDIKIT dari 15px */
            text-align: center;
            z-index: 1000;
            width: 140px; /* DIKECILKAN SEDIKIT dari 150px */
        }
        .qr-code-float img {
            width: 95px; /* DIKECILKAN SEDIKIT dari 100px */
            height: auto;
            margin-bottom: 9px; /* DIKECILKAN SEDIKIT dari 10px */
        }
        .qr-code-float p {
            font-size: 13.5px; /* DIKECILKAN SEDIKIT dari 14px */
            line-height: 1.35; /* DIKECILKAN SEDIKIT dari 1.4 */
            color: #333;
            font-weight: 500;
            margin: 0;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="container-fluid d-flex justify-content-between align-items-center mx-lg-5">
            <a href="/" class="navbar-brand d-flex align-items-center py-2">
                <img src="{{ asset('images/logo_inotal.png') }}" alt="Talenthub Logo" class="navbar-logo">
            </a>
            <a href="{{ route('company.login') }}" class="btn-login">Masuk</a>
        </div>
    </nav>

    <div class="register-container">
        <div class="register-left">
            <div class="feature">
                <img src="{{ asset('images/people.png') }}" alt="People" class="people-img">
                <h6>Akses 9 Juta+<br>Talenta</h6>
            </div>
            <div class="feature">
                <img src="{{ asset('images/chat.png') }}" alt="Chat">
                <h6>Chat dan Rekrut<br>Talenta Langsung</h6>
            </div>
            <div class="feature">
                <img src="{{ asset('images/ai.png') }}" alt="AI">
                <h6>Rekrutmen Cepat<br>dengan Bantuan AI</h6>
            </div>
        </div>

        <div class="register-right">
            <h3>Pasang Iklan Lowongan<br>Kerja Gratis!</h3>

            <div class="register-btn">
                <img src="{{ asset('images/googles.png') }}" alt="Google">
                Daftar dengan Google
            </div>

            <a href="{{ route('company.register') }}" class="register-btn">
                <img src="{{ asset('images/gmail.png') }}" alt="Email">
                Daftar dengan Email
            </a>

            <!-- <div class="social-login">
                <span>Atau dengan</span>
                <a href="#"><img src="{{ asset('images/logo linkedin.png') }}" alt="LinkedIn" class="linkedin"></a>
                <a href="#"><img src="{{ asset('images/logo facebook.png') }}" alt="Facebook" class="facebook"></a>
            </div> -->

            <div class="terms">
                Dengan melanjutkan, anda menyetujui
                <a href="#">Perjanjian Pengguna</a>,
                <a href="#">Kebijakan Privasi</a> dan
                <a href="#">Syarat Ketentuan Layanan</a>
            </div>

            <div class="login-link">
                Sudah punya akun? <a href="{{ route('company.login') }}">Login di sini</a>
            </div>
        </div>
    </div>

    <div class="qr-code-float">
        <img src="{{ asset('images/qr code.png') }}" alt="QR Code Glints App">
        <p>Rekrut Cepat<br>dengan Talenthub App</p>
    </div>

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Tambahkan event listener untuk tombol Google (jika diperlukan)
        document.addEventListener('DOMContentLoaded', function() {
            const googleBtn = document.querySelector('.register-btn:first-child');
            const emailBtn = document.querySelector('.register-btn[href]');

            // Contoh: Tambahkan loading state untuk tombol Google
            googleBtn.addEventListener('click', function(e) {
                // Jika ingin mengimplementasikan Google OAuth di masa depan
                // e.preventDefault();
                // window.location.href = '/auth/google';
            });

            // Email button sudah memiliki href yang benar ke route company.register
        });
    </script>

</body>
</html>
