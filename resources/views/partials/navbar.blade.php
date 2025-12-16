<style>
    .navbar {
        font-size: 1rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        position: relative;
    }

    .navbar-logo {
        height: 38px;
        width: auto;
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

    .navbar .nav-item {
        display: flex;
        align-items: center;
    }

    .nav-underline {
        position: absolute;
        bottom: 0;
        height: 2px;
        background: #0d47a1;
        transition: all 0.3s ease;
    }

    .btn-primary,
    .btn-outline-primary {
        border-radius: 4px;
        padding: 0.35rem 1rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-primary {
        color: #fff;
        background-color: #0d47a1;
        border-color: #0d47a1;
    }

    .btn-primary:hover {
        background-color: #fff;
        color: #0d47a1;
        border-color: #0d47a1;
    }

    .btn-outline-primary {
        color: #0d47a1;
        border-color: #0d47a1;
    }

    .btn-outline-primary:hover {
        background-color: #0d47a1;
        color: #fff;
        border-color: #0d47a1;
    }

    .btn-primary-custom,
    .btn-outline-primary-custom {
        transition: all 0.3s ease;
    }

    .btn-primary-custom:hover {
        background-color: #fff;
        color: #0d47a1;
        border-color: #0d47a1;
    }

    .btn-outline-primary-custom:hover {
        background-color: #0d47a1;
        color: #fff;
        border-color: #0d47a1;
    }

    .nav-icon {
        font-size: 1.2rem;
        color: #2c2c2c;
        margin-right: 1rem;
        cursor: pointer;
        transition: color 0.2s;
    }

    .nav-icon:hover {
        color: #0d47a1;
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
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.15);
    }

    .user-dropdown-name {
        font-weight: 600;
        color: #2c2c2c;
        margin: 0 0.3rem 0 0.8rem;
        white-space: nowrap;
        max-width: 150px;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .user-dropdown-toggle {
        display: flex;
        align-items: center;
        text-decoration: none;
        color: inherit;
    }

    .user-dropdown-toggle:hover {
        text-decoration: none;
        color: inherit;
    }

    .dropdown-menu {
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .dropdown-toggle::after {
        display: none;
    }

    .nav-link.company-link {
        color: #0d47a1 !important;
        font-weight: 600 !important;
        display: flex;
        align-items: center;
        height: 100%;
    }

    .nav-link.company-link:hover,
    .nav-link.company-link:focus,
    .nav-link.company-link.active {
        color: #0d47a1 !important;
        border: none !important;
    }

    .navbar .d-flex.align-items-center {
        gap: 0.75rem;
    }

    .navbar .nav-link.company-link.ms-3 {
        margin-top: 0 !important;
        display: flex;
        align-items: center;
        padding-top: 0.25rem;
    }

    .btn-company-outline {
        border-radius: 4px;
        padding: 0.35rem 1rem;
        font-weight: 600;
        transition: all 0.3s ease;
        color: #0d47a1;
        border: 1px solid #0d47a1;
        background-color: transparent;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        height: 100%;
    }

    .btn-company-outline:hover {
        background-color: #0d47a1;
        color: #fff;
        border-color: #0d47a1;
    }

    .btn-company-outline .fas.fa-arrow-right {
        margin-left: 0.5rem;
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
    }

    .chevron-icon.open {
        transform: rotate(180deg);
    }

    /* CSS untuk Notifikasi */
    .notification-dropdown {
        min-width: 350px;
        max-width: 400px;
        max-height: 500px;
        overflow-y: auto;
    }

    .notification-item {
        padding: 0.75rem 1rem;
        border-bottom: 1px solid #f0f0f0;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .notification-item:hover {
        background-color: #f8f9fa;
    }

    .notification-item.unread {
        background-color: #f0f7ff;
    }

    .notification-title {
        font-weight: 600;
        font-size: 0.9rem;
        color: #2c2c2c;
        margin-bottom: 0.25rem;
    }

    .notification-message {
        font-size: 0.85rem;
        color: #6c757d;
        margin-bottom: 0.25rem;
        line-height: 1.3;
    }

    .notification-time {
        font-size: 0.75rem;
        color: #999;
    }

    .notification-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background-color: #dc3545;
        color: white;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        font-size: 0.7rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .notification-empty {
        padding: 2rem 1rem;
        text-align: center;
        color: #6c757d;
    }

    .notification-empty i {
        font-size: 2rem;
        margin-bottom: 0.5rem;
        color: #dee2e6;
    }

    .notification-header {
        padding: 0.75rem 1rem;
        border-bottom: 1px solid #dee2e6;
        background-color: #f8f9fa;
        font-weight: 600;
    }

    .notification-footer {
        padding: 0.5rem 1rem;
        border-top: 1px solid #dee2e6;
        text-align: center;
    }

    .notification-footer a {
        color: #0d47a1;
        text-decoration: none;
        font-size: 0.85rem;
    }

    .notification-footer a:hover {
        text-decoration: underline;
    }

    .notification-icon-container {
        position: relative;
        display: inline-block;
    }
    /* Tambahkan CSS ini untuk link notifikasi */
.notification-link {
    display: block;
    text-decoration: none;
    color: inherit;
    padding: 0.75rem 1rem;
    border-bottom: 1px solid #f0f0f0;
    cursor: pointer;
    transition: background-color 0.2s;
}

.notification-link:hover {
    text-decoration: none;
    color: inherit;
    background-color: #f8f9fa;
}

.notification-item.unread .notification-link {
    background-color: #f0f7ff;
}

.notification-item.unread .notification-link:hover {
    background-color: #e3f2fd;
}

/* Pastikan pointer events bekerja */
.notification-dropdown {
    min-width: 350px;
    max-width: 400px;
    max-height: 500px;
    overflow-y: auto;
    z-index: 1060;
}

.notification-item {
    border-bottom: none; /* Hapus border dari item karena sudah ada di link */
}

.notification-item:last-child .notification-link {
    border-bottom: none;
}

    @media (max-width: 992px) {
        .navbar .nav-link.active {
            border-bottom: none;
        }
        .nav-underline {
            display: none;
        }
        .user-dropdown-name,
        .chevron-icon {
            display: none !important;
        }
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container-fluid mx-lg-5">

        <a class="navbar-brand d-flex align-items-center py-2" href="{{ url('/') }}">
            <img src="{{ asset('images/logo_inotal.png') }}" alt="Inotal Logo" class="navbar-logo d-inline-block align-text-top">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 position-relative" id="navMenu">

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('jobs.index') ? 'active' : '' }}"
                        href="{{ route('jobs.index') }}">
                        Lowongan Kerja
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link
                        {{ request()->is('sumber-daya-karir') ||
                            request()->is('sumber-daya-karir/jelajahi-karier') ||
                            request()->is('sumber-daya-karir/pencarian-lowongan-kerja') ||
                            request()->is('sumber-daya-karir/kehidupan-kerja') ||
                            request()->is('sumber-daya-karir/jelajahi-gaji')
                            ? 'active' : '' }}"
                        href="/sumber-daya-karir">
                        Sumber Daya Karir
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('explore-perusahaan') ? 'active' : '' }}"
                        href="/explore-perusahaan">
                        Explore Organisasi
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('magang.index') ? 'active' : '' }}"
                        href="{{ route('magang.index') }}">
                        Open intership
                    </a>
                </li>

                <li class="nav-item d-lg-none">
                    <a href="{{ url('/kampus/perusahaan') }}"
                        class="btn-company-outline"> Kampus/Perusahaan
                         </a>
                </li>

                <span class="nav-underline" id="navUnderline"></span>
            </ul>

            <div class="d-flex align-items-center">

                @auth
                    @if (Auth::user()->role === 'user')

                        <!-- Notifikasi Dropdown -->
                        <div class="dropdown me-2" id="notificationDropdownContainer">
                            <a class="nav-icon notification-icon-container" href="#" role="button"
                               id="notificationDropdownToggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-bell" title="Notifikasi"></i>
                                <span class="notification-badge d-none" id="notificationBadge">0</span>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end notification-dropdown" aria-labelledby="notificationDropdownToggle">
                                <li class="notification-header">
                                    Notifikasi
                                </li>
                                <div id="notificationList">
                                    <li class="notification-empty">
                                        <i class="fas fa-bell-slash"></i>
                                        <div>Tidak ada notifikasi</div>
                                    </li>
                                </div>
                                <li class="notification-footer">
                                    <a href="{{ route('notifications.my') }}">Lihat Semua Notifikasi</a>
                                </li>
                            </ul>
                        </div>

                        <!-- User Profile Dropdown -->
                        <div class="dropdown" id="userDropdownContainer">
                            <a class="user-dropdown-toggle" href="#" role="button"
                               id="userDropdownToggle" data-bs-toggle="dropdown" aria-expanded="false">

                               <div class="user-profile-icon">

                                @if (Auth::user()->avatar)
                                    <img src="{{ Auth::user()->avatar }}" alt="Profile Avatar" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                                @else
                                    @php
                                        $name = Auth::user()->name;
                                        $nameParts = explode(' ', trim($name));
                                        $initials = '';
                                        if (count($nameParts) >= 2) {
                                            $initials = strtoupper(substr($nameParts[0], 0, 1) . substr(end($nameParts), 0, 1));
                                        } elseif (count($nameParts) == 1 && !empty($nameParts[0])) {
                                            $initials = strtoupper(substr($nameParts[0], 0, 2));
                                        } else {
                                            $initials = '<i class="fas fa-user"></i>';
                                        }
                                    @endphp

                                    @if (strpos($initials, 'fas fa-user') !== false)
                                        <i class="fas fa-user"></i>
                                    @else
                                        {{ $initials }}
                                    @endif
                                @endif
                               </div>

                                <span class="user-dropdown-name d-none d-lg-inline">
                                    {{ Auth::user()->name }}
                                </span>

                                <i class="fas fa-chevron-down ms-1 d-none d-lg-inline chevron-icon"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end glints-dropdown" aria-labelledby="userDropdownToggle">
                                <li>
                                    <a class="dropdown-item" href="{{ url('/profile') }}">
                                        <i class="fas fa-user-circle"></i> PROFIL SAYA
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('user.applications.index') }}">
    <i class="fas fa-file-alt"></i> LAMARAN SAYA
</a>

                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ url('/pengaturan/detail') }}">
                                        <i class="fas fa-cog"></i> PENGATURAN AKUN
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item logout-item">
                                            <i class="fas fa-power-off"></i> KELUAR
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>

                    @else
                        <a href="{{ url('/daftar') }}" class="btn btn-primary btn-primary-custom">Daftar</a>
                        <a href="{{ url('/masuk') }}" class="btn btn-outline-primary btn-outline-primary-custom ms-3">Masuk</a>
                        <a href="{{ url('/kampus/perusahaan') }}"
                                class="btn-company-outline ms-3 d-none d-lg-block">
                                Kampus/Perusahaan
                              </a>
                    @endif

                @else
                    <a href="{{ url('/daftar') }}" class="btn btn-primary btn-primary-custom">Daftar</a>
                    <a href="{{ url('/masuk') }}" class="btn btn-outline-primary btn-outline-primary-custom ms-3">Masuk</a>
                    <a href="{{ url('/kampus/perusahaan') }}"
                        class="btn-company-outline ms-3 d-none d-lg-block">
                        Kampus/Perusahaan
                       </a>
                @endauth

            </div>
        </div>
    </div>
</nav>

<script>
    // Kode untuk underline navigasi
    const underline = document.getElementById('navUnderline');
    const navLinks = document.querySelectorAll('#navMenu .nav-link');

    function moveUnderline(el) {
        const rect = el.getBoundingClientRect();
        const parentRect = el.parentElement.parentElement.getBoundingClientRect();
        underline.style.width = rect.width + "px";
        underline.style.left = (rect.left - parentRect.left) + "px";
    }

    const activeLink = document.querySelector('#navMenu .nav-link.active');
    if (activeLink) moveUnderline(activeLink);

    navLinks.forEach(link => {
        link.addEventListener('click', function () {
            navLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
            moveUnderline(this);
        });
    });

    window.addEventListener('resize', () => {
        const active = document.querySelector('#navMenu .nav-link.active');
        if (active) moveUnderline(active);
    });

    // Kode untuk user dropdown
    const userDropdownContainer = document.getElementById('userDropdownContainer');
    const chevronIcon = userDropdownContainer ? userDropdownContainer.querySelector('.chevron-icon') : null;

    if (userDropdownContainer && chevronIcon) {
        userDropdownContainer.addEventListener('show.bs.dropdown', () => chevronIcon.classList.add('open'));
        userDropdownContainer.addEventListener('hide.bs.dropdown', () => chevronIcon.classList.remove('open'));
    }

    // Kode untuk notifikasi
class NotificationManager {
    constructor() {
        this.notificationDropdown = document.getElementById('notificationDropdownContainer');
        this.notificationList = document.getElementById('notificationList');
        this.notificationBadge = document.getElementById('notificationBadge');
        this.pollingInterval = null;
        this.isLoading = false;

        this.init();
    }

    init() {
        this.loadNotifications();
        this.startPolling();

        // Event listener untuk menandai notifikasi sebagai dibaca
        this.notificationList.addEventListener('click', (e) => {
            const notificationLink = e.target.closest('.notification-link');
            if (notificationLink) {
                e.preventDefault();
                const notificationId = notificationLink.dataset.id;
                this.markAsRead(notificationId);

                // Redirect ke URL notifikasi setelah menandai sebagai dibaca
                const redirectUrl = notificationLink.href;
                if (redirectUrl && redirectUrl !== '#') {
                    setTimeout(() => {
                        window.location.href = redirectUrl;
                    }, 300);
                }
            }
        });

        // Refresh notifikasi ketika dropdown dibuka
        if (this.notificationDropdown) {
            this.notificationDropdown.addEventListener('show.bs.dropdown', () => {
                this.loadNotifications();
            });
        }
    }

    async loadNotifications() {
        if (this.isLoading) return;

        this.isLoading = true;

        try {
            const response = await fetch('{{ route("notifications.api") }}');
            const data = await response.json();

            if (data.success) {
                this.renderNotifications(data.notifications);
                this.updateBadge(data.unread_count);
            }
        } catch (error) {
            console.error('Error loading notifications:', error);
        } finally {
            this.isLoading = false;
        }
    }

    renderNotifications(notifications) {
        if (!notifications || notifications.length === 0) {
            this.notificationList.innerHTML = `
                <li class="notification-empty">
                    <i class="fas fa-bell-slash"></i>
                    <div>Tidak ada notifikasi</div>
                </li>
            `;
            return;
        }

        const notificationsHtml = notifications.map(notification => `
            <li class="notification-item ${notification.read_at ? '' : 'unread'}"
                data-id="${notification.id}">
                <a class="notification-link"
                   href="${this.getNotificationUrl(notification)}"
                   data-id="${notification.id}">
                    <div class="notification-title">${this.escapeHtml(notification.data.title)}</div>
                    <div class="notification-message">${this.escapeHtml(notification.data.message)}</div>
                    <div class="notification-time">${this.formatTime(notification.created_at)}</div>
                </a>
            </li>
        `).join('');

        this.notificationList.innerHTML = notificationsHtml;
    }

    getNotificationUrl(notification) {
        // Tentukan URL berdasarkan jenis notifikasi
        if (notification.data.url) {
            return notification.data.url;
        }

        // Default URLs berdasarkan jenis notifikasi
        switch (notification.data.type) {
            case 'job_application':
                return '{{ url("/lamaran-saya") }}';
            case 'job_match':
                return '{{ route("jobs.index") }}';
            case 'profile_view':
                return '{{ url("/profil") }}';
            case 'message':
                return '{{ url("/pesan") }}';
            default:
                return '{{ route("notifications.my") }}';
        }
    }

    async markAsRead(notificationId) {
        try {
            const response = await fetch(`/notifications/${notificationId}/mark-as-read`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            if (response.ok) {
                // Update tampilan notifikasi
                const notificationItem = document.querySelector(`.notification-link[data-id="${notificationId}"]`).closest('.notification-item');
                if (notificationItem) {
                    notificationItem.classList.remove('unread');
                }

                // Update badge count
                this.updateBadgeCount(-1);
            }
        } catch (error) {
            console.error('Error marking notification as read:', error);
        }
    }

    updateBadgeCount(change) {
        const currentCount = parseInt(this.notificationBadge.textContent) || 0;
        const newCount = Math.max(0, currentCount + change);

        if (newCount > 0) {
            this.notificationBadge.textContent = newCount > 99 ? '99+' : newCount;
            this.notificationBadge.classList.remove('d-none');
        } else {
            this.notificationBadge.classList.add('d-none');
        }
    }

    updateBadge(unreadCount) {
        if (unreadCount > 0) {
            this.notificationBadge.textContent = unreadCount > 99 ? '99+' : unreadCount;
            this.notificationBadge.classList.remove('d-none');
        } else {
            this.notificationBadge.classList.add('d-none');
        }
    }

    startPolling() {
        // Poll setiap 30 detik untuk update notifikasi
        this.pollingInterval = setInterval(() => {
            this.loadNotifications();
        }, 30000);
    }

    stopPolling() {
        if (this.pollingInterval) {
            clearInterval(this.pollingInterval);
        }
    }

    formatTime(isoString) {
        const date = new Date(isoString);
        const now = new Date();
        const diffInMinutes = Math.floor((now - date) / (1000 * 60));

        if (diffInMinutes < 1) return 'Baru saja';
        if (diffInMinutes < 60) return `${diffInMinutes} menit lalu`;
        if (diffInMinutes < 1440) return `${Math.floor(diffInMinutes / 60)} jam lalu`;
        return `${Math.floor(diffInMinutes / 1440)} hari lalu`;
    }

    escapeHtml(unsafe) {
        return unsafe
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }
}

// Inisialisasi notifikasi manager ketika user sudah login
@auth
    @if (Auth::user()->role === 'user')
        document.addEventListener('DOMContentLoaded', function() {
            new NotificationManager();
        });
    @endif
@endauth
</script>
