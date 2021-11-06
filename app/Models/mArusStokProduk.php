<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mArusStokProduk extends Model
{
    use HasFactory;
    protected $table = 'tb_arus_stok_produk';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
