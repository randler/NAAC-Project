<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="https://pingendo.com/assets/bootstrap/bootstrap-4.0.0-beta.1.css" type="text/css"> </head>

<body>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <img class="img-fluid d-block" src="{{base_path()}}/public/assets/img/ftc.jpg" width="130px"> </div>
        <div class="col-md-4 py-5 my-5">
          <h1 class="text-center">{{$dadosEmail->title}}</h1>
        </div>
        <div class="col-md-4">
          <img class="img-fluid d-block" src="{{base_path()}}/public/assets/img/naac.jpg" width="70px"> </div>
      </div>
    </div>
  </div>
  <div class="">
    <div class="container">
      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
        <div class="card">
          <div class="card-header text-center"> {{$dadosEmail->titulo}} </div>
          <div class="card-body text-center">
          <h4>{{$dadosEmail->autor}}</h4>
          <h6 class="text-muted">{{$dadosEmail->mensagem}}</h6>
          @if ($dados->tipo == 'novo-usuario')
            <a class="btn btn-block btn-primary" href="{{$dadosEmail->link}}"> Ver <i class="fas fa-user"></i></a>
          @else
            <a class="btn btn-block btn-primary" href="{{$dadosEmail->link}}"> Ver Projeto <i class="fas fa-search"></i></a>
          @endif
          </div>
        </div>
        </div>
        <div class="col-md-4"></div>
      </div>
    </div>
  </div>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="blockquote">
            <p class="mb-0">Muito Obrigado</p>
            <div class="blockquote-footer">Por favor não responda a esse e-mail</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>

</html>