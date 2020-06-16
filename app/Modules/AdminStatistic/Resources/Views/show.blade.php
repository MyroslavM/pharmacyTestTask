@extends('admin::main')

@section('title', trans("allTranslate.analitic"))
@section('breadCrumb', Breadcrumbs::render('adminStatistic'))

@section('content')
    <div class="kt-portlet__body">
        <div class="kt-portlet">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon"><i class="kt-font-brand fa fa-chart-bar"></i></span>
                    <h3 class="kt-portlet__head-title">
                        @lang('allTranslate.analitic')
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            <a href="{{ redirect()->back()->getTargetUrl() }}" class="btn btn-secondary btn-elevate btn-icon-sm">
                                <i class="fa fa-undo"></i>
                                @lang('allTranslate.back')
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <ul class="nav nav-tabs  nav-tabs-line" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#kt_tabs_1_1" role="tab" aria-selected="true"><i class="fa fa-tags" aria-hidden="true"></i>@lang('allTranslate.Where_find_us')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_tabs_1_2" role="tab" aria-selected="false"><i class="fa fa-tags" aria-hidden="true"></i>@lang('allTranslate.on_account')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_tabs_1_3" role="tab" aria-selected="false"><i class="fa fa-tags" aria-hidden="true"></i>@lang('allTranslate.on_diagnoz')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_tabs_1_4" role="tab" aria-selected="false"><i class="fa fa-tags" aria-hidden="true"></i>@lang('allTranslate.on_doctor')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_tabs_1_5" role="tab" aria-selected="false"><i class="fa fa-tags" aria-hidden="true"></i>@lang('allTranslate.on_services')</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="kt_tabs_1_1" role="tabpanel">
                        <div id="kt_chart_1" style="height: 500px;"></div>
                    </div>
                    <div class="tab-pane" id="kt_tabs_1_2" role="tabpanel">
                        <div id="kt_chart_2" style="height: 500px;"></div>
                    </div>
                    <div class="tab-pane" id="kt_tabs_1_3" role="tabpanel">
                        <div id="kt_chart_3" style="height: 500px;"></div>
                    </div>
                    <div class="tab-pane" id="kt_tabs_1_4" role="tabpanel">
                        <div id="kt_chart_4" style="height: 500px;"></div>
                    </div>
                    <div class="tab-pane" id="kt_tabs_1_5" role="tabpanel">
                        <div id="kt_chart_5" style="height: 500px;"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('scripts')

    <script type="text/javascript" src="{{asset('assetsnew/js/amcharts.js')}}"></script>
    <script type="text/javascript" src="{{asset('assetsnew/js/serial.js')}}"></script>
    <script type="text/javascript" src="{{asset('assetsnew/js/animate.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assetsnew/js/light.js')}}"></script>
    <script>

        var KTamChartsChartWhere = function () {

            return {
                init: function () {
                    AmCharts.makeChart("kt_chart_1", {
                        rtl: KTUtil.isRTL(),
                        type: "serial",
                        theme: "light",
                        dataProvider: [
                                @foreach($where_array as $key => $value)
                            {
                                key: "{{$key}}", value: {{$value}}
                            },
                            @endforeach
                        ],
                        valueAxes: [{
                            gridColor: "#FFFFFF",
                            gridAlpha: .2,
                            dashLength: 0
                        }],
                        gridAboveGraphs: !0,
                        startDuration: 1,
                        graphs:
                            [{
                                balloonText: "[[category]]: <b>[[value]]</b>",
                                fillAlphas: .8,
                                lineAlpha: .2,
                                type: "column",
                                valueField: "value"
                            }],
                        chartCursor:
                            {
                                categoryBalloonEnabled: !1, cursorAlpha:
                                    0, zoomable:
                                    !1
                            },
                        categoryField: "key",
                        categoryAxis:
                            {
                                // labelRotation: 90,
                                "gridPosition": "start",
                                "gridAlpha": 0,
                                "autoWrap": true
                            },
                    })
                }
            }
        }();
        var KTamChartsChartAge = function () {

            return {
                init: function () {
                    AmCharts.makeChart("kt_chart_2", {
                        rtl: KTUtil.isRTL(),
                        type: "serial",
                        theme: "light",
                        dataProvider: [
                                @foreach($birthday_array as $key => $value)
                            {
                                key: "{{$key}}", value: {{$value}}
                            },
                            @endforeach
                        ],
                        valueAxes: [{
                            gridColor: "#FFFFFF",
                            gridAlpha: .2,
                            dashLength: 0
                        }],
                        gridAboveGraphs: !0,
                        startDuration: 1,
                        graphs:
                            [{
                                balloonText: "[[category]]: <b>[[value]]</b>",
                                fillAlphas: .8,
                                lineAlpha: .2,
                                type: "column",
                                valueField: "value"
                            }],
                        chartCursor:
                            {
                                categoryBalloonEnabled: !1, cursorAlpha:
                                    0, zoomable:
                                    !1
                            },
                        categoryField: "key",
                        categoryAxis:
                            {
                                // labelRotation: 90,
                                "gridPosition": "start",
                                "gridAlpha": 0,
                                "autoWrap": true
                            },
                    })
                }
            }
        }();
        var KTamChartsChartDisease = function () {

            return {
                init: function () {
                    AmCharts.makeChart("kt_chart_3", {
                        rtl: KTUtil.isRTL(),
                        type: "serial",
                        theme: "light",
                        dataProvider: [
                                @foreach($diagnosis_array as $key => $value)
                            {
                                key: "{{$key}}", value: {{$value}}
                            },
                            @endforeach
                        ],
                        valueAxes: [{
                            gridColor: "#FFFFFF",
                            gridAlpha: .2,
                            dashLength: 0
                        }],
                        gridAboveGraphs: !0,
                        startDuration: 1,
                        graphs:
                            [{
                                balloonText: "[[category]]: <b>[[value]]</b>",
                                fillAlphas: .8,
                                lineAlpha: .2,
                                type: "column",
                                valueField: "value"
                            }],
                        chartCursor:
                            {
                                categoryBalloonEnabled: !1, cursorAlpha:
                                    0, zoomable:
                                    !1
                            },
                        categoryField: "key",
                        categoryAxis:
                            {

                                // labelRotation: 90,
                                "gridPosition": "start",
                                "gridAlpha": 0,
                                "autoWrap": true
                            },
                    })
                }
            }
        }();
        var KTamChartsChartDoctors = function () {

            return {
                init: function () {
                    AmCharts.makeChart("kt_chart_4", {
                        rtl: KTUtil.isRTL(),
                        type: "serial",
                        theme: "light",
                        dataProvider: [
                                @foreach($doctors_array as $key => $value)
                            {
                                key: "{{$key}}", value: {{$value}}
                            },
                            @endforeach
                        ],
                        valueAxes: [{
                            gridColor: "#FFFFFF",
                            gridAlpha: .2,
                            dashLength: 0
                        }],
                        gridAboveGraphs: !0,
                        startDuration: 1,
                        graphs:
                            [{
                                balloonText: "[[category]]: <b>[[value]]</b>",
                                fillAlphas: .8,
                                lineAlpha: .2,
                                type: "column",
                                valueField: "value"
                            }],
                        chartCursor:
                            {
                                categoryBalloonEnabled: !1, cursorAlpha:
                                    0, zoomable:
                                    !1
                            },
                        categoryField: "key",
                        categoryAxis:
                            {
                                // labelRotation: 90,
                                "gridPosition": "start",
                                "gridAlpha": 0,
                                "autoWrap": true
                            },
                    })
                }
            }
        }();
        var KTamChartsChartServices = function () {

            return {
                init: function () {
                    AmCharts.makeChart("kt_chart_5", {
                        rtl: KTUtil.isRTL(),
                        type: "serial",
                        theme: "light",
                        dataProvider: [
                                @foreach($service_array as $key => $value)
                            {
                                key: "{{$key}}", value: {{$value}}
                            },
                            @endforeach
                        ],
                        valueAxes: [{
                            gridColor: "#FFFFFF",
                            gridAlpha: .2,
                            dashLength: 0
                        }],
                        gridAboveGraphs: !0,
                        startDuration: 1,
                        graphs:
                            [{
                                balloonText: "[[category]]: <b>[[value]]</b>",
                                fillAlphas: .8,
                                lineAlpha: .2,
                                type: "column",
                                valueField: "value"
                            }],
                        chartCursor:
                            {
                                categoryBalloonEnabled: !1, cursorAlpha:
                                    0, zoomable:
                                    !1
                            },
                        categoryField: "key",
                        categoryAxis:
                            {
                                // labelRotation: 90,
                                "gridPosition": "start",
                                "gridAlpha": 0,
                                "autoWrap": true
                            },
                    })
                }
            }
        }();

        jQuery(document).ready(function () {
            KTamChartsChartWhere.init();
            KTamChartsChartAge.init();
            KTamChartsChartDisease.init();
            KTamChartsChartDoctors.init();
            KTamChartsChartServices.init();
        });

    </script>


@endpush
