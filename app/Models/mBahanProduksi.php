<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mBahanProduksi extends Model
{
    use HasFactory;
    protected $table = 'tb_bahan_produksi';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
