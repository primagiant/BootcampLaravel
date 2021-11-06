<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mAcMaster extends Model
{
    use HasFactory;
    protected $table = 'tb_ac_master';
    protected $primaryKey = 'master_id';
    protected $guarded = [];
}
