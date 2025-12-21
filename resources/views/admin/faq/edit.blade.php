@extends('admin.layout')

@section('title', 'Edit FAQ')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit FAQ</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.faq.update', $faq->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="question">Pertanyaan *</label>
                <input type="text" class="form-control @error('question') is-invalid @enderror"
                       id="question" name="question"
                       value="{{ old('question', $faq->question) }}" required>
                @error('question')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="answer">Jawaban *</label>
                <textarea class="form-control @error('answer') is-invalid @enderror"
                          id="answer" name="answer" rows="6" required>{{ old('answer', $faq->answer) }}</textarea>
                @error('answer')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="is_active">Status *</label>
                <select class="form-control @error('is_active') is-invalid @enderror"
                        id="is_active" name="is_active" required>
                    <option value="aktif" {{ (old('is_active') == 'aktif' || $faq->is_active) ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ (old('is_active') == 'nonaktif' || !$faq->is_active) ? 'selected' : '' }}>Nonaktif</option>
                </select>
                @error('is_active')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <small class="text-muted">
                    <strong>Aktif:</strong> FAQ akan ditampilkan di halaman utama (publik)<br>
                    <strong>Nonaktif:</strong> FAQ hanya akan ditampilkan di panel admin
                </small>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Perbarui
                </button>
                <a href="{{ route('admin.faq.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
