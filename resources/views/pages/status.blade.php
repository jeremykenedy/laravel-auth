@extends('layouts.app')

@section('template_title')
	See Message
@endsection

@section('head')
@endsection

@section('content')

 <div class="container">
	<div class="row">
	    <div class="col-md-12">
			 @include('partials.form-status')
        </div>
    </div>
</div>

@endsection