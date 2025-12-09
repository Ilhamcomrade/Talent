@extends('admin.layout')

@section('title', 'Tambah Provinsi')
@section('content')

<div class="judul-form-area text-white p-3" style="background-color: #28a745;">
    <label class="form-label mb-0 fw-bold">Tambah Provinsi</label>
</div>

<div class="form-isian-area p-4" style="background-color: #e9ecef;">
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

    <div class="p-4 rounded shadow-sm" style="background-color: #cccccc;">
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Form Tambah Provinsi</h5>
            <a href="{{ route('admin.reference.provinsi.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <form action="{{ route('admin.reference.provinsi.store') }}" method="POST">
            @csrf
            
            <!-- Dropdown Cascade Lokasi -->
            <div class="mb-3 p-3 border rounded" style="background-color: #e0e0e0;">
                <label class="font-weight: normal;">Lokasi <span class="text-danger">*</span></label>
                
                <div class="row g-2 mt-2">
                    <div class="col-md-3">
                        <label class="font-weight: normal;">Provinsi</label>
                        <select id="provinsi" class="form-select form-select-sm" required>
                            <option value="">-- Pilih Provinsi --</option>
                            @foreach ($provinces as $prov)
                                <option value="{{ $prov->id }}" {{ old('province_id') == $prov->id ? 'selected' : '' }}>
                                    {{ $prov->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="font-weight: normal;">Kabupaten/Kota</label>
                        <select id="kabupaten" class="form-select form-select-sm" disabled>
                            <option value="">-- Pilih Kabupaten --</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="font-weight: normal;">Kecamatan</label>
                        <select id="kecamatan" class="form-select form-select-sm" disabled>
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
                
                <div id="loading-indicator" class="mt-2" style="display: none;">
                    <div class="spinner-border spinner-border-sm text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <small class="text-muted ms-2">Memuat data...</small>
                </div>
                
                <input type="hidden" name="province_id" id="province_id" value="{{ old('province_id') }}">
                <input type="hidden" name="kabupaten_id" id="regency_id" value="{{ old('kabupaten_id') }}">
                <input type="hidden" name="kecamatan_id" id="district_id" value="{{ old('kecamatan_id') }}">
                <input type="hidden" name="desa_id" id="village_id" value="{{ old('desa_id') }}">
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="id" class="font-weight: normal;">Kode Provinsi <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('id') is-invalid @enderror" 
                           id="id" name="id" 
                           value="{{ old('id') }}" placeholder="Contoh: 11, 12, 13" required maxlength="10">
                    @error('id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Kode provinsi harus unik dan maksimal 10 karakter</small>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="name" class="font-weight: normal;">Nama Provinsi <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" 
                           value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="status" class="font-weight: normal;">Status <span class="text-danger">*</span></label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                        <option value="">Pilih Status</option>
                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="d-flex gap-2 justify-content-end">
                <a href="{{ route('admin.reference.provinsi.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times me-1"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const provinsiEl = document.getElementById('provinsi');
    const kabupatenEl = document.getElementById('kabupaten');
    const kecamatanEl = document.getElementById('kecamatan');
    const desaEl = document.getElementById('desa');
    const provinceIdInput = document.getElementById('province_id');
    const regencyIdInput = document.getElementById('regency_id');
    const districtIdInput = document.getElementById('district_id');
    const villageIdInput = document.getElementById('village_id');
    const loadingIndicator = document.getElementById('loading-indicator');

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

    function showLoading() {
        loadingIndicator.style.display = 'block';
    }

    function hideLoading() {
        loadingIndicator.style.display = 'none';
    }

    async function loadWilayah(url, targetElement, level) {
        showLoading();
        try {
            const response = await fetch(url);
            if (!response.ok) throw new Error('Network response was not ok');
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

    provinsiEl.addEventListener('change', function() {
        const provinceId = this.value;
        provinceIdInput.value = provinceId;
        
        if (provinceId) {
            resetDependentDropdowns('provinsi');
            loadWilayah(`/api/reference/kabupaten/by-province?parent_id=${provinceId}`, kabupatenEl, 'Kabupaten/Kota');
        } else {
            resetDependentDropdowns('provinsi');
        }
    });

    kabupatenEl.addEventListener('change', function() {
        const kabupatenId = this.value;
        regencyIdInput.value = kabupatenId;
        
        if (kabupatenId) {
            resetDependentDropdowns('kabupaten');
            loadWilayah(`/api/reference/kecamatan/by-kabupaten?parent_id=${kabupatenId}`, kecamatanEl, 'Kecamatan');
        } else {
            resetDependentDropdowns('kabupaten');
        }
    });

    kecamatanEl.addEventListener('change', function() {
        const kecamatanId = this.value;
        districtIdInput.value = kecamatanId;
        
        if (kecamatanId) {
            resetDependentDropdowns('kecamatan');
            loadWilayah(`/api/reference/desa/by-kecamatan?parent_id=${kecamatanId}`, desaEl, 'Desa/Kelurahan');
        } else {
            resetDependentDropdowns('kecamatan');
        }
    });

    desaEl.addEventListener('change', function() {
        villageIdInput.value = this.value;
    });
</script>

@endsection