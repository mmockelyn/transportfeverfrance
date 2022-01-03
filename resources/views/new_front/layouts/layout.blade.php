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
            @include("new_front.layouts.includes.header_top")
            @include("new_front.layouts.includes.header_container")
            @include("new_front.layouts.includes.header_nav")
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
