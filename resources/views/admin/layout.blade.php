<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel admin next jobz</title>
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('123.png') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    /* ====================
        GLOBAL STYLES
        ==================== */
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f4f6f9;
      color: #333;
      margin: 0;
      padding: 0;
      overflow-x: hidden;
    }

    #wrapper {
      display: flex;
      min-height: 100vh;
    }

    /* DARK MODE */
    body.dark-mode {
      background-color: #1e1e2f;
      color: #ddd;
    }
    body.dark-mode #content-wrapper {
      background-color: #2b2b3c;
      color: #ddd;
    }
    body.dark-mode .navbar {
      background-color: #2f2f44;
      color: #ddd;
    }
    body.dark-mode .navbar .nav-link,
    body.dark-mode .profile-text {
      color: #ddd !important;
    }
    body.dark-mode .nav-link:hover,
    body.dark-mode .nav-link.active {
      background-color: rgba(255, 255, 255, 0.15);
    }

    /* ====================
        SIDEBAR STYLES - IMPROVED
        ==================== */
    #sidebar-wrapper {
      background: linear-gradient(0deg,
        red, orange, yellow, green, blue, indigo, violet
      );
      background-size: 100% 400%;
      color: #fff;
      min-height: 100vh;
      width: 250px;
      transition: all 0.3s ease;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
      position: fixed;
      z-index: 1000;
      animation: rainbowBG 15s linear infinite;
      left: 0;
      display: flex;
      flex-direction: column;
    }

    @keyframes rainbowBG {
      0%   { background-position: 50% 100%; }
      50%  { background-position: 50% 0%; }
      100% { background-position: 50% 100%; }
    }

    .sidebar-brand {
      padding: 1.5rem 1rem;
      text-align: center;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 120px;
      flex-shrink: 0;
    }

    .sidebar-brand img {
      width: 100px;
      height: auto;
      object-fit: contain;
      margin-bottom: 0;
    }

    .sidebar-brand h5 {
      font-weight: 700;
      margin: 0;
      text-transform: uppercase;
      font-size: 1.1rem;
      transition: all 0.5s ease;
    }

    .sidebar-nav-container {
      flex: 1;
      display: flex;
      flex-direction: column;
      overflow: hidden;
      position: relative;
    }

    .sidebar-nav {
      flex: 1;
      overflow-y: auto;
      padding-bottom: 1rem;
      max-height: calc(100vh - 180px); /* Membatasi tinggi maksimum */
    }

    .sidebar-nav::-webkit-scrollbar {
      width: 6px;
    }

    .sidebar-nav::-webkit-scrollbar-track {
      background: rgba(255, 255, 255, 0.1);
    }

    .sidebar-nav::-webkit-scrollbar-thumb {
      background: rgba(255, 255, 255, 0.3);
      border-radius: 3px;
    }

    .sidebar-nav::-webkit-scrollbar-thumb:hover {
      background: rgba(255, 255, 255, 0.5);
    }

    .nav-item {
      padding: 0 1rem;
    }

    .nav-link {
      display: flex;
      align-items: center;
      padding: 0.8rem 1rem; /* Sedikit lebih kecil padding */
      color: #fff;
      position: relative;
      transition: all 0.3s ease;
      font-size: 0.95rem; /* Sedikit lebih kecil font */
    }

    .nav-link.active {
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 5px;
    }

    .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 5px;
        transform: translateX(5px);
    }

    .nav-link i {
      margin-right: 0.8rem;
      font-size: 1.1rem; /* Sedikit lebih kecil */
      width: 20px;
      text-align: center;
    }

    /* Ikon dropdown custom */
    .dropdown-arrow {
      margin-left: auto;
      color: #fff;
      transition: transform 0.3s ease;
      font-size: 0.8rem;
    }
    .nav-link[aria-expanded="false"] .dropdown-arrow {
      transform: rotate(0deg);
    }
    .nav-link[aria-expanded="true"] .dropdown-arrow {
      transform: rotate(90deg);
    }

    /* Dropdown menu di sidebar */
    .sidebar-nav .dropdown-menu {
      background-color: rgba(59, 96, 196, 0.9);
      border: none;
      padding: 0;
      margin-top: 0;
      width: 100%;
      position: static !important;
      transform: none !important;
    }

    .sidebar-nav .dropdown-menu .dropdown-item {
      color: #fff;
      padding: 0.6rem 1rem 0.6rem 3.2rem; /* Sedikit lebih kecil */
      background-color: transparent;
      font-size: 0.9rem; /* Sedikit lebih kecil */
      display: flex;
      align-items: center;
      transition: all 0.3s ease;
    }

    .sidebar-nav .dropdown-menu .dropdown-item i {
      margin-right: 0.75rem;
      width: 20px;
    }

    .sidebar-nav .dropdown-menu .dropdown-item:hover {
        background-color: rgba(255, 255, 255, 0.1);
        transform: translateX(5px);
    }

    .sidebar-nav .dropdown-menu .dropdown-item.active {
        background-color: rgba(255, 255, 255, 0.2);
        font-weight: bold;
    }

    /* Logout button di bagian bawah */
    .sidebar-footer {
      padding: 1rem;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      flex-shrink: 0;
    }

    .logout-btn {
      display: flex;
      align-items: center;
      padding: 0.8rem 1rem;
      color: #fff;
      text-decoration: none;
      transition: all 0.3s ease;
      border-radius: 5px;
    }

    .logout-btn:hover {
      background-color: rgba(255, 255, 255, 0.1);
      color: #fff;
    }

    .logout-btn i {
      margin-right: 0.8rem;
      font-size: 1.1rem;
    }

    /* ====================
        CONTENT & NAVBAR
        ==================== */
    #content-wrapper {
      flex-grow: 1;
      margin-left: 250px;
      background-color: #f4f6f9;
      min-height: 100vh;
      transition: all 0.3s ease;
      width: calc(100% - 250px);
    }

    .navbar {
      background-color: #fff;
      padding: 0.75rem 2rem;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
      z-index: 999;
    }

    .navbar-custom {
      padding-left: 1rem;
      padding-right: 2rem;
    }

    .navbar-nav {
      display: flex;
      align-items: center;
      flex-direction: row;
    }

    .navbar-nav .nav-item .nav-link {
      color: #555;
      padding: 0;
      background: none;
      display: flex;
      align-items: center;
    }

    .dropdown-menu {
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .main-content {
      padding: 2rem;
      min-height: calc(100vh - 80px);
    }

    #sidebarToggle {
      background: none;
      border: none;
      color: #4e73df;
      font-size: 1.5rem;
      cursor: pointer;
      transition: transform 0.3s ease;
    }

    #sidebarToggle:hover {
      transform: scale(1.1);
    }

    .profile-text {
      font-size: 1.1rem;
      font-weight: 500;
    }

    .profile-icon {
      font-size: 2.25rem !important;
      cursor: pointer;
      transition: transform 0.3s ease;
    }

    .profile-icon:hover {
      transform: scale(1.1);
    }

    /* Dark Mode Toggle Button */
    .dark-toggle {
        background: none;
        border: none;
        color: #555;
        font-size: 1.25rem;
        cursor: pointer;
        margin-right: 1rem;
        transition: all 0.3s ease;
        padding: 0.5rem;
        border-radius: 50%;
    }
    .dark-toggle:hover {
        color: #4e73df;
        background-color: rgba(78, 115, 223, 0.1);
    }
    body.dark-mode .dark-toggle {
        color: #ddd;
    }
    body.dark-mode .dark-toggle:hover {
        color: #fff;
        background-color: rgba(255, 255, 255, 0.1);
    }

    /* Notification Button */
    .notification-btn {
        background: none;
        border: none;
        color: #555;
        font-size: 1.25rem;
        cursor: pointer;
        margin-right: 1rem;
        transition: all 0.3s ease;
        padding: 0.5rem;
        border-radius: 50%;
        position: relative;
    }
    .notification-btn:hover {
        color: #ec650aff;
        background-color: rgba(78, 115, 223, 0.1);
    }
    body.dark-mode .notification-btn {
        color: #ddd;
    }
    body.dark-mode .notification-btn:hover {
        color: #fff;
        background-color: rgba(255, 255, 255, 0.1);
    }

    .notification-badge {
        position: absolute;
        top: 0;
        right: 0;
        background-color: #e74c3c;
        color: white;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        font-size: 0.7rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Notification Dropdown Styles */
    .notification-dropdown {
        min-width: 350px;
        max-width: 400px;
        padding: 0;
    }

    .notification-list {
        max-height: 300px;
        overflow-y: auto;
    }

    .notification-item {
        padding: 0.75rem 1rem;
        cursor: pointer;
        transition: background-color 0.2s ease;
        border-radius: 0;
        margin: 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .notification-item:last-child {
        border-bottom: none;
    }

    .notification-item:hover {
        background-color: rgba(0, 0, 0, 0.03);
    }

    .notification-item.unread {
        background-color: rgba(0, 123, 255, 0.05);
        border-left: 3px solid #007bff;
    }

    .notification-item.read {
        opacity: 0.7;
        border-left: 3px solid transparent;
    }

    .notification-item h6 {
        font-size: 0.9rem;
        margin-bottom: 0.25rem;
        color: #333;
        font-weight: 600;
    }

    .notification-item p {
        font-size: 0.8rem;
        margin-bottom: 0.25rem;
        color: #666;
        line-height: 1.3;
    }

    .notification-item small {
        font-size: 0.7rem;
        color: #888;
    }

    .notification-badge.new {
        background-color: #e74c3c;
        color: white;
        font-size: 0.6rem;
        padding: 0.1rem 0.3rem;
    }

    .notification-empty {
        text-align: center;
        padding: 2rem 1rem;
        color: #6c757d;
    }

    .notification-empty i {
        font-size: 2rem;
        margin-bottom: 0.5rem;
        opacity: 0.5;
    }

    /* Dark mode styles untuk notifikasi */
    body.dark-mode .notification-item:hover {
        background-color: rgba(255, 255, 255, 0.05);
    }

    body.dark-mode .notification-item.unread {
        background-color: rgba(78, 115, 223, 0.1);
    }

    body.dark-mode .notification-item h6 {
        color: #ddd;
    }

    body.dark-mode .notification-item p {
        color: #aaa;
    }

    body.dark-mode .notification-item {
        border-bottom-color: #444;
    }

    /* Scrollbar untuk dropdown notifikasi */
    .notification-list::-webkit-scrollbar {
        width: 6px;
    }

    .notification-list::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }

    .notification-list::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 3px;
    }

    .notification-list::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }

    body.dark-mode .notification-list::-webkit-scrollbar-track {
        background: #2a2a3c;
    }

    body.dark-mode .notification-list::-webkit-scrollbar-thumb {
        background: #555;
    }

    body.dark-mode .notification-list::-webkit-scrollbar-thumb:hover {
        background: #777;
    }

    /* Dropdown header */
    .dropdown-header {
        padding: 0.75rem 1rem;
        background-color: #f8f9fa;
        border-bottom: 1px solid #e3e6f0;
    }

    body.dark-mode .dropdown-header {
        background-color: #2f2f44;
        border-bottom-color: #444;
    }

    /* ====================
        TOGGLE STYLES
        ==================== */
    #wrapper.toggled #sidebar-wrapper {
      width: 70px;
    }
    #wrapper.toggled #content-wrapper {
      margin-left: 70px;
      width: calc(100% - 70px);
    }

    #wrapper.fully-closed #sidebar-wrapper {
      width: 0;
      transform: translateX(-100%);
    }
    #wrapper.fully-closed #content-wrapper {
      margin-left: 0;
      width: 100%;
    }

    #wrapper.toggled .sidebar-brand h5,
    #wrapper.toggled .sidebar-nav .nav-link span,
    #wrapper.toggled .dropdown-arrow {
      display: none;
    }
    #wrapper.toggled .sidebar-nav .dropdown-menu {
      display: none !important;
    }
    #wrapper.toggled .sidebar-brand {
      justify-content: center;
      padding: 1rem 0;
    }
    #wrapper.toggled .nav-link i {
      margin: 0 auto;
    }
    #wrapper.toggled .nav-item {
        padding: 0 5px;
    }
    #wrapper.toggled .nav-link {
        justify-content: center;
        padding: 1rem 0;
    }

    #wrapper.fully-closed .sidebar-brand,
    #wrapper.fully-closed .sidebar-nav {
      opacity: 0;
      visibility: hidden;
    }

    /* ====================
        RESPONSIVE
        ==================== */
    @media (max-width: 768px) {
      #sidebar-wrapper {
        width: 250px;
        transform: translateX(-100%);
      }

      #content-wrapper {
        margin-left: 0;
        width: 100%;
      }

      #wrapper.toggled #sidebar-wrapper {
        transform: translateX(0);
        width: 250px;
      }

      #wrapper.toggled #content-wrapper {
        margin-left: 0;
        width: 100%;
      }

      #wrapper.fully-closed #sidebar-wrapper {
        transform: translateX(-100%);
      }

      .navbar {
        padding: 0.75rem 1rem;
      }

      .navbar-custom {
        padding-left: 0.5rem;
        padding-right: 1rem;
      }

      .notification-dropdown {
        min-width: 280px;
        max-width: 300px;
      }
    }
  </style>
</head>
<body>
  <div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="#" class="text-white text-decoration-none d-flex flex-column align-items-center">
          <img src="{{ asset('images/inotal.png') }}" alt="Inotal Logo">
          <div class="brand-text">
            <h5>Panel Admin</h5>
          </div>
        </a>
      </div>

      <div class="sidebar-nav-container">
        <ul class="nav flex-column sidebar-nav mt-3">
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
              <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
            </a>
          </li>

          @auth
          {{-- BLOK KHUSUS UNTUK ROLE WAWANCARA --}}
          @if(Auth::user()->role === 'wawancara')
              <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('wawancara.jadwal.index') ? 'active' : '' }}"
                     href="{{ route('wawancara.jadwal.index') }}">
                      <i class="fas fa-calendar-alt"></i> <span>Lihat Jadwal</span>
                  </a>
              </li>
          @endif

            {{-- BLOK UNTUK ROLE ADMIN & SUPER ADMIN --}}
            @if(in_array(Auth::user()->role, ['admin', 'super admin']))
              <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('admin.job_listings.*') ? 'active' : '' }}"
                     href="{{ route('admin.job_listings.index') }}">
                     <i class="fas fa-briefcase"></i> <span>Lowongan Kerja</span>
                  </a>
              </li>

              <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('admin.applicants.*') ? 'active' : '' }}"
                     href="{{ route('admin.applicants.index') }}">
                     <i class="fas fa-user-tie"></i> <span>Pelamar</span>
                  </a>
              </li>

              <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('admin.calendar.*') ? 'active' : '' }}"
                     href="{{ route('admin.calendar.index') }}">
                     <i class="fas fa-calendar-alt"></i> <span>Manajemen Jadwal</span>
                  </a>
              </li>

              <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}"
                     href="{{ route('admin.reports.index') }}">
                     <i class="fas fa-chart-bar"></i> <span>LAPORAN</span>
                  </a>
              </li>

              <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('admin.notif.*') ? 'active' : '' }}"
                     href="{{ route('admin.notif.index') }}">
                     <i class="fas fa-bell"></i> <span>Notifikasi</span>
                  </a>
              </li>

              <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('admin.magang.*') ? 'active' : '' }}"
                     href="{{ route('admin.magang.index') }}">
                     <i class="fas fa-briefcase"></i> <span>Lowongan magang</span>
                  </a>
              </li>

              {{-- TAMBAHAN: Navigasi untuk Pesan Masuk / Form Kontak yang telah disubmit pengguna --}}
              <li class="nav-item">
                  {{-- Menghitung jumlah pesan baru (belum dibaca).
                      Jika Anda ingin menghindari query di blade, pindahkan ke view composer. --}}
                  @php
                      try {
                          $countNewMessages = \App\Models\ContactMessage::whereNull('read_at')->count();
                      } catch (\Throwable $e) {
                          // Jika model/migration belum ada -> fallback 0 supaya UI tidak error
                          $countNewMessages = 0;
                      }
                  @endphp

                  <a class="nav-link {{ request()->routeIs('admin.contact-messages.*') ? 'active' : '' }}"
                     href="{{ route('admin.contact-messages.index') }}">
                     <i class="fas fa-envelope"></i> <span>kontak</span>
                     @if($countNewMessages > 0)
                         <span class="badge bg-danger ms-auto" style="margin-left: 0.5rem;">{{ $countNewMessages }}</span>
                     @endif
                  </a>
              </li>
            @endif

            {{-- BLOK KHUSUS UNTUK ROLE SUPER ADMIN --}}
            @if(Auth::user()->role === 'super admin')
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.users.index') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                  <i class="fas fa-users-cog"></i> <span>Manajemen User</span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.lokasi.index') ? 'active' : '' }}" href="{{ route('admin.lokasi.index') }}">
                  <i class="fas fa-map-marker-alt"></i> <span>Manajemen Lokasi</span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.companies.index') ? 'active' : '' }}" href="{{ route('admin.companies.index') }}">
                  <i class="fas fa-building"></i> <span>Perusahaan</span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.campus.index') ? 'active' : '' }}" href="{{ route('admin.campus.index') }}">
                  <i class="fa-solid fa-school"></i> <span>Kampus</span>
                </a>
              </li>
            @endif
          @endauth
        </ul>
      </div>

      <!-- Logout Button di Footer Sidebar -->
      <div class="sidebar-footer">
        <a class="logout-btn" href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
        </form>
      </div>
    </div>

    <!-- Content Wrapper -->
    <div id="content-wrapper">
      <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
        <div class="d-flex align-items-center">
          <button id="sidebarToggle" class="btn btn-link rounded-circle me-3">
            <i class="fa fa-bars"></i>
          </button>
          <h3 class="page-title mb-0">@yield('title', 'semangat yaa')</h3>
        </div>

        <ul class="navbar-nav ms-auto d-flex flex-row align-items-center">
          @auth
            <button id="darkModeToggle" class="dark-toggle">
              <i class="fas fa-moon"></i>
            </button>

            <!-- Notification Dropdown -->
            <li class="nav-item dropdown no-arrow me-3">
              <button id="notificationToggle" class="notification-btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell"></i>
                <span class="notification-badge" style="display: none;">0</span>
              </button>

              <div class="dropdown-menu dropdown-menu-end shadow animated--grow-in notification-dropdown"
                   id="notificationDropdown" aria-labelledby="notificationToggle">
                <div class="dropdown-header d-flex justify-content-between align-items-center">
                  <strong>Notifikasi</strong>
                  <a href="{{ route('admin.notif.my') }}" class="small text-primary">Lihat Semua</a>
                </div>
                <div class="dropdown-divider"></div>
                <div class="notification-list" style="max-height: 300px; overflow-y: auto;">
                  <div class="text-center p-3">
                    <div class="spinner-border spinner-border-sm" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2 small text-muted">Memuat notifikasi...</p>
                  </div>
                </div>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-center small text-muted" href="javascript:void(0)" onclick="loadNotifications()">
                  <i class="fas fa-sync-alt me-1"></i> Refresh
                </a>
              </div>
            </li>

            <li class="nav-item dropdown no-arrow">
              <a class="nav-link d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="d-none d-lg-flex flex-column text-start me-2">
                  <span class="fw-bold">{{ Auth::user()->name }}</span>
                  <span class="small text-warning">{{ strtoupper(Auth::user()->role) }}</span>
                </div>
                <i class="fas fa-user-circle text-primary profile-icon"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-end shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>
                  Lihat Profil
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form-dropdown').submit();">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>
                  Logout
                </a>
                <form id="logout-form-dropdown" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </div>
            </li>
          @endauth
        </ul>
      </nav>

      <div class="main-content">
        @yield('content')
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const sidebarToggle = document.getElementById('sidebarToggle');
      const darkToggle = document.getElementById('darkModeToggle');
      const notificationToggle = document.getElementById('notificationToggle');
      const wrapper = document.getElementById('wrapper');
      const body = document.body;

      // State management untuk sidebar
      let sidebarState = 'open'; // 'open', 'collapsed', 'closed'

      // Sidebar toggle dengan 3 status
      sidebarToggle.addEventListener('click', function () {
        if (sidebarState === 'open') {
          // Buka -> Mode ikon
          wrapper.classList.add('toggled');
          wrapper.classList.remove('fully-closed');
          sidebarState = 'collapsed';
        } else if (sidebarState === 'collapsed') {
          // Mode ikon -> Tutup sepenuhnya
          wrapper.classList.remove('toggled');
          wrapper.classList.add('fully-closed');
          sidebarState = 'closed';
        } else {
          // Tutup -> Buka
          wrapper.classList.remove('fully-closed');
          wrapper.classList.remove('toggled');
          sidebarState = 'open';
        }

        // Tutup dropdown yang terbuka saat men-toggle sidebar
        const openDropdown = document.querySelector('.sidebar-nav .dropdown-menu.show');
        if (openDropdown) {
          const collapseElement = bootstrap.Collapse.getInstance(openDropdown.closest('.collapse'));
          if (collapseElement) {
            collapseElement.hide();
          }
        }
      });

      // Dark mode toggle
      darkToggle.addEventListener('click', function () {
        body.classList.toggle('dark-mode');
        const icon = darkToggle.querySelector('i');
        if (body.classList.contains('dark-mode')) {
          icon.classList.replace('fa-moon', 'fa-sun');
          localStorage.setItem('theme', 'dark');
        } else {
          icon.classList.replace('fa-sun', 'fa-moon');
          localStorage.setItem('theme', 'light');
        }
      });

      // Load saved theme
      if (localStorage.getItem('theme') === 'dark') {
        body.classList.add('dark-mode');
        if (darkToggle) {
          darkToggle.querySelector('i').classList.replace('fa-moon', 'fa-sun');
        }
      }

      // Handle responsive behavior
      function handleResponsive() {
        if (window.innerWidth <= 768) {
          // Di mobile, defaultnya sidebar tertutup
          if (!wrapper.classList.contains('toggled') && !wrapper.classList.contains('fully-closed')) {
            wrapper.classList.add('fully-closed');
            sidebarState = 'closed';
          }
        }
      }

      // Initial responsive check
      handleResponsive();

      // Listen for window resize
      window.addEventListener('resize', handleResponsive);

      // ==================== NOTIFICATION FUNCTIONS ====================

      // Fungsi untuk memuat notifikasi dari server
      async function loadNotifications() {
        try {
          const notificationList = document.querySelector('.notification-list');
          if (notificationList) {
            notificationList.innerHTML = `
              <div class="text-center p-3">
                <div class="spinner-border spinner-border-sm" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2 small text-muted">Memuat notifikasi...</p>
              </div>
            `;
          }

          const response = await fetch('{{ route("admin.notif.api.my") }}');
          const data = await response.json();

          if (data.success) {
            updateNotificationDropdown(data.notifications);
            updateNotificationBadge(data.unread_count);
          } else {
            throw new Error('Failed to load notifications');
          }
        } catch (error) {
          console.error('Error loading notifications:', error);
          const notificationList = document.querySelector('.notification-list');
          if (notificationList) {
            notificationList.innerHTML = `
              <div class="text-center p-3 text-danger">
                <i class="fas fa-exclamation-triangle"></i>
                <p class="mt-2 small">Gagal memuat notifikasi</p>
                <button class="btn btn-sm btn-primary mt-2" onclick="loadNotifications()">Coba Lagi</button>
              </div>
            `;
          }
        }
      }

      // Fungsi untuk memperbarui dropdown notifikasi
      function updateNotificationDropdown(notifications) {
        const notificationList = document.querySelector('.notification-list');
        if (!notificationList) return;

        if (notifications.length === 0) {
          notificationList.innerHTML = `
            <div class="notification-empty">
              <i class="fas fa-bell-slash"></i>
              <p class="mt-2 small">Tidak ada notifikasi</p>
            </div>
          `;
          return;
        }

        let html = '';
        notifications.forEach(notif => {
          const isRead = notif.read_at !== null;
          const timeAgo = getTimeAgo(notif.created_at);
          const title = notif.data?.title || 'Notifikasi';
          const message = notif.data?.message || 'Tidak ada pesan';

          html += `
            <div class="notification-item ${isRead ? 'read' : 'unread'}"
                 data-id="${notif.id}" onclick="markAsRead('${notif.id}')">
              <div class="d-flex align-items-start">
                <div class="flex-grow-1">
                  <h6 class="mb-1">${title}</h6>
                  <p class="mb-1">${message}</p>
                  <small class="text-muted">${timeAgo}</small>
                </div>
                ${!isRead ? '<span class="badge bg-primary ms-2 new">Baru</span>' : ''}
              </div>
            </div>
          `;
        });

        notificationList.innerHTML = html;
      }

      // Fungsi untuk memperbarui badge notifikasi
      function updateNotificationBadge(unreadCount) {
        const badge = document.querySelector('.notification-badge');
        if (!badge) return;

        if (unreadCount > 0) {
          badge.textContent = unreadCount > 99 ? '99+' : unreadCount;
          badge.style.display = 'flex';
        } else {
          badge.style.display = 'none';
        }
      }

      // Fungsi untuk menandai notifikasi sebagai dibaca
      window.markAsRead = async function(notificationId) {
        try {
          const response = await fetch(`/admin/notif/read/${notificationId}`, {
            method: 'PUT',
            headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}',
              'Content-Type': 'application/json',
              'Accept': 'application/json'
            }
          });

          if (response.ok) {
            // Update tampilan notifikasi
            const notificationItem = document.querySelector(`.notification-item[data-id="${notificationId}"]`);
            if (notificationItem) {
              notificationItem.classList.remove('unread');
              notificationItem.classList.add('read');
              const newBadge = notificationItem.querySelector('.badge.new');
              if (newBadge) {
                newBadge.remove();
              }
            }

            // Update badge count
            loadNotifications();
          }
        } catch (error) {
          console.error('Error marking notification as read:', error);
        }
      }

      // Fungsi utility untuk format waktu
      function getTimeAgo(timestamp) {
        const now = new Date();
        const time = new Date(timestamp);
        const diffInSeconds = Math.floor((now - time) / 1000);

        if (diffInSeconds < 60) return 'Baru saja';
        if (diffInSeconds < 3600) return `${Math.floor(diffInSeconds / 60)} menit lalu`;
        if (diffInSeconds < 86400) return `${Math.floor(diffInSeconds / 3600)} jam lalu`;
        if (diffInSeconds < 2592000) return `${Math.floor(diffInSeconds / 86400)} hari lalu`;

        return time.toLocaleDateString('id-ID', {
          day: 'numeric',
          month: 'short',
          year: 'numeric'
        });
      }

      // Load notifikasi saat halaman pertama kali dimuat
      loadNotifications();

      // Auto-refresh notifikasi setiap 30 detik
      setInterval(loadNotifications, 30000);

      // Event listener untuk dropdown notifikasi
      notificationToggle.addEventListener('click', function () {
        // Load notifikasi ketika dropdown diklik
        loadNotifications();
      });

      // Make loadNotifications available globally
      window.loadNotifications = loadNotifications;
    });
  </script>
</body>
</html>
