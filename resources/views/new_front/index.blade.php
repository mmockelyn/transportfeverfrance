@extends("new_front.layouts.layout")
@section("style")
    <link rel="stylesheet" href="/front/assets/vendor/rs-plugin/css/settings.css">
    <link rel="stylesheet" href="/front/assets/vendor/rs-plugin/css/layers.css">
    <link rel="stylesheet" href="/front/assets/vendor/rs-plugin/css/navigation.css">
    <link rel="stylesheet" href="/front/assets/vendor/circle-flip-slideshow/css/component.css">
@endsection

@section("meta")

@endsection

@section("content")
    <div class="slider-container rev_slider_wrapper" style="height: 670px;">
        <div id="revolutionSlider" class="slider rev_slider" data-version="5.4.8" data-plugin-revolution-slider data-plugin-options="{'delay': 9000, 'gridwidth': 1170, 'gridheight': 670, 'disableProgressBar': 'on', 'responsiveLevels': [4096,1200,992,500], 'parallax': { 'type': 'scroll', 'origo': 'enterpoint', 'speed': 1000, 'levels': [2,3,4,5,6,7,8,9,12,50], 'disable_onmobile': 'on' }, 'navigation' : {'arrows': { 'enable': true }, 'bullets': {'enable': true, 'style': 'bullets-style-1', 'h_align': 'center', 'v_align': 'bottom', 'space': 7, 'v_offset': 70, 'h_offset': 0}}}">
            <ul>
                @foreach($heros as $hero)
                    <li data-transition="fade" class="slide-overlay">
                        <img src="/storage/files/shares/slider/{{ $hero->image }}"
                             alt=""
                             data-bgposition="center center"
                             data-bgfit="cover"
                             data-bgrepeat="no-repeat"
                             class="rev-slidebg">

                        <div class="tp-caption d-none d-md-block"
                             data-frames='[{"delay":2400,"speed":500,"frame":"0","from":"opacity:0;x:10%;","to":"opacity:1;x:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]'
                             data-x="center" data-hoffset="['80','80','80','135']"
                             data-y="center" data-voffset="['-33','-33','-33','-55']"><img src="/front/assets/img/slides/slide-blue-line.png" alt=""></div>

                        <div class="tp-caption"
                             data-x="center" data-hoffset="['150','150','150','240']"
                             data-y="center" data-voffset="['-50','-50','-50','-75']"
                             data-start="1000"
                             data-transform_in="x:[300%];opacity:0;s:500;"
                             data-transform_idle="opacity:0.2;s:500;"><img src="/front/assets/img/slides/slide-title-border.png" alt=""></div>

                        <div class="tp-caption font-weight-extra-bold text-color-light negative-ls-2"
                             data-frames='[{"delay":1000,"speed":2000,"frame":"0","from":"sX:1.5;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]'
                             data-x="center"
                             data-y="center"
                             data-fontsize="['50','50','50','90']"
                             data-lineheight="['55','55','55','95']">{{ $hero->title }}</div>

                        <div class="tp-caption font-weight-light"
                             data-frames='[{"from":"opacity:0;","speed":300,"to":"o:1;","delay":2000,"split":"chars","splitdelay":0.05,"ease":"Power2.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'
                             data-x="center"
                             data-y="center" data-voffset="['40','40','40','80']"
                             data-fontsize="['18','18','18','50']"
                             data-lineheight="['20','20','20','55']"
                             style="color: #b5b5b5;">{{ \Illuminate\Support\Str::limit($hero->short_content, 50) }}</div>

                        <a class="tp-caption tp-resizeme btn btn-primary"
                             data-frames='[{"delay":2000,"speed":2000,"frame":"0","from":"sX:1.5;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]'
                             data-x="center"
                             data-y="center" data-voffset="['130','40','40','80']"
                             data-width="['500']"
                             data-height="['auto']"
                             href="{{ route('front.blog.show', $hero->slug) }}"
                             >En savoir plus <span><i class="fas fa-chevron-right"></i></span></a>

                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="container pb-1">
        <div class="row pt-4 pb-2">
            <div class="col">
                <div class="overflow-hidden mb-3">
                    <h2 class="font-weight-bold text-8 mb-0 appear-animation animated maskUp appear-animation-visible" data-appear-animation="maskUp" style="animation-delay: 100ms;">
                        Derniers articles du blog
                    </h2>
                </div>
            </div>
        </div>
        <div class="row pt-4 pb-2">
            <div class="col">
                <div class="blog-posts">

                    <div class="row">
                        @foreach($blogs as $blog)
                        <div class="col-md-4">
                            <article class="post post-medium border-0 pb-0 mb-5">
                                <div class="post-image">
                                    <a href="{{ route('front.blog.show', $blog->slug) }}">
                                        @if($blog->image)
                                            <img src="/storage/files/shares/blog/{{ $blog->image }}" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="">
                                        @else
                                            <img src="/storage/files/shares/blog/placeholder.jpg" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="">
                                        @endif
                                    </a>
                                </div>

                                <div class="post-content">

                                    <h2 class="font-weight-semibold text-5 line-height-6 mt-3 mb-2"><a href="{{ route('front.blog.show', $blog->slug) }}">{{ $blog->title }}</a></h2>
                                    <p>{{ $blog->short_content }}</p>

                                    <div class="post-meta">
                                        <span><i class="far fa-user"></i> par <a href="#">Transport Fever France</a> </span>
                                        <span><i class="far fa-folder"></i>
                                            @foreach($blog->categories as $category)
                                                {{ $category->title }},
                                            @endforeach
                                        </span>
                                        <span><i class="far fa-comments"></i> <a href="{{ route('front.blog.show', $blog->slug) }}#comment">{{ $blog->comments()->count() }} {{ \Illuminate\Support\Str::plural("Commentaire", $blog->comments()->count()) }}</a></span>
                                        <span class="d-block mt-2"><a href="{{ route('front.blog.show', $blog->slug) }}" class="btn btn-xs btn-light text-1 text-uppercase">En savoir plus...</a></span>
                                    </div>

                                </div>
                            </article>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
        <div class="row pt-4 pb-2">
            <div class="col">
                <div class="overflow-hidden mb-3">
                    <h2 class="font-weight-bold text-8 mb-0 appear-animation animated maskUp appear-animation-visible" data-appear-animation="maskUp" style="animation-delay: 100ms;">
                        Derniers packages publiés
                    </h2>
                </div>
            </div>
        </div>
        <div class="row pt-4 pb-2">
            <div class="col">
                <div class="blog-posts">

                    <div class="row">
                        @foreach($downloads as $download)
                            <div class="col-md-4">
                                <article class="post post-medium border-0 pb-0 mb-5">
                                    <div class="post-image">
                                        <a href="{{ route('front.download.show', $download->slug) }}">
                                            @if($download->image)
                                                <img src="/storage/files/shares/download/{{ $download->image }}" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="">
                                            @else
                                                <img src="/storage/files/shares/download/placeholder.png" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="">
                                            @endif
                                        </a>
                                    </div>

                                    <div class="post-content">

                                        <h2 class="font-weight-semibold text-5 line-height-6 mt-3 mb-2"><a href="{{ route('front.download.show', $download->slug) }}">{{ $download->title }}</a></h2>
                                        <p>{{ $download->short_content }}</p>

                                        <div class="post-meta">
                                            <span><i class="far fa-user"></i> par <a href="#">Transport Fever France</a> </span>
                                            <span><i class="far fa-folder"></i> {{ $download->category->title }} - {{ $download->subcategory->title }}</span>
                                            <span><i class="far fa-comments"></i> <a href="{{ route('front.download.show', $download->slug) }}#comment">{{ $download->comments()->count() }} {{ \Illuminate\Support\Str::plural("Commentaire", $download->comments()->count()) }}</a></span>
                                            <span class="d-block mt-2"><a href="{{ route('front.download.show', $blog->slug) }}" class="btn btn-xs btn-light text-1 text-uppercase">En savoir plus...</a></span>
                                        </div>

                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section("script")
    <!-- Current Page Vendor and Views -->
    <script src="/front/assets/vendor/circle-flip-slideshow/js/jquery.flipshow.min.js"></script>
    <script src="/front/assets/vendor/nivo-slider/jquery.nivo.slider.min.js"></script>

    <!-- Current Page Vendor and Views -->
    <script src="/front/assets/vendor/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
    <script src="/front/assets/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
    <script src="/front/assets/vendor/circle-flip-slideshow/js/jquery.flipshow.min.js"></script>
    <script src="/front/assets/js/views/view.home.js"></script>
@endsection
