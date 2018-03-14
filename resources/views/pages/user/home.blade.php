@extends('layouts.app')

@section('template_title')
    {{ Auth::user()->name }}'s' Homepage
@endsection

@section('template_fastload_css')
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-10 offset-lg-1">

                @include('panels.welcome-panel')

            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
@endsection
