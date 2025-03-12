<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', 'App\Http\Controllers\api\AuthController@register');
Route::post('/login', 'App\Http\Controllers\api\AuthController@login');
Route::post('/logout', 'App\Http\Controllers\api\AuthController@logout')->middleware('auth:sanctum');
Route::get('/profile', 'App\Http\Controllers\api\AuthController@profile')->middleware('auth:sanctum');
Route::put('/profile', 'App\Http\Controllers\api\AuthController@updateProfile')->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('/laporan-keuangan', 'App\Http\Controllers\api\LaporanKeuanganController');
    Route::apiResource('/anggaran', 'App\Http\Controllers\api\AnggaranController');
    Route::apiResource('/transaksi', 'App\Http\Controllers\api\TransaksiController');
    Route::apiResource('/kategori', 'App\Http\Controllers\api\KategoriController');
});
