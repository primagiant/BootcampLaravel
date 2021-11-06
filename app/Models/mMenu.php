<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mMenu extends Model
{
    use HasFactory;
    protected $table = 'tb_menu';
    protected $primaryKey = 'id_menu';
    protected $guarded = [];
}
