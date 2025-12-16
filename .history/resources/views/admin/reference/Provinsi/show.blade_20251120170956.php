@extends('admin.layout')

@section('title', 'Detail Provinsi')
@section('content')

<style>
    .detail-container {
        max-width: 800px;
        margin: 0 auto;
    }
    
    .detail-header {
        border-bottom: 2px solid #0d6efd;
        padding-bottom: 15px;
        margin-bottom: 20px;
    }
    
    .detail-card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        padding: 20px;
        margin-bottom: 20px;
    }
    
    .detail-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }
    
    .detail-item {
        padding: 8px 0;
    }
    
    .detail-label {
        font-weight: 600;
        color: #495057;
        font-size: 12px;
        margin-bottom: 2px;
    }
    
    .detail-value {
        color: #212529;
        font-size: 14px;
    }
    
    .back-btn {
        background: #6c757d;
        border: none;
        padding: 6px 15px;
        font-size: 12px;
    }
</style>

<div class="container mt-3">
    <div class="detail-container">
        <!-- Header dengan tombol back di kiri -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('admin.reference.provinsi.index') }}" class="btn btn-secondary back-btn">
                <i class="fas fa-arrow-left me-1"></i>Kembali
            </a>
            <div class="text-end">
                <h5 class="mb-0">Detail Provinsi</h5>
                <small class="text-muted">Informasi data provinsi</small>
            </div>
        </div>

        <!-- Card Detail - HANYA VIEW DATA -->
        <div class="detail-card">
            <div class="detail-header">
                <h6 class="mb-0 text-primary">
                    <i class="fas fa-map-marked-alt me-2"></i>
                    {{ $provinsi->name }}
                </h6>
            </div>
            
            <!-- Grid informasi -->
            <div class="detail-grid">
                <div class="detail-item">
                    <div class="detail-label">ID PROVINSI</div>
                    <div class="detail-value">{{ $provinsi->id }}</div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-label">NAMA PROVINSI</div>
                    <div class="detail-value">{{ $provinsi->name }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection