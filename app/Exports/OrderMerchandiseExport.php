<?php

namespace App\Exports;

use App\Models\OrderMerchandise;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderMerchandiseExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = OrderMerchandise::select('no_pesanan', 'nama_pemesan', 'no_hp', 'total_harga', 'status', 'metode_pembayaran', 'kategori_metode', 'updated_at')
        ->where('status', 'success')
        ->get();

        return $data;
    }

    public function headings(): array
    {
        return [
            'No Invoice',
            'Nama Pemesan',
            'No Hp',
            'Total Harga',
            'Status',
            'Metode Pembayaran',
            'Kategori',
            'Waktu',
        ];
    }
}
