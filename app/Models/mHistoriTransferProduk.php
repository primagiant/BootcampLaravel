<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mHistoriTransferProduk extends Model
{
    use HasFactory;
    protected $table = 'tb_histori_transfer_produk';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
