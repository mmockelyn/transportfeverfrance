@extends("front.layouts.layout")
@section("styles")
    <link href="{{ asset('/front/assets/plugins/custom/owl_carousel/dist/assets/owl.carousel.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/front/assets/plugins/custom/owl_carousel/dist/assets/owl.theme.default.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/front/css/owl.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section("bread")
@endsection

@section("content")
    <!-- Slider -->
    <div class="container-fluid mt-5">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <div class="d-flex">
                    <!--begin::Pic-->
                    <div class="flex-shrink-0 mr-7">
                        <div class="symbol symbol-50 symbol-lg-120">
                            <img alt="Pic" src="storage/files/shares/download/{{ $download->image }}">
                        </div>
                    </div>
                    <!--end::Pic-->
                    <!--begin: Info-->
                    <div class="flex-grow-1">
                        <!--begin::Title-->
                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                            <!--begin::User-->
                            <div class="mr-3">
                                <div class="d-flex align-items-center mr-3">
                                    <!--begin::Name-->
                                    <a href="#" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">{{ $download->title }}</a>
                                    <!--end::Name-->
                                    {!! \App\Helpers\Format::symbolDownloadProvider($download->provider) !!}
                                </div>
                                <!--begin::Contacts-->
                                <div class="d-flex flex-wrap my-2">
                                    <a href="#" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
										<span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1" data-toggle="tooltip" data-theme="dark" title="Dernière version">
											<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Mail-notification.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <rect fill="#000000" opacity="0.3" x="11" y="8" width="2" height="9" rx="1"/>
                                                    <path d="M12,21 C13.1045695,21 14,20.1045695 14,19 C14,17.8954305 13.1045695,17 12,17 C10.8954305,17 10,17.8954305 10,19 C10,20.1045695 10.8954305,21 12,21 Z M12,23 C9.790861,23 8,21.209139 8,19 C8,16.790861 9.790861,15 12,15 C14.209139,15 16,16.790861 16,19 C16,21.209139 14.209139,23 12,23 Z" fill="#000000" fill-rule="nonzero"/>
                                                    <path d="M12,7 C13.1045695,7 14,6.1045695 14,5 C14,3.8954305 13.1045695,3 12,3 C10.8954305,3 10,3.8954305 10,5 C10,6.1045695 10.8954305,7 12,7 Z M12,9 C9.790861,9 8,7.209139 8,5 C8,2.790861 9.790861,1 12,1 C14.209139,1 16,2.790861 16,5 C16,7.209139 14.209139,9 12,9 Z" fill="#000000" fill-rule="nonzero"/>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
										</span> {{ $download->version_latest }}
                                    </a>
                                    <a href="#" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
										<span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1" data-toggle="tooltip" data-theme="dark" title="Date de publication">
											<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Mail-notification.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <path d="M12,22 C7.02943725,22 3,17.9705627 3,13 C3,8.02943725 7.02943725,4 12,4 C16.9705627,4 21,8.02943725 21,13 C21,17.9705627 16.9705627,22 12,22 Z" fill="#000000" opacity="0.3"/>
                                                    <path d="M11.9630156,7.5 L12.0475062,7.5 C12.3043819,7.5 12.5194647,7.69464724 12.5450248,7.95024814 L13,12.5 L16.2480695,14.3560397 C16.403857,14.4450611 16.5,14.6107328 16.5,14.7901613 L16.5,15 C16.5,15.2109164 16.3290185,15.3818979 16.1181021,15.3818979 C16.0841582,15.3818979 16.0503659,15.3773725 16.0176181,15.3684413 L11.3986612,14.1087258 C11.1672824,14.0456225 11.0132986,13.8271186 11.0316926,13.5879956 L11.4644883,7.96165175 C11.4845267,7.70115317 11.7017474,7.5 11.9630156,7.5 Z" fill="#000000"/>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
										</span> {{ formatDateHour($download->updated_at) }}
                                    </a>
                                </div>
                                <!--end::Contacts-->
                            </div>
                            <!--begin::User-->
                            <!--begin::Actions-->
                            <div class="mb-10">
                                @if($download->provider == 'steam')
                                    <a href="{{ $download->steam_link_package }}" class="btn btn-sm btn-primary font-weight-bolder text-uppercase mr-2" data-toggle="tooltip" data-theme="dark" data-placement="bottom" title="Télécharger via steam"><i class="socicon-steam"></i> Télécharger</a>
                                @endif
                                @if($download->provider == 'tfnet')
                                    <a href="{{ $download->tfnet_link_package }}" class="btn btn-sm btn-primary font-weight-bolder text-uppercase mr-2" data-toggle="tooltip" data-theme="dark" data-placement="bottom" title="Télécharger via TF.net">
                                        <span class="symbol symbol-20 symbol-lg-30 symbol-circle mr-3">
                                            <img src="storage/files/shares/core/icons/tf_net_icon.png" class="h-24px" alt="tfnet">
                                        </span>Télécharger
                                    </a>
                                @endif
                                @if($download->provider == 'tf_france')
                                    <a href="{{ $download->tf_france_link_package }}" class="btn btn-sm btn-primary font-weight-bolder text-uppercase mr-2" data-toggle="tooltip" data-theme="dark" data-placement="bottom" title="Télécharger via TF France">
                                        <span class="symbol symbol-20 symbol-lg-30 symbol-circle mr-3">
                                            <img src="storage/files/shares/core/icons/tf_france_icon.png" class="h-24px" alt="tffrance">
                                        </span>Télécharger
                                    </a>
                                @endif
                            </div>
                            <!--end::Actions-->
                        </div>
                        <!--end::Title-->
                        <!--begin::Content-->
                        <div class="d-flex align-items-center flex-wrap justify-content-between">
                            <!--begin::Description-->
                            <div class="flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2 mr-5">{{ $download->short_content }}</div>
                            <!--end::Description-->
                            <!--begin::Progress-->
                            <!--<div class="d-flex mt-4 mt-sm-0">
                                <span class="font-weight-bold mr-4">Progress</span>
                                <div class="progress progress-xs mt-2 mb-2 flex-shrink-0 w-150px w-xl-500px">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 63%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="font-weight-bolder text-dark ml-4">78%</span>
                            </div>-->
                            <!--end::Progress-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Info-->
                </div>
            </div>
        </div>

        <div class="card card-custom gutter-b">
            <div class="card-header card-header-tabs-line">
                <div class="card-toolbar">
                    <ul class="nav nav-tabs nav-tabs-line nav-bold nav-tabs-line-3x justify-content-center" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#description">
                                <span class="nav-text">Description</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#comments">
                                <span class="nav-text">Commentaires ({{ count($download->comments) }})</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#changelogs">
                                <span class="nav-text">Note de version</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#support">
                                <span class="nav-text">Support</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body" data-sticky-container>
                <div class="tab-content pt-5">
                    <div class="tab-pane active" id="description" role="tabpanel">
                        <div class="row">
                            <div class="col-md-9">
                                <div id="big" class="owl-carousel owl-theme">
                                    <div class="item">
                                        <img src="storage/files/shares/slider/img01.jpg">
                                    </div>
                                    <div class="item">
                                        <img src="storage/files/shares/slider/img02.jpg">
                                    </div>
                                    <div class="item">
                                        <img src="storage/files/shares/slider/img03.jpg">
                                    </div>
                                    <div class="item">
                                        <img src="storage/files/shares/slider/img04.jpg">
                                    </div>
                                    <div class="item">
                                        <img src="storage/files/shares/slider/img05.jpg">
                                    </div>
                                </div>
                                <div id="thumbs" class="owl-carousel owl-theme">
                                    <div class="item">
                                        <img src="storage/files/shares/slider/img01.jpg">
                                    </div>
                                    <div class="item">
                                        <img src="storage/files/shares/slider/img02.jpg">
                                    </div>
                                    <div class="item">
                                        <img src="storage/files/shares/slider/img03.jpg">
                                    </div>
                                    <div class="item">
                                        <img src="storage/files/shares/slider/img04.jpg">
                                    </div>
                                    <div class="item">
                                        <img src="storage/files/shares/slider/img05.jpg">
                                    </div>
                                </div>
                                <div class="separator separator-solid separator-border-3 separator-primary m-5"></div>
                                <!--<div class="callAction">
                                    <div class="row">
                                        <div class="col-8">
                                            <h6 class="font-style-italic">Cliquez pour télécharger</h6>
                                            <h3 class="fw-bold">{{ $download->title }}</h3>
                                        </div>
                                        <div class="col-4 text-right">
                                            @if($download->provider == 'steam')
                                                <a href="{{ $download->steam_link_package }}" class="btn btn-sm btn-primary font-weight-bolder text-uppercase mr-2" data-toggle="tooltip" data-theme="dark" data-placement="bottom" title="Télécharger via steam"><i class="socicon-steam"></i> Télécharger</a>
                                            @endif
                                            @if($download->provider == 'tfnet')
                                                <a href="{{ $download->tfnet_link_package }}" class="btn btn-sm btn-primary font-weight-bolder text-uppercase mr-2" data-toggle="tooltip" data-theme="dark" data-placement="bottom" title="Télécharger via TF.net">
                                                    <span class="symbol symbol-20 symbol-lg-30 symbol-circle mr-3">
                                                        <img src="storage/files/shares/core/icons/tf_net_icon.png" class="h-24px" alt="tfnet">
                                                    </span>Télécharger
                                                </a>
                                            @endif
                                            @if($download->provider == 'tf_france')
                                                <a href="{{ $download->tf_france_link_package }}" class="btn btn-sm btn-primary font-weight-bolder text-uppercase mr-2" data-toggle="tooltip" data-theme="dark" data-placement="bottom" title="Télécharger via TF France">
                                                    <span class="symbol symbol-20 symbol-lg-30 symbol-circle mr-3">
                                                        <img src="storage/files/shares/core/icons/tf_france_icon.png" class="h-24px" alt="tffrance">
                                                    </span>Télécharger
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>-->

                                <h3 class="display-3 mt-10">Description</h3>
                                <div class="separator separator-solid separator-border-2 mb-5"></div>
                                {!! $download->content !!}

                            </div>
                            <div class="col-md-3">
                                <div class="card card-custom sticky" data-sticky="true" data-margin-top="140" data-sticky-for="1023" data-sticky-class="stickyjs">
                                    <img src="storage/files/shares/download/{{ $download->image }}" alt="{{ $download->title }}" class="card-img-top">
                                    <div class="card-body">
                                        <strong>Catégorie:</strong> <a href="#">{{ $download->category->title }}</a> - <a href="{{ route('front.download.category', $download->subcategory->id) }}">{{ $download->subcategory->title }}</a><br>
                                        <strong>Publié le:</strong> {{ formatDateHour($download->created_at) }}<br>
                                        <strong>Mise à jour le:</strong> {{ formatDateHour($download->updated_at) }}
                                        <div class="separator separator-dashed separator-border-2 mt-2 mb-2"></div>
                                        <div class="text-muted">
                                            <strong>Dernière version:</strong> {{ $download->version_latest }}
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-custom sticky" data-sticky="true" data-margin-top="730" data-sticky-for="1026" data-sticky-class="stickyjs">
                                    <div class="card-header">
                                        <h5 class="card-title">Statistique</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="card card-custom bg-light-danger card-stretch gutter-b">
                                            <!--begin::ody-->
                                            <div class="card-body">
												<span class="svg-icon svg-icon-4x svg-icon-danger">
													<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Group.svg-->
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <polygon points="0 0 24 0 24 24 0 24"/>
                                                            <path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#000000"/>
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
												</span>
                                                <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">2,044</span>
                                                <span class="font-weight-bold text-muted font-size-sm">Visites uniques</span>
                                            </div>
                                            <!--end::Body-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="comments" role="tabpanel">
                        @if(auth()->guest())
                            <div class="alert alert-custom alert-notice alert-light-warning fade show" role="alert">
                                <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                                <div class="alert-text">Oops! Vous devez être <a href="{{ route('login') }}">connecter</a> pour pouvoir poster un commentaire.</div>
                                <div class="alert-close">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                    </button>
                                </div>
                            </div>
                        @else

                        @endif
                        <div class="comment_area">
                            <div class="comment_area_header">
                                <div class="header_actions" style="display: flex">
                                    @if(auth()->check())
                                     <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#postComment"><i class="la la-comment-medical icon-2x"></i> Poster un commentaire</button>
                                    @endif
                                </div>
                                <div class="header_count h3">
                                    <i class="la la-comments-o icon-2x text-dark"></i> <span class="font-style-italic">{{ count($download->comments) }} Commentaires</span>
                                </div>
                            </div>
                            <div class="comment_container">
                                <div class="comments">
                                    @foreach($download->comments as $comment)
                                        <div class="comment">
                                            @if(\Illuminate\Support\Facades\Cache::has('user-is-online-'.$comment->user->id))
                                                <div class="comment_user_avatar online">
                                                    <a>
                                                        @if($comment->user->avatar)
                                                        <img src="{{ $comment->user->avatar }}" alt="">
                                                        @else
                                                        <img src="{{ \Creativeorange\Gravatar\Facades\Gravatar::get($comment->user->email) }}" alt="">
                                                        @endif
                                                    </a>
                                                </div>
                                            @else
                                                <div class="comment_user_avatar offline">
                                                    <a>
                                                        @if($comment->user->avatar)
                                                            <img src="{{ $comment->user->avatar }}" alt="">
                                                        @else
                                                            <img src="{{ \Creativeorange\Gravatar\Facades\Gravatar::get($comment->user->email) }}" alt="">
                                                        @endif
                                                    </a>
                                                </div>
                                            @endif
                                            <div class="comment_content">
                                                <div class="comment_author">
                                                    <a href="#" class="comment_author_link" data-profile="{{ $comment->user->id }}">{{ $comment->user->name }}</a>
                                                    @if(\App\Helpers\Format::IsModAuthor($comment->user->id, $download->id) == true)
                                                        <span class="label label-inline label-pill label-danger">Créateur</span>
                                                    @endif
                                                    <span class="comment_timestamp">{{ $comment->updated_at->format('d/m/Y à H:i') }}</span>
                                                    <div class="comment_actions">
                                                        <button class="btn btn-xs btn-default btn-icon reportcomment mr-1" data-toggle="tooltip" data-theme="dark" title="Reporter ce commentaire"><i class="fas fa-flag"></i> </button>
                                                        @if(\Illuminate\Support\Facades\Auth::check())
                                                        <button class="btn btn-xs btn-primary btn-icon replycomment mr-1" data-toggle="tooltip" data-theme="dark" title="Repondre"><i class="fas fa-reply"></i> </button>
                                                            @if(auth()->user()->name == $comment->user->name)
                                                                <button class="btn btn-xs btn-danger btn-icon deletecomment mr-1" data-toggle="tooltip" data-theme="dark" title="Supprimer"><i class="fas fa-trash"></i> </button>
                                                            @endif
                                                        @endif

                                                    </div>
                                                </div>
                                                <div class="comment_text">
                                                    {{ $comment->content }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
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
    <script src="{{ asset('/front/assets/plugins/custom/owl_carousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('/front/js/download/show.js') }}"></script>
@endsection
