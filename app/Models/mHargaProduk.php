<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mHargaProduk extends Model
{
    use HasFactory;
    protected $table = 'tb_harga_produk';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
