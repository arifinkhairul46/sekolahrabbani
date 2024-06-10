<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenjang extends Model
{
    use HasFactory;
    protected $table = 'm_jenjang';
    protected $primaryKey = 'id';

    public function jenjang_sekolah () {
        return $this->hasMany(JenjangSekolah::class, 'jenjang_id', 'id');

    }
}
