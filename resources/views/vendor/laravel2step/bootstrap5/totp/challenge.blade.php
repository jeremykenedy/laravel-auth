@extends(config('laravel2step.laravel2stepBladeExtended', 'layouts.app'))

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <x-ui::card title="Two-Factor Verification">
                <p class="text-muted small mb-3">
                    Enter the 6-digit code from your authenticator app, or use a recovery code.
                </p>

                <form method="POST" action="{{ route('twostep.totp.challenge.verify') }}">
                    @csrf
                    <x-ui::input name="code" label="Authentication Code" placeholder="000000" required autofocus autocomplete="one-time-code" />
                    @error('code')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                    <div class="d-grid mt-3">
                        <x-ui::button type="submit" variant="primary" icon="shield">Verify</x-ui::button>
                    </div>
                </form>

                <div class="mt-3 text-center">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-link btn-sm text-muted text-decoration-underline">Log out instead</button>
                    </form>
                </div>
            </x-ui::card>
        </div>
    </div>
</div>
@endsection
