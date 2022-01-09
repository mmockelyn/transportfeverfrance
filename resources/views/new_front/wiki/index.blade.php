@extends("new_front.layouts.layout")
@section("style")

@endsection

@section("meta")
    <x-meta
        title="Tous les articles du wiki"
        author="Transport Fever France"
        url="{{ route('front.wiki') }}"
    />
@endsection

@section("content")
    <section class="page-header page-header-modern bg-color-light-scale-1 page-header-md">
        <div class="container">
            <div class="row">

                <div class="col-md-12 align-self-center p-static order-2 text-center">

                    <h1 class="text-dark font-weight-bold text-8">Tous les articles du wiki</h1>
                </div>

                <div class="col-md-12 align-self-center order-1">

                    <ul class="breadcrumb d-block text-center">
                        <li><a href="#">Acceuil</a></li>
                        <li class="active">Wiki</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <div class="container py-4">
        <div class="row">
            <div class="col-3">
                <h4 class="font-weight-bold">Catégorie</h4>
                <ul class="nav nav-list flex-column mb-5">
                    <li class="nav-item"><a class="nav-link {{ currentRouteMailbox('front.wiki') }}" href="{{ route('front.wiki') }}">Tous ({{ \App\Models\Wiki\Wiki::query()->count() }})</a></li>
                    @foreach($wiki_categories as $category)
                        <li class="nav-item"><a class="nav-link {{ currentRouteMailbox('front.wiki.category') }}" href="{{ route('front.wiki.category', $category->id) }}">{{ $category->title }} ({{ $category->wikis()->count() }})</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-9">
                <ul class="simple-post-list m-0">
                    @foreach(\App\Models\Wiki\Wiki::where('published', 1)->get() as $wiki)
                    <li>
                        <div class="post-info">
                            <a href="{{ route('front.wiki.show', $wiki->slug) }}">{{ $wiki->title }}</a>
                            <p>{{ \Illuminate\Support\Str::limit($wiki->contents, 200, '...') }}</p>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection

@section("script")

@endsection
