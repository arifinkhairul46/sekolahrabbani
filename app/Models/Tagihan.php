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

    public static function get_tagihan_bdu_by_nis($nis) {
        $data = static::where('jenis_penerimaan', 'bdu')
                    ->where('nis', $nis)
                    ->where('status', 1)
                    ->get();

        return $data;
    }

    public static function get_tagihan_spp_by_nis($nis) {
        $data = static::where('jenis_penerimaan', 'spp')
                    ->where('nis', $nis)
                    ->where('status', 1)
                    ->get();

        return $data;
    }

    public static function total_tunggakan_spp_by_nis($nis) {
        $data = static::selectRaw('id, nis, jenis_penerimaan, sum(nilai_tagihan) as total_tunggakan_spp')
                ->where('nis', $nis)
                ->where('status', 1)
                ->where('jenis_penerimaan', 'spp')
                ->groupBy('nis')
                ->get();

        return $data;
    }
}
