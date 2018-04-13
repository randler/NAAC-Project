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
                                  ->where('has_relatorio', false)
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

    /** ********************** EXIBIR RELATORIO **************************
     * 
     * 
     * 
     */
    public function verRelatorio($id, Relatorio $relatorio)
    {
        $dadosRelatorio = auth()->user()
                                ->relatorios()
                                ->where('id', $id)
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
        //dd($dadosRelatorio);
        return view('relatorio.relatorio.visualizar-relatorio', compact('dadosRelatorio'));
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

    /**
     * 
     * 
     */
    public function salvarCorrecaoRelatorio(RelatorioFormRequest $request, int $id, Relatorio $relatorio)
    {
        $dadosValidados = $request->validated();
        //dd($dadosValidados, $id);

        $responseUpdate = $relatorio->salvarCorrecaoRelatorioUser($id, $dadosValidados);

        if ($responseUpdate['success']) {
            return redirect()
                        ->route('home')
                        ->with('success', $responseUpdate['message']);   
        } else {
            return redirect()
                        ->back()
                        ->with('error', $responseUpdate['message']);
        }
    }

    /**
     * 
     * 
     */
    public function todosRelatoriosUser()
    {
        $statusFind = 'all';
        $relatorios = auth()->user()
                                ->relatorios()
                                ->get();
        return view('relatorio.relatorio.view', compact('relatorios', 'statusFind'));
    }

    /**
     * 
     * 
     */
    public function relatoriosCorrecao()
    {
        $messageTitle = 'Todos os Relatórios a Corrigir';
        $messageEmpty = 'Não há relatórios a corrigir';
        $statusFind = 'Indeferido';

        $relatorios = auth()->user()
                                ->relatorios()
                                ->where('status_relatorio', 'Indeferido')
                                ->orWhere('status_relatorio', 'Corrigir')
                                ->orWhere('status_relatorio', 'Recorrigir')
                                ->get();
        //dd($relatorios);
        return view('relatorio.relatorio.view', compact('relatorios', 'messageEmpty', 'messageTitle', 'statusFind'));
    }

    /**
     * 
     * 
     */
    public function relatoriosDeferidos()
    {
        $messageTitle = 'Todos os Relatórios Deferidos';
        $messageEmpty = 'Não há relatório(s) deferido(s)';
        $statusFind = 'Deferido';

        $relatorios = auth()->user()
                                ->relatorios()
                                ->where('status_relatorio', 'Deferido')
                                ->get();
        //dd($relatorios);
        return view('relatorio.relatorio.view', compact('relatorios', 'messageEmpty', 'messageTitle', 'statusFind'));
    }

    public function viewCorrigirRelatorio(int $id, $notify_id = '')
    {
        $editarRelatorio = auth()->user()
                            ->relatorios()
                            ->where('id', $id)
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
        
        $editarRelatorio['table-cronograma']           = $this->getCronogramaValues($editarRelatorio->getCronograma);
        $editarRelatorio['table-coordenador']          = $this->getTwoValues($editarRelatorio->getCoordenador);
        $editarRelatorio['table-equipe_organizadora']  = $this->getTwoValues($editarRelatorio->getEquipeRelatorio);
        $editarRelatorio['table-palestrantes']         = $this->getThreeValues($editarRelatorio->getPalestrante);
        $editarRelatorio['table-monitores']            = $this->getTwoValues($editarRelatorio->getMonitor);
        $editarRelatorio['table-expositores']          = $this->getThreeValues($editarRelatorio->getExpositor);
        $editarRelatorio['table-ministrantes']         = $this->getThreeValues($editarRelatorio->getMinistrante);
        $editarRelatorio['table-participantes']        = $this->getTwoValues($editarRelatorio->getParticipante);
        $editarRelatorio['table-ouvintes']             = $this->getTwoValues($editarRelatorio->getOuvinte);
        //dd($editarRelatorio);                    
        $projeto = $editarRelatorio->getProjeto;
        //dd($id, $notify_id, $editarRelatorio);
        return view('relatorio.relatorio.create_edit', compact('editarRelatorio', 'projeto'));
    }


    /*** PEGAR VALOR DO BANCO DE DADOS PARA ENVIAR PARA O INPUT DO TIPO HIDDEN */
    private function getTwoValues($dadosProject): String
    {
        $value = '';
        foreach($dadosProject as $val)
            $value .=  $val->nome.'|'.
                       $val->carga_horaria.'|';                            

            return $value;
    }

    private function getThreeValues($dadosProject): String
    {
        $value = '';
        foreach($dadosProject as $val)
            $value .=  $val->nome.'|'.
                       $val->titulo.'|'.
                       $val->carga_horaria.'|';                            

            return $value;
    }

    private function getCronogramaValues($dadosProject): String
    {
        $value = '';
        foreach($dadosProject as $val)
            $value .=  $val->desc_atividade.'|'.
                       $val->data.'|';                            

            return $value;
    }
}
