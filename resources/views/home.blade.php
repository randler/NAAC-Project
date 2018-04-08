@extends('layouts.app')

@section('content')

<div class="py-1 text-right">
    <div class="container">
      <div class="row text-left"> </div>
      <div class="row">
        <div class="col-md-7 col-lg-8 col-xl-9"></div>        
        @include('includes.alert.alerts')
      </div>
    </div>
  </div>
  <div class="bg-light py-5 my-5">
    @can('autor')
    <div class="container">
      <div class="row">
        <div class="py-5 col-md-6">
          <div class="row">
            <div class="text-center col-3 col-sm-2 col-md-3 col-lg-2 col-xl-2">
              <a href="{{route('new-projeto')}}" class="text-secondary" style="text-decoration:none; "><i class="d-block fa-5x far fa-file"></i></a>
            </div>
            <div class="col-9">
              <a href="{{route('new-projeto')}}" class="text-secondary" style="text-decoration:none; ">
                <h3 class="m-4"><b>Novo Projeto de Extensão</b></h3>
              </a>
            </div>
          </div>
        </div>
        <div class="py-5 col-md-6">
          <div class="row">
            <div class="text-center col-3 col-sm-2 col-md-3 col-lg-2 col-xl-2">
            <a href="{{route('index-relatorio')}}" class="text-secondary" style="text-decoration:none; "><i class="d-block fa-5x far fa-file"></i></a></div>
            <div class="col-9">
              <a href="{{route('index-relatorio')}}" class="text-secondary" style="text-decoration:none; ">
                  <h3 class="mt-4"><b>Novo Relatório de projeto de Extensão</b></h3></a>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="py-5 col-md-6">
          <div class="row">
            <div class="text-center col-3 col-sm-2 col-md-3 col-lg-2 col-xl-2">
                <a href="{{route('todos-projetos-user')}}" class="text-secondary" style="text-decoration:none; "><i class="d-block mx-auto fa-5x far fa-copy"></i></a></div>
            <div class="col-9">
              <a href="{{route('todos-projetos-user')}}" class="text-secondary" style="text-decoration:none; ">
                  <h3 class="m-4"><b>Ver Projetos</b></h3></a>
            </div>
          </div>
        </div>
        <div class="py-5 col-md-6">
          <div class="row">
            <div class="text-center col-3 col-sm-2 col-md-3 col-lg-2 col-xl-2">
                <a href="{{route('todos-relatorios-user')}}" class="text-secondary" style="text-decoration:none; "><i class="d-block mx-auto fa-5x far fa-copy"></i></a></div>
            <div class="col-9">
              <a href="{{route('todos-relatorios-user')}}" class="text-secondary" style="text-decoration:none; ">
                  <h3 class="m-4"><b>Ver Relatórios</b></h3></a>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
          <div class="py-5 col-md-6">
            <div class="row">
              <div class="text-center col-3 col-sm-2 col-md-3 col-lg-2 col-xl-2">
                  <a href="{{route('projetos-deferidos-user')}}" class="text-secondary" style="text-decoration:none; "><i class="d-block mx-auto fa-5x far fa-check-square"></i></a></div>
              <div class="col-9">
                <a href="{{route('projetos-deferidos-user')}}" class="text-secondary" style="text-decoration:none; ">
                    <h3 class="m-4"><b>Projetos Deferidos</b></h3></a>
              </div>
            </div>
          </div>
          <div class="py-5 col-md-6">
            <div class="row">
              <div class="text-center col-3 col-sm-2 col-md-3 col-lg-2 col-xl-2">
                  <a href="{{route('relatorios-deferidos-user')}}" class="text-secondary" style="text-decoration:none; "><i class="d-block mx-auto fa-5x far fa-check-square"></i></a></div>
              <div class="col-9">
                <a href="{{route('relatorios-deferidos-user')}}" class="text-secondary" style="text-decoration:none; ">
                    <h3 class="m-4"><b>Relatórios Deferidos</b></h3></a>
              </div>
            </div>
          </div>
        </div>
      <div class="row">
        <div class="py-5 col-md-6">
          <div class="row">
            <div class="text-center col-3 col-sm-2 col-md-3 col-lg-2 col-xl-2">
                <a href="{{route('projetos-correcao-user')}}" class="text-secondary" style="text-decoration:none; "><i class="d-block mx-auto fa-5x fas fa-edit"></i></a></div>
            <div class="col-9">
              <a href="{{route('projetos-correcao-user')}}" class="text-secondary" style="text-decoration:none; ">
                  <h3 class="m-4"><b>Projetos com correções</b></h3></a>
            </div>
          </div>
        </div>
        <div class="py-5 col-md-6">
          <div class="row">
            <div class="text-center col-3 col-sm-2 col-md-3 col-lg-2 col-xl-2">
                <a href="{{route('relatorios-correcao-user')}}" class="text-secondary" style="text-decoration:none; "><i class="d-block mx-auto fa-5x fas fa-edit"></i></a></div>
            <div class="col-9">
              <a href="{{route('relatorios-correcao-user')}}" class="text-secondary" style="text-decoration:none; ">
                  <h3 class="m-4"><b>Relatórios com correções</b></h3></a>
            </div>
          </div>
        </div>
        <div class="py-5 col-md-6">
          <div class="row">
            <div class="text-center col-3 col-sm-2 col-md-3 col-lg-2 col-xl-2">
                <a href="#" class="text-secondary" style="text-decoration:none; "><i class="d-block mx-auto fa-5x fas fa-list-ol"></i></a></div>
            <div class="col-9">
              <a href="#" class="text-secondary" style="text-decoration:none; ">
                  <h3 class="m-4"><b>Gerar lista do projeto</b></h3></a>
            </div>
          </div>
        </div>
        <div class="py-5 col-md-6">
          <div class="row">
            <div class="text-center col-3 col-sm-2 col-md-3 col-lg-2 col-xl-2">
                <a href="#" class="text-secondary" style="text-decoration:none; "><i class="d-block mx-auto fa-5x far fa-envelope"></i></a></div>
            <div class="col-9">
              <a href="#" class="text-secondary" style="text-decoration:none; ">
                  <h3 class="m-4"><b>Contatar NAAC</b></h3></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    @else
    <div class="container">
      <div class="row">
        <div class="py-5 col-md-6">
          <div class="row">
            <div class="text-center col-3 col-sm-2 col-md-3 col-lg-2 col-xl-2">
                <a href="#" class="text-secondary" style="text-decoration:none; "><i class="d-block mx-auto fa-5x far fa-copy"></i></a></div>
            <div class="col-9">
              <a href="{{route('todos-projetos')}}" class="text-secondary" style="text-decoration:none; ">
                  <h3 class="m-4"><b>Ver Projetos</b></h3></a>
            </div>
          </div>
        </div>
        <div class="py-5 col-md-6">
          <div class="row">
            <div class="text-center col-3 col-sm-2 col-md-3 col-lg-2 col-xl-2">
                <a href="#" class="text-secondary" style="text-decoration:none; "><i class="d-block mx-auto fa-5x far fa-copy"></i></a></div>
            <div class="col-9">
              <a href="{{route('projetos-solicitados')}}" class="text-secondary" style="text-decoration:none; ">
                  <h3 class="m-4"><b>Projetos Solicitados</b></h3></a>
            </div>
          </div>
        </div>
        <div class="py-5 col-md-6">
          <div class="row">
            <div class="text-center col-3 col-sm-2 col-md-3 col-lg-2 col-xl-2">
                <a href="#" class="text-secondary" style="text-decoration:none; "><i class="d-block mx-auto fa-5x fas fa-edit"></i></a></div>
            <div class="col-9">
              <a href="{{route('projetos-reenviados')}}" class="text-secondary" style="text-decoration:none; ">
                  <h3 class="m-4"><b>Projetos Corrigidos</b></h3></a>
            </div>
          </div>
        </div>
        <div class="py-5 col-md-6">
          <div class="row">
            <div class="text-center col-3 col-sm-2 col-md-3 col-lg-2 col-xl-2">
                <a href="#" class="text-secondary" style="text-decoration:none; "><i class="d-block mx-auto fa-5x far fa-file"></i></a></div>
            <div class="col-9">
              <a href="{{route('projetos-deferidos')}}" class="text-secondary" style="text-decoration:none; ">
                  <h3 class="m-4"><b>Projetos Deferidos</b></h3></a>
            </div>
          </div>
        </div>
        <div class="py-5 col-md-6">
          <div class="row">
            <div class="text-center col-3 col-sm-2 col-md-3 col-lg-2 col-xl-2">
                <a href="#" class="text-secondary" style="text-decoration:none; "><i class="d-block mx-auto fas fa-5x fa-users"></i></a></div>
            <div class="col-9">
              <a href=" {{route('request-users')}} " class="text-secondary" style="text-decoration:none; ">
                  <h3 class="m-4"><b>Liberar Usuários</b></h3></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endcan
  </div>
<!--div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 py-5">
            <div class="card card-default">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div-->
@endsection
