@extends('layouts.app')

@section('title', 'Laporan Penjualan Harian')

@section('content')
    <div class="row">
        <div class="col-md-12 mb-4">
            <h2 class="h3 mb-0 text-gray-800 fw-bold">Laporan Penjualan Harian</h2>
            <p class="text-muted">Rekapitulasi pendapatan harian dari transaksi yang berhasil.</p>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-white">
            <h6 class="m-0 font-weight-bold text-primary">Data Penjualan</h6>
            <button onclick="window.print()" class="btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-print fa-sm text-white-50"></i> Cetak Laporan
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Total Transaksi</th>
                            <th class="text-center">Total Pendapatan</th>
                            <th class="text-center">Status Rata-rata</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporan as $data)
                            <tr>
                                <td class="text-center">{{ \Carbon\Carbon::parse($data->tanggal)->format('d F Y') }}</td>
                                <td class="text-center fw-bold">{{ $data->total_transaksi }} Pesanan</td>
                                <td class="text-end fw-bold text-success">Rp {{ number_format($data->pendapatan, 0, ',', '.') }}
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success">Sukses</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">
                                    <i class="fas fa-folder-open fa-2x mb-3 d-block"></i>
                                    Belum ada data transaksi untuk ditampilkan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    @if($laporan->count() > 0)
                        <tfoot class="table-light fw-bold">
                            <tr>
                                <td class="text-center">TOTAL</td>
                                <td class="text-center">{{ $laporan->sum('total_transaksi') }} Pesanan</td>
                                <td class="text-end text-primary">Rp
                                    {{ number_format($laporan->sum('pendapatan'), 0, ',', '.') }}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    @endif
                </table>
            </div>
        </div>
    </div>
@endsection