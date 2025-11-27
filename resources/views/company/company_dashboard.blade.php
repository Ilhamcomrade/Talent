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
            color: #333;
        }
        
        .dashboard-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .dashboard-header {
            background: var(--gradient);
            color: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 10px 20px rgba(67, 97, 238, 0.2);
            position: relative;
            overflow: hidden;
        }
        
        .dashboard-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }
        
        .dashboard-header h1 {
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .dashboard-header p {
            opacity: 0.9;
            margin-bottom: 0;
        }
        
        .stat-card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            overflow: hidden;
            margin-bottom: 20px;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        
        .stat-card .card-body {
            padding: 25px;
        }
        
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
        
        .stat-card.loker .stat-icon {
            background: rgba(67, 97, 238, 0.15);
            color: var(--primary);
        }
        
        .stat-card.internship .stat-icon {
            background: rgba(76, 201, 240, 0.15);
            color: var(--success);
        }
        
        .stat-card.lamaran .stat-icon {
            background: rgba(247, 37, 133, 0.15);
            color: var(--warning);
        }
        
        .stat-card.pelamar .stat-icon {
            background: rgba(72, 149, 239, 0.15);
            color: var(--info);
        }
        
        .stat-number {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .stat-label {
            color: #6c757d;
            font-weight: 500;
            font-size: 14px;
        }
        
        .chart-card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
        }
        
        .chart-card .card-header {
            background: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 20px 25px;
            border-radius: 15px 15px 0 0 !important;
        }
        
        .chart-card .card-body {
            padding: 25px;
        }
        
        .chart-container {
            position: relative;
            height: 300px;
        }
        
        .activity-card, .lowongan-card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
        }
        
        .activity-card .card-header, .lowongan-card .card-header {
            background: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 20px 25px;
            border-radius: 15px 15px 0 0 !important;
        }
        
        .activity-card .card-body, .lowongan-card .card-body {
            padding: 25px;
        }
        
        .activity-item {
            display: flex;
            padding: 15px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .activity-item:last-child {
            border-bottom: none;
        }
        
        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
        }
        
        .activity-icon.success {
            background: rgba(76, 201, 240, 0.15);
            color: var(--success);
        }
        
        .activity-icon.primary {
            background: rgba(67, 97, 238, 0.15);
            color: var(--primary);
        }
        
        .activity-icon.info {
            background: rgba(72, 149, 239, 0.15);
            color: var(--info);
        }
        
        .activity-content {
            flex: 1;
        }
        
        .activity-title {
            font-weight: 600;
            margin-bottom: 5px;
            font-size: 15px;
        }
        
        .activity-time {
            color: #6c757d;
            font-size: 13px;
        }
        
        .lowongan-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .lowongan-item:last-child {
            border-bottom: none;
        }
        
        .lowongan-info h6 {
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .lowongan-meta {
            color: #6c757d;
            font-size: 13px;
        }
        
        .badge-status {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 12px;
        }
        
        .badge-aktif {
            background: rgba(76, 201, 240, 0.15);
            color: var(--success);
        }
        
        .badge-draft {
            background: rgba(108, 117, 125, 0.15);
            color: #6c757d;
        }
        
        .badge-tutup {
            background: rgba(247, 37, 133, 0.15);
            color: var(--warning);
        }
        
        .quick-actions {
            display: flex;
            gap: 15px;
            margin-top: 25px;
        }
        
        .quick-action-btn {
            flex: 1;
            background: white;
            border: 1px solid rgba(0, 0, 0, 0.08);
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            transition: all 0.3s ease;
            text-decoration: none;
            color: var(--dark);
        }
        
        .quick-action-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            color: var(--primary);
            border-color: var(--primary);
        }
        
        .action-icon {
            font-size: 24px;
            margin-bottom: 10px;
            color: var(--primary);
        }
        
        .action-text {
            font-weight: 600;
            font-size: 14px;
        }
        
        @media (max-width: 768px) {
            .dashboard-container {
                padding: 15px;
            }
            
            .dashboard-header {
                padding: 20px;
            }
            
            .quick-actions {
                flex-direction: column;
            }
            
            .stat-card .card-body {
                padding: 20px;
            }
            
            .chart-card .card-body, 
            .activity-card .card-body, 
            .lowongan-card .card-body {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    @include('partials.navbar_company')

    <div class="dashboard-container">
        <!-- Header -->
        <div class="dashboard-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1>Dashboard Perusahaan</h1>
                    <p>Selamat datang di panel perusahaan Anda</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <div class="btn-group">
                        <button class="btn btn-light">Hari ini</button>
                        <button class="btn btn-outline-light">Minggu ini</button>
                        <button class="btn btn-outline-light">Bulan ini</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert -->
        @if(session('login_success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('login_success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Quick Actions -->
        <div class="quick-actions">
            <a href="#" class="quick-action-btn">
                <div class="action-icon">
                    <i class="fas fa-plus-circle"></i>
                </div>
                <div class="action-text">Buat Lowongan</div>
            </a>
            <a href="#" class="quick-action-btn">
                <div class="action-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="action-text">Kelola Pelamar</div>
            </a>
            <a href="#" class="quick-action-btn">
                <div class="action-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="action-text">Lihat Statistik</div>
            </a>
            <a href="#" class="quick-action-btn">
                <div class="action-icon">
                    <i class="fas fa-cog"></i>
                </div>
                <div class="action-text">Pengaturan</div>
            </a>
        </div>

        <!-- Statistik -->
        <div class="row mt-4">
            <div class="col-xl-3 col-md-6">
                <div class="card stat-card loker">
                    <div class="card-body">
                        <div class="stat-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div class="stat-number">12</div>
                        <div class="stat-label">Total Lowongan Kerja</div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6">
                <div class="card stat-card internship">
                    <div class="card-body">
                        <div class="stat-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="stat-number">8</div>
                        <div class="stat-label">Total Internship</div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6">
                <div class="card stat-card lamaran">
                    <div class="card-body">
                        <div class="stat-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="stat-number">45</div>
                        <div class="stat-label">Lamaran Masuk</div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6">
                <div class="card stat-card pelamar">
                    <div class="card-body">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-number">28</div>
                        <div class="stat-label">Total Pelamar</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik dan Aktivitas -->
        <div class="row mt-4">
            <!-- Grafik -->
            <div class="col-lg-8">
                <div class="card chart-card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-chart-bar me-2"></i>Statistik Lowongan per Bulan
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="barChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Aktivitas Terbaru -->
            <div class="col-lg-4">
                <div class="card activity-card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-bell me-2"></i>Aktivitas Terbaru
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="activity-item">
                            <div class="activity-icon success">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">3 lamaran baru diterima</div>
                                <div class="activity-time">2 jam yang lalu</div>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon primary">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">Lowongan Data Scientist dipublikasi</div>
                                <div class="activity-time">1 hari yang lalu</div>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon info">
                                <i class="fas fa-building"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">Profil perusahaan diperbarui</div>
                                <div class="activity-time">2 hari yang lalu</div>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon success">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">5 lamaran berhasil diproses</div>
                                <div class="activity-time">3 hari yang lalu</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lowongan Terbaru -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card lowongan-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-briefcase me-2"></i>Lowongan Terbaru
                        </h5>
                        <a href="#" class="btn btn-sm btn-primary">Lihat Semua</a>
                    </div>
                    <div class="card-body">
                        <div class="lowongan-item">
                            <div class="lowongan-info">
                                <h6>Frontend Developer</h6>
                                <div class="lowongan-meta">Diposting: 2 hari lalu | 15 pelamar</div>
                            </div>
                            <span class="badge badge-status badge-aktif">Aktif</span>
                        </div>
                        
                        <div class="lowongan-item">
                            <div class="lowongan-info">
                                <h6>Backend Developer</h6>
                                <div class="lowongan-meta">Diposting: 1 minggu lalu | 8 pelamar</div>
                            </div>
                            <span class="badge badge-status badge-aktif">Aktif</span>
                        </div>
                        
                        <div class="lowongan-item">
                            <div class="lowongan-info">
                                <h6>UI/UX Designer</h6>
                                <div class="lowongan-meta">Diposting: 3 minggu lalu | 22 pelamar</div>
                            </div>
                            <span class="badge badge-status badge-aktif">Aktif</span>
                        </div>
                        
                        <div class="lowongan-item">
                            <div class="lowongan-info">
                                <h6>Data Scientist</h6>
                                <div class="lowongan-meta">Diposting: 1 bulan lalu | 12 pelamar</div>
                            </div>
                            <span class="badge badge-status badge-tutup">Ditutup</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Data untuk grafik
        const barChartData = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [
                {
                    label: 'Lowongan Kerja',
                    data: [5, 8, 7, 10, 12, 15, 14, 12, 10, 8, 6, 4],
                    backgroundColor: 'rgba(67, 97, 238, 0.7)',
                    borderColor: 'rgba(67, 97, 238, 1)',
                    borderWidth: 1,
                    borderRadius: 5
                },
                {
                    label: 'Internship',
                    data: [3, 5, 4, 6, 8, 7, 9, 10, 8, 6, 4, 3],
                    backgroundColor: 'rgba(76, 201, 240, 0.7)',
                    borderColor: 'rgba(76, 201, 240, 1)',
                    borderWidth: 1,
                    borderRadius: 5
                }
            ]
        };

        // Inisialisasi grafik batang
        const barCtx = document.getElementById('barChart').getContext('2d');
        const barChart = new Chart(barCtx, {
            type: 'bar',
            data: barChartData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false
                        },
                        ticks: {
                            color: '#6c757d'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#6c757d'
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: '#333',
                            usePointStyle: true,
                            padding: 15
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>