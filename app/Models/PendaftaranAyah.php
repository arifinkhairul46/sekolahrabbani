<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranAyah extends Model
{
    use HasFactory;
    protected $table = 'tbl_ayah';

    protected $fillable = [
        'id_ayah',
        'nama',
        'tptlahir_ayah',
        'tgllahir_ayah',
        'pekerjaan_jabatan',
        'pendidikan_ayah'
    ];
}
