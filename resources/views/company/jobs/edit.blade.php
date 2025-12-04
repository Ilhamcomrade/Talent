{{-- resources/views/company/jobs/edit.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lowongan Kerja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <h2 class="mb-4">Edit Lowongan Kerja</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('companiesjobs.update', $job->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Judul --}}
        <div class="mb-3">
            <label class="form-label">Judul Lowongan</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $job->title) }}" required>
        </div>

        {{-- Industri --}}
        <div class="mb-3">
            <label class="form-label">Industri</label>
            <input type="text" name="industry" class="form-control" value="{{ old('industry', $job->industry) }}">
        </div>

        {{-- Logo --}}
        <div class="mb-3">
            <label class="form-label">Logo Perusahaan</label>
            @if($job->company_logo)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $job->company_logo) }}" alt="Logo" width="100">
                </div>
            @endif
            <input type="file" name="company_logo" class="form-control">
        </div>

        {{-- Salary --}}
        <div class="mb-3">
            <label class="form-label">Gaji Minimal</label>
            <input type="number" name="salary_min" class="form-control" value="{{ old('salary_min', $job->salary_min) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Gaji Maksimal</label>
            <input type="number" name="salary_max" class="form-control" value="{{ old('salary_max', $job->salary_max) }}">
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="show_salary" class="form-check-input" value="1" {{ $job->show_salary ? 'checked' : '' }}>
            <label class="form-check-label">Tampilkan Gaji</label>
        </div>

        {{-- Skills --}}
        <div class="mb-3">
            <label class="form-label">Skills (pisahkan dengan koma)</label>
            <input type="text" name="skills" class="form-control"
                   value="{{ old('skills', is_array($job->skills) ? implode(',', $job->skills) : $job->skills) }}">
        </div>

        {{-- Lokasi --}}
        <div class="mb-3 row">
            <div class="col-md-3">
                <label class="form-label">Provinsi</label>
                <select id="provinsi" name="provinsi_id" class="form-select">
                    <option value="">Pilih Provinsi</option>
                    @foreach($provinces as $province)
                        <option value="{{ $province->id }}" {{ $province->id == $job->provinsi_id ? 'selected' : '' }}>
                            {{ $province->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">Kabupaten</label>
                <select id="kabupaten" name="kabupaten_id" class="form-select">
                    <option value="">Pilih Kabupaten</option>
                    @foreach($regencies as $regency)
                        <option value="{{ $regency->id }}" {{ $regency->id == $job->kabupaten_id ? 'selected' : '' }}>
                            {{ $regency->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">Kecamatan</label>
                <select id="kecamatan" name="kecamatan_id" class="form-select">
                    <option value="">Pilih Kecamatan</option>
                    @foreach($districts as $district)
                        <option value="{{ $district->id }}" {{ $district->id == $job->kecamatan_id ? 'selected' : '' }}>
                            {{ $district->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">Desa</label>
                <select id="desa" name="desa_id" class="form-select">
                    <option value="">Pilih Desa</option>
                    @foreach($villages as $village)
                        <option value="{{ $village->id }}" {{ $village->id == $job->desa_id ? 'selected' : '' }}>
                            {{ $village->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Alamat --}}
        <div class="mb-3">
            <label class="form-label">Alamat / Lokasi</label>
            <input type="text" name="location" class="form-control" value="{{ old('location', $job->location) }}">
        </div>

        {{-- Publik --}}
        <div class="form-check mb-3">
            <input type="checkbox" name="is_public" class="form-check-input" value="1" {{ $job->is_public ? 'checked' : '' }}>
            <label class="form-check-label">Tampilkan ke publik</label>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>

<script>
document.getElementById("provinsi").addEventListener("change", function () {
    let id = this.value;
    fetch("/companiesjobs/regencies/" + id)
        .then(res => res.json())
        .then(data => {
            let el = document.getElementById("kabupaten");
            el.innerHTML = '<option value="">Pilih Kabupaten</option>';
            data.forEach(item => el.innerHTML += `<option value="${item.id}">${item.name}</option>`);
            document.getElementById("kecamatan").innerHTML = '<option value="">Pilih Kecamatan</option>';
            document.getElementById("desa").innerHTML = '<option value="">Pilih Desa</option>';
        });
});

document.getElementById("kabupaten").addEventListener("change", function () {
    let id = this.value;
    fetch("/companiesjobs/districts/" + id)
        .then(res => res.json())
        .then(data => {
            let el = document.getElementById("kecamatan");
            el.innerHTML = '<option value="">Pilih Kecamatan</option>';
            data.forEach(item => el.innerHTML += `<option value="${item.id}">${item.name}</option>`);
            document.getElementById("desa").innerHTML = '<option value="">Pilih Desa</option>';
        });
});

document.getElementById("kecamatan").addEventListener("change", function () {
    let id = this.value;
    fetch("/companiesjobs/villages/" + id)
        .then(res => res.json())
        .then(data => {
            let el = document.getElementById("desa");
            el.innerHTML = '<option value="">Pilih Desa</option>';
            data.forEach(item => el.innerHTML += `<option value="${item.id}">${item.name}</option>`);
        });
});
</script>

</body>
</html>
