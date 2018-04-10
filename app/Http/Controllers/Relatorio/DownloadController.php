<?php

namespace App\Http\Controllers\Relatorio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Relatorio;

use PDF;

class DownloadController extends Controller
{
    public function downloadProjetoPDF(int $id, Relatorio $relatorio)
    {
        $dadorRelatorio = $relatorio->where('id', $id)
                                    ->with([
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
        
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'Courier']);
        
        return PDF::loadView('download.relatorio', 
                    compact('dadorRelatorio'))
                    ->download("NAAC-DOC-003 - Relatório de Projeto de Extensão -{$dadorRelatorio->titulo }.pdf");
    }
}
