<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\HomeController;

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
Route::get('/hapus-pelanggan/{id}',[PelangganController::class,'hapus'])->name('hapus.pelanggan');

Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Clear Config cleared</h1>';
});