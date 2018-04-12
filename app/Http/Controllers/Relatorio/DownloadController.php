<?php

namespace App\Http\Controllers\Relatorio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Relatorio;

use PDF;

class DownloadController extends Controller
{
    public function downloadRelatorioPDF(int $id, Relatorio $relatorio)
    {
        $dadosRelatorio = $relatorio->where('id', $id)
                                    ->with([
                                        'getProjeto',
                                        'getCoordenador',
                                        'getCronograma',
                                        'getEquipeRelatorio',
                                        'getExpositor',
                                        'getMinistrante',
                                        'getMonitor',
                                        'getOuvinte',
                                        'getPalestrante',
                                        'getParticipante'])
                                    ->get()
                                    ->first();
        
        //dd($dadosRelatorio);
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'Courier']);
        
        return PDF::loadView('download.relatorio', 
                    compact('dadosRelatorio'))
                    ->download("{$dadosRelatorio->getProjeto->numero_registro_naac} - NAAC-DOC-003 - Relatório de Projeto de Extensão - {$dadosRelatorio->titulo }.pdf");
    }
}
