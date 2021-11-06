<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mPiutangPembayaran extends Model
{
    use HasFactory;
    protected $table = 'tb_piutang_pelanggan';
    protected $guarded = [];
}
