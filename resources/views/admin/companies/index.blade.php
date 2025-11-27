@extends('admin.layout')

<style>
.btn-group {
    display: flex;
    gap: 5px;
}
.btn-group .btn {
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 38px;
    width: 38px;
    padding: 0;
}
.btn-group .btn i {
    font-size: 16px;
    line-height: 1;
}

/* === Penyeragaman ukuran logo di halaman INDEX === */
.table-logo {
    width: 90px; /* sebelumnya 70px */
    height: 90px; /* sebelumnya 70px */
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #fff;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}
.table-logo img {
    width: 100%;
    height: 100%;
    object-fit: contain; /* ✅ menjaga proporsi logo tanpa merusak bentuk */
}
</style>

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="h3 mb-4 text-gray-800">Manajemen Perusahaan</h1>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Perusahaan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Logo</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Pendaftar</th>
                                    <th>Industri</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($companies as $company)
                                <tr>
                                    <td class="text-center">
                                        <div class="table-logo">
                                            @if ($company->logo)
                                                <img src="{{ Storage::url($company->logo) }}" alt="{{ $company->nama_perusahaan }}">
                                            @else
                                                <i class="fas fa-building fa-2x text-secondary"></i>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <strong>{{ $company->nama_perusahaan }}</strong><br>
                                        <small class="text-muted">{{ $company->jumlah_karyawan }} karyawan</small>
                                    </td>
                                    <td>
                                        <strong>{{ $company->nama_lengkap }}</strong><br>
                                        <small class="text-muted">{{ $company->jabatan }}</small><br>
                                        <small class="text-muted">{{ $company->no_hp }}</small>
                                    </td>
                                    <td>{{ $company->industri }}</td>
                                    <td>{{ $company->email }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                               <!-- Ubah route untuk menggunakan slug -->
                                        <a href="{{ route('admin.companies.show', $company->slug) }}" class="btn btn-info" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.companies.destroy', $company->slug) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus perusahaan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                            </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data perusahaan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $companies->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
