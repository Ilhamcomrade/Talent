{{-- resources/views/company/jobs/create.blade.php --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Job</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

@include('partials.navbar_company')

<div class="container mt-4">
    <h2>Tambah Job Baru</h2>

    {{-- Error Validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('companiesjobs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Nama Perusahaan & Industri --}}
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Nama Perusahaan</label>
                <input type="text" name="company_name" class="form-control" value="{{ old('company_name') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Industri</label>
                <input type="text" name="industry" class="form-control" value="{{ old('industry') }}">
            </div>
        </div>

        {{-- Logo & Judul --}}
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Logo Perusahaan</label>
                <input type="file" name="company_logo" class="form-control" accept="image/*">
            </div>
            <div class="col-md-6">
                <label class="form-label">Judul Lowongan</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
            </div>
        </div>

        {{-- Level Pekerjaan & Show Salary + is_public --}}
        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label">Level Pekerjaan</label>
                <input type="text" name="job_level" class="form-control" value="{{ old('job_level') }}">
            </div>

            {{-- Show Salary --}}
            <div class="col-md-4 d-flex align-items-center">
                <div class="form-check mt-2">
                    <input type="hidden" name="show_salary" value="0">
                    <input type="checkbox" name="show_salary" class="form-check-input" id="show_salary" value="1"
                        {{ old('show_salary') ? 'checked' : '' }}>
                    <label class="form-check-label" for="show_salary">Tampilkan Gaji</label>
                </div>
            </div>

            {{-- Is Public (BARU) --}}
            <div class="col-md-4 d-flex align-items-center">
                <div class="form-check mt-2">
                    <input type="hidden" name="is_public" value="0">
                    <input type="checkbox" name="is_public" class="form-check-input" id="is_public" value="1"
                        {{ old('is_public') ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_public">Jadikan Publik (Tampilkan ke umum)</label>
                </div>
            </div>
        </div>

        {{-- Lokasi Bertingkat --}}
        <div class="mb-4 p-3 border rounded" style="background-color: #e9ecef;">
            <label class="form-label">Lokasi Kerja <span class="text-danger">*</span></label>

            {{-- Display selected location --}}
            <div class="alert alert-info py-2 mb-3" id="location-display" style="display: none;">
                <small class="fw-bold">Lokasi terpilih:</small>
                <span id="location-text">-</span>
            </div>

            <div class="row g-2">
                <div class="col-md-3">
                    <label class="form-label">Provinsi</label>
                    <select id="provinsi" class="form-select form-select-sm">
                        <option value="">-- Pilih Provinsi --</option>
                        @foreach ($provinces as $province)
                            <option value="{{ $province->id }}" {{ old('provinsi_id') == $province->id ? 'selected' : '' }}>
                                {{ $province->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Kabupaten/Kota</label>
                    <select id="kabupaten" class="form-select form-select-sm" disabled>
                        <option value="">-- Pilih Kabupaten --</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Kecamatan</label>
                    <select id="kecamatan" class="form-select form-select-sm" disabled>
                        <option value="">-- Pilih Kecamatan --</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Desa/Kelurahan</label>
                    <select id="desa" class="form-select form-select-sm" disabled>
                        <option value="">-- Pilih Desa --</option>
                    </select>
                </div>
            </div>

            {{-- Hidden fields --}}
            <input type="hidden" name="provinsi_id" id="province_id" value="{{ old('provinsi_id') }}">
            <input type="hidden" name="kabupaten_id" id="regency_id" value="{{ old('kabupaten_id') }}">
            <input type="hidden" name="kecamatan_id" id="district_id" value="{{ old('kecamatan_id') }}">
            <input type="hidden" name="desa_id" id="village_id" value="{{ old('desa_id') }}">
            <input type="hidden" name="location" id="location" value="{{ old('location') }}">
        </div>

        {{-- Skills --}}
        <div class="mb-3">
            <label class="form-label">Skills (pisahkan dengan koma)</label>
            <input type="text" name="skills" class="form-control" value="{{ old('skills') }}">
        </div>

        {{-- Deskripsi --}}
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="5">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Persyaratan</label>
            <textarea name="requirements" class="form-control" rows="3">{{ old('requirements') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggung Jawab</label>
            <textarea name="tanggung_jawab" class="form-control" rows="3">{{ old('tanggung_jawab') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Kualifikasi</label>
            <textarea name="kualifikasi" class="form-control" rows="3">{{ old('kualifikasi') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Nilai Tambah</label>
            <textarea name="nilai_tambah" class="form-control" rows="3">{{ old('nilai_tambah') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('companiesjobs.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

{{-- Script Lokasi Bertingkat --}}
<script>
    
      const provinsiEl = document.getElementById('provinsi');
    const kabupatenEl = document.getElementById('kabupaten');
    const kecamatanEl = document.getElementById('kecamatan');
    const desaEl = document.getElementById('desa');

    const provinceIdInput = document.getElementById('province_id');
    const regencyIdInput = document.getElementById('regency_id');
    const districtIdInput = document.getElementById('district_id');
    const villageIdInput = document.getElementById('village_id');
    const locationInput = document.getElementById('location');

    const locationDisplay = document.getElementById('location-display');
    const locationText = document.getElementById('location-text');

    function resetDropdowns(level) {
        if (level === 'provinsi') {
            kabupatenEl.innerHTML = '<option value="">-- Pilih Kabupaten --</option>'; kabupatenEl.disabled = true;
            kecamatanEl.innerHTML = '<option value="">-- Pilih Kecamatan --</option>'; kecamatanEl.disabled = true;
            desaEl.innerHTML = '<option value="">-- Pilih Desa --</option>'; desaEl.disabled = true;

            regencyIdInput.value = ''; districtIdInput.value = ''; villageIdInput.value = '';
        }
        if (level === 'kabupaten') {
            kecamatanEl.innerHTML = '<option value="">-- Pilih Kecamatan --</option>'; kecamatanEl.disabled = true;
            desaEl.innerHTML = '<option value="">-- Pilih Desa --</option>'; desaEl.disabled = true;

            districtIdInput.value = ''; villageIdInput.value = '';
        }
        if (level === 'kecamatan') {
            desaEl.innerHTML = '<option value="">-- Pilih Desa --</option>'; desaEl.disabled = true;
            villageIdInput.value = '';
        }
    }

    function updateLocationDisplay() {
        const provName = provinsiEl.options[provinsiEl.selectedIndex]?.text || '';
        const kabName = kabupatenEl.options[kabupatenEl.selectedIndex]?.text || '';
        const kecName = kecamatanEl.options[kecamatanEl.selectedIndex]?.text || '';
        const desaName = desaEl.options[desaEl.selectedIndex]?.text || '';

        const parts = [];
        if (desaName && desaName !== '-- Pilih Desa --') parts.unshift(desaName);
        if (kecName && kecName !== '-- Pilih Kecamatan --') parts.unshift(kecName);
        if (kabName && kabName !== '-- Pilih Kabupaten --') parts.unshift(kabName);
        if (provName && provName !== '-- Pilih Provinsi --') parts.unshift(provName);

        if (parts.length > 0) {
            locationText.textContent = parts.join(', ');
            locationInput.value = parts.join(', ');
            locationDisplay.style.display = 'block';
        } else {
            locationDisplay.style.display = 'none';
            locationInput.value = '';
        }
    }

    async function fetchAndFill(url, selectEl, selectedValue = '') {
        try {
            const res = await fetch(url);
            const data = await res.json();
            selectEl.innerHTML = '<option value="">-- Pilih --</option>';
            data.forEach(item => {
                const selected = item.id == selectedValue ? 'selected' : '';
                selectEl.innerHTML += `<option value="${item.id}" ${selected}>${item.name}</option>`;
            });
            selectEl.disabled = false;
        } catch (err) {
            console.error(err);
        }
    }

    provinsiEl.addEventListener('change', () => {
        const provId = provinsiEl.value;
        provinceIdInput.value = provId;
        resetDropdowns('provinsi');
        if (provId) fetchAndFill(`/company/api/regencies/${provId}`, kabupatenEl);
        updateLocationDisplay();
    });

    kabupatenEl.addEventListener('change', () => {
        const regId = kabupatenEl.value;
        regencyIdInput.value = regId;
        resetDropdowns('kabupaten');
        if (regId) fetchAndFill(`/company/api/districts/${regId}`, kecamatanEl);
        updateLocationDisplay();
    });

    kecamatanEl.addEventListener('change', () => {
        const distId = kecamatanEl.value;
        districtIdInput.value = distId;
        resetDropdowns('kecamatan');
        if (distId) fetchAndFill(`/company/api/villages/${distId}`, desaEl);
        updateLocationDisplay();
    });

    desaEl.addEventListener('change', () => {
        villageIdInput.value = desaEl.value;
        updateLocationDisplay();
    });

    window.addEventListener('DOMContentLoaded', async () => {
        const oldProv = provinceIdInput.value;
        const oldReg = regencyIdInput.value;
        const oldDist = districtIdInput.value;
        const oldVill = villageIdInput.value;

        if (oldProv) {
            await fetchAndFill(`/company/api/regencies/${oldProv}`, kabupatenEl, oldReg);
        }
        if (oldReg) {
            await fetchAndFill(`/company/api/districts/${oldReg}`, kecamatanEl, oldDist);
        }
        if (oldDist) {
            await fetchAndFill(`/company/api/villages/${oldDist}`, desaEl, oldVill);
        }
        updateLocationDisplay();
    });

</script>

</body>
</html>
