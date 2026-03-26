@if(config('socialite-kit.enabled', false))
    @include('socialite-kit::partials.social-buttons')
@endif
