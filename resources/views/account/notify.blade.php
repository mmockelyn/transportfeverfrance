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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Mes Notifications</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Accueil</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Mes Notifications</a>
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
    <div class="container-fluid" id="notification" data-id="{{ auth()->user()->id }}">
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">Mes Notification</div>
                <div class="card-toolbar">
                    <button id="btnAllMark" class="btn btn-sm btn-success font-weight-bold mr-2"><i class="flaticon2-check-mark"></i> Marquer comme lu</button>
                    <button id="btnAllTrash" class="btn btn-sm btn-danger font-weight-bold"><i class="flaticon2-trash"></i> Tous supprimer</button>
                </div>
            </div>
            <div class="card-body" id="tableNotification">
                @foreach($notifications as $notification)
                    <div class="d-flex align-items-center mb-10 @if($notification->read_at == null) bg-light-primary @endif">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-40 symbol-light-success mr-5">
							<span class="symbol-label">
								<i class="fas fa-{{ $notification->data['icon'] }}"></i>
							</span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="d-flex flex-column flex-grow-1 font-weight-bold">
                            <a href="{{ $notification->data['link'] }}" class="text-dark text-hover-primary mb-1 font-size-lg">{{ $notification->data['title'] }}</a>
                            <span class="text-muted">{{ $notification->data['desc'] }}</span>
                        </div>
                        <div class="d-flex flex-column flex-grow-1 align-items-end mr-5 text-muted">
                            {{ $notification->created_at->diffForHumans() }}
                        </div>
                        <!--end::Text-->
                        <!--begin::Dropdown-->
                        <button class="btn btn-hover-light-success btn-sm btn-icon checknotif mr-2" data-toggle="tooltip" data-theme="dark" title="Lu">
                            <i class="flaticon2-check-mark" data-notif-id="{{ $notification->id }}"></i>
                        </button>
                        <button class="btn btn-hover-light-danger btn-sm btn-icon deletenotif mr-2" data-toggle="tooltip" data-theme="dark" title="Supprimer">
                            <i class="flaticon2-trash" data-notif-id="{{ $notification->id }}"></i>
                        </button>
                        <!--end::Dropdown-->
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script src="{{ asset('front/js/account/notify.js') }}"></script>
@endsection
