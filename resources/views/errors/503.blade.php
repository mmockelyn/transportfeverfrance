<!DOCTYPE html>
<html>
<head>

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>{{ config('app.name') }} - Maintenance</title>

    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Porto - Responsive HTML5 Template">
    <meta name="author" content="okler.net">

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="apple-touch-icon.png">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">

    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">

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

    <!-- Demo CSS -->


    <!-- Skin CSS -->
    <link rel="stylesheet" href="/front/assets/css/skins/default.css">

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="/front/assets/css/custom.css">

    <!-- Head Libs -->
    <script src="/front/assets/vendor/modernizr/modernizr.min.js"></script>

</head>
<body>

<div class="body coming-soon">
    <div role="main" class="main" style="min-height: calc(100vh - 393px);">
        <div class="container">
            <div class="row mt-5">
                <div class="col text-center">
                    <div class="logo">
                        <a href="{{ route('home') }}">
                            <img width="100" height="48" src="/storage/files/shares/core/logo_couleur.png" alt="{{ config('app.name') }}">
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <hr class="solid my-5">
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <div class="overflow-hidden mb-2">
                        <h2 class="font-weight-normal text-7 mb-0 appear-animation" data-appear-animation="maskUp"><strong class="font-weight-extra-bold">Mode Maintenance activé !</strong></h2>
                    </div>
                    <div class="overflow-hidden mb-1">
                        <p class="lead mb-0 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="200">Le site est actuellement en maintenance.<br>Revenez plus tard.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <hr class="solid my-5">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col-lg-6 appear-animation" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="600">
                            <div class="feature-box">
                                <div class="feature-box-icon">
                                    <i class="far fa-life-ring"></i>
                                </div>
                                <div class="feature-box-info">
                                    <h4 class="text-4 text-uppercase mb-1 font-weight-bold">Que ce passe t-il exactement ?</h4>
                                    <p class="mb-4">Afin de garantir la continuiter des services de {{ config('app.name') }}, notre équipe travail à l'amélioration continuelle des services.<br>Cela doit passer par des mise à jours du site et donc de fermer sont accès.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="400">
                            <div class="feature-box">
                                <div class="feature-box-icon">
                                    <i class="far fa-clock"></i>
                                </div>
                                <div class="feature-box-info">
                                    <h4 class="text-4 text-uppercase mb-1 font-weight-bold">Revenez plus tard</h4>
                                    <p class="mb-4">Même si le site doit avoir droit à une grosse mise à jour, la maintenance n'éxède jamais 6H.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer id="footer">
        <div class="container my-4">
            <div class="row py-5">
                <div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
                    <h5 class="text-5 text-transform-none font-weight-semibold text-color-light mb-4">Suivez-nous</h5>
                    <ul class="header-social-icons social-icons">
                        @foreach($follows as $follow)
                            <li class="social-icons-{{ $follow->slug }}"><a href="{{ $follow->href }}" target="_blank" title="{{ $follow->title }}"><i class="fab fa-{{ $follow->icon }}"></i></a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-6 col-lg-2 mb-5 mb-lg-0">
                    <h5 class="text-5 text-transform-none font-weight-semibold text-color-light mb-4">Pages</h5>
                    <ul class="list list-icons list-icons-sm">
                        @foreach($pages as $page)
                            <li><i class="fas fa-angle-right"></i><a href="{{ route('page', $page->slug) }}" class="link-hover-style-1 ml-1"> {{ $page->title }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-6 col-lg-5">
                    <h5 class="text-5 text-transform-none font-weight-semibold text-color-light mb-4">Derniers Tweet</h5>
                    <div id="tweet" class="twitter" data-plugin-tweets="" data-plugin-options="{'username': 'tpf_france', 'count': 2}">
                        <p>Please wait...</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-copyright footer-copyright-style-2">
            <div class="container py-2">
                <div class="row py-4">
                    <div class="col mb-4 mb-lg-0">
                        <p>© Copyright 2021. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
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

<!-- Theme Base, Components and Settings -->
<script src="/front/assets/js/theme.js"></script>

<!-- Theme Custom -->
<script src="/front/assets/js/custom.js"></script>

<!-- Theme Initialization Files -->
<script src="/front/assets/js/theme.init.js"></script>

<!-- Google Analytics: Change UA-XXXXX-X to be your site's ID. Go to http://www.google.com/analytics/ for more information.
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-12345678-1', 'auto');
    ga('send', 'pageview');
</script>
 -->

</body>
</html>
