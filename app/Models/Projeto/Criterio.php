<?php

namespace App\Models\Projeto;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Projeto\ProjetoAutorController;

class Criterio extends Model
{
    protected $fillable = [
        'desc_criterio',
        'projeto_id'
    ];

    public function salvar(int $id, Array $dados): Array
    {
        $cont = 0;
        $erro;
        $projetoController = new ProjetoAutorController;
        
        $dataTable = $projetoController->stringToArray($dados['table-criterio']);
        for ($i = 0; $i < count($dataTable); $i++) {
            $insert = $this->create([
                                    'desc_criterio' => $dataTable[$i],
                                    'projeto_id'    => $id
                                ]);
        if ($insert) {
                $cont ++;
            } else {
                dd($erro = $insert);
            }
        }

        if ($cont === count($dataTable))
            return [
                'success' => true,
                'message' => 'Criterio adicionado com sucesso'
            ];

        return [
                'success' => false,
                'message' => 'Erro ao tentar inserir dados do Criterio:'
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
                    'message' => 'erro ao tentar excluir dados de criterios'
                ];
            }
        }
    }
}
