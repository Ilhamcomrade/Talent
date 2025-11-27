<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Perusahaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --light-bg: #f8f9fa;
            --border-radius: 8px;
            --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }
        
        .profile-container {
            max-width: 900px;
            margin: 20px auto;
            padding: 0 15px;
            background-color: white;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        }
        
        .profile-header {
            background: linear-gradient(135deg, #007bff, #3498db); 
            color: white;
            border-radius: 0;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: none;
            position: relative;
            overflow: hidden;
        }

        .profile-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: translate(40%, -40%);
        }
        
        .profile-header h2 {
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .profile-header p {
            opacity: 0.9;
            margin-bottom: 0;
        }
        
        .content-area {
            padding: 20px 15px;
            background-color: #f5f7fa;
        }

        .button-area {
            text-align: right; 
            padding: 20px 15px;
            background-color: #f5f7fa;
            border-top: 1px solid #dee2e6;
            position: sticky;
            bottom: 0;
            background: white;
            z-index: 100;
        }
        
        .btn-custom-cancel {
            background-color: #343a40; 
            border-color: #343a40;
            color: white;
            padding: 8px 25px; 
            border-radius: 4px; 
            font-weight: 500;
            margin-right: 10px; 
            transition: all 0.2s;
        }
        
        .btn-custom-cancel:hover {
            background-color: #495057;
            border-color: #495057;
            color: white;
        }
        
        .btn-custom-simpan {
            background-color: #007bff; 
            border-color: #007bff;
            padding: 8px 25px; 
            border-radius: 4px; 
            font-weight: 500;
            transition: all 0.2s;
        }
        
        .btn-custom-simpan:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .form-section-container {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-bottom: 15px;
            overflow: hidden;
        }

        .accordion-header {
            background-color: white;
            padding: 20px;
            border: none;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            text-align: left;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .accordion-header:hover {
            background-color: #f8f9fa;
        }
        
        .accordion-header.active {
            background-color: #e3f2fd;
            border-bottom: 1px solid #dee2e6;
        }
        
        .section-title {
            color: var(--primary-color);
            font-weight: 600;
            display: flex;
            align-items: center;
            margin: 0;
        }
        
        .section-title i {
            margin-right: 10px;
            font-size: 1.2rem;
        }
        
        .accordion-icon {
            transition: transform 0.3s;
        }
        
        .accordion-header.active .accordion-icon {
            transform: rotate(180deg);
        }
        
        .accordion-content {
            padding: 0;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out, padding 0.3s ease-out;
        }
        
        .accordion-content.active {
            padding: 25px;
            max-height: 2000px;
        }
        
        .form-label {
            font-weight: 600;
            color: #555;
            margin-bottom: 8px;
        }
        
        .form-control, .form-select {
            border-radius: 6px;
            padding: 10px 15px;
            border: 1px solid #ddd;
            transition: all 0.3s;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
        }
        
        .logo-preview {
            border: 1px dashed #ccc;
            border-radius: var(--border-radius);
            padding: 15px;
            text-align: center;
            margin-top: 10px;
            background-color: var(--light-bg);
        }
        
        .logo-preview img {
            max-width: 150px;
            max-height: 150px;
            border-radius: 6px;
        }
        
        .alert {
            border-radius: var(--border-radius);
            border: none;
            padding: 15px 20px;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .two-column-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        
        @media (max-width: 768px) {
            .profile-container {
                padding: 0 10px;
            }
            
            .profile-header {
                padding: 20px;
            }
            
            .button-area {
                text-align: center;
            }

            .btn-custom-cancel, .btn-custom-simpan {
                width: 100%;
                margin-right: 0;
                margin-bottom: 10px;
            }
            
            .two-column-layout {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

@include('partials.navbar_company')

<div class="profile-container">
    <div class="profile-header">
        <h2><i class="fas fa-building me-2"></i>Profil Perusahaan</h2>
        <p>Kelola informasi dan identitas perusahaan Anda</p>
    </div>

    <div class="content-area">

        @if(session('success'))
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <h6 class="mb-0">Terjadi kesalahan:</h6>
                </div>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('company.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <!-- 1. Informasi Dasar -->
            <div class="form-section-container">
                <button type="button" class="accordion-header active">
                    <h4 class="section-title"><i class="fas fa-info-circle"></i>Informasi Dasar</h4>
                    <i class="fas fa-chevron-down accordion-icon"></i>
                </button>
                <div class="accordion-content active">
                    <div class="two-column-layout">
                        <div class="mb-3">
                            <label class="form-label">Nama Perusahaan</label>
                            <input type="text" name="nama_perusahaan" class="form-control"
                                value="{{ old('nama_perusahaan', $company->nama_perusahaan ?? '') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jumlah Karyawan</label>
                            <input type="number" name="jumlah_karyawan" class="form-control"
                                value="{{ old('jumlah_karyawan', $company->jumlah_karyawan ?? '') }}">
                        </div>
                    </div>
                    
                    <div class="two-column-layout">
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control"
                                value="{{ old('nama_lengkap', $company->nama_lengkap ?? '') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jabatan</label>
                            <input type="text" name="jabatan" class="form-control"
                                value="{{ old('jabatan', $company->jabatan ?? '') }}" required>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- 2. Informasi Akun -->
            <div class="form-section-container">
                <button type="button" class="accordion-header">
                    <h4 class="section-title"><i class="fas fa-lock"></i>Informasi Akun</h4>
                    <i class="fas fa-chevron-down accordion-icon"></i>
                </button>
                <div class="accordion-content">
                    <div class="two-column-layout">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="{{ $company->email ?? 'email@contoh.com' }}" readonly>
                            <small class="text-muted">Email tidak dapat diubah</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password Baru (opsional)</label>
                            <input type="password" name="password" class="form-control">
                            <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">No. HP</label>
                        <input type="text" name="no_hp" class="form-control"
                            value="{{ old('no_hp', $company->no_hp ?? '') }}">
                    </div>
                </div>
            </div>
            
            <!-- 3. Alamat Perusahaan -->
            <div class="form-section-container">
                <button type="button" class="accordion-header">
                    <h4 class="section-title"><i class="fas fa-map-marker-alt"></i>Alamat Perusahaan</h4>
                    <i class="fas fa-chevron-down accordion-icon"></i>
                </button>
                <div class="accordion-content">
                    <div class="mb-3">
                        <label class="form-label">Alamat Lengkap</label>
                        <textarea name="alamat_lengkap" class="form-control" rows="2">{{ old('alamat_lengkap', $company->alamat_lengkap ?? '') }}</textarea>
                    </div>
                    
                    <div class="two-column-layout">
                        <div class="mb-3">
                            <label class="form-label">Provinsi</label>
                            <input type="text" name="provinsi" class="form-control"
                                value="{{ old('provinsi', $company->provinsi ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kota</label>
                            <input type="text" name="kota" class="form-control"
                                value="{{ old('kota', $company->kota ?? '') }}">
                        </div>
                    </div>
                    
                    <div class="two-column-layout">
                        <div class="mb-3">
                            <label class="form-label">Kecamatan</label>
                            <input type="text" name="kecamatan" class="form-control"
                                value="{{ old('kecamatan', $company->kecamatan ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Desa / Kelurahan</label>
                            <input type="text" name="desa_kelurahan" class="form-control"
                                value="{{ old('desa_kelurahan', $company->desa_kelurahan ?? '') }}">
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- 4. Visi, Misi & Alasan -->
            <div class="form-section-container">
                <button type="button" class="accordion-header">
                    <h4 class="section-title"><i class="fas fa-bullseye"></i>Visi, Misi & Alasan</h4>
                    <i class="fas fa-chevron-down accordion-icon"></i>
                </button>
                <div class="accordion-content">
                    <div class="mb-3">
                        <label class="form-label">Visi</label>
                        <textarea name="visi" class="form-control" rows="2">{{ old('visi', $company->visi ?? '') }}</textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Misi</label>
                        <textarea name="misi" class="form-control" rows="2">{{ old('misi', $company->misi ?? '') }}</textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Alasan</label>
                        <textarea name="alasan" class="form-control" rows="2">{{ old('alasan', $company->alasan ?? '') }}</textarea>
                    </div>
                </div>
            </div>
            
            <!-- 5. Logo Perusahaan -->
            <div class="form-section-container">
                <button type="button" class="accordion-header">
                    <h4 class="section-title"><i class="fas fa-image"></i>Logo Perusahaan</h4>
                    <i class="fas fa-chevron-down accordion-icon"></i>
                </button>
                <div class="accordion-content">
                    <div class="mb-3">
                        <label class="form-label">Unggah Logo Baru</label>
                        <input type="file" name="logo" class="form-control" accept="image/*">
                    </div>
                    
                    @if(isset($company->logo) && $company->logo)
                        <div class="logo-preview">
                            <p class="mb-2">Logo Saat Ini:</p>
                            <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo Perusahaan" class="img-thumbnail">
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- TOMBOL AKSI -->
            <div class="button-area">
                <a href="{{ url()->previous() }}" class="btn btn-custom-cancel">batal</a>
                <button type="submit" class="btn btn-custom-simpan">simpan</button>
            </div>
        </form>

        <!-- Zona Berbahaya -->
        <div class="form-section-container mt-4 mb-5">
            <button type="button" class="accordion-header">
                <h4 class="section-title text-danger"><i class="fas fa-exclamation-triangle"></i>Zona Berbahaya</h4>
                <i class="fas fa-chevron-down accordion-icon"></i>
            </button>
            <div class="accordion-content">
                <p class="text-muted mb-3">Hapus profil perusahaan Anda. Tindakan ini tidak dapat dibatalkan.</p>
                
                <form action="{{ route('company.profile.destroy', $company->id ?? 'dummy-id') }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus profil perusahaan? Tindakan ini tidak dapat dibatalkan.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Hapus Profil
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const accordionHeaders = document.querySelectorAll('.accordion-header');
        
        accordionHeaders.forEach(header => {
            header.addEventListener('click', function() {
                const content = this.nextElementSibling;
                const isActive = this.classList.contains('active');
                
                // Tutup semua accordion
                accordionHeaders.forEach(h => {
                    h.classList.remove('active');
                    h.nextElementSibling.classList.remove('active');
                });
                
                // Buka accordion yang diklik jika sebelumnya tidak aktif
                if (!isActive) {
                    this.classList.add('active');
                    content.classList.add('active');
                }
            });
        });
        
        // Buka accordion pertama secara default
        if (accordionHeaders.length > 0) {
            accordionHeaders[0].classList.add('active');
            accordionHeaders[0].nextElementSibling.classList.add('active');
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>