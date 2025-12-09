@extends('admin.layout')

@section('title', 'Tambah Reference')
@section('content')

<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Tambah Reference</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.reference.store') }}" method="POST">
                @csrf

                {{-- Name --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Nama</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="form-control @error('name') is-invalid @enderror"
                        placeholder="Masukkan nama reference">

                    @error('name')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Code --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Kode</label>
                    <input type="text" name="code" value="{{ old('code') }}"
                        class="form-control @error('code') is-invalid @enderror"
                        placeholder="Contoh: RF001">

                    @error('code')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Type --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Tipe</label>
                    <select name="type" class="form-select @error('type') is-invalid @enderror">
                        <option value="">-- Pilih Tipe --</option>
                        <option value="Provinsi" {{ old('type') == 'Provinsi' ? 'selected' : '' }}>Provinsi</option>
                        <option value="Kab/Kota" {{ old('type') == 'Kab/Kota' ? 'selected' : '' }}>Kab/Kota</option>
                        <option value="Kecamatan" {{ old('type') == 'Kecamatan' ? 'selected' : '' }}>Kecamatan</option>
                    </select>

                    @error('type')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Deskripsi</label>
                    <textarea name="description" rows="3"
                        class="form-control @error('description') is-invalid @enderror"
                        placeholder="Tambahkan deskripsi opsional...">{{ old('description') }}</textarea>

                    @error('description')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Status</label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror">
                        <option value="">-- Pilih Status --</option>
                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Nonaktif</option>
                    </select>

                    @error('status')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.reference.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>

                    <button class="btn btn-dark">Simpan</button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection
