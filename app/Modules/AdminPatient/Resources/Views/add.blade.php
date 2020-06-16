@extends('admin::main')

@section('title', trans("allTranslate.add_pacient"))
@section('breadCrumb', Breadcrumbs::render('addPatient'))

@section('content')
        <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon"><i class="kt-font-brand fa fa-users"></i></span>
                        <h3 class="kt-portlet__head-title">
                            @lang('allTranslate.add_pacient')
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="kt-portlet__head-actions">
                                <a href="{{ redirect()->back()->getTargetUrl() }}" class="btn btn-secondary btn-elevate btn-icon-sm">
                                    <i class="fa fa-undo"></i>
                                    <span class="d-m-n">@lang('allTranslate.back')</span>
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
                <form class="formAdd kt-form">
                    @csrf
                    <div class="kt-portlet__body">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>@lang('allTranslate.last_name')<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="first_name" value="" placeholder="@lang('allTranslate.last_name')">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>@lang('allTranslate.first_name')<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" value="" placeholder="@lang('allTranslate.first_name')">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>@lang('allTranslate.Surname') </label>
                                    <input type="text" class="form-control" name="last_name" value="" placeholder="@lang('allTranslate.Surname') ">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group ">
                                    <label>@lang('allTranslate.date_birth')</label>
                                    <input name="birthday" autocomplete="off" type="text" class="form-control" id="kt_datepicker_1" value="" placeholder="@lang('allTranslate.select_date')"/>
                                    <div class="invalid-feedback"></div>
                                    <span class="form-text text-muted">@lang('allTranslate.Date_format'): <code>05.02.2020</code></span>
                                </div>
                            </div>


                            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label>@lang('allTranslate.address') </label>
                                    <input type="text" class="form-control" name="address" value="" placeholder="@lang('allTranslate.address')">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label>@lang('allTranslate.telephone_number') <span class="text-danger">*</span></label>
                                    <input class="form-control phone-mask" name="phone" value="" type="text">
                                    <div class="invalid-feedback"></div>
                                    <span class="form-text text-muted">@lang('allTranslate.telephone_format') : <code>+38(050)846-56-92</code></span>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label>Почта </label>
                                    <input class="form-control" name="email" value="" type="email" placeholder="Почта">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label for="name">Врач</label>
                                    <select name="doctor_id" id="doctor" class="form-control doctor select-2-doctors">
                                        @foreach($doctors as $doctor)
                                            <option value="{{$doctor->id}}" data-description="{{$doctor->description}}" data-image="{{asset($doctor->avatar?? 'assetsnew/img/avatar.jpg')}}">{{ $doctor->fullName() }}</option>
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

                                            <input type="radio" name="gender" value="0"> Мужчина
                                            <span></span>
                                        </label>
                                        <label class="kt-radio kt-radio--brand">
                                            <input type="radio" name="gender" value="1"> Женщина
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label>Номер карты пациента</label>
                                    <input class="form-control" name="card_name" value="" type="text" placeholder="Номер карты пациента">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group d-flex flex-column">
                                    <label>Коментарий</label>
                                    <textarea name="comment" id="" cols="3" rows="3"></textarea>
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

                    <div class="kt-portlet__body">

                        {{--<div class="row">--}}
                            {{----}}
                            {{--<div class="col-12 col-sm-6 col-md-4 col-lg-3">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label>@lang('allTranslate.last_name')<span class="text-danger">*</span></label>--}}
                                    {{--<input type="text" class="form-control" name="first_name" placeholder="@lang('allTranslate.last_name')">--}}
                                    {{--<div class="invalid-feedback"></div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-12 col-sm-6 col-md-4 col-lg-3">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label>@lang('allTranslate.first_name')<span class="text-danger">*</span></label>--}}
                                    {{--<input type="text" class="form-control" name="name" placeholder="@lang('allTranslate.first_name')">--}}
                                    {{--<div class="invalid-feedback"></div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-12 col-sm-6 col-md-4 col-lg-3">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label>@lang('allTranslate.Surname') <span class="text-danger">*</span></label>--}}
                                    {{--<input type="text" class="form-control" name="last_name" placeholder="@lang('allTranslate.Surname')">--}}
                                    {{--<div class="invalid-feedback"></div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-12 col-sm-6 col-md-4 col-lg-3">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label>@lang('allTranslate.address')</label>--}}
                                    {{--<input type="text" class="form-control" name="address" placeholder="@lang('allTranslate.address')">--}}
                                    {{--<div class="invalid-feedback"></div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-12 col-sm-6 col-md-4 col-lg-3">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label>@lang('allTranslate.telephone_number')<span class="text-danger">*</span></label>--}}
                                    {{--<input class="form-control phone-mask" name="phone" value="" type="text">--}}
                                    {{--<div class="invalid-feedback"></div>--}}
                                    {{--<span class="form-text text-muted">@lang('allTranslate.telephone_format'): <code>+38(050)846-56-92</code></span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-12 col-sm-6 col-md-4 col-lg-3">--}}
                                {{--<div class="form-group ">--}}
                                    {{--<label>@lang('allTranslate.date_birth')<span class="text-danger">*</span></label>--}}
                                    {{--<input name="birthday" autocomplete="off" type="text" class="form-control" id="kt_datepicker_1" placeholder="@lang('allTranslate.date_birth')"/>--}}
                                    {{--<div class="invalid-feedback"></div>--}}
                                    {{--<span class="form-text text-muted">@lang('allTranslate.Date_format'): <code>05.02.2020</code></span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-12 col-sm-6 col-md-4 col-lg-3">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label>@lang('allTranslate.anamnez')</label>--}}
                                    {{--<input type="text" class="form-control" name="anamnez" placeholder="">--}}
                                    {{--<div class="invalid-feedback"></div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-portlet__head-actions justify-content-end d-flex">
                            <a href="{{ route('adminPatients') }}" class="btn btn-secondary btn-elevate btn-icon-sm"><i class="fa fa-window-close"></i> <span class="d-m-n">@lang('allTranslate.cancel_btn')</span></a>
                            &nbsp;
                            <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm"><i class="fa fa-save"></i> <span class="d-m-n">@lang('allTranslate.Save')</span></button>
                        </div>
                    </div>
                </form>
            </div>
@endsection


@push('scripts')
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
    </script>

    <script>
        $(document).ready(function () {
            new SaveTrait({selector: 'form.formAdd', enableButtonOnSuccess: false});
        });

        $('.select-2-doctors').select2({
            placeholder: "Виберіть лікаря",
            multiple: false,
        }).trigger('change');
    </script>

@endpush