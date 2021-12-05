@props(['user'])

@if($user->faileds()->count() == 0)
    <span class="badge badge-success"> OK</span>
@else
    <span class="badge badge-danger" data-bs-toggle="tooltip" data-theme="dark" title="Nombre de connexion echoué: {{ $user->faileds()->count() }}"> Attention</span>
@endif
