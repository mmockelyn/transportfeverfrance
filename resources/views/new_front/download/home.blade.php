@extends("new_front.layouts.layout")
@section("style")

@endsection

@section("meta")
    <x-meta
        title="{{ $category->title }}"
        description="Articles de la catégorie {{ $category->title }}"
        author="Transport Fever France"
        url="{{ route('front.download.category', $category->slug) }}"
    />
@endsection

@section("content")
    <section class="page-header page-header-modern bg-color-light-scale-1 page-header-md">
        <div class="container">
            <div class="row">

                <div class="col-md-12 align-self-center p-static order-2 text-center">

                    <h1 class="text-dark font-weight-bold text-8">Article de la catégorie {{ $category->title }}</h1>
                    <span class="sub-title text-dark">{{ $category->title }}</span>
                </div>

                <div class="col-md-12 align-self-center order-1">

                    <ul class="breadcrumb d-block text-center">
                        <li><a href="#">Acceuil</a></li>
                        <li><a href="#">Téléchargement</a></li>
                        <li class="active">{{ $category->title }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <div class="container py-4">
        <div class="row">
            @foreach($category->subcategories as $sub)
            <div class="col-md-6 col-sm-12">
                <a href="{{ route('front.download.category', $sub->id) }}"><img class="img-fluid" src="/storage/files/shares/download/subcategory/{{ $sub->image }}" alt=""></a>
            </div>
            @endforeach
        </div>
    </div>
@endsection

@section("script")

@endsection
