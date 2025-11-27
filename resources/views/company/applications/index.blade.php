<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Semua Pelamar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
    @include('partials.navbar_company')

    <div class="container">
        <h2 class="mb-4">Daftar Semua Pelamar</h2>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Lowongan</th>
                    <th>Status</th>
                    <th>Tanggal Lamar</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($applications as $a)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $a->nama }}</td>
                    <td>{{ $a->email }}</td>
                    <td>{{ $a->job->title ?? '-' }}</td>
                    <td>
                        <span class="badge bg-info text-dark">{{ $a->status }}</span>
                    </td>
                    <td>{{ $a->created_at }}</td>
                    <td>
                        <a href="{{ route('company.applications.show', $a->id) }}" class="btn btn-sm btn-primary">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</body>
</html>
