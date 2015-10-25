@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{ Lang::get('titles.login') }}</div>
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

					{!! Form::open(array('url' => 'auth/login', 'method' => 'POST', 'class' => 'lockscreen-credentials form-horizontal', 'role' => 'form')) !!}
						{!! csrf_field() !!}
						<div class="form-group has-feedback">
							{!! Form::label('email', Lang::get('auth.email') , array('class' => 'col-sm-4 control-label')); !!}
							<div class="col-sm-6">
								{!! Form::email('email', null, array('id' => 'email', 'class' => 'form-control', 'placeholder' => Lang::get('auth.ph_email'), 'required' => 'required',)) !!}
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
						<div class="form-group">
							<div class="col-sm-6 col-xs-offset-1 col-sm-offset-4">
								<div class="checkbox">
									{!! Form::checkbox('remember', 'remember', true, array('id' => 'remember')); !!}
									{!! Form::label('remember', Lang::get('auth.rememberMe')); !!}
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6 col-sm-offset-3">
								{!! Form::button(Lang::get('auth.login'), array('class' => 'btn btn-primary','type' => 'submit')) !!}
								{!! HTML::link(url('/password/email'), Lang::get('auth.forgot'), array('id' => 'forgot', 'class' => 'btn btn-link')) !!}
							</div>
						</div>
						<p class="text-center">Or</p>
						<div class="form-group">
							<div class="col-sm-6 col-sm-offset-3">
								{!! HTML::link(route('social.redirect', ['provider' => 'facebook']), 'Facebook', array('class' => 'btn btn-lg btn-primary btn-block facebook')) !!}
								{!! HTML::link(route('social.redirect', ['provider' => 'twitter']), 'Twitter', array('class' => 'btn btn-lg btn-primary btn-block twitter')) !!}
								{!! HTML::link(route('social.redirect', ['provider' => 'google']), 'Google +', array('class' => 'btn btn-lg btn-primary btn-block google')) !!}
								{!! HTML::link(route('social.redirect', ['provider' => 'github']), 'GitHub', array('class' => 'btn btn-lg btn-primary btn-block github')) !!}
								{!! HTML::link(route('social.redirect', ['provider' => 'youtube']), 'YouTube', array('class' => 'btn btn-lg btn-primary btn-block youtube')) !!}
								{!! HTML::link(route('social.redirect', ['provider' => 'twitch']), 'Twitch', array('class' => 'btn btn-lg btn-primary btn-block twitch')) !!}
								{!! HTML::link(route('social.redirect', ['provider' => 'instagram']), 'Instagram', array('class' => 'btn btn-lg btn-primary btn-block instagram')) !!}
								{!! HTML::link(route('social.redirect', ['provider' => '37signals']), 'Basecamp 37signals', array('class' => 'btn btn-lg btn-primary btn-block 37signals')) !!}
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
