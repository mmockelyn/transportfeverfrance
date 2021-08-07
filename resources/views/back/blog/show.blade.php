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
                    <small class="text-muted fs-7 fw-bold my-1 ms-1"><strong>Article: </strong>{{ $blog->title }}</small>
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
                    <button class="publish btn btn-sm btn-success">Publier l'article</button>
                @else
                    <button class="unpublish btn btn-sm btn-danger">Dépublier l'article</button>
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
                        <a href="{{ route('back.blog.show', $blog->id) }}" class="list-group-item list-group-item-action active" aria-current="true">Vue Général</a>
                        <a href="{{ route('back.blog.edit', $blog->id) }}" class="list-group-item list-group-item-action">Edition</a>
                        <a href="{{ route('back.blog.comments', $blog->id) }}" class="list-group-item list-group-item-action">Commentaires</a>
                        <a href="{{ route('front.blog.show', $blog->slug) }}" class="list-group-item list-group-item-action">Aperçu</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8"></div>
    </div>
</div>
@endsection

@section("script")
    <script src="/back/assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <script src="/back/js/blog/show.js"></script>
@endsection
