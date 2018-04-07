<?php

namespace App\Models\Projeto;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Projeto\ProjetoAutorController;


class EquipeProjeto extends Model
{
    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'projeto_id'
    ];

    public function salvar(int $id, Array $dados): Array
    {
        $cont = 0;
        $projetoController = new ProjetoAutorController;

        $dataTable = $projetoController->stringToArray($dados['table-equipe']);
        for ($i=0; $i < count($dataTable); $i+=3) {
            $insert = $this->create([
                                    'nome'          => $dataTable[$i],
                                    'email'         => $dataTable[($i + 1)],
                                    'telefone'      => $dataTable[($i + 2)],
                                    'projeto_id'    => $id
                                ]);
            if ($insert) {
                $cont ++;
            } else {
                dd($insert);
            }
        }

        if ($cont === (count($dataTable)/3))
            return [
                'success' => true,
                'message' => 'Equipe adicionada com sucesso'
            ];
            
        return [
                'success' => false,
                'message' => 'Erro ao tentar inserir dados da equipe:'
            ];    

    }

    public function atualizar(Array $request): Array
    {
        if ($this->where('projeto_id', $request['id'])->first() == null) {
            return $this->salvar($request['id'], $request);
        } else {
            $delete = $this->where('projeto_id',$request['id'])->delete();

            if ($delete) {
                return $this->salvar($request['id'], $request);
            } else {
                return [
                    'success' => false,
                    'message' => 'erro ao tentar excluir dados de equipe do projeto'
                ];
            }
        }
    }
}
