<!--begin::Aside menu-->
<div class="aside-menu flex-column-fluid">
    <!--begin::Aside Menu-->
    <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
        <!--begin::Menu-->
        <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">
            <div class="menu-item">
                <a class="menu-link active" href="{{ route('dashboard') }}">
					<span class="menu-icon">
						<!--begin::Svg Icon | path: icons/duotone/Design/PenAndRuller.svg-->
						<span class="svg-icon svg-icon-2">
							<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />
								<path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />
							</svg>
						</span>
                        <!--end::Svg Icon-->
					</span>
                    <span class="menu-title">Tableau de Bord</span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link" href="{{ route('back.calendar.index') }}">
					<span class="menu-icon">
						<!--begin::Svg Icon | path: icons/duotone/Design/Sketch.svg-->
						<span class="svg-icon svg-icon-2">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.25" fill-rule="evenodd" clip-rule="evenodd" d="M6 3C6 2.44772 6.44772 2 7 2C7.55228 2 8 2.44772 8 3V4H16V3C16 2.44772 16.4477 2 17 2C17.5523 2 18 2.44772 18 3V4H19C20.6569 4 22 5.34315 22 7V19C22 20.6569 20.6569 22 19 22H5C3.34315 22 2 20.6569 2 19V7C2 5.34315 3.34315 4 5 4H6V3Z" fill="#191213"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10 12C9.44772 12 9 12.4477 9 13C9 13.5523 9.44772 14 10 14H17C17.5523 14 18 13.5523 18 13C18 12.4477 17.5523 12 17 12H10ZM7 16C6.44772 16 6 16.4477 6 17C6 17.5523 6.44772 18 7 18H13C13.5523 18 14 17.5523 14 17C14 16.4477 13.5523 16 13 16H7Z" fill="#121319"/>
                            </svg>
						</span>
                        <!--end::Svg Icon-->
					</span>
                    <span class="menu-title">Calendrier</span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link" href="{{ route('back.tasks.index') }}">
					<span class="menu-icon">
						<!--begin::Svg Icon | path: icons/duotone/Design/Sketch.svg-->
						<span class="svg-icon svg-icon-2">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M10.5,5 L19.5,5 C20.3284271,5 21,5.67157288 21,6.5 C21,7.32842712 20.3284271,8 19.5,8 L10.5,8 C9.67157288,8 9,7.32842712 9,6.5 C9,5.67157288 9.67157288,5 10.5,5 Z M10.5,10 L19.5,10 C20.3284271,10 21,10.6715729 21,11.5 C21,12.3284271 20.3284271,13 19.5,13 L10.5,13 C9.67157288,13 9,12.3284271 9,11.5 C9,10.6715729 9.67157288,10 10.5,10 Z M10.5,15 L19.5,15 C20.3284271,15 21,15.6715729 21,16.5 C21,17.3284271 20.3284271,18 19.5,18 L10.5,18 C9.67157288,18 9,17.3284271 9,16.5 C9,15.6715729 9.67157288,15 10.5,15 Z" fill="#000000"/>
                                    <path d="M5.5,8 C4.67157288,8 4,7.32842712 4,6.5 C4,5.67157288 4.67157288,5 5.5,5 C6.32842712,5 7,5.67157288 7,6.5 C7,7.32842712 6.32842712,8 5.5,8 Z M5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 C6.32842712,10 7,10.6715729 7,11.5 C7,12.3284271 6.32842712,13 5.5,13 Z M5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 C6.32842712,15 7,15.6715729 7,16.5 C7,17.3284271 6.32842712,18 5.5,18 Z" fill="#000000" opacity="0.3"/>
                                </g>
                            </svg>
						</span>
                        <!--end::Svg Icon-->
					</span>
                    <span class="menu-title">Taches communes</span>
                </a>
            </div>
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
				<span class="menu-link">
					<span class="menu-icon">
						<!--begin::Svg Icon | path: icons/duotone/Code/Compiling.svg-->
						<span class="svg-icon svg-icon-2">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.25" d="M13.2621 4.48263C13.3664 3.27603 14.2725 2.33642 15.4724 2.17209C16.1606 2.07784 16.9082 2 17.5 2C18.0918 2 18.8394 2.07784 19.5276 2.17209C20.7275 2.33642 21.6336 3.27603 21.7379 4.48263C21.8668 5.97302 22 8.38715 22 12C22 15.6129 21.8668 18.027 21.7379 19.5174C21.6336 20.724 20.7275 21.6636 19.5276 21.8279C18.8394 21.9222 18.0918 22 17.5 22C16.9082 22 16.1606 21.9222 15.4724 21.8279C14.2725 21.6636 13.3664 20.724 13.2621 19.5174C13.1332 18.027 13 15.6129 13 12C13 8.38715 13.1332 5.97301 13.2621 4.48263Z" fill="#12131A"/>
                                <path d="M2.26209 4.48263C2.36644 3.27603 3.27253 2.33642 4.47244 2.17209C5.16065 2.07784 5.90816 2 6.5 2C7.09184 2 7.83935 2.07784 8.52756 2.17209C9.72747 2.33642 10.6336 3.27603 10.7379 4.48263C10.8668 5.97302 11 8.38715 11 12C11 15.6129 10.8668 18.027 10.7379 19.5174C10.6336 20.724 9.72747 21.6636 8.52756 21.8279C7.83935 21.9222 7.09184 22 6.5 22C5.90816 22 5.16065 21.9222 4.47244 21.8279C3.27253 21.6636 2.36644 20.724 2.26209 19.5174C2.13319 18.027 2 15.6129 2 12C2 8.38715 2.13319 5.97301 2.26209 4.48263Z" fill="#12131A"/>
                            </svg>
						</span>
                        <!--end::Svg Icon-->
					</span>
					<span class="menu-title">Blog</span>
					<span class="menu-arrow"></span>
				</span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    <div class="menu-item menu-accordion">
                        <div class="menu-item">
                            <a class="menu-link" href="{{ route('back.blog.category.index') }}">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
                                <span class="menu-title">Gestion des catégories</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="{{ route('back.blog.dashboard') }}">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
                                <span class="menu-title">Gestion des articles</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
				<span class="menu-link">
					<span class="menu-icon">
						<!--begin::Svg Icon | path: icons/duotone/Code/Compiling.svg-->
						<span class="svg-icon svg-icon-2">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.25" d="M13 6L12.4104 5.01732C11.8306 4.05094 10.8702 3.36835 9.75227 3.22585C8.83875 3.10939 7.66937 3 6.5 3C5.68392 3 4.86784 3.05328 4.13873 3.12505C2.53169 3.28325 1.31947 4.53621 1.19597 6.14628C1.09136 7.51009 1 9.43529 1 12C1 13.8205 1.06629 15.4422 1.15059 16.7685C1.29156 18.9862 3.01613 20.6935 5.23467 20.8214C6.91963 20.9185 9.17474 21 12 21C14.8253 21 17.0804 20.9185 18.7653 20.8214C20.9839 20.6935 22.7084 18.9862 22.8494 16.7685C22.9337 15.4422 23 13.8205 23 12C23 10.9589 22.9398 9.97795 22.8611 9.14085C22.7101 7.53313 21.4669 6.2899 19.8591 6.13886C19.0221 6.06022 18.0411 6 17 6H13Z" fill="#12131A"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M13 6H1.21033C1.39381 4.46081 2.58074 3.27842 4.13877 3.12505C4.86788 3.05328 5.68396 3 6.50004 3C7.66941 3 8.83879 3.10939 9.75231 3.22585C10.8702 3.36835 11.8306 4.05094 12.4104 5.01732L13 6Z" fill="#12131A"/>
                            </svg>
						</span>
                        <!--end::Svg Icon-->
					</span>
					<span class="menu-title">Téléchargement</span>
					<span class="menu-arrow"></span>
				</span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    <div class="menu-item menu-accordion">
                        <div class="menu-item">
                            <a class="menu-link" href="pages/profile/overview.html">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
                                <span class="menu-title">Gestion des catégories</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="pages/profile/overview.html">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
                                <span class="menu-title">Gestion des Packages</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
				<span class="menu-link">
					<span class="menu-icon">
						<!--begin::Svg Icon | path: icons/duotone/Code/Compiling.svg-->
						<span class="svg-icon svg-icon-2">
							<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <path d="M18.6225,9.75 L18.75,9.75 C19.9926407,9.75 21,10.7573593 21,12 C21,13.2426407 19.9926407,14.25 18.75,14.25 L18.6854912,14.249994 C18.4911876,14.250769 18.3158978,14.366855 18.2393549,14.5454486 C18.1556809,14.7351461 18.1942911,14.948087 18.3278301,15.0846699 L18.372535,15.129375 C18.7950334,15.5514036 19.03243,16.1240792 19.03243,16.72125 C19.03243,17.3184208 18.7950334,17.8910964 18.373125,18.312535 C17.9510964,18.7350334 17.3784208,18.97243 16.78125,18.97243 C16.1840792,18.97243 15.6114036,18.7350334 15.1896699,18.3128301 L15.1505513,18.2736469 C15.008087,18.1342911 14.7951461,18.0956809 14.6054486,18.1793549 C14.426855,18.2558978 14.310769,18.4311876 14.31,18.6225 L14.31,18.75 C14.31,19.9926407 13.3026407,21 12.06,21 C10.8173593,21 9.81,19.9926407 9.81,18.75 C9.80552409,18.4999185 9.67898539,18.3229986 9.44717599,18.2361469 C9.26485393,18.1556809 9.05191298,18.1942911 8.91533009,18.3278301 L8.870625,18.372535 C8.44859642,18.7950334 7.87592081,19.03243 7.27875,19.03243 C6.68157919,19.03243 6.10890358,18.7950334 5.68746499,18.373125 C5.26496665,17.9510964 5.02757002,17.3784208 5.02757002,16.78125 C5.02757002,16.1840792 5.26496665,15.6114036 5.68716991,15.1896699 L5.72635306,15.1505513 C5.86570889,15.008087 5.90431906,14.7951461 5.82064513,14.6054486 C5.74410223,14.426855 5.56881236,14.310769 5.3775,14.31 L5.25,14.31 C4.00735931,14.31 3,13.3026407 3,12.06 C3,10.8173593 4.00735931,9.81 5.25,9.81 C5.50008154,9.80552409 5.67700139,9.67898539 5.76385306,9.44717599 C5.84431906,9.26485393 5.80570889,9.05191298 5.67216991,8.91533009 L5.62746499,8.870625 C5.20496665,8.44859642 4.96757002,7.87592081 4.96757002,7.27875 C4.96757002,6.68157919 5.20496665,6.10890358 5.626875,5.68746499 C6.04890358,5.26496665 6.62157919,5.02757002 7.21875,5.02757002 C7.81592081,5.02757002 8.38859642,5.26496665 8.81033009,5.68716991 L8.84944872,5.72635306 C8.99191298,5.86570889 9.20485393,5.90431906 9.38717599,5.82385306 L9.49484664,5.80114977 C9.65041313,5.71688974 9.7492905,5.55401473 9.75,5.3775 L9.75,5.25 C9.75,4.00735931 10.7573593,3 12,3 C13.2426407,3 14.25,4.00735931 14.25,5.25 L14.249994,5.31450877 C14.250769,5.50881236 14.366855,5.68410223 14.552824,5.76385306 C14.7351461,5.84431906 14.948087,5.80570889 15.0846699,5.67216991 L15.129375,5.62746499 C15.5514036,5.20496665 16.1240792,4.96757002 16.72125,4.96757002 C17.3184208,4.96757002 17.8910964,5.20496665 18.312535,5.626875 C18.7350334,6.04890358 18.97243,6.62157919 18.97243,7.21875 C18.97243,7.81592081 18.7350334,8.38859642 18.3128301,8.81033009 L18.2736469,8.84944872 C18.1342911,8.99191298 18.0956809,9.20485393 18.1761469,9.38717599 L18.1988502,9.49484664 C18.2831103,9.65041313 18.4459853,9.7492905 18.6225,9.75 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                <path d="M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000"/>
                            </svg>
						</span>
                        <!--end::Svg Icon-->
					</span>
					<span class="menu-title">Configuration</span>
					<span class="menu-arrow"></span>
				</span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    <div class="menu-item menu-accordion">
                        <div class="menu-item">
                            <a class="menu-link" href="pages/profile/overview.html">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
                                <span class="menu-title">Configuration du site</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="pages/profile/overview.html">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
                                <span class="menu-title">Utilisateurs</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="pages/profile/overview.html">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
                                <span class="menu-title">Badges</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="pages/profile/overview.html">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
                                <span class="menu-title">CMS & Pages</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="pages/profile/overview.html">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
                                <span class="menu-title">Réseaux Sociaux</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="pages/profile/overview.html">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
                                <span class="menu-title">Statistiques</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="/totem">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
                                <span class="menu-title">Tache CRON</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Menu-->
    </div>
</div>
<!--end::Aside menu-->
<!--begin::Footer-->
<div class="aside-footer flex-column-auto pt-5 pb-7 px-5" id="kt_aside_footer">
    <a href="{{ route('back.changelog') }}" class="btn btn-custom btn-primary w-100" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-delay-show="8000" title="Voir les dernières nouveautés du back office">
        <span class="btn-label">Changelog</span>
        <!--begin::Svg Icon | path: icons/duotone/General/Clipboard.svg-->
        <span class="svg-icon btn-icon svg-icon-2">
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					<rect x="0" y="0" width="24" height="24" />
					<path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3" />
					<path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000" />
					<rect fill="#000000" opacity="0.3" x="7" y="10" width="5" height="2" rx="1" />
					<rect fill="#000000" opacity="0.3" x="7" y="14" width="9" height="2" rx="1" />
				</g>
			</svg>
		</span>
        <!--end::Svg Icon-->
    </a>
</div>
<!--end::Footer-->
