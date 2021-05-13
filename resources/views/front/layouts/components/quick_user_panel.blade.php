<!-- begin::User Panel-->
@auth()
<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
    <!--begin::Header-->
    <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
        <h3 class="font-weight-bold m-0">Mon Profil
            <small class="text-muted font-size-sm ml-2">{{ $user->unreadNotifications()->count() }}</small></h3>
        <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
            <i class="ki ki-close icon-xs text-muted"></i>
        </a>
    </div>
    <!--end::Header-->
    <!--begin::Content-->
    <div class="offcanvas-content pr-5 mr-n5">
        <!--begin::Header-->
        <div class="d-flex align-items-center mt-5">
            <div class="symbol symbol-100 mr-5">
                @if($user->avatar)
                    <img src="{{ $user->avatar }}" alt="{{ $user->name }}">
                    @if(\Illuminate\Support\Facades\Cache::has('user-is-online-'.$user->id))
                    <i class="symbol-badge bg-success"></i>
                    @else
                    <i class="symbol-badge bg-danger"></i>
                    @endif
                @else
                    <img src="{{ \Creativeorange\Gravatar\Facades\Gravatar::get($user->email) }}" alt="{{ $user->name }}">
                    @if(\Illuminate\Support\Facades\Cache::has('user-is-online-'.$user->id))
                        <i class="symbol-badge bg-success"></i>
                    @else
                        <i class="symbol-badge bg-danger"></i>
                    @endif
                @endif
            </div>
            <div class="d-flex flex-column">
                <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">{{ $user->name }}</a>
                <div class="text-muted mt-1">{{ \App\Helpers\Format::formatUserGroup($user->group) }}</div>
                <div class="navi mt-2">
                    <a href="#" class="navi-item">
								<span class="navi-link p-0 pb-2">
									<span class="navi-icon mr-1">
										<span class="svg-icon svg-icon-lg svg-icon-primary">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <polygon points="0 0 24 0 24 24 0 24"/>
                                                    <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                    <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
										</span>
									</span>
									<span class="navi-text text-muted text-hover-primary">{{ $user->email }}</span>
								</span>
                    </a>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Déconnexion</button>
                    </form>
                </div>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Separator-->
        <div class="separator separator-dashed mt-8 mb-5"></div>
        <!--end::Separator-->
        <!--begin::Nav-->
        <div class="navi navi-spacer-x-0 p-0">
            <!--begin::Item-->
            <a href="{{ route('account.profil') }}" class="navi-item">
                <div class="navi-link">
                    <div class="symbol symbol-40 bg-light mr-3">
                        <div class="symbol-label">
									<span class="svg-icon svg-icon-md svg-icon-success">
										<!--begin::Svg Icon | path:assets/media/svg/icons/General/Notification2.svg-->
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24" />
												<path d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z" fill="#000000" />
												<circle fill="#000000" opacity="0.3" cx="18.5" cy="5.5" r="2.5" />
											</g>
										</svg>
                                        <!--end::Svg Icon-->
									</span>
                        </div>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold">Mon profil</div>
                        <div class="text-muted">Informations personnelles & Sécurité</div>
                    </div>
                </div>
            </a>
            <a href="{{ route('account.badges') }}" class="navi-item">
                <div class="navi-link">
                    <div class="symbol symbol-40 bg-light mr-3">
                        <div class="symbol-label">
							<span class="svg-icon svg-icon-md svg-icon-primary">
								<!--begin::Svg Icon | path:assets/media/svg/icons/General/Notification2.svg-->
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <polygon fill="#000000" opacity="0.3" points="5 3 19 3 23 8 1 8"/>
                                        <polygon fill="#000000" points="23 8 12 20 1 8"/>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
							</span>
                        </div>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold">Mes Badges</div>
                        <div class="text-muted">
                            Succès TF France dévérouiller
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ route('account.notify') }}" class="navi-item">
                <div class="navi-link">
                    <div class="symbol symbol-40 bg-light mr-3">
                        <div class="symbol-label">
							<span class="svg-icon svg-icon-md svg-icon-primary">
								<!--begin::Svg Icon | path:assets/media/svg/icons/General/Notification2.svg-->
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <path d="M17,12 L18.5,12 C19.3284271,12 20,12.6715729 20,13.5 C20,14.3284271 19.3284271,15 18.5,15 L5.5,15 C4.67157288,15 4,14.3284271 4,13.5 C4,12.6715729 4.67157288,12 5.5,12 L7,12 L7.5582739,6.97553494 C7.80974924,4.71225688 9.72279394,3 12,3 C14.2772061,3 16.1902508,4.71225688 16.4417261,6.97553494 L17,12 Z" fill="#000000"/>
                                        <rect fill="#000000" opacity="0.3" x="10" y="16" width="4" height="4" rx="2"/>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
							</span>
                        </div>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold">Mes Notifications</div>
                        <div class="text-muted">
                            Liste de mes notifications
                            <span class="label label-light-danger label-inline font-weight-bold">Nouveau</span>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ route('account.messagerie') }}" class="navi-item">
                <div class="navi-link">
                    <div class="symbol symbol-40 bg-light mr-3">
                        <div class="symbol-label">
							<span class="svg-icon svg-icon-md svg-icon-primary">
								<!--begin::Svg Icon | path:assets/media/svg/icons/General/Notification2.svg-->
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <path d="M17,12 L18.5,12 C19.3284271,12 20,12.6715729 20,13.5 C20,14.3284271 19.3284271,15 18.5,15 L5.5,15 C4.67157288,15 4,14.3284271 4,13.5 C4,12.6715729 4.67157288,12 5.5,12 L7,12 L7.5582739,6.97553494 C7.80974924,4.71225688 9.72279394,3 12,3 C14.2772061,3 16.1902508,4.71225688 16.4417261,6.97553494 L17,12 Z" fill="#000000"/>
                                        <rect fill="#000000" opacity="0.3" x="10" y="16" width="4" height="4" rx="2"/>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
							</span>
                        </div>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold">Ma Messagerie</div>
                        <div class="text-muted">
                            Messagerie interne
                            <span class="label label-light-danger label-inline font-weight-bold">Nouveau</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!--end::Nav-->
    </div>
    <!--end::Content-->
</div>
<!-- end::User Panel-->
@endauth
