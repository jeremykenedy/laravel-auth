<div class="max-w-4xl mx-auto space-y-6">
    @include('panels.welcome-panel')

    {{-- Admin Dashboard Stats --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <x-ui::card>
            <div class="text-center">
                <p class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ \App\Models\User::count() }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Total Users</p>
            </div>
        </x-ui::card>
        <x-ui::card>
            <div class="text-center">
                <p class="text-3xl font-bold text-green-600 dark:text-green-400">{{ \App\Models\User::whereNotNull('email_verified_at')->count() }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Verified Users</p>
            </div>
        </x-ui::card>
        <x-ui::card>
            <div class="text-center">
                <p class="text-3xl font-bold text-blue-600 dark:text-blue-400">{{ \Illuminate\Support\Facades\DB::table('sessions')->whereNotNull('user_id')->distinct('user_id')->count('user_id') }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Active Sessions</p>
            </div>
        </x-ui::card>
        <x-ui::card>
            <div class="text-center">
                <p class="text-3xl font-bold text-amber-600 dark:text-amber-400">{{ \App\Models\User::onlyTrashed()->count() }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Deleted Users</p>
            </div>
        </x-ui::card>
    </div>

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
