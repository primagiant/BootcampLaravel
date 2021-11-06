<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mHutangSupplierPembayaran extends Model
{
    use HasFactory;
    protected $table = 'tb_hutang_supplier_pembayaran';
    protected $guarded = [];
}
