@extends('app')

@section('template_title')
	Welcome {{ Auth::user()->name }}
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">{{ Lang::get('titles.home') }}</div>
				<div class="panel-body">
					<h1>
						Welcome <small>{{ Auth::user()->name }}</small>
					</h1>
					<p>
						{{ Lang::get('auth.loggedIn') }}
					</p>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
