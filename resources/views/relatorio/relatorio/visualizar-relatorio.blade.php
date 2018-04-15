@extends('layouts.app')

@section('content')

<div class="m-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <i class="fa-5x far fa-file"></i>
                <h3 class="display-3">Dados do relatório {{$dadosRelatorio->titulo or ''}}</h3>
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
              <h3 class="m-6">Dados gerais do relatório</h3>
            </div>
            <div class="col-md-6 text-right">
              @if ($dadosRelatorio->status_relatorio == 'Deferido' && count($dadosRelatorio->getParticipantes) > 0 )
                <a href="{{route('download-relatorio', [$dadosRelatorio->id])}}" class="m-1 btn btn-primary btn-sm"> <i class="fas fa-download"></i> baixar Relatório </a>
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
        <table class="table table-hover table-striped table-responsive-xs">
          <thead>
          </thead>
            <tbody>
              <tr>
                <div class="col-md-12">
                <td class="w-25 text-right font-weight-bold">Título: </td>
                <td class="w-75 text-left">{{$dadosRelatorio->titulo}}</td>
                </div>
              </tr>
              <tr>
                <td class="text-right font-weight-bold">Área:</td>
                <td class="text-left">{{$dadosRelatorio->area}}</td>
              </tr>
              <tr>
                <td class="text-right font-weight-bold">Subárea:</td>
                <td class="text-left">{{$dadosRelatorio->sub_area}}</td>
              </tr>
              <tr>
                <td class="text-right font-weight-bold">Coordenador:</td>
                <td class="text-left">{{$dadosRelatorio->coordenador_projeto}}</td>
              </tr>
              <tr>
                <td class="text-right font-weight-bold">CPF:</td>
                <td class="text-left">{{$dadosRelatorio->cpf}}</td>
              </tr>
              <tr>
                <td class="text-right font-weight-bold">Carga horária:</td>
                <td class="text-left">{{$dadosRelatorio->carga_horaria_evento}} horas</td>
              </tr>
              <tr>
                <td class="text-right font-weight-bold">Período de realização:</td>
                <td class="text-left">{{$dadosRelatorio->periodo_realizacao}}</td>
              </tr>
              <tr>
                <td class="text-right font-weight-bold">Período abrangido pelo relatório:</td>
                <td class="text-left">{{$dadosRelatorio->periodo_abrangido_relatorio}}</td>
              </tr>
              <tr>
                <td class="text-right font-weight-bold">Objetivo geral:</td>
                <td class="text-left">{{$dadosRelatorio->objetivo_geral}}</td>
              </tr>
              <tr>
                <td class="text-right font-weight-bold">Objetivos Especificos:</td>
                <td class="text-left">{{$dadosRelatorio->objetivos_especificos}}</td>
              </tr>
              <tr>
                <td class="text-right font-weight-bold">Resultados obtidos</td>
                <td class="text-left">{{$dadosRelatorio->resultados_obtidos}}</td>
              </tr>
              <tr>
                <td class="text-right font-weight-bold">Parecer do responsável:</td>
                <td class="text-left">{{$dadosRelatorio->parecer_responsavel}}</td>
              </tr>
            </tbody>
        </table>
      </div>
  </div>
</div>
<div class="p-1">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3>Cronograma de Desenvolvimento do Trabalho</h3>
      </div>
    </div>
  </div>
</div>
<div class="p-1">
  <div class="container">
    <div class="row">
        <table class="table table-hover table-striped table-responsive-sm">
          <thead>
              <th class="w-75">Descrição</th>
              <th class="w-25">Data</th>
          </thead>
          <tbody>
          @forelse($dadosRelatorio->getCronograma as $cronograma)
            <tr>
              <td>{{$cronograma->desc_atividade}}</td>
              <td>{{$cronograma->data}}</td>
            </tr>
          @empty  
            <tr>
              <td>Não há cronograma(s) cadastrado(s)</td>
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
      <div class="col-sm-9 text-left">
        <h3>Coordenador(es) do Projeto</h3>
      </div>
      <div class="col-sm-3 text-right">
      @if ($dadosRelatorio->status_relatorio == 'Deferido' && count($dadosRelatorio->getCoordenador) > 0 )
        @can('autor')
        @else
            <a class="btn btn-success"href="{{route('download-excel', [$dadosRelatorio->id, 'Coordenadores'])}}" title="Baixar para planilha"> 
              <i class="far fa-file-excel"></i>
            </a>
        @endcan
      @endif  
      </div>
    </div>
  </div>
</div>
<div class="p-1">
  <div class="container">
    <div class="row">
      <table class="table table-hover table-striped table-responsive-sm">
        <thead>
            <th class="w-75 text-left">Nome</th>
            <th class="w-25 text-left">Carga horária</th>
        </thead>
        <tbody>
        @forelse($dadosRelatorio->getCoordenador as $coordenador)
          <tr>
            <td>{{$coordenador->nome}}</td>
            <td>{{$coordenador->carga_horaria}} h</td>
          </tr>
        @empty  
          <tr>
            <td>Não há coordenador(es) cadastrado(s)</td>
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
      <div class="col-sm-9 text-left">
        <h3>Equipe Organizadora</h3>
      </div>
      <div class="col-sm-3 text-right">
      @if ($dadosRelatorio->status_relatorio == 'Deferido' && count($dadosRelatorio->getEquipeRelatorio) > 0 )
        @can('autor')
        @else
            <a class="btn btn-success"href="{{route('download-excel', [$dadosRelatorio->id, 'Equipe'])}}" title="Baixar para planilha"> 
              <i class="far fa-file-excel"></i>
            </a>
        @endcan
      @endif
      </div>
    </div>
  </div>
</div>
<div class="p-1">
  <div class="container">
    <div class="row">
        <table class="table table-hover table-striped table-responsive-sm">
          <thead>
              <th class="w-75">Nome</th>
              <th class="w-25">Carga horária</th>
          </thead>
          <tbody>
          @forelse($dadosRelatorio->getEquipeRelatorio as $equipeRelatorio)
            <tr>
              <td>{{$equipeRelatorio->nome}}</td>
              <td>{{$equipeRelatorio->carga_horaria}} h</td>
            </tr>
          @empty  
            <tr>
              <td>Não há equipe(s) cadastrada(s)</td>
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
      <div class="col-sm-9 text-left">
        <h3>Palestrantes</h3>
      </div>
      <div class="col-sm-3 text-right">
      @if ($dadosRelatorio->status_relatorio == 'Deferido' && count($dadosRelatorio->getPalestrante) > 0 )
        @can('autor')
        @else
            <a class="btn btn-success"href="{{route('download-excel', [$dadosRelatorio->id, 'Palestrantes'])}}" title="Baixar para planilha"> 
              <i class="far fa-file-excel"></i>
            </a>
        @endcan
      @endif
      </div>
    </div>
  </div>
</div>
<div class="p-1">
  <div class="container">
    <div class="row">
        <table class="table table-hover table-striped table-responsive-xs">
          <thead>
              <th class="w-50">Nome</th>
              <th class="w-25">Título</th>
              <th class="w-25">Carga horária</th>
          </thead>
          <tbody>
          @forelse($dadosRelatorio->getPalestrante as $palestrante)
            <tr>
              <td>{{$palestrante->nome}}</td>
              <td>{{$palestrante->titulo}}</td>
              <td>{{$palestrante->carga_horaria}} h</td>
            </tr>
          @empty  
            <tr>
              <td>Não há palestrante(s) cadastrado(s)</td>
              <td>-</td>
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
      <div class="col-sm-9 text-left">
        <h3>Monitores</h3>
      </div>
      <div class="col-sm-3 text-right">
      @if ($dadosRelatorio->status_relatorio == 'Deferido' && count($dadosRelatorio->getMonitor) > 0 )
        @can('autor')
        @else
            <a class="btn btn-success"href="{{route('download-excel', [$dadosRelatorio->id, 'Monitores'])}}" title="Baixar para planilha"> 
              <i class="far fa-file-excel"></i>
            </a>
        @endcan
      @endif
      </div>
    </div>
  </div>
</div>
<div class="p-1">
  <div class="container">
    <div class="row">
        <table class="table table-hover table-striped table-responsive-xs">
          <thead>
              <th class="w-75">Nome</th>
              <th class="w-25">Carga horária</th>
          </thead>
          <tbody>
          @forelse($dadosRelatorio->getMonitor as $monitor)
            <tr>
              <td>{{$monitor->nome}}</td>
              <td>{{$monitor->carga_horaria}} h</td>
            </tr>
          @empty  
            <tr>
              <td>Não há monitor(es) cadastrado(s)</td>
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
      <div class="col-sm-9 text-left">
        <h3>Expositores</h3>
      </div>
      <div class="col-sm-3 text-right">
      @if ($dadosRelatorio->status_relatorio == 'Deferido' && count($dadosRelatorio->getExpositor) > 0 )
        @can('autor')
        @else
            <a class="btn btn-success"href="{{route('download-excel', [$dadosRelatorio->id, 'Expositores'])}}" title="Baixar para planilha"> 
              <i class="far fa-file-excel"></i>
            </a>
        @endcan
      @endif
      </div>
    </div>
  </div>
</div>
<div class="p-1">
  <div class="container">
    <div class="row">
        <table class="table table-hover table-striped table-responsive-xs">
          <thead>
              <th class="w-50">Nome</th>
              <th class="w-25">Título</th>
              <th class="w-25">Carga horária</th>
          </thead>
          <tbody>
          @forelse($dadosRelatorio->getExpositor as $expositor)
            <tr>
              <td>{{$expositor->nome}}</td>
              <td>{{$expositor->titulo}}</td>
              <td>{{$expositor->carga_horaria}} h</td>
            </tr>
          @empty  
            <tr>
              <td>Não há expositor(es) cadastrado(s)</td>
              <td>-</td>
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
      <div class="col-sm-9 text-left">
        <h3>Ministrantes</h3>
      </div>
      <div class="col-sm-3 text-right">
      @if ($dadosRelatorio->status_relatorio == 'Deferido' && count($dadosRelatorio->getMinistrante) > 0 )
        @can('autor')
        @else
            <a class="btn btn-success"href="{{route('download-excel', [$dadosRelatorio->id, 'Ministrantes'])}}" title="Baixar para planilha"> 
              <i class="far fa-file-excel"></i>
            </a>
        @endcan
      @endif
      </div>
    </div>
  </div>
</div>
<div class="p-1">
  <div class="container">
    <div class="row">
        <table class="table table-hover table-striped table-responsive-xs">
          <thead>
              <th class="w-50">Nome</th>
              <th class="w-25">Título</th>
              <th class="w-25">Carga horária</th>
          </thead>
          <tbody>
          @forelse($dadosRelatorio->getMinistrante as $ministrante)
            <tr>
              <td>{{$ministrante->nome}}</td>
              <td>{{$ministrante->titulo}}</td>
              <td>{{$ministrante->carga_horaria}} h</td>
            </tr>
          @empty  
            <tr>
              <td>Não há Ministrante(s) cadastrado(s)</td>
              <td>-</td>
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
      <div class="col-sm-9 text-left">
        <h3>Participantes</h3>
      </div>
      <div class="col-sm-3 text-right">
      @if ($dadosRelatorio->status_relatorio == 'Deferido' && count($dadosRelatorio->getParticipante) > 0 )
        @can('autor')
        @else
            <a class="btn btn-success"href="{{route('download-excel', [$dadosRelatorio->id, 'Participantes'])}}" title="Baixar para planilha"> 
              <i class="far fa-file-excel"></i>
            </a>
        @endcan
      @endif
      </div>
    </div>
  </div>
</div>
<div class="p-1">
  <div class="container">
    <div class="row">
        <table class="table table-hover table-striped table-responsive-xs">
          <thead>
              <th class="w-75">Nome</th>
              <th class="w-25">Carga Horária</th>
          </thead>
          <tbody>
          @forelse($dadosRelatorio->getParticipante as $participante)
            <tr>
              <td>{{$participante->nome}}</td>
              <td>{{$participante->carga_horaria}} h</td>
            </tr>
          @empty  
            <tr>
              <td>Não há participante(s) cadastrado(s)</td>
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
        <div class="col-sm-9 text-left">
          <h3>Ouvintes</h3>
        </div>
        <div class="col-sm-3 text-right">
        @if ($dadosRelatorio->status_relatorio == 'Deferido' && count($dadosRelatorio->getOuvinte) > 0 )
          @can('autor')
          @else
              <a class="btn btn-success"href="{{route('download-excel', [$dadosRelatorio->id, 'Ouvintes'])}}" title="Baixar para planilha"> 
                <i class="far fa-file-excel"></i>
              </a>
          @endcan
        @endif
        </div>
      </div>
    </div>
  </div>
  <div class="p-1">
    <div class="container">
      <div class="row">
          <table class="table table-hover table-striped table-responsive-xs">
            <thead>
                <th class="w-75">Nome</th>
                <th class="w-25">Carga Horária</th>
            </thead>
            <tbody>
            @forelse($dadosRelatorio->getOuvinte as $ouvinte)
              <tr>
                <td>{{$ouvinte->nome}}</td>
                <td>{{$ouvinte->carga_horaria}} h</td>
              </tr>
            @empty  
              <tr>
                <td>Não há participante(s) cadastrado(s)</td>
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
      @if ($dadosRelatorio->status_relatorio == 'Enviado' || $dadosRelatorio->status_relatorio == 'Reenviado')
      <div class="px-2 py-4">
        <div class="container">
          <div class="row">
            <!--div class="my-1 text-right col-12 col-sm-4 col-md-4 col-lg-4">
              <a class="btn btn-block btn-danger" href="{{route('indeferir-projeto', [$dadosRelatorio->id])}}"> Indeferir <i class="fas fa-ban"></i> </a>
            </div-->
            <div class="my-1 text-right col-12 col-sm-6 col-md-6 col-lg-6">
              <a class="btn btn-block btn-danger"data-toggle="modal" href="#modal_corrigir"> Indeferir <i class="fa fa-edit"></i> </a>
            </div>
            <div class="my-1 text-right col-12 col-sm-6 col-md-6 col-lg-6">
              <a class="btn btn-block btn-success" href="{{route('deferir-relatorio', [$dadosRelatorio->id])}}"> Deferir <i class="far fa-check-circle"></i> </a> 
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
            {!! Form::open(['route' => ['salvar-corrigir-relatorio', $dadosRelatorio->id], 'method' => 'put']) !!}
            
              <div class="form-group"> 
                  <label>Parecer</label>
                  {!! Form::text('parecer_naac', null, ['class' => 'form-control', 'placeholder' => 'Informe o parecer', 'required' => '']) !!}  
              </div>
                
              <div class="form-group"> 
                <label>Descrição da correção a ser feita</label> 
                {!! Form::textarea('correcao', null, ['class' => 'form-control', 'placeholder' => 'Informe aqui a descrição da correção', 'rows' => '8', 'style' => 'resize: none;', 'required' => '']) !!} 
              </div>
              <div class="text-right">
                {!! Form::button('Salvar <i class="fas fa-paper-plane"></i>', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    @endcan
@stop

        
