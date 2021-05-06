@extends("front.layouts.layout")
@section("styles")
    <link rel="stylesheet" href="{{ asset('front/assets/plugins/custom/password-requirement/css/jquery.passwordRequirements.css') }}">
@endsection

@section("bread")
    <div class="subheader py-2 py-lg-6 subheader-transparent" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Mon Profil</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Accueil</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Mon Profil</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
        </div>
    </div>
@endsection

@section("content")
    <!-- Slider -->
    <div class="container-fluid" id="profile" data-id="{{ $user->id }}">
        <x-account.deleted_account :user="$user"/>
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <!--begin::Details-->
                <div class="d-flex mb-9">
                    <!--begin: Pic-->
                    <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                        <div class="symbol symbol-80 symbol-lg-80">
                            @if($user->avatar)
                                <img src="{{ $user->avatar }}" alt="image">
                            @else
                                <img src="{{ \Creativeorange\Gravatar\Facades\Gravatar::get($user->email) }}" alt="image">
                            @endif

                        </div>
                    </div>
                    <!--end::Pic-->
                    <!--begin::Info-->
                    <div class="flex-grow-1">
                        <!--begin::Title-->
                        <div class="d-flex justify-content-between flex-wrap mt-1">
                            <div class="d-flex mr-3">
                                <a href="#" class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3">{{ \Illuminate\Support\Str::ucfirst($user->name) }}</a>
                                @if(\Illuminate\Support\Facades\Cache::has('user-is-online-'.$user->id) == true)
                                <a href="#"><i class="fas fa-circle text-success"></i></a>
                                @else
                                    <a href="#"><i class="fas fa-circle text-danger"></i></a>
                                @endif
                            </div>
                            <div class="my-lg-0 my-3">
                                <!--<a href="#" class="btn btn-sm btn-light-success font-weight-bolder text-uppercase mr-3">ask</a>
                                <a href="#" class="btn btn-sm btn-info font-weight-bolder text-uppercase">hire</a>-->
                                @if($user->valid == 0 && $user->email_verified_at == null)
                                    <a href="/email/verify" class="btn btn-xs btn-danger" data-toggle="tooltip" data-theme="dark" title="Renvoyer le mail de vérification"><i class="fas fa-envelope"></i> Compte non valider</a>
                                @endif
                                <x-account.social_active :user="$user"/>
                            </div>
                        </div>
                        <!--end::Title-->
                        <!--begin::Content-->
                        <div class="d-flex flex-wrap justify-content-between mt-1">
                            <div class="d-flex flex-column flex-grow-1 pr-8">
                                <div class="d-flex flex-wrap mb-4">
                                    <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                        <i class="flaticon2-new-email mr-2 font-size-lg"></i>{{ $user->email }}</a>
                                    <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                        @if(\Illuminate\Support\Facades\Cache::has('user-is-online-'.$user->id) == true)
                                            <i class="flaticon2-calendar-3 mr-2 font-size-lg"></i>Dernière connexion: <span class="text-success fw-bold">Connecter</span></a>
                                        @else
                                            <i class="flaticon2-calendar-3 mr-2 font-size-lg"></i>Dernière connexion: {{ $user->last_seen->diffForHumans() }}</a>
                                        @endif
                                    <a href="#" class="text-dark-50 text-hover-primary font-weight-bold">
                                        <i class="flaticon2-folder mr-2 font-size-lg"></i>{{ \App\Helpers\Format::formatUserGroup($user->group) }}</a>
                                </div>
                                <div class="font-weight-bold text-dark-50">{!! $user->description !!}</div>
                            </div>
                            <div class="d-flex align-items-center w-25 flex-fill float-right mt-lg-12 mt-8">
                                <span class="font-weight-bold text-dark-75">Profil</span>
                                {!! \App\Helpers\Format::percentProfilComplete($profilPercent) !!}
                            </div>
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Details-->
                <div class="separator separator-solid"></div>
                <!--begin::Items-->
                <div class="row">
                    <div class="col-md-8">
                        <ul class="nav nav-pills nav-primary row row-paddingless m-0 p-0 flex-column flex-sm-row" role="tablist">
                            <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
                                <a class="nav-link border py-10 d-flex flex-grow-1 rounded flex-column align-items-center active" data-toggle="tab" href="#overview">
                                    <span class="nav-icon py-2 w-auto">
										<span class="svg-icon svg-icon-3x">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <polygon points="0 0 24 0 24 24 0 24"/>
                                                    <circle fill="#000000" opacity="0.3" cx="15" cy="17" r="5"/>
                                                    <circle fill="#000000" opacity="0.3" cx="9" cy="17" r="5"/>
                                                    <circle fill="#000000" opacity="0.3" cx="7" cy="11" r="5"/>
                                                    <circle fill="#000000" opacity="0.3" cx="17" cy="11" r="5"/>
                                                    <circle fill="#000000" opacity="0.3" cx="12" cy="7" r="5"/>
                                                </g>
                                            </svg>
										</span>
									</span>
                                    <span class="nav-text font-size-lg py-2 font-weight-bold text-center">Aperçu</span>
                                </a>
                            </li>
                            <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
                                <a class="nav-link border py-10 d-flex flex-grow-1 rounded flex-column align-items-center" data-toggle="tab" href="#config">
                                    <span class="nav-icon py-2 w-auto">
										<span class="svg-icon svg-icon-3x">
											<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Home/Library.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <path d="M18.6225,9.75 L18.75,9.75 C19.9926407,9.75 21,10.7573593 21,12 C21,13.2426407 19.9926407,14.25 18.75,14.25 L18.6854912,14.249994 C18.4911876,14.250769 18.3158978,14.366855 18.2393549,14.5454486 C18.1556809,14.7351461 18.1942911,14.948087 18.3278301,15.0846699 L18.372535,15.129375 C18.7950334,15.5514036 19.03243,16.1240792 19.03243,16.72125 C19.03243,17.3184208 18.7950334,17.8910964 18.373125,18.312535 C17.9510964,18.7350334 17.3784208,18.97243 16.78125,18.97243 C16.1840792,18.97243 15.6114036,18.7350334 15.1896699,18.3128301 L15.1505513,18.2736469 C15.008087,18.1342911 14.7951461,18.0956809 14.6054486,18.1793549 C14.426855,18.2558978 14.310769,18.4311876 14.31,18.6225 L14.31,18.75 C14.31,19.9926407 13.3026407,21 12.06,21 C10.8173593,21 9.81,19.9926407 9.81,18.75 C9.80552409,18.4999185 9.67898539,18.3229986 9.44717599,18.2361469 C9.26485393,18.1556809 9.05191298,18.1942911 8.91533009,18.3278301 L8.870625,18.372535 C8.44859642,18.7950334 7.87592081,19.03243 7.27875,19.03243 C6.68157919,19.03243 6.10890358,18.7950334 5.68746499,18.373125 C5.26496665,17.9510964 5.02757002,17.3784208 5.02757002,16.78125 C5.02757002,16.1840792 5.26496665,15.6114036 5.68716991,15.1896699 L5.72635306,15.1505513 C5.86570889,15.008087 5.90431906,14.7951461 5.82064513,14.6054486 C5.74410223,14.426855 5.56881236,14.310769 5.3775,14.31 L5.25,14.31 C4.00735931,14.31 3,13.3026407 3,12.06 C3,10.8173593 4.00735931,9.81 5.25,9.81 C5.50008154,9.80552409 5.67700139,9.67898539 5.76385306,9.44717599 C5.84431906,9.26485393 5.80570889,9.05191298 5.67216991,8.91533009 L5.62746499,8.870625 C5.20496665,8.44859642 4.96757002,7.87592081 4.96757002,7.27875 C4.96757002,6.68157919 5.20496665,6.10890358 5.626875,5.68746499 C6.04890358,5.26496665 6.62157919,5.02757002 7.21875,5.02757002 C7.81592081,5.02757002 8.38859642,5.26496665 8.81033009,5.68716991 L8.84944872,5.72635306 C8.99191298,5.86570889 9.20485393,5.90431906 9.38717599,5.82385306 L9.49484664,5.80114977 C9.65041313,5.71688974 9.7492905,5.55401473 9.75,5.3775 L9.75,5.25 C9.75,4.00735931 10.7573593,3 12,3 C13.2426407,3 14.25,4.00735931 14.25,5.25 L14.249994,5.31450877 C14.250769,5.50881236 14.366855,5.68410223 14.552824,5.76385306 C14.7351461,5.84431906 14.948087,5.80570889 15.0846699,5.67216991 L15.129375,5.62746499 C15.5514036,5.20496665 16.1240792,4.96757002 16.72125,4.96757002 C17.3184208,4.96757002 17.8910964,5.20496665 18.312535,5.626875 C18.7350334,6.04890358 18.97243,6.62157919 18.97243,7.21875 C18.97243,7.81592081 18.7350334,8.38859642 18.3128301,8.81033009 L18.2736469,8.84944872 C18.1342911,8.99191298 18.0956809,9.20485393 18.1761469,9.38717599 L18.1988502,9.49484664 C18.2831103,9.65041313 18.4459853,9.7492905 18.6225,9.75 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                    <path d="M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000"/>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
										</span>
									</span>
                                    <span class="nav-text font-size-lg py-2 font-weight-bold text-center">Configuration</span>
                                </a>
                            </li>
                            <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
                                <a class="nav-link border py-10 d-flex flex-grow-1 rounded flex-column align-items-center" data-toggle="tab" href="#security">
                                    <span class="nav-icon py-2 w-auto">
										<span class="svg-icon svg-icon-3x">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" fill="#000000" opacity="0.3"/>
                                                    <path d="M14.5,11 C15.0522847,11 15.5,11.4477153 15.5,12 L15.5,15 C15.5,15.5522847 15.0522847,16 14.5,16 L9.5,16 C8.94771525,16 8.5,15.5522847 8.5,15 L8.5,12 C8.5,11.4477153 8.94771525,11 9.5,11 L9.5,10.5 C9.5,9.11928813 10.6192881,8 12,8 C13.3807119,8 14.5,9.11928813 14.5,10.5 L14.5,11 Z M12,9 C11.1715729,9 10.5,9.67157288 10.5,10.5 L10.5,11 L13.5,11 L13.5,10.5 C13.5,9.67157288 12.8284271,9 12,9 Z" fill="#000000"/>
                                                </g>
                                            </svg>
										</span>
									</span>
                                    <span class="nav-text font-size-lg py-2 font-weight-bold text-center">Sécurité</span>
                                </a>
                            </li>
                            <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
                                <a class="nav-link border py-10 d-flex flex-grow-1 rounded flex-column align-items-center" data-toggle="tab" href="#social">
                                    <span class="nav-icon py-2 w-auto">
										<span class="svg-icon svg-icon-3x">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <polygon points="0 0 24 0 24 24 0 24"/>
                                                    <rect fill="#000000" opacity="0.3" transform="translate(13.000000, 6.000000) rotate(-450.000000) translate(-13.000000, -6.000000) " x="12" y="8.8817842e-16" width="2" height="12" rx="1"/>
                                                    <path d="M9.79289322,3.79289322 C10.1834175,3.40236893 10.8165825,3.40236893 11.2071068,3.79289322 C11.5976311,4.18341751 11.5976311,4.81658249 11.2071068,5.20710678 L8.20710678,8.20710678 C7.81658249,8.59763107 7.18341751,8.59763107 6.79289322,8.20710678 L3.79289322,5.20710678 C3.40236893,4.81658249 3.40236893,4.18341751 3.79289322,3.79289322 C4.18341751,3.40236893 4.81658249,3.40236893 5.20710678,3.79289322 L7.5,6.08578644 L9.79289322,3.79289322 Z" fill="#000000" fill-rule="nonzero" transform="translate(7.500000, 6.000000) rotate(-270.000000) translate(-7.500000, -6.000000) "/>
                                                    <rect fill="#000000" opacity="0.3" transform="translate(11.000000, 18.000000) scale(1, -1) rotate(90.000000) translate(-11.000000, -18.000000) " x="10" y="12" width="2" height="12" rx="1"/>
                                                    <path d="M18.7928932,15.7928932 C19.1834175,15.4023689 19.8165825,15.4023689 20.2071068,15.7928932 C20.5976311,16.1834175 20.5976311,16.8165825 20.2071068,17.2071068 L17.2071068,20.2071068 C16.8165825,20.5976311 16.1834175,20.5976311 15.7928932,20.2071068 L12.7928932,17.2071068 C12.4023689,16.8165825 12.4023689,16.1834175 12.7928932,15.7928932 C13.1834175,15.4023689 13.8165825,15.4023689 14.2071068,15.7928932 L16.5,18.0857864 L18.7928932,15.7928932 Z" fill="#000000" fill-rule="nonzero" transform="translate(16.500000, 18.000000) scale(1, -1) rotate(270.000000) translate(-16.500000, -18.000000) "/>
                                                </g>
                                            </svg>
										</span>
									</span>
                                    <span class="nav-text font-size-lg py-2 font-weight-bold text-center">Connexion Social</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex align-items-center flex-wrap mt-8">
                            <!--begin::Item-->
                            <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
												<span class="mr-4">
													<i class="flaticon-chat-1 display-4 text-muted font-weight-bold"></i>
												</span>
                                <div class="d-flex flex-column text-dark-75">
                                    <span class="font-weight-bolder font-size-sm">Commentaires</span>
                                    <span class="font-weight-bolder font-size-h5 numbercomment"></span>
                                </div>
                            </div>
                            <!--end::Item-->
                        </div>
                    </div>
                </div>
                <!--begin::Items-->
            </div>
        </div>
        <div class="tab-content pt-5">
            <div class="tab-pane active" id="overview" role="tabpanel">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-custom card-stretch gutter-b">
                            <!--begin::Header-->
                            <div class="card-header border-0">
                                <h3 class="card-title font-weight-bolder text-dark">Derniers Packages</h3>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-2">
                                <!--begin::Item-->
                                @if($user->downloads()->count() == 0)
                                    <div class="alert alert-custom alert-outline-primary fade show mb-5" role="alert">
                                        <div class="alert-icon">
                                            <i class="flaticon-close"></i>
                                        </div>
                                        <div class="alert-text">Aucun package disponible</div>
                                    </div>
                                @else
                                    @foreach($user->downloads()->orderBy('updated_at', 'desc')->limit(5)->get() as $download)
                                        <div class="d-flex flex-wrap align-items-center mb-10">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-60 symbol-2by3 flex-shrink-0 mr-4">
                                                @if(\Illuminate\Support\Facades\Storage::exists('files/shares/download/'.$download->image) == true)
                                                    <div class="symbol-label" style="background-image: url('/storage/files/shares/download/{{ $download->image }}')"></div>
                                                @else
                                                    <div class="symbol-label" style="background-image: url('https://via.placeholder.com/600x400')"></div>
                                                @endif
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                                                <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $download->title }}</a>
                                                <span class="text-muted font-weight-bold font-size-sm my-1">{{ $download->category->title }} -> {{ $download->subcategory->title }}</span>
                                                <span class="text-muted font-weight-bold font-size-sm">Mise à jour:
																<span class="text-primary font-weight-bold">{{ $download->updated_at->format("d/m/Y à H:i") }}</span></span>
                                            </div>
                                            <!--end::Title-->
                                            <!--begin::Info-->
                                            <div class="d-flex align-items-center py-lg-0 py-2">
                                                <div class="d-flex flex-column text-right mr-5">
                                                    <span class="text-dark-75 font-weight-bolder font-size-h4">{{ $download->count_view }}</span>
                                                    <span class="text-muted font-size-sm font-weight-bolder">Vues</span>
                                                </div>
                                                <div class="d-flex flex-column text-right">
                                                    <button class="btn btn-icon btn-lg btn-default"><i class="fas fa-eye"></i> </button>
                                                </div>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                @endforeach
                                @endif
                                <!--end::Item-->
                            </div>
                            <!--end::Body-->
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-custom card-stretch gutter-b">
                            <!--begin::Header-->
                            <div class="card-header border-0">
                                <h3 class="card-title font-weight-bolder text-dark">Derniers Commentaire (Téléchargement)</h3>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-2">
                                <!--begin::Item-->
                                @if($user->downloadcomments()->count() == 0)
                                    <div class="alert alert-custom alert-outline-primary fade show mb-5" role="alert">
                                        <div class="alert-icon">
                                            <i class="flaticon-close"></i>
                                        </div>
                                        <div class="alert-text">Aucun Commentaire publier</div>
                                    </div>
                                @else
                                    @foreach($user->downloadcomments()->orderBy('updated_at', 'desc')->limit(5)->get() as $comment)

                                    @endforeach
                            @endif
                            <!--end::Item-->
                            </div>
                            <!--end::Body-->
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-custom card-stretch gutter-b">
                            <!--begin::Header-->
                            <div class="card-header border-0">
                                <h3 class="card-title font-weight-bolder text-dark">Derniers Commentaire (Blog)</h3>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-2">
                                <!--begin::Item-->
                                @if($user->blogcomments()->count() == 0)
                                    <div class="alert alert-custom alert-outline-primary fade show mb-5" role="alert">
                                        <div class="alert-icon">
                                            <i class="flaticon-close"></i>
                                        </div>
                                        <div class="alert-text">Aucun Commentaire publier</div>
                                    </div>
                                @else
                                    @foreach($user->blogcomments()->orderBy('updated_at', 'desc')->limit(5)->get() as $comment)

                                    @endforeach
                            @endif
                            <!--end::Item-->
                            </div>
                            <!--end::Body-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="config" role="tabpanel">
                <div class="row">
                    <div class="col-9">
                        <div class="card card-custom">
                            <div class="card-header">
                                <h3 class="card-title">Editer mes informations</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('account.profil.update') }}" method="POST" id="formUpdateUser">
                                    @csrf
                                    <div class="form-group">
                                        <label>Adresse Mail</label>
                                        <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Nom d'utilisateur ou Pseudo</label>
                                        <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control summernote" name="description">{!! $user->description !!}</textarea>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" id="btnFormUpdateUser" class="btn btn-primary"><i class="fas fa-check"></i> Mettre à jour</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card card-custom">
                            <div class="card-header">
                                <h3 class="card-title">Edition de l'avatar</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('account.profil.avatar') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="image-input image-input-outline image-input-circle" id="kt_image_3">
                                        @if($user->avatar)
                                            <div class="image-input-wrapper" style="background-image: url({{ $user->avatar }})"></div>
                                        @else
                                            <div class="image-input-wrapper" style="background-image: url({{ \Creativeorange\Gravatar\Facades\Gravatar::get($user->email) }})"></div>
                                        @endif

                                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                            <input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg"/>
                                            <input type="hidden" name="profile_avatar_remove"/>
                                        </label>

                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                          <i class="ki ki-bold-close icon-xs text-muted"></i>
                                         </span>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" id="btnFormUpdateUser" class="btn btn-block btn-primary"><i class="fas fa-check"></i> Mettre à jour</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="security" role="tabpanel">
                <div class="row">
                    <div class="col-9">
                        <div class="accordion accordion-solid accordion-panel accordion-svg-toggle" id="accordionExample8">
                            <div class="card">
                                <div class="card-header" id="headingOne8">
                                    <div class="card-title" data-toggle="collapse" data-target="#password">
                                        <div class="card-label">Changement du mot de passe</div>
                                        <span class="svg-icon">
											<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Navigation/Angle-double-right.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<polygon points="0 0 24 0 24 24 0 24"></polygon>
													<path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
													<path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999)"></path>
												</g>
											</svg>
                                        <!--end::Svg Icon-->
										</span>
                                    </div>
                                </div>
                                <div id="password" class="collapse show" data-parent="#accordionExample8">
                                    <div class="card-body">
                                        <form action="{{ route('account.profil.password') }}" method="POST" id="formPasswordUpdate">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label>Ancien mot de passe <span class="text-danger">*</span></label>
                                                <input type="password" class="form-control" name="old_password" @if($user->password == null) readonly disabled @else required @endif >
                                            </div>
                                            <div class="form-group">
                                                <label>Nouveau mot de passe <span class="text-danger">*</span></label>
                                                <input type="password" class="form-control pr-password" name="password" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Confirmation du mot de passe <span class="text-danger">*</span></label>
                                                <input type="password" class="form-control" name="password_confirmation" required>
                                            </div>
                                            <div class="text-right">
                                                <button type="submit" class="btn btn-primary" id="btnFormPassUpdate"><i class="fas fa-check"></i> Mettre à jours</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingOne8">
                                    <div class="card-title" data-toggle="collapse" data-target="#dangerZone">
                                        <div class="card-label text-danger">Danger Zone</div>
                                        <span class="svg-icon">
											<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Navigation/Angle-double-right.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<polygon points="0 0 24 0 24 24 0 24"></polygon>
													<path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
													<path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999)"></path>
												</g>
											</svg>
                                        <!--end::Svg Icon-->
										</span>
                                    </div>
                                </div>
                                <div id="dangerZone" class="collapse" data-parent="#accordionExample8">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-9">
                                                <p class="h3 fw-bold">Vous n'êtes pas satisfait du contenu du site ?<br>
                                                    Ou vous souhaitez supprimer toutes les informations associées à ce compte ?</p>
                                            </div>
                                            <div class="col-3">
                                                <button class="btn btn-outline-danger btn-block" data-toggle="modal" data-target="#deleteAccount"><i class="fas fa-trash"></i> Supprimer mon compte</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card card-custom">
                            <div class="card-header">
                                <h3 class="card-title">Etat de la sécurité de votre compte</h3>
                            </div>
                            <div class="card-body text-center">
                                <x-account.shield_security :user="$user"/>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="text-left">Complexité du mot de passe</td>
                                            <td class="text-right">
                                                <x-account.password_complexity :user="$user"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Etat des entrées echouer</td>
                                            <td class="text-right">
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
                <div class="card card-custom">
                    <div class="card-header">
                        <h3 class="card-title">Liaison Social</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
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
                                            <a href="#" class="text-dark font-weight-bold text-hover-primary font-size-h4">Facebook</a>
                                        </div>
                                        <!--end::Name-->
                                        <!--begin::Label-->
                                        @if($user->social->facebook_id != null)
                                            <span class="label label-inline label-lg label-light-success btn-sm font-weight-bold">Compte Lié</span>
                                        @else
                                            <span class="label label-inline label-lg label-light-danger btn-sm font-weight-bold">Désactivé</span>
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
                            <div class="col-3">
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
                                            <a href="#" class="text-dark font-weight-bold text-hover-primary font-size-h4">Google</a>
                                        </div>
                                        <!--end::Name-->
                                        <!--begin::Label-->
                                        @if($user->social->google_id != null)
                                            <span class="label label-inline label-lg label-light-success btn-sm font-weight-bold">Compte Lié</span>
                                        @else
                                            <span class="label label-inline label-lg label-light-danger btn-sm font-weight-bold">Désactivé</span>
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
                            <div class="col-3">
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
                                            <a href="#" class="text-dark font-weight-bold text-hover-primary font-size-h4">Twitter</a>
                                        </div>
                                        <!--end::Name-->
                                        <!--begin::Label-->
                                        @if($user->social->twitter_id != null)
                                            <span class="label label-inline label-lg label-light-success btn-sm font-weight-bold">Compte Lié</span>
                                        @else
                                            <span class="label label-inline label-lg label-light-danger btn-sm font-weight-bold">Désactivé</span>
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
                            <div class="col-3">
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
                                            <a href="#" class="text-dark font-weight-bold text-hover-primary font-size-h4">Steam</a>
                                        </div>
                                        <!--end::Name-->
                                        <!--begin::Label-->
                                        @if($user->social->steam_id != null)
                                            <span class="label label-inline label-lg label-light-success btn-sm font-weight-bold">Compte Lié</span>
                                        @else
                                            <span class="label label-inline label-lg label-light-danger btn-sm font-weight-bold">Désactivé</span>
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
                            <div class="col-3">
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
                                            <a href="#" class="text-dark font-weight-bold text-hover-primary font-size-h4">Discord</a>
                                        </div>
                                        <!--end::Name-->
                                        <!--begin::Label-->
                                        @if($user->social->discord_user_id != null)
                                            <span class="label label-inline label-lg label-light-success btn-sm font-weight-bold">Compte Lié</span>
                                        @else
                                            <span class="label label-inline label-lg label-light-danger btn-sm font-weight-bold">Désactivé</span>
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
    </div>
    <div class="modal fade" id="deleteAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
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
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Entrez votre mot de passe pour confirmer" required>
                        </div>
                        <button class="btn btn-block btn-danger btn-lg" id="btnDeleteAccount"><i class="fas fa-trash"></i> Confirmer la suppression</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script src="{{ asset('front/assets/plugins/custom/password-requirement/js/jquery.passwordRequirements.js') }}"></script>
    <script src="{{ asset('/front/js/account/profil.js') }}"></script>
@endsection