@extends('admin.layout')

@section('title', 'Edit Subkategori')
@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Edit Subkategori</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.job-categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Nama Subkategori --}}
                <div class="mb-3">
                    <label class="form-label">Nama Subkategori</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
                </div>

                {{-- Pilih Parent --}}
                <div class="mb-3">
                    <label class="form-label">Parent</label>
                    <select name="parent_id" class="form-control" required>
                        <option value="">--- Pilih Parent ---</option>
                        @foreach ($parents as $p)
                            <option value="{{ $p->id }}"
                                {{ old('parent_id', $category->parent_id) == $p->id ? 'selected' : '' }}>
                                {{ $p->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('admin.job-categories.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
