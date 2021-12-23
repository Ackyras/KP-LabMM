<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\Dashboard\PresensiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    return response([
        'status'    =>  true,
    ]);
});
Route::post('login',        [AuthController::class, 'login']);
Route::get('user/{id}',     [AuthController::class, 'profile']);
Route::resource('presensi',                 PresensiController::class)->except(['index', 'create']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('presensi',     [UserController::class, 'presensi']);
    Route::post('logout',        [AuthController::class, 'logout']);
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
