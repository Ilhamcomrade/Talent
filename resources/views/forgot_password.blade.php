<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi | Next Jobz</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #f8f9fa;
            height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
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
        }

        /* Form control disesuaikan dengan halaman login */
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

        .form-control::placeholder {
            color: #6c757d;
        }

        /* Tombol SUBMIT - TANPA HOVER, TANPA ANIMASI, TANPA TRANSITION */
        .btn-submit {
            background-color: #e60000;
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
        }

        .btn-submit:disabled {
            background-color: #ff6666;
            cursor: not-allowed;
        }

        /* Tombol KEMBALI - DENGAN EFEK HOVER KHUSUS */
        .btn-back {
            background-color: transparent;
            color: #e60000;
            border: 1px solid #e60000;
            font-weight: 600;
            height: 45px;
            font-size: 15px;
            width: 100%;
            margin: 8px auto;
            display: block;
            border-radius: 2px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        /* EFEK HOVER UNTUK TOMBOL KEMBALI SAJA */
        .btn-back:hover {
            background-color: #e60000;
            color: #fff;
            border-color: #e60000;
        }

        /* Tombol KIRIM ULANG (ditambahkan untuk bagian publik) */
        .btn-resend {
            background-color: #e60000;
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
        }

        .btn-resend:disabled {
            background-color: #ff6666;
            cursor: not-allowed;
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

        /* Error message khusus untuk email */
        .email-error {
            font-size: 13px;
            color: #e60000;
            margin-top: 4px;
            display: none;
        }

        /* Loading spinner untuk proses submit */
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

        /* Style untuk success confirmation box */
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
            margin-bottom: 16px; /* Ditambahkan untuk memberi jarak dengan tombol */
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
        }

        .success-box-message {
            color: #155724;
            font-size: 14px;
            line-height: 1.5;
            text-align: left;
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

        /* Untuk memastikan konten benar-benar di tengah vertikal */
        .vertical-center-wrapper {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 140px); /* Mengurangi tinggi navbar dan footer */
        }
    </style>
</head>

<body style="background-color: #f8f9fa;">

    @include('partials.navbar')

    <div class="main-content">
        <div class="vertical-center-wrapper">
            <!-- Judul di luar card -->
            <p class="sub-title">Lupa kata sandi?</p>

            <div class="forgot-container bg-white rounded shadow-sm">
                <!-- Pesan sukses dari session -->
                @if(session('status'))
                    <div class="status-message success" id="sessionSuccessMessage">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Form Section (Default View) -->
                <div id="formSection">
                    <form id="forgotPasswordForm">
                        @csrf
                        <div class="mb-3">
                            <input type="email"
                                   class="form-control"
                                   id="email"
                                   name="email"
                                   placeholder="Alamat Email"
                                   value="{{ old('email') }}"
                                   required>
                            <div class="form-text">
                                Masukkan alamat emailmu dan kami akan mengirimkan tautan untuk mereset kata sandi.
                            </div>
                            <!-- Error message khusus untuk email -->
                            <div id="emailError" class="email-error"></div>
                        </div>

                        <button type="submit" class="btn-submit" id="submitBtn">
                            <span id="submitText">SUBMIT</span>
                            <span id="submitLoading" class="loading" style="display: none;"></span>
                        </button>

                        <button type="button" class="btn-back" id="backBtn">
                            KEMBALI
                        </button>
                    </form>
                </div>

                <!-- Success Confirmation Section (Hidden by default) -->
                <div id="successSection" class="success-confirmation">
                    <div class="success-box">
                        <div class="success-box-title">
                            Email reset kata sandi telah dikirim ke
                        </div>
                        <div class="success-box-email" id="sentEmailAddress"></div>
                        <div class="success-box-message">
                            Klik tautan di email tersebut untuk mereset kata sandi Anda.
                        </div>
                    </div>

                    <!-- TOMBOL KIRIM ULANG (DITAMBAHKAN) -->
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
            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');
            const submitLoading = document.getElementById('submitLoading');
            const backBtn = document.getElementById('backBtn');
            const resendBtn = document.getElementById('resendBtn');
            const resendText = document.getElementById('resendText');
            const resendLoading = document.getElementById('resendLoading');
            const emailError = document.getElementById('emailError');
            const formSection = document.getElementById('formSection');
            const successSection = document.getElementById('successSection');
            const sentEmailAddress = document.getElementById('sentEmailAddress');

            let currentEmail = '';

            // Hapus localStorage untuk reset password publik
            localStorage.removeItem('public_last_submitted_email');
            localStorage.removeItem('public_reset_timestamp');

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
                sentEmailAddress.textContent = email;
                currentEmail = email;

                // Simpan ke localStorage
                localStorage.setItem('public_last_submitted_email', email);
            }

            // Function untuk menampilkan form state
            function showFormState() {
                successSection.classList.remove('active');
                formSection.style.display = 'block';

                // Isi email input dengan email sebelumnya
                if (currentEmail) {
                    emailInput.value = currentEmail;
                    // Tambahkan validasi visual jika email valid
                    if (validateEmail(currentEmail)) {
                        emailInput.style.borderColor = '#198754';
                    }
                } else {
                    emailInput.value = '';
                    emailInput.style.borderColor = '#999';
                }

                hideError();

                // Focus email input
                setTimeout(() => {
                    emailInput.focus();
                    // Pilih teks yang sudah ada untuk kemudahan edit
                    if (emailInput.value) {
                        emailInput.select();
                    }
                }, 100);
            }

            // Handle form submission dengan AJAX
            form.addEventListener('submit', async function(e) {
                e.preventDefault();

                const email = emailInput.value.trim();

                // Reset error display
                hideError();

                if (!validateEmail(email)) {
                    showError('Masukkan alamat email yang valid.');
                    emailInput.focus();
                    return;
                }

                // Show loading state
                submitBtn.disabled = true;
                submitText.style.display = 'none';
                submitLoading.style.display = 'inline-block';

                try {
                    const formData = new FormData();
                    formData.append('email', email);
                    formData.append('_token', document.querySelector('input[name="_token"]').value);

                    const response = await fetch("{{ route('password.email') }}", {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: formData
                    });

                    const data = await response.json();

                    if (response.ok && data.success) {
                        // Tampilkan success state
                        showSuccessState(email);
                    } else {
                        // Tampilkan error khusus untuk email jika ada
                        if (data.errors && data.errors.email) {
                            showError(data.errors.email);
                        } else {
                            showError(data.message || 'Terjadi kesalahan. Silakan coba lagi nanti.');
                        }
                    }
                } catch (error) {
                    console.error('Error:', error);
                    showError('Terjadi kesalahan jaringan. Silakan coba lagi nanti.');
                } finally {
                    // Reset loading state
                    submitBtn.disabled = false;
                    submitText.style.display = 'inline';
                    submitLoading.style.display = 'none';
                }
            });

            // Handle tombol KIRIM ULANG - KEMBALI KE FORM
            resendBtn.addEventListener('click', function() {
                // Langsung tampilkan form state tanpa loading atau pengiriman email
                showFormState();
            });

            // Handle back button dari form
            backBtn.addEventListener('click', function() {
                window.location.href = "{{ url('/masuk') }}";
            });

            // Enter key untuk submit
            emailInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    form.dispatchEvent(new Event('submit'));
                }
            });

            // Email validation function
            function validateEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }

            // Show error message under email input
            function showError(message) {
                emailError.textContent = message;
                emailError.style.display = 'block';
                emailInput.style.borderColor = '#e60000';
                emailInput.focus();
            }

            // Hide error message
            function hideError() {
                emailError.textContent = '';
                emailError.style.display = 'none';
                emailInput.style.borderColor = '#999';
            }

            // Add input validation styling
            emailInput.addEventListener('input', function() {
                hideError();
                if (this.value.trim() === '') {
                    this.style.borderColor = '#999';
                } else if (validateEmail(this.value.trim())) {
                    this.style.borderColor = '#198754';
                } else {
                    this.style.borderColor = '#e60000';
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
