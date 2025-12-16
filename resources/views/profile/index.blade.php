<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - Glints</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --glints-blue: #0a66c2;
            --glints-dark-blue: #004182;
            --glints-light-blue: #e3f0ff;
            --glints-gray: #666666;
            --glints-light-gray: #f3f2f1;
            --glints-border: #d0d0d0;
        }

        body {
            background-color: #f9f9f9;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            line-height: 1.4;
        }

        /* Profile Container */
        .profile-container {
            max-width: 1200px;
            margin: 2rem auto;
        }

        .profile-header {
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            padding: 2rem;
            margin-bottom: 1.5rem;
        }

        .profile-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--glints-blue);
        }

        .profile-name {
            font-size: 1.75rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 0.25rem;
        }

        .profile-title {
            color: var(--glints-gray);
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }

        .profile-location {
            color: var(--glints-gray);
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .edit-profile-btn {
            background: transparent;
            border: 1px solid var(--glints-blue);
            color: var(--glints-blue);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 500;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }

        .edit-profile-btn:hover {
            background: var(--glints-light-blue);
            color: var(--glints-blue);
        }

        /* Content Grid */
        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.5rem;
        }

        /* Main Content Cards */
        .content-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid var(--glints-border);
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #333;
            margin: 0;
        }

        .edit-icon {
            color: var(--glints-blue);
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 4px;
            transition: background 0.2s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .edit-icon:hover {
            background: var(--glints-light-blue);
        }

        /* Info Items */
        .info-item {
            display: flex;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--glints-light-gray);
        }

        .info-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .info-icon {
            width: 40px;
            height: 40px;
            background: var(--glints-light-blue);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            flex-shrink: 0;
        }

        .info-icon i {
            color: var(--glints-blue);
            font-size: 1.1rem;
        }

        .info-content {
            flex: 1;
        }

        .info-label {
            font-size: 0.9rem;
            color: var(--glints-gray);
            margin-bottom: 0.25rem;
        }

        .info-value {
            font-size: 1rem;
            color: #333;
            font-weight: 500;
        }

        .empty-state {
            color: var(--glints-gray);
            font-style: italic;
        }

        /* About Section */
        .about-content {
            line-height: 1.6;
            color: #333;
            white-space: pre-line;
        }

        /* Skills Section */
        .skill-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .skill-tag {
            background: var(--glints-light-blue);
            color: var(--glints-blue);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Sidebar */
        .sidebar-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .sidebar-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 1rem;
        }

        .document-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--glints-light-gray);
        }

        .document-item:last-child {
            border-bottom: none;
        }

        .document-icon {
            color: var(--glints-blue);
            margin-right: 0.75rem;
            font-size: 1.2rem;
        }

        .document-name {
            flex: 1;
            color: #333;
            font-weight: 500;
        }

        .document-action {
            color: var(--glints-blue);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .document-action:hover {
            text-decoration: underline;
        }

        /* Modal Styles */
        .modal-glints .modal-header {
            border-bottom: 1px solid var(--glints-border);
            padding: 1.5rem;
        }

        .modal-glints .modal-title {
            font-weight: 600;
            color: #333;
        }

        .modal-glints .modal-body {
            padding: 1.5rem;
        }

        .modal-glints .modal-footer {
            border-top: 1px solid var(--glints-border);
            padding: 1rem 1.5rem;
        }

        .btn-glints-primary {
            background: var(--glints-blue);
            border: none;
            color: white;
            font-weight: 500;
            padding: 0.5rem 1.5rem;
        }

        .btn-glints-primary:hover {
            background: var(--glints-dark-blue);
        }

        .btn-glints-outline {
            border: 1px solid var(--glints-border);
            color: var(--glints-gray);
            font-weight: 500;
            padding: 0.5rem 1.5rem;
        }

        .form-label-glints {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .form-control-glints {
            border: 1px solid var(--glints-border);
            border-radius: 4px;
            padding: 0.75rem;
        }

        .form-control-glints:focus {
            border-color: var(--glints-blue);
            box-shadow: 0 0 0 2px rgba(10, 102, 194, 0.2);
        }

        .file-upload-info {
            font-size: 0.875rem;
            color: var(--glints-gray);
            margin-top: 0.25rem;
        }

        @media (max-width: 768px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
            
            .profile-header {
                padding: 1.5rem;
            }
            
            .content-card, .sidebar-card {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>

@include('partials.navbar')

<div class="container profile-container">
    <!-- Profile Header -->
    <div class="profile-header">
        <div class="row align-items-center">
            <div class="col-auto">
                @if($user->avatar)
                    <img src="{{ Storage::url('public/avatars/' . $user->avatar) }}" alt="Profile" class="profile-avatar" id="currentAvatar">
                @else
                    <div class="profile-avatar bg-light d-flex align-items-center justify-content-center" id="currentAvatar">
                        <i class="bi bi-person-fill" style="font-size: 2rem; color: #666;"></i>
                    </div>
                @endif
            </div>
            <div class="col">
                <h1 class="profile-name">{{ $user->name ?: 'Nama Lengkap' }}</h1>
                <div class="profile-title">
                    @if($user->asal_sekolah)
                        {{ $user->asal_sekolah }}
                    @else
                        <span class="empty-state">Asal sekolah belum diisi</span>
                    @endif
                </div>
                <div class="profile-location">
                    <i class="bi bi-geo-alt"></i>
                    @if($user->lokasi)
                        {{ $user->lokasi }}
                    @else
                        <span class="empty-state">Lokasi belum diisi</span>
                    @endif
                </div>
            </div>
            <div class="col-auto">
                <button class="edit-profile-btn" onclick="openEditModal('profile')">
                    <i class="bi bi-pencil"></i>Edit Profil
                </button>
            </div>
        </div>
    </div>

    <div class="content-grid">
        <!-- Main Content -->
        <div class="main-content">
            <!-- About Section -->
            <div class="content-card">
                <div class="card-header">
                    <h3 class="card-title">Tentang Saya</h3>
                    <div class="edit-icon" onclick="openEditModal('about')">
                        <i class="bi bi-pencil"></i>Edit
                    </div>
                </div>
                <div class="about-content">
                    @if($user->tentang_anda)
                        {{ $user->tentang_anda }}
                    @else
                        <p class="empty-state">Deskripsi tentang diri Anda belum diisi. Tambahkan deskripsi untuk memperkenalkan diri kepada perusahaan.</p>
                    @endif
                </div>
            </div>

            <!-- Personal Information -->
            <div class="content-card">
                <div class="card-header">
                    <h3 class="card-title">Informasi Pribadi</h3>
                    <div class="edit-icon" onclick="openEditModal('personal')">
                        <i class="bi bi-pencil"></i>Edit
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="bi bi-telephone"></i>
                    </div>
                    <div class="info-content">
                        <div class="info-label">Nomor WhatsApp</div>
                        <div class="info-value">
                            @if($user->whatsapp)
                                {{ $user->whatsapp }}
                            @else
                                <span class="empty-state">Belum diisi</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">
                        <i class="bi bi-gender-ambiguous"></i>
                    </div>
                    <div class="info-content">
                        <div class="info-label">Jenis Kelamin</div>
                        <div class="info-value">
                            @if($user->gender)
                                {{ $user->gender }}
                            @else
                                <span class="empty-state">Belum diisi</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">
                        <i class="bi bi-envelope"></i>
                    </div>
                    <div class="info-content">
                        <div class="info-label">Email</div>
                        <div class="info-value">{{ $user->email }}</div>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                    <div class="info-content">
                        <div class="info-label">Lokasi</div>
                        <div class="info-value">
                            @if($user->lokasi)
                                {{ $user->lokasi }}
                            @else
                                <span class="empty-state">Belum diisi</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Skills Section -->
            <div class="content-card">
                <div class="card-header">
                    <h3 class="card-title">Keahlian</h3>
                    <div class="edit-icon" onclick="openEditModal('skills')">
                        <i class="bi bi-pencil"></i>Edit
                    </div>
                </div>
                <div class="skill-tags">
                    @if($user->skills)
                        @foreach(explode(',', $user->skills) as $skill)
                            <span class="skill-tag">{{ trim($skill) }}</span>
                        @endforeach
                    @else
                        <span class="empty-state">Keahlian belum diisi</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Documents -->
            <div class="sidebar-card">
                <h4 class="sidebar-title">Dokumen</h4>
                
                <div class="document-item">
                    <i class="bi bi-file-earmark-pdf document-icon"></i>
                    <span class="document-name">Curriculum Vitae</span>
                    @if($user->upload_cv)
                        <a href="{{ Storage::url('public/cv/' . $user->upload_cv) }}" target="_blank" class="document-action">Lihat</a>
                    @else
                        <span class="empty-state">Belum upload</span>
                    @endif
                </div>

                <div class="document-item">
                    <i class="bi bi-file-earmark-text document-icon"></i>
                    <span class="document-name">Ijazah</span>
                    @if($user->upload_ijazah)
                        <a href="{{ Storage::url('public/ijazah/' . $user->upload_ijazah) }}" target="_blank" class="document-action">Lihat</a>
                    @else
                        <span class="empty-state">Belum upload</span>
                    @endif
                </div>
            </div>

            <!-- Links -->
            <div class="sidebar-card">
                <h4 class="sidebar-title">Link</h4>
                
                <div class="document-item">
                    <i class="bi bi-github document-icon"></i>
                    <span class="document-name">GitHub</span>
                    @if($user->link_github)
                        <a href="{{ $user->link_github }}" target="_blank" class="document-action">Kunjungi</a>
                    @else
                        <span class="empty-state">Belum diisi</span>
                    @endif
                </div>

                <div class="document-item">
                    <i class="bi bi-briefcase document-icon"></i>
                    <span class="document-name">Portofolio</span>
                    @if($user->link_portofolio)
                        <a href="{{ $user->link_portofolio }}" target="_blank" class="document-action">Kunjungi</a>
                    @else
                        <span class="empty-state">Belum diisi</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.footer')

<!-- Modal untuk Edit Profil -->
<div class="modal fade modal-glints" id="editProfileModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalTitle">Edit Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="profileForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body" id="modalBody">
                    <!-- Konten akan diisi oleh JavaScript -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-glints-outline" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-glints-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@if(session('success'))
<script>
    Swal.fire({
        toast: true,
        position: "top-end",
        icon: "success",
        title: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        toast: true,
        position: "top-end",
        icon: "error",
        title: "{{ session('error') }}",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });
</script>
@endif

<script>

function openEditModal(section) {
    const modal = new bootstrap.Modal(document.getElementById('editProfileModal'));
    const modalTitle = document.getElementById('editModalTitle');
    const modalBody = document.getElementById('modalBody');
    
    // Kosongkan modal body terlebih dahulu
    modalBody.innerHTML = '';
    
    // Set modal title dan content berdasarkan section
    switch(section) {
        case 'profile':
            modalTitle.textContent = 'Edit Profil Lengkap';
            modalBody.innerHTML = `
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label-glints">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control-glints form-control" name="name" value="{{ $user->name }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label-glints">Asal Sekolah</label>
                        <input type="text" class="form-control-glints form-control" name="asal_sekolah" value="{{ $user->asal_sekolah }}" placeholder="Nama sekolah/universitas">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label-glints">Lokasi</label>
                        <input type="text" class="form-control-glints form-control" name="lokasi" value="{{ $user->lokasi }}" placeholder="Kota tempat tinggal">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label-glints">Avatar</label>
                        <input type="file" class="form-control-glints form-control" name="avatar" accept="image/*" onchange="previewAvatar(this)">
                        <div class="file-upload-info">Format: JPG, PNG, GIF (Maks. 2MB)</div>
                        @if($user->avatar)
                            <div class="file-upload-info text-success">Avatar sudah diupload</div>
                        @endif
                    </div>
                </div>
            `;
            break;
            
        case 'about':
            modalTitle.textContent = 'Edit Tentang Saya';
            modalBody.innerHTML = `
                <div class="mb-3">
                    <label class="form-label-glints">Tentang Anda</label>
                    <textarea class="form-control-glints form-control" name="tentang_anda" rows="6" placeholder="Ceritakan tentang diri Anda, pengalaman, minat, dan tujuan karir">{{ $user->tentang_anda }}</textarea>
                    <div class="file-upload-info">Maksimal 2000 karakter</div>
                </div>
            `;
            break;
            
        case 'personal':
            modalTitle.textContent = 'Edit Informasi Pribadi';
            modalBody.innerHTML = `
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label-glints">Nomor WhatsApp</label>
                        <input type="text" class="form-control-glints form-control" name="whatsapp" value="{{ $user->whatsapp }}" placeholder="Contoh: 081234567890">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label-glints">Jenis Kelamin</label>
                        <select name="gender" class="form-control-glints form-select">
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki" {{ $user->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ $user->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label-glints">Email</label>
                        <input type="email" class="form-control-glints form-control" value="{{ $user->email }}" disabled>
                        <small class="text-muted">Email tidak dapat diubah</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label-glints">Lokasi</label>
                        <input type="text" class="form-control-glints form-control" name="lokasi" value="{{ $user->lokasi }}" placeholder="Kota tempat tinggal">
                    </div>
                </div>
            `;
            break;
            
        case 'skills':
            modalTitle.textContent = 'Edit Keahlian & Dokumen';
            modalBody.innerHTML = `
                <div class="mb-3">
                    <label class="form-label-glints">Keahlian</label>
                    <input type="text" class="form-control-glints form-control" name="skills" value="{{ $user->skills }}" placeholder="Pisahkan dengan koma, contoh: HTML, CSS, JavaScript">
                    <div class="file-upload-info">Pisahkan setiap keahlian dengan koma</div>
                </div>
                <div class="mb-3">
                    <label class="form-label-glints">Link GitHub</label>
                    <input type="url" class="form-control-glints form-control" name="link_github" value="{{ $user->link_github }}" placeholder="https://github.com/username">
                </div>
                <div class="mb-3">
                    <label class="form-label-glints">Link Portofolio</label>
                    <input type="url" class="form-control-glints form-control" name="link_portofolio" value="{{ $user->link_portofolio }}" placeholder="https://yourportfolio.com">
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label-glints">Upload CV (PDF)</label>
                        <input type="file" class="form-control-glints form-control" name="upload_cv" accept=".pdf">
                        <div class="file-upload-info">Format: PDF (Maks. 4MB)</div>
                        @if($user->upload_cv)
                            <div class="file-upload-info text-success">CV sudah diupload</div>
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label-glints">Upload Ijazah</label>
                        <input type="file" class="form-control-glints form-control" name="upload_ijazah" accept=".pdf">
                        <div class="file-upload-info">Format: PDF (Maks. 4MB)</div>
                        @if($user->upload_ijazah)
                            <div class="file-upload-info text-success">Ijazah sudah diupload</div>
                        @endif
                    </div>
                </div>
            `;
            break;
    }
    
    modal.show();
}

function previewAvatar(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const currentAvatar = document.getElementById('currentAvatar');
            if (currentAvatar) {
                if (currentAvatar.tagName === 'IMG') {
                    currentAvatar.src = e.target.result;
                } else {
                    const newAvatar = document.createElement('img');
                    newAvatar.src = e.target.result;
                    newAvatar.className = 'profile-avatar';
                    newAvatar.alt = 'Profile Avatar';
                    newAvatar.id = 'currentAvatar';
                    currentAvatar.parentNode.replaceChild(newAvatar, currentAvatar);
                }
            }
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// Handle form submission
document.getElementById('profileForm').addEventListener('submit', function(e) {
    const submitBtn = this.querySelector('button[type="submit"]');
    
    // Show loading state
    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Menyimpan...';
    submitBtn.disabled = true;
    
    // Basic validation
    const nameInput = this.querySelector('input[name="name"]');
    if (nameInput && !nameInput.value.trim()) {
        e.preventDefault();
        submitBtn.innerHTML = 'Simpan Perubahan';
        submitBtn.disabled = false;
        Swal.fire({
            icon: 'error',
            title: 'Data Belum Lengkap',
            text: 'Nama lengkap wajib diisi!',
            confirmButtonText: 'OK'
        });
    }
});

// Auto-close modal on successful submission
</script>
@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = bootstrap.Modal.getInstance(document.getElementById('editProfileModal'));
        if (modal) {
            modal.hide();
        }
    });
</script>
@endif

</body>
</html>