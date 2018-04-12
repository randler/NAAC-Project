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
            <div class="card">
                <div class="card-body p-5"> 
                  <h3 class=" text-center text-dark"><i class="fas fa-envelope fa-2x"></i></h3>
                  <h3 class="pb-3 text-center text-dark">E-mail Enviado&nbsp;</h3>
                  <h3 class="pb-3 text-dark">Obrigado Entraremos em contato o mais breve possível.</h3>
                  <h3 class="pb-3 text-center">
                    <a href="{{route('home')}}" style="text-decoration: none;" class="text-dark">Voltar <i class="fas fa-home"></i></a>
                  </h3>
                </div>
              </div>
          
        </div>
      </div>
    </div>
  </div>
  @stop