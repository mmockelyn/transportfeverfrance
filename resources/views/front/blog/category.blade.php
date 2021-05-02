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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">{!! $title !!}</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Accueil</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Blog</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">{!! $title !!}</a>
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
        <div class="card card-custom mt-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8" style="border-right: solid 3px #7f7d7d">
                        <h3 class="title mb-lg-5">{!! $title !!}</h3>
                        <div class="row g-10">
                            @foreach($blogs as $blog)
                                <div class="col-md-4 mb-4">
                                    <!--begin::Feature post-->
                                    <div class="card-xl-stretch me-md-6">
                                        <!--begin::Image-->
                                        <a class="d-block bgi-no-repeat bgi-size-cover bgi-position-center card-rounded position-relative min-h-175px mb-5" style="background-image:url('storage/files/shares/blog/{{ $blog->image }}')" data-fslightbox="lightbox-video-tutorials" href="{{ route('front.blog.show', $blog->slug) }}"></a>
                                        <!--end::Image-->
                                        <!--begin::Body-->
                                        <div class="m-0">
                                            <!--begin::Title-->
                                            <a href="{{ route('front.blog.show', $blog->slug) }}" class="h4 text-dark fw-bolder text-hover-primary text-dark lh-base">{{ $blog->title }}</a>
                                            <!--end::Title-->
                                            <!--begin::Text-->
                                            <div class="fw-bold fs-5 text-gray-600 text-dark my-4">{{ $blog->short_content }}</div>
                                            <!--end::Text-->
                                            <!--begin::Content-->
                                            <div class="fs-6 fw-bolder">
                                                <!--begin::Date-->
                                                <span class="text-muted">Publier le {{ formatDateHour($blog->created_at) }}</span>
                                                <!--end::Date-->
                                            </div>
                                            <!--end::Content-->
                                        </div>
                                        <!--end::Body-->
                                    </div>
                                    <!--end::Feature post-->
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-4">
                        <!-- Categories -->
                        <div class="mb-16">
                            <h4 class="text-black mb-7">Categories</h4>
                            @foreach($categories as $category)
                            <div class="d-flex flex-wrap align-items-center justify-content-between w-100">
                                <!--begin::Info-->
                                <div class="d-flex flex-column align-items-cente py-2 w-75">
                                    <!--begin::Title-->
                                    <a href="{{ route('front.blog.category', $category->slug) }}" class="text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1 ">{{ $category->title }}</a>
                                    <!--end::Title-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Label-->
                                <span class="label label-lg label-light-primary label-inline font-weight-bold py-4">{{ count($category->blogs) }}</span>
                                <!--end::Label-->
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")

@endsection
