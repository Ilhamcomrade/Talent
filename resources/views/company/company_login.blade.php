<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Next Jobz</title>

    <link rel="icon" type="image/png" href="{{ asset('123.png') }}">
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
            background: #e9f6fd;
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

        /* Form - Hanya border yang diubah menjadi 1px solid #999 seperti halaman daftar */
        .form-control {
            border-radius: 2px;
            padding: 10px 15px;
            font-size: 1rem;
            color: #333;
            height: auto;
            border: 1px solid #999; /* Diubah ketebalan border menjadi 1px solid #999 */
        }

        /* Error styling untuk form input */
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
            background-color: #0d47a1;
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
            background-color: #0a3d8a;
        }

        /* Error message styling - HANYA DI BAWAH INPUT */
        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 5px;
            text-align: left;
            display: block;
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
            color: #4393fc;
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

        /* Responsive */
        @media (max-width: 768px) {
            .register-container {
                flex-direction: column;
                max-width: 90%;
                margin: 20px auto;
            }

            .register-left {
                max-width: 100%;
                flex-direction: row;
                justify-content: space-around;
                padding: 15px;
                gap: 10px;
            }

            .register-left .feature {
                align-items: center;
                text-align: center;
            }

            .register-left .feature img {
                width: 35px;
                height: 35px;
            }

            .register-left .feature img.people-img {
                width: 45px;
                height: 45px;
            }

            .qr-code-float {
                display: none;
            }
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

            <!-- HANYA MENAMPILKAN PESAN SUKSES, TANPA PESAN ERROR UMUM -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 4px; margin-bottom: 20px; padding: 12px 15px; font-size: 0.9rem;">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('company.login.submit') }}" method="POST" style="width: 100%;" id="loginForm">
                @csrf

                <div class="mb-3 text-start">
                    <input type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           id="email"
                           name="email"
                           placeholder="Masukkan email Anda"
                           value="{{ old('email') }}"
                           required>
                    <!-- HANYA TAMPILKAN ERROR EMAIL DI SINI -->
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 text-start">
                    <div class="password-container">
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               id="password"
                               name="password"
                               placeholder="Masukkan password anda"
                               required>
                        <i class="fa-regular fa-eye password-toggle"></i>
                    </div>
                    <!-- HANYA TAMPILKAN ERROR PASSWORD DI SINI -->
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <a href="{{ route('company.forgot.password') }}" class="forgot-password">Lupa password?</a>
                <button type="submit" class="btn btn-submit" id="submitBtn">
                    <span id="submitText">Masuk</span>
                    <span id="loadingSpinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                </button>
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
                Belum punya akun? <a href="{{ route('company.register') }}">Daftar di sini</a>
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
        // Password toggle functionality
        const passwordToggle = document.querySelector('.password-toggle');
        const passwordInput = document.querySelector('#password');

        if (passwordToggle && passwordInput) {
            passwordToggle.addEventListener('click', function () {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        }

        // Form validation and submission
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('loginForm');
            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');
            const loadingSpinner = document.getElementById('loadingSpinner');

            if (form) {
                form.addEventListener('submit', function(e) {
                    // Reset previous errors
                    const errorMessages = document.querySelectorAll('.error-message');
                    errorMessages.forEach(error => error.style.display = 'none');

                    const inputs = document.querySelectorAll('.form-control');
                    inputs.forEach(input => input.classList.remove('is-invalid'));

                    // Get form values
                    const email = document.getElementById('email').value.trim();
                    const password = document.getElementById('password').value.trim();
                    let hasError = false;

                    // Validate email
                    if (!email) {
                        showError('email', 'Email harus diisi.');
                        hasError = true;
                    } else if (!isValidEmail(email)) {
                        showError('email', 'Format email tidak valid.');
                        hasError = true;
                    }

                    // Validate password
                    if (!password) {
                        showError('password', 'Password harus diisi.');
                        hasError = true;
                    } else if (password.length < 6) {
                        showError('password', 'Password minimal 6 karakter.');
                        hasError = true;
                    }

                    if (hasError) {
                        e.preventDefault();
                        return false;
                    }

                    // Show loading state
                    submitBtn.disabled = true;
                    submitText.style.display = 'none';
                    loadingSpinner.style.display = 'inline-block';

                    return true;
                });
            }

            function showError(field, message) {
                const input = document.getElementById(field);
                const errorDiv = document.createElement('div');
                errorDiv.className = 'error-message';
                errorDiv.textContent = message;

                input.classList.add('is-invalid');

                // Remove existing error message
                const existingError = input.parentElement.querySelector('.error-message');
                if (existingError) {
                    existingError.remove();
                }

                // Insert error message after input
                input.parentElement.appendChild(errorDiv);
            }

            function isValidEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }

            // Auto-hide success alert after 5 seconds
            setTimeout(function() {
                const successAlert = document.querySelector('.alert-success');
                if (successAlert) {
                    const bsAlert = new bootstrap.Alert(successAlert);
                    bsAlert.close();
                }
            }, 5000);

            // Focus on email field if there's an error
            @if($errors->has('email') || $errors->has('password'))
                document.getElementById('email').focus();
            @endif
        });
    </script>
</body>
</html>
