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
