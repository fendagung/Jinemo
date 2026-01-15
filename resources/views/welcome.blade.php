<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jinemo Restoran Prasmanan</title>
    {{-- Bootstrap & Font Awesome --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --primary-brown: #6D4C41;
            --secondary-gold: #FFC107;
            --dark-brown: #3E2723;
            --light-cream: #FFF8E1;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        /* NAVBAR */
        .navbar-premium {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
        }

        .navbar-brand {
            font-weight: bold;
            color: var(--primary-brown) !important;
            font-size: 1.5rem;
        }

        /* HERO SECTION */
        .hero-section {
            background: linear-gradient(rgba(62, 39, 35, 0.8), rgba(62, 39, 35, 0.8)), url('https://source.unsplash.com/1600x900/?restaurant,food');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
            text-align: center;
            margin-bottom: 50px;
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            font-weight: bold;
            color: var(--secondary-gold);
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            display: inline-block;
            /* Ensure marquee handles it right */
        }

        /* MENU CARDS */
        .card-menu {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            background: white;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }

        .card-menu:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card-img-wrapper {
            height: 200px;
            overflow: hidden;
            position: relative;
        }

        .card-img-top {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .card-menu:hover .card-img-top {
            transform: scale(1.1);
        }

        .badge-category {
            position: absolute;
            top: 15px;
            right: 15px;
            background-color: var(--secondary-gold);
            color: var(--dark-brown);
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .menu-price {
            color: var(--primary-brown);
            font-weight: bold;
            font-size: 1.2rem;
        }

        .btn-order {
            background-color: #25D366;
            /* WA Color */
            color: white;
            border: none;
            border-radius: 25px;
            width: 100%;
            padding: 10px;
            font-weight: bold;
            transition: all 0.2s;
        }

        .btn-order:hover {
            background-color: #128C7E;
            color: white;
            transform: scale(1.02);
        }

        /* FOOTER */
        footer {
            background-color: var(--dark-brown);
            color: var(--light-cream);
            padding: 40px 0;
            margin-top: 50px;
        }

        .star-rating {
            font-size: 1.5rem;
        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            color: #ddd;
            cursor: pointer;
            transition: all 0.2s ease;
            margin: 0 2px;
        }

        .star-rating input:checked~label,
        .star-rating label:hover,
        .star-rating label:hover~label {
            color: #FFC107;
        }
    </style>
</head>

<body>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-premium sticky-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="#"><i class="fas fa-utensils me-2"></i> Jinemo Restoran</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    {{-- Cart Icon --}}
                    <li class="nav-item me-3">
                        <a href="{{ route('cart') }}" class="btn position-relative text-warning">
                            <i class="fas fa-shopping-cart fa-lg"></i>
                            @if(session('cart'))
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-light">
                                    {{ count(session('cart')) }}
                                    <span class="visually-hidden">items in cart</span>
                                </span>
                            @endif
                        </a>
                    </li>

                    {{-- Removed Login/Register for customers as per request --}}
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <li class="nav-item me-2">
                                <a class="btn btn-outline-warning text-dark fw-bold rounded-pill px-3"
                                    href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="btn btn-danger text-white fw-bold rounded-pill px-3">Logout</button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    {{-- HERO HEADER --}}
    <section class="hero-section">
        <div class="container">
            {{-- ANIMASI TULISAN BERJALAN (MARQUEE) --}}
            <div style="overflow: hidden; white-space: nowrap;">
                <marquee behavior="scroll" direction="left" scrollamount="12" class="hero-title mb-3"
                    style="width: 100%;">
                    Selamat Datang Di Jinemo Restoran Prasmanan Yogyakarta
                </marquee>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <p class="lead mb-4">Rasakan Kenikmatan Masakan Tradisional dengan Suasana Nyaman</p>
            <a href="#menu" class="btn btn-warning btn-lg rounded-pill px-5 shadow fw-bold">Pesan Sekarang</a>
        </div>
    </section>

    {{-- DAFTAR MENU --}}
    <section class="container" id="menu">
        <div class="text-center mb-5">
            <h5 class="text-warning fw-bold ls-1">PILIHAN TERBAIK</h5>
            <h2 class="fw-bold" style="color: var(--dark-brown);">Daftar Menu Spesial</h2>
            <div style="width: 80px; height: 3px; background-color: var(--primary-brown); margin: 15px auto;"></div>

            {{-- Search Form --}}
            <div class="row justify-content-center mt-4">
                <div class="col-md-6">
                    <form action="{{ url('/') }}" method="GET">
                        <div class="input-group mb-3 custom-search">
                            <input type="text" name="search" class="form-control form-control-lg border-2"
                                placeholder="Cari menu favorit Anda..." value="{{ request('search') }}"
                                style="border-color: var(--primary-brown); border-radius: 25px 0 0 25px;">
                            <button class="btn btn-warning text-dark fw-bold px-4" type="submit"
                                style="border-radius: 0 25px 25px 0;">
                                <i class="fas fa-search me-2"></i>Cari
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
            @forelse($menus as $menu)
                <div class="col">
                    <div class="card card-menu shadow-sm h-100">
                        {{-- GAMBAR --}}
                        <div class="card-img-wrapper">
                            @if($menu->gambar)
                                <img src="{{ asset('images/' . $menu->gambar) }}" class="card-img-top"
                                    alt="{{ $menu->nama_menu }}">
                            @else
                                <div class="d-flex align-items-center justify-content-center h-100 bg-light text-secondary">
                                    <i class="fas fa-image fa-3x"></i>
                                </div>
                            @endif
                            <span class="badge-category">{{ $menu->kategori ?? 'Umum' }}</span>
                        </div>

                        {{-- KONTEN --}}
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold mb-1">{{ $menu->nama_menu }}</h5>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="menu-price">Rp {{ number_format($menu->harga, 0, ',', '.') }}</span>
                                <div class="text-warning small d-flex align-items-center">
                                    <i class="fas fa-star me-1"></i>
                                    <span>{{ number_format($menu->reviews->avg('rating') ?: 5, 1) }}</span>
                                    <span class="text-muted ms-1"
                                        style="font-size: 0.7rem;">({{ $menu->reviews->count() }})</span>
                                </div>
                            </div>

                            {{-- ACTION BUTTONS --}}
                            <div class="d-grid gap-2">
                                <a href="{{ route('add.to.cart', $menu->id) }}"
                                    class="btn btn-success text-white fw-bold rounded-pill shadow-sm py-2">
                                    <i class="fas fa-cart-plus me-2"></i> Pesan Sekarang
                                </a>
                                <button type="button" class="btn btn-outline-warning btn-sm rounded-pill fw-bold"
                                    data-bs-toggle="modal" data-bs-target="#reviewModal{{ $menu->id }}">
                                    <i class="fas fa-comment-dots me-1"></i> Beri Ulasan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Review Modal -->
                <div class="modal fade" id="reviewModal{{ $menu->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content border-0 shadow">
                            <div class="modal-header header-bg text-white border-0">
                                <h5 class="modal-title fw-bold">Ulasan untuk: {{ $menu->nama_menu }}</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('review.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Nama Anda</label>
                                        <input type="text" name="nama_pelanggan" class="form-control"
                                            placeholder="Masukkan nama Anda" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Rating</label>
                                        <div class="star-rating d-flex flex-row-reverse justify-content-center">
                                            <input type="radio" id="star5-{{ $menu->id }}" name="rating" value="5"
                                                required /><label for="star5-{{ $menu->id }}"><i
                                                    class="fas fa-star"></i></label>
                                            <input type="radio" id="star4-{{ $menu->id }}" name="rating" value="4" /><label
                                                for="star4-{{ $menu->id }}"><i class="fas fa-star"></i></label>
                                            <input type="radio" id="star3-{{ $menu->id }}" name="rating" value="3" /><label
                                                for="star3-{{ $menu->id }}"><i class="fas fa-star"></i></label>
                                            <input type="radio" id="star2-{{ $menu->id }}" name="rating" value="2" /><label
                                                for="star2-{{ $menu->id }}"><i class="fas fa-star"></i></label>
                                            <input type="radio" id="star1-{{ $menu->id }}" name="rating" value="1" /><label
                                                for="star1-{{ $menu->id }}"><i class="fas fa-star"></i></label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Komentar</label>
                                        <textarea name="komentar" class="form-control" rows="3"
                                            placeholder="Apa pendapat Anda tentang menu ini?" required></textarea>
                                    </div>

                                    @if($menu->reviews->count() > 0)
                                        <hr>
                                        <h6 class="fw-bold mb-3">Ulasan Terbaru:</h6>
                                        <div style="max-height: 200px; overflow-y: auto;">
                                            @foreach($menu->reviews()->latest()->take(5)->get() as $review)
                                                <div class="mb-3 pb-2 border-bottom">
                                                    <div class="d-flex justify-content-between mb-1">
                                                        <span class="fw-bold small">{{ $review->nama_pelanggan }}</span>
                                                        <span class="text-warning small">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                <i class="fa{{ $i <= $review->rating ? 's' : 'r' }} fa-star"></i>
                                                            @endfor
                                                        </span>
                                                    </div>
                                                    <p class="small text-muted mb-0">{{ $review->komentar }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                <div class="modal-footer border-0">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-warning fw-bold text-dark px-4">Kirim
                                        Ulasan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <img src="https://cdn-icons-png.flaticon.com/512/11329/11329060.png" width="100"
                        class="mb-3 opacity-50">
                    <h4 class="text-muted">Belum ada menu yang tersedia.</h4>
                </div>
            @endforelse
        </div>
    </section>

    {{-- LOKASI KAMI --}}
    <section class="container my-5 py-5" id="lokasi">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h5 class="text-warning fw-bold ls-1">LOKASI KAMI</h5>
                <h2 class="fw-bold mb-3" style="color: var(--dark-brown);">Kunjungi Restoran Kami</h2>
                <p class="text-muted mb-4">
                    Nikmati suasana nyaman dan asri di Jinemo Restoran. Kami berlokasi strategis di pusat kota
                    Yogyakarta,
                    siap menyambut Anda dengan hidangan prasmanan terbaik.
                </p>
                <div class="d-flex align-items-start mb-3">
                    <i class="fas fa-map-marked-alt text-warning fa-2x me-3 mt-1"></i>
                    <div>
                        <h5 class="fw-bold mb-1">Alamat Lengkap</h5>
                        <p class="text-muted mb-0">Jl. Kledokan III, Ngentak, Caturtunggal, Kec. Depok, Kabupaten
                            Sleman, Daerah Istimewa Yogyakarta 55281</p>
                    </div>
                </div>
                <div class="d-flex align-items-start mb-4">
                    <i class="fas fa-clock text-warning fa-2x me-3 mt-1"></i>
                    <div>
                        <h5 class="fw-bold mb-1">Jam Operasional</h5>
                        <p class="text-muted mb-0">Setiap Hari: 08.00 - 23.00 WIB</p>
                    </div>
                </div>
                <a href="https://maps.google.com/?q=Jl.+Kledokan+III,+Ngentak,+Caturtunggal,+Kec.+Depok,+Kabupaten+Sleman,+Daerah+Istimewa+Yogyakarta+55281"
                    target="_blank" class="btn btn-outline-dark rounded-pill px-4">
                    <i class="fas fa-directions me-2"></i> Buka di Google Maps
                </a>
            </div>
            <div class="col-lg-6">
                <div class="card shadow-lg border-0 overflow-hidden" style="border-radius: 20px;">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15812.24757390234!2d110.36034176466388!3d-7.785055042859424!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5787bd5b6bc5%3A0x21723fd4d3684f71!2sYogyakarta%2C%20Yogyakarta%20City%2C%20Special%20Region%20of%20Yogyakarta!5e0!3m2!1sen!2sid!4v1703504822000!5m2!1sen!2sid"
                        width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-4 mb-md-0">
                    <h4 class="fw-bold text-warning mb-3">Jinemo Restoran</h4>
                    <p class="smal text-white-50">Tempat makan prasmanan terbaik dengan cita rasa khas nusantara.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-1"><i class="fas fa-map-marker-alt me-2 text-warning"></i> Yogyakarta, Indonesia</p>
                    <p class="mb-1"><i class="fab fa-whatsapp me-2 text-warning"></i> +62 812-3826-0375</p>
                    <div class="mt-3">
                        <a href="#" class="text-white me-3"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook fa-lg"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-top border-secondary mt-4 pt-4 text-center small text-white-50">
                &copy; {{ date('Y') }} Jinemo Restoran Prasmanan. All rights reserved. |
                <a href="{{ route('login') }}" class="text-white-50 text-decoration-none small"><i
                        class="fas fa-lock me-1"></i> Admin Login</a> |
                <a href="https://github.com/fenditusagung/Jinemo.git" target="_blank" class="text-warning">GitHub
                    Repo</a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>