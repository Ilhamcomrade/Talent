<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Dashboard</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #0d47a1;
            --primary-light: #e3f2fd;
            --secondary-color: #2c2c2c;
            --accent-color: #f5e7c6;
            --border-color: #dee2e6;
            --shadow-light: 0 2px 12px rgba(0, 0, 0, 0.08);
            --shadow-medium: 0 4px 16px rgba(0, 0, 0, 0.12);
            --transition-speed: 0.25s;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            color: #333;
            line-height: 1.5;
            padding-top: 70px; /* Untuk memberi ruang untuk sticky navbar */
        }

        /* NAVBAR FULL WIDTH */
        .navbar {
            font-size: 1rem;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            background: #ffffff;
            border-bottom: 1px solid var(--border-color);
            padding: 0;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1030;
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.98);
        }

        /* Container fluid untuk full width */
        .navbar .container-fluid {
            padding: 0 1.5rem;
            max-width: 100%;
        }

        .navbar-logo {
            height: 42px;
            width: auto;
            margin-right: 0.75rem;
            transition: transform var(--transition-speed) ease;
        }

        .navbar-logo:hover {
            transform: scale(1.05);
        }

        .company-name-navbar {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--secondary-color);
            white-space: nowrap;
            margin-right: 2rem;
            padding: 0.25rem 0.75rem;
            border-radius: 6px;
            background-color: var(--primary-light);
            transition: all var(--transition-speed) ease;
            border: 1px solid rgba(13, 71, 161, 0.1);
        }

        .company-name-navbar:hover {
            color: var(--primary-color);
            transform: translateY(-1px);
            border-color: rgba(13, 71, 161, 0.2);
            box-shadow: 0 2px 8px rgba(13, 71, 161, 0.1);
        }

        .navbar .nav-link {
            color: var(--secondary-color);
            margin: 0 0.5rem;
            font-weight: 500;
            padding: 0.75rem 1rem !important;
            transition: all var(--transition-speed) ease;
            position: relative;
            white-space: nowrap;
            border-radius: 6px;
        }

        .navbar .nav-link:hover {
            color: var(--primary-color);
            background-color: var(--primary-light);
        }

        .navbar .nav-link.active {
            color: var(--primary-color);
            font-weight: 600;
            background-color: var(--primary-light);
        }

        .nav-underline {
            position: absolute;
            bottom: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-color), #2196f3);
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 3px 3px 0 0;
            box-shadow: 0 1px 3px rgba(13, 71, 161, 0.2);
        }

        .btn-login {
            border-radius: 6px;
            padding: 0.5rem 1.5rem;
            font-weight: 600;
            color: var(--primary-color) !important;
            background-color: #fff;
            border: 2px solid var(--primary-color);
            transition: all 0.3s ease;
            text-decoration: none;
            box-shadow: 0 2px 4px rgba(13, 71, 161, 0.1);
        }

        .btn-login:hover {
            background-color: var(--primary-color);
            color: #fff !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(13, 71, 161, 0.2);
        }

        .user-profile-container {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-profile-icon {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background-color: var(--accent-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
            position: relative;
            box-shadow: var(--shadow-light);
            overflow: hidden;
            cursor: pointer;
            transition: all var(--transition-speed) ease;
            border: 2px solid white;
        }

        .user-profile-icon:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-medium);
            border-color: var(--primary-color);
        }

        .user-profile-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* DROPDOWN FIX - Tidak hilang saat klik */
        .dropdown {
            position: relative;
        }

        .glints-dropdown {
            min-width: 14rem;
            padding: 0.5rem 0;
            border-radius: 10px;
            box-shadow: var(--shadow-medium);
            margin-top: 12px !important;
            border: 1px solid var(--border-color);
            overflow: hidden;
            position: absolute;
            right: 0;
            left: auto;
        }

        /* Dropdown untuk mobile */
        @media (max-width: 991.98px) {
            .glints-dropdown {
                position: static;
                margin-top: 0.5rem !important;
            }
        }

        .dropdown-item {
            padding: 0.7rem 1.2rem;
            transition: all var(--transition-speed) ease;
            font-weight: 500;
            cursor: pointer;
        }

        .dropdown-item:hover {
            background-color: var(--primary-light);
            color: var(--primary-color);
            padding-left: 1.5rem;
        }

        .dropdown-item i {
            width: 20px;
            text-align: center;
            margin-right: 0.75rem;
            color: var(--primary-color);
        }

        .dropdown-divider {
            margin: 0.5rem 0;
        }

        .navbar-toggler {
            border: none;
            padding: 0.5rem;
            border-radius: 6px;
            transition: all var(--transition-speed) ease;
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 3px rgba(13, 71, 161, 0.25);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%2844, 44, 44, 0.8%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* Responsive adjustments */
        @media (max-width: 1199.98px) {
            .navbar .container-fluid {
                padding: 0 1rem;
            }
            
            .company-name-navbar {
                margin-right: 1rem;
                font-size: 1rem;
                padding: 0.25rem 0.5rem;
            }
        }

        @media (max-width: 991.98px) {
            body {
                padding-top: 60px;
            }
            
            .navbar .nav-link {
                margin: 0.25rem 0;
                padding: 0.75rem 1rem !important;
                border-radius: 8px;
                width: 100%;
            }
            
            .nav-underline {
                display: none;
            }
            
            .glints-dropdown {
                min-width: 100%;
                border-radius: 8px;
                box-shadow: none;
                border: 1px solid var(--border-color);
            }
            
            .company-name-navbar {
                margin: 0.5rem 0;
                text-align: center;
                display: inline-block;
            }
            
            .dropdown-menu {
                border: none;
            }
        }

        @media (max-width: 575.98px) {
            .navbar-logo {
                height: 36px;
            }
            
            .btn-login {
                padding: 0.5rem 1rem;
                width: 100%;
                text-align: center;
                margin-top: 0.5rem;
            }
            
            .user-profile-container {
                justify-content: center;
                margin-top: 1rem;
            }
            
            .navbar .container-fluid {
                padding: 0 0.75rem;
            }
        }

        /* Animation for dropdown */
        .dropdown-menu {
            animation: fadeInDown 0.3s ease forwards;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Active state enhancement */
        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 6px;
            height: 6px;
            background-color: var(--primary-color);
            border-radius: 50%;
        }

        @media (max-width: 991.98px) {
            .nav-link.active::after {
                display: none;
            }
        }

        /* Navbar collapse transition */
        .navbar-collapse {
            transition: all 0.3s ease;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('company/dashboard') }}">
                <img src="{{ asset('images/logo_inotal.png') }}" class="navbar-logo" alt="Logo Perusahaan">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#companyNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="companyNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 position-relative" id="companyMenu">
                    <!-- DASHBOARD -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('company/dashboard') ? 'active' : '' }}"
                           href="{{ url('company/dashboard') }}">
                           <i class="fas fa-chart-line me-1"></i> Dashboard
                        </a>
                    </li>

                    <!-- LOWONGAN KERJA + SUBMENU -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('company/jobs*') ? 'active' : '' }}"
                           href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                           <i class="fas fa-briefcase me-1"></i> Lowongan Kerja
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ url('company/jobs') }}">
                                    <i class="fas fa-list"></i> Lowongan kerja
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ url('company/applications') }}">
                                    <i class="fas fa-users"></i> Pelamar
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- INTERNSHIP + SUBMENU -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('company/magang*') ? 'active' : '' }}"
                           href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                           <i class="fas fa-graduation-cap me-1"></i> Internship
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ url('company/magang') }}">
                                    <i class="fas fa-list"></i> Lowongan magang
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ url('company/magang/dokumen') }}">
                                    <i class="fas fa-file-alt"></i> Dokumen
                                </a>
                            </li>
                        </ul>
                    </li>
                    

                    <span class="nav-underline" id="companyUnderline"></span>
                </ul>

                <div class="d-flex align-items-center ms-lg-auto">
                    @auth('company')
                        @php
                            $company = Auth::guard('company')->user();
                        @endphp

                        <span class="company-name-navbar d-none d-lg-inline-block me-3">
                            {{ $company->nama_perusahaan }}
                        </span>

                        <div class="dropdown">
                            <a class="d-flex align-items-center user-dropdown-toggle" 
                               href="#" 
                               role="button" 
                               data-bs-toggle="dropdown" 
                               aria-expanded="false"
                               id="userDropdown">
                                <div class="user-profile-icon">
                                    @if($company->logo)
                                        <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo Perusahaan">
                                    @else
                                        {{ strtoupper(substr($company->nama_perusahaan, 0, 2)) }}
                                    @endif
                                </div>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end glints-dropdown" aria-labelledby="userDropdown">
                                <li class="px-3 py-2 text-muted">
                                    <div class="small">Masuk sebagai</div>
                                    <strong>{{ $company->nama_perusahaan }}</strong>
                                </li>

                                <li><hr class="dropdown-divider"></li>

                                <li>
                                    <a class="dropdown-item" href="{{ url('company/profile') }}">
                                        <i class="fas fa-building"></i>&nbsp;Profil Perusahaan
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="{{ url('company/settings') }}">
                                        <i class="fas fa-cog"></i>&nbsp;Pengaturan
                                    </a>
                                </li>

                                <li><hr class="dropdown-divider"></li>

                                <li>
                                    <form method="POST" action="{{ route('company.logout') }}" id="logout-form">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-power-off"></i>&nbsp;Keluar
                                        </button>
                                    </form>
                                </li> 
                            </ul>
                        </div>
                    @else
                        <a href="{{ url('/company/login') }}" class="btn-login">
                            <i class="fas fa-sign-in-alt me-1"></i>Masuk
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

   

   
</body>
</html>