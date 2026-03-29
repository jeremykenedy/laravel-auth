<div>
    <x-ui::card title="Two-Factor Verification">
        <p class="text-muted small mb-3">Enter the 6-digit code from your authenticator app, or use a recovery code.</p>

        <form wire:submit="verify">
            <label class="form-label">Authentication Code</label>
            <input type="text" wire:model="code" class="form-control @error('code') is-invalid @enderror" placeholder="000000" autofocus autocomplete="one-time-code" />
            @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
            <div class="d-grid mt-3">
                <button type="submit" class="btn btn-primary">Verify</button>
            </div>
        </form>

        <div class="mt-3 text-center">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-link btn-sm text-muted">Log out instead</button>
            </form>
        </div>
    </x-ui::card>
</div>
