<!--begin::Top-->
<div class="header-top">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Left-->
        <div class="d-none d-lg-flex align-items-center mr-3">
            <!--begin::Logo-->
            <a href="{{ route('home') }}" class="mr-20">
                <img alt="Logo" src="{{ asset("storage/files/shares/core/logo_couleur.png") }}" class="max-h-50px" />
            </a>
            <!--end::Logo-->
        </div>
        <!--end::Left-->
        <!--begin::Topbar-->
        <div class="topbar">
            <!--begin::Search-->
            <div class="dropdown">
                <!--begin::Toggle-->
                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                    <div class="btn btn-icon btn-hover-transparent-white btn-lg btn-dropdown mr-1">
												<span class="svg-icon svg-icon-xl">
													<!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24" />
															<path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
															<path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
														</g>
													</svg>
                                                    <!--end::Svg Icon-->
												</span>
                    </div>
                </div>
                <!--end::Toggle-->
                <!--begin::Dropdown-->
                <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
                    <div class="quick-search quick-search-dropdown" id="kt_quick_search_dropdown">
                        <!--begin:Form-->
                        <form method="get" class="quick-search-form">
                            <div class="input-group">
                                <div class="input-group-prepend">
									<span class="input-group-text">
										<span class="svg-icon svg-icon-lg">
											<!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24" />
													<path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
													<path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
												</g>
											</svg>
                                            <!--end::Svg Icon-->
										</span>
									</span>
                                </div>
                                <input type="text" class="form-control" name="search" placeholder="Recherche..." />
                                <div class="input-group-append">
									<span class="input-group-text">
										<i class="quick-search-close ki ki-close icon-sm text-muted"></i>
									</span>
                                </div>
                            </div>
                        </form>
                        <!--end::Form-->
                        <!--begin::Scroll-->
                        <div class="quick-search-wrapper scroll" data-scroll="true" data-height="325" data-mobile-height="200"></div>
                        <!--end::Scroll-->
                    </div>
                </div>
                <!--end::Dropdown-->
            </div>
            <div class="topbar-item mr-2">
                <label class="col-form-label text-white">Mode Dark &nbsp;</label>
                <span class="switch switch-outline switch-sm switch-dark switch-icon">
                    <label>
                        <input type="checkbox" id="theme-toggle" @if(\Illuminate\Support\Facades\Cookie::get('theme') == 'dark') checked="checked" @endif name="select"/>
                        <span></span>
                    </label>
                </span>
            </div>
            <!--end::Search-->
            @auth()
                <!--begin::Notifications-->
                    <div class="dropdown">
                        <!--begin::Toggle-->
                        <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                            <div class="btn btn-icon btn-hover-transparent-white btn-dropdown btn-lg mr-1 pulse pulse-white">
								<span class="svg-icon svg-icon-xl">
									<!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24" />
											<path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" fill="#000000" opacity="0.3" />
											<path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" fill="#000000" />
										</g>
									</svg>
                                    <!--end::Svg Icon-->
								</span>
                                @if($user->unreadNotifications()->count() > 0)
                                <span class="pulse-ring"></span>
                                @endif
                            </div>
                        </div>
                        <!--end::Toggle-->
                        <!--begin::Dropdown-->
                        <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
                            <form>
                                <!--begin::Header-->
                                <div class="d-flex flex-column pt-12 bgi-size-cover bgi-no-repeat rounded-top" style="background-image: url({{ asset('front/assets/media/misc/bg-1.jpg') }})">
                                    <!--begin::Title-->
                                    <h4 class="d-flex flex-center rounded-top">
                                        <span class="text-white">Notification</span>
                                        <span class="btn btn-text btn-success btn-sm font-weight-bold btn-font-md ml-2">{{ $user->unreadNotifications()->count() }} Nouvelle notification</span>
                                    </h4>
                                    <!--end::Title-->
                                    <!--begin::Tabs-->
                                    <ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-line-transparent-white nav-tabs-line-active-border-success mt-3 px-8" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active show" data-toggle="tab" href="#topbar_notifications_notifications">Mes notifications</a>
                                        </li>
                                    </ul>
                                    <!--end::Tabs-->
                                </div>
                                <!--end::Header-->
                                <!--begin::Content-->
                                <div class="tab-content">
                                    <!--begin::Tabpane-->
                                    <div class="tab-pane active show p-8" id="topbar_notifications_notifications" role="tabpanel">
                                        <!--begin::Scroll-->
                                        <div class="scroll pr-7 mr-n7" data-scroll="true" data-height="300" data-mobile-height="200">
                                            @foreach($user->unreadNotifications as $notification)
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center mb-6">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-40 symbol-light-primary mr-5">
													<span class="symbol-label">
														<i class="fas fa-{{ $notification->data['icon'] }}"></i>
													</span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="d-flex flex-column font-weight-bold">
                                                    <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">{{ $notification->data['title'] }}</a>
                                                    <span class="text-muted">{{ $notification->data['desc'] }}</span>
                                                </div>
                                                <!--end::Text-->
                                            </div>
                                            <!--end::Item-->
                                            @endforeach
                                        </div>
                                        <!--end::Scroll-->
                                        <!--begin::Action-->
                                        <div class="d-flex flex-center pt-7">
                                            <a href="{{ route('account.notify') }}" class="btn btn-light-primary font-weight-bold text-center">Voir toutes les notifications</a>
                                        </div>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Tabpane-->
                                </div>
                                <!--end::Content-->
                            </form>
                        </div>
                        <!--end::Dropdown-->
                    </div>
                    <!--end::Notifications-->
            @endauth
            @auth()
                <!--begin::User-->
                    <div class="topbar-item">
                        <div class="btn btn-icon btn-hover-transparent-white w-sm-auto d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                            <div class="d-flex flex-column text-right pr-sm-3">
                                <span class="text-white opacity-50 font-weight-bold font-size-sm d-none d-sm-inline">{{ auth()->user()->name }}</span>
                                <span class="text-white font-weight-bolder font-size-sm d-none d-sm-inline">{{ \App\Helpers\Format::formatUserGroup($user->group) }}</span>
                            </div>
                            <div class="symbol symbol-35">
                                @if($user->avatar)
                                    <img src="{{ $user->avatar }}" alt="{{ $user->name }}">
                                @else
                                    <img src="{{ \Creativeorange\Gravatar\Facades\Gravatar::get($user->email) }}" alt="{{ $user->name }}">
                                @endif
                            </div>
                        </div>
                    </div>
                    <!--end::User-->
            @else
                    <div class="topbar-item">
                        <a href="/login" class="text-white text-hover-primary font-weight-bold">Connexion</a>&nbsp; ou&nbsp; <a href="/register" class="text-white text-hover-primary font-weight-bold">Inscription</a>
                    </div>
            @endauth
        </div>
        <!--end::Topbar-->
    </div>
    <!--end::Container-->
</div>
<!--end::Top-->
