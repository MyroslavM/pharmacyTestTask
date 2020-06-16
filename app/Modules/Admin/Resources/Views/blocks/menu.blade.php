<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
    <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
        <ul class="kt-menu__nav ">
            <li class="kt-menu__item   {{ request()->is('*calendar*') ? 'kt-menu__item--active' : null }}" aria-haspopup="true">
                <a href="{{route('adminCalendar',2)}}" class="kt-menu__link ">
                    <i class="kt-menu__link-icon fa fa-calendar-alt"></i><span class="kt-menu__link-text">@lang('allTranslate.calendar')</span>
                </a>
            </li>
            <li class="kt-menu__item {{ request()->is('*visits*') ? 'kt-menu__item--active' : null }}" aria-haspopup="true">
                <a href="{{route('adminVisits')}}" class="kt-menu__link ">
                    <i class="kt-menu__link-icon fa fa-calendar-check"></i><span class="kt-menu__link-text">@lang('allTranslate.visit') </span>
                </a>
            </li>
            <li class="kt-menu__item {{ request()->is('*patient*') ? 'kt-menu__item--active' : null }}" aria-haspopup="true">
                <a href="{{route('adminPatients')}}" class="kt-menu__link ">
                    <i class="kt-menu__link-icon fa fa-users"></i><span class="kt-menu__link-text">@lang('allTranslate.Pacients')</span>
                </a>
            </li>

            @hasrole('SuperAdmin|Admin|Manager')
            <li class="kt-menu__item {{ request()->is('*users*') ? 'kt-menu__item--active' : null }}" aria-haspopup="true">
                <a href="{{route('adminUsers')}}" class="kt-menu__link ">
                    <i class="kt-menu__link-icon  fa fa-user-edit"></i><span class="kt-menu__link-text">@lang('allTranslate.Workers')</span>
                </a>
            </li>
            @endhasrole

            <li class="kt-menu__item {{ request()->is('*user') ? 'kt-menu__item--active' : null }}" aria-haspopup="true">
                <a href="{{route('adminUser')}}" class="kt-menu__link ">
                    <i class="kt-menu__link-icon fa fa-user-lock"></i><span class="kt-menu__link-text">@lang('allTranslate.profile')</span>
                </a>
            </li>

            @hasrole('SuperAdmin|Admin')
            <li class="kt-menu__item  kt-menu__item&#45;&#45;submenu
            {{ request()->is('*/clinics*') ? 'kt-menu__item--active' : null }}
            {{ request()->is('*/statistic*') ? 'kt-menu__item--active' : null }}"
                data-ktmenu-submenu-toggle="hover">
                <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon fa fa-cogs"></i>
                    <span class="kt-menu__link-text">@lang('allTranslate.setting')</span>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                        <li class="kt-menu__item {{ request()->is('*/clinics*') ? 'kt-menu__item--active' : null }}">
                            <a href="{{route('adminClinics')}}" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet&#45;&#45;dot"><span></span></i>
                                <span class="kt-menu__link-text">@lang('allTranslate.clinics')</span>
                            </a>
                        </li>
                        <li class="kt-menu__item {{ request()->is('*/statistic*') ? 'kt-menu__item--active' : null }}">
                            <a href="{{route('adminStatistic')}}" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet&#45;&#45;dot"><span></span></i>
                                <span class="kt-menu__link-text">@lang('allTranslate.analitic')</span>
                            </a>
                        </li>
                        <li class="kt-menu__item {{ request()->is('/users*') ? 'kt-menu__item--active' : null }}" aria-haspopup="true">
                            <a href="{{route('widgetAdd')}}" class="kt-menu__link " target="_blank">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet&#45;&#45;dot"><span></span></i>
                                <span class="kt-menu__link-text">@lang('allTranslate.widget')</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endhasrole


            @hasrole('SuperAdmin|Admin')
            <li class="kt-menu__item  kt-menu__item&#45;&#45;submenu
            {{ request()->is('*/fields*') ? 'kt-menu__item--active' : null }}
                    " data-ktmenu-submenu-toggle="hover">
                <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon fa fa-list-ol"></i>
                    <span class="kt-menu__link-text">@lang('allTranslate.Templates')</span>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">

                        <li class="kt-menu__item {{ request()->is('*/products*') ? 'kt-menu__item--active' : null }}">
                            <a href="{{route('adminProducts')}}" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet&#45;&#45;dot"><span></span></i>
                                <span class="kt-menu__link-text">@lang('allTranslate.Product')</span>
                            </a>
                        </li>
                        <li class="kt-menu__item {{ request()->is('*/services*') ? 'kt-menu__item--active' : null }}">
                            <a href="{{route('adminServices')}}" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet&#45;&#45;dot"><span></span></i>
                                <span class="kt-menu__link-text">@lang('allTranslate.Service')</span>
                            </a>
                        </li>
                        <li class="kt-menu__item {{ request()->is('*/diseases*') ? 'kt-menu__item--active' : null }}">
                            <a href="{{route('adminDiseases')}}" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet&#45;&#45;dot"><span></span></i>
                                <span class="kt-menu__link-text">@lang('allTranslate.Diagnose')</span>
                            </a>
                        </li>

                        <li class="kt-menu__item {{ request()->is('*/manipulations*') ? 'kt-menu__item--active' : null }}">
                            <a href="{{route('adminManipulations')}}" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet&#45;&#45;dot"><span></span></i>
                                <span class="kt-menu__link-text">@lang('allTranslate.Manipulations')</span>
                            </a>
                        </li>
                        <li class="kt-menu__item {{ request()->is('*/marketing*') ? 'kt-menu__item--active' : null }}">
                            <a href="{{route('adminMarketings')}}" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet&#45;&#45;dot"><span></span></i>
                                <span class="kt-menu__link-text">@lang('allTranslate.Marketing')</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endhasrole


            <li class="kt-menu__item {{ request()->is('*instruction') ? 'kt-menu__item--active' : null }}" aria-haspopup="true">
                <a href="{{route('adminInstruction')}}" class="kt-menu__link ">
                    <i class="kt-menu__link-icon fa fa-video"></i><span class="kt-menu__link-text">@lang('allTranslate.instruction')</span>
                </a>
            </li>
        </ul>

    </div>
</div>
