@extends('admin::main')

@section('title', trans("allTranslate.Pacients"))
@section('breadCrumb', Breadcrumbs::render('adminPatients'))

{{--@section('delete',route('deletePatient'))--}}

@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon"><i class="kt-font-brand fa fa-users"></i></span>
                <h3 class="kt-portlet__head-title">
                    @lang('allTranslate.Pacients')
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
                        <a href="{{route('addPatient')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-plus"></i>
                            <span class="d-m-n">@lang('allTranslate.add_pacients')</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <table id="patient-table" class="table table-striped- table-bordered table-hover table-checkable table table-responsive-md"></table>
        </div>
    </div>

@endsection

@push('scripts')
    <link rel="stylesheet" type="text/css" href="{{asset('assetsnew/js/datatables.min.css')}}"/>
    <script type="text/javascript" src="{{asset('assetsnew/js/datatables.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#patient-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('adminPatientTable')}}',
                columns: [
                    {data: 'id', 'title': '#'},
                    {data: 'name', 'title': 'ПІБ'},
                    {data: 'phone', 'title': 'Телефон'},
                    {data: 'birthday', 'title': 'День народження'},
                    {data: 'is_children', 'title': ''},
                ],
                language: lang,
                "order": [[0, "desc"]],
            });
        });
    </script>
@endpush