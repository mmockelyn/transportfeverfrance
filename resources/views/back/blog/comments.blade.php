@extends("back.layouts.layout")

@section("style")
    <link href="/back/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>
@endsection

@section("bread")
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-place="true" data-kt-place-mode="prepend" data-kt-place-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center me-3 flex-wrap mb-5 mb-lg-0 lh-1">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Administration du blog
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                    <!--end::Separator-->
                    <!--begin::Description-->
                    <small class="text-muted fs-7 fw-bold my-1 ms-1"><strong>Commentaires de l'Article: </strong>{{ $blog->title }}</small>
                    <!--end::Description-->
                </h1>
                <!--end::Title-->
            </div>
            <!--end::Page title-->
            <div class="d-flex align-items-center py-1">
                <div class="mr-2 me-4">
                    <strong>Etat: </strong> {!! \App\Helpers\Format::AdminStateBlog($blog->active) !!}
                </div>
                <!--begin::Button-->
                @if($blog->active == 0)
                    <button class="publish btn btn-sm btn-success" data-provider="blog" data-provider-id="{{ $blog->id }}">Publier l'article</button>
                @else
                    <button class="unpublish btn btn-sm btn-danger" data-provider="blog" data-provider-id="{{ $blog->id }}">Dépublier l'article</button>
                @endif
                <!--end::Button-->
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
@endsection

@section("content")
<div class="container-fluid">
    <div class="row">
        <div class="col-4">
            <div class="card shadow-sm">
                @if($blog->image != null)
                    <img src="/storage/files/shares/blog/{{ $blog->image }}" alt="" class="card-img-top">
                @else
                    <img src="/storage/files/shares/blog/img01.jpg" alt="" class="card-img-top">
                @endif
                <div class="card-body">
                    <div class="list-group">
                        <a href="{{ route('back.blog.show', $blog->id) }}" class="list-group-item list-group-item-action" aria-current="true">Vue Général</a>
                        <a href="{{ route('back.blog.edit', $blog->id) }}" class="list-group-item list-group-item-action ">Edition</a>
                        <a href="{{ route('back.blog.comments', $blog->id) }}" class="list-group-item list-group-item-action active">Commentaires</a>
                        <a href="{{ route('front.blog.show', $blog->slug) }}" class="list-group-item list-group-item-action">Aperçu</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Liste des commentaires ({{ $blog->comments->count() }})</h3>
                </div>
                <div class="card-body">
                    <table class="table table-row-bordered gy-5" id="liste_blog_comment">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Utilisateur</th>
                                <th>Commentaire</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($blog->comments as $comment)
                                <tr>
                                    <td>{{ $comment->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center mb-7">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-50px me-5">
                                                <img src="/metronic8/demo1/assets/media/avatars/150-1.jpg" class="" alt="">
                                            </div>
                                            <!--end::Avatar-->
                                            <!--begin::Text-->
                                            <div class="flex-grow-1">
                                                <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">{{ $comment->user->name }}</a>
                                                <span class="text-muted d-block fw-bold">{{ \App\Helpers\Format::formatUserGroup($comment->user->group) }}</span>
                                            </div>
                                            <!--end::Text-->
                                        </div>
                                    </td>
                                    <td>
                                        {{ $comment->content }}
                                    </td>
                                    <td>{{ $comment->updated_at->format('d/m/Y à H:i') }}</td>
                                    <td>
                                        <button class="btn btn-danger btn-icon btn-sm deleteComment" data-bs-toggle="tooltip" title="Supprimer le commentaire" data-blog="{{ $blog->id }}" data-comment="{{ $comment->id }}"><i class="fas fa-trash"></i> </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("script")
    <script src="/back/assets/plugins/custom/tinymce/tinymce.bundle.js"></script>
    <script src="/back/assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <script src="/back/js/blog/comments.js"></script>
@endsection
