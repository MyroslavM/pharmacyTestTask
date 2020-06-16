<nav class="navbar navbar-expand-lg main-navbar bg-white" id="navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="la la-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
        </ul>
        <!--<div class="search-element">-->
        <!--<input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">-->
        <!--<button class="btn" type="submit"><i class="la la-search"></i></button>-->
        <!--<div class="search-backdrop"></div>-->
        <!--<div class="search-result">-->
        <!--<div class="search-header">-->
        <!--Histories-->
        <!--</div>-->
        <!--<div class="search-item">-->
        <!--<a href="#">How to hack NASA using CSS</a>-->
        <!--<a href="#" class="search-close"><i class="fas fa-times"></i></a>-->
        <!--</div>-->
        <!--<div class="search-item">-->
        <!--<a href="#">Kodinger.com</a>-->
        <!--<a href="#" class="search-close"><i class="fas fa-times"></i></a>-->
        <!--</div>-->
        <!--<div class="search-item">-->
        <!--<a href="#">#Perumnas V2</a>-->
        <!--<a href="#" class="search-close"><i class="fas fa-times"></i></a>-->
        <!--</div>-->
        <!--<div class="search-header">-->
        <!--Result-->
        <!--</div>-->
        <!--<div class="search-item">-->
        <!--<a href="#">-->
        <!--<img class="mr-3 rounded" width="30" src="./asset/images/product-1-50.png" alt="product">-->
        <!--oPhone S9 Limited Edition-->
        <!--</a>-->
        <!--</div>-->
        <!--<div class="search-item">-->
        <!--<a href="#">-->
        <!--<img class="mr-3 rounded" width="30" src="./asset/images/product-1-50.png" alt="product">-->
        <!--Drone X2 New Gen-7-->
        <!--</a>-->
        <!--</div>-->
        <!--<div class="search-item">-->
        <!--<a href="#">-->
        <!--<img class="mr-3 rounded" width="30" src="./asset/images/product-1-50.png" alt="product">-->
        <!--Headphone Blitz-->
        <!--</a>-->
        <!--</div>-->
        <!--<div class="search-header">-->
        <!--Projects-->
        <!--</div>-->
        <!--<div class="search-item">-->
        <!--<a href="#">-->
        <!--<div class="search-icon bg-danger text-white mr-3">-->
        <!--<i class="fas fa-code"></i>-->
        <!--</div>-->
        <!--Perumnas V2 Admin Template-->
        <!--</a>-->
        <!--</div>-->
        <!--<div class="search-item">-->
        <!--<a href="#">-->
        <!--<div class="search-icon bg-danger text-white mr-3">-->
        <!--<i class="fas fa-laptop"></i>-->
        <!--</div>-->
        <!--Create a new Homepage Design-->
        <!--</a>-->
        <!--</div>-->
        <!--</div>-->
        <!--</div>-->
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{asset('assets-admin/images/avatar-1.png')}}" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi, Admin Perumnas V2</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">Logged in 5 min ago</div>
                <a href="index-1.htm?show=features-profile" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                <a href="index-2.htm?show=features-activities" class="dropdown-item has-icon">
                    <i class="fas fa-bolt"></i> Activities
                </a>
                <a href="index-3.htm?show=features-settings" class="dropdown-item has-icon">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>

<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand bg-white brand-left text-overflow" id="brand" align="left">
            <a href="index.html"><img src="{{asset('assets-admin/images/logo.png')}}" class="logo-brand"> Perumnas ver-2 </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">Pr</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="la la-dashboard"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="index-4.htm?show=index">Dashboard Template 1</a></li>
                    <li><a class="nav-link" href="index-5.htm?show=index-2">Dashboard Template 2</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>






<div id="kt_header" class="kt-header kt-grid kt-grid--ver  kt-header--fixed ">
    <!-- begin:: Aside -->
    <div class="kt-header__brand kt-grid__item  " id="kt_header_brand">
        <div class="kt-header__brand-logo">
            <a href="{{ route('adminHome') }}">
                <img alt="Logo" src="{{asset('assetsnew/media/logos/logo-6.png')}}"/>
            </a>
        </div>
    </div>

    <!-- end:: Aside -->

    <!-- begin:: Title -->
    <h3 class="kt-header__title kt-grid__item">
        CRM Med
    </h3>

    <!-- end:: Title -->

    <!-- begin: Header Menu -->
    <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
    <div class="kt-header-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_header_menu_wrapper">
        <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
            <ul class="kt-menu__nav ">
                <li class="kt-menu__item  {{ request()->is('*calendar/*') ? 'kt-menu__item--active' : null }}" aria-haspopup="true">
                    <a href="{{route('adminCalendar',2)}}" class="kt-menu__link "><span class="kt-menu__link-text">@lang('allTranslate.calendar')</span></a>
                </li>
                <li class="kt-menu__item  {{ request()->is('*patient*') ? 'kt-menu__item--active' : null }}" aria-haspopup="true">
                    <a href="{{route('adminPatients')}}" class="kt-menu__link "><span class="kt-menu__link-text">@lang('allTranslate.Pacients')</span></a>
                </li>
            </ul>
        </div>
    </div>

    <!-- end: Header Menu -->

    <!-- begin:: Header Topbar -->
    <div class="kt-header__topbar">


        <!--end: Cart-->

    <!--begin: Language bar -->
        <div class="kt-header__topbar-item kt-header__topbar-item--langs">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
									<span class="kt-header__topbar-icon kt-header__topbar-icon--brand">
                                         @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                            @if($localeCode == app()->getLocale())
                                                <img src="{{asset('assetsnew/media/flags/'.$properties['regional'].'.svg')}}" alt=""/>
                                            @endif
                                        @endforeach
									</span>
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim">
                <ul class="kt-nav kt-margin-t-10 kt-margin-b-10">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <li class="kt-nav__item  @if($localeCode == app()->getLocale()) kt-nav__item--active @endif">
                            <a hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="kt-nav__link">
                                <span class="kt-nav__link-icon">
                                    <img src="{{asset('assetsnew/media/flags/'.$properties['regional'].'.svg')}}" alt=""/>
                                </span>
                                <span class="kt-nav__link-text">{{ $properties['native'] }} </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!--end: Language bar -->

        <!--begin: User bar -->
        <div class="kt-header__topbar-item kt-header__topbar-item--user">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                <span class="kt-hidden kt-header__topbar-welcome">@lang('allTranslate.add_visit')</span>
                <span class="kt-hidden kt-header__topbar-username">{{ auth()->user()->name }}</span>
                <img class="kt-hidden" alt="Pic" src="{{asset('assetsnew/media/users/300_21.jpg')}}"/>
                <img class="kt-hidden" alt="Pic" src="{{asset(auth()->user()->avatar??'/assetsnew/img/avatar.jpg')}}"/>
                <span class="kt-header__topbar-icon kt-hidden-"><i class="fa fa-user"></i></span>
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">

                <!--begin: Head -->
                <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url({{asset('assetsnew/media/misc/bg-1.jpg')}})">
                    <div class="kt-user-card__avatar">
                        <img class="kt-hidden" alt="Pic" src="{{asset('assetsnew/media/users/300_25.jpg')}}"/>
                        <span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">S</span>
                    </div>
                    <div class="kt-user-card__name">{{ auth()->user()->name }}</div>
                    <div class="kt-user-card__badge">
                        <span class="btn btn-success btn-sm btn-bold btn-font-md">
                             @foreach( auth()->user()->getRoleNames() as $item )
                                {{$item}}
                            @endforeach
                        </span>
                    </div>
                </div>


                <div class="kt-notification">
                    <a href="{{route('adminUser')}}" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="fa fa-user kt-font-success"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title kt-font-bold">
                                @lang('allTranslate.profile')

                            </div>
                            <div class="kt-notification__item-time">
                                @lang('allTranslate.setting_account')
                            </div>
                        </div>
                    </a>
                    @hasrole('SuperAdmin|Admin')
                    <a href="{{route('adminStatistic')}}" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="fa fa-chart-line kt-font-warning"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title kt-font-bold">
                                @lang('allTranslate.analitic')
                            </div>
                            <div class="kt-notification__item-time">
                                @lang('allTranslate.Clinic_analytics')
                            </div>
                        </div>
                    </a>
                    <a href="{{route('adminUsers')}}" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="fa fa-user-cog"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title kt-font-bold">
                                @lang('allTranslate.Workers')
                            </div>
                            <div class="kt-notification__item-time">
                                @lang('allTranslate.Information_schedule_employees')
                            </div>
                        </div>
                    </a>
                    @endhasrole
                    <div class="kt-notification__custom kt-space-between">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="btn btn-label btn-label-brand btn-sm btn-bold">@lang('allTranslate.Exit')</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <!--<a href="custom/user/login-v2.html" target="_blank" class="btn btn-clean btn-sm btn-bold">Upgrade Plan</a>-->
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- end:: Header -->