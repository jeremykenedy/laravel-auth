@extends('app')

@section('template_title')
	Activation Required
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">

				@include('partials.form-status')

				<div class="panel panel-default">
					<div class="panel-heading">{{ Lang::get('titles.home') }}</div>
					<div class="panel-body">
						<p>An email was sent to {{ $email }} on {{ $date }}.</p>
						<p>{{ Lang::get('auth.clickInEmail') }}</p>
						<p><a href='/activation'>{{ Lang::get('auth.clickHereResend') }}</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
