@extends('laravel2step::layouts.app')

@section('title')
    {{ trans('laravel2step::laravel-verification.exceededTitle') }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel verification-exceeded-panel">
                <div class="panel-heading text-center">
                    <i class="glyphicon glyphicon-lock locked-icon text-danger" aria-hidden="true"></i>
                    <h3>
                        {{ trans('laravel2step::laravel-verification.exceededTitle') }}
                    </h3>
                </div>
                <div class="panel-body">
                    <h4 class="text-center text-danger">
                        <em>
                            {{ trans('laravel2step::laravel-verification.lockedUntil') }}
                        </em>
                        <br />
                        <strong>
                            {{ $timeUntilUnlock }}
                        </strong>
                        <br />
                        <small>
                            {{ trans('laravel2step::laravel-verification.tryAgainIn') }} {{ $timeCountdownUnlock }} &hellip;
                        </small>
                    </h4>
                    <p class="text-center">
                        <a class="btn btn-info" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" tabindex="6">
                            <i class="glyphicon glyphicon-home" aria-hidden="true"></i> {{ trans('laravel2step::laravel-verification.returnButton') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
