@extends('layouts.app')

@section('template_title')
    {{ __('Login') }}
@endsection

@section('template_fastload_css')
    .auth-card-wrapper {
        min-height: calc(100vh - 120px);
        display: flex;
        align-items: center;
    }
    .auth-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 24px rgba(0,0,0,.10);
    }
    .auth-card .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
        border-radius: 12px 12px 0 0 !important;
        padding: 1.5rem 2rem;
        border-bottom: none;
    }
    .auth-card .card-header h4 {
        margin: 0;
        font-weight: 600;
        letter-spacing: .5px;
    }
    .auth-card .card-body {
        padding: 2rem;
    }
    .btn-auth {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        padding: .6rem 2rem;
        font-weight: 600;
        letter-spacing: .5px;
        transition: opacity .2s;
    }
    .btn-auth:hover { opacity: .88; }
    .password-wrapper { position: relative; }
    .password-toggle {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #aaa;
        border: none;
        background: none;
        padding: 0 4px;
        z-index: 5;
    }
    .password-toggle:hover { color: #555; }
    .divider-text {
        position: relative;
        text-align: center;
        margin: 1.25rem 0;
        color: #999;
        font-size: .85rem;
    }
    .divider-text::before,
    .divider-text::after {
        content: '';
        position: absolute;
        top: 50%;
        width: 42%;
        height: 1px;
        background: #e2e8f0;
    }
    .divider-text::before { left: 0; }
    .divider-text::after  { right: 0; }
@endsection

@section('content')
<div class="container auth-card-wrapper">
    <div class="row justify-content-center w-100">
        <div class="col-12 col-sm-9 col-md-7 col-lg-5">

            {{-- Flash Messages. `partials.form-status` (rendered by the layout) already handles
                 the status+message pair used by ActivateController/SocialController, where `status`
                 is an alert type. Only render here when `status` is a standalone message. --}}
            @if (session('status') && ! session('message'))
                <div class="alert alert-success alert-dismissible auto-dismiss fade show mb-3" role="alert">
                    <i class="fa fa-check-circle mr-2"></i>{{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="{{ __('Close') }}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card auth-card">
                <div class="card-header">
                    <h4><i class="fa fa-sign-in-alt mr-2"></i>{{ __('Sign In') }}</h4>
                    <small class="opacity-75">{{ __('Welcome back! Please sign in to continue.') }}</small>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" id="loginForm" novalidate>
                        @csrf

                        {{-- Email --}}
                        <div class="form-group mb-3">
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

                        {{-- Password --}}
                        <div class="form-group mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <label for="password" class="font-weight-600 text-muted small text-uppercase mb-0">
                                    {{ __('Password') }}
                                </label>
                                <a href="{{ route('password.request') }}" class="small text-muted">
                                    {{ __('Forgot password?') }}
                                </a>
                            </div>
                            <div class="input-group mt-1 password-wrapper">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light border-right-0">
                                        <i class="fa fa-lock text-muted"></i>
                                    </span>
                                </div>
                                <input
                                    id="password"
                                    type="password"
                                    class="form-control border-left-0{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    name="password"
                                    placeholder="{{ __('Your password') }}"
                                    required
                                    autocomplete="current-password"
                                >
                                <button type="button" class="password-toggle" id="togglePassword" aria-label="{{ __('Show password') }}" aria-pressed="false" aria-controls="password">
                                    <i class="fa fa-eye" id="togglePasswordIcon"></i>
                                </button>
                                @if ($errors->has('password'))
                                    <div class="invalid-feedback">
                                        <i class="fa fa-exclamation-circle mr-1"></i>
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Remember Me --}}
                        <div class="form-group d-flex justify-content-between align-items-center mb-4">
                            <div class="custom-control custom-checkbox">
                                <input
                                    type="checkbox"
                                    class="custom-control-input"
                                    id="remember"
                                    name="remember"
                                    {{ old('remember') ? 'checked' : '' }}
                                >
                                <label class="custom-control-label text-muted" for="remember">
                                    {{ __('Keep me signed in') }}
                                </label>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <button type="submit" class="btn btn-auth btn-primary btn-block text-white">
                            <i class="fa fa-sign-in-alt mr-2"></i>{{ __('Sign In') }}
                        </button>

                        @if (config('settings.reCaptchStatus'))
                            <div class="g-recaptcha mt-3" data-sitekey="{{ config('settings.reCaptchSite') }}"></div>
                        @endif

                        <div class="divider-text">{{ __('or continue with') }}</div>

                        @include('partials.socials-icons')

                    </form>
                </div>

                <div class="card-footer text-center bg-transparent border-top-0 pb-3">
                    <span class="text-muted small">
                        {{ __("Don't have an account?") }}
                        <a href="{{ route('register') }}" class="font-weight-600">{{ __('Create one') }}</a>
                    </span>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('footer_scripts')
    @if (config('settings.reCaptchStatus'))
        <script src="https://www.google.com/recaptcha/api.js"></script>
    @endif
    <script>
        // Password visibility toggle
        (function () {
            var btn  = document.getElementById('togglePassword');
            var icon = document.getElementById('togglePasswordIcon');
            var pwd  = document.getElementById('password');
            if (btn && pwd) {
                btn.addEventListener('click', function () {
                    var isPassword = pwd.type === 'password';
                    pwd.type       = isPassword ? 'text' : 'password';
                    icon.classList.toggle('fa-eye',      !isPassword);
                    icon.classList.toggle('fa-eye-slash', isPassword);
                    btn.setAttribute('aria-pressed', isPassword ? 'true' : 'false');
                });
            }
        })();
    </script>
@endsection
