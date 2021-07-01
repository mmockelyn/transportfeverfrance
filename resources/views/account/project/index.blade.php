@extends("front.layouts.layout")
@section("styles")

@endsection

@section("bread")
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Details-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Mes Projets</h5>
                <!--end::Title-->
            </div>
            <!--end::Details-->
        </div>
    </div>
@endsection

@section("content")
    @if(auth()->user()->social->project_active_user == 0)
        <div class="container-fluid">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <!--begin::Alert-->
                    <div class="alert alert-dismissible bg-light-warning d-flex flex-center flex-column py-10 px-10 px-lg-20 mb-10">

                        <!--begin::Icon-->
                        <span class="svg-icon svg-icon-5tx svg-icon-warning mb-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<path d="M11.1669899,4.49941818 L2.82535718,19.5143571 C2.557144,19.9971408 2.7310878,20.6059441 3.21387153,20.8741573 C3.36242953,20.9566895 3.52957021,21 3.69951446,21 L21.2169432,21 C21.7692279,21 22.2169432,20.5522847 22.2169432,20 C22.2169432,19.8159952 22.1661743,19.6355579 22.070225,19.47855 L12.894429,4.4636111 C12.6064401,3.99235656 11.9909517,3.84379039 11.5196972,4.13177928 C11.3723594,4.22181902 11.2508468,4.34847583 11.1669899,4.49941818 Z" fill="#000000" opacity="0.3"></path>
							<rect fill="#000000" x="11" y="9" width="2" height="7" rx="1"></rect>
							<rect fill="#000000" x="11" y="17" width="2" height="2" rx="1"></rect>
						</svg>
                    </span>
                        <!--end::Icon-->

                        <!--begin::Wrapper-->
                        <div class="text-center">
                            <!--begin::Title-->
                            <h5 class="fw-bolder fs-1 mb-5">Information</h5>
                            <!--end::Title-->

                            <!--begin::Separator-->
                            <div class="separator separator-dashed border-danger opacity-25 mb-5"></div>
                            <!--end::Separator-->

                            <!--begin::Content-->
                            <div class="mb-9">
                                Votre compte n'est actuellement pas lié au gestionnaire de projet, cliquez sur <i>Lié mon compte</i> pour lié votre compte TPF France au gestionnaire de projet
                            </div>
                            <!--end::Content-->

                            <!--begin::Buttons-->
                            <div class="d-flex flex-center flex-wrap">
                                <form action="{{ route('account.project.register') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="name" value="{{ auth()->user()->name }}">
                                    <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                                    <button type="submit" class="btn btn-warning m-2">Lié mon compte</button>
                                </form>
                            </div>
                            <!--end::Buttons-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Alert-->
                </div>
                <div class="col-3"></div>
            </div>
        </div>
    @else

    @endif
@endsection

@section("scripts")
    <script src="{{ asset('front/js/account/project/index.js') }}"
@endsection
