@extends("back.layouts.layout")

@section("style")
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
                    <small class="text-muted fs-7 fw-bold my-1 ms-1"><strong>Edition de l'Article: </strong>{{ $blog->title }}</small>
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
                        <a href="{{ route('back.blog.edit', $blog->id) }}" class="list-group-item list-group-item-action active">Edition</a>
                        <a href="{{ route('back.blog.comments', $blog->id) }}" class="list-group-item list-group-item-action">Commentaires</a>
                        <a href="{{ route('front.blog.show', $blog->slug) }}" class="list-group-item list-group-item-action">Aperçu</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card shadow-sm">
                <form action="{{ route('back.blog.update', $blog->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="card-body">
                        <div class="mb-2">
                            <label for="" class="form-label"><span class="required">Titre de l'article</span> </label>
                            <input type="text" class="form-control" name="title" value="{{ $blog->title }}" required/>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">
                                <span>Tags</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Veuillez spécifier une liste de tags (Touche tabulation pour ajouter)" aria-label="Specify your unique app name"></i>
                            </label>
                            <input class="form-control" name="meta_keywords" id="meta_keywords" value="{{ $blog->meta_keywords }}"/>
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label"><span class="required">Courte description</span> </label>
                            <textarea name="short_content" id="short_content" class="form-control" cols="30" rows="3">{{ $blog->short_content }}</textarea>
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label"><span class="required">Description</span> </label>
                            <textarea name="contents" id="content" class="form-control" cols="30" rows="3">{!! $blog->content !!}</textarea>
                        </div>
                        <div class="mb-2 mt-5">
                            <div class="row">
                                <div class="col-3">
                                    <div class="image-input image-input-empty" data-kt-image-input="true"
                                         style="background-image: @if($blog->image) url(/storage/files/shares/blog/{{ $blog->image }}) @else url(/back/assets/media/avatars/blank.png) @endif; background-position: center">
                                        <!--begin::Image preview wrapper-->
                                        <div class="image-input-wrapper w-700px h-230px"></div>
                                        <!--end::Image preview wrapper-->

                                        <!--begin::Edit button-->
                                        <label
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                            data-kt-image-input-action="change"
                                            data-bs-toggle="tooltip"
                                            data-bs-dismiss="click"
                                            title="Changer l'image de présentation">
                                            <i class="bi bi-pencil-fill fs-7"></i>

                                            <!--begin::Inputs-->
                                            <input type="file" name="image" accept=".png, .jpg, .jpeg" value="{{ old("image") }}"/>
                                            <input type="hidden" name="avatar_remove"/>
                                            <!--end::Inputs-->
                                        </label>
                                        <!--end::Edit button-->

                                        <!--begin::Cancel button-->
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                              data-kt-image-input-action="cancel"
                                              data-bs-toggle="tooltip"
                                              data-bs-dismiss="click"
                                              title="Cancel avatar">
                                 <i class="bi bi-x fs-2"></i>
                             </span>
                                        <!--end::Cancel button-->

                                        <!--begin::Remove button-->
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                              data-kt-image-input-action="remove"
                                              data-bs-toggle="tooltip"
                                              data-bs-dismiss="click"
                                              title="Remove avatar">
                                 <i class="bi bi-x fs-2"></i>
                             </span>
                                        <!--end::Remove button-->
                                    </div>
                                    <!--end::Image input-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section("script")
    <script src="/back/assets/plugins/custom/tinymce/tinymce.bundle.js"></script>
    <script src="/back/js/blog/edit.js"></script>
@endsection
