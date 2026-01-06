<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        // Aggregate Orders by Date
        // We group by date(created_at)
        $laporan = Pesanan::select(
            DB::raw('DATE(created_at) as tanggal'),
            DB::raw('count(*) as total_transaksi'),
            DB::raw('sum(total_harga) as pendapatan')
        )
            ->where('status', '!=', 'Dibatalkan') // Exclude cancelled orders
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('admin.laporan', compact('laporan'));
    }
}
