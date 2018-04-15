<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Models\Relatorio;

class InvoicesExport implements FromQuery
{
    use Exportable;

    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function query()
    {
        $relatorio = new Relatorio;
         return $relatorio
                        ->where('id', $this->id)
                        ->first()
                        ->getParticipante()
                        ->select('nome', 'carga_horaria')
                        ->get();
        //return Invoice::all();
    }
}