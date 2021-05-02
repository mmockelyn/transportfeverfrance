@extends("front.layouts.layout")
@section("styles")

@endsection

@section("bread")
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Details-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{ $sub->title }}</h5>
                <!--end::Title-->
                <!--begin::Separator-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                <!--end::Separator-->
                <!--begin::Search Form-->
                <div class="d-flex align-items-center" id="kt_subheader_search">
                    <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">{{ count($sub->downloads) }} Packages disponibles</span>
                    <form class="ml-5">
                        <div class="input-group input-group-sm input-group-solid" style="max-width: 175px">
                            <input type="hidden" name="subcategory_id" id="subcategory_id" value="{{ $sub->id }}">
                            <input type="text" class="form-control" id="searching_package" name="search" placeholder="Recherche...">
                            <div class="input-group-append">
								<span class="input-group-text">
									<span class="svg-icon">
										<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Search.svg-->
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24"></rect>
												<path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
												<path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero"></path>
											</g>
										</svg>
                                        <!--end::Svg Icon-->
									</span>
                                    <!--<i class="flaticon2-search-1 icon-sm"></i>-->
								</span>
                            </div>
                        </div>
                    </form>
                </div>
                <!--end::Search Form-->
            </div>
            <!--end::Details-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <!--begin::Button-->
                @auth()
                <a href="#" class="btn btn-light-primary font-weight-bold ml-2">Ajouter un packages</a>
                @endauth
                <!--end::Button-->
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
@endsection

@section("content")
    <!-- Slider -->
    <div class="container-fluid mt-5">
        <div class="row" id="search_result">
            @foreach($downloads as $download)
                <div class="col-4">
                    <div class="card card-custom gutter-b card-stretch">
                        <!--begin::Body-->
                        <div class="card-body pt-4">
                            <!--begin::User-->
                            <div class="d-flex align-items-center mb-7">
                                <!--begin::Pic-->
                                <div class="flex-shrink-0 mr-4">
                                    <div class="symbol symbol-circle symbol-lg-75">
                                        <img src="storage/files/shares/download/{{ $download->image }}" alt="image">
                                    </div>
                                </div>
                                <!--end::Pic-->
                                <!--begin::Title-->
                                <div class="d-flex flex-column">
                                    <a href="{{ route('front.download.show', $download->slug) }}" class="text-dark font-weight-bold text-hover-primary font-size-h4 mb-0">{{ $download->title }}</a>
                                    @if($download->provider == 'steam')
                                        <span class="label label-lg label-inline font-weight-bold label-rounded">
                                            <span class="symbol symbol-20 mr-3">
                                                <img alt="Pic" src="storage/files/shares/core/icons/steam_icon.png"/>
                                            </span> Steam
                                        </span>
                                    @endif
                                    @if($download->provider == 'tfnet')
                                        <span class="label label-lg label-inline font-weight-bold label-rounded">
                                            <span class="symbol symbol-20 mr-3">
                                                <img alt="Pic" src="storage/files/shares/core/icons/tf_net_icon.png"/>
                                            </span> Transport Fever.net
                                        </span>
                                    @endif
                                    @if($download->provider == 'tf_france')
                                        <span class="label label-lg label-inline font-weight-bold label-rounded">
                                            <span class="symbol symbol-20 mr-3">
                                                <img alt="Pic" src="storage/files/shares/core/icons/tf_france_icon.png"/>
                                            </span> Transport Fever France
                                        </span>
                                    @endif
                                    @if($download->provider == 'null')
                                        <span class="label label-lg label-inline font-weight-bold label-rounded">
                                            <span class="symbol symbol-20 mr-3">
                                                <img alt="Pic" src="storage/files/shares/core/icons/null_icon.png"/>
                                            </span> Interieur
                                        </span>
                                    @endif
                                </div>
                                <!--end::Title-->
                            </div>
                            <!--end::User-->
                            <!--begin::Desc-->
                            <p class="mb-7">{{ $download->short_content }}</p>
                            <!--end::Desc-->
                            <!--begin::Info-->
                            <div class="mb-7">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-dark-75 font-weight-bolder mr-2">Version:</span>
                                    <a href="#" class="text-muted text-hover-primary">1.0</a>
                                </div>
                                <div class="d-flex justify-content-between align-items-cente my-1">
                                    <span class="text-dark-75 font-weight-bolder mr-2">Mise à jours:</span>
                                    <a href="#" class="text-muted text-hover-primary">{{ formatDate($download->updated_at) }}</a>
                                </div>
                            </div>
                            <!--end::Info-->
                            <a href="{{ route('front.download.show', $download->slug) }}" class="btn btn-block btn-sm btn-light-success font-weight-bolder text-uppercase py-4">Voir le package</a>
                        </div>
                        <!--end::Body-->
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section("scripts")
    <script src="{{ asset('front/js/download/category.js') }}"></script>
@endsection
