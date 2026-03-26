<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        {{-- Prevent Alpine FOUC + dark mode flash --}}
        <style>[x-cloak] { display: none !important; }</style>
        <script>
            (function() {
                var t = localStorage.getItem('theme');
                if (t === 'dark' || (t !== 'light' && t !== 'dark' && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    document.documentElement.classList.add('dark');
                }
            })();
        </script>

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

        @livewireStyles
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
        @livewireScripts
        @yield('footer_scripts')
    </body>
</html>
