<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\Dashboard\DaftarMataKuliahController;
use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\InventarisController;
use App\Http\Controllers\Dashboard\MataKuliahController;
use App\Http\Controllers\Dashboard\PeminjamanBarangController;
use App\Http\Controllers\Dashboard\PeminjamanRuanganController;
use App\Http\Controllers\Dashboard\PendaftaranAsprakController;
use App\Http\Controllers\Dashboard\PenjadwalanController;
use App\Http\Controllers\Dashboard\RekrutAsprakController;
use App\Http\Controllers\Dashboard\SuratController;
use App\Http\Controllers\RuanganController;
use App\Models\FormBarang;
use App\Models\Inventaris;
use App\Models\PeminjamanBarang;

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

// Testing
Route::get('/test', function () {
    $form = FormBarang::find(1);
    $peminjaman = PeminjamanBarang::where('form_barang_id', $form->id)->get();
    foreach ($peminjaman as $pem) {
        $inven = Inventaris::where('id', $pem->barang_id)->first();
        $inven->update([
            'peminjaman' => $inven->peminjaman - $pem->jumlah
        ]);
    }
});


// Home
Route::get('/', function () {
    return view('barang.index');
})->name('home');

// Route Client Peminjaman Barang
Route::get('barang/list',               [BarangController::class, 'list'])->name('barang.list');
Route::get('barang/{id}',               [BarangController::class, 'show'])->name('barang.show');
Route::get('form/barang',               [BarangController::class, 'form'])->name('barang.form');
Route::post('form/barang',              [BarangController::class, 'store'])->name('brang.store');


// Route Client Peminjaman Ruangan
Route::get('form/ruangan',              [RuanganController::class, 'form'])->name('ruangan.form');
Route::post('form/ruangan',             [RuanganController::class, 'store'])->name('ruangan.store');

// auth
Route::get('login',         [AuthController::class, 'index'])->name('login');
Route::post('login',        [AuthController::class, 'login'])->name('loginPost');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin'], function () {
    Route::get('dashboard',                     [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('logout',                       [AuthController::class, 'logout'])->name('logout');
    Route::get('surat/masuk',                   [SuratController::class, 'masuk'])->name('surat.masuk');
    Route::get('surat/keluar',                  [SuratController::class, 'keluar'])->name('surat.keluar');
    Route::resource('surat',                    SuratController::class)->except(['index']);
    Route::get('penjadwalan',                   [PenjadwalanController::class, 'index'])->name('penjadwalan.index');
    Route::post('penjadwalan/delete',           [PenjadwalanController::class, 'destroy'])->name('penjadwalan.destroy');
    Route::post('penjadwalan/reset',            [PenjadwalanController::class, 'massReset'])->name('penjadwalan.reset');

    Route::group(['middleware' => 'Admin:superadmin'], function () {
        // Route Admin Inventaris Barang
        Route::resource('inventaris',   InventarisController::class);

        // Route Peminjaman Barang
        Route::get('peminjaman/barang',             [PeminjamanBarangController::class, 'index'])->name('peminjaman.barang');
        Route::post('peminjaman/barang',            [PeminjamanBarangController::class, 'status'])->name('peminjaman.barang.update');
        Route::get('peminjaman/barang/riwayat',     [PeminjamanBarangController::class, 'riwayat'])->name('peminjaman.barang.riwayat');

        // Route Peminjaman Ruangan
        Route::get('peminjaman/ruangan',            [PeminjamanRuanganController::class, 'index'])->name('peminjaman.ruangan');
        Route::post('peminjaman/ruangan',           [PeminjamanRuanganController::class, 'status'])->name('peminjaman.ruangan.update');
        Route::get('peminjaman/ruangan/riwayat',    [PeminjamanRuanganController::class, 'riwayat'])->name('peminjaman.ruangan.riwayat');
    });
    Route::group(['middleware' => ['Admin:superadmin']], function () {
        Route::resource('rekrut',                   PendaftaranAsprakController::class);
        Route::resource('matakuliah',               MataKuliahController::class)->except(['index', 'show']);
        Route::resource('daftarmatakuliah',         DaftarMataKuliahController::class)->only(['create', 'store']);

        Route::get('rekrut/matkul/{id}',            [RekrutAsprakController::class, 'indexMataKuliah'])->name('rekrut.matkul.index');
        Route::get('rekrut/matkut/create',          [RekrutAsprakController::class, 'addMataKuliah'])->name('rekrut.matkul.create');
    });
});




// // Pembukaan pendaftaran by admin
// Route::get('/open-pendaftaran', [pendaftarcontroller::class, 'openpendaftaran'])->name('pembukaan');
// Route::get('/open-pendaftaran/tambah', [pendaftarcontroller::class, 'tambahpendaftaran'])->name('tambahpendaftaran');
// Route::post('/open-pendaftaran/tambah', [pendaftarcontroller::class, 'prosestambahpendaftaran'])->name('prosestambahpendaftaran');

// // Penambahan matakuliah
// Route::get('/mata-kuliah/{id}', [pendaftarcontroller::class, 'listmatkul'])->name('listmatkul');
// Route::post('/mata-kuliah/{id}', [pendaftarcontroller::class, 'prosestambahmatkul'])->name('prosestambahmatkul');

// // main admin
// Route::get('/admin', [admincontroller::class, 'index'])->name('homeadmin');
// Route::get('/soal-generator', [])->name('generatorsoal');

// // pendaftaran peserta
// Route::get('/daftar', [pendaftarcontroller::class, 'daftar'])->name('pendaftaran');
// Route::post('/daftar/proses', [pendaftarcontroller::class, 'proses'])->name('prosespendaftaran');
