@extends('layouts.app')

@section('content')

<div class="m-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <i class="fa-5x far fa-file"></i>
                <h3 class="display-3">Correção do projeto {{$dadosProject->titulo_projeto or ''}}</h3>
            </div>
        </div>
    </div>
</div>
<div class="p-1">
  <div class="container">
      <div class="row">
        <div class="col-md-12 m-6">
          <div class="row">
            <div class="col-md-6">
              <h3 class="m-6">Dados gerais do projeto</h3>
            </div>
            <div class="col-md-6 text-right">
              @if ($dadosProject->status_projeto == 'Deferido')
                <a href="{{route('download-lista', [$dadosProject->id])}}" class="m-1  btn btn-warning btn-sm text-white"> <i class="fas fa-download"></i> Baixar Lista </a>                    
                <a href="{{route('download-projeto', [$dadosProject->id])}}" class="m-1 btn btn-primary btn-sm"> <i class="fas fa-download"></i> baixar Projeto </a>
              @endif
            </div>
          </div>
          </div>
      </div>
    </div>
</div>  


<div class="p-1">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <table class="table table-hover table-striped table-responsive-xs">
          <thead>
          </thead>
            <tbody>
              <tr>
                <div class="col-md-12">
                <td class="w-25 text-right font-weight-bold">Título: </td>
                <td class="w-75 text-left">{{$dadosProject->titulo_projeto}}</td>
                </div>
              </tr>
              <tr>
                <td class="text-right font-weight-bold">Colegiado de Origem:</td>
                <td class="text-left">{{$dadosProject->colegiado_origem}}</td>
              </tr>
              <tr>
                <td class="text-right font-weight-bold">Outros colegiados:</td>
                <td class="text-left">{{$dadosProject->outros_colegiados}}</td>
              </tr>
              <tr>
                <td class="text-right font-weight-bold">Autores:</td>
                <td class="text-left">{{$dadosProject->autores}}</td>
              </tr>
              <tr>
                <td class="text-right font-weight-bold">telefones:</td>
                <td class="text-left">{{$dadosProject->telefones}}</td>
              </tr>
              <tr>
                <td class="text-right font-weight-bold">E-mails:</td>
                <td class="text-left">{{$dadosProject->emails_responsaveis}}</td>
              </tr>
              <tr>
                <td class="text-right font-weight-bold">Data Entrada NAAC:</td>
                <td class="text-left">{{$dadosProject->data_entrada_naac}}</td>
              </tr>
              <tr>
                <td class="text-right font-weight-bold">Número de registro:</td>
                <td class="text-left">{{$dadosProject->numero_registro_naac}}</td>
              </tr>
              <tr>
                <td class="text-right font-weight-bold">Coordenador:</td>
                <td class="text-left">{{$dadosProject->nome_coordenador}}</td>
              </tr>
              <tr>
                <td class="text-right font-weight-bold">Público alvo:</td>
                <td class="text-left">{{$dadosProject->publico_alvo}}</td>
              </tr>
              <tr>
                <td class="text-right font-weight-bold">Tem cunho social?</td>
                <td class="text-left">{{$dadosProject->cunho_social == 1 ? 'Sim' : 'Não'}}</td>
              </tr>
              <tr>
                <td class="text-right font-weight-bold">Período de realização:</td>
                <td class="text-left">{{$dadosProject->periodo_realizacao}}</td>
              </tr>
              <tr>
                <td class="text-right font-weight-bold">Carga horaria:</td>
                <td class="text-left">{{$dadosProject->carga_horaria}} horas</td>
              </tr>
              <tr>
                <td class="text-right font-weight-bold">Número de Vagas:</td>
                <td class="text-left">{{$dadosProject->numero_vagas}}</td>
              </tr>
              <tr>
                <td class="text-right font-weight-bold">Dias e Horários:</td>
                <td class="text-left">{{$dadosProject->dias_horarios_evento}}</td>
              </tr>
              <tr>
                <td class="text-right font-weight-bold">Objetivo Geral</td>
                <td class="text-left">{{$dadosProject->objetivo_geral}}</td>
              </tr>
              <tr>
                <td class="text-right font-weight-bold">Objetivos específicos:</td>
                <td class="text-left">{{$dadosProject->objetivos_especificos}}</td>
              </tr>
              <tr>
                <td class="text-right font-weight-bold">Justificativa:</td>
                <td class="text-left">{{$dadosProject->justificativa}}</td>
              </tr>
              <tr>
                <td class="text-right font-weight-bold">Avaliação:</td>
                <td class="text-left">{{($dadosProject->avaliacao == 'false')? '-' : $dadosProject->avaliacao}}</td>
              </tr>
              <tr>
                <td class="text-right font-weight-bold">Retorno:</td>
                <td class="text-left">{{($dadosProject->retorno_proposta == 'false')? '-' :$dadosProject->retorno_proposta}}</td>
              </tr>
            </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<div class="p-1">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3>Dados da equipe do projeto</h3>
      </div>
    </div>
  </div>
</div>
<div class="p-1">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <table class="table table-hover table-striped table-responsive-xs">
          <thead>
              <th class="w-50">Nome</th>
              <th class="w-25">E-mail</th>
              <th class="w-25">Telefone</th>
          </thead>
          <tbody>
          @forelse($dadosProject->getEquipe as $equipe)
            <tr>
              <td>{{$equipe->nome}}</td>
              <td>{{$equipe->email}}</td>
              <td>{{$equipe->telefone}}</td>
            </tr>
          @empty  
            <tr>
              <td>-</td>
              <td>Não há equipe cadastrada</td>
              <td>-</td>
            </tr>
          @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<div class="p-1">
  <div class="container">
    <div class="row">
      <h3>Dados da atividade do projeto</h3>
    </div>
  </div>
</div>
<div class="p-1">
  <div class="container">
    <div class="row">
      <table class="table table-hover table-striped table-responsive-sm">
        <thead>
            <th class="w-50 text-left">Descrições da atividades</th>
            <th class="w-25 text-left">Título da atividade</th>
            <th class="w-25 text-left">Observação da Atividade</th>
        </thead>
        <tbody>
        @forelse($dadosProject->getAtividades as $atividade)
          <tr>
            <td>{{$atividade->desc_atividades}}</td>
            <td>{{$atividade->titulo_atividade}}</td>
            <td>{{$atividade->obs_atividade}}</td>
          </tr>
        @empty  
          <tr>
            <td>-</td>
            <td>Não há atividade cadastrada</td>
            <td>-</td>
          </tr>
        @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="p-1">
  <div class="container">
    <div class="row">
      <h3>Dados do conteúdo do projeto</h3>
    </div>
  </div>
</div>
<div class="p-1">
  <div class="container">
    <div class="row">
        <table class="table table-hover table-striped table-responsive-sm">
          <thead>
              <th class="w-25">Descrição do conteúdo</th>
              <th class="w-25">Referência</th>
          </thead>
          <tbody>
          @forelse($dadosProject->getConteudos as $conteudo)
            <tr>
              <td>{{$conteudo->desc_conteudo}}</td>
              <td>{{$conteudo->referencia}}</td>
            </tr>
          @empty  
            <tr>
              <td>-</td>
              <td>Não há conteúdos/referências cadastrados</td>
            </tr>
          @endforelse
          </tbody>
        </table>
    </div>
  </div>
</div>
<div class="p-1">
  <div class="container">
    <div class="row">
      <h3>Dados dos critérios do projeto</h3>
    </div>
  </div>
</div>
<div class="p-1">
  <div class="container">
    <div class="row">
        <table class="table table-hover table-striped table-responsive-xs">
          <thead>
              <th class="w-100 text-left">Descrições do critério</th>
          </thead>
          <tbody>
          @forelse($dadosProject->getCriterios as $criterio)
            <tr>
              <td class="text-left">{{$criterio->desc_criterio}}</td>
            </tr>
          @empty  
            <tr>
              <td>Não há critérios cadastrados</td>
            </tr>
          @endforelse
          </tbody>
        </table>
    </div>
  </div>
</div>
<div class="p-1">
  <div class="container">
    <div class="row">
      <h3>Dados dos documentos do projeto</h3>
    </div>
  </div>
</div>
<div class="p-1">
  <div class="container">
    <div class="row">
        <table class="table table-hover table-striped table-responsive-xs">
          <thead>
              <th class="w-100 text-left">Descrições do documento</th>
          </thead>
          <tbody>
          @forelse($dadosProject->getDocumento as $documento)
            <tr>
              <td class="text-left">{{$documento->desc_documento}}</td>
            </tr>
          @empty  
            <tr>
              <td>Não há documentos cadastrados</td>
            </tr>
          @endforelse
          </tbody>
        </table>
    </div>
  </div>
</div>
<div class="p-1">
  <div class="container">
    <div class="row">
      <h3>Dados do orçamento do projeto</h3>
    </div>
  </div>
</div>
<div class="p-1">
  <div class="container">
    <div class="row">
        <table class="table table-hover table-striped table-responsive-xs">
          <thead>
              <th class="w-25">Ítem</th>
              <th class="w-25">Quantidade</th>
              <th class="w-25">Valor unitário</th>
              <th class="w-25">Valor Total</th>
          </thead>
          <tbody>
          @forelse($dadosProject->getOrcamentos as $orcamento)
            <tr>
              <td>{{$orcamento->desc_item}}</td>
              <td>{{$orcamento->quantidade}}</td>
              <td>R${{number_format($orcamento->valor_unitario, 2, ',', '.')}}</td>
              <td>R${{number_format($orcamento->valor_total, 2, ',', '.')}}</td>
            </tr>
          @empty  
            <tr>
              <td>Não há orçamento cadastrado</td>
              <td>-</td>
              <td>-</td>
              <td>-</td>
            </tr>
          @endforelse
          </tbody>
        </table>
        <hr>
        <div class="col-md-12 text-right">
          <p class="lead">Total geral: <b class="text-danger">R${{number_format($total_geral, 2, ',', '.')}}</b></p>
        </div>
    </div>
  </div>
</div>
<div class="p-1">
  <div class="container">
    <div class="row">
      <h3>Dados das parcerias do projeto</h3>
    </div>
  </div>
</div>
<div class="p-1">
  <div class="container">
    <div class="row">
        <table class="table table-hover table-striped table-responsive-xs">
          <thead>
              <th>Parceria</th>
              <th>Representante</th>
              <th>Contato</th>
          </thead>
          <tbody>
          @forelse($dadosProject->getParcerias as $parceria)
            <tr>
              <td>{{$parceria->desc_parceria}}</td>
              <td>{{$parceria->representante}}</td>
              <td>{{$parceria->contato}}</td>
            </tr>
          @empty  
            <tr>
              <td>-</td>
              <td>Não há parcerias cadastradas</td>
              <td>-</td>
            </tr>
          @endforelse
          </tbody>
        </table>
    </div>
  </div>
</div>
<div class="p-1">
  <div class="container">
    <div class="row">
      <h3>Dados dos recursos do projeto</h3>
    </div>
  </div>
</div>
<div class="p-1">
  <div class="container">
    <div class="row">
        <table class="table table-hover table-striped table-responsive-xs">
          <thead>
              <th class="w-50">Espaço</th>
              <th class="w-50">Observação</th>
          </thead>
          <tbody>
          @forelse($dadosProject->getRecursos as $recurso)
            <tr>
              <td>{{$recurso->espaco}}</td>
              <td>{{$recurso->observacao}}</td>
            </tr>
          @empty  
            <tr>
              <td>Não há parcerias cadastradas</td>
              <td>-</td>
            </tr>
          @endforelse
          </tbody>
        </table>
    </div>
  </div>
</div>
    @can('autor')
    @else 
      @if ($dadosProject->status_projeto == 'Enviado' || $dadosProject->status_projeto == 'Reenviado')
      <div class="px-2 py-4">
        <div class="container">
          <div class="row">
            <!--div class="my-1 text-right col-12 col-sm-4 col-md-4 col-lg-4">
              <a class="btn btn-block btn-danger" href="{{route('indeferir-projeto', [$dadosProject->id])}}"> Indeferir <i class="fas fa-ban"></i> </a>
            </div-->
            <div class="my-1 text-right col-12 col-sm-6 col-md-6 col-lg-6">
              <a class="btn btn-block btn-danger"data-toggle="modal" href="#modal_corrigir"> Indeferir <i class="fa fa-edit"></i> </a>
            </div>
            <div class="my-1 text-right col-12 col-sm-6 col-md-6 col-lg-6">
              <a class="btn btn-block btn-success" href="{{route('deferir-projeto', [$dadosProject->id])}}"> Deferir <i class="far fa-check-circle"></i> </a> 
            </div>  
          </div>
        </div>
      </div>
      @endif
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal_corrigirLabel" aria-hidden="true" id="modal_corrigir">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header text-center">
            <h3 class="modal-title text-center" contenteditable="true">Indeferido</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
          </div>
          <div class="modal-body">
            <form class="" method="post" action="{{route('salvar-corrigir-project', [$dadosProject->id])}}">
              {!!csrf_field()!!}
              <div class="form-group"> 
                  <label>Parecer</label> 
                  <input type="text" name="parecer_naac" class="form-control" required placeholder="Informe o parecer"> 
              </div>
                
              <div class="form-group"> 
                <label>Descrição da correção a ser feita</label> 
                <textarea required name="correcao" class="form-control" placeholder="Informe aqui a descrição da correção" rows="5"></textarea> 
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-success">Salvar <i class="fas fa-paper-plane"></i></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    @endcan
@stop

        
