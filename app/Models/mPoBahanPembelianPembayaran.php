<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mPoBahanPembelianPembayaran extends Model
{
    use HasFactory;
    protected $table = 'tb_po_bahan_pembelian_pembayaran';
    protected $guarded = [];
}
