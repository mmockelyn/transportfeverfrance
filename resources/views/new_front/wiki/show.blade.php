@extends("new_front.layouts.layout")
@section("style")

@endsection

@section("meta")
    <x-meta
        title="{{ $wiki->title }}"
        description="{{ \Illuminate\Support\Str::limit($wiki->contents, 50, '') }}"
        author="Transport Fever France"
        url="{{ route('front.wiki.show', $wiki->slug) }}"
    />
@endsection

@section("content")
    <section class="page-header page-header-modern bg-color-light-scale-1 page-header-md">
        <div class="container">
            <div class="row">

                <div class="col-md-12 align-self-center p-static order-2 text-center">

                    <h1 class="text-dark font-weight-bold text-8">{{ $wiki->title }}</h1>
                </div>

                <div class="col-md-12 align-self-center order-1">

                    <ul class="breadcrumb d-block text-center">
                        <li><a href="#">Acceuil</a></li>
                        <li><a href="{{ route('front.wiki') }}">Wiki</a></li>
                        <li><a href="{{ route('front.wiki.category', $category->id) }}">{{ $category->title }}</a></li>
                        <li class="active">{{ $wiki->title }}</li>
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
                <h1 class="font-weight-bolder">{{ $wiki->title }}</h1>
                {!! $wiki->contents !!}
            </div>
        </div>
    </div>
@endsection

@section("script")

@endsection
