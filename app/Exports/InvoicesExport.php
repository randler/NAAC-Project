<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Models\Relatorio;

class InvoicesExport implements FromQuery
{
    use Exportable;

    protected $export;

    public function __construct($export)
    {
        $this->export = $export;
    }

    public function query()
    {
        return $this->export;
    }
}