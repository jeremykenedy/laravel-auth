<div class="modal fade" id="confirmForm" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">
          {{ trans('modals.form_modal_default_title') }}
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <p>
          {{ trans('modals.form_modal_default_message') }}
        </p>
      </div>
      <div class="modal-footer">
        {{ html()->button('<i class="fa fa-fw fa-close" aria-hidden="true"></i> ' . trans('modals.form_modal_default_btn_cancel'))
            ->class('btn btn-secondary')
            ->type('button')
            ->attribute('data-dismiss', 'modal') }}
        {{ html()->button('<i class="fa fa-fw fa-check" aria-hidden="true"></i> ' . trans('modals.form_modal_default_btn_submit'))
            ->class('btn btn-primary')
            ->type('button')
            ->id('confirm') }}
      </div>
    </div>
  </div>
</div>
