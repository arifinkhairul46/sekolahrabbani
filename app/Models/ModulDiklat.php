<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModulDiklat extends Model
{
    use HasFactory;
    protected $table = 'm_modul_diklat';

    protected $fillable = [
        'judul_modul',
        'deskripsi_modul',
        'file_modul',
        'status_modul',
    ];

    public function kelas()
    {
        return $this->hasMany(KelasDiklat::class, 'id_modul');
    }
}
