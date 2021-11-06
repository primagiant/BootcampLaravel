<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mAcJurnalUmum extends Model
{
    use HasFactory;
    protected $table = 'tb_ac_jurnal_umum';
    protected $primaryKey = 'jurnal_umum_id';
    protected $guarded = [];
}
