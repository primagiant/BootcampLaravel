<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mDistribusiDetail extends Model
{
    use HasFactory;
    protected $table = 'tb_distribusi_detail';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
