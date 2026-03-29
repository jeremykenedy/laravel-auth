<div>
    <x-ui::card title="Set Up Two-Factor Authentication">
        <p class="text-muted small mb-3">Scan the QR code with your authenticator app, then enter the 6-digit code.</p>

        <div class="text-center mb-3">
            <div class="d-inline-block p-3 bg-white rounded">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ urlencode($qrUri) }}" alt="QR Code" width="200" height="200" />
            </div>
        </div>

        <div class="mb-3 p-3 bg-light rounded text-center">
            <small class="text-muted d-block mb-1">Manual entry key:</small>
            <code class="fw-bold user-select-all">{{ $secret }}</code>
        </div>

        <form wire:submit="enable">
            <label class="form-label">Verification Code</label>
            <input type="text" wire:model="code" class="form-control @error('code') is-invalid @enderror" placeholder="000000" autocomplete="one-time-code" />
            @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Enable Two-Factor Authentication</button>
            </div>
        </form>
    </x-ui::card>
</div>
