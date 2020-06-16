@extends('admin::main')

@section('title', trans("allTranslate.editing_patient"))
@section('breadCrumb', Breadcrumbs::render('editPatient',$item))

@section('content')

    <div class="kt-portlet kt-portlet--tabs">

        @include('adminPatient::include/nav-menu')

        <div class="tab-content">
            <div class="tab-pane active" id="kt_user_edit_tab_1" role="tabpanel">
                <form class="formAdd kt-form">
                    @csrf
                    <div class="kt-portlet__body">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>@lang('allTranslate.last_name')<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="first_name" value="{{$item->first_name}}" placeholder="@lang('allTranslate.last_name')">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>@lang('allTranslate.first_name')<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" value="{{$item->name}}" placeholder="@lang('allTranslate.first_name')">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>@lang('allTranslate.Surname')</label>
                                    <input type="text" class="form-control" name="last_name" value="{{$item->last_name}}" placeholder="@lang('allTranslate.Surname') ">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group ">
                                    <label>@lang('allTranslate.date_birth')<span class="text-danger">*</span></label>
                                    <input name="birthday" autocomplete="off" type="text" class="form-control" id="kt_datepicker_1" value="{{\Carbon\Carbon::parse($item->birthday)->format('d.m.Y')}}" placeholder="@lang('allTranslate.select_date')"/>
                                    <div class="invalid-feedback"></div>
                                    <span class="form-text text-muted">@lang('allTranslate.Date_format'): <code>05.02.2020</code></span>
                                </div>
                            </div>


                            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label>@lang('allTranslate.address') </label>
                                    <input type="text" class="form-control" name="address" value="{{$item->address}}" placeholder="@lang('allTranslate.address')">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label>@lang('allTranslate.telephone_number') <span class="text-danger">*</span></label>
                                    <input class="form-control phone-mask" name="phone" value="{{$item->phone}}" type="text">
                                    <div class="invalid-feedback"></div>
                                    <span class="form-text text-muted">@lang('allTranslate.telephone_format') : <code>+38(050)846-56-92</code></span>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label>Почта </label>
                                    <input class="form-control" name="email" value="{{$item->email}}" type="email" placeholder="Почта">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label for="name">Врач</label>
                                    <select class="form-control select_2" name="doctor_id" data-placeholder="Выберите врача">
                                        @foreach($doctors as $doctor)
                                            <option value="{{ $doctor->id  }}" @if($doctor->id == $item->doctor_id) selected @endif>{{ $doctor->fullName() }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label>Пол</label>
                                    <div class="kt-radio-inline">
                                        <label class="kt-radio kt-radio--brand">
                                            <input type="radio" name="gender" value="0" @if( $item->gender == 0) checked @endif> Мужчина
                                            <span></span>
                                        </label>
                                        <label class="kt-radio kt-radio--brand">
                                            <input type="radio" name="gender" value="1" @if( $item->gender == 1) checked @endif> Женщина
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label>Номер карты пациента</label>
                                    <input class="form-control" name="card_name" value="{{$item->card_name}}" type="text" placeholder="Номер карты пациента">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group d-flex flex-column">
                                    <label>Коментарий</label>
                                    <textarea name="comment" id="" cols="3" rows="3">{{$item->comment}}</textarea>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            {{--<div class="col-12 col-sm-6 col-md-4 col-lg-3">--}}
                            {{--<div class="form-group">--}}
                            {{--<label>@lang('allTranslate.anamnez')</label>--}}
                            {{--<input type="text" class="form-control" name="anamnez" value="{{$item->anamnez}}" placeholder="">--}}
                            {{--<div class="invalid-feedback"></div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-portlet__head-actions justify-content-end d-flex">
                            {{--<a href="{{ route('adminPatients') }}" class="btn btn-secondary btn-elevate btn-icon-sm"><i class="fa fa-window-close"></i> <span class="d-m-n">@lang('allTranslate.cancel_btn')</span></a>--}}
                            {{--&nbsp;--}}
                            <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm"><i class="fa fa-save"></i> <span class="d-m-n">@lang('allTranslate.Save')</span></button>
                        </div>
                    </div>
                </form>
            </div>
            {{--<div class="tab-pane " id="kt_user_edit_tab_2" role="tabpanel">--}}
                {{--<form class=" kt-form">--}}
                    {{--@csrf--}}
                    {{--<div class="kt-portlet__body">--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-12">--}}
                                {{--<div class="form-group d-flex flex-column">--}}
                                    {{--<label>Анамнез (-)</label>--}}
                                    {{--<textarea name="" id="" cols="3" rows="3"></textarea>--}}
                                    {{--<div class="invalid-feedback"></div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-12">--}}
                                {{--<div class="form-group d-flex flex-column">--}}
                                    {{--<label>Имунологические сведения (-)</label>--}}
                                    {{--<textarea name="" id="" cols="3" rows="3"></textarea>--}}
                                    {{--<div class="invalid-feedback"></div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-12">--}}
                                {{--<div class="form-group d-flex flex-column">--}}
                                    {{--<label>Алергический статус (-)</label>--}}
                                    {{--<textarea name="" id="" cols="3" rows="3"></textarea>--}}
                                    {{--<div class="invalid-feedback"></div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="kt-portlet__foot">--}}
                        {{--<div class="kt-portlet__head-actions justify-content-end d-flex">--}}
                            {{--<a href="{{ route('adminPatients') }}" class="btn btn-secondary btn-elevate btn-icon-sm"><i class="fa fa-window-close"></i> <span class="d-m-n">@lang('allTranslate.cancel_btn')</span></a>--}}
                            {{--&nbsp;--}}
                            {{--<button type="submit" class="btn btn-brand btn-elevate btn-icon-sm"><i class="fa fa-save"></i> <span class="d-m-n">@lang('allTranslate.Save')</span></button>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</form>--}}
            {{--</div>--}}

        </div>
    </div>



@endsection


@push('scripts')
    {{--form 043 style--}}
    <style>


        .table-form043 {
            border: 1px solid #000;
            width: 100%;
            max-width: 100%;
            text-align: center;
        }

        .table-form043 input {
            max-width: 40px;
        }

        .table-form043 tr {
            width: 100%;
        }

        .table-form043 tr:nth-child(2n) {
            background: #e2e1e1;
        }

        .table-form043 tr:first-child th {
            border-top: 1px solid #000;

        }

        .table-form043 th {
            border-right: 1px solid #000;
            border-bottom: 1px solid #000;
            width: inherit;
        }

        .table-form043 th:last-child {
            border-right: 0px;
            width: inherit;
        }

        .table-form043 tr:last-child th {
            border-bottom: 0px;
            width: inherit;
        }

        .table-form043-diary {
            border: 1px solid #000;
            width: 100%;
            max-width: 100%;
            text-align: center;
        }

        .table-form043-diary tr:first-child th {
            border-top: 1px solid #000;

        }

        .table-form043-diary th {
            border-right: 1px solid #000;
            border-bottom: 1px solid #000;
            width: inherit;
        }

        .table-form043-diary tr {
            width: 100%;
        }

        .table-form043-diary th:last-child {
            border-right: 0px;
            width: inherit;
        }

        .table-form043-diary tr:last-child th {
            border-bottom: 0px;
            width: inherit;
        }

        .table-form043-diary tr th:first-child {
            width: 20% !important;
        }

        .table-form043-diary th input {
            width: 100%;
        }


        .table-form043-plan tbody {
            width: 100% !important;

        }

        .table-form043-plan tr:first-child th {
            border-top: 1px solid #000;

        }

        .table-form043-plan {
            border: 1px solid #000;
            width: 100%;
            max-width: 100%;
            text-align: center;
        }

        .table-form043-plan tr th {
            border-right: 1px solid #000;
            border-bottom: 1px solid #000;
            width: 50% !important;

        }

        .table-form043-plan tr {
            width: 100% !important;
        }

        .table-form043-plan tr th input {
            width: 100%;
        }

        .table-form043-plan th:last-child {
            border-right: 0px;
            width: inherit;
        }

        .table-form043-plan tr:last-child th {
            border-bottom: 0px;
            width: inherit;
        }
    </style>
    {{-- endform 043 style--}}

    <script>
        $('.select_2').select2();
    </script>

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

        $('.kt_datepicker_1').datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            language: "{{app()->getLocale()}}",
            isRTL: false,
            autoclose: true,
            format: "dd.mm.yyyy",
        });
    </script>

    <script>
        $(document).ready(function () {
            new SaveTrait({selector: 'form.formAdd', enableButtonOnSuccess: false});
        });
    </script>
    <script>
        $(document).ready(function () {
            new SaveTrait({selector: 'form.card', enableButtonOnSuccess: true})
                .setAdditionalData(function (data) {
                    data.append('comment', $('#hello').val());
                    return data;
                });
        });
    </script>
@endpush