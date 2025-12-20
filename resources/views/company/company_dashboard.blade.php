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
            --danger: #ef476f;
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
            padding: 15px 20px;
        }
        
        .dashboard-header {
            background: var(--gradient);
            color: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 5px 15px rgba(67,97,238,0.15);
        }
        
        .stat-card {
            border-radius: 10px;
            border: none;
            box-shadow: 0 3px 10px rgba(0,0,0,0.06);
            transition: all 0.2s ease;
            height: 100%;
            padding: 15px;
        }
        
        .stat-card:hover { 
            transform: translateY(-3px); 
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            margin-bottom: 10px;
        }
        
        .loker .stat-icon { 
            background: rgba(67,97,238,0.12); 
            color: var(--primary); 
        }
        
        .internship .stat-icon { 
            background: rgba(76,201,240,0.12); 
            color: var(--success); 
        }
        
        .lamaran .stat-icon { 
            background: rgba(247,37,133,0.12); 
            color: var(--warning); 
        }
        
        .pelamar .stat-icon { 
            background: rgba(72,149,239,0.12); 
            color: var(--info); 
        }
        
        .stat-number { 
            font-size: 24px; 
            font-weight: 700; 
            color: #2c3e50;
            margin-bottom: 2px;
        }
        
        .stat-label { 
            color: #6c757d; 
            font-size: 12px;
            font-weight: 500;
        }
        
        .stat-badge {
            font-size: 10px;
            padding: 3px 8px;
            margin-top: 5px;
        }
        
        .chart-card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 3px 10px rgba(0,0,0,0.06);
            height: 100%;
            margin-top: 15px;
        }
        
        .chart-card .card-header {
            background: white;
            border-bottom: 1px solid rgba(0,0,0,0.08);
            border-radius: 12px 12px 0 0 !important;
            padding: 1rem 1.25rem;
        }
        
        .chart-card .card-header h5 {
            margin: 0;
            font-weight: 600;
            color: #343a40;
            font-size: 15px;
        }
        
        .chart-container {
            position: relative;
            height: 250px;
            width: 100%;
        }
        
        .month-selector {
            background: white;
            border-radius: 6px;
            padding: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.04);
        }
        
        .month-selector select {
            border: 1px solid #dee2e6;
            border-radius: 6px;
            padding: 5px 10px;
            width: 100%;
            font-size: 13px;
        }
        
        .quick-actions {
            margin-top: 20px;
        }
        
        .action-card {
            background: white;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            transition: all 0.2s ease;
            border: 1px solid rgba(0,0,0,0.05);
            height: 100%;
        }
        
        .action-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
            border-color: var(--primary);
        }
        
        .action-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            margin: 0 auto 10px;
            background: rgba(67,97,238,0.1);
            color: var(--primary);
        }
        
        .action-card h6 {
            font-size: 13px;
            margin-bottom: 5px;
        }
        
        .action-card small {
            font-size: 11px;
        }
        
        /* Styling untuk chart summary boxes */
        .chart-summary-box {
            padding: 10px;
            border-radius: 8px;
            text-align: center;
            border: 1px solid rgba(0,0,0,0.08);
        }
        
        .chart-summary-box .value {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 2px;
        }
        
        .chart-summary-box .label {
            font-size: 11px;
            color: #6c757d;
        }
    </style>
</head>

<body>

@include('partials.navbar_company')

<div class="dashboard-container">

    <!-- Header -->
    <div class="dashboard-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-1 fw-bold">Dashboard Perusahaan</h4>
                <p class="mb-0 opacity-90">Selamat datang di panel perusahaan Anda</p>
            </div>
            <div class="d-none d-md-block">
                <span class="badge bg-light text-primary px-3 py-1" style="font-size: 12px">
                    <i class="fas fa-calendar-alt me-1"></i>
                    <?php echo date('d F Y'); ?>
                </span>
            </div>
        </div>
    </div>

    @if(session('login_success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center py-2" role="alert" style="font-size: 14px">
            <i class="fas fa-check-circle me-2 fs-6"></i>
            <div class="flex-grow-1">{{ session('login_success') }}</div>
            <button type="button" class="btn-close" style="font-size: 10px" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Statistik KPI (Lebih Kecil) -->
    <div class="row g-3">
        <div class="col-xl-3 col-md-6">
            <div class="stat-card loker">
                <div class="d-flex align-items-center">
                    <div class="stat-icon me-3">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="stat-number">{{ $totalJobs }}</div>
                        <div class="stat-label">Lowongan Kerja</div>
                        <div class="stat-badge badge bg-primary bg-opacity-10 text-primary d-inline-block">
                            {{ $chartJobs[date('n')-1] ?? 0 }} bulan ini
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stat-card internship">
                <div class="d-flex align-items-center">
                    <div class="stat-icon me-3">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="stat-number">{{ $totalMagangJobs }}</div>
                        <div class="stat-label">Lowongan Magang</div>
                        <div class="stat-badge badge bg-success bg-opacity-10 text-success d-inline-block">
                            {{ $chartMagang[date('n')-1] ?? 0 }} bulan ini
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stat-card lamaran">
                <div class="d-flex align-items-center">
                    <div class="stat-icon me-3">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="stat-number">{{ $totalApplicants }}</div>
                        <div class="stat-label">Lamaran Masuk</div>
                        <div class="mt-1">
                            <small class="text-muted" style="font-size: 11px">
                                <i class="fas fa-user me-1"></i> {{ $totalUniqueApplicants }} pelamar unik
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stat-card pelamar">
                <div class="d-flex align-items-center">
                    <div class="stat-icon me-3">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="stat-number">{{ $totalUniqueApplicants }}</div>
                        <div class="stat-label">Pelamar Unik</div>
                        <div class="mt-1">
                            <small class="text-muted" style="font-size: 11px">
                                <i class="fas fa-graduation-cap me-1"></i> {{ $totalMagangApplicants }} magang
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik (Lebih Ke Atas) -->
    <div class="row g-3 mt-0">
        <!-- BAR CHART -->
        <div class="col-lg-8">
            <div class="chart-card">
                <div class="card-header d-flex justify-content-between align-items-center py-2">
                    <h5><i class="fas fa-chart-bar me-2"></i>Statistik Lowongan per Bulan</h5>
                    <div class="month-selector">
                        <select class="form-select form-select-sm" id="yearFilter" style="font-size: 12px">
                            <option value="2024" selected>2024</option>
                            <option value="2023">2023</option>
                        </select>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="chart-container">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- PIE CHART -->
        <div class="col-lg-4">
            <div class="chart-card">
                <div class="card-header py-2">
                    <h5><i class="fas fa-chart-pie me-2"></i>Distribusi Pelamar</h5>
                </div>
                <div class="card-body p-3">
                    <div class="chart-container">
                        <canvas id="pieChart"></canvas>
                    </div>
                    <div class="row g-2 mt-3">
                        <div class="col-6">
                            <div class="chart-summary-box">
                                <div class="value text-primary">{{ $totalApplicants - $totalMagangApplicants }}</div>
                                <div class="label">Pelamar Reguler</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="chart-summary-box">
                                <div class="value text-success">{{ $totalMagangApplicants }}</div>
                                <div class="label">Pelamar Magang</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row quick-actions g-2">
        <div class="col-12">
            <div class="chart-card">
                <div class="card-header py-2">
                    <h5><i class="fas fa-bolt me-2"></i>Aksi Cepat</h5>
                </div>
                <div class="card-body p-3">
                    <div class="row g-2">
                        <div class="col-md-3 col-6">
                            <a href="{{ route('company.magang.create') }}" class="text-decoration-none">
                                <div class="action-card">
                                    <div class="action-icon">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                    <h6 class="fw-bold mb-1">Buat Magang</h6>
                                    <small>Tambah lowongan magang</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-6">
                            <a href="{{ route('companiesjobs.create') }}" class="text-decoration-none">
                                <div class="action-card">
                                    <div class="action-icon">
                                        <i class="fas fa-briefcase"></i>
                                    </div>
                                    <h6 class="fw-bold mb-1">Buat Lowongan</h6>
                                    <small>Tambah lowongan kerja</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-6">
                            <a href="#" class="text-decoration-none">
                                <div class="action-card">
                                    <div class="action-icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <h6 class="fw-bold mb-1">Lihat Pelamar</h6>
                                    <small>Kelola lamaran masuk</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-6">
                            <a href="#" class="text-decoration-none">
                                <div class="action-card">
                                    <div class="action-icon">
                                        <i class="fas fa-chart-line"></i>
                                    </div>
                                    <h6 class="fw-bold mb-1">Laporan</h6>
                                    <small>Lihat statistik lengkap</small>
                                </div>
                            </a>
                        </div>
                    </div>
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
    
    const barChart = new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [
                {
                    label: 'Lowongan Kerja',
                    data: chartJobs,
                    backgroundColor: 'rgba(67, 97, 238, 0.8)',
                    borderColor: 'rgba(67, 97, 238, 1)',
                    borderWidth: 1,
                    borderRadius: 4,
                    borderSkipped: false,
                },
                {
                    label: 'Lowongan Magang',
                    data: chartMagang,
                    backgroundColor: 'rgba(76, 201, 240, 0.8)',
                    borderColor: 'rgba(76, 201, 240, 1)',
                    borderWidth: 1,
                    borderRadius: 4,
                    borderSkipped: false,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        padding: 15,
                        usePointStyle: true,
                        pointStyle: 'circle',
                        font: {
                            size: 11
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    padding: 10,
                    cornerRadius: 5,
                    displayColors: true,
                    titleFont: {
                        size: 11
                    },
                    bodyFont: {
                        size: 11
                    },
                    callbacks: {
                        label: function(context) {
                            return `${context.dataset.label}: ${context.parsed.y} lowongan`;
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 10
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.04)'
                    },
                    ticks: {
                        stepSize: 1,
                        font: {
                            size: 10
                        },
                        callback: function(value) {
                            return value;
                        }
                    }
                }
            }
        }
    });

    // === PIE CHART ===
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    const regularApplicants = {{ $totalApplicants - $totalMagangApplicants }};
    const magangApplicants = {{ $totalMagangApplicants }};
    const totalApplicants = regularApplicants + magangApplicants;
    
    const pieChart = new Chart(pieCtx, {
        type: 'doughnut',
        data: {
            labels: ['Pelamar Reguler', 'Pelamar Magang'],
            datasets: [{
                data: [regularApplicants, magangApplicants],
                backgroundColor: [
                    'rgba(67, 97, 238, 0.9)',
                    'rgba(76, 201, 240, 0.9)'
                ],
                borderColor: [
                    'rgba(67, 97, 238, 1)',
                    'rgba(76, 201, 240, 1)'
                ],
                borderWidth: 1,
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '60%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 15,
                        usePointStyle: true,
                        pointStyle: 'circle',
                        font: {
                            size: 11
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    padding: 10,
                    cornerRadius: 5,
                    titleFont: {
                        size: 11
                    },
                    bodyFont: {
                        size: 11
                    },
                    callbacks: {
                        label: function(context) {
                            const value = context.raw || 0;
                            const percentage = Math.round((value / totalApplicants) * 100) || 0;
                            return `${context.label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });

    // Event listener untuk filter tahun
    document.getElementById('yearFilter').addEventListener('change', function(e) {
        console.log('Filter tahun:', this.value);
        // Implementasi filter tahun sesuai dengan data yang tersedia
    });
</script>

<!-- Bootstrap 5 JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>