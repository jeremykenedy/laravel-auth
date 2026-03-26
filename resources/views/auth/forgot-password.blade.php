@extends('layouts.guest')

@section('content')
    <x-ui::card title="Forgot your password?">
        <p class="mb-4 text-sm text-gray-500 dark:text-gray-400">
            No problem. Enter your email address and we will send you a password reset link.
        </p>

        @if (session('status'))
            <x-ui::alert variant="success" :dismissible="false" class="mb-4">
                {{ session('status') }}
            </x-ui::alert>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
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

            <x-ui::button type="submit" variant="primary" block>
                Email Password Reset Link
            </x-ui::button>

            <div class="text-center mt-4 text-sm">
                <a href="{{ route('login') }}" class="text-gray-500 dark:text-gray-400 underline underline-offset-4 hover:text-gray-900 dark:hover:text-gray-100">
                    Back to login
                </a>
            </div>
        </form>
    </x-ui::card>
@endsection
