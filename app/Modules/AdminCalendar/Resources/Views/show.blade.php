@extends('admin::main')

@section('title', 'CRM')

@section('breadCrumb', Breadcrumbs::render('adminCalendar'))

@section('content')
    <div class="kt-portlet kt-portlet--mobile p-3">
        <div class="row">
            <div class="col d-flex align-items-center justify-content-start">
                @foreach($clinics as $item)
                    <div class="schedule-cell-col mr-3">
                        <span class="schedule-cell example-cell" style="background: rgba(34,185,255,.025);"><span style="background: {{$item->color}}; width: 100%; height: 100%;    display: inherit;">{{$item->name}}</span></span>
                    </div>
                @endforeach
                {{--<div class="schedule-cell-col">--}}
                    {{--<span class="schedule-cell example-cell" style="background: rgba(34,185,255,.025);"><span style="background: rgb(224, 35, 35); width: 100%; height: 100%;    display: inherit;">Вихідний день</span></span>--}}
                {{--</div>--}}
            </div>
        </div>
        <div id='calendar' class="no-print"></div>
    </div>
    {{--#002f6d #282733--}}
    {{--#002f6d #201f2b--}}
@endsection

@push('modals')
    @include('adminCalendar::_modal_create')

    @include('adminCalendar::_modal_edit')
@endpush


@push('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="{{asset('assetsnew/js/fullcalendar2.min.js')}}"></script>
    <script src="{{asset('assetsnew/js/fullcalendar-columns.js')}}"></script>

    <script>

        $(document).on('change', '.new-children, .new-patient', function () {
            let changeEl = $('.new-patient'),
                phoneVal = $('[name="patient_id"] option:selected').data('phone'),
                attr_read_only = true;

            if ($(this).hasClass('new-patient')) {
                changeEl = $('.new-children');
                phoneVal = '';
                attr_read_only = false;
            }

            if (this.checked) {
                changeEl.prop('checked', false);

                $('[name="phone"]').val(phoneVal).attr('readonly', attr_read_only);
                $('.new-patient-b').addClass('d-flex');
                $('.old-patient-b').addClass('d-none');

            } else {
                $('.new-patient-b').removeClass('d-flex');
                $('.old-patient-b').removeClass('d-none');
            }
        });
    </script>

    <script>

        let doctors = @json($doctors),
            clinics = @json($clinics),
            statuses = @json($statuses),
            start_date = moment().format('YYYY-MM-DD'),
            day_names = [],
            month_names = [],
            calendar_cache = {},
            month_short_names = [];


        // Day's name list
        @for ($i = 0; $i < 7; $i++)
        day_names.push('{{ trans_choice('dates.weeks', $i) }}');
        @endfor

        // Month's name list
        @for ($i = 1; $i <= 12; $i++)
        month_names.push('{{ trans_choice('dates.month', $i) }}');
        month_short_names.push('{{ trans_choice('dates.month_short', $i) }}');
        @endfor

        // New Full Calendar

        var Calendar1 = $("#calendar");

        Calendar1.fullCalendar({
            // Add columns from fullcalendar-columns library
            views: {
                multiColAgendaDay: {
                    type: 'multiColAgenda',
                    duration: {days: 1},
                    numColumns: {{ $doctors->count() }},
                    columnHeaders: [
                        @foreach($doctors as $doctor)
                            '<div class="doctor-info">\n' +
                        '   <div class="doctor-img" style="background: url(\'{{asset( $doctor->avatar?? 'assetsnew/img/avatar.jpg')}}\')">\n' +
                        '   </div> <br>\n' +
                        '   {{$doctor->surname}} {{mb_strtoupper(mb_substr($doctor->name,0,1))}}.{{mb_strtoupper(mb_substr($doctor->patronymic,0,1))}}<br>\n' +
                        '       <span class="small"> {{$doctor->specialization}}</span>\n' +
                        '</div>',
                        @endforeach
                    ]
                }
            },
            scrollTime: moment(),
            navLinks: true,
            header: {
                left: 'today',
                center: '',
                right: 'prev, title, next'
            },
            minTime: '09:00:00',
            maxTime: '19:00:00',
            slotDuration: '00:30:00',
            slotLabelInterval: 30,
            editable: true,
            overlap: false,
            allDaySlot: false,
            nowIndicator: true,
            axisFormat: 'H:mm',
            defaultView: 'multiColAgendaDay',
            timeZone: 'local',
            timeFormat: 'H:mm',
            columnFormat: 'ddd M/D',
            titleFormat: {
                day: 'DD MMMM'
            },
            plugins: ['dayGrid', 'timeGrid', 'list'],
            monthNames: month_names,
            monthNamesShort: month_short_names,
            dayNames: day_names,
            dayNamesShort: day_names,
            buttonText: {
                today: '{{ Illuminate\Support\Str::ucfirst(trans('allTranslate.today')) }}',
                month: '{{ trans('allTranslate.month') }}',
                week: '{{ trans('allTranslate.week') }}',
                day: '{{ trans('allTranslate.day') }}',
                list: '{{ trans('allTranslate.list') }}',
            },
            // Permissions for selecting
            selectable: true,
            selectHelper: true,
            // Click and select functions
            eventClick: function (info) {
                openEditModal(info);
            },
            select: function (startDate, endDate, jsEvent, view) {
                let args = {
                    doctor_id: getDoctorIdByColumn(startDate.column),
                    column: startDate.column,
                    start: moment(startDate).format('YYYY-MM-DD HH:mm:ss'),
                    end: moment(startDate).format('YYYY-MM-DD') + ' ' + moment(endDate).format('HH:mm:ss')
                };

                let existing_events = checkEventsBetweenDates(args.start, args.end, args.column),
                    isSameClinics = validateBackgroundRangeOnDifferenceClinic(args.start, args.end, args.column);

                if (existing_events.length || !isSameClinics) {
                    Swal.fire({
                        position: 'center',
                        showCloseButton: true,
                        icon: 'info',
                        title: '{{trans('allTranslate.doctors_work_time')}}',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    Calendar1.fullCalendar('unselect');
                    return;
                }

                openCreateModal(args);
            },
            // Load events ajax from url
            eventSources: [

                // Get Work Times
                {
                    events: function (start, end, timezone, callback) {

                        start = start.format('YYYY-MM-DD');

                        // If start month of date less than current month
                        if (moment(start).isBefore(start_date, 'month')) {
                            start = start_date;
                        } else if (moment(start).isAfter(start_date, 'month')) {
                            // If start month of date more than current month
                            start = moment(start).startOf('month').format('YYYY-MM-DD');
                        }

                        end = moment(start).endOf('month').format('YYYY-MM-DD');

                        // have we already cached this time?
                        if (typeof calendar_cache !== 'undefined'
                            && calendar_cache.hasOwnProperty('workTime')
                            && typeof calendar_cache.workTime[end] !== 'undefined') {

                            //if we already have this data, pass it to callback()
                            callback(calendar_cache.workTime[end]);
                            return;
                        }

                        $.ajax({
                            url: '{{ route('adminCalendar.getWorkTimes') }}',
                            dataType: 'json',
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                start: start,
                                end: end
                            },
                            success: function (json_data) {
                                var events = [];

                                if (json_data['work_times']) {
                                    json_data['work_times'].forEach(function (item) {
                                        num_column = Object.keys(doctors).indexOf(item.doctor_id.toString())

                                        if (num_column !== -1) {
                                            if (item.is_holiday == null) {
                                                console.log('holidayEvent')
                                            }
                                            events.push({
                                                start: (item.start != null) ? item.start : moment(item.date).format('YYYY-MM-DD 09:00:00'),
                                                end: (item.end != null) ? item.end : moment(item.date).format('YYYY-MM-DD 19:00:00'),
                                                column: Object.keys(doctors).indexOf(item.doctor_id.toString()),
                                                rendering: 'background',
                                                backgroundColor: (item.is_holiday == null) ? clinics[item.clinic_id].color : '#e02323',
                                                overlap: (item.is_holiday == null),
                                                clinic_id: (item.is_holiday == null) ? item.clinic_id : 0,
                                                id: (item.is_holiday == null) ? 'workEvent' : 'holidayEvent'
                                            });
                                        }
                                        ;
                                    });
                                }

                                if (!calendar_cache.workTime)
                                    calendar_cache.workTime = {};

                                //store your data
                                calendar_cache.workTime[end] = events;

                                callback(events);
                            },
                            failed: function () {
                                alert('Response error. Please try reload page');
                            }
                        });
                    },

                },
                // Get Visits
                {
                    events: function (start, end, timezone, callback) {

                        start = start.startOf('month').format('YYYY-MM-DD');

                        // If start month of date less than current month
                        if (moment(start).isBefore(start_date, 'month')) {
                            start = start_date;
                        } else if (moment(start).isAfter(start_date, 'month')) {
                            // If start month of date more than current month
                            start = moment(start).startOf('month').format('YYYY-MM-DD');
                        }

                        end = moment(start).endOf('month').format('YYYY-MM-DD');

                        // have we already cached this time?
                        if (typeof calendar_cache !== 'undefined'
                            && calendar_cache.hasOwnProperty('visitItem')
                            && typeof calendar_cache.visitItem[end] !== 'undefined') {

                            //if we already have this data, pass it to callback()
                            callback(calendar_cache.visitItem[end]);
                            return;
                        }

                        $.ajax({
                            url: '{{ route('getVisits') }}',
                            dataType: 'json',
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                start: start,
                                end: end
                            },
                            success: function (json_data) {
                                var events = [];

                                if (json_data['visits']) {
                                    json_data['visits'].forEach(function (item) {
                                        num_column = Object.keys(doctors).indexOf(item.doctor_id.toString())

                                        if (num_column !== -1) {
                                            events.push({
                                                id: item.id,
                                                title: `${item.patient.first_name} ${item.patient.name} ${item.patient.last_name}`,
                                                start: item.date,
                                                end: item.date_end,
                                                column: Object.keys(doctors).indexOf(item.doctor_id.toString()),
                                                backgroundColor: statuses[item.status_id].color,
                                                borderColor: statuses[item.status_id].color,
                                                visit_data: {
                                                    visit_id: item.id,
                                                    complaints: item.complaints,
                                                    status_id: item.status_id,
                                                    service: (typeof item.visit_services[0] !== "undefined" && item.visit_services[0].service_id) ? item.visit_services[0].service.name : item.also,
                                                    phone: item.patient.phone,
                                                    birthday: moment(item.patient.birthday).format('DD.MM.YYYY')
                                                },
                                                draggable: false,
                                                editable: true,
                                                overlap: false
                                            });
                                        }
                                        ;
                                    });
                                }

                                if (!calendar_cache.visitItem)
                                    calendar_cache.visitItem = {};

                                //store your data
                                calendar_cache.visitItem[end] = events;

                                callback(events);
                            },
                            failed: function () {
                                alert('Response error. Please try reload page');
                            }
                        });
                    },

                }
                // any other sources...
            ]
        });

        function getDoctorIdByColumn(column) {
            let keys = Object.keys(doctors);

            if (keys) {
                return doctors[keys[column]].id;
            }

            return 0;
        }

        function fireMessage(data) {
            Swal.fire({
                type: data.status ? 'success' : 'error',
                title: data.title,
                toast: true,
                html: data.message,
                position: 'top-end',
                timer: 3002220,
                showConfirmButton: false,
            });
        }

        function checkEventsBetweenDates(date_start, date_end, column) {
            let existing_events = Calendar1.fullCalendar('clientEvents', function (events) {
                return ((events.start.add(1, 'm').isBetween(date_start, date_end)
                    || events.end.subtract(1, 'm').isBetween(date_start, date_end))
                    && events.column === column
                    && events.rendering !== 'background')
            });

            return existing_events;
        }

        /*
        * return false if clinics are not same
        * */
        function validateBackgroundRangeOnDifferenceClinic(date_start, date_end, column) {
            let flag = true;

            let existing_events = Calendar1.fullCalendar('clientEvents', function (events) {
                return (events.start.isBefore(date_end)
                    && events.end.isSameOrAfter(date_start)
                    && events.column === column
                    && events.rendering === 'background')
            });

            if (existing_events.length > 1) {
                existing_events.forEach(function (item) {
                    if (existing_events[0].clinic_id !== item.clinic_id) {
                        flag = false;

                        return;
                    }
                });
            } else if (existing_events.length < 1) {
                flag = false;
            }

            return flag;
        }

        function updateCalendarEvents(date_end, update_work_times = false) {
            date_end = moment(date_end).endOf('month').format('YYYY-MM-DD');

            delete calendar_cache.visitItem[date_end];

            if (update_work_times) {
                delete calendar_cache.workTime[date_end];
            }

            Calendar1.fullCalendar('refetchEvents');
        }

        $(document).ready(function () {
            $('#createVisitModal, #editVisitModal').on('hide.bs.modal', function (e) {
                if (e.target.name == 'birthday') {
                    return;
                }

                let form = $(this).find('form');

                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.form-group-invalid').removeClass('form-group-invalid');
                $('.new-patient-b').removeClass('d-flex');
                $('.old-patient-b').removeClass('d-none');

                form[0].reset();
                form.find('select').trigger('change');
            });


            $('#createVisitModal').find(".select_2").select2({
                language: {
                    searching: function (params) {
                        return 'searching...';
                    }
                }
            });

            $('#createVisitModal').find(".select_2_search").select2({
                ajax: {
                    url: '{{ route('searchPatients')}}',
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            search_query: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    }
                },
                templateSelection: function (container) {
                    $(container.element).attr("data-phone", container.phone);
                    return container.text;
                }
            });

            $('#createVisitModal').find(".phone-mask").inputmask("mask", {
                "mask": "+38 (999) 999-9999"
            });

            $('#createVisitModal').find('#birthday').datepicker({
                todayHighlight: true,
                orientation: "bottom left",
                language: "{{app()->getLocale()}}",
                isRTL: false,
                autoclose: true,
                format: "dd.mm.yyyy",
            });


            $('#createVisitModal #createVisitForm').on('submit', function (e) {
                e.preventDefault();

                let form = $(this),
                    formData = new FormData(this);

                if ($('.new-children, .new-patient').is(':checked')) {
                    formData.append('is_new', 1);
                }

                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.form-group-invalid').removeClass('form-group-invalid');

                $.ajax({
                    method: "POST",
                    url: '{{route('addDocVisit')}}',
                    processData: false,
                    contentType: false,
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        if (data.status) {
                            fireMessage(data);

                            updateCalendarEvents(form.find('input[name="end"]').val());

                            form[0].reset();

                            $('#createVisitModal').modal('hide');
                        } else if (!data.message) {
                            let obj = JSON.parse(data);

                            if (obj.errors) {
                                for (i in obj.errors) {
                                    $('#createVisitModal').find("[name='" + i + "']").addClass('is-invalid').parents('.form-group').addClass('form-group-invalid').find('.invalid-feedback').show().text(obj.errors[i][0]).parents('.form-group').find('.cke_chrome').css({border: '1px solid #c21a1a'});
                                }
                            }
                        } else {
                            fireMessage(data);
                        }
                    },
                    failed: function () {
                        alert('Response error. Please try reload page');
                    }
                });
            });

            $('#editVisitModal #editVisitForm').on('submit', function (e) {
                e.preventDefault();

                let form = $(this);

                $.ajax({
                    method: "POST",
                    url: '{{route('editStatus')}}',
                    data: form.serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        if (data.status) {
                            fireMessage(data);

                            updateCalendarEvents(form.find('input[name="end"]').val());

                            form[0].reset();

                            $('#editVisitModal').modal('hide');
                        } else if (!data.message) {
                            let obj = JSON.parse(data);

                            if (obj.errors) {
                                for (i in obj.errors) {
                                    $('#editVisitModal').find("[name='" + i + "']").addClass('is-invalid').parents('.form-group').addClass('form-group-invalid').find('.invalid-feedback').show().text(obj.errors[i][0]).parents('.form-group').find('.cke_chrome').css({border: '1px solid #c21a1a'});
                                }
                            }
                        } else {
                            fireMessage(data);
                        }
                    },
                    failed: function () {
                        alert('Response error. Please try reload page');
                    }
                });
            });

            $('#editVisitModal #delete_visit').on('click', function (e) {
                e.preventDefault();

                let form = $('#editVisitModal #editVisitForm');

                $.ajax({
                    method: "POST",
                    url: '{{ route('deleteDocVisit') }}',
                    data: {
                        visit_id: $('#editVisitModal #edit_visit_id').val()
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        if (data.status) {
                            fireMessage(data);

                            updateCalendarEvents(form.find('input[name="end"]').val());

                            form[0].reset();

                            $('#editVisitModal').modal('hide');
                        } else if (data.message) {
                            fireMessage(data);
                        }
                    },
                    failed: function () {
                        alert('Response error. Please try reload page');
                    }
                });
            });
        });
    </script>

    <script>
        $('.fc-left').append('<div class="calendars calendars-visit">\n' +
            '<input autocomplete="off" class="form-control" type="text" id="kt_datepicker_1" placeholder="@lang('allTranslate.Go_date')" >\n' +
            '</div>');
    </script>
    <script>

        function openCreateModal(args) {
            $('#createVisitModal').find('[name="start"]').val(args.start);
            $('#createVisitModal').find('[name="end"]').val(args.end);
            $('#createVisitModal').find('[name="doctor_id"]').val(args.doctor_id);

            $('#createVisitModal #createVisitModalTitle .font-weight-bold').text(
                moment(args.start).format('YYYY-MM-DD HH:mm') + '-' + moment(args.end).format('HH:mm')
            );

            $('#createVisitModal').modal({backdrop: 'static'}).modal('show');
        }

        function openEditModal(args) {
            $('#editVisitModal #editVisitModalTitle .font-weight-bold').text(
                moment(args.start).format('YYYY-MM-DD HH:mm') + '-' + moment(args.end).format('HH:mm')
            );
            $('#editVisitModal #edit_end').val(args.end.format());
            $('#editVisitModal #edit_patient').html(`<option value="">${args.title}</option>`).change();
            $('#editVisitModal #edit_status_id').val(args.visit_data.status_id).change();
            $('#editVisitModal #edit_phone').val(args.visit_data.phone);
            $('#editVisitModal #edit_birthday').val(args.visit_data.birthday);
            $('#editVisitModal #edit_complaints').val(args.visit_data.complaints);
            $('#editVisitModal #edit_service_id').html(`<option value="">${args.visit_data.service}</option>`).change();
            $('#editVisitModal #edit_visit_id').val(args.visit_data.visit_id);
            $('#open_visit').attr('href', '{{route('adminVisits')}}/' + args.id);
            $('#editVisitModal').modal('show');
        }

        $('#kt_datepicker_1').datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            language: "{{app()->getLocale()}}",
            isRTL: false,
            autoclose: true,
            format: "dd.mm.yyyy",
            endDate: moment().add('1', 'M').format('DD.MM.YYYY'),
            startDate: moment().subtract('2', 'M').format('DD.MM.YYYY'),
        }).on('changeDate', function (ev, e) {
            let datetime = new Date(ev.date.getTime());
            let unixtime = datetime.setDate(datetime.getDate() + 1);
            $('#calendar').fullCalendar('gotoDate', unixtime);
        });
    </script>
@endpush



@push('styles')
    <link href='{{asset('assetsnew/js/fullcalendar.css')}}' rel='stylesheet'>

    <style>
        .popup-class {
            background: #83ce6cbf !important;
            color: #fff !important;
        }

        .fc-time-grid .fc-slats td {
            height: 43px;
            border-bottom: 0;
        }

        .fc-time-grid-container {
            overflow: visible !important;
            height: auto !important;
        }

        .print-only {
            display: none;
        }


        @media print {

            .table-vcenter td, .table-vcenter th {
                border-right: 1px solid #c5cedb;
            }

            .border-top-1 {
                border-top: 1px solid rgba(0, 40, 100, 0.12) !important;

            }

            .table-vcenter td, .table-vcenter th {
                border-top: 1px solid #dee2e6;
                border-bottom: 1px solid #dee2e6;
            }

            .card-table tr:first-child td, .card-table tr:first-child th {
                border-top: 1px solid rgba(0, 40, 100, 0.12) !important;
            }

            .card-table tr td:first-child, .card-table tr th:first-child {
                border-left: 1px solid rgba(0, 40, 100, 0.12);
            }

            .card-table tr td:last-child, .card-table tr th:last-child {
                border-right: 1px solid rgba(0, 40, 100, 0.12);
            }

            .no-print {
                display: none !important;
            }

            .print-only {
                display: block !important;
            }
        }


        .doctor-info img {
            border-radius: 50%;
            width: 100%;
            max-width: 150px;
        }

        .doctor-info {
            margin-top: 10px;
        }

        .doctor-info div {
            border-radius: 50%;
        }

        .find-out {
            font-size: 15px;
        }

        .doctor-img {
            width: 100px;
            height: 100px;
            background-repeat: no-repeat !important;
            background-size: cover !important;
            background-position: center !important;
            margin: 0 auto;
        }

        .fc-right,
        .fc-center {
            display: flex !important;
            justify-content: center;
        }

        .schedule-cell-col {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            flex-wrap: nowrap;
            margin-bottom: 15px;

        }

        .example-cell {
            display: inline-block;
            /*width: 25px;*/
            /*height: 15px;*/
            /*margin-right: 10px;*/
            border: 1px solid #d6d6d6;
        }

        .example-cell span {
            opacity: .6;
            padding: 10px;
            color: #fff;
        }

        @media (max-width: 1024px) {
            .fc-unthemed .fc-toolbar .fc-center > .fc-button, .fc-unthemed .fc-toolbar .fc-left > .fc-button, .fc-unthemed .fc-toolbar .fc-right > .fc-button {
                float: left !important;
            }
        }

        @media (max-width: 768px) {
            .fc-unthemed .fc-toolbar .fc-center > .fc-button, .fc-unthemed .fc-toolbar .fc-left > .fc-button, .fc-unthemed .fc-toolbar .fc-right > .fc-button {
                float: none !important;
            }
        }

        @media (max-width: 1024px) {

            .fc-unthemed .fc-toolbar .fc-right {
                float: right !important;

            }
        }

        @media (max-width: 768px) {

            .fc-unthemed .fc-toolbar .fc-right {
                float: none !important;

            }
        }

        .fc-bgevent {
            opacity: .6;
        }

        .fc-state-default.fc-corner-left {
            border-top-left-radius: 0px;
            border-bottom-left-radius: 0px;
        }

        .fc-state-default.fc-corner-right {
            border-top-right-radius: 0px;
            border-bottom-right-radius: 0px;
        }

    </style>
@endpush