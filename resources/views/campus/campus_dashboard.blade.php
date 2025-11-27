<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Kampus/Sekolah | InotalHub</title>

    <link rel="icon" type="image/png" href="{{ asset('1.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"/>

    <style>
        body {
            background-color: #f7f9fb;
            font-family: Arial, sans-serif;
        }

        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
            padding: 15px;
            border-radius: 4px;
            margin: 20px auto;
            max-width: 800px;
        }

        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
            padding: 15px;
            border-radius: 4px;
            margin: 20px auto;
            max-width: 800px;
        }

        .logo-card {
            height: 100%;
            background-color: #ffffff;
        }

        .logo-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            text-align: center;
        }

        .logo-image {
            max-width: 200px;
            max-height: 200px;
            width: auto;
            height: auto;
            border-radius: 8px;
            object-fit: contain;
            margin-bottom: 1.5rem;
            border: 2px solid #e9ecef;
            padding: 10px;
            background-color: #fff;
        }

        .logo-placeholder {
            width: 200px;
            height: 200px;
            border-radius: 8px;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            border: 2px dashed #dee2e6;
        }

        .logo-placeholder i {
            font-size: 3rem;
            color: #6c757d;
        }

        .logo-title {
            font-size: 1.1rem;
            font-weight: 700; /* Diubah dari 600 menjadi 700 untuk lebih bold */
            color: #495057;
            margin-bottom: 0.5rem;
        }

        .logo-subtitle {
            font-size: 0.9rem;
            color: #6c757d;
        }
    </style>
</head>
<body>

    {{-- Navbar --}}
    @include('partials.navbar_campus')

    <!-- Tampilkan pesan sukses jika ada -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
    @endif

    <div class="container mt-4">
        <div class="row justify-content-center">
            <!-- Card Informasi Kampus -->
            <div class="col-md-8 mb-4">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="fas fa-university"></i> Informasi Kampus/Sekolah</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Nama Kampus/Sekolah:</strong><br>{{ Auth::guard('campus')->user()->nama_kampus }}</p>
                                <p><strong>Email:</strong><br>{{ Auth::guard('campus')->user()->email }}</p>
                                <p><strong>Jabatan:</strong><br>{{ Auth::guard('campus')->user()->jabatan }}</p>
                                <p><strong>Jenis Institusi:</strong><br>{{ Auth::guard('campus')->user()->jenis_institusi }}</p>
                                <p><strong>Jumlah Pegawai:</strong><br>{{ Auth::guard('campus')->user()->jumlah_pegawai }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Provinsi:</strong><br>{{ Auth::guard('campus')->user()->provinsi }}</p>
                                <p><strong>Kabupaten/Kota:</strong><br>{{ Auth::guard('campus')->user()->kota }}</p>
                                <p><strong>Kecamatan:</strong><br>{{ Auth::guard('campus')->user()->kecamatan }}</p>
                                <p><strong>Desa/Kelurahan:</strong><br>{{ Auth::guard('campus')->user()->desa_kelurahan }}</p>
                                <p><strong>Alamat Lengkap:</strong><br>{{ Auth::guard('campus')->user()->alamat_lengkap }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Logo Kampus -->
            <div class="col-md-4 mb-4">
                <div class="card logo-card">
                    <!-- PERUBAHAN: Warna header diubah dari bg-primary menjadi bg-success -->
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="fas fa-image"></i> Logo Kampus/Sekolah</h5>
                    </div>
                    <div class="card-body logo-container">
                        @if(Auth::guard('campus')->user()->logo_path)
                            <img src="{{ asset('storage/' . Auth::guard('campus')->user()->logo_path) }}"
                                 alt="Logo {{ Auth::guard('campus')->user()->nama_kampus }}"
                                 class="logo-image">
                        @else
                            <div class="logo-placeholder">
                                <i class="fas fa-university"></i>
                            </div>
                        @endif
                        <!-- PERUBAHAN: Class logo-title sudah menggunakan font-weight: 700 (bold) -->
                        <div class="logo-title">{{ Auth::guard('campus')->user()->nama_kampus }}</div>
                        <div class="logo-subtitle">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
