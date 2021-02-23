<?php

use App\Http\Controllers\BarangController;
use Illuminate\Support\Facades\Route;

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

Route::get('/',             [BarangController::class, 'index'])->name('home');
Route::get('listbarang',    [BarangController::class, 'list'])->name('list');
Route::get('barang/{id}',   [BarangController::class, 'show'])->name('show');
Route::get('form/{id}',     [BarangController::class, 'form'])->name('form');
Route::post('form/{id}',    [BarangController::class, 'store'])->name('store');
