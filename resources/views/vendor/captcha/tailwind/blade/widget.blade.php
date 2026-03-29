@if(config('captcha.enabled'))
    @captchaScript
    <div class="mt-4">
        @captchaWidget
        @error('g-recaptcha-response')
            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>
@endif
