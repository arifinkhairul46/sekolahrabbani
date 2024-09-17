<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HargaSeragam extends Model
{
    use HasFactory;
    protected $table = 'm_harga_seragam';
    protected $primaryKey = 'id';

    protected $fillable = [
        'harga',
        'diskon',
        'kode_produk',
        'stok'
    ];
}
