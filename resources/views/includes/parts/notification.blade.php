@if($notification->data['status_projeto'] == 'Deferido')
    <a class="dropdown-item"  href="{{route('visualizar-projeto', [$notification->data['id'], $notification->id]) }}">{{$notification->data['titulo_projeto']}} - <b class="text-success">{{$notification->data['status_projeto']}}</b></a>
@endif    
@if($notification->data['status_projeto'] == 'Indeferido')
    <a class="dropdown-item"  href="{{route('visualizar-projeto', [$notification->data['id'], $notification->id]) }}">{{$notification->data['titulo_projeto']}} - <b class="text-danger">{{$notification->data['status_projeto']}}</b></a>
@endif    
@if($notification->data['status_projeto'] == 'Enviado' || $notification->data['status_projeto'] == 'Reenviado')
    <a class="dropdown-item"  href="{{route('corrigir-project', [$notification->data['id'], $notification->id]) }}">{{$notification->data['titulo_projeto']}} - <b class="text-primary">{{$notification->data['status_projeto']}}</b></a>
@endif    
@if($notification->data['status_projeto'] == 'Corrigir' || $notification->data['status_projeto'] == 'Recorrigir')
    <a class="dropdown-item"  href="{{route('corrigir-projeto-user', [$notification->data['id'], $notification->id]) }}">{{$notification->data['titulo_projeto']}} - <b class="text-warning">{{$notification->data['status_projeto']}}</b></a>
@endif    
@if($notification->data['status_projeto'] == 'new_user')
<a class="dropdown-item text-secondary"  href="{{route('request-users', [$notification->data['id']])}}"><b>Novo usuário Cadastrado</b></a>
@endif    