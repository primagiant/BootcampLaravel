<?php

use App\Http\Controllers\Produksi\Produksi;
use Illuminate\Support\Facades\Route;

Route::get('/', [Produksi::class, 'index'])
    ->name('produksi');

Route::post('/produksiDatatable', [Produksi::class, 'datatable'])
    ->name('produksiDatatable');

require __DIR__ . '/auth.php';
