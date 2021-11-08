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
                    <small class="text-muted fs-7 fw-bold my-1 ms-1">Réseau Social</small>
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
    <!--begin::Accordion-->
    <div class="accordion" id="kt_accordion_1">
        <div class="accordion-item">
            <h2 class="accordion-header" id="kt_accordion_1_header_1">
                <button class="accordion-button fs-4 fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_1" aria-expanded="false" aria-controls="kt_accordion_1_body_1">
                    Configuration des Réseaux Sociaux
                </button>
            </h2>
            <div id="kt_accordion_1_body_1" class="accordion-collapse collapse" aria-labelledby="kt_accordion_1_header_1" data-bs-parent="#kt_accordion_1">
                <div class="accordion-body">
                    <form action="" id="form_edit_social_provider">
                        @foreach($follows as $follow)
                            <div class="mb-10">
                                <label for="exampleFormControlInput1" class="required form-label">{{ $follow->title }}</label>
                                <div class="input-group mb-5">
                                <span class="input-group-text" id="basic-addon1">
                                    <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                    <span class="svg-icon">
                                        <img src="/back/assets/media/svg/brand-logos/{{ $follow->icon }}.svg" width="24" height="24"/>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                    <input type="text" class="form-control" name="twitter" value="{{ $follow->href }}" aria-label="twitter" aria-describedby="basic-addon1"/>
                                </div>
                            </div>
                        @endforeach

                        <div class="text-end">
                            <button type="submit" class="btn btn-success">
                                <span class="indicator-label">Sauvegarder</span>
                                <span class="indicator-progress">Veuillez patienter...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow-sm mt-5">
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-header">
                <h3 class="card-title">Poster une news</h3>
                <div class="card-toolbar">
                    <button type="submit" class="btn btn-sm btn-success">
                        <span class="indicator-label">Poster la news</span>
                        <span class="indicator-progress">Veuillez patienter...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-2">
                        <!--begin::Option-->
                        <input type="checkbox" class="btn-check" name="providers" value="twitter" checked="checked"  id="kt_radio_buttons_2_option_1"/>
                        <label class="btn btn-outline btn-outline-dashed btn-outline-default p-7 d-flex align-items-center mb-5" for="kt_radio_buttons_2_option_1">
                            <!--begin::Svg Icon | path: icons/duotune/coding/cod001.svg-->
                            <span class="svg-icon svg-icon-4x me-4">
                                <img src="/back/assets/media/svg/brand-logos/twitter.svg" width="36" height="36"/>
                            </span>
                                                    <!--end::Svg Icon-->

                                                    <span class="d-block fw-bold text-start">
                                <span class="text-dark fw-bolder d-block fs-3">Twitter</span>
                                <span class="text-muted fw-bold fs-6">
                                    Poster une news sur twitter
                                </span>
                            </span>
                        </label>
                        <!--end::Option-->
                    </div>
                    <div class="col-2">
                        <!--begin::Option-->
                        <input type="checkbox" class="btn-check" name="providers" value="facebook" id="kt_radio_buttons_2_option_3"/>
                        <label class="btn btn-outline btn-outline-dashed btn-outline-default p-7 d-flex align-items-center mb-5" for="kt_radio_buttons_2_option_3">
                            <!--begin::Svg Icon | path: icons/duotune/coding/cod001.svg-->
                            <span class="svg-icon svg-icon-4x me-4">
                                <img src="/back/assets/media/svg/brand-logos/facebook.svg" width="36" height="36"/>
                            </span>
                                                    <!--end::Svg Icon-->

                                                    <span class="d-block fw-bold text-start">
                                <span class="text-dark fw-bolder d-block fs-3">Facebook</span>
                                <span class="text-muted fw-bold fs-6">
                                    Poster une news sur facebook
                                </span>
                            </span>
                        </label>
                        <!--end::Option-->
                    </div>
                    <div class="col-2">
                        <!--begin::Option-->
                        <input type="checkbox" class="btn-check" name="providers" value="instagram" id="kt_radio_buttons_2_option_4"/>
                        <label class="btn btn-outline btn-outline-dashed btn-outline-default p-7 d-flex align-items-center mb-5" for="kt_radio_buttons_2_option_4">
                            <!--begin::Svg Icon | path: icons/duotune/coding/cod001.svg-->
                            <span class="svg-icon svg-icon-4x me-4">
                                <img src="/back/assets/media/svg/brand-logos/instagram.svg" width="36" height="36"/>
                            </span>
                                                    <!--end::Svg Icon-->

                                                    <span class="d-block fw-bold text-start">
                                <span class="text-dark fw-bolder d-block fs-3">Instagram</span>
                                <span class="text-muted fw-bold fs-6">
                                    Poster une news sur Instagram
                                </span>
                            </span>
                        </label>
                        <!--end::Option-->
                    </div>
                    <div class="col-2">
                        <!--begin::Option-->
                        <input type="checkbox" class="btn-check" name="providers" value="discord" id="kt_radio_buttons_2_option_5"/>
                        <label class="btn btn-outline btn-outline-dashed btn-outline-default p-7 d-flex align-items-center mb-5" for="kt_radio_buttons_2_option_5">
                            <!--begin::Svg Icon | path: icons/duotune/coding/cod001.svg-->
                            <span class="svg-icon svg-icon-4x me-4">
                                <img src="/back/assets/media/svg/brand-logos/discord.svg" width="36" height="36"/>
                            </span>
                                                    <!--end::Svg Icon-->

                                                    <span class="d-block fw-bold text-start">
                                <span class="text-dark fw-bolder d-block fs-3">Discord</span>
                                <span class="text-muted fw-bold fs-6">
                                    Poster une news sur Discord
                                </span>
                            </span>
                        </label>
                        <!--end::Option-->
                    </div>
                    <div class="col-2">
                        <!--begin::Option-->
                        <input type="checkbox" class="btn-check" name="providers" value="steam" id="kt_radio_buttons_2_option_6"/>
                        <label class="btn btn-outline btn-outline-dashed btn-outline-default p-7 d-flex align-items-center mb-5" for="kt_radio_buttons_2_option_6">
                            <!--begin::Svg Icon | path: icons/duotune/coding/cod001.svg-->
                            <span class="svg-icon svg-icon-4x me-4">
                                <img src="/back/assets/media/svg/brand-logos/steam.svg" width="36" height="36"/>
                            </span>
                                                    <!--end::Svg Icon-->

                                                    <span class="d-block fw-bold text-start">
                                <span class="text-dark fw-bolder d-block fs-3">Steam</span>
                                <span class="text-muted fw-bold fs-6">
                                    Poster une news sur le Groupe Steam
                                </span>
                            </span>
                        </label>
                        <!--end::Option-->
                    </div>
                </div>
                <div class="mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">Titre</label>
                    <input type="text" class="form-control form-control-solid" name="title" />
                </div>
                <div class="mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">Contenue</label>
                    <textarea name="body" class="form-control" id="body" cols="30" rows="10"></textarea>
                </div>
                <div class="mb-10">
                    <!--begin::Image input-->
                    <label for="exampleFormControlInput1" class="form-label">Image</label><br>
                    <div class="image-input image-input-empty" data-kt-image-input="true" style="background-image: url(/back/assets/media/avatars/blank.png)">
                        <!--begin::Image preview wrapper-->
                        <div class="image-input-wrapper w-125px h-125px"></div>
                        <!--end::Image preview wrapper-->

                        <!--begin::Edit button-->
                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                               data-kt-image-input-action="change"
                               data-bs-toggle="tooltip"
                               data-bs-dismiss="click"
                               title="Changer l'image">
                            <i class="bi bi-pencil-fill fs-7"></i>

                            <!--begin::Inputs-->
                            <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                            <input type="hidden" name="avatar_remove" />
                            <!--end::Inputs-->
                        </label>
                        <!--end::Edit button-->

                        <!--begin::Cancel button-->
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                              data-kt-image-input-action="cancel"
                              data-bs-toggle="tooltip"
                              data-bs-dismiss="click"
                              title="Annuler l'image">
                             <i class="bi bi-x fs-2"></i>
                         </span>
                        <!--end::Cancel button-->

                        <!--begin::Remove button-->
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                              data-kt-image-input-action="remove"
                              data-bs-toggle="tooltip"
                              data-bs-dismiss="click"
                              title="Supprimer l'image">
                             <i class="bi bi-x fs-2"></i>
                         </span>
                        <!--end::Remove button-->
                    </div>
                    <!--end::Image input-->
                </div>
            </div>
        </form>
    </div>
    <!--end::Accordion-->
@endsection

@section("script")
    <script src="/back/js/settings/social/index.js"></script>
@endsection
