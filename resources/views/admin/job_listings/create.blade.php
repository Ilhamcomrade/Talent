@extends('admin.layout')

@section('content')

{{-- 1. Area Judul Form (Area Hijau) --}}
<div class="judul-form-area text-white p-3" style="background-color: #28a745;">
    <label class="form-label mb-0 fw-bold">Tambah Lowongan Baru</label>
</div>
{{-- Akhir Area Judul Form --}}

{{-- 2. Area Form Isian (Area Abu-abu Muda) --}}
<div class="form-isian-area p-4" style="background-color: #e9ecef;"> 

    {{-- Notifikasi error validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi Kesalahan!</strong>
            <ul>
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Bungkus semua field form dalam div abu-abu gelap --}}
    <div class="p-4 rounded shadow-sm" style="background-color: #cccccc;">
        <form action="{{ route('admin.job_listings.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Informasi Pengelola --}}
            {{-- <div class="mb-4 p-3 border rounded" style="background-color: #f8f9fa;">
                <label class="font-weight-bold text-dark mb-2">Informasi Pengelola</label>
                <div class="row"> --}}
                    <div class="col-md-12 mb-3">
                        <label class="font-weight: normal;">Loker ini dikelola oleh</label>
                        <select name="company_id" class="form-select" required>
                            <option value="">-- Pilih Pengelola --</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                    {{ $company->nama_lengkap }}
                                </option>
                            @endforeach
                        </select>
                        {{-- <small class="form-text text-muted">Pilih nama lengkap yang akan mengelola lowongan ini</small> --}}
                    </div>
                </div>
            </div>

            <div class="row">
                {{-- Judul dan Perusahaan --}}
                <div class="col-md-6 mb-3">
                    <label style="font-weight: normal;">Judul Lowongan</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="font-weight: normal;">Nama Perusahaan</label>
                    <input type="text" name="company" class="form-control" value="{{ old('company') }}" required>
                    {{-- <small class="form-text text-muted">Masukkan nama perusahaan tempat bekerja</small> --}}
                </div>
            </div>

            {{-- Logo dan Deadline --}}
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="font-weight: normal;">Logo Perusahaan</label>
                    <input type="file" name="company_logo" class="form-control" accept="image/*">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="font-weight: normal;">Deadline</label>
                    <input type="date" name="deadline" class="form-control" value="{{ old('deadline') }}">
                </div>
            </div>
            
            {{-- Lokasi (Dropdown Bertingkat) --}}
            <div class="mb-3 p-3 border rounded" style="background-color: #e0e0e0;">
                <label class="font-weight: normal;">Lokasi Kerja <span class="text-danger">*</span></label>
                
                {{-- Display selected location --}}
                <div class="alert alert-info py-2 mb-3" id="location-display" style="display: none;">
                    <small class="fw-bold">Lokasi terpilih:</small>
                    <span id="location-text">-</span>
                </div>

                <div class="row g-2">
                    <div class="col-md-3">
                        <label class="font-weight: normal;">Provinsi</label>
                        <select id="provinsi" class="form-select form-select-sm" required>
                            <option value="">-- Pilih Provinsi --</option>
                            @foreach ($provinces as $province)
                                <option value="{{ $province->id }}" 
                                    {{ old('provinsi_id') == $province->id ? 'selected' : '' }}>
                                    {{ $province->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="font-weight: normal;">Kabupaten/Kota</label>
                        <select id="kabupaten" class="form-select form-select-sm" disabled required>
                            <option value="">-- Pilih Kabupaten --</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="font-weight: normal;">Kecamatan</label>
                        <select id="kecamatan" class="form-select form-select-sm" disabled required>
                            <option value="">-- Pilih Kecamatan --</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="font-weight: normal;">Desa/Kelurahan</label>
                        <select id="desa" class="form-select form-select-sm" disabled>
                            <option value="">-- Pilih Desa --</option>
                        </select>
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
                <input type="hidden" name="provinsi_id" id="province_id" value="{{ old('provinsi_id') }}">
                <input type="hidden" name="kabupaten_id" id="regency_id" value="{{ old('kabupaten_id') }}">
                <input type="hidden" name="kecamatan_id" id="district_id" value="{{ old('kecamatan_id') }}">
                <input type="hidden" name="desa_id" id="village_id" value="{{ old('desa_id') }}">
                <input type="hidden" name="location" id="location" value="{{ old('location') }}">
            </div>

            {{-- Gaji --}}
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="font-weight: normal;">Gaji Minimum</label>
                    <input type="number" name="salary_min" class="form-control" value="{{ old('salary_min') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="font-weight: normal;">Gaji Maksimum</label>
                    <input type="number" name="salary_max" class="form-control" value="{{ old('salary_max') }}">
                </div>
            </div>

            <div class="row">
                {{-- Type --}}
                <div class="col-md-4 mb-3">
                    <label class="font-weight: normal;">Tipe </label>
                    <select name="type" class="form-select" required>
                        <option value="">-- Pilih Tipe --</option>
                        <option value="full-time" {{ old('type') == 'full-time' ? 'selected' : '' }}>Full-Time</option>
                        <option value="part-time" {{ old('type') == 'part-time' ? 'selected' : '' }}>Part-Time</option>
                        <option value="contract" {{ old('type') == 'contract' ? 'selected' : '' }}>Contract</option>
                        <option value="internship" {{ old('type') == 'internship' ? 'selected' : '' }}>Internship</option>
                    </select>
                </div>
                {{-- Jenis Pekerjaan --}}
                <div class="col-md-4 mb-3">
                    <label class="font-weight: normal;">Jenis Pekerjaan</label>
                    <select name="job_type" class="form-select" required>
                        <option value="">-- Pilih Jenis --</option>
                        <option value="penuh_waktu" {{ old('job_type') == 'penuh_waktu' ? 'selected' : '' }}>Penuh Waktu</option>
                        <option value="paruh_waktu" {{ old('job_type') == 'paruh_waktu' ? 'selected' : '' }}>Paruh Waktu</option>
                        <option value="kontrak" {{ old('job_type') == 'kontrak' ? 'selected' : '' }}>Kontrak</option>
                        <option value="magang" {{ old('job_type') == 'magang' ? 'selected' : '' }}>Magang</option>
                        <option value="freelance" {{ old('job_type') == 'freelance' ? 'selected' : '' }}>Freelance</option>
                        <option value="harian" {{ old('job_type') == 'harian' ? 'selected' : '' }}>Harian</option>
                    </select>
                </div>
                {{-- Kebijakan Kerja --}}
                <div class="col-md-4 mb-3">
                    <label class="font-weight: normal;">Kebijakan Kerja</label>
                    <select name="work_policy" class="form-select" required>
                        <option value="">-- Pilih Kebijakan --</option>
                        <option value="kerja_di_kantor" {{ old('work_policy') == 'kerja_di_kantor' ? 'selected' : '' }}>Kerja di Kantor</option>
                        <option value="hybrid" {{ old('work_policy') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                        <option value="remote" {{ old('work_policy') == 'remote' ? 'selected' : '' }}>Remote</option>
                    </select>
                </div>
            </div>

            <div class="row">
                {{-- Level Pengalaman --}}
                <div class="col-md-6 mb-3">
                    <label class="font-weight: normal;">Level Pengalaman</label>
                    <select name="experience_level" class="form-select" required>
                        <option value="">-- Pilih Level --</option>
                        <option value="tidak_berpengalaman" {{ old('experience_level') == 'tidak_berpengalaman' ? 'selected' : '' }}>Tidak Berpengalaman</option>
                        <option value="fresh_graduate" {{ old('experience_level') == 'fresh_graduate' ? 'selected' : '' }}>Fresh Graduate</option>
                        <option value="kurang_dari_setahun" {{ old('experience_level') == 'kurang_dari_setahun' ? 'selected' : '' }}>Kurang dari Setahun</option>
                        <option value="1_3_tahun" {{ old('experience_level') == '1_3_tahun' ? 'selected' : '' }}>1–3 Tahun</option>
                        <option value="3_5_tahun" {{ old('experience_level') == '3_5_tahun' ? 'selected' : '' }}>3–5 Tahun</option>
                        <option value="5_10_tahun" {{ old('experience_level') == '5_10_tahun' ? 'selected' : '' }}>5–10 Tahun</option>
                        <option value="lebih_dari_10_tahun" {{ old('experience_level') == 'lebih_dari_10_tahun' ? 'selected' : '' }}>Lebih dari 10 Tahun</option>
                    </select>
                </div>
                {{-- Pendidikan Minimal --}}
                <div class="col-md-6 mb-3">
                    <label class="font-weight: normal;">Pendidikan Minimal</label>
                    <select name="education_level" class="form-select" required>
                        <option value="">-- Pilih Pendidikan --</option>
                        <option value="s3" {{ old('education_level') == 's3' ? 'selected' : '' }}>S3</option>
                        <option value="s2" {{ old('education_level') == 's2' ? 'selected' : '' }}>S2</option>
                        <option value="s1" {{ old('education_level') == 's1' ? 'selected' : '' }}>S1</option>
                        <option value="d1_d4" {{ old('education_level') == 'd1_d4' ? 'selected' : '' }}>D1–D4</option>
                        <option value="sma_smk" {{ old('education_level') == 'sma_smk' ? 'selected' : '' }}>SMA/SMK</option>
                        <option value="smp" {{ old('education_level') == 'smp' ? 'selected' : '' }}>SMP</option>
                        <option value="sd" {{ old('education_level') == 'sd' ? 'selected' : '' }}>SD</option>
                    </select>
                </div>
            </div>

            {{-- Deskripsi --}}
            <div class="mb-3">
                <label class="font-weight: normal;">Deskripsi Pekerjaan</label>
                <textarea name="description" class="form-control" rows="5">{{ old('description') }}</textarea>
            </div>
            
            {{-- Persyaratan --}}
            <div class="mb-3">
                <label class="font-weight: normal;">Persyaratan</label>
                <textarea name="requirements" class="form-control" rows="3">{{ old('requirements') }}</textarea>
            </div>

            {{-- Keahlian --}}
            <div class="mb-3">
                <label class="font-weight: normal;">Keahlian yang Dibutuhkan</label>
                <textarea name="skills" class="form-control" rows="3">{{ old('skills') }}</textarea>
            </div>

            {{-- Kualifikasi Tambahan (CKEditor) --}}
            <div class="mb-3">
                <label class="font-weight: normal;">Kualifikasi Tambahan</label>
                <textarea name="qualifications" id="qualifications" class="form-control" rows="3">{{ old('qualifications') }}</textarea>
                <small class="form-text text-muted">Gunakan editor untuk format teks yang lebih baik</small>
            </div>

            {{-- Status --}}
            <div class="mb-5">
                <label for="is_public" class="font-weight: normal;">Status</label>
                @php
                    $statusValue = old('is_public', '0'); 
                @endphp
                <select name="is_public" id="is_public" class="form-select" required>
                    <option value="1" {{ $statusValue == '1' ? 'selected' : '' }}>
                        Publish
                    </option>
                    <option value="0" {{ $statusValue == '0' ? 'selected' : '' }}>
                        Draft
                    </option>
                </select>
            </div>

            {{-- Tombol Simpan dan Batal --}}
            <div class="d-flex justify-content-end pt-3">
                <a href="{{ route('admin.job_listings.index') }}" class="btn text-white me-3" style="background-color: #343a40; border-radius: 20px; min-width: 100px;">
                    Batal
                </a>
                <button type="submit" class="btn text-white" style="background-color: #2724e4; border-radius: 20px; min-width: 100px;">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
{{-- Akhir Area Form Isian --}}

{{-- Include CKEditor --}}
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

{{-- Script Dropdown Lokasi dengan AJAX --}}
<script>
    // Inisialisasi CKEditor untuk kualifikasi
    CKEDITOR.replace('qualifications', {
        toolbar: [
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Blockquote'] },
            { name: 'links', items: ['Link', 'Unlink'] },
            { name: 'tools', items: ['Maximize', 'Source'] }
        ],
        height: 200,
        removeButtons: 'Subscript,Superscript',
        format_tags: 'p;h1;h2;h3;pre',
        removeDialogTabs: 'image:advanced;link:advanced'
    });

    const provinsiEl = document.getElementById('provinsi');
    const kabupatenEl = document.getElementById('kabupaten');
    const kecamatanEl = document.getElementById('kecamatan');
    const desaEl = document.getElementById('desa');
    const provinceIdInput = document.getElementById('province_id');
    const regencyIdInput = document.getElementById('regency_id');
    const districtIdInput = document.getElementById('district_id');
    const villageIdInput = document.getElementById('village_id');
    const locationInput = document.getElementById('location');
    const locationDisplay = document.getElementById('location-display');
    const locationText = document.getElementById('location-text');
    const loadingIndicator = document.getElementById('loading-indicator');

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
                const selected = (
                    (level === 'Kabupaten/Kota' && item.id == "{{ old('regency_id') }}") ||
                    (level === 'Kecamatan' && item.id == "{{ old('district_id') }}") ||
                    (level === 'Desa/Kelurahan' && item.id == "{{ old('village_id') }}")
                ) ? 'selected' : '';

                targetElement.innerHTML += `<option value="${item.id}" ${selected}>${item.name}</option>`;
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
            locationInput.value = fullLocation;
            locationDisplay.style.display = 'block';
        } else {
            locationDisplay.style.display = 'none';
            locationInput.value = '';
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

    // Initialize form jika ada data old
    document.addEventListener('DOMContentLoaded', function() {
        const loadOldData = async () => {
            const oldProvinceId = "{{ old('province_id') }}";
            const oldRegencyId = "{{ old('regency_id') }}";
            const oldDistrictId = "{{ old('district_id') }}";
            const oldVillageId = "{{ old('village_id') }}";

            if (oldProvinceId) {
                await loadWilayah(`/admin/api/regencies/${oldProvinceId}`, kabupatenEl, 'Kabupaten/Kota');
                
                if (oldRegencyId) {
                    kabupatenEl.value = oldRegencyId;
                    
                    await loadWilayah(`/admin/api/districts/${oldRegencyId}`, kecamatanEl, 'Kecamatan');
                    
                    if (oldDistrictId) {
                        kecamatanEl.value = oldDistrictId;
                        
                        await loadWilayah(`/admin/api/villages/${oldDistrictId}`, desaEl, 'Desa/Kelurahan');
                        
                        if (oldVillageId) {
                            desaEl.value = oldVillageId;
                        }
                    }
                }
            }

            updateLocationDisplay();
        };

        loadOldData();
    });
</script>

<style>
    .form-label {
        font-weight: 600;
    }
    .form-text {
        font-size: 0.75rem;
    }
    
    #location-display {
        background-color: #f8f9fa;
        border-left: 4px solid #0d6efd;
    }
    
    /* Styling untuk CKEditor */
    .cke_chrome {
        border: 1px solid #ced4da !important;
        border-radius: 0.375rem !important;
    }
</style>
@endsection