<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Notifikasi - {{ config('app.name') }}</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .notification-header {
             background: url('/images/Header.png') no-repeat center center;
            background-size: cover;
            padding: 3rem 0;
            min-height: 50px;
            color: #fff;
            display: flex;
            align-items: center;
        }
        .notification-header.dropdown {
  min-height: 50px;
  padding: 0.75rem 1rem;
  background: none;
  color: #333;
  align-items: flex-start;
}
        .notification-card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            overflow: hidden;
        }
        .notification-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-right: 1rem;
        }
        .status-badge {
            font-size: 0.8rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
        }
        .action-btn {
            border-radius: 25px;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .message-box {
            background: #f8f9fa;
            border-left: 4px solid #6c7175;
            padding: 1.5rem;
            border-radius: 8px;
            white-space: pre-line;
        }
        .metadata-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
            color: #6c757d;
        }
        .metadata-item i {
            width: 20px;
            margin-right: 0.5rem;
        }
        .cursor-pointer {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Header -->
    <div class="notification-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb" style="--bs-breadcrumb-divider: '›';">
                            {{-- <li class="breadcrumb-item">
                                <a href="{{ route('home') }}" class="text-white-50">
                                    <i class="fas fa-home"></i> Home
                                </a> --}}
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('notifications.index') }}" class="text-white-50">
                                    <i class="fas fa-bell"></i> Notifikasi
                                </a>
                            </li>
                            <li class="breadcrumb-item active text-white">Detail Notifikasi</li>
                        </ol>
                    </nav>
                    <h1 class="h2 mb-0">
                        <i class="fas fa-eye me-2"></i>Detail Notifikasi
                    </h1>
                </div>
                <div class="col-md-4 text-end">
                    <span class="status-badge bg-{{ $notification->read_at ? 'success' : 'warning' }}">
                        <i class="fas fa-{{ $notification->read_at ? 'check-circle' : 'envelope' }} me-1"></i>
                        {{ $notification->read_at ? 'Sudah Dibaca' : 'Belum Dibaca' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Notification Card -->
                <div class="card notification-card">
                    <div class="card-header bg-white py-3">
                        <div class="d-flex align-items-center">
                            @php
                                $icon = $data['icon'] ?? 'fas fa-bell';
                                $iconColor = $data['icon_color'] ?? 'primary';
                                $iconBg = $data['icon_bg'] ?? '#e3f2fd';
                            @endphp
                            <div class="notification-icon" 
                                 data-icon-bg="{{ $iconBg }}" 
                                 data-icon-color="{{ $iconColor }}">
                                <i class="{{ $icon }}"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="card-title mb-1">
                                    {{ $data['title'] ?? 'Notifikasi' }}
                                </h5>
                                <div class="d-flex flex-wrap gap-2">
                                    @if(isset($data['type']))
                                    <span class="badge bg-info">
                                        <i class="fas fa-tag me-1"></i>{{ $data['type'] }}
                                    </span>
                                    @endif
                                    @if(isset($data['priority']))
                                    <span class="badge bg-{{ $data['priority'] === 'high' ? 'danger' : ($data['priority'] === 'medium' ? 'warning' : 'secondary') }}">
                                        Prioritas: {{ ucfirst($data['priority']) }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- Metadata -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="metadata-item">
                                    <i class="fas fa-clock text-primary"></i>
                                    <strong>Diterima:</strong>
                                    <span class="ms-1">{{ $notification->created_at->translatedFormat('l, d F Y H:i') }}</span>
                                </div>
                                <div class="metadata-item">
                                    <i class="fas fa-history text-info"></i>
                                    <strong>Waktu:</strong>
                                    <span class="ms-1">{{ $notification->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if($notification->read_at)
                                <div class="metadata-item">
                                    <i class="fas fa-check-circle text-success"></i>
                                    <strong>Dibaca:</strong>
                                    <span class="ms-1">{{ $notification->read_at->translatedFormat('d F Y H:i') }}</span>
                                </div>
                                @endif
                                {{-- <div class="metadata-item">
                                    <i class="fas fa-id-badge text-secondary"></i>
                                    <strong>ID:</strong>
                                    <span class="ms-1">{{ $notification->id }}</span>
                                </div> --}}
                            </div>
                        </div>

                        <!-- Message Content -->
                        @if(isset($data['message']))
                        <div class="mb-4">
                            <h6 class="text-muted mb-2">
                                <i class="fas fa-envelope-open-text me-1"></i>Pesan:
                            </h6>
                            <div class="message-box">
                                {!! nl2br(e($data['message'])) !!}
                            </div>
                        </div>
                        @endif

                        <!-- Additional Data -->
                        @if(isset($data['additional_data']) && !empty($data['additional_data']))
                        <div class="mb-4">
                            <h6 class="text-muted mb-2">
                                <i class="fas fa-info-circle me-1"></i>Informasi Tambahan:
                            </h6>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered">
                                    <tbody>
                                        @foreach($data['additional_data'] as $key => $value)
                                        <tr>
                                            <th width="30%" class="bg-light">{{ ucfirst(str_replace('_', ' ', $key)) }}</th>
                                            <td>
                                                @if(is_array($value))
                                                    <pre class="mb-0"><code>{{ json_encode($value, JSON_PRETTY_PRINT) }}</code></pre>
                                                @else
                                                    {{ $value }}
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif

                        <!-- Raw Data (Debug) -->
                        @if(app()->environment('local') && auth()->check() && auth()->user()->is_admin)
                        <div class="mb-4">
                            <details>
                                <summary class="text-muted cursor-pointer">
                                    <i class="fas fa-bug me-1"></i>Debug Information
                                </summary>
                                <div class="mt-2">
                                    <pre class="bg-dark text-light p-3 small rounded"><code>
{{ json_encode([
    'notification_id' => $notification->id,
    'type' => $notification->type,
    'data' => $notification->data,
    'read_at' => $notification->read_at,
    'created_at' => $notification->created_at,
    'updated_at' => $notification->updated_at
], JSON_PRETTY_PRINT) }}
                                    </code></pre>
                                </div>
                            </details>
                        </div>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div class="card-footer bg-white py-3">
                        <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center">
                            <div class="d-flex flex-wrap gap-2">
                                <!-- Back Button -->
                                <a href="{{ route('notifications.index') }}" class="btn btn-outline-secondary action-btn">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali
                                </a>

                                <!-- Mark as Read/Unread Button -->
                                @if(!$notification->read_at)
                                <form action="{{ route('notifications.markRead', $notification->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success action-btn">
                                        <i class="fas fa-check me-2"></i>Tandai Dibaca
                                    </button>
                                </form>
                                @endif

                                 <!-- SweetAlert Delete Button -->
                                <form id="deleteForm" action="{{ route('notifications.delete', $notification->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger action-btn" id="btnDelete">
                                        <i class="fas fa-trash me-2"></i>Hapus
                                    </button>
                                </form>
                            </div>

                            @if(isset($data['action_url']) && $data['action_url'])
                            <div>
                                <a href="{{ $data['action_url'] }}" class="btn btn-primary action-btn">
                                    <i class="fas fa-external-link-alt me-1"></i>
                                    {{ $data['action_text'] ?? 'Lihat Detail' }}
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById('btnDelete').addEventListener('click', function() {
            Swal.fire({
                title: 'Yakin hapus notifikasi ini?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('deleteForm');
                    fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: new URLSearchParams({ '_method': 'DELETE' })
                    })
                    .then(response => {
                        if (response.ok) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Notifikasi berhasil dihapus.',
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.href = "{{ route('notifications.my') }}";
                            });
                        } else {
                            Swal.fire('Gagal', 'Terjadi kesalahan saat menghapus.', 'error');
                        }
                    })
                    .catch(() => {
                        Swal.fire('Error', 'Koneksi ke server gagal.', 'error');
                    });
                }
            });

            // Apply styles from data attributes to notification icons
            var notificationIcons = document.querySelectorAll('.notification-icon[data-icon-bg]');
            notificationIcons.forEach(function(icon) {
                var bgColor = icon.getAttribute('data-icon-bg');
                var textColor = icon.getAttribute('data-icon-color');
                if (bgColor) {
                    icon.style.backgroundColor = bgColor;
                }
                if (textColor) {
                    icon.style.color = textColor;
                }
            });
        });
    </script>
</body>
</html>