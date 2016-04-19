@extends('app')

@section('template_title')
	Showing User {{ $user->name }}
@endsection

@section('template_fastload_css')
@endsection

@section('content')
	 <div class="content-wrapper">
	    <section class="content-header">

			<h1>Showing {{ $user->name }}</h1>

	    </section>
	    <section class="content">

			<ul>
				<li>
					<a href="{{ URL::to('users/create') }}">Create a User</a>
				</li>
			</ul>

			    	{{--
			    	@include('admin.modules.profile-image-box-split-bg')
					--}}
			    {{-- 	@include('admin.modules.profile-image-box') --}}
			    	{{--
					@include('admin.modules.profile-image-box-w-bg')
			    	@include('admin.modules.profile-about')
					--}}

			<div class="jumbotron text-center">
				<h2>{{ $user->name }}</h2>
				<p>
					<strong>Email:</strong> {{ $user->email }}<br>
				</p>
			</div>


	    </section>
	</div>
@endsection

@section('template_scripts')
@endsection