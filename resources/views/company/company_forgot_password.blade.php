<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lupa Kata Sandi | Next Employer</title>

    <link rel="icon" type="image/png" href="{{ asset('1.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"/>

    <style>
        /* [KEEP ALL EXISTING STYLES] */
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #f8f9fa;
            height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        /* [KEEP ALL EXISTING STYLES] */
        .navbar {
            font-size: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            background: #fff;
            border-bottom: 1px solid #dee2e6;
            padding: 0.5rem 1rem;
        }
        .navbar-logo {
            height: 38px;
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

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .sub-title {
            font-size: 28px;
            font-weight: 700;
            line-height: 1.2;
            color: #2c2c2c;
            text-align: center;
            margin-bottom: 30px;
        }

        .forgot-container {
            max-width: 400px;
            padding: 32px;
            margin: 0 auto;
            width: 100%;
            background-color: #fff;
            border-radius: 2px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

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

        .form-control.is-invalid {
            border-color: #dc3545;
        }

        .form-control.is-valid {
            border-color: #198754;
        }

        .form-control::placeholder {
            color: #6c757d;
        }

        .btn-submit {
            background-color: #0d47a1;
            color: #fff;
            font-weight: 600;
            height: 45px;
            border: none;
            font-size: 15px;
            width: 100%;
            margin: 10px auto 8px;
            display: block;
            border-radius: 2px; /* Sudut lancip 90 derajat */
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-submit:disabled {
            background-color: #5472d3;
            cursor: not-allowed;
        }

        /* STYLE TOMBOL BATALKAN YANG SUDAH DISESUAIKAN - SUDUT LANCIP */
        .btn-cancel {
            background-color: #fff;
            color: #0d47a1;
            border: 2px solid #0d47a1;
            font-weight: 600;
            height: 45px;
            font-size: 15px;
            width: 100%;
            margin: 8px auto;
            display: block;
            border-radius: 2px; /* Diubah dari 6px menjadi 2px untuk sudut lancip */
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            line-height: 41px;
            text-align: center;
        }

        .btn-cancel:hover {
            background-color: #0d47a1;
            color: #fff;
            border-color: #0d47a1;
        }

        /* STYLE TOMBOL KIRIM ULANG - SUDUT LANCIP - BIRU PERMANEN */
        .btn-resend {
            background-color: #0d47a1; /* Biru permanen */
            color: #fff; /* Teks putih */
            font-weight: 600;
            height: 45px;
            font-size: 15px;
            width: 100%;
            margin: 20px auto 0; /* Margin atas 20px, bawah 0 */
            display: block;
            border-radius: 2px; /* Sudut lancip */
            cursor: pointer;
            text-decoration: none;
            line-height: 45px; /* Line height disesuaikan */
            text-align: center;
            border: none; /* Tidak ada border */
            /* Hapus semua transisi dan efek hover */
            transition: none;
        }

        /* TIDAK ADA EFEK HOVER - WARNA TETAP SAMA */
        .btn-resend:hover {
            background-color: #0d47a1; /* Tetap biru sama */
            color: #fff; /* Tetap putih sama */
        }

        /* Loading state untuk tombol kirim ulang */
        .btn-resend:disabled {
            background-color: #5472d3; /* Biru lebih terang saat disabled */
            color: #fff;
            cursor: not-allowed;
        }

        /* HAPUS LOADING ANIMATION UNTUK TOMBOL RESEND */
        .btn-resend.loading {
            position: relative;
            color: #fff !important; /* Tetap putih saat loading */
        }

        /* HAPUS ANIMASI SPINNER */
        .btn-resend.loading::after {
            content: none; /* Hapus spinner */
        }

        .status-message {
            padding: 12px 16px;
            border-radius: 4px;
            margin-bottom: 15px;
            font-size: 14px;
            display: none;
        }

        .status-message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            display: block;
        }

        .status-message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            display: block;
        }

        .form-text {
            font-size: 13px;
            color: #666;
            margin-top: 8px;
            line-height: 1.4;
            text-align: left;
        }

        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
            margin-right: 8px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .success-confirmation {
            display: none;
        }

        .success-confirmation.active {
            display: block;
        }

        .success-box {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
            padding: 24px;
        }

        .success-box-title {
            color: #155724;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 12px;
            line-height: 1.5;
            text-align: left;
        }

        .success-box-email {
            color: #155724;
            font-weight: 700;
            margin-bottom: 8px;
            text-align: left;
            font-size: 16px;
            word-break: break-all;
        }

        .success-box-message {
            color: #155724;
            font-size: 14px;
            line-height: 1.5;
            text-align: left;
            margin-top: 8px;
        }

        .invalid-feedback {
            display: block;
            width: 100%;
            margin-top: 0.25rem;
            font-size: 0.875em;
            color: #dc3545;
        }

        /* PERUBAHAN: Sembunyikan pesan error di atas form */
        .hide-form-error-messages .status-message.error {
            display: none !important;
        }

        @media (max-width: 576px) {
            .forgot-container {
                padding: 24px;
            }

            .sub-title {
                font-size: 24px;
            }

            .main-content {
                padding: 15px;
            }
        }

        .vertical-center-wrapper {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 140px);
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="container-fluid d-flex justify-content-between align-items-center mx-lg-5">
            <a href="/" class="navbar-brand d-flex align-items-center py-2">
                <img src="{{ asset('images/logo_inotal.png') }}" alt="Talenthub Logo" class="navbar-logo">
            </a>
            <a href="{{ route('company.login') }}" class="btn-login">Masuk</a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="vertical-center-wrapper">
            <!-- Judul di luar card -->
            <p class="sub-title">Lupa Kata Sandi Anda?</p>

            <div class="forgot-container">
                <!-- PERUBAHAN: Hanya tampilkan pesan sukses dari session -->
                @if(session('status'))
                    <div class="status-message success" id="sessionSuccessMessage">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Form Section (Default View) -->
                <div id="formSection">
                    <form id="forgotPasswordForm" action="{{ route('company.password.email') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <input type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   id="email"
                                   name="email"
                                   placeholder="Masukkan alamat email anda"
                                   value="{{ old('email') }}"
                                   required>
                            @error('email')
                                <!-- PERUBAHAN: Pesan error khusus untuk email tidak terdaftar -->
                                <div class="invalid-feedback" id="emailError">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-text mt-2">
                                Masukkan email anda diatas untuk mendapatkan instruksi reset kata sandi
                            </div>
                        </div>

                        <button type="submit" class="btn-submit" id="submitBtn">
                            <span id="submitText">KIRIM INSTRUKSI RESET</span>
                            <span id="submitLoading" class="loading" style="display: none;"></span>
                        </button>

                        <!-- TOMBOL BATALKAN YANG SUDAH DISESUAIKAN DENGAN SUDUT LANCIP -->
                        <a href="{{ route('company.login') }}" class="btn-cancel" id="cancelBtn">
                            BATALKAN
                        </a>
                    </form>
                </div>

                <!-- Success Confirmation Section (Hidden by default) -->
                <div id="successSection" class="success-confirmation">
                    <div class="success-box">
                        <div class="success-box-title">
                            Email reset kata sandi telah dikirim ke
                        </div>
                        <!-- Email akan ditampilkan di sini -->
                        <!-- PERUBAHAN: Prioritas tampilkan email dari session, kemudian dari localStorage -->
                        <div class="success-box-email" id="sentEmailAddress">
                            @if(session('email'))
                                {{ session('email') }}
                            @endif
                        </div>
                        <div class="success-box-message">
                            Klik tautan di email tersebut untuk mereset kata sandi Anda.
                            <br><br>
                            <small style="color: #0d47a1; font-weight: 500;">
                                <i class="fas fa-redo"></i> Tidak menerima email?
                                <a href="#" id="resendLink" style="color: #0d47a1; text-decoration: underline;">
                                    Kirim ulang
                                </a>
                            </small>
                        </div>
                    </div>

                    <!-- TOMBOL KIRIM ULANG SAJA (TANPA TOMBOL BATALKAN) -->
                    <button type="button" class="btn-resend" id="resendButton">
                        <span id="resendButtonText">KIRIM ULANG</span>
                        <span id="resendButtonLoading" class="loading" style="display: none;"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('forgotPasswordForm');
            const emailInput = document.getElementById('email');
            const emailError = document.getElementById('emailError');
            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');
            const submitLoading = document.getElementById('submitLoading');
            const cancelBtn = document.getElementById('cancelBtn');
            const formSection = document.getElementById('formSection');
            const successSection = document.getElementById('successSection');
            const sentEmailAddress = document.getElementById('sentEmailAddress');
            const resendLink = document.getElementById('resendLink');
            const resendButton = document.getElementById('resendButton');
            const resendButtonText = document.getElementById('resendButtonText');
            const resendButtonLoading = document.getElementById('resendButtonLoading');

            let currentEmail = '';

            // PERUBAHAN: Hapus localStorage untuk reset password perusahaan
            localStorage.removeItem('company_last_submitted_email');
            localStorage.removeItem('company_reset_timestamp');

            // Sembunyikan pesan session setelah 5 detik
            setTimeout(() => {
                const sessionSuccessMessage = document.getElementById('sessionSuccessMessage');

                if (sessionSuccessMessage) {
                    sessionSuccessMessage.style.display = 'none';
                }
            }, 5000);

            // Function untuk menampilkan success state
            function showSuccessState(email) {
                formSection.style.display = 'none';
                successSection.classList.add('active');

                // Tampilkan email
                if (email) {
                    sentEmailAddress.textContent = email;
                    currentEmail = email;
                    // Simpan ke localStorage
                    localStorage.setItem('company_last_submitted_email', email);
                }
            }

            // Function untuk menampilkan form state
            function showFormState() {
                successSection.classList.remove('active');
                formSection.style.display = 'block';

                // PERUBAHAN: Isi email input dengan email sebelumnya
                if (currentEmail) {
                    emailInput.value = currentEmail;
                    // Tambahkan validasi visual jika email valid
                    if (validateEmail(currentEmail)) {
                        emailInput.classList.remove('is-invalid');
                        emailInput.classList.add('is-valid');
                    }
                } else {
                    emailInput.value = '';
                }

                // Clear error state
                emailInput.classList.remove('is-invalid');
                if (emailError) {
                    emailError.textContent = '';
                }

                // Focus email input
                setTimeout(() => {
                    emailInput.focus();
                    // Pilih teks yang sudah ada untuk kemudahan edit
                    if (emailInput.value) {
                        emailInput.select();
                    }
                }, 100);
            }

            // Function untuk memvalidasi email
            function validateEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }

            // Logika untuk menampilkan success section
            function showSuccessSection(email) {
                formSection.style.display = 'none';
                successSection.classList.add('active');

                // Tampilkan email
                if (email) {
                    sentEmailAddress.textContent = email;
                    currentEmail = email;
                    // Simpan ke localStorage
                    localStorage.setItem('company_last_submitted_email', email);
                }
            }

            // Jika ada pesan sukses dari session, tampilkan success section
            @if(session('status'))
                // Email dari session memiliki prioritas tertinggi
                const sessionEmail = '{{ session("email", "") }}';
                const oldEmail = '{{ old("email", "") }}';
                const displayEmail = sessionEmail || oldEmail;

                showSuccessSection(displayEmail);
            @endif

            // PERUBAHAN: Jika ada error validasi, pastikan hanya ditampilkan di bawah input
            @if($errors->has('email'))
                // Hanya set error styling untuk input email
                emailInput.classList.add('is-invalid');
                // Pastikan pesan error sudah ditampilkan dari blade template
            @endif

            // Email validation function
            function validateEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }

            // Add input validation styling
            emailInput.addEventListener('input', function() {
                if (this.value.trim() === '') {
                    this.classList.remove('is-valid', 'is-invalid');
                    if (emailError) {
                        emailError.textContent = '';
                    }
                } else if (validateEmail(this.value.trim())) {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                    if (emailError) {
                        emailError.textContent = '';
                    }
                } else {
                    this.classList.remove('is-valid');
                    this.classList.add('is-invalid');
                    if (emailError) {
                        emailError.textContent = 'Format email tidak valid.';
                    }
                }
            });

            // Form submission handling
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const emailValue = emailInput.value.trim();

                // Validasi format email
                if (!validateEmail(emailValue)) {
                    emailInput.classList.add('is-invalid');
                    if (emailError) {
                        emailError.textContent = 'Format email tidak valid.';
                    }
                    return;
                }

                // Clear previous error
                emailInput.classList.remove('is-invalid');
                if (emailError) {
                    emailError.textContent = '';
                }

                // Disable submit button and show loading
                submitBtn.disabled = true;
                submitText.style.display = 'none';
                submitLoading.style.display = 'inline-block';

                // Simpan email untuk digunakan kembali
                currentEmail = emailValue;

                // Simpan ke localStorage untuk ditampilkan nanti
                localStorage.setItem('company_last_submitted_email', emailValue);

                // Submit the form
                form.submit();
            });

            // PERUBAHAN: Fitur kirim ulang email dari link teks - KEMBALI KE FORM
            if (resendLink) {
                resendLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    showFormState();
                });
            }

            // PERUBAHAN: Fitur kirim ulang email dari tombol KIRIM ULANG - KEMBALI KE FORM
            if (resendButton) {
                resendButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    showFormState();
                });
            }

            // Cek jika ada email yang disimpan di localStorage
            const lastEmail = localStorage.getItem('company_last_submitted_email');
            if (lastEmail && !sentEmailAddress.textContent.trim()) {
                sentEmailAddress.textContent = lastEmail;
            }

            // Focus email input on page load jika form ditampilkan
            if (formSection.style.display !== 'none') {
                setTimeout(() => {
                    emailInput.focus();
                }, 100);
            }
        });
    </script>

</body>
</html>
