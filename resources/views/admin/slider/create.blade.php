@extends('admin.layout')

@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-12">
                <h1 class="h2">Tambah Slider Baru</h1>
                <nav aria-label="breadcrumb">
                </nav>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Form Tambah Slider</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar Slider *</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                        <small class="text-muted">Ukuran maksimal 2MB. Format: JPG, PNG, GIF, WebP</small>
                        <div id="imagePreview" class="mt-2" style="display: none;">
                            <img src="" alt="Preview" class="img-thumbnail" style="max-width: 300px;">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.slider.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan Slider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('image').addEventListener('change', function(e) {
        const preview = document.getElementById('imagePreview');
        const previewImg = preview.querySelector('img');

        if (this.files && this.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.style.display = 'block';
            }

            reader.readAsDataURL(this.files[0]);
        } else {
            preview.style.display = 'none';
        }
    });
</script>
@endsection
