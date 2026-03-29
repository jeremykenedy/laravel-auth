<nav class="sticky top-0 z-40 bg-white dark:bg-[#161615] border-b border-[#e3e3e0] dark:border-[#3E3E3A] shadow-sm" x-data="{ mobileOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            {{-- Left side: Brand + Chat + Bell + Search + Admin dropdown --}}
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="text-xl font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">
                    {{ config('app.name', 'Laravel') }}
                </a>

                {{-- Dark mode toggle + Chat + Bell + Search (left side, after brand) --}}
                <div class="hidden sm:flex sm:items-center sm:ml-6 sm:gap-1">
                    <x-darkmode-toggle />
                </div>
                @auth
                    <div class="hidden sm:flex sm:items-center sm:ml-1 sm:gap-1" x-data="navCounters()" x-init="init()">
                        <a href="{{ route('chat.index') }}" class="relative p-2 rounded-md text-[#706f6c] hover:text-[#1b1b18] dark:text-[#A1A09A] dark:hover:text-[#EDEDEC] hover:bg-gray-100 dark:hover:bg-[#1b1b18] transition-colors" title="Messages">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                            <span x-show="chatCount > 0" x-cloak x-text="chatCount > 99 ? '99+' : chatCount" class="absolute -top-1 -right-1 flex items-center justify-center h-[18px] min-w-[18px] px-1 text-[10px] font-bold leading-none text-white bg-blue-500 rounded-full"></span>
                        </a>
                        <a href="{{ route('notifications.index') }}" class="relative p-2 rounded-md text-[#706f6c] hover:text-[#1b1b18] dark:text-[#A1A09A] dark:hover:text-[#EDEDEC] hover:bg-gray-100 dark:hover:bg-[#1b1b18] transition-colors" title="Notifications">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" /></svg>
                            <span x-show="notifCount > 0" x-cloak x-text="notifCount > 99 ? '99+' : notifCount" class="absolute -top-1 -right-1 flex items-center justify-center h-[18px] min-w-[18px] px-1 text-[10px] font-bold leading-none text-white bg-red-500 rounded-full"></span>
                        </a>
                        <button onclick="window.dispatchEvent(new CustomEvent('open-command-palette'))" class="hidden md:inline-flex items-center gap-1 ml-1 p-2 rounded-md text-[#706f6c] hover:text-[#1b1b18] dark:text-[#A1A09A] dark:hover:text-[#EDEDEC] hover:bg-gray-100 dark:hover:bg-[#1b1b18] transition-colors" title="Search (&#8984;K)">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
                            <kbd class="px-1 py-0.5 bg-gray-100 dark:bg-[#0a0a0a] rounded text-[10px] font-mono text-[#706f6c] dark:text-[#A1A09A] border border-gray-200 dark:border-gray-600">&#8984;K</kbd>
                        </button>
                    </div>
                    <script>
                        function navCounters() {
                            return {
                                notifCount: 0, chatCount: 0, interval: null,
                                init() {
                                    this.fetchCounts();
                                    this.listenForRealtime();
                                    this.interval = setInterval(() => this.fetchCounts(), 60000);
                                },
                                fetchCounts() {
                                    fetch('{{ route("notifications.count") }}', { headers: { Accept: 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]')?.content } })
                                        .then(r => r.json()).then(d => { this.notifCount = d.count || 0; }).catch(() => {});
                                    fetch('{{ route("chat.conversations") }}', { headers: { Accept: 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]')?.content } })
                                        .then(r => r.json()).then(convos => { let t = 0; (convos||[]).forEach(c => { if(c.unread_count) t += c.unread_count; }); this.chatCount = t; }).catch(() => {});
                                },
                                listenForRealtime() {
                                    if (typeof window.Echo === 'undefined') return;
                                    window.Echo.private('notifications.{{ auth()->id() }}')
                                        .listen('.notification.created', (e) => {
                                            this.notifCount = e.count || (this.notifCount + 1);
                                        });
                                    fetch('{{ route("chat.conversations") }}', { headers: { Accept: 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]')?.content } })
                                        .then(r => r.json())
                                        .then(convos => {
                                            (convos || []).forEach(c => {
                                                window.Echo.private('chat.conversation.' + c.id)
                                                    .listen('.message.sent', () => {
                                                        this.chatCount++;
                                                    });
                                            });
                                        }).catch(() => {});
                                },
                                destroy() { if (this.interval) clearInterval(this.interval); }
                            };
                        }
                    </script>
                @endauth

                {{-- Admin dropdown (desktop, after icons) --}}
                @auth
                    @level(5)
                        <div class="hidden sm:ml-4 sm:flex sm:items-center relative" x-data="{ open: false }">
                            <button @click="open = !open" class="inline-flex items-center px-3 py-2 text-sm font-medium text-[#706f6c] hover:text-[#1b1b18] dark:text-[#A1A09A] dark:hover:text-[#EDEDEC]">
                                Admin
                                <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div x-show="open" x-cloak @click.away="open = false" x-transition class="absolute left-0 top-full mt-1 w-48 rounded-lg bg-white dark:bg-[#161615] shadow-lg ring-1 ring-[#e3e3e0] dark:ring-[#3E3E3A] z-50">
                                <div class="py-1">
                                    <a href="{{ route('laravelroles::roles.index') }}" class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/50">Roles & Permissions</a>
                                    <hr class="my-1 border-[#e3e3e0] dark:border-[#3E3E3A]">
                                    <a href="{{ url('/users') }}" class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/50">Users</a>
                                    <a href="{{ url('/users/create') }}" class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/50">New User</a>
                                    <hr class="my-1 border-[#e3e3e0] dark:border-[#3E3E3A]">
                                    <a href="{{ route('admin.posts.index') }}" class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/50">Posts</a>
                                    <hr class="my-1 border-[#e3e3e0] dark:border-[#3E3E3A]">
                                    <a href="{{ url('/activity') }}" class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/50">Activity</a>
                                    <a href="{{ route('login-history.admin.index') }}" class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/50">Login History</a>
                                    <a href="{{ route('laravelblocker::blocker.index') }}" class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/50">Blocker</a>
                                    <a href="{{ route('notifications.send.create') }}" class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/50">Send Notification</a>
                                    <hr class="my-1 border-[#e3e3e0] dark:border-[#3E3E3A]">
                                    <a href="{{ url('/phpinfo') }}" class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/50">PHP Info</a>
                                    <a href="{{ route('admin.routes') }}" class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/50">Routes</a>
                                    <a href="{{ url('/log-viewer') }}" class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/50">Logs</a>
                                    <a href="{{ url('/horizon') }}" class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/50">Horizon</a>
                                    <a href="{{ route('health-checks') }}" class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/50">Health Checks</a>
                                    <hr class="my-1 border-[#e3e3e0] dark:border-[#3E3E3A]">
                                    <a href="{{ route('admin.settings') }}" class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/50">Settings</a>
                                </div>
                            </div>
                        </div>
                    @endlevel
                @endauth
            </div>

            {{-- Right side (desktop) --}}
            <div class="hidden sm:flex sm:items-center sm:gap-4">
                @guest
                    <a href="{{ route('login') }}" class="inline-block px-5 py-1.5 text-sm text-[#1b1b18] dark:text-[#EDEDEC] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="inline-block px-5 py-1.5 text-sm text-[#1b1b18] dark:text-[#EDEDEC] border border-[#19140035] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm">Register</a>
                    @endif
                @else
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="inline-flex items-center px-3 py-2 text-sm font-medium text-[#706f6c] hover:text-[#1b1b18] dark:text-[#A1A09A] dark:hover:text-[#EDEDEC]">
                            {{ Auth::user()->name }}
                            <x-avatar :src="Auth::user()->getAvatarUrl(28)" :alt="Auth::user()->name" size="xs" class="ml-2" />
                            <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="open" x-cloak @click.away="open = false" x-transition class="absolute right-0 top-full mt-1 w-48 rounded-lg bg-white dark:bg-[#161615] shadow-lg ring-1 ring-[#e3e3e0] dark:ring-[#3E3E3A] z-50">
                            <div class="py-1">
                                <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/50">Profile</a>
                                <a href="{{ route('notifications.index') }}" class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/50">Notifications</a>
                                <a href="{{ route('profile.sessions') }}" class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/50">Sessions</a>
                                <a href="{{ route('login-history.index') }}" class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/50">Login History</a>
                                <hr class="my-1 border-[#e3e3e0] dark:border-[#3E3E3A]">
                                <form method="POST" action="{{ route('logout') }}">@csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/50">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endguest
            </div>

            {{-- Mobile: theme toggle + hamburger --}}
            <div class="flex items-center gap-2 sm:hidden">
                <x-darkmode-toggle />
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
                <div class="flex items-center gap-2 py-2">
                    <x-avatar :src="Auth::user()->getAvatarUrl(24)" :alt="Auth::user()->name" size="xs" />
                    <span class="text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC]">{{ Auth::user()->name }}</span>
                </div>
                <a href="{{ route('chat.index') }}" class="block py-2 text-sm text-[#706f6c]">Messages</a>
                <a href="{{ route('notifications.index') }}" class="block py-2 text-sm text-[#706f6c]">Notifications</a>
                <a href="{{ route('profile.show') }}" class="block py-2 text-sm text-[#706f6c]">Profile</a>
                <a href="{{ route('login-history.index') }}" class="block py-2 text-sm text-[#706f6c]">Login History</a>
                @level(5)
                    <hr class="my-1 border-[#e3e3e0] dark:border-[#3E3E3A]">
                    <a href="{{ url('/users') }}" class="block py-2 text-sm text-[#706f6c]">Users</a>
                    <a href="{{ route('admin.posts.index') }}" class="block py-2 text-sm text-[#706f6c]">Posts</a>
                    <a href="{{ url('/activity') }}" class="block py-2 text-sm text-[#706f6c]">Activity</a>
                    <a href="{{ route('login-history.admin.index') }}" class="block py-2 text-sm text-[#706f6c]">Login History</a>
                    <a href="{{ url('/blocker') }}" class="block py-2 text-sm text-[#706f6c]">Blocker</a>
                    <a href="{{ route('admin.settings') }}" class="block py-2 text-sm text-[#706f6c]">Settings</a>
                    <a href="{{ url('/horizon') }}" class="block py-2 text-sm text-[#706f6c]">Horizon</a>
                    <a href="{{ route('health-checks') }}" class="block py-2 text-sm text-[#706f6c]">Health Checks</a>
                @endlevel
                <hr class="my-1 border-[#e3e3e0] dark:border-[#3E3E3A]">
                <form method="POST" action="{{ route('logout') }}">@csrf
                    <button type="submit" class="block w-full text-left py-2 text-sm text-[#706f6c]">Logout</button>
                </form>
            @endguest
        </div>
    </div>
</nav>
