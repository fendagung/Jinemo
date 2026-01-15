<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Pesanan; // Ensure this model exists or create it later
use App\Models\PesananDetail; // Ensure this model exists or create it later
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    public function addToCart($id)
    {
        $menu = Menu::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $menu->nama_menu,
                "quantity" => 1,
                "price" => $menu->harga,
                "image" => $menu->gambar
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Menu berhasil ditambahkan ke keranjang!');
    }

    public function updateCart(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Keranjang berhasil diperbarui');
        }
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Menu dihapus dari keranjang');
        }
    }

    public function checkout(Request $request)
    {
        // Simple Checkout Logic
        // In a real app, this would integrate with a payment gateway.
        // Here we just save it as a "Pending" order.

        $cart = session()->get('cart');
        if (!$cart) {
            return redirect()->back()->with('error', 'Keranjang kosong!');
        }

        // Check if user is logged in (Optional for guest checkout)
        // Removed Auth::check() to allow guests to checkout

        DB::beginTransaction();
        try {
            // Create Pesanan
            $pesanan = new Pesanan();
            $pesanan->user_id = Auth::id();
            $pesanan->tanggal_pesanan = now();
            $pesanan->status = 'Menunggu Konfirmasi';
            $pesanan->total_harga = 0; // Will calculate below
            $pesanan->save();

            $total = 0;
            foreach ($cart as $id => $details) {
                $subtotal = $details['price'] * $details['quantity'];
                $total += $subtotal;

                // Create Pesanan Detail
                $detail = new PesananDetail();
                $detail->pesanan_id = $pesanan->id;
                $detail->menu_id = $id;
                $detail->jumlah = $details['quantity'];
                $detail->harga_satuan = $details['price'];
                $detail->subtotal = $subtotal;
                $detail->save();
            }

            $pesanan->total_harga = $total;
            $pesanan->save();

            DB::commit();
            session()->forget('cart');

            return redirect()->route('welcome')->with('success', 'Pesanan berhasil dibuat! Silakan tunggu konfirmasi admin.');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat proses checkout: ' . $e->getMessage());
        }
    }
}
