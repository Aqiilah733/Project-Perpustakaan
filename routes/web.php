<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\RiwayatController;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\FuncCall;

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

Route::get('/', function () {
    return view('/home');
});

Route::middleware(['guest'])->group(function(){
    Route::get('admin/login', [LoginController::class, 'loginFormAdmin']);
    Route::post('admin/login', [LoginController::class, 'prosesLoginAdmin']);

    Route::get('anggota/login', [LoginController::class, 'loginForm']);
    Route::post('anggota/login', [LoginController::class, 'prosesLogin']);
 });

 
 
 Route::middleware(['logberhasil'])->group(Function () {
    Route::post('/logout', [LoginController::class,'logout'])->name('logout');
    Route::get('anggota/list-buku', [ListController::class, 'buku']);
    Route::get('anggota/riwayat', [RiwayatController::class, 'index']);
 });
 
 Route::middleware(['auth:admin'])->group(function(){
    Route::get('admin/dashboard', [DashboardController::class, 'index']);
    Route::resource('admin/buku', BukuController::class);
    Route::resource('admin/anggota', AnggotaController::class);
    Route::resource('admin/admin', AdminController::class);
    Route::resource('admin/kategori', KategoriController::class);
    Route::post('admin/peminjaman/{f_id}', [PeminjamanController::class, 'pengembalian'])->name('pengembalian');
    Route::resource('admin/peminjaman', PeminjamanController::class)->except('show');
   Route::get('admin/peminjaman/pdf', [PeminjamanController::class, 'PDF']);
    
 });