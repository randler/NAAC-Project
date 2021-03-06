<div class="bg-dark text-white">
    <div class="container">
      <div class="row">
        <div class="p-5 col-md-4">
          <h3 class="mb-4">NAAC</h3>
          <ul class="list-unstyled">
              @guest
                  <a class="nav-link text-white" href="{{route('index')}}">Início</a>
                  <a class="nav-link text-white" href=" {{route('register')}} ">Cadastrar</a>
                  <a class="nav-link text-white" href=" {{route('login')}} ">Entrar</a>
              @else
                  <a class="nav-link text-white" href="{{route('home')}}">Início</a>
              @endguest
                <a class="nav-link text-white" href="#">Sobre</a>
                <a class="nav-link text-white" href="{{route('contact')}}">Contato</a>
          </ul>
        </div>
        <div class="p-5 col-md-3"></div>
        <div class="p-5 col-md-5 text-center">
                <h3 class="mb-5">Social</h3>
                <div class="align-self-center col-12 my-3">
                  <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook-square d-inline fa-3x mr-3 text-white"></i></a>
                  <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter-square d-inline mx-3 fa-3x text-white"></i></a>
                </div>
         </div>
      </div>
      <div class="row">
        <div class="col-md-12 mt-3">
          <p class="text-center">© Copyright 2017 Pingendo - All rights reserved. <a class="text-white" href='https://br.freepik.com' >Designed by Freepik</a> </p>
        </div>
      </div>
    </div>
  </div>
  <script src="{{asset('js/jquery-3.2.1.slim.min.js')}}" ></script>
  <script src="{{asset('js/popper.min.js')}}" ></script>
  <script src="{{asset('js/bootstrap.min.js')}}" ></script>

  @stack('scripts-footer')
  