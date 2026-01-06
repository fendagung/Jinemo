@extends('layouts.app')

@section('title', 'Integrasi Sosial Media Premium')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* TEMA JINEMO ROYAL (Reused) */
        :root {
            --primary-brown: #6D4C41;
            --secondary-gold: #FFC107;
            --dark-brown: #4E342E;
            --light-cream: #FFF8E1;
        }

        /* WARNA SOSMED */
        .bg-instagram {
            background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
            color: white;
        }

        .bg-shopee {
            background: linear-gradient(45deg, #FF5722, #FF8A65);
            color: white;
        }

        .bg-whatsapp {
            background: linear-gradient(45deg, #25D366, #128C7E);
            color: white;
        }

        .card-social {
            border: none;
            border-radius: 15px;
            transition: all 0.3s ease;
            overflow: hidden;
            position: relative;
        }

        .card-social:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2) !important;
        }

        .social-icon-large {
            font-size: 4rem;
            opacity: 0.2;
            position: absolute;
            right: -10px;
            bottom: -10px;
            transform: rotate(-15deg);
        }

        .btn-connect {
            border-radius: 20px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.8rem;
            padding: 8px 20px;
        }
    </style>
@endsection

@section('content')

    {{-- HEADER --}}
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="mb-2 fw-bold" style="color: var(--dark-brown);">Hubungkan Bisnis Anda</h1>
            <p class="text-muted">Pantau interaksi pelanggan dari berbagai platform dalam satu tampilan premium.</p>
        </div>
    </div>

    {{-- KARTU MONITORING --}}
    <div class="row mb-4">

        {{-- INSTAGRAM --}}
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card card-social bg-instagram shadow h-100">
                <div class="card-body p-4 d-flex flex-column justify-content-between" style="min-height: 200px;">
                    <div>
                        <h5 class="fw-bold mb-1">Instagram Business</h5>
                        <p class="small mb-4 text-white-50">@jinemmo_jogja</p>

                        <div class="d-flex align-items-end mb-2">
                            <h2 class="fw-bold mb-0 me-2">12.5K</h2>
                            <span class="small"><i class="fas fa-arrow-up"></i> 500 Followers</span>
                        </div>
                        <p class="small text-white-50 mb-0">Engagement Rate: 4.8%</p>
                    </div>

                    <div class="mt-4">
                        <a href="https://instagram.com/jinemmo_jogja" target="_blank"
                            class="btn btn-light btn-sm btn-connect text-danger shadow-sm">
                            <i class="fab fa-instagram me-1"></i> Buka Profil
                        </a>
                    </div>
                    <i class="fab fa-instagram social-icon-large"></i>
                </div>
            </div>
        </div>

        {{-- SHOPEE --}}
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card card-social bg-shopee shadow h-100">
                <div class="card-body p-4 d-flex flex-column justify-content-between" style="min-height: 200px;">
                    <div>
                        <h5 class="fw-bold mb-1">Shopee Official</h5>
                        <p class="small mb-4 text-white-50">Jinemmo Official Store</p>

                        <div class="d-flex align-items-end mb-2">
                            <h2 class="fw-bold mb-0 me-2">85</h2>
                            <span class="small"><i class="fas fa-shopping-bag"></i> Order Baru</span>
                        </div>
                        <p class="small text-white-50 mb-0">Pendapatan: Rp 2.100.000</p>
                    </div>

                    <div class="mt-4">
                        <a href="https://shopee.co.id/jinemmo_official" target="_blank"
                            class="btn btn-light btn-sm btn-connect text-warning shadow-sm"
                            style="color: #FF5722 !important">
                            <i class="fas fa-store me-1"></i> Kelola Toko
                        </a>
                    </div>
                    <i class="fas fa-shopping-bag social-icon-large"></i>
                </div>
            </div>
        </div>

        {{-- WHATSAPP --}}
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card card-social bg-whatsapp shadow h-100">
                <div class="card-body p-4 d-flex flex-column justify-content-between" style="min-height: 200px;">
                    <div>
                        <h5 class="fw-bold mb-1">WhatsApp Business</h5>
                        <p class="small mb-4 text-white-50">+62 812-3826-0375</p>

                        <div class="d-flex align-items-end mb-2">
                            <h2 class="fw-bold mb-0 me-2">15</h2>
                            <span class="small"><i class="fas fa-comment-dots"></i> Pesan Belum Dibaca</span>
                        </div>
                        <p class="small text-white-50 mb-0">Respon Rata-rata: < 5 Menit</p>
                    </div>

                    <div class="mt-4">
                        <a href="https://wa.me/6281238260375?text=Halo,%20Selamat%20Datang%20di%20Jinemo%20Restoran%20Prasmanan%20ada%20yang%20kami%20bisah%20bantu"
                            target="_blank" class="btn btn-light btn-sm btn-connect text-success shadow-sm">
                            <i class="fab fa-whatsapp me-1"></i> Balas Chat
                        </a>
                    </div>
                    <i class="fab fa-whatsapp social-icon-large"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- SECTION TOOLS --}}
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3" style="color: var(--primary-brown);">Alat Pemasaran Cepat</h5>
                    <div class="row g-3">
                        <div class="col-md-3">
                            <button class="btn btn-outline-dark w-100 py-3 text-start border-2 h-100">
                                <i class="fas fa-camera text-danger me-2 fa-lg"></i>
                                <strong>Buat Story Instagram</strong>
                                <div class="small text-muted mt-1">Promosi menu baru</div>
                            </button>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-outline-dark w-100 py-3 text-start border-2 h-100">
                                <i class="fas fa-bullhorn text-warning me-2 fa-lg"></i>
                                <strong>Broadcast WA</strong>
                                <div class="small text-muted mt-1">Kirim promo ke pelanggan</div>
                            </button>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-outline-dark w-100 py-3 text-start border-2 h-100">
                                <i class="fas fa-tags text-primary me-2 fa-lg"></i>
                                <strong>Update Stok Shopee</strong>
                                <div class="small text-muted mt-1">Sinkronisasi otomatis</div>
                            </button>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-outline-dark w-100 py-3 text-start border-2 h-100">
                                <i class="fas fa-star text-warning me-2 fa-lg"></i>
                                <strong>Ulasan Pelanggan</strong>
                                <div class="small text-muted mt-1">Lihat rating Google</div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection