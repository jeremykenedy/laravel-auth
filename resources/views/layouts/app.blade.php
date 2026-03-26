<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@hasSection('template_title')@yield('template_title') | @endif {{ config('app.name', 'Laravel') }}</title>
        <meta name="description" content="">
        <meta name="author" content="Jeremy Kenedy">
        <link rel="shortcut icon" href="/favicon.ico">
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

        @yield('template_linked_fonts')

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

        @yield('template_linked_css')

        <style type="text/css">
            @yield('template_fastload_css')
        </style>

        @livewireStyles
        @yield('head')

        <script>
            window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!};
        </script>
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] font-sans antialiased min-h-screen {{ $themeBodyClass ?? '' }}">
        <div id="app">
            @include('partials.impersonation-bar')
            @include('partials.nav')

            <main class="py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    @include('partials.form-status')
                    @yield('content')
                </div>
            </main>
        </div>

        {{-- Toast notifications (convert flash messages to toasts) --}}
        @php
            $tm = app(\Jeremykenedy\LaravelToast\Services\ToastManager::class);
            if (session('success')) $tm->success(session('success'));
            if (session('error')) $tm->error(session('error'));
            if (session('warning')) $tm->warning(session('warning'));
            if (session('info') && is_string(session('info'))) $tm->info(session('info'));
        @endphp
        @include('toast::toasts')

        @yield('footer_scripts')
        @include('scripts.ga-analytics')
        @livewireScripts
    </body>
</html>
