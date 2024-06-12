<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;
    protected $table = 't_tagihan';
    protected $primaryKey = 'id';

    protected $fillable = [
       'id', 
       'nis',
       'jenis_penerimaan',
       'tahun',
       'tgl_tagihan',
       'nilai_tagihan'
    ];
}
