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

            dd('Validados', $dadosValidados);
        } catch(QueryException $e) {

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
