<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mAcMasterDetail extends Model
{
    use HasFactory;
    protected $table = 'tb_ac_master_detail';
    protected $primaryKey = 'master_detail_id';
    protected $guarded = [];
}
