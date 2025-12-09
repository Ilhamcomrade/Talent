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
                    <label class="font-weight: normal;">Kabupaten/Kota <span class="text-danger">*</span></label>
                    <select id="kabupaten" class="form-select" name="kabupaten_id" required>
                        <option value="">-- Pilih Kabupaten/Kota --</option>
                        @foreach ($kabupatens as $kabupaten)
                            <option value="{{ $kabupaten->id }}" {{ old('kabupaten_id', $kecamatan->kabupaten_id) == $kabupaten->id ? 'selected' : '' }}>
                                {{ $kabupaten->nama_kabupaten }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="id" class="font-weight: normal;">Kode Kecamatan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" 
                           id="id" name="id" 
                           value="{{ $kecamatan->id }}" disabled>
                    <small class="text-muted">ID tidak dapat diubah</small>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="name" class="font-weight: normal;">Nama Kecamatan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" 
                           value="{{ old('name', $kecamatan->name) }}" required>
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
    // Script untuk fitur tambahan jika diperlukan
</script>

@endsection