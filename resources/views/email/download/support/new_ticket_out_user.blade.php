@extends("email.layouts.email")

@section("content")
    <tr>
        <td align="left" valign="center">
            <div style="text-align:left; margin: 0 20px; padding: 40px; background-color:#ffffff; border-radius: 6px">
                <!--begin:Email content-->
                <div style="padding-bottom: 30px; font-size: 17px;">
                    <strong>Cher {{ $support->name_user }},</strong>
                </div>
                <div style="padding-bottom: 30px">
                    Vous avez effectuer une demande de support sur le mod <b>{{ $support->download->title }}</b>.
                    <br>Les auteurs de ce mod ont été avertie de votre ticket et vous répondrons dès que possible.<br>
                    Afin que vous puissier suivre et répondre à cette demande, veuillez cliquer sur le bouton ci-dessous
                </div>
                <div style="padding-bottom: 40px; text-align:center;">
                    <a href="{{ route('front.download.ticket.room', [$support->download->slug, $support->id]) }}" rel="noopener" style="text-decoration:none;display:inline-block;text-align:center;padding:0.75575rem 1.3rem;font-size:0.925rem;line-height:1.5;border-radius:0.35rem;color:#ffffff;background-color:#009EF7;border:0px;margin-right:0.75rem!important;font-weight:600!important;outline:none!important;vertical-align:middle" target="_blank">Acceder à mon ticket</a>
                </div>
                <div style="border-bottom: 1px solid #eeeeee; margin: 15px 0"></div>
                <div style="padding-bottom: 50px; word-wrap: break-all;">
                    <p style="margin-bottom: 10px;">Ci ce boutton ne fonctionne pas, veuillez copier-coller le lien ci-dessous dans votre navigateur:</p>
                    <a href="{{ route('front.download.ticket.room', [$support->download->slug, $support->id]) }}" rel="noopener" target="_blank" style="text-decoration:none;color: #009EF7">{{ route('front.download.ticket.room', [$support->download->slug, $support->id]) }}</a>
                </div>
                <!--end:Email content-->
                <div style="padding-bottom: 10px">Cordialement,
                    <br>La communauté Transport Fever France
                </div>
            </div>
        </td>
    </tr>
@endsection
