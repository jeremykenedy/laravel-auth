<div class="max-w-7xl mx-auto space-y-6">
    @include('panels.welcome-panel')

    {{-- User Account Stats --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <x-ui::stat-card value="{{ $notificationCount ?? 0 }}" label="Unread Notifications" icon="bell" href="{{ route('notifications.index') }}" />
        <x-ui::stat-card value="{{ $sessionCount ?? 0 }}" label="Active Sessions" variant="primary" icon="globe" href="{{ route('profile.sessions') }}" />
        <x-ui::stat-card value="{{ Auth::user()->roles->first()?->name ?? 'User' }}" label="Current Role" variant="info" icon="shield" />
        <x-ui::stat-card value="{{ $accountAge ?? '0d' }}" label="Account Age" variant="success" icon="clock" />
    </div>

    {{-- Two-column grid: Profile Completion + Account Security --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Profile Completion --}}
        @if(isset($profileCompletion) && $profileCompletion['percent'] < 100)
        <x-ui::card>
            <x-slot name="header">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Complete Your Profile</h3>
                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ $profileCompletion['completed'] }}/{{ $profileCompletion['total'] }}</span>
                </div>
            </x-slot>

            <div class="mb-4">
                <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400 mb-1.5">
                    <span>{{ $profileCompletion['percent'] }}% complete</span>
                </div>
                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                    <div class="h-2.5 rounded-full transition-all duration-500 {{ $profileCompletion['percent'] >= 75 ? 'bg-green-500' : ($profileCompletion['percent'] >= 50 ? 'bg-blue-500' : 'bg-yellow-500') }}" style="width: {{ $profileCompletion['percent'] }}%"></div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                @foreach($profileCompletion['steps'] as $key => $step)
                    <div class="flex items-center gap-2.5 py-1.5">
                        @if($step['done'])
                            <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-green-100 dark:bg-green-900/30">
                                <svg class="h-3 w-3 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                            </span>
                            <span class="text-sm text-gray-500 dark:text-gray-400 line-through">{{ $step['label'] }}</span>
                        @else
                            <span class="inline-flex items-center justify-center h-5 w-5 rounded-full border-2 border-gray-300 dark:border-gray-600"></span>
                            <span class="text-sm text-gray-900 dark:text-gray-100">{{ $step['label'] }}</span>
                        @endif
                    </div>
                @endforeach
            </div>

            @php
                $incompleteSteps = collect($profileCompletion['steps'])->where('done', false)->keys();
                $nextAction = match($incompleteSteps->first()) {
                    'email_verified' => ['url' => route('verification.notice'), 'text' => 'Verify Email'],
                    'first_name', 'last_name', 'avatar' => ['url' => route('profile.show'), 'text' => 'Edit Profile'],
                    'theme' => ['url' => route('themes.index'), 'text' => 'Choose Theme'],
                    'two_factor' => ['url' => url('/twostep/setup'), 'text' => 'Enable 2FA'],
                    default => null,
                };
            @endphp
            @if($nextAction)
                <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <x-ui::button href="{{ $nextAction['url'] }}" variant="primary" size="sm">{{ $nextAction['text'] }}</x-ui::button>
                </div>
            @endif
        </x-ui::card>
        @endif

        {{-- Account Security --}}
        <x-ui::card>
            <x-slot name="header">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Account Security</h3>
            </x-slot>

            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex items-center justify-center h-8 w-8 rounded-full {{ Auth::user()->email_verified_at ? 'bg-green-100 dark:bg-green-900/30' : 'bg-yellow-100 dark:bg-yellow-900/30' }}">
                            <svg class="h-4 w-4 {{ Auth::user()->email_verified_at ? 'text-green-600 dark:text-green-400' : 'text-yellow-600 dark:text-yellow-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" /></svg>
                        </span>
                        <div>
                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Email Verification</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    @if(Auth::user()->email_verified_at)
                        <x-ui::badge variant="success">Verified</x-ui::badge>
                    @else
                        <x-ui::badge variant="warning">Unverified</x-ui::badge>
                    @endif
                </div>

                <hr class="border-gray-200 dark:border-gray-700">

                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex items-center justify-center h-8 w-8 rounded-full {{ Auth::user()->two_factor_secret ? 'bg-green-100 dark:bg-green-900/30' : 'bg-gray-100 dark:bg-gray-800' }}">
                            <svg class="h-4 w-4 {{ Auth::user()->two_factor_secret ? 'text-green-600 dark:text-green-400' : 'text-gray-400 dark:text-gray-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /></svg>
                        </span>
                        <div>
                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Two-Factor Authentication</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">TOTP via authenticator app</p>
                        </div>
                    </div>
                    @if(Auth::user()->two_factor_secret)
                        <x-ui::badge variant="success">Enabled</x-ui::badge>
                    @else
                        <x-ui::badge variant="secondary">Disabled</x-ui::badge>
                    @endif
                </div>

                <hr class="border-gray-200 dark:border-gray-700">

                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-blue-100 dark:bg-blue-900/30">
                            <svg class="h-4 w-4 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a9 9 0 11-18 0V5.25" /></svg>
                        </span>
                        <div>
                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Active Sessions</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $sessionCount ?? 0 }} device(s) logged in</p>
                        </div>
                    </div>
                    <x-ui::button href="{{ route('profile.sessions') }}" variant="secondary" size="xs" outline>Manage</x-ui::button>
                </div>
            </div>
        </x-ui::card>
    </div>

    {{-- Two-column grid: Notifications + Quick Links --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Recent Notifications --}}
        <x-ui::card>
            <x-slot name="header">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Recent Notifications</h3>
                    <x-ui::button href="{{ route('notifications.index') }}" variant="secondary" size="sm" outline>View All</x-ui::button>
                </div>
            </x-slot>

            @if(isset($recentNotifications) && $recentNotifications->isNotEmpty())
                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($recentNotifications as $notification)
                        <div class="flex items-start gap-3 py-3">
                            <div class="flex-shrink-0 mt-0.5">
                                <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-blue-100 dark:bg-blue-900/30">
                                    <svg class="h-4 w-4 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" /></svg>
                                </span>
                            </div>
                            <div class="flex-1 min-w-0">
                                @if(isset($notification->data['title']))
                                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $notification->data['title'] }}</p>
                                @endif
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $notification->data['message'] ?? '' }}</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-6">
                    <svg class="mx-auto h-10 w-10 text-gray-300 dark:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" /></svg>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">No unread notifications</p>
                </div>
            @endif
        </x-ui::card>

        {{-- Quick Links --}}
        <x-ui::card title="Quick Links">
            <div class="grid grid-cols-2 gap-2">
                <x-ui::button href="{{ route('profile.show') }}" variant="primary" size="sm" icon="user">My Profile</x-ui::button>
                <x-ui::button href="{{ route('profile.sessions') }}" variant="secondary" size="sm" icon="globe">Active Sessions</x-ui::button>
                <x-ui::button href="{{ route('notifications.index') }}" variant="secondary" size="sm" icon="bell">Notifications</x-ui::button>
                <x-ui::button href="{{ route('chat.index') }}" variant="secondary" size="sm" icon="chat">Messages</x-ui::button>
            </div>
        </x-ui::card>
    </div>
</div>
