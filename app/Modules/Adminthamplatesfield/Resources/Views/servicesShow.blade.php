@extends('admin::main')

@section('title', trans("allTranslate.Services"))
@section('breadCrumb', Breadcrumbs::render('adminServices'))

@section('delete',route('deleteService'))

@section('content')
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon"><i class="kt-font-brand fa fa-clinic-medical"></i></span>
                        <h3 class="kt-portlet__head-title">
                            @lang('allTranslate.Services')
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
                                {{--<a href="{{route('addClinic')}}" class="btn btn-brand btn-elevate btn-icon-sm">--}}
                                {{--<i class="la la-plus"></i>--}}
                                {{--<span class="d-m-n">Додати продукт</span>--}}
                                {{--</a>--}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table class="table table-striped- table-bordered table-hover table-checkable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('allTranslate.name_service')</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($services as $service)
                            <tr>
                                <td>{{$service->id}}</td>
                                <td>{{$service->name}}</td>
                                <td class="text-right d-flex align-items-center justify-content-center">
                                    <a href="{{route('editService',$service->id)}}" title="@lang('allTranslate.edit_service')" class="btn btn-sm btn-outline-brand btn-elevate btn-icon d-flex "><i class="la la-edit"></i></a>
                                    &nbsp;
                                    <a href="javascript:void(0)" data-id="{{$service->id}}" title="Видалити послугу" class="btn btn-sm btn-danger btn-icon d-flex  delete-item"><i class="la la-trash"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="mx-auto">@lang('allTranslate.the_list_empty')</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="kt-pagination  kt-pagination--brand d-flex align-items-center justify-content-center">
                        {{ $services->links() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon"><i class="kt-font-brand fa fa-clinic-medical"></i></span>
                        <h3 class="kt-portlet__head-title">
                            @lang('allTranslate.Add_service')
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
                                {{--<a href="{{route('addClinic')}}" class="btn btn-brand btn-elevate btn-icon-sm">--}}
                                {{--<i class="la la-plus"></i>--}}
                                {{--<span class="d-m-n">Додати продукт</span>--}}
                                {{--</a>--}}
                            </div>
                        </div>
                    </div>
                </div>
                <form class="formAdd kt-form" action="{{ route('addService') }}" method="POST">
                    @csrf
                    <div class="kt-portlet__body">
                        <div class="row">
                            <div class="col-12 col-md-6 ">
                                <div class="form-group">
                                    <label>@lang('allTranslate.name_service') <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" placeholder="@lang('allTranslate.Enter_name_service')">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-portlet__head-actions justify-content-end d-flex">
                            <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm"><i class="fa fa-save"></i> <span class="d-m-n">@lang('allTranslate.Save')</span></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            new SaveTrait({selector: 'form.formAdd', enableButtonOnSuccess: false, clearFormOnSuccess: true});
        });
    </script>
@endpush