<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKategori extends Model
{
    use HasFactory;
    protected $table = 'm_kategori_seragam';
    protected $primaryKey = 'id';
}
