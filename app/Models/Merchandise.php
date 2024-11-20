<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchandise extends Model
{
    use HasFactory;
    protected $table = 'm_merchandise';

    protected $fillable = [
        'kode',
        'nama_produk',
        'ukuran',
        'jenis',
        'warna',
        'deskripsi',
        'harga_awal',
        'diskon',
        'image_1',
        'image_2',
        'image_3',
        'created_at'
    ];
}
