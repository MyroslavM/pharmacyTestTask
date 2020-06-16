@extends('admin::main')

@section('title', trans("allTranslate.editing_patient"))
@section('breadCrumb', Breadcrumbs::render('visitPatient',$item))

@section('content')

    <div class="kt-portlet kt-portlet--tabs">

        @include('adminPatient::include/nav-menu')

        <div class="tab-pane " id="kt_user_edit_tab_4" role="tabpanel">
            <form class="form043">
                {{--@csrf--}}
                <div class="kt-portlet__body" id="printEpicriz">
                    <div class="row">
                        <div class="col-12 col-xl-9">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="text-center mb-4">МЕДИЧНА КАРТА СТОМАТОЛОГІЧНОГО ХВОРОГО № {{ $item->card_name }}</h2>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                    <div class="form-group">
                                        <label>ПІБ</label>
                                        <input type="text" class="form-control" name="fio" value="{{ $item->fullName() }}" disabled placeholder="ПІБ">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                    <div class="form-group">
                                        <label>Стать</label>
                                        <input type="text" class="form-control" name="gender" value="{{ $item->gender == 0 ? 'Мужчина' : 'Женщина' }}" disabled placeholder="Стать">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                    <div class="form-group">
                                        <label>Дата народження</label>
                                        <input type="text" class="form-control" name="birthday" value="{{ \Carbon\Carbon::parse($item->birthday)->format('d.m.Y') }}" disabled placeholder="Дата народження">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                    <div class="form-group">
                                        <label>Адреса, телефон</label>
                                        <input type="text" class="form-control" name="address" value="@if ($item->address) {{ $item->address }}, {{ $item->phone }} @else {{ $item->phone }} @endif" disabled placeholder="Адреса, телефон">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-12 ">
                                    <div class="form-group d-flex flex-column">
                                        <label for="diagnose">Діагноз</label>
                                        <textarea name="diagnose" id="diagnose" cols="3" rows="3">{{ $form043 ? $form043->diagnose : null }}</textarea>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-12 ">
                                    <div class="form-group d-flex flex-column">
                                        <label for="complaint">Скарги</label>
                                        <textarea name="complaint" id="complaint" cols="3" rows="3">{{ $form043 ? $form043->complaint : null }}</textarea>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-12 ">
                                    <div class="form-group d-flex flex-column">
                                        <label for="transferred_diseases">Перенесені та супутні захворювання</label>
                                        <textarea name="transferred_diseases" id="transferred_diseases" cols="3" rows="3">{{ $form043 ? $form043->transferred_diseases : null }}</textarea>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-12 ">
                                    <div class="form-group d-flex flex-column">
                                        <label for="current_disease">Розвиток теперішнього захворювання</label>
                                        <textarea name="current_disease" id="current_disease" cols="3" rows="3">{{ $form043 ? $form043->current_disease : null }}</textarea>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-12 ">
                                    <hr>
                                </div>
                                <div class="col-12 ">
                                    <div class="form-group d-flex flex-column">
                                        <label for="research_data">Дані обєктивного дослідження, зовнішній огляд, стан зубів:</label>
                                        <textarea name="research_data" id="research_data" cols="3" rows="3">{{ $form043 ? $form043->research_data : null }}</textarea>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-12 ">
                                    <div class="table-responsive">
                                        <table class="table-form043 table">
                                            <tbody>
                                            @for($i = 1; $i < 9; $i++)
                                                <tr>
                                                    @for($n = 0; $n < 17; $n++)
                                                        <th class="date_input"><input name="data[{{ $i.$n }}]" value="{{ isset($data['data']) && array_key_exists($i.$n, $data['data']) ? $data['data'][$i.$n] : null }}" @if($n === 0) class="kt_datepicker_1" @endif type="text"></th>
                                                    @endfor
                                                </tr>
                                                @if($i == 4)
                                                    <tr>
                                                        <th>Дата оглядів</th>
                                                        <th>8</th>
                                                        <th>7</th>
                                                        <th>6</th>
                                                        <th>5(V)</th>

                                                        <th>4(IV)</th>
                                                        <th>3(III)</th>
                                                        <th>2(II)</th>
                                                        <th>1(I)</th>
                                                        <th>1(I)</th>

                                                        <th>2(II)</th>
                                                        <th>3(III)</th>
                                                        <th>4(IV)</th>
                                                        <th>5(V)</th>
                                                        <th>6</th>

                                                        <th>7</th>
                                                        <th>8</th>
                                                    </tr>
                                                @endif
                                            @endfor
                                            </tbody>
                                        </table>
                                        <div>
                                            <h3 class="text-center">Умовні позначення</h3>
                                            <p>
                                                С-карієс, P-пульпіт, Pt- періодонтит, Lp- локалізований пародонтит, Gp-генералізований пародонтит, R-корінь, A-відсутній, Cd-корона,
                                                PI-пломба, F- фасетка, ar - штучний зуб, r - реставрація, H- гемісекція, Am-ампутація, res-резекція, pin- штифт, i- імплантація,
                                                Rp- реплантація, Dc-зубний камінь.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 ">
                                    <hr>
                                </div>
                                <div class="col-12">
                                    <h2 class="text-center">Щоденник лікаря</h2>
                                    <div class="table-responsive">
                                        <table class="table-form043-diary table ">
                                            <tbody>
                                            <tr class="doctor_diary_tr">
                                                <th>Дата</th>
                                                <th>Анамнез, статус, діагноз, лікування, рекомендації</th>
                                            </tr>
                                            @for($i = 0; $i < 22; $i++)
                                                <tr class="doctor_diary_tr">
                                                    <th><input name="date_journal[{{ $i }}]" autocomplete="off" type="text" class="kt_datepicker_1" value="{{ isset($data['date_journal']) && array_key_exists($i, $data['text_journal']) ? $data['date_journal'][$i] : null }}"/></th>
                                                    <th><input name="text_journal[{{ $i }}]" autocomplete="off" type="text" value="{{ isset($data['text_journal']) && array_key_exists($i, $data['text_journal']) ? $data['text_journal'][$i] : null }}"></th>
                                                </tr>
                                            @endfor
                                            </tbody>
                                        </table>

                                        {{--<div>Вставка Епікризу з іншої вкладки</div>--}}
                                    </div>
                                </div>
                                <div class="col-12 ">
                                    <hr>
                                </div>
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table cellpadding="2" class="table-form043-plan table ">
                                            <tbody>
                                            <tr>
                                                <th colspan="1">План обстеження</th>
                                                <th colspan="1">План лікування</th>
                                            </tr>
                                            @for($i = 0; $i < 22; $i++)
                                                <tr>
                                                    <th><input name="examination[{{ $i }}]" type="text" value="{{ isset($data['examination']) && array_key_exists($i, $data['examination']) ? $data['examination'][$i] : null }}"></th>
                                                    <th><input name="treatment[{{ $i }}]" type="text" value="{{ isset($data['treatment']) && array_key_exists($i, $data['treatment']) ? $data['treatment'][$i] : null }}"></th>
                                                </tr>
                                            @endfor
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-portlet__head-actions justify-content-end d-flex">
                        <a onclick="printJS({
                                printable: 'printEpicriz',
                                css: [
                                '{{asset("assets/css/print.css")}}',
                                '{{asset("assets/css/style.bundle.css")}}',
                                ],
                                type: 'html'
                                })" class="btn btn-secondary btn-elevate btn-icon-sm"><i class="fa fa-print"></i> <span class="d-m-n">Печатать</span></a>
                        &nbsp;
                        <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm"><i class="fa fa-save"></i> <span class="d-m-n">@lang('allTranslate.Save')</span></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    {{--form 043 style--}}
    <style>
        .table-form043 tr th {
            /*width: auto;*/
        }
        .table-form043 tr th:first-child {
            /*width: 20%!important;*/
        }
        .table-form043 tr th:first-child input {
            width: 100%;
            max-width: 100%;
        }
        .table th, .table td {
            padding: 5px;
            vertical-align: top;
            border-top: 1px solid #ebedf2;
        }
        .table-form043 {
            border: 1px solid #000;
            width: 100%;
            max-width: 100%;
            text-align: center;
        }

        .table-form043 input {
            max-width: 40px;
        }

        .table-form043 tr {
            width: 100%;
        }

        .table-form043 tr:nth-child(2n) {
            background: #e2e1e1;
        }

        .table-form043 tr:first-child th {
            border-top: 1px solid #000;

        }

        .table-form043 th {
            border-right: 1px solid #000;
            border-bottom: 1px solid #000;
            width: inherit;
        }

        .table-form043 th:last-child {
            border-right: 0px;
            width: inherit;
        }

        .table-form043 tr:last-child th {
            border-bottom: 0px;
            width: inherit;
        }

        .table-form043-diary {
            border: 1px solid #000;
            width: 100%;
            max-width: 100%;
            text-align: center;
        }

        .table-form043-diary tr:first-child th {
            border-top: 1px solid #000;

        }

        .table-form043-diary th {
            border-right: 1px solid #000;
            border-bottom: 1px solid #000;
            width: inherit;
        }

        .table-form043-diary tr {
            width: 100%;
        }

        .table-form043-diary th:last-child {
            border-right: 0px;
            width: inherit;
        }

        .table-form043-diary tr:last-child th {
            border-bottom: 0px;
            width: inherit;
        }

        .table-form043-diary tr th:first-child {
            width: 20% !important;
        }

        .table-form043-diary th input {
            width: 100%;
        }


        .table-form043-plan tbody {
            width: 100% !important;

        }

        .table-form043-plan tr:first-child th {
            border-top: 1px solid #000;

        }

        .table-form043-plan {
            border: 1px solid #000;
            width: 100%;
            max-width: 100%;
            text-align: center;
        }

        .table-form043-plan tr th {
            border-right: 1px solid #000;
            border-bottom: 1px solid #000;
            width: 50% !important;

        }

        .table-form043-plan tr {
            width: 100% !important;
        }

        .table-form043-plan tr th input {
            width: 100%;
        }

        .table-form043-plan th:last-child {
            border-right: 0px;
            width: inherit;
        }

        .table-form043-plan tr:last-child th {
            border-bottom: 0px;
            width: inherit;
        }
    </style>
    {{-- endform 043 style--}}

    <link rel="stylesheet" type="text/css" href="https://printjs-4de6.kxcdn.com/print.min.css"/>
    <script type="text/javascript" src="https://printjs-4de6.kxcdn.com/print.min.js"></script>

    <script>

        $('.kt_datepicker_1').datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            language: "{{app()->getLocale()}}",
            isRTL: false,
            autoclose: true,
            format: "dd.mm.yyyy",
        });

        $(document).ready(function () {
            new SaveTrait({selector: 'form.form043', enableButtonOnSuccess: false});
        });
    </script>
    <script>
        $(document).ready(function () {
            new SaveTrait({selector: 'form.card', enableButtonOnSuccess: true})
                .setAdditionalData(function (data) {
                    data.append('comment', $('#hello').val());
                    return data;
                });
        });
    </script>
@endpush