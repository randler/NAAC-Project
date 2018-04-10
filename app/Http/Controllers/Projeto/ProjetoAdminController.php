<?php

namespace App\Http\Controllers\Projeto;

use App\Models\Projeto;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Projeto\ProjetoFormRequest;
use App\Mail\SendNotifications;
use App\User;

use Gate;
use Mail;

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
        $messageTitle = 'Projetos solicitados';
        $messageEmpty = 'Não há projetos solicitados';
        $projetos = $projetos->where('status_projeto', 'Enviado')
                             ->orWhere('status_projeto', 'Reenviado')
                             ->get();
        //dd($projetos);                          
        return view('projeto.projeto.view', compact('projetos', 'messageTitle', 'messageEmpty'));
    }

    /**METODO DE VISUALIZAR TODOS OS PROJETOS CADASTRADOS
     * Irá retornar todos os projetos cadastrados no banco de dados
     * 
     */
    public function todosProjetos(Projeto $projeto)
    {
        $projetos = $projeto->all();
        //dd($projetos);
        return view('projeto.projeto.view', compact('projetos'));
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
        $messageTitle = 'Projetos a corrigir';                             
        $messageEmpty = 'Não há projetos a corrigir';                     
        //dd($projetos);
        return view('projeto.projeto.view', compact('projetos', 'messageEmpty', 'messageTitle'));
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
        return view('projeto.projeto.view', compact('projetos', 'messageEmpty', 'messageTitle'));
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
        
        return view('projeto.projeto.visualizar-projeto', 
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
        $dadosProjeto = $projeto->where('id', $id)->get()->first();
        $user_id = $dadosProjeto->user_id;
        
        $dados_user = User::where('id', $user_id)->get()->first(); 
        $email_user = $dados_user->email;
        //dd(route('corrigir-projeto-user', [$id]));
       
        $dadosEmail = (object) Array (
            'para'          => $email_user,
            'assunto'       => '[NAAC - Status Projeto '. $dadosProjeto->titulo_projeto .']',
            'title'         => 'Projeto Deferido',
            'title_message' => 'Parabéns o projeto '. $dadosProjeto->titulo_projeto .' foi deferido na data: ' . date('d/m/Y') . '. ',
            'descricao'     => $dadosProjeto->objetivo_geral,
            'titulo'        => $dadosProjeto->titulo_projeto,
            'status'        => 'Deferido',
            'autor'         => $dados_user->name,
            'tipo'          => 'projeto-deferido',
            'link'          => route('visualizar-projeto', [$id])
        );

        $retornoDeferir = $projeto->deferir($id);

        if ($retornoDeferir['success']) {
            $this->sendEmail($dadosEmail);
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
        $correcaoForm = $request->except('_token');
        
        $dadosProjeto = $projeto->where('id', $id)->get()->first();
        $user_id = $dadosProjeto->user_id;
        
        $dados_user = User::where('id', $user_id)->get()->first(); 
        $email_user = $dados_user->email;

        $dadosEmail = (object) Array (
            'para'          => $email_user,
            'assunto'       => '[NAAC - Status Projeto '. $request->titulo_projeto .']',
            'title'         => 'Projeto Indeferido',
            'title_message' => 'O projeto '. $request->titulo_projeto .'  foi corrigido e encontramos algumas correções a serem feitas.',
            'descricao'     => $request->objetivo_geral,
            'titulo'        => $request->titulo_projeto,
            'status'        => 'Indeferido',
            'autor'         => $dados_user->name,
            'tipo'          => 'projeto-indeferido',
            'link'          => route('corrigir-projeto-user', [$id])
        );

        $responseCorrigir = $projeto->salvarCorrecaoAdmin($correcaoForm, $id);
        
        if ($responseCorrigir['success']) {
            $this->sendEmail($dadosEmail);
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

    /******************* ENVIAR E-MAIL ********************
     * 
     */
    private function sendEmail($dadosEmail)
    {
        Mail::to($dadosEmail->para)->send(new SendNotifications($dadosEmail));
    }
}
