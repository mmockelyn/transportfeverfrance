@include('front.layouts.includes.head')
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled page-loading">
<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Error-->
    <div class="error error-4 d-flex flex-row-fluid bgi-size-cover bgi-position-center" style="background-image: url({{ asset('front/assets/media/error/bg4.jpg') }});">
        <!--begin::Content-->
        <div class="d-flex flex-column flex-row-fluid align-items-center align-items-md-start justify-content-md-center text-center text-md-left px-10 px-md-30 py-10 py-md-0 line-height-xs">
            <h1 class="error-title text-success font-weight-boldest line-height-sm">429</h1>
            <p class="error-subtitle text-success font-weight-boldest mb-10">TO MANY REQUESTS</p>
            <p class="display-4 text-danger font-weight-boldest mt-md-0 line-height-md">En gros vous avez envoyer trop de reqêtes au serveur.<br>Veuillez réessayer plus tard ou contacter un administrateur.</p>
        </div>
        <!--end::Content-->
    </div>
    <!--end::Error-->
</div>
<!--end::Main-->
<!--begin::Global Config(global config for global JS scripts)-->
<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#8950FC", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#E1E9FF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
<!--end::Global Config-->
<!--begin::Global Theme Bundle(used by all pages)-->
<script src="{{ asset('/front/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('/front/assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
<script src="{{ asset('/front/assets/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('/front/js/blog/comment.js') }}"></script>
<!--end::Global Theme Bundle-->
</body>
<!--end::Body-->
</html>
