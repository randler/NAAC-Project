<?php

namespace App\Http\Requests\Projeto;

use Illuminate\Foundation\Http\FormRequest;

class ProjetoFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'titulo_projeto'        => 'required',
            'colegiado_origem'      => 'required',
            'outros_colegiados'     => 'required',
            'autores'               => 'required',
            'telefones'             => 'required',            
            'emails_responsaveis'   => 'required',
            'nome_coordenador'      => 'required',
            'publico_alvo'          => 'required',
            'cunho_social'          => 'required',
            'periodo_realizacao'    => 'required',
            'carga_horaria'         => 'required|numeric|min:1',
            'numero_vagas'          => 'required|numeric|min:1',
            'dias_horarios_evento'  => 'required',
            'justificativa'         => 'required',
            'objetivo_geral'        => 'required',
            'objetivos_especificos' => 'required',
            'avaliacao'             => 'required',
            'retorno_proposta'      => 'required',
    
            'table-equipe'          => 'required',
            'table-criterio'        => 'required',
            'table-documento'       => 'required',
            'table-atividade'       => 'required',
            'table-referencia'      => 'required',
            'table-parceria'        => 'required',
            'table-orcamento'       => 'required',
            'table-recurso'         => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [            
            'titulo_projeto.required'        => 'O campo Título do Projeto é de preenchimento obrigatório.',
            'colegiado_origem.required'      => 'O campo Colegiado de Origem é de preenchimento obrigatório.',
            'outros_colegiados.required'     => 'O campo Outros colegiados é de preenchimento obrigatório.',
            'autores.required'               => 'O campo Autores do Projeto é de preenchimento obrigatório.',
            'telefones.required'             => 'O campo Telefones é de preenchimento obrigatório.',
            'emails_responsaveis.required'   => 'O campo E-mails dos autores é de preenchimento obrigatório.',
            'nome_coordenador.required'      => 'O campo Coordenador do Projeto é de preenchimento obrigatório.',
            'publico_alvo.required'          => 'O campo Público Alvo é de preenchimento obrigatório.',
            'cunho_social.required'          => 'O campo Cunho Social é de preenchimento obrigatório.',
            'periodo_realizacao.required'    => 'O campo Período da Realização é de preenchimento obrigatório.',
            'carga_horaria.required'         => 'O campo Carga Horária é de preenchimento obrigatório.',
            'carga_horaria.numeric'          => 'O campo Carga Horária deve ser preenchido com valores numéricos.',
            'carga_horaria.min'              => 'O campo Carga Horária deve conter no minímo uma (1) hora.',
            'numero_vagas.required'          => 'O campo Número de vagas do Projeto é de preenchimento obrigatório.',
            'numero_vagas.min'               => 'O campo Número de vagas deve conter o mínimo de 100 vaga.',
            'dias_horarios_evento.required'  => 'O campo Dias e horarios da realização do evento é de preenchimento obrigatório.',
            'justificativa.required'         => 'O campo Apresentação/Justificativa é de preenchimento obrigatório.',
            'objetivo_geral.required'        => 'O campo Objetivo geral é de preenchimento obrigatório.',
            'objetivos_especificos.required' => 'O campo Objetivos específicos é de preenchimento obrigatório.',
            'retorno_proposta.required'      => 'O Retorno da proposta para a comunidade acadêmica é de preenchimento obrigatório.',
            'avaliacao.required'             => 'A Avaliação é de preenchimento obrigatório.',
     
            'table-equipe.required'          => 'Os dados da Equipe Executora/Organizadora devem ser inseridos.',
            'table-criterio.required'        => 'Os dados de Critérios para seleção devem ser inseridos.',
            'table-documento.required'       => 'Os dados da Documentação necessária devem ser inseridos.',
            'table-atividade.required'       => 'Os dados de Atividades previstas devem ser inseridos.',
            'table-referencia.required'      => 'Os dados de Conteúdos/Referências devem ser inseridos.',
            'table-parceria.required'        => 'Os dados do Quadro de parcerias devem ser inseridos.',
            'table-orcamento.required'       => 'Os dados do Orçamento(Custos Envolvidos) devem ser inseridos.',
            'table-recurso.required'         => 'Os dados de Recursos (Infra-Estrura envolvida) devem ser inseridos.',
        ];
    }
}
