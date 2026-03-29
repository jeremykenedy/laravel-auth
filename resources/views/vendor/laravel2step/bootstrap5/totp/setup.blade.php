@extends(config('laravel2step.laravel2stepBladeExtended', 'layouts.app'))

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <x-ui::card title="Set Up Two-Factor Authentication">
                <p class="text-muted small mb-3">
                    Scan the QR code below with your authenticator app (Google Authenticator, Authy, etc.), then enter the 6-digit code to confirm.
                </p>

                <div class="text-center mb-3">
                    <div class="d-inline-block p-3 bg-white rounded">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ urlencode($qrUri) }}" alt="QR Code" width="200" height="200" />
                    </div>
                </div>

                <div class="mb-3 p-3 bg-light rounded text-center">
                    <p class="text-muted small mb-1">Manual entry key:</p>
                    <code class="fw-bold user-select-all">{{ $secret }}</code>
                </div>

                <form method="POST" action="{{ route('twostep.totp.enable') }}">
                    @csrf
                    <x-ui::input name="code" label="Verification Code" placeholder="000000" required autofocus autocomplete="one-time-code" />
                    @error('code')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                    <div class="mt-3">
                        <x-ui::button type="submit" variant="primary" icon="shield">Enable Two-Factor Authentication</x-ui::button>
                    </div>
                </form>
            </x-ui::card>
        </div>
    </div>
</div>
@endsection
