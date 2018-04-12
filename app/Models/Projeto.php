<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Projeto\AtividadePrevista;
use App\Models\Projeto\Conteudo;
use App\Models\Projeto\Criterio;
use App\Models\Projeto\Documento;
use App\Models\Projeto\EquipeProjeto;
use App\Models\Projeto\Oracamento;
use App\Models\Projeto\Parceria;
use App\Models\Projeto\Recurso;
use App\User;

use App\Notifications\ProjetoNotification;
use App\Mail\SendNotifications;

use Mail;
use DB;

class Projeto extends Model
{
    private $equipeProjeto;
    private $criterio;
    private $documento;
    private $atividade;
    private $referencia;
    private $parceria;
    private $orcamento;
    private $recurso;

    protected $fillable = [
        'user_id',
        'realtorio_id',
        'titulo_projeto',
        'colegiado_origem',
        'outros_colegiados',
        'autores',
        'telefones',
        'emails_responsaveis',
        'data_aprovacao_colegiado',
        'data_entrada_naac',
        'numero_registro_naac',
        'parecer_naac',
        'data_aprovacao_naac',
        'nome_coordenador',
        'publico_alvo',
        'cunho_social',
        'periodo_realizacao',
        'carga_horaria',
        'numero_vagas',
        'dias_horarios_evento',
        'objetivo_geral',
        'objetivos_especificos',
        'justificativa',
        'avaliacao',
        'status_projeto',
        'correcao',
        'retorno_proposta',
        'has_relatorio'        
    ];

    public function salvarProjeto(Array $dados): Array
    {
        $equipeProjeto = new EquipeProjeto;
        $criterio = new Criterio;
        $documento = new Documento;
        $atividade = new AtividadePrevista;
        $referencia = new Conteudo;
        $parceria = new Parceria;
        $orcamento = new Oracamento;
        $recurso = new Recurso;
        $user = new User;

        try {

           DB::beginTransaction();
            
            $dados['user_id'] = auth()->user()->id;
            $dados['cunho_social'] = ($dados['cunho_social'] == "Sim") ? true : false;
            $dados['data_entrada_naac'] = date("d/m/Y");
            $dados['numero_registro_naac'] = uniqid(null, true);
            //dd($dados);
            $insert = $this->create($dados);
                        
                if ($insert) {
                    if ($dados['table-equipe'] != "false") {
                        $insertEquipe = $equipeProjeto->salvar($insert->id, $dados);
                        if (!$insertEquipe['success']) {
                            DB::rollback();
                            return $insertEquipe;
                            
                        }                            
                    }
                    if ($dados['table-criterio'] != "false") {
                        $insertCriterio = $criterio->salvar($insert->id, $dados);
                        if (!$insertCriterio['success']) {
                            DB::rollback();
                            return $insertCriterio;
                        }
                    }
                    if ($dados['table-documento'] != "false") {
                        $insertDocumento = $documento->salvar($insert->id, $dados);
                        if (!$insertDocumento['success']) {
                            DB::rollback();
                            return $insertDocumento;
                        }
                    }
                    if ($dados['table-atividade'] != "false") {
                        $insertAtividade = $atividade->salvar($insert->id, $dados);
                        if (!$insertAtividade['success']) {
                            DB::rollback();
                            return $insertAtividade;
                        }
                    }
                    if ($dados['table-referencia'] != "false") {
                        $insertReferencia = $referencia->salvar($insert->id, $dados);
                        if (!$insertReferencia['success']) {
                            DB::rollback();
                            return $insertReferencia;
                        }
                    }
                    if ($dados['table-parceria'] != "false") {
                        $insertParceria = $parceria->salvar($insert->id, $dados);
                        if (!$insertParceria['success']) {
                            DB::rollback();
                            return $insertParceria;
                        }
                    }
                    if ($dados['table-orcamento'] != "false") {
                        $insertOrcamento = $orcamento->salvar($insert->id, $dados);
                        if (!$insertOrcamento['success']) {
                            DB::rollback();
                            return $insertOrcamento;
                        }
                    }
                    if ($dados['table-recurso'] != "false") {
                        $insertRecurso = $recurso->salvar($insert->id, $dados);
                        if (!$insertRecurso['success']){
                            DB::rollback();
                            return $insertRecurso;
                        }
                    }

                    /** ************************ NOTIFICAÇÕES ********************
                     *  
                    **/
                    // ******* NOTIFICAR NO SISTEMA *******
                    $insert->status_projeto = 'Enviado';
                    $admins = User::where('admin', true)->get();
                    foreach ($admins as $admin)
                        $admin->notify(new ProjetoNotification($insert));
                    
                    // ****** NOTIFICAR POR E-MAIL *********
                    $dadosEmail = (object) Array (
                        'para'          => $user->where('admin', true)->get()->first()->email,
                        'assunto'       => '[NAAC - Novo Projeto Cadastrado]',
                        'title'         => 'Novo Projeto',
                        'title_message' => 'A um novo projeto cadastrado, na data ' . date('d/m/Y') . '. ',
                        'descricao'     => $insert->objetivo_geral,
                        'titulo'        => $insert->titulo_projeto,
                        'status'        => 'Enviado',
                        'autor'         => auth()->user()->name,
                        'tipo'          => 'novo-projeto',
                        'link'          => route('corrigir-project', [$insert->id])
                    );
                    
                    $this->sendEmail($dadosEmail);
                    /************************************************************************************************* */
                    DB::commit();

                    return [
                        'success' => true,
                        'message' => 'Projeto salvo com sucesso'
                    ];
                } else {
                    DB::rollback();
                    return [
                        'success' => false,
                        'message' => 'Erro ao tentar salvar o projeto'
                    ];
                }
            } catch (QueryException $e) {
                if ($e->errorInfo[0] == "23000") {
                    return [
                        'success' => false,
                        'message' => 'Um projeto com esse título já está cadastrado!'
                    ];
                } else {
                    return [
                        'success' => false,
                        'message' => "ERRO: $e"
                    ];
                }
            }
    }

    /********************* SALVAR AS INFORMAÇÕES DE INDEFERIR ****************
     * 
     * 
     */
    public function salvarCorrecaoAdmin(Array $correcaoForm, $id): Array
    {
        DB::beginTransaction();
        $project = $this->where('id',$id)->first();

       
        $correcaoForm['data_aprovacao_naac'] = date("d/m/Y");

        if ($project['status_projeto'] == "Reenviado") {
            $correcaoForm['status_projeto'] = "Recorrigir";
            $project->status_projeto = 'Recorrigir';
        } else {
            $correcaoForm['status_projeto'] = "Indeferido";
            $project->status_projeto = 'Indeferido';    
        }

        // SALVAR A CORREÇÃO
        $updateCorrecao = $project->update($correcaoForm);

        if ($updateCorrecao) {
            /** ***************************** NOTIFICAR *************************************** */
            // ******************** NA APLICAÇÃO ************************
            User::find($project
                            ->get()
                            ->first()
                            ->user_id)
                        ->notify(new ProjetoNotification($project));

            // ******************** POR E-MAIL **************************
            $user_id = $project->user_id;
            
            $dados_user = User::where('id', $user_id)->get()->first(); 
            $email_user = $dados_user->email;
    
            $dadosEmail = (object) Array (
                'para'          => $email_user,
                'assunto'       => '[NAAC - Status Projeto '. $project->titulo_projeto .']',
                'title'         => 'Projeto Indeferido',
                'title_message' => 'O projeto '. $project->titulo_projeto .'  foi corrigido e encontramos algumas correções a serem feitas.',
                'descricao'     => $project->objetivo_geral,
                'titulo'        => $project->titulo_projeto,
                'status'        => 'Indeferido',
                'autor'         => $dados_user->name,
                'tipo'          => 'projeto-indeferido',
                'link'          => route('corrigir-projeto-user', [$id])
            );

            $this->sendEmail($dadosEmail);
            // **************************************************************************************************
            DB::commit();
            return [
                'success' => true,
                'message' => 'Correção do projeto salva com sucesso!'
            ];
        } else {
            DB::rollback();
            return [
                'success' => false,
                'message' => 'Erro ao tentar salvar a correção do projeto'
            ];
        }
    }

    /** ******* DEFERIR PROJETO *************
     * 
     */
    public function deferir($id)
    {
        DB::beginTransaction();
        
        $projetoDeferir = $this->where('id', $id);//->get()->first();
        //dd($projetoDeferir);
        
        $updateDeferido = $projetoDeferir->update([
            'status_projeto'        => 'Deferido',
            'parecer_naac'          => 'Deferido',
            'data_aprovacao_naac'   => date("d/m/Y")
        ]);

        if ($updateDeferido) {
            /** ************************ NOTIFICAR *************************************************/
            // ******* NA APLICAÇÃO *************
            $projeto = $projetoDeferir->get()->first();
            $projeto->status_projeto = 'Deferido';

            $user = User::find($projeto->user_id)
                            ->notify(new ProjetoNotification($projeto));

            // ********* POR E-MAIL **************
                //Email do usuário
            $dados_user = User::where('id', $projeto->user_id)->get()->first(); 
            $email_user = $dados_user->email; 
                //Compor e-mail
            $dadosEmail = (object) Array (
                'para'          => $email_user,
                'assunto'       => '[NAAC - Status Projeto '. $projeto->titulo_projeto .']',
                'title'         => 'Projeto Deferido',
                'title_message' => 'Parabéns o projeto '. $projeto->titulo_projeto .' foi deferido na data: ' . date('d/m/Y') . '. ',
                'descricao'     => $projeto->objetivo_geral,
                'titulo'        => $projeto->titulo_projeto,
                'status'        => 'Deferido',
                'autor'         => $dados_user->name,
                'tipo'          => 'projeto-deferido',
                'link'          => route('visualizar-projeto', [$id])
            );

            $this->sendEmail($dadosEmail);
            /**************************************************************************************************************************************** */
            
            DB::commit();
            return [
                'success' => true,
                'message' => 'Projeto Deferido com sucesso!'
            ];
        } else {
            DB::rollback();
            return [
                'success' => false,
                'message' => 'Erro ao tentar Deferir o projeto.'
            ];
        }
    }

    /********************** SALVAR AS CORREÇÕES FEITA PELO USUARIO **********************
     * 
     * 
     */
    public function userCorrigirProjeto(int $id, Array $request): Array
    {
        DB::beginTransaction();
        //dd($request);
        $equipeProjeto = new EquipeProjeto;
        $criterio = new Criterio;
        $documento = new Documento;
        $atividade = new AtividadePrevista;
        $referencia = new Conteudo;
        $parceria = new Parceria;
        $orcamento = new Oracamento;
        $recurso = new Recurso;
        $user = new User;

        $request['status_projeto']  = "Reenviado";
        $request['cunho_social']    = ($request['cunho_social'] == "Sim") ? true : false;
        //dd($request);

        $oldProjeto = $this->where('id', $id)->first();
        $updateCorrecao = $oldProjeto->update($request);
        $request['id'] = $id;
        //dd($request);
        if ($updateCorrecao) {
            if ($request['table-equipe'] != "false") {
                //dd($request);
                $updateEquipe = $equipeProjeto->atualizar($request);
                if (!$updateEquipe['success']) {
                    DB::rollback();
                    return $updateEquipe;
                    
                }                            
            }
            if ($request['table-criterio'] != "false") {
                $updateCriterio = $criterio->atualizar($request);
                if (!$updateCriterio['success']) {
                    DB::rollback();
                    return $updateCriterio;
                }
            }
            if ($request['table-documento'] != "false") {
                $updateDocumento = $documento->atualizar($request);
                if (!$updateDocumento['success']) {
                    DB::rollback();
                    return $updateDocumento;
                }
            }
            if ($request['table-atividade'] != "false") {
                $updateAtividade = $atividade->atualizar($request);
                if (!$updateAtividade['success']) {
                    DB::rollback();
                    return $updateAtividade;
                }
            }
            if ($request['table-referencia'] != "false") {
                $updateReferencia = $referencia->atualizar($request);
                if (!$updateReferencia['success']) {
                    DB::rollback();
                    return $updateReferencia;
                }
            }
            if ($request['table-parceria'] != "false") {
                $updateParceria = $parceria->atualizar($request);
                if (!$updateParceria['success']) {
                    DB::rollback();
                    return $updateParceria;
                }
            }
            if ($request['table-orcamento'] != "false") {
                $updateOrcamento = $orcamento->atualizar($request);
                if (!$updateOrcamento['success']) {
                    DB::rollback();
                    return $updateOrcamento;
                }
            }
            if ($request['table-recurso'] != "false") {
                $updateRecurso = $recurso->atualizar($request);
                if (!$updateRecurso['success']){
                    DB::rollback();
                    return $updateRecurso;
                }
            }


            /******************************* NOTIFICAÇÕES ******************************************/
            // ****************** NA APLICAÇÃO ***************************
            $oldProjeto->status_projeto = 'Reenviado';
            $admins = User::where('admin', true)->get();
            foreach ($admins as $admin)
                $admin->notify(new ProjetoNotification($oldProjeto));

            // *************** POR E-MAIL ***************
            //dd($oldProjeto->id);
            $dadosEmail = (object) Array (
                'para'          => $user->where('admin', true)->get()->first()->email,
                'assunto'       => '['. auth()->user()->name .' - Projeto Corrigido]',
                'title'         => 'Projeto Corrigido',
                'title_message' => 'O projeto '. $oldProjeto->titulo_projeto .' foi corrigido na data: ' . date('d/m/Y') . '. ',
                'descricao'     => $oldProjeto->objetivo_geral,
                'titulo'        => $oldProjeto->titulo_projeto,
                'status'        => 'Corrigido',
                'autor'         => auth()->user()->name,
                'tipo'          => 'projeto-corrigido',
                'link'          => route('corrigir-project', [$oldProjeto->id])
            );

            $this->sendEmail($dadosEmail);
            /****************************************************************************************/

            DB::commit();
            return [
                'success' => true,
                'message' => 'Projeto corrigido e enviado com sucesso!'
            ];

        } else {
            DB::rollback();
            return [
                'success' => false,
                'message' => 'Erro ao tentar corrigir o projeto!'
            ];
        }
    }

    public function setRelatorio(int $idProjeto, int $idRelatorio)
    {
        //dd($idRelatorio);
        $update = $this->where('id', $idProjeto)->update([
            'relatorio_id' => $idRelatorio,
            'has_relatorio' => true
        ]);

        if ($update)
            return true;

        return false;
    }

    public function getEquipe()
    {
        return $this->hasMany(EquipeProjeto::class);
    }

    public function getAtividades()
    {
        return $this->hasMany(AtividadePrevista::class);
    }

    public function getConteudos()
    {
        return $this->hasMany(Conteudo::class);
    }

    public function getCriterios()
    {
        return $this->hasMany(Criterio::class);
    }

    public function getDocumento()
    {
        return $this->hasMany(Documento::class);
    }

    public function getOrcamentos()
    {
        return $this->hasMany(Oracamento::class);
    }

    public function getParcerias()
    {
        return $this->hasMany(Parceria::class);
    }

    public function getRecursos()
    {
        return $this->hasMany(Recurso::class);
    }


    /******************* ENVIAR EMAIL *************************
     * 
     */
    private function sendEmail($dadosEmail)
    {
        Mail::to($dadosEmail->para)->send(new SendNotifications($dadosEmail));
    }
}
