<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mAcKodeBukti extends Model
{
    use HasFactory;
    protected $table = 'tb_ac_kode_bukti';
    protected $primaryKey = 'kode_bukti_id';
    protected $guarded = [];
}
