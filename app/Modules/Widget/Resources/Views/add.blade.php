@extends('layouts.app')


@section('content')
    <div class="my-3 my-md-5">
        <div class="widget-container">

            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="page-header">
                            <h4 class="page-title">Записатись на візит</h4>
                            {{--                {{ Breadcrumbs::render('adminClinics') }}--}}

                        </div>
                        <form class="card">
                            <!--<div class="card-header">-->
                            <!--<h3 class="card-title">Basic Table</h3>-->
                            <!--</div>-->

                            @csrf
                            <div class="px-4 py-3">
                                <div class="form-group form-group1">
                                    <label for="doctors">Лікар <span class="text-danger">*</span></label>
                                    <select name="doctor_id" id="doctor" class="form-control doctor select-2-doctors">
                                        <option></option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}" data-description="{{$user->description}}" data-image="{{asset($user->avatar?? '/admin-styles/assets/images/avatar.png')}}">{{$user->surname}} {{mb_strtoupper(mb_substr($user->name,0,1))}}.{{mb_strtoupper(mb_substr($user->patronymic,0,1))}}.</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="form-group">
                                    <label for="new-patient" class="kt-checkbox kt-checkbox--bold kt-checkbox--brand mr-5">
                                        <input type="hidden" name="confirmed" value="0">
                                        <input type="checkbox" id="new-patient" class="new-patient" value="1" name="is_new"> Новий пацієнт
                                        <span></span>
                                    </label>
                                </div>
                                <div class="form-group old-patient-b">
                                    <label for="patient-phone">Введіть ваш номер <span class="text-danger">*</span></label>
                                    <input name="phone" type="text" id="patient-phone" class="form-control phone-mask client-phone">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="row d-none new-patient-b">
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="name">Ім'я<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control " name="name" id="name">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="surname">Прізвище<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control " name="first_name" id="surname">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="patronymic">По-батькові<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control " name="last_name" id="patronymic">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="address">Адреса<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control " name="address" id="address">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="phone">Номер телефона <span class="text-danger">*</span></label>
                                            <input type="text" name="phone" class="form-control phone-mask" id="phone" placeholder="Введіть номер телефона">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="birthday">Вкажіть дату народження<span class="text-danger">*</span></label>
                                            <div class="calendars">
                                                <input type="text"
                                                       class="form-control openemr-datepicker input-textbox outline-element incorrect"
                                                       name="birthday" autocomplete="off">
                                            </div>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 ">
                                        <div class="form-group form-group2 select_2-100">
                                            <label for="find-out">Звідки про нас дізнались?</label>
                                            <select class="custom-select select-2-find-out w-auto" name="where_id">
                                                <option value="" selected>Виберіть варіант відповіді</option>
                                                @foreach($wheres as $where)
                                                    <option value="{{$where->id}}">{{$where->name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group form-group3">
                                            <label for="date">Виберіть день запису <span class="text-danger">*</span></label>
                                            {{--<input type="text" class="form-control date-mask" id="birth" placeholder="Виберіть дату запису">--}}
                                            <select name="date" id="date" multiple class="form-control  select-2-record-day">
                                                <option></option>
                                            </select>
                                            <div class="invalid-feedback"></div>
                                            <small class="text-danger">(Якщо лікар не вибраний оберіть його!)</small>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 mx-auto">
                                        <div class="form-group form-group4">
                                            <label class="d-block mb-30" for="start">Виберіть час запису <span class="text-danger text-center">*</span></label>
                                            <select name="start" id="start" class="form-control  select-2-record-start">
                                                <option></option>
                                            </select>
                                            <div class="invalid-feedback"></div>
                                            {{--<p class="mb-0">--}}
                                            {{--<small><img class="mr-1" width="14px" height="14px" src="{{asset('public/admin-styles/assets/img/info-circle-solid.svg')}}" alt="">Лікар працює з : </i> <span class="treatment-plan-free-time color-primary"><small><span class="badge badge-pill badge-primary">09:00 - 18:00</span></small></span></small>--}}
                                            {{--</p>--}}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group form-group5">
                                            <label for="birth">Заплановані послуги <span class="text-danger text-center">*</span></label>
                                            <select class="custom-select select-2-service" name="service_id">
                                                <option value="" selected>Виберіть послугу</option>
                                                @foreach($services as $service)
                                                    <option value="{{$service->id}}">{{$service->name}}</option>
                                                @endforeach
                                                {{--<option value="also">Інше</option>--}}
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    {{--<div class="col-6 also-input" style="display: none">--}}
                                    {{--<div class="form-group">--}}
                                    {{--<label for="birth">Вкажіть назву послуги</label>--}}
                                    {{--<input class="form-control" name="also" placeholder="Вкажіть послугу">--}}
                                    {{--<div class="invalid-feedback"></div>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                </div>
                                <div class="form-group">
                                    <label for="complaints">Коментар</label>
                                    <textarea type="text" name="complaints" class="form-control" id="complaints" placeholder="Введіть коментар"></textarea>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="modal-footer">
                                    <a href="javascript:void(0)" class="btn btn-secondary close-modal" data-dismiss="modal">Відмінити</a>
                                    <button type="submit" class="btn btn-primary add-time">Додати запис</button>
                                </div>
                            </div>
                        </form>
                        <!-- table-responsive -->
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection


@push('scripts')

    <script>


        $('.select_2').select2({
            minimumResultsForSearch: -1,
        });
        // data-placeholder="Виберіть послугу"

        $(".phone-mask").inputmask("mask", {
            "mask": "+38 (999) 999-9999"
        });
    </script>
    <script>
        $(".openemr-datepicker").datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            // language: "ru",
            language: "uk",
            // language: "en",
            isRTL: false,
            autoclose: true,
            format: "dd.mm.yyyy",
        });
    </script>


    <script>
        let worktime = [];
        let visits = [];
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
                        // console.log(data);

                        $.each(data.dates, function (k, v) {
                            let option = $('<option/>');
                            option.val(k).attr({'data-clinic': v[0].clinic_id, 'data-end': v[0].end}).text(k);
                            $('[name=date]').append(option);
                            worktime = data.dates;
                            visits = data.visits;
                        })
                    }
                });
            });

            new SaveTrait({selector: 'form.card', actionUrl: '{{route('widgetAdd')}}', enableButtonOnSuccess: true, showFailToast: true, clearFormOnSuccess: true}).setAdditionalData(function (data) {
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
                    nowDateWorkTime.push([Date.parse(worktime[$('#date :selected').val()][i].start), Date.parse(worktime[$('#date :selected').val()][i].end), worktime[$('#date :selected').val()][i].clinic.address, worktime[$('#date :selected').val()][i].clinic.id]);
                }
                // console.log(visits);
                $('[name=start]').html('');
                for (v in nowDateWorkTime) {
                    let start2 = nowDateWorkTime[v][0];
                    let end = nowDateWorkTime[v][1];
                    for (; end - start2 >= 1800000; start2 += 1800000) {
                        let minutes = new Date(start2).getMinutes();
                        let hours = new Date(start2).getHours();
                        if (minutes === 0) {
                            minutes += '0';
                        }
                        if (hours < 10) {
                            hours = '0' + hours;
                        }

                        let not_in_visit = true;
                        for (ind in visits[$('#date :selected').val()]) {
                            if (start2 == Date.parse(visits[$('#date :selected').val()][ind].date)) {
                                not_in_visit = false;
                            }
                        }
                        if (not_in_visit) {
                            let option = $('<option/>');
                            option.val(hours + ':' + minutes).attr('data-clinic', nowDateWorkTime[v][3]).text(hours + ':' + minutes + '  ' + nowDateWorkTime[v][2]);
                            $('[name=start]').append(option);
                        }
                    }
                }

            });
        });


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
            minimumResultsForSearch: -1,

            placeholder: "Виберіть лікаря",
            dropdownParent: $(".form-group1"),

            multiple: false,
            templateResult: formatState,
            templateSelection: formatState
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


        $('.select-2-find-out').select2({
            placeholder: "Виберіть варіант відповіді",
            multiple: false,
            minimumResultsForSearch: -1,
            dropdownParent: $(".form-group2")
        });
        $('.select-2-record-day').select2({
            placeholder: "Виберіть день запису",
            multiple: false,
            // minimumResultsForSearch: -1,
            dropdownParent: $(".form-group3")
        });
        $('.select-2-record-start').select2({
            placeholder: "Виберіть дату запису",
            multiple: false,
            // minimumResultsForSearch: -1,
            dropdownParent: $(".form-group4")
        });
        $('.select-2-service').select2({
            placeholder: "Виберіть послугу",
            multiple: false,
            minimumResultsForSearch: -1,
            dropdownParent: $(".form-group5")
        });


        // ---------select-2-------------

        //
        // $(".phone-mask").inputmask('+38(999) 999 9999',
        //     {"clearMaskOnLostFocus": false});
        //
        // $(".date-mask").inputmask('dd.mm.yyyy',
        //     {"clearMaskOnLostFocus": false});


    </script>
    <style>
        .select_2-100 .select2-container {
            width: 100% !important;
        }
        .form-group{
            display: flex;
            flex-direction: column;
        }
    </style>
@endpush