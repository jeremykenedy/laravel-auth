@extends('layouts.app')

@section('template_title')
    Status
@endsection

@section('content')
    <div class="max-w-4xl mx-auto">
        @include('partials.form-status')
    </div>
@endsection
