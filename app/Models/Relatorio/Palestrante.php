<?php

namespace App\Models\Relatorio;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Projeto\ProjetoAutorController;

class Palestrante extends Model
{
    protected $fillable = [
        'nome',
        'titulo',
        'carga_horaria',
        'relatorio_id'
    ];

    public function salvar(int $id, Array $dados): Array
    {
        $cont = 0;
        $serviceController = new ProjetoAutorController;

        $dataTable = $serviceController->stringToArray($dados['table-palestrantes']);
        //dd($dataTable);
        for ($i=0; $i < count($dataTable) ; $i+=3) { 
            $insert = $this->create([
                'nome'           => $dataTable[$i],
                'titulo'  => $dataTable[$i+1],
                'carga_horaria'  => $dataTable[$i+2],
                'relatorio_id'   => $id
            ]);
            
            if ($insert)
                $cont++;
            else
                dd($insert);    
        }

        if($cont == (count($dataTable)/3))
            return [
                'success' => true,
                'message' => 'Palestrante adicionado com sucesso.'
            ];

        return [
            'success' => false,
            'message' => 'Erro ao tentar inserir dados do(s) Palestrante(s).'
        ];
    }
}
