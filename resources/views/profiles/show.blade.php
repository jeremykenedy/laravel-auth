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

							@if ($user->profile)

								<dt>
									{{ Lang::get('profile.showProfileLocation') }}
								</dt>
								<dd>
									{{ $user->profile->location }}
								</dd>
								<dt>
									{{ Lang::get('profile.showProfileBio') }}
								</dt>
								<dd>
									{{ $user->profile->bio }}
								</dd>
								<dt>
									{{ Lang::get('profile.showProfileTwitterUsername') }}
								</dt>
								<dd>
									{{ $user->profile->twitter_username }}
								</dd>
								<dt>
									{{ Lang::get('profile.showProfileGitHubUsername') }}
								</dt>
								<dd>
									{{ $user->profile->github_username }}
								</dd>

							@endif

						</dl>

						@if (!$user->profile)

							<p>No profile yet.</p>

							{{--
								@if ($user->isCurrent())
									{{ link_to_route('profile.edit', 'Edit Your Profile', $user->username) }}
								@endif
							--}}

						@endif

					</div>
				</div>
			</div>
		</div>
	</div>
@endsection