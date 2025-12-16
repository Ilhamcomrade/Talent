@extends('admin.layout')

@section('title', 'Tambah Kecamatan')
@section('content')

<div class="judul-form-area text-white p-3" style="background-color: #28a745;">
    <label class="form-label mb-0 fw-bold">Tambah Kecamatan</label>
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
            <h5 class="mb-0">Form Tambah Kecamatan</h5>
            <a href="{{ route('admin.reference.kecamatan.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <form action="{{ route('admin.reference.kecamatan.store') }}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="font-weight: normal;">Provinsi <span class="text-danger">*</span></label>
                    <select id="provinsi" class="form-select" required>
                        <option value="">-- Pilih Provinsi --</option>
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
                    <input type="text" class="form-control @error('kode_kecamatan') is-invalid @enderror" 
                           id="kode_kecamatan" name="kode_kecamatan" 
                           value="{{ old('kode_kecamatan') }}" required>
                    @error('kode_kecamatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="nama_kecamatan" class="font-weight: normal;">Nama Kecamatan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama_kecamatan') is-invalid @enderror" 
                           id="nama_kecamatan" name="nama_kecamatan" 
                           value="{{ old('nama_kecamatan') }}" required>
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
                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Nonaktif</option>
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
                    <i class="fas fa-save me-1"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>

</div>

<script>
    const provinsiEl = document.getElementById('provinsi');
    const kabupatenEl = document.getElementById('kabupaten');
    
    // Data kabupatens grouped by province
    const kabupatensData = {
        @foreach($kabupatens->groupBy('province_id') as $provinceId => $kabupatensGroup)
            '{{ $provinceId }}': [
                @foreach($kabupatensGroup as $kabupaten)
                    { id: '{{ $kabupaten->id }}', nama: '{{ $kabupaten->nama_kabupaten }}' },
                @endforeach
            ],
        @endforeach
    };

    // Populate provinces
    function initializeProvinces() {
        const provinces = Object.keys(kabupatensData);
        provinces.forEach(provinceId => {
            provinsiEl.innerHTML += `<option value="${provinceId}">${provinceId}</option>`;
        });
    }

    // Handle province selection
    provinsiEl.addEventListener('change', function() {
        const selectedProvinceId = this.value;
        kabupatenEl.innerHTML = '<option value="">-- Pilih Kabupaten/Kota --</option>';
        
        if (selectedProvinceId) {
            // Filter kabupatens by selected province
            const kabupatensForProvince = kabupatensData[selectedProvinceId] || [];
            kabupatensForProvince.forEach(kabupaten => {
                kabupatenEl.innerHTML += `<option value="${kabupaten.id}">${kabupaten.nama}</option>`;
            });
            kabupatenEl.disabled = false;
        } else {
            kabupatenEl.disabled = true;
        }
        
        // Reset kabupaten selection
        kabupatenEl.value = '';
    });

    // Initialize on page load
    window.addEventListener('DOMContentLoaded', function() {
        initializeProvinces();
        
        // Restore old values if form has errors
        const oldProvinceId = '{{ old("province_id") }}';
        const oldKabupatenId = '{{ old("kabupaten_id") }}';
        
        if (oldProvinceId) {
            provinsiEl.value = oldProvinceId;
            provinsiEl.dispatchEvent(new Event('change'));
            
            if (oldKabupatenId) {
                setTimeout(() => {
                    kabupatenEl.value = oldKabupatenId;
                }, 100);
            }
        }
    });
</script>

@endsection