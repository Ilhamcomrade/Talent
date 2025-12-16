<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lupa Kata Sandi | Next Employer</title>

    <link rel="icon" type="image/png" href="https://via.placeholder.com/32x32/00b14f/ffffff?text=NJ">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"/>

    <style>
        /* [KEEP ALL EXISTING STYLES - TIDAK ADA PERUBAHAN] */
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #f8f9fa;
            height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

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
            background-color: #00b14f;
            color: #fff;
            font-weight: 600;
            height: 45px;
            border: none;
            font-size: 15px;
            width: 100%;
            margin: 10px auto 8px;
            display: block;
            border-radius: 2px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #009944;
        }

        .btn-submit:disabled {
            background-color: #66d19e;
            cursor: not-allowed;
        }

        .btn-cancel {
            background-color: #fff;
            color: #00b14f;
            border: 2px solid #00b14f;
            font-weight: 600;
            height: 45px;
            font-size: 15px;
            width: 100%;
            margin: 8px auto;
            display: block;
            border-radius: 2px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            line-height: 41px;
            text-align: center;
        }

        .btn-cancel:hover {
            background-color: #00b14f;
            color: #fff;
            border-color: #00b14f;
        }

        .btn-back {
            background-color: #fff;
            color: #00b14f;
            border: 2px solid #00b14f;
            font-weight: 600;
            height: 45px;
            font-size: 15px;
            width: 100%;
            margin: 8px auto;
            display: block;
            border-radius: 2px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            line-height: 41px;
            text-align: center;
        }

        .btn-back:hover {
            background-color: #00b14f;
            color: #fff;
            border-color: #00b14f;
        }

        .btn-resend {
            background-color: #00b14f;
            color: #fff;
            font-weight: 600;
            height: 45px;
            border: none;
            font-size: 15px;
            width: 100%;
            margin: 8px auto;
            display: block;
            border-radius: 2px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            line-height: 45px;
            text-align: center;
        }

        .btn-resend:hover {
            background-color: #009944;
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
            margin-bottom: 16px;
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

        .resend-info {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 12px;
            border-radius: 4px;
            margin: 15px 0;
            font-size: 14px;
            text-align: left;
        }

        .invalid-feedback {
            display: none;
            width: 100%;
            margin-top: 0.25rem;
            font-size: 0.875em;
            color: #dc3545;
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

        .alert-container {
            max-width: 400px;
            margin: 0 auto 20px;
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
             <a href="{{ url('/login-kampus') }}" class="btn-login">Masuk</a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="vertical-center-wrapper">
            <!-- Judul di luar card -->
            <p class="sub-title">Lupa Kata Sandi Anda?</p>

            <!-- Alert Message Container -->
            <div class="alert-container">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>

            <div class="forgot-container">
                <!-- Form Section (Default View) -->
                <div id="formSection">
                    <form id="forgotPasswordForm" method="POST" action="{{ route('campus.password.email') }}">
                        @csrf

                        <div class="mb-4">
                            <input type="email"
                                   class="form-control"
                                   id="email"
                                   name="email"
                                   placeholder="Masukkan alamat email anda"
                                   value="{{ old('email') }}"
                                   required>
                            <div class="invalid-feedback" id="emailError"></div>
                            <div class="form-text mt-2">
                                Masukkan email anda diatas untuk mendapatkan instruksi reset kata sandi
                            </div>
                        </div>

                        <button type="submit" class="btn-submit" id="submitBtn">
                            <span id="submitText">KIRIM INSTRUKSI RESET</span>
                            <span id="submitLoading" class="loading" style="display: none;"></span>
                        </button>

                        <!-- TOMBOL BATALKAN -->
                        <a href="{{ route('campus.login') }}" class="btn-cancel" id="cancelBtn">
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
                        <div class="success-box-email" id="sentEmailAddress">contoh@email.com</div>
                        <div class="success-box-message">
                            Klik tautan di email tersebut untuk mereset kata sandi Anda.
                        </div>
                    </div>

                    <!-- Info tambahan untuk kirim ulang -->
                    <div class="resend-info" id="resendInfo">
                        <i class="fas fa-info-circle"></i> Tidak menerima email?
                        <br>Anda dapat mengirim ulang instruksi reset kata sandi.
                    </div>

                    <!-- TOMBOL KIRIM ULANG (SAMA SEPERTI BAGIAN PERUSAHAAN) -->
                    <!-- PERUBAHAN: Ubah tipe tombol menjadi tombol biasa untuk kembali ke form -->
                    <button type="button" class="btn-resend" id="resendBtn">
                        <span id="resendText">KIRIM ULANG</span>
                        <span id="resendLoading" class="loading" style="display: none;"></span>
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
            const resendBtn = document.getElementById('resendBtn');
            const resendText = document.getElementById('resendText');
            const resendLoading = document.getElementById('resendLoading');
            const formSection = document.getElementById('formSection');
            const successSection = document.getElementById('successSection');
            const sentEmailAddress = document.getElementById('sentEmailAddress');
            const resendInfo = document.getElementById('resendInfo');

            let currentEmail = '';

            // PERUBAHAN: HAPUS LOGIKA localStorage
            // Hapus semua data reset password dari localStorage setiap kali halaman dimuat
            localStorage.removeItem('campus_last_reset_email');
            localStorage.removeItem('campus_reset_time');
            localStorage.removeItem('campus_password_was_reset');

            // Email validation function
            function validateEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }

            // Reset error styling
            function resetError() {
                emailInput.classList.remove('is-invalid');
                emailError.style.display = 'none';
                emailError.textContent = '';
            }

            // Add input validation styling
            emailInput.addEventListener('input', function() {
                resetError();

                if (this.value.trim() === '') {
                    this.classList.remove('is-valid', 'is-invalid');
                } else if (validateEmail(this.value.trim())) {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                } else {
                    this.classList.remove('is-valid');
                }
            });

            // Function untuk mengirim reset password request
            async function sendResetRequest(email) {
                try {
                    // Kirim request AJAX ke server
                    const response = await fetch('{{ route("campus.password.email") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            email: email
                        })
                    });

                    return await response.json();
                } catch (error) {
                    console.error('Error:', error);
                    return {
                        success: false,
                        message: 'Terjadi kesalahan jaringan. Silakan coba lagi.'
                    };
                }
            }

            // Function untuk menampilkan loading state pada tombol
            function showLoading(button, textElement, loadingElement) {
                button.disabled = true;
                textElement.style.display = 'none';
                loadingElement.style.display = 'inline-block';
            }

            // Function untuk menghilangkan loading state pada tombol
            function hideLoading(button, textElement, loadingElement) {
                button.disabled = false;
                textElement.style.display = 'inline';
                loadingElement.style.display = 'none';
            }

            // Function untuk menampilkan success state
            function showSuccessState(email) {
                formSection.style.display = 'none';
                successSection.classList.add('active');
                sentEmailAddress.textContent = email;
                currentEmail = email;

                // Scroll ke atas untuk melihat pesan sukses
                window.scrollTo({ top: 0, behavior: 'smooth' });
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
                        emailInput.classList.add('is-valid');
                    }
                } else {
                    emailInput.value = '';
                }

                emailInput.classList.remove('is-invalid');
                resetError();

                // Focus email input
                setTimeout(() => {
                    emailInput.focus();
                    // Pilih teks yang sudah ada untuk kemudahan edit
                    if (emailInput.value) {
                        emailInput.select();
                    }
                }, 100);
            }

            // Form submission handling dengan AJAX
            form.addEventListener('submit', async function(e) {
                e.preventDefault();

                resetError();

                const emailValue = emailInput.value.trim();

                // Validasi email kosong
                if (!emailValue) {
                    emailInput.classList.add('is-invalid');
                    emailError.textContent = 'Email harus diisi.';
                    emailError.style.display = 'block';
                    emailInput.focus();
                    return;
                }

                // Validasi format email
                if (!validateEmail(emailValue)) {
                    emailInput.classList.add('is-invalid');
                    emailError.textContent = 'Format email tidak valid.';
                    emailError.style.display = 'block';
                    emailInput.focus();
                    return;
                }

                // Tampilkan loading state
                showLoading(submitBtn, submitText, submitLoading);

                const data = await sendResetRequest(emailValue);

                // Reset button state
                hideLoading(submitBtn, submitText, submitLoading);

                if (data.success) {
                    // Tampilkan success state
                    showSuccessState(emailValue);

                    // PERUBAHAN: Simpan email untuk digunakan kembali
                    currentEmail = emailValue;

                    // PERUBAHAN: Hapus localStorage untuk mencegah tampilan success saat reload
                    localStorage.removeItem('campus_last_reset_email');
                    localStorage.removeItem('campus_reset_time');
                    localStorage.removeItem('campus_password_was_reset');
                } else {
                    // Tampilkan error
                    emailInput.classList.add('is-invalid');
                    emailError.textContent = data.message || 'Terjadi kesalahan. Silakan coba lagi.';
                    emailError.style.display = 'block';
                    emailInput.focus();
                }
            });

            // PERUBAHAN: Handle tombol Kirim Ulang - KEMBALI KE FORM
            resendBtn.addEventListener('click', async function(e) {
                e.preventDefault();

                // Langsung tampilkan form state tanpa loading atau pengiriman email
                showFormState();

                // PERUBAHAN: Update info text untuk memberi tahu user
                resendInfo.innerHTML = '<i class="fas fa-info-circle"></i> Masukkan email Anda untuk mengirim ulang instruksi reset kata sandi.';
                resendInfo.style.backgroundColor = '#fff3cd';
                resendInfo.style.borderColor = '#ffeaa7';
                resendInfo.style.color = '#856404';
            });

            // PERUBAHAN: Handle link teks "Kirim ulang" di dalam resend-info
            resendInfo.addEventListener('click', function(e) {
                if (e.target && e.target.tagName === 'A') {
                    e.preventDefault();
                    showFormState();
                }
            });

            // Focus email input on page load
            setTimeout(() => {
                emailInput.focus();
            }, 100);
        });
    </script>

</body>
</html>
