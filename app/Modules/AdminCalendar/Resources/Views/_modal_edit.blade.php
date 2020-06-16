<div class="modal fade no-print" id="editVisitModal" tabindex="-1" role="dialog" aria-labelledby="editVisitModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editVisitModalTitle">@lang('allTranslate.Reception_recording') &nbsp;<span class="font-weight-bold edit-modal-long"></span></h5>
                <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editVisitForm">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group old-patient-b">
                                <label for="edit_patient">@lang('allTranslate.Pacient')</label>
                                <select name="edit_patient" disabled="disabled" id="edit_patient" class="form-control ">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="edit_phone">@lang('allTranslate.phone-number')</label>
                                <input type="text" disabled="disabled" class="form-control phone-mask" id="edit_phone">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="birth">@lang('allTranslate.date_birth')</label>
                                <input type="text" disabled="disabled" class="form-control" id="edit_birthday" placeholder="@lang('allTranslate.date_birth') ">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group select_2-100">
                                <label for="edit_service_id">@lang('allTranslate.scheduled_services')<span class="text-danger">*</span></label>
                                <select class="custom-select select_2" disabled="disabled" name="edit_service_id" id="edit_service_id">
                                    <option value="" selected>@lang('allTranslate.select_service')</option>
                                    @foreach($services as $service)
                                        <option value="{{$service->id}}">{{$service->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group select_2-100">
                                <label for="edit_status_id">@lang('allTranslate.visit_status')</label>
                                <select class="select_2 form-control w-100" name="status_id" id="edit_status_id">
                                    @foreach($statuses as $status)
                                        <option value="{{$status->id}}">{{$status->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="text-white">-</label>
                                <button type="submit" form="editVisitForm" class="btn btn-primary w-100">@lang('allTranslate.change_status')</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit_complaints">@lang('allTranslate.comment')</label>
                        <textarea type="text" class="form-control" name="edit_complaints" disabled="disabled" id="edit_complaints" placeholder="@lang('allTranslate.Enter_comment')"></textarea>
                    </div>
                    <input type="hidden" name="visit_id" id="edit_visit_id">
                    <input type="hidden" name="end" id="edit_end">
                </form>
            </div>
            <div class="modal-footer">
                <a id="open_visit" href="" class="btn btn-primary btn-elevate btn-icon-sm mr-auto"><i class="kt-menu__link-icon fa fa-calendar-check"></i>@lang('allTranslate.open_visit')</a>


                <a href="javascript:void(0)" class="btn btn-secondary btn-elevate btn-icon-sm close-modal" data-dismiss="modal"><i class="fa fa-window-close"></i> @lang('allTranslate.cancel_btn')</a>
                &nbsp;
                <button id="delete_visit" class="btn btn-danger btn-elevate btn-icon-sm"><i class="fa fa-trash"></i>@lang('allTranslate.cancel_visit')</button>
            </div>
        </div>
    </div>
</div>