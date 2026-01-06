<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\PesananController;
// Pastikan path ini benar. Jika controller Anda di dalam folder Admin:
use App\Http\Controllers\Admin\KatalogController;
// Jika controller Anda TIDAK di dalam folder Admin:
// use App\Http\Controllers\KatalogController; 


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute Halaman Utama (Homepage)
Route::get('/', function () {
    $query = \App\Models\Menu::query();
    if (request('search')) {
        $query->where('nama_menu', 'like', '%' . request('search') . '%');
    }
    $menus = $query->get();
    return view('welcome', compact('menus'));
})->name('welcome');

Route::resource('menu', MenuController::class);

// --- CART ROUTES ---
Route::get('cart', [CartController::class, 'index'])->name('cart');
Route::get('add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add.to.cart');
Route::patch('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('remove-from-cart', [CartController::class, 'remove'])->name('cart.remove');
Route::post('checkout', [CartController::class, 'checkout'])->name('checkout');

// --- AUTHENTICATION ROUTES (MANUAL) ---
use App\Http\Controllers\Auth\LoginController;

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// --- AREA ROUTE ADMINISTRATOR CAFE JINEMMO ---

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    // 1. Dashboard Admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // 2. DAFTAR MENU (Route Resource Penuh)
    // URL: /admin/daftar-menu (Menggantikan /admin/katalog)
    // Nama Route: admin.katalog.index, admin.katalog.create, dll (Tetap sama agar tidak ubah Controller/View)
    Route::resource('daftar-menu', KatalogController::class)->names([
        'index' => 'katalog',
        'create' => 'katalog.create',
        'edit' => 'katalog.edit',
        'destroy' => 'katalog.destroy',
        'store' => 'katalog.store',
        'update' => 'katalog.update',
        'show' => 'katalog.show',
    ]);

    // 3. Manajemen Pesanan
    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan');
    Route::patch('/pesanan/{id}', [PesananController::class, 'updateStatus'])->name('pesanan.update');

    // 4. Integrasi Sosial Media
    Route::get('/sosmed', function () {
        return view('admin.sosmed');
    })->name('sosmed');

    // 5. Laporan Harian
    Route::get('/laporan', [\App\Http\Controllers\Admin\LaporanController::class, 'index'])->name('laporan');

});