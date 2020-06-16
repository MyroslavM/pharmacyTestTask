<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>CRM</title>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('assetsnew/img/favicon.png')}}">
    <link rel="shortcut icon" href="{{asset('assetsnew/img/favicon.png')}}" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link href="assets/css/pages/login/login-1.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
    {{--    <link href="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css"/>--}}
    <link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css"/>


    {{--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">--}}
    {{--<link href="{{asset('assetsnew/js/login-2.css')}}" rel="stylesheet" type="text/css"/>--}}
    {{--<link href="{{asset('assetsnew/js/plugins.bundle.css')}}" rel="stylesheet" type="text/css"/>--}}
    {{--<link href="{{asset('assetsnew/js/style.bundle.css')}}" rel="stylesheet" type="text/css"/>--}}
</head>
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">

@yield('content')

<script src="{{ asset('assetsnew/js/jquery-3.2.1.min.js') }}"></script>


<script src="{{asset('assetsnew/js/plugins.bundle.js')}}" type="text/javascript"></script>
<script src="{{asset('assetsnew/js/scripts.bundle.js')}}" type="text/javascript"></script>


{{--<script src="{{asset('assets/js/pages/custom/login/login-1.js')}}" type="text/javascript"></script>--}}


@stack('scripts')


<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#2c77f4",
                "light": "#ffffff",
                "dark": "#282a3c",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
            }
        }
    };
</script>

</body>
</html>
