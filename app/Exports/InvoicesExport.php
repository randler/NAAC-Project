<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Models\Relatorio;

class InvoicesExport implements FromQuery
{
    use Exportable;

    protected $participante;

    public function __construct($participante)
    {
        $this->participante = $participante;
    }

    public function query()
    {
        /*dd($this->participante
                            ->select('nome', 'carga_horaria')
                            ->get());*/
        return $this->participante
                            ->select('nome', 'carga_horaria')
                            ->get();
    }
}