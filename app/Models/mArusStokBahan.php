<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mArusStokBahan extends Model
{
    use HasFactory;
    protected $table = 'tb_arus_stok_bahan';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
