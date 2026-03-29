{{-- Command Palette (Cmd+K / Ctrl+K) --}}
<div x-data="commandPalette()" x-show="open" x-cloak @keydown.meta.k.window.prevent="toggle()" @keydown.ctrl.k.window.prevent="toggle()" @keydown.escape="close()" @open-command-palette.window="toggle()" class="fixed inset-0 z-[110]">
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" @click="close()" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

    <div class="fixed inset-x-0 top-[15vh] mx-auto max-w-xl px-4" @click.self="close()" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
        <div class="rounded-xl bg-white dark:bg-[#1e1e1d] shadow-2xl ring-1 ring-[#e3e3e0] dark:ring-[#3E3E3A] overflow-hidden">
            {{-- Search input --}}
            <div class="flex items-center gap-3 px-4 border-b border-gray-200 dark:border-gray-700">
                <svg class="h-5 w-5 text-gray-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
                <input
                    x-ref="input"
                    x-model="query"
                    @input.debounce.200ms="search()"
                    @keydown.arrow-down.prevent="moveDown()"
                    @keydown.arrow-up.prevent="moveUp()"
                    @keydown.enter.prevent="go()"
                    type="text"
                    placeholder="Search pages and actions..."
                    class="flex-1 py-3.5 bg-transparent text-sm text-gray-900 dark:text-gray-100 placeholder-gray-400 outline-none border-0 focus:ring-0"
                >
                <kbd class="hidden sm:inline-flex items-center px-1.5 py-0.5 bg-gray-100 dark:bg-gray-800 rounded text-[10px] font-mono text-gray-400">ESC</kbd>
            </div>

            {{-- Results (only when typing) --}}
            <div class="max-h-80 overflow-y-auto py-2" x-show="query.length >= 2 && allItems().length > 0">
                {{-- Matching pages --}}
                <template x-if="filteredPages().length > 0">
                    <div>
                        <p class="px-4 py-1.5 text-xs font-medium text-gray-400 uppercase tracking-wide">Pages</p>
                        <template x-for="(page, index) in filteredPages()" :key="'page-' + page.url">
                            <a :href="page.url"
                               :class="{ 'bg-blue-50 dark:bg-blue-900/20': selectedIndex === index }"
                               class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800/50 cursor-pointer"
                               @mouseenter="selectedIndex = index">
                                <span class="inline-flex items-center justify-center h-7 w-7 rounded-md bg-gray-100 dark:bg-gray-800 text-gray-500">
                                    <span x-html="page.icon"></span>
                                </span>
                                <span x-text="page.name" class="flex-1 font-medium"></span>
                            </a>
                        </template>
                    </div>
                </template>

                        {{-- API results --}}
                        <template x-if="apiResults.length > 0">
                            <div>
                                <p class="px-4 py-1.5 text-xs font-medium text-gray-400 uppercase tracking-wide">Results</p>
                                <template x-for="(item, i) in apiResults" :key="item._search_url || i">
                                    <a :href="item._search_url || '#'"
                                       :class="{ 'bg-blue-50 dark:bg-blue-900/20': selectedIndex === (filteredPages().length + i) }"
                                       class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800/50 cursor-pointer"
                                       @mouseenter="selectedIndex = filteredPages().length + i">
                                        <span class="inline-flex items-center justify-center h-7 w-7 rounded-full bg-gray-200 dark:bg-gray-700 text-xs font-medium text-gray-600 dark:text-gray-300" x-text="(item._search_title || '?').charAt(0).toUpperCase()"></span>
                                        <span class="flex-1">
                                            <span x-text="item._search_title" class="font-medium"></span>
                                            <span x-text="item._search_subtitle" class="ml-2 text-gray-400 text-xs"></span>
                                        </span>
                                    </a>
                                </template>
                            </div>
                        </template>
                    </div>
                </template>
            </div>

            {{-- Empty state --}}
            <div x-show="query.length >= 2 && allItems().length === 0 && !loading" class="py-8 text-center">
                <p class="text-sm text-gray-500 dark:text-gray-400">No results for "<span x-text="query"></span>"</p>
            </div>

            {{-- Loading --}}
            <div x-show="loading" x-cloak class="py-6 text-center">
                <svg class="animate-spin h-5 w-5 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/></svg>
            </div>

            {{-- Footer --}}
            <div class="flex items-center justify-between px-4 py-2.5 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-[#161615]">
                <div class="flex items-center gap-3 text-[11px] text-gray-400">
                    <span><kbd class="px-1 py-0.5 bg-gray-200 dark:bg-gray-700 rounded font-mono">&uarr;&darr;</kbd> navigate</span>
                    <span><kbd class="px-1 py-0.5 bg-gray-200 dark:bg-gray-700 rounded font-mono">&crarr;</kbd> open</span>
                    <span><kbd class="px-1 py-0.5 bg-gray-200 dark:bg-gray-700 rounded font-mono">esc</kbd> close</span>
                </div>
                <span class="text-[11px] text-gray-400">Type to search</span>
            </div>
        </div>
    </div>
</div>

<script>
function commandPalette() {
    @php $navIcon = fn($d) => '<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="'.$d.'" /></svg>'; @endphp
    return {
        open: false,
        query: '',
        apiResults: [],
        loading: false,
        selectedIndex: 0,
        pages: [
            { name: 'Home', url: '{{ url("/home") }}', icon: '{!! $navIcon("M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25") !!}' },
            { name: 'Notifications', url: '{{ route("notifications.index") }}', icon: '{!! $navIcon("M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0") !!}' },
            { name: 'Profile', url: '{{ route("profile.show") }}', icon: '{!! $navIcon("M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z") !!}' },
            { name: 'Themes', url: '{{ route("themes.index") }}', icon: '{!! $navIcon("M4.098 19.902a3.75 3.75 0 005.304 0l6.401-6.402M6.75 21A3.75 3.75 0 013 17.25V4.125C3 3.504 3.504 3 4.125 3h5.25c.621 0 1.125.504 1.125 1.125v4.072M6.75 21a3.75 3.75 0 003.75-3.75V8.197") !!}' },
            { name: 'Messages', url: '{{ route("chat.index") }}', icon: '{!! $navIcon("M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z") !!}' },
            { name: 'Posts', url: '{{ url("/posts") }}', icon: '{!! $navIcon("M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z") !!}' },
            @level(5)
            { name: 'Users', url: '{{ url("/users") }}', icon: '{!! $navIcon("M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z") !!}' },
            { name: 'Settings', url: '{{ url("/settings") }}', icon: '{!! $navIcon("M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594") !!}' },
            { name: 'Activity Log', url: '{{ url("/activity") }}', icon: '{!! $navIcon("M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z") !!}' },
            { name: 'Roles', url: '{{ url("/roles") }}', icon: '{!! $navIcon("M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z") !!}' },
            { name: 'Blocker', url: '{{ url("/blocker") }}', icon: '{!! $navIcon("M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636") !!}' },
            @endlevel
        ],

        toggle() {
            this.open = !this.open;
            if (this.open) {
                this.query = '';
                this.apiResults = [];
                this.selectedIndex = 0;
                this.$nextTick(() => this.$refs.input.focus());
            }
        },

        close() {
            this.open = false;
        },

        filteredPages() {
            if (this.query.length < 2) return [];
            const q = this.query.toLowerCase();
            return this.pages.filter(p => p.name.toLowerCase().includes(q));
        },

        allItems() {
            if (this.query.length < 2) return [];
            return [...this.filteredPages(), ...this.apiResults];
        },

        search() {
            if (this.query.length < 2) {
                this.apiResults = [];
                this.selectedIndex = 0;
                return;
            }

            // Always filter pages client-side (instant)
            this.selectedIndex = 0;

            // Also query backend API for DB results
            this.loading = true;
            fetch('{{ route("simple-search") }}?q=' + encodeURIComponent(this.query), {
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]')?.content,
                }
            })
            .then(r => r.json())
            .then(data => {
                this.apiResults = Object.values(data.results || {}).flat().slice(0, 8);
                this.loading = false;
            })
            .catch(() => {
                this.apiResults = [];
                this.loading = false;
            });
        },

        moveDown() {
            const items = this.allItems();
            if (this.selectedIndex < items.length - 1) this.selectedIndex++;
        },

        moveUp() {
            if (this.selectedIndex > 0) this.selectedIndex--;
        },

        go() {
            const items = this.allItems();
            const item = items[this.selectedIndex];
            if (!item) return;

            if (item.url) {
                window.location.href = item.url;
            } else if (item._search_url) {
                window.location.href = item._search_url;
            }
        }
    };
}
</script>
