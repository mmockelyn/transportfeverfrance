@extends("account.layouts.layout")
@section("styles")
    <link href="/account/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>

@endsection

@section("content")
    <div class="row gy-5 g-xl-8 d-flex align-items-center mt-lg-0 mb-10 mb-lg-15">
        <!--begin::Col-->
        <div class="col-xl-6 d-flex align-items-center">
            <h1 class="fs-2hx">Mes Packages - {{ $download->title }}</h1>

        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xl-6">
            <div class="d-flex flex-stack ps-lg-20">
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

    @if(config('app.env') == 'production')
        <!--begin::Alert-->
        <div class="alert alert-warning d-flex flex-column flex-sm-row p-5 mb-10">
            <!--begin::Icon-->
            <span class="svg-icon svg-icon-2hx svg-icon-warning me-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"/>
                    <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="black"/>
                    <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="black"/>
                </svg>
            </span>
            <!--end::Icon-->

            <!--begin::Wrapper-->
            <div class="d-flex flex-column">
                <!--begin::Title-->
                <h4 class="mb-1">Avertissement</h4>
                <!--end::Title-->
                <!--begin::Content-->
                <span>Cette fonctionnalité est encore en phase de développement, si un bug ou un disfonctionnement, veuillez nous le faire savoir à cette adresse: <a href="https://helpdesk.transportfeverfrance.fr/public/create-ticket">Soumettre un problème</a></span>
                <!--end::Content-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Alert-->
    @endif
    @if($download->active == 0)
        <div class="alert alert-dismissible bg-light-warning d-flex flex-column flex-sm-row p-5 mb-10">
            <!--begin::Icon-->
            <span class="svg-icon svg-icon-2hx svg-icon-warning me-4 mb-5 mb-sm-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"/>
                    <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="black"/>
                    <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="black"/>
                </svg>
            </span>
            <!--end::Icon-->

            <!--begin::Wrapper-->
            <div class="d-flex">
                <div class="d-flex flex-column pe-0 pe-sm-10">
                    <!--begin::Title-->
                    <h4 class="fw-bold">Attention</h4>
                    <!--end::Title-->
                    <!--begin::Content-->
                    <span>Le mod <strong>{{ $download->title }}</strong> est actuellement <span class="text-danger">Non publier</span>,<br>Vérifier les informations et publier le mod. </span>
                    <!--end::Content-->
                </div>
            </div>
            <!--end::Wrapper-->
            <button class="btn btn-success position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 ms-sm-auto publish" data-download="{{ $download->id }}" type="submit">
                <span class="indicator-label">
                    Publier le mod
                </span>
                <span class="indicator-progress">
                    Veuillez Patienter... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
            </button>
            <!--begin::Close-->
            <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                <i class="bi bi-x fs-1 text-warning"></i>
            </button>
            <!--end::Close-->
        </div>
    @endif
    <div class="row">
        <div class="col-md-3 col-sm-12 mb-10">
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="text-center px-4 mb-10 mt-5 overlay overflow-hidden">
                        <div class="overlay-wrapper">
                            @if($download->image)
                                <img class="mw-100 card-rounded-bottom card-rounded-top" alt="" src="/storage/files/shares/download/{{ $download->image }}"/>
                            @else
                                <img class="mw-100 card-rounded-bottom card-rounded-top" alt="" src="/storage/files/shares/download/placeholder.jpg"/>
                            @endif
                        </div>
                        <div class="overlay-layer bg-dark bg-opacity-25">
                            <a href="{{ route('account.packages.steam_preview', $download->id) }}" class="btn btn-primary btn-shadow">Preview on steam</a>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-8 px-5">
                        <!--begin::Description-->
                        <div class="flex-grow-1">
                            <a href="#" class="text-gray-800 text-hover-primary fw-bolder fs-6">Fournisseur (Provider)</a>
                        </div>
                        <!--end::Description-->
                        {!! \App\Helpers\Format::symbolDownloadProvider($download->provider) !!}
                    </div>

                    <div class="d-flex align-items-center mb-8 px-5">
                        <!--begin::Description-->
                        <div class="flex-grow-1">
                            <a href="#" class="text-gray-800 text-hover-primary fw-bolder fs-6">Etat</a>
                        </div>
                        <!--end::Description-->
                        {!! \App\Helpers\Format::DownloadState($download->active) !!}
                    </div>

                    <div class="d-flex align-items-center mb-8 px-5">
                        <!--begin::Description-->
                        <div class="flex-grow-1">
                            <a href="#" class="text-gray-800 text-hover-primary fw-bolder fs-6">Nombre de téléchargement</a>
                        </div>
                        <!--end::Description-->
                        <span class="badge badge-secondary">{{ $download->count_download }}</span>
                    </div>

                    <div class="d-flex align-items-center mb-8 px-5">
                        <!--begin::Description-->
                        <div class="flex-grow-1">
                            <a href="#" class="text-gray-800 text-hover-primary fw-bolder fs-6">Nombre de vue</a>
                        </div>
                        <!--end::Description-->
                        <span class="badge badge-secondary">{{ $download->count_view }}</span>
                    </div>

                    <div class="d-flex align-items-center mb-8 px-5">
                        <!--begin::Description-->
                        <div class="flex-grow-1">
                            <a href="#" class="text-gray-800 text-hover-primary fw-bolder fs-6">Nombre de commentaire</a>
                        </div>
                        <!--end::Description-->
                        <span class="badge badge-secondary">{{ $download->comments()->count() }}</span>
                    </div>

                    <div class="d-flex align-items-center mb-8 px-5">
                        <!--begin::Description-->
                        <div class="flex-grow-1">
                            <a href="#" class="text-gray-800 text-hover-primary fw-bolder fs-6">Nombre de ticket de support</a>
                        </div>
                        <!--end::Description-->
                        <span class="badge badge-secondary">{{ $download->supports()->count() }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-sm-12 col-sm-12">
            <div class="card shadow-sm">
                <div class="card-header card-header-stretch">
                    <div class="card-toolbar">
                        <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#general">
                                    <span class="svg-icon svg-icon-2 m-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<path d="M11 2.375L2 9.575V20.575C2 21.175 2.4 21.575 3 21.575H9C9.6 21.575 10 21.175 10 20.575V14.575C10 13.975 10.4 13.575 11 13.575H13C13.6 13.575 14 13.975 14 14.575V20.575C14 21.175 14.4 21.575 15 21.575H21C21.6 21.575 22 21.175 22 20.575V9.575L13 2.375C12.4 1.875 11.6 1.875 11 2.375Z" fill="black"></path>
										</svg>
                                    </span>
                                    <span class="d-flex flex-column align-items-start">
                                        <span class="fs-4 fw-bolder">Général</span>
                                    </span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#features">
                                    <span class="svg-icon svg-icon-2 m-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M20.0381 4V10C20.0381 10.6 19.6381 11 19.0381 11H17.0381C16.4381 11 16.0381 10.6 16.0381 10V4C16.0381 2.9 16.9381 2 18.0381 2C19.1381 2 20.0381 2.9 20.0381 4ZM9.73808 18.9C10.7381 18.5 11.2381 17.3 10.8381 16.3L5.83808 3.29999C5.43808 2.29999 4.23808 1.80001 3.23808 2.20001C2.23808 2.60001 1.73809 3.79999 2.13809 4.79999L7.13809 17.8C7.43809 18.6 8.23808 19.1 9.03808 19.1C9.23808 19 9.53808 19 9.73808 18.9ZM19.0381 18H17.0381V20H19.0381V18Z" fill="black"/>
                                            <path d="M18.0381 6H4.03809C2.93809 6 2.03809 5.1 2.03809 4C2.03809 2.9 2.93809 2 4.03809 2H18.0381C19.1381 2 20.0381 2.9 20.0381 4C20.0381 5.1 19.1381 6 18.0381 6ZM4.03809 3C3.43809 3 3.03809 3.4 3.03809 4C3.03809 4.6 3.43809 5 4.03809 5C4.63809 5 5.03809 4.6 5.03809 4C5.03809 3.4 4.63809 3 4.03809 3ZM18.0381 3C17.4381 3 17.0381 3.4 17.0381 4C17.0381 4.6 17.4381 5 18.0381 5C18.6381 5 19.0381 4.6 19.0381 4C19.0381 3.4 18.6381 3 18.0381 3ZM12.0381 17V22H6.03809V17C6.03809 15.3 7.33809 14 9.03809 14C10.7381 14 12.0381 15.3 12.0381 17ZM9.03809 15.5C8.23809 15.5 7.53809 16.2 7.53809 17C7.53809 17.8 8.23809 18.5 9.03809 18.5C9.83809 18.5 10.5381 17.8 10.5381 17C10.5381 16.2 9.83809 15.5 9.03809 15.5ZM15.0381 15H17.0381V13H16.0381V8L14.0381 10V14C14.0381 14.6 14.4381 15 15.0381 15ZM19.0381 15H21.0381C21.6381 15 22.0381 14.6 22.0381 14V10L20.0381 8V13H19.0381V15ZM21.0381 20H15.0381V22H21.0381V20Z" fill="black"/>
                                        </svg>
                                    </span>
                                    <span class="d-flex flex-column align-items-start">
                                        <span class="fs-4 fw-bolder">Caractéristiques</span>
                                    </span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#author">
                                    <span class="svg-icon svg-icon-2 m-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="black"/>
                                            <path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="black"/>
                                        </svg>
                                    </span>
                                    <span class="d-flex flex-column align-items-start">
                                        <span class="fs-4 fw-bolder">Auteurs</span>
                                    </span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#comments">
                                    <span class="svg-icon svg-icon-2 m-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M8 8C8 7.4 8.4 7 9 7H16V3C16 2.4 15.6 2 15 2H3C2.4 2 2 2.4 2 3V13C2 13.6 2.4 14 3 14H5V16.1C5 16.8 5.79999 17.1 6.29999 16.6L8 14.9V8Z" fill="black"/>
                                            <path d="M22 8V18C22 18.6 21.6 19 21 19H19V21.1C19 21.8 18.2 22.1 17.7 21.6L15 18.9H9C8.4 18.9 8 18.5 8 17.9V7.90002C8 7.30002 8.4 6.90002 9 6.90002H21C21.6 7.00002 22 7.4 22 8ZM19 11C19 10.4 18.6 10 18 10H12C11.4 10 11 10.4 11 11C11 11.6 11.4 12 12 12H18C18.6 12 19 11.6 19 11ZM17 15C17 14.4 16.6 14 16 14H12C11.4 14 11 14.4 11 15C11 15.6 11.4 16 12 16H16C16.6 16 17 15.6 17 15Z" fill="black"/>
                                        </svg>
                                    </span>
                                    <span class="d-flex flex-column align-items-start">
                                        <span class="fs-4 fw-bolder">Commentaires</span>
                                    </span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#versions">
                                    <span class="svg-icon svg-icon-2 m-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M5 8.04999L11.8 11.95V19.85L5 15.85V8.04999Z" fill="black"/>
                                            <path d="M20.1 6.65L12.3 2.15C12 1.95 11.6 1.95 11.3 2.15L3.5 6.65C3.2 6.85 3 7.15 3 7.45V16.45C3 16.75 3.2 17.15 3.5 17.25L11.3 21.75C11.5 21.85 11.6 21.85 11.8 21.85C12 21.85 12.1 21.85 12.3 21.75L20.1 17.25C20.4 17.05 20.6 16.75 20.6 16.45V7.45C20.6 7.15 20.4 6.75 20.1 6.65ZM5 15.85V7.95L11.8 4.05L18.6 7.95L11.8 11.95V19.85L5 15.85Z" fill="black"/>
                                        </svg>
                                    </span>
                                    <span class="d-flex flex-column align-items-start">
                                        <span class="fs-4 fw-bolder">Versions & Packages</span>
                                    </span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#docs">
                                    <span class="svg-icon svg-icon-2 m-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z" fill="black"/>
                                            <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black"/>
                                        </svg>
                                    </span>
                                    <span class="d-flex flex-column align-items-start">
                                        <span class="fs-4 fw-bolder">Documentations</span>
                                    </span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#supports">
                                    <span class="svg-icon svg-icon-2 m-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                            <path opacity="0.3" d="M16 0.200012H4C1.8 0.200012 0 2.00001 0 4.20001V16.2C0 18.4 1.8 20.2 4 20.2H16C18.2 20.2 20 18.4 20 16.2V4.20001C20 2.00001 18.2 0.200012 16 0.200012ZM15 10.2C15 10.9 14.8 11.6 14.6 12.2H18V16.2C18 17.3 17.1 18.2 16 18.2H12V14.8C11.4 15.1 10.7 15.2 10 15.2C9.3 15.2 8.6 15 8 14.8V18.2H4C2.9 18.2 2 17.3 2 16.2V12.2H5.4C5.1 11.6 5 10.9 5 10.2C5 9.50001 5.2 8.80001 5.4 8.20001H2V4.20001C2 3.10001 2.9 2.20001 4 2.20001H8V5.60001C8.6 5.30001 9.3 5.20001 10 5.20001C10.7 5.20001 11.4 5.40001 12 5.60001V2.20001H16C17.1 2.20001 18 3.10001 18 4.20001V8.20001H14.6C14.8 8.80001 15 9.50001 15 10.2Z" fill="black"/>
                                            <path d="M12 1.40002C15.4 2.20002 18 4.80003 18.8 8.20003H14.6C14.1 7.00003 13.2 6.10003 12 5.60003V1.40002ZM5.40001 8.20003C5.90001 7.00003 6.80001 6.10003 8.00001 5.60003V1.40002C4.60001 2.20002 2.00001 4.80003 1.20001 8.20003H5.40001ZM14.6 12.2C14.1 13.4 13.2 14.3 12 14.8V19C15.4 18.2 18 15.6 18.8 12.2H14.6ZM8.00001 14.8C6.80001 14.3 5.90001 13.4 5.40001 12.2H1.20001C2.00001 15.6 4.60001 18.2 8.00001 19V14.8Z" fill="black"/>
                                        </svg>
                                    </span>
                                    <span class="d-flex flex-column align-items-start">
                                        <span class="fs-4 fw-bolder">Supports</span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="general" role="tabpanel">
                            <div class="row">
                                <div class="col-md-9 col-sm-12 border-end">
                                    <h3 class="font-weight-bold mb-5"><u>Edition des informations du mod</u></h3>
                                    <form action="{{ route('account.packages.update_info', $download->id) }}" method="post" id="formUpdateModInfo">
                                        @csrf
                                        @method("PUT")
                                        <div class="mb-10">
                                            <label for="exampleFormControlInput1" class="form-label">Titre</label>
                                            <input type="text" class="form-control form-control-solid" name="title" value="{{ $download->title }}"/>
                                        </div>
                                        <div class="mb-10">
                                            <label for="exampleFormControlInput1" class="form-label">Tags</label>
                                            <input type="text" class="form-control form-control-solid tagify" name="meta_keywords" value="{{ $download->meta_keywords }}"/>
                                        </div>

                                        <div class="mb-10">
                                            <label for="exampleFormControlInput1" class="form-label">Courte description</label>
                                            <textarea title="exampleFormControlInput1" class="form-control" name="short_content" id="short_content" rows="6" maxlength="255">{{ $download->short_content   }}</textarea>
                                        </div>

                                        <div class="mb-10">
                                            <label for="exampleFormControlInput1" class="form-label">Description</label>
                                            <textarea title="exampleFormControlInput1" class="form-control" name="description" id="description" rows="6">{!! $download->content !!}</textarea>
                                        </div>

                                        <div class="text-end">
                                            <button class="btn btn-success" type="submit">
                                                <span class="indicator-label">
                                                    Valider
                                                </span>
                                                <span class="indicator-progress">
                                                    Veuillez Patienter... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                </span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="card shadow-sm">
                                        <div class="card-header">
                                            <h3 class="card-title">Edition de l'image du mod</h3>
                                        </div>
                                        <form action="{{ route('account.packages.update_image', $download->id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method("put")
                                            <div class="card-body">
                                                <div class="image-input image-input-outline mw-100 card-rounded-bottom card-rounded-top" data-kt-image-input="true" style="background-image: url(@if($download->image) /storage/files/shares/download/{{ $download->image }} @else /storage/files/shares/download/placeholder.jpg @endif">
                                                    <!--begin::Image preview wrapper-->
                                                    <div class="image-input-wrapper mw-100" style="background-image: url(@if($download->image) /storage/files/shares/download/{{ $download->image }} @else /storage/files/shares/download/placeholder.jpg @endif)"></div>
                                                    <!--end::Image preview wrapper-->

                                                    <!--begin::Edit button-->
                                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                                           data-kt-image-input-action="change"
                                                           data-bs-toggle="tooltip"
                                                           data-bs-dismiss="click"
                                                           title="Change avatar">
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
                                            <div class="card-footer text-end">
                                                <button class="btn btn-success" type="submit">
                                                <span class="indicator-label">
                                                    Valider
                                                </span>
                                                    <span class="indicator-progress">
                                                    Veuillez Patienter... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                </span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="features" role="tabpanel">
                            <div class="card shadow-sm">
                                <div class="card-header">
                                    <h3 class="card-title">Caractéristique</h3>
                                    <div class="card-toolbar">
                                        <button type="button" class="btn btn-sm btn-light" id="btnModalEditFeature" data-id="{{ $download->id }}">
                                            Editer les caractéristiques
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-6">
                                            <div class="d-flex align-items-center mb-7">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-50px me-5">
														<span class="symbol-label bg-light-primary">
															<!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
															<span class="svg-icon svg-icon-2x svg-icon-success">
																<img src="/storage/files/shares/core/icons/feature/type_feature.png" width="24" alt="">
															</span>
                                                            <!--end::Svg Icon-->
														</span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="d-flex flex-column">
                                                    <a href="#" class="text-dark text-hover-primary fs-6 fw-bolder">Type</a>
                                                    <span class="text-muted fw-bold">
                                                        @if($download->feature->type_feature == 0)
                                                            Vehicule
                                                        @else
                                                            Autre objet
                                                        @endif
                                                    </span>
                                                </div>
                                                <!--end::Text-->
                                            </div>
                                        </div>
                                        @if($download->feature->type_feature == 0)
                                        <div class="col-md-3 col-sm-6">
                                            <div class="d-flex align-items-center mb-7">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-50px me-5">
														<span class="symbol-label bg-light-primary">
															<!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
															<span class="svg-icon svg-icon-2x svg-icon-success">
																<img src="/storage/files/shares/core/icons/feature/type_vehicle_train.png" width="24" alt="">
															</span>
                                                            <!--end::Svg Icon-->
														</span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="d-flex flex-column">
                                                    <a href="#" class="text-dark text-hover-primary fs-6 fw-bolder">Type de Vehicule</a>
                                                    <span class="text-muted fw-bold">
                                                        {{ $download->feature->type_vehicule }}
                                                    </span>
                                                </div>
                                                <!--end::Text-->
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="d-flex align-items-center mb-7">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-50px me-5">
														<span class="symbol-label bg-light-primary">
															<!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
															<span class="svg-icon svg-icon-2x svg-icon-success">
																<img src="/storage/files/shares/core/icons/feature/type_conduite.png" width="24" alt="">
															</span>
                                                            <!--end::Svg Icon-->
														</span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="d-flex flex-column">
                                                    <a href="#" class="text-dark text-hover-primary fs-6 fw-bolder">Type de conduite</a>
                                                    <span class="text-muted fw-bold">
                                                        {{ $download->feature->conduite_vehicule }}
                                                    </span>
                                                </div>
                                                <!--end::Text-->
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="d-flex align-items-center mb-7">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-50px me-5">
														<span class="symbol-label bg-light-primary">
															<!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
															<span class="svg-icon svg-icon-2x svg-icon-success">
																<img src="/storage/files/shares/core/icons/feature/vitesse.png" width="24" alt="">
															</span>
                                                            <!--end::Svg Icon-->
														</span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="d-flex flex-column">
                                                    <a href="#" class="text-dark text-hover-primary fs-6 fw-bolder">Vitesse Max.</a>
                                                    <span class="text-muted fw-bold">
                                                        {{ $download->feature->vitesse }} Km/h
                                                    </span>
                                                </div>
                                                <!--end::Text-->
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="d-flex align-items-center mb-7">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-50px me-5">
														<span class="symbol-label bg-light-primary">
															<!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
															<span class="svg-icon svg-icon-2x svg-icon-success">
																<img src="/storage/files/shares/core/icons/feature/performance.png" width="24" alt="">
															</span>
                                                            <!--end::Svg Icon-->
														</span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="d-flex flex-column">
                                                    <a href="#" class="text-dark text-hover-primary fs-6 fw-bolder">Performance</a>
                                                    <span class="text-muted fw-bold">
                                                        {{ $download->feature->performance }} kN
                                                    </span>
                                                </div>
                                                <!--end::Text-->
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="d-flex align-items-center mb-7">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-50px me-5">
														<span class="symbol-label bg-light-primary">
															<!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
															<span class="svg-icon svg-icon-2x svg-icon-success">
																<img src="/storage/files/shares/core/icons/feature/performance.png" width="24" alt="">
															</span>
                                                            <!--end::Svg Icon-->
														</span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="d-flex flex-column">
                                                    <a href="#" class="text-dark text-hover-primary fs-6 fw-bolder">Performance</a>
                                                    <span class="text-muted fw-bold">
                                                        {{ $download->feature->performance }} kW
                                                    </span>
                                                </div>
                                                <!--end::Text-->
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="d-flex align-items-center mb-7">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-50px me-5">
														<span class="symbol-label bg-light-primary">
															<!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
															<span class="svg-icon svg-icon-2x svg-icon-success">
																<img src="/storage/files/shares/core/icons/feature/traction.png" width="24" alt="">
															</span>
                                                            <!--end::Svg Icon-->
														</span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="d-flex flex-column">
                                                    <a href="#" class="text-dark text-hover-primary fs-6 fw-bolder">Effort de Traction</a>
                                                    <span class="text-muted fw-bold">
                                                        {{ $download->feature->traction }} kN
                                                    </span>
                                                </div>
                                                <!--end::Text-->
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="d-flex align-items-center mb-7">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-50px me-5">
														<span class="symbol-label bg-light-primary">
															<!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
															<span class="svg-icon svg-icon-2x svg-icon-success">
																<img src="/storage/files/shares/core/icons/feature/espacement.png" width="24" alt="">
															</span>
                                                            <!--end::Svg Icon-->
														</span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="d-flex flex-column">
                                                    <a href="#" class="text-dark text-hover-primary fs-6 fw-bolder">Ecartement de voie</a>
                                                    <span class="text-muted fw-bold">
                                                        {{ $download->feature->ecartement }} mm
                                                    </span>
                                                </div>
                                                <!--end::Text-->
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="d-flex align-items-center mb-7">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-50px me-5">
														<span class="symbol-label bg-light-primary">
															<!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
															<span class="svg-icon svg-icon-2x svg-icon-success">
																<img src="/storage/files/shares/core/icons/feature/capacity.png" width="24" alt="">
															</span>
                                                            <!--end::Svg Icon-->
														</span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="d-flex flex-column">
                                                    <a href="#" class="text-dark text-hover-primary fs-6 fw-bolder">Ecartement de voie</a>
                                                    <span class="text-muted fw-bold">
                                                        {{ $download->feature->capacity }}
                                                    </span>
                                                </div>
                                                <!--end::Text-->
                                            </div>
                                        </div>
                                        @endif
                                        <div class="col-md-3 col-sm-6">
                                            <div class="d-flex align-items-center mb-7">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-50px me-5">
														<span class="symbol-label bg-light-primary">
															<!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
															<span class="svg-icon svg-icon-2x svg-icon-success">
																<img src="/storage/files/shares/core/icons/feature/date_start.png" width="24" alt="">
															</span>
                                                            <!--end::Svg Icon-->
														</span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="d-flex flex-column">
                                                    <a href="#" class="text-dark text-hover-primary fs-6 fw-bolder">Horodatage</a>
                                                    <span class="text-muted fw-bold">
                                                        {{ $download->feature->dispo_start }} @if($download->feature->dispo_end)-{{ $download->feature->dispo_end }}@endif
                                                    </span>
                                                </div>
                                                <!--end::Text-->
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="d-flex align-items-center mb-7">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-50px me-5">
														<span class="symbol-label bg-light-primary">
															<!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
															<span class="svg-icon svg-icon-2x svg-icon-success">
																<img src="/storage/files/shares/core/icons/feature/country.png" width="24" alt="">
															</span>
                                                            <!--end::Svg Icon-->
														</span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="d-flex flex-column">
                                                    <a href="#" class="text-dark text-hover-primary fs-6 fw-bolder">Pays</a>
                                                    <span class="text-muted fw-bold">
                                                        {{ $download->feature->pays }}
                                                    </span>
                                                </div>
                                                <!--end::Text-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="author" role="tabpanel">
                            <div class="card shadow-sm">
                                <div class="card-header">
                                    <h3 class="card-title">Liste des auteurs du mod</h3>
                                    <div class="card-toolbar">
                                        <button type="button" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#addUser">
                                            Ajouter un auteur
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row" id="contentAuthors">
                                        @foreach($download->users as $user)
                                        <div class="col-md-3 col-sm-6">
                                            <div class="d-flex align-items-center mb-7 overlay overflow-hidden">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-50px me-5">
                                                    @if($user->image)
                                                    <img src="/storage/files/shares/avatar/{{ $user->image }}" class="" alt="">
                                                    @else
                                                        <img src="/storage/files/shares/avatar/placeholder.png" class="" alt="">
                                                    @endif
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Text-->
                                                <div class="flex-grow-1">
                                                    <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">{{ $user->name }}</a>
                                                    <span class="text-muted d-block fw-bold">{{ $user->email }}</span>
                                                </div>
                                                <!--end::Text-->
                                                @if(auth()->user()->id !== $user->id)
                                                <div class="overlay-layer bg-dark bg-opacity-25">
                                                    <a href="#" class="btn btn-primary btn-shadow disabled">Voir le profil</a>
                                                    <a href="#" class="btn btn-light-danger btn-shadow ms-2 disabled">Supprimer</a>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="comments" role="tabpanel">
                            <div class="card shadow-sm">
                                <div class="card-header">
                                    <h3 class="card-title">Listes des commentaires</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-row-bordered gy-5" id="list_download_comments">
                                        <thead>
                                            <tr>
                                                <th class="">#</th>
                                                <th class="text-center">Auteur</th>
                                                <th class="text-center">Commentaire</th>
                                                <th class="text-center">Etat</th>
                                                <th class="text-end">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($download->comments as $comment)
                                            <tr>
                                                <td>{{ $comment->id }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center mb-7">
                                                        <!--begin::Avatar-->
                                                        <div class="symbol symbol-50px me-5">
                                                            @if($comment->user->image)
                                                                <img src="/storage/files/shares/avatar/{{ $comment->user->image }}" class="" alt="">
                                                            @else
                                                                <img src="/storage/files/shares/avatar/placeholder.png" class="" alt="">
                                                            @endif
                                                        </div>
                                                        <!--end::Avatar-->
                                                        <!--begin::Text-->
                                                        <div class="flex-grow-1">
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">{{ $comment->user->name }}</a>
                                                            <span class="text-muted d-block fw-bold">{{ $comment->user->email }}</span>
                                                        </div>
                                                        <!--end::Text-->
                                                    </div>
                                                </td>
                                                <td>{{ $comment->content }}</td>
                                                <td class="text-center">
                                                    @if($comment->valid == 0)
                                                        <span class="badge badge-danger">Non valider</span>
                                                    @else
                                                        <span class="badge badge-success">Valider</span>
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    @if($comment->valid == 0)
                                                        <a href="/api/download/{{ $download->id }}/comment/{{ $comment->id }}/publish" class="btn btn-success btn-sm btn-icon" data-bs-toggle="tooltip" title="Publier le commentaire"><i class="fas fa-check-circle"></i> </a>
                                                    @else
                                                        <a href="/api/download/{{ $download->id }}/comment/{{ $comment->id }}/dispublish" class="btn btn-danger btn-sm btn-icon" data-bs-toggle="tooltip" title="Dépublier le commentaire"><i class="fas fa-times-circle"></i> </a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="versions" role="tabpanel">
                            <div class="card shadow-sm">
                                <div class="card-header">
                                    <h3 class="card-title">Listes des versions du mod</h3>
                                    <div class="card-toolbar">
                                        <button type="button" class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#modalAddVersion">
                                            <i class="fas fa-plus-circle"></i> Nouvelle version
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-row-bordered gy-5" id="list_download_versions">
                                        <thead>
                                        <tr>
                                            <th class="">Version</th>
                                            <th class="text-center">Type</th>
                                            <th class="text-center">Etat</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($download->versions as $version)
                                            <tr>
                                                <td>{{ $version->version }}</td>
                                                <td class="text-center">{!! \App\Helpers\Format::labelDownloadVersionType($version->type, true) !!}</td>
                                                <td class="text-center">{!! \App\Helpers\Format::labelDownloadVersionState($version->state, true) !!}</td>
                                                <td class="text-end">
                                                    <button type="button" class="btn btn-sm btn-secondary btn-icon btnToggleView" data-download="{{ $version->download_id }}" data-version="{{ $version->id }}" data-bs-toggle="tooltip" title="Voir la mise à jours"><i class="fas fa-eye"></i> </button>
                                                    <button type="button" class="btn btn-sm btn-primary btn-icon btnEditVersion" data-download="{{ $version->download_id }}" data-version="{{ $version->id }}" data-bs-toggle="tooltip" title="Editer la mise à jours"><i class="fas fa-edit"></i> </button>
                                                    @if($version->state != 2)
                                                        <button type="button" class="btn btn-sm btn-danger btn-icon btnTrashVersion" data-download="{{ $version->download_id }}" data-version="{{ $version->id }}" data-bs-toggle="tooltip" title="Supprimer la mise à jours">
                                                            <span class="indicator-label">
                                                                <i class="fas fa-trash"></i>
                                                            </span>
                                                            <span class="indicator-progress">
                                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                            </span>
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="docs" role="tabpanel">
                            <div class="card shadow-sm">
                                <div class="card-header">
                                    <h3 class="card-title">Documentation du mod</h3>
                                    <div class="card-toolbar">
                                        <button type="button" id="btnEditDoc" class="btn btn-sm btn-icon btn-light-primary" data-bs-toggle="tooltip" title="Editer la documentation">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    {!! $download->wiki->content !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="modalEditFeatureVehicle">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edition des caractéristiques</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="" id="formEditFeatureVehicle">
                    <input type="hidden" name="download_id" value="{{ $download->id }}">
                    <div class="modal-body">
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

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
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
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="modalEditFeatureOther">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edition des caractéristiques</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="" id="formEditFeatureOther">
                    <input type="hidden" name="download_id" value="{{ $download->id }}">
                    <div class="modal-body">
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

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
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
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="addUser">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajout d'un auteur</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="/api/download/{{ $download->id }}/auteur" id="formAddUser">
                    <input type="hidden" name="auth_user_id" value="{{ auth()->user()->id }}">
                    <div class="modal-body">
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Example</label>
                            <select title="exampleFormControlInput1" id="user_id" name="user_id[]" class="form-select" data-control="select2" data-placeholder="Selectionner un auteur" data-allow-clear="true" multiple="multiple">
                                <option></option>
                                @foreach(\App\Models\User::query()->where('id', '!=', auth()->user()->id)->get() as $user)
                                    <option value="{{ $user->id }}" data-avatar="@if($user->avatar){{ $user->avatar }}@else placeholder.png @endif">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
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
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="modalViewVersion">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Ajout d'un auteur<br><span class="text-muted">Module</span> </h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close" style="border: solid 1px #63636d; padding: 8px; border-radius: 50%; width: 32px; height: 32px; margin-bottom: 8px; box-shadow: 0 3px 32px #000;">
                        <span class="svg-icon svg-icon-2x">
                            <svg version="1.1" id="Layer_2" xmlns="http://www.w3.org/2000/svg" class="SVGIcon_Button SVGIcon_X_Line" x="0px" y="0px" width="256px" height="256px" viewBox="0 0 256 256">
                                <line fill="none" stroke="#ffffff" stroke-width="45" stroke-miterlimit="10" x1="212" y1="212" x2="44" y2="44"></line>
                                <line fill="none" stroke="#ffffff" stroke-width="45" stroke-miterlimit="10" x1="44" y1="212" x2="212" y2="44"></line>
                            </svg>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-striped fs-3 mb-15">
                        <tbody>
                            <tr>
                                <td>Version</td>
                                <td class="text-end">
                                    <span class="badge badge-primary badgeVersion">1.0</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Type</td>
                                <td class="text-end">
                                    <span class="badge badge-danger badgeType">Alpha</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Etat</td>
                                <td class="text-end">
                                    <span class="badge badge-warning badgeState">En cours de publication</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="noteContent"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="modalAddVersion">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Nouvelle version d'un mod</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close" style="border: solid 1px #63636d; padding: 8px; border-radius: 50%; width: 32px; height: 32px; margin-bottom: 8px; box-shadow: 0 3px 32px #000;">
                        <span class="svg-icon svg-icon-2x">
                            <svg version="1.1" id="Layer_2" xmlns="http://www.w3.org/2000/svg" class="SVGIcon_Button SVGIcon_X_Line" x="0px" y="0px" width="256px" height="256px" viewBox="0 0 256 256">
                                <line fill="none" stroke="#ffffff" stroke-width="45" stroke-miterlimit="10" x1="212" y1="212" x2="44" y2="44"></line>
                                <line fill="none" stroke="#ffffff" stroke-width="45" stroke-miterlimit="10" x1="44" y1="212" x2="212" y2="44"></line>
                            </svg>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>
                <form action="/api/download/{{ $download->id }}/version" method="post" id="formAddVersion" enctype="multipart/form-data">
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="download_id" value="{{ $download->id }}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Version</label>
                                    <input type="text" class="form-control form-control-solid" name="version" placeholder="1.0,1.1.1,1.1.1:2222,etc..."/>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Type de release</label>
                                    <select title="exampleFormControlInput1" name="type" class="form-select" data-control="select2" data-placeholder="Type de release de la version">
                                        <option></option>
                                        <option value="alpha">Alpha</option>
                                        <option value="beta">Beta</option>
                                        <option value="release">Release</option>
                                        <option value="hotfix">Hotfix</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Etat</label>
                                    <select title="exampleFormControlInput1" name="state" class="form-select" data-control="select2" data-placeholder="Etat de la version">
                                        <option></option>
                                        <option value="0">Non publier</option>
                                        <option value="1">En cours de publication</option>
                                        <option value="2">Publier</option>
                                    </select>
                                    <p>Vous pouvez avoir plus d'information sur le processus sur <a href="/docs/1.0/account/process_publish">la documentation</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Lien du package</label>
                            <input type="text" class="form-control form-control-solid" name="link_package" placeholder="Lien web ou Identifiant (steam)"/>
                            <p class="text-muted">Non obligatoire si le provider est TPF France</p>
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Note de la version</label>
                            <textarea name="contents" class="form-control editor" rows="6"></textarea>
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Fichier du mod</label>
                            <input type="file" name="file_mod" accept="application/zip" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
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
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="modalEditVersion">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edition d'une version</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close" style="border: solid 1px #63636d; padding: 8px; border-radius: 50%; width: 32px; height: 32px; margin-bottom: 8px; box-shadow: 0 3px 32px #000;">
                        <span class="svg-icon svg-icon-2x">
                            <svg version="1.1" id="Layer_2" xmlns="http://www.w3.org/2000/svg" class="SVGIcon_Button SVGIcon_X_Line" x="0px" y="0px" width="256px" height="256px" viewBox="0 0 256 256">
                                <line fill="none" stroke="#ffffff" stroke-width="45" stroke-miterlimit="10" x1="212" y1="212" x2="44" y2="44"></line>
                                <line fill="none" stroke="#ffffff" stroke-width="45" stroke-miterlimit="10" x1="44" y1="212" x2="212" y2="44"></line>
                            </svg>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>
                <form action="/api/download/{{ $download->id }}/version" method="post" id="formEditVersion" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="download_id" value="{{ $download->id }}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Version</label>
                                    <input type="text" class="form-control form-control-solid" name="version" placeholder="1.0,1.1.1,1.1.1:2222,etc..."/>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Type de release</label>
                                    <select title="exampleFormControlInput1" name="type" class="form-select" data-control="select2" data-placeholder="Type de release de la version">
                                        <option></option>
                                        <option value="alpha">Alpha</option>
                                        <option value="beta">Beta</option>
                                        <option value="release">Release</option>
                                        <option value="hotfix">Hotfix</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Etat</label>
                                    <select title="exampleFormControlInput1" name="state" class="form-select" data-control="select2" data-placeholder="Etat de la version">
                                        <option></option>
                                        <option value="0">Non publier</option>
                                        <option value="1">En cours de publication</option>
                                        <option value="2">Publier</option>
                                    </select>
                                    <p>Vous pouvez avoir plus d'information sur le processus sur <a href="/docs/1.0/account/process_publish">la documentation</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Lien du package</label>
                            <input type="text" class="form-control form-control-solid" name="link_package" placeholder="Lien web ou Identifiant (steam)"/>
                            <p class="text-muted">Non obligatoire si le provider est TPF France</p>
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Note de la version</label>
                            <textarea name="contents" class="form-control editor" rows="6"></textarea>
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Fichier du mod</label>
                            <input type="file" name="file_mod" accept="application/zip" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
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
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="modalEditDoc">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edition de la documentation</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close" style="border: solid 1px #63636d; padding: 8px; border-radius: 50%; width: 32px; height: 32px; margin-bottom: 8px; box-shadow: 0 3px 32px #000;">
                        <span class="svg-icon svg-icon-2x">
                            <svg version="1.1" id="Layer_2" xmlns="http://www.w3.org/2000/svg" class="SVGIcon_Button SVGIcon_X_Line" x="0px" y="0px" width="256px" height="256px" viewBox="0 0 256 256">
                                <line fill="none" stroke="#ffffff" stroke-width="45" stroke-miterlimit="10" x1="212" y1="212" x2="44" y2="44"></line>
                                <line fill="none" stroke="#ffffff" stroke-width="45" stroke-miterlimit="10" x1="44" y1="212" x2="212" y2="44"></line>
                            </svg>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>
                <form action="/api/download/{{ $download->id }}/documentation" method="post" id="formEditDoc">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="download_id" value="{{ $download->id }}">
                    <div class="modal-body">
                        <div class="mb-10">
                            <textarea name="contents" class="form-control editor" rows="6">@if($download->wiki !== null) {!! $download->wiki->content !!}  @endif</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
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
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script src="/account/assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <script src="/account/assets/plugins/custom/tinymce/tinymce.bundle.js"></script>
    <script src="{{ asset('account/js/package/show.js') }}"></script>
@endsection
