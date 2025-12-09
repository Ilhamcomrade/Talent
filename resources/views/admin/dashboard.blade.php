@extends('admin.layout')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

    body {
        font-family: 'Inter', sans-serif;
        background-color: #f8f9fc;
        color: #333;
    }

    .dashboard-header {
        text-align: center;
        margin-bottom: 2rem;
        position: relative;
    }

    .dashboard-title {
        display: inline-block;
        position: relative;
        font-weight: 700;
        color: #51a2f3ff;
        font-size: 1.8rem;
        padding-bottom: 8px;
    }

    .dashboard-title::after {
        content: "";
        position: absolute;
        left: 50%;
        bottom: 0;
        transform: translateX(-50%);
        height: 4px;
        width: 180px;
        border-radius: 3px;
        background: linear-gradient(90deg, red, orange, yellow, green, cyan, blue, violet);
        background-size: 400%;
        animation: lineFlow 5s linear infinite;
    }

    @keyframes lineFlow {
        0% { background-position: 0% 50%; }
        100% { background-position: 400% 50%; }
    }

    /* KPI CARD */
    .kpi-card {
        border-radius: 12px !important;
        overflow: hidden;
        transition: all 0.3s ease;
        border: none;
        color: #fff !important;
        min-height: 100px;
        background: linear-gradient(270deg, #ff3c3c, #ff9f0a, #28a745, #007bff, #6610f2);
        background-size: 600% 600%;
        animation: colorShift 10s ease infinite;
    }

    @keyframes colorShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .kpi-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.15);
    }

    .kpi-card .card-body {
        padding: 0.8rem 1rem;
    }

    .kpi-card h3 {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 3px;
    }

    .kpi-card p {
        font-size: 0.9rem;
        margin-bottom: 0;
        opacity: 0.9;
    }

    .card-footer {
        background: rgba(255, 255, 255, 0.2);
        border-top: none;
        padding: 0.5rem 1rem;
        text-align: right;
    }

    .card-footer a {
        color: #fff;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        text-decoration: none;
        transition: 0.3s;
    }

    .card-footer a:hover {
        text-decoration: underline;
    }

    /* Chart Box */
    .chart-box {
        background: #fff;
        border-radius: 12px;
        padding: 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        min-height: 200px;
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .chart-box h6 {
        font-weight: 700;
        color: #495057;
        font-size: 0.9rem;
        margin-bottom: 10px;
    }

    /* Custom KPI Colors */
    .kpi-card-pemagang {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        animation: none !important;
    }

    .kpi-card-campus {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%) !important;
        animation: none !important;
    }

    .kpi-card-pemagang:hover, .kpi-card-campus:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.15);
    }
</style>

<div class="container-fluid">
    <div class="dashboard-header">
        <h2 class="dashboard-title">Dashboard</h2>
    </div>

    {{-- KPI Boxes --}}
    <div class="row text-center mb-4">
        <div class="col-md-2 mb-3">
            <div class="card kpi-card">
                <div class="card-body">
                    <h3>{{ $activeJobsCount }}</h3>
                    <p>Lowongan Aktif</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.job_listings.index') }}">Lihat Detail</a>
                </div>
            </div>
        </div>

        <div class="col-md-2 mb-3">
            <div class="card kpi-card">
                <div class="card-body">
                    <h3>{{ $newApplicationsCount }}</h3>
                    <p>Kandidat</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.applicants.index') }}">Lihat Detail</a>
                </div>
            </div>
        </div>

        <div class="col-md-2 mb-3">
            <div class="card kpi-card">
                <div class="card-body">
                    <h3>{{ $companiesCount }}</h3>
                    <p>Perusahaan</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.companies.index') }}">Lihat Detail</a>
                </div>
            </div>
        </div>

        <div class="col-md-2 mb-3">
            <div class="card kpi-card">
                <div class="card-body">
                    <h3>{{ $totalUsersCount }}</h3>
                    <p>Total Pengguna</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.users.index') }}">Lihat Detail</a>
                </div>
            </div>
        </div>

        {{-- KPI Box Baru: Total Pemagang --}}
        <div class="col-md-2 mb-3">
            <div class="card kpi-card kpi-card-pemagang">
                <div class="card-body">
                    <h3>156</h3>
                    <p>Total Pemagang</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.magang.index') }}">Lihat Detail</a>
                </div>
            </div>
        </div>

       {{-- KPI Box Baru: Total Campus --}}
        <div class="col-md-2 mb-3">
            <div class="card kpi-card kpi-card-campus">
                <div class="card-body">
                    <h3>{{ $totalCampusesCount }}</h3>
                    <p>Total Campus</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.dashboard') }}">Lihat Detail</a>
                </div>
            </div>
        </div>

    {{-- Inline Charts di bawah KPI --}}
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="chart-box">
                <h6 class="text-center">Distribusi Peran Pengguna</h6>
                <canvas id="userRoleChart" style="max-height:160px;"></canvas>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="chart-box">
                <h6 class="text-center">Lowongan Berdasarkan Lokasi</h6>
                <canvas id="lokasiChart" style="max-height:160px;"></canvas>
            </div>
        </div>
    </div>

    {{-- Chart Baru: Statistik Pemagang & Campus --}}
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="chart-box">
                <h6 class="text-center">Status Pemagang</h6>
                <canvas id="internStatusChart" style="max-height:160px;"></canvas>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="chart-box">
                <h6 class="text-center">Distribusi Campus</h6>
                <canvas id="campusDistributionChart" style="max-height:160px;"></canvas>
            </div>
        </div>
    </div>
</div>

{{-- CHART SCRIPT --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

{{-- === DATA UNTUK JAVASCRIPT === --}}
{{-- Editor akan mengabaikan script type="application/json" ini --}}
<script id="chart-data" type="application/json">
    {
        "userRoleLabels": @json($userRoles->keys()),
        "userRoleData": @json($userRoles->values()),
        "lokasiLabels": @json($lokasiStats->keys()),
        "lokasiData": @json($lokasiStats->values())
    }
</script>

<script>
    // Ambil data dari tag script type="application/json" dan parse sebagai JSON
    const chartDataElement = document.getElementById('chart-data');
    const appChartData = JSON.parse(chartDataElement.textContent);

    Chart.defaults.font.family = "'Inter', sans-serif";
    Chart.defaults.color = '#6c757d';

    // Chart 1: Distribusi Role Pengguna
    const userRoleCtx = document.getElementById('userRoleChart');
    if (userRoleCtx) {
        new Chart(userRoleCtx, {
            type: 'pie',
            data: {
                labels: appChartData.userRoleLabels, 
                datasets: [{
                    label: 'Jumlah User',
                    data: appChartData.userRoleData, 
                    backgroundColor: [
                        'rgb(0,123,255)',
                        'rgb(40,167,69)',
                        'rgb(255,193,7)',
                        'rgb(220,53,69)',
                        'rgb(111,66,193)'
                    ],
                    hoverOffset: 6
                }]
            },
            options: {
                plugins: { legend: { position: 'bottom', labels: { boxWidth: 14 } } }
            }
        });
    }

    // Chart 2: Lowongan Berdasarkan Lokasi
    const lokasiCtx = document.getElementById('lokasiChart');
    if (lokasiCtx) {
        new Chart(lokasiCtx, {
            type: 'bar',
            data: {
                labels: appChartData.lokasiLabels, 
                datasets: [{
                    label: 'Jumlah Lowongan',
                    data: appChartData.lokasiData, 
                    backgroundColor: 'rgba(23,162,184,0.8)',
                    borderColor: 'rgb(23,162,184)',
                    borderWidth: 1,
                    borderRadius: 4
                }]
            },
            options: {
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1 } },
                    x: { grid: { display: false } }
                }
            }
        });
    }

    // Chart 3: Status Pemagang (Dummy Data)
    const internStatusCtx = document.getElementById('internStatusChart');
    if (internStatusCtx) {
        new Chart(internStatusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Aktif', 'Selesai', 'Ditolak', 'Menunggu'],
                datasets: [{
                    label: 'Jumlah Pemagang',
                    data: [89, 45, 12, 10],
                    backgroundColor: [
                        'rgb(40,167,69)',
                        'rgb(0,123,255)',
                        'rgb(220,53,69)',
                        'rgb(255,193,7)'
                    ],
                    hoverOffset: 8
                }]
            },
            options: {
                plugins: { 
                    legend: { 
                        position: 'bottom', 
                        labels: { boxWidth: 14 } 
                    } 
                }
            }
        });
    }

    // Chart 4: Distribusi Campus (Dummy Data)
    const campusDistributionCtx = document.getElementById('campusDistributionChart');
    if (campusDistributionCtx) {
        new Chart(campusDistributionCtx, {
            type: 'bar',
            data: {
                labels: ['Universitas', 'Politeknik', 'Sekolah Tinggi', 'Akademi', 'Institut'],
                datasets: [{
                    label: 'Jumlah Campus',
                    data: [18, 12, 7, 3, 2],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 206, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(153, 102, 255)'
                    ],
                    borderWidth: 1,
                    borderRadius: 6
                }]
            },
            options: {
                plugins: { legend: { display: false } },
                scales: {
                    y: { 
                        beginAtZero: true, 
                        ticks: { stepSize: 5 },
                        title: {
                            display: true,
                            text: 'Jumlah Campus'
                        }
                    },
                    x: { 
                        grid: { display: false },
                        title: {
                            display: true,
                            text: 'Jenis Institusi'
                        }
                    }
                }
            }
        });
    }
</script>
@endsection
