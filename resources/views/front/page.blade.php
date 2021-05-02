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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">{{ $page->title }}</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Accueil</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">{{ $page->title }}</a>
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
    <div class="container-fluid">
        <div class="card card-custom mt-5">
            <div class="card-header">
                <h3 class="card-title">{{ $page->title }}</h3>
            </div>
            <div class="card-body">
                {!! $page->body !!}
            </div>
        </div>
    </div>
@endsection

@section("scripts")

@endsection
