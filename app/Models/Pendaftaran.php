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
        'tempat_lahir',
        'tgl_lahir',
        'jenis_kelamin',
        'no_hp_ayah',
        'no_hp_ibu',
        'lokasi',
        'kelas',
        'tingkat',
        'info_ppdb',
        'jenis_pendidikan',
        'asal_sekolah',
        'alamat',
        'provinsi',
        'kota',
        'kecamatan',
        'kelurahan',
        'jenjang',
        'riwayat_penyakit',
        'tinggi_badan',
        'berat_badan',
        'anak_ke',
        'jml_saudara',
        'kec_asal_sekolah',
        'gol_darah',
        'hafalan',
    ];

    public static function get_profile($id)
    {
        $data = static::where('id_anak', $id)
            ->first();

        return $data;

    }
}
