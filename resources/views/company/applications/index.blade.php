<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Semua Pelamar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .unread-row {
            background-color: #e9ecef !important;
        }
    </style>
</head>

<body class="bg-light" style="padding-top: 90px;">

@include('partials.navbar_company')

<div class="container">

    <h2 class="mb-4 fw-bold">Daftar Semua Pelamar</h2>

    <div class="card shadow-sm">
        <div class="table-responsive">

            <table class="table table-bordered mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Pendidikan</th>
                        <th>Lowongan</th>
                        <th>Alamat</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($applications as $a)
                    <tr class="{{ $a->is_read ? '' : 'unread-row' }}">

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $a->nama }}</td>

                        <td>{{ $a->pendidikan ?? '-' }}</td>

                        <td>{{ $a->job->title ?? '-' }}</td>

                        <td>{{ Str::limit($a->alamat, 40) }}</td>

                        <td>
                            @switch($a->status)
                                @case('masuk')
                                    <span class="badge bg-secondary">Masuk</span>
                                    @break

                                @case('diproses')
                                    <span class="badge bg-warning text-dark">Diproses</span>
                                    @break

                                @case('profile_lolos')
                                    <span class="badge bg-info text-dark">Profile Lolos</span>
                                    @break

                                @case('wawancara_lolos')
                                    <span class="badge bg-primary">Wawancara Lolos</span>
                                    @break

                                @case('tes_lolos')
                                    <span class="badge bg-success">Tes Lolos</span>
                                    @break

                                @case('diterima')
                                    <span class="badge bg-success">Diterima</span>
                                    @break

                                @case('ditolak')
                                    <span class="badge bg-danger">Ditolak</span>
                                    @break

                                @default
                                    <span class="badge bg-secondary">Tidak diketahui</span>
                            @endswitch
                        </td>

                        <td>
                            <a href="{{ route('company.applications.show', $a->id) }}" 
                               class="btn btn-sm btn-primary">
                                Detail
                            </a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
