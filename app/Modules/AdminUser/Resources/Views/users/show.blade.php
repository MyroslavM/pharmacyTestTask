@extends('admin::main')

@section('title', trans("allTranslate.Workers"))
@section('breadCrumb', Breadcrumbs::render('adminUsers'))

@section('delete',route('deleteUser'))

@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon"><i class="kt-font-brand fa fa-user-edit"></i></span>
                <h3 class="kt-portlet__head-title">
                    @lang('allTranslate.Workers')
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <a href="{{ redirect()->back()->getTargetUrl() }}" class="btn btn-secondary btn-elevate btn-icon-sm">
                            <i class="fa fa-undo"></i>
                            <span class="d-m-n">@lang('allTranslate.back')</span>
                        </a>
                        @hasrole('SuperAdmin|Admin')
                        &nbsp;
                        <a href="{{route('addUsers')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-plus"></i>
                            <span class="d-m-n">@lang('allTranslate.add_employee')</span>
                        </a>
                        @endhasrole

                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">

            <table class="table table-striped- table-bordered table-hover table-checkable table-responsive-md">
                <thead>
                <tr>
                    <th>@lang('allTranslate.PIB')</th>
                    <th>Email</th>
                    <th>@lang('allTranslate.telephone_number')</th>
                    <th>@lang('allTranslate.role')</th>
                    <th>
                        {{--                                    <a href="{{route('addUsers')}}" class="btn btn-success btn-sm ml-auto float-right">Додати</a>--}}
                    </th>
                </tr>
                </thead>
                <tbody>
                @hasrole('SuperAdmin|Admin')

                @foreach($users as $user)
                    <tr>
                        <td><img src="{{asset($user->avatar?? '/assetsnew/img/avatar.jpg')}}" style="max-height: 30px; margin-right: 10px" alt="">{{$user->surname.' '.$user->name.' '.$user->patronymic}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone}}</td>
                        <td>{{$user->getRoleNames()[0]}}</td>
                        <td class="text-right d-flex align-items-center justify-content-center">
                            <a class="icon" href="javascript:void(0)"></a>
                            <a href="{{route('editUsers',$user->id)}}" title="@lang('allTranslate.change_worker')" class="btn btn-sm btn-outline-brand btn-elevate btn-icon d-flex "><i class="la la-edit"></i></a>
                            {{--&nbsp;--}}
                            {{--<a class="icon" href="javascript:void(0)"></a>--}}
                            {{--<a href="javascript:void(0)" data-id="{{$user->id}}"  title="Видалити працівника" class="btn btn-sm btn-danger btn-icon d-flex  delete-item"><i class="la la-trash"></i></a>--}}
                        </td>
                    </tr>
                @endforeach
                @endhasrole

                @hasrole('Doctor|Manager')

                @foreach($users as $user)
                    @if (($user->getRoleNames()[0] == 'Manager' )|| ($user->getRoleNames()[0] == 'Doctor' ) )
                        <tr>
                            <td><img src="{{asset($user->avatar?? '/assetsnew/img/avatar.jpg')}}" style="max-height: 30px; margin-right: 10px" alt="">{{$user->surname.' '.$user->name.' '.$user->patronymic}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{$user->getRoleNames()[0]}}</td>
                            <td class="text-right d-flex align-items-center justify-content-center">
                                <a class="icon" href="javascript:void(0)"></a>
                                <a href="{{route('editUsers',$user->id)}}" title="@lang('allTranslate.change_worker')" class="btn btn-sm btn-outline-brand btn-elevate btn-icon d-flex "><i class="la la-edit"></i></a>
                                {{--&nbsp;--}}
                                {{--<a class="icon" href="javascript:void(0)"></a>--}}
                                {{--<a href="javascript:void(0)" data-id="{{$user->id}}"  title="Видалити працівника" class="btn btn-sm btn-danger btn-icon d-flex  delete-item"><i class="la la-trash"></i></a>--}}
                            </td>
                        </tr>
                    @endif
                @endforeach
                @endhasrole
                </tbody>
            </table>

            {{--<table id="patient-table" class="table table-striped- table-bordered table-hover table-checkable"></table>--}}
        </div>
    </div>
@endsection