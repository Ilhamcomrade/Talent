@extends('admin.layout')

@section('title', 'Edit Reference')
@section('content')

<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-header bg-warning">
            <h5 class="mb-0">Edit Reference</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.reference.update', $reference->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Name --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Nama</label>
                    <input type="text" name="name" value="{{ old('name', $reference->name) }}"
                        class="form-control @error('name') is-invalid @enderror">

                    @error('name')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Code --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Kode</label>
                    <input type="text" name="code" value="{{ old('code', $reference->code) }}"
                        class="form-control @error('code') is-invalid @enderror">

                    @error('code')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Type --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Wilayah</label>
                    <select name="type" class="form-select @error('type') is-invalid @enderror">
                        <option value="Kategori" {{ $reference->type == 'Provinsi' ? 'selected' : '' }}>Provinsi</option>
                        <option value="Wilayah" {{ $reference->type == 'Kab/Kota' ? 'selected' : '' }}>Kab/Kota</option>
                        <option value="Lainnya" {{ $reference->type == 'Kecamatan' ? 'selected' : '' }}>Kecamatan</option>
                    </select>

                    @error('type')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Deskripsi</label>
                    <textarea name="description" rows="3"
                        class="form-control @error('description') is-invalid @enderror">{{ old('description', $reference->description) }}</textarea>

                    @error('description')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Status</label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror">
                        <option value="1" {{ $reference->status == 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ $reference->status == 0 ? 'selected' : '' }}>Nonaktif</option>
                    </select>

                    @error('status')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.reference.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>

                    <button class="btn btn-warning text-white">Update</button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
