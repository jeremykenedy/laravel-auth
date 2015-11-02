@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					{{ Lang::get('profile.showProfileTitle') }}
				</div>

				<div class="panel-body">
					<dl class="user-info">
						<dt>
							{{ Lang::get('profile.showProfileUsername') }}
						</dt>
						<dd>
							{{ $user->name }}
						</dd>
						<dt>
							{{ Lang::get('profile.showProfileFirstName') }}
						</dt>
						<dd>
							{{ $user->first_name }}
						</dd>

						<dt>
							{{ Lang::get('profile.showProfileLastName') }}
						</dt>
						<dd>
							{{ $user->last_name }}
						</dd>

						<dt>
							{{ Lang::get('profile.showProfileEmail') }}
						</dt>
						<dd>
							{{ $user->email }}
						</dd>
					</dl>
					<dl class="user-bio">
						<dt>
							{{ Lang::get('profile.showProfileLocation') }}
						</dt>
						<dd>
							{{ $user->name }}
						</dd>
						<dt>
							{{ Lang::get('profile.showProfileBio') }}
						</dt>
						<dd>
							{{ $user->name }}
						</dd>
					</dl>
				</div>

			</div>
		</div>
	</div>
</div>
@endsection