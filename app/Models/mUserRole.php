<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mUserRole extends Model
{
    use HasFactory;
    protected $table = 'tb_user_role';
    protected $guarded = [];
}
