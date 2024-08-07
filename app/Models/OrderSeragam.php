<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderSeragam extends Model
{
    use HasFactory;
    protected $table = 't_pesan_seragam';
    protected $primaryKey = 'id';

    protected $fillable = [
        'no_pemesanan',
        'no_hp',
        'nama_pemesan'
    ];
}
