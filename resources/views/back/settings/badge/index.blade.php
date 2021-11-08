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
                    <small class="text-muted fs-7 fw-bold my-1 ms-1">Gestion des badges</small>
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
    <!--begin::Alert-->
    <div class="alert alert-dismissible bg-primary d-flex flex-column flex-sm-row p-5 mb-10">
        <!--begin::Icon-->
        <span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path opacity="0.3" d="M14 3V20H2V3C2 2.4 2.4 2 3 2H13C13.6 2 14 2.4 14 3ZM11 13V11C11 9.7 10.2 8.59995 9 8.19995V7C9 6.4 8.6 6 8 6C7.4 6 7 6.4 7 7V8.19995C5.8 8.59995 5 9.7 5 11V13C5 13.6 4.6 14 4 14V15C4 15.6 4.4 16 5 16H11C11.6 16 12 15.6 12 15V14C11.4 14 11 13.6 11 13Z" fill="black"/>
                <path d="M2 20H14V21C14 21.6 13.6 22 13 22H3C2.4 22 2 21.6 2 21V20ZM9 3V2H7V3C7 3.6 7.4 4 8 4C8.6 4 9 3.6 9 3ZM6.5 16C6.5 16.8 7.2 17.5 8 17.5C8.8 17.5 9.5 16.8 9.5 16H6.5ZM21.7 12C21.7 11.4 21.3 11 20.7 11H17.6C17 11 16.6 11.4 16.6 12C16.6 12.6 17 13 17.6 13H20.7C21.2 13 21.7 12.6 21.7 12ZM17 8C16.6 8 16.2 7.80002 16.1 7.40002C15.9 6.90002 16.1 6.29998 16.6 6.09998L19.1 5C19.6 4.8 20.2 5 20.4 5.5C20.6 6 20.4 6.60005 19.9 6.80005L17.4 7.90002C17.3 8.00002 17.1 8 17 8ZM19.5 19.1C19.4 19.1 19.2 19.1 19.1 19L16.6 17.9C16.1 17.7 15.9 17.1 16.1 16.6C16.3 16.1 16.9 15.9 17.4 16.1L19.9 17.2C20.4 17.4 20.6 18 20.4 18.5C20.2 18.9 19.9 19.1 19.5 19.1Z" fill="black"/>
            </svg>
        </span>
        <!--end::Icon-->

        <!--begin::Wrapper-->
        <div class="d-flex flex-column text-light pe-0 pe-sm-10">
            <!--begin::Title-->
            <h4 class="mb-2 light">Information</h4>
            <!--end::Title-->

            <!--begin::Content-->
            <span>Pour soumettre un nouveau badges, veuillez en faire la demande directement par discord Section 'Site TpFF'</span>
            <!--end::Content-->
        </div>
        <!--end::Wrapper-->

        <!--begin::Close-->
        <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
            <span class="svg-icon svg-icon-2x svg-icon-light">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
					<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
					<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
				</svg>
            </span>
        </button>
        <!--end::Close-->
    </div>
    <!--end::Alert-->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Mes Badges</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-3 text-center mb-8">
                    <div class="symbol symbol-150 symbol-circle">
                        <img alt="Pic" src="/storage/files/shares/badges/newuser.png">
                    </div>
                    <div class="font-size-h4 fw-bold text-center text-muted">Nouveau</div>
                    <div class="font-size-h6 text-center text-muted">Bienvenue sur TF France</div>
                </div>
                <div class="col-3 text-center mb-8">
                    <div class="symbol symbol-150 symbol-circle">
                        <img alt="Pic" src="/storage/files/shares/badges/comments-10.png">
                    </div>
                    <div class="font-size-h4 fw-bold text-center text-muted">Timide</div>
                    <div class="font-size-h6 text-center text-muted">Vous avez poster 10 commentaires</div>
                </div>
                <div class="col-3 text-center mb-8">
                    <div class="symbol symbol-150 symbol-circle">
                        <img alt="Pic" src="/storage/files/shares/badges/comments-50.png">
                    </div>
                    <div class="font-size-h4 fw-bold text-center text-muted">Bavard</div>
                    <div class="font-size-h6 text-center text-muted">Vous avez poster 50 commentaires</div>
                </div>
                <div class="col-3 text-center mb-8">
                    <div class="symbol symbol-150 symbol-circle">
                        <img alt="Pic" src="/storage/files/shares/badges/comments-100.png">
                    </div>
                    <div class="font-size-h4 fw-bold text-center text-muted">Pipelette</div>
                    <div class="font-size-h6 text-center text-muted">Vous avez poster 100 commentaires</div>
                </div>
                <div class="col-3 text-center mb-8">
                    <div class="symbol symbol-150 symbol-circle">
                        <img alt="Pic" src="/storage/files/shares/badges/ages-1.png">
                    </div>
                    <div class="font-size-h4 fw-bold text-center text-muted">Jeunot</div>
                    <div class="font-size-h6 text-center text-muted">Inscrit depuis 1 an</div>
                </div>
                <div class="col-3 text-center mb-8">
                    <div class="symbol symbol-150 symbol-circle">
                        <img alt="Pic" src="/storage/files/shares/badges/ages-2.png">
                    </div>
                    <div class="font-size-h4 fw-bold text-center text-muted">Habitué</div>
                    <div class="font-size-h6 text-center text-muted">Inscrit depuis 2 an</div>
                </div>
                <div class="col-3 text-center mb-8">
                    <div class="symbol symbol-150 symbol-circle">
                        <img alt="Pic" src="/storage/files/shares/badges/ages-3.png">
                    </div>
                    <div class="font-size-h4 fw-bold text-center text-muted">Ancien</div>
                    <div class="font-size-h6 text-center text-muted">Inscrit depuis 3 an</div>
                </div>
                <div class="col-3 text-center mb-8">
                    <div class="symbol symbol-150 symbol-circle">
                        <img alt="Pic" src="/storage/files/shares/badges/train.png">
                    </div>
                    <div class="font-size-h4 fw-bold text-center text-muted">Curieux</div>
                    <div class="font-size-h6 text-center text-muted">Vous avez trouver le train de Transport Fever France</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script src="/back/js/settings/badge/index.js"></script>
@endsection
