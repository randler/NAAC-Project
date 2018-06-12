@extends('layouts.app')

@section('content')

<div class="m-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <i class="fa-5x far fa-file"></i>
                <h3 class="display-3">{{$messageTitle or 'Todos projetos'}}</h3>
            </div>
        </div>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="row">
        @forelse($projetos as $projeto)
                <div class="my-1 col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                    <div class="card">
                        <div class="card-header">{{$projeto->titulo_projeto}}</div>
                        <div class="card-body">
                            <h4>{{$projeto->autores}}</h4> 
                            @if ($projeto->status_projeto == 'Deferido')
                                <h6 class="text-muted">Status: <span class="badge badge-success">{{$projeto->status_projeto}}</span></h6>
                            @elseif ($projeto->status_projeto == 'Indeferido' || $projeto->status_projeto == 'Recorrigir')
                                <h6 class="text-muted">Status: <span class="badge badge-danger">{{$projeto->status_projeto}}</span></h6>
                            @elseif ($projeto->status_projeto == 'Enviado'|| $projeto->status_projeto == 'Reenviado')
                                <h6 class="text-muted">Status: <span class="badge badge-info">{{$projeto->status_projeto}}</span></h6>
                            @endif    
                            <h6 class="text-muted">Objetivo: </h6><p class=" p-y-1">{{$projeto->objetivo_geral}}</p>
                            <div class="text-right">
                                @if ($projeto->status_projeto == 'Deferido')
                                    @can('autor')
                                        <a class="btn btn-success" href="{{route('visualizar-projeto', [$projeto->id])}}"> Ver <i class="fas fa-search"></i> </a>
                                    @else
                                    <a class="btn btn-success" href="{{route('corrigir-project', [$projeto->id])}}"> Abrir <i class="fas fa-search"></i> </a> 
                                    @endcan
                                @elseif ($projeto->status_projeto == 'Indeferido' || $projeto->status_projeto == 'Recorrigir')
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
                    <a href="{{route('home')}}"><p class="lead text-center"><i class=" fa text-center fa-lg fa-reply"></i>  Voltar</p></a>
                    </div>
        @endforelse
        </div>
    </div>
</div>
@stop

        
