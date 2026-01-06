@extends('layouts.app')

@section('title', 'Katalog Produk')

@section('styles')
    {{-- Impor Font Awesome untuk ikon produk --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Gaya dasar untuk card produk */
        .product-card {
            padding: 8px;
            /* Padding diperkecil */
            min-height: 150px;
            /* Tinggi minimum diperkecil lagi */
            background-color: #FFFDE7;
        }

        /* Mengembalikan ukuran font yang normal untuk H1 */
        h1 {
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        /* Mengatur ukuran font untuk elemen di dalam card agar tidak terlalu kecil */
        .product-card h4 {
            font-size: 0.85rem;
            /* Font diperkecil sedikit */
            margin-bottom: 0.1rem;
        }

        .product-card h3 {
            font-size: 1.1rem;
            /* Font harga diperkecil */
            margin-bottom: 0.2rem;
        }

        .product-card p.small {
            font-size: 0.7rem;
            margin-bottom: 0.2rem;
        }

        .product-card i.fa-4x {
            font-size: 1.8em;
            /* Ikon fallback diperkecil */
            margin-bottom: 0.2rem;
        }
    </style>
@endsection

@section('content')
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="mb-0">Daftar Menu</h1>

            {{-- TOMBOL TAMBAH PRODUK --}}
            <a href="{{ route('admin.katalog.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah
                Produk</a>
        </div>
    </div>

    <div class="mb-4" id="filter-buttons">
        <a href="javascript:void(0)" class="btn btn-sm btn-dark me-1 filter-btn" data-filter="all">Semua</a>
        <a href="javascript:void(0)" class="btn btn-sm btn-outline-dark me-1 filter-btn" data-filter="Kopi">Kopi</a>
        <a href="javascript:void(0)" class="btn btn-sm btn-outline-dark me-1 filter-btn" data-filter="Makanan">Makanan</a>
        <a href="javascript:void(0)" class="btn btn-sm btn-outline-dark me-1 filter-btn" data-filter="Minuman">Minuman
            Dingin</a>
    </div>

    <div class="row" id="product-list">
        @foreach ($products as $product)
            {{-- Struktur Kolom Bootstrap (Revisi: 3 items per row = col-xl-4) --}}
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mb-4 product-item {{ $product->kategori }}">

                {{-- Struktur Card (Penting!) --}}
                <div class="card product-card shadow-sm position-relative">

                    {{-- <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-1">Stok: {{ $product->stock ??
                        '-' }}</span> --}}
                    <div class="text-center mb-1"
                        style="height: 100px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                        @if($product->gambar)
                            <img src="/images/{{ $product->gambar }}" alt="{{ $product->nama_menu }}"
                                style="max-height: 100%; max-width: 100%;">
                        @else
                            {{-- Fallback Icon based on Category --}}
                            @if($product->kategori == 'Kopi')
                                <i class="fas fa-mug-hot fa-4x text-muted" style="color: #6D4C41 !important;"></i>
                            @elseif($product->kategori == 'Makanan')
                                <i class="fas fa-utensils fa-4x text-muted" style="color: #4CAF50 !important;"></i>
                            @elseif($product->kategori == 'Minuman')
                                <i class="fas fa-glass-whiskey fa-4x text-muted" style="color: #FFC107 !important;"></i>
                            @else
                                <i class="fas fa-box fa-4x text-muted"></i>
                            @endif
                        @endif
                    </div>

                    <h4 class="fw-bold mb-0 text-center">{{ $product->nama_menu }}</h4>
                    <p class="text-muted small text-center">{{ $product->kategori }}</p>

                    <h3 class="text-danger fw-bold text-center">Rp {{ number_format($product->harga, 0, ',', '.') }}</h3>
                    {{-- <p class="small text-muted mb-3 text-center">Terjual: {{ $product->sold ?? 0 }} unit</p> --}}

                    <div class="d-flex mt-3">
                        {{-- Tombol Edit --}}
                        <a href="{{ route('admin.katalog.edit', $product->id) }}"
                            class="btn btn-info btn-sm flex-grow-1 me-1"><i class="fas fa-edit"></i> Edit</a>

                        {{-- Form Delete --}}
                        <form action="{{ route('admin.katalog.destroy', $product->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus produk {{ $product->nama_menu }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

        @if(count($products) == 0)
            <div class="col-12">
                <p class="text-center text-muted">Belum ada data produk yang tersedia.</p>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Logika Filter Kategori
            $('.filter-btn').on('click', function () {
                var filterValue = $(this).attr('data-filter');

                // Logika Tampilan Tombol (Aktif/Nonaktif)
                $('.filter-btn').removeClass('btn-dark filter-btn-active').addClass('btn-outline-dark');
                $(this).removeClass('btn-outline-dark').addClass('btn-dark filter-btn-active');

                // Logika Filter Produk
                if (filterValue === 'all') {
                    $('.product-item').show();
                } else {
                    $('.product-item').hide();
                    $('.' + filterValue).show();
                }
            });
        });
    </script>
@endsection