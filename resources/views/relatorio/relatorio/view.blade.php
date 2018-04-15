@extends('layouts.app')

@section('content')

<div class="m-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <i class="fa-5x far fa-file"></i>
                <h3 class="display-3">{{$messageTitle or 'Todos os Relatórios'}}</h3>
            </div>
        </div>
    </div>
</div>
<div class="pt-5 text-center">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12">
                    {!! Form::open(['route' => 'search-relatorio']) !!}
                        <div class="form-row ">
                            <div class="mt-1 col-md-5">
                                {!! Form::hidden('messageTitle', isset($messageTitle) ? $messageTitle : '')!!}
                                {!! Form::hidden('statusFind', isset($statusFind) ? $statusFind : '')!!}    
                                {!! Form::text('titulo', null, ['placeholder' => 'Título' ,'class' => 'form-control'])!!}
                            </div>
                            <div class="mt-1 col-md-5">
                                {!! Form::text('coordenador_projeto', null, ['placeholder' => 'Coordenador do projeto' ,'class' => 'form-control'])!!}
                            </div>
                            <!--div class="col-md-3">
                                <input type="text" class="form-control" placeholder="Zip">
                            </div-->
                            <div class="mt-1 col-12 col-md-2">
                                {!! Form::button('<i class="fas fa-search"></i>', ['type' => 'submit', 'placeholder' => 'Autor' ,'class' => 'btn btn-block btn-primary'])!!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <hr>
                </div>
            </div>
        </div>
    </div>
<div class="pb-5">
    <div class="container">
        <div class="row">
        @forelse($relatorios as $relatorio)
                <div class="my-1 col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                    <div class="card">
                        <div class="card-header">Autor: {{$relatorio->coordenador_projeto}}</div>
                        <div class="card-body">
                            <h4 class="d-inline-block text-truncate" style="max-width: 273px;">
                                @can('autor')
                                <a class="text-dark" style="text-decoration: none;" href="{{route('visualizar-relatorio', [$relatorio->id])}}">
                                    Título: {{$relatorio->titulo}}
                                </a>
                                @else
                                <a class="text-dark" style="text-decoration: none;" href="{{route('corrigir-relatorio-admin', [$relatorio->id])}}">
                                    Título: {{$relatorio->titulo}}
                                </a>
                                @endcan
                            </h4> 
                            @if ($relatorio->status_relatorio == 'Deferido')
                                <h6 class="text-muted">Status: <span class="badge badge-success">{{$relatorio->status_relatorio}}</span>
                                <a href="{{route('download-relatorio', [$relatorio->id])}}" title="Baixar Relatório" style="text-decoration: none"> 
                                    <span class="badge badge-warning"><i class="fas fa-download"></i></span>
                                </a>
                                @can('autor')
                                @else
                                    <a href="{{route('download-participantes-excel', [$relatorio->id])}}" title="Baixar Lista de Participantes" style="text-decoration: none"> 
                                        <span class="badge badge-success"><i class="mx-1 far fa-file-excel"></i></span>
                                    </a>
                                @endcan
                                </h6>
                            @elseif ($relatorio->status_relatorio == 'Indeferido' || $relatorio->status_relatorio == 'Recorrigir')
                                <h6 class="text-muted">Status: <span class="badge badge-danger">{{$relatorio->status_relatorio}}</span></h6>
                            @elseif ($relatorio->status_relatorio == 'Enviado'|| $relatorio->status_relatorio == 'Reenviado')
                                <h6 class="text-muted">Status: <span class="badge badge-info">{{$relatorio->status_relatorio}}</span></h6>
                            @endif    
                            <h6 class="text-muted">Objetivo: </h6><p class="p-y-1 d-inline-block text-truncate" style="max-width: 273px;">{{$relatorio->objetivo_geral}}</p>
                            <div class="text-right">
                                @if ($relatorio->status_relatorio == 'Deferido')
                                    @can('autor')
                                        <a class="btn btn-success" href="{{route('visualizar-relatorio', [$relatorio->id])}}"> Ver <i class="fas fa-search"></i> </a>
                                    @else
                                        <a class="btn btn-success" href="{{route('corrigir-relatorio-admin', [$relatorio->id])}}"> Abrir <i class="fas fa-search"></i> </a> 
                                    @endcan
                                @elseif ($relatorio->status_relatorio == 'Indeferido' || $relatorio->status_relatorio == 'Recorrigir')
                                    @can('autor')
                                        <a class="btn btn-danger" href="{{route('corrigir-relatorio-user', [$relatorio->id])}}"> Corrigir <i class="fa fa-edit"></i> </a>
                                    @else
                                        <a class="btn btn-danger disabled" href="#"> Esperando correção... <i class="fa fa-edit"></i></a>
                                    @endcan
                                @elseif ($relatorio->status_relatorio == 'Enviado'|| $relatorio->status_relatorio == 'Reenviado')
                                    @can('autor')
                                        <a class="btn btn-info disabled" disabled href="#"> Aguarde... <i class="fas fa-history"></i> </a>
                                    @else
                                        <a class="btn btn-primary" href="{{route('corrigir-relatorio-admin', [$relatorio->id])}}"> Abrir <i class="fa fa-edit"></i> </a>  
                                    @endcan
                                    
                                @endif   
                            </div>
                        </div>
                    </div>
                </div>
        @empty
                    <div class="col-md-12">
                    <h1 class="text-center py-4">{{$messageEmpty or 'Não há relatorios cadastrados'}}</h1>
                    <a href="{{route('home')}}" style="text-decoration: none;"><p class="lead text-center"><i class=" fa text-center fa-lg fa-reply"></i>  Voltar</p></a>
                    </div>
        @endforelse
        </div>
    </div>
</div>
@stop

        
