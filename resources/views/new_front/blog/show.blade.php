@extends("new_front.layouts.layout")
@section("style")

@endsection

@section("meta")
    <x-meta
        title="{{ $blog->title }}"
        description="{{ $blog->short_content }}"
        image="/storage/files/shares/blog/{{ $blog->image }}"
        author="Transport Fever France"
        url="{{ route('front.blog.show', $blog->slug) }}"
    />
@endsection

@section("content")
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v3.1';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
    <section class="page-header page-header-modern page-header-background page-header-background-md parallax overlay overlay-color-dark overlay-show overlay-op-5 mt-0" data-plugin-parallax data-plugin-options="{'speed': 1.2}" data-image-src="/storage/files/shares/blog/{{ $blog->image }}">
        <div class="container">
            <div class="row">
                <div class="col-md-12 align-self-center p-static order-2 text-center">
                    <h1>{{ $blog->title }}</h1>
                </div>
                <div class="col-md-12 align-self-center order-1">
                    <ul class="breadcrumb breadcrumb-light d-block text-center">
                        <li><a href="#">Acceuil</a></li>
                        <li><a href="#">Blog</a></li>
                        @foreach($blog->categories as $category)
                            <li><a href="#">{{ $category->title }}</a></li>
                        @endforeach
                        <li class="active">{{ $blog->title }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <div class="container py-4">

        <div class="row">
            <div class="col-lg-3 order-lg-2">
                <aside class="sidebar">
                    <h5 class="font-weight-bold pt-4">Catégories</h5>
                    <ul class="nav nav-list flex-column mb-5">
                        @foreach(\App\Models\Blog\BlogCategory::all() as $category)
                        <li class="nav-item"><a class="nav-link" href="{{ route('front.blog.category', $category->slug) }}">{{ $category->title }} ({{ $category->blogs()->count() }})</a></li>
                        @endforeach
                    </ul>
                    <div class="tabs tabs-dark mb-4 pb-2">
                        <ul class="nav nav-tabs">
                            <li class="nav-item active"><a class="nav-link show active text-1 font-weight-bold text-uppercase" href="#popularPosts" data-toggle="tab">Populaires</a></li>
                            <li class="nav-item"><a class="nav-link text-1 font-weight-bold text-uppercase" href="#recentPosts" data-toggle="tab">Récents</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="popularPosts">
                                <ul class="simple-post-list">
                                    @foreach(\App\Models\Blog\Blog::query()->orderBy('vue', 'desc')->limit(3)->get() as $blog)
                                    <li>
                                        <div class="post-image">
                                            <div class="img-thumbnail img-thumbnail-no-borders d-block">
                                                <a href="{{ route('front.blog.show', $blog->slug) }}">
                                                    @if($blog->image)
                                                        <img src="/storage/files/shares/blog/{{ $blog->image }}" width="50" height="50" alt="">
                                                    @else
                                                        <img src="/storage/files/shares/blog/placeholder.jpg" width="50" height="50" alt="">
                                                    @endif
                                                </a>
                                            </div>
                                        </div>
                                        <div class="post-info">
                                            <a href="{{ route('front.blog.show', $blog->slug) }}">{{ $blog->title }}</a>
                                            <div class="post-meta">
                                                {{ $blog->updated_at->format('d/m/Y') }}
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="tab-pane" id="recentPosts">
                                <ul class="simple-post-list">
                                    @foreach(\App\Models\Blog\Blog::query()->orderBy('updated_at', 'asc')->limit(3)->get() as $blog)
                                        <li>
                                            <div class="post-image">
                                                <div class="img-thumbnail img-thumbnail-no-borders d-block">
                                                    <a href="{{ route('front.blog.show', $blog->slug) }}">
                                                        @if($blog->image)
                                                            <img src="/storage/files/shares/blog/{{ $blog->image }}" width="50" height="50" alt="">
                                                        @else
                                                            <img src="/storage/files/shares/blog/placeholder.jpg" width="50" height="50" alt="">
                                                        @endif
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="post-info">
                                                <a href="{{ route('front.blog.show', $blog->slug) }}">{{ $blog->title }}</a>
                                                <div class="post-meta">
                                                    {{ $blog->updated_at->format('d/m/Y') }}
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <h5 class="font-weight-bold pt-4">Derniers info de twitter</h5>
                    <div id="tweet" class="twitter mb-4" data-plugin-tweets data-plugin-options="{'username': 'T_FeverFR', 'count': 2}">
                        <p>Veuillez patientez....</p>
                    </div>
                    <h5 class="font-weight-bold pt-4 mb-2">Tags</h5>
                    <div class="mb-3 pb-1">
                        @foreach(\App\Models\Blog\BlogTag::all() as $tag)
                        <a href="#"><span class="badge badge-dark badge-sm badge-pill text-uppercase px-2 py-1 mr-1">{{ $tag->tag }}</span></a>
                        @endforeach
                    </div>
                    <h5 class="font-weight-bold pt-4">Retrouvez nous sur facebook</h5>
                    <div class="fb-page" data-href="{{ \App\Helpers\SiteHelper::getSiteInfo('facebook_link') }}" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true">
                        <blockquote cite="{{ \App\Helpers\SiteHelper::getSiteInfo('facebook_link') }}" class="fb-xfbml-parse-ignore">
                            <a href="{{ \App\Helpers\SiteHelper::getSiteInfo('facebook_link') }}">Okler Themes</a>
                        </blockquote>
                    </div>
                    <h5 class="font-weight-bold pt-4">Discord</h5>
                    <iframe src="https://discord.com/widget?id=709827298441822257&theme=dark" width="350" height="500" allowtransparency="true" frameborder="0" sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe>
                </aside>
            </div>
            <div class="col-lg-9 order-lg-1">
                <div class="blog-posts single-post">

                    <article class="post post-large blog-single-post border-0 m-0 p-0">
                        <div class="post-image ml-0">
                            <a href="#">
                                @if($blog->image)
                                    <img src="/storage/files/shares/blog/{{ $blog->image }}" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="" />
                                @else
                                    <img src="/storage/files/shares/blog/placeholder.jpg" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="" />
                                @endif
                            </a>
                        </div>

                        <div class="post-date ml-0">
                            <span class="day">{{ $blog->updated_at->format('d') }}</span>
                            <span class="month">{{ $blog->updated_at->formatLocalized('%b') }}</span>
                        </div>

                        <div class="post-content ml-0">

                            <h2 class="font-weight-bold"><a href="#">{{ $blog->title }}</a></h2>

                            <div class="post-meta">
                                <span><i class="far fa-user"></i> par <a href="#">Transport Fever France</a> </span>
                                <span><i class="far fa-folder"></i>
                                    @foreach($blog->categories as $category)
                                        <a href="{{ route('front.blog.category', $category->slug) }}">{{ $category->title }}</a>
                                    @endforeach
                                </span>
                                <span><i class="far fa-comments"></i> <a href="#">{{ $blog->comments()->count() }} {{ \Illuminate\Support\Str::plural("commentaire", $blog->comments()->count()) }}</a></span>
                            </div>
                            {!! $blog->content !!}
                            <div class="post-block mt-5 post-share">
                                <h4 class="mb-3">Partager cette article</h4>

                                <!-- AddThis Button BEGIN -->
                                <div class="addthis_toolbox addthis_default_style ">
                                    <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                                    <a class="addthis_button_tweet"></a>
                                    <a class="addthis_button_pinterest_pinit"></a>
                                    <a class="addthis_counter addthis_pill_style"></a>
                                </div>
                                <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-61ae202d5c843e76"></script>
                                <!-- AddThis Button END -->

                            </div>


                            <div id="comments" class="post-block mt-5 post-comments">
                                <h4 class="mb-3">{{ \Illuminate\Support\Str::plural("Commentaire", $blog->comments()->count()) }} ({{ $blog->comments()->count() }})</h4>

                                <ul class="comments">
                                    @foreach($blog->comments()->orderBy('updated_at', 'desc')->get() as $comment)
                                    <li>
                                        <div class="comment">
                                            <div class="img-thumbnail img-thumbnail-no-borders d-none d-sm-block">
                                                @if($comment->user->image)
                                                    <img class="avatar" alt="" src="/storage/files/shares/avatar/{{ $comment->user->image }}">
                                                @else
                                                    <img class="avatar" alt="" src="/storage/files/shares/avatar/placeholder.png">
                                                @endif
                                            </div>
                                            <div class="comment-block">
                                                <div class="comment-arrow"></div>
                                                <span class="comment-by">
													<strong>{{ $comment->user->name }}</strong>
                                                    @if(auth()->user()->id == $comment->user->id || auth()->user()->group == 1)
													<span class="float-right">
														<span>
                                                            <a href="#"><i class="fas fa-trash"></i> Supprimer</a>
                                                        </span>
													</span>
                                                    @endif
												</span>
                                                {!! $comment->content !!}
                                                <span class="date float-right">{{ $comment->updated_at->toDayDateTimeString() }}</span>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>

                            </div>

                            @auth()
                                <div class="post-block mt-5 post-leave-comment">
                                    <h4 class="mb-3">Laisser un commentaire</h4>

                                    <form class="contact-form p-4 rounded bg-color-grey" action="{{ route('front.blog.comment.store', $blog->id) }}" method="POST">
                                        <div class="p-2">
                                            <div class="form-row">
                                                <div class="form-group col">
                                                    <label class="required font-weight-bold text-dark">Commentaire</label>
                                                    <textarea maxlength="5000" data-msg-required="Veuillez entrer un message" rows="8" class="form-control" name="message" required></textarea>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col mb-0">
                                                    <input type="submit" value="Poster un commentaire" class="btn btn-primary btn-modern" data-loading-text="Loading...">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endauth

                        </div>
                    </article>

                </div>
            </div>
        </div>

    </div>
@endsection

@section("script")

@endsection
