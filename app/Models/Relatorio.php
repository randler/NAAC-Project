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
        $coordenador = new Coordenador;
        $cronograma = new Cronograma;
        $equipeRelatorio = new EquipeRelatorio;
        $expositor = new Expositor;
        $ministrante = new Ministrante;
        $monitor = new Monitor;
        $ouvinte = new Ouvinte;
        $palestrante = new Palestrante;
        $participante = new Participante;

        try {
            DB::beginTransaction();
            $dadosValidados['user_id'] = auth()->user()->id;

            $insertRelatorio = $this->create($dadosValidados);
            //dd($dadosValidados, $insertRelatorio->id);

            if ($insertRelatorio) {
                // *** Atualizar a referencia do id_relatorio no projeto
                $projeto = auth()->user()
                                    ->projects()
                                    ->where('id',(int) $dadosValidados['projeto_id'])
                                    ->first()
                                    ->setRelatorio($insertRelatorio->id);
                
                if (!$projeto) {
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
                /****************************************************************** */

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
     * 
     * 
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

        //User::find($relatorio->get()->first()->user_id)->notify(new ProjetoNotification($relatorio));

        $updateCorrecao = $relatorio->update($dadosIndeferir);
        //dd($updateCorrecao);
        if ($updateCorrecao) {
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
     * 
     * 
     */
    public function deferirRelatorio(int $id): Array
    {
        DB::beginTransaction();
        
        $relatorioDeferir = $this->where('id', $id);
        //dd($relatorioDeferir);
        
        $relatorio = $relatorioDeferir->get()->first();
        $relatorio->status_relatorio = 'Deferido';
        //dd($relatorio);
        //$user = User::find($projeto->user_id)->notify(new ProjetoNotification($projeto));
        
        $updateDeferido = $relatorioDeferir->update([
            'status_relatorio'      => 'Deferido',
            'parecer_naac'          => 'Deferido'
        ]);
        //dd($updateDeferido);

        if ($updateDeferido) {
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

        DB::beginTransaction();
        //dd($request);
        $dadosValidados['status_relatorio']  = "Reenviado";
        
        $oldProjeto = $this->where('id', $id)->first();
        //$notifyProject = $oldProjeto;
        //$notifyProject->status_projeto = 'Reenviado';
        //$admins = User::where('admin', true)->get();
        //foreach ($admins as $admin)
          //  $admin->notify(new ProjetoNotification($notifyProject));
        //dd($dadosValidados);
        $updateCorrecao = $oldProjeto->update($dadosValidados);
        $dadosValidados['id'] = $id;
        //dd($dadosValidados);
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
            //dd('commit');

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
}
