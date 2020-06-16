@extends('admin::main')

@section('title', trans("allTranslate.editing_patient"))
@section('breadCrumb', Breadcrumbs::render('visitPatient',$item))

@section('content')

    <div class="kt-portlet kt-portlet--tabs">

        @include('adminPatient::include/nav-menu')

        <div class="tab-content">
            <div class="">
                <div class="kt-portlet__body">
                    <table id="visit-table" class="table table-striped- table-bordered table-hover table-checkable table-responsive-md"></table>
                </div>
            </div>
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
                ajax: '{{route('adminPatientVisitsTable', ['id' => $item->id])}}',
                columns: [
                    {data: 'id', 'title': '#'},
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