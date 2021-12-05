@extends("account.layouts.layout")
@section("style")
    <link href="/account/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>
@endsection

@section("content")
    <div class="row gy-5 g-xl-8 d-flex align-items-center mt-lg-0 mb-10 mb-lg-15">
        <!--begin::Col-->
        <div class="col-xl-6 d-flex align-items-center">
            <h1 class="fs-2hx">Mes Packages</h1>

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
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Information</h3>
                    <div class="card-toolbar">
                        <button type="button" class="btn btn-sm btn-danger" data-download="{{ $ticket->download_id }}" data-ticket="{{ $ticket->id }}">
                            <span class="indicator-label">
                                Cloturer le ticket
                            </span>
                            <span class="indicator-progress">
                                Veuillez Patienter... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-8 px-5">
                        <!--begin::Description-->
                        <div class="flex-grow-1">
                            <a href="#" class="text-gray-800 text-hover-primary fw-bolder fs-6">Numéro du ticket</a>
                        </div>
                        <!--end::Description-->
                        TCK-MOD{{ $ticket->download->id }}-{{ $ticket->id }}
                    </div>
                    <div class="d-flex align-items-center mb-8 px-5">
                        <!--begin::Description-->
                        <div class="flex-grow-1">
                            <a href="#" class="text-gray-800 text-hover-primary fw-bolder fs-6">Etat du ticket</a>
                        </div>
                        <!--end::Description-->
                        {!! \App\Helpers\Format::labelDownloadSupportState($ticket->state, true) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-12">
            <div class="card" id="kt_chat_messenger">
                <!--begin::Card header-->
                <div class="card-header" id="kt_chat_messenger_header">
                    <!--begin::Title-->
                    <div class="card-title">
                        <!--begin::User-->
                        <div class="d-flex justify-content-center flex-column me-3">
                            <a href="#" class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 mb-2 lh-1">{{ $ticket->subject }}</a>
                            <!--begin::Info-->
                            <div class="mb-0 lh-1">
                                {!! \App\Helpers\Format::labelDownloadSupportState($ticket->state, true) !!}
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::User-->
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body" id="kt_chat_messenger_body">
                    <!--begin::Messages-->
                    <div class="scroll-y me-n5 pe-5 h-300px h-lg-auto" data-kt-element="messages" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_toolbar, #kt_footer, #kt_chat_messenger_header, #kt_chat_messenger_footer" data-kt-scroll-wrappers="#kt_content, #kt_chat_messenger_body" data-kt-scroll-offset="5px" style="max-height: 374px;">
                        @foreach($ticket->rooms as $room)
                            @if($room->user_id)
                                <!--begin::Message(out)-->
                                <div class="d-flex justify-content-end mb-10">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-column align-items-end">
                                        <!--begin::User-->
                                        <div class="d-flex align-items-center mb-2">
                                            <!--begin::Details-->
                                            <div class="me-3">
                                                <span class="text-muted fs-7 mb-1">
                                                    @if($room->created_at >= now()->subDay() && $room->created_at <= now())
                                                        {{ $room->created_at->longAbsoluteDiffForHumans() }}
                                                    @else
                                                        {{ $room->created_at->format("d/m/Y à H:i") }}
                                                    @endif
                                                </span>
                                                <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary ms-1">Vous</a>
                                            </div>
                                            <!--end::Details-->
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-35px symbol-circle">
                                                @if($room->user->image)
                                                <img alt="Pic" src="/storage/files/shares/avatar/{{ $room->user->image }}">
                                                @else
                                                    <img alt="Pic" src="/storage/files/shares/avatar/placeholder.png">
                                                @endif
                                            </div>
                                            <!--end::Avatar-->
                                        </div>
                                        <!--end::User-->
                                        <!--begin::Text-->
                                        <div class="p-5 rounded bg-light-primary text-dark fw-bold mw-lg-400px text-end" data-kt-element="message-text">
                                            {!! $room->message !!}
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Message(out)-->
                            @else
                                <!--begin::Message(in)-->
                                <div class="d-flex justify-content-start mb-10">
                                        <!--begin::Wrapper-->
                                        <div class="d-flex flex-column align-items-start">
                                            <!--begin::User-->
                                            <div class="d-flex align-items-center mb-2">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-35px symbol-circle">
                                                    @if($room->author->image)
                                                        <img alt="Pic" src="/storage/files/shares/avatar/{{ $room->author->image }}">
                                                    @else
                                                        <img alt="Pic" src="/storage/files/shares/avatar/placeholder.png">
                                                    @endif
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Details-->
                                                <div class="ms-3">
                                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1">{{ $room->author->name }}</a>
                                                    <span class="text-muted fs-7 mb-1">
                                                        @if($room->created_at >= now()->subDay() && $room->created_at <= now())
                                                            {{ $room->created_at->longAbsoluteDiffForHumans() }}
                                                        @else
                                                            {{ $room->created_at->format("d/m/Y à H:i") }}
                                                        @endif
                                                    </span>
                                                </div>
                                                <!--end::Details-->
                                            </div>
                                            <!--end::User-->
                                            <!--begin::Text-->
                                            <div class="p-5 rounded bg-light-info text-dark fw-bold mw-lg-400px text-start" data-kt-element="message-text">{!! $room->message !!}</div>
                                            <!--end::Text-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                <!--end::Message(in)-->
                            @endif
                        @endforeach
                    </div>
                    <!--end::Messages-->
                </div>
                <!--end::Card body-->
                <!--begin::Card footer-->
                <div class="card-footer pt-4" id="kt_chat_messenger_footer">
                    <form action="{{ route('account.package.support.room.reply', [$ticket->download->id, $ticket->id]) }}" method="POST">
                        @csrf
                        <!--begin::Input-->
                        <textarea class="form-control form-control-flush mb-3" rows="1" name="message" data-kt-element="input" placeholder="Taper votre réponse"></textarea>
                        <!--end::Input-->
                        <!--begin:Toolbar-->
                        <div class="d-flex flex-stack">
                            <!--begin::Send-->
                            <button class="btn btn-primary" type="submit" data-kt-element="send">Répondre</button>
                            <!--end::Send-->
                        </div>
                        <!--end::Toolbar-->
                    </form>
                </div>
                <!--end::Card footer-->
            </div>
        </div>
    </div>

@endsection

@section("script")
    <script src="/account/assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <script src="{{ asset('account/js/package/room.js') }}"></script>
@endsection
