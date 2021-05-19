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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Création d'un package</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Accueil</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Mes packages</a>
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
    <div class="container-fluid" id="package_create" data-id="{{ auth()->user()->id }}">
        <div class="card card-custom">
            <div class="card-header">
                <h3 class="card-title">Selection de la source de publication du mod</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div class="card card-custom wave wave-animate-slow wave-steam mb-8 mb-lg-0" >
                            <div class="card-body">
                                <div class="d-flex align-items-center p-5">
                                    <div class="mr-6">
                                        <div class="symbol symbol-75 symbol-lg-60 symbol-circle">
                                            <img alt="Pic" src="/storage/files/shares/core/icons/steam_icon.png" class="h-75"/>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <a href="{{ route('account.packages.createSteam') }}" class="text-dark text-hover-default font-weight-bold font-size-h4 mb-3">
                                            Steam
                                        </a>
                                        <div class="text-dark-75">
                                            Créer votre packages, et une fois publier, envoyer le sur le steam workshop.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card card-custom wave wave-animate-slow wave-tfnet mb-8 mb-lg-0" >
                            <div class="card-body">
                                <div class="d-flex align-items-center p-5">
                                    <div class="mr-6">
                                        <div class="symbol symbol-75 symbol-lg-60 symbol-circle">
                                            <img alt="Pic" src="/storage/files/shares/core/icons/tf_net_icon.png" class="h-75"/>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <a href="{{ route('account.packages.createTfnet') }}" class="text-dark text-hover-danger font-weight-bold font-size-h4 mb-3">
                                            Transport fever.net
                                        </a>
                                        <div class="text-dark-75">
                                            Créer votre packages, et une fois publier, envoyer le sur transportfever.net.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card card-custom wave wave-animate-slow wave-primary mb-8 mb-lg-0" >
                            <div class="card-body">
                                <div class="d-flex align-items-center p-5">
                                    <div class="mr-6">
                                        <div class="symbol symbol-75 symbol-lg-60 symbol-circle">
                                            <img alt="Pic" src="/storage/files/shares/core/icons/tf_france_icon.png" class="h-75"/>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <a href="{{ route('account.packages.createTffrance') }}" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">
                                            Transport Fever France
                                        </a>
                                        <div class="text-dark-75">
                                            Créer votre packages, et une fois publier, envoyer le sur Transport Fever France.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
@endsection
