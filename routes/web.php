<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DaftarAsprakController;
use App\Http\Controllers\Dashboard\DaftarMataKuliahController;
use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\InventarisController;
use App\Http\Controllers\Dashboard\ManagementUser;
use App\Http\Controllers\Dashboard\MataKuliahController;
use App\Http\Controllers\Dashboard\PeminjamanBarangController;
use App\Http\Controllers\Dashboard\PeminjamanRuanganController;
use App\Http\Controllers\Dashboard\PendaftaranAsprakController;
use App\Http\Controllers\Dashboard\PenjadwalanController;
use App\Http\Controllers\Dashboard\SuratController;
use App\Http\Controllers\RuanganController as RuanganForm;
use App\Http\Controllers\Dashboard\RuanganController as RuanganAdmin;
use App\Http\Controllers\Dashboard\VerifikasiController;
use Illuminate\Support\Facades\Auth;

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
Route::view('/', 'home.index')->name('home');
Route::view('/home', 'home.index')->name('home');

// Auth Routes
Auth::routes();

// Route Client Peminjaman Barang
Route::get('barang/list',               [BarangController::class, 'list'])->name('barang.list');
Route::get('barang/list/elektronik',    [BarangController::class, 'listElektronik'])->name('barang.list.elektronik');
Route::get('barang/list/nonelektronik', [BarangController::class, 'listNonElektronik'])->name('barang.list.nonelektronik');
Route::get('barang/list/tpb',           [BarangController::class, 'listTpb'])->name('barang.list.tpb');
Route::get('barang/list/prodi',         [BarangController::class, 'listProdi'])->name('barang.list.prodi');
Route::get('barang/search',             [BarangController::class, 'search'])->name('barang.search');
Route::get('barang/{id}',               [BarangController::class, 'show'])->name('barang.show');
Route::get('form/barang',               [BarangController::class, 'form'])->name('barang.form');
Route::post('form/barang',              [BarangController::class, 'store'])->name('barang.store');


// Route Client Peminjaman Ruangan
Route::get('form/ruangan',              [RuanganForm::class, 'form'])->name('ruangan.form');
Route::post('form/ruangan',             [RuanganForm::class, 'store'])->name('ruangan.store');

// Route Pendaftaran Calon Asprak
Route::resource('calonasprak',          DaftarAsprakController::class)->only(['index', 'store']);
Route::get('calonasprak/login',         [DaftarAsprakController::class, 'login'])->name('calonasprak.login');
Route::post('calonasprak/login',        [DaftarAsprakController::class, 'loginpost'])->name('calonasprak.login.post');
Route::get('calonasprak/daftar',        [DaftarAsprakController::class, 'form'])->name('calonasprak.form');
Route::get('calonasprak/jadwal',        [DaftarAsprakController::class, 'jadwal'])->name('calonasprak.jadwal');
Route::get('calonasprak/tidak-ada-pembukaan',   [DaftarAsprakController::class, 'none'])->name('calonasprak.none');


// Route Seleksi Calon Asprak
Route::group(['middleware' => ['CalonAsprak']], function () {
    Route::get('calonasprak/seleksi',       [DaftarAsprakController::class, 'seleksi'])->name('calonasprak.seleksi');
    Route::get('calonasprak/seleksi/{id}',  [DaftarAsprakController::class, 'seleksishow'])->name('calonasprak.test');
    Route::post('calonasprak/seleksi/{id}', [DaftarAsprakController::class, 'seleksiupload'])->name('calonasprak.test.store');
    Route::post('calonasprak/logout',       [DaftarAsprakController::class, 'logout'])->name('calonasprak.logout');
});

Route::group(['middleware' => 'Admin', 'prefix' => 'admin'], function () {
    Route::get('dashboard',                     [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('logout',                       [AuthController::class, 'logout'])->name('logout');
    Route::resource('user',                     ManagementUser::class)->only(['edit', 'update']);
});

Route::group(['middleware' => 'OnlyLaboran', 'prefix' => 'admin'], function () {
    Route::get('surat/masuk',                   [SuratController::class, 'masuk'])->name('surat.masuk');
    Route::get('surat/keluar',                  [SuratController::class, 'keluar'])->name('surat.keluar');
    Route::get('surat/search',                  [SuratController::class, 'search'])->name('surat.search');
    Route::resource('surat',                    SuratController::class)->except(['index']);
});

Route::group(['middleware' => 'SuperAdmin', 'prefix' => 'admin'], function () {
    Route::post('user/reset',                   [Managementuser::class, 'reset'])->name('user.resetasprak');
    Route::resource('user',                     ManagementUser::class)->except(['show', 'edit', 'update']);
});

Route::group(['middleware' => 'Inventaris', 'prefix' => 'admin'], function () {
    // Route Admin Inventaris Barang
    Route::get('inventaris/search', [InventarisController::class, 'search'])->name('inventaris.search');
    Route::resource('inventaris',   InventarisController::class);

    // Route Peminjaman Barang
    Route::get('peminjaman/barang',             [PeminjamanBarangController::class, 'index'])->name('peminjaman.barang');
    Route::post('peminjaman/barang',            [PeminjamanBarangController::class, 'status'])->name('peminjaman.barang.update');
    Route::get('peminjaman/barang/search',      [PeminjamanBarangController::class, 'search'])->name('peminjaman.barang.search');
    Route::get('peminjaman/barang/telat',       [PeminjamanBarangController::class, 'telat'])->name('peminjaman.barang.telat');
    Route::get('peminjaman/barang/riwayat',     [PeminjamanBarangController::class, 'riwayat'])->name('peminjaman.barang.riwayat');
    Route::get('peminjaman/barang/riwayat/search', [PeminjamanBarangController::class, 'searchriwayat'])->name('peminjaman.barang.riwayat.search');
    Route::get('peminjaman/barang/{status}',    [PeminjamanBarangController::class, 'filter'])->name('peminjaman.barang.filter');
});

Route::group(['middleware' => 'Ruangan', 'prefix' => 'admin'], function () {
    // Route Peminjaman Ruangan
    Route::get('peminjaman/ruangan',            [PeminjamanRuanganController::class, 'index'])->name('peminjaman.ruangan');
    Route::post('peminjaman/ruangan',           [PeminjamanRuanganController::class, 'status'])->name('peminjaman.ruangan.update');
    Route::get('peminjaman/ruangan/search',     [PeminjamanRuanganController::class, 'search'])->name('peminjaman.ruangan.search');
    Route::get('peminjaman/ruangan/riwayat',    [PeminjamanRuanganController::class, 'riwayat'])->name('peminjaman.ruangan.riwayat');
    Route::get('peminjaman/ruangan/riwayat/search', [PeminjamanRuanganController::class, 'searchriwayat'])->name('peminjaman.ruangan.riwayat.search');
    Route::get('peminjaman/ruangan/{slug}',     [PeminjamanRuanganController::class, 'filter'])->name('peminjaman.ruangan.filter');
    Route::get('peminjaman/ruangan/riwayat/{slug}', [PeminjamanRuanganController::class, 'riwayatfilter'])->name('peminjaman.ruangan.riwayat.filter');

    // Route Penjadwalan Ruangan
    Route::get('penjadwalan',                   [PenjadwalanController::class, 'index'])->name('penjadwalan.index');
    Route::post('penjadwalan/delete',           [PenjadwalanController::class, 'destroy'])->name('penjadwalan.destroy');
    Route::post('penjadwalan/reset',            [PenjadwalanController::class, 'massReset'])->name('penjadwalan.reset');
    Route::resource('ruanglab',                 RuanganAdmin::class)->except(['show']);
});

Route::group(['middleware' => 'Asprak', 'prefix' => 'admin'], function () {
    // Verifikasi Berkas
    Route::get('asprak/verifikasi',             [VerifikasiController::class, 'index'])->name('asprak.index');
    Route::get('asprak/verifikasi/search',      [VerifikasiController::class, 'berkasmatkul'])->name('asprak.index.matkul');
    Route::post('asprak/verifikasi',            [VerifikasiController::class, 'verifikasiberkas'])->name('asprak.verifikasi');

    // Route Pembukaan Pendaftaran Asprak
    Route::resource('rekrut',                   PendaftaranAsprakController::class);
    Route::resource('matakuliah',               MataKuliahController::class)->except(['index', 'show']);
    Route::resource('daftarmatakuliah',         DaftarMataKuliahController::class)->only(['create', 'store']);
});

Route::group(['middleware' => 'Dosen', 'prefix' => 'admin'], function () {
    // Verifikasi Kelulusan dan Penilaian
    Route::get('asprak/penilaian',              [VerifikasiController::class, 'indexnilai'])->name('asprak.nilai.index');
    Route::post('asprak/penilain',              [VerifikasiController::class, 'penilaian'])->name('asprak.verifikasi.nilai');
    Route::get('asprak/verifikasi/nilai/search', [VerifikasiController::class, 'penilaianmatkul'])->name('asprak.nilai.index.matkul');
    Route::post('asprak/verifikasi/lulus',      [VerifikasiController::class, 'verifikasilulus'])->name('asprak.verifikasi.lulus');
});
