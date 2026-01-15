@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4 text-center fw-bold text-dark-brown">Keranjang Belanja Anda</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body">
                @if(session('cart'))
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 50%">Menu</th>
                                    <th style="width: 15%">Harga</th>
                                    <th style="width: 15%">Jumlah</th>
                                    <th style="width: 20%" class="text-center">Subtotal</th>
                                    <th style="width: 10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0 @endphp
                                @foreach(session('cart') as $id => $details)
                                    @php $total += $details['price'] * $details['quantity'] @endphp
                                    <tr data-id="{{ $id }}">
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($details['image'])
                                                    <img src="{{ asset('images/' . $details['image']) }}" width="60" height="60"
                                                        class="rounded me-3 object-fit-cover" alt="...">
                                                @else
                                                    <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center"
                                                        style="width: 60px; height: 60px;">
                                                        <i class="fas fa-utensils text-muted"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <h6 class="mb-0 fw-bold">{{ $details['name'] }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Rp {{ number_format($details['price'], 0, ',', '.') }}</td>
                                        <td>
                                            <input type="number" value="{{ $details['quantity'] }}"
                                                class="form-control quantity update-cart" min="1" style="width: 80px;">
                                        </td>
                                        <td class="text-center fw-bold">Rp
                                            {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</td>
                                        <td class="text-end">
                                            <form action="{{ route('cart.remove') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $id }}">
                                                <button class="btn btn-danger btn-sm rounded-circle"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <td colspan="3" class="text-end fw-bold fs-5">Total Belanja:</td>
                                    <td class="text-center fw-bold fs-5 text-warning">Rp
                                        {{ number_format($total, 0, ',', '.') }}</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="row mt-4 justify-content-end">
                        <div class="col-md-4">
                            <form action="{{ route('checkout') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Nama Lengkap Pemesan</label>
                                    <input type="text" name="nama_pelanggan" class="form-control" placeholder="Contoh: Budi Santoso" required>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Nomor Meja</label>
                                    <select name="nomor_meja" class="form-select" required>
                                        <option value="" selected disabled>Pilih Nomor Meja</option>
                                        @for($i = 1; $i <= 20; $i++)
                                            <option value="{{ $i }}">Meja Nomor {{ $i }}</option>
                                        @endfor
                                        <option value="Take Away">Bawa Pulang (Take Away)</option>
                                    </select>
                                </div>
                                <div class="d-grid d-md-flex justify-content-md-between gap-2">
                                    <a href="{{ url('/') }}" class="btn btn-outline-secondary w-100"><i class="fas fa-arrow-left me-2"></i> Kembali</a>
                                    <button type="submit" class="btn btn-warning fw-bold px-4 text-dark w-100">Checkout Sekarang <i
                                            class="fas fa-arrow-right ms-2"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>

                @else
                    <div class="text-center py-5">
                        <i class="fas fa-shopping-cart fa-4x text-muted mb-3 opacity-50"></i>
                        <h4 class="text-muted">Keranjang belanja Anda masih kosong.</h4>
                        <a href="{{ url('/') }}" class="btn btn-warning mt-3">Mulai Belanja</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(".update-cart").change(function (e) {
            e.preventDefault();
            var ele = $(this);
            $.ajax({
                url: '{{ route('cart.update') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("data-id"),
                    quantity: ele.parents("tr").find(".quantity").val()
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        });
    </script>
@endsection