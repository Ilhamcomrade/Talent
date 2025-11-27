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
    width: 90px;
    height: 90px;
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
            <h1 class="h3 mb-4 text-gray-800">Manajemen Kampus/Sekolah</h1>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Kampus/Sekolah</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Logo</th>
                                    <th>Nama Kampus/Sekolah</th>
                                    <th>Pendaftar</th>
                                    <th>Jenis Institusi</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($campuses as $campus)
                                <tr>
                                    <td class="text-center">
                                        <div class="table-logo">
                                            @if ($campus->logo_path)
                                                <img src="{{ asset('storage/' . $campus->logo_path) }}" alt="{{ $campus->nama_kampus }}">
                                            @else
                                                <i class="fas fa-school fa-2x text-secondary"></i>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <strong>{{ $campus->nama_kampus }}</strong><br>
                                        <small class="text-muted">{{ $campus->jumlah_pegawai }} pegawai</small>
                                    </td>
                                    <td>
                                        <strong>{{ $campus->nama_lengkap }}</strong><br>
                                        <small class="text-muted">{{ $campus->jabatan }}</small><br>
                                        <small class="text-muted">{{ $campus->no_hp }}</small>
                                    </td>
                                    <td>{{ $campus->jenis_institusi }}</td>
                                    <td>{{ $campus->email }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                                    <!-- Ubah route untuk menggunakan slug -->
                                            <a href="{{ route('admin.campus.show', $campus->slug) }}" class="btn btn-info" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <form action="{{ route('admin.campus.destroy', $campus->slug) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kampus ini?')">
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
                                    <td colspan="6" class="text-center">Tidak ada data kampus.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $campuses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Initialize DataTable
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
            },
            "pageLength": 25,
            "order": [[1, 'asc']], // Urutkan berdasarkan nama kampus
            "paging": false, // Nonaktifkan paging DataTable karena sudah menggunakan Laravel pagination
            "searching": true, // Biarkan fitur pencarian aktif
            "info": false // Sembunyikan info "Showing X of Y entries"
        });
    });
</script>
@endsection
