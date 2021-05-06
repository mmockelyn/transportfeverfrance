
<!DOCTYPE html>
<!--
Product Name: Metronic - #1 Selling Bootstrap 5 HTML Multi-demo Admin Dashboard ThemeAuthor: KeenThemes
Purchase: https://1.envato.market/EA4JPWebsite: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.-->
<html lang="en">
<!--begin::Head-->
<head><base href="../../../">
    <meta charset="utf-8" />
    <title>{{ env('APP_NAME') }}</title>
    <meta name="description" content="Création pour Trainsport Fever 2 par Trainznation Studio" />
    <meta name="keywords" content="Trainznation, mod, transport, fever, game, build, modding, create, artifact, simple, train, fly" />
    <link rel="canonical" href="{{ env('APP_URL') }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ asset('back/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('back/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="bg-dark header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed toolbar-tablet-and-mobile-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-size1: 100% 50%; background-image: url({{ asset('back/assets/media/misc/outdoor.png') }})">
        <!--begin::Content-->
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <!--begin::Logo-->
            <a href="{{ route('home') }}" class="mb-12">
                <img alt="Logo" src="/storage/files/shares/core/logo_couleur.png" class="h-100px" />
            </a>
            <!--end::Logo-->
            <!--begin::Wrapper-->
            <div class="w-lg-500px bg-white rounded shadow-sm p-10 p-lg-15 mx-auto">
                <!--begin::Form-->
                <form class="form w-100" method="POST" action="/email/verification-notification">
                    @csrf
                    <!--begin::Heading-->
                    <div class="text-center mb-10">
                        <!--begin::Title-->
                        <h1 class="text-dark mb-3">Bienvenue: Validation de votre compte</h1>
                        <!--end::Title-->
                        <!--begin::Link-->
                        <div class="text-gray-400 fw-bold fs-4">Une email comportant les instructions de validation de votre compte vient de vous être envoyer.</div>
                        <!--end::Link-->
                        <x-auth.session-status :status="session('status')" />
                        <x-auth.validation-errors :errors="$errors" />
                    </div>
                        <p class="fw-bold">Si vous n'avez pas reçu le mail ou si vous l'avez par mégarde supprimer, veuillez cliquer sur le boutton ci-dessous pour recevoir de nouveau ce mail.</p>
                        <button class="btn btn-block btn-info">Renvoyer le mail de vérification</button>

                </form>
                <!--end::Form-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Content-->
        <!--begin::Footer-->
        <div class="d-flex flex-center flex-column-auto p-10">
            <!--begin::Links-->
            <!--<div class="d-flex align-items-center fw-bold fs-6">
                <a href="https://keenthemes.com/faqs" class="text-muted text-hover-primary px-2">About</a>
                <a href="mailto:support@keenthemes.com" class="text-muted text-hover-primary px-2">Contact</a>
                <a href="https://1.envato.market/EA4JP" class="text-muted text-hover-primary px-2">Contact Us</a>
            </div>-->
            <!--end::Links-->
        </div>
        <!--end::Footer-->
    </div>
    <!--end::Authentication - Sign-in-->
</div>
<!--end::Main-->
<!--begin::Javascript-->
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{ asset('back/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('back/assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--end::Javascript-->
</body>
<!--end::Body-->
</html>
