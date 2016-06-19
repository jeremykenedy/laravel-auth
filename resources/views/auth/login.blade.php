@extends('app')

@section('template_title')
	Login
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{ Lang::get('titles.login') }}</div>
				<div class="panel-body">

					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<div class="form-group">
								<strong>{{ Lang::get('auth.whoops') }}</strong> {{ Lang::get('auth.someProblems') }}<br /><br />
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
									<li>{!! HTML::link(url('/password/email'), Lang::get('auth.forgot_message'), array('id' => 'forgot_message',)) !!}</li>
								</ul>

							</div>
						</div>
					@endif

					{!! Form::open(array('url' => 'auth/login', 'method' => 'POST', 'class' => 'lockscreen-credentials form-horizontal', 'role' => 'form')) !!}
						<div class="form-group has-feedback">
							<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
								{!! Form::label('email', Lang::get('auth.email') , array('class' => 'control-label')); !!}
								{!! Form::email('email', null, array('id' => 'email', 'class' => 'form-control', 'placeholder' => Lang::get('auth.ph_email'), 'required' => 'required',)) !!}
							</div>
						</div>
						<div class="form-group has-feedback">
							<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
								{!! Form::label('password', Lang::get('auth.password') , array('class' => 'control-label')); !!}
								{!! Form::password('password', array('id' => 'password', 'class' => 'form-control', 'placeholder' => Lang::get('auth.ph_password'), 'required' => 'required',)) !!}
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
								<div class="checkbox">
									<label for="remember">
										{!! Form::checkbox('remember', 'remember', true, array('id' => 'remember')); !!}
										{!! Lang::get('auth.rememberMe') !!}
									</label>
								</div>
								<p class="help-block">Not recommended on a shared device</p>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
								{!! Form::button(Lang::get('auth.login'), array('class' => 'btn btn-primary btn-raised btn-block','type' => 'submit')) !!}
								{!! HTML::link(url('/password/email'), Lang::get('auth.forgot'), array('id' => 'forgot', 'class' => 'btn btn-link btn-block')) !!}
							</div>
						</div>
						<p class="text-center">Or</p>
						<div class="form-group">
							<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
								{!! HTML::link(route('social.redirect', ['provider' => 'facebook']), 'Facebook', array('class' => 'btn btn-lg btn-raised btn-block facebook')) !!}
								{!! HTML::link(route('social.redirect', ['provider' => 'twitter']), 'Twitter', array('class' => 'btn btn-lg btn-raised btn-block twitter')) !!}
								{!! HTML::link(route('social.redirect', ['provider' => 'google']), 'Google +', array('class' => 'btn btn-lg btn-raised btn-block google')) !!}
								{!! HTML::link(route('social.redirect', ['provider' => 'github']), 'GitHub', array('class' => 'btn btn-lg btn-raised btn-block github')) !!}
								{!! HTML::link(route('social.redirect', ['provider' => 'youtube']), 'YouTube', array('class' => 'btn btn-lg btn-raised btn-block youtube')) !!}
								{!! HTML::link(route('social.redirect', ['provider' => 'twitch']), 'Twitch', array('class' => 'btn btn-lg btn-raised btn-block twitch')) !!}
								{!! HTML::link(route('social.redirect', ['provider' => 'instagram']), 'Instagram', array('class' => 'btn btn-lg btn-raised btn-block instagram')) !!}
								{!! HTML::link(route('social.redirect', ['provider' => '37signals']), 'Basecamp 37signals', array('class' => 'btn btn-lg btn-raised btn-block 37signals')) !!}
							</div>
						</div>
					{!! Form::close() !!}

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
