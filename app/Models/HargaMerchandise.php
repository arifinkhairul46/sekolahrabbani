<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HargaMerchandise extends Model
{
    use HasFactory;
    protected $table = 'm_harga_kaos';
    protected $primaryKey = 'id';

    protected $fillable = [
        'merchandise_id',
        'jenis_id',
        'ukuran_id',
        'harga',
        'diskon',
        'kategori_id',
        'warna_id',
        'lengan_id'
    ];
}
