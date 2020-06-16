@extends('admin::main')

@section('title', trans("allTranslate.Visit_completed"))
@section('breadCrumb', Breadcrumbs::render('visitPatient',$item))

@section('content')
    <div class="kt-portlet kt-portlet--tabs">

        @include('adminPatient::include/nav-menu')

        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon"><i class="kt-font-brand fa fa-calendar-check"></i></span>
                <h3 class="kt-portlet__head-title">
                    @lang('allTranslate.Save')
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <a href="{{ redirect()->back()->getTargetUrl() }}" class="btn btn-secondary btn-elevate btn-icon-sm">
                            <i class="fa fa-undo"></i>
                            @lang('allTranslate.back')
                        </a>
                        {{--&nbsp;--}}
                        {{--<a href="{{route('addPatient')}}" class="btn btn-brand btn-elevate btn-icon-sm">--}}
                        {{--<i class="la la-plus"></i>--}}
                        {{--Додати пацієнта--}}
                        {{--</a>--}}
                    </div>
                </div>
            </div>
        </div>
        <form class="kt-form">
            @csrf
            <div class="kt-portlet__body">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label class="form-label">@lang('allTranslate.doctor')</label>
                            <input type="text" disabled="disabled" class="form-control" value="{{$visit->doctor->surname??null}} {{$visit->doctor->name??null}} {{$visit->doctor->patronymic??null}}">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label class="form-label">@lang('allTranslate.Pacients')</label>
                            <input type="text" disabled="disabled" class="form-control" value="{{$visit->patient->first_name}} {{$visit->patient->name}} {{$visit->patient->last_name}}">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label class="form-label">@lang('allTranslate.Service')</label>
                            <input type="text" disabled="disabled" class="form-control" value="{{$visit->service?$visit->service->name:$visit->also}}">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label class="form-label">@lang('allTranslate.date_record')</label>
                            <input type="text" disabled="disabled" value="{{\Carbon\Carbon::parse($visit->date)->format('Y.m.d')}}" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label class="form-label">@lang('allTranslate.time_record')</label>
                            <input type="text" value="{{\Carbon\Carbon::parse($visit->date)->format('H:i') . '-' . \Carbon\Carbon::parse($visit->date_end)->format('H:i')}}" class="form-control" disabled="disabled">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label class="form-label">@lang('allTranslate.phone')</label>
                            <input type="text" class="form-control phone-mask" value="{{$visit->patient->phone??null}}" disabled="disabled">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <label class="form-label">@lang('allTranslate.reason_visit')</label>
                            <textarea class="form-control" name="complaints" placeholder="@lang('allTranslate.write_reason_visit')" disabled="disabled">{{$visit->complaints}}</textarea>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <label class="form-label">@lang('allTranslate.Conclusion')</label>
                            <textarea class="form-control" name="conclusion" placeholder="@lang('allTranslate.Write_conclusion')" disabled="disabled">{{$visit->conclusion}}</textarea>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-4 ">
                        <div class="form-group">
                            <label for="name">@lang('allTranslate.Diagnosis')</label>
                            <select class="form-control select_2" name="diagnosis[]" data-placeholder="@lang('allTranslate.Select_diagnosis')" disabled="disabled">
                                @foreach($diseases as $disease)
                                    <option value="{{$disease->id}}" @if ($visit_data['diseases']->contains($disease->id)) selected @endif>{{$disease->name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="name">@lang('allTranslate.product')</label>
                            <select class="form-control select_2" name="products[]" multiple="multiple" data-placeholder="@lang('allTranslate.select_product')" disabled="disabled">
                                @foreach($products as $product)
                                    <option value="{{$product->id}}" @if ($visit_data['products']->contains($product->id)) selected @endif>{{$product->name}} ({{ $product->price }} грн)</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="name">@lang('allTranslate.status')</label>
                            <select class="form-control select_2" name="status_id" data-placeholder="@lang('allTranslate.select_status')" disabled="disabled">
                                <option selected>{{$visit->status_my->name??null}}</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="name">Услуги</label>
                            <select class="form-control select_2 select_service_price" name="services[]" multiple="multiple" disabled="disabled" data-placeholder="Выберите услуги">
                                @foreach($services as $service)
                                    <option value="{{$service->id}}" @if ($visit_data['services']->contains($service->id)) selected @endif>{{$service->name}} ({{ $service->price }} грн)</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-4 ">
                        <div class="form-group">
                            <label for="name">@lang('allTranslate.Manipulations')</label>
                            <select class="form-control select_2" name="manipulation[]" multiple="multiple" data-placeholder="@lang('allTranslate.Select_manipulations')" disabled="disabled">
                                @foreach($manipulations as $manipulation)
                                    <option value="{{$manipulation->id}}" @if ($visit_data['manipulations']->contains($manipulation->id)) selected @endif>{{$manipulation->name}} ({{ $manipulation->price }} грн)</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="form-group date-manipulation">
                            <label>@lang('allTranslate.Date_manipulations')<span class="text-danger">*</span></label>
                            <input autocomplete="off" value="{{$visit->date_manipulation ? \Carbon\Carbon::parse($visit->date_manipulation)->format('d.m.Y'): null}}" type="text" class="form-control" id="kt_datepicker_1" placeholder="@lang('allTranslate.select_date')" disabled="disabled">
                            <div class="invalid-feedback"></div>
                            <span class="form-text text-muted">@lang('allTranslate.Date_format'): <code>05.02.2020</code></span>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>3Д снимок</label>


                            <table class="table     image_container">
                                <tbody>
                                @if (isset($images['3d']))
                                    <tr data-id="{{ $images['3d']->id }}">
                                        <td class="px-0 pb-0">
                                            <div class="img_visit_item">
                                                <a href="{{ $images['3d']->filepath . '/' . $images['3d']->filename }}" class="d-block image_link">
                                                    <img src="{{ $images['3d']->filepath . '/' . $images['3d']->filename }}" class="img-fluid" alt="">
                                                </a>
                                                <div class="img_visit_item_control">
                                                    <a class='btn btn-primary img-preview' data-fancybox="gallery3D" href='{{ $images['3d']->filepath . '/' . $images['3d']->filename }}'><i class='fa fa-search-plus pr-0'></i></a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Дополнительные снимки</label>
                            <table class="table  images_container">
                                <tbody>
                                <tr style="display: none"></tr>
                                @foreach($images['additional'] as $image)
                                    <tr data-id="{{ $image->id }}">
                                        <td class="px-0 pb-0">
                                            <div class="img_visit_item">
                                                <a href="{{ $image->filepath . '/' . $image->filename }}" class="d-block image_link">
                                                    <img src="{{ $image->filepath . '/' . $image->filename }}" class="img-fluid" alt="">
                                                </a>
                                                <div class="img_visit_item_control">
                                                    <a class='btn btn-primary' data-fancybox="galleryAll" href='{{ $image->filepath . '/' . $image->filename }}'><i class='fa fa-search-plus pr-0'></i></a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-12 ">
                        <hr>
                        <h3 class="dark">Стоимость визита</h3>


                        <table class="table printTableItems printTableItemsNarrow totalCost" style="margin-left: 0">
                            <thead>
                            <tr>
                                <th width="1%"></th>
                                <th width="60%">Работа</th>
                                <th class="textAlignRight" width="10%">Стоимость</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($costs as $cost)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $cost->name }}</td>
                                    <td class="textAlignRight">{{ $cost->price }} грн</td>
                                </tr>
                            @endforeach
                            <tr class="printTableTotalRow">
                                <td colspan="2" class="text-right"><h2 class="mb-0">Всего:</h2></td>
                                <td class=""><h2 class="font-weight-bold text-nowrap">{{ $visit->cost }} грн</h2></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{--<div class="kt-portlet__foot">--}}
            {{--<div class="kt-portlet__head-actions justify-content-end d-flex">--}}
            {{--<a href="{{ route('adminVisits') }}" class="btn btn-secondary btn-elevate btn-icon-sm"><i class="fa fa-window-close"></i> Відмінити</a>--}}
            {{--</div>--}}
            {{--</div>--}}
        </form>
    </div>
@endsection


@push('scripts')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css"/>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

    <style>
        .img_visit_item {
            position: relative;
            max-width: 150px;
            border: 1px solid #e2e5ec;
        }

        .img_visit_item_control {
            position: absolute;
            right: 0;
            top: 0;
            left: 0;
            bottom: 0;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .images_container tbody td {
            border-top: 0px;
        }

        .images_container tbody {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .img_visit_item_control a {
            margin: 0 10px;
        }
        .table th, .table td{
            border-top: none!important;
        }
    </style>

    <script>
        $(".phone-mask").inputmask("mask", {
            "mask": "+38 (999) 999-9999"
        });
        $('#kt_datepicker_1').datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            language: "{{app()->getLocale()}}",
            isRTL: false,
            autoclose: true,
            format: "dd.mm.yyyy",
        });

        $('.select_2').select2();



    </script>


@endpush