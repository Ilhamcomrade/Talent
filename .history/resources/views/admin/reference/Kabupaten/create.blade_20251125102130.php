@extends('admin.layout')

@section('title', 'Tambah Kabupaten/Kota')
@section('content')

<style>
    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
    
    .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 10px 10px 0 0 !important;
        padding: 1.5rem;
    }
    
    .btn-back {
        background: rgba(255,255,255,0.2);
        border: 1px solid rgba(255,255,255,0.3);
        color: white;
    }
    
    .btn-back:hover {
        background: rgba(255,255,255,0.3);
        color: white;
    }
</style>

<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Tambah Kabupaten/Kota</h4>
                        <a href="{{ route('admin.reference.kabupaten.index') }}" class="btn btn-back">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.reference.kabupaten.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="province_id" class="form-label fw-bold">Provinsi <span class="text-danger">*</span></label>
                                <select class="form-select @error('province_id') is-invalid @enderror" id="province_id" name="province_id" required>
                                    <option value="">Pilih Provinsi</option>
                                    @foreach($provinces as $province)
                                        <option value="{{ $province->id }}" {{ old('province_id') == $province->id ? 'selected' : '' }}>
                                            {{ $province->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('province_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="id" class="form-label fw-bold">Kode Kabupaten <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('id') is-invalid @enderror" 
                                       id="id" name="id" 
                                       value="{{ old('id') }}" 
                                       placeholder="Contoh: 1107, 3201" required>
                                @error('id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="name" class="form-label fw-bold">Nama Kabupaten/Kota <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" 
                                       value="{{ old('name') }}" 
                                       placeholder="Contoh: Kabupaten Aceh Jaya, Kota Bandung" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                    <option value="">Pilih Status</option>
                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label fw-bold">Deskripsi</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3" 
                                      placeholder="Deskripsi tambahan tentang kabupaten/kota">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('admin.reference.kabupaten.index') }}" class="btn btn-secondary me-md-2">
                                <i class="fas fa-times me-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- List Section -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-list me-2"></i>Daftar Kabupaten/Kota</h5>
                </div>
                <div class="card-body p-0">
                    <div id="kabupaten-list-container" style="max-height: 600px; overflow-y: auto;">
                        <div style="padding: 3rem 1rem; text-align: center; color: #6c757d;">
                            <i class="fas fa-inbox fa-2x mb-3" style="display: block;"></i>
                            <p>Pilih Provinsi untuk melihat data Kabupaten/Kota</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Function untuk update list kabupaten saat provinsi berubah
    document.getElementById('province_id')?.addEventListener('change', async function() {
        const provinceId = this.value;
        const listContainer = document.getElementById('kabupaten-list-container');
        
        if (!provinceId) {
            listContainer.innerHTML = `
                <div style="padding: 3rem 1rem; text-align: center; color: #6c757d;">
                    <i class="fas fa-inbox fa-2x mb-3" style="display: block;"></i>
                    <p>Pilih Provinsi untuk melihat data Kabupaten/Kota</p>
                </div>
            `;
            return;
        }

        try {
            const response = await fetch(`/api/reference/kabupaten/by-province?parent_id=${provinceId}`);
            const data = await response.json();
            
            if (data.length === 0) {
                listContainer.innerHTML = `
                    <div style="padding: 3rem 1rem; text-align: center; color: #6c757d;">
                        <i class="fas fa-inbox fa-2x mb-3" style="display: block;"></i>
                        <p>Belum ada data Kabupaten/Kota untuk provinsi ini</p>
                    </div>
                `;
                return;
            }

            let html = '';
            data.forEach(item => {
                html += `
                    <div style="padding: 0.75rem 1rem; border-bottom: 1px solid #e9ecef; cursor: pointer; transition: background-color 0.2s;" 
                         onmouseover="this.style.backgroundColor='#f8f9fa'" onmouseout="this.style.backgroundColor='white'">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="fw-bold">${item.name}</div>
                                <small class="text-muted">Kode: <code>${item.id}</code></small>
                            </div>
                            <span class="badge ${item.status == 1 ? 'bg-success' : 'bg-secondary'}">
                                ${item.status == 1 ? 'Aktif' : 'Nonaktif'}
                            </span>
                        </div>
                    </div>
                `;
            });
            listContainer.innerHTML = html;
        } catch (error) {
            console.error('Error fetching kabupaten:', error);
            listContainer.innerHTML = `
                <div style="padding: 3rem 1rem; text-align: center; color: #6c757d;">
                    <i class="fas fa-exclamation-circle fa-2x mb-3\" style="display: block; color: #dc3545;\"></i>
                    <p>Terjadi kesalahan saat memuat data</p>
                </div>
            `;
        }
    });
</script>

@endsection