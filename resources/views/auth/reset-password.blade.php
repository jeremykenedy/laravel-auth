@extends('layouts.guest')

@section('content')
    <x-ui::card title="Reset your password">
        <form method="POST" action="{{ route('password.store') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="mb-4">
                <x-ui::input
                    name="email"
                    type="email"
                    label="Email"
                    :value="old('email', $request->email)"
                    required
                    autofocus
                    autocomplete="email"
                />
            </div>

            <div class="mb-4">
                <x-ui::password-input
                    name="password"
                    label="New Password"
                    required
                    autocomplete="new-password"
                    :strength-meter="true"
                />
            </div>

            <div class="mb-4">
                <x-ui::password-input
                    name="password_confirmation"
                    label="Confirm New Password"
                    required
                    autocomplete="new-password"
                    :strength-meter="false"
                    :show-hide="false"
                />
            </div>

            <x-ui::button type="submit" variant="primary" block>
                Reset Password
            </x-ui::button>
        </form>
    </x-ui::card>
@endsection
