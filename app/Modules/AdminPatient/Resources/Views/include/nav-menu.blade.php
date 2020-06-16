<div class="kt-portlet__head">
    <div class="kt-portlet__head-toolbar">
        <ul class="nav nav-tabs nav-tabs-space-xl nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand" role="tablist">
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'editPatient' ? 'active' : null }}" href="{{ route('editPatient', ['id' => $item->id]) }}">
                    <i class="kt-menu__link-icon  fa fa-user-edit"></i>
                    Основная информация
                </a>
            </li>
            {{--<li class="nav-item">--}}
            {{--<a class="nav-link " data-toggle="tab" href="#kt_user_edit_tab_2" role="tab" aria-selected="true">--}}
            {{--<i class="kt-menu__link-icon  fa fa-clipboard-list"></i>--}}
            {{--Мед. сведения--}}
            {{--</a>--}}
            {{--</li>--}}
            <li class="nav-item">
                <a class="nav-link {{ in_array(Route::currentRouteName(),['visitPatient', 'editVisitPatient']) ? 'active' : null }}" href="{{ route('visitPatient', ['id' => $item->id]) }}">
                    <i class="kt-menu__link-icon fa fa-calendar-check"></i>
                    История визитов
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'form043Patient' ? 'active' : null }}" href="{{ route('form043Patient', ['id' => $item->id]) }}">
                    <i class="fab fa-wpforms"></i>
                    Форма 043
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'epicrizPatient' ? 'active' : null }}" href="{{ route('epicrizPatient', ['id' => $item->id]) }}">
                    <i class="fab fa-wpforms"></i>
                    ЕПІКРИЗ
                </a>
            </li>
        </ul>
    </div>
</div>