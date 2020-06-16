@extends('admin::main')

@section('title', trans("allTranslate.Edit_service"))
@section('breadCrumb', Breadcrumbs::render('editService',$service))

@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon"><i class="kt-font-brand fa fa-clinic-medical"></i></span>
                <h3 class="kt-portlet__head-title">
                    @lang('allTranslate.Edit_service')
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
                            <label>@lang('allTranslate.name_service') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{$service->name}}" name="name" placeholder="@lang('allTranslate.name_service')">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__foot">
                <div class="kt-portlet__head-actions justify-content-end d-flex">
                    <a href="{{ route('adminServices') }}" class="btn btn-secondary btn-elevate btn-icon-sm"><i class="fa fa-window-close"></i> <span class="d-m-n">@lang('allTranslate.cancel_btn')</span></a>
                    &nbsp;
                    <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm"><i class="fa fa-save"></i>
                        <span class="d-m-n">@lang('allTranslate.Save')</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            new SaveTrait({selector: 'form.formAdd', enableButtonOnSuccess: true});
        });
    </script>
@endpush