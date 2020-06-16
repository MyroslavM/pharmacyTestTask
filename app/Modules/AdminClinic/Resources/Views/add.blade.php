@extends('admin::main')

@section('title', trans("allTranslate.add_clinic"))
@section('breadCrumb', Breadcrumbs::render('addClinic'))

@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon"><i class="kt-font-brand fa fa-clinic-medical"></i></span>
                <h3 class="kt-portlet__head-title">
                    @lang('allTranslate.add_clinic')
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        {{--<a href="{{ redirect()->back()->getTargetUrl() }}" class="btn btn-secondary btn-elevate btn-icon-sm">--}}
                        {{--<i class="fa fa-undo"></i>--}}
                        {{--Назад--}}
                        {{--</a>--}}
                        {{--&nbsp;--}}
                        {{--<a href="{{route('addClinic')}}" class="btn btn-brand btn-elevate btn-icon-sm">--}}
                        {{--<i class="la la-plus"></i>--}}
                        {{--Додати клініку--}}
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
                            <label>@lang('allTranslate.name_clinic')<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" placeholder="@lang('allTranslate.name_clinic')">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="form-group">
                            <label>@lang('allTranslate.address_clinic') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="address" placeholder="@lang('allTranslate.address')">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-none">
                        <div class="form-group">
                            <label>@lang('allTranslate.start_day') <span class="text-danger">*</span></label>
                            <input class="form-control kt_timepicker" readonly="" value="12:00" name="start_time" placeholder="@lang('allTranslate.start_day')" type="text">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-none">
                        <div class="form-group">
                            <label>@lang('allTranslate.end_day')<span class="text-danger">*</span></label>
                            <input class="form-control kt_timepicker" readonly="" value="12:00" name="end_time" placeholder="@lang('allTranslate.end_day')" type="text">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="form-group">
                            <label>@lang('allTranslate.color_clinic')<span class="text-danger">*</span></label>
                            <input class="form-control" type="color" name="color" value="#563d7c" id="example-color-input">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__foot">
                <div class="kt-portlet__head-actions justify-content-end d-flex">
                    <a href="{{ route('adminClinics') }}" class="btn btn-secondary btn-elevate btn-icon-sm"><i class="fa fa-window-close"></i> <span class="d-m-n">@lang('allTranslate.cancel_btn')</span></a>
                    &nbsp;
                    <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm"><i class="fa fa-save"></i> <span class="d-m-n">@lang('allTranslate.Save')</span></button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        jQuery(document).ready(function () {
            $(".kt_timepicker").timepicker({
                format: 'DD/MM/YYYY HH:mm',
                minuteStep: 30,
                maxHours: 24,
                pickDate: false,
                showMeridian: false,
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            new SaveTrait({selector: 'form.formAdd', enableButtonOnSuccess: false, clearFormOnSuccess: true});
        });
    </script>
@endpush