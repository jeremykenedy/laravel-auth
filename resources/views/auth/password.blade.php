@extends('app')

@section('template_title')
	Reset Password Request
@endsection

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">{{ Lang::get('titles.resetPword') }}</div>
					<div class="panel-body">

						@if (session('status'))
							<div class="alert alert-success">
								{{ session('status') }}
							</div>
						@endif

						@if (count($errors) > 0)
							<div class="row">
								<div class="form-group">
									<div class="col-sm-10 col-sm-offset-1">
										<div class="alert alert-danger">
											<strong>{{ Lang::get('auth.whoops') }}</strong> {{ Lang::get('auth.someProblems') }}<br><br>
											<ul>
												@foreach ($errors->all() as $error)
													<li>{{ $error }}</li>
												@endforeach
											</ul>
										</div>
									</div>
								</div>
							</div>
						@endif

						{!! Form::open(array('url' => url('/password/email'), 'method' => 'POST', 'class' => 'lockscreen-credentials form-horizontal', 'role' => 'form')) !!}
							{!! csrf_field() !!}

							<div class="form-group has-feedback">
								{!! Form::label('email', Lang::get('auth.email') , array('class' => 'col-sm-4 control-label')); !!}
								<div class="col-sm-6">
									{!! Form::email('email', null, array('id' => 'email', 'class' => 'form-control', 'placeholder' => Lang::get('auth.ph_email'), 'required' => 'required',)) !!}
									<span class="glyphicon glyphicon-envelope form-control-feedback" aria-hidden="true"></span>
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-6 col-sm-offset-4 ">
									<div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}"></div>
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-6 col-sm-offset-4">
									{!! Form::button(Lang::get('auth.sendResetLink'), array('class' => 'btn btn-primary','type' => 'submit')) !!}
								</div>
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('template_scripts')
	{!! HTML::script('https://www.google.com/recaptcha/api.js', array('type' => 'text/javascript')) !!}
@endsection