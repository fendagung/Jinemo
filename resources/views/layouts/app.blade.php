<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Cafe Jinemmo | @yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{-- CSS KUSTOM UNTUK MEMASTIKAN JARAK RAPAT (MENGGUNAKAN ID UNTUK PRIORITAS TERTINGGI) --}}
    <style>
        #super-rapat-menu {
            list-style: none !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        #super-rapat-menu li {
            /* Jarak vertikal antar item dihilangkan */
            margin: 0 !important;
            padding: 0 !important;
        }

        #super-rapat-menu a {
            /* Padding di link menu yang mengontrol jarak */
            display: block !important;
            padding: 8px 15px !important;
            /* Nilai 8px ini yang menentukan kerapatan. */
            text-decoration: none !important;
            color: inherit !important;
            transition: background-color 0.2s !important;
        }

        #super-rapat-menu a:hover {
            background-color: #f0f0f0 !important;
        }
    </style>

    @yield('styles')
</head>

<body>
    @if(Auth::check() && Auth::user()->role === 'admin')
        <nav class="navbar navbar-expand-lg header-bg fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand text-white ms-4" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-mug-hot me-2"></i> Cafe Jinemmo Admin
                </a>
                <div class="ms-auto text-white pe-4">
                    <i class="fas fa-user-circle me-2"></i> {{ Auth::user()->name }}
                </div>
            </div>
        </nav>

        {{-- SIDEBAR REVISI STRUKTUR (MENGGUNAKAN ID) --}}
        <div class="sidebar pt-5">
            {{-- Menggunakan ID untuk prioritas CSS tertinggi --}}
            <ul id="super-rapat-menu">
                <li>
                    <a class="{{ Request::is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i
                            class="fas fa-chart-line me-2"></i>
                        Dashboard</a>
                </li>
                <li>
                    <a class="{{ Request::is('admin/katalog*') ? 'active' : '' }}" href="{{ route('admin.katalog') }}"><i
                            class="fas fa-box-open me-2"></i> Daftar Menu</a>
                </li>
                <li>
                    <a class="{{ Request::is('admin/pesanan*') ? 'active' : '' }}" href="{{ route('admin.pesanan') }}"><i
                            class="fas fa-list-alt me-2"></i> Manajemen Pesanan</a>
                </li>
                <li>
                    <a class="{{ Request::is('admin/laporan*') ? 'active' : '' }}" href="{{ route('admin.laporan') }}"><i
                            class="fas fa-file-alt me-2"></i> Laporan</a>
                </li>
                <li>
                    <a class="{{ Request::is('admin/sosmed*') ? 'active' : '' }}" href="{{ route('admin.sosmed') }}"><i
                            class="fas fa-share-alt me-2"></i> Integrasi Sosial Media</a>
                </li>
                <li class="mt-3 pt-3 border-top">
                    <a href="{{ url('/') }}"><i class="fas fa-home me-2"></i> Home</a>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" id="logout-form-admin" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-admin').submit();"
                        class="text-danger">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    @else
        {{-- Navbar Sederhana untuk Pelanggan di Halaman Keranjang/Lainnya --}}
        <nav class="navbar navbar-expand-lg bg-white shadow-sm fixed-top">
            <div class="container py-2">
                <a class="navbar-brand fw-bold" href="{{ url('/') }}" style="color: #6D4C41;">
                    <i class="fas fa-utensils me-2 text-warning"></i> Jinemo Restoran
                </a>
                <div class="ms-auto">
                    <a href="{{ url('/') }}" class="btn btn-outline-warning text-dark fw-bold rounded-pill px-3">
                        <i class="fas fa-home me-2"></i> Kembali ke Menu
                    </a>
                </div>
            </div>
        </nav>
        <style>
            .sidebar {
                display: none !important;
            }

            .main-content {
                margin-left: 0 !important;
                padding-top: 100px !important;
                width: 100% !important;
            }
        </style>
    @endif

    <main class="main-content">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer style="background-color: #6D4C41; color: #FFC107; padding: 20px 0; text-align: center;">
        <div class="container-fluid my-auto">
            <div class="copyright text-center my-auto">
                <span>
                    &copy; 2025 Jinemmo Restoran Prasmanan Yogyakarta - E-Business System
                </span>
                <br>
                <span>
                    Source Code: <a href="https://github.com/fenditusagung/Jinemo.git" target="_blank"
                        style="color: #FFC107; text-decoration: underline;">https://github.com/fenditusagung/Jinemo.git</a>
                </span>
                <br>
                <span>
                    Jl. kledokan III, Kec. Depok, Kab Sleman Yogyakarta | 📞 (0274) 123-4567
                </span>
            </div>
        </div>
    </footer>
    {{-- END OF FOOTER --}}

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')

</body>

</html>