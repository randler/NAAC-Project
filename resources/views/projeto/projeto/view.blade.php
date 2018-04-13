@extends('layouts.app')

@section('content')

<div class="m-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <i class="fa-5x far fa-file"></i>
                <h3 class="display-3">{{$messageTitle or 'Todos os seus projetos'}}</h3>
            </div>
        </div>
    </div>
</div>
<div class="pt-5 text-center">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12">
                {!! Form::open(['route' => 'search-projeto']) !!}
                    <div class="form-row ">
                        <div class="mt-1 col-md-5">
                            {!! Form::hidden('messageTitle', isset($messageTitle) ? $messageTitle : '')!!}
                            {!! Form::hidden('statusFind', isset($statusFind) ? $statusFind : '')!!}    
                            {!! Form::text('titulo', null, ['placeholder' => 'Título' ,'class' => 'form-control'])!!}
                        </div>
                        <div class="mt-1 col-md-5">
                            {!! Form::text('autores', null, ['placeholder' => 'Autor' ,'class' => 'form-control'])!!}
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
        @forelse($projetos as $projeto)
                <div class="my-1 col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                    <div class="card">
                        <div class="card-header text-truncate col-12">
                            @can('autor')
                            <a class="text-dark" style="text-decoration: none;" href="{{route('visualizar-projeto', [$projeto->id])}}">
                                Título: {{$projeto->titulo_projeto}}
                            <a>
                            @else
                            <a class="text-dark" style="text-decoration: none;" href="{{route('corrigir-project', [$projeto->id])}}">
                                Título: {{$projeto->titulo_projeto}}
                            <a>
                            @endcan
                        </div>
                        <div class="card-body">
                            <h4 class="d-inline-block text-truncate" style="max-width: 273px;">Autores: {{$projeto->autores}}</h4> 
                            @if ($projeto->status_projeto == 'Deferido')
                                <h6 class="text-muted">Status: <span class="badge badge-success">{{$projeto->status_projeto}}</span> 
                                    @if($projeto->has_relatorio) 
                                        @can('autor')
                                            <a href="{{route('visualizar-relatorio', [$projeto->relatorio_id])}}" title="Abrir relatório" style="text-decoration: none">
                                                <span class="mx-1 badge badge-secondary">Tem relatório</span>
                                            </a> 
                                        @else
                                            <a href="{{route('corrigir-relatorio-admin', [$projeto->relatorio_id])}}" title="Abrir relatório" style="text-decoration: none">
                                                <span class="mx-1 badge badge-secondary">Tem relatório</span>
                                            </a>
                                        @endcan
                                    @endif
                                    <a href="{{route('download-projeto', [$projeto->id])}}" title="Baixar Projeto" style="text-decoration: none"> 
                                        <span class="badge badge-warning"><i class="fas fa-download"></i></span>
                                    </a>
                                    <a href="{{route('download-lista', [$projeto->id])}}" title="Baixar Lista" style="text-decoration: none"> 
                                        <span class="badge badge-warning"><i class="fas fa-download"></i></span>
                                    </a>
                                </h6>
                            @elseif ($projeto->status_projeto == 'Indeferido' || $projeto->status_projeto == 'Corrigir' || $projeto->status_projeto == 'Recorrigir')
                                <h6 class="text-muted">Status: <span class="badge badge-danger">{{$projeto->status_projeto}}</span></h6>
                            @elseif ($projeto->status_projeto == 'Enviado'|| $projeto->status_projeto == 'Reenviado')
                                <h6 class="text-muted">Status: <span class="badge badge-info">{{$projeto->status_projeto}}</span></h6>
                            @endif    
                            <h6 class="text-muted">Objetivo: </h6><p class="p-y-1 d-inline-block text-truncate" style="max-width: 273px;">{{$projeto->objetivo_geral}}</p>
                            <div class="text-right">
                                @if ($projeto->status_projeto == 'Deferido')
                                    @can('autor')
                                        <a class="btn btn-success" href="{{route('visualizar-projeto', [$projeto->id])}}"> Ver <i class="fas fa-search"></i> </a>
                                    @else
                                    <a class="btn btn-success" href="{{route('corrigir-project', [$projeto->id])}}"> Abrir <i class="fas fa-search"></i> </a> 
                                    @endcan
                                @elseif ($projeto->status_projeto == 'Indeferido' || $projeto->status_projeto == 'Corrigir' || $projeto->status_projeto == 'Recorrigir')
                                    @can('autor')
                                        <a class="btn btn-danger" href="{{route('corrigir-projeto-user', [$projeto->id])}}"> Corrigir <i class="fa fa-edit"></i> </a>
                                    @else
                                        <a class="btn btn-danger disabled" href="#"> Esperando correção... <i class="fa fa-edit"></i></a>
                                    @endcan
                                @elseif ($projeto->status_projeto == 'Enviado'|| $projeto->status_projeto == 'Reenviado')
                                    @can('autor')
                                        <a class="btn btn-info disabled" disabled href="#"> Aguarde... <i class="fas fa-history"></i> </a>
                                    @else
                                        <a class="btn btn-primary" href="{{route('corrigir-project', [$projeto->id])}}"> Abrir <i class="fa fa-edit"></i> </a>  
                                    @endcan
                                    
                                @endif   
                            </div>
                        </div>
                    </div>
                </div>
        @empty
                    <div class="col-md-12">
                    <h1 class="text-center py-4">{{$messageEmpty or 'Não há projetos cadastrados'}}</h1>
                    <a href="{{route('home')}}" style="text-decoration: none;"><p class="lead text-center"><i class=" fa text-center fa-lg fa-reply"></i>  Voltar</p></a>
                    </div>
        @endforelse
        </div>
    </div>
</div>
@stop

        
