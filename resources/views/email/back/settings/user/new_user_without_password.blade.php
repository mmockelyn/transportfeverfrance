@extends("email.layouts.email")

@section("content")
    <tr>
        <td align="left" valign="center">
            <div style="text-align:left; margin: 0 20px; padding: 40px; background-color:#ffffff; border-radius: 6px">
                <!--begin:Email content-->
                <div style="padding-bottom: 30px; font-size: 17px;">
                    <strong>Cher {{ $user->name }},</strong>
                </div>
                <div style="padding-bottom: 30px">
                    Votre compte à été ajouter manuellement par un administrateur du site {{ env("APP_NAME") }}.<br>
                    Par default et à des fin de protection, le mot de passe à été générer aléatoirement:<br>
                    <br>
                    Votre mot de passe: <strong>{{ $password }}</strong><br>
                    <br>
                    Veillez à changer ce mot de passe à des fin de sécurité par l'intermédiaire <strong>Mon Profil -> onglet "Sécutité" -> Changer mon mot de passe</strong>.<br>
                </div>
                <!--end:Email content-->
                <div style="padding-bottom: 10px">Cordialement,
                    <br>La communauté Transport Fever France
                </div>
            </div>
        </td>
    </tr>
@endsection
