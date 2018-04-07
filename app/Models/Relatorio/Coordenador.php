<?php

namespace App\Models\Relatorio;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Projeto\ProjetoAutorController;


class Coordenador extends Model
{
    protected $fillable = [
        'nome',
        'carga_horaria',
        'relatorio_id'
    ];

    public function salvar(int $id, Array $dados): Array
    {
        $cont = 0;
        $serviceController = new ProjetoAutorController;

        $dataTable = $serviceController->stringToArray($dados['table-coordenador']);
        //dd($dataTable);
        for ($i=0; $i < count($dataTable) ; $i+=2) { 
            $insert = $this->create([
                'nome' => $dataTable[$i],
                'carga_horaria' => $dataTable[$i+1],
                'relatorio_id' => $id
            ]);
            
            if ($insert)
                $cont++;
            else
                dd($insert);    
        }

        if($cont == (count($dataTable)/2))
            return [
                'success' => true,
                'message' => 'Coordenador adicionado com sucesso.'
            ];

        return [
            'success' => false,
            'message' => 'Erro ao tentar inserir dados do(s) Coordenador(es).'
        ];
    }
}
