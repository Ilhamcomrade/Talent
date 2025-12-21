@extends('admin.layout')

@section('title', 'Kategori Pekerjaan')
@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Manajemen Kategori Pekerjaan</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tombol tambah parent (modal) --}}
    <div class="mb-3">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addParentModal">
            + Tambah Parent
        </button>

        {{-- Tombol tambah kategori/subkategori --}}
        <a href="{{ route('admin.job-categories.create') }}" class="btn btn-primary">
            + Tambah Kategori/Subkategori
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            @if ($categories->isEmpty())
                <p class="text-muted">Belum ada kategori.</p>
            @else
                <ul class="list-group">
                    @foreach($categories as $parent)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <strong>{{ $parent->name }}</strong>

                                <div>
                                    {{-- Tombol edit parent (modal) --}}
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#editParentModal{{ $parent->id }}">
                                        Edit
                                    </button>

                                    <form class="d-inline" method="POST" action="{{ route('admin.job-categories.destroy', $parent->id) }}">
                                        @csrf @method('DELETE')
                                        <button onclick="return confirm('Hapus kategori ini?')" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>

                            {{-- CHILD --}}
                            @if($parent->children->count())
                                <ul class="mt-2">
                                    @foreach($parent->children as $child)
                                        <li class="d-flex justify-content-between">
                                            {{ $child->name }}

                                            <div>
                                                <a href="{{ route('admin.job-categories.edit', $child->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                <form class="d-inline" method="POST" action="{{ route('admin.job-categories.destroy', $child->id) }}">
                                                    @csrf @method('DELETE')
                                                    <button onclick="return confirm('Hapus subkategori ini?')" class="btn btn-sm btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>

                        {{-- MODAL EDIT PARENT --}}
                        <div class="modal fade" id="editParentModal{{ $parent->id }}" tabindex="-1" aria-labelledby="editParentModalLabel{{ $parent->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('admin.job-categories.update', $parent->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editParentModalLabel{{ $parent->id }}">Edit Parent</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Nama Kategori Parent</label>
                                                <input type="text" name="name" class="form-control" value="{{ $parent->name }}" required>
                                            </div>

                                            {{-- Parent_id harus tetap null --}}
                                            <input type="hidden" name="parent_id" value="">
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Simpan</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>

{{-- MODAL TAMBAH PARENT --}}
<div class="modal fade" id="addParentModal" tabindex="-1" aria-labelledby="addParentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.job-categories.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addParentModalLabel">Tambah Parent</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Kategori Parent</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    {{-- Parent_id harus null --}}
                    <input type="hidden" name="parent_id" value="">
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Autofocus input saat modal muncul
    var addParentModal = document.getElementById('addParentModal')
    addParentModal.addEventListener('shown.bs.modal', function () {
        addParentModal.querySelector('input[name="name"]').focus()
    })

    // Autofocus untuk setiap edit parent modal
    document.querySelectorAll('[id^=editParentModal]').forEach(function(modal) {
        modal.addEventListener('shown.bs.modal', function () {
            modal.querySelector('input[name="name"]').focus()
        })
    })
</script>
@endsection
