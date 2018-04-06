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
<div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center"><i class="fa fa-5x fa-users"></i>
          <h1 class="display-3">Usuários</h1>
        </div>
      </div>
    </div>
  </div>

  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center"><h1 class="">Usuários Novos</h1></div>
        <div class="col-md-12">
          <table class="table table-striped table-hover table-responsive">
            <thead>
              <tr>
                <th>#</th>
                <th class="w-25">Nome</th>
                <th class="w-25">Email</th>
                <th>Instituição</th>
                <th class="w-25">Área</th>
                <th>Curso</th>
                <th class="w-25">Acesso</th>
              </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $user)
                    @if(!$user->admin && $user->novo)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->instituicao}}</td>
                            <td>{{$user->area_atuacao}}</td>
                            <td>{{$user->curso}}</td>
                            <td class="text-center">
                            @if(!$user->liberado)  
                                <a href="{{route('liberar-user', [$user->id])}}" class=""><span class="badge badge-success">Liberar <i class="fa fa-unlock"></i></span></a>
                            @else
                                <a href="{{route('negar-user', [$user->id])}}" class=""><span class="badge badge-danger">Negar <i class="fa fa-lock"></i></span></a>
                            @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>


  <div class="py-5">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center"><h1 class="">Usuários</h1></div>
          <div class="col-md-12">
            <table class="table table-striped table-hover table-responsive">
              <thead>
                <tr>
                  <th>#</th>
                  <th class="w-25">Nome</th>
                  <th class="w-25">Email</th>
                  <th>Instituição</th>
                  <th class="w-25">Área</th>
                  <th>Curso</th>
                  <th class="w-25">Acesso</th>
                </tr>
              </thead>
              <tbody>
                  @foreach($usuarios as $user)
                      @if(!$user->admin && !$user->novo)
                          <tr>
                              <td>{{$user->id}}</td>
                              <td>{{$user->name}}</td>
                              <td>{{$user->email}}</td>
                              <td>{{$user->instituicao}}</td>
                              <td>{{$user->area_atuacao}}</td>
                              <td>{{$user->curso}}</td>
                              <td class="text-center">
                              @if(!$user->liberado)  
                                  <a href="{{route('liberar-user', [$user->id])}}" class=""><span class="badge badge-success">Liberar <i class="fa fa-unlock"></i></span></a>
                              @else
                                  <a href="{{route('negar-user', [$user->id])}}" class=""><span class="badge badge-danger">Negar <i class="fa fa-lock"></i></span></a>
                              @endif
                              </td>
                          </tr>
                      @endif
                  @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  @endsection