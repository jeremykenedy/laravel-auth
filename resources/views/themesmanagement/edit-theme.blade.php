@extends('layouts.app')

@section('template_title')
  	Theme {{ $theme->name }}
@endsection

@section('template_fastload_css')

@endsection

@php

    $themeActive = [
		'checked' => '',
		'value' => 0,
		'true'	=> '',
		'false'	=> 'checked'
    ];

    if($theme->status == 1) {
        $themeActive = [
        	'checked' => 'checked',
        	'value' => 1,
			'true'	=> 'checked',
			'false'	=> ''
        ];
    }

@endphp


@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">

						<strong>{{ trans('themes.editTitle') }}</strong> {{ $theme->name }}

						<a href="/themes/{{$theme->id}}" class="btn btn-primary btn-xs pull-right" style="margin-left: 1em;">
						  	<i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
						 	Back  <span class="hidden-xs">to Theme</span>
						</a>

						<a href="/themes" class="btn btn-info btn-xs pull-right">
							<i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
							<span class="hidden-xs">Back to </span>Themes
						</a>

					</div>

					{!! Form::model($theme, array('action' => array('ThemesManagementController@update', $theme->id), 'method' => 'PUT')) !!}

						{!! csrf_field() !!}

						<div class="panel-body">

							<div class="form-group has-feedback row {{ $errors->has('status') ? ' has-error ' : '' }} @if($theme->id == 1) disabled @endif ">
								{!! Form::label('status', trans('themes.statusLabel'), array('class' => 'col-md-3 control-label')); !!}
								<div class="col-md-9">
									<label class="switch {{ $themeActive['checked'] }}" for="status">
										<span class="active"><i class="fa fa-toggle-on fa-2x"></i> {{ trans('themes.statusEnabled') }}</span>
										<span class="inactive"><i class="fa fa-toggle-on fa-2x fa-rotate-180"></i> {{ trans('themes.statusDisabled') }}</span>
										<input type="radio" name="status" value="1" {{ $themeActive['true'] }}>
										<input type="radio" name="status" value="0" {{ $themeActive['false'] }}>
									</label>

									@if ($errors->has('status'))
										<span class="help-block">
											<strong>{{ $errors->first('status') }}</strong>
										</span>
									@endif
								</div>
							</div>

						  	<div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
							    {!! Form::label('name', trans('themes.nameLabel') , array('class' => 'col-md-3 control-label')); !!}
							    <div class="col-md-9">
							      	<div class="input-group">
							        	{!! Form::text('name', old('name'), array('id' => 'name', 'class' => 'form-control', 'placeholder' => trans('themes.namePlaceholder'))) !!}
							        	<label class="input-group-addon" for="name"><i class="fa fa-fw fa-pencil }}" aria-hidden="true"></i></label>
							      	</div>
									@if ($errors->has('name'))
										<span class="help-block">
											<strong>{{ $errors->first('name') }}</strong>
										</span>
									@endif
							    </div>
						  	</div>

						  	<div class="form-group has-feedback row {{ $errors->has('link') ? ' has-error ' : '' }}">
							    {!! Form::label('link', trans('themes.linkLabel') , array('class' => 'col-md-3 control-label')); !!}
							    <div class="col-md-9">
							      	<div class="input-group">
							        	{!! Form::text('link', old('link'), array('id' => 'link', 'class' => 'form-control', 'placeholder' => trans('themes.linkPlaceholder'))) !!}
							        	<label class="input-group-addon" for="link"><i class="fa fa-fw fa-link fa-rotate-90 }}" aria-hidden="true"></i></label>
							      	</div>
									@if ($errors->has('link'))
										<span class="help-block">
											<strong>{{ $errors->first('link') }}</strong>
										</span>
									@endif
							    </div>
						  	</div>

						  	<div class="form-group has-feedback row {{ $errors->has('notes') ? ' has-error ' : '' }}">
							    {!! Form::label('notes', trans('themes.notesLabel') , array('class' => 'col-md-3 control-label')); !!}
							    <div class="col-md-9">
							      	<div class="input-group">
							        	{!! Form::textarea('notes', old('notes'), array('id' => 'notes', 'class' => 'form-control', 'placeholder' => trans('themes.notesPlaceholder'))) !!}
							        	<label class="input-group-addon" for="notes"><i class="fa fa-fw fa-pencil }}" aria-hidden="true"></i></label>
							      	</div>
									@if ($errors->has('notes'))
										<span class="help-block">
											<strong>{{ $errors->first('notes') }}</strong>
										</span>
									@endif
							    </div>
						  	</div>

						</div>
						<div class="panel-footer">

						  <div class="row">

						    <div class="col-xs-6">
						      {!! Form::button('<i class="fa fa-fw fa-save" aria-hidden="true"></i>' . trans('themes.editSave'), array('class' => 'btn btn-success btn-block margin-bottom-1 btn-save','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmSave', 'data-title' => Lang::get('modals.edit_user__modal_text_confirm_title'), 'data-message' => Lang::get('modals.edit_user__modal_text_confirm_message'))) !!}
						    </div>
						  </div>
						</div>

					{!! Form::close() !!}

				</div>
			</div>
		</div>
	</div>

	@include('modals.modal-save')
	@include('modals.modal-delete')

@endsection

@section('footer_scripts')

	@include('scripts.delete-modal-script')
	@include('scripts.save-modal-script')
	@include('scripts.check-changed')
	@include('scripts.toggleStatus')

@endsection