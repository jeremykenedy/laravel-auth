<div>
    @if(config('captcha.enabled'))
        @if($version === 'v2')
            <div class="g-recaptcha" data-sitekey="{{ $siteKey }}" wire:ignore></div>
            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        @endif
        @error('g-recaptcha-response')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    @endif
</div>
