<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kelola Lowongan | Next Employer</title>

    <link rel="icon" type="image/png" href="{{ asset('1.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
</head>

<body>

@include('partials.navbar_company')
@include('partials.header_company')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Daftar Lowongan</h3>
        <a href="{{ route('company.jobs.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Tambah Lowongan
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Perusahaan</th>
                        <th>Tipe</th>
                        <th>Gaji</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($jobs as $job)
                    <tr>
                        <td>{{ $job->title }}</td>
                        <td>{{ $job->company_name }}</td>
                        <td>{{ $job->employment_type }}</td>
                        <td>
                            @if($job->show_salary)
                                Rp {{ number_format($job->salary_min) }} - Rp {{ number_format($job->salary_max) }}
                            @else
                                Tidak ditampilkan
                            @endif
                        </td>
                        <td>

                            <a href="{{ route('company.jobs.edit', $job->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('company.jobs.destroy', $job->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Hapus lowongan ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

</div>

</body>
</html>
