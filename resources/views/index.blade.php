<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}" type="text/css">
  <link rel="stylesheet" href="{{asset('css/bootstrap-4.0.0-beta.1.css')}}" type="text/css">
  <script defer src="{{asset('js/all.js')}}"></script>
  <title>NAAC</title>
</head>

<body>
    @include('includes.navbar.navbar')
  <div class="py-5 gradient-overlay" style="background-image: url(&quot;{{asset('images/cover_event.jpg')}}&quot;);">
    <div class="container py-5">
      <div class="row">
        <div class="col-md-3 text-white">
          <img class="img-fluid d-block mx-auto mb-5" src="{{ asset('assets/img/naac_logo.png') }}"> </div>
        <div class="col-md-9 text-white align-self-center">
          <h1 class="display-3 mb-4">NAAC</h1>
          <p class="mb-5 lead text-capitalize">Núcleo de Acompanhamento de Ações Acadêmicas</p>
        </div>
      </div>
    </div>
  </div>
  <div class="py-5 text-center bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="pb-3 text-secondary">Envie seus projetos e relatórios de maneira prática</h1>
        </div>
      </div>
      <div class="row">
        <div class="text-right col-md-6">
          <div class="row my-5">
            <div class="col-2 order-lg-2 col-2 text-center"><i class="d-block fa fa-3x fa-child"></i></div>
            <div class="col-10 text-lg-right text-left order-lg-1">
              <h4 class="text-primary">Não precisa ir no NAAC</h4>
            </div>
          </div>
          <div class="row my-5">
            <div class="col-2 order-lg-2 col-2 text-center"><i class="d-block fas fa-4x fa-file-alt"></i></div>
            <div class="col-10 text-lg-right text-left order-lg-1">
              <h4 class="text-primary">Projetos e Relatórios enviados para o NAAC</h4>
            </div>
          </div>
        </div>
        <div class="text-left col-md-6">
          <div class="row my-5">
            <div class="col-2 text-center"><i class="d-block fas fa-3x fa-bell"></i></div>
            <div class="col-10">
              <h4 class="text-primary">Notificações de suas solicitações</h4>
            </div>
          </div>
          <div class="row my-5">
            <div class="col-2 text-center"><i class="d-block mx-auto fas fa-3x fa-list"></i></div>
            <div class="col-10">
              <h4 class="text-primary">Listas geradas e salvas quando quiser</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('includes.footer.footer')
</body>

</html>