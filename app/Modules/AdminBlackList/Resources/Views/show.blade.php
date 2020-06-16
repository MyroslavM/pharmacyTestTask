@extends('admin::main')

@section('content')
    <div class="my-3 my-md-5">
        <div class="container">
            <div class="page-header">
                <h4 class="page-title">Чорний список</h4>
                {{ Breadcrumbs::render('adminBlackList') }}
            </div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="page-title">Список пацієнтів</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="table-responsive">
                                    <table id="users-table" class="table table-hover table-striped table-bordered" style="width:100%"></table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="page-title">Пацієнти в чорному списку</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="table-responsive">
                                    <table id="blacklist-table" class="table table-hover table-striped table-bordered" style="width:100%"></table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('modals')
    <div class="modal fade" id="ModalBlackList" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="forma" action="{{route('addBlackList')}}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Додати пацієнта до чорного списку?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Причина</label>
                            <input name="comment" class="form-control" data-id="" id="hello" type="text" placeholder="Введіть причину">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Відміна</button>
                        <button type="button" class="btn btn-primary btn-sm form-send">Додати</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush

@push('scripts')
    <link rel="stylesheet" type="text/css" href="{{asset('assetsnew/js/datatables.min.css')}}"/>
    <script type="text/javascript" src="{{asset('assetsnew/js/datatables.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            new SaveTrait({
                selector: '.form-send',
                selectorType: 'click',
                formSelector: '.forma',
                button: '.form-send',
                clearFormOnSuccess: true,
                showSuccessToast: true,
            }).setAdditionalData(function (data) {
                data.append('patient_id', $('#hello').data('id'))
                return data;
            }).setAdditionalSuccessCallback(function (data) {
                $('#ModalBlackList').modal('hide');
            });
        });
    </script>
    <script>
        let tableLang = {
            "sProcessing":   "Зачекайте...",
            "sLengthMenu":   "Показати _MENU_ записів",
            "sZeroRecords":  "Записи відсутні.",
            "sInfo":         "Записи з _START_ по _END_ із _TOTAL_ записів",
            "sInfoEmpty":    "Записи з 0 по 0 із 0 записів",
            "sInfoFiltered": "(відфільтровано з _MAX_ записів)",
            "sInfoPostFix":  "",
            "sSearch":       "Пошук:",
            "sUrl":          "",
            "oPaginate": {
                "sFirst": "Перша",
                "sPrevious": "Попередня",
                "sNext": "Наступна",
                "sLast": "Остання"
            },
            "oAria": {
                "sSortAscending":  ": активувати для сортування стовпців за зростанням",
                "sSortDescending": ": активувати для сортування стовпців за спаданням"
            }
        };

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#users-table').on('click', '#dle-clk', function (event) {
                $('#hello').data('id', $(this).data('id'));
                event.preventDefault();
                $('#ModalBlackList').modal('show');
            });
            let blacklist = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('adminUsersTable')}}',
                language: tableLang,
                columnDefs: [
                    {
                        targets: [1],
                        className: 'dt-body-center',
                    }
                ],
                columns: [
                    {data: 'id', 'title': '#'},
                    {data: 'name', 'title': 'ПІБ'},
                    {data: 'created_at', 'title': 'День народження'},
                    {data: 'updated_at', 'title': ''},
                ],
                "order": [[0, "desc"]],
            });

            let news = $('#blacklist-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('adminBlackListTable')}}',
                language: tableLang,
                columnDefs: [
                    {
                        targets: [1],
                        className: 'dt-body-center',
                    }
                ],
                columns: [
                    {data: 'id', 'title': '#'},
                    {data: 'name', 'title': 'ПІБ'},
                    {data: 'comment', 'title': 'Коментар'},
                    {data: 'created_at', 'title': 'День народження'},
                    {data: 'updated_at', 'title': ''},
                ],
                "order": [[0, "desc"]],
            });
        });

    </script>
@endpush