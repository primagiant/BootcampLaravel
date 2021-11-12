<?php

use App\Http\Controllers\Produksi\Produksi;
use Illuminate\Support\Facades\Route;

Route::get('/', [Produksi::class, 'index'])
    ->name('produksi');
Route::post('/produksiDatatable', [Produksi::class, 'datatable'])
    ->name('produksiDatatable');

Route::get('/tambahProduksi', [Produksi::class, 'create'])
    ->name('tambahProduksi');
Route::post('/tambahProduksi', [Produksi::class, 'store'])
    ->name('tambahProduksi');

Route::get('/editProduksi/{id}', [Produksi::class, 'edit'])
    ->name('editProduksi');
Route::put('/editProduksi/{id}', [Produksi::class, 'update'])
    ->name('editProduksi');

Route::delete('/deleteProduksi', [Produksi::class, 'destroy'])
    ->name('deleteProduksi');

require __DIR__ . '/auth.php';
