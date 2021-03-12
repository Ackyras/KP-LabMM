<?php

use App\Http\Controllers\authcontroller;
use App\Http\Controllers\pendaftarcontroller;
use App\Http\Controllers\BarangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\InventarisController;

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
    return view('welcome');
})->name('home');

// auth
Route::get('login', [authcontroller::class, 'indexlogin'])->name('login');
Route::get('login', [authcontroller::class, 'proseslogin'])->name('login.proses');
Route::get('logout', [authcontroller::class, 'logout'])->name('logout');

Route::group(['middleware'=>['auth']], function(){
    Route::group(['middleware'=>['Cek_login:admin']], function(){


    });
    Route::group(['middleware'=>['Cek_login:user']], function(){

    });
});

// Route Client Peminjaman Barang
Route::get('daftarbarang',              [BarangController::class, 'list'])->name('list');
Route::get('barang/{id}',               [BarangController::class, 'show'])->name('show');
Route::get('form',                      [BarangController::class, 'form'])->name('form');
Route::post('form',                     [BarangController::class, 'store'])->name('store');


// Route Admin Inventaris Barang
Route::resource('inventaris',   InventarisController::class);

// Route Peminjaman Ruangan
Route::get('admin/peminjaman',          [BarangController::class, 'index'])->name('peminjaman.barang');
Route::post('admin/peminjaman',         [BarangController::class, 'status'])->name('peminjaman.barang.update');
Route::get('admin/peminjaman/riwayat',  [BarangController::class, 'riwayat'])->name('peminjaman.barang.riwayat');

// Pembukaan pendaftaran by admin
Route::get('/open-pendaftaran', [pendaftarcontroller::class, 'openpendaftaran'])->name('pembukaan');
Route::post('/open-pendaftaran', [pendaftarcontroller::class, 'prosesopen'])->name('prosespembukaan');
Route::get('/open-pendaftaran/tambah', [pendaftarcontroller::class, 'tambahpendaftaran'])->name('tambahpendaftaran');
Route::post('/open-pendaftaran/tambah', [pendaftarcontroller::class, 'prosestambahpendaftaran'])->name('prosestambahpendaftaran');

// Penambahan matakuliah
Route::get('/mata-kuliah/{id}', [pendaftarcontroller::class, 'tambahmatkul'])->name('tambahmatkul');
Route::post('/mata-kuliah/{id}', [pendaftarcontroller::class, 'prosestambahmatkul'])->name('prosestambahmatkul');

// main admin
Route::get('/admin', [admincontroller::class, 'index'])->name('homeadmin');
Route::get('/soal-generator', [])->name('generatorsoal');

// pendaftaran peserta
Route::get('/daftar', [pendaftarcontroller::class, 'daftar'])->name('pendaftaran');
Route::post('/daftar/proses', [pendaftarcontroller::class, 'proses'])->name('prosespendaftaran');
