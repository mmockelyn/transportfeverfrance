@extends("back.layouts.layout")

@section("style")
    <style>
        .ql-container {
            height: 350px;
        }
    </style>
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
                <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Configuration
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                    <!--end::Separator-->
                    <!--begin::Description-->
                    <small class="text-muted fs-7 fw-bold my-1 ms-1">Gestion CMS & Pages</small>
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                    <!--end::Separator-->
                    <!--begin::Description-->
                    <small class="text-muted fs-7 fw-bold my-1 ms-1">Création d'une page</small>
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
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">Création de la page</h3>
        </div>
        <form action="#" method="post" id="form_add_page">
            @csrf
            @method("POST")
            <div class="card-body">
                <div class="mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">Titre de la page</label>
                    <input type="text" class="form-control form-control-solid" name="title" required/>
                </div>
                <div class="mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">Contenue</label>
                    <div id="contents"></div>
                    <input type="hidden" name="over_content" id="over_content">
                </div>
            </div>
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-success">
                    <span class="indicator-label">Sauvegarder</span>
                    <span class="indicator-progress">Veuillez patienter...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
            </div>
        </form>
    </div>
@endsection

@section("script")
    <script src="/back/assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js"></script>
    <script src="/back/js/settings/pages/create.js"></script>
@endsection
