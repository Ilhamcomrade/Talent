@extends('admin.layout')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Profil Perusahaan</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Informasi Kontak -->
                            <div class="col-md-6">
                                <h4 class="mb-3">Informasi Kontak</h4>

                                <div class="form-group mb-3">
                                    <label for="address">Alamat</label>
                                    <textarea name="address" id="address" class="form-control" rows="3" required>{{ old('address', $profile->address) }}</textarea>
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $profile->email) }}" required>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="phone">Nomor Telepon</label>
                                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $profile->phone) }}" required>
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="operation_hours">Jam Operasional</label>
                                    <input type="text" name="operation_hours" id="operation_hours" class="form-control" value="{{ old('operation_hours', $profile->operation_hours) }}" required>
                                    @error('operation_hours')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Lokasi Perusahaan -->
                            <div class="col-md-6">
                                <h4 class="mb-3">Lokasi Perusahaan</h4>

                                <div class="form-group mb-3">
                                    <label for="latitude">Latitude</label>
                                    <input type="text"
                                           name="latitude"
                                           id="latitude"
                                           class="form-control"
                                           value="{{ old('latitude', $profile->latitude) }}"
                                           required
                                           pattern="-?\d+(\.\d+)?"
                                           title="Hanya angka, titik desimal, dan tanda minus diperbolehkan"
                                           oninput="validateCoordinateInput(this)">
                                    @error('latitude')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="longitude">Longitude</label>
                                    <input type="text"
                                           name="longitude"
                                           id="longitude"
                                           class="form-control"
                                           value="{{ old('longitude', $profile->longitude) }}"
                                           required
                                           pattern="-?\d+(\.\d+)?"
                                           title="Hanya angka, titik desimal, dan tanda minus diperbolehkan"
                                           oninput="validateCoordinateInput(this)">
                                    @error('longitude')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="map_popup_text">Teks Popup Peta</label>
                                    <input type="text" name="map_popup_text" id="map_popup_text" class="form-control" value="{{ old('map_popup_text', $profile->map_popup_text) }}">
                                    @error('map_popup_text')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Preview Peta -->
                                <div id="map-preview" class="mb-3" style="height: 300px; border: 1px solid #ddd; border-radius: 4px; overflow: hidden; position: relative;">
                                    <!-- Peta akan ditampilkan di sini -->
                                    <div id="map" style="width: 100%; height: 100%;"></div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <!-- Logo Section -->
                        <div class="row">
                            <div class="col-12">
                                <h4 class="mb-3">Logo</h4>
                            </div>

                            <!-- Logo Navbar Public -->
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="card-title">Logo Navbar Public</h6>
                                    </div>
                                    <div class="card-body text-center">
                                        @if($profile->logo_navbar_public_url)
                                            <img src="{{ $profile->logo_navbar_public_url }}" alt="Logo Navbar Public" class="img-fluid mb-2" style="max-height: 100px;" id="preview-logo-navbar-public">
                                            <div class="form-check mb-2">
                                            </div>
                                        @else
                                            <div class="alert alert-info mb-2">
                                                <small>Belum ada logo yang diupload</small>
                                            </div>
                                        @endif
                                        <input type="file" name="logo_navbar_public" id="logo_navbar_public" class="form-control" accept="image/*">
                                        @error('logo_navbar_public')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Logo Navbar Company -->
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="card-title">Logo Navbar Company</h6>
                                    </div>
                                    <div class="card-body text-center">
                                        @if($profile->logo_navbar_company_url)
                                            <img src="{{ $profile->logo_navbar_company_url }}" alt="Logo Navbar Company" class="img-fluid mb-2" style="max-height: 100px;" id="preview-logo-navbar-company">
                                            <div class="form-check mb-2">
                                            </div>
                                        @else
                                            <div class="alert alert-info mb-2">
                                                <small>Belum ada logo yang diupload</small>
                                            </div>
                                        @endif
                                        <input type="file" name="logo_navbar_company" id="logo_navbar_company" class="form-control" accept="image/*">
                                        @error('logo_navbar_company')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Logo Navbar Campus -->
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="card-title">Logo Navbar Campus</h6>
                                    </div>
                                    <div class="card-body text-center">
                                        @if($profile->logo_navbar_campus_url)
                                            <img src="{{ $profile->logo_navbar_campus_url }}" alt="Logo Navbar Campus" class="img-fluid mb-2" style="max-height: 100px;" id="preview-logo-navbar-campus">
                                            <div class="form-check mb-2">
                                            </div>
                                        @else
                                            <div class="alert alert-info mb-2">
                                                <small>Belum ada logo yang diupload</small>
                                            </div>
                                        @endif
                                        <input type="file" name="logo_navbar_campus" id="logo_navbar_campus" class="form-control" accept="image/*">
                                        @error('logo_navbar_campus')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Logo Footer -->
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="card-title">Logo Footer</h6>
                                    </div>
                                    <div class="card-body text-center">
                                        @if($profile->logo_footer_url)
                                            <img src="{{ $profile->logo_footer_url }}" alt="Logo Footer" class="img-fluid mb-2" style="max-height: 100px;" id="preview-logo-footer">
                                            <div class="form-check mb-2">
                                            </div>
                                        @else
                                            <div class="alert alert-info mb-2">
                                                <small>Belum ada logo yang diupload</small>
                                            </div>
                                        @endif
                                        <input type="file" name="logo_footer" id="logo_footer" class="form-control" accept="image/*">
                                        @error('logo_footer')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk preview peta -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    #map {
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }
    .leaflet-container {
        font-family: inherit;
    }
    .leaflet-control-container {
        position: absolute;
        z-index: 1000;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil nilai latitude dan longitude
        let lat = {{ $profile->latitude ??  -6.925457980196308 }};
        let lng = {{ $profile->longitude ??  107.66299344598612 }};

        // Inisialisasi peta
        let map = L.map('map').setView([lat, lng], 16);

        // Tambahkan tile layer OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 19,
            minZoom: 1
        }).addTo(map);

        // Tambahkan marker dengan icon kustom
        let markerIcon = L.icon({
            iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
            iconRetinaUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
            shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        let marker = L.marker([lat, lng], {icon: markerIcon}).addTo(map)
            .bindPopup("{{ $profile->map_popup_text ?? 'Lokasi Perusahaan' }}")
            .openPopup();

        // Fungsi untuk menyesuaikan ukuran peta
        function resizeMap() {
            setTimeout(function() {
                map.invalidateSize();
                map.setView([lat, lng], map.getZoom());
            }, 100);
        }

        // Panggil resizeMap setelah DOM selesai dimuat
        resizeMap();

        // Update marker saat input berubah
        document.getElementById('latitude').addEventListener('input', updateMap);
        document.getElementById('longitude').addEventListener('input', updateMap);

        function updateMap() {
            let newLat = parseFloat(document.getElementById('latitude').value) || lat;
            let newLng = parseFloat(document.getElementById('longitude').value) || lng;

            // Update view dan marker
            map.setView([newLat, newLng], map.getZoom());
            marker.setLatLng([newLat, newLng]);

            // Update variabel lat/lng global
            lat = newLat;
            lng = newLng;
        }

        // Fungsi validasi input koordinat
        function validateCoordinateInput(input) {
            // Hapus karakter yang tidak diinginkan
            let value = input.value;
            let cleaned = value.replace(/[^0-9.\-]/g, '');

            // Pastikan hanya ada satu titik desimal
            let dots = cleaned.split('.').length - 1;
            if (dots > 1) {
                cleaned = cleaned.substring(0, cleaned.lastIndexOf('.'));
            }

            // Validasi format
            const regex = /^-?\d+(\.\d+)?$/;
            if (!regex.test(cleaned) && cleaned !== '') {
                input.setCustomValidity('Format koordinat tidak valid. Hanya angka, titik desimal, dan tanda minus diperbolehkan.');
                input.classList.add('is-invalid');
            } else {
                input.setCustomValidity('');
                input.classList.remove('is-invalid');
            }

            // Update nilai input
            if (value !== cleaned) {
                input.value = cleaned;
            }
        }

        // Inisialisasi validasi untuk input yang sudah ada
        validateCoordinateInput(document.getElementById('latitude'));
        validateCoordinateInput(document.getElementById('longitude'));

        // Preview gambar sebelum upload untuk logo
        const logoInputs = ['logo_navbar_public', 'logo_navbar_company', 'logo_navbar_campus', 'logo_footer'];
        logoInputs.forEach(inputId => {
            const input = document.getElementById(inputId);
            const previewId = 'preview-' + inputId.replace(/_/g, '-');
            const previewElement = document.getElementById(previewId);

            input.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        // Update preview image
                        if (previewElement) {
                            previewElement.src = e.target.result;
                        } else {
                            // Jika belum ada preview, buat baru
                            const cardBody = input.closest('.card-body');
                            const existingImg = cardBody.querySelector('img');
                            if (existingImg) {
                                existingImg.src = e.target.result;
                            } else {
                                const img = document.createElement('img');
                                img.src = e.target.result;
                                img.className = 'img-fluid mb-2';
                                img.style.maxHeight = '100px';
                                img.id = previewId;
                                cardBody.insertBefore(img, input);
                            }
                        }

                        // Sembunyikan alert info jika ada
                        const alertInfo = input.closest('.card-body').querySelector('.alert-info');
                        if (alertInfo) {
                            alertInfo.style.display = 'none';
                        }

                        // Tampilkan checkbox hapus
                        const removeCheckbox = input.closest('.card-body').querySelector('.form-check');
                        if (removeCheckbox) {
                            removeCheckbox.style.display = 'block';
                        }
                    };
                    reader.readAsDataURL(file);
                }
            });
        });

        // Handle checkbox hapus logo
        document.querySelectorAll('[id^="remove_logo_"]').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const cardBody = this.closest('.card-body');
                const img = cardBody.querySelector('img');
                const fileInput = cardBody.querySelector('input[type="file"]');
                const alertInfo = cardBody.querySelector('.alert-info');

                if (this.checked && img) {
                    img.style.opacity = '0.5';
                    if (fileInput) {
                        fileInput.disabled = true;
                    }
                    if (alertInfo) {
                        alertInfo.style.display = 'block';
                    }
                } else {
                    if (img) img.style.opacity = '1';
                    if (fileInput) fileInput.disabled = false;
                    if (alertInfo) {
                        alertInfo.style.display = 'none';
                    }
                }
            });
        });

        // Tambahkan event listener untuk resize window
        window.addEventListener('resize', function() {
            resizeMap();
        });

        // Invalidate size saat tab diaktifkan
        document.addEventListener('visibilitychange', function() {
            if (!document.hidden) {
                resizeMap();
            }
        });
    });
</script>
@endsection
