<div class="max-w-4xl mx-auto space-y-6">
    @include('panels.welcome-panel')

    {{-- Admin Dashboard Stats --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <x-ui::stat-card value="{{ \App\Models\User::count() }}" label="Total Users" icon="users" href="{{ url('/users') }}" />
        <x-ui::stat-card value="{{ \App\Models\User::whereNotNull('email_verified_at')->count() }}" label="Verified Users" variant="success" icon="check" />
        <x-ui::stat-card value="{{ \Illuminate\Support\Facades\DB::table('sessions')->whereNotNull('user_id')->distinct('user_id')->count('user_id') }}" label="Active Sessions" variant="primary" icon="globe" />
        <x-ui::stat-card value="{{ \App\Models\User::onlyTrashed()->count() }}" label="Deleted Users" variant="warning" icon="trash" href="{{ url('/users/deleted') }}" />
    </div>

    {{-- Quick Actions --}}
    <x-ui::card title="Quick Actions">
        <div class="flex flex-wrap gap-2">
            <x-ui::button href="{{ url('/users/create') }}" variant="primary" size="sm" icon="plus">New User</x-ui::button>
            <x-ui::button href="{{ route('admin.posts.create') }}" variant="primary" size="sm" icon="edit">New Post</x-ui::button>
            <x-ui::button href="{{ url('/activity') }}" variant="secondary" size="sm" icon="eye">Activity Log</x-ui::button>
            <x-ui::button href="{{ url('/blocker') }}" variant="secondary" size="sm" icon="shield">Blocker</x-ui::button>
            <x-ui::button href="{{ url('/roles') }}" variant="secondary" size="sm" icon="users">Roles</x-ui::button>
            <x-ui::button href="{{ route('admin.settings') }}" variant="secondary" size="sm" icon="cog">Settings</x-ui::button>
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
                                    <x-ui::avatar :src="$user->profile?->avatar" :alt="$user->name" size="sm" />
                                    <span class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full ring-2 ring-white dark:ring-gray-900 {{ (now()->timestamp - $session->last_activity) < 300 ? 'bg-green-400' : 'bg-gray-300' }}"></span>
                                </div>
                                <div>
                                    <a href="{{ url('users/' . $user->id) }}" class="text-sm font-medium text-gray-900 dark:text-gray-100 hover:underline">{{ $user->name }}</a>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ \Illuminate\Support\Carbon::createFromTimestamp($session->last_activity)->diffForHumans() }}</p>
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
</div>
