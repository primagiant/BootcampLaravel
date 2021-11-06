<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mPiutangLainPembayaran extends Model
{
    use HasFactory;
    protected $table = 'tb_piutang_lain_pembayaran';
    protected $guarded = [];
}
