<?php

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UangKasController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PenguranganSaldoController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\KontrakkanController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\PabrikController;

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Autentikasi menggunakan Auth::routes()
Auth::routes();

// Rute untuk home setelah login
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rute resource untuk siswa, pembayaran, dan transaksi
Route::resource('siswa', SiswaController::class);
Route::resource('pembayaran', PembayaranController::class);
Route::resource('uang_kas', UangKasController::class);

Route::resource('pengurangansaldo', PenguranganSaldoController::class);
Route::resource('t', TokoController::class);
Route::resource('k', KontrakkanController::class);
Route::resource('p', ProyekController::class);
Route::resource('b', PabrikController::class);





