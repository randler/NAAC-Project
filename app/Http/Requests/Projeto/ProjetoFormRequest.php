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
            'inputTitulo'                   => 'required',
            'inputColegiado'                => 'required',
            'inputOutrosColegiados'         => 'requires',
            'inputAutores'                  => 'required',
            'inputEmailsAutores'            => 'required',
            'inputCoordenador'              => 'required',
            'inputPublicoAlvo'              => 'required',
            'inlineRadioCunho'              => 'required',
            'dateRangePeriodo'              => 'required',
            'inputCH'                       => 'required|numeric|max:1000',
            'inputVagas'                    => 'required|min:1|max:100',
            'inputDiasHoras'                => 'required',
            'inputJustificatva'             => 'required',
            'inputObjetivoGeral'            => 'required',
            'inputObjetivosEspecificos'     => 'required',
            'table-equipe'                  => 'required',
            'table-criterio'                => 'required',
            'table-documento'               => 'required',
            'table-atividade'               => 'required',
            'table-referencia'              => 'required',
            'inputAvaliacao'                => 'required',
            'table-parceria'                => 'required',
            'table-orcamento'               => 'required',
            'table-recurso'                 => 'required',
            'inputProposta'                 => 'required'
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
            'inputTitulo.required'                  => 'O campo Título do Projeto é de preenchimento obrigatório.',
            'inputColegiado.required'               => 'O campo Colegiado de Origem é de preenchimento obrigatório.',
            'inputOutrosColegiados.required'        => 'O campo Outros colegiados é de preenchimento obrigatório.',
            'inputAutores.required'                 => 'O campo Autores do Projeto é de preenchimento obrigatório.',
            'inputEmailsAutores.required'           => 'O campo E-mails dos autores é de preenchimento obrigatório.',
            'inputCoordenador.required'             => 'O campo Coordenador do Projeto é de preenchimento obrigatório.',
            'inputPublicoAlvo.required'             => 'O campo Público Alvo é de preenchimento obrigatório.',
            'inlineRadioCunho.required'             => 'O campo Cunho Social é de preenchimento obrigatório.',
            'dateRangePeriodo.required'             => 'O campo Período da Realização é de preenchimento obrigatório.',
            'inputCH.required'                      => 'O campo Carga Horária é de preenchimento obrigatório.',
            'inputCH.numeric'                       => 'O campo Carga Horária deve ser preenchido com valores numéricos.',
            'inputCH.max'                           => 'O campo Carga Horária não deve ultrapassar 1000 horas.',
            'inputVagas.required'                   => 'O campo Número de vagas do Projeto é de preenchimento obrigatório.',
            'inputVagas.min'                        => 'O campo Número de vagas deve conter o mínimo de uma vaga.',
            'inputVagas.max'                        => 'O campo Número de vagas não deve ultrapassar 1000 vagas.',
            'inputDiasHoras.required'               => 'O campo Dias e horarios da realização do evento é de preenchimento obrigatório.',
            'inputJustificatva.required'            => 'O campo Apresentação/Justificativa é de preenchimento obrigatório.',
            'inputObjetivoGeral.required'           => 'O campo Objetivo geral é de preenchimento obrigatório.',
            'inputObjetivosEspecificos.required'    => 'O campo Objetivos específicos é de preenchimento obrigatório.',
            'table-equipe.required'                 => 'Os Dados da Equipe Executora/Organizadora devem ser inseridos.',
            'table-criterio.required'               => 'Os Dados de Critérios para seleção devem ser inseridos.',
            'table-documento.required'              => 'Os Dados da Documentação necessária devem ser inseridos.',
            'table-atividade.required'              => 'Os Dados de Atividades previstas devem ser inseridos.',
            'table-referencia.required'             => 'Os Dados de Conteúdos/Referências devem ser inseridos.',
            'inputAvaliacao.required'               => 'A Avaliação é de preenchimento obrigatório.',
            'table-parceria.required'               => 'Os Dados do Quadro de parcerias devem ser inseridos.',
            'table-orcamento.required'              => 'Os Dados do Orçamento(Custos Envolvidos) devem ser inseridos.',
            'table-recurso.required'                => 'Os Dados de Recursos (Infra-Estrura envolvida) devem ser inseridos.',
            'inputProposta.required'                => 'O Retorno da proposta para a comunidade acadêmica é de preenchimento obrigatório.'
        ];
    }
}
