<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">
    <!-- begin: Header Menu -->
    <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
    <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
        <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
            {{--<ul class="kt-menu__nav ">--}}
                {{--<li class="kt-menu__item  kt-menu__item--active " aria-haspopup="true"><a href="index.html" class="kt-menu__link "><span class="kt-menu__link-text">Пункт меню</span></a></li>--}}
            {{--</ul>--}}
        </div>
    </div>
    <!-- end: Header Menu -->

    <!-- begin:: Header Topbar -->
    <div class="kt-header__topbar">

        <!--begin: Language bar -->
        <div class="kt-header__topbar-item kt-header__topbar-item--langs">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
									<span class="kt-header__topbar-icon kt-header__topbar-icon--brand">
                                         @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                            @if($localeCode == app()->getLocale())
                                                <img src="{{asset('assets/media/flags/'.$properties['regional'].'.svg')}}" alt=""/>
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

        <!--begin: User Bar -->
        <div class="kt-header__topbar-item kt-header__topbar-item--user">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                <div class="kt-header__topbar-user">
                    <span class="kt-header__topbar-welcome kt-hidden-mobile"></span>
                    <span class="kt-header__topbar-username kt-hidden-mobile">{{ auth()->user()->name }}</span>
                    <img alt="Pic" class="kt-radius-100" src="{{asset(auth()->user()->avatar??'/assets/media/avatar.jpg')}}">
                </div>
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">
                <!--begin: Head -->
                <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="    background: #042552;">
                    <div class="kt-user-card__avatar">
                        <img class="kt-hidden" alt="Pic" src="{{asset(auth()->user()->avatar??'/assets/media/avatar.jpg')}}"/>
                        <span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">
                                                <img alt="Pic" class="kt-radius-100" src="{{asset(auth()->user()->avatar??'/assets/media/avatar.jpg')}}">

                        </span>
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
                    {{--<a href="{{route('adminUser')}}" class="kt-notification__item">--}}
                        {{--<div class="kt-notification__item-icon">--}}
                            {{--<i class="fa fa-user kt-font-success"></i>--}}
                        {{--</div>--}}
                        {{--<div class="kt-notification__item-details">--}}
                            {{--<div class="kt-notification__item-title kt-font-bold">--}}
                                {{--@lang('allTranslate.profile')--}}

                            {{--</div>--}}

                        {{--</div>--}}
                    {{--</a>--}}
                    {{--@hasrole('SuperAdmin|Admin')--}}
                    {{--<a href="{{route('adminStatistic')}}" class="kt-notification__item">--}}
                        {{--<div class="kt-notification__item-icon">--}}
                            {{--<i class="fa fa-chart-line kt-font-warning"></i>--}}
                        {{--</div>--}}
                        {{--<div class="kt-notification__item-details">--}}
                            {{--<div class="kt-notification__item-title kt-font-bold">--}}
                                {{--@lang('allTranslate.analitic')--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</a>--}}
                    {{--@endhasrole--}}
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="fa fa-user-cog"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title kt-font-bold">
                                @lang('allTranslate.Exit')
                            </div>
                        </div>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>

        <!--end: User Bar -->
    </div>

    <!-- end:: Header Topbar -->
</div>
