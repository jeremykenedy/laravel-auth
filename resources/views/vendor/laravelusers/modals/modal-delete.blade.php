<div class="modal fade modal-danger" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    {!! trans('laravelusers::modals.delete_user_title') !!}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">close</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    {!! trans('laravelusers::modals.delete_user_message') !!}
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light pull-left" data-dismiss="modal">
                    {!! trans('laravelusers::modals.delete_user_btn_cancel') !!}
                </button>
                <button type="button" class="btn btn-danger pull-right btn-flat" id="confirm">
                    {!! trans('laravelusers::modals.delete_user_btn_confirm') !!}
                </button>
            </div>
        </div>
    </div>
</div>
