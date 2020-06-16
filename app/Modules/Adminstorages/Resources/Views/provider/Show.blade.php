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
                            Поставщики
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
                                <a href="#addProvider" data-toggle="modal" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                    <span class="d-m-n">Добавить поставщика</span>
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
                            <th>Город</th>
                            <th>ФИО</th>
                            <th>Телефон</th>
                            <th>Почта</th>
                            <th>Комментарий</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>Клиника 1</td>
                            <td>Киев</td>
                            <td>Иванов И.И.</td>
                            <td>0508536485</td>
                            <td>mail@gmail.com</td>
                            <td>Можно заказывать с предоплатой</td>
                            <td class="text-right d-flex align-items-center justify-content-end">
                                <a href="" class="btn btn-sm btn-outline-brand btn-elevate btn-icon d-flex "><i class="la la-edit"></i></a>
                                &nbsp;
                                <a href="" class="btn btn-sm btn-danger btn-icon d-flex  "><i class="la la-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Клиника 1</td>
                            <td>Киев</td>
                            <td>Иванов И.И.</td>
                            <td>0508536485</td>
                            <td>mail@gmail.com</td>
                            <td>Можно заказывать с предоплатой</td>
                            <td class="text-right d-flex align-items-center justify-content-end">
                                <a href="" class="btn btn-sm btn-outline-brand btn-elevate btn-icon d-flex "><i class="la la-edit"></i></a>
                                &nbsp;
                                <a href="" class="btn btn-sm btn-danger btn-icon d-flex  "><i class="la la-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Клиника 1</td>
                            <td>Киев</td>
                            <td>Иванов И.И.</td>
                            <td>0508536485</td>
                            <td>mail@gmail.com</td>
                            <td>Можно заказывать с предоплатой</td>
                            <td class="text-right d-flex align-items-center justify-content-end">
                                <a href="" class="btn btn-sm btn-outline-brand btn-elevate btn-icon d-flex "><i class="la la-edit"></i></a>
                                &nbsp;
                                <a href="" class="btn btn-sm btn-danger btn-icon d-flex  "><i class="la la-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Клиника 1</td>
                            <td>Киев</td>
                            <td>Иванов И.И.</td>
                            <td>0508536485</td>
                            <td>mail@gmail.com</td>
                            <td>Можно заказывать с предоплатой</td>
                            <td class="text-right d-flex align-items-center justify-content-end">
                                <a href="" class="btn btn-sm btn-outline-brand btn-elevate btn-icon d-flex "><i class="la la-edit"></i></a>
                                &nbsp;
                                <a href="" class="btn btn-sm btn-danger btn-icon d-flex  "><i class="la la-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Клиника 1</td>
                            <td>Киев</td>
                            <td>Иванов И.И.</td>
                            <td>0508536485</td>
                            <td>mail@gmail.com</td>
                            <td>Можно заказывать с предоплатой</td>
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
    <div class="modal fade" id="addProvider" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Добавить поставщика</h5>
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
                    <div class="form-group">
                        <label>Город</label>
                        <input type="text" class="form-control" value="" placeholder="Введите город ">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label>ФИО</label>
                        <input type="text" class="form-control" value="" placeholder="Введите ФИО ">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label>Телефон</label>
                        <input type="text" class="form-control" value="" placeholder="Введите телефон ">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label>Почта</label>
                        <input type="text" class="form-control" value="" placeholder="Введите почта ">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label>Комментарий</label>
                        <textarea type="text" class="form-control"  placeholder="Введите комментарий "></textarea>
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
    {{--<link rel="stylesheet" type="text/css" href="{{asset('assetsnew/js/datatables.min.css')}}"/>--}}
    {{--<script type="text/javascript" src="{{asset('assetsnew/js/datatables.min.js')}}"></script>--}}

@endpush