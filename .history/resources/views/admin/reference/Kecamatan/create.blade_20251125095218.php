@extends('admin.layout')

@section('title', 'Tambah Kecamatan')
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
                        <h4 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Tambah Kecamatan</h4>
                        <a href="{{ route('admin.reference.kecamatan.index') }}" class="btn btn-back">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.reference.kecamatan.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="kabupaten_id" class="form-label fw-bold">Kabupaten/Kota <span class="text-danger">*</span></label>
                                <select class="form-select @error('kabupaten_id') is-invalid @enderror" id="kabupaten_id" name="kabupaten_id">
                                    <option value="">Pilih Kabupaten/Kota</option>
                                    @foreach($kabupatens as $kabupaten)
                                        <option value="{{ $kabupaten->id }}" {{ old('kabupaten_id') == $kabupaten->id ? 'selected' : '' }}>
                                            {{ $kabupaten->nama_kabupaten }} - {{ $kabupaten->provinsi->nama_provinsi }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kabupaten_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="kode_kecamatan" class="form-label fw-bold">Kode Kecamatan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('kode_kecamatan') is-invalid @enderror" 
                                       id="kode_kecamatan" name="kode_kecamatan" 
                                       value="{{ old('kode_kecamatan') }}" 
                                       placeholder="Contoh: 317101, 327301">
                                @error('kode_kecamatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama_kecamatan" class="form-label fw-bold">Nama Kecamatan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama_kecamatan') is-invalid @enderror" 
                                       id="nama_kecamatan" name="nama_kecamatan" 
                                       value="{{ old('nama_kecamatan') }}" 
                                       placeholder="Contoh: Tebet, Cicendo">
                                @error('nama_kecamatan')
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
                                      placeholder="Deskripsi tambahan tentang kecamatan">{{ old('deskripsi') }}</textarea>
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
                    <h5 class="mb-0"><i class="fas fa-list me-2"></i>Daftar Kecamatan</h5>
                </div>
                <div class="card-body p-0">
                    <div style="max-height: 600px; overflow-y: auto;">
                        @forelse($kecamatans ?? [] as $kec)
                            <div style="padding: 0.75rem 1rem; border-bottom: 1px solid #e9ecef; cursor: pointer; transition: background-color 0.2s;" 
                                 onmouseover="this.style.backgroundColor='#f8f9fa'" onmouseout="this.style.backgroundColor='white'">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="fw-bold">{{ $kec->nama_kecamatan }}</div>
                                        <small class="text-muted">Kode: <code>{{ $kec->kode_kecamatan }}</code></small>
                                    </div>
                                    <span class="badge {{ $kec->status == 1 ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $kec->status == 1 ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div style="padding: 3rem 1rem; text-align: center; color: #6c757d;">
                                <i class="fas fa-inbox fa-2x mb-3" style="display: block;"></i>
                                <p>Belum ada data kecamatan</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection