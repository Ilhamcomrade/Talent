<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talenthub</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        body {
            background-color: #f6f8f5;
        }

        /* Map Section */
        .map-container {
            background-color: #fff;
            padding: 0;
        }

        #map {
            height: 450px;
            width: 100%;
            border-radius: 0;
            border: none;
            box-shadow: none;
        }

        /* Konten Utama (Form dan Info) */
        .contact-section {
            background-color: #fff;
            padding: 50px 0;
        }

        .contact-content {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            flex-wrap: wrap;
        }

        /* --- PERUBAHAN UTAMA UNTUK MENJAGA TINGGI --- */
        /* Tambahkan min-height yang diperkirakan sama dengan tinggi form. */
        /* Nilai ini mungkin perlu disesuaikan (misalnya 550px) tergantung konten navbar/header/footer */
        .contact-form-wrapper {
            width: 45%;
            padding-right: 3rem;
            /* Tambahan: Minimal tinggi, disesuaikan agar sama dengan tinggi form */
            min-height: 570px;
            /* Nilai estimasi, coba sesuaikan jika perlu */
        }

        /* ------------------------------------------- */

        .contact-info-wrapper {
            width: 45%;
            padding-left: 3rem;
        }

        /* Modifikasi Card */
        .contact-card {
            background-color: #fff;
            padding: 2.5rem;
            border-radius: 8px;
            border: 1px solid #ccc;
            box-shadow: none;
        }

        @media (max-width: 991px) {

            .contact-form-wrapper,
            .contact-info-wrapper {
                width: 100%;
                padding-right: 15px;
                padding-left: 15px;
            }

            .contact-form-wrapper {
                padding-bottom: 30px;
                margin-bottom: 30px;
                /* Hapus min-height di mobile agar konten menyesuaikan */
                min-height: auto;
            }
        }

        .contact-form-heading {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 1.5rem;
        }

        .contact-form-subheading {
            font-size: 1.25rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 1.5rem;
        }

        .contact-form-text {
            font-size: 0.95rem;
            color: #666;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        /* Input Custom */
        .form-control-custom {
            background-color: #f5f5f5;
            border-radius: 6px;
            padding: 0.75rem 1rem;
            border: 1px solid #e0e0e0;
            margin-bottom: 1rem;
            transition: border-color 0.3s, box-shadow 0.3s;
            box-shadow: none;
        }

        .form-control-custom:focus {
            background-color: #f5f5f5;
            border-color: #bdbdbd;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.05);
        }

        .form-control-custom::placeholder {
            color: #a0a0a0;
        }

        .form-control-custom.is-invalid {
            border-color: #e57373;
        }

        /* Tombol Kirim */
        .btn-kirim {
            width: 100%;
            background-color: #e00028;
            color: #fff;
            font-weight: normal;
            padding: 0.75rem;
            border: none;
            border-radius: 6px;
            transition: box-shadow 0.3s ease;
        }

        .btn-kirim:hover {
            background-color: #e00028;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Informasi Kontak */
        .contact-info-heading {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 1.5rem;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1.5rem;
        }

        .info-icon {
            color: #888;
            font-size: 1.2rem;
            margin-right: 1rem;
            width: 20px;
            text-align: center;
        }

        .info-text {
            color: #555;
            font-size: 0.95rem;
            line-height: 1.5;
            /* **TIDAK BERUBAH** */
        }

        /* --- Custom Dropdown Subject Styling --- */
        .subject-dropdown-container {
            position: relative;
            margin-bottom: 1rem;
        }

        .subject-input-wrapper {
            display: flex;
            align-items: center;
            position: relative;
            background-color: #f5f5f5;
            border-radius: 6px;
            border: 1px solid #e0e0e0;
            padding-right: 0;
        }

        /* NEW: Style for invalid subject wrapper */
        .subject-input-wrapper.is-invalid {
            border-color: #e57373; /* Red color for error */
        }

        .subject-input-wrapper input {
            flex-grow: 1;
            border: none;
            background: transparent;
            padding: 0.75rem 1rem;
            height: auto;
            margin-bottom: 0;
        }

        .subject-input-wrapper input:focus {
            outline: none;
            box-shadow: none;
        }

        .subject-input-wrapper:focus-within {
            border-color: #bdbdbd;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.05);
        }

        .dropdown-toggle-button {
            cursor: pointer;
            padding: 0 1rem;
            background-color: transparent;
            border: none;
            height: 100%;
            display: flex;
            align-items: center;
            color: #a0a0a0;
            transition: color 0.3s ease;
        }

        .dropdown-toggle-button:hover {
            color: #333;
        }

        .dropdown-arrow {
            transition: transform 0.3s ease;
        }

        .dropdown-arrow.rotated {
            transform: rotate(180deg);
        }

        .subject-dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            min-width: 100%;
            margin: 2px 0 0;
            padding: 0;
            list-style: none;
            background-color: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            display: none;
            overflow: hidden;
        }

        .subject-dropdown-menu.show {
            display: block;
        }

        .subject-dropdown-menu li {
            padding: 0;
        }

        .subject-dropdown-menu a {
            display: block;
            padding: 0.5rem 1rem;
            clear: both;
            font-weight: 400;
            color: #333;
            text-align: inherit;
            text-decoration: none;
            white-space: nowrap;
            background-color: transparent;
            border: 0;
        }

        .subject-dropdown-menu a:hover,
        .subject-dropdown-menu a:focus {
            color: #fff;
            text-decoration: none;
            background-color: #0d6efd;
        }

        /* NEW: Custom styling for error messages */
        .invalid-feedback {
            width: 100%;
            margin-top: 0.25rem;
            font-size: 0.875em;
            color: #e57373; /* Red color matching the border */
        }
        /* Ensures the feedback is always visible under the custom inputs/wrappers */
        .invalid-feedback.d-block {
            display: block !important;
        }

        /* Style Disesuaikan untuk Success Message (Mirip Jobstreet) */
        .success-message-container {
            /* Menghilangkan align-items: center dan text-align: center dari style lama */
            display: block;
            /* Menggunakan display block atau flex-start untuk rata kiri */
            padding: 0;
            /* Sesuaikan padding jika perlu */
        }

        .success-heading {
            font-size: 1.5rem;
            /* **PERUBAHAN: Dari 2rem menjadi 1.5rem (sama dengan .contact-form-heading)** */
            font-weight: bold;
            color: #333;
            /* Warna gelap */
            margin-bottom: 25px;
            /* Jarak bawah yang sesuai */
            text-align: left;
            /* Rata Kiri */
        }

        .success-title-thanks {
            font-size: 1.25rem;
            /* **PERUBAHAN: Dari 1.5rem menjadi 1.25rem (sama dengan .contact-form-subheading)** */
            /* font-weight: normal; <-- Diambil dari sini */
            color: #333;
            margin-bottom: 15px;
            /* Jarak bawah */
            text-align: left;
            /* Rata Kiri */
        }

        /* --- TAMBAHAN: Style untuk membuat teks pesan sukses jadi bold --- */
        .success-title-thanks strong {
            font-weight: bold;
        }

        /* ------------------------------------------------------------ */


        .success-text {
            font-size: 0.95rem;
            /* **PERUBAHAN: Dari 1rem menjadi 0.95rem (sama dengan .contact-form-text)** */
            color: #555;
            line-height: 1.6;
            margin-bottom: 20px;
            text-align: left;
            /* Rata Kiri */
        }

        .success-text a {
            color: #0d6efd;
            /* Warna link biru */
            text-decoration: none;
        }

        .success-text a:hover {
            text-decoration: underline;
        }

        .btn-kembali-kontak-js {
            display: inline-flex;
            /* Menggunakan inline-flex untuk ikon dan teks */
            align-items: center;
            background-color: #fff;
            /* Latar belakang putih */
            color: #333;
            /* Teks hitam */
            font-weight: 600;
            /* Sedikit lebih tebal */
            padding: 0.75rem 1.5rem;
            /* Padding yang lebih besar */
            border-radius: 6px;
            border: 1px solid #ccc;
            /* Border abu-abu */
            text-decoration: none;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .btn-kembali-kontak-js:hover {
            background-color: #f5f5f5;
            /* Hover effect */
            color: #333;
            border-color: #999;
        }

        .btn-kembali-kontak-js i {
            margin-right: 0.5rem;
            font-size: 1rem;
        }

        /* Hapus style lama yang tidak terpakai */
        .success-message-icon,
        .success-message-title,
        .success-message-text {
            /* Hapus atau timpa style lama agar tidak bentrok */
            display: none;
        }

        /* --- STYLE TAMBAHAN UNTUK IKON GMAIL --- */
        .success-icon-wrapper {
            /* Hapus 'text-align: left;' atau atur ke display: block; */
            /* Untuk kontrol margin-left yang lebih baik, cukup hapus text-align */
            /* atau ubah menjadi: */
            text-align: initial;
            /* Atau hapus baris ini, agar margin pada child bisa bekerja */
            margin-top: -50px;
            margin-bottom: -50px;
        }

        .gmail-icon {
            width: 200px;
            /* Ganti dengan nilai px yang Anda inginkan (Contoh: 90px) */
            height: auto;

            /* Gunakan margin-left untuk menggeser ikon secara manual */
            margin-left: 70px;
            /* Ganti 120px dengan nilai pergeseran horizontal yang Anda inginkan */
        }
        /* -------------------------------------- */
    </style>
</head>

<body>
    {{-- Pastikan data $profile tersedia sebelum mencoba mengaksesnya --}}
    @if (isset($profile))
        {{-- diasumsikan file ini ada --}}
        @include('partials.navbar')

        <div class="map-container">
            <div id="map"></div>
        </div>

        <div class="contact-section">
            <div class="container">
                <div class="row contact-content">
                    <div class="col-lg-6 contact-form-wrapper">
                        {{-- START: KONDISI UNTUK TAMPILAN SETELAH SUBMIT --}}
                        @if (isset($success_message))
                            <div class="success-message-container">
                                <h2 class="success-heading">Hubungi kami</h2>
                                {{-- PERUBAHAN: Tambahkan <strong> untuk membuat teks bold --}}
                                <h3 class="success-title-thanks"><strong>Terima kasih telah menghubungi kami</strong></h3>

                                {{-- START: IKON GMAIL TAMBAHAN --}}
                                <div class="success-icon-wrapper">
                                    {{-- Menggunakan placeholder jika 'images/send.png' tidak ada --}}
                                    <img src="{{ asset('images/send.png') }}"
                                        onerror="this.onerror=null; this.src='https://placehold.co/200x200/cccccc/333333?text=Email+Sent';"
                                        alt="Email Sent" class="gmail-icon">
                                </div>
                                {{-- END: IKON GMAIL TAMBAHAN --}}

                                <p class="success-text">
                                    Kami akan mencoba membalas anda dalam beberapa hari ke depan.
                                </p>
                                <p class="success-text">
                                    Jika anda ingin segera menghubungi kami, silahkan kunjungi halaman Kontak untuk
                                    menemukan nomor telepon kami
                                </p>
                                <a href="{{ route('contact') }}" class="btn-kembali-kontak-js">
                                    <i class="fas fa-chevron-left"></i> Kembali ke halaman Kontak.
                                </a>
                            </div>
                        @else
                            {{-- TAMPILAN FORM KONTAK ASLI --}}
                            <h2 class="contact-form-heading">Hubungi Kami</h2>
                            <h3 class="contact-form-subheading">Punya Pertanyaan ?</h3>
                            <p class="contact-form-text">
                                Apabila Anda memiliki pertanyaan terkait lowongan kerja,
                                atau informasi lainnya, silahkan hubungi kami melalui formulir di bawah ini:
                            </p>

                            {{-- Form Kontak --}}
                            <form action="{{ route('contact.store') }}" method="POST">
                                @csrf

                                {{-- Input: Nama --}}
                                <div class="mb-3">
                                    <input name="name" type="text"
                                        class="form-control form-control-custom @error('name') is-invalid @enderror"
                                        placeholder="Nama Lengkap Anda" value="{{ old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Input: Nomor Kontak --}}
                                <div class="mb-3">
                                    <input name="phone" type="tel" inputmode="numeric" pattern="[0-9]*"
                                        class="form-control form-control-custom @error('phone') is-invalid @enderror"
                                        placeholder="Nomor Kontak" id="phone-input" value="{{ old('phone') }}">
                                    @error('phone')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Input: Email --}}
                                <div class="mb-3">
                                    <input name="email" type="email"
                                        class="form-control form-control-custom @error('email') is-invalid @enderror"
                                        placeholder="Alamat Email Anda" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Input: Subjek (Custom Dropdown) --}}
                                <div class="subject-dropdown-container">
                                    <div class="subject-input-wrapper @error('subject') is-invalid @enderror"
                                        id="subject-wrapper">
                                        <input name="subject" type="text" class="subject-input" id="subject-input"
                                            placeholder="Subjek" aria-haspopup="true" aria-expanded="false"
                                            value="{{ old('subject') }}">
                                        <button type="button" class="dropdown-toggle-button" id="dropdown-toggle">
                                            <i class="fas fa-chevron-down dropdown-arrow" id="dropdown-arrow"></i>
                                        </button>
                                    </div>

                                    <ul class="subject-dropdown-menu" id="subject-menu">
                                        <li><a href="#" data-value="Login / kata sandi">Login / kata sandi</a></li>
                                        <li><a href="#" data-value="Akun Saya">Akun Saya</a></li>
                                        <li><a href="#" data-value="Pencarian Lowongan">Pencarian Lowongan</a></li>
                                        <li><a href="#" data-value="Melamar lowongan">Melamar lowongan</a></li>
                                        <li><a href="#" data-value="Profil Talenthub">Profil Talenthub</a></li>
                                        <li><a href="#" data-value="Melaporkan iklan lowongan yang mencurigakan">Melaporkan iklan
                                                lowongan yang mencurigakan</a></li>
                                        <li><a href="#" data-value="Masalah email">Masalah email</a></li>
                                    </ul>
                                    @error('subject')
                                        {{-- Menampilkan error di luar wrapper subjek --}}
                                        <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Input: Pesan --}}
                                <div class="mb-3">
                                    <textarea name="message"
                                        class="form-control form-control-custom @error('message') is-invalid @enderror"
                                        rows="4" placeholder="Pesan Anda">{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-kirim">Kirim Pesan</button>
                                </div>
                            </form>
                        @endif
                        {{-- END: KONDISI UNTUK TAMPILAN SETELAH SUBMIT --}}
                    </div>

                    <div class="col-lg-6 contact-info-wrapper">
                        <div class="contact-card">
                            <h2 class="contact-info-heading">Informasi Kontak</h2>

                            {{-- PERUBAHAN: ALAMAT DARI MODEL PROFILE --}}
                            <div class="info-item">
                                <i class="fas fa-map-marker-alt info-icon"></i>
                                <div class="info-text">
                                    @if($profile->address)
                                        {!! nl2br(e($profile->address)) !!}
                                    @else
                                        Jl. Pratista Utara III No.2, Antapani Kidul, Kec. Antapani, Kota Bandung, Jawa Barat, Indonesia 4029
                                    @endif
                                </div>
                            </div>

                            {{-- PERUBAHAN: EMAIL DARI MODEL PROFILE --}}
                            <div class="info-item">
                                <i class="fas fa-envelope info-icon"></i>
                                <div class="info-text">Email: {{ $profile->email ?? 'corporate@inotal.tech' }}</div>
                            </div>

                            {{-- PERUBAHAN: TELEPON DARI MODEL PROFILE --}}
                            <div class="info-item">
                                <i class="fas fa-phone-alt info-icon"></i>
                                <div class="info-text">Phone: {{ $profile->phone ?? '+(62) 82115179879' }}</div>
                            </div>

                            {{-- PERUBAHAN: JAM OPERASIONAL DARI MODEL PROFILE --}}
                            <div class="info-item">
                                <i class="fas fa-clock info-icon"></i>
                                <div class="info-text">
                                    Jam Operasional:<br>
                                    {{ $profile->operation_hours ?? 'Senin - Jumat, 08.00 - 16.00 WIB' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- diasumsikan file ini ada --}}
        @include('partials.footer')

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                // PERUBAHAN: Gunakan data dari model Profile
                const latitude = {{ $profile->latitude ?? '-6.925457980196308' }};
                const longitude = {{ $profile->longitude ?? '107.66299344598612' }};
                const mapPopupText = "{!! addslashes($profile->map_popup_text ?? 'PT INOTAL SISTEMA INTERNASIONAL Jl. Pratista Utara III No.2, Antapani.') !!}";
                const location = [latitude, longitude];

                if (document.getElementById('map') && latitude !== null && longitude !== null) {
                    const map = L.map('map').setView(location, 18);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(map);

                    L.marker(location).addTo(map)
                        .bindPopup(mapPopupText)
                        .openPopup();
                }

                //-- Dropdown Script --//
                const toggleButton = document.getElementById('dropdown-toggle');
                const subjectMenu = document.getElementById('subject-menu');
                const subjectInput = document.getElementById('subject-input');
                const dropdownArrow = document.getElementById('dropdown-arrow');
                const menuItems = subjectMenu ? subjectMenu.querySelectorAll('a') : [];

                // Cek apakah elemen-elemen untuk form ada sebelum menjalankan script dropdown/phone input
                if (toggleButton && subjectMenu && subjectInput && dropdownArrow && menuItems.length > 0) {
                    function toggleDropdown() {
                        const isShown = subjectMenu.classList.toggle('show');
                        dropdownArrow.classList.toggle('rotated', isShown);
                        subjectInput.setAttribute('aria-expanded', isShown);
                    }

                    toggleButton.addEventListener('click', (e) => {
                        e.preventDefault();
                        e.stopPropagation();
                        toggleDropdown();
                    });

                    document.addEventListener('click', (e) => {
                        if (!subjectMenu.contains(e.target) && e.target !== toggleButton && e.target !== subjectInput) {
                            subjectMenu.classList.remove('show');
                            dropdownArrow.classList.remove('rotated');
                            subjectInput.setAttribute('aria-expanded', false);
                        }
                    });

                    menuItems.forEach(item => {
                        item.addEventListener('click', (e) => {
                            e.preventDefault();
                            subjectInput.value = item.getAttribute('data-value');
                            subjectInput.focus();
                            toggleDropdown();
                        });
                    });

                    subjectInput.addEventListener('click', () => {
                        if (!subjectMenu.classList.contains('show')) {
                            toggleDropdown();
                        }
                    });
                }

                const phoneInput = document.getElementById('phone-input');
                if (phoneInput) {
                    phoneInput.addEventListener('keydown', (e) => {
                        const isAlphabetKey = /^[a-zA-Z]$/.test(e.key);
                        if (e.key.length === 1 && isAlphabetKey) {
                            e.preventDefault();
                        }

                        if (e.ctrlKey || e.metaKey) {
                            if (['a', 'c', 'v', 'x'].includes(e.key)) {
                                return;
                            }
                        }
                    });

                    phoneInput.addEventListener('input', (e) => {
                        e.target.value = e.target.value.replace(/[a-zA-Z]/g, '');
                    });
                }
            });
        </script>
    @else
        <div class="container text-center py-5">
            <h1>Data Kontak Belum Tersedia</h1>
            <p>Mohon periksa konfigurasi database dan Controller Anda.</p>
        </div>
    @endif
</body>

</html>
