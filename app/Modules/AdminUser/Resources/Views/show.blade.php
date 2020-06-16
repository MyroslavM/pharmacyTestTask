@extends('admin::main')

@section('title', trans("allTranslate.profile"))
@section('breadCrumb', Breadcrumbs::render('adminProfile'))

@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon"><i class="kt-font-brand fa fa-user-lock"></i></span>
                <h3 class="kt-portlet__head-title">
                    @lang('allTranslate.profile')
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
        <div class="kt-form kt-form--label-right">
            <div class="kt-form__body">
                <div class="kt-section__body">
                    <form class="formAdd kt-form">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="row">
                                <div class="col-12 col-sm-8 col-md-3 mx-auto mx-md-0 my-5 my-md-0">
                                    <div class="form-group d-flex justify-content-center align-items-center">
                                        <div class="kt-avatar kt-avatar--outline kt-avatar--circle- w-100" id="kt_user_edit_avatar">
                                            {{--<div class="kt-avatar__holder" style="background-image: url('');"></div>--}}
                                            <img src="{{asset(auth()->user()->avatar??'/assetsnew/img/avatar.jpg')}}" class="img-fluid w-100" alt="">
                                            <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="@lang('allTranslate.change_photo')">
                                                <i class="fa fa-pen" aria-hidden="true" data-toggle="modal" data-target="#changeAvatar"></i>
                                            </label>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-brand btn-elevate btn-icon-sm mx-auto d-flex" data-toggle="modal" data-target="#changePassword"><i class="fa fa-lock"></i> @lang('allTranslate.change_password')</button>

                                </div>
                                <div class="col-12 col-md-9">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label>@lang('allTranslate.last_name') <span class="text-danger">*</span></label>
                                                <input type="text" name="surname" class="form-control" value="{{auth()->user()->surname}}" placeholder=" ">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label>@lang('allTranslate.first_name') <span class="text-danger">*</span></label>
                                                <input type="text" name="name" class="form-control" value="{{auth()->user()->name}}" placeholder=" ">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label>@lang('allTranslate.Surname') <span class="text-danger">*</span></label>
                                                <input type="text" name="patronymic" class="form-control" value="{{auth()->user()->patronymic}}" placeholder=" ">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label>Email <span class="text-danger">*</span></label>
                                                <input type="email" name="email" value="{{auth()->user()->email}}" class="form-control" placeholder=" ">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label>@lang('allTranslate.address')</label>
                                                <input type="text" name="address" value="{{auth()->user()->address}}" class="form-control" placeholder=" ">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label>@lang('allTranslate.telephone_number') </label>
                                                <input type="text" name="phone" class="form-control phone-mask" value="{{auth()->user()->phone}}" placeholder="">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label>@lang('allTranslate.Work_experience')</label>
                                                <input type="text" name="experience" value="{{auth()->user()->experience}}" class="form-control" placeholder="">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label>@lang('allTranslate.Specialization')</label>
                                                <input type="text" name="specialization" value="{{auth()->user()->specialization}}" class="form-control" placeholder="">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label>@lang('allTranslate.Scientific_degree')</label>
                                                <input type="text" name="degree" value="{{auth()->user()->degree}}" class="form-control" placeholder="">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label>@lang('allTranslate.Brief_description')</label>
                                                <input type="text" name="description" value="{{auth()->user()->description}}" class="form-control" placeholder="">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-portlet__head-actions justify-content-end d-flex">
                                <a href="{{ route('adminUser') }}" class="btn btn-secondary btn-elevate btn-icon-sm"><i class="fa fa-window-close"></i> <span class="d-m-n">@lang('allTranslate.cancel_btn')</span></a>
                                &nbsp;
                                <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm"><i class="fa fa-save"></i> <span class="d-m-n">@lang('allTranslate.Save')</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('modals')
    <div class="modal fade" id="changeAvatar" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content change-avatar">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('allTranslate.Save')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>@lang('allTranslate.Select_new_photo')</label>
                        <div class="custom-file">
                            <input name="avatar" type="file" class="custom-file-input changeAvatar avatar-new" id="customFile">
                            <label class="custom-file-label" for="customFile">@lang('allTranslate.Select_new_photo')</label>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm btn-icon-sm" data-dismiss="modal"><i class="fa fa-window-close"></i> @lang('allTranslate.cancel_btn')</button>
                    <button type="submit" class="btn btn-success btn-sm btn-icon-sm change-avatar"><i class="fa fa-save"></i> @lang('allTranslate.Save_changes')</button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content change-password">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('allTranslate.Сhanges_password')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>@lang('allTranslate.Enter_old_password')</label>
                        <input type="password" name="last_password" class="form-control" placeholder="@lang('allTranslate.old_password')">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label>@lang('allTranslate.Enter_new_password')</label>
                        <input type="password" name="password" class="form-control" placeholder="@lang('allTranslate.new_password')">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm btn-icon-sm" data-dismiss="modal"><i class="fa fa-window-close"></i> @lang('allTranslate.cancel_btn')</button>
                    <button type="submit" class="btn btn-success btn-sm btn-icon-sm change-avatar"><i class="fa fa-save"></i> @lang('allTranslate.Save_changes')</button>
                </div>
            </form>
        </div>
    </div>
@endpush

@push('scripts')
    <script>
        $(".phone-mask").inputmask("mask", {
            "mask": "+38 (999) 999-9999"
        });
    </script>
    <script>
        $(document).ready(function () {
            new SaveTrait({selector: 'form.formAdd', enableButtonOnSuccess: true,});

            new SaveTrait({
                selector: 'form.change-avatar',
                showFailToast: true,
                actionUrl: '{{route('adminUserAvatar')}}'
            }).setAdditionalSuccessCallback(function (data) {
                $('.avatar-item').attr('src', '{{asset('')}}' + data.avatar);
                $('#changeAvatar').modal('hide');
                location.reload();
            });

            new SaveTrait({
                selector: 'form.change-password',
                actionUrl: '{{route('adminUserPassword')}}',
                showFailToast: true,
            }).setAdditionalSuccessCallback(function (data) {
                $('#changePassword').modal('hide');
            });
        });
    </script>
@endpush