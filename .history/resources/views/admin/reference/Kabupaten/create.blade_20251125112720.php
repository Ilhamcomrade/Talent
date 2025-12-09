@extends('admin.layout')

@section('title', 'Tambah Kabupaten/Kota')
@section('content')

<div class="judul-form-area text-white p-3" style="background-color: #28a745;">
    <label class="form-label mb-0 fw-bold">Tambah Kabupaten/Kota</label>
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
            <h5 class="mb-0">Form Tambah Kabupaten/Kota</h5>
            <a href="{{ route('admin.reference.kabupaten.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <form action="{{ route('admin.reference.kabupaten.store') }}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="font-weight: normal;">Provinsi <span class="text-danger">*</span></label>
                    <select id="provinsi" class="form-select" name="province_id" required>
                        <option value="">-- Pilih Provinsi --</option>
                        @foreach ($provinces as $province)
                            <option value="{{ $province->id }}" {{ old('province_id') == $province->id ? 'selected' : '' }}>
                                {{ $province->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="font-weight: normal;">Nama Kabupaten/Kota <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" 
                           value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
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

</div>

<script>
    // Script untuk fitur tambahan jika diperlukan
</script>

@endsection