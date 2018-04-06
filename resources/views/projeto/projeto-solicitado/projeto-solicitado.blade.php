@extends('layouts.app')

@section('content')

<div class="m-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <i class="fa-5x far fa-file"></i>
                <h3 class="display-3">Projetos Solicitados</h3>
            </div>
        </div>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="row">
        @forelse($projetos as $projeto)
            @if($projeto->status_projeto == 'Enviado' || $projeto->status_projeto == 'Reenviado')
                <div class="my-1 col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                    <div class="card">
                        <div class="card-header">{{$projeto->titulo_projeto}}</div>
                        <div class="card-body">
                            <h4>{{$projeto->autores}}</h4>
                            <h6 class="text-muted">Status: <span class="badge badge-primary">{{$projeto->status_projeto}}</span></h6>
                            <h6 class="text-muted">Objetivo: </h6><p class=" p-y-1">{{$projeto->objetivo_geral}}</p>
                            <div class="text-right">
                                <a class="btn btn-primary" href="{{route('corrigir-project', [$projeto->id])}}"> Abrir <i class="fa fa-edit"></i> </a>  
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @empty
            <div class="col-md-12">
                <h1 class="text-center py-4">Não há projetos enviados</h1>
                <a href="{{route('home')}}"><p class="lead text-center"><i class=" fa text-center fa-lg fa-reply"></i>  Voltar</p></a>
            </div>
        @endforelse
        </div>
    </div>
</div>
@stop

        
