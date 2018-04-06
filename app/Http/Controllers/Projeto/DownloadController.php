<?php

namespace App\Http\Controllers\Projeto;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Projeto;

use PDF;

class DownloadController extends Controller
{
    public function downloadProjetoPDF(int $id, Projeto $projeto)
    {
        $dadosProject = $projeto->where('id', $id)
                                ->with([
                                    'getEquipe',
                                    'getAtividades',
                                    'getConteudos',
                                    'getCriterios',
                                    'getDocumento',
                                    'getOrcamentos',
                                    'getParcerias',
                                    'getRecursos'
                                ])->get()->first();
        //dd($dadosProject);    
        $total_geral    = 0.0;

        foreach ($dadosProject->getOrcamentos as $orcamento) {
            $total_geral += $orcamento->valor_total;
        }
        
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'Courier']);
        
        return PDF::loadView('download.projeto', 
                    compact('dadosProject', 'total_geral'))
                    ->download("NAAC-DOC-002 - Projeto de Extensão -{$dadosProject->titulo_projeto }_{$dadosProject->numero_registro_naac}.pdf");
    }

    public function downloadListaPDF(int $id, Projeto $projeto)
    {
        $dadosProject = $projeto->where('id', $id)
                                ->get()
                                ->first();
        //dd($dadosProject);
        
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'Courier']);
        
        return PDF::loadView('download.lista', 
                    compact('dadosProject'))
                    ->download("NAAC-DOC-004 - Lista de Presença - {$dadosProject->titulo_projeto }_{$dadosProject->numero_registro_naac}.pdf");
    }

    
}
