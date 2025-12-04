<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar Lowongan Magang</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

    {{-- NAVBAR --}}
    @include('partials.navbar_company')

    <div class="container py-4">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0">Daftar Lowongan Magang</h3>
            <a href="{{ route('company.magang.create') }}" class="btn btn-primary">
                + Tambah Magang
            </a>
        </div>

        {{-- Alert --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Search --}}
        <form method="GET" class="mb-3">
            <div class="input-group">
                <input type="text"
                       name="search"
                       class="form-control"
                       placeholder="Cari judul, lokasi, atau departemen..."
                       value="{{ $search }}">
                <button class="btn btn-secondary" type="submit">Cari</button>
            </div>
        </form>

        <div class="card shadow-sm">
            <div class="card-body p-0">

                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Judul</th>
                                <th>Departemen</th>
                                <th>Lokasi</th>
                                <th>Tipe</th>
                                <th>Status</th>
                                <th>Deadline</th>
                                <th width="140">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($magang as $item)
                            <tr>
                                <td>{{ $loop->iteration + ($magang->currentPage() - 1) * $magang->perPage() }}</td>

                                <td>
                                    <strong>{{ $item->title }}</strong>
                                    <br>
                                    <small class="text-muted">{{ Str::limit($item->deskripsi, 50) }}</small>
                                </td>

                                <td>{{ $item->department ?? '-' }}</td>
                                <td>{{ $item->lokasi }}</td>

                                {{-- Type --}}
                                <td>
                                    <span class="badge bg-info text-dark">
                                        {{ ucfirst($item->type) }}
                                    </span>
                                </td>

                                {{-- Status --}}
                                <td>
                                    @if($item->status == 'aktif')
                                        <span class="badge bg-success">Aktif</span>
                                    @elseif($item->status == 'nonaktif')
                                        <span class="badge bg-secondary">Nonaktif</span>
                                    @else
                                        <span class="badge bg-danger">Expired</span>
                                    @endif
                                </td>

                                {{-- Deadline --}}
                                <td>
                                    {{ $item->deadline ? date('d M Y', strtotime($item->deadline)) : '-' }}
                                </td>

                                {{-- Aksi --}}
                                <td>
                                    <a href="{{ route('company.magang.show', $item->id) }}"
                                       class="btn btn-sm btn-info">Detail</a>

                                    <a href="{{ route('company.magang.edit', $item->id) }}"
                                       class="btn btn-sm btn-warning">Edit</a>

                                    <form action="{{ route('company.magang.destroy', $item->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-3">
                                        Tidak ada data magang ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

            </div>
        </div>

        {{-- Pagination --}}
        <div class="mt-3">
            {{ $magang->links() }}
        </div>

    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
