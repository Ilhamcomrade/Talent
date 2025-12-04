@extends('admin.layout')

@section('content')

{{-- 1. Area Judul Form (Area Hijau) --}}
<div class="judul-form-area text-white p-3" style="background-color: #28a745;">
    <h4 class="mb-0 fw-bold">Edit Lowongan: {{ $jobListing->title }}</h4>
</div>
{{-- Akhir Area Judul Form --}}

{{-- 2. Area Form Isian (Area Abu-abu Muda) --}}
<div class="form-isian-area p-4" style="background-color: #e9ecef;">

    {{-- Notifikasi Error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi Kesalahan!</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Bungkus semua field form dalam div abu-abu gelap --}}
    <div class="p-4 rounded shadow-sm" style="background-color: #cccccc;">
        <form id="editForm" action="{{ route('admin.job_listings.update', $jobListing->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-3">
                {{-- Judul & Perusahaan --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Judul Lowongan <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $jobListing->title) }}" required>
                </div>
                <div class="col-md-6 mb-3">
    <label class="form-label">Pilih Perusahaan <span class="text-danger">*</span></label>
    <select name="company_id" class="form-select" required>
        <option value="">-- Pilih Perusahaan --</option>
        @foreach ($companies as $company)
            <option value="{{ $company->id }}" 
                {{ old('company_id', $jobListing->company_id) == $company->id ? 'selected' : '' }}>
                {{ $company->nama_lengkap }}
            </option>
        @endforeach
    </select>
</div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Perusahaan <span class="text-danger">*</span></label>
                    <input type="text" name="company" class="form-control" value="{{ old('company', $jobListing->company) }}" required>
                </div>

                {{-- Logo --}}
                <div class="col-12 mb-3">
                    <label class="form-label">Logo Perusahaan</label>
                    @if ($jobListing->company_logo)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $jobListing->company_logo) }}" alt="Logo" class="img-thumbnail" style="max-width: 120px;">
                            <div class="form-text">
                                <small>Logo saat ini. Kosongkan jika tidak ingin mengubah.</small>
                            </div>
                        </div>
                    @endif
                    <input type="file" name="company_logo" class="form-control" accept="image/jpg,image/jpeg,image/png">
                    <div class="form-text">
                        <small>Format: JPG, JPEG, PNG. Maksimal 2MB.</small>
                    </div>
                </div>

                {{-- Lokasi bertingkat --}}
                <div class="col-12 mb-3">
                    <label class="form-label fw-bold">Lokasi Kerja <span class="text-danger">*</span></label>
                    
                    {{-- Display selected location --}}
                    <div class="alert alert-info py-2 mb-3" id="location-display">
                        <small class="fw-bold">Lokasi terpilih:</small>
                        <span id="location-text">
                            @if($jobListing->province || $jobListing->regency || $jobListing->district)
                                {{ $jobListing->full_location }}
                            @else
                                -
                            @endif
                        </span>
                    </div>

                    <div class="row g-2">
                        <div class="col-md-3">
                            <label class="form-label small">Provinsi <span class="text-danger">*</span></label>
                            <select id="provinsi" class="form-select form-select-sm" required>
                                <option value="">-- Pilih Provinsi --</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}" 
                                        {{ old('provinsi_id', $jobListing->provinsi_id) == $province->id ? 'selected' : '' }}>
                                        {{ $province->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="form-text small">Pilih provinsi terlebih dahulu</div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small">Kabupaten/Kota <span class="text-danger">*</span></label>
                            <select id="kabupaten" class="form-select form-select-sm" {{ !$regencies->count() ? 'disabled' : '' }} required>
                                <option value="">-- Pilih Kabupaten --</option>
                                @if(isset($regencies) && $regencies->count() > 0)
                                    @foreach($regencies as $regency)
                                        <option value="{{ $regency->id }}" 
                                            {{ old('kabupaten_id', $jobListing->kabupaten_id) == $regency->id ? 'selected' : '' }}>
                                            {{ $regency->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <div class="form-text small">Pilih kabupaten/kota</div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small">Kecamatan <span class="text-danger">*</span></label>
                            <select id="kecamatan" class="form-select form-select-sm" {{ !$districts->count() ? 'disabled' : '' }} required>
                                <option value="">-- Pilih Kecamatan --</option>
                                @if(isset($districts) && $districts->count() > 0)
                                    @foreach($districts as $district)
                                        <option value="{{ $district->id }}" 
                                            {{ old('kecamatan_id', $jobListing->kecamatan_id) == $district->id ? 'selected' : '' }}>
                                            {{ $district->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <div class="form-text small">Pilih kecamatan</div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small">Desa/Kelurahan</label>
                            <select id="desa" class="form-select form-select-sm" {{ !$villages->count() ? 'disabled' : '' }}>
                                <option value="">-- Pilih Desa --</option>
                                @if(isset($villages) && $villages->count() > 0)
                                    @foreach($villages as $village)
                                        <option value="{{ $village->id }}" 
                                            {{ old('desa_id', $jobListing->desa_id) == $village->id ? 'selected' : '' }}>
                                            {{ $village->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <div class="form-text small">Pilih desa/kelurahan (opsional)</div>
                        </div>
                    </div>
                    
                    {{-- Loading indicator --}}
                    <div id="loading-indicator" class="mt-2" style="display: none;">
                        <div class="spinner-border spinner-border-sm text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <small class="text-muted ms-2">Memuat data...</small>
                    </div>

                    {{-- Hidden fields untuk menyimpan ID wilayah --}}
                    <input type="hidden" name="provinsi_id" id="province_id" value="{{ old('provinsi_id', $jobListing->provinsi_id) }}">
                    <input type="hidden" name="kabupaten_id" id="regency_id" value="{{ old('kabupaten_id', $jobListing->kabupaten_id) }}">
                    <input type="hidden" name="kecamatan_id" id="district_id" value="{{ old('kecamatan_id', $jobListing->kecamatan_id) }}">
                    <input type="hidden" name="desa_id" id="village_id" value="{{ old('desa_id', $jobListing->desa_id) }}">
                </div>

                {{-- Gaji --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Gaji Minimum (Rp)</label>
                    <input type="number" name="salary_min" class="form-control" 
                           value="{{ old('salary_min', $jobListing->salary_min) }}" 
                           placeholder="Contoh: 5000000">
                    <div class="form-text">
                        <small>Isi angka tanpa titik/koma</small>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Gaji Maksimum (Rp)</label>
                    <input type="number" name="salary_max" class="form-control" 
                           value="{{ old('salary_max', $jobListing->salary_max) }}" 
                           placeholder="Contoh: 10000000">
                    <div class="form-text">
                        <small>Isi angka tanpa titik/koma</small>
                    </div>
                </div>

                {{-- job_type & type --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Jenis Pekerjaan (job_type) <span class="text-danger">*</span></label>
                    <select name="job_type" class="form-select" required>
                        <option value="">-- Pilih Jenis --</option>
                        <option value="penuh_waktu" {{ old('job_type', $jobListing->job_type) == 'penuh_waktu' ? 'selected' : '' }}>Penuh Waktu</option>
                        <option value="paruh_waktu" {{ old('job_type', $jobListing->job_type) == 'paruh_waktu' ? 'selected' : '' }}>Paruh Waktu</option>
                        <option value="kontrak" {{ old('job_type', $jobListing->job_type) == 'kontrak' ? 'selected' : '' }}>Kontrak</option>
                        <option value="magang" {{ old('job_type', $jobListing->job_type) == 'magang' ? 'selected' : '' }}>Magang</option>
                        <option value="freelance" {{ old('job_type', $jobListing->job_type) == 'freelance' ? 'selected' : '' }}>Freelance</option>
                        <option value="harian" {{ old('job_type', $jobListing->job_type) == 'harian' ? 'selected' : '' }}>Harian</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Tipe Sistem (type) <span class="text-danger">*</span></label>
                    <select name="type" class="form-select" required>
                        <option value="full-time" {{ old('type', $jobListing->type) == 'full-time' ? 'selected' : '' }}>Full-Time</option>
                        <option value="part-time" {{ old('type', $jobListing->type) == 'part-time' ? 'selected' : '' }}>Part-Time</option>
                        <option value="contract" {{ old('type', $jobListing->type) == 'contract' ? 'selected' : '' }}>Contract</option>
                        <option value="internship" {{ old('type', $jobListing->type) == 'internship' ? 'selected' : '' }}>Internship</option>
                    </select>
                </div>

                {{-- work_policy, experience_level, education_level --}}
                <div class="col-md-4 mb-3">
                    <label class="form-label">Kebijakan Kerja (work_policy) <span class="text-danger">*</span></label>
                    <select name="work_policy" class="form-select" required>
                        <option value="kerja_di_kantor" {{ old('work_policy', $jobListing->work_policy) == 'kerja_di_kantor' ? 'selected' : '' }}>Kerja di Kantor</option>
                        <option value="hybrid" {{ old('work_policy', $jobListing->work_policy) == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                        <option value="remote" {{ old('work_policy', $jobListing->work_policy) == 'remote' ? 'selected' : '' }}>Remote</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Level Pengalaman (experience_level) <span class="text-danger">*</span></label>
                    <select name="experience_level" class="form-select" required>
                        <option value="tidak_berpengalaman" {{ old('experience_level', $jobListing->experience_level) == 'tidak_berpengalaman' ? 'selected' : '' }}>Tidak Berpengalaman</option>
                        <option value="fresh_graduate" {{ old('experience_level', $jobListing->experience_level) == 'fresh_graduate' ? 'selected' : '' }}>Fresh Graduate</option>
                        <option value="kurang_dari_setahun" {{ old('experience_level', $jobListing->experience_level) == 'kurang_dari_setahun' ? 'selected' : '' }}>Kurang dari Setahun</option>
                        <option value="1_3_tahun" {{ old('experience_level', $jobListing->experience_level) == '1_3_tahun' ? 'selected' : '' }}>1-3 Tahun</option>
                        <option value="3_5_tahun" {{ old('experience_level', $jobListing->experience_level) == '3_5_tahun' ? 'selected' : '' }}>3-5 Tahun</option>
                        <option value="5_10_tahun" {{ old('experience_level', $jobListing->experience_level) == '5_10_tahun' ? 'selected' : '' }}>5-10 Tahun</option>
                        <option value="lebih_dari_10_tahun" {{ old('experience_level', $jobListing->experience_level) == 'lebih_dari_10_tahun' ? 'selected' : '' }}>Lebih dari 10 Tahun</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Tingkat Pendidikan (education_level) <span class="text-danger">*</span></label>
                    <select name="education_level" class="form-select" required>
                        <option value="s3" {{ old('education_level', $jobListing->education_level) == 's3' ? 'selected' : '' }}>S3</option>
                        <option value="s2" {{ old('education_level', $jobListing->education_level) == 's2' ? 'selected' : '' }}>S2</option>
                        <option value="s1" {{ old('education_level', $jobListing->education_level) == 's1' ? 'selected' : '' }}>S1</option>
                        <option value="d1_d4" {{ old('education_level', $jobListing->education_level) == 'd1_d4' ? 'selected' : '' }}>D1-D4</option>
                        <option value="sma_smk" {{ old('education_level', $jobListing->education_level) == 'sma_smk' ? 'selected' : '' }}>SMA/SMK</option>
                        <option value="smp" {{ old('education_level', $jobListing->education_level) == 'smp' ? 'selected' : '' }}>SMP</option>
                        <option value="sd" {{ old('education_level', $jobListing->education_level) == 'sd' ? 'selected' : '' }}>SD</option>
                    </select>
                </div>

                {{-- Deskripsi/qualifications/skills/requirements --}}
                <div class="col-12 mb-3">
                    <label class="form-label">Deskripsi Pekerjaan</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Jelaskan tentang pekerjaan, tanggung jawab, dan lingkungan kerja...">{{ old('description', $jobListing->description) }}</textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Kualifikasi</label>
                    <textarea name="qualifications" class="form-control" rows="3" placeholder="Kualifikasi yang dibutuhkan...">{{ old('qualifications', $jobListing->qualifications) }}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Keterampilan (skills)</label>
                    <textarea name="skills" class="form-control" rows="3" placeholder="Keterampilan yang diperlukan...">{{ old('skills', $jobListing->skills) }}</textarea>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label">Persyaratan Lainnya</label>
                    <textarea name="requirements" class="form-control" rows="3" placeholder="Persyaratan tambahan...">{{ old('requirements', $jobListing->requirements) }}</textarea>
                </div>

                {{-- Deadline & Status --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Batas Lamaran</label>
                    <input type="date" name="deadline" value="{{ old('deadline', optional($jobListing->deadline)->format('Y-m-d')) }}" class="form-control">
                    <div class="form-text">
                        <small>Kosongkan jika tidak ada batas waktu</small>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="is_public" class="form-select" required>
                        <option value="1" {{ old('is_public', $jobListing->is_public) == 1 ? 'selected' : '' }}>Published</option>
                        <option value="0" {{ old('is_public', $jobListing->is_public) == 0 ? 'selected' : '' }}>Draft</option>
                    </select>
                    <div class="form-text">
                        <strong>Published:</strong> Lowongan dapat dilihat publik | 
                        <strong>Draft:</strong> Hanya dapat dilihat di admin
                    </div>
                </div>
            </div>

            {{-- Tombol Simpan dan Batal (Area tombol abu-abu tua berbentuk oval) --}}
            <div class="d-flex justify-content-end pt-3">
                <a href="{{ route('admin.job_listings.index') }}" class="btn text-white me-3" style="background-color: #343a40; border-radius: 20px; min-width: 100px;">
                    Batal
                </a>
                <button type="submit" class="btn text-white" style="background-color: #1641ce; border-radius: 20px; min-width: 100px;">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
{{-- Akhir Area Form Isian --}}

{{-- Script Dropdown Lokasi dengan AJAX --}}
<script>
    const provinsiEl = document.getElementById('provinsi');
    const kabupatenEl = document.getElementById('kabupaten');
    const kecamatanEl = document.getElementById('kecamatan');
    const desaEl = document.getElementById('desa');
    const provinceIdInput = document.getElementById('province_id');
    const regencyIdInput = document.getElementById('regency_id');
    const districtIdInput = document.getElementById('district_id');
    const villageIdInput = document.getElementById('village_id');
    const locationDisplay = document.getElementById('location-display');
    const locationText = document.getElementById('location-text');
    const loadingIndicator = document.getElementById('loading-indicator');
    const formEl = document.getElementById('editForm');

    // Reset dropdown dependen
    function resetDependentDropdowns(level) {
        if (level === 'provinsi') {
            kabupatenEl.innerHTML = '<option value="">-- Pilih Kabupaten --</option>';
            kecamatanEl.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
            desaEl.innerHTML = '<option value="">-- Pilih Desa --</option>';
            kabupatenEl.disabled = true;
            kecamatanEl.disabled = true;
            desaEl.disabled = true;
            
            regencyIdInput.value = '';
            districtIdInput.value = '';
            villageIdInput.value = '';
        } else if (level === 'kabupaten') {
            kecamatanEl.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
            desaEl.innerHTML = '<option value="">-- Pilih Desa --</option>';
            kecamatanEl.disabled = true;
            desaEl.disabled = true;
            
            districtIdInput.value = '';
            villageIdInput.value = '';
        } else if (level === 'kecamatan') {
            desaEl.innerHTML = '<option value="">-- Pilih Desa --</option>';
            desaEl.disabled = true;
            villageIdInput.value = '';
        }
    }

    // Tampilkan loading
    function showLoading() {
        loadingIndicator.style.display = 'block';
    }

    // Sembunyikan loading
    function hideLoading() {
        loadingIndicator.style.display = 'none';
    }

    // Load data via AJAX
    async function loadWilayah(url, targetElement, level) {
        showLoading();
        try {
            const response = await fetch(url);
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const data = await response.json();
            
            targetElement.innerHTML = `<option value="">-- Pilih ${level} --</option>`;
            data.forEach(item => {
                targetElement.innerHTML += `<option value="${item.id}">${item.name}</option>`;
            });
            targetElement.disabled = false;
        } catch (error) {
            console.error('Error loading wilayah:', error);
            targetElement.innerHTML = `<option value="">-- Error loading data --</option>`;
        } finally {
            hideLoading();
        }
    }

    // Update lokasi yang dipilih
    function updateLocationDisplay() {
        const provName = provinsiEl.options[provinsiEl.selectedIndex]?.text || '';
        const kabName = kabupatenEl.options[kabupatenEl.selectedIndex]?.text || '';
        const kecName = kecamatanEl.options[kecamatanEl.selectedIndex]?.text || '';
        const desaName = desaEl.options[desaEl.selectedIndex]?.text || '';
        
        const selectedParts = [];
        if (desaName && desaName !== '-- Pilih Desa --') selectedParts.unshift(desaName);
        if (kecName && kecName !== '-- Pilih Kecamatan --') selectedParts.unshift(kecName);
        if (kabName && kabName !== '-- Pilih Kabupaten --') selectedParts.unshift(kabName);
        if (provName && provName !== '-- Pilih Provinsi --') selectedParts.unshift(provName);
        
        if (selectedParts.length > 0) {
            const fullLocation = selectedParts.join(', ');
            locationText.textContent = fullLocation;
            locationDisplay.style.display = 'block';
        } else {
            locationDisplay.style.display = 'none';
        }
    }

    // Event listeners
    provinsiEl.addEventListener('change', function () {
        const provinceId = this.value;
        provinceIdInput.value = provinceId;
        resetDependentDropdowns('provinsi');
        
        if (provinceId) {
            loadWilayah(`/admin/api/regencies/${provinceId}`, kabupatenEl, 'Kabupaten/Kota');
        }
        updateLocationDisplay();
    });

    kabupatenEl.addEventListener('change', function () {
        const regencyId = this.value;
        regencyIdInput.value = regencyId;
        resetDependentDropdowns('kabupaten');
        
        if (regencyId) {
            loadWilayah(`/admin/api/districts/${regencyId}`, kecamatanEl, 'Kecamatan');
        }
        updateLocationDisplay();
    });

    kecamatanEl.addEventListener('change', function () {
        const districtId = this.value;
        districtIdInput.value = districtId;
        resetDependentDropdowns('kecamatan');
        
        if (districtId) {
            loadWilayah(`/admin/api/villages/${districtId}`, desaEl, 'Desa/Kelurahan');
        }
        updateLocationDisplay();
    });

    desaEl.addEventListener('change', function () {
        const villageId = this.value;
        villageIdInput.value = villageId;
        updateLocationDisplay();
    });

    // Initialize form dengan data yang sudah ada
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-load data via AJAX jika diperlukan
        const existingProvinceId = "{{ $jobListing->provinsi_id }}";
        const existingRegencyId = "{{ $jobListing->kabupaten_id }}";
        const existingDistrictId = "{{ $jobListing->kecamatan_id }}";

        // Jika ada provinsi yang dipilih tapi kabupaten belum terisi, load via AJAX
        if (existingProvinceId && kabupatenEl.options.length <= 1) {
            loadWilayah(`/admin/api/regencies/${existingProvinceId}`, kabupatenEl, 'Kabupaten/Kota')
                .then(() => {
                    if (existingRegencyId) {
                        kabupatenEl.value = existingRegencyId;
                        // Load kecamatan
                        return loadWilayah(`/admin/api/districts/${existingRegencyId}`, kecamatanEl, 'Kecamatan');
                    }
                })
                .then(() => {
                    if (existingDistrictId) {
                        kecamatanEl.value = existingDistrictId;
                        // Load desa
                        return loadWilayah(`/admin/api/villages/${existingDistrictId}`, desaEl, 'Desa/Kelurahan');
                    }
                })
                .then(() => {
                    if ("{{ $jobListing->desa_id }}") {
                        desaEl.value = "{{ $jobListing->desa_id }}";
                    }
                    updateLocationDisplay();
                });
        } else {
            updateLocationDisplay();
        }
    });

    // Validasi sebelum submit
    formEl.addEventListener('submit', function (e) {
        updateLocationDisplay();
        if (!provinsiEl.value || !kabupatenEl.value || !kecamatanEl.value) {
            e.preventDefault();
            alert('Silakan pilih lokasi lengkap (minimal Provinsi, Kabupaten, dan Kecamatan) sebelum menyimpan.');
            if (!provinsiEl.value) provinsiEl.focus();
            else if (!kabupatenEl.value) kabupatenEl.focus();
            else if (!kecamatanEl.value) kecamatanEl.focus();
            return false;
        }
    });
</script>

<style>
    .form-label {
        font-weight: 600;
    }
    
    .form-label small {
        font-size: 0.875rem;
        font-weight: 500;
    }
    
    .form-text {
        font-size: 0.75rem;
    }
    
    #location-display {
        background-color: #f8f9fa;
        border-left: 4px solid #0d6efd;
    }
</style>
@endsection