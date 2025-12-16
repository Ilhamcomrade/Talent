<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar | Next Jobz</title>
  <link rel="icon" type="image/png" href="{{ asset('123.png') }}">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

  <style>
    /* Body & Container */
    body {
      background-color: #f8f9fa;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    /* === Judul diangkat sedikit ke atas === */
    .title-glints {
      font-size: 28px;
      font-weight: 700;
      text-align: center;
      margin: 25px auto 15px; /* sebelumnya 35px -> dikurangi agar naik lebih dekat ke navbar */
    }

    .title-glints span {
      color: #00b14f;
    }

    /* Card pendaftaran */
    .registration-box {
      max-width: 700px;
      margin: 0 auto 40px;
      background: #fff;
      border-radius: 6px;
      padding: 30px 40px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      min-height: calc(100vh - 200px);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    /* Input style */
    .form-control,
    .input-group-text {
      height: 45px;
      font-size: 14px;
      border: 1px solid #999;
      border-radius: 2px;
      box-shadow: none;
    }

    .form-control:focus {
      border-color: #333;
      box-shadow: none;
    }

    .row .col {
      margin-bottom: 15px;
    }

    /* Password container */
    .password-container {
      position: relative;
    }

    .password-container .password-toggle {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #6c757d;
    }

    /* Lokasi Dropdown */
    .dropdown-location {
      position: relative;
    }

    .dropdown-location .caret-icon {
      position: absolute;
      right: 24px;
      top: 50%;
      transform: translateY(-50%);
      font-size: 16px;
      color: #555;
      cursor: pointer;
      pointer-events: auto;
      transition: transform 0.3s ease;
    }

    .dropdown-location .caret-icon.open {
      transform: translateY(-50%) rotate(180deg);
    }

    .dropdown-list {
      position: absolute;
      top: 100%;
      left: 0.75rem;
      right: 0.75rem;
      background: #fff;
      border: 1px solid #ccc;
      border-top: none;
      z-index: 1000;
      max-height: 180px;
      overflow-y: auto;
      display: none;
    }

    .dropdown-list div {
      padding: 8px 12px;
      cursor: pointer;
    }

    .dropdown-list div:hover {
      background-color: #e3f2fd;
      color: #0d47a1;
      font-weight: 600;
    }

    /* Input WhatsApp */
    .input-group .form-control {
      border: 1px solid #999 !important;
      border-radius: 2px !important;
    }

    /* Button */
    .btn-daftar {
      background-color: #e60000;
      color: #fff;
      font-weight: 600;
      height: 45px;
      border: none;
      font-size: 15px;
      width: 180px;
      margin: 15px auto 12px; /* margin bawah dikurangi dari 18px jadi 12px */
      display: block;
    }

    .btn-daftar:hover {
      background-color: #c70000;
    }

    /* Footer text - jarak diperkecil lagi */
    .company-link,
    .terms,
    .footer-line {
      text-align: center;
      margin-top: 5px; /* dikurangi dari 8px jadi 5px untuk jarak lebih dekat lagi */
      font-size: 15px;
      line-height: 1.4;
    }

    .terms a {
      text-decoration: none;
      font-weight: 500;
      color: #000;
    }

    .footer-line a {
      font-weight: 600;
      color: #0d47a1;
      text-decoration: none;
    }

    .footer-line a:hover {
      text-decoration: underline;
    }

    .text-danger-custom {
      color: #e60000;
      font-size: 13px;
      margin-top: 3px;
    }
  </style>
</head>

<body>
  {{-- Navbar --}}
  @include('partials.navbar')

  {{-- Judul --}}
  <h2 class="title-glints">Mari buat profil Talenthub kamu</h2>

  {{-- Konten --}}
  <div class="registration-box">
    <form action="{{ route('register.process') }}" method="POST">
      @csrf

      @if (session('error'))
      <div class="alert alert-danger" role="alert">
        {{ session('error') }}
      </div>
      @endif

      <div class="row">
        <div class="col">
          <input type="text" class="form-control @error('nama_depan') is-invalid @enderror" name="nama_depan"
            placeholder="Nama depan" value="{{ old('nama_depan') }}" required>
          @error('nama_depan')
          <div class="text-danger-custom">{{ $message }}</div>
          @enderror
        </div>
        <div class="col">
          <input type="text" class="form-control @error('nama_belakang') is-invalid @enderror" name="nama_belakang"
            placeholder="Nama Belakang" value="{{ old('nama_belakang') }}" required>
          @error('nama_belakang')
          <div class="text-danger-custom">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <div class="row">
        <div class="col">
          <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
            placeholder="Email" value="{{ old('email') }}" required>
          @error('email')
          <div class="text-danger-custom">{{ $message }}</div>
          @enderror
        </div>
        <div class="col">
          <div class="password-container">
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="passwordInput"
              name="password" placeholder="Buat kata sandi" required>
            <i class="fa-regular fa-eye password-toggle"></i>
            @error('password')
            <div class="text-danger-custom">{{ $message }}</div>
            @enderror
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col dropdown-location">
          <input type="text" class="form-control @error('lokasi') is-invalid @enderror" id="locationInput" name="lokasi"
            placeholder="Masukkan lokasimu (Kota & Negara)" value="{{ old('lokasi') }}" autocomplete="off" required>
          <i class="bi bi-chevron-down caret-icon" id="locationCaret"></i>
          <div class="dropdown-list" id="locationDropdown"></div>
          @error('lokasi')
          <div class="text-danger-custom">{{ $message }}</div>
          @enderror
        </div>

        <div class="col">
          <div class="input-group">
            <input type="tel" class="form-control @error('whatsapp') is-invalid @enderror" id="whatsappInput"
              name="whatsapp" placeholder="Nomor WhatsApp" value="{{ old('whatsapp') }}" pattern="[0-9]*" required>
          </div>
          @error('whatsapp')
          <div class="text-danger-custom">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <div class="text-center">
        <button type="submit" class="btn btn-daftar">DAFTAR</button>
      </div>
    </form>

    <p class="company-link">Untuk perusahaan, kunjungi <a href="/company">halaman ini</a></p>
    <p class="terms">Dengan mendaftar, saya setuju dengan <a href="#">Ketentuan Layanan</a></p>

    <div class="footer-line">
      <span>Sudah punya akun Talenthub ?</span>
      <a href="{{ url('/masuk') }}"> Masuk</a>
    </div>
  </div>

  <script>
    const locations = [
      "Jakarta Pusat, DKI Jakarta", "Jakarta Selatan, DKI Jakarta", "Jakarta Barat, DKI Jakarta", "Jakarta Utara, DKI Jakarta",
      "Jakarta Timur, DKI Jakarta", "Bandung, Jawa Barat", "Bogor, Jawa Barat", "Depok, Jawa Barat", "Bekasi, Jawa Barat",
      "Tangerang, Banten", "Serang, Banten", "Yogyakarta, DI Yogyakarta", "Surabaya, Jawa Timur", "Malang, Jawa Timur",
      "Sidoarjo, Jawa Timur", "Semarang, Jawa Tengah", "Solo, Jawa Tengah", "Medan, Sumatera Utara", "Padang, Sumatera Barat",
      "Denpasar, Bali"
    ];

    const input = document.getElementById("locationInput");
    const dropdown = document.getElementById("locationDropdown");
    const caret = document.getElementById("locationCaret");

    input.addEventListener("input", function () {
      const value = this.value.toLowerCase();
      dropdown.innerHTML = "";
      if (value) {
        const filtered = locations.filter(loc => loc.toLowerCase().includes(value));
        filtered.forEach(loc => {
          const div = document.createElement("div");
          div.textContent = loc;
          div.addEventListener("click", function () {
            input.value = loc;
            dropdown.style.display = "none";
            caret.classList.remove('open');
          });
          dropdown.appendChild(div);
        });
        dropdown.style.display = filtered.length > 0 ? "block" : "none";
        caret.classList.toggle('open', filtered.length > 0);
      } else {
        dropdown.style.display = "none";
        caret.classList.remove('open');
      }
    });

    caret.addEventListener("click", function () {
      if (dropdown.style.display === "block") {
        dropdown.style.display = "none";
        caret.classList.remove('open');
      } else {
        dropdown.innerHTML = "";
        locations.forEach(loc => {
          const div = document.createElement("div");
          div.textContent = loc;
          div.addEventListener("click", function () {
            input.value = loc;
            dropdown.style.display = "none";
            caret.classList.remove('open');
          });
          dropdown.appendChild(div);
        });
        dropdown.style.display = "block";
        caret.classList.add('open');
      }
    });

    document.addEventListener("click", function (e) {
      if (!e.target.closest(".dropdown-location")) {
        dropdown.style.display = "none";
        caret.classList.remove('open');
      }
    });

    const whatsappInput = document.getElementById("whatsappInput");
    whatsappInput.addEventListener('input', function () {
      this.value = this.value.replace(/[^0-9]/g, '');
    });

    const passwordInput = document.getElementById("passwordInput");
    const passwordToggle = document.querySelector(".password-toggle");

    passwordToggle.addEventListener("click", function () {
      const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
      passwordInput.setAttribute("type", type);
      this.classList.toggle("fa-eye");
      this.classList.toggle("fa-eye-slash");
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
