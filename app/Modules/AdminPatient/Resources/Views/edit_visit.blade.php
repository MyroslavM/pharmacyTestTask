@extends('admin::main')

@section('title', trans("allTranslate.editing_visit"))

@section('breadCrumb', Breadcrumbs::render('visitPatient', $item))

@section('content')
    <div class="kt-portlet kt-portlet--tabs">

        @include('adminPatient::include/nav-menu')

        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon"><i class="kt-font-brand fa fa-calendar-check"></i></span>
                <h3 class="kt-portlet__head-title">
                    @lang('allTranslate.routes_edit_visits')
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

        <div class="tab-content">
            <form class="formAdd kt-form" method="POST">
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
                                <label class="form-label">@lang('allTranslate.Pacient')</label>
                                <input type="text" disabled="disabled" class="form-control" value="{{$visit->patient->first_name}} {{$visit->patient->name}} {{$visit->patient->last_name}}">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <label class="form-label">@lang('allTranslate.date_record')</label>
                                <input type="text" disabled="disabled" value="{{\Carbon\Carbon::parse($visit->date)->format('d.m.Y')}}" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label class="form-label">@lang('allTranslate.time_record')</label>
                                <input type="text" disabled="disabled" value="{{\Carbon\Carbon::parse($visit->date)->format('H:i') . '-' . \Carbon\Carbon::parse($visit->date_end)->format('H:i')}}" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label class="form-label">@lang('allTranslate.phone')</label>
                                <input type="text" disabled="disabled" class="form-control phone-mask" value="{{$visit->patient->phone??null}}">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label class="form-label">@lang('allTranslate.reason_visit')</label>
                                <textarea class="form-control" name="complaints" placeholder="@lang('allTranslate.write_reason_visit')">{{$visit->complaints}}</textarea>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label class="form-label">@lang('allTranslate.Conclusion')</label>
                                <textarea class="form-control" name="conclusion" placeholder="@lang('allTranslate.Write_conclusion')">{{$visit->conclusion}}</textarea>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group d-flex flex-column">
                                <label for="name">Диагнозы</label>
                                <select class="form-control select_2" name="diagnosis[]" data-placeholder="@lang('allTranslate.Select_diagnosis')" multiple="multiple">
                                    <option value="">@lang('allTranslate.Select_diagnosis')</option>
                                    @foreach($diseases as $disease)
                                        <option value="{{$disease->id}}" @if ($visit_data['diseases']->contains($disease->id)) selected @endif>{{$disease->name}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group d-flex flex-column">
                                <label for="name">Продукты</label>
                                <select class="form-control select_2 select_product_price" name="products[]" data-placeholder="@lang('allTranslate.select_product')" multiple="multiple">
                                    <option value="">@lang('allTranslate.select_product')</option>
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}" @if ($visit_data['products']->contains($product->id)) selected @endif>{{$product->name}} ({{ $product->price }} грн)</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group d-flex flex-column">
                                <label for="name">@lang('allTranslate.status')</label>
                                <select class="form-control select_2" name="status_id" data-placeholder="@lang('allTranslate.select_status')">
                                    @foreach($statuses as $status)
                                        <option value="{{$status->id}}" data-bgcolor="{{$status->color}}" {{$status->id==$visit->status_id?'selected':''}}>{{$status->name}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group d-flex flex-column">
                                <label for="name">Услуги</label>
                                <select class="form-control select_2 select_service_price" name="services[]" multiple="multiple" data-placeholder="Выберите услуги">
                                    @foreach($services as $service)
                                        <option value="{{$service->id}}" data-price="{{$service->price}}" @if ($visit_data['services']->contains($service->id)) selected @endif>{{$service->name}} ({{ $service->price }} грн)</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group d-flex flex-column">
                                <label for="name">@lang('allTranslate.Manipulations')</label>
                                <select class="form-control select_2 select_manipulation_price" name="manipulations[]" multiple="multiple" data-placeholder="@lang('allTranslate.Select_manipulations')">
                                    {{--<option value="" selected>@lang('allTranslate.Select_manipulations')</option>--}}
                                    @foreach($manipulations as $manipulation)
                                        <option value="{{$manipulation->id}}" @if ($visit_data['manipulations']->contains($manipulation->id)) selected @endif>{{$manipulation->name}} ({{ $manipulation->price }} грн)</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group d-flex flex-column">
                                <label>Запланировать следующий визит</label>
                                <input name="date_manipulation" autocomplete="off" type="text" class="form-control" id="kt_datepicker_1" value="{{$visit->date_manipulation ? \Carbon\Carbon::parse($visit->date_manipulation)->format('d.m.Y'): null}}" placeholder=""/>
                                <div class="invalid-feedback"></div>
                                <span class="form-text text-muted">@lang('allTranslate.Date_format'): <code>05.02.2020</code></span>
                            </div>
                        </div>
                        {{--<div class="col-sm-6 col-md-4">--}}
                        {{--<div class="form-group date-manipulation">--}}
                        {{--<label>@lang('allTranslate.Date_manipulations')<span class="text-danger">*</span></label>--}}
                        {{--<input autocomplete="off" name="date_manipulation" value="{{ $visit->date_manipulation ? \Carbon\Carbon::parse($visit->date_manipulation)->format('d.m.Y') : ''}}" type="text" class="form-control" id="kt_datepicker_1" placeholder="@lang('allTranslate.select_date')"/>--}}
                        {{--<div class="invalid-feedback"></div>--}}
                        {{--<span class="form-text text-muted">@lang('allTranslate.Date_format'): <code>05.02.2020</code></span>--}}
                        {{--</div>--}}
                        {{--</div>--}}


                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>3Д снимок</label>
                                <div class="dropzone dropzone-default" id="kt_dropzone_1">
                                    <div class="dropzone-msg dz-message needsclick">
                                        <h3 class="dropzone-msg-title">Перетащите файлы сюда или нажмите, чтобы загрузить.</h3>
                                        {{--<span class="dropzone-msg-desc">This is just a demo dropzone. Selected files are <strong>not</strong> actually uploaded.</span>--}}
                                    </div>
                                </div>
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
                                                        <a class='btn btn-danger img-delete' data-id="{{ $images['3d']->id }}" href='#'><i class='fa fa-window-close pr-0'></i></a>
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
                                <div class="dropzone dropzone-default" id="kt_dropzone_2">
                                    <div class="dropzone-msg dz-message needsclick">
                                        <h3 class="dropzone-msg-title">Перетащите файлы сюда или нажмите, чтобы загрузить.</h3>
                                        {{--<span class="dropzone-msg-desc">This is just a demo dropzone. Selected files are <strong>not</strong> actually uploaded.</span>--}}
                                    </div>
                                </div>
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
                                                        <a class='btn btn-danger img-delete' data-id="{{ $image->id }}" href='#'><i class='fa fa-window-close pr-0'></i></a>
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
                            <table class="table totalCost" style="margin-left: 0">
                                <thead>
                                <tr>
                                    <th width="1%">№</th>
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
                <div class="kt-portlet__foot">
                    <div class="kt-portlet__head-actions justify-content-end d-flex">
                        <a href="{{ route('adminVisits') }}" class="btn btn-secondary btn-elevate btn-icon-sm"><i class="fa fa-window-close"></i> <span class="d-m-n">@lang('allTranslate.cancel_btn')</span></a>
                        &nbsp;
                        <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm"><i class="fa fa-save"></i> <span class="d-m-n">@lang('allTranslate.Save')</span></button>
                    </div>
                </div>
            </form>
        </div>
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

        /*.overlay {*/
        /*position: fixed;*/
        /*left: 0;*/
        /*top: 0;*/
        /*z-index: 10000;*/
        /*width: 100%;*/
        /*height: 100%;*/
        /*background-color: rgba(0, 0, 0, .4);*/
        /*text-align: center;*/
        /*}*/

        /*.file-preview {*/
        /*width: 60%;*/
        /*height: 90%;*/
        /*position: absolute;*/
        /*left: 20%;*/
        /*top: 5%;*/
        /*border-radius: 4px;*/
        /*overflow: hidden;*/
        /*padding: 20px;*/
        /*color: #fff;*/
        /*background-color: #fff;*/
        /*box-shadow: 0 0 20px 0 rgba(0, 0, 0, 1.00);*/
        /*}*/

        /*.file-preview img {*/
        /*max-height: 100%;*/
        /*max-width: 100%;*/
        /*}*/

        /*.overlay-close {*/
        /*position: absolute;*/
        /*right: 20px;*/
        /*top: 11px;*/
        /*font-size: 18px !important;*/
        /*color: #000;*/
        /*cursor: pointer;*/
        /*}*/
    </style>


    <script>
        // function showPreview() {
        //     $('body').append('<div class="overlay"><div class="file-preview"><img src="" alt=""><i class="fa fa-times overlay-close"></i></div></div>');
        // }

        // $('table').on('click', '.img-preview', function (e) {
        //     e.preventDefault();
        //     showPreview();
        //     var path = $(this).data('path');
        //     $('.overlay').find('img').attr('src', path);
        //
        // });

        // $(document).on('click', '.overlay-close', function () {
        //     $('.overlay').remove();
        // });

        $('table').on('click', '.img-delete', function (e) {
            e.preventDefault();
            let _this = $(this),
                id = _this.data('id');
            $.ajax({
                method: "POST",
                url: '{{ route('editVisitPatient', ['id' => $visit->patient->id, 'visit_id' => $visit->id]) }}',
                data: {
                    image_id: id,
                    action: 'image_delete'
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    if (data.status) {
                        _this.parent().parent().parent().parent().remove();
                    }
                }
            });
        });

        $('#kt_dropzone_1').dropzone({
            url: "{{ route('editVisitPatient', ['id' => $visit->patient->id, 'visit_id' => $visit->id]) }}", // Set the url for your upload script location
            paramName: "image", // The name that will be used to transfer the file
            maxFiles: 1,
            maxFilesize: 30, // MB
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            init: function () {
                this.on("addedfile", function (file) {

                })
            },
            success: function (file, response) {
                if (response.status == 1) {
                    this.removeFile(file);

                    let html = '';
                    for (var i = 0; i < response.images.length; i++) {


                        html += "<tr data-id='" + response.images[i].id + "'>";

                        html += '<td class="px-0 pb-0">' +
                            '<div class="img_visit_item">' +
                            '<a href="' + response.images[i].path + '" class="d-block image_link"> <img src="' + response.images[i].path + '" class="img-fluid"></a>' +
                            '<div class="img_visit_item_control">' +
                            "<a class='btn btn-primary btn-icon-sm' data-fancybox='gallery3D'  href='" + response.images[i].path + "'><i class='fa fa-search-plus pr-0'></i></a>" +
                            "<a class='btn btn-danger btn-icon-sm img-delete' data-id='" + response.images[i].id + "' href='#'><i class='fa fa-window-close pr-0'></i></a>" +
                            '</div>' +
                            '</div>' +
                            '</td>';

                        html += "</tr>";
                    }

                    $('.image_container > tbody').html(html)
                }
            },
        });


        $('#kt_dropzone_2').dropzone({
            url: "{{ route('editVisitPatient', ['id' => $visit->patient->id, 'visit_id' => $visit->id]) }}", // Set the url for your upload script location

            paramName: "image", // The name that will be used to transfer the file
            parallelUploads: 10,
            maxFiles: 10,
            maxFilesize: 5, // MB
            autoProcessQueue: true,
            uploadMultiple: true,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            init: function () {
                this.on("addedfile", function (file) {

                })
            },
            success: function (file, response) {
                if (response.status == 1) {
                    this.removeFile(file);

                    for (var i = 0; i < response.images.length; i++) {

                        let tr = $('table.images_container').find('tr[data-id=' + response.images[i].id + ']');
                        if (tr.length == 0) {
                            let html = '';
                            html += "<tr data-id='" + response.images[i].id + "'>";
                            html += '<td class="px-0 pb-0">' +
                                ' <div class="img_visit_item">' +
                                '<a href="' + response.images[i].path + '" class="d-block image_link">  <img src="' + response.images[i].path + '" class="img-fluid" alt=""></a>' +
                                ' <div class="img_visit_item_control">' +
                                "<a class='btn btn-primary btn-icon-sm ' data-fancybox='galleryAll' href='" + response.images[i].path + "'><i class='fa fa-search-plus'></i></a>" +
                                "<a class='btn btn-danger btn-icon-sm img-delete' data-id='" + response.images[i].id + "' href='#'><i class='fa fa-window-close'></i></a>" +
                                '</div>' +
                                '</div>' +
                                '</td>';
                            html += "</tr>";
                            $('.images_container > tbody > tr').last().after(html);
                        }
                    }
                }
            },
        });


        $('#kt_datepicker_1').datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            language: "{{app()->getLocale()}}",
            isRTL: false,
            autoclose: true,
            format: "dd.mm.yyyy",
        });
    </script>
    <script>
        $(".phone-mask").inputmask("mask", {
            "mask": "+38 (999) 999-9999"
        });

        updateCost('select2:select', '.select_service_price', '{{ \App\Visit::class }}');
        updateCost('select2:unselect', '.select_service_price', '{{ \App\Visit::class }}');
        updateCost('select2:select', '.select_product_price', '{{ \App\Product::class }}');
        updateCost('select2:unselect', '.select_product_price', '{{ \App\Product::class }}');
        updateCost('select2:select', '.select_manipulation_price', '{{ \App\Manipulation::class }}');
        updateCost('select2:unselect', '.select_manipulation_price', '{{ \App\Manipulation::class }}');

        function updateCost(action, selector, type) {
            $(selector).on(action, function (e) {
                $.ajax({
                    method: "POST",
                    url: '{{route('updateVisitCost')}}',
                    data: {
                        id: e.params.data.id,
                        visit_id: '{{ $visit->id }}',
                        type: type,
                        action: action === 'select2:select' ? 'add' : 'delete'
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        renderTable(data);
                    }
                });
            });
        }

        function renderTable(data) {
            var html = "",
                cost = 0;

            for (var i = 0; i < data.costs.length; i++) {
                cost += data.costs[i].price;

                html += "<tr>";
                html += "<td>" + (i + 1) + "</td>";
                html += "<td>" + data.costs[i].name + "</td>";
                html += "<td>" + data.costs[i].price + " грн</td>";
                html += "</tr>";
            }

            html += "<tr class='printTableTotalRow'>";
            html += "<td colspan='2' class='text-right'><h2 class='mb-0'>Всего:</h2></td>";
            html += "<td><h2 class='font-weight-bold text-nowrap'>" + cost + " грн</h2></td>";
            html += " </tr>";

            $('.totalCost > tbody').html(html);
        }

        $('.select_2').select2();
    </script>

    <script>
        $(document).ready(function () {
            new SaveTrait({selector: 'form.formAdd'});
        });
    </script>
@endpush