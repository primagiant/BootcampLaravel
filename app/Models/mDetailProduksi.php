<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mDetailProduksi extends Model
{
    use HasFactory;
    protected $table = 'tb_detail_produksi';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
