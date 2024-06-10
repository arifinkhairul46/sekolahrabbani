<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;
    protected $table = 'tbl_anak';

    protected $fillable = [
        'id_anak',
        'nama_lengkap',
        'no_hp_ayah',
        'no_hp_ibu',
        'lokasi',
        'kelas',
        'tingkat'
    ];
}
