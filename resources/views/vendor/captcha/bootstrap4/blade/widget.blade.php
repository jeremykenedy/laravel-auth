@if(config('captcha.enabled'))
    @captchaScript
    <div class="form-group">
        @captchaWidget
        @error('g-recaptcha-response')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
@endif
