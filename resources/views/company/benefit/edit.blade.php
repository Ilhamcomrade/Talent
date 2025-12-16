<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Benefit</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-light">

    {{-- NAVBAR --}}
    @include('partials.navbar_company')

    <div class="container py-4">

        {{-- HEADER + BACK BUTTON --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">Edit Benefit</h3>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('company.benefits.update', $benefit) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul Benefit *</label>
                                <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                       id="judul" name="judul"
                                       value="{{ old('judul', $benefit->judul) }}"
                                       required
                                       placeholder="Contoh: Asuransi Kesehatan">
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status *</label>
                                <select class="form-control @error('status') is-invalid @enderror"
                                        id="status" name="status" required>
                                    <option value="">Pilih Status</option>
                                    <option value="aktif" {{ old('status', $benefit->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="nonaktif" {{ old('status', $benefit->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi *</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                  id="deskripsi" name="deskripsi"
                                  rows="4"
                                  required
                                  placeholder="Jelaskan detail benefit yang diberikan...">{{ old('deskripsi', $benefit->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="icon" class="form-label">Icon/Gambar</label>

                        {{-- CURRENT ICON --}}
                        @if($benefit->icon)
                            <div class="mb-3">
                                <p class="mb-1">Icon Saat Ini:</p>
                                <img src="{{ asset('storage/' . $benefit->icon) }}"
                                     alt="Current Icon"
                                     class="img-thumbnail"
                                     style="max-width: 150px;">
                                <div class="form-text">
                                    Kosongkan jika tidak ingin mengubah icon
                                </div>
                            </div>
                        @endif

                        <input type="file" class="form-control @error('icon') is-invalid @enderror"
                               id="icon" name="icon" accept="image/*">
                        <small class="text-muted">Format: jpeg, png, jpg, gif, svg. Maksimal: 2MB</small>
                        @error('icon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        {{-- NEW PREVIEW AREA --}}
                        <div class="mt-3">
                            <p class="mb-2">Preview Icon Baru:</p>
                            <img id="icon-preview" src=""
                                 alt="Preview Icon Baru"
                                 class="img-thumbnail"
                                 style="max-width: 150px; display: none;">
                            <div id="no-preview" class="text-muted">
                                Belum ada gambar dipilih
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('company.benefits.index') }}" class="btn btn-secondary">
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Benefit
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Preview image before upload
        document.getElementById('icon').addEventListener('change', function(e) {
            const preview = document.getElementById('icon-preview');
            const noPreview = document.getElementById('no-preview');
            const file = e.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    noPreview.style.display = 'none';
                }

                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
                noPreview.style.display = 'block';
            }
        });
    </script>
</body>
</html>
