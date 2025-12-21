<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pelamar: {{ $applicant->nama ?? 'Nama Pelamar' }}</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
            --success-color: #198754;
            --info-color: #0dcaf0;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
            --light-bg: #f4f7f9;
        }

        body {
            background-color: var(--light-bg);
        }

        .container {
            max-width: 1000px;
        }

        /* --- STYLES FOR STEPPER / PROGRESS BAR (Menggunakan nav-tabs) --- */
        .nav-pills-custom .nav-link {
            text-align: center;
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            color: var(--secondary-color);
            background-color: #fff;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            position: relative;
            margin-bottom: 0.5rem;
            border: 1px solid #efe9e9;
        }

        .nav-pills-custom .nav-link:hover {
            color: var(--primary-color);
        }

        .nav-pills-custom .nav-link.active {
            color: #fff;
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .nav-pills-custom .step-icon {
            display: block;
            font-size: 1.25rem;
            margin-bottom: 0.25rem;
        }

        /* Garis pemisah antar tab pada desktop */
        @media (min-width: 768px) {
            .nav-pills-custom {
                border-bottom: 1px solid #e60808; /* Perbaikan: Warna garis bottom */
                margin-bottom: 1.5rem;
            }
            .nav-pills-custom .nav-item:not(:last-child) .nav-link::after {
                
            }
        }


        /* Card Info Header */
        .info-header {
            background-color: #ffffff;
            border-bottom: 1px solid #e9ecef;
            padding: 1.5rem;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .card-detail {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        
        /* Table Styling */
        .table-info th {
            width: 30%;
            background-color: #f8f9fa;
            font-weight: 600;
            color: #495057;
        }
        .table-info td {
            color: #212529;
            vertical-align: middle;
        }
        .table-info a {
            font-weight: 500;
        }
        .table-info tr:last-child td, .table-info tr:last-child th {
            border-bottom: none;
        }

        /* Media file styling */
        .media-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.25rem 0.5rem;
            border-radius: 5px;
            background-color: var(--info-color);
            color: white;
            text-decoration: none;
            transition: opacity 0.2s;
        }
        .media-link:hover {
            opacity: 0.9;
            color: white;
        }
        .media-preview {
            max-width: 150px;
            height: auto;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        /* Action Buttons Group */
        .action-group .btn {
            font-weight: 600;
        }

        /* Form Card Styling */
        .form-card {
            border-left: 5px solid var(--primary-color);
            border-radius: 0.5rem;
        }
    </style>
</head>
<body class="bg-light">

@include('partials.navbar_company')

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark">Detail Pelamar</h3>
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>
    </div>

    {{-- BLOK LOGIKA UNTUK MENENTUKAN WARNA BADGE STATUS (DIPINDAHKAN KE ATAS) --}}
    @php
        $statusColors = [
            'pending' => 'bg-secondary',
            'profile_lolos' => 'bg-primary',
            'wawancara_lolos' => 'bg-warning text-dark',
            'tes_lolos' => 'bg-info text-dark',
            'diterima' => 'bg-success',
            'ditolak' => 'bg-danger',
        ];

        $statusKey = $applicant->status ?? 'pending';
        $statusClass = $statusColors[$statusKey] ?? 'bg-secondary';
        $statusText = ucfirst(str_replace('_', ' ', $statusKey));
    @endphp
    {{-- AKHIR BLOK LOGIKA --}}

    {{-- Header Informasi Pelamar --}}
    <div class="card card-detail mb-4">
        <div class="info-header d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-1 text-primary fw-bold">{{ $applicant->nama ?? 'Nama Pelamar' }}</h4>
                <p class="mb-0 text-muted">{{ $applicant->job->title ?? 'Posisi Tidak Diketahui' }}</p>
            </div>
            {{-- Status di Header --}}
            <span class="badge {{ $statusClass }} fs-6">{{ $statusText }}</span>
        </div>
        
        {{-- TAB NAVIGATION (Ganti Stepper 1-2-3-4 yang lama) --}}
        <div class="card-body pb-0">
            <ul class="nav nav-pills nav-fill nav-pills-custom" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="true">
                        <i class="bi bi-person-circle step-icon"></i> Profil Dasar
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-interview-tab" data-bs-toggle="pill" data-bs-target="#pills-interview" type="button" role="tab" aria-controls="pills-interview" aria-selected="false">
                        <i class="bi bi-calendar-event step-icon"></i> Wawancara & Riwayat
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-doc-tab" data-bs-toggle="pill" data-bs-target="#pills-doc" type="button" role="tab" aria-controls="pills-doc" aria-selected="false">
                        <i class="bi bi-file-earmark-text step-icon"></i> Dokumen & Tes
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-actions-tab" data-bs-toggle="pill" data-bs-target="#pills-actions" type="button" role="tab" aria-controls="pills-actions" aria-selected="false">
                        <i class="bi bi-send-check step-icon"></i> Aksi Status
                    </button>
                </li>
            </ul>
        </div>
    </div>

    {{-- TAB CONTENT AREA --}}
    <div class="card card-detail mb-5 p-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="tab-content" id="pills-tabContent">
            
            {{-- TAB 1: Profil Dasar --}}
            <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <h5 class="fw-bold mb-3 text-primary">Informasi Kontak & Diri</h5>
                <table class="table table-striped table-borderless table-info">
                    <tbody>
                        <tr><th>Nama Lengkap</th><td>{{ $applicant->nama }}</td></tr>
                        <tr><th>Email</th><td>{{ $applicant->email }}</td></tr>
                        <tr><th>Telepon/WhatsApp</th><td>+62 {{ $applicant->telepon ?? '-' }}</td></tr>
                        <tr><th>Tanggal Lahir</th><td>{{ $applicant->tgl_lahir ?? '-' }}</td></tr>
                        <tr><th>Alamat Domisili</th><td>{{ $applicant->alamat ?? '-' }}</td></tr>
                    </tbody>
                </table>
            </div>

            {{-- TAB 2: Wawancara & Riwayat (DITAMBAHKAN FORM WAWANCARA) --}}
            <div class="tab-pane fade" id="pills-interview" role="tabpanel" aria-labelledby="pills-interview-tab">
                <h5 class="fw-bold mb-3 text-primary">Riwayat Pendidikan & Pengalaman Pelamar</h5>
                <table class="table table-striped table-borderless table-info">
                    <tbody>
                        <tr><th>Pendidikan Terakhir</th><td>{{ $applicant->pendidikan ? strtoupper($applicant->pendidikan) : '-' }}</td></tr>
                        <tr><th>Asal Sekolah/Kampus</th><td>{{ $applicant->asal_sekolah ?? '-' }}</td></tr>
                        <tr><th>Pengalaman Kerja</th><td>{{ $applicant->pengalaman_kerja ?? '-' }}</td></tr>
                        <tr><th>Keahlian Utama</th><td>{{ $applicant->keahlian ?? '-' }}</td></tr>
                    </tbody>
                </table>

                <h5 class="fw-bold mt-4 mb-3 text-primary">Informasi Wawancara Saat Ini</h5>
                <table class="table table-striped table-borderless table-info">
                    <tbody>
                        <tr><th>Tanggal Wawancara</th><td>{{ $applicant->tanggal_wawancara ?? '-' }}</td></tr>
                        <tr><th>Link Wawancara</th><td>@if($applicant->link_wawancara)<a href="{{ $applicant->link_wawancara }}" target="_blank" class="text-primary">{{ $applicant->link_wawancara }}</a>@else - @endif</td></tr>
                        <tr><th>Deskripsi Wawancara</th><td>{{ $applicant->desk_wawancara ?? '-' }}</td></tr>
                    </tbody>
                </table>

                <hr class="my-4">

                {{-- FORM UPDATE WAWANCARA BARU --}}
                <div class="card p-3 shadow-sm form-card">
                    <h6 class="fw-bold text-dark mb-3"><i class="bi bi-pencil-square me-2"></i> Perbarui Jadwal Wawancara</h6>
                    <form action="{{ route('company.applications.updateStatus', $applicant->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        {{-- Field yang dikirim untuk update jadwal: --}}
                        <input type="hidden" name="action_type" value="update_wawancara">
                        
                        <div class="mb-3">
                            <label for="tanggal_wawancara" class="form-label">Tanggal Wawancara</label>
                            <input type="date" class="form-control" id="tanggal_wawancara" name="tanggal_wawancara" value="{{ $applicant->tanggal_wawancara }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="link_wawancara" class="form-label">Link Wawancara (Google Meet/Zoom)</label>
                            <input type="url" class="form-control" id="link_wawancara" name="link_wawancara" value="{{ $applicant->link_wawancara }}" placeholder="Contoh: https://meet.google.com/xyz" required>
                        </div>
                        <div class="mb-3">
                            <label for="desk_wawancara" class="form-label">Deskripsi Wawancara</label>
                            <textarea class="form-control" id="desk_wawancara" name="desk_wawancara" rows="3" placeholder="Contoh: Wawancara User, harap siapkan portofolio Anda.">{{ $applicant->desk_wawancara }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-save me-2"></i> Simpan Jadwal Wawancara
                        </button>
                    </form>
                </div>
            </div>

            {{-- TAB 3: Dokumen & Tes (DITAMBAHKAN FORM TES) --}}
            <div class="tab-pane fade" id="pills-doc" role="tabpanel" aria-labelledby="pills-doc-tab">
                <h5 class="fw-bold mb-3 text-primary">Berkas Lamaran</h5>
                <table class="table table-striped table-borderless table-info">
                    <tbody>
                        <tr>
                            <th>Curriculum Vitae (CV)</th>
                            <td>
                                @if($applicant->cv)
                                    <a href="{{ asset('storage/'.$applicant->cv) }}" target="_blank" class="media-link bg-success">
                                        <i class="bi bi-file-earmark-pdf"></i> Lihat CV
                                    </a>
                                @else 
                                    <span class="text-muted">- Tidak Ada -</span>
                                @endif
                            </td>
                        </tr>
                        {{-- Bagian lain dari berkas lamaran di sini... --}}
                        <tr>
                            <th>Surat Lamaran</th>
                            <td>
                                @if($applicant->surat_lamaran)
                                    <a href="{{ asset('storage/'.$applicant->surat_lamaran) }}" target="_blank" class="media-link bg-info">
                                        <i class="bi bi-file-earmark-text"></i> Lihat Surat
                                    </a>
                                @else 
                                    <span class="text-muted">- Tidak Ada -</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Ijazah</th>
                            <td>
                                @if($applicant->ijazah)
                                    <a href="{{ asset('storage/'.$applicant->ijazah) }}" target="_blank" class="media-link bg-secondary">
                                        <i class="bi bi-mortarboard"></i> Lihat Ijazah
                                    </a>
                                @else 
                                    <span class="text-muted">- Tidak Ada -</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Foto Terbaru</th>
                            <td>
                                @if($applicant->foto)
                                    <a href="{{ asset('storage/'.$applicant->foto) }}" target="_blank">
                                        <img src="{{ asset('storage/'.$applicant->foto) }}" alt="Foto Pelamar" class="media-preview">
                                    </a>
                                @else 
                                    <span class="text-muted">- Tidak Ada -</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>

                <h5 class="fw-bold mt-4 mb-3 text-primary">Informasi Tugas/Tes Khusus Saat Ini</h5>
                <table class="table table-striped table-borderless table-info">
                    <tbody>
                        <tr><th>Deskripsi Tes</th><td>{{ $applicant->desk_tes ?? '-' }}</td></tr>
                        <tr><th>Link Pengumpulan Tugas</th><td>@if($applicant->link_tugas)<a href="{{ $applicant->link_tugas }}" target="_blank">{{ $applicant->link_tugas }}</a>@else - @endif</td></tr>
                        <tr><th>Catatan Tambahan</th><td>{{ $applicant->catatan ?? '-' }}</td></tr>
                    </tbody>
                </table>
                
                <hr class="my-4">

                {{-- FORM UPDATE TES/TUGAS BARU --}}
                <div class="card p-3 shadow-sm form-card">
                    <h6 class="fw-bold text-dark mb-3"><i class="bi bi-gear-fill me-2"></i> Tetapkan Tugas/Tes Khusus</h6>
                    <form action="{{ route('company.applications.updateStatus', $applicant->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        {{-- Field yang dikirim untuk update jadwal: --}}
                        <input type="hidden" name="action_type" value="update_tes">

                        <div class="mb-3">
                            <label for="desk_tes" class="form-label">Deskripsi Tes/Tugas</label>
                            <textarea class="form-control" id="desk_tes" name="desk_tes" rows="3" placeholder="Contoh: Buatlah mock-up website untuk proyek A, dikumpulkan dalam format PDF.">{{ $applicant->desk_tes }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="link_tugas" class="form-label">Link Pengumpulan Tugas (Jika Ada)</label>
                            <input type="url" class="form-control" id="link_tugas" name="link_tugas" value="{{ $applicant->link_tugas }}" placeholder="Contoh: https://forms.gle/xyz">
                        </div>
                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan Tambahan</label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="2" placeholder="Tenggat waktu: Jumat, 10 Mei 2025">{{ $applicant->catatan }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-save me-2"></i> Simpan Detail Tes/Tugas
                        </button>
                    </form>
                </div>
            </div>

            {{-- TAB 4: Aksi Status (Penerimaan) --}}
            <div class="tab-pane fade" id="pills-actions" role="tabpanel" aria-labelledby="pills-actions-tab">
                <h5 class="fw-bold mb-4 text-primary">Perbarui Status Pelamar</h5>
                
                <div class="alert alert-info border-0 shadow-sm" role="alert">
                    Status saat ini: 
                    <span class="badge {{ $statusClass }} fw-bold fs-6">
                        {{ $statusText }}
                    </span>
                </div>

                <div class="action-group d-flex flex-wrap gap-3">
                    {{-- Tombol Aksi Status --}}
                    <form action="{{ route('company.applications.updateStatus', $applicant->id) }}" method="POST">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="profile_lolos">
                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-check-circle-fill me-2"></i> Lolos Seleksi Profil
                        </button>
                    </form>
                    <form action="{{ route('company.applications.updateStatus', $applicant->id) }}" method="POST">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="wawancara_lolos">
                        <button class="btn btn-warning text-dark" type="submit">
                            <i class="bi bi-check-circle-fill me-2"></i> Lolos Wawancara
                        </button>
                    </form>
                    <form action="{{ route('company.applications.updateStatus', $applicant->id) }}" method="POST">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="tes_lolos">
                        <button class="btn btn-info text-dark" type="submit">
                            <i class="bi bi-check-circle-fill me-2"></i> Lolos Tes Khusus
                        </button>
                    </form>
                    
                    <hr class="w-100 my-2">

                    <form action="{{ route('company.applications.updateStatus', $applicant->id) }}" method="POST">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="diterima">
                        <button class="btn btn-success" type="submit">
                            <i class="bi bi-person-check-fill me-2"></i> Terima Pelamar
                        </button>
                    </form>
                    <form action="{{ route('company.applications.updateStatus', $applicant->id) }}" method="POST">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="ditolak">
                        <button class="btn btn-danger" type="submit">
                            <i class="bi bi-person-x-fill me-2"></i> Tolak Pelamar
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>