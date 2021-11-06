<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mHistoriPenyesuaianBahan extends Model
{
    use HasFactory;
    protected $table = 'tb_histori_penyesuaian_bahan';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
