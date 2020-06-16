@extends('admin::main')
@section('breadCrumb', Breadcrumbs::render('addUsers'))

@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon"><i class="fa fa-calendar-check"></i></span>
                <h3 class="kt-portlet__head-title">
                    @lang('allTranslate.add_employee')
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
                        {{--&nbsp;--}}
                        {{--<a href="{{route('addUsers')}}" class="btn btn-brand btn-elevate btn-icon-sm">--}}
                        {{--<i class="la la-plus"></i>--}}
                        {{--<span class="d-m-n">Додати працівника</span>--}}
                        {{--</a>--}}
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-form kt-form--label-right">
            <div class="kt-form__body">
                <div class="kt-section__body">
                    <form class="formAdd kt-form">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="row">
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label>@lang('allTranslate.last_name') <span class="text-danger">*</span></label>
                                        <input type="text" name="surname" class="form-control" value="" placeholder=" ">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label>@lang('allTranslate.first_name') <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" value="" placeholder=" ">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label>@lang('allTranslate.Surname') <span class="text-danger">*</span></label>
                                        <input type="text" name="patronymic" class="form-control" value="" placeholder=" ">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" value="" class="form-control" placeholder=" ">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label>@lang('allTranslate.address') </label>
                                        <input type="text" name="address" value="" class="form-control" placeholder=" ">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label>@lang('allTranslate.telephone_number') </label>
                                        <input type="text" name="phone" class="form-control phone-mask" value="" placeholder="">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label>@lang('allTranslate.Work_experience')</label>
                                        <input type="text" name="experience" value="" class="form-control" placeholder="">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label>@lang('allTranslate.Specialization') </label>
                                        <input type="text" name="specialization" value="" class="form-control" placeholder="">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label>@lang('allTranslate.Scientific_degree') </label>
                                        <input type="text" name="degree" value="" class="form-control" placeholder="">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label>@lang('allTranslate.Brief_description') </label>
                                        <input type="text" name="description" value="" class="form-control" placeholder="">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label>@lang('allTranslate.photo')</label>
                                        <div class="custom-file">
                                            <input name="avatar" type="file" class="custom-file-input changeAvatar avatar-new" id="customFile">
                                            <label class="custom-file-label text-left" for="customFile">@lang('allTranslate.Select_new_photo')</label>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label>@lang('allTranslate.select_role') <span class="text-danger">*</span></label>
                                        <select class="form-control" name="role">
                                            @foreach($roles as $role)
                                                <option>{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label>@lang('allTranslate.Enter_password') <span class="text-danger">*</span></label>
                                        <input type="password" name="password" value="" class="form-control" placeholder="">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-portlet__head-actions justify-content-end d-flex">
                                <a href="{{ route('adminUsers') }}" class="btn btn-secondary btn-elevate btn-icon-sm"><i class="fa fa-window-close"></i> <span class="d-m-n">@lang('allTranslate.cancel_btn')</span></a>
                                &nbsp;
                                <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm"><i class="fa fa-save"></i><span class="d-m-n"> @lang('allTranslate.Save')</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(".phone-mask").inputmask("mask", {
            "mask": "+38 (999) 999-9999"
        });
    </script>
    <script>
        $(document).ready(function () {
            new SaveTrait({selector: 'form.formAdd'});
        });
    </script>
@endpush