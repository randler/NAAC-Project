@if($notification->data['status'] == 'Deferido')
    <a class="dropdown-item"  href="{{route('visualizar-projeto', [$notification->data['id'], $notification->id]) }}">{{$notification->data['titulo']}} - <b class="text-success">{{$notification->data['status']}}</b></a>
@endif    
@if($notification->data['status'] == 'Indeferido')
    <a class="dropdown-item"  href="{{route('corrigir-projeto-user', [$notification->data['id'], $notification->id]) }}">{{$notification->data['titulo']}} - <b class="text-danger">{{$notification->data['status']}}</b></a>
@endif    
@if($notification->data['status'] == 'Enviado' || $notification->data['status'] == 'Reenviado')
    <a class="dropdown-item"  href="{{route('corrigir-project', [$notification->data['id'], $notification->id]) }}">{{$notification->data['titulo']}} - <b class="text-primary">{{$notification->data['status']}}</b></a>
@endif    
@if($notification->data['status'] == 'Corrigir' || $notification->data['status'] == 'Recorrigir')
    <a class="dropdown-item"  href="{{route('corrigir-projeto-user', [$notification->data['id'], $notification->id]) }}">{{$notification->data['titulo']}} - <b class="text-warning">{{$notification->data['status']}}</b></a>
@endif    
@if($notification->data['status'] == 'new_user')
<a class="dropdown-item text-secondary"  href="{{route('request-users', [$notification->data['id']])}}"><b>Novo usuário Cadastrado</b></a>
@endif    