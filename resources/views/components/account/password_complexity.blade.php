@props(['user'])

@if($user->password_complexity !== null)
    @if($user->password_complexity <= 15)
        <span class="label label-pill label-inline label-danger" data-toggle="tooltip" data-theme="dark" title="Complexity: {{ $user->password_complexity }}">Bas</span>
    @elseif($user->password_complexity >= 16 && $user->password_complexity <= 49)
        <span class="label label-pill label-inline label-warning" data-toggle="tooltip" data-theme="dark" title="Complexity: {{ $user->password_complexity }}">Moyen</span>
    @else
        <span class="label label-pill label-inline label-success" data-toggle="tooltip" data-theme="dark" title="Complexity: {{ $user->password_complexity }}">Haut</span>
    @endif
@else
    <i class="fas fa-warning" data-toggle="tooltip" data-theme="dark" title="Connexion social, mot de passe non définie"></i>
@endif
