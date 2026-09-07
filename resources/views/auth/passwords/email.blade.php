@extends('layouts.app')

@section('template_title')
    {{ __('Forgot Password') }}
@endsection

@section('template_fastload_css')
    .auth-card-wrapper { min-height: calc(100vh - 120px); display: flex; align-items: center; }
    .auth-card { border: none; border-radius: 12px; box-shadow: 0 4px 24px rgba(0,0,0,.10); }
    .auth-card .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
        border-radius: 12px 12px 0 0 !important;
        padding: 1.5rem 2rem;
        border-bottom: none;
    }
    .auth-card .card-header h4 { margin: 0; font-weight: 600; }
    .auth-card .card-body { padding: 2rem; }
    .btn-auth {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none; padding: .6rem 2rem; font-weight: 600;
    }
    .font-weight-600 { font-weight: 600; }
@endsection

@section('content')
<div class="container auth-card-wrapper">
    <div class="row justify-content-center w-100">
        <div class="col-12 col-sm-9 col-md-7 col-lg-5">

            <div class="card auth-card">
                <div class="card-header">
                    <h4><i class="fa fa-key mr-2"></i>{{ __('Forgot Password') }}</h4>
                    <small class="opacity-75">{{ __("Enter your email and we'll send you a reset link.") }}</small>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible auto-dismiss fade show" role="alert">
                            <i class="fa fa-check-circle mr-2"></i>{{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="{{ __('Close') }}"><span aria-hidden="true">&times;</span></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" novalidate>
                        @csrf

                        <div class="form-group mb-4">
                            <label for="email" class="font-weight-600 text-muted small text-uppercase">
                                {{ __('Email Address') }}
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light border-right-0">
                                        <i class="fa fa-envelope text-muted"></i>
                                    </span>
                                </div>
                                <input
                                    id="email"
                                    type="email"
                                    class="form-control border-left-0{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="{{ __('you@example.com') }}"
                                    required
                                    autofocus
                                    autocomplete="email"
                                >
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        <i class="fa fa-exclamation-circle mr-1"></i>
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <button type="submit" class="btn btn-auth btn-primary btn-block text-white">
                            <i class="fa fa-paper-plane mr-2"></i>{{ __('Send Reset Link') }}
                        </button>
                    </form>
                </div>

                <div class="card-footer text-center bg-transparent border-top-0 pb-3">
                    <a href="{{ route('login') }}" class="small text-muted">
                        <i class="fa fa-arrow-left mr-1"></i>{{ __('Back to Sign In') }}
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
