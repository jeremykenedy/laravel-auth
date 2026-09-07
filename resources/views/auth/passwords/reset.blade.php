@extends('layouts.app')

@section('template_title')
    {{ __('Reset Password') }}
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
    .password-wrapper { position: relative; }
    .password-toggle {
        position: absolute; right: 10px; top: 50%; transform: translateY(-50%);
        cursor: pointer; color: #aaa; border: none; background: none; padding: 0 4px; z-index: 5;
    }
    /* Strength bar */
    .req-item { font-size: .78rem; transition: color .2s; }
    .req-item.met  { color: #28a745; }
    .req-item.unmet{ color: #bbb;    }
    .font-weight-600 { font-weight: 600; }
@endsection

@section('content')
<div class="container auth-card-wrapper">
    <div class="row justify-content-center w-100">
        <div class="col-12 col-sm-9 col-md-7 col-lg-5">

            <div class="card auth-card">
                <div class="card-header">
                    <h4><i class="fa fa-shield-alt mr-2"></i>{{ __('Set New Password') }}</h4>
                    <small class="opacity-75">{{ __('Choose a strong password to protect your account.') }}</small>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible auto-dismiss fade show" role="alert">
                            <i class="fa fa-check-circle mr-2"></i>{{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="{{ __('Close') }}"><span aria-hidden="true">&times;</span></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.request') }}" novalidate>
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

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
                                    value="{{ $email ?? old('email') }}"
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

                        {{-- New Password --}}
                        <div class="form-group mb-1">
                            <label for="password" class="font-weight-600 text-muted small text-uppercase">
                                {{ __('New Password') }}
                            </label>
                            <div class="input-group password-wrapper">
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
                                    placeholder="{{ __('Create a strong password') }}"
                                    required
                                    autocomplete="new-password"
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

                        {{-- Strength indicators --}}
                        <div class="mb-3">
                            <div class="progress" style="height:5px; border-radius:3px;">
                                <div id="strengthBar" class="progress-bar" role="progressbar" style="width:0%; transition: width .3s, background .3s;"></div>
                            </div>
                            <div class="d-flex flex-wrap mt-1">
                                <span class="req-item unmet mr-2" id="req-len"><i class="fa fa-circle mr-1" style="font-size:.6rem"></i>8+ chars</span>
                                <span class="req-item unmet mr-2" id="req-upper"><i class="fa fa-circle mr-1" style="font-size:.6rem"></i>Uppercase</span>
                                <span class="req-item unmet mr-2" id="req-lower"><i class="fa fa-circle mr-1" style="font-size:.6rem"></i>Lowercase</span>
                                <span class="req-item unmet mr-2" id="req-num"><i class="fa fa-circle mr-1" style="font-size:.6rem"></i>Number</span>
                                <span class="req-item unmet" id="req-sym"><i class="fa fa-circle mr-1" style="font-size:.6rem"></i>Symbol</span>
                            </div>
                        </div>

                        {{-- Confirm Password --}}
                        <div class="form-group mb-4">
                            <label for="password-confirm" class="font-weight-600 text-muted small text-uppercase">
                                {{ __('Confirm Password') }}
                            </label>
                            <div class="input-group password-wrapper">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light border-right-0">
                                        <i class="fa fa-lock text-muted"></i>
                                    </span>
                                </div>
                                <input
                                    id="password-confirm"
                                    type="password"
                                    class="form-control border-left-0{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                    name="password_confirmation"
                                    placeholder="{{ __('Repeat your password') }}"
                                    required
                                    autocomplete="new-password"
                                >
                                <button type="button" class="password-toggle" id="togglePasswordConfirm" aria-label="{{ __('Show password confirmation') }}" aria-pressed="false" aria-controls="password-confirm">
                                    <i class="fa fa-eye" id="togglePasswordConfirmIcon"></i>
                                </button>
                                @if ($errors->has('password_confirmation'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <button type="submit" class="btn btn-auth btn-primary btn-block text-white">
                            <i class="fa fa-save mr-2"></i>{{ __('Reset Password') }}
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('footer_scripts')
<script>
(function () {
    function bindToggle(btnId, iconId, fieldId) {
        var btn = document.getElementById(btnId);
        var icon = document.getElementById(iconId);
        var pwd  = document.getElementById(fieldId);
        if (btn && pwd) {
            btn.addEventListener('click', function () {
                var show = pwd.type === 'password';
                pwd.type = show ? 'text' : 'password';
                icon.classList.toggle('fa-eye',       !show);
                icon.classList.toggle('fa-eye-slash',  show);
                btn.setAttribute('aria-pressed', show ? 'true' : 'false');
            });
        }
    }
    bindToggle('togglePassword',        'togglePasswordIcon',        'password');
    bindToggle('togglePasswordConfirm', 'togglePasswordConfirmIcon', 'password-confirm');

    var pwdInput = document.getElementById('password');
    var bar      = document.getElementById('strengthBar');
    var reqs = {
        len:   { el: document.getElementById('req-len'),   fn: function(v){ return v.length >= 8; } },
        upper: { el: document.getElementById('req-upper'), fn: function(v){ return /[A-Z]/.test(v); } },
        lower: { el: document.getElementById('req-lower'), fn: function(v){ return /[a-z]/.test(v); } },
        num:   { el: document.getElementById('req-num'),   fn: function(v){ return /[0-9]/.test(v); } },
        sym:   { el: document.getElementById('req-sym'),   fn: function(v){ return /[^A-Za-z0-9]/.test(v); } },
    };
    var colors = ['#dc3545','#fd7e14','#ffc107','#20c997','#28a745'];

    if (pwdInput && bar) {
        pwdInput.addEventListener('input', function () {
            var val = pwdInput.value;
            var met = 0;
            Object.keys(reqs).forEach(function (key) {
                var pass = reqs[key].fn(val);
                if (pass) met++;
                reqs[key].el.classList.toggle('met',   pass);
                reqs[key].el.classList.toggle('unmet', !pass);
            });
            var pct              = val.length === 0 ? 0 : Math.round((met / 5) * 100);
            bar.style.width      = pct + '%';
            bar.style.background = val.length === 0 ? '' : colors[met - 1] || colors[0];
        });
    }
})();
</script>
@endsection
