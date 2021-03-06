<?php

namespace App\Models\Projeto;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Projeto\ProjetoAutorController;

use DB;

class Oracamento extends Model
{
    protected $fillable = [
        'desc_item',
        'quantidade',
        'valor_unitario',
        'valor_total',
        'projeto_id'
    ];

    public function salvar(int $id, Array $dados): Array
    {
        DB::beginTransaction();
        $cont = 0;
        $erro;
        $projetoController = new ProjetoAutorController;
        //dd($dados);
        $dataTable = $projetoController->stringToArray($dados['table-orcamento']);
        /*dd( $dataTable,
            (int) $dataTable[1],
            (float) $dataTable[2],
            (int) $dataTable[1] * (float) $dataTable[2]);*/
        for ($i=0; $i < count($dataTable); $i+=3) {
            $quantidade     = (int) $dataTable[($i + 1)];
            $valorUnitario  = (float) $dataTable[($i + 2)];
            $valorTotar     = $quantidade * $valorUnitario;
            
            $insert = $this->create([
                                    'desc_item'      => $dataTable[$i],
                                    'quantidade'     => $quantidade,
                                    'valor_unitario' => $valorUnitario,
                                    'valor_total'    => $valorTotar,
                                    'projeto_id'     => $id
                                ]);
       if ($insert) {
                $cont ++;
            } else {
                dd($erro = $insert);
            }
        }

        if ($cont === (count($dataTable)/3)) {
         
            DB::commit();
         
            return [
                'success' => true,
                'message' => 'Orçamento adicionado com sucesso'
            ];
        }
        
        DB::rollback();
        
        return [
                'success' => false,
                'message' => 'Erro ao tentar inserir dados do Orçamento:'
            ];    
    }

    public function atualizar(Array $request): Array
    {
        if ($this->where('projeto_id', $request['id'])->first() == null) {
            return $this->salvar($request['id'], $request);
        } else {
            $delete = $this->where('projeto_id',$request['id'])->delete();
            //dd($delete);
            if ($delete) {
                return $this->salvar($request['id'], $request);
            } else {
                return [
                    'success' => false,
                    'message' => 'erro ao tentar excluir dados de orcamento'
                ];
            }
        } 
    }   
}
