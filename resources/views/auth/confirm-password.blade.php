@extends('layouts.guest')

@section('content')
    <x-ui::card title="Confirm your password">
        <p class="mb-4 text-sm text-gray-500 dark:text-gray-400">
            This is a secure area. Please confirm your password before continuing.
        </p>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div class="mb-4">
                <x-ui::password-input
                    name="password"
                    label="Password"
                    required
                    autocomplete="current-password"
                    :strength-meter="false"
                />
            </div>

            <x-ui::button type="submit" variant="primary" block>
                Confirm
            </x-ui::button>
        </form>
    </x-ui::card>
@endsection
