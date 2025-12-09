@extends('admin.layout')

@section('title', 'Tambah Desa/Kelurahan')
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
                        <h4 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Tambah Desa/Kelurahan</h4>
                        <a href="{{ route('admin.reference.desa.index') }}" class="btn btn-back">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.reference.desa.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="kecamatan_id" class="form-label fw-bold">Kecamatan <span class="text-danger">*</span></label>
                                <select class="form-select @error('kecamatan_id') is-invalid @enderror" id="kecamatan_id" name="kecamatan_id">
                                    <option value="">Pilih Kecamatan</option>
                                    @foreach($kecamatans as $kecamatan)
                                        <option value="{{ $kecamatan->id }}" {{ old('kecamatan_id') == $kecamatan->id ? 'selected' : '' }}>
                                            {{ $kecamatan->nama_kecamatan }} - {{ $kecamatan->kabupaten->nama_kabupaten }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kecamatan_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="kode_desa" class="form-label fw-bold">Kode Desa <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('kode_desa') is-invalid @enderror" 
                                       id="kode_desa" name="kode_desa" 
                                       value="{{ old('kode_desa') }}" 
                                       placeholder="Contoh: 3171011001">
                                @error('kode_desa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama_desa" class="form-label fw-bold">Nama Desa/Kelurahan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama_desa') is-invalid @enderror" 
                                       id="nama_desa" name="nama_desa" 
                                       value="{{ old('nama_desa') }}" 
                                       placeholder="Contoh: Tebet Timur, Cicendo">
                                @error('nama_desa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="jenis" class="form-label fw-bold">Jenis <span class="text-danger">*</span></label>
                                <select class="form-select @error('jenis') is-invalid @enderror" id="jenis" name="jenis">
                                    <option value="">Pilih Jenis</option>
                                    <option value="Desa" {{ old('jenis') == 'Desa' ? 'selected' : '' }}>Desa</option>
                                    <option value="Kelurahan" {{ old('jenis') == 'Kelurahan' ? 'selected' : '' }}>Kelurahan</option>
                                </select>
                                @error('jenis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="kodepos" class="form-label fw-bold">Kode Pos</label>
                                <input type="text" class="form-control @error('kodepos') is-invalid @enderror" 
                                       id="kodepos" name="kodepos" 
                                       value="{{ old('kodepos') }}" 
                                       placeholder="Contoh: 12820">
                                @error('kodepos')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
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
                            <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" name="deskripsi" rows="3" 
                                      placeholder="Deskripsi tambahan tentang desa/kelurahan">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="reset" class="btn btn-secondary me-md-2">
                                <i class="fas fa-undo me-1"></i> Reset
                            </button>
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
                    <h5 class="mb-0"><i class="fas fa-list me-2"></i>Daftar Desa/Kelurahan</h5>
                </div>
                <div class="card-body p-0">
                    <div id="desa-list-container" style="max-height: 600px; overflow-y: auto;">
                        <div style="padding: 3rem 1rem; text-align: center; color: #6c757d;">
                            <i class="fas fa-inbox fa-2x mb-3" style="display: block;"></i>
                            <p>Pilih Kecamatan untuk melihat data Desa/Kelurahan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Function untuk update list desa saat kecamatan berubah
    document.getElementById('kecamatan_id')?.addEventListener('change', async function() {
        const kecamatanId = this.value;
        const listContainer = document.getElementById('desa-list-container');
        
        if (!kecamatanId) {
            listContainer.innerHTML = `
                <div style="padding: 3rem 1rem; text-align: center; color: #6c757d;">
                    <i class="fas fa-inbox fa-2x mb-3" style="display: block;"></i>
                    <p>Pilih Kecamatan untuk melihat data Desa/Kelurahan</p>
                </div>
            `;
            return;
        }

        try {
            const response = await fetch(`/api/reference/desa/by-kecamatan?parent_id=${kecamatanId}`);
            const data = await response.json();
            
            if (data.length === 0) {
                listContainer.innerHTML = `
                    <div style="padding: 3rem 1rem; text-align: center; color: #6c757d;">
                        <i class="fas fa-inbox fa-2x mb-3" style="display: block;"></i>
                        <p>Belum ada data Desa/Kelurahan untuk kecamatan ini</p>
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
                                <small class="text-muted">Kode: <code>${item.code}</code></small>
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
            console.error('Error fetching desa:', error);
            listContainer.innerHTML = `
                <div style="padding: 3rem 1rem; text-align: center; color: #6c757d;">
                    <i class="fas fa-exclamation-circle fa-2x mb-3" style="display: block; color: #dc3545;"></i>
                    <p>Terjadi kesalahan saat memuat data</p>
                </div>
            `;
        }
    });
</script>

@endsection
@endsection