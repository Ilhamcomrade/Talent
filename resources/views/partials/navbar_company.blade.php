<style>
    .navbar {
        font-size: 1rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        background: #fff;
        border-bottom: 1px solid #dee2e6;
        padding: 0.6rem 1rem;
        position: relative;
    }

    .navbar-logo {
        height: 38px;
        width: auto;
        margin-right: 0.5rem;
    }

    .company-name-navbar {
        font-size: 1.05rem;
        font-weight: 600;
        color: #2c2c2c;
        white-space: nowrap;
        margin-right: 1.5rem;
    }

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
        border-bottom: 2px solid #0d47a1;
    }

    .nav-underline {
        position: absolute;
        bottom: 0;
        height: 2px;
        background: #0d47a1;
        transition: all 0.3s ease;
    }

    .btn-login {
        border-radius: 4px;
        padding: 0.35rem 1rem;
        font-weight: 600;
        color: #0d47a1 !important;
        background-color: #fff;
        border: 2px solid #0d47a1;
        transition: all 0.3s ease;
        text-decoration: none;
    }
    .btn-login:hover {
        background-color: #0d47a1;
        color: #fff !important;
    }

    .user-profile-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #f5e7c6;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        color: #333;
        margin-left: 0.5rem;
        position: relative;
        box-shadow: 0 1px 2px rgba(0,0,0,0.15);
        overflow: hidden;
    }

    .glints-dropdown {
        min-width: 12rem;
        padding: 0.2rem 0;
        border-radius: 0.5rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        margin-top: 8px !important;
    }

    /* Dropdown hover */
    .dropdown:hover .dropdown-menu {
        display: block;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container-fluid mx-lg-5">

        <a class="navbar-brand d-flex align-items-center" href="{{ url('company/dashboard')}}">
            <img src="{{ asset('images/logo_inotal.png') }}" class="navbar-logo">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#companyNav" aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="companyNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 position-relative" id="companyMenu">

                <!-- DASHBOARD -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('company/dashboard') ? 'active' : '' }}"
                       href="{{ url('company/dashboard') }}">
                       Dashboard
                    </a>
                </li>

                <!-- LOWONGAN KERJA + SUBMENU -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle
                        {{ request()->is('company/jobs*') ? 'active' : '' }}"
                       href="#" data-bs-toggle="dropdown">
                       Lowongan Kerja
                    </a>

                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{ url('company/jobs') }}">
                                Lowongan kerja
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="{{ url('company/applicants') }}">
                                Pelamar
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- INTERSHIP + SUBMENU -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle
                        {{ request()->is('company/magang*') ? 'active' : '' }}"
                       href="#" data-bs-toggle="dropdown">
                       Intership
                    </a>

                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{ url('company/magang') }}">
                                Lowongan magang
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="{{ url('company/magang/dokumen') }}">
                                Dokumen
                            </a>
                        </li>
                    </ul>
                </li>

                 <!-- BENEFIT -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('company/benefits*') ? 'active' : '' }}"
                    href="{{ route('company.benefits.index') }}">
                    Benefit
                    </a>
                </li>


                <span class="nav-underline" id="companyUnderline"></span>
            </ul>

            @auth('company')
                @php
                    $company = Auth::guard('company')->user();
                @endphp

                <span class="company-name-navbar">
                    {{ $company->nama_perusahaan }}
                </span>

                <div class="dropdown">
                    <a class="d-flex align-items-center user-dropdown-toggle" data-bs-toggle="dropdown">
                        <div class="user-profile-icon">

                            @if($company->logo)
                                <img src="{{ asset('storage/' . $company->logo) }}"
                                     style="width:100%;height:100%;object-fit:cover;">
                            @else
                                {{ strtoupper(substr($company->nama_perusahaan, 0, 2)) }}
                            @endif

                        </div>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end glints-dropdown">

                        <li class="px-3 py-2 text-muted">
                            <strong>{{ $company->nama_perusahaan }}</strong>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <a class="dropdown-item" href="{{ url('company/profile') }}">
                                <i class="fas fa-user"></i>&nbsp;Profil Perusahaan
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="{{ url('company/settings') }}">
                                <i class="fas fa-cog"></i>&nbsp;Pengaturan
                            </a>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <form method="POST" action="{{ route('company.logout') }}">
                                @csrf
                                <button class="dropdown-item">
                                    <i class="fas fa-power-off"></i>&nbsp;Keluar
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <a href="{{ url('/company/login') }}" class="btn-login">Masuk</a>
            @endauth

        </div>
    </div>
</nav>

<script>
    const underline2 = document.getElementById("companyUnderline");
    const links2 = document.querySelectorAll("#companyMenu .nav-link");

    function moveUnderline2(el) {
        const rect = el.getBoundingClientRect();
        const parentRect = el.parentElement.parentElement.getBoundingClientRect();
        underline2.style.width = rect.width + "px";
        underline2.style.left = (rect.left - parentRect.left) + "px";
    }

    const active2 = document.querySelector("#companyMenu .nav-link.active");
    if (active2) moveUnderline2(active2);

    links2.forEach(link => {
        link.addEventListener("click", () => {
            links2.forEach(l => l.classList.remove("active"));
            link.classList.add("active");
            moveUnderline2(link);
        });
    });

    window.addEventListener("resize", () => {
        const act = document.querySelector("#companyMenu .nav-link.active");
        if (act) moveUnderline2(act);
    });
</script>
