<?php

namespace App\Http\Controllers\Relatorio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Relatorio;

use App\Http\Requests\Relatorio\RelatorioFormRequest;

class RelatorioAutorController extends Controller
{
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
    public function salvarRelatorio(RelatorioFormRequest $request, Relatorio $relatorio)
    {
        $dadosValidados = $request->validated();
        $dadosValidados['projeto_id'] = $request['projeto_id'];
        //dd($dadosValidados);
        $responseSave = $relatorio->salvarRelatorio($dadosValidados);
        //dd($responseSave);
        if ($responseSave['success']) {
            return redirect()
                        ->route('home')
                        ->with('success', $responseSave['message']);
        } else {
            return redirect()
                        ->back()
                        ->with('error', $responseSave['message']);
        }


    }
}
