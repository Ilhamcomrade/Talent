<style>
    /* Footer */
    .footer-bg {
        background: linear-gradient(rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.9)), url("{{ asset('images/gedung.png') }}");
        background-size: cover;
        background-position: center;
        position: relative;
        color: #fff;
    }
    .footer-logo {
        height: 120px;
        width: auto;
        display: block;
        cursor: pointer;
    }
    .footer-link {
        color: #fff;
        text-decoration: none;
    }
    .footer-link:hover { color: #28a745; }
    .alamat-icon-wrapper {
        display: flex;
        align-items: flex-start;
        margin-bottom: 0.5rem;
    }
    .alamat-text {
        flex-grow: 1;
        margin-left: 0.5rem;
    }
    .text-red-custom { color: #e11c25; }
</style>

<footer class="py-5 footer-bg text-white">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="mb-3">
                    <a href="{{ route('home') }}">
                        @if($profile->logo_footer && Storage::disk('public')->exists($profile->logo_footer))
                            <img src="{{ asset('storage/' . $profile->logo_footer) }}" alt="INOTAL SISTEMA INTERNASIONAL" class="footer-logo">
                        @else
                            <img src="{{ asset('images/inotal.png') }}" alt="INOTAL SISTEMA INTERNASIONAL" class="footer-logo">
                        @endif
                    </a>
                </div>

                <p class="mb-1">PT INOTAL SISTEMA INTERNASIONAL</p>
                <p>Langkah Mudah Menuju Masa Depan Karier</p>
            </div>
<div class="col-md-4 mb-4 mb-md-0">
                <h5 class="fw-bold mb-3 text-red-custom">Navigasi</h5>
                <ul class="list-unstyled">
                    <li><a href="/jobs" class="footer-link">Lowongan Kerja</a></li>
                    <li><a href="/sumber-daya-karir" class="footer-link">Sumber Daya Karir</a></li>
                    <li><a href="/explore-organisasi" class="footer-link">Explore Organisasi</a></li>
                    <li><a href="/magang" class="footer-link">Open Intership</a></li>
                    <li><a href="/tentang-kami" class="footer-link">Tentang kami</a></li>

                    <li><a href="/kontak" class="footer-link">Kontak</a></li>

                </ul>
            </div>
            <div class="col-md-4">
                <h5 class="fw-bold mb-3 text-red-custom">Alamat</h5>
                <ul class="list-unstyled">
                    <li>
                        <p class="alamat-icon-wrapper">
                            <i class="bi bi-geo-alt-fill me-2 text-red-custom"></i>
                            <span class="alamat-text">
                                Jl. Pratista Utara III No.2,<br>
                                Antapani Kidul,<br>
                                Kec. Antapani, Kota Bandung,<br>
                                Jawa Barat, Indonesia 4029
                            </span>
                        </p>
                    </li>
                    <li>
                        <p class="mb-1 d-flex align-items-start">
                            <i class="bi bi-telephone-fill me-2 text-red-custom"></i>
                            <span>+(62) 82115179879</span>
                        </p>
                    </li>
                    <li>
                        <p class="mb-1 d-flex align-items-start">
                            <i class="bi bi-envelope-fill me-2 text-red-custom"></i>
                            <span>corporate@inotal.tech</span>
                        </p>
                    </li>
                </ul>
            </div>
        </div>
        <hr class="my-4" style="border-color: #6c757d;">
        <div class="text-center">Copyright ©2025 INOTAL SISTEMA INTERNASIONAL</div>
    </div>
</footer>
