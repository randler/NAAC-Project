<?php

namespace App\Http\Requests\Relatorio;

use Illuminate\Foundation\Http\FormRequest;

class RelatorioFormRequest extends FormRequest
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
            'titulo'                        => 'required',
            'area'                          => 'required',
            'sub_area'                      => 'required',
            'coordenador_projeto'           => 'required',
            'cpf'                           => 'required',
            'carga_horaria_evento'          => 'required|numeric|min:1',
            'periodo_realizacao'            => 'required',
            'periodo_abrangido_relatorio'   => 'required',
            'objetivo_geral'                => 'required',
            'objetivos_especificos'         => 'required',
            'resultados_obtidos'            => 'required',
            'parecer_responsavel'           => 'required',

            'table-cronograma'              => 'required',
            'table-coordenador'             => 'required',
            'table-equipe_organizadora'     => 'required',
            'table-palestrantes'            => 'required',
            'table-monitores'               => 'required',
            'table-expositores'             => 'required',
            'table-ministrantes'            => 'required',
            'table-participantes'           => 'required',
            'table-ouvintes'                => 'required',
        ];
    }

    public function messages()
    {

        return [
            'titulo.required'                       => 'O Título do projeto é de preenchimento obrigatório.',
            'area.required'                         => 'A Área é de preenchimento obrigatório.',
            'sub_area.required'                     => 'A Subárea é de projeto é de preenchimento obrigatório.',
            'coordenador_projeto.required'          => 'O nome do Coordenador é de preenchimento obrigatório.',
            'cpf.required'                          => 'O CPF é de preenchimento obrigatório.',
            'carga_horaria_evento.required'         => 'A Carga horária é de preenchimento obrigatório.',
            'carga_horaria_evento.numeric'          => 'A Carga horária deve se rdo tipo númerica',
            'carga_horaria_evento.min'              => 'A Carga horária deve conter um minímo de uma (1) hora.',
            'periodo_realizacao.required'           => 'O período de realização é de preenchimento obrigatório.',
            'periodo_abrangido_relatorio.required'  => 'O período abrangido pelo relatório é de preenchimento obrigatório.',
            'objetivo_geral.required'               => 'O Objetivo geral é de preenchimento obrigatório.',
            'objetivos_especificos.required'        => 'Os Objetivos especificos são de preenchimento obrigatório.',
            'resultados_obtidos.required'           => 'Os resultados obtidos são de preenchimento obrigatório.',
            'parecer_responsavel.required'          => 'O parecer é de preenchimento obrigatório.',

            'table-cronograma.required'             => 'A Tabela Cronograma deve ser preenchida ou não aplicada.',
            'table-coordenador.required'            => 'A Tabela Coordenador deve ser preenchida ou não aplicada.',
            'table-equipe_organizadora.required'    => 'A Tabela Equipe Organizadora deve ser preenchida ou não aplicada.',
            'table-palestrantes.required'           => 'A Tabela Palestrantes deve ser preenchida ou não aplicada.',
            'table-monitores.required'              => 'A Tabela Monitoresdeve ser preenchida ou não aplicada.',
            'table-expositores.required'            => 'A Tabela Expositores deve ser preenchida ou não aplicada.',
            'table-ministrantes.required'           => 'A Tabela Ministrantes deve ser preenchida ou não aplicada.',
            'table-participantes.required'          => 'A Tabela Participantes deve ser preenchida ou não aplicada.',
            'table-ouvintes.required'               => 'A Tabela Ouvintes deve ser preenchida ou não aplicada.',







            'titulo_projeto.required'        => 'O campo Título do Projeto é de preenchimento obrigatório.',
            'colegiado_origem.required'      => 'O campo Colegiado de Origem é de preenchimento obrigatório.',
            'outros_colegiados.required'     => 'O campo Outros colegiados é de preenchimento obrigatório.',
            'autores.required'               => 'O campo Autores do Projeto é de preenchimento obrigatório.',
            'emails_responsaveis.required'   => 'O campo E-mails dos autores é de preenchimento obrigatório.',
            'nome_coordenador.required'      => 'O campo Coordenador do Projeto é de preenchimento obrigatório.',
            'publico_alvo.required'          => 'O campo Público Alvo é de preenchimento obrigatório.',
            'cunho_social.required'          => 'O campo Cunho Social é de preenchimento obrigatório.',
            'periodo_realizacao.required'    => 'O campo Período da Realização é de preenchimento obrigatório.',
            'carga_horaria.required'         => 'O campo Carga Horária é de preenchimento obrigatório.',
            'carga_horaria.numeric'          => 'O campo Carga Horária deve ser preenchido com valores numéricos.',
            'carga_horaria.max'              => 'O campo Carga Horária não deve ultrapassar 1000 horas.',
            'numero_vagas.required'          => 'O campo Número de vagas do Projeto é de preenchimento obrigatório.',
            'numero_vagas.min'               => 'O campo Número de vagas deve conter o mínimo de 100 vaga.',
            'numero_vagas.max'               => 'O campo Número de vagas não deve ultrapassar 1000 vagas.',
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
