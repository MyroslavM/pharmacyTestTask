@extends('admin::main')

@section('title', trans("allTranslate.visit"))
@section('breadCrumb', Breadcrumbs::render('adminVisits'))

@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon"><i class="kt-font-brand fa fa-calendar-check"></i></span>
                <h3 class="kt-portlet__head-title">
                    @lang('allTranslate.visit')
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
                        <a href="{{route('addVisit')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-plus"></i>
                            <span class="d-m-n">@lang('allTranslate.add_visit')</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <table id="visit-table" class="table table-striped- table-bordered table-hover table-checkable table-responsive-md"></table>
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

            $('#visit-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('adminVisitTable')}}',
                columns: [
                    {data: 'id', 'title': '#'},
                    {data: 'patient', 'title': 'Пацієнт'},
                    {data: 'doctor', 'title': 'Доктор'},
                    {data: 'status', 'title': 'Статус'},
                    {data: 'date', 'title': 'Дата запису'},
                    {data: 'cost', 'title': 'Вартість'},
                    {data: 'edit', 'title': ''},
                ],
                language: lang,
                "order": [[0, "desc"]],
            });
        });
    </script>
@endpush