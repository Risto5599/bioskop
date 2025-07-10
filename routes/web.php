<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TicketSaleController;
use App\Http\Controllers\ProductSaleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\FilmController;

// Redirect root URL ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Route login dan logout
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route khusus untuk admin (harus login)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    Route::resource('films', FilmController::class);
    Route::resource('products', ProductController::class);
    Route::resource('ticket-sales', TicketSaleController::class);
    Route::resource('product-sales', ProductSaleController::class);
    Route::resource('users', UserController::class);
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('/laporan/cetak-tiket', [LaporanController::class, 'cetakTiket'])->name('laporan.cetak.tiket');
Route::get('/laporan/cetak-produk', [LaporanController::class, 'cetakProduk'])->name('laporan.cetak.produk');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


});
