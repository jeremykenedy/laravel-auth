@extends('layouts.guest')

@section('content')
    <x-ui::card title="Create your account">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-4">
                <x-ui::input
                    name="name"
                    label="Username"
                    :value="old('name')"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="johndoe"
                />
            </div>

            <div class="mb-4">
                <x-ui::input
                    name="first_name"
                    label="First Name"
                    :value="old('first_name')"
                    autocomplete="given-name"
                />
            </div>

            <div class="mb-4">
                <x-ui::input
                    name="last_name"
                    label="Last Name"
                    :value="old('last_name')"
                    autocomplete="family-name"
                />
            </div>

            <div class="mb-4">
                <x-ui::input
                    name="email"
                    type="email"
                    label="Email"
                    :value="old('email')"
                    required
                    autocomplete="email"
                    placeholder="you@example.com"
                />
            </div>

            <div class="mb-4">
                <x-ui::password-input
                    name="password"
                    label="Password"
                    required
                    autocomplete="new-password"
                    :strength-meter="true"
                />
            </div>

            <div class="mb-4">
                <x-ui::password-input
                    name="password_confirmation"
                    label="Confirm Password"
                    required
                    autocomplete="new-password"
                    :strength-meter="false"
                    :show-hide="false"
                />
            </div>

            <x-ui::button type="submit" variant="primary" block>
                Register
            </x-ui::button>

            <div class="text-center mt-4 text-sm">
                <span class="text-gray-500 dark:text-gray-400">Already have an account?</span>
                <a href="{{ route('login') }}" class="text-gray-500 dark:text-gray-400 underline underline-offset-4 hover:text-gray-900 dark:hover:text-gray-100 ml-1">
                    Log in
                </a>
            </div>
        </form>

        @include('socialite-kit::partials.social-buttons')
    </x-ui::card>
@endsection
