<?php

namespace App\Http\Controllers\Projeto;

use App\Models\Projeto;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Email\EmailController;
use App\Http\Requests\Projeto\ProjetoFormRequest;

use Gate;

class ProjetoAdminController extends Controller
{
    /**METODO PARA ATUALIZAR COM POLITICAS DE AUTORIZAÇÃO
     * 
     */
    public function update(Request $request) {
        $projeto = $request->all();

        //$this->authorize('update-projeto', $projeto);
        if (Gate::denies('update-projeto', $projeto)) {
            abort(403, 'Ação não autorizada');
        }
        dd($projeto);

        return 'atualizou';

    }

    /* METODO DE VISUALIZAR TODOS OS PROJETOS SOLICITADOS
        irá retornar todos os projetos daquele usuario
    */
    public function projetosSolicitados(Projeto $projetos)
    {
        $projetos = $projetos->where('status_projeto', 'Enviado')
                             ->orWhere('status_projeto', 'Reenviado')
                             ->get();
        //dd($projetos);                          
        return view('projeto.projeto-solicitado.projeto-solicitado', compact('projetos'));
    }

    /**METODO DE VISUALIZAR TODOS OS PROJETOS CADASTRADOS
     * Irá retornar todos os projetos cadastrados no banco de dados
     * 
     */
    public function todosProjetos(Projeto $projeto)
    {
        $projetos = $projeto->all();
        //dd($projetos);
        return view('projeto.all-projects.all-projects', compact('projetos'));
    }

    /**METODO DE VISUALIZAR TODOS OS PROJETOS CADASTRADOS COM CORREÇÕES
     * Irá retornar todos os projetos cadastrados no banco de dados
     * que possuam correções a ver sendo somente reenviados
     * 
     */
    public function todosProjetosCorrigidos(Projeto $projeto)
    {
        $projetos = $projeto->where('status_projeto', 'Reenviado')
                             ->get();
        $messageTitle = 'Todos projetos reenviados';                             
        $messageEmpty = 'Não há projetos a corrigir';                     
        //dd($projetos);
        return view('projeto.all-projects.all-projects', compact('projetos', 'messageEmpty', 'messageTitle'));
    }

        /**METODO DE VISUALIZAR TODOS OS PROJETOS DEFERIDOS
     * Irá retornar todos os projetos cadastrados no banco de dados
     * que estejam deferidos
     * 
     */
    public function todosProjetosDeferidos(Projeto $projeto)
    {
        $projetos = $projeto->where('status_projeto', 'Deferido')
                             ->get();
        $messageTitle = 'Todos projetos deferidos';                             
        $messageEmpty = 'Não há projetos deferidos';                     
        //dd($projetos);
        return view('projeto.all-projects.all-projects', compact('projetos', 'messageEmpty', 'messageTitle'));
    }

    /* METODO DE CORREÇÃO PARA O ADMINISTRADOR
        todas as manipulações para o administrador ver os ados do projeto
        que ele irá corrigir
    */
    public function corrigirProjeto(int $id, $notify_id = '', Projeto $projeto)
    {
        if ($notify_id != '')
            $this->setLida($notify_id); 

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
        if ($dadosProject->status_projeto == "Corrigir"     ||
            $dadosProject->status_projeto == "Recorrigir")
                return redirect()->back();       

        $total_geral = 0.0;
        foreach ($dadosProject->getOrcamentos as $orcamento)
            $total_geral += $orcamento->valor_total;
        
        return view('projeto.projeto-solicitado.visualizar-projeto', 
                    compact('total_geral', 'dadosProject'));
    }


    /*public function indeferirProjeto($id, Projeto $projeto)
    {
        $retornoIndeferir = $projeto->indeferir($id);

        if ($retornoIndeferir['success']) {
            
            return redirect()
                        ->route('home')
                        ->with('success',$retornoIndeferir['message']);
        } else {
            return redirect()
                        ->back()
                        ->with('error', $retornoIndeferir['message']);
        }
    }*/

    public function deferirProjeto($id, Projeto $projeto)
    {
        $retornoDeferir = $projeto->deferir($id);

        if ($retornoDeferir['success']) {
            return redirect()
                        ->route('home')
                        ->with('success',$retornoDeferir['message']);
        } else {
            return redirect()
                        ->back()
                        ->with('error', $retornoDeferir['message']);
        }
    }

    public function salvarCorrigirProjeto($id, Request $request, Projeto $projeto)
    {
        //$projetoCorrigir = $projeto->find($id);
        $email = new EmailController;
        $email->sendMail();
        dd('opa');
        $correcaoForm = $request->except('_token');
        $responseCorrigir = $projeto->salvarCorrecaoAdmin($correcaoForm, $id);
        
        if ($responseCorrigir['success']) {
            return redirect()
                        ->route('home')
                        ->with('success',$responseCorrigir['message']);
        } else {
            return redirect()
                        ->back()
                        ->with('error', $responseCorrigir['message']);
        }
    }
    
    private function setLida($notify_id)
    {
        foreach (auth()->user()->unreadNotifications as $notification)
            if ($notification->id == $notify_id)
                $notification->delete();
    }
}
