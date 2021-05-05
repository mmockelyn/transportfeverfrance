@extends("front.layouts.layout")
@section("styles")

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
    </div>
@endsection

@section("scripts")
    <script src="{{ asset('/front/js/account/profil.js') }}"></script>
@endsection
