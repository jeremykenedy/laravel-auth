@extends(config('laravel2step.laravel2stepBladeExtended', 'layouts.app'))

@section('content')
<div class="max-w-lg mx-auto px-4 py-8">
    <x-ui::card title="Set Up Two-Factor Authentication">
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
            Scan the QR code below with your authenticator app (Google Authenticator, Authy, etc.), then enter the 6-digit code to confirm.
        </p>

        <div class="flex justify-center mb-4">
            <div class="p-4 bg-white rounded-lg">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ urlencode($qrUri) }}" alt="QR Code" width="200" height="200" />
            </div>
        </div>

        <div class="mb-4 p-3 rounded-lg bg-gray-100 dark:bg-gray-800 text-center">
            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Manual entry key:</p>
            <code class="text-sm font-mono font-bold text-gray-900 dark:text-gray-100 select-all">{{ $secret }}</code>
        </div>

        <form method="POST" action="{{ route('twostep.totp.enable') }}">
            @csrf
            <x-ui::input name="code" label="Verification Code" placeholder="000000" required autofocus autocomplete="one-time-code" />
            @error('code')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
            <div class="mt-4">
                <x-ui::button type="submit" variant="primary" icon="shield">Enable Two-Factor Authentication</x-ui::button>
            </div>
        </form>
    </x-ui::card>
</div>
@endsection
