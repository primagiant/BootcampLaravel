<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mDistributorOrder extends Model
{
    use HasFactory;
    protected $table = 'tb_distributor_order';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
