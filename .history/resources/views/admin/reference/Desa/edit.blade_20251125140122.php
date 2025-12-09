@extends('admin.layout')

@section('title', 'Edit Desa/Kelurahan')
@section('content')

<div class="judul-form-area text-white p-3" style="background-color: #ffc107;">
    <label class="form-label mb-0 fw-bold">Edit Desa/Kelurahan</label>
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
            <h5 class="mb-0">Form Edit Desa/Kelurahan</h5>
            <a href="{{ route('admin.reference.desa.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <form action="{{ route('admin.reference.desa.update', $desa->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Dropdown Cascade Lokasi -->
            <div class="mb-3 p-3 border rounded" style="background-color: #e0e0e0;">
                <label class="font-weight: normal;">Lokasi <span class="text-danger">*</span></label>
                
                <div class="row g-2 mt-2">
                    <div class="col-md-3">
                        <label class="font-weight: normal;">Provinsi</label>
                        <select id="provinsi" class="form-select form-select-sm" required>
                            <option value="">-- Pilih Provinsi --</option>
                            @foreach ($provinces as $province)
                                <option value="{{ $province->id }}" {{ old('provinsi_id', $desa->kecamatan->kabupaten->provinsi_id ?? '') == $province->id ? 'selected' : '' }}>
                                    {{ $province->nama_provinsi }}
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
                
                <div id="loading-indicator" class="mt-2" style="display: none;">
                    <div class="spinner-border spinner-border-sm text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <small class="text-muted ms-2">Memuat data...</small>
                </div>
                
                <input type="hidden" name="provinsi_id" id="provinsi_id" value="{{ old('provinsi_id', $desa->kecamatan->kabupaten->provinsi_id ?? '') }}">
                <input type="hidden" name="kabupaten_id" id="kabupaten_id" value="{{ old('kabupaten_id', $desa->kecamatan->kabupaten_id) }}">
                <input type="hidden" name="kecamatan_id" id="kecamatan_id" value="{{ old('kecamatan_id', $desa->kecamatan_id) }}">
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="id" class="font-weight: normal;">Kode Desa <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" 
                           id="id" name="id" 
                           value="{{ $desa->id }}" disabled>
                    <small class="text-muted">ID tidak dapat diubah</small>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="name" class="font-weight: normal;">Nama Desa/Kelurahan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" 
                           value="{{ old('name', $desa->name) }}" required>
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
                        <option value="1" {{ old('status', $desa->status) == '1' || old('status', $desa->status) === 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ old('status', $desa->status) == '0' || old('status', $desa->status) === 0 ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="d-flex gap-2 justify-content-end">
                <button type="reset" class="btn btn-secondary">
                    <i class="fas fa-undo me-1"></i> Reset
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Update
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

    // Pre-populated values for edit mode
    const editProvinceId = '{{ old("province_id", $desa->kecamatan->kabupaten->province_id ?? "") }}';
    const editKabupatenId = '{{ old("kabupaten_id", $desa->kecamatan->kabupaten_id) }}';
    const editKecamatanId = '{{ old("kecamatan_id", $desa->kecamatan_id) }}';
    const editDesaId = '{{ old("desa_id", $desa->id) }}';

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

    async function loadWilayah(url, targetElement, level, selectValue = null) {
        showLoading();
        try {
            const response = await fetch(url);
            if (!response.ok) throw new Error('Network response was not ok');
            const data = await response.json();
            
            targetElement.innerHTML = `<option value="">-- Pilih ${level} --</option>`;
            data.forEach(item => {
                const selected = selectValue && selectValue == item.id ? 'selected' : '';
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

    provinsiEl.addEventListener('change', function() {
        const provinceId = this.value;
        provinceIdInput.value = provinceId;
        
        if (provinceId) {
            resetDependentDropdowns('provinsi');
            loadWilayah(`/api/reference/kabupaten/by-province?parent_id=${provinceId}`, kabupatenEl, 'Kabupaten/Kota', editKabupatenId);
        } else {
            resetDependentDropdowns('provinsi');
        }
    });

    kabupatenEl.addEventListener('change', function() {
        const kabupatenId = this.value;
        regencyIdInput.value = kabupatenId;
        
        if (kabupatenId) {
            resetDependentDropdowns('kabupaten');
            loadWilayah(`/api/reference/kecamatan/by-kabupaten?parent_id=${kabupatenId}`, kecamatanEl, 'Kecamatan', editKecamatanId);
        } else {
            resetDependentDropdowns('kabupaten');
        }
    });

    kecamatanEl.addEventListener('change', function() {
        const kecamatanId = this.value;
        districtIdInput.value = kecamatanId;
        
        if (kecamatanId) {
            resetDependentDropdowns('kecamatan');
            loadWilayah(`/api/reference/desa/by-kecamatan?parent_id=${kecamatanId}`, desaEl, 'Desa/Kelurahan', editDesaId);
        } else {
            resetDependentDropdowns('kecamatan');
        }
    });

    desaEl.addEventListener('change', function() {
        villageIdInput.value = this.value;
    });

    // Auto-load cascade on page load for edit mode
    window.addEventListener('DOMContentLoaded', function() {
        if (editProvinceId) {
            provinsiEl.value = editProvinceId;
            provinsiEl.dispatchEvent(new Event('change'));
        }
    });
</script>

@endsection