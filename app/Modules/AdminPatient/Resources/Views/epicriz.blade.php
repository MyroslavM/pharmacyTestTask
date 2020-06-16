@extends('admin::main')

@section('title', trans("allTranslate.editing_patient"))
@section('breadCrumb', Breadcrumbs::render('epicrizPatient',$item))

@section('content')

    <div class="kt-portlet kt-portlet--tabs">

        @include('adminPatient::include/nav-menu')

        <div class="tab-content">
            <div class="">
                <form class="formEpikriz">
                    {{--@csrf--}}
                    <div class="kt-portlet__body" id="printEpicriz">
                        <div class="row">
                            <div class="col-12 col-xl-9">
                                <div class="row">
                                    <div class="col-12">
                                        <h2 class="text-center mb-4">ЕПІКРИЗ ХВОРОГО № {{ $item->card_name }}</h2>
                                    </div>

                                    <div class="col-12">
                                        <div class="table-responsive">
                                            
                                            <table class="table-form043-diary table ">
                                                <tbody>
                                                <tr class="doctor_diary_tr">
                                                    <th>Дата</th>
                                                    <th>Анамнез, статус, діагноз, лікування, рекомендації</th>
                                                </tr>
                                                @for($i = 0; $i < 22; $i++)
                                                    <tr class="doctor_diary_tr">
                                                        <th><input name="date_epicriz[{{ $i }}]" autocomplete="off" type="text" class="kt_datepicker_1" value="{{ isset($data['date_epicriz']) && array_key_exists($i, $data['date_epicriz']) ? $data['date_epicriz'][$i] : null }}"/></th>
                                                        <th><input name="text_epicriz[{{ $i }}]" autocomplete="off" type="text" value="{{ isset($data['text_epicriz']) && array_key_exists($i, $data['text_epicriz']) ? $data['text_epicriz'][$i] : null }}"></th>
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
    </div>



@endsection


@push('scripts')
    {{--form 043 style--}}
    <style>
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

    <script>
        $('.kt_datepicker_1').datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            language: "{{app()->getLocale()}}",
            isRTL: false,
            autoclose: true,
            format: "dd.mm.yyyy",
        });
    </script>

    <script>

        $(document).ready(function () {
            new SaveTrait({selector: 'form.formEpikriz', enableButtonOnSuccess: false});
        });
    </script>

    <link rel="stylesheet" type="text/css" href="https://printjs-4de6.kxcdn.com/print.min.css"/>
    <script type="text/javascript" src="https://printjs-4de6.kxcdn.com/print.min.js"></script>

    <script>


        function CallPrint() {
            var divToPrint = document.getElementById('printEpicriz');
            var printCss = '<link href="{{asset("assets/css/print.css")}}" rel="stylesheet" type="text/css"/> <link href="{{asset("assets/css/style.bundle.css")}}" rel="stylesheet" type="text/css"/>'
            newWin = window.open("about:blank", '', 'left=50,top=50,width=900,height=700,toolbar=0,scrollbars=1,status=0');
            newWin.document.write(printCss);
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            // newWin.close();
        }
    </script>
@endpush