<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lowongan Magang</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .card {
            border-radius: 10px;
        }
        .btn-grad-hijau {
            background-image: linear-gradient(to right, #4CAF50 0%, #8BC34A 51%, #4c77af 100%);
            color: #fff;
            transition: 0.5s;
            background-size: 200% auto;
            border: none;
        }
        .btn-grad-hijau:hover {
            background-position: right center;
            color: #fff;
        }
        label {
            font-weight: 500;
        }
    </style>
</head>

<body class="bg-light">

@include('partials.navbar_company')

<div class="container py-4">

    <div class="mb-3">
        <a href="{{ route('company.magang.index') }}" class="btn btn-sm btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0 fw-bold">
                <i class="bi bi-pencil-square me-1"></i> Edit Lowongan Magang
            </h5>
        </div>

        <div class="card-body">

            {{-- Error --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('company.magang.update', $magang->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    {{-- Judul --}}
                    <div class="col-md-6">
                        <label>Judul Magang <span class="text-danger">*</span></label>
                        <input type="text"
                               name="title"
                               class="form-control"
                               value="{{ old('title', $magang->title) }}"
                               required>
                    </div>

                    {{-- Departemen --}}
                    <div class="col-md-6">
                        <label>Departemen</label>
                        <input type="text"
                               name="department"
                               class="form-control"
                               value="{{ old('department', $magang->department) }}">
                    </div>

                    {{-- Lokasi --}}
                    <div class="col-md-6">
                        <label>Lokasi <span class="text-danger">*</span></label>
                        <input type="text"
                               name="lokasi"
                               class="form-control"
                               value="{{ old('lokasi', $magang->lokasi) }}"
                               required>
                    </div>

                    {{-- Tipe --}}
                    <div class="col-md-6">
                        <label>Tipe Magang <span class="text-danger">*</span></label>
                        <select name="type" class="form-select" required>
                            <option value="">-- Pilih Tipe --</option>
                            <option value="onsite" {{ old('type', $magang->type) == 'onsite' ? 'selected' : '' }}>Onsite</option>
                            <option value="remote" {{ old('type', $magang->type) == 'remote' ? 'selected' : '' }}>Remote</option>
                            <option value="hybrid" {{ old('type', $magang->type) == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                        </select>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="col-12">
                        <label>Deskripsi <span class="text-danger">*</span></label>
                        <textarea name="deskripsi"
                                  class="form-control"
                                  rows="4"
                                  required>{{ old('deskripsi', $magang->deskripsi) }}</textarea>
                    </div>

                    {{-- Kualifikasi --}}
                    <div class="col-12">
                        <label>Kualifikasi</label>
                        <textarea name="kualifikasi"
                                  class="form-control"
                                  rows="3">{{ old('kualifikasi', $magang->kualifikasi) }}</textarea>
                    </div>

                    {{-- Tanggung Jawab --}}
                    <div class="col-12">
                        <label>Tanggung Jawab</label>
                        <textarea name="tanggung_jawab"
                                  class="form-control"
                                  rows="3">{{ old('tanggung_jawab', $magang->tanggung_jawab) }}</textarea>
                    </div>

                    {{-- Benefit --}}
                    <div class="col-md-6">
                        <label>Benefit</label>
                        <input type="text"
                               name="benefit"
                               class="form-control"
                               value="{{ old('benefit', $magang->benefit) }}">
                    </div>

                    {{-- Durasi --}}
                    <div class="col-md-6">
                        <label>Durasi</label>
                        <input type="text"
                               name="durasi"
                               class="form-control"
                               value="{{ old('durasi', $magang->durasi) }}">
                    </div>

                    {{-- Kuota --}}
                    <div class="col-md-4">
                        <label>Kuota <span class="text-danger">*</span></label>
                        <input type="number"
                               name="kuota"
                               class="form-control"
                               value="{{ old('kuota', $magang->kuota) }}"
                               required>
                    </div>

                    {{-- Gaji Min --}}
                    <div class="col-md-4">
                        <label>Gaji Minimum</label>
                        <input type="number"
                               name="gaji_min"
                               class="form-control"
                               value="{{ old('gaji_min', $magang->gaji_min) }}">
                    </div>

                    {{-- Gaji Max --}}
                    <div class="col-md-4">
                        <label>Gaji Maksimum</label>
                        <input type="number"
                               name="gaji_max"
                               class="form-control"
                               value="{{ old('gaji_max', $magang->gaji_max) }}">
                    </div>

                    {{-- Deadline --}}
                    <div class="col-md-6">
                        <label>Deadline</label>
                        <input type="date"
                               name="deadline"
                               class="form-control"
                               value="{{ old('deadline', $magang->deadline) }}">
                    </div>

                    {{-- Status --}}
                    <div class="col-md-6">
                        <label>Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select" required>
                            <option value="aktif" {{ old('status', $magang->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ old('status', $magang->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            <option value="expired" {{ old('status', $magang->status) == 'expired' ? 'selected' : '' }}>Expired</option>
                        </select>
                    </div>

                </div>

                <div class="mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-grad-hijau px-4">
                        <i class="bi bi-save me-1"></i> Update Data
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
