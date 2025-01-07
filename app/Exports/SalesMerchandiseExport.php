<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SalesMerchandiseExport implements WithMultipleSheets
{
    use Exportable;
   /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];

            $sheets[] = new OrderDetailMerchandiseExport();
            $sheets[] = new OrderMerchandiseExport();

        return $sheets;
    }
}
