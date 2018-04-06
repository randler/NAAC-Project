<?php

namespace App\Http\Controllers\Projeto;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Projeto;

use Validator;

class ProjetoAutorController extends Controller
{
    private $rules = [
        'titulo_projeto'        => 'required',
        'colegiado_origem'      => 'required',
        'outros_colegiados'     => 'required',
        'autores'               => 'required',
        'emails_responsaveis'   => 'required',
        'nome_coordenador'      => 'required',
        'publico_alvo'          => 'required',
        'cunho_social'          => 'required',
        'periodo_realizacao'    => 'required',
        'carga_horaria'         => 'required|numeric|min:1',
        'numero_vagas'          => 'required|numeric|min:1',
        'dias_horarios_evento'  => 'required',
        'justificativa'         => 'required',
        'objetivo_geral'        => 'required',
        'objetivos_especificos' => 'required',
        'avaliacao'             => 'required',
        'retorno_proposta'      => 'required',

        'table-equipe'          => 'required',
        'table-criterio'        => 'required',
        'table-documento'       => 'required',
        'table-atividade'       => 'required',
        'table-referencia'      => 'required',
        'table-parceria'        => 'required',
        'table-orcamento'       => 'required',
        'table-recurso'         => 'required',
    ];
    private $messages = [
        'titulo_projeto.required'        => 'O campo Título do Projeto é de preenchimento obrigatório.',
        'colegiado_origem.required'      => 'O campo Colegiado de Origem é de preenchimento obrigatório.',
        'outros_colegiados.required'     => 'O campo Outros colegiados é de preenchimento obrigatório.',
        'autores.required'               => 'O campo Autores do Projeto é de preenchimento obrigatório.',
        'emails_responsaveis.required'   => 'O campo E-mails dos autores é de preenchimento obrigatório.',
        'nome_coordenador.required'      => 'O campo Coordenador do Projeto é de preenchimento obrigatório.',
        'publico_alvo.required'          => 'O campo Público Alvo é de preenchimento obrigatório.',
        'cunho_social.required'          => 'O campo Cunho Social é de preenchimento obrigatório.',
        'periodo_realizacao.required'    => 'O campo Período da Realização é de preenchimento obrigatório.',
        'carga_horaria.required'         => 'O campo Carga Horária é de preenchimento obrigatório.',
        'carga_horaria.numeric'          => 'O campo Carga Horária deve ser preenchido com valores numéricos.',
        'carga_horaria.max'              => 'O campo Carga Horária não deve ultrapassar 1000 horas.',
        'numero_vagas.required'          => 'O campo Número de vagas do Projeto é de preenchimento obrigatório.',
        'numero_vagas.min'               => 'O campo Número de vagas deve conter o mínimo de 100 vaga.',
        'numero_vagas.max'               => 'O campo Número de vagas não deve ultrapassar 1000 vagas.',
        'dias_horarios_evento.required'  => 'O campo Dias e horarios da realização do evento é de preenchimento obrigatório.',
        'justificativa.required'         => 'O campo Apresentação/Justificativa é de preenchimento obrigatório.',
        'objetivo_geral.required'        => 'O campo Objetivo geral é de preenchimento obrigatório.',
        'objetivos_especificos.required' => 'O campo Objetivos específicos é de preenchimento obrigatório.',
        'retorno_proposta.required'      => 'O Retorno da proposta para a comunidade acadêmica é de preenchimento obrigatório.',
        'avaliacao.required'             => 'A Avaliação é de preenchimento obrigatório.',
 
        'table-equipe.required'          => 'Os dados da Equipe Executora/Organizadora devem ser inseridos.',
        'table-criterio.required'        => 'Os dados de Critérios para seleção devem ser inseridos.',
        'table-documento.required'       => 'Os dados da Documentação necessária devem ser inseridos.',
        'table-atividade.required'       => 'Os dados de Atividades previstas devem ser inseridos.',
        'table-referencia.required'      => 'Os dados de Conteúdos/Referências devem ser inseridos.',
        'table-parceria.required'        => 'Os dados do Quadro de parcerias devem ser inseridos.',
        'table-orcamento.required'       => 'Os dados do Orçamento(Custos Envolvidos) devem ser inseridos.',
        'table-recurso.required'         => 'Os dados de Recursos (Infra-Estrura envolvida) devem ser inseridos.',
    ];


    public function novoProjeto()
    {
        return view('projeto.projeto.create_edit');
    }   

    /* METODO PARA SALVAR UM NOVO PROJETO DO AUTOR
        Irá validar os dados e então salvar no banco
    */
    public function salvarProjeto(Request $request, Projeto $projeto)
    {
        //recupera os dados menos o token do formulario
        $dataForm = $request->except(['_token']);
        //verifica se os dados estão de acordo com as validações acima
        $validator = Validator::make($request->all(), $this->rules, $this->messages);
        //caso não estejam retorna os erro especificos e os campos preenchidos
        if ($validator->fails()) {
            return redirect()->back()
                        ->withInput()
                        ->withErrors($validator);
        }

        //envia para o metodo salvar do model os dados 
        $responseSave = $projeto->salvarProjeto($dataForm);
        
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
        $projetos = auth()->user()->projects;
        $messageTitle = 'Todos os seus projetos ';   

        return view('projeto.all-projects.all-projects', compact('projetos', 'messageTitle'));
    }

    /* METODO DE VISUALIZAR TODOS OS PROJETOS
        irá retornar todos os projetos daquele usuario
    */
    public function projetosCorrecao()
    {
        $projetos = auth()->user()->projects()
                                  ->where('status_projeto', 'Corrigir')
                                  ->orWhere('status_projeto', 'Recorrigir')
                                  ->get();
        //dd($projetos);                                  
        return view('projeto.correcao.projetos-correcao', compact('projetos'));
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
    public function atualizarCorrecaoProjeto(int $id, Request $request, Projeto $projeto)
    {
        if (!auth()->user()->projects()->find($id))
            return redirect()
                        ->back()
                        ->with('error', 'Erro! esse projeto não existe para esse autor.');
         
        $validator = Validator::make($request->all(), $this->rules, $this->messages);
        
        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withInput()
                        ->withErrors($validator);
        }
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
        
        
        return view('projeto.projeto-solicitado.visualizar-projeto', 
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
