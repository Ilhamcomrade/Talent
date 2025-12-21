<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lamar Pekerjaan: {{ $job->title }} - {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #4361ee;
            --primary-hover: #3a56d4;
            --secondary-color: #6c757d;
            --light-bg: #f8f9fa;
            --border-color: #dee2e6;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --step-inactive: #e9ecef;
            --step-active: var(--primary-color);
            --step-completed: #198754;
        }
        
        body { 
            background-color: var(--light-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .apply-container { 
            max-width: 900px;
            margin: 2rem auto;
            padding: 0 15px;
        }
        
        .job-header { 
            background: linear-gradient(135deg, #f5f7ff 0%, #ffffff 100%);
            padding: 1.75rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            border-left: 5px solid var(--primary-color);
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        
        .form-container { 
            background: white; 
            padding: 2.5rem; 
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
            margin-bottom: 3rem;
        }
        
        .form-label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #333;
        }
        
        .required::after {
            content: " *";
            color: var(--danger-color);
        }
        
        .form-control, .form-select {
            padding: 0.75rem 1rem;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
        }
        
        .btn-outline-secondary {
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 600;
        }
        
        .alert-info {
            border-radius: 10px;
            border-left: 5px solid var(--primary-color);
            padding: 1.25rem;
        }
        
        .job-meta {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
            margin-top: 0.5rem;
        }
        
        .job-meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--secondary-color);
            font-size: 0.95rem;
        }
        
        .job-meta-item i {
            color: var(--primary-color);
        }
        
        .upload-area {
            border: 2px dashed var(--border-color);
            border-radius: 10px;
            padding: 2rem;
            text-align: center;
            background-color: #fafafa;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 0.5rem;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        
        .upload-area:hover {
            border-color: var(--primary-color);
            background-color: #f5f7ff;
        }
        
        .upload-area input[type="file"] {
            display: none;
        }
        
        .upload-text {
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
        }
        
        .file-info {
            font-size: 0.9rem;
            color: #666;
        }
        
        .form-section {
            margin-bottom: 2.5rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid var(--border-color);
        }
        
        .form-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            position: relative;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background-color: var(--primary-color);
            border-radius: 3px;
        }
        
        .character-counter {
            font-size: 0.85rem;
            text-align: right;
            color: var(--secondary-color);
            margin-top: 0.5rem;
        }
        
        /* --- STYLES FOR STEPPER/PROGRESS BAR --- */
        .progress-stepper {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2.5rem;
            padding: 0 1rem;
            position: relative;
        }

        .step {
            position: relative;
            flex: 1;
            text-align: center;
            z-index: 2;
        }

        .step-icon {
            width: 50px;
            height: 50px;
            line-height: 50px;
            border-radius: 50%;
            background-color: var(--step-inactive);
            color: #6c757d;
            font-weight: bold;
            display: inline-block;
            transition: all 0.3s ease;
            position: relative;
            font-size: 1.1rem;
            border: 3px solid white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .step-label {
            display: block;
            margin-top: 0.75rem;
            font-size: 0.9rem;
            color: var(--secondary-color);
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .step.active .step-icon {
            background-color: var(--step-active);
            color: white;
            box-shadow: 0 0 0 5px rgba(67, 97, 238, 0.2), 0 2px 8px rgba(67, 97, 238, 0.3);
        }

        .step.completed .step-icon {
            background-color: var(--step-completed);
            color: white;
        }
        
        .step.completed .step-icon::after {
            content: '✓';
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-weight: bold;
        }
        
        .step.active .step-label {
            color: var(--step-active);
            font-weight: 600;
        }
        
        .step.completed .step-label {
            color: var(--step-completed);
        }

        /* Progress line between steps */
        .progress-line {
            position: absolute;
            top: 25px;
            left: 50px;
            right: 50px;
            height: 3px;
            background-color: var(--step-inactive);
            z-index: 1;
            transition: background-color 0.3s ease;
        }
        
        .progress-line-fill {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            background-color: var(--step-active);
            width: 0;
            transition: width 0.3s ease;
            border-radius: 3px;
        }
        
        /* Section indicator */
        .section-indicator {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid #f0f0f0;
        }
        
        .section-number {
            width: 32px;
            height: 32px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 12px;
            font-size: 0.9rem;
        }
        
        .section-heading {
            font-size: 1.2rem;
            font-weight: 600;
            color: #333;
            margin: 0;
        }
        
        .form-group-highlight {
            background-color: #f8faff;
            padding: 1.25rem;
            border-radius: 8px;
            border-left: 4px solid var(--primary-color);
            margin-bottom: 1.5rem;
        }
        
        @media (max-width: 768px) {
            .apply-container {
                margin: 1rem auto;
                padding: 0 10px;
            }
            
            .form-container {
                padding: 1.5rem;
            }
            
            .job-header {
                padding: 1.25rem;
            }
            
            .job-meta {
                gap: 1rem;
            }
            
            .step-icon {
                width: 40px;
                height: 40px;
                line-height: 40px;
            }
            
            .progress-line {
                top: 20px;
                left: 40px;
                right: 40px;
            }
            
            .upload-area {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>

@include('partials.navbar')

<div class="container apply-container">
    @if($hasApplied)
        <!-- Jika sudah apply, tampilkan pesan -->
        <div class="alert alert-info d-flex align-items-center" role="alert">
            <i class="bi bi-info-circle-fill me-2" style="font-size: 1.2rem;"></i>
            <div>
                <h5 class="alert-heading mb-2">Lamaran Telah Dikirim!</h5>
                <p class="mb-2">Anda telah mengirimkan lamaran untuk posisi ini. Silakan pantau email untuk informasi selanjutnya.</p>
                <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-sm btn-outline-primary mt-2">Kembali ke Detail Lowongan</a>
            </div>
        </div>
    @endif

    <div class="job-header">
        <h4 class="mb-3 fw-bold">{{ $job->title }}</h4>
        <p class="mb-2 text-primary fw-medium">{{ $job->company_name ?? $job->company->name ?? 'Perusahaan' }}</p>
        
        <div class="job-meta">
            <div class="job-meta-item">
                <i class="bi bi-geo-alt"></i>
                <span>{{ $job->location }}</span>
            </div>
            <div class="job-meta-item">
                <i class="bi bi-briefcase"></i>
                <span>{{ $job->type }}</span>
            </div>
            <div class="job-meta-item">
                <i class="bi bi-calendar"></i>
                <span>Dibuka: {{ \Carbon\Carbon::parse($job->created_at)->format('d M Y') }}</span>
            </div>
        </div>
    </div>

    @if(!$hasApplied)
    <div class="form-container">

        <!-- Progress Stepper -->
        <div class="progress-stepper">
            <div class="step active" id="step1">
                <span class="step-icon">1</span>
                <span class="step-label">Data Kontak</span>
            </div>
            <div class="step" id="step2">
                <span class="step-icon">2</span>
                <span class="step-label">Data Diri</span>
            </div>
            <div class="step" id="step3">
                <span class="step-icon">3</span>
                <span class="step-label">Dokumen</span>
            </div>
            <div class="progress-line">
                <div class="progress-line-fill" id="progressFill"></div>
            </div>
        </div>
        
        <form method="POST" action="{{ route('jobs.apply.store', $job->id) }}" enctype="multipart/form-data" id="applyForm">
            @csrf
            
            <!-- Bagian 1: Data Kontak -->
            <div class="form-section" id="section1">
                <div class="section-indicator">
                    <div class="section-number">1</div>
                    <h5 class="section-heading">Data Kontak</h5>
                </div>
                
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <div class="form-group-highlight">
                            <label class="form-label required">Nama Lengkap</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                   name="nama" value="{{ old('nama', Auth::user()->name ?? '') }}" 
                                   placeholder="Masukkan nama lengkap" required>
                            @error('nama')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-group-highlight">
                            <label class="form-label required">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email', Auth::user()->email ?? '') }}" 
                                   placeholder="nama@contoh.com" required>
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group-highlight">
                    <label class="form-label">Nomor Telepon/WhatsApp</label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white">+62</span>
                        <input type="text" class="form-control @error('telepon') is-invalid @enderror" 
                               name="telepon" value="{{ old('telepon') }}" 
                               placeholder="81234567890">
                        @error('telepon')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <small class="text-muted mt-2 d-block">Contoh: 81234567890 (tanpa 0 di depan)</small>
                </div>
                
                <div class="d-flex justify-content-end mt-4">
                    <button type="button" class="btn btn-outline-primary btn-next" data-next="section2">
                        Selanjutnya <i class="bi bi-arrow-right ms-1"></i>
                    </button>
                </div>
            </div>
            
            <!-- Bagian 2: Data Diri & Riwayat -->
            <div class="form-section" id="section2" style="display: none;">
                <div class="section-indicator">
                    <div class="section-number">2</div>
                    <h5 class="section-heading">Data Diri & Riwayat</h5>
                </div>
                
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" 
                               name="tgl_lahir" value="{{ old('tgl_lahir') }}">
                        @error('tgl_lahir')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Pendidikan Terakhir</label>
                        <select class="form-select @error('pendidikan') is-invalid @enderror" name="pendidikan">
                            <option value="">Pilih Jenjang</option>
                            <option value="sd" {{ old('pendidikan') == 'sd' ? 'selected' : '' }}>SD</option>
                            <option value="smp" {{ old('pendidikan') == 'smp' ? 'selected' : '' }}>SMP</option>
                            <option value="smk_sma" {{ old('pendidikan') == 'smk_sma' ? 'selected' : '' }}>SMK/SMA Sederajat</option>
                            <option value="d1-d4" {{ old('pendidikan') == 'd1-d4' ? 'selected' : '' }}>D1 - D4</option>
                            <option value="s1" {{ old('pendidikan') == 's1' ? 'selected' : '' }}>S1</option>
                            <option value="s2" {{ old('pendidikan') == 's2' ? 'selected' : '' }}>S2</option>
                            <option value="s3" {{ old('pendidikan') == 's3' ? 'selected' : '' }}>S3</option>
                        </select>
                        @error('pendidikan')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Sekolah/Institusi Terakhir</label>
                    <input type="text" class="form-control @error('asal_sekolah') is-invalid @enderror" 
                           name="asal_sekolah" value="{{ old('asal_sekolah') }}" 
                           placeholder="Contoh: Universitas Indonesia">
                    @error('asal_sekolah')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Alamat Lengkap (Domisili)</label>
                    <textarea class="form-control @error('alamat') is-invalid @enderror" 
                              name="alamat" rows="3"
                              placeholder="Alamat lengkap, termasuk detail RT/RW">{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Pengalaman Kerja Singkat (Opsional)</label>
                    <textarea class="form-control @error('pengalaman_kerja') is-invalid @enderror" 
                              name="pengalaman_kerja" rows="4"
                              placeholder="Tuliskan ringkasan pengalaman kerja Anda (posisi, perusahaan, tahun)">{{ old('pengalaman_kerja') }}</textarea>
                    @error('pengalaman_kerja')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Keahlian Utama (Skills)</label>
                    <textarea class="form-control @error('keahlian') is-invalid @enderror" 
                              name="keahlian" rows="3"
                              placeholder="Contoh: PHP, MySQL, Project Management, Berkomunikasi Efektif">{{ old('keahlian') }}</textarea>
                    <small class="text-muted">Pisahkan setiap keahlian dengan koma atau baris baru.</small>
                    @error('keahlian')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-outline-secondary btn-prev" data-prev="section1">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </button>
                    <button type="button" class="btn btn-outline-primary btn-next" data-next="section3">
                        Selanjutnya <i class="bi bi-arrow-right ms-1"></i>
                    </button>
                </div>
            </div>

            <!-- Bagian 3: Dokumen Lamaran -->
            <div class="form-section" id="section3" style="display: none;">
                <div class="section-indicator">
                    <div class="section-number">3</div>
                    <h5 class="section-heading">Dokumen Lamaran & Konfirmasi</h5>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-4">
                        <label class="form-label required">Curriculum Vitae (CV)</label>
                        <div class="upload-area" onclick="document.getElementById('cvFile').click()" id="cvUploadArea">
                            <i class="bi bi-file-earmark-pdf" style="font-size: 2.5rem; color: var(--primary-color);"></i>
                            <p class="upload-text fw-medium">Klik untuk mengunggah file CV</p>
                            <p class="file-info">Format: PDF, DOC, DOCX | Maksimal: 5MB</p>
                            <div id="cvFileName" class="mt-2 text-primary fw-medium">{{ old('cv') ? 'File Sudah Dipilih' : '' }}</div>
                        </div>
                        <input type="file" class="form-control @error('cv') is-invalid @enderror d-none" 
                                id="cvFile" name="cv" accept=".pdf,.doc,.docx" required
                                onchange="displayFileName(this, 'cvFileName', 'cvUploadArea')">
                        @error('cv')
                            <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label">Surat Lamaran (Opsional)</label>
                        <div class="upload-area" onclick="document.getElementById('coverLetterFile').click()" id="coverLetterUploadArea">
                            <i class="bi bi-file-earmark-text" style="font-size: 2.5rem; color: var(--secondary-color);"></i>
                            <p class="upload-text">Klik untuk mengunggah Surat Lamaran</p>
                            <p class="file-info">Format: PDF, DOC, DOCX | Maksimal: 5MB</p>
                            <div id="coverLetterFileName" class="mt-2 text-secondary">{{ old('surat_lamaran') ? 'File Sudah Dipilih' : '' }}</div>
                        </div>
                        <input type="file" class="form-control @error('surat_lamaran') is-invalid @enderror d-none" 
                                id="coverLetterFile" name="surat_lamaran" accept=".pdf,.doc,.docx"
                                onchange="displayFileName(this, 'coverLetterFileName', 'coverLetterUploadArea')">
                        @error('surat_lamaran')
                            <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Foto Terbaru (Opsional)</label>
                        <div class="upload-area" onclick="document.getElementById('fotoFile').click()" id="fotoUploadArea">
                            <i class="bi bi-person-bounding-box" style="font-size: 2.5rem; color: var(--warning-color);"></i>
                            <p class="upload-text fw-medium">Klik untuk mengunggah Foto</p>
                            <p class="file-info">Format: JPG, PNG, JPEG | Maksimal: 2MB</p>
                            <div id="fotoFileName" class="mt-2 text-primary fw-medium">{{ old('foto') ? 'File Sudah Dipilih' : '' }}</div>
                        </div>
                        <input type="file" class="form-control @error('foto') is-invalid @enderror d-none" 
                                id="fotoFile" name="foto" accept=".jpg,.jpeg,.png"
                                onchange="displayFileName(this, 'fotoFileName', 'fotoUploadArea')">
                        @error('foto')
                            <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label">Ijazah Terakhir (Opsional)</label>
                        <div class="upload-area" onclick="document.getElementById('ijazahFile').click()" id="ijazahUploadArea">
                            <i class="bi bi-award" style="font-size: 2.5rem; color: var(--success-color);"></i>
                            <p class="upload-text fw-medium">Klik untuk mengunggah Ijazah</p>
                            <p class="file-info">Format: PDF, DOCX, JPG, PNG | Maksimal: 5MB</p>
                            <div id="ijazahFileName" class="mt-2 text-primary fw-medium">{{ old('ijazah') ? 'File Sudah Dipilih' : '' }}</div>
                        </div>
                        <input type="file" class="form-control @error('ijazah') is-invalid @enderror d-none" 
                                id="ijazahFile" name="ijazah" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                                onchange="displayFileName(this, 'ijazahFileName', 'ijazahUploadArea')">
                        @error('ijazah')
                            <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="form-label">Catatan untuk Perekrut (Opsional)</label>
                    <textarea class="form-control @error('catatan') is-invalid @enderror" 
                                 name="catatan" rows="4"
                                 placeholder="Tuliskan informasi tambahan yang ingin disampaikan kepada perekrut..."
                                 oninput="updateCharacterCount(this, 'charCount')">{{ old('catatan') }}</textarea>
                    <div class="character-counter">
                        <span id="charCount">0</span>/1000 karakter
                    </div>
                    @error('catatan')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-check mb-4 p-3 bg-light rounded">
                    <input class="form-check-input" type="checkbox" id="agreeTerms" required style="width: 1.2em; height: 1.2em;">
                    <label class="form-check-label ms-2" for="agreeTerms">
                        <span class="fw-semibold">Saya menyetujui</span> bahwa informasi yang saya berikan adalah <span class="fw-semibold">benar dan valid</span>, dan saya siap untuk proses seleksi lebih lanjut.
                    </label>
                </div>
                
                <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                    <button type="button" class="btn btn-outline-secondary btn-prev" data-prev="section2">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </button>
                    <div>
                        <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-outline-danger me-2">
                            <i class="bi bi-x-circle me-1"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-primary px-5">
                            <i class="bi bi-send-check me-2"></i>Kirim Lamaran
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @endif
</div>

@include('partials.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    let currentSection = 'section1';
    
    // Fungsi untuk menampilkan nama file yang diupload
    function displayFileName(input, displayElementId, uploadAreaId) {
        const fileName = input.files[0]?.name || '';
        document.getElementById(displayElementId).textContent = fileName ? fileName : 'Belum ada file';
        
        // Update tampilan upload area
        const uploadArea = document.getElementById(uploadAreaId);
        if (uploadArea) {
            if (fileName) {
                uploadArea.style.borderColor = 'var(--primary-color)';
                uploadArea.style.backgroundColor = '#f0f4ff';
            } else {
                uploadArea.style.borderColor = '';
                uploadArea.style.backgroundColor = '';
            }
        }
    }
    
    // Fungsi untuk menghitung karakter
    function updateCharacterCount(textarea, countElementId) {
        const count = textarea.value.length;
        document.getElementById(countElementId).textContent = count;
        
        if (count > 1000) {
            textarea.value = textarea.value.substring(0, 1000);
            document.getElementById(countElementId).textContent = 1000;
        }
    }
    
    // Fungsi untuk berpindah section
    function navigateToSection(sectionId) {
        // Sembunyikan semua section
        document.querySelectorAll('.form-section').forEach(section => {
            section.style.display = 'none';
        });
        
        // Tampilkan section yang dipilih
        document.getElementById(sectionId).style.display = 'block';
        
        // Update current section
        currentSection = sectionId;
        
        // Update progress stepper
        updateProgressStepper(sectionId);
        
        // Scroll ke atas form
        document.querySelector('.form-container').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
    
    // Fungsi untuk update progress stepper
    function updateProgressStepper(activeSectionId) {
        // Reset semua step
        document.querySelectorAll('.step').forEach(step => {
            step.classList.remove('active', 'completed');
        });
        
        // Tentukan step yang aktif dan selesai
        const sections = ['section1', 'section2', 'section3'];
        const activeIndex = sections.indexOf(activeSectionId);
        
        // Update progress line
        const progressFill = document.getElementById('progressFill');
        if (progressFill) {
            progressFill.style.width = `${(activeIndex / (sections.length - 1)) * 100}%`;
        }
        
        // Update step status
        for (let i = 0; i < sections.length; i++) {
            const stepId = `step${i + 1}`;
            const stepElement = document.getElementById(stepId);
            
            if (i < activeIndex) {
                // Step sebelumnya telah selesai
                stepElement.classList.add('completed');
            } else if (i === activeIndex) {
                // Step aktif
                stepElement.classList.add('active');
            }
        }
    }
    
    // Fungsi untuk validasi section sebelum berpindah
    function validateSection(sectionId) {
        const section = document.getElementById(sectionId);
        const requiredFields = section.querySelectorAll('[required]');
        let isValid = true;
        
        for (let field of requiredFields) {
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('is-invalid');
                
                // Scroll ke field yang error
                field.scrollIntoView({ behavior: 'smooth', block: 'center' });
                field.focus();
                break;
            } else {
                field.classList.remove('is-invalid');
            }
        }
        
        return isValid;
    }
    
    // Inisialisasi dan event listener
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi karakter counter
        const catatanTextarea = document.querySelector('textarea[name="catatan"]');
        if (catatanTextarea) {
            updateCharacterCount(catatanTextarea, 'charCount');
        }
        
        // Update progress stepper awal
        updateProgressStepper(currentSection);
        
        // Event listener untuk tombol selanjutnya
        document.querySelectorAll('.btn-next').forEach(button => {
            button.addEventListener('click', function() {
                const nextSection = this.getAttribute('data-next');
                if (validateSection(currentSection)) {
                    navigateToSection(nextSection);
                }
            });
        });
        
        // Event listener untuk tombol kembali
        document.querySelectorAll('.btn-prev').forEach(button => {
            button.addEventListener('click', function() {
                const prevSection = this.getAttribute('data-prev');
                navigateToSection(prevSection);
            });
        });
        
        // Event listener untuk klik step langsung
        document.querySelectorAll('.step').forEach((step, index) => {
            step.addEventListener('click', function() {
                const sectionId = `section${index + 1}`;
                
                // Validasi section sebelumnya jika ingin pindah ke section selanjutnya
                if (index > 0) {
                    const currentIndex = parseInt(currentSection.replace('section', ''));
                    if (index > currentIndex) {
                        // Jika ingin melompat ke section berikutnya, validasi section saat ini
                        if (!validateSection(currentSection)) {
                            return;
                        }
                    }
                }
                
                navigateToSection(sectionId);
            });
        });
        
        // Event listener submit form
        document.getElementById('applyForm').addEventListener('submit', function(e) {
            // Validasi section terakhir
            if (!validateSection('section3')) {
                e.preventDefault();
                return;
            }
            
            const agreeTerms = document.getElementById('agreeTerms');
            if (!agreeTerms.checked) {
                e.preventDefault();
                alert('Anda harus menyetujui persyaratan terlebih dahulu.');
                agreeTerms.focus();
                agreeTerms.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        });
        
        // Format input telepon
        document.querySelector('input[name="telepon"]')?.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.startsWith('0')) {
                value = value.substring(1);
            }
            e.target.value = value.substring(0, 13);
        });

        // Mempertahankan nama file jika ada error validasi
        ['cv', 'surat_lamaran', 'foto', 'ijazah'].forEach(fileField => {
            const input = document.getElementById(`${fileField}File`);
            if (input && input.files.length > 0) {
                displayFileName(input, `${fileField}FileName`, `${fileField}UploadArea`);
            }
        });
    });
</script>
</body>
</html>