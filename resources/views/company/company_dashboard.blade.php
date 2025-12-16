<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Perusahaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --info: #4895ef;
            --warning: #f72585;
            --light: #f8f9fa;
            --dark: #212529;
            --gradient: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
        }
        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .dashboard-container {
            max-width: 1400px;
            margin: auto;
            padding: 20px;
        }
        .dashboard-header {
            background: var(--gradient);
            color: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 10px 20px rgba(67,97,238,0.2);
            position: relative;
        }
        .dashboard-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 300px;
            height: 300px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
        }
        .stat-card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: 0.3s;
        }
        .stat-card:hover { transform: translateY(-5px); }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 15px;
        }
        .loker .stat-icon { background: rgba(67,97,238,0.15); color: var(--primary); }
        .internship .stat-icon { background: rgba(76,201,240,0.15); color: var(--success); }
        .lamaran .stat-icon { background: rgba(247,37,133,0.15); color: var(--warning); }
        .pelamar .stat-icon { background: rgba(72,149,239,0.15); color: var(--info); }

        .stat-number { font-size: 28px; font-weight: 700; }
        .stat-label { color: #6c757d; font-size: 14px; }

        .chart-card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
    </style>
</head>

<body>

@include('partials.navbar_company')

<div class="dashboard-container">

    <!-- Header -->
    <div class="dashboard-header">
        <h1>Dashboard Perusahaan</h1>
        <p>Selamat datang di panel perusahaan Anda</p>
    </div>

    @if(session('login_success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('login_success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Statistik -->
    <div class="row mt-4">
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card loker">
                <div class="card-body">
                    <div class="stat-icon"><i class="fas fa-briefcase"></i></div>
                    <div class="stat-number">{{ $totalJobs }}</div>
                    <div class="stat-label">Total Lowongan Kerja</div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card stat-card internship">
                <div class="card-body">
                    <div class="stat-icon"><i class="fas fa-user-graduate"></i></div>
                    <div class="stat-number">{{ $totalMagangJobs }}</div> <!-- DIUBAH -->
                    <div class="stat-label">Total Lowongan Magang</div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card stat-card lamaran">
                <div class="card-body">
                    <div class="stat-icon"><i class="fas fa-file-alt"></i></div>
                    <div class="stat-number">{{ $totalApplicants }}</div>
                    <div class="stat-label">Lamaran Masuk</div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card stat-card pelamar">
                <div class="card-body">
                    <div class="stat-icon"><i class="fas fa-users"></i></div>
                    <div class="stat-number">{{ $totalUniqueApplicants }}</div> <!-- DIUBAH -->
                    <div class="stat-label">Total Pelamar</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik -->
    <div class="row mt-4">

        <!-- BAR CHART -->
        <div class="col-lg-8">
            <div class="card chart-card">
                <div class="card-header">
                    <h5><i class="fas fa-chart-bar me-2"></i>Statistik Lowongan Kerja & Lowongan Magang per Bulan</h5>
                </div>
                <div class="card-body">
                    <canvas id="barChart" height="120"></canvas>
                </div>
            </div>
        </div>

        <!-- PIE CHART -->
        <div class="col-lg-4">
            <div class="card chart-card">
                <div class="card-header">
                    <h5><i class="fas fa-chart-pie me-2"></i>Distribusi Pelamar</h5>
                </div>
                <div class="card-body">
                    <canvas id="pieChart" height="220"></canvas>
                </div>
            </div>
        </div>

    </div>

</div>

<script>
    // === BAR CHART ===
    const barCtx = document.getElementById('barChart').getContext('2d');
    const chartJobs = @json($chartJobs);
    const chartMagang = @json($chartMagang);

    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
            datasets: [
                {
                    label: 'Total Lowongan kerja ',
                    data: chartJobs,
                    backgroundColor: 'rgba(67, 97, 238, 0.7)',
                    borderRadius: 6
                },
                {
                    label: 'Lowongan Magang',
                    data: chartMagang,
                    backgroundColor: 'rgba(255, 193, 7, 0.8)',
                    borderRadius: 6
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `${context.dataset.label}: ${context.raw} lowongan`;
                        }
                    }
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Bulan'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Jumlah Lowongan'
                    },
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });

    // === PIE CHART ===
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: ['Pelamar Reguler', 'Pelamar Magang'],
            datasets: [{
                data: [{{ $totalApplicants - $totalMagangApplicants }}, {{ $totalMagangApplicants }}],
                backgroundColor: [
                    'rgba(67, 97, 238, 0.8)',
                    'rgba(76, 201, 240, 0.8)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.raw || 0;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = Math.round((value / total) * 100);
                            return `${label}: ${value} pelamar (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });
</script>
<!-- Bootstrap 5 JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>