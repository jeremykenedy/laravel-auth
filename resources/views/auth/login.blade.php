@extends('layouts.guest')

@section('content')
    <x-ui::card title="Log in to your account">
        @if (session('status'))
            <x-ui::alert variant="success" :dismissible="false">
                {{ session('status') }}
            </x-ui::alert>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <x-ui::input
                    name="email"
                    type="email"
                    label="Email"
                    :value="old('email')"
                    required
                    autofocus
                    autocomplete="email"
                    placeholder="you@example.com"
                />
            </div>

            <div class="mb-4">
                <x-ui::password-input
                    name="password"
                    label="Password"
                    required
                    autocomplete="current-password"
                    :strength-meter="false"
                />
            </div>

            <div class="mb-4">
                <x-ui::checkbox
                    name="remember"
                    label="Remember me"
                    :checked="old('remember', false)"
                />
            </div>

            <x-ui::button type="submit" variant="primary" block>
                Log in
            </x-ui::button>

            <div class="flex items-center justify-between mt-4 text-sm">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-gray-500 dark:text-gray-400 underline underline-offset-4 hover:text-gray-900 dark:hover:text-gray-100">
                        Forgot your password?
                    </a>
                @endif
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-gray-500 dark:text-gray-400 underline underline-offset-4 hover:text-gray-900 dark:hover:text-gray-100">
                        Create an account
                    </a>
                @endif
            </div>
        </form>

        @include('socialite-kit::partials.social-buttons')
    </x-ui::card>
@endsection
