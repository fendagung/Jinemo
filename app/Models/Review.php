<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'nama_pelanggan',
        'rating',
        'komentar',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
