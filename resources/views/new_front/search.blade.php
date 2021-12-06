@extends("new_front.layouts.layout")
@section("style")

@endsection

@section("meta")

@endsection

@section("content")
    <section class="page-header page-header-modern page-header page-header-modern bg-color-primary page-header-md m-0">
        <div class="container">
            <div class="row">

                <div class="col-md-12 align-self-center p-static order-2 text-center">

                    <h1 class="text-light text-10"><strong>Recherche</strong></h1>
                    <span class="sub-title text-light">{{ $count }} résultat pour le terme: <strong>{{ $search }}</strong></span>
                </div>

                <div class="col-md-12 align-self-center order-1">

                    <ul class="breadcrumb d-block text-center breadcrumb-light">
                        <li><a href="#">Acceuil</a></li>
                        <li class="active">Rechercher</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <hr class="m-0">

    <div class="container py-5 mt-3">

        <div class="row">
            <div class="col">
                <h2 class="font-weight-normal text-7 mb-0">Affichage des résultats pour <strong class="font-weight-extra-bold">{{ $search }}</strong></h2>
                <p class="lead mb-0">{{ $count }} résultats trouvées.</p>
            </div>
        </div>
        <div class="row">
            <div class="col pt-2 mt-1">
                <hr class="my-4">
            </div>
        </div>
        @if($count != 0)
            <h3 class="font-weight-bolder">Articles du blog</h3>
            <div class="row">
                <div class="col">

                    <ul class="simple-post-list m-0">
                        @foreach($blogs as $blog)
                        <li>
                            <div class="post-info">
                                <a href="{{ route('front.blog.show', $blog->slug) }}">{{ $blog->title }}</a>
                                <div class="post-meta">
                                    <span class="text-dark text-uppercase font-weight-semibold">{{ $blog->category->title }}</span> |
                                    {{ $blog->updated_at->format("d/m/Y") }}
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col pt-2 mt-1">
                    <hr class="my-4">
                </div>
            </div>
            <h3 class="font-weight-bolder">Téléchargement</h3>
            <div class="row">
                <div class="col">

                    <ul class="simple-post-list m-0">
                        @foreach($downloads as $download)
                            <li>
                                <div class="post-info">
                                    <a href="{{ route('front.download.show', $download->slug) }}">{{ $download->title }}</a>
                                    <div class="post-meta">
                                        <span class="text-dark text-uppercase font-weight-semibold">{{ $download->category->title }} - {{ $download->subcategory->title }}</span> |
                                        {{ $download->updated_at->format("d/m/Y") }}
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </div>

    <section class="section section-default border-0 m-0">
        <div class="container py-4">

            <div class="row pb-4">
                <div class="col">
                    <form action="/api/search" method="get">
                        <div class="input-group input-group-lg">
                            <input class="form-control" placeholder="Rechercher..." name="search" id="s" type="text">
                            <span class="input-group-append">
								<button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
							</span>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
@endsection

@section("script")

@endsection
