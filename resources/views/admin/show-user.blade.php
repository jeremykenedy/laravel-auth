@extends('app')

@section('template_title')
	Showing User {{ $user->name }}
@endsection

@section('template_fastload_css')

	#map-canvas{
		min-height: 300px;
		height: 100%;
		width: 100%;
	}

@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">

						{{ Lang::get('profile.showProfileTitle',['username' => $user->name]) }}

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

							@if ($user->last_name)
								<dt>
									{{ Lang::get('profile.showProfileLastName') }}
								</dt>
								<dd>
									{{ $user->last_name }}
								</dd>
							@endif

							<dt>
								{{ Lang::get('profile.showProfileEmail') }}
							</dt>
							<dd>
								{{ $user->email }}
							</dd>

							@if ($user->profile)

								@if ($user->profile->location)
									<dt>
										{{ Lang::get('profile.showProfileLocation') }}
									</dt>
									<dd>
										{{ $user->profile->location }} <br />
										Latitude: <span id="latitude"></span> / Longitude: <span id="longitude"></span> <br />

										<div id="map-canvas"></div>

									</dd>

								@endif

								@if ($user->profile->bio)
									<dt>
										{{ Lang::get('profile.showProfileBio') }}
									</dt>
									<dd>
										{{ $user->profile->bio }}
									</dd>
								@endif

								@if ($user->profile->twitter_username)
									<dt>
										{{ Lang::get('profile.showProfileTwitterUsername') }}
									</dt>
									<dd>
										{!! HTML::link('https://twitter.com/'.$user->profile->twitter_username, $user->profile->twitter_username, array('class' => 'twitter-link', 'target' => '_blank')) !!}
									</dd>
								@endif

								@if ($user->profile->github_username)
									<dt>
										{{ Lang::get('profile.showProfileGitHubUsername') }}
									</dt>
									<dd>
										{!! HTML::link('https://github.com/'.$user->profile->github_username, $user->profile->github_username, array('class' => 'github-link', 'target' => '_blank')) !!}
									</dd>
								@endif
							@endif

						</dl>


						<div class="row">

							<div class="col-xs-6">

								{!! HTML::icon_link(URL::to('users/' . $user->id . '/edit'), 'fa fa-fw '.Lang::get('forms.submit-btn-icon')  , Lang::get('forms.submit-btn-text'), array('class' => 'btn btn-small btn-info btn-block')) !!}

							</div>

							{!! Form::open(array('url' => 'users/' . $user->id, 'class' => 'col-xs-6')) !!}
								{!! Form::hidden('_method', 'DELETE') !!}
								{!! Form::button('<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i> Delete this User', array('class' => 'btn btn-danger btn-block btn-flat','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete User', 'data-message' => 'Are you sure you want to delete this user ?')) !!}
							{!! Form::close() !!}

						</div>


					</div>
				</div>
			</div>
		</div>
	</div>

	@include('modals.modal-delete')

@endsection

@section('template_scripts')

	@include('scripts.google-maps-geocode-and-map')
	@include('scripts.delete-modal-script')

@endsection