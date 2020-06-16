@extends('admin::main')

@section('title', 'Категории')
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
                            Категории
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
                                <a href="#addCategory" data-toggle="modal" class="btn btn-brand btn-elevate btn-icon-sm">
                                    <i class="la la-plus"></i>
                                    <span class="d-m-n">Добавить категорию</span>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table class="table table-striped- table-bordered table-hover table-checkable table-responsive-md">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Название</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>Клиника 1</td>
                            <td class="text-right d-flex align-items-center justify-content-end">
                                <a href="" class="btn btn-sm btn-outline-brand btn-elevate btn-icon d-flex "><i class="la la-edit"></i></a>
                                &nbsp;
                                <a href="" class="btn btn-sm btn-danger btn-icon d-flex  "><i class="la la-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Клиника 1</td>
                            <td class="text-right d-flex align-items-center justify-content-end">
                                <a href="" class="btn btn-sm btn-outline-brand btn-elevate btn-icon d-flex "><i class="la la-edit"></i></a>
                                &nbsp;
                                <a href="" class="btn btn-sm btn-danger btn-icon d-flex  "><i class="la la-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Клиника 1</td>
                            <td class="text-right d-flex align-items-center justify-content-end">
                                <a href="" class="btn btn-sm btn-outline-brand btn-elevate btn-icon d-flex "><i class="la la-edit"></i></a>
                                &nbsp;
                                <a href="" class="btn btn-sm btn-danger btn-icon d-flex  "><i class="la la-trash"></i></a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('modals')
    <div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Добавить категорию</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Название</label>
                        <input type="text" class="form-control" value="" placeholder="Введите название ">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm btn-icon-sm" data-dismiss="modal"><i class="fa fa-window-close"></i> @lang('allTranslate.cancel_btn')</button>
                    <button type="submit" class="btn btn-brand btn-sm btn-icon-sm"><i class="fa fa-save"></i> @lang('allTranslate.Save')</button>
                </div>
            </form>
        </div>
    </div>
@endpush
@push('scripts')

@endpush