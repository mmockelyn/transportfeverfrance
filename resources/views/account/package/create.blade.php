@extends("account.layouts.layout")
@section("style")
    <link rel="stylesheet" href="/vendor/markdown/dist/mdeditor.css">
@endsection

@section("content")
    <div class="row gy-5 g-xl-8 d-flex align-items-center mt-lg-0 mb-10 mb-lg-15">
        <!--begin::Col-->
        <div class="col-xl-6 d-flex align-items-center">
            <h1 class="fs-2hx">Mes Packages - Création</h1>

        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xl-6">
            <div class="d-flex flex-stack ps-lg-20">
                <a href="{{ url()->previous() }}" class="btn btn-icon btn-light-primary btn-nav h-50px w-50px h-lg-70px w-lg-70px ms-4" data-bs-toggle="tooltip" title="Retour">
                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs038.svg-->
                    <span class="svg-icon svg-icon-1 svg-icon-lg-2hx">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M9.60001 11H21C21.6 11 22 11.4 22 12C22 12.6 21.6 13 21 13H9.60001V11Z" fill="black"/>
                            <path opacity="0.3" d="M9.6 20V4L2.3 11.3C1.9 11.7 1.9 12.3 2.3 12.7L9.6 20Z" fill="black"/>
                        </svg>
					</span>
                    <!--end::Svg Icon-->
                </a>
                <a href="{{ route('account.dashboard') }}" class="btn btn-icon btn-outline btn-nav h-50px w-50px h-lg-70px w-lg-70px ms-2" data-bs-toggle="tooltip" title="Tableau de bord">
                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs038.svg-->
                    <span class="svg-icon svg-icon-1 svg-icon-lg-2hx">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M11 2.375L2 9.575V20.575C2 21.175 2.4 21.575 3 21.575H9C9.6 21.575 10 21.175 10 20.575V14.575C10 13.975 10.4 13.575 11 13.575H13C13.6 13.575 14 13.975 14 14.575V20.575C14 21.175 14.4 21.575 15 21.575H21C21.6 21.575 22 21.175 22 20.575V9.575L13 2.375C12.4 1.875 11.6 1.875 11 2.375Z" fill="black"/>
                        </svg>
					</span>
                    <!--end::Svg Icon-->
                </a>
                <a href="{{ route('account.profil') }}" class="btn btn-icon btn-outline btn-nav h-50px w-50px h-lg-70px w-lg-70px ms-2" data-bs-toggle="tooltip" title="Mon profil">
                    <!--begin::Svg Icon | path: icons/duotune/technology/teh008.svg-->
                    <span class="svg-icon svg-icon-1 svg-icon-lg-2hx">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="black"/>
                            <path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="black"/>
                        </svg>
					</span>
                    <!--end::Svg Icon-->
                </a>
                <a href="{{ route('account.badges') }}" class="btn btn-icon btn-outline btn-nav h-50px w-50px h-lg-70px w-lg-70px ms-2" data-bs-toggle="tooltip" title="Mes Badges">
                    <!--begin::Svg Icon | path: icons/duotune/art/art002.svg-->
                    <span class="svg-icon svg-icon-1 svg-icon-lg-2hx">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M11 6.5C11 9 9 11 6.5 11C4 11 2 9 2 6.5C2 4 4 2 6.5 2C9 2 11 4 11 6.5ZM17.5 2C15 2 13 4 13 6.5C13 9 15 11 17.5 11C20 11 22 9 22 6.5C22 4 20 2 17.5 2ZM6.5 13C4 13 2 15 2 17.5C2 20 4 22 6.5 22C9 22 11 20 11 17.5C11 15 9 13 6.5 13ZM17.5 13C15 13 13 15 13 17.5C13 20 15 22 17.5 22C20 22 22 20 22 17.5C22 15 20 13 17.5 13Z" fill="black"/>
                            <path d="M17.5 16C17.5 16 17.4 16 17.5 16L16.7 15.3C16.1 14.7 15.7 13.9 15.6 13.1C15.5 12.4 15.5 11.6 15.6 10.8C15.7 9.99999 16.1 9.19998 16.7 8.59998L17.4 7.90002H17.5C18.3 7.90002 19 7.20002 19 6.40002C19 5.60002 18.3 4.90002 17.5 4.90002C16.7 4.90002 16 5.60002 16 6.40002V6.5L15.3 7.20001C14.7 7.80001 13.9 8.19999 13.1 8.29999C12.4 8.39999 11.6 8.39999 10.8 8.29999C9.99999 8.19999 9.20001 7.80001 8.60001 7.20001L7.89999 6.5V6.40002C7.89999 5.60002 7.19999 4.90002 6.39999 4.90002C5.59999 4.90002 4.89999 5.60002 4.89999 6.40002C4.89999 7.20002 5.59999 7.90002 6.39999 7.90002H6.5L7.20001 8.59998C7.80001 9.19998 8.19999 9.99999 8.29999 10.8C8.39999 11.5 8.39999 12.3 8.29999 13.1C8.19999 13.9 7.80001 14.7 7.20001 15.3L6.5 16H6.39999C5.59999 16 4.89999 16.7 4.89999 17.5C4.89999 18.3 5.59999 19 6.39999 19C7.19999 19 7.89999 18.3 7.89999 17.5V17.4L8.60001 16.7C9.20001 16.1 9.99999 15.7 10.8 15.6C11.5 15.5 12.3 15.5 13.1 15.6C13.9 15.7 14.7 16.1 15.3 16.7L16 17.4V17.5C16 18.3 16.7 19 17.5 19C18.3 19 19 18.3 19 17.5C19 16.7 18.3 16 17.5 16Z" fill="black"/>
                        </svg>
					</span>
                    <!--end::Svg Icon-->
                </a>
                <a href="{{ route('account.notify') }}" class="btn btn-icon btn-outline btn-nav h-50px w-50px h-lg-70px w-lg-70px ms-2" data-bs-toggle="tooltip" title="Mes Notifications">
                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs042.svg-->
                    <span class="svg-icon svg-icon-1 svg-icon-lg-2hx">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M12 22C13.6569 22 15 20.6569 15 19C15 17.3431 13.6569 16 12 16C10.3431 16 9 17.3431 9 19C9 20.6569 10.3431 22 12 22Z" fill="black"/>
                            <path d="M19 15V18C19 18.6 18.6 19 18 19H6C5.4 19 5 18.6 5 18V15C6.1 15 7 14.1 7 13V10C7 7.6 8.7 5.6 11 5.1V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V5.1C15.3 5.6 17 7.6 17 10V13C17 14.1 17.9 15 19 15ZM11 10C11 9.4 11.4 9 12 9C12.6 9 13 8.6 13 8C13 7.4 12.6 7 12 7C10.3 7 9 8.3 9 10C9 10.6 9.4 11 10 11C10.6 11 11 10.6 11 10Z" fill="black"/>
                        </svg>
					</span>
                    <!--end::Svg Icon-->
                </a>
                <a href="{{ route('account.messagerie') }}" class="btn btn-icon btn-outline btn-nav h-50px w-50px h-lg-70px w-lg-70px ms-2" data-bs-toggle="tooltip" title="Ma Messagerie">
                    <!--begin::Svg Icon | path: icons/duotune/medicine/med005.svg-->
                    <span class="svg-icon svg-icon-1 svg-icon-lg-2hx">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z" fill="black"/>
                            <path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z" fill="black"/>
                        </svg>
					</span>
                    <!--end::Svg Icon-->
                </a>
                <a href="{{ route('account.packages') }}" class="btn btn-icon btn-outline btn-nav active h-50px w-50px h-lg-70px w-lg-70px ms-2" data-bs-toggle="tooltip" title="Mes Packages">
                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs036.svg-->
                    <span class="svg-icon svg-icon-1 svg-icon-lg-2hx">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M7 20.5L2 17.6V11.8L7 8.90002L12 11.8V17.6L7 20.5ZM21 20.8V18.5L19 17.3L17 18.5V20.8L19 22L21 20.8Z" fill="black"/>
                            <path d="M22 14.1V6L15 2L8 6V14.1L15 18.2L22 14.1Z" fill="black"/>
                        </svg>
					</span>
                    <!--end::Svg Icon-->
                </a>
                <a href="{{ route('account.project') }}" class="btn btn-icon btn-outline btn-nav h-50px w-50px h-lg-70px w-lg-70px ms-2" data-bs-toggle="tooltip" title="Mes Projets">
                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs036.svg-->
                    <span class="svg-icon svg-icon-1 svg-icon-lg-2hx">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="black"/>
                            <path d="M9.2 3H3C2.4 3 2 3.4 2 4V19C2 19.6 2.4 20 3 20H21C21.6 20 22 19.6 22 19V7C22 6.4 21.6 6 21 6H12L10.4 3.60001C10.2 3.20001 9.7 3 9.2 3Z" fill="black"/>
                        </svg>
					</span>
                    <!--end::Svg Icon-->
                </a>
                @if(auth()->user()->group == 1)
                    <a href="{{ route('dashboard') }}" class="btn btn-icon btn-outline btn-nav h-50px w-50px h-lg-70px w-lg-70px ms-2" data-bs-toggle="tooltip" title="Administration">
                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs036.svg-->
                        <span class="svg-icon svg-icon-1 svg-icon-lg-2hx">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3" d="M22.1 11.5V12.6C22.1 13.2 21.7 13.6 21.2 13.7L19.9 13.9C19.7 14.7 19.4 15.5 18.9 16.2L19.7 17.2999C20 17.6999 20 18.3999 19.6 18.7999L18.8 19.6C18.4 20 17.8 20 17.3 19.7L16.2 18.9C15.5 19.3 14.7 19.7 13.9 19.9L13.7 21.2C13.6 21.7 13.1 22.1 12.6 22.1H11.5C10.9 22.1 10.5 21.7 10.4 21.2L10.2 19.9C9.4 19.7 8.6 19.4 7.9 18.9L6.8 19.7C6.4 20 5.7 20 5.3 19.6L4.5 18.7999C4.1 18.3999 4.1 17.7999 4.4 17.2999L5.2 16.2C4.8 15.5 4.4 14.7 4.2 13.9L2.9 13.7C2.4 13.6 2 13.1 2 12.6V11.5C2 10.9 2.4 10.5 2.9 10.4L4.2 10.2C4.4 9.39995 4.7 8.60002 5.2 7.90002L4.4 6.79993C4.1 6.39993 4.1 5.69993 4.5 5.29993L5.3 4.5C5.7 4.1 6.3 4.10002 6.8 4.40002L7.9 5.19995C8.6 4.79995 9.4 4.39995 10.2 4.19995L10.4 2.90002C10.5 2.40002 11 2 11.5 2H12.6C13.2 2 13.6 2.40002 13.7 2.90002L13.9 4.19995C14.7 4.39995 15.5 4.69995 16.2 5.19995L17.3 4.40002C17.7 4.10002 18.4 4.1 18.8 4.5L19.6 5.29993C20 5.69993 20 6.29993 19.7 6.79993L18.9 7.90002C19.3 8.60002 19.7 9.39995 19.9 10.2L21.2 10.4C21.7 10.5 22.1 11 22.1 11.5ZM12.1 8.59998C10.2 8.59998 8.6 10.2 8.6 12.1C8.6 14 10.2 15.6 12.1 15.6C14 15.6 15.6 14 15.6 12.1C15.6 10.2 14 8.59998 12.1 8.59998Z" fill="black"/>
                                <path d="M17.1 12.1C17.1 14.9 14.9 17.1 12.1 17.1C9.30001 17.1 7.10001 14.9 7.10001 12.1C7.10001 9.29998 9.30001 7.09998 12.1 7.09998C14.9 7.09998 17.1 9.29998 17.1 12.1ZM12.1 10.1C11 10.1 10.1 11 10.1 12.1C10.1 13.2 11 14.1 12.1 14.1C13.2 14.1 14.1 13.2 14.1 12.1C14.1 11 13.2 10.1 12.1 10.1Z" fill="black"/>
                            </svg>
					    </span>
                        <!--end::Svg Icon-->
                    </a>
                @endif
            </div>
        </div>
        <!--end::Col-->
    </div>
    <form action="{{ route('account.packages.store') }}" method="post" class="mb-5" id="formAddPackage">
        <div class="card shadow-sm mb-10">
            <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse" data-bs-target="#provider">
                <h3 class="card-title">Provider</h3>
                <div class="card-toolbar rotate-180">
                <span class="svg-icon svg-icon-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M12.5657 11.3657L16.75 15.55C17.1642 15.9643 17.8358 15.9643 18.25 15.55C18.6642 15.1358 18.6642 14.4643 18.25 14.05L12.7071 8.50716C12.3166 8.11663 11.6834 8.11663 11.2929 8.50715L5.75 14.05C5.33579 14.4643 5.33579 15.1358 5.75 15.55C6.16421 15.9643 6.83579 15.9643 7.25 15.55L11.4343 11.3657C11.7467 11.0533 12.2533 11.0533 12.5657 11.3657Z" fill="black"/>
                    </svg>
                </span>
                </div>
            </div>
            <div id="provider" class="collapse show">
                <div class="card-body w-100">
                    <!--begin::Option-->
                    <input type="radio" class="btn-check" name="provider" value="0" checked="checked"  id="kt_radio_buttons_2_option_1"/>
                    <label class="btn btn-outline btn-outline-dashed btn-outline-default p-7 d-flex align-items-center mb-5" for="kt_radio_buttons_2_option_1">
                        <!--begin::Svg Icon | path: icons/duotune/coding/cod001.svg-->
                        <span class="svg-icon svg-icon-4x me-4">
                            <img src="/storage/files/shares/core/icons/null_icon.png" width="36" alt="">
                        </span>
                        <!--end::Svg Icon-->

                        <span class="d-block fw-bold text-start">
                            <span class="text-dark fw-bolder d-block fs-3">Aucun</span>
                            <span class="text-muted fw-bold fs-6">
                                Aucun provider, le packages n'est publier sur aucun service.
                            </span>
                        </span>
                    </label>
                    <!--end::Option-->

                    <!--begin::Option-->
                    <input type="radio" class="btn-check" name="provider" value="1" id="kt_radio_buttons_2_option_2"/>
                    <label class="btn btn-outline btn-outline-dashed btn-outline-default p-7 d-flex align-items-center mb-5" for="kt_radio_buttons_2_option_2">
                        <!--begin::Svg Icon | path: icons/duotune/coding/cod001.svg-->
                        <span class="svg-icon svg-icon-4x me-4">
                            <img src="/storage/files/shares/core/icons/steam_icon.png" width="36" alt="">
                        </span>
                        <!--end::Svg Icon-->

                        <span class="d-block fw-bold text-start">
                            <span class="text-dark fw-bolder d-block fs-3">Steam Workshop</span>
                            <span class="text-muted fw-bold fs-6">
                                Le package est ou va être publier sur le steam workshop.
                            </span>
                        </span>
                    </label>
                    <!--end::Option-->

                    <!--begin::Option-->
                    <input type="radio" class="btn-check" name="provider" value="2" id="kt_radio_buttons_2_option_3"/>
                    <label class="btn btn-outline btn-outline-dashed btn-outline-default p-7 d-flex align-items-center mb-5" for="kt_radio_buttons_2_option_3">
                        <!--begin::Svg Icon | path: icons/duotune/coding/cod001.svg-->
                        <span class="svg-icon svg-icon-4x me-4">
                            <img src="/storage/files/shares/core/icons/tf_net_icon.png" width="36" alt="">
                        </span>
                        <!--end::Svg Icon-->

                        <span class="d-block fw-bold text-start">
                            <span class="text-dark fw-bolder d-block fs-3">Transportfever.net</span>
                            <span class="text-muted fw-bold fs-6">
                                Le package est ou va être publier sur transportfever.net.
                            </span>
                        </span>
                    </label>
                    <!--end::Option-->

                    <!--begin::Option-->
                    <input type="radio" class="btn-check" name="provider" value="3" id="kt_radio_buttons_2_option_4"/>
                    <label class="btn btn-outline btn-outline-dashed btn-outline-default p-7 d-flex align-items-center mb-5" for="kt_radio_buttons_2_option_4">
                        <!--begin::Svg Icon | path: icons/duotune/coding/cod001.svg-->
                        <span class="svg-icon svg-icon-4x me-4">
                            <img src="/storage/files/shares/core/icons/tf_france_icon.png" width="36" alt="">
                        </span>
                        <!--end::Svg Icon-->

                        <span class="d-block fw-bold text-start">
                            <span class="text-dark fw-bolder d-block fs-3">Transport Fever France</span>
                            <span class="text-muted fw-bold fs-6">
                                Le package est ou va être publier sur Transport Fever France.
                            </span>
                        </span>
                    </label>
                    <!--end::Option-->
                </div>
            </div>
        </div>
        <div class="card shadow-sm mb-10">
            <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse" data-bs-target="#general">
                <h3 class="card-title">Information Général</h3>
                <div class="card-toolbar rotate-180">
                <span class="svg-icon svg-icon-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M12.5657 11.3657L16.75 15.55C17.1642 15.9643 17.8358 15.9643 18.25 15.55C18.6642 15.1358 18.6642 14.4643 18.25 14.05L12.7071 8.50716C12.3166 8.11663 11.6834 8.11663 11.2929 8.50715L5.75 14.05C5.33579 14.4643 5.33579 15.1358 5.75 15.55C6.16421 15.9643 6.83579 15.9643 7.25 15.55L11.4343 11.3657C11.7467 11.0533 12.2533 11.0533 12.5657 11.3657Z" fill="black"/>
                    </svg>
                </span>
                </div>
            </div>
            <div id="general" class="collapse show">
                <div class="card-body w-100">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-10">
                                <label for="exampleFormControlInput1" class="required form-label">Titre</label>
                                <input type="text" name="title" class="form-control form-control-solid form-control-lg" placeholder="Titre du mod"/>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-10">
                                <label for="exampleFormControlInput1" class="required form-label">Tags</label>
                                <input type="text" name="meta_keywords" class="form-control form-control-solid form-control-lg tagify"/>
                                <div class="fs-7 fw-bold text-muted">Tapez vos mots, suivi par <code>une virgule</code></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-10">
                                <label for="exampleFormControlInput1" class="required form-label">Catégorie</label>
                                <select title="exampleFormControlInput1" class="form-select category_id" name="category_id" data-control="select2" data-placeholder="Selectionner une catégorie">
                                    <option></option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-10">
                                <label for="exampleFormControlInput1" class="required form-label">Sous-catégorie</label>
                                <select title="exampleFormControlInput1" class="form-select subcategory_id" name="subcategory_id" data-control="select2" data-placeholder="Selectionner une sous catégorie" disabled>
                                    <option></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-10">
                        <label for="exampleFormControlInput1" class="required form-label">Courte description</label>
                        <textarea title="exampleFormControlInput1" class="form-control" name="short_content" id="short_content" rows="6" maxlength="255"></textarea>
                    </div>
                    <div class="mb-10">
                        <label for="exampleFormControlInput1" class="required form-label">Description</label>
                        <textarea title="exampleFormControlInput1" class="form-control" name="description" id="description" rows="6"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow-sm mb-10">
            <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse" data-bs-target="#mod">
                <h3 class="card-title">Donnée relative au mods</h3>
                <div class="card-toolbar rotate-180">
                <span class="svg-icon svg-icon-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M12.5657 11.3657L16.75 15.55C17.1642 15.9643 17.8358 15.9643 18.25 15.55C18.6642 15.1358 18.6642 14.4643 18.25 14.05L12.7071 8.50716C12.3166 8.11663 11.6834 8.11663 11.2929 8.50715L5.75 14.05C5.33579 14.4643 5.33579 15.1358 5.75 15.55C6.16421 15.9643 6.83579 15.9643 7.25 15.55L11.4343 11.3657C11.7467 11.0533 12.2533 11.0533 12.5657 11.3657Z" fill="black"/>
                    </svg>
                </span>
                </div>
            </div>
            <div id="mod" class="collapse show">
                <div class="card-body w-100">
                    <label class="col-form-label font-bold">Type d'Objet</label>
                    <div class="d-flex mb-10">
                        <div class="form-check form-check-custom form-check-solid me-10">
                            <input class="form-check-input h-30px w-30px" type="radio" name="type_feature" value="0" id="flexCheckbox30"/>
                            <label class="form-check-label" for="flexCheckbox30">
                                Véhicule
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid me-10">
                            <input class="form-check-input h-30px w-30px" type="radio" name="type_feature" value="1" id="flexCheckbox30"/>
                            <label class="form-check-label" for="flexCheckbox30">
                                Autre objet
                            </label>
                        </div>
                    </div>
                    <div id="vehicle" class="">
                        <hr class="mb-10">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="form-label">Type de véhicule</label>
                                    <input type="text" title="exampleFormControlInput1" name="type_vehicule" class="form-control form-control-solid form-control-lg" placeholder="Type de vehicule (Bus, train, avion, etc...)"/>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="form-label">Type de conduite</label>
                                    <select class="form-select" title="exampleFormControlInput1" data-control="select2" name="type_conduite" data-placeholder="Selectionner un type de conduite">
                                        <option></option>
                                        <option value="cheval">A Cheval</option>
                                        <option value="charbon">Charbon</option>
                                        <option value="gazole">Gazole</option>
                                        <option value="electrique">Electrique</option>
                                        <option value="hybride">Hybride</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="form-label">Vitesse</label>
                                    <input type="text" title="exampleFormControlInput1" name="vitesse" class="form-control form-control-solid form-control-lg" placeholder="Vitesse maximal du vehicule en Km/h"/>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="form-label">Performance</label>
                                    <input type="text" title="exampleFormControlInput1" name="performance" class="form-control form-control-solid form-control-lg" placeholder="Puissance en Kw"/>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="form-label">Effort de traction</label>
                                    <input type="text" title="exampleFormControlInput1" name="traction" class="form-control form-control-solid form-control-lg" placeholder="Effort continue en kN"/>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="form-label">Ecartement des voie en mm</label>
                                    <select title="exampleFormControlInput1" class="form-select" data-control="select2" name="ecartement" data-placeholder="Selectionner un ecartement">
                                        <option></option>
                                        <option value="1524">1524</option>
                                        <option value="1435">1435</option>
                                        <option value="1000">1000</option>
                                        <option value="900">900</option>
                                        <option value="785">785</option>
                                        <option value="760">760</option>
                                        <option value="750">750</option>
                                        <option value="700">700</option>
                                        <option value="600">600</option>
                                        <option value="381">381</option>
                                        <option value="0">Autre</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="form-label">Capacité</label>
                                    <input type="text" title="exampleFormControlInput1" name="capacity" class="form-control form-control-solid form-control-lg" placeholder="Capacité du matériel"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="mb-10">
                    <h2 class="title mb-4">Disponibilité</h2>
                    <div class="row mb-10">
                        <div class="col-md-4">
                            <div class="mb-10">
                                <label for="exampleFormControlInput1" class="form-label">Début</label>
                                <input type="text" title="exampleFormControlInput1" name="dispo_start" class="form-control form-control-solid form-control-lg maskingYear" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-10">
                                <label for="exampleFormControlInput1" class="form-label">Fin</label>
                                <input type="text" title="exampleFormControlInput1" name="dispo_end" class="form-control form-control-solid form-control-lg maskingYear" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-10">
                                <label for="exampleFormControlInput1" class="form-label">Pays ISO 3166</label>
                                <select title="exampleFormControlInput1" class="form-select" data-control="select2" name="pays" data-placeholder="Selectionner un pays">
                                    <option></option>
                                    <option value="AF">Afghanistan</option>
                                    <option value="AX">Åland Islands</option>
                                    <option value="AL">Albania</option>
                                    <option value="DZ">Algeria</option>
                                    <option value="AS">American Samoa</option>
                                    <option value="AD">Andorra</option>
                                    <option value="AO">Angola</option>
                                    <option value="AI">Anguilla</option>
                                    <option value="AQ">Antarctica</option>
                                    <option value="AG">Antigua and Barbuda</option>
                                    <option value="AR">Argentina</option>
                                    <option value="AM">Armenia</option>
                                    <option value="AW">Aruba</option>
                                    <option value="AU">Australia</option>
                                    <option value="AT">Austria</option>
                                    <option value="AZ">Azerbaijan</option>
                                    <option value="BS">Bahamas</option>
                                    <option value="BH">Bahrain</option>
                                    <option value="BD">Bangladesh</option>
                                    <option value="BB">Barbados</option>
                                    <option value="BY">Belarus</option>
                                    <option value="BE">Belgium</option>
                                    <option value="BZ">Belize</option>
                                    <option value="BJ">Benin</option>
                                    <option value="BM">Bermuda</option>
                                    <option value="BT">Bhutan</option>
                                    <option value="BO">Bolivia, Plurinational State of</option>
                                    <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                                    <option value="BA">Bosnia and Herzegovina</option>
                                    <option value="BW">Botswana</option>
                                    <option value="BV">Bouvet Island</option>
                                    <option value="BR">Brazil</option>
                                    <option value="IO">British Indian Ocean Territory</option>
                                    <option value="BN">Brunei Darussalam</option>
                                    <option value="BG">Bulgaria</option>
                                    <option value="BF">Burkina Faso</option>
                                    <option value="BI">Burundi</option>
                                    <option value="KH">Cambodia</option>
                                    <option value="CM">Cameroon</option>
                                    <option value="CA">Canada</option>
                                    <option value="CV">Cape Verde</option>
                                    <option value="KY">Cayman Islands</option>
                                    <option value="CF">Central African Republic</option>
                                    <option value="TD">Chad</option>
                                    <option value="CL">Chile</option>
                                    <option value="CN">China</option>
                                    <option value="CX">Christmas Island</option>
                                    <option value="CC">Cocos (Keeling) Islands</option>
                                    <option value="CO">Colombia</option>
                                    <option value="KM">Comoros</option>
                                    <option value="CG">Congo</option>
                                    <option value="CD">Congo, the Democratic Republic of the</option>
                                    <option value="CK">Cook Islands</option>
                                    <option value="CR">Costa Rica</option>
                                    <option value="CI">Côte d'Ivoire</option>
                                    <option value="HR">Croatia</option>
                                    <option value="CU">Cuba</option>
                                    <option value="CW">Curaçao</option>
                                    <option value="CY">Cyprus</option>
                                    <option value="CZ">Czech Republic</option>
                                    <option value="DK">Denmark</option>
                                    <option value="DJ">Djibouti</option>
                                    <option value="DM">Dominica</option>
                                    <option value="DO">Dominican Republic</option>
                                    <option value="EC">Ecuador</option>
                                    <option value="EG">Egypt</option>
                                    <option value="SV">El Salvador</option>
                                    <option value="GQ">Equatorial Guinea</option>
                                    <option value="ER">Eritrea</option>
                                    <option value="EE">Estonia</option>
                                    <option value="ET">Ethiopia</option>
                                    <option value="FK">Falkland Islands (Malvinas)</option>
                                    <option value="FO">Faroe Islands</option>
                                    <option value="FJ">Fiji</option>
                                    <option value="FI">Finland</option>
                                    <option value="FR">France</option>
                                    <option value="GF">French Guiana</option>
                                    <option value="PF">French Polynesia</option>
                                    <option value="TF">French Southern Territories</option>
                                    <option value="GA">Gabon</option>
                                    <option value="GM">Gambia</option>
                                    <option value="GE">Georgia</option>
                                    <option value="DE">Germany</option>
                                    <option value="GH">Ghana</option>
                                    <option value="GI">Gibraltar</option>
                                    <option value="GR">Greece</option>
                                    <option value="GL">Greenland</option>
                                    <option value="GD">Grenada</option>
                                    <option value="GP">Guadeloupe</option>
                                    <option value="GU">Guam</option>
                                    <option value="GT">Guatemala</option>
                                    <option value="GG">Guernsey</option>
                                    <option value="GN">Guinea</option>
                                    <option value="GW">Guinea-Bissau</option>
                                    <option value="GY">Guyana</option>
                                    <option value="HT">Haiti</option>
                                    <option value="HM">Heard Island and McDonald Islands</option>
                                    <option value="VA">Holy See (Vatican City State)</option>
                                    <option value="HN">Honduras</option>
                                    <option value="HK">Hong Kong</option>
                                    <option value="HU">Hungary</option>
                                    <option value="IS">Iceland</option>
                                    <option value="IN">India</option>
                                    <option value="ID">Indonesia</option>
                                    <option value="IR">Iran, Islamic Republic of</option>
                                    <option value="IQ">Iraq</option>
                                    <option value="IE">Ireland</option>
                                    <option value="IM">Isle of Man</option>
                                    <option value="IL">Israel</option>
                                    <option value="IT">Italy</option>
                                    <option value="JM">Jamaica</option>
                                    <option value="JP">Japan</option>
                                    <option value="JE">Jersey</option>
                                    <option value="JO">Jordan</option>
                                    <option value="KZ">Kazakhstan</option>
                                    <option value="KE">Kenya</option>
                                    <option value="KI">Kiribati</option>
                                    <option value="KP">Korea, Democratic People's Republic of</option>
                                    <option value="KR">Korea, Republic of</option>
                                    <option value="KW">Kuwait</option>
                                    <option value="KG">Kyrgyzstan</option>
                                    <option value="LA">Lao People's Democratic Republic</option>
                                    <option value="LV">Latvia</option>
                                    <option value="LB">Lebanon</option>
                                    <option value="LS">Lesotho</option>
                                    <option value="LR">Liberia</option>
                                    <option value="LY">Libya</option>
                                    <option value="LI">Liechtenstein</option>
                                    <option value="LT">Lithuania</option>
                                    <option value="LU">Luxembourg</option>
                                    <option value="MO">Macao</option>
                                    <option value="MK">Macedonia, the former Yugoslav Republic of</option>
                                    <option value="MG">Madagascar</option>
                                    <option value="MW">Malawi</option>
                                    <option value="MY">Malaysia</option>
                                    <option value="MV">Maldives</option>
                                    <option value="ML">Mali</option>
                                    <option value="MT">Malta</option>
                                    <option value="MH">Marshall Islands</option>
                                    <option value="MQ">Martinique</option>
                                    <option value="MR">Mauritania</option>
                                    <option value="MU">Mauritius</option>
                                    <option value="YT">Mayotte</option>
                                    <option value="MX">Mexico</option>
                                    <option value="FM">Micronesia, Federated States of</option>
                                    <option value="MD">Moldova, Republic of</option>
                                    <option value="MC">Monaco</option>
                                    <option value="MN">Mongolia</option>
                                    <option value="ME">Montenegro</option>
                                    <option value="MS">Montserrat</option>
                                    <option value="MA">Morocco</option>
                                    <option value="MZ">Mozambique</option>
                                    <option value="MM">Myanmar</option>
                                    <option value="NA">Namibia</option>
                                    <option value="NR">Nauru</option>
                                    <option value="NP">Nepal</option>
                                    <option value="NL">Netherlands</option>
                                    <option value="NC">New Caledonia</option>
                                    <option value="NZ">New Zealand</option>
                                    <option value="NI">Nicaragua</option>
                                    <option value="NE">Niger</option>
                                    <option value="NG">Nigeria</option>
                                    <option value="NU">Niue</option>
                                    <option value="NF">Norfolk Island</option>
                                    <option value="MP">Northern Mariana Islands</option>
                                    <option value="NO">Norway</option>
                                    <option value="OM">Oman</option>
                                    <option value="PK">Pakistan</option>
                                    <option value="PW">Palau</option>
                                    <option value="PS">Palestinian Territory, Occupied</option>
                                    <option value="PA">Panama</option>
                                    <option value="PG">Papua New Guinea</option>
                                    <option value="PY">Paraguay</option>
                                    <option value="PE">Peru</option>
                                    <option value="PH">Philippines</option>
                                    <option value="PN">Pitcairn</option>
                                    <option value="PL">Poland</option>
                                    <option value="PT">Portugal</option>
                                    <option value="PR">Puerto Rico</option>
                                    <option value="QA">Qatar</option>
                                    <option value="RE">Réunion</option>
                                    <option value="RO">Romania</option>
                                    <option value="RU">Russian Federation</option>
                                    <option value="RW">Rwanda</option>
                                    <option value="BL">Saint Barthélemy</option>
                                    <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                                    <option value="KN">Saint Kitts and Nevis</option>
                                    <option value="LC">Saint Lucia</option>
                                    <option value="MF">Saint Martin (French part)</option>
                                    <option value="PM">Saint Pierre and Miquelon</option>
                                    <option value="VC">Saint Vincent and the Grenadines</option>
                                    <option value="WS">Samoa</option>
                                    <option value="SM">San Marino</option>
                                    <option value="ST">Sao Tome and Principe</option>
                                    <option value="SA">Saudi Arabia</option>
                                    <option value="SN">Senegal</option>
                                    <option value="RS">Serbia</option>
                                    <option value="SC">Seychelles</option>
                                    <option value="SL">Sierra Leone</option>
                                    <option value="SG">Singapore</option>
                                    <option value="SX">Sint Maarten (Dutch part)</option>
                                    <option value="SK">Slovakia</option>
                                    <option value="SI">Slovenia</option>
                                    <option value="SB">Solomon Islands</option>
                                    <option value="SO">Somalia</option>
                                    <option value="ZA">South Africa</option>
                                    <option value="GS">South Georgia and the South Sandwich Islands</option>
                                    <option value="SS">South Sudan</option>
                                    <option value="ES">Spain</option>
                                    <option value="LK">Sri Lanka</option>
                                    <option value="SD">Sudan</option>
                                    <option value="SR">Suriname</option>
                                    <option value="SJ">Svalbard and Jan Mayen</option>
                                    <option value="SZ">Swaziland</option>
                                    <option value="SE">Sweden</option>
                                    <option value="CH">Switzerland</option>
                                    <option value="SY">Syrian Arab Republic</option>
                                    <option value="TW">Taiwan, Province of China</option>
                                    <option value="TJ">Tajikistan</option>
                                    <option value="TZ">Tanzania, United Republic of</option>
                                    <option value="TH">Thailand</option>
                                    <option value="TL">Timor-Leste</option>
                                    <option value="TG">Togo</option>
                                    <option value="TK">Tokelau</option>
                                    <option value="TO">Tonga</option>
                                    <option value="TT">Trinidad and Tobago</option>
                                    <option value="TN">Tunisia</option>
                                    <option value="TR">Turkey</option>
                                    <option value="TM">Turkmenistan</option>
                                    <option value="TC">Turks and Caicos Islands</option>
                                    <option value="TV">Tuvalu</option>
                                    <option value="UG">Uganda</option>
                                    <option value="UA">Ukraine</option>
                                    <option value="AE">United Arab Emirates</option>
                                    <option value="GB">United Kingdom</option>
                                    <option value="US">United States</option>
                                    <option value="UM">United States Minor Outlying Islands</option>
                                    <option value="UY">Uruguay</option>
                                    <option value="UZ">Uzbekistan</option>
                                    <option value="VU">Vanuatu</option>
                                    <option value="VE">Venezuela, Bolivarian Republic of</option>
                                    <option value="VN">Viet Nam</option>
                                    <option value="VG">Virgin Islands, British</option>
                                    <option value="VI">Virgin Islands, U.S.</option>
                                    <option value="WF">Wallis and Futuna</option>
                                    <option value="EH">Western Sahara</option>
                                    <option value="YE">Yemen</option>
                                    <option value="ZM">Zambia</option>
                                    <option value="ZW">Zimbabwe</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-10">
                        <!--begin::Input wrapper-->
                        <div class="w-lg-50 position-relative">
                            <label for="exampleFormControlInput1" class="form-label">
                                Licence
                                <span class="svg-icon svg-icon-1hx" data-bs-toggle="tooltip" data-bs-html="true" data-bs-trigger="click" title="Pour plus d'information sur les type de licence cliquer <a href='/licence'>ici</a>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"/>
                                        <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="black"/>
                                        <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="black"/>
                                    </svg>
                                </span>
                            </label>
                            <select title="exampleFormControlInput1" class="form-select" data-control="select2" name="licence" data-placeholder="Selectionner une licence...">
                                <option></option>
                                <option value="licence-tffrance-reserved">Tous droits réservés (Norme du site)</option>
                                <option value="licence-cc-by-nc-nd">Attribution, non commercial, aucune édition possible</option>
                                <option value="licence-cc-by-nc-sa">Attribution, non commercial, distribution dans des conditions égales</option>
                                <option value="licence-cc-by-nd">Dénomination, aucune édition possible</option>
                                <option value="licence-cc-by-sa">Dénomination, Transfert dans les mêmes conditions</option>
                                <option value="licence-cc-by">Attribution</option>
                                <option value="licence-cc">Aucun droit d'auteur - domaine public</option>
                            </select>

                        </div>
                        <!--end::Input wrapper-->
                    </div>
                </div>
            </div>
        </div>
        <div class="text-end">
            <button type="submit" class="btn btn-success">
                <span class="indicator-label">
                    Valider
                </span>
                <span class="indicator-progress">
                    Veuillez Patienter... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
            </button>
        </div>
    </form>
@endsection

@section("script")
    <script src="/account/assets/plugins/custom/tinymce/tinymce.bundle.js"></script>
    <script src="/account/js/package/create.js"></script>
@endsection
