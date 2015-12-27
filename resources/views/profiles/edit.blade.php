@extends('app')

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
						{{ Lang::get('profile.editProfileTitle') }}
					</div>
					<div class="panel-body">

						@if (session('status'))
							<div class="alert alert-success">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								{{ session('status') }}
							</div>
						@endif

						@if (count($errors) > 0)
							<div class="alert alert-danger">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<div class="form-group">
									<strong>{{ Lang::get('auth.whoops') }}</strong> {{ Lang::get('auth.someProblems') }}<br /><br />
									<ul>
										@foreach ($errors->all() as $error)
											<li>{{ $error }}</li>
										@endforeach
									</ul>
								</div>
							</div>
						@endif

						@if ($user->profile)
							@if (Auth::user()->id == $user->id)

								{!! Form::model($user->profile, ['method' => 'PATCH', 'route' => ['profile.update', $user->name],  'class' => 'form-horizontal', 'role' => 'form' ]) !!}

									<div class="form-group has-feedback">
										{!! Form::label('location', Lang::get('profile.label-location') , array('class' => 'col-sm-4 control-label')); !!}
										<div class="col-sm-6">
											{!! Form::text('location', old('location'), array('id' => 'location', 'class' => 'form-control', 'placeholder' => Lang::get('profile.ph-location'))) !!}
											<span class="glyphicon glyphicon-pencil form-control-feedback" aria-hidden="true"></span>
										</div>
									</div>

									<div class="form-group has-feedback">
										{!! Form::label('bio', Lang::get('profile.label-bio') , array('class' => 'col-sm-4 control-label')); !!}
										<div class="col-sm-6">
											{!! Form::textarea('bio', old('bio'), array('id' => 'bio', 'class' => 'form-control', 'placeholder' => Lang::get('profile.ph-bio'))) !!}
											<span class="glyphicon glyphicon-pencil form-control-feedback" aria-hidden="true"></span>
										</div>
									</div>

									<div class="form-group has-feedback">
										{!! Form::label('twitter_username', Lang::get('profile.label-twitter_username') , array('class' => 'col-sm-4 control-label')); !!}
										<div class="col-sm-6">
											{!! Form::text('twitter_username', old('twitter_username'), array('id' => 'twitter_username', 'class' => 'form-control', 'placeholder' => Lang::get('profile.ph-twitter_username'))) !!}
											<span class="glyphicon glyphicon-pencil form-control-feedback" aria-hidden="true"></span>
										</div>
									</div>

									<div class="form-group has-feedback">
										{!! Form::label('github_username', Lang::get('profile.label-github_username') , array('class' => 'col-sm-4 control-label')); !!}
										<div class="col-sm-6">
											{!! Form::text('github_username', old('github_username'), array('id' => 'github_username', 'class' => 'form-control', 'placeholder' => Lang::get('profile.ph-twitter_username'))) !!}
											<span class="glyphicon glyphicon-pencil form-control-feedback" aria-hidden="true"></span>
										</div>
									</div>

									<div class="form-group">
										<div class="col-sm-6 col-sm-offset-4">
											{!! Form::button(Lang::get('profile.submitButton'), array('class' => 'btn btn-primary','type' => 'submit')) !!}
										</div>
									</div>
								{!! Form::close() !!}
							@else
								<p>{{ Lang::get('profile.notYourProfile') }}</p>
							@endif
						@else
							<p>{{ Lang::get('profile.noProfileYet') }}</p>
							{!! HTML::link(url('/profile/'.Auth::user()->name.'/edit'), Lang::get('titles.createProfile')) !!}
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('template_scripts')

	{!! HTML::script('//maps.googleapis.com/maps/api/js?libraries=places&dummy=.js', array('type' => 'text/javascript')) !!}

	<script type="text/javascript">
	    //FUNCTION TO ASSIST WITH AUTO ADDRESS INPUT USING GOOGLE MAPS API3
	    //<![CDATA[
	    window.onload=function(){
	        if(document.getElementById("location"))
	        {
	            var input = document.getElementById('location');
	            var options; // = {componentRestrictions: {country: 'us'}};
	            var autocomplete = new google.maps.places.Autocomplete(input, options);
	        }
	     }//]]>
	</script>

@endsection


