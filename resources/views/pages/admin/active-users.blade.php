@extends('layouts.app')

@section('template_title')
    {{ trans('titles.activeUsers') }}
@endsection

@section('content')

    <users-count :registered={{ $users }} ></users-count>

@endsection
