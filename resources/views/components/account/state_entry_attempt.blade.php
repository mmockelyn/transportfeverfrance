@props(['user'])

@if($user->faileds()->count() == 0)
    <span class="label label-pill label-inline label-success"> OK</span>
@else
    <span class="label label-pill label-inline label-danger" data-toggle="tooltip" data-theme="dark" title="Nombre de connexion echoué: {{ $user->faileds()->count() }}"> Attention</span>
@endif
