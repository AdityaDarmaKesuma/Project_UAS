<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProdukController;
use App\Models\KategoriProduk;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');;

Route::group(['middleware' => 'guest'], function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('register-store', [AuthController::class, 'register_store'])->name('user.register');
    Route::post('login-store', [AuthController::class, 'login_store'])->name('user.login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('user.logout');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // produk
    Route::get('produk', [ProdukController::class, 'list'])->name('produk.list');
    Route::get('produk/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('produk/create', [ProdukController::class, 'simpan'])->name('produk.store');
    Route::get('produk/edit/{id}', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('produk/edit/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::get('produk/show/{id}', [ProdukController::class, 'show'])->name('produk.show');
    Route::delete('produk/{id}', [ProdukController::class, 'delete'])->name('produk.delete');
    Route::get('etalase', [ProdukController::class, 'etalase'])->name('produk.etalase');
    Route::get('etalase/detail/{id}', [ProdukController::class, 'detail'])->name('produk.detail');

    // kategori
    Route::get('kategori', [KategoriController::class, 'list'])->name('kategori.list');
    Route::get('kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('kategori/create', [KategoriController::class, 'simpan'])->name('kategori.store');
    Route::get('kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('kategori/edit/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('kategori/{id}', [KategoriController::class, 'delete'])->name('kategori.delete');

    // pesanan
    Route::get('pesanan', [PesananController::class, 'list'])->name('pesanan.list');
    Route::get('pesanan/create', [PesananController::class, 'create'])->name('pesanan.create');
    Route::post('pesanan/create', [PesananController::class, 'simpan'])->name('pesanan.store');
    Route::get('pesanan/edit/{id}', [PesananController::class, 'edit'])->name('pesanan.edit');
    Route::put('pesanan/edit/{id}', [PesananController::class, 'update'])->name('pesanan.update');
    Route::get('pesanan/show/{id}', [PesananController::class, 'show'])->name('pesanan.show');
    Route::delete('pesanan/{id}', [PesananController::class, 'delete'])->name('pesanan.delete');
});
