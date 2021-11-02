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
                <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Configuration
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                    <!--end::Separator-->
                    <!--begin::Description-->
                    <small class="text-muted fs-7 fw-bold my-1 ms-1">Configuration du site</small>
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
        <form id="form_edit_site" action="{{ route('back.settings.site.update') }}" method="POST">
            <div class="card-header">
                <h3 class="card-title">Configuration du site</h3>
                <div class="card-toolbar">
                    <button type="submit" class="btn btn-success btn-sm">
                        <span class="indicator-label">Valider</span>
                        <span class="indicator-progress">Veuillez Patienter...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">Nom du site</label>
                    <input type="text" class="form-control form-control-solid" name="name" value="{{ $site->name }}"/>
                </div>
                <div class="mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">Lien de la page facebook</label>
                    <input type="text" class="form-control form-control-solid" name="facebook_link" value="{{ $site->facebook_link }}"/>
                </div>
                <div class="mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">Lien de la page twitter</label>
                    <input type="text" class="form-control form-control-solid" name="twitter_link" value="{{ $site->twitter_link }}"/>
                </div>
                <div class="mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">Lien de la page Instagram</label>
                    <input type="text" class="form-control form-control-solid" name="insta_link" value="{{ $site->insta_link }}"/>
                </div>
                <div class="mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">Lien de l'invitation Discord'</label>
                    <input type="text" class="form-control form-control-solid" name="discord_link" value="{{ $site->discord_link }}"/>
                </div>
                <div class="mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">Lien de la page steam</label>
                    <input type="text" class="form-control form-control-solid" name="steam_link" value="{{ $site->steam_link }}"/>
                </div>
            </div>
        </form>
    </div>
@endsection

@section("script")
    <script src="/back/js/settings/site/index.js"></script>
@endsection
