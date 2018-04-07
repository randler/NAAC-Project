<nav class="navbar navbar-expand-md bg-secondary navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="{{url('/')}}"> <i class="fa fa-graduation-cap"></i> NAAC</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span> </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          @guest
          <li class="nav-item">
              <a class="nav-link text-white" href="{{route('index')}}">Início</a>
          </li>
          @else
          <li class="nav-item">
              <a class="nav-link text-white" href="{{route('home')}}">Início</a>
          </li>
          @endguest
          @guest
          <li class="nav-item">
            <a class="nav-link text-white" href="{{route('register')}}">Cadastrar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="#">Sobre</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="{{route('contact')}}">Contato</a>
          </li>
          @endguest
        </ul>
        @guest
          <a href="{{route('login')}}" class="btn btn-primary" type="submit"><i class="fas fa-sign-in-alt"></i> Entrar</a>
        @else
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
        <a class="nav-link  dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           Notificações <span class="badge badge-pill badge-danger">{{(count(auth()->user()->unreadNotifications) > 0) ? count(auth()->user()->unreadNotifications) : ''}}</span> </a>
        @if (count(auth()->user()->unreadNotifications) > 0)
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              @foreach(auth()->user()->unreadNotifications as $notification)
                @if ($loop->last)
                  @include('includes.parts.notification', compact($notification))
                  <div class="dropdown-divider"></div>
                  {!! Form::open(['route' => 'apagar-notificacoes']) !!}
                    {!! Form::hidden('notification', $notification->data['id']) !!}
                    <button type="submit" class="btn dropdown-item text-danger"><i class="fas fa-trash"></i> Remover todas </button>
                  {!! Form::close() !!}
                @else
                  @include('includes.parts.notification', compact($notification))
                @endif
              @endforeach
          </div>
        @endif
      </li>
      </ul>




        <ul class="navbar-nav">
            <li class="nav-item dropdown">
        <a class="nav-link btn btn-outline-primary dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           {{ Auth::user()->name }} <span class="caret"></span> </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ route('home') }}"><i class="fa fa-home"></i> Pagína inicial</a>
          <a class="dropdown-item" href="{{ route('perfil') }}"><i class="fa fa-user"></i> Perfíl</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item text-danger" href="{{ route('logout') }}" 
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                              <i class="fas fa-sign-out-alt"></i> Sair
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </div>
      </li>
      </ul>
        @endguest
      </div>
    </div>
  </nav>