<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{!! csrf_token() !!}" >
        <title>@hasSection('title')@yield('title') | @endif {{ config('app.name', 'Laravel 2-Step Verification') }}</title>
        @if(config('laravel2step.laravel2stepBootstrapCssCdnEnbled'))
            <link rel="stylesheet" type="text/css" href="{{ config('laravel2step.laravel2stepBootstrapCssCdn') }}">
        @endif
        @if(config('laravel2step.laravel2stepAppCssEnabled'))
            <link rel="stylesheet" type="text/css" href="{{ asset(config('laravel2step.laravel2stepAppCss')) }}">
        @endif
        <link rel="stylesheet" type="text/css" href="{{ asset(config('laravel2step.laravel2stepCssFile')) }}">
        @yield('head')
        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>
    </head>
    <body>
        <div id="app" class="two-step-verification">
            @yield('content')
        </div>
        @yield('foot')
    </body>
</html>
