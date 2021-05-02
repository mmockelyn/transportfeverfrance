
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
                <form class="form w-100" method="POST" action="{{ route('register') }}">
                    @csrf
                    <!--begin::Heading-->
                    <div class="text-center mb-10">
                        <!--begin::Title-->
                        <h1 class="text-dark mb-3">Inscription à {{ env('APP_NAME') }}</h1>
                        <!--end::Title-->
                        <!--begin::Link-->
                        <div class="text-gray-400 fw-bold fs-4">Vous avez déja un compte ?
                            <a href="{{ route('login') }}" class="link-primary fw-bolder">Connexion</a>
                        </div>
                        <!--end::Link-->
                        <x-auth.validation-errors :errors="$errors" />
                    </div>
                    <!--begin::Heading-->
                        <div class="fv-row mb-10 fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="form-label fs-6 fw-bolder text-dark">Nom d'utilisateur ou Pseudo</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input class="form-control form-control-lg form-control-solid" type="text" name="name" autocomplete="off" value="{{ old('name') }}" required autofocus>
                            <!--end::Input-->
                        </div>
                    <!--begin::Input group-->
                        <x-auth.input-email />
                    <!--end::Input group-->
                    <!--begin::Input group-->
                        <x-auth.input-password />

                        <div class="fv-row mb-10 fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="form-label fs-6 fw-bolder text-dark">Confirmation du mot de passe</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input class="form-control form-control-lg form-control-solid" type="password" name="password_confirmation" autocomplete="off" required>
                            <!--end::Input-->
                        </div>
                    <!--end::Input group-->
                        <x-auth.submit title="Inscription" />
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
