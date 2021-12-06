@extends("new_front.layouts.layout")
@section("style")

@endsection

@section("meta")
    <x-meta
        title="{{ $category->title }}"
        description="Articles de la catégorie {{ $category->title }}"
        author="Transport Fever France"
        url="{{ route('front.blog.category', $category->slug) }}"
    />
@endsection

@section("content")
    <section class="page-header page-header-modern bg-color-light-scale-1 page-header-md">
        <div class="container">
            <div class="row">

                <div class="col-md-12 align-self-center p-static order-2 text-center">

                    <h1 class="text-dark font-weight-bold text-8">{{ $category->title }}</h1>
                    <span class="sub-title text-dark">{!! $title !!}</span>
                </div>

                <div class="col-md-12 align-self-center order-1">

                    <ul class="breadcrumb d-block text-center">
                        <li><a href="#">Acceuil</a></li>
                        <li><a href="#">Blog</a></li>
                        <li class="active">{{ $category->title }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <div class="container py-4">

        <div class="row">
            <div class="col">
                <div class="blog-posts">
                    <div class="row">
                        @foreach($blogs as $blog)
                            <div class="col-md-4">
                                <article class="post post-medium border-0 pb-0 mb-5">
                                    <div class="post-image">
                                        <a href="{{ route('front.blog.show', $blog->slug) }}">
                                            @if($blog->image || \Illuminate\Support\Facades\File::exists('/storage/files/shares/blog/'.$blog->image) == true)
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

    </div>
@endsection

@section("script")

@endsection
