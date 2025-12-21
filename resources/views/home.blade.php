@extends('layouts.main')

@section('content')

    {{-- Slider Section dengan Search Box di Tengah --}}
    <section class="slider-section">
    <div class="slider-container">
        <div class="slider-wrapper">
            @php
                use App\Models\Slider;
                // HAPUS query dengan is_active dan order karena kolom tersebut sudah tidak ada
                // $sliders = Slider::where('is_active', true)
                //                 ->orderBy('order', 'asc')
                //                 ->get();

                // GANTI dengan query sederhana: ambil semua slider, urutkan berdasarkan created_at
                $sliders = Slider::orderBy('created_at', 'desc')->get();
                // Atau jika tidak butuh sorting: $sliders = Slider::all();
            @endphp

            @if($sliders->count() > 0)
                {{-- Tampilkan slider dari database --}}
                @foreach($sliders as $index => $slider)
                    <div class="slider-slide {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}">
                        @if($slider->image)
                            <img src="{{ asset('images/sliders/' . $slider->image) }}"
                                alt="Slider Image {{ $index + 1 }}"
                                class="slider-image">
                        @endif
                    </div>
                @endforeach
            @else
                {{-- Jika tidak ada slider di database, tampilkan placeholder --}}
                <div class="slider-slide active">
                    <div class="slider-placeholder">
                        <img src="{{ asset('images/placeholder-slider.jpg') }}"
                            alt="Placeholder Slider"
                            class="slider-image">
                        <div class="placeholder-overlay">
                            <h3>Belum Ada Slider Saat Ini</h3>
                            <p>Admin belum menambahkan gambar slider. Silakan hubungi administrator.</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>

            {{-- Search Box di Tengah Slider --}}
            <div class="slider-search-container">
                <div class="container">
                    <div class="slider-search-box">
                        <form class="row g-2 align-items-end search-box">
                            <div class="col-12 col-md-4">
                                <label class="search-label">Pekerjaan apa?</label>
                                <input type="text" class="form-control" placeholder="Masukkan kata kunci">
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="search-label">&nbsp;</label>
                                <div class="dropdown w-100">
                                    <button class="btn dropdown-toggle w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="dropdownKlasifikasi">
                                        Semua klasifikasi
                                        <i class="bi bi-chevron-down"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-scrollable w-100" aria-labelledby="dropdownKlasifikasi">
                                        <li>
                                            <a class="dropdown-item dropdown-item-custom" href="#">
                                                <div>
                                                    <input type="checkbox" class="form-check-input" id="devOps-infrastructure">
                                                    <label class="form-check-label" for="devOps-infrastructure">DevOps & Infrastructure</label>
                                                </div>
                                                <span class="count">1,248</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item dropdown-item-custom" href="#">
                                                <div>
                                                    <input type="checkbox" class="form-check-input" id="analyst-consultant">
                                                    <label class="form-check-label" for="analyst-consultant">Analyst & Consultant</label>
                                                </div>
                                                <span class="count">5,677</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item dropdown-item-custom" href="#">
                                                <div>
                                                    <input type="checkbox" class="form-check-input" id="project-management">
                                                    <label class="form-check-label" for="project-management">Project Management</label>
                                                </div>
                                                <span class="count">1,914</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item dropdown-item-custom" href="#">
                                                <div>
                                                    <input type="checkbox" class="form-check-input" id="ui/ux-design">
                                                    <label class="form-check-label" for="ui/ux-design">UI/UX Design</label>
                                                </div>
                                                <span class="count">3,593</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item dropdown-item-custom" href="#">
                                                <div>
                                                    <input type="checkbox" class="form-check-input" id="database-management">
                                                    <label class="form-check-label" for="database-management">Database Management</label>
                                                </div>
                                                <span class="count">86</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item dropdown-item-custom" href="#">
                                                <div>
                                                    <input type="checkbox" class="form-check-input" id="frontend-developer">
                                                    <label class="form-check-label" for="frontend-developer">Frontend Developer</label>
                                                </div>
                                                    <span class="count">451</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item dropdown-item-custom" href="#">
                                                <div>
                                                    <input type="checkbox" class="form-check-input" id="mobile-developer">
                                                    <label class="form-check-label" for="mobile-developer">Mobile Developer</label>
                                                </div>
                                                <span class="count">6,823</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item dropdown-item-custom" href="#">
                                                <div>
                                                    <input type="checkbox" class="form-check-input" id="backend-developer">
                                                    <label class="form-check-label" for="backend-developer">Backend Developer</label>
                                                </div>
                                                <span class="count">5,326</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item dropdown-item-custom" href="#">
                                                <div>
                                                    <input type="checkbox" class="form-check-input" id="cybersecurity">
                                                    <label class="form-check-label" for="cybersecurity">Cybersecurity</label>
                                                </div>
                                                <span class="count">1,738</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="search-label">Di mana?</label>
                                <input type="text" class="form-control" placeholder="Masukkan kota atau wilayah">
                            </div>
                            <div class="col-12 col-md-2 d-grid">
                                <button type="submit" class="btn btn-pink">Cari</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Navigation Buttons --}}
            <button class="slider-nav prev">
                <i class="bi bi-chevron-left"></i>
            </button>
            <button class="slider-nav next">
                <i class="bi bi-chevron-right"></i>
            </button>

            {{-- Pagination Dots --}}
            @if($sliders->count() > 0)
                <div class="slider-pagination">
                    @foreach($sliders as $index => $slider)
                        <span class="slider-dot {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}"></span>
                    @endforeach
                </div>
            @else
                {{-- Jika tidak ada slider, tetap tampilkan 1 dot untuk placeholder --}}
                <div class="slider-pagination">
                    <span class="slider-dot active" data-slide="0"></span>
                </div>
            @endif
        </div>
    </section>

    <section class="hero-section text-center text-md-start">
        <div class="hero-background-image"></div>
        <div class="hero-content">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-7 mb-4 mb-md-0">
                        <h1 class="display-6 mb-3 hero-title">Temukan kesempatan karir yang Anda impikan</h1>
                        <p class="lead mb-4 hero-text">
                            Lebih dari 100+ posisi pekerjaan terverifikasi tersedia di perusahaan kami.
                            <br class="d-none d-md-block">
                            Bergabunglah bersama tim profesional kami dan raih karir Anda ke level selanjutnya.
                        </p>
                    </div>
                    <div class="col-md-5 d-none d-md-block"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <h2 class="fs-4 mb-4 fw-bold category-heading">Kategori pekerjaan</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="card h-100 category-card">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <h5 class="card-title mb-0">DevOps & Infrastructure</h5>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 category-card">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <h5 class="card-title mb-0">Analyst & Consultant</h5>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 category-card">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <h5 class="card-title mb-0">Project Management</h5>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 category-card">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <h5 class="card-title mb-0">UI/UX Design</h5>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 category-card">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <h5 class="card-title mb-0">Database Management</h5>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 category-card">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <h5 class="card-title mb-0">Frontend Developer</h5>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 category-card">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <h5 class="card-title mb-0">Mobile Developer</h5>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 category-card">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <h5 class="card-title mb-0">Backend Developer</h5>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 category-card">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <h5 class="card-title mb-0">Cybersecurity</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <h2 class="fs-4 fw-bold mb-4 text-dark-gray">Dibutuhkan segera</h2>
                    <div class="d-flex flex-wrap">
                        <a href="#" class="dibutuhkan-segera-tag">DevOps Engineer</a>
                        <a href="#" class="dibutuhkan-segera-tag">Data Analyst</a>
                        <a href="#" class="dibutuhkan-segera-tag">Project Manager</a>
                        <a href="#" class="dibutuhkan-segera-tag">UI Designer</a>
                        <a href="#" class="dibutuhkan-segera-tag">Database Administrator</a>
                        <a href="#" class="dibutuhkan-segera-tag">Frontend Developer</a>
                        <a href="#" class="dibutuhkan-segera-tag">Mobile Developer</a>
                        <a href="#" class="dibutuhkan-segera-tag">Backend Developer</a>
                        <a href="#" class="dibutuhkan-segera-tag">Security Architect</a>
                        <a href="#" class="dibutuhkan-segera-tag">Cloud Engineer</a>
                        <a href="#" class="dibutuhkan-segera-tag">IT Consultant</a>
                        <a href="#" class="dibutuhkan-segera-tag">Product Manager</a>
                        <a href="#" class="dibutuhkan-segera-tag">iOS Developer</a>
                    </div>
                </div>

                   <div class="col-md-7 trusted-companies">
                <h2 class="fs-4 fw-bold mb-4 text-dark-gray">Perusahaan terpercaya, merekrut</h2>

                    @php
                        // Ambil 8 perusahaan aktif pertama dari database
                        $trustedCompanies = App\Models\Company::aktif()->take(8)->get();
                    @endphp

                    {{-- Jika tidak ada perusahaan, tampilkan pesan saja --}}
                    @if($trustedCompanies->count() === 0)
                        <p class="text-muted">Belum ada perusahaan yang terdaftar</p>
                    @else
                        <div class="logo-container">
                            @foreach($trustedCompanies as $company)
                                <div class="logo-wrapper">
                                    <div class="logo-card">
                                        <a href="{{ route('company.detail', $company->slug) }}" class="company-link">
                                            @if($company->logo)
                                                <img src="{{ asset('storage/' . $company->logo) }}"
                                                    alt="{{ $company->nama_perusahaan }}"
                                                    class="logo"
                                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                                <div class="default-logo" style="display: none;">
                                                    {{ substr($company->nama_perusahaan, 0, 2) }}
                                                </div>
                                            @else
                                                <div class="default-logo">
                                                    {{ substr($company->nama_perusahaan, 0, 2) }}
                                                </div>
                                            @endif
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Link lihat lainnya hanya muncul bila perusahaan ada --}}
                        <div class="text-start mt-3">
                            <a href="explore-organisasi" class="text-decoration-none see-more-offset">Lihat Lainnya.....</a>
                        </div>
                    @endif
                </div>

    </section>

    {{-- Ganti seluruh section testimoni dari baris 209-259 dengan kode berikut --}}

    <section class="py-5 text-center glints-section">
    <div class="container">
        <h2 class="fw-bold mb-2">4 juta talenta dapat kerja via Talenthub</h2>
        <p class="mb-5">Pelajari tips cari kerja di Talenthub dari mereka. Kalau mereka bisa, maka kamu juga!</p>

        @php
            // Ambil testimoni aktif dari database (tanpa urutan)
            $testimonis = App\Models\Testimoni::aktif()
                ->orderBy('created_at', 'desc') // Urut berdasarkan tanggal dibuat (terbaru dulu)
                ->limit(3) // Ambil maksimal 3 testimoni
                ->get();
        @endphp

        @if($testimonis->count() > 0)
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach($testimonis as $testimoni)
                <div class="col">
                    <div class="testimonial-card">
                        <img src="{{ asset('images/foto2.png') }}" alt="Windya A." class="img-fluid">
                        <blockquote class="mb-0">
                            "Talenthub jadi platform cari kerja yang paling mudah & cepat buatku. Aku berhasil career switch ke bidang yang jadi passion-ku dan dapat kerja cuma dalam 4 hari."
                        </blockquote>
                        <div class="mt-3">
                            <div class="testimonial-author">ilham sadewo, 24 tahun</div>
                            <div class="testimonial-role">pemula</div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="testimonial-card">
                        <img src="{{ asset('images/foto1.png') }}" alt="Dimas B Wicaksono" class="img-fluid">
                        <blockquote class="mb-0">
                            "Lewat Talenthub, aku bisa dapat pekerjaan yang bikin aku puas dan orang tua bangga. Prosesnya cepat, cuma 4 hari aku langsung dihubungi rekruter."
                        </blockquote>
                        <div class="mt-3">
                            <div class="testimonial-author">rimba sadewo, 26 tahun</div>
                            <div class="testimonial-role">full stack developer</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            {{-- Tampilkan pesan sederhana tanpa styling khusus --}}
            <div class="my-5">
                <p class="mb-0" style="color: #000; font-size: 16px;">
                    belum ada data testimoni saat ini
                </p>
            </div>
        @endif
    </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-5 faq-section">
    <div class="container">
        <h2 class="text-center fw-bold mb-5 faq-title">Pertanyaan yang Sering Diajukan</h2>

        <div class="faq-container">
            <div class="accordion" id="faqAccordion">

                <?php
                // Mengambil data FAQ aktif langsung dari database
                $faqs = \App\Models\Faq::where('is_active', true)->latest()->get();
                ?>

                @foreach($faqs as $index => $faq)
                <div class="accordion-item mb-3 border rounded">
                    <h2 class="accordion-header" id="heading{{ $index + 1 }}">
                        <button class="accordion-button collapsed fw-semibold" type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $index + 1 }}"
                                aria-expanded="false"
                                aria-controls="collapse{{ $index + 1 }}">
                            {{ $faq->question }}
                        </button>
                    </h2>
                    <div id="collapse{{ $index + 1 }}"
                         class="accordion-collapse collapse"
                         aria-labelledby="heading{{ $index + 1 }}"
                         data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            {!! nl2br(e($faq->answer)) !!}
                        </div>
                    </div>
                </div>
                @endforeach

                @if($faqs->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-question-circle fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Belum ada FAQ yang tersedia.</p>
                </div>
                @endif

            </div>
        </div>
    </div>
    </section>

    <section class="py-5 text-center stats-section">
        <div class="container">
            <h2 class="fs-4 fw-normal stats-title mb-2">Statistik Website Kami</h2>
            <p class="stats-text mb-5">Berikut adalah data keberhasilan kami dalam merekrut talenta terbaik</p>
            <div class="row">
                <div class="col-6 col-md-3 mb-4">
                    <h3 class="stats-number text-green">50</h3>
                    <p class="stats-text fw-semibold">Pelamar</p>
                </div>
                <div class="col-6 col-md-3 mb-4">
                    <h3 class="stats-number text-green">10</h3>
                    <p class="stats-text fw-semibold">Lowongan Terbuka</p>
                </div>
                <div class="col-6 col-md-3 mb-4">
                    <h3 class="stats-number text-green">30</h3>
                    <p class="stats-text fw-semibold">Posisi Terpenuhi</p>
                </div>
                <div class="col-6 col-md-3 mb-4">
                    <h3 class="stats-number text-green">75</h3>
                    <p class="stats-text fw-semibold">Karyawan</p>
                </div>
            </div>
        </div>
    </section>

     <!-- INTEGRASI WHATSAPP YANG BERFUNGSI -->
    <div class="whatsapp-float">
        <a href="https://wa.me/6282115179879?text=Halo%2C%20saat%20ini%20saya%20sedang%20mengakses%20website%20Inotal%20dan%20saya%20butuh%20bantuan"
        target="_blank"
        rel="noopener noreferrer"
        class="whatsapp-link">
            <img src="{{ asset('images/whatsapp.png') }}" alt="Chat via WhatsApp" class="whatsapp-logo">
        </a>
    </div>

        {{-- Slider JavaScript --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('.slider-slide');
            const dots = document.querySelectorAll('.slider-dot');
            const prevBtn = document.querySelector('.slider-nav.prev');
            const nextBtn = document.querySelector('.slider-nav.next');
            let currentSlide = 0;
            let slideInterval;
            const slideDuration = 5000; // 5 seconds

            // Cek apakah ada slide
            if (slides.length === 0) return;

            // Fungsi untuk mengubah slide
            function showSlide(index) {
                // Sembunyikan semua slide
                slides.forEach(slide => {
                    slide.classList.remove('active');
                });

                // Hapus class active dari semua dots
                dots.forEach(dot => {
                    dot.classList.remove('active');
                });

                // Tampilkan slide yang dipilih
                currentSlide = index;
                if (currentSlide >= slides.length) currentSlide = 0;
                if (currentSlide < 0) currentSlide = slides.length - 1;

                slides[currentSlide].classList.add('active');
                if (dots[currentSlide]) {
                    dots[currentSlide].classList.add('active');
                }
            }

            // Fungsi untuk slide berikutnya
            function nextSlide() {
                showSlide(currentSlide + 1);
            }

            // Fungsi untuk slide sebelumnya
            function prevSlide() {
                showSlide(currentSlide - 1);
            }

            // Event listener untuk tombol navigasi
            if (nextBtn) {
                nextBtn.addEventListener('click', function() {
                    nextSlide();
                    resetInterval();
                });
            }

            if (prevBtn) {
                prevBtn.addEventListener('click', function() {
                    prevSlide();
                    resetInterval();
                });
            }

            // Event listener untuk pagination dots
            dots.forEach((dot, index) => {
                dot.addEventListener('click', function() {
                    showSlide(index);
                    resetInterval();
                });
            });

            // Fungsi untuk mereset interval otomatis
            function resetInterval() {
                clearInterval(slideInterval);
                slideInterval = setInterval(nextSlide, slideDuration);
            }

            // Mulai slider otomatis
            function startSlider() {
                slideInterval = setInterval(nextSlide, slideDuration);
            }

            // Pause slider saat hover
            const sliderContainer = document.querySelector('.slider-container');
            if (sliderContainer) {
                sliderContainer.addEventListener('mouseenter', function() {
                    clearInterval(slideInterval);
                });

                sliderContainer.addEventListener('mouseleave', function() {
                    startSlider();
                });
            }

            // Inisialisasi slider
            startSlider();

            // Keyboard navigation
            document.addEventListener('keydown', function(e) {
                if (e.key === 'ArrowLeft') {
                    prevSlide();
                    resetInterval();
                } else if (e.key === 'ArrowRight') {
                    nextSlide();
                    resetInterval();
                }
            });
        });
    </script>

@endsection
