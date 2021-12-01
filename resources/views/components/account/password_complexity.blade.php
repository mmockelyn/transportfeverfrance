@props(['user'])

@if($user->password_complexity !== null)
    @if($user->password_complexity <= 15)
        <span class="badge badge-danger" data-toggle="tooltip" data-theme="dark" title="Complexity: {{ $user->password_complexity }}">Bas</span>
    @elseif($user->password_complexity >= 16 && $user->password_complexity <= 49)
        <span class="badge badge-warning" data-toggle="tooltip" data-theme="dark" title="Complexity: {{ $user->password_complexity }}">Moyen</span>
    @else
        <span class="badge badge-success" data-toggle="tooltip" data-theme="dark" title="Complexity: {{ $user->password_complexity }}">Haut</span>
    @endif
@else
    <i class="fas fa-warning" data-bs-toggle="tooltip" data-theme="dark" title="Connexion social, mot de passe non définie"></i>
@endif
