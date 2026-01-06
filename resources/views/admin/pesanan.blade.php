@extends('layouts.app')

@section('title', 'Manajemen Pesanan')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Manajemen Pesanan / Transaksi</h1>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Pelanggan</th>
                                    <th>Menu Pesanan</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pesanans as $pesanan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pesanan->created_at->format('d M Y H:i') }}</td>
                                        <td>{{ $pesanan->user->name ?? 'Guest' }}</td>
                                        <td>
                                            <ul class="list-unstyled mb-0">
                                                @foreach($pesanan->details as $detail)
                                                    <li>
                                                        <small>
                                                            {{ $detail->menu->nama_menu ?? 'Menu Dihapus' }}
                                                            <span class="text-muted">x {{ $detail->jumlah }}</span>
                                                        </small>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                                        <td>
                                            <span
                                                class="badge bg-{{ $pesanan->status == 'Selesai' ? 'success' : ($pesanan->status == 'Batal' ? 'danger' : 'warning') }}">
                                                {{ $pesanan->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <!-- Update Status Form (Simple) -->
                                            <form action="{{ route('admin.pesanan.update', $pesanan->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" class="form-select form-select-sm d-inline-block w-auto"
                                                    onchange="this.form.submit()">
                                                    <option value="Menunggu Konfirmasi" {{ $pesanan->status == 'Menunggu Konfirmasi' ? 'selected' : '' }}>Menunggu</option>
                                                    <option value="Diproses" {{ $pesanan->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                                    <option value="Selesai" {{ $pesanan->status == 'Selesai' ? 'selected' : '' }}>
                                                        Selesai</option>
                                                    <option value="Batal" {{ $pesanan->status == 'Batal' ? 'selected' : '' }}>
                                                        Batal</option>
                                                </select>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada pesanan masuk.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection