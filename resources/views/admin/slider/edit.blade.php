@extends('admin.layout')

@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-12">
                <h1 class="h2">Edit Slider</h1>
                <nav aria-label="breadcrumb">
                </nav>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Form Edit Slider</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar Slider</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar. Ukuran maksimal 2MB.</small>

                        <div class="mt-3">
                            <p>Gambar saat ini:</p>
                            @if($slider->image_url)
                                <img src="{{ $slider->image_url }}" alt="Current Image" class="img-thumbnail" style="max-width: 300px;">
                            @else
                                <span class="text-muted">Tidak ada gambar</span>
                            @endif
                        </div>

                        <div id="imagePreview" class="mt-2" style="display: none;">
                            <p>Preview gambar baru:</p>
                            <img src="" alt="Preview" class="img-thumbnail" style="max-width: 300px;">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.slider.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Update Slider</button>
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
