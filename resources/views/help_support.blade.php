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

        .page-content-wrapper {
            flex-grow: 1;
            background-color: #fff;
        }

        .setting-card {
            border-radius: 0;
            box-shadow: none;
            border: 1px solid #cfcbcbff;
            margin-bottom: 20px;
            background-color: #fff;
            padding: 0 20px 20px 20px;
        }

        .setting-card-header {
            background-color: #F2F2F2;
            padding: 15px 20px;
            margin: 0 -20px 20px -20px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .setting-card-header h5 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2c2c2c;
            margin: 0;
            padding: 0;
            border-bottom: none;
        }
        
        .help-support-text {
            font-size: 1rem;
            color: #495057;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        /* PERUBAHAN: Tombol Dapatkan Bantuan dengan warna biru dan tanpa efek hover */
        .btn-glints-primary {
            background-color: #0d47a1;
            color: #fff;
            border: 1px solid #0d47a1;
            font-weight: 600;
            padding: 8px 20px;
            border-radius: 4px;
            text-transform: uppercase;
            transition: none;
            font-size: 0.9rem;
            display: inline-block;
            text-decoration: none;
            cursor: pointer;
        }

        /* PERUBAHAN: Menghapus efek hover secara permanen */
        .btn-glints-primary:hover,
        .btn-glints-primary:active,
        .btn-glints-primary:focus {
            background-color: #0d47a1;
            color: #fff;
            border-color: #0d47a1;
        }

        .account-management-toggle {
            background-color: #F2F2F2;
            border: none;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding: 15px 20px;
            cursor: pointer;
            font-size: 1.1rem;
            font-weight: 600;
            color: #2c2c2c;
            border-radius: 0;
            transition: none;
        }
        
        .account-management-toggle:hover {
            background-color: #F2F2F2;
        }
        
        .account-management-toggle:focus {
            box-shadow: none;
        }
        
        .custom-collapse-icon {
            transition: transform 0.3s ease;
        }

        .account-management-toggle.collapsed .custom-collapse-icon {
            transform: rotate(0deg);
        }

        .account-management-toggle:not(.collapsed) .custom-collapse-icon {
            transform: rotate(-180deg);
        }
        
        .accordion-item {
            border: 1px solid #cfcbcbff;
            border-radius: 0 !important;
        }
        .accordion-item:not(:last-child) {
            border-bottom: 0;
        }
        .accordion-body {
            padding: 20px;
            border-top: 1px solid #e0e0e0;
        }

        .account-delete-text {
            font-size: 1rem;
            color: #495057;
            line-height: 1.5;
            margin-bottom: 0;
        }

        .modal-content {
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        
        .modal-header {
            border-bottom: 1px solid #e9ecef;
            padding: 20px 24px 20px 24px;
        }
        .modal-body {
            padding: 24px;
        }
        
        .modal-footer {
            border-top: 1px solid #e9ecef;
            padding: 16px 24px;
            justify-content: flex-end;
        }
        
        .btn-glints-danger {
            background-color: #d32f2f;
            color: white;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 4px;
            border: 1px solid #d32f2f;
            transition: background-color 0.3s;
        }
        .btn-glints-danger:hover {
            background-color: #c62828;
            color: white;
        }
        .btn-glints-secondary {
            background-color: transparent;
            color: #6c757d;
            border: none;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 4px;
        }

        .btn-glints-disabled {
            background-color: #e9ecef !important;
            color: #adb5bd !important;
            border-color: #e9ecef !important;
            opacity: 1 !important;
        }
        
        .btn-glints-border-secondary {
            background-color: #fff;
            color: #6c757d;
            border: 1px solid #cfcbcbff;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 4px;
            transition: none;
        }
        .btn-glints-border-secondary:hover {
            background-color: #fff;
            color: #6c757d;
            border-color: #cfcbcbff;
            box-shadow: none;
        }

        .modal-footer .btn-primary {
            padding: 10px 20px;
            font-weight: 600;
            border-radius: 4px;
        }
        
        #confirmDeleteFinalBtn:not(:disabled) {
            background-color: #0d47a1;
            color: white;
            border-color: #0d47a1;
            transition: background-color 0.3s;
        }
        
        #confirmDeleteFinalBtn:not(:disabled):hover {
            background-color: #0c3e8e;
            color: white;
            border-color: #0c3e8e;
        }
        
        #confirmDeleteFinalBtn[disabled] {
            background-color: #e9ecef !important;
            color: #adb5bd !important;
            border-color: #e9ecef !important;
            opacity: 1 !important;
        }

        .form-check-label {
            font-size: 1rem;
            color: #2c2c2c;
            cursor: pointer;
        }
        .form-check-input:checked {
            background-color: #0d47a1;
            border-color: #0d47a1;
        }
    </style>
</head>

<body>

    @include('partials.navbar')

    <div class="page-content-wrapper">
        <div class="account-setting-container">
            <div class="container">
                
                <div class="row pt-8 pb-5">
                    
                    @include('partials.setting_account')
                
                    <div class="col-lg-8 col-md-7 mx-auto">

                        <div class="setting-card">
                            <div class="setting-card-header">
                                <h5>Bantuan & Dukungan</h5>
                            </div>

                            <p class="help-support-text">
                                Untuk bantuan mengenai akun Talenthub kamu, hubungi kami melalui tombol di bawah ini.
                            </p>

                            <a href="#" class="btn-glints-primary text-uppercase">
                                DAPATKAN BANTUAN
                            </a>
                        </div>

                        <div class="accordion" id="accordionKelolaAkun">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingKelolaAkun">
                                    <button class="account-management-toggle collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseKelolaAkun" aria-expanded="false"
                                        aria-controls="collapseKelolaAkun">
                                        Kelola Akun
                                        <i class="fas fa-chevron-down custom-collapse-icon"></i>
                                    </button>
                                </h2>
                                <div id="collapseKelolaAkun" class="accordion-collapse collapse"
                                    aria-labelledby="headingKelolaAkun" data-bs-parent="#accordionKelolaAkun">
                                    <div class="accordion-body">
                                        <p class="account-delete-text">
                                            Jika kamu ingin menghapus akun Talenthub kamu secara permanen, silakan 
                                            <a href="#" class="text-decoration-none" style="color: #0d47a1; font-weight: 600;"
                                                data-bs-toggle="modal" data-bs-target="#deleteAccountModalStep1">klik di sini</a> 
                                            untuk menghapus.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteAccountModalStep1" tabindex="-1" aria-labelledby="deleteAccountModalStep1Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAccountModalStep1Label">Hapus akun ini</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <p>Harap diperhatikan bahwa akun yang dihapus bersifat permanen dan tidak dapat dikembalikan. Seluruh aktivitas, seperti lamaran kerja, akan hilang.</p>
                    <p class="mt-4 fw-bold">Ketik "DELETE" untuk mengonfirmasi</p>
                    <input type="text" class="form-control" id="confirmDeleteInput" placeholder="DELETE" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-glints-disabled" id="nextStep1Btn" disabled
                        data-bs-target="#deleteAccountModalStep2" data-bs-toggle="modal" data-bs-dismiss="modal">Selanjutnya</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteAccountModalStep2" tabindex="-1" aria-labelledby="deleteAccountModalStep2Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAccountModalStep2Label">Hapus akun ini</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <p>Talenthub turut menyesal melihat kamu pergi. Sebelum kamu pergi, kami ingin mengetahui alasan kamu menghapus akun Talenthub agar kami dapat memberikan bantuan yang sesuai.</p>
                    <p class="mt-4 fw-bold">Pilih alasan<span class="text-danger">*</span></p>

                    <div id="reasonOptions">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="deleteReason" id="reason1" value="Terlalu banyak waktu">
                            <label class="form-check-label" for="reason1">
                                Menghabiskan terlalu banyak waktu di Talenthub
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="deleteReason" id="reason2" value="Masalah privasi">
                            <label class="form-check-label" for="reason2">
                                Masalah privasi saat menggunakan Talenthub
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="deleteReason" id="reason3" value="Tidak lagi membantu" checked>
                            <label class="form-check-label" for="reason3">
                                Tidak lagi menemukan Talenthub membantu
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="deleteReason" id="reason4" value="Akun diretas">
                            <label class="form-check-label" for="reason4">
                                Akun diretas (hacked)
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="deleteReason" id="reason5" value="Sudah mendapat pekerjaan">
                            <label class="form-check-label" for="reason5">
                                Sudah mendapatkan pekerjaan
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="deleteReason" id="reason6" value="Akun duplikat">
                            <label class="form-check-label" for="reason6">
                                Akun duplikat
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-glints-border-secondary"
                        data-bs-target="#deleteAccountModalStep1" data-bs-toggle="modal" data-bs-dismiss="modal">Kembali</button>
                    <button type="button" class="btn btn-primary" id="nextStep2Btn" 
                        data-bs-target="#deleteAccountModalStep3" data-bs-toggle="modal" data-bs-dismiss="modal">Selanjutnya</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteAccountModalStep3" tabindex="-1" aria-labelledby="deleteAccountModalStep3Label" aria-hidden="true"
        data-has-errors="{{ $errors->any() ? 'true' : 'false' }}"
        data-current-route="{{ Route::currentRouteName() }}"
        data-delete-route="{{ 'account.delete.process' }}"
        data-old-reason="{{ old('delete_reason') }}"
        data-old-explanation="{{ old('reason_explanation') }}">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="deleteAccountForm" action="{{ route('account.delete.process') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteAccountModalStep3Label">Hapus akun ini</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <p>Talenthub turut menyesal melihat kamu pergi. Sebelum kamu pergi, kami ingin mengetahui alasan kamu menghapus akun Talenthub agar kami dapat memberikan bantuan yang sesuai.</p>
                        <p class="mt-4 fw-bold">Jelaskan alasanmu<span class="text-danger">*</span></p>
                        <textarea class="form-control" id="reasonExplanationInput" name="reason_explanation" rows="3" placeholder="Jelaskan alasanmu" required></textarea>

                        <input type="hidden" name="confirmation_word" id="hiddenConfirmationWord" value="">
                        <input type="hidden" name="delete_reason" id="hiddenDeleteReason" value="">
                        
                        @if ($errors->has('reason_explanation'))
                            <div class="text-danger mt-2 small">{{ $errors->first('reason_explanation') }}</div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-glints-border-secondary"
                            data-bs-target="#deleteAccountModalStep2" data-bs-toggle="modal" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-danger btn-glints-danger" id="confirmDeleteFinalBtn" disabled>Konfirmasi Penghapusan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        try {
            const userDropdownContainer = document.getElementById('userDropdownContainer');
            
            if (userDropdownContainer) {
                const chevronIcon = userDropdownContainer.querySelector('.chevron-icon');
                if (chevronIcon) {
                    userDropdownContainer.addEventListener('show.bs.dropdown', () => chevronIcon.classList.add('open'));
                    userDropdownContainer.addEventListener('hide.bs.dropdown', () => chevronIcon.classList.remove('open'));
                }
            }
        } catch (e) {
            console.warn("Kemungkinan 'userDropdownContainer' sudah dideklarasikan di partials.navbar atau file lain. Mengabaikan blok ini untuk mencegah Uncaught SyntaxError.");
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            const togglePasswordIcons = document.querySelectorAll('.toggle-password');

            togglePasswordIcons.forEach(icon => {
                icon.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-target');
                    const passwordInput = document.getElementById(targetId);

                    const isPasswordVisible = passwordInput.getAttribute('type') === 'password';
                    const newType = isPasswordVisible ? 'text' : 'password';
                    passwordInput.setAttribute('type', newType);

                    if (newType === 'text') {
                        this.classList.remove('fa-eye-slash');
                        this.classList.add('fa-eye');
                    } else {
                        this.classList.remove('fa-eye');
                        this.classList.add('fa-eye-slash');
                    }
                });
            });

            const confirmDeleteInput = document.getElementById('confirmDeleteInput');
            const nextStep1Btn = document.getElementById('nextStep1Btn');
            const hiddenConfirmationWord = document.getElementById('hiddenConfirmationWord');

            const reasonOptions = document.getElementById('reasonOptions');
            const hiddenDeleteReason = document.getElementById('hiddenDeleteReason');
            const radioButtons = document.querySelectorAll('input[name="deleteReason"]');
            
            const reasonExplanationInput = document.getElementById('reasonExplanationInput');
            const confirmDeleteFinalBtn = document.getElementById('confirmDeleteFinalBtn');
            const deleteAccountModalStep3 = document.getElementById('deleteAccountModalStep3');

            function updateHiddenReason() {
                let selectedValue = null;
                for (const radio of radioButtons) {
                    if (radio.checked) {
                        selectedValue = radio.value;
                        break;
                    }
                }
                hiddenDeleteReason.value = selectedValue || '';
            }

            function checkExplanationInput() {
                if (reasonExplanationInput.value.trim().length >= 1) { 
                    confirmDeleteFinalBtn.disabled = false;
                    confirmDeleteFinalBtn.classList.remove('btn-glints-disabled');
                } else {
                    confirmDeleteFinalBtn.disabled = true;
                    confirmDeleteFinalBtn.classList.add('btn-glints-disabled');
                }
            }
            
            function checkDeleteConfirmationInput() {
                if (confirmDeleteInput.value === 'DELETE') {
                    nextStep1Btn.disabled = false;
                    nextStep1Btn.classList.remove('btn-glints-disabled');
                    hiddenConfirmationWord.value = 'DELETE'; 
                } else {
                    nextStep1Btn.disabled = true;
                    nextStep1Btn.classList.add('btn-glints-disabled');
                    hiddenConfirmationWord.value = '';
                }
            }

            confirmDeleteInput.addEventListener('input', checkDeleteConfirmationInput);
            
            checkDeleteConfirmationInput();

            radioButtons.forEach(radio => {
                radio.addEventListener('change', updateHiddenReason);
            });
            updateHiddenReason();

            deleteAccountModalStep3.addEventListener('shown.bs.modal', function () {
                reasonExplanationInput.focus();
                checkExplanationInput();
            });

            reasonExplanationInput.addEventListener('input', checkExplanationInput);
            
            // Baca data attribute untuk cek apakah ada error dan route match
            const deleteAccountModalStep3El = document.getElementById('deleteAccountModalStep3');
            const hasErrors = deleteAccountModalStep3El.getAttribute('data-has-errors') === 'true';
            const currentRoute = deleteAccountModalStep3El.getAttribute('data-current-route');
            const deleteRoute = deleteAccountModalStep3El.getAttribute('data-delete-route');
            const oldReason = deleteAccountModalStep3El.getAttribute('data-old-reason');
            const oldExplanation = deleteAccountModalStep3El.getAttribute('data-old-explanation');
            
            if (hasErrors && currentRoute === deleteRoute) {
                var modal = new bootstrap.Modal(document.getElementById('deleteAccountModalStep3'));
                modal.show();
                
                if (oldExplanation) {
                    reasonExplanationInput.value = oldExplanation;
                }
                if (oldReason) {
                    hiddenDeleteReason.value = oldReason;
                }
                
                checkExplanationInput();
            }
        });
    </script>

</html>