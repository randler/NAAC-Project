<?php

namespace App\Models\Relatorio;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Projeto\ProjetoAutorController;

class Cronograma extends Model
{
    protected $fillable = [
        'desc_atividade',
        'data',
        'relatorio_id'
    ];

    public function salvar(int $id, Array $dados): Array
    {
        $cont = 0;
        $serviceController = new ProjetoAutorController;

        $dataTable = $serviceController->stringToArray($dados['table-cronograma']);
        //dd($dataTable);
        for ($i=0; $i < count($dataTable) ; $i+=2) { 
            $insert = $this->create([
                'desc_atividade' => $dataTable[$i],
                'data'           => $dataTable[$i+1],
                'relatorio_id'   => $id
            ]);
            
            if ($insert)
                $cont++;
            else
                dd($insert);    
        }

        if($cont == (count($dataTable)/2))
            return [
                'success' => true,
                'message' => 'Cronograma adicionado com sucesso.'
            ];

        return [
            'success' => false,
            'message' => 'Erro ao tentar inserir dados do Cronograma.'
        ];
    }

    public function atualizar(Array $request): Array
    {
        //dd($request, $this->where('id', $request['id'])->first());
        if ($this->where('relatorio_id', $request['id'])->first() == null) {
            return $this->salvar($request['id'], $request);
        } else {
            $delete = $this->where('relatorio_id',$request['id'])->delete();

            if ($delete) {
                return $this->salvar($request['id'], $request);
            } else {
                return [
                    'success' => false,
                    'message' => 'erro ao tentar excluir dados do cronograma'
                ];
            }
        }
    }
}
