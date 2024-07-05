<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $table = 'm_profile';

    protected $fillable = [
        'nis',
        'nama_lengkap',
        'tahun_masuk',
        'kelas_id',
        'jenjang_id',
        'no_hp_ayah',
        'no_hp_ibu',
        'pass_akun'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function get_user_profile_byphone($phone) {
        $data = static::with(['user'])
            ->where('no_hp_ibu', $phone)
            ->get();

        return $data;

    }

     public static function get_nis($id) {
        $data = static::select('nis', 'nama_lengkap')
            ->where('user_id', $id)
            ->get();

        return $data;

    }
}
