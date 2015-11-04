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
        {{ session('status') }}
    </div>
@endif

{!! Form::model($user->profile, ['method' => 'PATCH', 'route' => ['profile.update', $user->name]]) !!}

{!! Form::label('location', 'Location: ' , array('class' => '')); !!}
{!! Form::text('location', old('location'), array('id' => 'location', 'class' => 'form-control', 'placeholder' => 'Location')) !!}

{!! Form::label('bio', 'Bio: ' , array('class' => '')); !!}
{!! Form::textarea('bio', old('bio'), array('id' => 'bio', 'class' => 'form-control', 'placeholder' => 'Bio')) !!}

{!! Form::label('twitter_username', 'Twitter Username: ' , array('class' => '')); !!}
{!! Form::text('twitter_username', old('twitter_username'), array('id' => 'twitter_username', 'class' => 'form-control', 'placeholder' => 'Twitter Username')) !!}

{!! Form::label('github_username', 'Github Username: ' , array('class' => '')); !!}
{!! Form::text('github_username', old('github_username'), array('id' => 'github_username', 'class' => 'form-control', 'placeholder' => 'Github Username')) !!}

<br />

{!! Form::button('Submit Changes', array('class' => 'btn btn-primary','type' => 'submit')) !!}







						{!! Form::close() !!}


					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('template_scripts')
@endsection


