@extends('admin.layout')

@section('title', 'Edit Desa/Kelurahan')
@section('content')

<style>
    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
    
    .card-header {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
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
                        <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Desa/Kelurahan</h4>
                        <a href="{{ route('admin.reference.desa.index') }}" class="btn btn-back">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.reference.desa.update', $desa->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="kecamatan_id" class="form-label fw-bold">Kecamatan <span class="text-danger">*</span></label>
                                <select class="form-select @error('kecamatan_id') is-invalid @enderror" id="kecamatan_id" name="kecamatan_id">
                                    <option value="">Pilih Kecamatan</option>
                                    @foreach($kecamatans as $kecamatan)
                                        <option value="{{ $kecamatan->id }}" {{ old('kecamatan_id', $desa->kecamatan_id) == $kecamatan->id ? 'selected' : '' }}>
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
                                       value="{{ old('kode_desa', $desa->kode_desa) }}">
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
                                       value="{{ old('nama_desa', $desa->nama_desa) }}">
                                @error('nama_desa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="jenis" class="form-label fw-bold">Jenis <span class="text-danger">*</span></label>
                                <select class="form-select @error('jenis') is-invalid @enderror" id="jenis" name="jenis">
                                    <option value="">Pilih Jenis</option>
                                    <option value="Desa" {{ old('jenis', $desa->jenis) == 'Desa' ? 'selected' : '' }}>Desa</option>
                                    <option value="Kelurahan" {{ old('jenis', $desa->jenis) == 'Kelurahan' ? 'selected' : '' }}>Kelurahan</option>
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
                                       value="{{ old('kodepos', $desa->kodepos) }}">
                                @error('kodepos')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                    <option value="">Pilih Status</option>
                                    <option value="1" {{ old('status', $desa->status) == '1' ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ old('status', $desa->status) == '0' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $desa->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('admin.reference.desa.index') }}" class="btn btn-secondary me-md-2">
                                <i class="fas fa-times me-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Update
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
                    <div style="max-height: 600px; overflow-y: auto;">
                        @forelse($desas ?? [] as $des)
                            <div style="padding: 0.75rem 1rem; border-bottom: 1px solid #e9ecef; cursor: pointer; transition: background-color 0.2s;{{ $des->id == $desa->id ? ' background-color: #fff3cd;' : '' }}" 
                                 onmouseover="this.style.backgroundColor='#f8f9fa'" onmouseout="this.style.backgroundColor='{{ $des->id == $desa->id ? '#fff3cd' : 'white' }}'">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="fw-bold">{{ $des->nama_desa }}</div>
                                        <small class="text-muted">Kode: <code>{{ $des->kode_desa }}</code></small>
                                    </div>
                                    <span class="badge {{ $des->status == 1 ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $des->status == 1 ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div style="padding: 3rem 1rem; text-align: center; color: #6c757d;">
                                <i class="fas fa-inbox fa-2x mb-3" style="display: block;"></i>
                                <p>Belum ada data desa/kelurahan</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection