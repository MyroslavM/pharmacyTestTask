@extends('admin::main')

@section('title', trans("allTranslate.clinics"))

@section('breadCrumb', Breadcrumbs::render('adminClinics'))

@section('delete',route('deleteClinic'))

@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon"><i class="kt-font-brand fa fa-clinic-medical"></i></span>
                <h3 class="kt-portlet__head-title">
                    @lang('allTranslate.clinics')
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
                        <a href="{{route('addClinic')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-plus"></i>
                            <span class="d-m-n">@lang('allTranslate.add_clinics')</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">

            <table class="table table-striped- table-bordered table-hover table-checkable table-responsive-md">
                <thead>
                <tr>
                    <th>@lang('allTranslate.name_clinic')</th>
                    <th>@lang('allTranslate.address')</th>
                    <th>
                        {{--                                    <a href="{{route('addUsers')}}" class="btn btn-success btn-sm ml-auto float-right">Додати</a>--}}
                    </th>
                </tr>
                </thead>
                <tbody>
                @forelse($clinics as $clinic)
                    <tr>
                        <td>{{$clinic->name}}</td>
                        <td>{{$clinic->address}}</td>
                        {{--                                        @if($clinic->status)--}}
                        {{--                                            <td><span class="status-icon bg-success"></span> Відображається</td>--}}
                        {{--                                        @else--}}
                        {{--                                            <td><span class="status-icon bg-danger"></span> Не відображається</td>--}}
                        {{--                                        @endif--}}
                        {{--<td class="text-right">--}}
                        {{--<a class="icon" href="{{route('editClinic',$clinic->id)}}"></a>--}}
                        {{--<a href="{{route('editClinic',$clinic->id)}}" class="btn btn-primary btn-sm" data-toggle="deleteModal"><i class="fa fa-pencil"></i> Редагувати</a>--}}
                        {{--<a class="icon" href="javascript:void(0)"></a>--}}
                        {{--<a href="javascript:void(0)" class="btn btn-danger btn-sm delete-item" data-id="{{$clinic->id}}"><i class="fa fa-trash"></i> Видалити</a>--}}
                        {{--</td>--}}
                        <td class="text-right d-flex align-items-center justify-content-center">
                            {{--                                    <a class="icon" href="{{route('editClinic',$clinic->id)}}"></a>--}}

                            <a href="{{route('editClinic',$clinic->id)}}" title="@lang('allTranslate.editing_clinic')" class="btn btn-sm btn-outline-brand btn-elevate btn-icon d-flex "><i class="la la-edit"></i></a>
                            &nbsp;
                            {{--<a class="icon" href="javascript:void(0)"></a>--}}
                            {{--<a href="javascript:void(0)" data-id="{{$clinic->id}}" title="Видалити клініку" class="btn btn-sm btn-danger btn-icon d-flex  delete-item"><i class="la la-trash"></i></a>--}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="mx-auto" colspan="3">@lang('allTranslate.list_empty')</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            {{--<table id="patient-table" class="table table-striped- table-bordered table-hover table-checkable"></table>--}}
        </div>
    </div>
@endsection