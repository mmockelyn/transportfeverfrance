@extends("account.layouts.layout")
@section("styles")
    <link href="/account/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet"
          href="{{ asset('/front/assets/plugins/custom/password-requirement/css/jquery.passwordRequirements.css') }}">
    <style>
        .ql-container {
            height: 350px;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simplemde/1.11.2/simplemde.min.css">
@endsection

@section("content")
    <!--begin::Row-->
    <div class="row gy-5 g-xl-8 d-flex align-items-center mt-lg-0 mb-10 mb-lg-15">
        <!--begin::Col-->
        <div class="col-xl-6 d-flex align-items-center">
            <h1 class="fs-2hx">Mon Profil</h1>

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
                <a href="{{ route('account.profil') }}" class="btn btn-icon btn-outline btn-nav active h-50px w-50px h-lg-70px w-lg-70px ms-2" data-bs-toggle="tooltip" title="Mon profil">
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
                <a href="{{ route('account.packages') }}" class="btn btn-icon btn-outline btn-nav h-50px w-50px h-lg-70px w-lg-70px ms-2" data-bs-toggle="tooltip" title="Mes Packages">
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
    <div id="profile" data-id="{{ $user->id }}">
        <x-account.deleted_account :user="$user"/>
        <div class="card mb-5 mb-xl-10">
            <div class="card-body pt-9 pb-0">
                <!--begin::Details-->
                <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                    <!--begin: Pic-->
                    <div class="me-7 mb-4">
                        <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                            @if($user->avatar != null)
                                <img src="{{ $user->avatar }}" alt="image">
                            @else
                                <div class="symbol-label fs-2 fw-bold">{{ \Illuminate\Support\Str::limit($user->name, 1, '') }}</div>
                            @endif
                            @if(\Illuminate\Support\Facades\Cache::has('user-is-online-'.$user->id) == true)
                                    <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-white h-20px w-20px"></div>
                            @else

                            @endif<div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-danger rounded-circle border border-4 border-white h-20px w-20px"></div>
                        </div>
                    </div>
                    <!--end::Pic-->
                    <!--begin::Info-->
                    <div class="flex-grow-1">
                        <!--begin::Title-->
                        <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                            <!--begin::User-->
                            <div class="d-flex flex-column">
                                <!--begin::Name-->
                                <div class="d-flex align-items-center mb-2">
                                    <a href="#" class="text-white text-hover-primary fs-2 fw-bolder me-1">{{ $user->name }}</a>
                                </div>
                                <!--end::Name-->
                                <!--begin::Info-->
                                <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
                                    <a href="#" class="d-flex align-items-center text-white-50 text-hover-primary me-5 mb-2">
                                        <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                        <span class="svg-icon svg-icon-4 me-1">
																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																	<path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="black"></path>
																	<path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="black"></path>
																</svg>
															</span>
                                        <!--end::Svg Icon-->{{ \App\Helpers\Format::formatUserGroup($user->group) }}</a>
                                    <a href="#" class="d-flex align-items-center text-white-50 text-hover-primary me-5 mb-2">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
                                        <span class="svg-icon svg-icon-4 me-1">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z" fill="black"/>
                                                <path d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z" fill="black"/>
                                                <path d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z" fill="black"/>
                                            </svg>
										</span>
                                        <!--end::Svg Icon-->{{ $user->last_seen->format('d/m/Y à H:i') }}</a>
                                    <a href="#" class="d-flex align-items-center text-white-50 text-hover-primary mb-2">
                                        <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                                        <span class="svg-icon svg-icon-4 me-1">
																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																	<path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z" fill="black"></path>
																	<path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z" fill="black"></path>
																</svg>
															</span>
                                        <!--end::Svg Icon-->{{ $user->email }}</a>
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::User-->
                            <!--begin::Actions-->
                            <div class="d-flex my-4">
                                @if($user->valid == 0 && $user->email_verified_at == null)
                                    <a href="/email/verify" class="btn btn-sm btn-danger me-3" data-bs-toggle="tooltip" title="Renvoyer le mail de vérification"><i class="fas fa-envelope"></i> Compte non valider</a>
                                @endif
                                <x-account.social_active :user="$user"/>
                            </div>
                            <!--end::Actions-->
                        </div>
                        <!--end::Title-->
                        <!--begin::Stats-->
                        <div class="d-flex flex-wrap flex-stack">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column flex-grow-1 pe-8">
                                <!--begin::Stats-->
                                <div class="d-flex flex-wrap">
                                    <!--begin::Stat-->
                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        <!--begin::Number-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                            <span class="svg-icon svg-icon-3 svg-icon-success me-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z" fill="black"/>
                                                    <rect x="6" y="12" width="7" height="2" rx="1" fill="black"/>
                                                    <rect x="6" y="7" width="12" height="2" rx="1" fill="black"/>
                                                </svg>
											</span>
                                            <!--end::Svg Icon-->
                                            <div class="fs-2 fw-bolder numbercomment" data-kt-countup="true" data-kt-countup-value="4500" data-kt-countup-prefix=""></div>
                                        </div>
                                        <!--end::Number-->
                                        <!--begin::Label-->
                                        <div class="fw-bold fs-6 text-white-50">Commentaires</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Stat-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Progress-->
                            <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                                <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                    <span class="fw-bold fs-6 text-white ">Profil</span>
                                    <span class="fw-bolder fs-6">{{ $profilPercent }}%</span>
                                </div>
                                <div class="h-5px mx-3 w-100 bg-light mb-3">
                                    {!! \App\Helpers\Format::percentProfilComplete($profilPercent) !!}
                                </div>
                            </div>
                            <!--end::Progress-->
                        </div>
                        <!--end::Stats-->
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Details-->
                <!--begin::Navs-->
                <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder">
                    <!--begin::Nav item-->
                    <li class="nav-item mt-2">
                        <a class="nav-link text-white text-active-primary ms-0 me-10 py-5 active" data-bs-toggle="tab" href="#overview">Aperçu</a>
                    </li>
                    <!--end::Nav item-->
                    <!--begin::Nav item-->
                    <li class="nav-item mt-2">
                        <a class="nav-link text-white text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" href="#configuration">Configuration</a>
                    </li>
                    <!--end::Nav item-->
                    <!--begin::Nav item-->
                    <li class="nav-item mt-2">
                        <a class="nav-link text-white text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" href="#security">Sécurité</a>
                    </li>
                    <!--end::Nav item-->
                    <!--begin::Nav item-->
                    <li class="nav-item mt-2">
                        <a class="nav-link text-white text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" href="#social">Connexion Social</a>
                    </li>
                    <!--end::Nav item-->
                </ul>
                <!--begin::Navs-->
            </div>
        </div>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="overview" role="tabpanel">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title">Derniers Packages</h3>
                        </div>
                        <div class="card-body">
                            @if($user->downloads()->count() == 0)
                                <div class="alert alert-dismissible bg-light-primary border border-primary d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                                    <!--begin::Icon-->
                                    <!--begin::Svg Icon | path: icons/duotune/files/fil024.svg-->
                                    <span class="svg-icon svg-icon-2hx svg-icon-primary me-4 mb-5 mb-sm-0">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"/>
                                            <rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="black"/>
                                            <rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="black"/>
                                        </svg>
									</span>
                                    <!--end::Svg Icon-->
                                    <!--end::Icon-->
                                    <!--begin::Content-->
                                    <div class="d-flex flex-column pe-0 pe-sm-10">
                                        <span>Aucun packages disponible</span>
                                    </div>
                                    <!--end::Content-->
                                    <!--begin::Close-->
                                    <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                                        <i class="bi bi-x fs-1 text-primary"></i>
                                    </button>
                                    <!--end::Close-->
                                </div>
                            @else
                                @foreach($user->downloads()->orderBy('updated_at', 'desc')->limit(5)->get() as $download)
                                    <div class="d-flex align-items-sm-center mb-7">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-60px symbol-2by3 me-4">
                                            @if(\Illuminate\Support\Facades\Storage::disk("public")->exists('files/shares/download/'.$download->image) == true)
                                                <div class="symbol-label" style="background-image: url('/storage/files/shares/download/{{ $download->image }}')"></div>
                                            @else
                                                <div class="symbol-label" style="background-image: url('https://via.placeholder.com/600x400')"></div>
                                            @endif
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Title-->
                                        <div class="d-flex flex-row-fluid flex-wrap align-items-center">
                                            <div class="flex-grow-1 me-2">
                                                <a href="{{ route('account.packages.show', $download->id) }}" class="text-gray-800 fw-bolder text-hover-primary fs-6">{{ $download->title }}</a>
                                                <span class="text-muted fw-bold d-block pt-1">{{ $download->category->title }} -> {{ $download->subcategory->title }}</span>
                                            </div>
                                            @if($download->active == 1)
                                                <span class="badge badge-light-success fs-8 fw-bolder my-2">Publier</span>
                                            @else
                                                <span class="badge badge-light-danger fs-8 fw-bolder my-2">Non Publier</span>
                                            @endif
                                            <div class="d-flex flex-column text-right">
                                                <a href="{{ route('front.download.show', $download->slug) }}" class="btn btn-icon btn-lg btn-default"><i
                                                        class="fas fa-eye"></i></a>
                                            </div>
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title">Derniers Commentaires (Téléchargement)</h3>
                        </div>
                        <div class="card-body">
                            @if($user->downloadcomments()->count() == 0)
                                <div class="alert alert-dismissible bg-light-primary border border-primary d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                                    <!--begin::Icon-->
                                    <!--begin::Svg Icon | path: icons/duotune/files/fil024.svg-->
                                    <span class="svg-icon svg-icon-2hx svg-icon-primary me-4 mb-5 mb-sm-0">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"/>
                                            <rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="black"/>
                                            <rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="black"/>
                                        </svg>
									</span>
                                    <!--end::Svg Icon-->
                                    <!--end::Icon-->
                                    <!--begin::Content-->
                                    <div class="d-flex flex-column pe-0 pe-sm-10">
                                        <span>Aucun commentaires publier</span>
                                    </div>
                                    <!--end::Content-->
                                    <!--begin::Close-->
                                    <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                                        <i class="bi bi-x fs-1 text-primary"></i>
                                    </button>
                                    <!--end::Close-->
                                </div>
                            @else
                               <div class="table-responsive">
                                   <table class="table align-middle table-row-bordered gy-5" id="listDownloadComment">
                                       <thead>
                                        <tr>
                                            <th>Package</th>
                                            <th>Date</th>
                                            <th class="text-end"></th>
                                        </tr>
                                       </thead>
                                       <tbody class="text-gray-600 fw-bold">
                                       @foreach($user->downloadcomments()->orderBy('created_at', 'desc')->limit(5)->get() as $comment)
                                       <tr data-kt-docs-datatable-subtable="subtable_template_download" class="bg-lighten d-none">
                                           <td>
                                               <span data-kt-docs-datatable-subtable="template_download_comment">{{ $comment->content }}</span>
                                           </td>
                                       </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-sm-center mb-7">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-60px symbol-2by3 me-4">
                                                        @if(\Illuminate\Support\Facades\Storage::disk("public")->exists('files/shares/download/'.$download->image) == true)
                                                            <div class="symbol-label" style="background-image: url('/storage/files/shares/download/{{ $download->image }}')"></div>
                                                        @else
                                                            <div class="symbol-label" style="background-image: url('https://via.placeholder.com/600x400')"></div>
                                                        @endif
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Title-->
                                                    <div class="d-flex flex-row-fluid flex-wrap align-items-center">
                                                        <div class="flex-grow-1 me-2">
                                                            <a href="{{ route('account.packages.show', $download->id) }}" class="text-gray-800 fw-bolder text-hover-primary fs-6">{{ $download->title }}</a>
                                                            <span class="text-muted fw-bold d-block pt-1">{{ $download->category->title }} -> {{ $download->subcategory->title }}</span>
                                                        </div>
                                                    </div>
                                                    <!--end::Title-->
                                                </div>
                                            </td>
                                            <td>{{ $comment->created_at->format('d/m/Y à H:i') }}</td>
                                            <td class="text-end">
                                                <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px"
                                                        data-kt-docs-datatable-subtable="expand_row_download">
                                                    <span class="svg-icon svg-icon-3 m-0 toggle-off">...</span>
                                                    <span class="svg-icon svg-icon-3 m-0 toggle-on">...</span>
                                                </button>
                                            </td>
                                        </tr>
                                       @endforeach
                                       </tbody>
                                   </table>
                               </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title">Derniers Commentaires (Blog)</h3>
                        </div>
                        <div class="card-body">
                            @if($user->blogcomments()->count() == 0)
                                <div class="alert alert-dismissible bg-light-primary border border-primary d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                                    <!--begin::Icon-->
                                    <!--begin::Svg Icon | path: icons/duotune/files/fil024.svg-->
                                    <span class="svg-icon svg-icon-2hx svg-icon-primary me-4 mb-5 mb-sm-0">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"/>
                                            <rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="black"/>
                                            <rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="black"/>
                                        </svg>
									</span>
                                    <!--end::Svg Icon-->
                                    <!--end::Icon-->
                                    <!--begin::Content-->
                                    <div class="d-flex flex-column pe-0 pe-sm-10">
                                        <span>Aucun commentaires publier</span>
                                    </div>
                                    <!--end::Content-->
                                    <!--begin::Close-->
                                    <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                                        <i class="bi bi-x fs-1 text-primary"></i>
                                    </button>
                                    <!--end::Close-->
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table align-middle table-row-bordered gy-5" id="listDownloadComment">
                                        <thead>
                                        <tr>
                                            <th>Article</th>
                                            <th>Date</th>
                                            <th class="text-end"></th>
                                        </tr>
                                        </thead>
                                        <tbody class="text-gray-600 fw-bold">
                                        @foreach($user->blogcomments()->orderBy('created_at', 'desc')->limit(5)->get() as $comment)
                                            <tr data-kt-docs-datatable-subtable="subtable_template" class="bg-lighten d-none">
                                                <td>
                                                    {{ $comment->content }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-sm-center mb-7">
                                                        <!--begin::Symbol-->
                                                        <div class="symbol symbol-60px symbol-2by3 me-4">
                                                            @if(\Illuminate\Support\Facades\Storage::disk("public")->exists('files/shares/blog/'.$blog->image) == true)
                                                                <div class="symbol-label" style="background-image: url('/storage/files/shares/blog/{{ $blog->image }}')"></div>
                                                            @else
                                                                <div class="symbol-label" style="background-image: url('https://via.placeholder.com/600x400')"></div>
                                                            @endif
                                                        </div>
                                                        <!--end::Symbol-->
                                                        <!--begin::Title-->
                                                        <div class="d-flex flex-row-fluid flex-wrap align-items-center">
                                                            <div class="flex-grow-1 me-2">
                                                                <a href="{{ route('front.blog.show', $blog->slug) }}" class="text-gray-800 fw-bolder text-hover-primary fs-6">{{ $download->title }}</a>
                                                                <span class="text-muted fw-bold d-block pt-1">{{ $blog->category->title }}</span>
                                                            </div>
                                                        </div>
                                                        <!--end::Title-->
                                                    </div>
                                                </td>
                                                <td>{{ $comment->created_at->format('d/m/Y à H:i') }}</td>
                                                <td class="text-end">
                                                    <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px"
                                                            data-kt-docs-datatable-subtable="expand_row">
                                                        <span class="svg-icon svg-icon-3 m-0 toggle-off">...</span>
                                                        <span class="svg-icon svg-icon-3 m-0 toggle-on">...</span>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="configuration" role="tabpanel">
            <div class="row">
                <div class="col-md-9 col-sm-12">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title">Editer mes informations</h3>
                        </div>
                        <form action="{{ route('account.profil.update') }}" method="POST" id="formUpdateUser">
                            <div class="card-body">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Adresse Mail</label>
                                    <input type="email" name="email" class="form-control form-control-solid" value="{{ $user->email }}" required/>
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Nom d'utilisateur ou Pseudo</label>
                                    <input type="text" name="name" class="form-control form-control-solid" value="{{ $user->name }}" required/>
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="form-label">Description</label>
                                    <textarea id="editor" name="description">{!! $user->description !!}</textarea>
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
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title">Editer mon avatar</h3>
                        </div>
                        <form action="{{ route('account.profil.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body text-center">
                                <div class="image-input image-input-circle" data-kt-image-input="true" style="background-image: @if($user->avatar) url({{ $user->avatar }}) @else url(/account/assets/media/avatars/blank.png) @endif">
                                    <!--begin::Image preview wrapper-->
                                    @if($user->avatar)
                                        <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{ $user->avatar }})"></div>
                                    @else
                                        <div class="image-input-wrapper w-125px h-125px" style="background-image: url(/account/assets/media/avatars/blank.png)"></div>
                                    @endif
                                    <!--end::Image preview wrapper-->

                                    <!--begin::Edit button-->
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                           data-kt-image-input-action="change"
                                           data-bs-toggle="tooltip"
                                           data-bs-dismiss="click"
                                           title="Changer mon avatar">
                                        <i class="bi bi-pencil-fill fs-7"></i>

                                        <!--begin::Inputs-->
                                        <input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="profile_avatar_remove" />
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Edit button-->

                                    <!--begin::Cancel button-->
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                          data-kt-image-input-action="cancel"
                                          data-bs-toggle="tooltip"
                                          data-bs-dismiss="click"
                                          title="Annuler">
                                         <i class="bi bi-x fs-2"></i>
                                     </span>
                                    <!--end::Cancel button-->

                                    <!--begin::Remove button-->
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                          data-kt-image-input-action="remove"
                                          data-bs-toggle="tooltip"
                                          data-bs-dismiss="click"
                                          title="Supprimer mon avatar">
                                         <i class="bi bi-x fs-2"></i>
                                    </span>
                                    <!--end::Remove button-->
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
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="security" role="tabpanel">
            <div class="row">
                <div class="col-md-9 col-sm-12">
                    <div class="card shadow-sm mb-10">
                        <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse" data-bs-target="#block_change_password">
                            <h3 class="card-title">Changer mon mot de passe</h3>
                            <div class="card-toolbar rotate-90">
                                <span class="svg-icon svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<polygon points="0 0 24 0 24 24 0 24"></polygon>
											<path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
											<path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999)"></path>
										</g>
									</svg>
                                </span>
                            </div>
                        </div>
                        <div id="block_change_password" class="collapse">
                            <form action="{{ route('account.profil.password') }}" method="post" id="formPasswordUpdate">
                                @csrf
                                @method("PUT")
                                <div class="card-body">
                                    <div class="mb-10">
                                        <label for="exampleFormControlInput1" class="required form-label">Ancien mot de passe</label>
                                        <input type="password" class="form-control form-control-solid" name="old_password" @if($user->password == null) readonly disabled @else required @endif/>
                                    </div>
                                    <div class="mb-10">
                                        <label for="exampleFormControlInput1" class="required form-label">Nouveau mot de passe</label>
                                        <input type="password" class="form-control form-control-solid pr-password" name="password" required/>
                                    </div>
                                    <div class="mb-10">
                                        <label for="exampleFormControlInput1" class="required form-label">Confirmation mot de passe</label>
                                        <input type="password" class="form-control form-control-solid" name="password_confirmation" required/>
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
                    </div>
                    <div class="card shadow-sm mb-10">
                        <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse" data-bs-target="#block_auth">
                            <h3 class="card-title"><span class="badge badge-primary mr-3">Béta</span>&nbsp; Authentification à double facteur</h3>
                            <div class="card-toolbar rotate-90">
                                <span class="svg-icon svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<polygon points="0 0 24 0 24 24 0 24"></polygon>
											<path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
											<path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999)"></path>
										</g>
									</svg>
                                </span>
                            </div>
                        </div>
                        <div id="block_auth" class="collapse">
                            <div class="card-body">
                                <p>L'authentification à double facteur ajoute une deuxième couche de protection à votre compte.</p>
                                <div class="row">
                                    <div class="col-8">
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td class="fw-bold">Etat de l'authentification</td>
                                                <td>
                                                    @if($user->two_factor_secret == null)
                                                        <span class="badge badge-danger">Désactiver</span>
                                                    @else
                                                        <span class="badge badge-success">Activer</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-4">
                                        @if($user->two_factor_secret == null)
                                            <button id="btnStartTotp" class="btn btn-block btn-success"><i
                                                    class="fas fa-lock"></i> Activer l'authentification TOTP
                                            </button>
                                        @else
                                            <button id="btnEndTotp" class="btn btn-block btn-danger"><i
                                                    class="fas fa-unlock"></i> Désactiver l'authentification
                                                TOTP
                                            </button>
                                        @endif
                                            @if($user->two_factor_secret != null)
                                                <div id="contentSvgQrCode">
                                                    <p>Veuillez télécharger Google Authenticator ou un autre
                                                        Programme TOTP et scanner le QR Code ci-dessous:</p>
                                                    <div class="text-center">
                                                        {!! request()->user()->twoFactorQrCodeSvg() !!}
                                                    </div>
                                                </div>
                                            @endif
                                    </div>
                                </div>
                                <p>Si vous rencontrer un disfonctionnement avec cette fonction, veuillez nous le signaler:
                                    <a href="https://helpdesk.transportfeverfrance.fr/public/create-ticket">Soumettre un problème</a></p>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm mb-10">
                        <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse" data-bs-target="#block_device">
                            <h3 class="card-title"><span class="badge badge-primary mr-3">Béta</span>&nbsp; Notification mobile push</h3>
                            <div class="card-toolbar rotate-90">
                                <span class="svg-icon svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<polygon points="0 0 24 0 24 24 0 24"></polygon>
											<path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
											<path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999)"></path>
										</g>
									</svg>
                                </span>
                            </div>
                        </div>
                        <div id="block_device" class="collapse">
                            <div class="card-body">
                                <p>Vous permet de recevoir des notifications sur votre mobile</p>
                                <div class="row">
                                    <div class="col-8">
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td class="fw-bold">Etat</td>
                                                <td>
                                                    @if($user->device->device_token == null)
                                                        <span class="badge badge-danger">Désactiver</span>
                                                    @else
                                                        <span class="badge badge-success">Activer</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-4">
                                        @if($user->device->device_token == null)
                                            <button id="btnStartPushNotification" class="btn btn-block btn-success">
                                                <i class="fas fa-lock"></i> Activer la notification push mobile
                                            </button>
                                        @else
                                            <button id="btnEndPushNotification" class="btn btn-block btn-danger">
                                                <i class="fas fa-unlock"></i> Désactiver la notification push mobile
                                            </button>
                                        @endif
                                    </div>
                                </div>
                                <p>Si vous rencontrer un disfonctionnement avec cette fonction, veuillez nous le signaler:
                                    <a href="https://helpdesk.transportfeverfrance.fr/public/create-ticket">Soumettre un problème</a></p>
                            </div>
                        </div>
                    </div>

                    <div class="card bg-danger shadow-sm mb-10">
                        <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse" data-bs-target="#block_danger">
                            <h3 class="card-title">Danger Zone</h3>
                            <div class="card-toolbar rotate-90">
                                <span class="svg-icon svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<polygon points="0 0 24 0 24 24 0 24"></polygon>
											<path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
											<path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999)"></path>
										</g>
									</svg>
                                </span>
                            </div>
                        </div>
                        <div id="block_danger" class="collapse">
                            <div class="card-body bg-light-danger">
                                <div class="row">
                                    <div class="col-9">
                                        <p class="h3 fw-bold">Vous n'êtes pas satisfait du contenu du site ?<br>
                                            Ou vous souhaitez supprimer toutes les informations associées à ce
                                            compte ?</p>
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-outline-danger btn-block" data-bs-toggle="modal"
                                                data-bs-target="#deleteAccount"><i class="fas fa-trash"></i>
                                            Supprimer mon compte
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title">Etat de la sécurité de votre compte</h3>
                        </div>
                        <div class="card-body text-center">
                            <x-account.shield_security :user="$user"/>
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td class="text-start">Complexité du mot de passe</td>
                                    <td class="text-end">
                                        <x-account.password_complexity :user="$user"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-start">Etat des entrées echouer</td>
                                    <td class="text-end">
                                        <x-account.state_entry_attempt :user="$user"/>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="social" role="tabpanel">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Laison Social</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <!--begin::Card-->
                            <div class="card card-custom gutter-b card-stretch">
                                <!--begin::Body-->
                                <div class="card-body text-center pt-4">
                                    <!--begin::User-->
                                    <div class="mt-7">
                                        <div class="symbol symbol-circle symbol-lg-75">
                                            <i class="socicon-facebook icon-6x"></i>
                                        </div>
                                    </div>
                                    <!--end::User-->
                                    <!--begin::Name-->
                                    <div class="my-2">
                                        <a href="#"
                                           class="text-dark font-weight-bold text-hover-primary font-size-h4">Facebook</a>
                                    </div>
                                    <!--end::Name-->
                                    <!--begin::Label-->
                                    @if($user->social->facebook_id != null)
                                        <span
                                            class="label label-inline label-lg label-light-success btn-sm font-weight-bold">Compte Lié</span>
                                    @else
                                        <span
                                            class="label label-inline label-lg label-light-danger btn-sm font-weight-bold">Désactivé</span>
                                @endif
                                <!--end::Label-->
                                    <!--begin::Buttons-->
                                    <div class="mt-9 mb-6">
                                        @if($user->social->facebook_id != null)
                                            <button class="btn btn-danger">Désactivé</button>
                                        @else
                                            <button class="btn btn-success">Lié le compte</button>
                                        @endif
                                    </div>
                                    <!--end::Buttons-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <!--begin::Card-->
                            <div class="card card-custom gutter-b card-stretch">
                                <!--begin::Body-->
                                <div class="card-body text-center pt-4">
                                    <!--begin::User-->
                                    <div class="mt-7">
                                        <div class="symbol symbol-circle symbol-lg-75">
                                            <i class="socicon-google icon-6x"></i>
                                        </div>
                                    </div>
                                    <!--end::User-->
                                    <!--begin::Name-->
                                    <div class="my-2">
                                        <a href="#"
                                           class="text-dark font-weight-bold text-hover-primary font-size-h4">Google</a>
                                    </div>
                                    <!--end::Name-->
                                    <!--begin::Label-->
                                    @if($user->social->google_id != null)
                                        <span
                                            class="label label-inline label-lg label-light-success btn-sm font-weight-bold">Compte Lié</span>
                                    @else
                                        <span
                                            class="label label-inline label-lg label-light-danger btn-sm font-weight-bold">Désactivé</span>
                                @endif
                                <!--end::Label-->
                                    <!--begin::Buttons-->
                                    <div class="mt-9 mb-6">
                                        @if($user->social->google_id != null)
                                            <button class="btn btn-danger">Désactivé</button>
                                        @else
                                            <button class="btn btn-success">Lié le compte</button>
                                        @endif
                                    </div>
                                    <!--end::Buttons-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <!--begin::Card-->
                            <div class="card card-custom gutter-b card-stretch">
                                <!--begin::Body-->
                                <div class="card-body text-center pt-4">
                                    <!--begin::User-->
                                    <div class="mt-7">
                                        <div class="symbol symbol-circle symbol-lg-75">
                                            <i class="socicon-twitter icon-6x"></i>
                                        </div>
                                    </div>
                                    <!--end::User-->
                                    <!--begin::Name-->
                                    <div class="my-2">
                                        <a href="#"
                                           class="text-dark font-weight-bold text-hover-primary font-size-h4">Twitter</a>
                                    </div>
                                    <!--end::Name-->
                                    <!--begin::Label-->
                                    @if($user->social->twitter_id != null)
                                        <span
                                            class="label label-inline label-lg label-light-success btn-sm font-weight-bold">Compte Lié</span>
                                    @else
                                        <span
                                            class="label label-inline label-lg label-light-danger btn-sm font-weight-bold">Désactivé</span>
                                @endif
                                <!--end::Label-->
                                    <!--begin::Buttons-->
                                    <div class="mt-9 mb-6">
                                        @if($user->social->twitter_id != null)
                                            <button class="btn btn-danger">Désactivé</button>
                                        @else
                                            <button class="btn btn-success">Lié le compte</button>
                                        @endif
                                    </div>
                                    <!--end::Buttons-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <!--begin::Card-->
                            <div class="card card-custom gutter-b card-stretch">
                                <!--begin::Body-->
                                <div class="card-body text-center pt-4">
                                    <!--begin::User-->
                                    <div class="mt-7">
                                        <div class="symbol symbol-circle symbol-lg-75">
                                            <i class="socicon-steam icon-6x"></i>
                                        </div>
                                    </div>
                                    <!--end::User-->
                                    <!--begin::Name-->
                                    <div class="my-2">
                                        <a href="#"
                                           class="text-dark font-weight-bold text-hover-primary font-size-h4">Steam</a>
                                    </div>
                                    <!--end::Name-->
                                    <!--begin::Label-->
                                    @if($user->social->steam_id != null)
                                        <span
                                            class="label label-inline label-lg label-light-success btn-sm font-weight-bold">Compte Lié</span>
                                    @else
                                        <span
                                            class="label label-inline label-lg label-light-danger btn-sm font-weight-bold">Désactivé</span>
                                @endif
                                <!--end::Label-->
                                    <!--begin::Buttons-->
                                    <div class="mt-9 mb-6">
                                        @if($user->social->steam_id != null)
                                            <button class="btn btn-danger">Désactivé</button>
                                        @else
                                            <button class="btn btn-success">Lié le compte</button>
                                        @endif
                                    </div>
                                    <!--end::Buttons-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <!--begin::Card-->
                            <div class="card card-custom gutter-b card-stretch">
                                <!--begin::Body-->
                                <div class="card-body text-center pt-4">
                                    <!--begin::User-->
                                    <div class="mt-7">
                                        <div class="symbol symbol-circle symbol-lg-75">
                                            <i class="socicon-discord icon-6x"></i>
                                        </div>
                                    </div>
                                    <!--end::User-->
                                    <!--begin::Name-->
                                    <div class="my-2">
                                        <a href="#"
                                           class="text-dark font-weight-bold text-hover-primary font-size-h4">Discord</a>
                                    </div>
                                    <!--end::Name-->
                                    <!--begin::Label-->
                                    @if($user->social->discord_user_id != null)
                                        <span
                                            class="label label-inline label-lg label-light-success btn-sm font-weight-bold">Compte Lié</span>
                                    @else
                                        <span
                                            class="label label-inline label-lg label-light-danger btn-sm font-weight-bold">Désactivé</span>
                                @endif
                                <!--end::Label-->
                                    <!--begin::Buttons-->
                                    <div class="mt-9 mb-6">
                                        @if($user->social->discord_user_id != null)
                                            <button class="btn btn-danger">Désactivé</button>
                                        @else
                                            <button class="btn btn-success">Lié le compte</button>
                                        @endif
                                    </div>
                                    <!--end::Buttons-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Card-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmation de la suppression du compte</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <h1 class="fw-bolder">Confirmer la suppression</h1>
                    <p>
                        Vous êtes sur le point de supprimer votre compte {{ env('APP_NAME') }}.<br>
                        Pour confirmer cette demande merci de rentrer votre mot de passe. Le compte
                        sera supprimer dans les 5 jours.
                    </p>
                    <form action="{{ route('account.profil.delete') }}" method="POST" id="formDeleteAccount">
                        @csrf
                        <div class="form-group mb-10">
                            <input type="password" class="form-control" name="password"
                                   placeholder="Entrez votre mot de passe pour confirmer" required>
                        </div>
                        <button class="btn btn-block btn-danger btn-lg" id="btnDeleteAccount"><i
                                class="fas fa-trash"></i> Confirmer la suppression
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end::Row-->
@endsection

@section("script")
    <script src="/account/assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <script
        src="{{ asset('front/assets/plugins/custom/password-requirement/js/jquery.passwordRequirements.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/simplemde/1.11.2/simplemde.min.js"></script>
    <script src="{{ asset('/front/js/account/profil.js') }}"></script>
@endsection
