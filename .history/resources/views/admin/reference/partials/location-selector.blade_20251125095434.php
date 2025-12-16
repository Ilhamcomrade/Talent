<!-- Location Selector Script for Reference Forms -->
<script>
    // Global state untuk tracking lokasi terpilih
    const locationState = {
        provinsiId: null,
        kabupatenId: null,
        kecamatanId: null,
        desaId: null,
        
        setProvinsi(id) { this.provinsiId = id; this.kabupatenId = null; this.kecamatanId = null; this.desaId = null; },
        setKabupaten(id) { this.kabupatenId = id; this.kecamatanId = null; this.desaId = null; },
        setKecamatan(id) { this.kecamatanId = id; this.desaId = null; },
        setDesa(id) { this.desaId = id; }
    };

    // Fetch data berdasarkan parent
    async function fetchChildData(endpoint, parentId) {
        try {
            const response = await fetch(`/api/reference/${endpoint}?parent_id=${parentId}`);
            return await response.json();
        } catch (error) {
            console.error('Error fetching data:', error);
            return [];
        }
    }

    // Update list items dan highlight
    function updateListItems(container, items, itemType, highlightId = null) {
        if (!container) return;
        
        container.innerHTML = '';
        
        if (items.length === 0) {
            container.innerHTML = `
                <div style="padding: 3rem 1rem; text-align: center; color: #6c757d;">
                    <i class="fas fa-inbox fa-2x mb-3" style="display: block;"></i>
                    <p>Belum ada data ${itemType}</p>
                </div>
            `;
            return;
        }

        items.forEach(item => {
            const isActive = highlightId && item.id === highlightId;
            const itemHtml = `
                <div style="padding: 0.75rem 1rem; border-bottom: 1px solid #e9ecef; 
                            background-color: ${isActive ? '#fff3cd' : 'white'};
                            cursor: pointer; transition: background-color 0.2s;" 
                     onmouseover="this.style.backgroundColor='${isActive ? '#fff3cd' : '#f8f9fa'}'" 
                     onmouseout="this.style.backgroundColor='${isActive ? '#fff3cd' : 'white'}'">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="fw-bold">${item.name || item.nama_provinsi || item.nama_kabupaten || item.nama_kecamatan || item.nama_desa}</div>
                            <small class="text-muted">Kode: <code>${item.id || item.kode_provinsi || item.kode_kabupaten || item.kode_kecamatan || item.kode_desa}</code></small>
                        </div>
                        <span class="badge ${item.status == 1 ? 'bg-success' : 'bg-secondary'}">
                            ${item.status == 1 ? 'Aktif' : 'Nonaktif'}
                        </span>
                    </div>
                </div>
            `;
            container.innerHTML += itemHtml;
        });
    }

    // Event listeners untuk dropdown
    document.addEventListener('DOMContentLoaded', function() {
        // Reference Kabupaten
        const provinsiSelect = document.getElementById('province_id');
        const kabupatenListContainer = document.getElementById('kabupaten-list-container');
        
        if (provinsiSelect && kabupatenListContainer) {
            provinsiSelect.addEventListener('change', async function() {
                if (this.value) {
                    locationState.setProvinsi(this.value);
                    const data = await fetchChildData('kabupaten/by-province', this.value);
                    updateListItems(kabupatenListContainer, data, 'kabupaten/kota');
                }
            });
        }

        // Reference Kecamatan
        const kabupatenSelect = document.getElementById('kabupaten_id');
        const kecamatanListContainer = document.getElementById('kecamatan-list-container');
        
        if (kabupatenSelect && kecamatanListContainer) {
            kabupatenSelect.addEventListener('change', async function() {
                if (this.value) {
                    locationState.setKabupaten(this.value);
                    const data = await fetchChildData('kecamatan/by-kabupaten', this.value);
                    updateListItems(kecamatanListContainer, data, 'kecamatan');
                }
            });
        }

        // Reference Desa
        const kecamatanSelect = document.getElementById('kecamatan_id');
        const desaListContainer = document.getElementById('desa-list-container');
        
        if (kecamatanSelect && desaListContainer) {
            kecamatanSelect.addEventListener('change', async function() {
                if (this.value) {
                    locationState.setKecamatan(this.value);
                    const data = await fetchChildData('desa/by-kecamatan', this.value);
                    updateListItems(desaListContainer, data, 'desa/kelurahan');
                }
            });
        }
    });
</script>
