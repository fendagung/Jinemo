<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    /**
     * Menampilkan daftar semua produk (Katalog Produk Admin).
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengambil data dari database
        $products = \App\Models\Menu::all();

        // Mengirimkan data produk ke view 'admin.katalog'
        return view('admin.katalog', compact('products'));
    }

    // --- Metode CRUD lainnya untuk Route Resource ---

    public function create()
    {
        // Method untuk menampilkan formulir tambah produk
        return view('admin.produk_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required',
            'harga' => 'required|numeric',
            'kategori' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('gambar')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $profileImage);
            $input['gambar'] = "$profileImage";
        }

        \App\Models\Menu::create($input);

        return redirect()->route('admin.katalog')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        // Method untuk menampilkan formulir edit produk
        $product = \App\Models\Menu::findOrFail($id);
        return view('admin.produk_edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_menu' => 'required',
            'harga' => 'required|numeric',
            'kategori' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $input = $request->all();
        $product = \App\Models\Menu::findOrFail($id);

        if ($image = $request->file('gambar')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $profileImage);
            $input['gambar'] = "$profileImage";

            // Opsional: Hapus gambar lama jika ada
            if ($product->gambar && file_exists(public_path('images/' . $product->gambar))) {
                unlink(public_path('images/' . $product->gambar));
            }
        } else {
            unset($input['gambar']);
        }

        $product->update($input);

        return redirect()->route('admin.katalog')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $product = \App\Models\Menu::findOrFail($id);

        // Hapus gambar jika ada
        if ($product->gambar && file_exists(public_path('images/' . $product->gambar))) {
            unlink(public_path('images/' . $product->gambar));
        }

        $product->delete();
        return redirect()->route('admin.katalog')->with('success', 'Produk berhasil dihapus!');
    }
}