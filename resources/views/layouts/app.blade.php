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

        @include('darkmode::init-script')

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

        {{-- Framework-specific head assets --}}
        @if(config('ui-kit.frontend') === 'livewire' || config('ui-kit.frontend') === 'blade')
            @livewireStyles
        @else
            @php
                $feManifest = file_exists(public_path('build/manifest.json'))
                    ? json_decode(file_get_contents(public_path('build/manifest.json')), true) ?? []
                    : [];
                $feEntry = match(config('ui-kit.frontend')) {
                    'vue' => 'resources/js/vue/app.js',
                    'react' => 'resources/js/react/app.jsx',
                    'svelte' => 'resources/js/svelte/app.js',
                    default => null,
                };
            @endphp
            @if($feEntry && (isset($feManifest[$feEntry]) || file_exists(public_path('hot'))))
                @vite([$feEntry])
            @endif
        @endif
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
                    @yield('content')
                </div>
            </main>
        </div>

        @auth
            @include('partials.command-palette')
        @endauth

        {{-- Toast notifications (convert flash messages to toasts) --}}
        @php
            $tm = app(\Jeremykenedy\LaravelToast\Services\ToastManager::class);
            if (session('success')) $tm->success(session('success'));
            if (session('error')) $tm->error(session('error'));
            if (session('warning')) $tm->warning(session('warning'));
            if (session('info') && is_string(session('info'))) $tm->info(session('info'));
        @endphp
        @include('toast::toasts')

        @include('partials.live-timestamp')
        @yield('footer_scripts')
        @include('scripts.ga-analytics')

        {{-- Framework-specific footer scripts --}}
        @if(config('ui-kit.frontend') === 'livewire' || config('ui-kit.frontend') === 'blade')
            @livewireScripts
        @endif

        {{-- Keyboard shortcuts for navigation --}}
        @auth
        <script>
        (function() {
            let pending = null;
            document.addEventListener('keydown', function(e) {
                if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA' || e.target.tagName === 'SELECT' || e.target.isContentEditable) return;
                if (e.metaKey || e.ctrlKey || e.altKey) return;

                const key = e.key.toLowerCase();

                if (pending === 'g') {
                    pending = null;
                    const routes = {
                        'h': '{{ url("/home") }}',
                        'u': '{{ url("/users") }}',
                        'n': '{{ route("notifications.index") }}',
                        'p': '{{ route("profile.show") }}',
                        's': '{{ url("/settings") }}',
                        'a': '{{ url("/activity") }}',
                        'r': '{{ url("/roles") }}',
                        't': '{{ route("themes.index") }}',
                    };
                    if (routes[key]) {
                        e.preventDefault();
                        window.location.href = routes[key];
                    }
                    return;
                }

                if (key === 'g') {
                    pending = 'g';
                    setTimeout(function() { pending = null; }, 1000);
                    return;
                }

                if (key === '?' && !e.shiftKey) return;
                if (key === '?' || (e.shiftKey && key === '/')) {
                    e.preventDefault();
                    const el = document.getElementById('keyboard-shortcuts-modal');
                    if (el) el.__x.$data.open = !el.__x.$data.open;
                }
            });
        })();
        </script>

        {{-- Keyboard shortcuts help modal --}}
        <div id="keyboard-shortcuts-modal" x-data="{ open: false }" x-show="open" x-cloak @keydown.escape.window="open = false" class="fixed inset-0 z-[100] overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4" @click="open = false">
                <div class="relative w-full max-w-md rounded-xl bg-white dark:bg-[#161615] shadow-2xl ring-1 ring-[#e3e3e0] dark:ring-[#3E3E3A] p-6" @click.stop>
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Keyboard Shortcuts</h3>
                        <button @click="open = false" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>
                    <div class="space-y-3 text-sm">
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-medium tracking-wide">Navigation (press g then...)</p>
                        <div class="grid grid-cols-2 gap-y-2 gap-x-4">
                            <div class="flex items-center gap-2"><kbd class="px-1.5 py-0.5 bg-gray-100 dark:bg-gray-800 rounded text-xs font-mono">g h</kbd> <span class="text-gray-600 dark:text-gray-400">Home</span></div>
                            <div class="flex items-center gap-2"><kbd class="px-1.5 py-0.5 bg-gray-100 dark:bg-gray-800 rounded text-xs font-mono">g u</kbd> <span class="text-gray-600 dark:text-gray-400">Users</span></div>
                            <div class="flex items-center gap-2"><kbd class="px-1.5 py-0.5 bg-gray-100 dark:bg-gray-800 rounded text-xs font-mono">g n</kbd> <span class="text-gray-600 dark:text-gray-400">Notifications</span></div>
                            <div class="flex items-center gap-2"><kbd class="px-1.5 py-0.5 bg-gray-100 dark:bg-gray-800 rounded text-xs font-mono">g p</kbd> <span class="text-gray-600 dark:text-gray-400">Profile</span></div>
                            <div class="flex items-center gap-2"><kbd class="px-1.5 py-0.5 bg-gray-100 dark:bg-gray-800 rounded text-xs font-mono">g s</kbd> <span class="text-gray-600 dark:text-gray-400">Settings</span></div>
                            <div class="flex items-center gap-2"><kbd class="px-1.5 py-0.5 bg-gray-100 dark:bg-gray-800 rounded text-xs font-mono">g a</kbd> <span class="text-gray-600 dark:text-gray-400">Activity</span></div>
                            <div class="flex items-center gap-2"><kbd class="px-1.5 py-0.5 bg-gray-100 dark:bg-gray-800 rounded text-xs font-mono">g r</kbd> <span class="text-gray-600 dark:text-gray-400">Roles</span></div>
                            <div class="flex items-center gap-2"><kbd class="px-1.5 py-0.5 bg-gray-100 dark:bg-gray-800 rounded text-xs font-mono">g t</kbd> <span class="text-gray-600 dark:text-gray-400">Themes</span></div>
                        </div>
                        <hr class="border-gray-200 dark:border-gray-700">
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-medium tracking-wide">General</p>
                        <div class="flex items-center gap-2"><kbd class="px-1.5 py-0.5 bg-gray-100 dark:bg-gray-800 rounded text-xs font-mono">?</kbd> <span class="text-gray-600 dark:text-gray-400">Show this help</span></div>
                    </div>
                </div>
            </div>
        </div>
        @endauth
    </body>
</html>
