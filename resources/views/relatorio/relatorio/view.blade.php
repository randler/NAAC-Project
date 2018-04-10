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
<div class="py-5">
    <div class="container">
        <div class="row">
        @forelse($relatorios as $relatorio)
                <div class="my-1 col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                    <div class="card">
                        <div class="card-header">Autor: {{$relatorio->coordenador_projeto}}</div>
                        <div class="card-body">
                            <h4>Título: {{$relatorio->titulo}}</h4> 
                            @if ($relatorio->status_relatorio == 'Deferido')
                                <h6 class="text-muted">Status: <span class="badge badge-success">{{$relatorio->status_relatorio}}</span></h6>
                            @elseif ($relatorio->status_relatorio == 'Indeferido' || $relatorio->status_relatorio == 'Recorrigir')
                                <h6 class="text-muted">Status: <span class="badge badge-danger">{{$relatorio->status_relatorio}}</span></h6>
                            @elseif ($relatorio->status_relatorio == 'Enviado'|| $relatorio->status_relatorio == 'Reenviado')
                                <h6 class="text-muted">Status: <span class="badge badge-info">{{$relatorio->status_relatorio}}</span></h6>
                            @endif    
                            <h6 class="text-muted">Objetivo: </h6><p class=" p-y-1">{{$relatorio->objetivo_geral}}</p>
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
                    <a href="{{route('home')}}"><p class="lead text-center"><i class=" fa text-center fa-lg fa-reply"></i>  Voltar</p></a>
                    </div>
        @endforelse
        </div>
    </div>
</div>
@stop

        
