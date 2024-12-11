<?php

namespace App\Exports;

use App\Models\OrderDetailMerchandise;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderDetailMerchandiseExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return OrderDetailMerchandise::all();
        $data = OrderDetailMerchandise::select('t_pesan_merchandise_detail.nama_siswa', 't_pesan_merchandise_detail.lokasi_sekolah',
                    't_pesan_merchandise_detail.nama_kelas', 'mm.nama_produk', 'mwk.warna', 'mtd.judul as template',  
                    'mus.ukuran_seragam', 'mku.kategori', 'tdp.nis', 't_pesan_merchandise_detail.quantity', 't_pesan_merchandise_detail.created_at' )
                    ->leftJoin('t_pesan_merchandise as tpm', 'tpm.no_pesanan', 't_pesan_merchandise_detail.no_pesanan')
                    ->leftJoin('m_merchandise as mm', 'mm.id', 't_pesan_merchandise_detail.merchandise_id')
                    ->leftJoin('m_warna_kaos as mwk', 'mwk.id', 't_pesan_merchandise_detail.warna_id')
                    ->leftJoin('m_ukuran_seragam as mus', 'mus.id', 't_pesan_merchandise_detail.ukuran_id')
                    ->leftJoin('m_kategori_umur as mku', 'mku.id', 't_pesan_merchandise_detail.kategori_id')
                    ->leftJoin('m_template_desain as mtd', 'mtd.id', 't_pesan_merchandise_detail.template_id')
                    ->leftJoin('t_desain_palestineday as tdp', 'tdp.id', 't_pesan_merchandise_detail.design_id')
                    ->where('tpm.status', 'success')
                    ->get();
        return $data;
    }

    public function headings(): array
    {
        return [
            'Nama Siswa',
            'Sekolah',
            'Nama Kelas',
            'Nama Produk',
            'Warna',
            'Template',
            'Ukuran',
            'Kategori',
            'Design by',
            'Quantity',
            'Waktu',
        ];
    }
}
