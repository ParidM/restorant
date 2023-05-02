<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', function () {
    return redirect()->route('login');
});

Route::resource('/pelanggan', PelangganController::class);
Route::resource('/cart', CartController::class);
Route::get('/hapus-pelanggan/{id}',[PelangganController::class,'hapus'])->name('hapus.pelanggan');
Route::resource('/supplier', SupplierController::class);
Route::get('/hapus-supplier/{id}',[SupplierController::class,'hapus'])->name('hapus.supplier');
Route::resource('/barang', BarangController::class);
Route::get('/hapus-barang/{id}',[BarangController::class,'hapus'])->name('hapus.barang');
Route::resource('/barang-masuk', BarangMasukController::class);
Route::get('/hapus-barang-masuk/{id}',[BarangMasukController::class,'hapus'])->name('hapus.barang-masuk');
Route::resource('/transaksi', TransaksiController::class);
Route::get('/hapus-transaksi/{id}',[TransaksiController::class,'hapus'])->name('hapus.transaksi');


Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Clear Config cleared</h1>';
});