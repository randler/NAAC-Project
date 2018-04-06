@extends('layouts.app')

@section('content')
<div class="py-5 text-white opaque-overlay" style="background-image: url(&quot;https://pingendo.github.io/templates/sections/assets/cover_restaurant.jpg&quot;);">
    <div class="container">
      <div class="row text-center">
        <div class="col-md-12"><i class="text-center far fa-5x fa-comments"></i>
          <h1 class="display-3 text-center">Nos conte sua opinão</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <p class="lead mb-4">Preencha os dados e clique em enviar</p>
          <form class="" method="post" action="#">
            <div class="form-group"> <label>E-mail</label>
              <input type="email" name="email" class="form-control" placeholder="Digite o seu e-mail"> </div>
            <div class="form-group"> <label>Mensagem</label> <textarea type="text" name="mensagem" class="form-control" placeholder="Digite aqui a sua mensagem" rows="10"></textarea> </div>
            <button type="submit" class="btn btn-primary">Enviar <i class="fa fa-paper-plane"></i></button>
          </form>
        </div>
      </div>
    </div>
  </div>
  @stop