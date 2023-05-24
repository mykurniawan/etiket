<?php

use App\Http\Controllers\MetodeBayarC;
use App\Http\Controllers\PelangganC;
use App\Http\Controllers\PesananC;
// use App\Http\Controllers\tesPK;
use App\Http\Controllers\TiketC;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ambil semua data 
Route::get('/getPelanggan', [PelangganC::class, 'getPelanggan']);
Route::get('/getTiket', [TiketC::class, 'getTiket']);
Route::get('/getmetodebayar', [MetodeBayarC::class, 'getMetodeBayar']);
Route::get('/getpesanan', [PesananC::class, 'getPesanan']);

// ambil data berdasarkan id
Route::get('/getIdPelanggan/{idPelanggan}', [PelangganC::class, 'getIdPelanggan']);
Route::get('/getIdTiket/{id}', [TiketC::class, 'getIdTiket']);
Route::get('/getidmetodebayar/{idMetodeBayar}', [MetodeBayarC::class, 'getIdMetodeBayar']);
Route::get('/getidpesanan/{idPesanan}', [PesananC::class, 'getIdPesanan']);

// menambahkan data 
Route::post('/tambahPelanggan', [PelangganC::class, 'creatPelanggan']);
Route::post('/buatTiket', [TiketC::class, 'createTiket']);
Route::post('/tambahmetodebayar', [MetodeBayarC::class, 'createMetodeBayar']);
Route::post('/pesananbaru', [PesananC::class, 'createPesanan']);

// Route::post('/pesananbaru', [tesPK::class, 'buatPK']);

// update data 
Route::put('editDataPelanggan/{diPelanggan}', [PelangganC::class, 'editPelanggan']);
Route::put('editTiket/{id}', [TiketC::class, 'editTiket']);
Route::put('editmetodebayar/{idMetodeBayar}', [MetodeBayarC::class, 'editMetodePembayaran']);
Route::put('editstatusbayar/{idPesanan}', [PesananC::class, 'editStatusPembayaran']);

// hapus data 
Route::delete('hapusPelanggan/{idPelanggan}', [PelangganC::class, 'delPelanggan']);
Route::delete('hapusTiket/{id}', [TiketC::class, 'delTiket']);
Route::delete('hapusmetodebayar/{idMetodeBayar}', [MetodeBayarC::class, 'delMetodeBayar']);
Route::delete('hapuspesanan/{idPesanan}', [PesananC::class, 'delPesanan']);
