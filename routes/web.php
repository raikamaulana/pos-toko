<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('users', UserController::class);
    Route::get('/reports/sales', [ReportController::class, 'sales'])->name('report.sales');
    Route::get('/reports/sales/export', [ReportController::class, 'export'])->name('report.export');
    Route::resource('suppliers', SupplierController::class)->except(['show']);
    Route::resource('purchases', PurchaseController::class)->only(['index', 'create', 'store', 'show']);
});

Route::middleware(['auth', 'role:admin,kasir'])->group(function () {
    Route::get('/pos', [PosController::class, 'index'])->name('pos.index');
    Route::post('/pos', [PosController::class, 'store'])->name('pos.store');
    Route::get('/pos/history', fn () => 'Halaman Riwayat Transaksi Saya')->name('pos.history');
    Route::get('/pos/history', [PosController::class, 'history'])->name('pos.history');
    Route::get('/pos/{transaction}/struk', [PosController::class, 'struk'])->name('pos.struk');
});

use App\Http\Controllers\Auth\LoginController;
Route::get('/login', [LoginController::class, 'create'])
    ->middleware('guest')
    ->name('login');
Route::post('/login', [LoginController::class, 'store'])
    ->middleware('guest')
    ->name('login.store');
Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::get('/about', function () {
    return '<h1>Tentang POS Barokah Mart</h1>
            <p>POS Barokah Mart adalah aplikasi Point of Sale berbasis web untuk mengelola data kategori, produk, stok barang, dan transaksi penjualan harian toko kelontong Barokah Mart.</p>';
})->name('about');


