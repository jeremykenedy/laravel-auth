@extends('app')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">{{ Lang::get('titles.resetPword') }}</div>
					<div class="panel-body">

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

						{!! Form::open(array('url' => url('/password/reset'), 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form')) !!}
							{!! csrf_field() !!}
							{!! Form::hidden('token', $token) !!}

							<div class="form-group has-feedback">
								{!! Form::label('email', Lang::get('auth.email') , array('class' => 'col-sm-4 control-label')); !!}
								<div class="col-sm-6">
									{!! Form::email('email', old('email'), array('id' => 'email', 'class' => 'form-control', 'placeholder' => Lang::get('auth.ph_email'), 'required' => 'required')) !!}
									<span class="glyphicon glyphicon-envelope form-control-feedback" aria-hidden="true"></span>
								</div>
							</div>

							<div class="form-group has-feedback">
								{!! Form::label('password', Lang::get('auth.password') , array('class' => 'col-sm-4 control-label')); !!}
								<div class="col-sm-6">
									{!! Form::password('password', array('id' => 'password', 'class' => 'form-control', 'placeholder' => Lang::get('auth.ph_password'), 'required' => 'required',)) !!}
									<span class="glyphicon glyphicon-lock form-control-feedback" aria-hidden="true"></span>
								</div>
							</div>

							<div class="form-group has-feedback">
								{!! Form::label('password_confirmation', Lang::get('auth.confirmPassword') , array('class' => 'col-sm-4 control-label')); !!}
								<div class="col-sm-6">
									{!! Form::password('password_confirmation', array('id' => 'password_confirmation', 'class' => 'form-control', 'placeholder' => Lang::get('auth.ph_password_conf'), 'required' => 'required',)) !!}
									<span class="glyphicon glyphicon-lock form-control-feedback" aria-hidden="true"></span>
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-6 col-sm-offset-4">
									{!! Form::button(Lang::get('auth.resetPassword'), array('class' => 'btn btn-primary','type' => 'submit')) !!}
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
    <script type="text/javascript">
		document.addEventListener("DOMContentLoaded", function(event) {
		  	matching_password_check();
		});
        function matching_password_check() {
            var password = document.getElementById("password");
            var confirm_password = document.getElementById("password_confirmation");
            function validatePassword(){
                if(password.value != confirm_password.value) {
                    confirm_password.setCustomValidity("The Passwords do not match");
                } else {
                    confirm_password.setCustomValidity('');
                }
            }
            password.onchange = validatePassword;
            confirm_password.onkeyup = validatePassword;
        }
    </script>
@endsection