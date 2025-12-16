@extends('admin.layout')

@section('title', 'Lambah kategori')
@section('content')
<div class="container mt-4">
    <h3>Tambah Kategori / Subkategori</h3>

    <div class="card mt-3">
        <div class="card-body">

            <form action="{{ route('admin.job-categories.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Parent (opsional)</label>
                    <select name="parent_id" class="form-control">
                        <option value="">--- Parent (Kategori Utama) ---</option>
                        @foreach ($parents as $p)
                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button class="btn btn-success">Simpan</button>
                <a href="{{ route('admin.job-categories.index') }}" class="btn btn-secondary">Kembali</a>
            </form>

        </div>
    </div>
</div>
@endsection
