@extends("back.layouts.layout")

@section("style")

@endsection

@section("bread")
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-place="true" data-kt-place-mode="prepend"
                 data-kt-place-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                 class="page-title d-flex align-items-center me-3 flex-wrap mb-5 mb-lg-0 lh-1">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Administration du wiki
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                    <!--end::Separator-->
                    <!--begin::Description-->
                    <small class="text-muted fs-7 fw-bold my-1 ms-1">Création d'un article</small>
                    <!--end::Description-->
                </h1>
                <!--end::Title-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
@endsection

@section("content")
    <div class="container-fluid">
        <div class="card shadow-sm">
            <form action="{{ route('back.wiki.store') }}" method="post">
                @csrf
                <div class="card-header">
                    <h3 class="card-title">Nouvelle Article de wiki</h3>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <label for="" class="form-label"><span class="required">Titre de l'article</span> </label>
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}" required/>
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label"><span class="required">Catégorie</span> </label>
                        <select class="form-select form-select-solid" data-control="select2"
                                data-placeholder="Selectionner une catégorie" name="wiki_category_id" data-allow-clear="true">
                            <option></option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label"><span class="required">Description</span> </label>
                        <textarea name="contents" id="content" class="form-control" cols="30" rows="3">{{ old("contents") }}</textarea>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section("script")
    <script src="/back/assets/plugins/custom/tinymce/tinymce.bundle.js"></script>
    <script src="/back/js/wiki/create.js"></script>
@endsection
