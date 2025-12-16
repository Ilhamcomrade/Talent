<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Lowongan Kerja - Company</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 20px;
        }
        .form-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-top: 20px;
        }
        .form-section {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        .form-section-title {
            color: #0d6efd;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #0d6efd;
            font-weight: 600;
        }
        .required-label::after {
            content: " *";
            color: #dc3545;
        }
        .font-weight-normal {
            font-weight: normal;
        }
        .location-select {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Memanggil partial navbar -->
        @include('partials.navbar_company')
        
        <div class="form-container">
            <h3 class="mb-4">Buat Lowongan Kerja</h3>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('companiesjobs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- SECTION 1: INFORMASI PERUSAHAAN -->
                <div class="form-section">
                    <h5 class="form-section-title">Informasi Perusahaan</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Industri</label>
                            <input type="text" name="industry" class="form-control" placeholder="Contoh: Teknologi, Retail" value="{{ old('industry') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kategori Pekerjaan</label>
                            <select name="job_category_id" class="form-select">
                                <option value="">-- Pilih Kategori --</option>
                                @php
                                    use App\Models\JobCategory;
                                    // Ambil hanya child categories (yang memiliki parent_id)
                                    $categories = JobCategory::whereNotNull('parent_id')->orderBy('name')->get();
                                @endphp
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('job_category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Logo Perusahaan</label>
                            <input type="file" name="company_logo" class="form-control" accept="image/jpg,image/jpeg,image/png">
                            <small class="text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB</small>
                        </div>
                    </div>
                </div>

                <!-- SECTION 2: INFORMASI LOWONGAN -->
                <div class="form-section">
                    <h5 class="form-section-title">Informasi Lowongan</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label required-label">Judul Lowongan</label>
                            <input type="text" name="title" class="form-control" required value="{{ old('title') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Level Pekerjaan</label>
                            <select name="job_level" class="form-select">
                                <option value="">-- Pilih Level --</option>
                                <option value="entry" {{ old('job_level') == 'entry' ? 'selected' : '' }}>Entry Level</option>
                                <option value="junior" {{ old('job_level') == 'junior' ? 'selected' : '' }}>Junior</option>
                                <option value="intermediate" {{ old('job_level') == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                <option value="senior" {{ old('job_level') == 'senior' ? 'selected' : '' }}>Senior</option>
                                <option value="manager" {{ old('job_level') == 'manager' ? 'selected' : '' }}>Manager</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label required-label">Jenis Pekerjaan</label>
                            <select name="employment_type" class="form-select" required>
                                <option value="">-- Pilih Jenis Pekerjaan --</option>
                                <option value="full-time" {{ old('employment_type') == 'full-time' ? 'selected' : '' }}>Full-time</option>
                                <option value="contract" {{ old('employment_type') == 'contract' ? 'selected' : '' }}>Contract</option>
                                <option value="internship" {{ old('employment_type') == 'internship' ? 'selected' : '' }}>Internship</option>
                                <option value="part-time" {{ old('employment_type') == 'part-time' ? 'selected' : '' }}>Part-time</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label required-label">Kebijakan Kerja</label>
                            <select name="work_mode" class="form-select" required>
                                <option value="">-- Pilih Kebijakan --</option>
                                <option value="kerja_di_kantor" {{ old('work_mode') == 'kerja_di_kantor' ? 'selected' : '' }}>Kerja di Kantor</option>
                                <option value="remote" {{ old('work_mode') == 'remote' ? 'selected' : '' }}>Remote</option>
                                <option value="hybrid" {{ old('work_mode') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- SECTION 3: KRITERIA KANDIDAT -->
                <div class="form-section">
                    <h5 class="form-section-title">Kriteria Kandidat</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label required-label">Pengalaman</label>
                            <select name="experience" class="form-select" required>
                                <option value="">-- Pilih Pengalaman --</option>
                                <option value="belum_pengalaman" {{ old('experience') == 'belum_pengalaman' ? 'selected' : '' }}>Belum memiliki pengalaman</option>
                                <option value="fresh_graduate" {{ old('experience') == 'fresh_graduate' ? 'selected' : '' }}>Fresh Graduate</option>
                                <option value="kurang_setahun" {{ old('experience') == 'kurang_setahun' ? 'selected' : '' }}>Kurang dari setahun</option>
                                <option value="1-3_tahun" {{ old('experience') == '1-3_tahun' ? 'selected' : '' }}>1-3 Tahun</option>
                                <option value="3-5_tahun" {{ old('experience') == '3-5_tahun' ? 'selected' : '' }}>3-5 Tahun</option>
                                <option value="5-10_tahun" {{ old('experience') == '5-10_tahun' ? 'selected' : '' }}>5-10 Tahun</option>
                                <option value="lebih_10_tahun" {{ old('experience') == 'lebih_10_tahun' ? 'selected' : '' }}>Lebih dari 10 Tahun</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label required-label">Pendidikan</label>
                            <select name="education_level" class="form-select" required>
                                <option value="">-- Pilih Tingkat Pendidikan --</option>
                                <option value="sd" {{ old('education_level') == 'sd' ? 'selected' : '' }}>SD</option>
                                <option value="smp" {{ old('education_level') == 'smp' ? 'selected' : '' }}>SMP</option>
                                <option value="smk_sma" {{ old('education_level') == 'smk_sma' ? 'selected' : '' }}>SMK/SMA</option>
                                <option value="d1-d4" {{ old('education_level') == 'd1-d4' ? 'selected' : '' }}>D1 - D4</option>
                                <option value="s1" {{ old('education_level') == 's1' ? 'selected' : '' }}>S1</option>
                                <option value="s2" {{ old('education_level') == 's2' ? 'selected' : '' }}>S2</option>
                                <option value="s3" {{ old('education_level') == 's3' ? 'selected' : '' }}>S3</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Skills (pisahkan dengan koma)</label>
                            <input type="text" name="skills" class="form-control" placeholder="Laravel, React, UI/UX" value="{{ old('skills') }}">
                        </div>
                    </div>
                </div>

                <!-- SECTION 4: KOMPENSASI & LOKASI -->
                <div class="form-section">
                    <h5 class="form-section-title">Kompesasi & Lokasi</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" name="show_salary" value="1" id="showSalary" {{ old('show_salary') ? 'checked' : '' }}>
                                        <label class="form-check-label fw-bold" for="showSalary">
                                            Tampilkan Gaji?
                                        </label>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Gaji Minimum</label>
                                            <input type="number" name="salary_min" class="form-control" value="{{ old('salary_min') }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Gaji Maksimum</label>
                                            <input type="number" name="salary_max" class="form-control" value="{{ old('salary_max') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <label class="form-label fw-bold mb-3">Lokasi Kerja</label>
                                    
                                    <div class="row g-2">
                                        <div class="col-md-3 location-select">
                                            <label class="font-weight-normal small">Provinsi</label>
                                            <select id="provinsi" class="form-select form-select-sm" required>
                                                <option value="">-- Pilih Provinsi --</option>
                                                @foreach($provinces as $province)
                                                    <option value="{{ $province->id }}" 
                                                        {{ old('provinsi_id') == $province->id ? 'selected' : '' }}>
                                                        {{ $province->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3 location-select">
                                            <label class="font-weight-normal small">Kabupaten/Kota</label>
                                            <select id="kabupaten" class="form-select form-select-sm" disabled required>
                                                <option value="">-- Pilih Kabupaten --</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 location-select">
                                            <label class="font-weight-normal small">Kecamatan</label>
                                            <select id="kecamatan" class="form-select form-select-sm" disabled required>
                                                <option value="">-- Pilih Kecamatan --</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 location-select">
                                            <label class="font-weight-normal small">Desa/Kelurahan</label>
                                            <select id="desa" class="form-select form-select-sm" disabled>
                                                <option value="">-- Pilih Desa --</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <!-- Loading indicator -->
                                    <div id="loading-indicator" class="mt-2" style="display: none;">
                                        <div class="spinner-border spinner-border-sm text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        <small class="text-muted ms-2">Memuat data...</small>
                                    </div>

                                    <!-- Hidden fields untuk menyimpan ID wilayah -->
                                    <input type="hidden" name="provinsi_id" id="province_id" value="{{ old('provinsi_id') }}">
                                    <input type="hidden" name="kabupaten_id" id="regency_id" value="{{ old('kabupaten_id') }}">
                                    <input type="hidden" name="kecamatan_id" id="district_id" value="{{ old('kecamatan_id') }}">
                                    <input type="hidden" name="desa_id" id="village_id" value="{{ old('desa_id') }}">
                                    <input type="hidden" name="location" id="location" value="{{ old('location') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECTION 5: DESKRIPSI DETAIL -->
                <div class="form-section">
                    <h5 class="form-section-title">Deskripsi Detail</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Persyaratan</label>
                            <textarea name="requirements" class="form-control" rows="5" placeholder="Persyaratan yang harus dipenuhi">{{ old('requirements') }}</textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggung Jawab</label>
                            <textarea name="tanggung_jawab" class="form-control" rows="5" placeholder="Tanggung jawab pekerjaan">{{ old('tanggung_jawab') }}</textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kualifikasi</label>
                            <textarea name="kualifikasi" class="form-control" rows="5" placeholder="Kualifikasi yang diharapkan">{{ old('kualifikasi') }}</textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nilai Tambah</label>
                            <textarea name="nilai_tambah" class="form-control" rows="5" placeholder="Nilai tambah yang diutamakan">{{ old('nilai_tambah') }}</textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Deskripsi Pekerjaan</label>
                            <textarea name="description" class="form-control" rows="4" placeholder="Deskripsi umum tentang pekerjaan">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- SECTION 6: PUBLIKASI -->
                <div class="form-section">
                    <h5 class="form-section-title">Publikasi</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="is_public" value="1" id="isPublic" {{ old('is_public', true) ? 'checked' : '' }}>
                                        <label class="form-check-label fw-bold" for="isPublic">
                                            Publikasikan Lowongan
                                        </label>
                                        <small class="text-muted d-block">Jika tidak dicentang, lowongan akan tersimpan sebagai draft</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- BUTTONS -->
                <div class="form-section">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('companiesjobs.index') }}" class="btn btn-secondary px-4">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save"></i> Simpan Lowongan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle salary fields
            const salaryCheckbox = document.querySelector('input[name="show_salary"]');
            const salaryMin = document.querySelector('input[name="salary_min"]');
            const salaryMax = document.querySelector('input[name="salary_max"]');
            
            function toggleSalaryFields() {
                if (salaryCheckbox.checked) {
                    salaryMin.disabled = false;
                    salaryMax.disabled = false;
                } else {
                    salaryMin.disabled = true;
                    salaryMax.disabled = true;
                    salaryMin.value = '';
                    salaryMax.value = '';
                }
            }
            
            toggleSalaryFields();
            salaryCheckbox.addEventListener('change', toggleSalaryFields);

            // AJAX untuk dropdown wilayah
            const provinsiSelect = document.getElementById('provinsi');
            const kabupatenSelect = document.getElementById('kabupaten');
            const kecamatanSelect = document.getElementById('kecamatan');
            const desaSelect = document.getElementById('desa');
            
            // Hidden fields
            const provinceIdField = document.getElementById('province_id');
            const regencyIdField = document.getElementById('regency_id');
            const districtIdField = document.getElementById('district_id');
            const villageIdField = document.getElementById('village_id');
            const locationField = document.getElementById('location');
            
            // Loading indicator
            const loadingIndicator = document.getElementById('loading-indicator');

            function showLoading() {
                loadingIndicator.style.display = 'block';
            }

            function hideLoading() {
                loadingIndicator.style.display = 'none';
            }

            function updateLocationText() {
                const provinsi = provinsiSelect.options[provinsiSelect.selectedIndex]?.text || '';
                const kabupaten = kabupatenSelect.options[kabupatenSelect.selectedIndex]?.text || '';
                const kecamatan = kecamatanSelect.options[kecamatanSelect.selectedIndex]?.text || '';
                const desa = desaSelect.options[desaSelect.selectedIndex]?.text || '';
                
                const locationParts = [];
                if (desa) locationParts.push(desa);
                if (kecamatan) locationParts.push(kecamatan);
                if (kabupaten) locationParts.push(kabupaten);
                if (provinsi) locationParts.push(provinsi);
                
                locationField.value = locationParts.join(', ');
            }

            // PERBAIKAN: Gunakan URL yang benar sesuai rute di routes/web.php
            function loadRegencies(provinsiId) {
                if (provinsiId) {
                    showLoading();
                    kabupatenSelect.disabled = true;
                    kabupatenSelect.innerHTML = '<option value="">-- Pilih Kabupaten --</option>';
                    
                    // Update hidden field
                    provinceIdField.value = provinsiId;
                    
                    // PERBAIKAN: Gunakan URL yang benar
                    fetch(`/company/api/regencies/${provinsiId}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('Kabupaten data:', data); // Debug log
                            if (Array.isArray(data) && data.length > 0) {
                                data.forEach(regency => {
                                    const option = document.createElement('option');
                                    option.value = regency.id;
                                    option.textContent = regency.name;
                                    kabupatenSelect.appendChild(option);
                                });
                                kabupatenSelect.disabled = false;
                            } else {
                                kabupatenSelect.innerHTML = '<option value="">-- Tidak ada data --</option>';
                            }
                            hideLoading();
                            
                            // Reset child dropdowns
                            kecamatanSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
                            kecamatanSelect.disabled = true;
                            desaSelect.innerHTML = '<option value="">-- Pilih Desa --</option>';
                            desaSelect.disabled = true;
                            
                            // Clear hidden fields for child dropdowns
                            regencyIdField.value = '';
                            districtIdField.value = '';
                            villageIdField.value = '';
                            
                            updateLocationText();
                        })
                        .catch(error => {
                            console.error('Error loading regencies:', error);
                            hideLoading();
                            kabupatenSelect.innerHTML = '<option value="">-- Error loading data --</option>';
                        });
                } else {
                    kabupatenSelect.innerHTML = '<option value="">-- Pilih Kabupaten --</option>';
                    kabupatenSelect.disabled = true;
                    kecamatanSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
                    kecamatanSelect.disabled = true;
                    desaSelect.innerHTML = '<option value="">-- Pilih Desa --</option>';
                    desaSelect.disabled = true;
                    
                    // Clear all hidden fields
                    provinceIdField.value = '';
                    regencyIdField.value = '';
                    districtIdField.value = '';
                    villageIdField.value = '';
                    locationField.value = '';
                }
            }

            function loadDistricts(kabupatenId) {
                if (kabupatenId) {
                    showLoading();
                    kecamatanSelect.disabled = true;
                    kecamatanSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
                    
                    // Update hidden field
                    regencyIdField.value = kabupatenId;
                    
                    // PERBAIKAN: Gunakan URL yang benar
                    fetch(`/company/api/districts/${kabupatenId}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('Kecamatan data:', data); // Debug log
                            if (Array.isArray(data) && data.length > 0) {
                                data.forEach(district => {
                                    const option = document.createElement('option');
                                    option.value = district.id;
                                    option.textContent = district.name;
                                    kecamatanSelect.appendChild(option);
                                });
                                kecamatanSelect.disabled = false;
                            } else {
                                kecamatanSelect.innerHTML = '<option value="">-- Tidak ada data --</option>';
                            }
                            hideLoading();
                            
                            // Reset child dropdown
                            desaSelect.innerHTML = '<option value="">-- Pilih Desa --</option>';
                            desaSelect.disabled = true;
                            
                            // Clear hidden fields for child dropdowns
                            districtIdField.value = '';
                            villageIdField.value = '';
                            
                            updateLocationText();
                        })
                        .catch(error => {
                            console.error('Error loading districts:', error);
                            hideLoading();
                            kecamatanSelect.innerHTML = '<option value="">-- Error loading data --</option>';
                        });
                } else {
                    kecamatanSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
                    kecamatanSelect.disabled = true;
                    desaSelect.innerHTML = '<option value="">-- Pilih Desa --</option>';
                    desaSelect.disabled = true;
                    
                    // Clear child hidden fields
                    regencyIdField.value = '';
                    districtIdField.value = '';
                    villageIdField.value = '';
                    updateLocationText();
                }
            }

            function loadVillages(kecamatanId) {
                if (kecamatanId) {
                    showLoading();
                    desaSelect.disabled = true;
                    desaSelect.innerHTML = '<option value="">-- Pilih Desa --</option>';
                    
                    // Update hidden field
                    districtIdField.value = kecamatanId;
                    
                    // PERBAIKAN: Gunakan URL yang benar
                    fetch(`/company/api/villages/${kecamatanId}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('Desa data:', data); // Debug log
                            if (Array.isArray(data) && data.length > 0) {
                                data.forEach(village => {
                                    const option = document.createElement('option');
                                    option.value = village.id;
                                    option.textContent = village.name;
                                    desaSelect.appendChild(option);
                                });
                                desaSelect.disabled = false;
                            } else {
                                desaSelect.innerHTML = '<option value="">-- Tidak ada data --</option>';
                            }
                            hideLoading();
                            updateLocationText();
                        })
                        .catch(error => {
                            console.error('Error loading villages:', error);
                            hideLoading();
                            desaSelect.innerHTML = '<option value="">-- Error loading data --</option>';
                        });
                } else {
                    desaSelect.innerHTML = '<option value="">-- Pilih Desa --</option>';
                    desaSelect.disabled = true;
                    
                    // Clear hidden field
                    districtIdField.value = '';
                    villageIdField.value = '';
                    updateLocationText();
                }
            }

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // --- 1. Ambil Elemen DOM dan Input Tersembunyi ---
        const provinsiEl = document.getElementById('provinsi');
        const kabupatenEl = document.getElementById('kabupaten');
        const kecamatanEl = document.getElementById('kecamatan');
        const desaEl = document.getElementById('desa');

        const provinceIdInput = document.getElementById('province_id');
        const regencyIdInput = document.getElementById('regency_id');
        const districtIdInput = document.getElementById('district_id');
        const villageIdInput = document.getElementById('village_id'); // Digunakan di kedua versi, ambil yang ini.
        const locationInput = document.getElementById('location'); // Input untuk menyimpan teks lokasi lengkap (dari versi 50dfe0cb...)

        // Elemen untuk menampilkan teks lokasi (dari versi 50dfe0cb...)
        const locationDisplay = document.getElementById('location-display');
        const locationText = document.getElementById('location-text');

        // --- 2. Fungsi Pembantu ---

        function resetDropdowns(level) {
            // Mereset dropdown di bawah level saat ini
            if (level === 'provinsi') {
                kabupatenEl.innerHTML = '<option value="">-- Pilih Kabupaten --</option>'; kabupatenEl.disabled = true;
                kecamatanEl.innerHTML = '<option value="">-- Pilih Kecamatan --</option>'; kecamatanEl.disabled = true;
                desaEl.innerHTML = '<option value="">-- Pilih Desa --</option>'; desaEl.disabled = true;

                regencyIdInput.value = ''; districtIdInput.value = ''; villageIdInput.value = '';
            }
            if (level === 'kabupaten') {
                kecamatanEl.innerHTML = '<option value="">-- Pilih Kecamatan --</option>'; kecamatanEl.disabled = true;
                desaEl.innerHTML = '<option value="">-- Pilih Desa --</option>'; desaEl.disabled = true;

                districtIdInput.value = ''; villageIdInput.value = '';
            }
            if (level === 'kecamatan') {
                desaEl.innerHTML = '<option value="">-- Pilih Desa --</option>'; desaEl.disabled = true;
                villageIdInput.value = '';
            }
        }

        function updateLocationDisplay() {
            // Menggabungkan dan menampilkan teks lokasi lengkap (dari versi 50dfe0cb...)
            const provName = provinsiEl.options[provinsiEl.selectedIndex]?.text || '';
            const kabName = kabupatenEl.options[kabupatenEl.selectedIndex]?.text || '';
            const kecName = kecamatanEl.options[kecamatanEl.selectedIndex]?.text || '';
            const desaName = desaEl.options[desaEl.selectedIndex]?.text || '';

            const parts = [];
            // Urutan: Desa, Kecamatan, Kabupaten, Provinsi
            if (desaName && !desaName.includes('-- Pilih Desa --')) parts.unshift(desaName);
            if (kecName && !kecName.includes('-- Pilih Kecamatan --')) parts.unshift(kecName);
            if (kabName && !kabName.includes('-- Pilih Kabupaten --')) parts.unshift(kabName);
            if (provName && !provName.includes('-- Pilih Provinsi --')) parts.unshift(provName);

            if (parts.length > 0) {
                locationText.textContent = parts.join(', ');
                locationInput.value = parts.join(', ');
                locationDisplay.style.display = 'block';
            } else {
                locationDisplay.style.display = 'none';
                locationInput.value = '';
            }
        }

        async function fetchAndFill(url, selectEl, placeholderText, selectedValue = '') {
            // Mengambil data dan mengisi dropdown (diadopsi dari versi 50dfe0cb...)
            try {
                const res = await fetch(url);
                const data = await res.json();
                selectEl.innerHTML = `<option value="">${placeholderText}</option>`;
                data.forEach(item => {
                    const selected = item.id == selectedValue ? 'selected' : '';
                    selectEl.innerHTML += `<option value="${item.id}" ${selected}>${item.name}</option>`;
                });
                selectEl.disabled = false;
            } catch (err) {
                console.error('Error fetching data:', err);
            }
        }

        // --- 3. Event Listener (Diadopsi dari versi 50dfe0cb... dengan perbaikan log) ---

        provinsiEl.addEventListener('change', () => {
            const provId = provinsiEl.value;
            console.log('Provinsi changed:', provId); // Log dari HEAD
            provinceIdInput.value = provId;
            resetDropdowns('provinsi');
            if (provId) fetchAndFill(`/company/api/regencies/${provId}`, kabupatenEl, '-- Pilih Kabupaten --');
            updateLocationDisplay();
        });

        kabupatenEl.addEventListener('change', () => {
            const regId = kabupatenEl.value;
            console.log('Kabupaten changed:', regId); // Log dari HEAD
            regencyIdInput.value = regId;
            resetDropdowns('kabupaten');
            if (regId) fetchAndFill(`/company/api/districts/${regId}`, kecamatanEl, '-- Pilih Kecamatan --');
            updateLocationDisplay();
        });

        kecamatanEl.addEventListener('change', () => {
            const distId = kecamatanEl.value;
            console.log('Kecamatan changed:', distId); // Log dari HEAD
            districtIdInput.value = distId;
            resetDropdowns('kecamatan');
            if (distId) fetchAndFill(`/company/api/villages/${distId}`, desaEl, '-- Pilih Desa --');
            updateLocationDisplay();
        });

        desaEl.addEventListener('change', () => {
            const villId = desaEl.value;
            console.log('Desa changed:', villId); // Log dari HEAD
            villageIdInput.value = villId;
            updateLocationDisplay();
        });


        // --- 4. Pemuatan Ulang Nilai Lama (Saat Error Validasi) ---

        // Ambil nilai lama (menggunakan syntax Laravel Blade yang ada di HEAD)
        const oldProvinsiId = @json(old('provinsi_id', ''));
        const oldKabupatenId = @json(old('kabupaten_id', ''));
        const oldKecamatanId = @json(old('kecamatan_id', ''));
        const oldDesaId = @json(old('desa_id', ''));
        
        // Cek apakah ada nilai lama (jika form gagal validasi)
        if (oldProvinsiId) {
            console.log('Mendeteksi nilai lama:', {oldProvinsiId, oldKabupatenId, oldKecamatanId, oldDesaId});
            
            // Atur nilai pada input tersembunyi
            provinceIdInput.value = oldProvinsiId;
            regencyIdInput.value = oldKabupatenId;
            districtIdInput.value = oldKecamatanId;
            villageIdInput.value = oldDesaId;
            
            // Atur nilai pada dropdown provinsi
            provinsiEl.value = oldProvinsiId;

            // Panggil fungsi pemuatan data secara async/await (lebih baik dari setTimeout bertingkat)
            if (oldProvinsiId) {
                await fetchAndFill(`/company/api/regencies/${oldProvinsiId}`, kabupatenEl, '-- Pilih Kabupaten --', oldKabupatenId);
            }
            if (oldKabupatenId) {
                await fetchAndFill(`/company/api/districts/${oldKabupatenId}`, kecamatanEl, '-- Pilih Kecamatan --', oldKecamatanId);
            }
            if (oldKecamatanId) {
                await fetchAndFill(`/company/api/villages/${oldKecamatanId}`, desaEl, '-- Pilih Desa --', oldDesaId);
            }
        }
        
        // Panggil updateLocationDisplay di akhir (baik ada old value atau tidak)
        updateLocationDisplay();
    });
</script>
</body>
</html>