@extends('admin.layout')

@section('title', 'jangan maless')
@section('content')
@php
    $userRole = Auth::user()->role;
    $isEditable = in_array($userRole, ['admin', 'super admin']);
@endphp

<div class="container-fluid mt-4" data-is-editable="{{ $isEditable ? 'true' : 'false' }}">
    <h2 class="mb-4 fw-bold text-secondary">kalender skejull</h2>

    <div class="row">
        {{-- Sidebar kiri (Hanya tampil untuk Admin/Super Admin) --}}
        @if ($isEditable)
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="fw-semibold mb-3">geser aja</h5>

                    <div id="external-events">
                        <div class="fc-event bg-success text-white p-2 mb-2 rounded" data-color="bg-success">Meeting</div>
                        <div class="fc-event bg-warning text-dark p-2 mb-2 rounded" data-color="bg-warning">Go home</div>
                        <div class="fc-event bg-primary text-white p-2 mb-2 rounded" data-color="bg-primary">wawancara id 8</div>
                        <div class="fc-event bg-info text-white p-2 mb-2 rounded" data-color="bg-info">Test dev id 2</div>
                        <div class="fc-event bg-danger text-white p-2 mb-3 rounded" data-color="bg-danger">olahraga</div>

                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="drop-remove">
                            <label class="form-check-label small" for="drop-remove">remove after drop</label>
                        </div>
                    </div>

                    <h6 class="fw-semibold mt-3 mb-2">Create Event</h6>
                    <div class="mb-2">
                        <span class="btn btn-success p-2 me-1 color-picker" data-color="bg-success"></span>
                        <span class="btn btn-primary p-2 me-1 color-picker" data-color="bg-primary"></span>
                        <span class="btn btn-warning p-2 me-1 color-picker" data-color="bg-warning"></span>
                        <span class="btn btn-danger p-2 me-1 color-picker" data-color="bg-danger"></span>
                        <span class="btn btn-secondary p-2 color-picker" data-color="bg-secondary"></span>
                    </div>

                    <div class="input-group">
                        <input type="text" id="new-event" class="form-control form-control-sm" placeholder="Event Title">
                        <button id="add-event" class="btn btn-primary btn-sm">Add</button>
                    </div>
                </div>
            </div>
        </div>
        @endif

        {{-- Kalender kanan --}}
        <div class="col-md-{{ $isEditable ? '9' : '12' }}">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- FullCalendar CSS & JS --}}
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@6.1.15/index.global.min.js"></script>

{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- 🌈 Custom Style --}}
<style>
    #calendar {
        background: #fdfdfd;
        border-radius: 16px;
        padding: 1rem;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
        font-family: "Poppins", sans-serif;
    }
    .fc-toolbar-title { font-weight: 600; font-size: 1.3rem; color: #444; }
    .fc-button {
        background-color: #eef2f7 !important;
        border: none !important;
        color: #333 !important;
        border-radius: 8px !important;
        transition: all 0.2s ease;
    }
    .fc-button:hover { background-color: #dce3ef !important; }
    .fc-day-today { background-color: #fff7e6 !important; border: 1px solid #ffe7a3 !important; }
    .fc-event {
        border: none !important;
        border-radius: 10px !important;
        padding: 4px 8px !important;
        color: #fff !important;
        transition: all 0.2s ease-in-out;
        font-size: 0.85rem;
    }
    .fc-event:hover { transform: scale(1.03); filter: brightness(1.1); }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const isEditable = document.querySelector('[data-is-editable]').getAttribute('data-is-editable') === 'true';

    // 🟢 Hanya jalankan fitur draggable kalau admin
    let containerEl = document.getElementById('external-events');
    if (isEditable && containerEl) {
        new FullCalendar.Draggable(containerEl, {
            itemSelector: '.fc-event',
            eventData: eventEl => ({
                title: eventEl.innerText.trim(),
                classNames: [eventEl.getAttribute('data-color')]
            })
        });
    }

    // === Inisialisasi Kalender ===
    const calendarEl = document.getElementById('calendar');
    const baseUrl = window.location.pathname.startsWith('/wawancara')
        ? '{{ route("wawancara.jadwal.index.events") }}'
        : '{{ route("admin.calendar.index.events") }}';

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        editable: isEditable,
        droppable: isEditable,
        selectable: isEditable,
        height: 700,
        locale: 'id',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: {
            url: baseUrl,
            method: "GET",
            failure: () => Swal.fire('Gagal!', 'Tidak dapat memuat event dari server.', 'error')
        },
        eventDidMount: info => {
            const pastel = ['#74b9ff','#55efc4','#fab26f','#a29bfe','#ff7675','#81ecec','#fd79a8','#ffeaa7'];
            const color = pastel[Math.floor(Math.random()*pastel.length)];
            info.el.style.backgroundColor = color;
            info.el.style.borderColor = color;
        },
        select: info => {
            if (!isEditable) return;
            Swal.fire({
                title: 'Tambah Jadwal',
                input: 'text',
                inputLabel: 'Masukkan nama kegiatan:',
                showCancelButton: true,
                confirmButtonText: 'Simpan',
                cancelButtonText: 'Batal'
            }).then(result => {
                if (result.isConfirmed && result.value) {
                    fetch("{{ route('admin.calendar.store') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            title: result.value,
                            start: info.startStr,
                            end: info.endStr
                        })
                    })
                    .then(res => res.json())
                    .then(() => {
                        calendar.refetchEvents();
                        Swal.fire('Tersimpan!', 'Jadwal berhasil ditambahkan.', 'success');
                    });
                }
            });
        },
        eventReceive: info => {
            if (!isEditable) return;
            const event = info.event;
            fetch("{{ route('admin.calendar.store') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    title: event.title,
                    start: event.startStr,
                    end: event.endStr,
                    color: event.backgroundColor
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.id) event.setProp('id', data.id);
                Swal.fire('Tersimpan!', 'Event berhasil ditambahkan ke kalender.', 'success');
            });
            if (document.getElementById('drop-remove').checked) {
                info.draggedEl.parentNode.removeChild(info.draggedEl);
            }
        },
        eventDrop: info => {
            if (!isEditable) return;
            fetch("{{ route('admin.calendar.update') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    id: info.event.id,
                    start: info.event.startStr,
                    end: info.event.endStr
                })
            });
        },
        eventClick: info => {
            if (!isEditable) {
                Swal.fire({
                    title: info.event.title,
                    html: `<b>Mulai:</b> ${info.event.start.toLocaleString('id-ID')}<br>
                           <b>Selesai:</b> ${info.event.end ? info.event.end.toLocaleString('id-ID') : 'N/A'}`,
                    icon: 'info'
                });
                return;
            }
            Swal.fire({
                title: 'Hapus Jadwal?',
                text: `Yakin ingin menghapus "${info.event.title}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!'
            }).then(r => {
                if (r.isConfirmed) {
                    fetch("{{ route('admin.calendar.delete') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({ id: info.event.id })
                    })
                    .then(() => {
                        info.event.remove();
                        Swal.fire('Terhapus!', 'Jadwal berhasil dihapus.', 'success');
                    });
                }
            });
        }
    });

    calendar.render();

    // === Tambah Event ke Sidebar TANPA duplikasi ===
    if (isEditable) {
        let currentColor = 'bg-success';
        const colorBtns = document.querySelectorAll('.color-picker');
        colorBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                currentColor = btn.getAttribute('data-color');
            });
        });

        document.getElementById('add-event').addEventListener('click', () => {
            const val = document.getElementById('new-event').value.trim();
            if (!val) return;

            const newEvent = document.createElement('div');
            newEvent.classList.add('fc-event', 'p-2', 'mb-2', 'rounded', currentColor, 'text-white');
            newEvent.innerText = val;
            newEvent.setAttribute('data-color', currentColor);

            containerEl.prepend(newEvent);
            document.getElementById('new-event').value = '';
            Swal.fire('Berhasil!', 'Event baru ditambahkan ke sidebar.', 'success');
        });
    }
});
</script>
@endsection
