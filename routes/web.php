<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PenjualanController;

/*
|--------------------------------------------------------------------------
| Routes untuk Login & Logout (Guest)
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Route utama yang dilindungi middleware auth
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Redirect root ke dashboard
    Route::redirect('/', '/dashboard');

    // Halaman dashboard umum untuk semua user yang login
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Route khusus untuk role Admin
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('kategori', KategoriController::class);
        Route::resource('menu', MenuController::class);
        Route::resource('customer', CustomerController::class);
        Route::resource('user', UserController::class);
        Route::resource('pembelian', PembelianController::class);
        Route::resource('stok', StokController::class)->only(['index', 'edit', 'update']);
    });

    /*
    |--------------------------------------------------------------------------
    | Route khusus untuk role Kasir
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:kasir'])->group(function () {

        // Halaman utama kasir
        Route::get('/kasir', [KasirController::class, 'index'])->name('kasir.index');

        // Semua route transaksi dengan prefix /transaksi dan nama route 'transaksi.*'
        Route::prefix('transaksi')->name('transaksi.')->group(function () {
            Route::get('/', [TransaksiController::class, 'index'])->name('index');                      // List transaksi / form kasir
            Route::post('/add-to-cart', [TransaksiController::class, 'addToCart'])->name('addToCart');  // Tambah produk ke keranjang
            Route::get('/cart/remove/{id}', [TransaksiController::class, 'removeFromCart'])->name('removeFromCart');  // Hapus produk dari keranjang
            Route::get('/cart/clear', [TransaksiController::class, 'clearCart'])->name('clearCart');    // Bersihkan keranjang
            Route::post('/simpan', [TransaksiController::class, 'simpanTransaksi'])->name('simpan');    // Simpan transaksi ke database
            Route::get('/checkout', [TransaksiController::class, 'checkout'])->name('checkout');        
            Route::get('/keranjang', [TransaksiController::class, 'getKeranjang'])->name('getKeranjang');
            Route::get('/struk/{id}', [TransaksiController::class, 'cetakStruk'])->name('struk');
        });
            Route::post('/checkout/konfirmasi', [TransaksiController::class, 'konfirmasiCheckout'])->name('checkout.konfirmasi'); // Konfirmasi checkout
            Route::get('/checkout/batal', [TransaksiController::class, 'batalkanCheckout'])->name('checkout.batal'); // Batalkan checkout
            
    });

    /*
    |--------------------------------------------------------------------------
    | Route khusus untuk role Owner
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:owner'])->group(function () {
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index'); // Halaman laporan
        Route::get('/customer/{customer}', [App\Http\Controllers\LaporanController::class, 'show'])->name('laporan.show');
        Route::get('/detail/{penjualan}', [App\Http\Controllers\LaporanController::class, 'detail'])->name('laporan.detail');
    });

    /*
    |--------------------------------------------------------------------------
    | Route umum untuk semua role (auth)
    |--------------------------------------------------------------------------
    */
    Route::resource('penjualan', PenjualanController::class);
});