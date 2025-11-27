<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Lowongan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    {{-- NAVBAR --}}
    @include('partials.navbar_company')

    <div class="container py-4">

        {{-- ALERT SUCCESS --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- HEADER + BUTTON --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">Daftar Lowongan</h3>

            <a href="{{ route('companiesjobs.create') }}" class="btn btn-primary">
                + Tambah Lowongan
            </a>
        </div>

        {{-- SEARCH BAR --}}
        <form method="GET" action="{{ route('companiesjobs.index') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" value="{{ $search }}" class="form-control"
                       placeholder="Cari judul, nama perusahaan, atau industri...">
                <button class="btn btn-secondary" type="submit">Cari</button>
            </div>
        </form>

        {{-- TABLE LIST --}}
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover table-bordered mb-0">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th width="50">#</th>
                            <th>Logo</th>
                            <th>Judul</th>
                            <th>Perusahaan</th>
                            <th>Industri</th>
                            <th width="180">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($jobs as $job)
                            <tr class="align-middle">
                                <td class="text-center">{{ $loop->iteration }}</td>

                                <td class="text-center">
                                    @if($job->company_logo)
                                        <img src="{{ asset('storage/' . $job->company_logo) }}" width="45" height="45" class="rounded">
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                                <td>{{ $job->title }}</td>
                                <td>{{ $job->company_name }}</td>
                                <td>{{ $job->industry ?? '-' }}</td>

                                <td class="text-center">

                                    {{-- DETAIL --}}
                                    <a href="{{ route('companiesjobs.show', $job->id) }}"
                                       class="btn btn-info btn-sm">
                                        Detail
                                    </a>

                                    {{-- EDIT --}}
                                    <a href="{{ route('companiesjobs.edit', $job->id) }}"
                                       class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    {{-- DELETE --}}
                                    <form action="{{ route('companiesjobs.destroy', $job->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin hapus data ini?')"
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
                                    Tidak ada data ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- PAGINATION --}}
        <div class="mt-3">
            {{ $jobs->links() }}
        </div>

    </div>

</body>
</html>
