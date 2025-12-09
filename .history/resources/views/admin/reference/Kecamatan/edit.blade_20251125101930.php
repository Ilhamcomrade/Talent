@extends('admin.layout')

@section('title', 'Edit Kecamatan')
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
                        <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Kecamatan</h4>
                        <a href="{{ route('admin.reference.kecamatan.index') }}" class="btn btn-back">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.reference.kecamatan.update', $kecamatan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="kabupaten_id" class="form-label fw-bold">Kabupaten/Kota <span class="text-danger">*</span></label>
                                <select class="form-select @error('kabupaten_id') is-invalid @enderror" id="kabupaten_id" name="kabupaten_id">
                                    <option value="">Pilih Kabupaten/Kota</option>
                                    @foreach($kabupatens as $kabupaten)
                                        <option value="{{ $kabupaten->id }}" {{ old('kabupaten_id', $kecamatan->kabupaten_id) == $kabupaten->id ? 'selected' : '' }}>
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
                                       value="{{ old('kode_kecamatan', $kecamatan->kode_kecamatan) }}">
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
                                       value="{{ old('nama_kecamatan', $kecamatan->nama_kecamatan) }}">
                                @error('nama_kecamatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                    <option value="">Pilih Status</option>
                                    <option value="1" {{ old('status', $kecamatan->status) == '1' ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ old('status', $kecamatan->status) == '0' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $kecamatan->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('admin.reference.kecamatan.index') }}" class="btn btn-secondary me-md-2">
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
    </div>
</div>

@endsection