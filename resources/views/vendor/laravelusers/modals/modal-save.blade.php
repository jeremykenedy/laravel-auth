<div class="modal fade modal-success modal-save" id="confirmSave" role="dialog" aria-labelledby="confirmSaveLabel" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    {!! trans('laravelusers::modals.edit_user__modal_text_confirm_title') !!}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">close</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    {!! trans('laravelusers::modals.confirm_modal_title_text') !!}
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left btn-flat" data-dismiss="modal">
                    <i class="fa fa-fw {{ trans('laravelusers::modals.confirm_modal_button_cancel_icon') }}" aria-hidden="true"></i>
                    {!! trans('laravelusers::modals.confirm_modal_button_cancel_text') !!}
                </button>
                <button type="button" class="btn btn-success pull-right btn-flat" id="confirm">
                    <i class="fa fa-fw {{ trans('laravelusers::modals.confirm_modal_button_save_icon') }}" aria-hidden="true"></i>
                    {!! trans('laravelusers::modals.confirm_modal_button_save_text') !!}
                </button>
            </div>
        </div>
    </div>
</div>
