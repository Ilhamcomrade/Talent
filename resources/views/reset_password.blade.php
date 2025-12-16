<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Kata Sandi | Next Jobz</title>

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

        .reset-title {
            font-size: 28px;
            font-weight: 700;
            line-height: 1.2;
            color: #2c2c2c;
            text-align: center;
            margin-bottom: 30px;
        }

        .reset-container {
            max-width: 400px;
            padding: 32px;
            margin: 0 auto;
            width: 100%;
        }

        /* Form control disesuaikan */
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

        /* Label styling */
        .form-label {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            display: block;
        }

        /* Deskripsi/help text */
        .form-help {
            font-size: 13px;
            color: #666;
            margin-top: 8px;
            line-height: 1.4;
            text-align: left;
            margin-bottom: 20px;
        }

        /* Password container dengan toggle */
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
            font-size: 18px;
        }

        /* Divider garis */
        .divider {
            height: 1px;
            background-color: #e1e4e8;
            margin: 20px 0;
            width: 100%;
        }

        /* Tombol KIRIM */
        .btn-submit {
            background-color: #e60000;
            color: #fff;
            font-weight: 600;
            height: 45px;
            border: none;
            font-size: 15px;
            width: 100%;
            margin: 10px auto;
            display: block;
            border-radius: 2px;
            cursor: pointer;
        }

        .btn-submit:disabled {
            background-color: #ff6666;
            cursor: not-allowed;
        }

        /* Tombol MASUK (untuk success state) */
        .btn-login {
            background-color: #e60000;
            color: #fff;
            font-weight: 600;
            height: 45px;
            border: none;
            font-size: 15px;
            width: 100%;
            margin: 10px auto;
            display: block;
            border-radius: 2px;
            cursor: pointer;
            text-decoration: none;
            line-height: 45px;
            text-align: center;
        }

        .btn-login:hover {
            background-color: #e60000;
            color: #fff;
        }

        /* Status message */
        .status-message {
            padding: 12px 16px;
            border-radius: 4px;
            margin-bottom: 20px;
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

        /* Success box styling */
        .success-box {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .success-box-title {
            font-size: 16px;
            font-weight: 600;
            color: #155724;
            margin-bottom: 8px;
            text-align: left;
        }

        .success-box-message {
            font-size: 14px;
            color: #155724;
            margin: 0;
            text-align: left;
            line-height: 1.5;
        }

        /* Loading spinner */
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

        /* Asterisk merah */
        .required {
            color: #e60000;
            margin-right: 4px;
        }

        /* Hide/Show classes */
        .d-none {
            display: none !important;
        }

        .d-block {
            display: block !important;
        }

        @media (max-width: 576px) {
            .reset-container {
                padding: 24px;
            }

            .reset-title {
                font-size: 24px;
                margin-bottom: 20px;
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
            min-height: calc(100vh - 140px);
        }
    </style>
</head>

<body style="background-color: #f8f9fa;">

    @include('partials.navbar')

    <div class="main-content">
        <div class="vertical-center-wrapper">
            <!-- Judul di luar card -->
            <h1 class="reset-title">Reset kata sandimu</h1>

            <div class="reset-container bg-white rounded shadow-sm">
                @if(session('status'))
                    <div class="status-message success">
                        {{ session('status') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="status-message error">
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <!-- Pesan dinamis untuk AJAX -->
                <div id="ajaxMessage" class="status-message" style="display: none;"></div>

                <!-- Success State (Hidden by default) -->
                <div id="successState" class="d-none">
                    <div class="success-box">
                        <div class="success-box-title">Kata sandi telah berhasil direset</div>
                        <p class="success-box-message">Silakan gunakan kata sandi baru untuk masuk.</p>
                    </div>
                    <a href="{{ route('login') }}" class="btn-login">MASUK</a>
                </div>

                <!-- Form State (Visible by default) -->
                <form id="resetPasswordForm">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">

                    <!-- New Password Field -->
                    <div class="mb-4">
                        <label for="new_password" class="form-label">
                        </label>
                        <div class="password-container">
                            <input type="password"
                                   class="form-control"
                                   id="password"
                                   name="password"
                                   placeholder="Masukkan kata sandi baru"
                                   required minlength="8">
                            <i class="fa-regular fa-eye password-toggle" id="toggleNewPassword"></i>
                        </div>
                        <div class="form-help">
                            Pilih kata sandi baru (minimal 8 karakter).
                        </div>
                        <div id="passwordError" class="text-danger mt-1" style="display: none; font-size: 13px;"></div>
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="mb-4">
                        <label for="confirm_password" class="form-label">
                        </label>
                        <div class="password-container">
                            <input type="password"
                                   class="form-control"
                                   id="password_confirmation"
                                   name="password_confirmation"
                                   placeholder="Konfirmasi kata sandi baru"
                                   required minlength="8">
                            <i class="fa-regular fa-eye password-toggle" id="toggleConfirmPassword"></i>
                        </div>
                        <div class="form-help">
                            Ketik ulang kata sandi barumu untuk memastikannya benar.
                        </div>
                        <div id="confirmPasswordError" class="text-danger mt-1" style="display: none; font-size: 13px;"></div>
                    </div>

                    <!-- Divider -->
                    <div class="divider"></div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-submit" id="submitBtn">
                        <span id="submitText">KIRIM</span>
                        <span id="submitLoading" class="loading" style="display: none;"></span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('resetPasswordForm');
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation');
            const toggleNewPassword = document.getElementById('toggleNewPassword');
            const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');
            const submitLoading = document.getElementById('submitLoading');
            const ajaxMessage = document.getElementById('ajaxMessage');
            const passwordError = document.getElementById('passwordError');
            const confirmPasswordError = document.getElementById('confirmPasswordError');
            const successState = document.getElementById('successState');

            // Toggle password visibility for new password
            toggleNewPassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });

            // Toggle password visibility for confirm password
            toggleConfirmPassword.addEventListener('click', function() {
                const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmPasswordInput.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });

            // Real-time validation untuk password confirmation (hanya styling, tidak tampilkan pesan error)
            confirmPasswordInput.addEventListener('input', function() {
                const password = passwordInput.value;
                const confirmPassword = this.value;

                // Reset error display
                hideConfirmPasswordError();
                hideMessage();

                if (confirmPassword && password !== confirmPassword) {
                    this.style.borderColor = '#e60000';
                } else if (confirmPassword && password === confirmPassword) {
                    this.style.borderColor = '#198754';
                } else {
                    this.style.borderColor = '#999';
                }
            });

            // Handle form submission dengan AJAX
            form.addEventListener('submit', async function(e) {
                e.preventDefault();

                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;

                // Reset semua error
                hideAllErrors();
                hideMessage();

                // Validation
                let hasError = false;

                if (!password) {
                    showPasswordError('Masukkan kata sandi baru.');
                    passwordInput.focus();
                    hasError = true;
                } else if (password.length < 8) {
                    showPasswordError('Kata sandi minimal 8 karakter.');
                    passwordInput.focus();
                    hasError = true;
                }

                if (!confirmPassword) {
                    showConfirmPasswordError('Konfirmasi kata sandi baru.');
                    if (!hasError) confirmPasswordInput.focus();
                    hasError = true;
                } else if (password !== confirmPassword) {
                    showConfirmPasswordError('Kata sandi tidak cocok. Silakan periksa kembali.');
                    if (!hasError) confirmPasswordInput.focus();
                    hasError = true;
                }

                if (hasError) {
                    return;
                }

                // Show loading state
                submitBtn.disabled = true;
                submitText.style.display = 'none';
                submitLoading.style.display = 'inline-block';

                try {
                    const formData = new FormData(form);

                    const response = await fetch("{{ route('password.update') }}", {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: formData
                    });

                    const data = await response.json();

                    if (response.ok && data.success) {
                        // Sembunyikan form dan tampilkan success state
                        form.classList.add('d-none');
                        successState.classList.remove('d-none');

                        // Scroll ke atas untuk memastikan pesan terlihat
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    } else {
                        let errorMessage = data.message || 'Terjadi kesalahan. Silakan coba lagi nanti.';
                        showMessage(errorMessage, 'error');

                        // Tampilkan error spesifik jika ada
                        if (data.errors) {
                            if (data.errors.password) {
                                showPasswordError(data.errors.password[0]);
                            }
                            if (data.errors.password_confirmation) {
                                showConfirmPasswordError(data.errors.password_confirmation[0]);
                            }
                            if (data.errors.token) {
                                showMessage(data.errors.token, 'error');
                            }
                            if (data.errors.email) {
                                showMessage(data.errors.email, 'error');
                            }
                        }
                    }
                } catch (error) {
                    console.error('Error:', error);
                    showMessage('Terjadi kesalahan jaringan. Silakan coba lagi nanti.', 'error');
                } finally {
                    // Reset loading state
                    submitBtn.disabled = false;
                    submitText.style.display = 'inline';
                    submitLoading.style.display = 'none';
                }
            });

            // Show status message
            function showMessage(message, type) {
                ajaxMessage.textContent = message;
                ajaxMessage.className = `status-message ${type}`;
                ajaxMessage.style.display = 'block';
            }

            // Hide message
            function hideMessage() {
                ajaxMessage.style.display = 'none';
            }

            // Show password error
            function showPasswordError(message) {
                passwordError.textContent = message;
                passwordError.style.display = 'block';
                passwordInput.style.borderColor = '#e60000';
            }

            // Show confirm password error
            function showConfirmPasswordError(message) {
                confirmPasswordError.textContent = message;
                confirmPasswordError.style.display = 'block';
                confirmPasswordInput.style.borderColor = '#e60000';
            }

            // Hide all errors
            function hideAllErrors() {
                passwordError.style.display = 'none';
                confirmPasswordError.style.display = 'none';
                passwordInput.style.borderColor = '#999';
                confirmPasswordInput.style.borderColor = '#999';
            }

            // Hide password error
            function hidePasswordError() {
                passwordError.style.display = 'none';
                passwordInput.style.borderColor = '#999';
            }

            // Hide confirm password error
            function hideConfirmPasswordError() {
                confirmPasswordError.style.display = 'none';
                confirmPasswordInput.style.borderColor = '#999';
            }

            // Focus password input on page load
            setTimeout(() => {
                passwordInput.focus();
            }, 100);
        });
    </script>

</body>
</html>
