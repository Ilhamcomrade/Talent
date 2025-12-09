<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Talenthub</title>

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

        /* REGISTER / LOGIN CONTAINER - DISESUAIKAN SAMA DENGAN HALAMAN PERUSAHAAN */
        .register-container {
            max-width: 650px; /* DISESUAIKAN SAMA */
            min-height: 450px; /* DISESUAIKAN SAMA */
            margin: 35px auto 50px auto; /* DISESUAIKAN SAMA */
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            overflow: hidden;
        }

        /* Kiri - DISESUAIKAN SAMA */
        .register-left {
            background: #c0eed5ff;
            padding: 28px 18px; /* DISESUAIKAN SAMA */
            max-width: 200px; /* DISESUAIKAN SAMA */
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            text-align: left;
            gap: 22px; /* DISESUAIKAN SAMA */
            flex-shrink: 0;
        }
        .register-left .feature {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-bottom: 0;
        }
        .register-left .feature img {
            width: 45px; /* DISESUAIKAN SAMA */
            height: 45px; /* DISESUAIKAN SAMA */
            margin-bottom: 9px; /* DISESUAIKAN SAMA */
            flex-shrink: 0;
        }
        .register-left .feature img.people-img {
            width: 60px; /* DISESUAIKAN SAMA */
            height: 60px; /* DISESUAIKAN SAMA */
        }
        .register-left .feature h6 {
            margin: 0;
            font-weight: 600;
            font-size: 13.5px; /* DISESUAIKAN SAMA */
            line-height: 1.35; /* DISESUAIKAN SAMA */
            color: #333;
        }

        /* Kanan - DISESUAIKAN SAMA */
        .register-right {
            padding: 40px 45px; /* DISESUAIKAN SAMA */
            flex: 1;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .register-right h3 {
            font-weight: bold;
            margin-bottom: 22px; /* DISESUAIKAN SAMA */
            font-size: 23px; /* DISESUAIKAN SAMA */
            line-height: 1.35; /* DISESUAIKAN SAMA */
        }

        /* Form - Disesuaikan dengan halaman login perusahaan */
        .form-label {
            align-self: flex-start;
            margin-bottom: 5px;
            font-weight: normal;
            color: black;
        }
        .form-control {
            border-radius: 2px; /* Diubah dari 6px menjadi 2px */
            padding: 10px 15px;
            font-size: 1rem;
            color: #333;
            height: auto;
            border: 1px solid #999; /* Diubah ketebalan border menjadi 1px solid #999 */
        }
        .form-control.is-invalid {
            border-color: #dc3545 !important;
            background-image: none;
        }
        .password-container {
            position: relative;
            width: 100%;
        }
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #aaa;
            font-size: 1.25rem;
        }
        .forgot-password {
            display: block;
            text-align: left;
            margin-top: 8px;
            font-size: 0.85rem;
            color: black;
            text-decoration: underline;
            font-weight: normal;
        }
        .btn-submit {
            background-color: #00b14f;
            color: #fff;
            padding: 8px 15px;
            border-radius: 6px;
            font-weight: normal;
            font-size: 1rem;
            border: none;
            width: 180px;
            margin-top: 20px;
        }
        .btn-submit:hover {
            background-color: #00b14f;
        }

        /* Error messages */
        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
            padding: 10px 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }
        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
            padding: 10px 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }
        .invalid-feedback {
            display: block;
            width: 100%;
            margin-top: 5px;
            font-size: 0.875rem;
            color: #dc3545;
            text-align: left;
        }
        .is-invalid {
            border-color: #dc3545 !important;
        }

        /* Social login - DISESUAIKAN SAMA */
        .social-login {
            margin-top: 18px; /* DISESUAIKAN SAMA */
            margin-bottom: 14px; /* DISESUAIKAN SAMA */
            display: flex;
            align-items: center;
            gap: 11px; /* DISESUAIKAN SAMA */
            justify-content: center;
            width: 100%;
        }
        .social-login span {
            color: #666;
            font-weight: 500;
            font-size: 0.83rem; /* DISESUAIKAN SAMA */
        }
        .social-login a img {
            width: 38px; /* DISESUAIKAN SAMA */
            height: 38px; /* DISESUAIKAN SAMA */
            border-radius: 50%;
            border: 1px solid #ccc;
            background: #fff;
            transition: 0.3s;
            object-fit: contain;
            padding: 4.5px; /* DISESUAIKAN SAMA */
        }
        .social-login a img.linkedin,
        .social-login a img.facebook,
        .social-login a img.google-icon {
            padding: 1px;
        }
        .social-login a img:hover {
            background: #f5f5f5;
        }

        /* Terms - DISESUAIKAN SAMA */
        .terms {
            margin-top: 9px; /* DISESUAIKAN SAMA */
            font-size: 0.83rem; /* DISESUAIKAN SAMA */
            color: #6c757d;
            line-height: 1.45; /* DISESUAIKAN SAMA */
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

        /* Login link - DISESUAIKAN SAMA */
        .login-link {
            margin-top: 14px; /* DISESUAIKAN SAMA */
            font-size: 0.98rem; /* DISESUAIKAN SAMA */
            color: #6c757d;
        }
        .login-link a {
            color: #00b14f;
            font-weight: 600;
            text-decoration: none;
        }
        .login-link a:hover {
            text-decoration: underline;
        }

        /* QR Code Floating - DISESUAIKAN SAMA */
        .qr-code-float {
            position: fixed;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 14px; /* DISESUAIKAN SAMA */
            text-align: center;
            z-index: 1000;
            width: 140px; /* DISESUAIKAN SAMA */
        }
        .qr-code-float img {
            width: 95px; /* DISESUAIKAN SAMA */
            height: auto;
            margin-bottom: 9px; /* DISESUAIKAN SAMA */
        }
        .qr-code-float p {
            font-size: 13.5px; /* DISESUAIKAN SAMA */
            line-height: 1.35; /* DISESUAIKAN SAMA */
            color: #333;
            font-weight: 500;
            margin: 0;
        }

        /* PERUBAHAN: Error message khusus untuk email salah */
        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 5px;
            text-align: left;
            width: 100%;
            display: block;
        }

        /* PERUBAHAN: Style untuk form errors */
        .form-group {
            margin-bottom: 1rem;
            width: 100%;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="container-fluid d-flex justify-content-between align-items-center mx-lg-5">
            <a href="/" class="navbar-brand d-flex align-items-center py-2">
                <img src="{{ asset('images/logo_inotal.png') }}" alt="Talenthub Logo" class="navbar-logo">
            </a>
            <a href="{{ url('/login-kampus') }}" class="btn-login">Masuk</a>
        </div>
    </nav>

    <div class="register-container">
        <div class="register-left">
            <div class="feature">
                <img src="{{ asset('images/people_green.png') }}" alt="People" class="people-img">
                <h6>Akses 9 Juta+<br>Talenta</h6>
            </div>
            <div class="feature">
                <img src="{{ asset('images/chat_green.png') }}" alt="Chat">
                <h6>Chat dan Rekrut<br>Talenta Langsung</h6>
            </div>
            <div class="feature">
                <img src="{{ asset('images/ai_green.png') }}" alt="AI">
                <h6>Rekrutmen Cepat<br>dengan Bantuan AI</h6>
            </div>
        </div>

        <div class="register-right">
            <h3>Pasang Iklan Intership<br>Sekarang!</h3>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('campus.login.submit') }}" method="POST" style="width: 100%;">
                @csrf

                <!-- PERUBAHAN: Form group untuk email dengan error di bawahnya -->
                <div class="form-group mb-3 text-start">
                    <input type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           id="email"
                           name="email"
                           placeholder="Masukkan email Anda"
                           value="{{ old('email') }}"
                           required>

                    <!-- PERUBAHAN: Tampilkan error email spesifik di bawah input -->
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- PERUBAHAN: Form group untuk password dengan error di bawahnya -->
                <div class="form-group mb-3 text-start">
                    <div class="password-container">
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               id="password"
                               name="password"
                               placeholder="Masukkan password anda"
                               required>
                        <i class="fa-regular fa-eye password-toggle"></i>
                    </div>

                    <!-- PERUBAHAN: Tampilkan error password spesifik di bawah input -->
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <a href="/lupa-password-kampus" class="forgot-password">Lupa password?</a>
                <button type="submit" class="btn btn-submit">Masuk</button>
            </form>

            <div class="social-login">
                <span>Atau dengan</span>
                <a href="#"><img src="{{ asset('images/googles.png') }}" alt="Google" class="google-icon"></a>
            </div>

            <div class="terms">
                Dengan melanjutkan, anda menyetujui
                <a href="#">Perjanjian Pengguna</a>,
                <a href="#">Kebijakan Privasi</a> dan
                <a href="#">Syarat Ketentuan Layanan</a>
            </div>

            <div class="login-link">
                Belum punya akun? <a href="{{ route('campus.register') }}">Daftar di sini</a>
            </div>
        </div>
    </div>

    <div class="qr-code-float">
        <img src="{{ asset('images/qr code.png') }}" alt="QR Code Glints App">
        <p>Rekrut Cepat<br>dengan Talenthub App</p>
    </div>

    @include('partials.footer')

    <script>
        const passwordToggle = document.querySelector('.password-toggle');
        const passwordInput = document.querySelector('#password');

        passwordToggle.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        // PERUBAHAN: Focus pada input email jika ada error
        @if($errors->has('email'))
            document.getElementById('email').focus();
        @endif

        // PERUBAHAN: Focus pada input password jika ada error password saja
        @if($errors->has('password') && !$errors->has('email'))
            document.getElementById('password').focus();
        @endif
    </script>
</body>
</html>
