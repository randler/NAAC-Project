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
        <div class="col-md-12">
          <h1 class="text-dark py-3 text-center">Editar Dados</h1>
          <form method="POST" action="{{ route('update-user') }}">
            @csrf
            <!--div class="form-group"> 
                <label>Nome Completo</label>
                <input type="text" name="name" class="form-control" placeholder="Digite o nome completo"> 
            </div-->

            <div class="form-group row">
                <label for="name" class="col-md-3 col-form-label text-md-right">Nome completo</label>

                <div class="col-md-7">
                    <input id="name" type="text" placeholder="Digite o nome completo" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name}}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-3 col-form-label text-md-right">E-mail</label>

                <div class="col-md-7">
                    <input type="hidden" name="old_email" value="{{ $user->email }}">
                    <input id="email" type="email" placeholder="Digite o e-mail" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" required>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="instituicao" class="col-md-3 col-form-label text-md-right">Instituição</label>

                <div class="col-md-7">
                    <input id="instituicao" placeholder="Digite a instituição de ensino" type="text" class="form-control{{ $errors->has('instituicao') ? ' is-invalid' : '' }}" name="instituicao" value="{{ $user->instituicao }}" required>

                    @if ($errors->has('instituicao'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('instituicao') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="cpf" class="col-md-3 col-form-label text-md-right">CPF</label>

                <div class="col-md-7">
                    <input id="cpf" type="text" placeholder="Digite o CPF" class="form-control{{ $errors->has('cpf') ? ' is-invalid' : '' }}" name="cpf" value="{{ $user->cpf }}" required data-mask="000.000.000-00">

                    @if ($errors->has('cpf'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('cpf') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="area_atuacao" class="col-md-3 col-form-label text-md-right">Área de Atuação</label>

                <div class="col-md-7">
                    <input id="area_atuacao" type="text" placeholder="Digite a área de atuação" class="form-control{{ $errors->has('area_atuacao') ? ' is-invalid' : '' }}" name="area_atuacao" value="{{ $user->area_atuacao }}" required>

                    @if ($errors->has('area_atuacao'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('area_atuacao') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="curso" class="col-md-3 col-form-label text-md-right">Curso</label>

                <div class="col-md-7">
                    <input id="curso" type="text" placeholder="Digite o curso" class="form-control{{ $errors->has('curso') ? ' is-invalid' : '' }}" name="curso" value="{{ $user->curso }}" required>

                    @if ($errors->has('curso'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('curso') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="funcao" class="col-md-3 col-form-label text-md-right">Função</label>

                <div class="col-md-7">
                    <input id="funcao" type="text" placeholder="Digite a função" class="form-control{{ $errors->has('funcao') ? ' is-invalid' : '' }}" name="funcao" value="{{ $user->funcao }}" required>

                    @if ($errors->has('funcao'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('funcao') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-3 col-form-label text-md-right">Senha</label>

                <div class="col-md-7">
                    <input id="password" type="password" placeholder="Digite a senha" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">

                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-3 col-form-label text-md-right">Confirme a senha</label>

                <div class="col-md-7">
                    <input id="password-confirm" type="password" placeholder="Confirme a senha anterior" class="form-control" name="password_confirmation">
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-7 offset-md-3">
                    <a href="{{route('home')}}"class="btn btn-danger">
                        <i class="fas fa-ban"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Atualizar <i class="fas fa-pencil-alt"></i>
                    </button>
                </div>
            </div>
        </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts-footer')
    <script src="{{ asset('assets/mask/js/jquery.mask.min.js') }}"></script>
@endpush
