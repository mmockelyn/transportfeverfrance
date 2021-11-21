<!--begin::Menu-->
<div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default d-flex justify-content-between">
    <!--begin::Nav-->
    <ul class="menu-nav">
        <li class="menu-item {{ currentRoute('home') }}" aria-haspopup="true">
            <a href="{{ route('home') }}" class="menu-link">
                <span class="menu-text">Acceuil</span>
            </a>
        </li>
        <li class="menu-item {{ currentRoute('front.blog') }}" aria-haspopup="true">
            <a href="{{ route('front.blog') }}" class="menu-link">
                <span class="menu-text">Blog</span>
            </a>
        </li>
        <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
            <a href="javascript:;" class="menu-link menu-toggle">
                <span class="menu-text">Téléchargement</span>
                <span class="menu-desc"></span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                <ul class="menu-subnav">
                    @foreach($download_categories as $category)
                    <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                        <a href="javascript:;" class="menu-link menu-toggle">
                            <span class="menu-text">{{ $category->title }}</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                            <ul class="menu-subnav">
                                @foreach($category->subcategories as $subcategory)
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{ route('front.download.category', $subcategory->id) }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">{{ $subcategory->title }}</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </li>
        <!--<li class="menu-item" aria-haspopup="true">
            <a href="#" class="menu-link">
                <span class="menu-text">Documentation</span>
            </a>
        </li>-->
        <li class="menu-item" aria-haspopup="true">
            <a href="{{ route('contacts.create') }}" class="menu-link">
                <span class="menu-text">Nous contacter</span>
            </a>
        </li>
    </ul>
    <div class="align-self-center">
        @foreach($follows as $follow)
            <a href="{{ $follow->href }}" class="btn {{ $follow->color }} btn-icon"><i class="socicon-{{ $follow->icon }} icon-2x"></i> </a>
        @endforeach
            <a href="{{ \App\Helpers\Format::linkToPaypal() }}" class="btn btn-primary"><i class="socicon-paypal icon-2x"></i> Effectuer un don</a>
    </div>
    <!--end::Nav-->
</div>
<!--end::Menu-->
