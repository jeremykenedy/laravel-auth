@extends('layouts.app')

@section('template_title')
	Edit your profile
@endsection

@section('template_fastload_css')
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">
						{{ trans('profile.editProfileTitle') }}
					</div>
					<div class="panel-body">

						@if ($user->profile)
							@if (Auth::user()->id == $user->id)

								{!! Form::model($user->profile, ['method' => 'PATCH', 'route' => ['profile.update', $user->name],  'class' => 'form-horizontal', 'role' => 'form' ]) !!}

									{{ csrf_field() }}

									<div class="form-group has-feedback {{ $errors->has('theme') ? ' has-error ' : '' }}">
										{!! Form::label('theme', trans('profile.label-theme') , array('class' => 'col-sm-4 control-label')); !!}
										<div class="col-sm-6">

											<select class="form-control" name="theme_id" id="theme_id">
												@if ($themes->count())
													@foreach($themes as $theme)
													  <option value="{{ $theme->id }}"{{ $currentTheme->id == $theme->id ? 'selected="selected"' : '' }}>{{ $theme->name }}</option>
													@endforeach
												@endif
											</select>

											<span class="glyphicon {{ $errors->has('theme') ? ' glyphicon-asterisk ' : ' ' }} form-control-feedback" aria-hidden="true"></span>

									        @if ($errors->has('theme'))
									            <span class="help-block">
									                <strong>{{ $errors->first('theme') }}</strong>
									            </span>
									        @endif

										</div>
									</div>

									<div class="form-group has-feedback {{ $errors->has('location') ? ' has-error ' : '' }}">
										{!! Form::label('location', trans('profile.label-location') , array('class' => 'col-sm-4 control-label')); !!}
										<div class="col-sm-6">
											{!! Form::text('location', old('location'), array('id' => 'location', 'class' => 'form-control', 'placeholder' => trans('profile.ph-location'))) !!}
											<span class="glyphicon {{ $errors->has('location') ? ' glyphicon-asterisk ' : ' glyphicon-pencil ' }} form-control-feedback" aria-hidden="true"></span>
									        @if ($errors->has('location'))
									            <span class="help-block">
									                <strong>{{ $errors->first('location') }}</strong>
									            </span>
									        @endif
										</div>
									</div>

									<div class="form-group has-feedback {{ $errors->has('bio') ? ' has-error ' : '' }}">
										{!! Form::label('bio', trans('profile.label-bio') , array('class' => 'col-sm-4 control-label')); !!}
										<div class="col-sm-6">
											{!! Form::textarea('bio', old('bio'), array('id' => 'bio', 'class' => 'form-control', 'placeholder' => trans('profile.ph-bio'))) !!}
											<span class="glyphicon glyphicon-pencil form-control-feedback" aria-hidden="true"></span>
									        @if ($errors->has('bio'))
									            <span class="help-block">
									                <strong>{{ $errors->first('bio') }}</strong>
									            </span>
									        @endif
										</div>
									</div>

									<div class="form-group has-feedback {{ $errors->has('twitter_username') ? ' has-error ' : '' }}">
										{!! Form::label('twitter_username', trans('profile.label-twitter_username') , array('class' => 'col-sm-4 control-label')); !!}
										<div class="col-sm-6">
											{!! Form::text('twitter_username', old('twitter_username'), array('id' => 'twitter_username', 'class' => 'form-control', 'placeholder' => trans('profile.ph-twitter_username'))) !!}
											<span class="glyphicon glyphicon-pencil form-control-feedback" aria-hidden="true"></span>
									        @if ($errors->has('twitter_username'))
									            <span class="help-block">
									                <strong>{{ $errors->first('twitter_username') }}</strong>
									            </span>
									        @endif
										</div>
									</div>

									<div class="form-group has-feedback {{ $errors->has('github_username') ? ' has-error ' : '' }}">
										{!! Form::label('github_username', trans('profile.label-github_username') , array('class' => 'col-sm-4 control-label')); !!}
										<div class="col-sm-6">
											{!! Form::text('github_username', old('github_username'), array('id' => 'github_username', 'class' => 'form-control', 'placeholder' => trans('profile.ph-twitter_username'))) !!}
											<span class="glyphicon glyphicon-pencil form-control-feedback" aria-hidden="true"></span>
									        @if ($errors->has('github_username'))
									            <span class="help-block">
									                <strong>{{ $errors->first('github_username') }}</strong>
									            </span>
									        @endif
										</div>
									</div>

									<div class="form-group">
										<div class="col-sm-6 col-sm-offset-4">
											{!! Form::button(trans('profile.submitButton'), array('class' => 'btn btn-primary','type' => 'submit')) !!}
										</div>
									</div>
								{!! Form::close() !!}
							@else
								<p>{{ trans('profile.notYourProfile') }}</p>
							@endif
						@else

							<p>{{ trans('profile.noProfileYet') }}</p>

							{{--
								{!! HTML::link(url('/profile/create'), trans('titles.createProfile')) !!}
							--}}

						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('footer_scripts')

	@include('scripts.gmaps-address-lookup-api3')

@endsection