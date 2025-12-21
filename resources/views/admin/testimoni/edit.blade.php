@extends('admin.layout')

@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-md-8">
                <h1 class="h3 mb-0">Edit Testimoni</h1>
                <p class="text-muted">Perbarui data testimoni</p>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('admin.testimoni.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.testimoni.update', $testimoni) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                       id="nama" name="nama" value="{{ old('nama', $testimoni->nama) }}" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="umur" class="form-label">Umur <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('umur') is-invalid @enderror"
                                               id="umur" name="umur"
                                               value="{{ old('umur', $testimoni->umur) }}"
                                               min="1" max="120"
                                               required>
                                        @error('umur')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Masukkan umur dalam angka (contoh: 25)</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="pekerjaan" class="form-label">Pekerjaan <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror"
                                               id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan', $testimoni->pekerjaan) }}" required>
                                        @error('pekerjaan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="kesan_pesan" class="form-label">Kesan & Pesan <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('kesan_pesan') is-invalid @enderror"
                                          id="kesan_pesan" name="kesan_pesan" rows="4" required>{{ old('kesan_pesan', $testimoni->kesan_pesan) }}</textarea>
                                <small class="text-muted">Maksimal 500 karakter</small>
                                @error('kesan_pesan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror"
                                        id="status" name="status" required>
                                    <option value="aktif" {{ old('status', $testimoni->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="nonaktif" {{ old('status', $testimoni->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Ubah status di sini. Aktif = tampil di halaman utama, Nonaktif = tidak tampil.</small>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto</label>
                                <div class="mb-3">
                                    <img id="preview-foto" src="{{ $testimoni->foto_url }}"
                                         class="img-thumbnail mb-2" style="width: 200px; height: 200px; object-fit: cover;">
                                </div>
                                <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                       id="foto" name="foto" accept="image/*" onchange="previewImage(event)">
                                <small class="text-muted">Biarkan kosong jika tidak ingin mengganti foto</small>
                                @error('foto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Perbarui Testimoni
                        </button>
                        <button type="reset" class="btn btn-secondary">
                            <i class="fas fa-redo"></i> Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const preview = document.getElementById('preview-foto');
        preview.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection
