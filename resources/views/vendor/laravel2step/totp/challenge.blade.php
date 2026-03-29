@extends(config('laravel2step.laravel2stepBladeExtended', 'layouts.app'))

@section('content')
<div class="max-w-md mx-auto px-4 py-16">
    <x-ui::card title="Two-Factor Verification">
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
            Enter the 6-digit code from your authenticator app, or use a recovery code.
        </p>

        <form method="POST" action="{{ route('twostep.totp.challenge.verify') }}">
            @csrf
            <x-ui::input name="code" label="Authentication Code" placeholder="000000" required autofocus autocomplete="one-time-code" />
            @error('code')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
            <div class="mt-4">
                <x-ui::button type="submit" variant="primary" icon="shield" class="w-full justify-center">Verify</x-ui::button>
            </div>
        </form>

        <div class="mt-4 text-center">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm text-gray-500 dark:text-gray-400 underline hover:text-gray-700 dark:hover:text-gray-200">Log out instead</button>
            </form>
        </div>
    </x-ui::card>
</div>
@endsection
