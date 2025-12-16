@extends('admin.layout')

@section('title', 'Kalender & Jadwal')
@section('content')

<div class="container-fluid mt-4">
    <h2 class="mb-4 fw-bold text-secondary">Kalender Jadwal</h2>

    {{-- Redirect ke halaman calendar yang sebenarnya --}}
    <div class="alert alert-info">
        <p>Halaman Kalender sedang dimuat. Silakan tunggu...</p>
    </div>

    {{-- Script untuk redirect otomatis --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.location.href = "{{ route('admin.calendar.index') }}";
        });
    </script>
</div>

@endsection
