@extends('admin.layout')

@section('title', 'Edit Kecamatan')
@section('content')

<div class="judul-form-area text-white p-3" style="background-color: #ffc107;">
    <label class="form-label mb-0 fw-bold">Edit Kecamatan</label>
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
            <h5 class="mb-0">Form Edit Kecamatan</h5>
            <a href="{{ route('admin.reference.kecamatan.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <form action="{{ route('admin.reference.kecamatan.update', $kecamatan->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="font-weight: normal;">Provinsi <span class="text-danger">*</span></label>
                    <select id="provinsi" class="form-select" name="province_id" required>
                        <option value="">-- Pilih Provinsi --</option>
                        @foreach ($provinces as $province)
                            <option value="{{ $province->id }}" {{ old('province_id', $kecamatan->kabupaten->provinsi_id) == $province->id ? 'selected' : '' }}>
                                {{ $province->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="font-weight: normal;">Kabupaten/Kota <span class="text-danger">*</span></label>
                    <select id="kabupaten" class="form-select" name="kabupaten_id" required disabled>
                        <option value="">-- Pilih Kabupaten/Kota --</option>
                    </select>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="kode_kecamatan" class="font-weight: normal;">Kode Kecamatan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" 
                           id="kode_kecamatan" name="kode_kecamatan" 
                           value="{{ $kecamatan->kode_kecamatan }}" disabled>
                    <small class="text-muted">Kode Kecamatan tidak dapat diubah</small>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="nama_kecamatan" class="font-weight: normal;">Nama Kecamatan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama_kecamatan') is-invalid @enderror" 
                           id="nama_kecamatan" name="nama_kecamatan" 
                           value="{{ old('nama_kecamatan', $kecamatan->nama_kecamatan) }}" required>
                    @error('nama_kecamatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="status" class="font-weight: normal;">Status <span class="text-danger">*</span></label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                        <option value="">Pilih Status</option>
                        <option value="1" {{ old('status', $kecamatan->status) == '1' || old('status', $kecamatan->status) === 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ old('status', $kecamatan->status) == '0' || old('status', $kecamatan->status) === 0 ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="d-flex gap-2 justify-content-end">
                <button type="reset" class="btn btn-secondary">
                    <i class="fas fa-redo me-1"></i> Reset
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Update
                </button>
            </div>
        </form>
    </div>
</div>

</div>

<script>
    const provinsiEl = document.getElementById('provinsi');
    const kabupatenEl = document.getElementById('kabupaten');
    const cache = { kabupaten: {} };

    // Load kabupaten from API based on selected province
    async function loadKabupaten(provinceId) {
        kabupatenEl.innerHTML = '<option value="">-- Pilih Kabupaten/Kota --</option>';
        kabupatenEl.disabled = true;

        if (!provinceId) {
            return;
        }

        try {
            // Check cache first
            if (cache.kabupaten[provinceId]) {
                populateKabupaten(cache.kabupaten[provinceId]);
                return;
            }

            const response = await fetch(`/api/reference/kabupaten/by-provinsi?parent_id=${provinceId}`);
            const data = await response.json();
            
            cache.kabupaten[provinceId] = data;
            populateKabupaten(data);
        } catch (error) {
            console.error('Error loading kabupaten:', error);
            kabupatenEl.innerHTML = '<option value="">-- Error loading data --</option>';
        }
    }

    function populateKabupaten(data) {
        kabupatenEl.innerHTML = '<option value="">-- Pilih Kabupaten/Kota --</option>';
        
        for (const item of data) {
            const option = document.createElement('option');
            option.value = item.id;
            option.textContent = item.name;
            
            // Set selected jika ada data old atau merupakan kabupaten saat ini
            if (item.id == "{{ old('kabupaten_id', $kecamatan->kabupaten_id) }}") {
                option.selected = true;
            }
            
            kabupatenEl.appendChild(option);
        }
        
        kabupatenEl.disabled = false;
    }

    // Handle province selection
    provinsiEl.addEventListener('change', function() {
        loadKabupaten(this.value);
    });

    // Initialize on page load
    window.addEventListener('DOMContentLoaded', function() {
        const currentProvinceId = '{{ $kecamatan->kabupaten->provinsi_id }}';
        if (currentProvinceId) {
            loadKabupaten(currentProvinceId);
        }
    });
</script>

@endsection