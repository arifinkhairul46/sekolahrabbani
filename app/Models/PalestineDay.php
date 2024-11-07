<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PalestineDay extends Model
{
    use HasFactory;
    protected $table = 'm_palestine_day';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'judul',
        'image',
        'file',
        'deskripsi',
        'style',
        'status',
        'terbit',
        'jenjang',
        'created_by',
        'updated_by',
    ];
}