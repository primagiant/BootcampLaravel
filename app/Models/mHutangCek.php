<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mHutangCek extends Model
{
    use HasFactory;
    protected $table = 'tb_hutang_cek';
    protected $primaryKey = 'id_hutang_cek';
    protected $guarded = [];
}
