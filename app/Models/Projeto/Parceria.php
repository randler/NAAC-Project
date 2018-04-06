<?php

namespace App\Models\Projeto;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Projeto\ProjetoAutorController;

class Parceria extends Model
{
    protected $fillable = [
        'desc_parceria',
        'representante',
        'contato',
        'projeto_id'
    ];

    public function salvar(int $id, Array $dados): Array
    {
        $cont = 0;
        $erro;
        $projetoController = new ProjetoAutorController;

        $dataTable = $projetoController->stringToArray($dados['table-parceria']);
        for ($i=0; $i < count($dataTable); $i+=3) {
            $insert = $this->create([
                                    'desc_parceria' => $dataTable[$i],
                                    'representante' => $dataTable[($i + 1)],
                                    'contato'       => $dataTable[($i + 2)],
                                    'projeto_id'    => $id
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
                'message' => 'Parceria adicionado com sucesso'
            ];

        return [
                'success' => false,
                'message' => 'Erro ao tentar inserir dados da Parceria'
            ];    
    }

    public function atualizar(Array $request): Array
    {
        //dd($this->all()->first());
        if ($this->where('projeto_id', $request['id'])->first() == null) {
            return $this->salvar($request['id'], $request);
        } else {
            $delete = $this->where('projeto_id', $request['id'])->delete();
            
            if ($delete) {
                return $this->salvar($request['id'], $request);
            } else {
                return [
                    'success' => false,
                    'message' => 'erro ao tentar excluir dados de parceria'
                ];
            }
        }
    }
}
