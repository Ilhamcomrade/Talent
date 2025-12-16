<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pasang Iklan Intership Gratis | Talenthub</title>

    <link rel="icon" type="image/png" href="{{ asset('1.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"/>

    <style>
        body {
            background-color: #f7f9fb;
            font-family: Arial, sans-serif;
        }

        /* NAVBAR */
        .navbar {
            font-size: 1rem; 
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            background: #fff;
            border-bottom: 1px solid #dee2e6;
            padding: 0.5rem 1rem;
        }
        .navbar-logo {
            height: 38px;
            width: auto;
        }
        .btn-login {
            border-radius: 6px;
            padding: 0.35rem 1rem;
            font-weight: 600;
            font-size: 0.95rem;
            color: #0d47a1 !important;
            background-color: #fff;
            border: 2px solid #0d47a1;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            background-color: #0d47a1;
            color: #fff !important;
            border: 2px solid #0d47a1;
        }

        /* === PROGRESS STEP === */
        .progress-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        .progress-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            flex: 1;
            text-align: center;
        }

        .progress-step:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 18px;
            right: -50%;
            width: 100%;
            height: 4px;
            background-color: #28a745; /* 🔥 Semua garis jadi hijau */
            z-index: 0;
            transition: background-color 0.3s ease;
        }

        .circle {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background-color: #28a745; /* 🔥 Semua lingkaran jadi hijau */
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            z-index: 1;
            position: relative;
        }

        .progress-label {
            margin-top: 8px;
            font-size: 0.9rem;
            color: #28a745; /* 🔥 Semua label jadi hijau */
            font-weight: 600;
        }

        /* FORM STYLING */
        .campus-profile-card {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 0;
            max-width: 600px;
            margin: 2rem auto;
            overflow: hidden;
        }
        
        .card-header {
            padding: 1.5rem 2rem 1rem 2rem;
            border-bottom: 1px solid #eee;
        }
        
        .card-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 0;
            color: #333;
        }
        
        .card-body {
            padding: 1.5rem 2rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            display: none; /* Sembunyikan label */
        }
        
        .required-star {
            color: #e53935;
        }
        
        .form-control {
            border-radius: 2px;
            border: 1px solid #999;
            padding: 0.75rem;
            font-size: 0.95rem;
            transition: border-color 0.2s;
        }
        
        .form-control:focus {
            border-color: #333;
            box-shadow: none;
        }

        .custom-select-wrapper {
            position: relative;
        }
        
        .custom-select {
            border-radius: 2px;
            border: 1px solid #999;
            padding: 0.75rem;
            font-size: 0.95rem;
            width: 100%;
            background-color: white;
            appearance: none;
            cursor: pointer;
        }
        
        .custom-select:focus {
            border-color: #333;
            box-shadow: none;
            outline: none;
        }

        .custom-arrow {
            position: absolute;
            top: 50%;
            right: 12px;
            transform: translateY(-50%);
            pointer-events: none;
            transition: transform 0.3s ease-in-out;
        }

        .custom-arrow i {
            color: #666;
            font-size: 0.9rem;
            transition: transform 0.3s ease-in-out;
        }

        .custom-select-wrapper.open .custom-arrow i {
            transform: rotate(180deg);
        }
        
        .btn-primary {
            background-color: #00b14f;
            border-color: #00b14f;
            border-radius: 6px;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            font-size: 0.95rem;
            width: auto;
            float: right;
            margin-top: 0;
        }
        
        .btn-primary:hover {
            background-color: #009944;
            border-color: #009944;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            border-radius: 6px;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            font-size: 0.95rem;
            width: auto;
            margin-top: 0;
        }
        
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
        
        .form-footer::after {
            content: "";
            display: table;
            clear: both;
        }

        .placeholder-option {
            color: #999;
        }

        /* Styling untuk form lokasi */
        .location-row {
            display: flex;
            gap: 1rem;
        }
        
        .location-col {
            flex: 1;
        }
        
        .full-width {
            width: 100%;
        }
        
        .char-counter {
            text-align: right;
            font-size: 0.8rem;
            color: #666;
            margin-top: 0.25rem;
        }

        /* Placeholder styling untuk select */
        .custom-select option:first-child {
            color: #999;
        }

        .alert {
            margin-bottom: 1rem;
        }

        /* Error styling */
        .is-invalid {
            border-color: #dc3545 !important;
        }

        .invalid-feedback {
            display: block;
            width: 100%;
            margin-top: 0.25rem;
            font-size: 0.875em;
            color: #dc3545;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="container-fluid d-flex justify-content-between align-items-center mx-lg-5">
            <a href="/" class="navbar-brand d-flex align-items-center py-2">
                <img src="{{ asset('images/logo_inotal.png') }}" alt="Talenthub Logo" class="navbar-logo">
            </a>
            <a href="{{ route('campus.register.cancel') }}" class="btn-login" onclick="return confirm('Batalkan pendaftaran? Data yang sudah diisi akan hilang.')">
                Keluar
            </a>
        </div>
    </nav>

    <!-- === PROGRESS BAR === -->
    <div class="container progress-container">
        <div class="progress-step active">
            <div class="circle">1</div>
            <div class="progress-label">Data Diri</div>
        </div>
        <div class="progress-step active">
            <div class="circle">2</div>
            <div class="progress-label">Data Kampus/Sekolah</div>
        </div>
        <div class="progress-step active">
            <div class="circle">3</div>
            <div class="progress-label">Lokasi Kampus/Sekolah</div>
        </div>
    </div>

    <!-- Form Lokasi Kampus -->
    <div class="container my-5">
        <div class="campus-profile-card">
            <div class="card-header">
                <h1 class="card-title">Lokasi Kampus/Sekolah</h1>
            </div>
            
            <div class="card-body">

                <form id="locationForm" action="{{ route('campus.register.step3') }}" method="POST">
                    @csrf
                    <!-- Form Lokasi Kampus -->
                    <div class="location-row">
                        <div class="location-col">
                            <div class="form-group">
                                <div class="custom-select-wrapper" id="provinsiWrapper">
                                    <select class="custom-select @error('provinsi') is-invalid @enderror" id="provinsi" name="provinsi" required>
                                        <option value="" selected disabled class="placeholder-option">Pilih Provinsi</option>
                                        <!-- Opsi provinsi akan diisi oleh JavaScript -->
                                    </select>
                                    <div class="custom-arrow">
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                </div>
                                @error('provinsi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="location-col">
                            <div class="form-group">
                                <div class="custom-select-wrapper" id="kotaWrapper">
                                    <select class="custom-select @error('kota') is-invalid @enderror" id="kota" name="kota" required disabled>
                                        <option value="" selected disabled class="placeholder-option">Pilih Kota</option>
                                        <!-- Opsi kota akan diisi oleh JavaScript -->
                                    </select>
                                    <div class="custom-arrow">
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                </div>
                                @error('kota')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Baris baru untuk Kecamatan dan Desa/Kelurahan -->
                    <div class="location-row">
                        <div class="location-col">
                            <div class="form-group">
                                <div class="custom-select-wrapper" id="kecamatanWrapper">
                                    <select class="custom-select @error('kecamatan') is-invalid @enderror" id="kecamatan" name="kecamatan" required disabled>
                                        <option value="" selected disabled class="placeholder-option">Pilih Kecamatan</option>
                                        <!-- Opsi kecamatan akan diisi oleh JavaScript -->
                                    </select>
                                    <div class="custom-arrow">
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                </div>
                                @error('kecamatan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="location-col">
                            <div class="form-group">
                                <div class="custom-select-wrapper" id="desaKelurahanWrapper">
                                    <select class="custom-select @error('desa_kelurahan') is-invalid @enderror" id="desa_kelurahan" name="desa_kelurahan" required disabled>
                                        <option value="" selected disabled class="placeholder-option">Pilih Desa/Kelurahan</option>
                                        <!-- Opsi desa/kelurahan akan diisi oleh JavaScript -->
                                    </select>
                                    <div class="custom-arrow">
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                </div>
                                @error('desa_kelurahan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <textarea class="form-control @error('alamat_lengkap') is-invalid @enderror" id="alamatLengkap" name="alamat_lengkap" placeholder="Alamat lengkap (gedung & lantai, jalan, dst.)*" rows="3" maxlength="255" required>{{ old('alamat_lengkap') }}</textarea>
                        <div class="char-counter">
                            <span id="charCount">0</span> / 255
                        </div>
                        @error('alamat_lengkap')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="form-footer">

                        <a href="{{ route('campus.register.process') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Sebelumnya
                        </a>

                        <button type="submit" class="btn btn-primary" id="submitButton">
                            Buat Kampus/Sekolah
                        </button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Cache untuk data API
            const cache = {
                kabupaten: {},
                kecamatan: {},
                desa: {}
            };

            // Data hardcoded sebagai fallback
            const kotaKecamatan = {
                // Jawa Barat
                "Bandung": ["Bandung Kulon", "Bandung Wetan", "Buahbatu", "Cibeunying Kidul", "Cibeunying Kaler"],
                "Bekasi": ["Bekasi Barat", "Bekasi Selatan", "Bekasi Timur", "Bekasi Utara", "Medan Satria"],
                "Bogor": ["Bogor Barat", "Bogor Selatan", "Bogor Tengah", "Bogor Timur", "Bogor Utara"],
                "Depok": ["Beji", "Cimanggis", "Limo", "Pancoran Mas", "Sawangan"],
                "Cimahi": ["Cimahi Selatan", "Cimahi Tengah", "Cimahi Utara", "Cimahi Barat", "Cimahi Timur"],
                
                // Jawa Tengah
                "Semarang": ["Banyumanik", "Candisari", "Gajah Mungkur", "Gayamsari", "Genuk"],
                "Surakarta": ["Banjarsari", "Jebres", "Laweyan", "Pasar Kliwon", "Serengan"],
                "Tegal": ["Margadana", "Tegal Barat", "Tegal Selatan", "Tegal Timur", "Tegal Utara"],
                "Pekalongan": ["Pekalongan Barat", "Pekalongan Selatan", "Pekalongan Timur", "Pekalongan Utara", "Pekalongan Tengah"],
                "Salatiga": ["Argomulyo", "Sidomukti", "Sidorejo", "Tingkir", "Salatiga Selatan"],
                
                // Jawa Timur
                "Surabaya": ["Asemrowo", "Benowo", "Bubutan", "Bulak", "Dukuh Pakis"],
                "Malang": ["Blimbing", "Kedungkandang", "Klojen", "Lowokwaru", "Sukun"],
                "Kediri": ["Kediri Kota", "Mojoroto", "Pesantren", "Kediri Selatan", "Kediri Utara"],
                "Madiun": ["Kartoharjo", "Manguharjo", "Taman", "Madiun Lor", "Madiun Kidul"],
                "Blitar": ["Kepanjenkidul", "Sananwetan", "Sukorejo", "Blitar Selatan", "Blitar Utara"],
                
                // DKI Jakarta
                "Jakarta Pusat": ["Cempaka Putih", "Gambir", "Johar Baru", "Kemayoran", "Menteng"],
                "Jakarta Selatan": ["Cilandak", "Jagakarsa", "Kebayoran Baru", "Kebayoran Lama", "Mampang Prapatan"],
                "Jakarta Timur": ["Cakung", "Cipayung", "Ciracas", "Duren Sawit", "Jatinegara"],
                "Jakarta Barat": ["Cengkareng", "Grogol Petamburan", "Kalideres", "Kebon Jeruk", "Kembangan"],
                "Jakarta Utara": ["Cilincing", "Kelapa Gading", "Koja", "Pademangan", "Penjaringan"],
                
                // Banten
                "Serang": ["Cipocok Jaya", "Curug", "Kasemen", "Taktakan", "Walantaka"],
                "Tangerang": ["Batuceper", "Benda", "Cibodas", "Ciledug", "Cipondoh"],
                "Cilegon": ["Cibeber", "Cilegon", "Citangkil", "Ciwandan", "Gerogol"],
                "Tangerang Selatan": ["Ciputat", "Ciputat Timur", "Pamulang", "Pondok Aren", "Serpong"],
                "Cibinong": ["Cibinong", "Cileungsi", "Gunung Putri", "Klapanunggal", "Sukaraja"]
            };

            // Data desa/kelurahan berdasarkan kecamatan (setiap kecamatan memiliki 5 desa/kelurahan)
            const kecamatanDesa = {
                // Bandung
                "Bandung Kulon": ["Caringin", "Cibuntu", "Cicadas", "Kebon Jeruk", "Maleber"],
                "Bandung Wetan": ["Cihapit", "Citarum", "Tamansari", "Bandung Wetan", "Cipaganti"],
                "Buahbatu": ["Cijawura", "Jatisari", "Kebon Lega", "Mekar Jaya", "Buahbatu"],
                "Cibeunying Kidul": ["Cikutra", "Padasuka", "Sukamaju", "Sukapada", "Cibeunying Kidul"],
                "Cibeunying Kaler": ["Cigadung", "Cihaurgeulis", "Cisaga", "Sukaluyu", "Cibeunying Kaler"],
                
                // Bekasi
                "Bekasi Barat": ["Bintara", "Bintara Jaya", "Karang Asem Barat", "Karang Asem Timur", "Kranji"],
                "Bekasi Selatan": ["Jakasampurna", "Kaliabang Tengah", "Margahayu", "Perwira", "Teluk Pucung"],
                "Bekasi Timur": ["Aren Jaya", "Bekasi Jaya", "Duren Jaya", "Margahayu", "Bekasi Timur"],
                "Bekasi Utara": ["Harapan Baru", "Harapan Jaya", "Kaliabang Bungur", "Perwira", "Bekasi Utara"],
                "Medan Satria": ["Harapan Mulya", "Kali Baru", "Pejuang", "Medan Satria", "Satria Jaya"],
                
                // Bogor
                "Bogor Barat": ["Balungbangjaya", "Bubulak", "Cilendek Barat", "Cilendek Timur", "Curug"],
                "Bogor Selatan": ["Batutulis", "Bojongkerta", "Bondongan", "Cikaret", "Empang"],
                "Bogor Tengah": ["Babakan", "Babakan Pasar", "Cibogor", "Gudang", "Paledang"],
                "Bogor Timur": ["Baranangsiang", "Katulampa", "Sindangrasa", "Sindangsari", "Sukasari"],
                "Bogor Utara": ["Cibuluh", "Ciluar", "Kedunghalang", "Tanah Baru", "Tegal Gundil"],
                
                // Depok
                "Beji": ["Beji", "Beji Timur", "Kemiri Muka", "Kukusan", "Pondok Cina"],
                "Cimanggis": ["Cisalak Pasar", "Curug", "Harjamukti", "Mekarsari", "Pasir Gunung Selatan"],
                "Limo": ["Grogol", "Krukut", "Limo", "Meruyung", "Limo Jaya"],
                "Pancoran Mas": ["Depok", "Depok Jaya", "Mampang", "Pancoran Mas", "Rangkapan Jaya"],
                "Sawangan": ["Bedahan", "Cinangka", "Kedaung", "Pasir Putih", "Sawangan Baru"],
                
                // Cimahi
                "Cimahi Selatan": ["Cibeber", "Cibeureum", "Leuwigajah", "Melong", "Utama"],
                "Cimahi Tengah": ["Baros", "Cigugur Tengah", "Cimahi", "Karangmekar", "Padasuka"],
                "Cimahi Utara": ["Cibabat", "Cipageran", "Citeureup", "Pasirkaliki", "Cimahi Utara"],
                "Cimahi Barat": ["Cibabat Barat", "Cipageran Barat", "Citeureup Barat", "Pasirkaliki Barat", "Cimahi Barat"],
                "Cimahi Timur": ["Cibabat Timur", "Cipageran Timur", "Citeureup Timur", "Pasirkaliki Timur", "Cimahi Timur"],
                
                // Semarang
                "Banyumanik": ["Banyumanik", "Gedawang", "Jabungan", "Padangsari", "Pedalangan"],
                "Candisari": ["Candisari", "Jatingaleh", "Jomblang", "Karanganyar Gunung", "Tegalsari"],
                "Gajah Mungkur": ["Bendan Ngisor", "Bendungan", "Gajah Mungkur", "Karanganyar", "Lempongsari"],
                "Gayamsari": ["Gayamsari", "Kaligawe", "Pandean Lamper", "Sambirejo", "Sawah Besar"],
                "Genuk": ["Bangetayu Kulon", "Bangetayu Wetan", "Gebangsari", "Genuk", "Karangroto"],
                
                // Surakarta
                "Banjarsari": ["Banjarsari", "Gilingan", "Kadipiro", "Kestalan", "Nusukan"],
                "Jebres": ["Jebres", "Kepatihan Kulon", "Kepatihan Wetan", "Mojosongo", "Pucang Sawit"],
                "Laweyan": ["Bumi", "Kerten", "Laweyan", "Pajang", "Penumping"],
                "Pasar Kliwon": ["Baluwarti", "Gajahan", "Joyosuran", "Kampung Baru", "Sangkrah"],
                "Serengan": ["Danukusuman", "Jayengan", "Kedung Lumbu", "Kemlayan", "Serengan"],
                
                // Tegal
                "Margadana": ["Margadana", "Kalinyamat Wetan", "Sumur Panggang", "Kemandungan", "Pesurungan Kidul"],
                "Tegal Barat": ["Tegal Barat", "Kemandungan", "Muarareja", "Pekauman", "Tegalsari"],
                "Tegal Selatan": ["Tegal Selatan", "Debong Lor", "Kaligangsa", "Krandon", "Panggung"],
                "Tegal Timur": ["Tegal Timur", "Kalinyamat Kulon", "Mintaragen", "Pasar Pagi", "Slerok"],
                "Tegal Utara": ["Tegal Utara", "Bandung", "Debong Kidul", "Kalibuntu", "Keturen"],
                
                // Pekalongan
                "Pekalongan Barat": ["Pekalongan Barat", "Bendan", "Gamer", "Krapyak", "Sapuro"],
                "Pekalongan Selatan": ["Pekalongan Selatan", "Jenggot", "Kauman", "Klego", "Noyontaansari"],
                "Pekalongan Timur": ["Pekalongan Timur", "Kandang Panjang", "Padukuhan Kraton", "Panjang Wetan", "Seteran"],
                "Pekalongan Utara": ["Pekalongan Utara", "Dukuh", "Kramat Sari", "Pasir Kraton Kramat", "Tirto"],
                "Pekalongan Tengah": ["Pekalongan Tengah", "Jatirejo", "Kebulen", "Sampangan", "Sukorejo"],
                
                // Salatiga
                "Argomulyo": ["Argomulyo", "Cebongan", "Kumpulrejo", "Ledok", "Tegalrejo"],
                "Sidomukti": ["Sidomukti", "Blotongan", "Bugel", "Kauman Kidul", "Pulutan"],
                "Sidorejo": ["Sidorejo", "Kecandran", "Kutowinangun", "Pulutan", "Salatiga"],
                "Tingkir": ["Tingkir", "Gendongan", "Kutowinangun Kidul", "Kutowinangun Lor", "Sidorejo"],
                "Salatiga Selatan": ["Salatiga Selatan", "Bobosan", "Cebongan", "Kumpulrejo", "Tegalrejo"],
                
                // Surabaya
                "Asemrowo": ["Asemrowo", "Genting Kalianak", "Tambak Sarioso", "Asemrowo", "Kalianak"],
                "Benowo": ["Benowo", "Babat Jerawat", "Kandangan", "Pakal", "Romokalisari"],
                "Bubutan": ["Bubutan", "Alun-alun Contong", "Bubutan", "Gundih", "Jepara"],
                "Bulak": ["Bulak", "Bulak Banteng", "Kedung Cowek", "Sukolilo Baru", "Tambak Wedi"],
                "Dukuh Pakis": ["Dukuh Pakis", "Dukuh Kupang", "Gunung Sari", "Pradah Kalikendal", "Dukuh Pakis"],
                
                // Malang
                "Blimbing": ["Blimbing", "Arjosari", "Blimbing", "Pandanwangi", "Polowijen"],
                "Kedungkandang": ["Kedungkandang", "Bumiayu", "Kedungkandang", "Lesanpuro", "Samaan"],
                "Klojen": ["Klojen", "Bareng", "Gading Kasri", "Klojen", "Rampal Celaket"],
                "Lowokwaru": ["Lowokwaru", "Jatimulyo", "Merjosari", "Sumbersari", "Tunggulwulung"],
                "Sukun": ["Sukun", "Bakalan Krajan", "Ciptomulyo", "Gadang", "Kebonsari"],
                
                // Kediri
                "Kediri Kota": ["Kediri Kota", "Balowerti", "Banjaran", "Dandangan", "Kemasan"],
                "Mojoroto": ["Mojoroto", "Gayam", "Kampung Dalem", "Mrican", "Pojok"],
                "Pesantren": ["Pesantren", "Betet", "Bawang", "Pesantren", "Tinalan"],
                "Kediri Selatan": ["Kediri Selatan", "Jamsaren", "Kaliombo", "Manisrenggo", "Sukorame"],
                "Kediri Utara": ["Kediri Utara", "Banjaranyar", "Kembang", "Pakunden", "Setonogedong"],
                
                // Madiun
                "Kartoharjo": ["Kartoharjo", "Kartoharjo", "Klegen", "Oro-Oro Ombo", "Rejomulyo"],
                "Manguharjo": ["Manguharjo", "Madiun Lor", "Manguharjo", "Ngegong", "Winongo"],
                "Taman": ["Taman", "Banjarejo", "Kejuron", "Taman", "Tambran"],
                "Madiun Lor": ["Madiun Lor", "Mojopurno", "Pangongangan", "Sogaten", "Sukosari"],
                "Madiun Kidul": ["Madiun Kidul", "Demangan", "Josenan", "Kuncen", "Pandean"],
                
                // Blitar
                "Kepanjenkidul": ["Kepanjenkidul", "Bendo", "Kauman", "Kepanjenkidul", "Tanggung"],
                "Sananwetan": ["Sananwetan", "Gedog", "Karangsari", "Sananwetan", "Sukorejo"],
                "Sukorejo": ["Sukorejo", "Pakunden", "Sukorejo", "Tanjungsari", "Turi"],
                "Blitar Selatan": ["Blitar Selatan", "Karangsari", "Kepanjenkidul", "Sananwetan", "Sukorejo"],
                "Blitar Utara": ["Blitar Utara", "Gedog", "Kauman", "Kepanjenkidul", "Tanggung"],
                
                // Jakarta Pusat
                "Cempaka Putih": ["Cempaka Putih", "Cempaka Putih Barat", "Cempaka Putih Timur", "Rawasari", "Cempaka Putih"],
                "Gambir": ["Gambir", "Gambir", "Kebon Kelapa", "Petojo Selatan", "Petojo Utara"],
                "Johar Baru": ["Johar Baru", "Galur", "Johar Baru", "Kampung Rawa", "Tanah Tinggi"],
                "Kemayoran": ["Kemayoran", "Gunung Sahari Selatan", "Kemayoran", "Kebon Kosong", "Serdang"],
                "Menteng": ["Menteng", "Cikini", "Gondangdia", "Kebon Sirih", "Menteng"],
                
                // Jakarta Selatan
                "Cilandak": ["Cilandak", "Cilandak Barat", "Cipete Selatan", "Gandaria Selatan", "Lebak Bulus"],
                "Jagakarsa": ["Jagakarsa", "Ciganjur", "Cipedak", "Jagakarsa", "Lenteng Agung"],
                "Kebayoran Baru": ["Kebayoran Baru", "Gandaria Utara", "Kramat Pela", "Melawai", "Senayan"],
                "Kebayoran Lama": ["Kebayoran Lama", "Cipulir", "Grogol Selatan", "Kebayoran Lama", "Pondok Pinang"],
                "Mampang Prapatan": ["Mampang Prapatan", "Kuningan Barat", "Mampang Prapatan", "Pela Mampang", "Tegal Parang"],
                
                // Jakarta Timur
                "Cakung": ["Cakung", "Cakung Barat", "Cakung Timur", "Rawa Terate", "Ujung Menteng"],
                "Cipayung": ["Cipayung", "Cipayung", "Cipayung Jaya", "Lubang Buaya", "Setu"],
                "Ciracas": ["Ciracas", "Cibubur", "Ciracas", "Kelapa Dua Wetan", "Rambutan"],
                "Duren Sawit": ["Duren Sawit", "Duren Sawit", "Klender", "Malaka Jaya", "Malaka Sari"],
                "Jatinegara": ["Jatinegara", "Bali Mester", "Bidara Cina", "Cipinang Besar Utara", "Kampung Melayu"],
                
                // Jakarta Barat
                "Cengkareng": ["Cengkareng", "Cengkareng Barat", "Cengkareng Timur", "Duri Kosambi", "Kapuk"],
                "Grogol Petamburan": ["Grogol Petamburan", "Grogol", "Jelambar", "Jelambar Baru", "Tanjung Duren"],
                "Kalideres": ["Kalideres", "Kalideres", "Kamal", "Pegadungan", "Semanan"],
                "Kebon Jeruk": ["Kebon Jeruk", "Duri Kepa", "Kebon Jeruk", "Kedoya Selatan", "Sukabumi Utara"],
                "Kembangan": ["Kembangan", "Joglo", "Kembangan Selatan", "Kembangan Utara", "Meruya Selatan"],
                
                // Jakarta Utara
                "Cilincing": ["Cilincing", "Cilincing", "Kalibaru", "Marunda", "Sukapura"],
                "Kelapa Gading": ["Kelapa Gading", "Kelapa Gading Barat", "Kelapa Gading Timur", "Pegangsaan Dua", "Kelapa Gading"],
                "Koja": ["Koja", "Koja", "Lagoa", "Rawa Badak Selatan", "Tugu Selatan"],
                "Pademangan": ["Pademangan", "Pademangan Barat", "Pademangan Timur", "Ancol", "Sungai Bambu"],
                "Penjaringan": ["Penjaringan", "Kamal Muara", "Kapuk Muara", "Pejagalan", "Penjaringan"],
                
                // Serang
                "Cipocok Jaya": ["Cipocok Jaya", "Cipocok Jaya", "Dalung", "Karang Anyar", "Panancangan"],
                "Curug": ["Curug", "Cilaku", "Curug", "Kamanisan", "Sukalaksana"],
                "Kasemen": ["Kasemen", "Bendung", "Kasemen", "Kebon Baru", "Terumbu"],
                "Taktakan": ["Taktakan", "Cibendung", "Kuranji", "Pancur", "Taktakan"],
                "Walantaka": ["Walantaka", "Kalodran", "Pager Agung", "Pancalaksana", "Walantaka"],
                
                // Tangerang
                "Batuceper": ["Batuceper", "Batuceper", "Batujaya", "Kebon Besar", "Poris Gaga"],
                "Benda": ["Benda", "Benda", "Belendung", "Karang Anyar", "Karang Sari"],
                "Cibodas": ["Cibodas", "Cibodas", "Cibodas Baru", "Cibodas Sari", "Jatiuwung"],
                "Ciledug": ["Ciledug", "Ciledug", "Ciledug Kulon", "Ciledug Wetan", "Paninggilan"],
                "Cipondoh": ["Cipondoh", "Cipondoh", "Cipondoh Indah", "Cipondoh Makmur", "Gondrong"],
                
                // Cilegon
                "Cibeber": ["Cibeber", "Bulakan", "Cibeber", "Kedaleman", "Kota Baru"],
                "Cilegon": ["Cilegon", "Cilegon", "Karang Anyar", "Kebonsari", "Ramanuju"],
                "Citangkil": ["Citangkil", "Citangkil", "Deringo", "Kebon Dalem", "Samangraya"],
                "Ciwandan": ["Ciwandan", "Ciwandan", "Gerem", "Grogol", "Kedungbunder"],
                "Gerogol": ["Gerogol", "Karang Asem", "Kebon Jati", "Lebak Gede", "Pabean"],
                
                // Tangerang Selatan
                "Ciputat": ["Ciputat", "Ciputat", "Ciputat Jaya", "Jombang", "Sawah Lama"],
                "Ciputat Timur": ["Ciputat Timur", "Ciputat Timur", "Jatiwaringin", "Pondok Ranji", "Rempoa"],
                "Pamulang": ["Pamulang", "Bambu Apus", "Pamulang Barat", "Pamulang Timur", "Pondok Benda"],
                "Pondok Aren": ["Pondok Aren", "Jurang Mangu", "Pondok Aren", "Pondok Kacang", "Pondok Karya"],
                "Serpong": ["Serpong", "Buaran", "Cilenggang", "Lengkong Gudang", "Serpong"],
                
                // Cibinong
                "Cibinong": ["Cibinong", "Cibinong", "Cirimekar", "Karadenan", "Sukahati"],
                "Cileungsi": ["Cileungsi", "Cileungsi", "Cipeucang", "Jatisari", "Mampir"],
                "Gunung Putri": ["Gunung Putri", "Bojong Kulur", "Gunung Putri", "Karang Asem", "Nagrak"],
                "Klapanunggal": ["Klapanunggal", "Kembang Kuning", "Lulut", "Sampora", "Setu"],
                "Sukaraja": ["Sukaraja", "Cikeas", "Cilebut", "Kedung Waringin", "Sukaraja"]
            };

            const provinsiSelect = document.getElementById('provinsi');
            const kotaSelect = document.getElementById('kota');
            const kecamatanSelect = document.getElementById('kecamatan');
            const desaKelurahanSelect = document.getElementById('desa_kelurahan');
            const alamatTextarea = document.getElementById('alamatLengkap');
            const charCount = document.getElementById('charCount');
            const submitButton = document.getElementById('submitButton');
            const form = document.getElementById('locationForm');

            // Isi dropdown provinsi
            async function loadProvinsi() {
                try {
                    const response = await fetch('{{ route("api.reference.provinsi.list") }}');
                    const data = await response.json();
                    
                    const provinsiSelect = document.getElementById('provinsi');
                    for (const prov of data) {
                        const option = document.createElement('option');
                        option.value = prov.id;
                        option.textContent = prov.name;
                        // Set selected jika ada data old
                        if (prov.id == "{{ old('provinsi') }}") {
                            option.selected = true;
                        }
                        provinsiSelect.appendChild(option);
                    }
                    
                    // Trigger perubahan provinsi jika ada data old
                    if ("{{ old('provinsi') }}") {
                        provinsiSelect.dispatchEvent(new Event('change'));
                    }
                } catch (error) {
                    console.error('Error loading provinsi:', error);
                }
            }

            // Isi dropdown kabupaten berdasarkan provinsi yang dipilih
            async function isiKabupaten(provinsiId) {
                kabupatenSelect = document.getElementById('kota');
                kecamatanSelect = document.getElementById('kecamatan');
                desaKelurahanSelect = document.getElementById('desa_kelurahan');
                
                kabupatenSelect.innerHTML = '<option value="" selected disabled class="placeholder-option">Pilih Kota</option>';
                kabupatenSelect.disabled = true;
                
                // Reset dan disable kecamatan & desa
                resetKecamatan();
                resetDesaKelurahan();

                if (!provinsiId) {
                    return;
                }

                try {
                    // Check cache first
                    if (cache.kabupaten[provinsiId]) {
                        populateKabupaten(cache.kabupaten[provinsiId]);
                        return;
                    }

                    const response = await fetch(`{{ route("api.reference.kabupaten.by-province") }}?parent_id=${provinsiId}`);
                    const data = await response.json();
                    
                    cache.kabupaten[provinsiId] = data;
                    populateKabupaten(data);
                } catch (error) {
                    console.error('Error loading kabupaten:', error);
                }
            }

            function populateKabupaten(kabupatenList) {
                const kabupatenSelect = document.getElementById('kota');
                for (const kab of kabupatenList) {
                    const option = document.createElement('option');
                    option.value = kab.id;
                    option.textContent = kab.name;
                    // Set selected jika ada data old
                    if (kab.id == "{{ old('kota') }}") {
                        option.selected = true;
                    }
                    kabupatenSelect.appendChild(option);
                }
                kabupatenSelect.disabled = false;
                
                // Trigger perubahan kota jika ada data old
                if ("{{ old('kota') }}") {
                    kabupatenSelect.dispatchEvent(new Event('change'));
                }
            }

            // Isi dropdown kecamatan berdasarkan kabupaten yang dipilih
            async function isiKecamatan(kabupatenId) {
                kecamatanSelect = document.getElementById('kecamatan');
                desaKelurahanSelect = document.getElementById('desa_kelurahan');
                
                kecamatanSelect.innerHTML = '<option value="" selected disabled class="placeholder-option">Pilih Kecamatan</option>';
                kecamatanSelect.disabled = true;

                // Reset dan disable desa
                resetDesaKelurahan();

                if (!kabupatenId) {
                    return;
                }

                try {
                    // Check cache first
                    if (cache.kecamatan[kabupatenId]) {
                        populateKecamatan(cache.kecamatan[kabupatenId]);
                        return;
                    }

                    const response = await fetch(`{{ route("api.reference.kecamatan.by-kabupaten") }}?parent_id=${kabupatenId}`);
                    const data = await response.json();
                    
                    cache.kecamatan[kabupatenId] = data;
                    populateKecamatan(data);
                } catch (error) {
                    console.error('Error loading kecamatan:', error);
                }
            }

            function populateKecamatan(kecamatanList) {
                const kecamatanSelect = document.getElementById('kecamatan');
                for (const kec of kecamatanList) {
                    const option = document.createElement('option');
                    option.value = kec.id;
                    option.textContent = kec.name;
                    // Set selected jika ada data old
                    if (kec.id == "{{ old('kecamatan') }}") {
                        option.selected = true;
                    }
                    kecamatanSelect.appendChild(option);
                }
                kecamatanSelect.disabled = false;
                
                // Trigger perubahan kecamatan jika ada data old
                if ("{{ old('kecamatan') }}") {
                    kecamatanSelect.dispatchEvent(new Event('change'));
                }
            }

            // Isi dropdown desa/kelurahan berdasarkan kecamatan yang dipilih
            async function isiDesaKelurahan(kecamatanId) {
                desaKelurahanSelect = document.getElementById('desa_kelurahan');
                
                desaKelurahanSelect.innerHTML = '<option value="" selected disabled class="placeholder-option">Pilih Desa/Kelurahan</option>';
                desaKelurahanSelect.disabled = true;

                if (!kecamatanId) {
                    return;
                }

                try {
                    // Check cache first
                    if (cache.desa[kecamatanId]) {
                        populateDesa(cache.desa[kecamatanId]);
                        return;
                    }

                    const response = await fetch(`{{ route("api.reference.desa.by-kecamatan") }}?parent_id=${kecamatanId}`);
                    const data = await response.json();
                    
                    cache.desa[kecamatanId] = data;
                    populateDesa(data);
                } catch (error) {
                    console.error('Error loading desa:', error);
                }
            }

            function populateDesa(desaList) {
                const desaKelurahanSelect = document.getElementById('desa_kelurahan');
                for (const desa of desaList) {
                    const option = document.createElement('option');
                    option.value = desa.id;
                    option.textContent = desa.name;
                    // Set selected jika ada data old
                    if (desa.id == "{{ old('desa_kelurahan') }}") {
                        option.selected = true;
                    }
                    desaKelurahanSelect.appendChild(option);
                }
                desaKelurahanSelect.disabled = false;
            }

            // Load Provinsi
            loadProvinsi();

            // Reset dropdown kecamatan
            function resetKecamatan() {
                kecamatanSelect.innerHTML = '<option value="" selected disabled class="placeholder-option">Pilih Kecamatan</option>';
                kecamatanSelect.disabled = true;
            }

            // Reset dropdown desa/kelurahan
            function resetDesaKelurahan() {
                desaKelurahanSelect.innerHTML = '<option value="" selected disabled class="placeholder-option">Pilih Desa/Kelurahan</option>';
                desaKelurahanSelect.disabled = true;
            }

            // Trigger perubahan provinsi jika ada data old
            if ("{{ old('provinsi') }}") {
                const provinsiSelect = document.getElementById('provinsi');
                provinsiSelect.dispatchEvent(new Event('change'));
            }

            // Event listener untuk perubahan provinsi
            document.getElementById('provinsi').addEventListener('change', function() {
                const selectedProvinsi = this.value;
                isiKabupaten(selectedProvinsi);
            });

            // Event listener untuk perubahan kabupaten/kota
            document.getElementById('kota').addEventListener('change', function() {
                const selectedKabupaten = this.value;
                isiKecamatan(selectedKabupaten);
            });

            // Event listener untuk perubahan kecamatan
            document.getElementById('kecamatan').addEventListener('change', function() {
                const selectedKecamatan = this.value;
                isiDesaKelurahan(selectedKecamatan);
            });

            // Hitung karakter alamat
            alamatTextarea.addEventListener('input', () => {
                charCount.textContent = alamatTextarea.value.length;
            });

            // Set char count awal jika ada data old
            charCount.textContent = alamatTextarea.value.length;

            // Form submission handling
            form.addEventListener('submit', function(e) {
                const provinsi = provinsiSelect.value;
                const kota = kotaSelect.value;
                const kecamatan = kecamatanSelect.value;
                const desaKelurahan = desaKelurahanSelect.value;
                const alamat = alamatTextarea.value.trim();

                if (!provinsi || !kota || !kecamatan || !desaKelurahan || !alamat) {
                    e.preventDefault();
                    alert('Harap lengkapi semua field sebelum melanjutkan!');
                    return;
                }

                // Show loading state
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Menyimpan...';
            });
        });
    </script>
</body>
</html>