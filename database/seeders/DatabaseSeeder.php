<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();



        // 1. ADMIN USER
        $admin = User::where('email', 'fendagung515@gmail.com')->first();
        if (!$admin) {
            User::create([
                'name' => 'Fen Agung',
                'email' => 'fendagung515@gmail.com',
                'password' => bcrypt('1234'),
                'role' => 'admin',
            ]);
        } else {
            $admin->update(['role' => 'admin']);
        }

        // 2. CUSTOMER USER
        $customer = User::where('email', 'irfantulis26@gmail.com')->first();
        if (!$customer) {
            User::create([
                'name' => 'Irfan Tulis',
                'email' => 'irfantulis26@gmail.com',
                'password' => bcrypt('12345678'), // Password updated as requested
                'role' => 'customer',
            ]);
        } else {
            $customer->update(['role' => 'customer', 'password' => bcrypt('12345678')]);
        }

        $customer = User::where('email', 'pelanggan@gmail.com')->first();
        if (!$customer) {
            User::create([
                'name' => 'Pelanggan Setia',
                'email' => 'pelanggan@gmail.com',
                'password' => bcrypt('1234'),
            ]);
        }


        // 1. MAKANAN (3 Item)
        \App\Models\Menu::create([
            'nama_menu' => 'Nasi Ayam Bakar',
            'kategori' => 'Makanan',
            'harga' => 20000,
            'deskripsi' => 'Nasi ayam bakar spesial dengan sambal lalapan.',
            'gambar' => '20251225110438.jpeg'
        ]);

        \App\Models\Menu::create([
            'nama_menu' => 'Nasi Lele Bakar',
            'kategori' => 'Makanan',
            'harga' => 25000,
            'deskripsi' => 'Lele bakar gurih dengan nasi hangat.',
            'gambar' => '20251225110549.jpeg'
        ]);

        \App\Models\Menu::create([
            'nama_menu' => 'Nasi Nila Bakar',
            'kategori' => 'Makanan',
            'harga' => 20000,
            'deskripsi' => 'Nila bakar segar bumbu rempah.',
            'gambar' => '20251225110707.jpeg'
        ]);

        // 2. MINUMAN DINGIN (3 Item)
        \App\Models\Menu::create([
            'nama_menu' => 'Es Buah Apel',
            'kategori' => 'Minuman Dingin',
            'harga' => 5000,
            'deskripsi' => 'Minuman segar rasa apel alami.',
            'gambar' => '20251225111013.jpeg'
        ]);

        \App\Models\Menu::create([
            'nama_menu' => 'Buah Naga',
            'kategori' => 'Minuman Dingin',
            'harga' => 6000,
            'deskripsi' => 'Jus buah naga segar kaya vitamin.',
            'gambar' => '20251225110924.jpeg'
        ]);

        \App\Models\Menu::create([
            'nama_menu' => 'Es Buah Alpukat',
            'kategori' => 'Minuman Dingin',
            'harga' => 12000,
            'deskripsi' => 'Es alpukat kocok lezat.',
            'gambar' => '20251225110841.jpeg'
        ]);

        // 3. KOPI (3 Item)
        \App\Models\Menu::create([
            'nama_menu' => 'Kopi Hitam',
            'kategori' => 'Kopi',
            'harga' => 8000,
            'deskripsi' => 'Kopi hitam robusta asli.',
            'gambar' => '20251225111451.jpg'
        ]);

        \App\Models\Menu::create([
            'nama_menu' => 'Kopi Susu Gula Aren',
            'kategori' => 'Kopi',
            'harga' => 15000,
            'deskripsi' => 'Kopi susu kekinian dengan gula aren.',
            'gambar' => '20251225111610.jpg'
        ]);

        \App\Models\Menu::create([
            'nama_menu' => 'Cappuccino',
            'kategori' => 'Kopi',
            'harga' => 18000,
            'deskripsi' => 'Cappuccino hangat dengan foam lembut.',
            'gambar' => '20251225111656.jpg'
        ]);
    }
}
