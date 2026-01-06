<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        $pesanans = Pesanan::with(['user', 'details.menu'])->orderBy('created_at', 'desc')->get();
        return view('admin.pesanan', compact('pesanans'));
    }

    public function show($id)
    {
        $pesanan = Pesanan::with(['details.menu', 'user'])->findOrFail($id);
        return view('admin.pesanan_detail', compact('pesanan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->status = $request->status;
        $pesanan->save();

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }
}
