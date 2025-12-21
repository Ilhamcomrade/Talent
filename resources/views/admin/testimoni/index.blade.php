@extends('admin.layout')

@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-md-8">
                <h1 class="h3 mb-0">Manajemen Testimoni</h1>
                <p class="text-muted">Kelola testimoni yang akan ditampilkan di halaman utama</p>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('admin.testimoni.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Testimoni
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="50">#</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Umur</th>
                                <th>Pekerjaan</th>
                                <th width="300">Kesan Pesan</th>
                                <th>Status</th>
                                <th width="150">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($testimonis as $testimoni)
                            <tr>
                                <td>{{ $loop->iteration + (($testimonis->currentPage() - 1) * $testimonis->perPage()) }}</td>
                                <td>
                                    <img src="{{ $testimoni->foto_url }}" alt="{{ $testimoni->nama }}"
                                         class="rounded-circle" width="50" height="50" style="object-fit: cover;">
                                </td>
                                <td>{{ $testimoni->nama }}</td>
                                <td>{{ $testimoni->umur }} tahun</td>
                                <td>{{ $testimoni->pekerjaan }}</td>
                                <td>
                                    <small style="
                                        display: inline-block;
                                        max-width: 300px;
                                        word-wrap: break-word;
                                        overflow-wrap: break-word;
                                        white-space: normal;
                                        line-height: 1.4;
                                    ">
                                        "{{ Str::limit($testimoni->kesan_pesan, 150) }}"
                                    </small>
                                </td>
                                <td>
                                    <span class="badge {{ $testimoni->status === 'aktif' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $testimoni->status === 'aktif' ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.testimoni.edit', $testimoni) }}"
                                           class="btn btn-sm btn-warning">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.testimoni.destroy', $testimoni) }}"
                                              method="POST" class="d-inline"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus testimoni ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="fas fa-comment-slash fa-2x mb-3"></i>
                                        <p>Belum ada testimoni</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $testimonis->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
