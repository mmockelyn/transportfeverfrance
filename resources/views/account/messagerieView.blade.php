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
                            <a href="#" class="btn btn-block btn-primary font-weight-bold text-uppercase py-4 px-6 text-center" data-toggle="modal" data-target="#kt_inbox_compose">New Message</a>
                        </div>
                        <!--end::Compose-->
                        <!--begin::Navigations-->
                        <div class="navi navi-hover navi-active navi-link-rounded navi-bold navi-icon-center navi-light-icon">
                            <!--begin::Item-->
                            <div class="navi-item my-2">
                                <a href="{{ route('account.messagerie') }}" class="navi-link active">
									<span class="navi-icon mr-4">
										<span class="svg-icon svg-icon-lg">
											<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Mail-heart.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"></rect>
													<path d="M6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,13 C19,13.5522847 18.5522847,14 18,14 L6,14 C5.44771525,14 5,13.5522847 5,13 L5,3 C5,2.44771525 5.44771525,2 6,2 Z M13.8,4 C13.1562,4 12.4033,4.72985286 12,5.2 C11.5967,4.72985286 10.8438,4 10.2,4 C9.0604,4 8.4,4.88887193 8.4,6.02016349 C8.4,7.27338783 9.6,8.6 12,10 C14.4,8.6 15.6,7.3 15.6,6.1 C15.6,4.96870845 14.9396,4 13.8,4 Z" fill="#000000" opacity="0.3"></path>
													<path d="M3.79274528,6.57253826 L12,12.5 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 Z" fill="#000000"></path>
												</g>
											</svg>
                                            <!--end::Svg Icon-->
										</span>
									</span>
                                    <span class="navi-text font-weight-bolder font-size-lg">Boite de Réception</span>
                                    @if($count != 0)
                                        <span class="navi-label">
										<span class="label label-rounded label-light-success font-weight-bolder">{{ $count }}</span>
									</span>
                                    @endif
                                </a>
                            </div>
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
                        <div class="card-title">
                            <h3 class="card-label">{{ $message->subject }}</h3>
                        </div>
                        <div class="card-toolbar">
                            <span class="btn btn-default btn-icon btn-sm mr-2" data-toggle="tooltip" title="" data-original-title="Delete" data-message-id="{{ $message->id }}">
								<span class="svg-icon svg-icon-md">
									<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Trash.svg-->
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24"></rect>
											<path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path>
											<path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path>
										</g>
									</svg>
                                    <!--end::Svg Icon-->
								</span>
							</span>
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body card-spacer-x px-0">
                        <div class="row mb-lg-5">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
									<span class="symbol symbol-50 mr-4">
                                        @if($message->from->avatar !== null)
                                            <span class="symbol-label" style="background-image: url('{{ $message->from->avatar }}')"></span>
                                        @else
                                            <span class="symbol-label" style="background-image: url('{{ \Creativeorange\Gravatar\Facades\Gravatar::get($message->from->email) }}')"></span>
                                        @endif

									</span>
                                    <div class="d-flex flex-column flex-grow-1 flex-wrap mr-2">
                                        <div class="d-flex">
                                            <a href="#" class="font-size-lg font-weight-bolder text-dark-75 text-hover-primary mr-2">{{ $message->from->name }}</a>
                                            <div class="font-weight-bold text-muted">
                                                @if(\Illuminate\Support\Facades\Cache::has('user-is-online-'.$message->from->id) == true)
                                                    <span class="label label-success label-dot mr-2"></span>
                                                @else
                                                    <span class="label label-danger label-dot mr-2"></span>
                                                @endif

                                                @if($message->created_at > now() && $message->created_at <= now()->addDay())
                                                    {{ $message->created_at->format('d/m/Y à H:i') }}
                                                    @else
                                                    {{ $message->created_at->diffForHumans() }}
                                                @endif
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <div class="toggle-off-item">
												<span class="font-weight-bold text-muted cursor-pointer" data-toggle="dropdown">à moi
												    <i class="flaticon2-down icon-xs ml-1 text-dark-50"></i>
                                                </span>
                                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left p-5">
                                                    <table>
                                                        <tbody><tr>
                                                            <td class="text-muted min-w-75px py-2">De</td>
                                                            <td>{{ $message->from->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted py-2">Date:</td>
                                                            <td>{{ $message->created_at->format('d/m/Y à H:i') }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted py-2">Sujet:</td>
                                                            <td>{{ $message->subject }}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="font-weight-bold text-muted text-right mx-2">{{ $message->created_at->format('d/m/Y H:i') }}</div>
                            </div>
                        </div>
                        <div class="">
                            {!! $message->message !!}
                        </div>
                    </div>
                    <div class="card-footer align-items-center">
                        <form action="{{ route('account.messagerie.view.compose', $message->id) }}" method="post">
                            @csrf
                            <textarea class="form-control border-0 p-0" rows="2" placeholder="Tapez votre message" name="message"></textarea>
                            <div class="d-flex align-items-center justify-content-between mt-5">
                                <div>
                                    <button type="submit" class="btn btn-primary btn-md text-uppercase font-weight-bold chat-send py-2 px-6">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::List-->
        </div>
    </div>
@endsection

@section("scripts")
    <script src="{{ asset('front/js/account/messagerie_view.js') }}"></script>
@endsection
