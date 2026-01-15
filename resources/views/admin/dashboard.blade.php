@extends('layouts.app')

@section('title', 'Dashboard Premium')

@section('styles')
    <style>
        /* TEMA JINEMO ROYAL */
        :root {
            --primary-brown: #6D4C41;
            --secondary-gold: #FFC107;
            --dark-brown: #4E342E;
            --light-cream: #FFF8E1;
        }

        .bg-gradient-primary-royal {
            background: linear-gradient(45deg, var(--dark-brown), var(--primary-brown));
            color: white;
        }

        .bg-gradient-gold-royal {
            background: linear-gradient(45deg, #FFB300, #FFD54F);
            color: var(--dark-brown);
        }

        .bg-gradient-info {
            background: linear-gradient(45deg, #36b9cc, #2c9faf);
            color: white;
        }

        .bg-gradient-danger {
            background: linear-gradient(45deg, #e74a3b, #be2617);
            color: white;
        }

        .bg-gradient-brand {
            background: linear-gradient(45deg, #4e73df, #224abe);
            color: white;
        }

        .bg-soft-cream {
            background-color: #fdfbf7;
        }

        .text-brown {
            color: var(--primary-brown) !important;
        }

        .card-premium {
            border: none;
            border-radius: 15px;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .card-premium:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important;
        }

        .icon-circle {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            background-color: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(5px);
        }

        .welcome-banner {
            background: url('https://source.unsplash.com/1600x400/?restaurant,luxury') center/cover no-repeat;
            background-color: var(--dark-brown);
            position: relative;
            border-radius: 12px;
            padding: 20px 25px;
            color: white;
            margin-bottom: 20px;
            overflow: hidden;
        }

        .welcome-banner::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to right, rgba(78, 52, 46, 0.95), rgba(78, 52, 46, 0.7));
            z-index: 1;
        }

        .welcome-content {
            position: relative;
            z-index: 2;
        }

        .quick-action-btn {
            background-color: white;
            border: 1px solid #eee;
            border-radius: 10px;
            padding: 8px;
            text-align: center;
            transition: all 0.2s;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: #555;
        }

        .quick-action-btn:hover {
            background-color: var(--light-cream);
            border-color: var(--secondary-gold);
            color: var(--dark-brown);
            transform: scale(1.03);
        }

        .quick-action-icon {
            font-size: 1.5rem;
            margin-bottom: 5px;
            color: var(--primary-brown);
        }

        .chart-container-card {
            border-radius: 12px;
            border: none;
        }
    </style>
@endsection

@section('content')

    {{-- 1. WELCOME BANNER --}}
    <div class="welcome-banner shadow-sm">
        <div class="welcome-content d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h2 class="fw-bold mb-1" style="font-family: 'Playfair Display', serif;">Selamat Datang, Admin!</h2>
                <p class="mb-0 fs-6 text-white-50">Dashboard Jinemo Restoran Prasmanan</p>
            </div>
            <div class="mt-2 mt-md-0">
                <span class="badge bg-warning text-dark px-2 py-1 rounded-pill shadow-sm">
                    <i class="fas fa-clock me-1"></i> {{ date('d F Y') }}
                </span>
            </div>
        </div>
    </div>

    {{-- 2. QUICK ACTIONS (Aksi Cepat) --}}
    <h6 class="mb-2 text-secondary fw-bold px-1">Aksi Cepat</h6>
    <div class="row mb-3">
        <div class="col-6 col-md-3 mb-2">
            <a href="{{ route('admin.katalog.create') }}" class="quick-action-btn shadow-sm">
                <i class="fas fa-plus-circle quick-action-icon"></i>
                <span class="small fw-bold">Tambah Menu</span>
            </a>
        </div>
        <div class="col-6 col-md-3 mb-2">
            <a href="{{ route('admin.katalog') }}" class="quick-action-btn shadow-sm">
                <i class="fas fa-book-open quick-action-icon"></i>
                <span class="small fw-bold">Daftar Menu</span>
            </a>
        </div>
        <div class="col-6 col-md-3 mb-2">
            <a href="{{ route('admin.pesanan') }}" class="quick-action-btn shadow-sm position-relative">
                <i class="fas fa-receipt quick-action-icon"></i>
                <span class="small fw-bold">Pesanan Masuk</span>
                @if($pendingOrdersCount > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger shadow">
                        {{ $pendingOrdersCount }}
                    </span>
                @endif
            </a>
        </div>
        <div class="col-6 col-md-3 mb-2">
            <a href="{{ route('admin.laporan') }}" class="quick-action-btn shadow-sm">
                <i class="fas fa-file-invoice-dollar quick-action-icon"></i>
                <span class="small fw-bold">Laporan</span>
            </a>
        </div>
    </div>

    {{-- 3. STATISTIK UTAMA --}}
    <h6 class="mb-2 text-secondary fw-bold px-1">Ringkasan Bisnis</h6>
    <div class="row mb-3">
        {{-- Total Penjualan --}}
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card card-premium bg-gradient-gold-royal shadow h-100 py-2">
                <div class="card-body p-3">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1" style="opacity: 0.8; font-size: 0.7rem;">
                                Penjualan (Hari Ini)</div>
                            <div class="h5 mb-0 font-weight-bold text-dark" style="font-size: 1.1rem;">Rp 1.500k</div>
                        </div>
                        <div class="col-auto">
                            <div class="icon-circle bg-dark text-white">
                                <i class="fas fa-wallet"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Produk Terjual --}}
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card card-premium bg-gradient-brand shadow h-100 py-2 text-white">
                <div class="card-body p-3">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-light text-uppercase mb-1" style="opacity: 0.8; font-size: 0.7rem;">
                                Produk Terjual</div>
                            <div class="h5 mb-0 font-weight-bold" style="font-size: 1.1rem;">580 Porsi</div>
                        </div>
                        <div class="col-auto">
                            <div class="icon-circle bg-white text-primary">
                                <i class="fas fa-utensils"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pengunjung --}}
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card card-premium bg-gradient-info shadow h-100 py-2 text-white">
                <div class="card-body p-3">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-light text-uppercase mb-1" style="opacity: 0.8; font-size: 0.7rem;">
                                Pengunjung (Bulan Ini)</div>
                            <div class="h5 mb-0 font-weight-bold" style="font-size: 1.1rem;">450</div>
                        </div>
                        <div class="col-auto">
                            <div class="icon-circle bg-white text-info">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Menu Aktif --}}
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card card-premium bg-gradient-danger shadow h-100 py-2 text-white">
                <div class="card-body p-3">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-light text-uppercase mb-1" style="opacity: 0.8; font-size: 0.7rem;">
                                Total Menu Aktif</div>
                            <div class="h5 mb-0 font-weight-bold" style="font-size: 1.1rem;">12 Item</div>
                        </div>
                        <div class="col-auto">
                            <div class="icon-circle bg-white text-danger">
                                <i class="fas fa-mug-hot"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 4. GRAFIK & AKTIVITAS --}}
    <div class="row">
        {{-- Chart Pendapatan --}}
        <div class="col-lg-6 mb-3">
            <div class="card card-premium shadow mb-3 bg-soft-cream">
                <div class="card-header py-2 bg-transparent border-bottom-0">
                    <h6 class="m-0 font-weight-bold text-brown" style="font-size: 0.9rem;">Grafik Pendapatan</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area" style="height: 180px;">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pie Chart / Aktivitas --}}
        <div class="col-lg-6 mb-3">
            <div class="card card-premium shadow mb-3 bg-soft-cream">
                <div class="card-header py-2 bg-transparent border-bottom-0">
                    <h6 class="m-0 font-weight-bold text-brown" style="font-size: 0.9rem;">Kategori Terlaris</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-1 pb-1" style="height: 180px;">
                        <canvas id="categoryChart"></canvas>
                    </div>
                    <div class="mt-2 text-center small" style="font-size: 0.75rem;">
                        <span class="mx-1"><i class="fas fa-circle" style="color: #6D4C41"></i> Kopi</span>
                        <span class="mx-1"><i class="fas fa-circle" style="color: #FFC107"></i> Makanan</span>
                        <span class="mx-1"><i class="fas fa-circle" style="color: #1cc88a"></i> Minuman</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
    <script>
        // --- 1. SETTING FONT UMUM ---
        Chart.defaults.font.family = "'Nunito', sans-serif";
        Chart.defaults.color = '#858796';

        // --- 2. GRAFIK PENJUALAN (LINE) ---
        var ctx = document.getElementById("salesChart");
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags"],
                datasets: [{
                    label: "Pendapatan",
                    lineTension: 0.3,
                    backgroundColor: "rgba(255, 193, 7, 0.05)", // Gold Transparan
                    borderColor: "#6D4C41", // Cokelat Royal
                    pointRadius: 3,
                    pointBackgroundColor: "#FFC107", // Gold
                    pointBorderColor: "#6D4C41",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "#6D4C41",
                    pointHoverBorderColor: "#FFC107",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: [0, 1000000, 500000, 1500000, 1000000, 2000000, 1500000, 2500000],
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: { padding: { left: 10, right: 25, top: 25, bottom: 0 } },
                scales: {
                    x: {
                        grid: { display: false, drawBorder: false },
                        ticks: { maxTicksLimit: 7 }
                    },
                    y: {
                        ticks: {
                            maxTicksLimit: 5,
                            padding: 10,
                            callback: function (value, index, values) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        },
                        grid: { color: "rgb(234, 236, 244)", zeroLineColor: "rgb(234, 236, 244)", drawBorder: false, borderDash: [2], zeroLineBorderDash: [2] }
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyColor: "#858796",
                        titleMarginBottom: 10,
                        titleColor: '#6e707e',
                        titleFont: { size: 14 },
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        intersect: false,
                        mode: 'index',
                        caretPadding: 10,
                        callbacks: {
                            label: function (tooltipItem, chart) {
                                var datasetLabel = tooltipItem.dataset.label || '';
                                return datasetLabel + ': Rp ' + tooltipItem.raw.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });

        // --- 3. GRAFIK KATEGORI (DOUGHNUT) ---
        var ctxPie = document.getElementById("categoryChart");
        var myPieChart = new Chart(ctxPie, {
            type: 'doughnut',
            data: {
                labels: ["Kopi", "Makanan", "Minuman"],
                datasets: [{
                    data: [55, 30, 15],
                    backgroundColor: ['#6D4C41', '#FFC107', '#1cc88a'],
                    hoverBackgroundColor: ['#5D4037', '#FFB300', '#17a673'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: { display: false },
                cutout: '80%',
            },
        });
    </script>
@endsection