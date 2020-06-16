@extends('admin::main')

@section('title', trans("allTranslate.add_visit"))
@section('breadCrumb', Breadcrumbs::render('addVisit'))

@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon"><i class="kt-font-brand fa fa-calendar-check"></i></span>
                <h3 class="kt-portlet__head-title">
                    @lang('allTranslate.add_visit')
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <a href="{{ redirect()->back()->getTargetUrl() }}" class="btn btn-secondary btn-elevate btn-icon-sm">
                            <i class="fa fa-undo"></i>
                            @lang('allTranslate.back')
                        </a>
                        {{--&nbsp;--}}
                        {{--<a href="{{route('addPatient')}}" class="btn btn-brand btn-elevate btn-icon-sm">--}}
                        {{--<i class="la la-plus"></i>--}}
                        {{--Додати пацієнта--}}
                        {{--</a>--}}
                    </div>
                </div>
            </div>
        </div>
        <form class="formAdd kt-form">
            @csrf
            <div class="kt-portlet__body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="doctors">@lang('allTranslate.doctor') <span class="text-danger">*</span></label>
                            <select name="doctor_id" id="doctor" class="form-control doctor select-2-doctors">
                                {{--<option></option>--}}
                                @foreach($users as $user)
                                    <option value="{{$user->id}}" data-description="{{$user->description}}" data-image="{{asset($user->avatar?? 'assetsnew/img/avatar.jpg')}}">{{$user->surname}} {{mb_strtoupper(mb_substr($user->name,0,1))}}.{{mb_strtoupper(mb_substr($user->patronymic,0,1))}}.</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand mr-5">
                                <input type="checkbox" id="new-patient" name="is_new" class="new-patient">@lang('allTranslate.New_pacient')
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group old-patient-b">
                            <label for="patient-phone">@lang('allTranslate.number_telephone_pacient')<span class="text-danger">*</span></label>
                            <input name="phone" type="text" id="patient-phone" class="form-control phone-mask client-phone">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>

                <div class="row d-none new-patient-b">
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label for="name">@lang('allTranslate.first_name')<span class="text-danger">*</span></label>
                            <input type="text" class="form-control " name="name" id="name">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label for="surname">@lang('allTranslate.last_name')<span class="text-danger">*</span></label>
                            <input type="text" class="form-control " name="first_name" id="surname">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label for="patronymic">@lang('allTranslate.Surname')<span class="text-danger">*</span></label>
                            <input type="text" class="form-control " name="last_name" id="patronymic">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label for="address">@lang('allTranslate.address')<span class="text-danger">*</span></label>
                            <input type="text" class="form-control " name="address" id="address">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label for="phone">@lang('allTranslate.phone-number') <span class="text-danger">*</span></label>
                            <input type="text" name="phone" class="form-control phone-mask" id="phone">
                            <div class="invalid-feedback"></div>
                            <span class="form-text text-muted">@lang('allTranslate.telephone_format'): <code>+38(050)846-56-92</code></span>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label for="birth">@lang('allTranslate.enter_date_birth')<span class="text-danger">*</span></label>
                            <div class="calendars">
                                <input name="birthday" autocomplete="off" type="text" class="form-control date-mask" id="kt_datepicker_1" placeholder="@lang('allTranslate.select_date')">
                            </div>
                            <div class="invalid-feedback"></div>
                            <span class="form-text text-muted">@lang('allTranslate.Date_format'): <code>05.02.2020</code></span>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 ">
                        <div class="form-group select_2-100">
                            <label>@lang('allTranslate.Where_find_us')<span class="text-danger">*</span></label>
                            <select class="form-control select_2" name="where_id" data-placeholder="@lang('allTranslate.Select_option')">
                                <option value="">@lang('allTranslate.Select_option')</option>
                                @foreach($wheres as $where)
                                    <option value="{{$where->id}}">{{$where->name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 col-md-4">
                        <div class="form-group">
                            <label for="date">@lang('allTranslate.Select_recording_day') <span class="text-danger">*</span></label>
                            <select name="date" id="date" class="form-control  select_2 date-mask" data-placeholder="@lang('allTranslate.Select_recording_day')">
                                <option></option>
                            </select>
                            <div class="invalid-feedback"></div>
                            <span class="form-text text-muted"><code>@lang('allTranslate.Select_doctor')</code></span>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <div class="form-group">
                            <label class="d-block" for="start">@lang('allTranslate.Select_start_time') <span class="text-danger text-center">*</span></label>
                            <select name="start" id="start" class="form-control  select_2_time" data-placeholder="@lang('allTranslate.Select_start_time')">
                                <option></option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <div class="form-group">
                            <label class="d-block" for="end">@lang('allTranslate.Select_end_time') <span class="text-danger text-center">*</span></label>
                            <select name="end" id="end" class="form-control  select_2_time" data-placeholder="@lang('allTranslate.Select_end_time')">
                                <option></option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <div class="form-group">
                            <label>@lang('allTranslate.Scheduled_services') </label>
                            <select class="custom-select select_2" name="service_id">
                                <option value="" selected>@lang('allTranslate.Select_service')</option>
                                @foreach($services as $service)
                                    <option value="{{$service->id}}">{{$service->name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="complaints">@lang('allTranslate.comment')</label>
                            <textarea type="text" name="complaints" class="form-control" id="complaints" placeholder="@lang('allTranslate.Enter_comment')"></textarea>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__foot">
                <div class="kt-portlet__head-actions justify-content-end d-flex">
                    <a href="{{ route('adminVisits') }}" class="btn btn-secondary btn-elevate btn-icon-sm"><i class="fa fa-window-close"></i> <span class="d-m-n">@lang('allTranslate.cancel_btn')</span></a>
                    &nbsp;
                    <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm"><i class="fa fa-save"></i> <span class="d-m-n">@lang('allTranslate.Save')</span></button>
                </div>
            </div>
        </form>
    </div>
@endsection


@push('scripts')



    <script>
        let worktime = [];
        $(document).ready(function () {
            $('#doctor').change(function () {
                // console.log($('#doctor').val());
                $.ajax({
                    method: "POST",
                    url: '{{route('getWorkTime')}}',
                    data: {
                        id: $('#doctor').val(),
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        $('#date').html('');

                        $.each(data.dates, function (k, v) {
                            let option = $('<option/>');
                            option.val(k).attr({'data-clinic': v[0].clinic_id, 'data-end': v[0].end}).text(k);
                            $('[name=date]').append(option);
                            worktime = data.dates;
                        })

                        $('#date').trigger('change');
                    }
                });
            });

            new SaveTrait({
                selector: 'form.formAdd',
                enableButtonOnSuccess: false,
                showFailToast: true,
                clearFormOnSuccess: true
            }).setAdditionalData(function (data) {
                data.append('clinic_id', $('#start :selected').data('clinic'));
                if (!$('#new-patient').is(':checked')) {
                    data.append('phone2', $('#patient-phone').val());
                }
                return data;
            });

            let nowDateWorkTime = [];
            $('#date').change(function () {
                nowDateWorkTime = [];
                for (let i in worktime[$('#date :selected').val()]) {
                    nowDateWorkTime.push([
                        Date.parse(worktime[$('#date :selected').val()][i].start),
                        Date.parse(worktime[$('#date :selected').val()][i].end),
                        worktime[$('#date :selected').val()][i].clinic.address,
                        worktime[$('#date :selected').val()][i].clinic.id
                    ]);
                }

                updateTimeSelect(nowDateWorkTime);

            });

            $('#doctor').trigger('change');
        });

        // When date field has changed
        let start_el = $('[name="start"]'),
            end_el = $('[name="end"]');

        start_el.on('change', function () {
            if (!start_el.find('option[data-elem]').length) {
                return false;
            }

            let start_option = start_el.find('option:selected'),
                end_option = end_el.find('option:selected'),
                start_index = parseInt(start_option.attr('data-elem'), 10),
                end_index = parseInt(end_option.attr('data-elem')),
                start_group = start_option.attr('data-group'),
                end_group = end_option.attr('data-group');

            if (start_group !== end_group || start_index >= end_index) {
                end_el.find('option[data-elem="' + (start_index + 1) + '"]').prop('selected', true);

                end_el.trigger('change')
            }

            end_el.find('option:not([data-group="' + start_group + '"]')
                .prop('disabled', true);

            end_el.find('option[data-group="' + start_group + '"]')
                .prop('disabled', false)
                .filter(function () {
                    return parseInt($(this).attr('data-elem'), 10) < (start_index + 1);
                }).prop('disabled', true);
        });

        function updateTimeSelect(nowDateWorkTime) {
            start_el.html('');
            end_el.html('');

            let el_num = 0;

            for (v in nowDateWorkTime) {
                let start_time = nowDateWorkTime[v][0],
                    end_time = nowDateWorkTime[v][1],
                    time_step = 1800000,
                    count_cycles = (end_time - start_time) / time_step + 1;

                for (i = 1; i <= count_cycles; i++) {
                    let minutes = new Date(start_time).getMinutes(),
                        hours = new Date(start_time).getHours();

                    if (minutes === 0) {
                        minutes += '0';
                    }

                    if (hours < 10) {
                        hours = '0' + hours;
                    }

                    let option = $('<option/>');

                    option.val(hours + ':' + minutes)
                        .attr('data-elem', el_num)
                        .attr('data-group', v)
                        .attr('data-clinic', nowDateWorkTime[v][3])
                        .text(hours + ':' + minutes + '  ' + nowDateWorkTime[v][2]);

                    if (i < count_cycles) {
                        start_el.append(option);
                    }

                    if (i !== 1) {
                        end_el.append(option.clone());
                    }

                    el_num++;
                    start_time += time_step;
                }
            }

            start_el.trigger('change');
        }


        $('.select-2-service').on('change', function () {
            if ($('.select-2-service option:selected').val() === 'also') {
                $('.also-input').show();
            } else {
                $('.also-input').hide();
            }
        });

        $(document).on('change', '.new-patient', function () {
            if (this.checked) {
                $('.new-patient-b').addClass('d-flex');
                $('.old-patient-b').addClass('d-none');
            } else {
                $('.new-patient-b').removeClass('d-flex');
                $('.old-patient-b').removeClass('d-none')
            }
        });
    </script>


    <script>

        $('.select-2-doctors').select2({
            placeholder: "Виберіть лікаря",
            multiple: false,
            templateResult: formatState,
            templateSelection: formatState
        }).trigger('change');

        $('.select_2_time').select2({
            minimumResultsForSearch: -1
        }).trigger('change');


        function formatState(opt) {
            if (!opt.id) {
                return opt.text.toUpperCase();
            }

            var optimage = $(opt.element).attr('data-image');
            var description = $(opt.element).attr('data-description');
            // console.log(optimage)
            if (!optimage) {
                return opt.text.toUpperCase();
            } else {
                var $opt = $(
                    '<div class="d-flex align-items-center justify-content-start">' +
                    '<img src="' + optimage + '" width="30px" /> ' +
                    '<div    class="d-flex flex-column align-items-start justify-content-start ml-3">' + '<div    class="select-name" style="line-height: 18px; font-size: 13px;">' + opt.text.toUpperCase() + '</div>' +
                    '<div    class="select-description"  style="line-height: 18px; font-size: 12px;">' + description + '</div>' +
                    '</div>' +
                    '</div>'
                );
                return $opt;
            }
        }

        $(".phone-mask").inputmask("mask", {
            "mask": "+38 (999) 999-99-99"
        });
        $('#kt_datepicker_1').datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            language: "{{app()->getLocale()}}",
            isRTL: false,
            autoclose: true,
            format: "dd.mm.yyyy",
        });

        $('.select_2').select2({
            minimumResultsForSearch: -1
        });


    </script>

@endpush