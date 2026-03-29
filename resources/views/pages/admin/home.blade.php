<div class="max-w-7xl mx-auto space-y-6">
    @include('panels.welcome-panel')

    {{-- Admin Dashboard Stats --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <x-ui::stat-card value="{{ \App\Models\User::count() }}" label="Total Users" icon="users" href="{{ url('/users') }}" />
        <x-ui::stat-card value="{{ \App\Models\User::whereNotNull('email_verified_at')->count() }}" label="Verified Users" variant="success" icon="check" />
        <x-ui::stat-card value="{{ \Illuminate\Support\Facades\DB::table('sessions')->whereNotNull('user_id')->distinct('user_id')->count('user_id') }}" label="Active Sessions" variant="primary" icon="globe" />
        <x-ui::stat-card value="{{ \App\Models\User::onlyTrashed()->count() }}" label="Deleted Users" variant="warning" icon="trash" href="{{ url('/users/deleted') }}" />
    </div>

    {{-- Registration Chart (Last 30 Days) --}}
    @php
        $registrationData = collect(range(29, 0))->map(function ($daysAgo) {
            $date = now()->subDays($daysAgo)->format('Y-m-d');
            return [
                'date' => now()->subDays($daysAgo)->format('M d'),
                'count' => \App\Models\User::whereDate('created_at', $date)->count(),
            ];
        });
        $maxCount = max($registrationData->max('count'), 1);
        $totalNew = $registrationData->sum('count');
        $chartWidth = 100;
        $chartHeight = 40;
        $points = $registrationData->values()->map(function ($item, $index) use ($chartWidth, $chartHeight, $maxCount) {
            $x = ($index / 29) * $chartWidth;
            $y = $chartHeight - (($item['count'] / $maxCount) * ($chartHeight - 4)) - 2;
            return "{$x},{$y}";
        })->implode(' ');
        $areaPoints = "0,{$chartHeight} " . $points . " {$chartWidth},{$chartHeight}";
    @endphp
    <x-ui::card>
        <x-slot name="header">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">User Registrations</h3>
                <div class="text-right">
                    <span class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $totalNew }}</span>
                    <span class="text-sm text-gray-500 dark:text-gray-400 ml-1">last 30 days</span>
                </div>
            </div>
        </x-slot>
        <div class="relative">
            <svg viewBox="0 0 {{ $chartWidth }} {{ $chartHeight }}" class="w-full h-24" preserveAspectRatio="none">
                <polygon points="{{ $areaPoints }}" fill="url(#chartGradient)" />
                <polyline points="{{ $points }}" fill="none" stroke="rgb(59, 130, 246)" stroke-width="0.8" stroke-linejoin="round" stroke-linecap="round" />
                <defs>
                    <linearGradient id="chartGradient" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0%" stop-color="rgb(59, 130, 246)" stop-opacity="0.2" />
                        <stop offset="100%" stop-color="rgb(59, 130, 246)" stop-opacity="0.02" />
                    </linearGradient>
                </defs>
            </svg>
            <div class="flex justify-between text-[10px] text-gray-400 dark:text-gray-500 mt-1">
                <span>{{ $registrationData->first()['date'] }}</span>
                <span>{{ $registrationData->slice(14, 1)->first()['date'] }}</span>
                <span>{{ $registrationData->last()['date'] }}</span>
            </div>
        </div>
    </x-ui::card>

    {{-- Quick Actions --}}
    <x-ui::card title="Quick Actions">
        <div class="flex flex-wrap gap-2">
            <x-ui::button href="{{ url('/users/create') }}" variant="primary" size="sm" icon="plus">New User</x-ui::button>
            <x-ui::button href="{{ route('admin.posts.create') }}" variant="primary" size="sm" icon="edit">New Post</x-ui::button>
            <x-ui::button href="{{ url('/activity') }}" variant="secondary" size="sm" icon="eye">Activity Log</x-ui::button>
            <x-ui::button href="{{ url('/blocker') }}" variant="secondary" size="sm" icon="shield">Blocker</x-ui::button>
            <x-ui::button href="{{ url('/roles') }}" variant="secondary" size="sm" icon="users">Roles</x-ui::button>
            <x-ui::button href="{{ route('admin.settings') }}" variant="secondary" size="sm" icon="cog">Settings</x-ui::button>
            <x-ui::button href="{{ route('notifications.send.create') }}" variant="secondary" size="sm" icon="bell">Send Notification</x-ui::button>
            <x-ui::button href="{{ url('/log-viewer') }}" variant="secondary" size="sm" outline>Log Viewer</x-ui::button>
            <x-ui::button href="{{ url('/health') }}" variant="secondary" size="sm" outline>Health Check</x-ui::button>
        </div>
    </x-ui::card>

    {{-- Recently Active Users --}}
    <x-ui::card title="Recently Active Users">
        @php
            $activeSessions = \Illuminate\Support\Facades\DB::table('sessions')
                ->whereNotNull('user_id')
                ->orderBy('last_activity', 'desc')
                ->limit(10)
                ->get();
            $activeUserIds = $activeSessions->pluck('user_id')->unique();
            $activeUsers = \App\Models\User::whereIn('id', $activeUserIds)->with('roles', 'profile')->get()->keyBy('id');
        @endphp
        @if($activeSessions->isNotEmpty())
            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($activeSessions->unique('user_id') as $session)
                    @php $user = $activeUsers->get($session->user_id); @endphp
                    @if($user)
                        <div class="flex items-center justify-between py-3">
                            <div class="flex items-center gap-3">
                                <div class="relative">
                                    <x-avatar :src="$user->profile?->avatar" :alt="$user->name" size="sm" />
                                    <span class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full ring-2 ring-white dark:ring-gray-900 {{ (now()->timestamp - $session->last_activity) < 300 ? 'bg-green-400' : 'bg-gray-300' }}"></span>
                                </div>
                                <div>
                                    <a href="{{ url('users/' . $user->id) }}" class="text-sm font-medium text-gray-900 dark:text-gray-100 hover:underline">{{ $user->name }}</a>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-500 dark:text-gray-400" data-timestamp="{{ $session->last_activity }}">{{ \Illuminate\Support\Carbon::createFromTimestamp($session->last_activity)->diffForHumans() }}</p>
                                @foreach($user->roles as $role)
                                    <x-ui::badge :variant="$role->level >= 5 ? 'warning' : 'secondary'" size="sm">{{ $role->name }}</x-ui::badge>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @else
            <p class="text-sm text-gray-500 dark:text-gray-400">No active sessions.</p>
        @endif
    </x-ui::card>

    {{-- Recent Registrations --}}
    <x-ui::card>
        <x-slot name="header">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Recent Registrations</h3>
                <x-ui::button href="{{ url('/users') }}" variant="secondary" size="sm" outline>View All</x-ui::button>
            </div>
        </x-slot>
        @php
            $recentUsers = \App\Models\User::with('roles')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
        @endphp
        @if($recentUsers->isNotEmpty())
            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($recentUsers as $recentUser)
                    <div class="flex items-center justify-between py-3">
                        <div class="flex items-center gap-3">
                            <x-avatar :src="$recentUser->getAvatarUrl(32)" :alt="$recentUser->name" size="xs" />
                            <div>
                                <a href="{{ url('users/' . $recentUser->id) }}" class="text-sm font-medium text-gray-900 dark:text-gray-100 hover:underline">{{ $recentUser->name }}</a>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $recentUser->email }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $recentUser->created_at->diffForHumans() }}</p>
                            @foreach($recentUser->roles as $role)
                                <x-ui::badge :variant="$role->level >= 5 ? 'warning' : ($role->slug === 'unverified' ? 'danger' : 'secondary')" size="sm">{{ $role->name }}</x-ui::badge>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-sm text-gray-500 dark:text-gray-400">No users registered yet.</p>
        @endif
    </x-ui::card>

    {{-- System Health --}}
    <x-ui::card title="System Information">
        @php
            $diskFree = disk_free_space('/');
            $diskTotal = disk_total_space('/');
            $diskUsedPct = round((1 - $diskFree / $diskTotal) * 100, 1);
        @endphp
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="space-y-3">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-500 dark:text-gray-400">PHP Version</span>
                    <span class="font-medium text-gray-900 dark:text-gray-100">{{ PHP_VERSION }}</span>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-500 dark:text-gray-400">Laravel Version</span>
                    <span class="font-medium text-gray-900 dark:text-gray-100">{{ app()->version() }}</span>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-500 dark:text-gray-400">Environment</span>
                    <x-ui::badge :variant="app()->environment('production') ? 'danger' : 'success'" size="sm">{{ app()->environment() }}</x-ui::badge>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-500 dark:text-gray-400">Debug Mode</span>
                    <x-ui::badge :variant="config('app.debug') ? 'warning' : 'success'" size="sm">{{ config('app.debug') ? 'On' : 'Off' }}</x-ui::badge>
                </div>
            </div>
            <div class="space-y-3">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-500 dark:text-gray-400">Cache Driver</span>
                    <span class="font-medium text-gray-900 dark:text-gray-100">{{ config('cache.default') }}</span>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-500 dark:text-gray-400">Queue Driver</span>
                    <span class="font-medium text-gray-900 dark:text-gray-100">{{ config('queue.default') }}</span>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-500 dark:text-gray-400">Session Driver</span>
                    <span class="font-medium text-gray-900 dark:text-gray-100">{{ config('session.driver') }}</span>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-500 dark:text-gray-400">Disk Usage</span>
                    <span class="font-medium text-gray-900 dark:text-gray-100">{{ $diskUsedPct }}%</span>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400 mb-1">
                <span>Disk: {{ number_format(($diskTotal - $diskFree) / 1073741824, 1) }}GB / {{ number_format($diskTotal / 1073741824, 1) }}GB</span>
                <span>{{ number_format($diskFree / 1073741824, 1) }}GB free</span>
            </div>
            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                <div class="h-2 rounded-full {{ $diskUsedPct > 90 ? 'bg-red-500' : ($diskUsedPct > 75 ? 'bg-yellow-500' : 'bg-green-500') }}" style="width: {{ $diskUsedPct }}%"></div>
            </div>
        </div>
    </x-ui::card>
</div>
