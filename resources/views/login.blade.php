<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Masuk | Next Jobz</title>

    <link rel="icon" type="image/png" href="{{ asset('123.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .login-container {
            max-width: 400px;
            padding: 32px;
            margin-top: 20px;
        }

        .sub-title{
            font-size: 28px;
            font-weight: 700;
            line-height: 1.2;
            color: #2c2c2c;
            text-align: center;
            margin-bottom: 5px;
        }

        .social-buttons {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 5px;
            margin-bottom: 15px;
        }

        .social-buttons img {
            width: 60px;
            height: 60px;
            object-fit: contain;
        }

        .social-buttons .facebook-logo {
            width: 70px;
            height: 70px;
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            color: #8c8f95;
            font-size: 16px;
            margin: 8px 0; /* Dikurangi margin atas dan bawah agar lebih dekat */
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e1e4e8;
        }

        .divider:not(:empty)::before {
            margin-right: .75em;
        }

        .divider:not(:empty)::after {
            margin-left: .75em;
        }

        .info-box {
            background-color: #f5f6f8;
            padding: 16px;
            border-radius: 4px;
            font-size: 16px;
            color: #6c757d;
            text-align: left;
        }

        .info-box a {
            color: #007AFF;
            font-weight: 500;
            text-decoration: underline;
        }

        .footer-line {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 12px; /* Dikurangi dari 20px menjadi 12px untuk naik lebih tinggi */
            font-size: 16px;
            color: #6c757d;
        }

        .footer-line a {
            color: #007AFF;
            text-decoration: underline;
            font-weight: 500;
        }

        .text-link {
            color: #007AFF;
            text-decoration: underline;
            font-weight: 500;
        }

        .company-link {
            font-size: 16px;
            color: #6c757d;
            text-align: center;
            margin-top: 4px; /* Dikurangi dari 8px menjadi 4px untuk naik lebih tinggi */
        }

        .company-link a {
            color: #007AFF;
            text-decoration: underline;
            font-weight: 500;
        }

        /* Form control disesuaikan dengan halaman daftar */
        .form-control {
            height: 45px;
            font-size: 14px;
            border: 1px solid #999;
            border-radius: 2px;
            box-shadow: none;
        }

        .form-control:focus {
            border-color: #333;
            box-shadow: none;
        }

        .password-container {
            position: relative;
        }

        .password-container .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
        }

        /* Tombol Masuk disesuaikan dengan tombol Daftar */
        .btn-masuk {
            background-color: #e60000;
            color: #fff;
            font-weight: 600;
            height: 45px;
            border: none;
            font-size: 15px;
            width: 180px; /* Sama dengan lebar tombol Daftar */
            margin: 10px auto 8px; /* Dikurangi margin atas dan bawah agar lebih dekat */
            display: block;
        }

        .btn-masuk:hover {
            background-color: #c70000;
        }

        .forgot-password {
            text-align: left;
            margin-top: -5px;
            margin-bottom: 5px;
        }

        .forgot-password a {
            color: #007AFF;
            text-decoration: underline;
            font-weight: 500;
            font-size: 15px;
        }

        .glints-toast {
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            background-color: #fff;
            padding: 12px;
            max-width: 600px;
            z-index: 1080;
        }

        .toast-container.position-fixed {
            top: 20px;
            right: 20px;
        }

        .glints-toast .toast-header {
            background-color: transparent;
            border-bottom: none;
            padding: 0;
            display: flex;
            align-items: flex-start;
            line-height: 1.2;
        }

        .glints-icon {
            color: #198754;
            font-size: 16px;
            margin-right: 10px;
            line-height: 1.5;
        }

        .glints-toast-content {
            flex-grow: 1;
            margin-right: 10px;
        }

        .glints-toast-title {
            color: #2c2c2c;
            font-weight: normal;
            font-size: 16px;
            margin-bottom: 2px;
            display: block;
        }

        .glints-toast-text {
            color: #6c757d;
            font-size: 14px;
            line-height: 1.3;
            display: block;
        }

        .glints-toast .btn-close {
            padding: 0;
            margin-left: auto;
            color: #8c8f95;
            opacity: 0.8;
            margin-top: 0;
        }
    </style>
</head>

<body style="background-color: #f8f9fa;">

    @include('partials.navbar')

    <div class="d-flex flex-column align-items-center pt-3">
        <!-- <h2 class="title-glints">Selamat Datang Kembali!</h2> -->
        <p class="sub-title">Masuk ke akun Talenthub kamu</p>
        <div class="login-container bg-white rounded shadow-sm">
            <form action="{{ route('login.process') }}" method="POST">
                @csrf
                <div class="mb-3">
                     <!-- <label for="email" class="form-label">Email</label> -->
                    <input type="email" class="form-control" id="email" name="email" placeholder="Alamat Email" required>
                </div>
                <div class="mb-3">
                    <!-- <label for="password" class="form-label">Password</label> -->
                    <div class="password-container">
                        <input type="password" class="form-control" id="passwordInput" name="password" placeholder="Kata Sandi" required>
                        <i class="fa-regular fa-eye password-toggle"></i>
                    </div>
                </div>
                <!-- Tambahkan link Lupa Password di sini -->
                <div class="forgot-password">
                    <a href="{{ url('/lupa-kata-sandi') }}">Lupa Kata Sandi?</a>
                </div>
                <div class="d-grid gap-2 mb-2"> <!-- Dikurangi margin bottom dari mb-3 ke mb-2 -->
                    <button type="submit" class="btn btn-masuk">Masuk</button>
                </div>
            </form>

            <p class="divider">atau</p>

            <div class="social-buttons">
               <a href="{{ route('google.login') }}" title="Masuk dengan Google">
                    <img src="{{ asset('images/logo google.png') }}" alt="Google">
                </a>
                 <!-- <a href="#">
                    <img src="{{ asset('images/logo facebook.png') }}" alt="Facebook" class="facebook-logo">
                </a>
                 <a href="#">
                    <img src="{{ asset('images/logo linkedin.png') }}" alt="linkedin" class="linkedin-logo">
                </a>  -->
            </div>

            <hr class="my-3"> <!-- Dikurangi margin dari my-4 ke my-3 -->

            <div class="footer-line">
                <span>Belum punya akun?</span>
                <a href="{{ url('/daftar') }}">Daftar</a>
            </div>

            <p class="company-link mb-0">
                Untuk perusahaan, kunjungi <a href="/company">laman berikut.</a>
            </p>
        </div>
    </div>

    @if (session('account_deleted'))
        <input type="hidden" id="showDeletedAccountToastFlag" value="1">
    @endif

    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="deletedAccountToast" class="toast glints-toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="fas fa-check-circle glints-icon"></i>
                <div class="glints-toast-content">
                    <strong class="glints-toast-title">Akun dihapus</strong>
                    <span class="glints-toast-text">Untuk melanjutkan, silahkan gunakan akun lain untuk login.</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Tutup"></button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const passwordInput = document.getElementById("passwordInput");
        const passwordToggle = document.querySelector(".password-toggle");

        if (passwordInput && passwordToggle) {
            passwordToggle.addEventListener("click", function () {
                const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
                passwordInput.setAttribute("type", type);

                this.classList.toggle("fa-eye");
                this.classList.toggle("fa-eye-slash");
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const showFlag = document.getElementById('showDeletedAccountToastFlag');

            if (showFlag) {
                const toastEl = document.getElementById('deletedAccountToast');
                if (toastEl) {
                    const deletedToast = new bootstrap.Toast(toastEl, {
                        autohide: true,
                        delay: 5000
                    });
                    deletedToast.show();
                }
            }
        });
    </script>
</body>
</html>
