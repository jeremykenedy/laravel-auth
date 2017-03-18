@extends('layouts.app')

@section('template_title')
    Welcome {{ Auth::user()->name }}
@endsection

@section('head')
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome {{ Auth::user()->name }}</div>
                <div class="panel-body">
                    <p>
                        {{ trans('auth.loggedIn') }}
                    </p>
                    <p>
                        <em>Thank you</em> for checking this project out. <strong>Please remember to star it!</strong>
                    </p>
                    <p>
                        This page route is protected by <code>activated</code> middleware. Only accounts with activated emails are able pass this middleware.
                    </p>
                    <p>
                        <small>
                            Users registered via Social providers are by default activated.
                        </small>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection