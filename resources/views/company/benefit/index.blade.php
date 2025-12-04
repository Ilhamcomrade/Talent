<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Benefit Perusahaan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-light">

    {{-- NAVBAR --}}
    @include('partials.navbar_company')

    <div class="container py-4">

        {{-- ALERT SUCCESS --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- HEADER + BUTTON --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">Daftar Benefit Perusahaan</h3>

            <a href="{{ route('company.benefits.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Benefit
            </a>
        </div>

        {{-- SEARCH BAR --}}
        <form method="GET" action="{{ route('company.benefits.index') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                       placeholder="Cari judul atau deskripsi benefit...">
                <button class="btn btn-secondary" type="submit">
                    Cari
                </button>
            </div>
        </form>

        {{-- TABLE LIST --}}
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover table-bordered mb-0">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th width="50">No</th>
                            <th>Icon</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($benefits as $benefit)
                            <tr class="align-middle">
                                <td class="text-center">
                                    {{ $loop->iteration + ($benefits->currentPage() - 1) * $benefits->perPage() }}
                                </td>

                                <td class="text-center">
                                    @if($benefit->icon)
                                        <img src="{{ asset('storage/' . $benefit->icon) }}"
                                             width="45" height="45"
                                             class="rounded"
                                             alt="Icon Benefit"
                                             style="object-fit: cover;">
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                                <td>{{ $benefit->judul }}</td>
                                <td>{{ Str::limit($benefit->deskripsi, 100) }}</td>

                                <td class="text-center">
                                    <span class="badge bg-{{ $benefit->status === 'aktif' ? 'success' : 'danger' }}">
                                        {{ ucfirst($benefit->status) }}
                                    </span>
                                </td>

                                <td class="text-center">
                                    {{-- EDIT --}}
                                    <a href="{{ route('company.benefits.edit', $benefit) }}"
                                       class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    {{-- DELETE --}}
                                    <form action="{{ route('company.benefits.destroy', $benefit) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin hapus benefit ini?')"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>
                                    </form>

                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-3">
                                    Belum ada data benefit saat ini
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- PAGINATION --}}
        <div class="mt-3">
            {{ $benefits->links() }}
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
