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
                    <div class="col-md-4">
                        <label class="font-weight: normal;">Provinsi</label>
                        <select id="provinsi" class="form-select form-select-sm" required>
                            <option value="">-- Pilih Provinsi --</option>
                            @foreach ($provinces as $province)
                                <option value="{{ $province->id }}" {{ old('provinsi_id', optional(optional(optional($desa)->kecamatan)->kabupaten)->provinsi_id ?? '') == $province->id ? 'selected' : '' }}>
                                    {{ $province->nama_provinsi }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="font-weight: normal;">Kabupaten/Kota</label>
                        <select id="kabupaten" class="form-select form-select-sm" required>
                            <option value="">-- Pilih Kabupaten --</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="font-weight: normal;">Kecamatan</label>
                        <select id="kecamatan" class="form-select form-select-sm" name="kecamatan_id" required>
                            <option value="">-- Pilih Kecamatan --</option>
                        </select>
                    </div>
                </div>
                
                <div id="loading-indicator" class="mt-2" style="display: none;">
                    <div class="spinner-border spinner-border-sm text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <small class="text-muted ms-2">Memuat data...</small>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="kode_desa" class="font-weight: normal;">Kode Desa <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('kode_desa') is-invalid @enderror" 
                           id="kode_desa" name="kode_desa" 
                           value="{{ old('kode_desa', $desa->kode_desa) }}" required>
                    @error('kode_desa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Kode Desa</small>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="nama_desa" class="font-weight: normal;">Nama Desa/Kelurahan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama_desa') is-invalid @enderror" 
                           id="nama_desa" name="nama_desa" 
                           value="{{ old('nama_desa', $desa->nama_desa) }}" required>
                    @error('nama_desa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="jenis" class="font-weight: normal;">Jenis <span class="text-danger">*</span></label>
                    <select class="form-select @error('jenis') is-invalid @enderror" id="jenis" name="jenis" required>
                        <option value="">Pilih Jenis</option>
                        <option value="Desa" {{ old('jenis', $desa->jenis) == 'Desa' ? 'selected' : '' }}>Desa</option>
                        <option value="Kelurahan" {{ old('jenis', $desa->jenis) == 'Kelurahan' ? 'selected' : '' }}>Kelurahan</option>
                    </select>
                    @error('jenis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="status" class="font-weight: normal;">Status <span class="text-danger">*</span></label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                        <option value="">Pilih Status</option>
                        <option value="1" {{ (old('status', $desa->status) == '1' || old('status', $desa->status) === true || old('status', $desa->status) === 1) ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ (old('status', $desa->status) == '0' || old('status', $desa->status) === false || old('status', $desa->status) === 0) ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="d-flex gap-2 justify-content-end mt-4">
                <button type="button" class="btn btn-secondary" onclick="resetForm()">
                    <i class="fas fa-redo me-1"></i> Reset
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
    const loadingIndicator = document.getElementById('loading-indicator');

    // Store initial values for reset
    const initialValues = {
        provinsiId: '{{ old("provinsi_id", optional(optional(optional($desa)->kecamatan)->kabupaten)->provinsi_id ?? "") }}',
        kabupatenId: '{{ old("kabupaten_id", optional(optional($desa)->kecamatan)->kabupaten_id ?? "") }}',
        kecamatanId: '{{ old("kecamatan_id", $desa->kecamatan_id ?? "") }}',
        kodeDesa: '{{ old("kode_desa", $desa->kode_desa ?? "") }}',
        namaDesa: '{{ old("nama_desa", $desa->nama_desa ?? "") }}',
        jenis: '{{ old("jenis", $desa->jenis ?? "") }}',
        status: '{{ old("status", $desa->status ?? "") }}'
    };

    function resetDependentDropdowns(level) {
        if (level === 'provinsi') {
            kabupatenEl.innerHTML = '<option value="">-- Pilih Kabupaten --</option>';
            kecamatanEl.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
        } else if (level === 'kabupaten') {
            kecamatanEl.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
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
            if (data.data && Array.isArray(data.data)) {
                data.data.forEach(item => {
                    const selected = selectValue && selectValue == item.id ? 'selected' : '';
                    targetElement.innerHTML += `<option value="${item.id}" ${selected}>${item.name || item.nama_kabupaten || item.nama_kecamatan}</option>`;
                });
            } else if (Array.isArray(data)) {
                data.forEach(item => {
                    const selected = selectValue && selectValue == item.id ? 'selected' : '';
                    targetElement.innerHTML += `<option value="${item.id}" ${selected}>${item.name || item.nama_kabupaten || item.nama_kecamatan}</option>`;
                });
            }
        } catch (error) {
            console.error('Error loading wilayah:', error);
            targetElement.innerHTML = `<option value="">-- Error loading data --</option>`;
        } finally {
            hideLoading();
        }
    }

    function resetForm() {
        document.getElementById('provinsi').value = initialValues.provinsiId;
        document.getElementById('kode_desa').value = initialValues.kodeDesa;
        document.getElementById('nama_desa').value = initialValues.namaDesa;
        document.getElementById('jenis').value = initialValues.jenis;
        document.getElementById('status').value = initialValues.status;
        
        // Reload cascade
        if (initialValues.provinsiId) {
            provinsiEl.dispatchEvent(new Event('change'));
        }
    }

    provinsiEl.addEventListener('change', function() {
        const provinsiId = this.value;
        
        if (provinsiId) {
            resetDependentDropdowns('provinsi');
            // Use OLD system API for kabupaten
            loadWilayah(`/api/reference/kabupaten/by-provinsi?parent_id=${provinsiId}`, kabupatenEl, 'Kabupaten/Kota', initialValues.kabupatenId);
        } else {
            resetDependentDropdowns('provinsi');
        }
    });

    kabupatenEl.addEventListener('change', function() {
        const kabupatenId = this.value;
        
        if (kabupatenId) {
            resetDependentDropdowns('kabupaten');
            // Use OLD system API for kecamatan
            loadWilayah(`/api/reference/kecamatan/by-kabupaten-old?parent_id=${kabupatenId}`, kecamatanEl, 'Kecamatan', initialValues.kecamatanId);
        } else {
            resetDependentDropdowns('kabupaten');
        }
    });

    // Auto-load cascade on page load for edit mode
    window.addEventListener('DOMContentLoaded', function() {
        if (initialValues.provinsiId) {
            // Set provinsi value
            provinsiEl.value = initialValues.provinsiId;
            
            // Trigger change event to load kabupaten
            provinsiEl.dispatchEvent(new Event('change'));
            
            // Wait for kabupaten to load, then set and trigger kabupaten change
            setTimeout(() => {
                if (initialValues.kabupatenId && kabupatenEl.options.length > 1) {
                    kabupatenEl.value = initialValues.kabupatenId;
                    kabupatenEl.dispatchEvent(new Event('change'));
                }
            }, 600);
            
            // Wait for kecamatan to load, then set kecamatan value
            setTimeout(() => {
                if (initialValues.kecamatanId && kecamatanEl.options.length > 1) {
                    kecamatanEl.value = initialValues.kecamatanId;
                }
            }, 1200);
        }
    });
</script>

@endsection