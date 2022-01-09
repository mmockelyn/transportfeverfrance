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
                <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Administration du wiki
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                    <!--end::Separator-->
                    <!--begin::Description-->
                    <small class="text-muted fs-7 fw-bold my-1 ms-1"><strong>Edition de l'Article: </strong>{{ $wiki->title }}</small>
                    <!--end::Description-->
                </h1>
                <!--end::Title-->
            </div>
            <!--end::Page title-->
            <div class="d-flex align-items-center py-1">
                <div class="mr-2 me-4">
                    <strong>Etat: </strong> {!! \App\Helpers\Format::AdminStateBlog($wiki->published) !!}
                </div>
                <!--begin::Button-->
                @if($wiki->published == 0)
                    <button class="publish btn btn-sm btn-success" data-provider="wiki" data-provider-id="{{ $wiki->id }}">Publier l'article</button>
                @else
                    <button class="unpublish btn btn-sm btn-danger" data-provider="wiki" data-provider-id="{{ $wiki->id }}">Dépublier l'article</button>
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
                <div class="card-body">
                    <div class="list-group">
                        <a href="{{ route('back.wiki.show', $wiki->id) }}" class="list-group-item list-group-item-action" aria-current="true">Vue Général</a>
                        <a href="{{ route('back.wiki.edit', $wiki->id) }}" class="list-group-item list-group-item-action active">Edition</a>
                        <a href="{{ route('front.wiki.show', $wiki->slug) }}" target="_blank" class="list-group-item list-group-item-action">Aperçu</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card shadow-sm">
                <form action="{{ route('back.wiki.update', $wiki->id) }}" method="post">
                    @csrf
                    @method("PUT")
                    <div class="card-body">
                        <div class="mb-2">
                            <label for="" class="form-label"><span class="required">Titre de l'article</span> </label>
                            <input type="text" class="form-control" name="title" value="{{ $wiki->title }}" required/>
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label"><span class="required">Description</span> </label>
                            <textarea name="contents" id="content" class="form-control" cols="30" rows="3">{!! $wiki->contents !!}</textarea>
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
    <script src="/back/js/wiki/edit.js"></script>
@endsection
