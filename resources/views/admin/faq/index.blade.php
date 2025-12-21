@extends('admin.layout')

@section('title', 'Manajemen FAQ')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar FAQ</h3>
        <div class="card-tools">
            <a href="{{ route('admin.faq.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah FAQ
            </a>
        </div>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 5%">No</th>
                    <th style="width: 35%">Pertanyaan</th>
                    <th style="width: 40%">Jawaban</th>
                    <th style="width: 8%">Status</th>
                    <th style="width: 12%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($faqs as $index => $faq)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ Str::limit($faq->question, 60) }}</td>
                    <td>{{ Str::limit(strip_tags($faq->answer), 80) }}</td>
                    <td class="text-center">
                        @if($faq->is_active)
                            <span class="badge bg-success" style="padding: 5px 10px; font-size: 12px;">Aktif</span>
                        @else
                            <span class="badge bg-danger" style="padding: 5px 10px; font-size: 12px;">Nonaktif</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex justify-content-between" style="gap: 8px;">
                            <a href="{{ route('admin.faq.edit', $faq->id) }}" class="btn btn-sm btn-warning" title="Edit" style="flex: 1; padding: 4px 8px; font-size: 12px;">
                                Edit
                            </a>
                            <form action="{{ route('admin.faq.destroy', $faq->id) }}" method="POST" style="flex: 1; margin: 0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger w-100"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus FAQ ini?')"
                                        title="Hapus"
                                        style="padding: 4px 8px; font-size: 12px;">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
    .table th, .table td {
        vertical-align: middle;
    }

    .btn-sm {
        min-width: 50px;
    }
</style>
@endsection
