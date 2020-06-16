<div class="modal fade no-print" id="createVisitModal" tabindex="-1" role="dialog" aria-labelledby="createVisitModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createVisitModalTitle">@lang('allTranslate.Reception_recording') &nbsp; &nbsp; <span class="font-weight-bold"></span></h5>
                <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createVisitForm">
                    <div class="form-group">
                        <label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand mb-0">
                            <input type="checkbox" name="new-patient" class="new-patient">@lang('allTranslate.New_pacient')
                            <span></span>
                        </label>
                    </div>
                    <div class="form-group select_2-100 old-patient-b">
                        <label for="patient_id">@lang('allTranslate.Pacient') <span class="text-danger">*</span></label>
                        <div class="w-100">
                            <select name="patient_id" autocomplete="off" id="patient_id" class="form-control w-100 select_2_search">
                                @foreach($patients as $patient)
                                    <option data-phone="{{$patient->phone}}" value="{{$patient->id}}">{{$patient->first_name}} {{$patient->name}} {{$patient->last_name}} {{$patient->birthday}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="row d-none new-patient-b">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="first_name">@lang('allTranslate.last_name')<span class="text-danger">*</span></label>
                                <input type="text" class="form-control " name="first_name" id="first_name" placeholder="@lang('allTranslate.Enter_last_name')">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">@lang('allTranslate.first_name')<span class="text-danger">*</span></label>
                                <input type="text" class="form-control " name="name" id="name" placeholder="@lang('allTranslate.Enter_first_name')">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="last_name">@lang('allTranslate.Surname')<span class="text-danger">*</span></label>
                                <input type="text" class="form-control " name="last_name" id="last_name" placeholder="@lang('allTranslate.Enter_surname')">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="phone">@lang('allTranslate.phone-number') <span class="text-danger">*</span></label>
                                <input type="text" class="form-control phone-mask" name="phone" id="phone" placeholder="@lang('allTranslate.Enter-phone-number')">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group select_2-100">
                                <label for="find-out">@lang('allTranslate.Where_find_us')<span class="text-danger">*</span></label>
                                <div class="w-100">
                                    <select name="where_id" id="find-out" class="form-control doctor w-100 select_2">
                                        <option value="" selected>@lang('allTranslate.Select_option')</option>
                                        @foreach($wheres as $where)
                                            <option value="{{$where->id}}">{{$where->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="birth">@lang('allTranslate.enter_date_birth')<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" autocomplete="off" name="birthday" id="birthday">
                                <span class="form-text text-muted">@lang('allTranslate.Date_format'): <code>05.02.2020</code></span>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand mb-0">
                                    <input type="checkbox" name="new-children" class="new-children">@lang('allTranslate.Add_family_member')
                                    <span></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group select_2-100">
                                <label for="service">@lang('allTranslate.Scheduled_services') <span class="text-danger">*</span></label>
                                <select name="service_id" id="service" class="form-control doctor w-100 select_2">
                                    <option value="" selected>@lang('allTranslate.Select_service')</option>
                                    @foreach($services as $service)
                                        <option value="{{$service->id}}">{{$service->name}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="start">
                    <input type="hidden" name="end">
                    <input type="hidden" name="doctor_id">
                    <div class="form-group">
                        <label for="complaints">@lang('allTranslate.comment')</label>
                        <textarea type="text" class="form-control" name="complaints" id="complaints" placeholder="@lang('allTranslate.Enter_comment')"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end d-flex">
                <a href="javascript:void(0)" class="btn btn-secondary btn-elevate btn-icon-sm close-modal" data-dismiss="modal"><i class="fa fa-window-close"></i> <span class="d-m-n">@lang('allTranslate.cancel_btn')</span></a>
                &nbsp;
                <button type="submit" form="createVisitForm" class="btn btn-brand btn-elevate btn-icon-sm"><i class="fa fa-save"></i> <span class="d-m-n">@lang('allTranslate.Save')</span></button>
            </div>
        </div>
    </div>
</div>