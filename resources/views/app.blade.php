<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes" name="viewport">
		<title>{{ Lang::get('titles.app') }}</title>

		{{-- FONTS --}}
		{!! HTML::style('//fonts.googleapis.com/css?family=Roboto:400,300', array('type' => 'text/css', 'rel' => 'stylesheet')) !!}

		{{-- STYLESHEETS --}}
		{!! HTML::style(asset('/css/app.css'), array('type' => 'text/css', 'rel' => 'stylesheet')) !!}

	    {{-- HTML5 Shim and Respond.js for IE8 support --}}
	    <!--[if lt IE 9]>
	      {!! HTML::script('https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js', array('type' => 'text/javascript')) !!}
	      {!! HTML::script('//s3.amazonaws.com/nwapi/nwmatcher/nwmatcher-1.2.5-min.js', array('type' => 'text/javascript')) !!}
	      {!! HTML::script('//html5base.googlecode.com/svn-history/r38/trunk/js/selectivizr-1.0.3b.js', array('type' => 'text/javascript')) !!}
	      {!! HTML::script('https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js', array('type' => 'text/javascript')) !!}
	    <![endif]-->
	    <!--[if gte IE 9]>
	      <style type="text/css">.gradient {filter: none;}</style>
	    <![endif]-->

	</head>
	<body>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">{{ Lang::get('toggleNav') }}</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					{!! HTML::link(url('/'), Lang::get('titles.app'), array('class' => 'navbar-brand'), false) !!}
				</div>

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li>{!! HTML::link(url('/'), Lang::get('titles.home')) !!}</li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						@if (Auth::guest())
							<li>{!! HTML::link(url('/auth/login'), Lang::get('titles.login')) !!}</li>
							<li>{!! HTML::link(url('/auth/register'), Lang::get('titles.register')) !!}</li>
						@else
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li>{!! HTML::link(url('/auth/logout'), Lang::get('titles.logout')) !!}</li>
								</ul>
							</li>
						@endif
					</ul>
				</div>
			</div>
		</nav>

		@yield('content')

		{{-- SCRIPTS --}}
		{!! HTML::script('//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js', array('type' => 'text/javascript')) !!}
		{!! HTML::script('//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js', array('type' => 'text/javascript')) !!}

		@yield('template_scripts')

	</body>
</html>