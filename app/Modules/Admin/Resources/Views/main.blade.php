<!doctype html>
<html lang="{{app()->getLocale()}}">
<head>
    <title>@yield('title') </title>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('assetsnew/img/favicon.png')}}">
    <link rel="shortcut icon" href="{{asset('assetsnew/img/favicon.png')}}" type="image/x-icon">


    @stack('styles')

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
    {{--    <link href="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css"/>--}}
    <link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css"/>


</head>


<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">


<!-- begin:: Page -->

<!-- begin:: Header Mobile -->

@include('admin::blocks._headerMobile')
<!-- end:: Header Mobile -->


<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

        <!-- begin:: Aside Menu -->
    @include('admin::blocks._menu')
    <!-- end:: Aside Menu -->

        <!-- end:: Aside -->
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

            <!-- begin:: Header -->
        @include('admin::blocks._header')
        <!-- end:: Header -->


            <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

                <!-- begin:: Subheader -->
            @include('admin::blocks._subheader')
            <!-- end:: Subheader -->


                <!-- begin:: Content -->
                <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

                    <!--Begin::Dashboard-->

                @yield('content')


                <!--End::Dashboard-->
                </div>

                <!-- end:: Content -->
            </div>

        @include('admin::blocks._footer')


        <!-- end:: Footer -->
        </div>
    </div>
</div>


<!-- end:: Page -->

@include('admin::blocks.scripts')


<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('allTranslate.delete_record')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <h5 class="modal-body ">
                <strong>{{auth()->user()->name}}</strong> @lang('allTranslate.you_delete_information')
                <div class="alert d-block alert-outline-warning mt-3 px-2" wfd-id="55">@lang('allTranslate.after_deleting_information') &nbsp;<strong> @lang('allTranslate.not_subject') </strong>&nbsp; @lang('allTranslate.recovery') </div>
            </h5>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-6">
                        <button type="button" class="btn btn-secondary d-flex" data-dismiss="modal"><i class="fa fa-window-close"></i> <span class="d-m-n">@lang('allTranslate.cancel_btn') </span></button>
                    </div>
                    <div class="col-6">
                        <form method="post" action="@yield('delete')" id="form-delete">
                            @csrf
                            <input hidden name="id">
                            <button id="delete" aria-hidden="true" type="submit" class="btn btn-warning d-flex"><i class="la la-trash"></i> <span class="d-m-n">@lang('allTranslate.delete_btn')</span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .breadcrumb {
        margin-bottom: 0;
        font-size: 16px;
        background-color: #22b9ff;
    }

    .breadcrumb-item + .breadcrumb-item::before {
        color: #fdfdfd;
    }

    .breadcrumb-item.active {
        color: #f5f5f5;
    }

    .breadcrumb a {
        color: #fff;
    }

    .kt-subheader-search {
        padding: 20px 0;
    }

    .kt-subheader-search {
        background-color: #22b9ff;
    }

    @media (max-width: 576px) {
        .d-m-n {
            display: none;
        }

        .btn i {
            padding-right: 0;
        }
    }

    .select_2-100 .select2-container {
        width: 100% !important;
    }

    @media (max-width: 1024px) {
        .kt-aside.kt-aside--on {
            right: 0;
            left: auto;
        }

        .kt-aside-close {
            right: -25px;
            left: auto;
        }

        .kt-aside--on .kt-aside-close {
            right: 249px;
            left: auto;
        }

        .kt-aside {
            right: -295px;
            left: auto;
        }

    }

    .form-group-invalid {

    }

    .form-group-invalid .select2-container--default .select2-selection--multiple, .form-group-invalid .select2-container--default .select2-selection--single {
        border: 1px solid #db1430;
    }
    .datepicker table tr td, .datepicker table tr th{
        border-radius: 0px;
    }
    .fc-event{
         border-radius: 0px;
    }
    .swal2-popup .swal2-content {
        margin-top: 0 !important;
    }

    .swal2-popup.swal2-toast .swal2-header {
        margin-right: 10px;
    }

    .form-group {
        margin-bottom: 1rem;
    }
    .modal-content{
        border: none;
    }




    .kt-header-menu .kt-menu__nav > .kt-menu__item.kt-menu__item--open, .kt-header-menu .kt-menu__nav > .kt-menu__item.kt-menu__item--active {
        background-color: #042552;
    }
    .kt-aside__brand{
        background: #fff;
    }
    .kt-aside__brand .kt-aside__brand-tools .kt-aside__brand-aside-toggler:hover span {
        background: #000000;
    }
    .kt-aside__brand .kt-aside__brand-tools .kt-aside__brand-aside-toggler:hover span::before, .kt-aside__brand .kt-aside__brand-tools .kt-aside__brand-aside-toggler:hover span::after {
        background: #000000;
    }
    .kt-aside__brand .kt-aside__brand-tools .kt-aside__brand-aside-toggler.kt-aside__brand-aside-toggler--active span::before, .kt-aside__brand .kt-aside__brand-tools .kt-aside__brand-aside-toggler.kt-aside__brand-aside-toggler--active span::after {
        background: #000000;
    }
    .kt-aside__brand .kt-aside__brand-tools .kt-aside__brand-aside-toggler.kt-aside__brand-aside-toggler--active span {
        background: #000000;
    }
</style>


@stack('modals')

</body>
</html>