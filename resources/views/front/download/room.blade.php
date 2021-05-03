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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Ticket N°TCK-MOD{{ $ticket->download->id }}-{{ $ticket->id }}</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Accueil</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Téléchargement</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">{{ $ticket->download->title }}</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted fw-bold">Ticket N°TCK-MOD{{ $ticket->download->id }}-{{ $ticket->id }}</a>
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
    <div class="container-fluid ticket" data-download-slug="{{ $ticket->download->slug }}" data-ticket-id="{{ $ticket->id }}">
        <div class="row">
            <div class="col-4">
                <div class="card card-custom">
                    <div class="card-header">
                        <h3 class="card-title">Liste des auteurs</h3>
                    </div>
                    <div class="card-body" id="list_author">
                        @foreach($ticket->download->users as $user)
                            <div class="d-flex align-items-center justify-content-between mb-5">
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-50 mr-3">
                                        @if($user->avatar)
                                            <img alt="Pic" src="{{ $user->avatar }}">
                                        @else
                                            <img alt="Pic" src="{{ \Creativeorange\Gravatar\Facades\Gravatar::get($user->email) }}">
                                        @endif
                                        @if(\Illuminate\Support\Facades\Cache::has('user-is-online-'.$user->id))
                                            <div class="symbol-badge bg-success start-100 top-100 border-4 h-15px w-15px ms-n2 mt-n2"></div>
                                        @else
                                            <div class="symbol-badge bg-danger start-100 top-100 border-4 h-15px w-15px ms-n2 mt-n2"></div>
                                        @endif
                                    </div>
                                    <div class="d-flex flex-column">
                                        <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-lg">{{ $user->name }}</a>
                                        <span class="text-muted font-weight-bold font-size-sm">{{ $user->name }}</span>
                                    </div>
                                </div>
                                <div class="d-flex flex-column align-items-end">
                                    @if($user->last_seen)
                                        <span class="text-muted font-weight-bold font-size-sm">{{ $user->last_seen->diffForHumans() }}</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card card-custom">
                    <!--begin::Header-->
                    <div class="card-header align-items-center px-4 py-3">
                        <div class="text-left flex-grow-1">
                        </div>
                        <div class="text-center flex-grow-1">
                            <div class="text-dark-75 font-weight-bold font-size-h5">Ticket N°TCK-MOD{{ $ticket->download->id }}-{{ $ticket->id }}</div>
                            <div>
                                <span class="font-weight-bold text-muted font-size-sm">{{ $ticket->subject }}</span>
                            </div>
                        </div>
                        <div class="text-right flex-grow-1">
                            <!--begin::Dropdown Menu-->
                            <!--end::Dropdown Menu-->
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::Scroll-->
                        <div class="scroll scroll-pull" data-mobile-height="350">
                            <!--begin::Messages-->
                            <div class="messages" id="room"></div>
                            <!--end::Messages-->
                        </div>
                        <!--end::Scroll-->
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer align-items-center">
                        <form action="/api/download/{{ $ticket->download->slug }}/ticket/{{ $ticket->id }}/composer" id="formConverse" method="post">
                            <!--begin::Compose-->
                            @csrf
                            @if(auth()->user()->id == $ticket->user_id)
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            @else
                                <input type="hidden" name="user_id" value="1">
                            @endif
                            <textarea class="form-control border-0 p-0" name="message" rows="2" placeholder="Veuillez taper un message..."></textarea>
                            <div class="d-flex align-items-center justify-content-between mt-5">
                                <div>
                                    <button type="submit" id="formSubmit" class="btn btn-primary btn-md text-uppercase font-weight-bold chat-send py-2 px-6">Envoyer</button>
                                </div>
                            </div>
                            <!--begin::Compose-->
                        </form>
                    </div>
                    <!--end::Footer-->
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script src="{{ asset('front/assets/js/pages/custom/chat/chat.js') }}"></script>
    <script src="{{ asset('front/js/download/room.js') }}"></script>
@endsection
