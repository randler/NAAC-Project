<?php

namespace App\Models\Projeto;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Projeto\ProjetoAutorController;

class AtividadePrevista extends Model
{
    protected $fillable = [
        'desc_atividades',
        'titulo_atividade',
        'obs_atividade',
        'projeto_id'
    ];
    
    public function salvar(int $id, Array $dados): Array
    {
        $cont = 0;
        $erro;
        $projetoController = new ProjetoAutorController;
        
        $dataTable = $projetoController->stringToArray($dados['table-atividade']);
        //dd($dataTable);
        for ($i = 0; $i < count($dataTable); $i+=3) {
            $insert = $this->create([
                                    'desc_atividades'   => $dataTable[$i],
                                    'titulo_atividade'  => $dataTable[($i + 1)],
                                    'obs_atividade'     => $dataTable[($i + 2)],
                                    'projeto_id'        => $id
                                ]);                      
        if ($insert) {
                $cont ++;
            } else {
                dd($erro = $insert);
            }
        }

        if ($cont === (count($dataTable)/3))
            return [
                'success' => true,
                'message' => 'Atividade adicionada com sucesso'
            ];

        return [
                'success' => false,
                'message' => 'Erro ao tentar inserir dados da Atividade:'
            ];    
    }
    
    public function atualizar(Array $request): Array
    {
        //dd($request, $this->where('id', $request['id'])->first());
        if ($this->where('projeto_id', $request['id'])->first() == null) {
            return $this->salvar($request['id'], $request);
        } else {
            $delete = $this->where('projeto_id',$request['id'])->delete();

            if ($delete) {
                return $this->salvar($request['id'], $request);
            } else {
                return [
                    'success' => false,
                    'message' => 'erro ao tentar excluir dados de atividades'
                ];
            }
        }
    }
}
