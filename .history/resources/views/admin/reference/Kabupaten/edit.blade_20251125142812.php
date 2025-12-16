@extends('admin.layout')

@section('title', 'Edit Kabupaten/Kota')
@section('content')

<div class="judul-form-area text-white p-3" style="background-color: #ffc107;">
    <label class="form-label mb-0 fw-bold">Edit Kabupaten/Kota</label>
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
            <h5 class="mb-0">Form Edit Kabupaten/Kota</h5>
            <a href="{{ route('admin.reference.kabupaten.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <form action="{{ route('admin.reference.kabupaten.update', $regency->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="font-weight: normal;">Provinsi <span class="text-danger">*</span></label>
                    <select id="provinsi" class="form-select" name="province_id" required>
                        <option value="">-- Pilih Provinsi --</option>
                        @foreach ($provinces as $province)
                            <option value="{{ $province->id }}" {{ old('province_id', $regency->province_id) == $province->id ? 'selected' : '' }}>
                                {{ $province->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="id" class="font-weight: normal;">Kode Kabupaten <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" 
                           id="id" name="id" 
                           value="{{ $regency->id }}" disabled>
                    <small class="text-muted">Kode tidak dapat diubah</small>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="name" class="font-weight: normal;">Nama Kabupaten/Kota <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" 
                           value="{{ old('name', $regency->name) }}" required>
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
                        <option value="1" {{ (old('status', $regency->status) == '1' || old('status', $regency->status) === true || old('status', $regency->status) === 1) ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ (old('status', $regency->status) == '0' || old('status', $regency->status) === false || old('status', $regency->status) === 0) ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="d-flex gap-2 justify-content-end">
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
    const initialValues = {
        provinceId: '{{ old("province_id", $regency->province_id ?? "") }}',
        name: '{{ old("name", $regency->name ?? "") }}',
        status: '{{ old("status", $regency->status) }}'
    };

    function resetForm() {
        document.getElementById('provinsi').value = initialValues.provinceId;
        document.getElementById('name').value = initialValues.name;
        document.getElementById('status').value = initialValues.status;
    }
</script>

@endsection