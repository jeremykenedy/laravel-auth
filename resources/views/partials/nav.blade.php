<nav class="sticky top-0 z-40 bg-white dark:bg-[#161615] border-b border-[#e3e3e0] dark:border-[#3E3E3A] shadow-sm" x-data="{ mobileOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            {{-- Brand --}}
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="text-xl font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">
                    {{ config('app.name', 'Laravel') }}
                </a>

                {{-- Admin dropdown (desktop) --}}
                @auth
                    @level(5)
                        <div class="hidden sm:ml-8 sm:flex sm:items-center relative" x-data="{ open: false }">
                            <button @click="open = !open" class="inline-flex items-center px-3 py-2 text-sm font-medium text-[#706f6c] hover:text-[#1b1b18] dark:text-[#A1A09A] dark:hover:text-[#EDEDEC]">
                                Admin
                                <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div x-show="open" x-cloak @click.away="open = false" x-transition class="absolute left-0 top-full mt-1 w-48 rounded-lg bg-white dark:bg-[#161615] shadow-lg ring-1 ring-[#e3e3e0] dark:ring-[#3E3E3A] z-50">
                                <div class="py-1">
                                    <a href="{{ route('laravelroles::roles.index') }}" class="block px-4 py-2 text-sm text-[#706f6c] hover:bg-gray-50 dark:hover:bg-[#1b1b18] {{ Request::is('roles', 'permissions') ? 'text-[#1b1b18] dark:text-[#EDEDEC] font-medium' : '' }}">Roles & Permissions</a>
                                    <hr class="my-1 border-[#e3e3e0] dark:border-[#3E3E3A]">
                                    <a href="{{ url('/users') }}" class="block px-4 py-2 text-sm text-[#706f6c] hover:bg-gray-50 dark:hover:bg-[#1b1b18] {{ Request::is('users', 'users/*') ? 'text-[#1b1b18] dark:text-[#EDEDEC] font-medium' : '' }}">Users</a>
                                    <a href="{{ url('/users/create') }}" class="block px-4 py-2 text-sm text-[#706f6c] hover:bg-gray-50 dark:hover:bg-[#1b1b18]">New User</a>
                                    <hr class="my-1 border-[#e3e3e0] dark:border-[#3E3E3A]">
                                    <a href="{{ route('themes.index') }}" class="block px-4 py-2 text-sm text-[#706f6c] hover:bg-gray-50 dark:hover:bg-[#1b1b18]">Themes</a>
                                    <a href="{{ route('admin.posts.index') }}" class="block px-4 py-2 text-sm text-[#706f6c] hover:bg-gray-50 dark:hover:bg-[#1b1b18]">Posts</a>
                                    <hr class="my-1 border-[#e3e3e0] dark:border-[#3E3E3A]">
                                    <a href="{{ url('/activity') }}" class="block px-4 py-2 text-sm text-[#706f6c] hover:bg-gray-50 dark:hover:bg-[#1b1b18]">Activity</a>
                                    <a href="{{ route('laravelblocker::blocker.index') }}" class="block px-4 py-2 text-sm text-[#706f6c] hover:bg-gray-50 dark:hover:bg-[#1b1b18]">Blocker</a>
                                    <hr class="my-1 border-[#e3e3e0] dark:border-[#3E3E3A]">
                                    <a href="{{ url('/phpinfo') }}" class="block px-4 py-2 text-sm text-[#706f6c] hover:bg-gray-50 dark:hover:bg-[#1b1b18]">PHP Info</a>
                                    <a href="{{ route('admin.routes') }}" class="block px-4 py-2 text-sm text-[#706f6c] hover:bg-gray-50 dark:hover:bg-[#1b1b18]">Routes</a>
                                    <a href="{{ url('/log-viewer') }}" class="block px-4 py-2 text-sm text-[#706f6c] hover:bg-gray-50 dark:hover:bg-[#1b1b18]">Logs</a>
                                    <hr class="my-1 border-[#e3e3e0] dark:border-[#3E3E3A]">
                                    <a href="{{ route('admin.settings') }}" class="block px-4 py-2 text-sm text-[#706f6c] hover:bg-gray-50 dark:hover:bg-[#1b1b18] {{ Request::is('settings') ? 'text-[#1b1b18] dark:text-[#EDEDEC] font-medium' : '' }}">Settings</a>
                                </div>
                            </div>
                        </div>
                    @endlevel
                @endauth
            </div>

            {{-- Right side (desktop) --}}
            <div class="hidden sm:flex sm:items-center sm:gap-4">
                <x-ui::theme-toggle />

                @auth
                    {{-- Notification bell --}}
                    <div class="relative" x-data="{ nOpen: false, count: 0 }" x-init="fetch('{{ route('notifications.count') }}', { headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]')?.content } }).then(r => r.json()).then(d => count = d.count || 0).catch(() => {})">
                        <a href="{{ route('notifications.index') }}" class="relative p-2 rounded-md text-[#706f6c] hover:text-[#1b1b18] dark:text-[#A1A09A] dark:hover:text-[#EDEDEC] hover:bg-gray-100 dark:hover:bg-[#1b1b18] transition-colors">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" /></svg>
                            <span x-show="count > 0" x-cloak x-text="count" class="absolute -top-0.5 -right-0.5 inline-flex items-center justify-center h-4 min-w-[1rem] px-1 text-[10px] font-bold text-white bg-red-500 rounded-full"></span>
                        </a>
                    </div>
                @endauth

                @guest
                    <a href="{{ route('login') }}" class="inline-block px-5 py-1.5 text-sm text-[#1b1b18] dark:text-[#EDEDEC] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="inline-block px-5 py-1.5 text-sm text-[#1b1b18] dark:text-[#EDEDEC] border border-[#19140035] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm">Register</a>
                    @endif
                @else
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="inline-flex items-center px-3 py-2 text-sm font-medium text-[#706f6c] hover:text-[#1b1b18] dark:text-[#A1A09A] dark:hover:text-[#EDEDEC]">
                            @if (Auth::user()->profile?->avatar_status == 1)
                                <x-ui::avatar :src="Auth::user()->profile->avatar" :alt="Auth::user()->name" size="xs" class="mr-2" />
                            @endif
                            {{ Auth::user()->name }}
                            <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="open" x-cloak @click.away="open = false" x-transition class="absolute right-0 top-full mt-1 w-48 rounded-lg bg-white dark:bg-[#161615] shadow-lg ring-1 ring-[#e3e3e0] dark:ring-[#3E3E3A] z-50">
                            <div class="py-1">
                                <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-[#706f6c] hover:bg-gray-50 dark:hover:bg-[#1b1b18]">Profile</a>
                                <a href="{{ route('notifications.index') }}" class="block px-4 py-2 text-sm text-[#706f6c] hover:bg-gray-50 dark:hover:bg-[#1b1b18]">Notifications</a>
                                <a href="{{ route('profile.sessions') }}" class="block px-4 py-2 text-sm text-[#706f6c] hover:bg-gray-50 dark:hover:bg-[#1b1b18]">Sessions</a>
                                <hr class="my-1 border-[#e3e3e0] dark:border-[#3E3E3A]">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-[#706f6c] hover:bg-gray-50 dark:hover:bg-[#1b1b18]">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endguest
            </div>

            {{-- Mobile: theme toggle + hamburger --}}
            <div class="flex items-center gap-2 sm:hidden">
                <x-ui::theme-toggle />
                <button @click="mobileOpen = !mobileOpen" class="p-2 rounded-md text-[#706f6c] hover:text-[#1b1b18] dark:text-[#A1A09A] dark:hover:text-[#EDEDEC]">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="mobileOpen ? 'M6 18L18 6M6 6l12 12' : 'M4 6h16M4 12h16M4 18h16'" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div x-show="mobileOpen" x-cloak x-transition class="sm:hidden border-t border-[#e3e3e0] dark:border-[#3E3E3A]">
        <div class="py-2 px-4 space-y-1">
            @guest
                <a href="{{ route('login') }}" class="block py-2 text-sm text-[#706f6c]">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="block py-2 text-sm text-[#706f6c]">Register</a>
                @endif
            @else
                <a href="{{ route('profile.show') }}" class="block py-2 text-sm text-[#706f6c]">Profile</a>
                @level(5)
                    <hr class="my-1 border-[#e3e3e0] dark:border-[#3E3E3A]">
                    <a href="{{ url('/users') }}" class="block py-2 text-sm text-[#706f6c]">Users</a>
                    <a href="{{ route('themes.index') }}" class="block py-2 text-sm text-[#706f6c]">Themes</a>
                    <a href="{{ route('admin.posts.index') }}" class="block py-2 text-sm text-[#706f6c]">Posts</a>
                    <a href="{{ url('/activity') }}" class="block py-2 text-sm text-[#706f6c]">Activity</a>
                    <a href="{{ url('/blocker') }}" class="block py-2 text-sm text-[#706f6c]">Blocker</a>
                    <a href="{{ route('admin.settings') }}" class="block py-2 text-sm text-[#706f6c]">Settings</a>
                @endlevel
                <hr class="my-1 border-[#e3e3e0] dark:border-[#3E3E3A]">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left py-2 text-sm text-[#706f6c]">Logout</button>
                </form>
            @endguest
        </div>
    </div>
</nav>
