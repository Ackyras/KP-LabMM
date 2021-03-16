<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\pendaftarcontroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\InventarisController;
use App\Http\Controllers\Dashboard\PeminjamanBarangController;
use App\Http\Controllers\Dashboard\PeminjamanRuanganController;
use App\Http\Controllers\RuanganController;

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
// Home
Route::get('/', function () {
    return view('barang.index');
})->name('home');

// auth
Route::get('login', [AuthController::class, 'indexlogin'])->name('login');
Route::post('login', [AuthController::class, 'proseslogin'])->name('login.proses');
Route::get('register', [AuthController::class, 'indexregister'])->name('register');
Route::post('register', [AuthController::class], 'registerproses')->name('register.proses');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Route::group(['middleware'=>['auth']], function(){
//     Route::group(['middleware'=>['Cek_login:admin']], function(){


//     });
//     Route::group(['middleware'=>['Cek_login:user']], function(){

//     });
// });

Route::get('admin/dashboard',           [DashboardController::class, 'index'])->name('admin.dashboard');

// Route Client Peminjaman Barang
Route::get('barang/list',               [BarangController::class, 'list'])->name('barang.list');
Route::get('barang/{id}',               [BarangController::class, 'show'])->name('barang.show');
Route::get('form/barang',               [BarangController::class, 'form'])->name('barang.form');
Route::post('form/barang',              [BarangController::class, 'store'])->name('brang.store');


// Route Client Peminjaman Ruangan
Route::get('form/ruangan',              [RuanganController::class, 'form'])->name('ruangan.form');
Route::post('form/ruangan',             [RuanganController::class, 'store'])->name('ruangan.store');

// Route Admin Inventaris Barang
Route::resource('inventaris',   InventarisController::class);

// Route Peminjaman Barang
Route::get('admin/peminjaman/barang',           [PeminjamanBarangController::class, 'index'])->name('peminjaman.barang');
Route::post('admin/peminjaman/barang',          [PeminjamanBarangController::class, 'status'])->name('peminjaman.barang.update');
Route::get('admin/peminjaman/barang/{id}',      [PeminjamanBarangController::class, 'show'])->name('peminjaman.barang.show');
Route::get('admin/peminjaman/barang/riwayat',   [PeminjamanBarangController::class, 'riwayat'])->name('peminjaman.barang.riwayat');

// Route Peminjaman Ruangan
Route::get('admin/peminjaman/ruangan',           [PeminjamanRuanganController::class, 'index'])->name('peminjaman.ruangan');
Route::post('admin/peminjaman/ruangan',          [PeminjamanRuanganController::class, 'status'])->name('peminjaman.ruangan.update');
Route::get('admin/peminjaman/ruangan/{id}',      [PeminjamanRuanganController::class, 'show'])->name('peminjaman.ruangan.show');
Route::get('admin/peminjaman/ruangan/riwayat',   [PeminjamanRuanganController::class, 'riwayat'])->name('peminjaman.ruangan.riwayat');

// Pembukaan pendaftaran by admin
Route::get('/open-pendaftaran', [pendaftarcontroller::class, 'openpendaftaran'])->name('pembukaan');
Route::get('/open-pendaftaran/tambah', [pendaftarcontroller::class, 'tambahpendaftaran'])->name('tambahpendaftaran');
Route::post('/open-pendaftaran/tambah', [pendaftarcontroller::class, 'prosestambahpendaftaran'])->name('prosestambahpendaftaran');

// Penambahan matakuliah
Route::get('/mata-kuliah/{id}', [pendaftarcontroller::class, 'listmatkul'])->name('listmatkul');
Route::post('/mata-kuliah/{id}', [pendaftarcontroller::class, 'prosestambahmatkul'])->name('prosestambahmatkul');

// main admin
Route::get('/admin', [admincontroller::class, 'index'])->name('homeadmin');
Route::get('/soal-generator', [])->name('generatorsoal');

// pendaftaran peserta
Route::get('/daftar', [pendaftarcontroller::class, 'daftar'])->name('pendaftaran');
Route::post('/daftar/proses', [pendaftarcontroller::class, 'proses'])->name('prosespendaftaran');
