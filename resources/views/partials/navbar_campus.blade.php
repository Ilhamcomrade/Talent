<style>
    .navbar {
        font-size: 1rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        position: relative;
        background-color: #fff !important; /* Memastikan background putih */
    }

    .navbar-logo {
        height: 38px;
        width: auto;
        margin-right: 1.5rem;
    }

    /* --- PERUBAHAN CSS: Menambahkan aturan untuk menghapus panah pada dropdown navigasi --- */
    .nav-link.no-arrow::after {
        display: none !important;
    }
    /* ----------------------------------------------------------------------------------- */

    .navbar .nav-link {
        color: #2c2c2c;
        margin-right: 1rem;
        font-weight: 400;
        transition: color 0.2s ease;
        position: relative;
        white-space: nowrap;
    }

    .navbar .nav-link:hover {
        color: #0d47a1;
    }

    .navbar .nav-link.active {
        color: #0d47a1;
        font-weight: 600;
        /* border-bottom: 2px solid #0d47a1; <--- DIHAPUS */
    }

    .navbar .nav-item {
        display: flex;
        align-items: center;
    }

    /* Style untuk dropdown profil kampus */
    .campus-profile-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;

        /* PERUBAHAN UTAMA: Hapus background color dan box-shadow */
        background-color: transparent; /* Menghapus warna latar belakang */
        box-shadow: none; /* Menghapus bayangan (bingkai) */

        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        color: #333;
        /* Dipertahankan 0rem agar hemat ruang di kiri */
        margin-left: 0rem;
        position: relative;
    }

    .campus-dropdown-name {
        font-weight: 600;
        color: #2c2c2c;
        /* Jarak yang nyaman antara ikon dan nama */
        margin: 0 0.2rem 0 0.8rem;
        /* Penting: white-space: nowrap; dipertahankan agar teks tetap dalam satu baris */
        white-space: nowrap;

        /* Hapus batasan lebar (max-width) dan pemotongan teks */
        max-width: none;
        overflow: visible;
        text-overflow: clip;
    }

    .navbar-collapse > .d-flex.align-items-center {
        /* Mengurangi margin di sisi kanan untuk memberikan lebih banyak ruang di tengah */
        margin-right: -10px;
    }


    .campus-dropdown-toggle {
        display: flex;
        align-items: center;
        text-decoration: none;
        color: inherit;
    }

    .campus-dropdown-toggle:hover {
        text-decoration: none;
        color: inherit;
    }

    /* Menampilkan ikon chevron pada dropdown (default Bootstrap) */
    .dropdown-toggle::after {
        display: inline-block;
        margin-left: 0.255em;
        vertical-align: 0.255em;
        content: "";
        border-top: 0.3em solid;
        border-right: 0.3em solid transparent;
        border-bottom: 0;
        border-left: 0.3em solid transparent;
    }

    /* Menghilangkan ikon chevron pada dropdown profil */
    .campus-dropdown-toggle::after {
        display: none;
    }

    .glints-dropdown {
        min-width: 12rem;
        padding: 0.2rem 0;
        border: 1px solid rgba(0, 0, 0, 0.15);
        border-radius: 0.5rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        margin-top: 8px !important;
    }

    .glints-dropdown .dropdown-item {
        font-size: 0.875rem;
        color: #2c2c2c;
        padding: 0.65rem 1rem;
        display: flex;
        align-items: center;
        font-weight: 500;
    }

    .glints-dropdown .dropdown-item:hover,
    .glints-dropdown .dropdown-item:focus {
        background-color: #f8f9fa;
        color: #0d47a1;
    }

    .glints-dropdown .dropdown-item i {
        font-size: 1rem;
        margin-right: 0.8rem;
        width: 1.1rem;
        text-align: center;
    }

    .glints-dropdown .dropdown-divider {
        margin: 0.2rem 0;
    }

    .glints-dropdown .dropdown-item.logout-item {
        color: #2c2c2c;
    }

    .glints-dropdown .dropdown-item.logout-item:hover {
        color: #0d47a1;
    }

    .chevron-icon {
        transition: transform 0.3s ease;
        font-size: 0.7rem;
        color: #6c757d;
        /* Dipertahankan minimal untuk menghemat ruang */
        margin-left: 0.25rem !important;
    }

    .chevron-icon.open {
        transform: rotate(180deg);
    }

    /* PERUBAHAN BARU: Style untuk chevron icon pada menu Kerja Sama dan Informasi */
    .nav-dropdown-chevron {
        transition: transform 0.3s ease;
        font-size: 0.7rem;
        color: #6c757d;
        margin-left: 0.25rem !important;
    }

    .nav-dropdown-chevron.open {
        transform: rotate(180deg);
    }

    /* PERUBAHAN BARU: Container untuk menu navigasi di sebelah kanan */
    .navbar-nav-right {
        margin-left: auto;
        margin-right: 1rem;
        display: flex;
        align-items: center;
    }

    /* Penyesuaian untuk tampilan mobile */
    @media (max-width: 992px) {
        .navbar .nav-link.active {
            border-bottom: none;
        }
        .campus-dropdown-name,
        .chevron-icon,
        .nav-dropdown-chevron {
            display: none !important;
        }

        .navbar-nav-right {
            margin-right: 0;
            width: 100%;
            justify-content: flex-start;
        }
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container-fluid mx-lg-5">

        <a class="navbar-brand d-flex align-items-center py-2" href="{{ url('/dashboard-kampus') }}">
            <img src="{{ asset('images/logo_inotal.png') }}" alt="Inotal Logo" class="navbar-logo d-inline-block align-text-top">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNavCampus" aria-controls="navbarNavCampus"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavCampus">
            <!-- PERUBAHAN UTAMA: Menu navigasi dipindah ke sebelah kanan (sebelah kiri profil) -->
            <ul class="navbar-nav navbar-nav-right mb-2 mb-lg-0 position-relative" id="navMenuCampus">

                <li class="nav-item dropdown" id="kerjasamaDropdownContainer">
                    <a class="nav-link dropdown-toggle no-arrow d-flex align-items-center" href="#" id="kerjasamaDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Kerja Sama
                        <i class="fas fa-chevron-down nav-dropdown-chevron ms-1"></i>
                    </a>
                    <ul class="dropdown-menu glints-dropdown" aria-labelledby="kerjasamaDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ url('/mou-kampus') }}">
                                <i class="fas fa-handshake"></i> MOU
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ url('/pengajuan-proposal-kampus') }}">
                                <i class="fas fa-file-contract"></i> Pengajuan Proposal
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown" id="informasiDropdownContainer">
                    <a class="nav-link dropdown-toggle no-arrow d-flex align-items-center" href="#" id="informasiDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Informasi
                        <i class="fas fa-chevron-down nav-dropdown-chevron ms-1"></i>
                    </a>
                    <ul class="dropdown-menu glints-dropdown" aria-labelledby="informasiDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ url('/pengajuan-magang-kampus') }}">
                                <i class="fas fa-briefcase"></i> Pengajuan Magang
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ url('/lowongan-pekerjaan-kampus') }}">
                                <i class="fas fa-users"></i> Lowongan Pekerjaan
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

            <div class="d-flex align-items-center">

                @auth('campus')
                    <div class="dropdown" id="campusDropdownContainer">
                        <a class="campus-dropdown-toggle" href="#" role="button"
                            id="campusDropdownToggle" data-bs-toggle="dropdown" aria-expanded="false">

                            <div class="campus-profile-icon">
                                @if (Auth::guard('campus')->user()->logo_path)
                                    <img src="{{ asset('storage/' . Auth::guard('campus')->user()->logo_path) }}"
                                            alt="Campus Logo"
                                            style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                                @else
                                    <i class="fas fa-university"></i>
                                @endif
                            </div>

                            <span class="campus-dropdown-name d-none d-lg-inline">
                                {{ Auth::guard('campus')->user()->nama_kampus }}
                            </span>

                            <i class="fas fa-chevron-down ms-1 d-none d-lg-inline chevron-icon"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end glints-dropdown" aria-labelledby="campusDropdownToggle">
                            <li>
                                <a class="dropdown-item" href="{{ url('/campus/setting') }}">
                                    <i class="fas fa-cog"></i> Setting
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('campus.logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item logout-item">
                                        <i class="fas fa-power-off"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>

                @else
                    <a href="{{ url('/campus/login') }}" class="btn btn-outline-primary ms-3">Masuk</a>
                @endauth

            </div>
        </div>
    </div>
</nav>

<script>
    // Kode untuk kampus dropdown
    const campusDropdownContainer = document.getElementById('campusDropdownContainer');
    const chevronIconCampus = campusDropdownContainer ? campusDropdownContainer.querySelector('.chevron-icon') : null;

    if (campusDropdownContainer && chevronIconCampus) {
        campusDropdownContainer.addEventListener('show.bs.dropdown', () => chevronIconCampus.classList.add('open'));
        campusDropdownContainer.addEventListener('hide.bs.dropdown', () => chevronIconCampus.classList.remove('open'));
    }

    // PERUBAHAN BARU: Kode untuk animasi chevron pada menu Kerja Sama dan Informasi
    const kerjasamaDropdownContainer = document.getElementById('kerjasamaDropdownContainer');
    const informasiDropdownContainer = document.getElementById('informasiDropdownContainer');

    if (kerjasamaDropdownContainer) {
        const kerjasamaChevron = kerjasamaDropdownContainer.querySelector('.nav-dropdown-chevron');
        if (kerjasamaChevron) {
            kerjasamaDropdownContainer.addEventListener('show.bs.dropdown', () => kerjasamaChevron.classList.add('open'));
            kerjasamaDropdownContainer.addEventListener('hide.bs.dropdown', () => kerjasamaChevron.classList.remove('open'));
        }
    }

    if (informasiDropdownContainer) {
        const informasiChevron = informasiDropdownContainer.querySelector('.nav-dropdown-chevron');
        if (informasiChevron) {
            informasiDropdownContainer.addEventListener('show.bs.dropdown', () => informasiChevron.classList.add('open'));
            informasiDropdownContainer.addEventListener('hide.bs.dropdown', () => informasiChevron.classList.remove('open'));
        }
    }
</script>
