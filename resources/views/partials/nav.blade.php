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
							<li>{!! HTML::link(url('/profile/'.Auth::user()->name), Lang::get('titles.profile')) !!}</li>
							<li>{!! HTML::link(url('/auth/logout'), Lang::get('titles.logout')) !!}</li>
						</ul>
					</li>
				@endif

			</ul>
		</div>
	</div>
</nav>