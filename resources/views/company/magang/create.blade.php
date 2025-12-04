@include('partials.navbar_company')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Lowongan Magang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-4">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Tambah Lowongan Magang</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('company.magang.store') }}" method="POST">
                @csrf

                <div class="row">

                    {{-- Judul Lowongan --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Judul Lowongan *</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    {{-- Department --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Department</label>
                        <input type="text" name="department" class="form-control">
                    </div>

                    {{-- Lokasi --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Lokasi *</label>
                        <input type="text" name="lokasi" class="form-control" required>
                    </div>

                    {{-- Tipe --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tipe</label>
                        <select name="type" class="form-select">
                            <option value="internship">Internship</option>
                            <option value="fulltime">Fulltime</option>
                            <option value="parttime">Parttime</option>
                            <option value="remote">Remote</option>
                        </select>
                    </div>

                    {{-- Durasi --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Durasi</label>
                        <input type="text" name="durasi" class="form-control" placeholder="Ex: 3 bulan">
                    </div>

                    {{-- Kuota --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kuota *</label>
                        <input type="number" name="kuota" class="form-control" value="1" required>
                    </div>

                    {{-- Gaji Min --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Gaji Minimum</label>
                        <input type="number" name="gaji_min" class="form-control">
                    </div>

                    {{-- Gaji Max --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Gaji Maksimum</label>
                        <input type="number" name="gaji_max" class="form-control">
                    </div>

                    {{-- Deadline --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Deadline *</label>
                        <input type="date" name="deadline" class="form-control">
                    </div>

                    {{-- Status --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status *</label>
                        <select name="status" class="form-select">
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                            <option value="expired">Expired</option>
                        </select>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="col-12 mb-3">
                        <label class="form-label">Deskripsi *</label>
                        <textarea name="deskripsi" rows="4" class="form-control" required></textarea>
                    </div>

                    {{-- Kualifikasi --}}
                    <div class="col-12 mb-3">
                        <label class="form-label">Kualifikasi</label>
                        <textarea name="kualifikasi" rows="3" class="form-control"></textarea>
                    </div>

                    {{-- Tanggung Jawab --}}
                    <div class="col-12 mb-3">
                        <label class="form-label">Tanggung Jawab</label>
                        <textarea name="tanggung_jawab" rows="3" class="form-control"></textarea>
                    </div>

                    {{-- Benefit --}}
                    <div class="col-12 mb-3">
                        <label class="form-label">Benefit</label>
                        <input type="text" name="benefit" class="form-control">
                    </div>

                </div>

                <button type="submit" class="btn btn-primary px-4">Simpan</button>
                <a href="{{ route('company.magang.index') }}" class="btn btn-secondary px-4">Kembali</a>

            </form>

        </div>
    </div>

</div>

</body>
</html>
