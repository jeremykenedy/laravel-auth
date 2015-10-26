@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{ Lang::get('titles.resetPword') }}</div>
				<div class="panel-body">

					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>{{ Lang::get('auth.whoops') }}</strong> {{ Lang::get('auth.someProblems') }}<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="token" value="{{ $token }}">

						<div class="form-group">
							<label class="col-md-4 control-label">{{ Lang::get('auth.email') }}</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">{{ Lang::get('auth.password') }}</label>
							<div class="col-md-6">
								<input type="password" id="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">{{ Lang::get('auth.confirmPassword') }}</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									{{ Lang::get('auth.resetPassword') }}
								</button>
							</div>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection


@section('additional_content')


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