@extends('layouts.app')

@section('content')
    @if(Auth::user()->level() >= 5)
        @include('pages.admin.home')
    @else
        @include('pages.user.home')
    @endif
@endsection
