@extends('admin::main')

@section('title', trans("allTranslate.edit_workers"))
@section('breadCrumb', Breadcrumbs::render('adminUser'))

@section('content')

    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon"><i class="kt-font-brand fa fa-user-edit"></i></span>
                <h3 class="kt-portlet__head-title">
                    {{--                            @if(!$user->hasRole('Doctor'))--}}
                    @lang('allTranslate.Worker') - <b>{{$user->surname}} {{$user->name}} {{$user->patronymic}}</b>
                    {{--@endif--}}
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <a href="{{ redirect()->back()->getTargetUrl() }}" class="btn btn-secondary btn-elevate btn-icon-sm">
                            <i class="fa fa-undo"></i>
                            <span class="d-m-n"> @lang('allTranslate.back')</span>
                        </a>
                        &nbsp;
                        <a href="{{route('addUsers')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-plus"></i>
                            <span class="d-m-n">@lang('allTranslate.add_employee')</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-form kt-form--label-right">
            <div class="kt-form__body">
                <div class="kt-section__body">
                    @if($user->hasRole('Doctor'))
                        <div class="kt-portlet__body kt-portlet__head">
                            <div class="schedule mb-3">
                                <div class="card p-3 mb-0">
                                    <div class="mb-3 "> @lang('allTranslate.Schedule_for'): <b>{{parseMonthTrue(date('n'))}}</b></div>
                                    <div class="table-responsive ">
                                        <table class="table" border="1">
                                            <tr>
                                                <th rowspan="2">
                                                    @lang('allTranslate.Doctor')
                                                </th>
                                                @for($day = 1; $day <= date('t');$day++)
                                                    @if($day == date('j'))
                                                        <th class="today {{(date('N',strtotime(''. $day - date('d').' days')) == 6)?'day-off':''}} {{date('N',strtotime(''. $day - date('d').' days')) == 7?'day-off':''}}">{{parseMonth(date('N',strtotime(''. $day - date('d').' days')))}}</th>
                                                    @else
                                                        <th class="{{date('N',strtotime(''. $day - date('d').' days')) == 6?'day-off':''}} {{date('N',strtotime(''. $day - date('d').' days')) == 7?'day-off':''}}">{{parseMonth(date('N',strtotime(''.$day - date('d').' days')))}}</th>
                                                    @endif
                                                @endfor
                                            </tr>
                                            <tr>
                                                @for($day = 1; $day <= date('t');$day++)
                                                    @if($day == date('j'))
                                                        <th class="today">{{$day}}</th>
                                                    @else
                                                        <th>{{$day}}</th>
                                                    @endif
                                                @endfor
                                            </tr>
                                            <tr>
                                                <td>
                                                    @lang('allTranslate.Doctor')
                                                </td>
                                                @for($day = 1; $day <= date('t');$day++)
                                                    @if($day < date('j'))
                                                        <td class="{{in_array(date('Y-m-d',strtotime(''. $day - date('d').' days')),$holidays->toArray())?'day-off empty':''}} {{in_array(date('Y-m-d',strtotime(''. $day - date('d').' days')),$days->toArray())?'all-day empty':''}}"></td>
                                                    @else
                                                        <td data-date="{{date('Y-m-d',strtotime(''. $day - date('d').' days'))}}" class="next-days {{in_array(date('Y-m-d',strtotime(''. $day - date('d').' days')),$holidays->toArray())?'day-off':''}}

                                                        @if(in_array(date('Y-m-d',strtotime(''. $day - date('d').' days')),$two_clinics))
                                                                two-clinic
@else
                                                        {{in_array(date('Y-m-d',strtotime(''. $day - date('d').' days')),$days->toArray())?'all-day':''}}
                                                        @endif
                                                        {{$day == date('j')?'today today-number':''}}"></td>
                                                    @endif
                                                @endfor
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col col-4">
                                            <div class="schedule-cell-col">
                                                <span class="schedule-cell example-cell day-off"></span>
                                                <span> @lang('allTranslate.Day_off')</span>
                                            </div>
                                        </div>
                                        <div class="col col-4">
                                            <div class="schedule-cell-col">
                                                <span class="schedule-cell example-cell all-day"></span>
                                                <span>@lang('allTranslate.Workday')</span>
                                            </div>
                                        </div>
                                        <div class="col col-4">
                                            <div class="schedule-cell-col">
                                                <span class="schedule-cell example-cell two-clinic"></span>
                                                <span>@lang('allTranslate.works_two_clinics')</span>
                                            </div>
                                        </div>
                                        {{--@foreach($clinics as $clinic)--}}
                                        {{--<div class="col col-4">--}}
                                        {{--<div class="schedule-cell-col">--}}
                                        {{--<span class="schedule-cell example-cell two-clinic" style="background: {{$clinic->color}}"></span>--}}
                                        {{--<span>{{$clinic->name}}</span>--}}
                                        {{--</div>--}}
                                        {{--</div>--}}
                                        {{--@endforeach--}}
                                    </div>
                                </div>
                            </div>
                            <div class="schedule">
                                <div class="card p-3 mb-0">
                                    <div class="mb-3 ">@lang('allTranslate.Schedule_for'): <b>{{parseMonthTrue(date('n',strtotime(''.now().'+ 1 month')))}}</b></div>
                                    <div class="table-responsive">
                                        <table class="table" border="1">
                                            <tr>
                                                <th rowspan="2">
                                                    @lang('allTranslate.Doctor')
                                                </th>
                                                @for($day = 1; $day <= date('t',strtotime(''.now().'+ 1 month'));$day++)
                                                    <th class="{{date('N',strtotime(''.(date('t') - date('d')+$day).' days')) == 6?'day-off':''}} {{date('N',strtotime(''.(date('t') - date('d')+$day).' days')) == 7?'day-off':''}}">{{parseMonth(date('N',strtotime(''.(date('t') - date('d')+$day).' days')))}}</th>
                                                @endfor
                                            </tr>
                                            <tr>
                                                @for($day = 1; $day <= date('t',strtotime(''.now().'+ 1 month'));$day++)
                                                    <th>{{$day}}</th>
                                                @endfor
                                            </tr>
                                            <tr>
                                                <td>
                                                    @lang('allTranslate.Doctor')
                                                </td>
                                                @for($day = 1; $day <= date('t',strtotime(''.now().'+ 1 month'));$day++)
                                                    <td data-date="{{date('Y-m-d',strtotime(''.(date('t') - date('d')+$day).' days'))}}" class="next-days {{in_array(date('Y-m-d',strtotime(''.(date('t') - date('d')+$day).' days')),$holidays->toArray())?'day-off':''}}

                                                    @if(in_array(date('Y-m-d',strtotime(''.(date('t') - date('d')+$day).' days')),$two_clinics))
                                                            two-clinic
@else
                                                    {{in_array(date('Y-m-d',strtotime(''.(date('t') - date('d')+$day).' days')),$days->toArray())?'all-day':''}}
                                                    @endif
                                                            "></td>
                                                @endfor
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-md-4">
                                            <span class="schedule-cell example-cell day-off"></span>
                                            @lang('allTranslate.Day_off')
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <span class="schedule-cell example-cell all-day"></span>
                                            @lang('allTranslate.all_day')
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <span class="schedule-cell example-cell two-clinic"></span>
                                            @lang('allTranslate.works_several_clinics')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="kt-form__body">
                <div class="kt-section__body">
                    <form class="formAdd kt-form">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="row">
                                <div class="col-12 col-sm-8 col-md-3 mx-auto mx-md-0 my-5 my-md-0">
                                    <div class="form-group d-flex justify-content-center align-items-center">
                                        <div class="kt-avatar kt-avatar--outline kt-avatar--circle-" id="kt_user_edit_avatar">
                                            <img src="{{asset($user->avatar??'/assetsnew/img/avatar.jpg')}}" class="img-fluid" alt="">
                                            <label data-toggle="modal" data-target="#changeAvatar" class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="@lang('allTranslate.change_photo')">
                                                <i class="fa fa-pen" aria-hidden="true"></i>
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
                                                <input type="text" name="surname" class="form-control" value="{{$user->surname}}" placeholder=" ">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label>@lang('allTranslate.first_name') <span class="text-danger">*</span></label>
                                                <input type="text" name="name" class="form-control" value="{{$user->name}}" placeholder=" ">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label>@lang('allTranslate.Surname') <span class="text-danger">*</span></label>
                                                <input type="text" name="patronymic" class="form-control" value="{{$user->patronymic}}" placeholder=" ">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label>Email <span class="text-danger">*</span></label>
                                                <input type="email" name="email" value="{{$user->email}}" class="form-control" placeholder=" ">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label>@lang('allTranslate.address') </label>
                                                <input type="text" name="address" value="{{$user->address}}" class="form-control" placeholder=" ">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label>@lang('allTranslate.telephone_number')</label>
                                                <input type="text" name="phone" class="form-control phone-mask" value="{{$user->phone}}" placeholder="">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label>@lang('allTranslate.Work_experience')</label>
                                                <input type="text" name="experience" value="{{$user->experience}}" class="form-control" placeholder="">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label>@lang('allTranslate.Specialization')</label>
                                                <input type="text" name="specialization" value="{{$user->specialization}}" class="form-control" placeholder="">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label>@lang('allTranslate.Scientific_degree')</label>
                                                <input type="text" name="degree" value="{{$user->degree}}" class="form-control" placeholder="">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label>@lang('allTranslate.Brief_description')</label>
                                                <input type="text" name="description" value="{{$user->description}}" class="form-control" placeholder="">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-portlet__head-actions justify-content-end d-flex">
                                <a href="{{ route('adminUsers') }}" class="btn btn-secondary btn-elevate btn-icon-sm"><i class="fa fa-window-close"></i> <span class="d-m-n">@lang('allTranslate.cancel_btn')</span></a>
                                &nbsp;
                                <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm"><i class="fa fa-save"></i> <span class="d-m-n">@lang('allTranslate.Save')</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content">
                <div class="modal-header">
                    <div class="col-8">
                        <h5>@lang('allTranslate.Schedule_for') <span class="title-date"></span></h5>
                    </div>
                    <div class="col-4">
                        <h5 class="text-right">{{$user->surname}} {{mb_strtoupper(mb_substr($user->name,0,1))}}. {{mb_strtoupper(mb_substr($user->patronymic,0,1))}}.</h5>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <div>
                            <label class="kt-radio kt-radio--bold kt-radio--brand">
                                <input type="radio" id="day-off" name="work_time" checked class="schedule-radio" value="0">
                                @lang('allTranslate.doctor_day_off')
                                <span></span>
                            </label>
                        </div>
                        <div>
                            <label class="kt-radio kt-radio--bold kt-radio--brand">
                                <input type="radio" id="time-work" name="work_time" class="schedule-radio time-radio" value="1">
                                @lang('allTranslate.Specify_business_hours')
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="align-items-center flex-column justify-content-center work-time-b d-none">
                        <div class="modal-go">
                        </div>
                        <button class="btn btn-sm btn-brand add-time add-time-modal" value="add"><i class="fa fa-plus px-0 mx-0"></i></button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fa fa-window-close"></i> @lang('allTranslate.cancel_btn')</button>
                    <button type="button" class="btn btn-brand btn-sm modal-work-time"><i class="fa fa-save"></i>@lang('allTranslate.Save')</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('modals')
    <div class="modal fade" id="changeAvatar" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content change-avatar">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('allTranslate.change_photo_profile')</h5>
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
                    <button type="submit" class="btn btn-success btn-sm btn-icon-sm change-avatar"><i class="fa fa-save"></i> @lang('allTranslate.Save')</button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content change-password">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('allTranslate.change_password')</h5>
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
                        <input type="password" name="password" class="form-control" placeholder="@lang('allTranslate.new_password') ">
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

        function initModal() {
            $('.select_2').select2();
        }
    </script>


    <script>

        $(document).ready(function () {
            new SaveTrait({
                selector: 'form.change-avatar',
                actionUrl: '{{route('adminUsersAvatar',$user->id)}}',
                showFailToast: true
            }).setAdditionalSuccessCallback(function (data) {
                $('.avatar-item').attr('src', '{{asset('')}}' + data.avatar);
                $('#changeAvatar').modal('hide');
                location.reload();
            });

            new SaveTrait({
                selector: 'form.change-password',
                actionUrl: '{{route('adminUsersPassword',$user->id)}}',
                showFailToast: true,
            }).setAdditionalSuccessCallback(function (data) {
                $('#changePassword').modal('hide');
            });
        });


        $('.schedule-radio').on('change', function () {
            if (this.checked) {
                if ($(this).hasClass('time-radio')) {
                    $('.work-time-b').addClass('d-flex');
                } else {
                    $('.work-time-b').removeClass('d-flex')
                }
            }
        });

        function delete_btn(id) {
            $.ajax({
                method: "POST",
                url: '{{route('deleteWorkTime',$user->id)}}',
                data: {
                    id: id,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    // console.log(data);
                    Swal.fire({
                        type: data.status ? 'success' : 'error',
                        title: data.title,
                        toast: true,
                        html: data.message,
                        position: 'top-end',
                        timer: 100000,
                        showConfirmButton: false,
                    });
                    setTimeout(() => document.location.reload(true), 2000);
                }
            });
        }

        $(document).ready(function () {


            $('.add-time').click(function () {
                $('.modal-go').append('<div class="select_2-100">' +
                    ' <select name="clinics_id[]" class="form-control select_2 select-2-record-day">\n' +
                    '                                @foreach($clinics as $clinic)\n' +
                    '                                    <option value="{{$clinic->id}}">{{$clinic->name}}</option>\n' +
                    '                                @endforeach\n' +
                    '                            </select>' +
                    '</div>' +
                    '         <div class="d-flex align-items-center mb-3 position-relative"><div class="description-modal">з</div>\n  ' +
                    '                            <div class="select_2-100">\n' +
                    '                                <select name="start_time[]" class="form-control select_2 select-2-record-day d-flex">\n' +
                    '                                    <option>09:00</option>\n' +
                    '                                    <option>09:30</option>\n' +
                    '                                    <option>09:45</option>\n' +
                    '                                    <option>10:00</option>\n' +
                    '                                    <option>10:30</option>\n' +
                    '                                    <option>11:00</option>\n' +
                    '                                    <option>11:30</option>\n' +
                    '                                    <option>12:00</option>\n' +
                    '                                    <option>13:00</option>\n' +
                    '                                    <option>13:30</option>\n' +
                    '                                    <option>14:00</option>\n' +
                    '                                    <option>14:30</option>\n' +
                    '                                    <option>15:00</option>\n' +
                    '                                    <option>15:30</option>\n' +
                    '                                    <option>16:00</option>\n' +
                    '                                    <option>16:30</option>\n' +
                    '                                    <option>17:00</option>\n' +
                    '                                    <option>17:30</option>\n' +
                    '                                    <option>18:00</option>\n' +
                    '                                    <option>18:30</option>\n' +
                    '                                </select>\n' +
                    '                            </div>\n' +
                    '                            <div class="description-modal">до</div>\n' +
                    '                            <div class="select_2-100">\n' +
                    '                                <select name="end_time[]" class="form-control select_2 select-2-record-day d-flex">\n' +
                    '                                    <option>09:00</option>\n' +
                    '                                    <option>09:30</option>\n' +
                    '                                    <option>09:45</option>\n' +
                    '                                    <option>10:00</option>\n' +
                    '                                    <option>10:30</option>\n' +
                    '                                    <option>11:00</option>\n' +
                    '                                    <option>11:30</option>\n' +
                    '                                    <option>12:00</option>\n' +
                    '                                    <option>13:00</option>\n' +
                    '                                    <option>13:30</option>\n' +
                    '                                    <option>14:00</option>\n' +
                    '                                    <option>14:30</option>\n' +
                    '                                    <option>15:00</option>\n' +
                    '                                    <option>15:30</option>\n' +
                    '                                    <option>16:00</option>\n' +
                    '                                    <option>16:30</option>\n' +
                    '                                    <option>17:00</option>\n' +
                    '                                    <option>17:30</option>\n' +
                    '                                    <option>18:00</option>\n' +
                    '                                    <option>18:30</option>\n' +
                    '                                    <option>19:00</option>\n' +
                    '                                </select>\n' +
                    '                            </div>\n' +
                    '                            <input value="0" hidden name="ids[]">' +
                    '</div>');
                event.preventDefault();
                initModal();
            });
            new SaveTrait({selector: 'form.formAdd', enableButtonOnSuccess: true});

            new SaveTrait({
                selector: '.modal-work-time',
                formSelector: 'form.modal-content',
                selectorType: 'click',
                buttonSelector: '.modal-work-time',
                enableButtonOnSuccess: true,
                showFailToast: true,
                // showSuccessToast: false,
                actionUrl: '{{route('addWorkTime',$user->id)}}'
            })
                .setAdditionalData(function (data) {
                    data.append('date', $('.title-date').data('date'));
                    return data;
                });
            // console.log("This is %cMy stylish message", "color: yellow; font-style: italic; background-color: blue; padding: 20px;font-size:40px");
            new SaveTrait({
                selector: '.next-days',
                actionUrl: '{{route('adminWorkTime',$user->id)}}',
                selectorType: 'click',
                showSuccessToast: false,
            }).setAdditionalData(function (data, instance) {
                $('.title-date').data('date', $(instance).data('date'));
                let date = $(instance).data('date');
                $('.title-date').text(date.substring(8, 10) + '.' + date.substring(5, 7) + '.' + date.substring(0, 4));
                data.append('date', $(instance).data('date'));


                // var dateAr = $(instance).data('date').split('-');
                // var newDate =  dateAr[2] + '.' + dateAr[1] +   '.' + dateAr[0].slice(-4);
                // data.append('date', newDate);
                // $('.title-date').text(newDate);

                return data;
            }).setAdditionalSuccessCallback(function (data) {
                if (data.closed) {
                    $('#day-off').prop("checked", true);
                    $('.work-time-b').removeClass('d-flex');
                    $('.modal-go').html('<div class="select_2-100">' +
                        ' <select name="clinics_id[]" class="form-control select_2 select-2-record-day">\n' +
                        '                                @foreach($clinics as $clinic)\n' +
                        '                                    <option value="{{$clinic->id}}">{{$clinic->name}}</option>\n' +
                        '                                @endforeach\n' +
                        '                            </select>' +
                        '</div>' +
                        '<div class="d-flex align-items-center mb-3 position-relative"><div class="description-modal">з</div>\n' +
                        '                            <div class="select_2-100">\n' +
                        '                                <select name="start_time[]" class="form-control select_2 select-2-record-day">\n' +
                        '                                    <option>09:00</option>\n' +
                        '                                    <option>09:30</option>\n' +
                        '                                    <option>09:45</option>\n' +
                        '                                    <option>10:00</option>\n' +
                        '                                    <option>10:30</option>\n' +
                        '                                    <option>11:00</option>\n' +
                        '                                    <option>11:30</option>\n' +
                        '                                    <option>12:00</option>\n' +
                        '                                    <option>13:00</option>\n' +
                        '                                    <option>13:30</option>\n' +
                        '                                    <option>14:00</option>\n' +
                        '                                    <option>14:30</option>\n' +
                        '                                    <option>15:00</option>\n' +
                        '                                    <option>15:30</option>\n' +
                        '                                    <option>16:00</option>\n' +
                        '                                    <option>16:30</option>\n' +
                        '                                    <option>17:00</option>\n' +
                        '                                    <option>17:30</option>\n' +
                        '                                    <option>18:00</option>\n' +
                        '                                    <option>18:30</option>\n' +
                        '                                </select>\n' +
                        '                            </div>\n' +
                        '                            <div class="description-modal">до</div>\n' +
                        '                            <div class="select_2-100">\n' +
                        '                                <select name="end_time[]" class="form-control select_2 select-2-record-day">\n' +
                        '                                    <option>09:00</option>\n' +
                        '                                    <option>09:30</option>\n' +
                        '                                    <option>09:45</option>\n' +
                        '                                    <option>10:00</option>\n' +
                        '                                    <option>10:30</option>\n' +
                        '                                    <option>11:00</option>\n' +
                        '                                    <option>11:30</option>\n' +
                        '                                    <option>12:00</option>\n' +
                        '                                    <option>13:00</option>\n' +
                        '                                    <option>13:30</option>\n' +
                        '                                    <option>14:00</option>\n' +
                        '                                    <option>14:30</option>\n' +
                        '                                    <option>15:00</option>\n' +
                        '                                    <option>15:30</option>\n' +
                        '                                    <option>16:00</option>\n' +
                        '                                    <option>16:30</option>\n' +
                        '                                    <option>17:00</option>\n' +
                        '                                    <option>17:30</option>\n' +
                        '                                    <option>18:00</option>\n' +
                        '                                    <option>18:30</option>\n' +
                        '                                    <option>19:00</option>\n' +
                        '                                </select>\n' +
                        '                            </div>\n' +
                        '                            <input value="0" hidden name="ids[]"></div></div');
                    // console.log('closed');
                } else {
                    if (data.items.length) {
                        $('#time-work').prop("checked", true);
                        $('.work-time-b').addClass('d-flex');
                        $('.modal-go').html('');
                        data.items.forEach(function (val) {
                            // console.log(val);'
                            $('.modal-go').append('<div><div class="clinic-id select_2-100">' +
                                ' <select name="clinics_id[]" class="form-control select_2 select-2-record-day">\n' +
                                '                                @foreach($clinics as $clinic)\n' +
                                '                                    <option value="{{$clinic->id}}" >{{$clinic->name}}</option>\n' +
                                '                                @endforeach\n' +
                                '                            </select>' +
                                '</div>' +
                                ' <div class="d-flex align-items-center mb-3 position-relative"> <div class="description-modal">з</div>\n' +
                                '                            \<div class="select_2-100">\n' +
                                '                                <select name="start_time[]" class="form-control select_2 select-2-record-day">\n' +
                                '                                    <option>' + val.start.substr(val.start.length - 8, 5) + '</option>\n' +
                                '                                    <option>09:00</option>\n' +
                                '                                    <option>09:30</option>\n' +
                                '                                    <option>09:45</option>\n' +
                                '                                    <option>10:00</option>\n' +
                                '                                    <option>10:30</option>\n' +
                                '                                    <option>11:00</option>\n' +
                                '                                    <option>11:30</option>\n' +
                                '                                    <option>12:00</option>\n' +
                                '                                    <option>13:00</option>\n' +
                                '                                    <option>13:30</option>\n' +
                                '                                    <option>14:00</option>\n' +
                                '                                    <option>14:30</option>\n' +
                                '                                    <option>15:00</option>\n' +
                                '                                    <option>15:30</option>\n' +
                                '                                    <option>16:00</option>\n' +
                                '                                    <option>16:30</option>\n' +
                                '                                    <option>17:00</option>\n' +
                                '                                    <option>17:30</option>\n' +
                                '                                    <option>18:00</option>\n' +
                                '                                    <option>18:30</option>\n' +
                                '                                </select>\n' +
                                '                            </div>\n' +
                                '                            <div class="description-modal">до</div>\n' +
                                '                            <div class="select_2-100">\n' +
                                '                                <select name="end_time[]" class="form-control select_2 select-2-record-day">\n' +
                                '                                    <option>' + val.end.substr(val.end.length - 8, 5) + '</option>\n' +
                                '                                    <option>09:00</option>\n' +
                                '                                    <option>09:30</option>\n' +
                                '                                    <option>09:45</option>\n' +
                                '                                    <option>10:00</option>\n' +
                                '                                    <option>10:30</option>\n' +
                                '                                    <option>11:00</option>\n' +
                                '                                    <option>11:30</option>\n' +
                                '                                    <option>12:00</option>\n' +
                                '                                    <option>13:00</option>\n' +
                                '                                    <option>13:30</option>\n' +
                                '                                    <option>14:00</option>\n' +
                                '                                    <option>14:30</option>\n' +
                                '                                    <option>15:00</option>\n' +
                                '                                    <option>15:30</option>\n' +
                                '                                    <option>16:00</option>\n' +
                                '                                    <option>16:30</option>\n' +
                                '                                    <option>17:00</option>\n' +
                                '                                    <option>17:30</option>\n' +
                                '                                    <option>18:00</option>\n' +
                                '                                    <option>18:30</option>\n' +
                                '                                    <option>19:00</option>\n' +
                                '                                </select>\n' +
                                '                            </div>\n' +
                                '                            <input value="' + val.id + '" hidden name="ids[]"> ' +
                                '<div class="btn btn-deletes mr-2 modal-time-delete" onclick="delete_btn(' + val.id + ')"><i class="fa fa-trash "></i>  </div></div></div>');

                            // let item = $($( "input[value="+val.id+"][name='ids[]']").parent().parent().children().first().children().first()[0]);
                            let item = $($("input[value=" + val.id + "][name='ids[]']").parent().parent().children().first().children().find('option[value=' + val.clinic_id + ']').attr("selected", "selected"));

                            // console.log(item)


                            // if (item.val() == val.id){
                            //
                            //     console.log($('.modal-go').find('[name="ids[]"]'));
                            // }
                        });
                        // console.log(data);
                    } else {
                        $('#day-off').prop("checked", true);
                        $('.work-time-b').removeClass('d-flex');
                        $('.modal-go').html('<div class="select_2-100">' +
                            ' <select name="clinics_id[]" class="form-control select_2 select-2-record-day">\n' +
                            '                                @foreach($clinics as $clinic)\n' +
                            '                                    <option value="{{$clinic->id}}">{{$clinic->name}}</option>\n' +
                            '                                @endforeach\n' +
                            '                            </select>' +
                            '</div>' +
                            '  <div class="d-flex align-items-center mb-3 position-relative"> <div class="description-modal">з</div>\n' +
                            '                            <div class="select_2-100">\n' +
                            '                                <select name="start_time[]" class="form-control select_2 select-2-record-day">\n' +
                            '                                    <option>09:00</option>\n' +
                            '                                    <option>09:30</option>\n' +
                            '                                    <option>09:45</option>\n' +
                            '                                    <option>10:00</option>\n' +
                            '                                    <option>10:30</option>\n' +
                            '                                    <option>11:00</option>\n' +
                            '                                    <option>11:30</option>\n' +
                            '                                    <option>12:00</option>\n' +
                            '                                    <option>13:00</option>\n' +
                            '                                    <option>13:30</option>\n' +
                            '                                    <option>14:00</option>\n' +
                            '                                    <option>14:30</option>\n' +
                            '                                    <option>15:00</option>\n' +
                            '                                    <option>15:30</option>\n' +
                            '                                    <option>16:00</option>\n' +
                            '                                    <option>16:30</option>\n' +
                            '                                    <option>17:00</option>\n' +
                            '                                    <option>17:30</option>\n' +
                            '                                    <option>18:00</option>\n' +
                            '                                    <option>18:30</option>\n' +
                            '                                </select>\n' +
                            '                            </div>\n' +
                            '                            <div class="description-modal">до</div>\n' +
                            '                            <div class="select_2-100">\n' +
                            '                                <select name="end_time[]" class="form-control select_2 select-2-record-day">\n' +
                            '                                    <option>09:00</option>\n' +
                            '                                    <option>09:30</option>\n' +
                            '                                    <option>09:45</option>\n' +
                            '                                    <option>10:00</option>\n' +
                            '                                    <option>10:30</option>\n' +
                            '                                    <option>11:00</option>\n' +
                            '                                    <option>11:30</option>\n' +
                            '                                    <option>12:00</option>\n' +
                            '                                    <option>13:00</option>\n' +
                            '                                    <option>13:30</option>\n' +
                            '                                    <option>14:00</option>\n' +
                            '                                    <option>14:30</option>\n' +
                            '                                    <option>15:00</option>\n' +
                            '                                    <option>15:30</option>\n' +
                            '                                    <option>16:00</option>\n' +
                            '                                    <option>16:30</option>\n' +
                            '                                    <option>17:00</option>\n' +
                            '                                    <option>17:30</option>\n' +
                            '                                    <option>18:00</option>\n' +
                            '                                    <option>18:30</option>\n' +
                            '                                    <option>19:00</option>\n' +
                            '                                </select>\n' +
                            '                            </div>\n' +
                            '                            <input value="0" hidden name="ids[]">' +
                            '<div class="description-modal d-none">до</div></div>');
                        // console.log('undefined-my');
                    }
                }
                $('#exampleModal').modal('show');

                initModal();

            });

        });


    </script>
@endpush

@push('styles')
    <style>

        /*Start table*/
        .schedule .table {
            border: 1px solid #eee;
            font: 14px/16px Roboto, sans-serif;
        }

        .calendars {
            margin: 0px auto;
            display: block;
            position: relative;
        }

        .calendars #datepicker {
            height: 30px;
        }

        .calendars .ui-datepicker-trigger {
            position: absolute;
            top: 7px;
            right: 7px;
            color: #009efb;
        }

        .calendars-visit .ui-datepicker-trigger {
            position: absolute;
            top: 2px;
            right: 7px;
            color: #009efb;
        }

        .fc-toolbar {
            padding-bottom: 15px;
        }

        .fc-now-indicator {
            border: 0 solid #FFC107;
        }

        .doctor-avatar {
            max-width: 60px;
        }

        .fc-now-indicator {
            border: 0 solid #FFC107;
        }

        .doctor-info {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            margin-bottom: 15px;
        }

        .schedule .table th {
            text-transform: none;
            text-align: center;
            white-space: nowrap;
            font-weight: 700;
            vertical-align: middle;
            padding: 8px;
        }

        .example-cell {
            display: inline-block;
            width: 25px;
            height: 15px;
            margin-right: 10px;
            border: 1px solid #d6d6d6;
        }

        .today {
            border-left: 3px solid #e9bc78;
        }

        .today-number:hover {
            background: #59D2FE;
            cursor: pointer;
        }

        .next-days {
            background-color: #f5f5f5;
        }

        .all-day {
            background: #1dc48d;
        }

        .two-clinic {
            background: -webkit-gradient(linear, left top, left bottom, color-stop(50%, #1dc48d), color-stop(50%, #ffd400));
            background: linear-gradient(to bottom, #1dc48d 50%, #ffd400 50%);
        }

        .before-day {
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0, #1dc48d), color-stop(50%, #1dc48d), color-stop(50%, #fff), to(#fff));
            background: linear-gradient(to bottom, #1dc48d 0, #1dc48d 50%, #fff 50%, #fff 100%);
        }

        .after-day {
            background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #1dc48d), color-stop(50%, #1dc48d), color-stop(50%, #fff), to(#fff));
            background: linear-gradient(to top, #1dc48d 0, #1dc48d 50%, #fff 50%, #fff 100%);
        }

        .day-off {
            background: #FF5B5B;
            color: #fff !important;
        }

        .next-days:hover {
            background: #59D2FE;
            cursor: pointer;
        }

        .empty {
            opacity: .2;
        }

        .schedule-cell-col {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            flex-wrap: nowrap;
            margin-bottom: 15px;

        }

        .modal-time-delete {
            position: absolute;
            left: 100%;
        }

        .clinic-id {
            margin-bottom: 10px;
        }

        .description-modal {
            margin: 0 10px;
        }

        .description-modal:first-child {
            position: absolute;
            right: 100%;
        }

        .select_2-100 {
            margin-bottom: 10px;
        }

        .select_2-100 .select2-container {
            min-width: 132px !important;
        }

        .modal-go {
            width: 300px;
        }

    </style>
@endpush

