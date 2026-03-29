<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        @include('darkmode::init-script')

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <script src="https://cdn.tailwindcss.com"></script>
            <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3/dist/cdn.min.js"></script>
        @endif

        {{-- Theme CSS (injected by ThemeComposer) --}}
        @if (!empty($themeCssFile))
            <link rel="stylesheet" href="{{ $themeCssFile }}">
        @endif

        @if(config('ui-kit.frontend') === 'livewire' || config('ui-kit.frontend') === 'blade')
            @livewireStyles
        @endif
        @yield('head')
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col font-sans antialiased {{ $themeBodyClass ?? '' }}">
        <div class="w-full max-w-md">
            <div class="text-center mb-8">
                <a href="{{ url('/') }}" class="text-2xl font-semibold text-[#1b1b18] dark:text-[#EDEDEC] no-underline">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>
            {{ $slot ?? '' }}
            @yield('content')
        </div>
        @php
            $tm = app(\Jeremykenedy\LaravelToast\Services\ToastManager::class);
            if (session('success')) $tm->success(session('success'));
            if (session('error')) $tm->error(session('error'));
        @endphp
        @include('toast::toasts')
        @if(config('ui-kit.frontend') === 'livewire' || config('ui-kit.frontend') === 'blade')
            @livewireScripts
        @endif
        @yield('footer_scripts')
    </body>
</html>
