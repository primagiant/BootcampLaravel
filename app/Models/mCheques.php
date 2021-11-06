<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mCheques extends Model
{
    use HasFactory;
    protected $table = 'tb_cheques';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
