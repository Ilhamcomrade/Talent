<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $job->title ?? 'Lowongan Pekerjaan' }} - {{ $job->company_name ?? config('app.name') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    /* Tambahan/Perubahan Gaya CSS */
    .job-detail-card {
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        padding: 0; /* Hapus padding agar konten dalam bisa diatur */
    }
    .main-content-wrapper {
        padding: 24px; /* Padding untuk konten utama di sisi kiri */
    }
    .right-info-wrapper {
        border-left: 1px solid #e9ecef;
        padding: 24px;
        background-color: #f7f7f7; /* Background abu-abu muda untuk membedakan */
    }
    @media (max-width: 991.98px) {
        .right-info-wrapper {
            border-left: none;
            border-top: 1px solid #e9ecef;
            padding: 15px;
            background-color: #ffffff;
        }
    }
    .custom-breadcrumb a {
        color: #007bff;
        text-decoration: none;
        font-size: 0.9rem;
    }
    .breadcrumb-separator {
        margin: 0 5px;
        color: #6c757d;
    }
</style>
@include('partials.navbar')

<div class="container mt-4">
    <div class="row">
        {{-- =================================== --}}
        {{-- KOLOM KIRI (GABUNGAN DUA KONTEN UTAMA) --}}
        {{-- =================================== --}}
        <div class="col-lg-8 col-12">
            
            {{-- Breadcrumb --}}
            <nav class="custom-breadcrumb mt-4 text-start" aria-label="breadcrumb">
                <a href="{{ route('jobs.index') }}">Pekerjaan</a>
                <span class="breadcrumb-separator">/</span>
                <a href="#">{{ $job->location_string ?? 'Lokasi' }}</a>
                <span class="breadcrumb-separator">/</span>
                <span class="text-muted">{{ $job->title ?? 'Detail Pekerjaan' }}</span>
            </nav>

            {{-- Card Utama yang Menggabungkan Detail dan QR Code --}}
            <div class="job-detail-card mt-4 mb-4">
                <div class="row g-0">
                    
                    {{-- Sisi Kiri Card (Detail Pekerjaan) --}}
                    <div class="col-lg-8 col-12 main-content-wrapper">
                        
                        {{-- 1. KOTAK STATUS LAMARAN --}}
                        @if($job->has_applied)
                        <div class="alert alert-warning-custom text-start p-3 mb-4" role="alert" style="background-color: #fff9f0; border-left: 5px solid #ff9900; color: #333;">
                            <p class="mb-1 fw-bold">Kamu sudah melamar pekerjaan ini. Silakan cek lamaran saya untuk pantau statusnya.</p>
                            <small class="text-muted">Cek lamaran saya untuk melacak status lamaran kamu.</small>
                        </div>
                        @endif
                        {{-- Akhir Kotak Status --}}

                        <div class="job-card-main pt-0">
                            
                            {{-- Logo, Title, and Company Info --}}
                            @php
                                $logo_src = ($job->company_logo && Storage::disk('public')->exists($job->company_logo)) ? asset('storage/' . $job->company_logo) : null;
                            @endphp
                            <div class="d-flex align-items-start mb-3 pt-3">
                                <div class="company-logo-main rounded-3 me-3" 
                                    style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; background-color: #f0f0f0; border: 1px solid #e0e0e0;">
                                    @if($logo_src)
                                        <img src="{{ $logo_src }}" 
                                            alt="Logo {{ $job->company_name ?? 'Perusahaan' }}" 
                                            style="width: 100%; height: 100%; object-fit: contain;">
                                    @else
                                        <span class="logo-initials" style="font-size: 1.5rem; color: #666;">
                                            {{ substr($job->company_name ?? 'CO', 0, 2) }}
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="flex-grow-1">
                                    <h1 class="job-title-main mb-1" style="font-size: 1.75rem;">{{ $job->title ?? 'Judul Tidak Ada' }}</h1>
                                    <p class="company-name-main mb-0" style="font-size: 1rem; color: #007bff;">
                                        <a href="#" class="text-decoration-none">{{ $job->company_name ?? 'Nama Perusahaan' }}</a>
                                        @if(($job->companyRelation->is_verified ?? false))
                                            <i class="bi bi-patch-check-fill verified-icon ms-1" title="Perusahaan Terverifikasi" style="color: #17a2b8;"></i>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            {{-- Meta Info (Gaji, Lokasi, Tipe, Edukasi, Pengalaman) --}}
                            <div class="d-flex flex-column align-items-start mb-3" style="font-size: 0.95rem;">
                                {{-- Gaji --}}
                                <div class="d-flex align-items-center mb-2 text-dark">
                                    <i class="bi bi-cash-coin me-2 text-muted" style="font-size: 1.1rem;"></i>
                                    <strong class="me-1">{{ $job->formatted_salary ?? 'Gaji Tidak Ditampilkan' }}</strong>
                                    @if($job->formatted_salary && $job->formatted_salary != 'Gaji Tidak Ditampilkan')
                                        <span class="text-muted">/Bulan</span>
                                    @endif
                                </div>
                                
                                {{-- Lokasi dan Industri --}}
                                <div class="d-flex align-items-center mb-2 text-dark">
                                    <i class="bi bi-geo-alt-fill me-2 text-muted" style="font-size: 1.1rem;"></i>
                                    <span>{{ $job->location_string ?? 'Lokasi tidak tersedia' }}</span>
                                    @if($job->industry)
                                        <span class="mx-2 text-muted">|</span>
                                        <span>{{ $job->industry }}</span>
                                    @endif
                                </div>
                                
                                {{-- Tipe Pekerjaan/Kebijakan Kerja --}}
                                <div class="d-flex align-items-center mb-2 text-dark">
                                    <i class="bi bi-clock-fill me-2 text-muted" style="font-size: 1.1rem;"></i>
                                    <span>
                                        <strong>{{ ucfirst(str_replace('-', ' ', $job->employment_type ?? 'Tidak Diketahui')) }}</strong> 
                                        <span class="text-muted">|</span> 
                                        {{ $job->work_mode == 'kerja_di_kantor' ? 'Kerja di kantor' : ($job->work_mode == 'remote' ? 'Remote' : ($job->work_mode == 'hybrid' ? 'Hybrid' : 'Kebijakan Kerja')) }}
                                    </span>
                                </div>

                                {{-- Minimal Pendidikan --}}
                                <div class="d-flex align-items-center mb-2 text-dark">
                                    <i class="bi bi-mortarboard-fill me-2 text-muted" style="font-size: 1.1rem;"></i>
                                    <span>Minimal <strong>{{ $job->formatted_education ?? 'Tidak Diketahui' }}</strong></span>
                                </div>

                                {{-- Pengalaman --}}
                                <div class="d-flex align-items-center text-dark">
                                    <i class="bi bi-person-badge-fill me-2 text-muted" style="font-size: 1.1rem;"></i>
                                    <span>
                                        @php
                                            $experience = $job->experience ?? 'Tidak Diketahui';
                                            $experience = str_replace('_', ' ', $experience);
                                            $experience = str_replace('kurang setahun', 'Kurang dari 1 tahun', $experience);
                                            $experience = str_replace('belum pengalaman', 'Belum berpengalaman', $experience);
                                            $experience = str_replace('fresh graduate', 'Fresh Graduate', $experience);
                                            $experience = ucfirst($experience);
                                        @endphp
                                        <strong>{{ $experience }}</strong>
                                    </span>
                                </div>

                            </div>

                            {{-- Status Badges --}}
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                @if($job->applicants_count > 10)
                                    <span class="badge bg-danger text-white px-2 py-1" style="font-size: 0.75rem; font-weight: 700;">HOT JOB</span>
                                @endif
                                <span class="badge bg-primary text-white px-2 py-1" style="font-size: 0.75rem; font-weight: 700;">AKTIF MEREKRUT</span>
                            </div>

                            {{-- Footer Info (Tanggal Tayang/Update) --}}
                            <div class="footer-info d-flex align-items-center mb-4" style="font-size: 0.85rem; color: #6c757d;">
                                <span><i class="bi bi-calendar-event me-1"></i> Tayang {{ $job->created_at ? $job->created_at->diffForHumans() : 'sejak lama' }}</span>
                                <span class="mx-2">|</span>
                                <span><i class="bi bi-arrow-clockwise me-1"></i> Diperbarui {{ $job->updated_at ? $job->updated_at->diffForHumans() : 'Tidak Diketahui' }}</span>
                            </div>
                            
                            {{-- Tombol Aksi (HANYA MUNCUL JIKA BELUM MELAMAR) --}}
                            @if(!$job->has_applied)
                            <div class="btn-group-actions d-flex mb-4">
                                <a href="{{ route('jobs.apply', $job->id) }}" class="btn btn-primary btn-lg me-3" style="font-weight: 600; background-color: #007bff; border-color: #007bff;">
                                    <i class="bi bi-send-check me-2"></i> Lamar Sekarang
                                </a>

                                {{-- <button class="btn btn-outline-secondary me-2" onclick="chatHrd()" title="Chat dengan HRD" style="border: 1px solid #ccc;">
                                    <i class="bi bi-chat-dots" style="font-size: 1.2rem;"></i>
                                </button> --}}

                                <button class="btn btn-outline-secondary me-2" onclick="saveJob()" title="Simpan Lowongan" style="border: 1px solid #ccc;">
                                    <i class="bi bi-bookmark" style="font-size: 1.2rem;"></i>
                                </button>

                                <button class="btn btn-outline-secondary" onclick="shareJob()" title="Bagikan Lowongan" style="border: 1px solid #ccc;">
                                    <i class="bi bi-share" style="font-size: 1.2rem;"></i>
                                </button>
                            </div>
                            @endif

                            {{-- LOKER DIKELOLA OLEH dipindahkan ke bagian bawah (setelah Tombol Aksi) --}}
                            @if($job->company_name)
                            <hr class="my-4">
                            <div class="job-section mb-5 p-3 rounded-3" style="background-color: #f8f9fa; border: 1px solid #e9ecef;">
                                <h3 class="section-title fw-bold" style="font-size: 1.25rem;">Loker dikelola oleh</h3>
                                <div class="d-flex align-items-center mt-3">
                                    <div class="company-logo-main rounded-3 me-3" 
                                        style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; background-color: #e0e0e0;">
                                            @if($logo_src)
                                                <img src="{{ $logo_src }}" 
                                                        alt="Logo {{ $job->company_name ?? 'Perusahaan' }}" 
                                                        style="width: 100%; height: 100%; object-fit: contain;">
                                            @else
                                                <span class="logo-initials" style="font-size: 1rem; color: #666;">
                                                    {{ substr($job->company_name ?? 'CO', 0, 2) }}
                                                </span>
                                            @endif
                                    </div>
                                    <div>
                                        <p class="mb-0 fw-bold">{{ $job->company_name ?? 'Nama Perusahaan' }}</p>
                                        <small class="text-muted">Online kemaren</small>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            {{-- Konten lainnya (Persyaratan, Deskripsi, Tanggung Jawab, Kualifikasi, Nilai Tambah) --}}

                            <hr class="my-4">
                            
                            {{-- Bagian Persyaratan --}}
                            @if(!empty($job->requirements_list) || $job->work_mode || $job->experience || $job->education_level)
                            <div class="job-section mb-5">
                                <h3 class="section-title fw-bold" style="font-size: 1.25rem;">Persyaratan</h3>
                                <div class="tags-container d-flex flex-wrap gap-2">
                                    
                                    @if($job->work_mode)
                                        <span class="badge bg-light text-dark p-2" style="border: 1px solid #e0e0e0; font-weight: normal;">
                                            {{ $job->work_mode == 'kerja_di_kantor' ? 'Kerja di Kantor' : ($job->work_mode == 'remote' ? 'Remote' : 'Hybrid') }}
                                        </span>
                                    @endif
                                    @if($job->experience)
                                        @php
                                            $exp_label = str_replace('_', ' ', $job->experience);
                                            $exp_label = str_replace('kurang setahun', 'Kurang dari 1 tahun', $exp_label);
                                        @endphp
                                        <span class="badge bg-light text-dark p-2" style="border: 1px solid #e0e0e0; font-weight: normal;">
                                            {{ ucfirst($exp_label) }} 
                                        </span>
                                    @endif
                                    @if($job->education_level)
                                        <span class="badge bg-light text-dark p-2" style="border: 1px solid #e0e0e0; font-weight: normal;">
                                            Minimal {{ $job->formatted_education }}
                                        </span>
                                    @endif

                                    @if(!empty($job->requirements_list))
                                        @foreach($job->requirements_list as $req)
                                            @php $clean_req = trim($req); @endphp
                                            @if(!empty($clean_req))
                                                <span class="badge bg-light text-dark p-2" style="border: 1px solid #e0e0e0; font-weight: normal;">
                                                    {{ $clean_req }}
                                                </span>
                                            @endif
                                        @endforeach
                                    @endif

                                </div>

                                {{-- Skills --}}
                                @if(!empty($job->skills_list))
                                <div class="mt-4">
                                    <h4 class="fw-bold mb-2" style="font-size: 1rem;">Keahlian yang Dibutuhkan <i class="bi bi-info-circle text-muted ms-1"></i></h4>
                                    <div class="tags-container d-flex flex-wrap gap-2 mt-2">
                                        @foreach($job->skills_list as $skill)
                                            @php $clean_skill = trim($skill); @endphp
                                            @if(!empty($clean_skill))
                                                <span class="badge bg-light text-primary p-2" style="border: 1px solid #007bff; font-weight: normal;">
                                                    <i class="bi bi-check-lg text-primary me-1"></i> {{ $clean_skill }}
                                                </span>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>
                            @endif
                            
                            
                            {{-- Deskripsi Pekerjaan --}}
                            @if(!empty($job->description_list))
                            <div class="job-section mb-5">
                                <h3 class="section-title fw-bold" style="font-size: 1.25rem;">Deskripsi Pekerjaan {{ $job->title ?? '' }}</h3>
                                <div class="job-description mt-3">
                                    <ul>
                                        @foreach($job->description_list as $desc)
                                            @if(trim($desc))
                                                <li>{{ trim($desc) }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endif
                            
                            {{-- Tanggung Jawab --}}
                            @if(!empty($job->tanggung_jawab_list))
                            <div class="job-section mb-5">
                                <h3 class="section-title fw-bold" style="font-size: 1.25rem;">Tanggung Jawab</h3>
                                <div class="job-description mt-3">
                                    <ul>
                                        @foreach($job->tanggung_jawab_list as $tanggung)
                                            @if(trim($tanggung))
                                                <li>{{ trim($tanggung) }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endif

                            {{-- Kualifikasi (Jika dipisahkan dari Persyaratan) --}}
                            @if(!empty($job->kualifikasi_list))
                            <div class="job-section mb-5">
                                <h3 class="section-title fw-bold" style="font-size: 1.25rem;">Kualifikasi Tambahan</h3>
                                <div class="qualification-content mt-3">
                                    <ul>
                                        @foreach($job->kualifikasi_list as $kualifikasi)
                                            @if(trim($kualifikasi))
                                                <li>{{ trim($kualifikasi) }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endif
                            
                            {{-- Nilai Tambah --}}
                            @if(!empty($job->nilai_tambah_list))
                            <div class="job-section mb-5">
                                <h3 class="section-title fw-bold" style="font-size: 1.25rem;">Nilai Tambah</h3>
                                <div class="qualification-content mt-3">
                                    <ul>
                                        @foreach($job->nilai_tambah_list as $nilai)
                                            @if(trim($nilai))
                                                <li>{{ trim($nilai) }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endif

                            {{-- Tentang Perusahaan --}}
                            <div class="job-section mb-5 p-3 rounded-3" style="border: 1px solid #e9ecef;">
                                <h3 class="section-title fw-bold mb-3" style="font-size: 1.25rem;">Tentang Perusahaan</h3>
                                
                                <div class="d-flex align-items-start mb-3">
                                    <div class="company-logo-main rounded-3 me-3" 
                                        style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; background-color: #e0e0e0;">
                                            @if($logo_src)
                                                <img src="{{ $logo_src }}" 
                                                        alt="Logo {{ $job->company_name ?? 'Perusahaan' }}" 
                                                        style="width: 100%; height: 100%; object-fit: contain;">
                                            @else
                                                <span class="logo-initials" style="font-size: 1.2rem; color: #666;">
                                                    {{ substr($job->company_name ?? 'CO', 0, 2) }}
                                                </span>
                                            @endif
                                    </div>
                                    <div>
                                        <p class="mb-0 fw-bold">{{ $job->company_name ?? 'Nama Perusahaan' }}</p>
                                        <small class="text-muted">{{ $job->industry ?? 'Logistik dan Rantai Pasokan' }} · {{ $job->companyRelation->num_employees ?? '11 - 50' }} karyawan</small>
                                        <div class="mt-2">
                                            @if(($job->companyRelation->is_verified ?? false))
                                            <span class="badge bg-light text-muted p-2" style="border: 1px solid #e0e0e0;">
                                                <i class="bi bi-person-check me-1"></i> Terverifikasi
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <h4 class="fw-bold mb-2" style="font-size: 1rem;">Ringkasan</h4>
                                <p class="text-secondary" style="font-size: 0.9rem;">
                                    {{ $job->companyRelation->description ?? 'Deskripsi perusahaan tidak tersedia.' }}
                                </p>

                                <h4 class="fw-bold mb-2 mt-4" style="font-size: 1rem;">Alamat Kantor</h4>
                                <p class="text-secondary mb-0" style="font-size: 0.9rem;">
                                    {{ $job->companyRelation->address ?? 'Alamat kantor tidak tersedia.' }}
                                </p>
                            </div>

                        </div>
                    </div>

                    
                </div>
            </div>

        </div>

        {{-- =================================== --}}
        {{-- KOLOM KANAN BARU (Lowongan Lainnya) --}}
        {{-- =================================== --}}
        <div class="col-lg-4 col-12 mt-4 mt-lg-0">
            <div class="sticky-sidebar">
                <h5 class="sidebar-title mb-4">Lowongan Lainnya Untukmu</h5>

                @if(!empty($relatedJobs) && count($relatedJobs) > 0)
                    @foreach($relatedJobs as $relatedJob)
                    <a href="{{ route('jobs.show', $relatedJob->id) }}" class="text-decoration-none text-dark">
                        <div class="card sidebar-job-card mb-3 shadow-sm border-0">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-start">
                                    @php
                                        $related_logo_src = ($relatedJob->company_logo && Storage::disk('public')->exists($relatedJob->company_logo)) ? asset('storage/' . $relatedJob->company_logo) : null;
                                    @endphp
                                    <div class="logo-container me-3" style="width:45px; height:45px; min-width: 45px; display: flex; align-items: center; justify-content: center; background-color: #f0f0f0; border-radius: 6px;">
                                        @if($related_logo_src)
                                            <img src="{{ $related_logo_src }}"
                                                    alt="Logo {{ $relatedJob->company_name }}"
                                                    style="width: 100%; height: 100%; object-fit: contain; border-radius: 6px;">
                                        @else
                                            <span style="font-size:1rem; color:#6c757d;">
                                                {{ substr($relatedJob->company_name ?? 'CO', 0, 2) }}
                                            </span>
                                        @endif
                                    </div>

                                    <div class="flex-grow-1">
                                        <h6 class="related-job-title mb-1 fw-bold">{{ $relatedJob->title }}</h6>
                                        <div class="related-job-company mb-1" style="font-size: 0.9rem;">
                                            {{ $relatedJob->company_name }}
                                        </div>
                                        <div class="related-job-salary mb-1 fw-bold text-primary" style="font-size: 0.95rem;">
                                            Rp {{ $relatedJob->formatted_salary ?? 'Gaji tidak ditampilkan' }}
                                        </div>
                                        <small class="text-muted d-block" style="font-size: 0.85rem;">
                                            <i class="bi bi-geo-alt me-1"></i>{{ $relatedJob->location_string ?? 'Lokasi tidak tersedia' }}
                                        </small>
                                        <small class="text-muted d-block mt-1" style="font-size: 0.75rem;">
                                            {{ $relatedJob->created_at ? $relatedJob->created_at->diffForHumans() : '' }}
                                        </small>
                                    </div>
                                    {{-- Tombol Bookmark Kecil (Opsional) --}}
                                    <button class="btn btn-sm text-muted" style="position: relative; z-index: 10;">
                                        <i class="bi bi-bookmark"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                @else
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        Belum ada lowongan serupa.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@include('partials.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function saveJob() {
        const jobId = {{ $job->id ?? 0 }};
        
        fetch(`/jobs/${jobId}/save`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message || 'Lowongan berhasil disimpan!');
            } else {
                alert(data.message || 'Gagal menyimpan lowongan.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menyimpan lowongan.');
        });
    }
    
    function shareJob() {
        const shareData = {
            title: '{{ $job->title ?? "Lowongan Pekerjaan" }}',
            text: 'Lihat lowongan ini: {{ $job->title ?? "" }} di {{ $job->company_name ?? "" }}',
            url: window.location.href
        };

        if (navigator.share) {
            navigator.share(shareData)
                .then(() => console.log('Berhasil membagikan'))
                .catch(error => {
                    if (error.name !== 'AbortError') {
                        copyToClipboard();
                    }
                });
        } else {
            copyToClipboard();
        }
    }

    function copyToClipboard() {
        navigator.clipboard.writeText(window.location.href)
            .then(() => alert('Link lowongan telah disalin ke clipboard!'))
            .catch(err => {
                console.error('Gagal menyalin link: ', err);
                fallbackCopy();
            });
    }

    function fallbackCopy() {
        const textArea = document.createElement('textarea');
        textArea.value = window.location.href;
        document.body.appendChild(textArea);
        textArea.select();
        try {
            document.execCommand('copy');
            alert('Link lowongan telah disalin ke clipboard!');
        } catch (err) {
            console.error('Fallback copy failed: ', err);
            alert('Gagal menyalin link. Silakan salin secara manual: ' + window.location.href);
        }
        document.body.removeChild(textArea);
    }
</script>

</body>
</html>