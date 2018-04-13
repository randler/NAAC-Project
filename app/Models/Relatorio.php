<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Projeto;
use App\Models\Relatorio\Coordenador;
use App\Models\Relatorio\Cronograma;
use App\Models\Relatorio\EquipeRelatorio;
use App\Models\Relatorio\Expositor;
use App\Models\Relatorio\Ministrante;
use App\Models\Relatorio\Monitor;
use App\Models\Relatorio\Ouvinte;
use App\Models\Relatorio\Palestrante;
use App\Models\Relatorio\Participante;
use App\User;

use App\Notifications\RelatorioNotification;
use App\Mail\SendNotifications;

use Mail;
use DB;

class Relatorio extends Model
{
    private $coordenador;
    private $cronograma;
    private $equipeRelatorio;
    private $expositor;
    private $ministrante;
    private $monitor;
    private $ouvinte;
    private $palestrante;
    private $participante;

    protected $fillable = [
        'user_id',
        'titulo',
        'area',
        'sub_area',
        'coordenador_projeto',
        'cpf',
        'carga_horaria_evento',
        'periodo_realizacao',
        'periodo_abrangido_relatorio',
        'objetivo_geral',
        'objetivos_especificos',
        'resultados_obtidos',
        'parecer_responsavel',
        'status_relatorio',
        'correcao',
        'parecer_naac',
    ];


    public function salvarRelatorio(Array $dadosValidados): Array
    {
        //dd($dadosValidados);
        $projeto = new Projeto;
        $coordenador = new Coordenador;
        $cronograma = new Cronograma;
        $equipeRelatorio = new EquipeRelatorio;
        $expositor = new Expositor;
        $ministrante = new Ministrante;
        $monitor = new Monitor;
        $ouvinte = new Ouvinte;
        $palestrante = new Palestrante;
        $participante = new Participante;
        $user = new User;

        try {
            DB::beginTransaction();
            $dadosValidados['user_id'] = auth()->user()->id;

            $insertRelatorio = $this->create($dadosValidados);
            //dd($dadosValidados, $insertRelatorio->id);

            if ($insertRelatorio) {
                // *** Atualizar a referencia do id_relatorio no projeto
                $projetoResponse = $projeto->setRelatorio($dadosValidados['projeto_id'], $insertRelatorio->id);
                //dd($insertRelatorio->id, $projetoResponse, auth()->user()->projects()->where('id',(int) $dadosValidados['projeto_id'])->get());
                if (!$projetoResponse) {
                    DB::rollback();
                    return [
                        'success' => false,
                        'message' => 'Erro ao tentar atualizar o projeto deste relatório.'
                    ];
                }
                // ***

                /************** SALVAR DADOS PREENCHIDOS NAS TABELAS DA VIEW ************/
                if ($dadosValidados['table-coordenador'] != 'false') {
                    $insertCoordenador = $coordenador->salvar($insertRelatorio->id, $dadosValidados);
                    if (!$insertCoordenador['success']) {
                        DB::rollback();
                        return $insertCoordenador;
                    }
                }
                if ($dadosValidados['table-cronograma'] != 'false') {
                    $insertCronograma = $cronograma->salvar($insertRelatorio->id, $dadosValidados);
                    if (!$insertCronograma['success']) {
                        DB::rollback();
                        return $insertCronograma;
                    }
                }
                if ($dadosValidados['table-equipe_organizadora'] != 'false') {
                    $insertEquipe = $equipeRelatorio->salvar($insertRelatorio->id, $dadosValidados);
                    if (!$insertEquipe['success']) {
                        DB::rollback();
                        return $insertEquipe;
                    }
                }
                if ($dadosValidados['table-expositores'] != 'false') {
                    $insertExpositor = $expositor->salvar($insertRelatorio->id, $dadosValidados);
                    if (!$insertExpositor['success']) {
                        DB::rollback();
                        return $insertExpositor;
                    }
                }
                if ($dadosValidados['table-ministrantes'] != 'false') {
                    $insertMinistrante = $ministrante->salvar($insertRelatorio->id, $dadosValidados);
                    if (!$insertMinistrante['success']) {
                        DB::rollback();
                        return $insertMinistrante;
                    }
                }
                if ($dadosValidados['table-monitores'] != 'false') {
                    $insertMonitor = $monitor->salvar($insertRelatorio->id, $dadosValidados);
                    if (!$insertMonitor['success']) {
                        DB::rollback();
                        return $insertMonitor;
                    }
                }
                if ($dadosValidados['table-ouvintes'] != 'false') {
                    $insertOuvinte = $ouvinte->salvar($insertRelatorio->id, $dadosValidados);
                    if (!$insertOuvinte['success']) {
                        DB::rollback();
                        return $insertOuvinte;
                    }
                }
                if ($dadosValidados['table-palestrantes'] != 'false') {
                    $insertPalestrantes = $palestrante->salvar($insertRelatorio->id, $dadosValidados);
                    if (!$insertPalestrantes['success']) {
                        DB::rollback();
                        return $insertPalestrantes;
                    }
                }
                if ($dadosValidados['table-participantes'] != 'false') {
                    $insertParticipante = $participante->salvar($insertRelatorio->id, $dadosValidados);
                    if (!$insertParticipante['success']) {
                        DB::rollback();
                        return $insertParticipante;
                    }
                }
                /*************************** NOTIFICAÇÕES *************************************** */

                // ******************* NOTIFICAR NA APLICAÇÃO ******************
                $insertRelatorio->status_projeto = 'Enviado';
                $admins = User::where('admin', true)->get();
                foreach ($admins as $admin)
                        $admin->notify(new RelatorioNotification($insertRelatorio));
                
                // ****** NOTIFICAR POR E-MAIL *********
                $dadosEmail = (object) Array (
                    'para'          => $user->where('admin', true)->get()->first()->email,
                    'assunto'       => '[NAAC - Novo Relatório Cadastrado]',
                    'title'         => 'Novo Relatório',
                    'title_message' => 'A um novo relatório cadastrado, na data ' . date('d/m/Y') . '. ',
                    'descricao'     => $insertRelatorio->objetivo_geral,
                    'titulo'        => $insertRelatorio->titulo,
                    'status'        => 'Enviado',
                    'autor'         => auth()->user()->name,
                    'tipo'          => 'novo-relatorio',
                    'link'          => route('corrigir-relatorio-admin', [$insertRelatorio->id])
                );
                    
                $this->sendEmail($dadosEmail);
                    /************************************************************************************************* */

                /*** SE TUDO OCORREU PERFEITAMENTE DAR COMMIT NO BANCO E NÃO VAI GERAR ERRO */
                DB::commit();
                return [
                    'success' => true,
                    'message' => 'Relatório salvo com sucesso.'
                ];


            } else {
                /******* CASO NÃ SALVE O RELATORIO NO BANCO DAR OLLBACK E REJEITAR TODAS AS ALTERAÇÕES NO BD ****************/
                DB::rollback();
                return [
                    'success' => false,
                    'message' => 'Erro ao tentar salvar o relatório.'
                ];
            }

            
        } catch(QueryException $e) {

        }
    }

    /***************** INDEFERIR RELATORIO ********************************************
     * 
     */
    public function salvarCorrigirRelatorio(int $id, Array $dadosIndeferir): Array
    {
        //dd('Model', $id, $dadosIndeferir);
        DB::beginTransaction();
        $relatorio = $this->where('id',$id)->first();


        if ($relatorio['status_relatorio'] == "Reenviado") {
            $dadosIndeferir['status_relatorio'] = "Recorrigir";
            $relatorio->status_relatorio = 'Recorrigir';
        } else {
            $dadosIndeferir['status_relatorio'] = "Indeferido";
            $relatorio->status_relatorio = 'Indeferido';    
        }

        $updateCorrecao = $relatorio->update($dadosIndeferir);
        //dd($updateCorrecao);
        if ($updateCorrecao) {
            /** ************************* NOTIFICAÇÃO *************************** */
            // ******************** NA APLICAÇÃO *******************************
            User::find($relatorio
                            ->get()
                            ->first()
                            ->user_id
                        )
                        ->notify(new RelatorioNotification($relatorio));

            // ******************* POR E-MAIL *********************************
            $user_id = $relatorio->user_id;
            
            $dados_user = User::where('id', $user_id)->get()->first(); 
    
            $dadosEmail = (object) Array (
                'para'          => $dados_user->email,
                'assunto'       => '[NAAC - Status Relatório '. $relatorio->titulo .']',
                'title'         => 'Relatório Indeferido',
                'title_message' => 'O relatório '. $relatorio->titulo .'  foi corrigido e encontramos algumas correções a serem feitas.',
                'descricao'     => $relatorio->objetivo_geral,
                'titulo'        => $relatorio->titulo,
                'status'        => 'Indeferido',
                'autor'         => $dados_user->name,
                'tipo'          => 'relatorio-indeferido',
                'link'          => route('corrigir-relatorio-user', [$id])
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

    /** ************* DEFERIR RELATORIO **********************************************
     * 
     */
    public function deferirRelatorio(int $id): Array
    {
        DB::beginTransaction();
        
        $relatorioDeferir = $this->where('id', $id);
        
        $updateDeferido = $relatorioDeferir->update([
            'status_relatorio'      => 'Deferido',
            'parecer_naac'          => 'Deferido'
        ]);

        if ($updateDeferido) {

            /*************************** NOTIFICAÇÕES ********************************* */
            // ******************* NA APLICAÇÃO *************************
            $relatorio = $relatorioDeferir->get()->first();
            $relatorio->status_relatorio = 'Deferido';

            $user = User::find($relatorio->user_id)
                            ->notify(new RelatorioNotification($relatorio));

            // ******************* POR E-MAIL ***************************
            $dados_user = User::where('id', $relatorio->user_id)->get()->first();  
                //Compor e-mail
            $dadosEmail = (object) Array (
                'para'          => $dados_user->email,
                'assunto'       => '[NAAC - Status Relatório '. $relatorio->titulo .']',
                'title'         => 'Relatório Deferido',
                'title_message' => 'Parabéns o relatório '. $relatorio->titulo .' foi deferido na data: ' . date('d/m/Y') . '. ',
                'descricao'     => $relatorio->objetivo_geral,
                'titulo'        => $relatorio->titulo,
                'status'        => 'Deferido',
                'autor'         => $dados_user->name,
                'tipo'          => 'relatorio-deferido',
                'link'          => route('visualizar-relatorio', [$id])
            );

            $this->sendEmail($dadosEmail);
            /**************************************************************************************************************************************** */
            
            DB::commit();
            return [
                'success' => true,
                'message' => 'Relatório Deferido com sucesso!'
            ];
        } else {
            DB::rollback();
            return [
                'success' => false,
                'message' => 'Erro ao tentar Deferir o relatório.'
            ];
        }
    }

    /***************** SALVAR AS CORREÇÕES FEITAS PELO USUARIO ************************
     * 
     * 
     * 
     */
    public function salvarCorrecaoRelatorioUser(int $id, Array $dadosValidados): Array
    {
        //dd('Model', $id, $dadosValidados);
        $coordenador = new Coordenador;
        $cronograma = new Cronograma;
        $equipeRelatorio = new EquipeRelatorio;
        $expositor = new Expositor;
        $ministrante = new Ministrante;
        $monitor = new Monitor;
        $ouvinte = new Ouvinte;
        $palestrante = new Palestrante;
        $participante = new Participante;
        $user = new User;

        DB::beginTransaction();

        $dadosValidados['status_relatorio']  = "Reenviado";
        $relatorioBD = $this->where('id', $id)->first();
        $updateCorrecao = $relatorioBD->update($dadosValidados);        
        $dadosValidados['id'] = $id;

        if ($updateCorrecao) {
            
                /************** SALVAR DADOS PREENCHIDOS NAS TABELAS DA VIEW ************/
                if ($dadosValidados['table-coordenador'] != 'false') {
                    $updateCoordenador = $coordenador->atualizar($dadosValidados);
                    if (!$updateCoordenador['success']) {
                        DB::rollback();
                        return $updateCoordenador;
                    }
                }
                if ($dadosValidados['table-cronograma'] != 'false') {
                    $updateCronograma = $cronograma->atualizar($dadosValidados);
                    if (!$updateCronograma['success']) {
                        DB::rollback();
                        return $updateCronograma;
                    }
                }
                if ($dadosValidados['table-equipe_organizadora'] != 'false') {
                    $updateEquipe = $equipeRelatorio->atualizar($dadosValidados);
                    if (!$updateEquipe['success']) {
                        DB::rollback();
                        return $updateEquipe;
                    }
                }
                if ($dadosValidados['table-expositores'] != 'false') {
                    $updateExpositor = $expositor->atualizar($dadosValidados);
                    if (!$updateExpositor['success']) {
                        DB::rollback();
                        return $updateExpositor;
                    }
                }
                if ($dadosValidados['table-ministrantes'] != 'false') {
                    $updateMinistrante = $ministrante->atualizar($dadosValidados);
                    if (!$updateMinistrante['success']) {
                        DB::rollback();
                        return $updateMinistrante;
                    }
                }
                if ($dadosValidados['table-monitores'] != 'false') {
                    $updateMonitor = $monitor->atualizar($dadosValidados);
                    if (!$updateMonitor['success']) {
                        DB::rollback();
                        return $updateMonitor;
                    }
                }
                if ($dadosValidados['table-ouvintes'] != 'false') {
                    $updateOuvinte = $ouvinte->atualizar($dadosValidados);
                    if (!$updateOuvinte['success']) {
                        DB::rollback();
                        return $updateOuvinte;
                    }
                }
                if ($dadosValidados['table-palestrantes'] != 'false') {
                    $updatePalestrantes = $palestrante->atualizar($dadosValidados);
                    if (!$updatePalestrantes['success']) {
                        DB::rollback();
                        return $updatePalestrantes;
                    }
                }
                if ($dadosValidados['table-participantes'] != 'false') {
                    $updateParticipante = $participante->atualizar($dadosValidados);
                    if (!$updateParticipante['success']) {
                        DB::rollback();
                        return $updateParticipante;
                    }
                }
                /****************************************************************** */
        
            /************************** NOTIFICAÇÕES ***************************************/
            // ****************** NA APLICAÇÃO ***************************
            $relatorioBD->status_projeto = 'Reenviado';
            $admins = User::where('admin', true)->get();
            foreach ($admins as $admin)
                $admin->notify(new RelatorioNotification($relatorioBD));
            
            // ***************** POR E-MAIL *****************************
            $dadosEmail = (object) Array (
                'para'          => $user->where('admin', true)->get()->first()->email,
                'assunto'       => '['. auth()->user()->name .' - Relatório Corrigido]',
                'title'         => 'Relatório Corrigido',
                'title_message' => 'O relatório '. $relatorioBD->titulo .' foi corrigido na data: ' . date('d/m/Y') . '. ',
                'descricao'     => $relatorioBD->objetivo_geral,
                'titulo'        => $relatorioBD->titulo,
                'status'        => 'Corrigido',
                'autor'         => auth()->user()->name,
                'tipo'          => 'relatorio-corrigido',
                'link'          => route('corrigir-relatorio-admin', [$relatorioBD->id])
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

    public function procurarRelatorio($dadosPesquisa)
    {
        //dd('dados pesquisa', $dadosPesquisa);
        $pesquisa = $this->where(function ($query) use ($dadosPesquisa) {
            if (isset($dadosPesquisa['coordenador_projeto'])) {
                $query->where('coordenador_projeto', 'LIKE', '%' . $dadosPesquisa['coordenador_projeto'] . '%');
            }
            if (isset($dadosPesquisa['titulo'])) {
                $query->where('titulo', 'LIKE', '%' . $dadosPesquisa['titulo'] . '%' );
            }
            if ($dadosPesquisa['statusFind'] == 'Indeferido') {
                $query->where('status_relatorio', 'Indeferido')
                      ->orWhere('status_relatorio', 'Corrigir')
                      ->orWhere('status_relatorio', 'Recorrigir');
            } else if ( $dadosPesquisa['statusFind'] != 'all' ){
                $query->where('status_relatorio', $dadosPesquisa['statusFind']);
            }
        })//->toSql();
        //dd($pesquisa);
        ->get();

        return $pesquisa;
    }



    /*** RELATIONSHIPS */
    public function getProjeto()
    {
        return $this->hasOne(Projeto::class);
    } 

    public function getCoordenador()
    {
        return $this->hasMany(Coordenador::class);
    }

    public function getCronograma()
    {
        return $this->hasMany(Cronograma::class);
    }

    public function getEquipeRelatorio()
    {
        return $this->hasMany(EquipeRelatorio::class);
    }

    public function getExpositor()
    {
        return $this->hasMany(Expositor::class);
    }

    public function getMinistrante()
    {
        return $this->hasMany(Ministrante::class);
    }

    public function getMonitor()
    {
        return $this->hasMany(Monitor::class);
    }

    public function getOuvinte()
    {
        return $this->hasMany(Ouvinte::class);
    }

    public function getPalestrante()
    {
        return $this->hasMany(Palestrante::class);
    }

    public function getParticipante()
    {
        return $this->hasMany(Participante::class);
    }

    /******************* ENVIAR EMAIL *************************
     * 
     */
    private function sendEmail($dadosEmail)
    {
        Mail::to($dadosEmail->para)->send(new SendNotifications($dadosEmail));
    }
}
