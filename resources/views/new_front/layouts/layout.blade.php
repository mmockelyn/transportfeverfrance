<!DOCTYPE html>
<html>
<head>

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>{{ config('app.name') }}</title>

    @yield("meta")

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="apple-touch-icon.png">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">

    <!-- Web Fonts  -->
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="/front/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/front/assets/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/front/assets/vendor/animate/animate.min.css">
    <link rel="stylesheet" href="/front/assets/vendor/simple-line-icons/css/simple-line-icons.min.css">
    <link rel="stylesheet" href="/front/assets/vendor/owl.carousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="/front/assets/vendor/owl.carousel/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="/front/assets/vendor/magnific-popup/magnific-popup.min.css">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="/front/assets/css/theme.css">
    <link rel="stylesheet" href="/front/assets/css/theme-elements.css">
    <link rel="stylesheet" href="/front/assets/css/theme-blog.css">
    <link rel="stylesheet" href="/front/assets/css/theme-shop.css">

    <!-- Current Page CSS -->
    <link rel="stylesheet" href="/front/assets/vendor/rs-plugin/css/settings.css">
    <link rel="stylesheet" href="/front/assets/vendor/rs-plugin/css/layers.css">
    <link rel="stylesheet" href="/front/assets/vendor/rs-plugin/css/navigation.css">

    <!-- Demo CSS -->


    <!-- Skin CSS -->
    <link rel="stylesheet" href="/front/assets/css/skins/default.css">

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="/front/assets/css/custom.css">

    @yield("style")

    <!-- Head Libs -->
    <script src="/front/assets/vendor/modernizr/modernizr.min.js"></script>

</head>
<body class="loading-overlay-showing" data-plugin-page-transition data-loading-overlay data-plugin-options="{'hideDelay': 500}">
<div class="loading-overlay">
    <div class="bounce-loader">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
    </div>
</div>

<div class="body">

    <header id="header" data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyStartAt': 122, 'stickySetTop': '-122px', 'stickyChangeLogo': false}">
        <div class="header-body border-color-primary border-top-0 box-shadow-none">
            <div class="header-container container">
                <div class="header-row">
                    <div class="header-column">
                        <div class="header-row">
                            <div class="header-logo">
                                <a href="{{ route('home') }}">
                                    <img alt="Porto" width="100" height="48" data-sticky-width="82" data-sticky-height="40" data-sticky-top="25" src="/storage/files/shares/core/logo_couleur.png">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="header-column justify-content-end">
                        <div class="header-row">
                            <div class="header-nav pt-1">
                                <div class="header-nav-main header-nav-main-effect-1 header-nav-main-sub-effect-1">
                                    <nav class="collapse">
                                        <ul class="nav nav-pills" id="mainNav">
                                            <li>
                                                <a href="{{ route('home') }}">Acceuil</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('front.blog') }}">Blog</a>
                                            </li>
                                            <li class="dropdown dropdown-mega">
                                                <a class="dropdown-item dropdown-toggle" href="#">
                                                    Téléchargement
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <div class="dropdown-mega-content">
                                                            <div class="row">
                                                                <div class="col-lg-9"></div>
                                                                <div class="col-lg-3">
                                                                    <span class="dropdown-mega-sub-title">Téléchargement</span>
                                                                    <ul class="dropdown-mega-sub-nav">
                                                                        @foreach($download_categories as $category)
                                                                        <li class="dropdown-submenu">
                                                                            <a href="" class="dropdown-item">{{ $category->title }}</a>
                                                                            <ul class="dropdown-menu">
                                                                                @foreach($category->subcategories as $sub)
                                                                                    <li><a href="{{ route('front.download.category', $sub->id) }}">{{ $sub->title }}</a></li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="{{ route('contacts.create') }}">Nous contacter</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                                <div class="header-nav-features">
                                    @if(auth()->guest())
                                        <div class="header-nav-features header-nav-features-no-border header-nav-features-lg-show-border order-1 order-lg-2">
                                            <div class="header-nav-feature header-nav-features-user d-inline-flex mx-2 pr-2 signin" id="headerAccount">
                                                <a href="#" class="header-nav-features-toggle">
                                                    <i class="fas fa-user"></i> Connexion
                                                </a>
                                                <div class="header-nav-features-dropdown header-nav-features-dropdown-mobile-fixed header-nav-features-dropdown-force-right" id="headerTopUserDropdown">
                                                    <div class="signin-form">
                                                        <h5 class="text-uppercase mb-4 font-weight-bold text-3">Connexion</h5>
                                                        <form action="{{ route('login') }}" method="post">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label class="mb-1 text-2 opacity-8">Adresse Mail * </label>
                                                                <input type="email" class="form-control form-control-lg" name="email" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="mb-1 text-2 opacity-8">Mot de passe *</label>
                                                                <input type="password" class="form-control form-control-lg" name="password" required>
                                                            </div>
                                                            <div class="form-row pb-2">
                                                                <div class="form-group form-check col-lg-6 pl-1">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" id="rememberMeCheck" name="remember">
                                                                        <label class="custom-control-label text-2" for="rememberMeCheck">Se souvenir de moi</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-lg-6 text-right">
                                                                    <a class="text-uppercase text-1 font-weight-bold text-color-dark" id="headerRecover" href="#">Oublie de mot de passe ?</a>
                                                                </div>
                                                            </div>
                                                            <div class="actions">
                                                                <div class="form-row">
                                                                    <div class="col d-flex justify-content-end">
                                                                        <button type="submit" class="btn btn-primary">Connexion</button>
                                                                    </div>
                                                                    <div class="col d-flex justify-content-center">
                                                                        <a href="{{ route('auth.login.provider', 'discord') }}" class="mb-1 mt-1 mr-1 btn bg-discord text-color-white"><i class="fab fa-discord"></i></a>
                                                                        <a href="{{ route('auth.login.provider', 'google') }}" class="mb-1 mt-1 mr-1 btn bg-google text-color-white"><i class="fab fa-google"></i></a>
                                                                        <a href="{{ route('auth.login.provider', 'facebook') }}" class="mb-1 mt-1 mr-1 btn bg-facebook text-color-white"><i class="fab fa-facebook"></i></a>
                                                                        <a href="{{ route('auth.login.provider', 'twitter') }}" class="mb-1 mt-1 mr-1 btn bg-twitter text-color-white"><i class="fab fa-twitter"></i></a>
                                                                        <a href="{{ route('auth.login.provider', 'steam') }}" class="mb-1 mt-1 mr-1 btn bg-steam text-color-white"><i class="fab fa-steam"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="extra-actions">
                                                                <p>Vous n'avez pas de compte ? <a href="#" id="headerSignUp" class="text-uppercase text-1 font-weight-bold text-color-dark">S'inscrire</a></p>
                                                            </div>
                                                        </form>
                                                    </div>

                                                    <div class="signup-form">
                                                        <h5 class="text-uppercase mb-4 font-weight-bold text-3">Inscription</h5>
                                                        <form action="{{ route('register') }}" method="post">
                                                            <div class="form-group">
                                                                <label class="mb-1 text-2 opacity-8">Pseudo * </label>
                                                                <input type="text" class="form-control form-control-lg" name="name" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="mb-1 text-2 opacity-8">Adresse Mail * </label>
                                                                <input type="email" class="form-control form-control-lg" name="email" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="mb-1 text-2 opacity-8">Mot de passe *</label>
                                                                <input type="password" class="form-control form-control-lg" name="password" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="mb-1 text-2 opacity-8">Confirmation du mot de passe *</label>
                                                                <input type="password" class="form-control form-control-lg" name="password_confirmation" required>
                                                            </div>
                                                            <div class="actions">
                                                                <div class="form-row">
                                                                    <div class="col d-flex justify-content-end">
                                                                        <button type="submit" class="btn btn-primary">M'inscrire</button>
                                                                    </div>
                                                                    <div class="col d-flex justify-content-center">
                                                                        <a href="{{ route('auth.login.provider', 'discord') }}" class="mb-1 mt-1 mr-1 btn bg-discord text-color-white"><i class="fab fa-discord"></i></a>
                                                                        <a href="{{ route('auth.login.provider', 'google') }}" class="mb-1 mt-1 mr-1 btn bg-google text-color-white"><i class="fab fa-google"></i></a>
                                                                        <a href="{{ route('auth.login.provider', 'facebook') }}" class="mb-1 mt-1 mr-1 btn bg-facebook text-color-white"><i class="fab fa-facebook"></i></a>
                                                                        <a href="{{ route('auth.login.provider', 'twitter') }}" class="mb-1 mt-1 mr-1 btn bg-twitter text-color-white"><i class="fab fa-twitter"></i></a>
                                                                        <a href="{{ route('auth.login.provider', 'steam') }}" class="mb-1 mt-1 mr-1 btn bg-steam text-color-white"><i class="fab fa-steam"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="extra-actions">
                                                                <p>Vous avez déja un compte ? <a href="#" id="headerSignIn" class="text-uppercase text-1 font-weight-bold text-color-dark">Connexion</a></p>
                                                            </div>
                                                        </form>
                                                    </div>

                                                    <div class="recover-form">
                                                        <h5 class="text-uppercase mb-2 pb-1 font-weight-bold text-3">Réinitialiser mon mot de passe</h5>
                                                        <p class="text-2 mb-4">Remplissez le formulaire ci-dessous pour recevoir un e-mail avec le code d'autorisation nécessaire pour réinitialiser votre mot de passe.</p>

                                                        <form action="{{ route('password.email') }}">
                                                            <div class="form-group">
                                                                <label class="mb-1 text-2 opacity-8">Adresse Mail* </label>
                                                                <input type="email" class="form-control form-control-lg" name="email" required>
                                                            </div>
                                                            <div class="actions">
                                                                <div class="form-row">
                                                                    <div class="col d-flex justify-content-end">
                                                                        <button type="submit" class="btn btn-primary">Réinitialiser</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="extra-actions">
                                                                <p>Vous avez déja un compte ? <a href="#" id="headerRecoverCancel" class="text-uppercase text-1 font-weight-bold text-color-dark">Connexion</a></p>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="header-nav-features header-nav-features-no-border header-nav-features-lg-show-border order-1 order-lg-2">
                                            <div class="header-nav-feature header-nav-features-user header-nav-features-user-logged d-inline-flex mx-2 pr-2" id="headerAccount">
                                                <a href="#" class="header-nav-features-toggle">
                                                    <i class="fas fa-user"></i> {{ auth()->user()->name }}
                                                </a>
                                                <div class="header-nav-features-dropdown header-nav-features-dropdown-mobile-fixed header-nav-features-dropdown-force-right" id="headerTopUserDropdown">
                                                    <div class="row">
                                                        <div class="col-8">
                                                            <p class="mb-0 pb-0 text-2 line-height-1 pt-1">
                                                                @if(now()->hour >= 0 && now()->hour <= 17)
                                                                    Bonjour,
                                                                @else
                                                                    Bonsoir,
                                                                @endif
                                                            </p>
                                                            <p><strong class="text-color-dark text-4">{{ auth()->user()->name }}</strong></p>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="d-flex justify-content-end">
                                                                @if(auth()->user()->image)
                                                                    <img class="rounded-circle" width="40" height="40" alt="" src="/storage/files/shares/avatar/{{ auth()->user()->image }}">
                                                                @else
                                                                    <img class="rounded-circle" width="40" height="40" alt="" src="/storage/files/shares/avatar/placeholder.png">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <ul class="nav nav-list-simple flex-column text-3">
                                                                <li class="nav-item"><a class="nav-link" href="{{ route('account.profil') }}"><i class="fas fa-user-circle"></i> Mon profil</a></li>
                                                                <li class="nav-item"><a class="nav-link" href="{{ route('account.badges') }}"><i class="fas fa-certificate"></i> Mes badges</a></li>
                                                                <li class="nav-item"><a class="nav-link" href="{{ route('account.notify') }}"><i class="fas fa-bell"></i> Mes notifications</a></li>
                                                                <li class="nav-item"><a class="nav-link" href="{{ route('account.messagerie') }}"><i class="fas fa-envelope-square"></i> Ma messagerie</a></li>
                                                                <li class="nav-item"><a class="nav-link" href="{{ route('account.packages') }}"><i class="fas fa-boxes"></i> Mes Packages</a></li>
                                                                <li class="nav-item"><a class="nav-link" href="{{ route('account.project') }}"><i class="fas fa-layer-group"></i> Mes projets</a></li>
                                                                @if(auth()->user()->group == 1)
                                                                    <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-cogs"></i> Administration du site</a></li>
                                                                @endif
                                                                <li class="nav-item">
                                                                    <form action="{{ route('logout') }}" method="POST">
                                                                        <button type="submit" class="btn btn-xs btn-primary"><i class="fas fa-sign-out-alt"></i> Déconnexion</button>
                                                                    </form>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main nav">
                                    <i class="fas fa-bars"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div role="main" class="main">
        @yield("content")
    </div>

    <footer id="footer">
        @include("new_front.layouts.includes.footer")
    </footer>
</div>

<!-- Vendor -->
<script src="/front/assets/vendor/jquery/jquery.min.js"></script>
<script src="/front/assets/vendor/jquery.appear/jquery.appear.min.js"></script>
<script src="/front/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="/front/assets/vendor/jquery.cookie/jquery.cookie.min.js"></script>
<script src="/front/assets/vendor/popper/umd/popper.min.js"></script>
<script src="/front/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="/front/assets/vendor/common/common.min.js"></script>
<script src="/front/assets/vendor/jquery.validation/jquery.validate.min.js"></script>
<script src="/front/assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
<script src="/front/assets/vendor/jquery.gmap/jquery.gmap.min.js"></script>
<script src="/front/assets/vendor/jquery.lazyload/jquery.lazyload.min.js"></script>
<script src="/front/assets/vendor/isotope/jquery.isotope.min.js"></script>
<script src="/front/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="/front/assets/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="/front/assets/vendor/vide/jquery.vide.min.js"></script>
<script src="/front/assets/vendor/vivus/vivus.min.js"></script>
<script src="/front/assets/vendor/instafeed/instafeed.min.js"></script>

<!-- Theme Base, Components and Settings -->
<script src="/front/assets/js/theme.js"></script>

<!-- Theme Custom -->
<script src="/front/assets/js/custom.js"></script>

<!-- Theme Initialization Files -->
<script src="/front/assets/js/theme.init.js"></script>

<!-- Examples -->
<script src="/front/assets/js/examples/examples.instafeed.js"></script>

@yield("script")


<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-185785466-1', 'auto');
    ga('send', 'pageview');
</script>

</body>
</html>
