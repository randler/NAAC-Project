<?php

namespace App\Http\Controllers\Relatorio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RelatorioController extends Controller
{
    //


    public function index()
    {
        $projetos = auth()->user()->projects()
                                  ->where('status_projeto', 'Deferido')
                                  ->get(); 
        //dd($projetos); 
        return view('relatorio.index', compact('projetos'));
    }

    /**METODO PARA EXIBIR OS DADOS PARA PREENCHER UM NOVO RELATORIO *********************
     * 
     */
    public function novoRelatorio(int $idRelatorio)
    {
        //dd($idRelatorio);
        $projeto = auth()->user()
                         ->projects()
                         ->where('id', $idRelatorio)
                         ->with([
                            'getEquipe',
                            'getAtividades',
                            'getConteudos',
                            'getCriterios',
                            'getDocumento',
                            'getOrcamentos',
                            'getParcerias',
                            'getRecursos'
                         ])
                         ->get()
                         ->first();
        $projeto['coordenador_projeto'] = auth()->user()->name;
        $projeto['cpf'] =auth()->user()->cpf;
        
        //dd($projeto); 
        return view('relatorio.relatorio.create_edit', compact('projeto'));                         
    }


    /** ***************** METODO PARA SALVAR UM NOVO RELATORIO **********************
     * 
     */
    public function salvarRelatorio(Request $request)
    {
        dd($request->all());
    }
}
