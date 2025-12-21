@extends('admin.layout')

@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-12">
                <h1 class="h2">Manajemen Slider</h1>
                <nav aria-label="breadcrumb">
                </nav>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Slider</h5>
                <a href="{{ route('admin.slider.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Slider
                </a>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if($sliders->isEmpty())
                    <div class="alert alert-info">
                        Belum ada data slider. Silakan tambah slider baru.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Gambar</th>
                                    <th>Dibuat Pada</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sliders as $slider)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if($slider->image_url)
                                            <img src="{{ $slider->image_url }}" alt="Slider" style="width: 100px; height: 60px; object-fit: cover;">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $slider->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.slider.edit', $slider->id) }}" class="btn btn-sm btn-warning">
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.slider.destroy', $slider->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus slider ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
