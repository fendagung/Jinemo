<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'nama_pelanggan' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string',
        ]);

        Review::create($request->all());

        return redirect()->back()->with('success', 'Ulasan Anda berhasil dikirim! Terima kasih atas masukkannya.');
    }
}
