@extends("new_front.layouts.layout")
@section("style")

@endsection

@section("meta")
    <x-meta
        title="{{ $page->title }}"
        description="{{ config('app.name') }} - {{ $page->title }}"
        author="Transport Fever France"
        url="{{ route('page', $page->slug) }}"
    />
@endsection

@section("content")
    <section class="page-header page-header-modern bg-color-light-scale-1 page-header-md">
        <div class="container">
            <div class="row">

                <div class="col-md-12 align-self-center p-static order-2 text-center">

                    <h1 class="text-dark font-weight-bold text-8">{{ $page->title }}</h1>
                </div>

                <div class="col-md-12 align-self-center order-1">

                    <ul class="breadcrumb d-block text-center">
                        <li><a href="#">Acceuil</a></li>
                        <li class="active">{{ $page->title }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <hr class="m-0">

    <div class="container py-5 mt-3">

        <div class="row">
            <div class="col text-center">
                {!! $page->body !!}
            </div>
        </div>

    </div>
@endsection

@section("script")

@endsection
