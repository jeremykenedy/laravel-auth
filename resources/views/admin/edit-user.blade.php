@extends('app')

@section('template_title')
	Showing User {{ $user->name }}
@endsection

@section('template_fastload_css')
@endsection

@section('content')
	 <div class="content-wrapper">
	    <section class="content-header">

	    	<h1>
	    		Edit {{ $user->name }}
	    	</h1>

	    </section>
	    <section class="content">

{{-- 			@include('admin.modules.profile-image-box-w-bg')

			@include('admin.forms.edit-user-admin') --}}

{!! Form::model($user, array('action' => array('UsersManagementController@update', $user->id), 'method' => 'PUT')) !!}

	{!! csrf_field() !!}

	<div class="box box-primary">

		<div class="box-body">

@if (session('status'))
	<div class="alert alert-success alert-dismissable flat">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<h4><i class="icon fa fa-check"></i> Success</h4>
		{{ session('status') }}
	</div>
@endif

@if (session('anError'))
	<div class="alert alert-danger alert-dismissable flat">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<h4>
			<i class="icon fa fa-warning"></i>
			Success
		</h4>
		{{ session('anError') }}
	</div>
@endif

@if (count($errors) > 0)
	<div class="alert alert-danger alert-dismissable flat">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<h4>
			<i class="icon fa fa-warning"></i>
			<strong>{{ Lang::get('auth.whoops') }}</strong> {{ Lang::get('auth.someProblems') }}
		</h4>
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif

			<div class="form-group has-feedback">
				{!! Form::label('name', Lang::get('forms.label-username') , array('class' => 'col-lg-3 control-label margin-bottom-half')); !!}
				<div class="col-lg-9">
	              	<div class="input-group">
	                	{!! Form::text('name', old('name'), array('id' => 'name', 'class' => 'form-control', 'placeholder' => Lang::get('forms.ph-username'))) !!}
	                	<label class="input-group-addon" for="name"><i class="fa fa-fw {{ Lang::get('forms.username-icon') }}" aria-hidden="true"></i></label>
	              	</div>
				</div>
			</div>
			<div class="form-group has-feedback">
				{!! Form::label('email', Lang::get('forms.label-useremail') , array('class' => 'col-lg-3 control-label margin-bottom-half')); !!}
				<div class="col-lg-9">
	              	<div class="input-group">
	                	{!! Form::text('email', old('email'), array('id' => 'email', 'class' => 'form-control', 'placeholder' => Lang::get('forms.ph-useremail'))) !!}
	                	<label class="input-group-addon" for="email"><i class="fa fa-fw {{ Lang::get('forms.useremail-icon') }} " aria-hidden="true"></i></label>
	              	</div>
				</div>
			</div>

			<div class="form-group has-feedback">
				{!! Form::label('role_id', Lang::get('forms.label-userrole_id') , array('class' => 'col-lg-3 control-label margin-bottom-half')); !!}
				<div class="col-lg-12">
	              		{!! Form::select('role_id', array('0' => Lang::get('forms.option-label'), '1' => Lang::get('forms.option-user'), '2' => Lang::get('forms.option-editor'), '3' => Lang::get('forms.option-admin')), $access, array('class' => 'form-control')) !!}
				</div>
			</div>

			<div class="form-group has-feedback">
				{!! Form::label('first_name', Lang::get('forms.create_user_label_firstname'), array('class' => 'col-md-3 control-label margin-bottom-half')); !!}
				<div class="col-lg-9">
			      	<div class="input-group">
			       	 	{!! Form::text('first_name', NULL, array('id' => 'first_name', 'class' => 'form-control', 'placeholder' => Lang::get('forms.create_user_ph_firstname'))) !!}
			        	<label class="input-group-addon" for="first_name"><i class="fa fa-fw {{ Lang::get('forms.create_user_icon_firstname') }}" aria-hidden="true"></i></label>
			      	</div>
				</div>
			</div>

			<div class="form-group has-feedback">
				{!! Form::label('last_name', Lang::get('forms.create_user_label_lastname'), array('class' => 'col-md-3 control-label margin-bottom-half')); !!}
				<div class="col-lg-9">
			      	<div class="input-group">
			       	 	{!! Form::text('last_name', NULL, array('id' => 'last_name', 'class' => 'form-control', 'placeholder' => Lang::get('forms.create_user_ph_lastname'))) !!}
			        	<label class="input-group-addon" for="last_name"><i class="fa fa-fw {{ Lang::get('forms.create_user_icon_lastname') }}" aria-hidden="true"></i></label>
			      	</div>
				</div>
			</div>

		</div>

		<div class="box-footer">
			{!! Form::button('<i class="fa fa-fw '.Lang::get('forms.submit-btn-icon').'" aria-hidden="true"></i> '.Lang::get('forms.submit-btn-text'), array('class' => 'btn btn-primary btn-lg btn-block margin-bottom-1','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmSave', 'data-title' => Lang::get('modals.edit_user__modal_text_confirm_btn'), 'data-message' => Lang::get('modals.edit_user__modal_text_confirm_message'))) !!}
		</div>

	</div>

{!! Form::close() !!}


	    </section>
	</div>

	<div class="modal fade modal-primary" id="confirmSave" role="dialog" aria-labelledby="confirmSaveLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"> {{ Lang::get('modals.confirm_modal_title_text') }} </h4>
				</div>
				<div class="modal-body">
					<p>{{ Lang::get('modals.confirm_modal_title_std_msg') }}</p>
				</div>
				<div class="modal-footer">
					{!! Form::button('<i class="fa fa-fw '.Lang::get('modals.confirm_modal_button_cancel_icon').'" aria-hidden="true"></i> ' . Lang::get('modals.confirm_modal_button_cancel_text'), array('class' => 'btn btn-outline pull-left btn-flat', 'type' => 'button', 'data-dismiss' => 'modal' )) !!}
					{!! Form::button('<i class="fa fa-fw '.Lang::get('modals.confirm_modal_button_save_icon').'" aria-hidden="true"></i> ' . Lang::get('modals.confirm_modal_button_save_text'), array('class' => 'btn btn-outline pull-right btn-flat', 'type' => 'button', 'id' => 'confirm' )) !!}
				</div>
			</div>
		</div>
	</div>

@endsection

@section('template_scripts')

	<script type="text/javascript">

		// CONFIRMATION SAVE MODEL
		$('#confirmSave').on('show.bs.modal', function (e) {
			var message = $(e.relatedTarget).attr('data-message');
			var title = $(e.relatedTarget).attr('data-title');
			var form = $(e.relatedTarget).closest('form');
			$(this).find('.modal-body p').text(message);
			$(this).find('.modal-title').text(title);
			$(this).find('.modal-footer #confirm').data('form', form);
		});
		$('#confirmSave').find('.modal-footer #confirm').on('click', function(){
		  	$(this).data('form').submit();
		});

		// CONFIRMATION DELETE MODAL
		$('#confirmDelete').on('show.bs.modal', function (e) {
			var message = $(e.relatedTarget).attr('data-message');
			var title = $(e.relatedTarget).attr('data-title');
			var form = $(e.relatedTarget).closest('form');
			$(this).find('.modal-body p').text(message);
			$(this).find('.modal-title').text(title);
			$(this).find('.modal-footer #confirm').data('form', form);
		});
		$('#confirmDelete').find('.modal-footer #confirm').on('click', function(){
		  	$(this).data('form').submit();
		});

	</script>

@endsection