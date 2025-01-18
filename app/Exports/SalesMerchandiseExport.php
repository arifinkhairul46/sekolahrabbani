<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SalesMerchandiseExport implements WithMultipleSheets
{
    use Exportable;
    protected $from_date;
    protected $end_date;
    
    public function __construct($from_date, $end_date)
    {
        $this->from_date = $from_date;
        $this->end_date = $end_date;
    }
   /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];

            $sheets[] = new OrderDetailMerchandiseExport( $this->from_date, $this->end_date);
            $sheets[] = new OrderMerchandiseExport( $this->from_date, $this->end_date);

        return $sheets;
    }
}
