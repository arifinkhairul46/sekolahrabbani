<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengumpulanTugas extends Model
{
    use HasFactory;
    protected $table = 't_pengumpulan_tugas';

    protected $fillable = [
        'user_id',
        'kode_csdm',
        'tugas_id',
        'status',
        'file'
    ];
 
}
