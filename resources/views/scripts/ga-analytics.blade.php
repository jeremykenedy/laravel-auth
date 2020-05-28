@if(config('settings.googleanalyticsId'))
    {{-- Global site tag (gtag.js) - Google Analytics --}}
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('settings.googleanalyticsId') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '{{ config('settings.googleanalyticsId') }}');
    </script>
@endif
