@extends("front.layouts.layout")
@section("styles")
    <link href="{{ asset('/front/assets/plugins/custom/owl_carousel/dist/assets/owl.carousel.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/front/assets/plugins/custom/owl_carousel/dist/assets/owl.theme.default.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/front/css/owl.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section("bread")
@endsection

@section("content")
    <!-- Slider -->
    <div class="container-fluid">
        <div class="owl-carousel">
            @foreach($heros as $hero)
            <div class="owl-item-content" style="background: linear-gradient(rgba(0,0,0,.7),rgba(0,0,0,.7)), url('storage/files/shares/slider/{{ $hero->image }}') !important; background-size: cover;">
                <div class="row item-content">
                    <div class="col-4 item-img-container">
                        <img src="storage/files/shares/slider/{{ $hero->image }}" alt="" class="img-responsive" />
                    </div>
                    <div class="col-8 item-text-container">
                        <div class="title">{{ $hero->title }}</div>
                        <div class="subtitle">{{ $hero->short_content }}</div>
                        <button class="btn btn-outline-primary font-size-h3 px-10 py-5"><i class="flaticon flaticon-download-1 pulse pulse-primary"><span class="pulse-ring"></span></i> Télécharger ce mod </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="container-fluid mt-2">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">Dernières News</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($blogs as $blog)
                        <div class="col-4 mb-4">
                            <div class="card card-custom">
                                <img src="storage/files/shares/blog/{{ $blog->image }}" alt="{{ $blog->title }}" class="card-img-top">
                                <div class="card-body">
                                    <div class="card-title">
                                        <a href="{{ route('front.blog.show', $blog->slug) }}" class="h3 text-black">{{ $blog->title }}</a><br>
                                        @foreach($blog->categories as $category)
                                            <span class="label label-default label-pill label-inline mr-2">{{ $category->title }}</span>
                                        @endforeach
                                    </div>
                                    <div class="card-text">{!! $blog->short_content !!}</div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <span class="text-muted">Publier le {{ formatDateHour($blog->created_at) }}</span>
                                            </div>
                                            <div class="col-md-6 text-right text-muted">
                                                <a href="{{ \Jorenvh\Share\ShareFacade::page(route('front.blog.show', $blog->slug))->facebook()->getRawLinks() }}" class="btn btn-facebook btn-icon btn-xs" data-toggle="tooltip" data-theme="dark" title="Partager sur facebook"><i class="socicon-facebook"></i></a>
                                                <a href="{{ \Jorenvh\Share\ShareFacade::page(route('front.blog.show', $blog->slug))->twitter()->getRawLinks() }}" class="btn btn-twitter btn-icon btn-xs" data-toggle="tooltip" data-theme="dark" title="Partager sur twitter"><i class="socicon-twitter"></i></a>
                                                <a href="{{ route('front.blog.show', $blog->slug) }}#comments" class="btn btn-default btn-icon btn-xs" data-toggle="tooltip" data-theme="dark" title="{{ count($blog->validComments) }} {{ \Illuminate\Support\Str::plural('Commentaire', count($blog->validComments)) }}"><i class="flaticon-comment text-primary"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid mt-2">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">Derniers Packages</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($downloads as $download)
                            <div class="col-4 mb-4">
                                <div class="card card-custom">
                                    <img src="storage/files/shares/download/{{ $download->image }}" alt="{{ $download->title }}" class="card-img-top">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <a href="{{ route('front.download.show', $download->slug) }}" class="h3 text-black">{{ $download->title }}</a><br>
                                                    <span class="label label-default label-pill label-inline mr-2">{{ $download->category->title }}</span>
                                                    <span class="label label-default label-pill label-inline mr-2">{{ $download->subcategory->title }}</span>
                                                </div>
                                                <div class="col-md-2">
                                                    @if($download->provider == 'steam')
                                                        <a href="{{ $download->steam_link_package }}">
                                                            <div class="symbol symbol-20 symbol-lg-30 symbol-circle mr-3">
                                                                <img alt="Pic" src="storage/files/shares/core/icons/{{ \App\Helpers\Format::switchDownloadProvider($download->provider) }}"/>
                                                            </div>
                                                        </a>
                                                    @endif
                                                        @if($download->provider == 'tfnet')
                                                            <a href="{{ $download->tfnet_link_package }}">
                                                                <div class="symbol symbol-20 symbol-lg-30 symbol-circle mr-3">
                                                                    <img alt="Pic" src="storage/files/shares/core/icons/{{ \App\Helpers\Format::switchDownloadProvider($download->provider) }}"/>
                                                                </div>
                                                            </a>
                                                        @endif
                                                        @if($download->provider == 'tf_france')
                                                            <a href="{{ $download->tf_france_link_package }}">
                                                                <div class="symbol symbol-20 symbol-lg-30 symbol-circle mr-3">
                                                                    <img alt="Pic" src="storage/files/shares/core/icons/{{ \App\Helpers\Format::switchDownloadProvider($download->provider) }}"/>
                                                                </div>
                                                            </a>
                                                        @endif
                                                        @if($download->provider == 'null')
                                                            <a href="#">
                                                                <div class="symbol symbol-20 symbol-lg-30 symbol-circle mr-3">
                                                                    <img alt="Pic" src="storage/files/shares/core/icons/{{ \App\Helpers\Format::switchDownloadProvider($download->provider) }}"/>
                                                                </div>
                                                            </a>
                                                        @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-text">{!! $download->short_content !!}</div>
                                        <div class="card-footer">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <span class="text-muted">Publier le {{ formatDateHour($download->created_at) }}</span>
                                                </div>
                                                <div class="col-md-6 text-right text-muted">
                                                    <a href="#" class="btn btn-facebook btn-icon btn-xs" data-toggle="tooltip" data-theme="dark" title="Partager sur facebook"><i class="socicon-facebook"></i></a>
                                                    <a href="#" class="btn btn-twitter btn-icon btn-xs" data-toggle="tooltip" data-theme="dark" title="Partager sur twitter"><i class="socicon-twitter"></i></a>

                                                    <span class="label label-default label-pill label-inline">1 &nbsp;<i class="flaticon-comment text-primary"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script src="{{ asset('/front/assets/plugins/custom/owl_carousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('/front/js/index.js') }}"></script>
@endsection
