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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Ma Messagerie</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Accueil</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Ma Messagerie</a>
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
    <div class="container-fluid" id="messagerie" data-user-id="{{ auth()->user()->id }}">
        <div class="d-flex flex-row">
            <!--begin::Aside-->
            <div class="flex-row-auto offcanvas-mobile w-200px w-xxl-275px" id="kt_inbox_aside">
                <!--begin::Card-->
                <div class="card card-custom card-stretch">
                    <!--begin::Body-->
                    <div class="card-body px-5">
                        <!--begin::Compose-->
                        <div class="px-4 mt-4 mb-10">
                            <a href="#" class="btn btn-block btn-primary font-weight-bold text-uppercase py-4 px-6 text-center" data-toggle="modal" data-target="#compose">Nouveau Message</a>
                        </div>
                        <!--end::Compose-->
                        <!--begin::Navigations-->
                        <div class="navi navi-hover navi-active navi-link-rounded navi-bold navi-icon-center navi-light-icon">
                            <!--begin::Item-->
                            <x-account.menu_messagerie :count="$count"/>
                            <!--end::Item-->
                            <!--begin::Separator-->
                            <div class="navi-item my-10"></div>
                            <!--end::Separator-->
                        </div>
                        <!--end::Navigations-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Aside-->
            <!--begin::List-->
            <div class="flex-row-fluid ml-lg-8 d-block" id="kt_inbox_list">
                <!--begin::Card-->
                <div class="card card-custom card-stretch">
                    <!--begin::Header-->
                    <div class="card-header row row-marginless align-items-center flex-wrap py-5 h-auto">
                        <!--begin::Search-->
                        <div class="col-xxl-3 d-flex order-1 order-xxl-2 align-items-center justify-content-center">
                            <div class="input-group input-group-lg input-group-solid my-2">
                                <input type="text" class="form-control pl-4" placeholder="Recherche...">
                                <div class="input-group-append">
									<span class="input-group-text pr-3">
										<span class="svg-icon svg-icon-lg">
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
									</span>
                                </div>
                            </div>
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body table-responsive px-0">
                        <!--begin::Items-->
                        <div class="list list-hover min-w-500px" data-inbox="list">
                            <!--begin::Item-->
                            @foreach($inboxes->inboxes as $inbox)
                                <div class="d-flex align-items-start list-item card-spacer-x py-3" data-inbox="message" data-item="{{ $inbox->id }}">
                                    <!--begin::Toolbar-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Author-->
                                        <div class="d-flex align-items-center flex-wrap w-xxl-200px mr-3" data-toggle="view">
										<span class="symbol symbol-35 mr-3">
                                            @if($inbox->from->avatar != null)
                                                <span class="symbol-label" style="background-image: url('{{ $inbox->from->avatar }}')"></span>
                                            @else
                                                <span class="symbol-label" style="background-image: url('{{ \Creativeorange\Gravatar\Facades\Gravatar::get($inbox->from->email) }}')"></span>
                                            @endif
										</span>
                                            <a href="#" class="font-weight-bold text-dark-75 text-hover-primary">{{ $inbox->from->name }}</a>
                                        </div>
                                        <!--end::Author-->
                                    </div>
                                    <!--end::Toolbar-->
                                    <!--begin::Info-->
                                    <div class="flex-grow-1 mt-2 mr-2" data-toggle="view">
                                        <div>
                                            @if($inbox->read_at == null)
                                                <span class="font-weight-bolder font-size-lg mr-2">{{ $inbox->subject }}</span>
                                            @else
                                                <span class="font-size-lg mr-2">{{ $inbox->subject }}</span>
                                            @endif
                                            <span class="text-muted">{!! \Illuminate\Support\Str::limit($inbox->message, 60) !!}</span>
                                        </div>
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Datetime-->
                                    @if($inbox->created_at > now() && $inbox->created_at <= now()->addDay())
                                        <div class="mt-2 mr-3 font-weight-bolder w-150px text-right" data-toggle="view">{{ $inbox->created_at->format('d/m/Y H:i') }}</div>
                                    @else
                                        <div class="mt-2 mr-3 font-weight-bolder w-150px text-right" data-toggle="view">{{ $inbox->created_at->diffForHumans() }}</div>
                                @endif
                                <!--end::Datetime-->
                                </div>
                            @endforeach
                            <!--end::Item-->
                        </div>
                        <!--end::Items-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::List-->
        </div>
    </div>
    <div class="modal modal-sticky modal-sticky-lg modal-sticky-bottom-right" id="compose" role="dialog" data-backdrop="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!--begin::Form-->
                <form id="kt_inbox_compose_form" action="{{ route('account.messagerie.sending') }}">
                    <!--begin::Header-->
                    <div class="d-flex align-items-center justify-content-between py-5 pl-8 pr-5 border-bottom">
                        <h5 class="font-weight-bold m-0">Nouveau Message</h5>
                        <div class="d-flex ml-2">
							<span class="btn btn-clean btn-sm btn-icon mr-2">
								<i class="flaticon2-arrow-1 icon-1x"></i>
							</span>
                            <span class="btn btn-clean btn-sm btn-icon" data-dismiss="modal">
								<i class="ki ki-close icon-1x"></i>
							</span>
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="d-block">
                        <!--begin::To-->
                        <div class="d-flex align-items-center border-bottom inbox-to px-8 min-h-45px">
                            <div class="text-dark-50 w-75px">A:</div>
                            <div class="d-flex align-items-center flex-grow-1">
                                <select class="form-control selectpicker" name="to_id" data-live-search="true">
                                    <option value=""></option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" data-content="
                                        <div class='row'>
                                            <div class='col-1'>
                                                @if($user->avatar == null)
                                                <div class='symbol symbol-20 symbol-lg-30 symbol-circle mr-3'>
                                                    <img alt='Pic' src='{{ \Creativeorange\Gravatar\Facades\Gravatar::get($user->email) }}'/>
                                                </div>
                                                @else
                                                <div class='symbol symbol-20 symbol-lg-30 symbol-circle mr-3'>
                                                    <img alt='Pic' src='{{ $user->avatar }}'/>
                                                </div>
                                                @endif
                                            </div>
                                            <div class='col-11'>
                                                <strong>{{ $user->name }}</strong><br>
                                                {{ \App\Helpers\Format::formatUserGroup($user->group) }}
                                            </div>
                                        </div>
                                        ">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!--end::To-->
                        <!--begin::Subject-->
                        <div class="border-bottom">
                            <input class="form-control border-0 px-8 min-h-45px" name="subject" placeholder="Sujet" />
                        </div>
                        <!--end::Subject-->
                        <!--begin::Message-->
                        <textarea class="border-0 summernote" name="message"></textarea>
                        <!--end::Message-->
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="d-flex align-items-center justify-content-between py-5 pl-8 pr-5 border-top">
                        <!--begin::Actions-->
                        <div class="d-flex align-items-center mr-3">
                            <!--begin::Send-->
                            <div class="btn-group mr-4">
                                <button type="submit" id="btnEnvoye" class="btn btn-primary font-weight-bold px-6">Envoyer</button>
                            </div>
                            <!--end::Send-->
                        </div>
                        <!--end::Actions-->

                    </div>
                    <!--end::Footer-->
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script src="{{ asset('front/js/account/messagerie.js') }}"></script>
@endsection
