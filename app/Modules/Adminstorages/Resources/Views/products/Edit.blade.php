@extends('admin::main')

@section('title', trans("allTranslate.Product"))
@section('breadCrumb', Breadcrumbs::render('adminProducts'))

@section('delete',route('deleteProduct'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon"><i class="kt-font-brand fa fa-clinic-medical"></i></span>
                        <h3 class="kt-portlet__head-title">
                            Редактировать товар
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="kt-portlet__head-actions">
                                <a href="{{ redirect()->back()->getTargetUrl() }}" class="btn btn-secondary btn-elevate btn-icon-sm">
                                    <i class="fa fa-undo"></i>
                                    <span class="d-m-n">@lang('allTranslate.back')</span>
                                </a>
                                &nbsp;
                                {{--<a href="#addProduct" data-toggle="modal" class="btn btn-brand btn-elevate btn-icon-sm">--}}
                                {{--<i class="la la-plus"></i>--}}
                                    {{--<span class="d-m-n">Добавить товар</span>--}}
                                {{--</a>--}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">

                </div>
            </div>
        </div>

    </div>
@endsection

@push('modals')

@endpush

@push('scripts')
    {{--<link rel="stylesheet" type="text/css" href="{{asset('assetsnew/js/datatables.min.css')}}"/>--}}
    {{--<script type="text/javascript" src="{{asset('assetsnew/js/datatables.min.js')}}"></script>--}}

@endpush