<?php

namespace App\Http\Controllers\Projeto;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Projeto;
use App\Http\Requests\Projeto\ProjetoFormRequest;

use Validator;

use App\User;

class ProjetoAutorController extends Controller
{

    public function novoProjeto()
    {
        return view('projeto.projeto.create_edit');
    }   

    /* METODO PARA SALVAR UM NOVO PROJETO DO AUTOR
        Irá validar os dados e então salvar no banco
    */
    public function salvarProjeto(ProjetoFormRequest $request, Projeto $projeto, User $user)
    {
        //recupera os dados menos o token do formulario
        $dadosValidados = $request->validated();
        //envia para o metodo salvar do model os dados 
        $responseSave = $projeto->salvarProjeto($dadosValidados);

        //se ocorrer tudo certo retorna a pagina principal com sucesso
        // caso não ele retorna ao formulário com os dados e com o especifico erro
        if($responseSave['success']) {
           return redirect()
                        ->route('home')
                        ->with('success',$responseSave['message']);
                        //dd($dataForm);
        } else {
            return redirect()
                        ->back()
                        ->with('error', $responseSave['message']);
        }
    }

    /* METODO DE VISUALIZAR TODOS OS PROJETOS DE DETERMINADO USUÁRIO
        irá retornar todos os projetos daquele usuario
    */
    public function todosProjetosUser()
    {
        $messageTitle = 'Todos os seus projetos';

        $statusFind = 'all';
        $projetos = auth()->user()->projects;  

        return view('projeto.projeto.view', compact('projetos', 'messageTitle', 'statusFind'));
    }

    /* METODO DE VISUALIZAR TODOS OS PROJETOS
        irá retornar todos os projetos daquele usuario
    */
    public function projetosCorrecao()
    {
        $messageTitle = 'Todos os projetos a corrigir';
        $messageEmpty = 'Não há projetos a corrigir';
        $statusFind = 'Corrigir';
        $projetos = auth()->user()->projects()
                                  ->where('status_projeto', 'Corrigir')
                                  ->orWhere('status_projeto', 'Recorrigir')
                                  ->get();
        //dd($projetos);                                  
        return view('projeto.projeto.view', compact('projetos', 'messageTitle', 'messageEmpty', 'statusFind'));
    }

    public function projetosDeferidos()
    {
        $messageTitle = 'Todos os projetos deferidos';
        $messageEmpty = 'Não há projeto deferido';
        $statusFind = 'Deferido';
        $projetos = auth()->user()->projects()
                                  ->where('status_projeto', 'Deferido')
                                  ->get();
        //dd($projetos);                                  
        return view('projeto.projeto.view', compact('projetos', 'messageTitle', 'messageEmpty', 'statusFind'));
    }

    //******** CORREÇÃO  ************************/

    /* METODO DE VISUALIZAR AS CORREÇÕES DE DETERMINADO PROJETO DO AUTOR
        irá os dados com possibilidade de edição 
        e informando as correções necesárias
    */
    public function visualizarCorrigirProjeto(int $id, $notify_id = '', Projeto $projeto)
    {
        // verifica se foi clicado pelas notificações, 
        // caso sim ele remove a notificação clicada
        if ($notify_id != '')
            $this->setLida($notify_id); 

        // pesquisa o projeto do usuario com os seus dados 
        // de outras tabelas que mantêm relacionamento    
        $dadosProject = auth()->user()
                                ->projects()
                                ->where('id', $id)
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
        
        if ($dadosProject == null)
            return redirect()->route('home'); 

        if ($dadosProject->status_projeto != 'Indeferido' &&
            $dadosProject->status_projeto != 'Recorrigir')
            return redirect()->route('home');  
            
        $ArrayOrcamentos    = $this->getValueOrcamentos($dadosProject);
           
        // trata os dados para exibição e preenchimento das tabelas
        $dadosProject['table-equipe']       = $this->getValueEquipe($dadosProject);
        $dadosProject['table-atividade']    = $this->getValueAtividades($dadosProject);
        $dadosProject['table-referencia']   = $this->getValueConteudos($dadosProject);
        $dadosProject['table-criterio']     = $this->getValueCriterios($dadosProject);
        $dadosProject['table-documento']    = $this->getValueDocumentos($dadosProject);
        $dadosProject['table-parceria']     = $this->getValueParcerias($dadosProject);
        $dadosProject['table-recurso']      = $this->getValueRecursos($dadosProject);        
        $dadosProject['table-orcamento']    = $ArrayOrcamentos['value'];
        $dadosProject['total_geral']        = $ArrayOrcamentos['total_geral']; 
        //dd($dadosProject);
        return view('projeto.projeto.create_edit', 
                compact('dadosProject'));
    }

    /**METODO (PUT) PARA ATUALIZAR O PROJETO CORRIGIDO
     *  Aqui será atualizado o projeto corrigido pelo autor
     * será reenviado para o administrador como "reenviado" 
     *  
     */
    public function atualizarCorrecaoProjeto(int $id, ProjetoFormRequest $request, Projeto $projeto, User $user)
    {
        if (!auth()->user()->projects()->find($id))
            return redirect()
                        ->back()
                        ->with('error', 'Erro! esse projeto não existe para esse autor.');
         
        //dd($request->all());
        $responseUpdate = $projeto->userCorrigirProjeto($id, $request->all());
        //dd($responseUpdate);
        if($responseUpdate['success']) {
            return redirect()
                        ->route('home')
                        ->with('success',$responseUpdate['message']);
        } else {
            return redirect()
                        ->back()
                        ->with('error', $responseUpdate['message']);
        }
    }

    /**METODO PARA VISUALIZAR OS DADOS DE DETERMINADO PROJETO
     * O usuário pode escolher o projeto e será redirecionado
     * para uma view contendo os dados capturados aqui
     * 
     */
    public function verProjeto(int $id, $notify_id = '', Projeto $projeto)
    {
        if ($notify_id != '')
            $this->setLida($notify_id);
        
        $dadosProject = auth()->user()
                                ->projects()
                                ->where('id', $id)
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
        if ($dadosProject == null)
            return redirect()->route('home');

        //dd($dadosProject);
        $total_geral = 0.0;
        foreach ($dadosProject->getOrcamentos as $orcamento) {
            $total_geral += $orcamento->valor_total;
        }
        
        
        return view('projeto.projeto.visualizar-projeto', 
                    compact('dadosProject', 'total_geral'));
    }

    /** FUNÇÕES PARA RETORNAR OS VALORES
     * Será utilizado os valores para preenchimento 
     * dos campos inputs do tipo hidden
     */
    //******************************************************************************* */
    private function getValueEquipe($dadosProject): String
    {
        $value = '';
        foreach($dadosProject->getEquipe as $equipe)
        $value .= $equipe->nome.'|'.
                  $equipe->email.'|'.
                  $equipe->telefone.'|';
    
        return $value;
    }

    //******************************************************************************* */
    private function getValueAtividades($dadosProject): String
    {
        $value = '';
        foreach($dadosProject->getAtividades as $atividade)
            $value .= $atividade->desc_atividades.'|'.
                      $atividade->titulo_atividade.'|'.
                      $atividade->obs_atividade.'|';
        
        return $value; 
    }

    //******************************************************************************* */
    private function getValueConteudos($dadosProject): String
    {
        $value = '';
        foreach($dadosProject->getConteudos as $conteudo)
        $value .=  $conteudo->desc_conteudo.'|'.
                   $conteudo->referencia.'|';
    
        return $value;
    }

    //******************************************************************************* */
    private function getValueCriterios($dadosProject): String
    {
        $value = '';
        foreach($dadosProject->getCriterios as $criterio)
            $value .=  $criterio->desc_criterio.'|';                            

            return $value;
    }

    //******************************************************************************* */
    private function getValueDocumentos($dadosProject): String
    {
        $value = '';
        foreach($dadosProject->getDocumento as $documento)
            $value .=  $documento->desc_documento.'|';

        return $value;
    }

    //******************************************************************************* */
    private function getValueOrcamentos($dadosProject): Array
    {
        $value = '';
        $total_geral = 0.0;
        foreach ($dadosProject->getOrcamentos as $orcamento) {
            $total_geral += $orcamento->valor_total;
            $value .=  $orcamento->desc_item.'|'.
                       $orcamento->quantidade.'|'.
                       $orcamento->valor_unitario.'|';
        }

        return [
            'total_geral' => $total_geral,
            'value'       => $value  
        ];

    }

    //******************************************************************************* */
    private function getValueParcerias($dadosProject): String
    {
        $value = '';
        foreach($dadosProject->getParcerias as $parceria)
            $value .=  $parceria->desc_parceria.'|'.
                       $parceria->representante.'|'.
                       $parceria->contato.'|';            

        return $value;
    }

    //******************************************************************************* */
    private function getValueRecursos($dadosProject): String
    {
        $value = '';
        foreach($dadosProject->getRecursos as $recurso)
            $value .=  $recurso->espaco.'|'.
                       $recurso->observacao.'|';
        return $value;                        

    }
    /******************************************************************************* */


    // METODO PARA TRANSFORMAR UMA STRING COM O SEPARADOR | PARA UM ARRAY DE STRINGS 
    public function stringToArray(String $dados): Array {
        $saida = explode('|', $dados);
        array_pop($saida);
        return $saida;
    }

    // METODO PARA REMOVER A NOTIFICAÇÃO DA TABELA DE NOTIFICATIONS
    private function setLida($notify_id)
    {
        foreach (auth()->user()->unreadNotifications as $notification)
            if ($notification->id == $notify_id)
                $notification->delete();
    }
}
