@extends('layouts.app')

@section('template_title')
    {{ $user->name }}
@endsection

@section('content')
    <div class="max-w-4xl mx-auto">
        <x-ui::breadcrumbs :items="[
            ['label' => 'Users', 'url' => url('/users')],
            ['label' => $user->name],
        ]" />

        {{-- User Quick Stats --}}
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-6">
            <x-ui::stat-card
                :value="$user->notifications()->count()"
                label="Notifications"
                icon="bell"
                variant="info"
            />
            <x-ui::stat-card
                :value="\Illuminate\Support\Facades\DB::table('sessions')->where('user_id', $user->id)->count()"
                label="Active Sessions"
                icon="globe"
                variant="primary"
            />
            <x-ui::stat-card
                :value="$user->created_at->diffForHumans(syntax: true)"
                label="Account Age"
                icon="clock"
                variant="success"
            />
            <x-ui::stat-card
                :value="$user->email_verified_at ? 'Yes' : 'No'"
                label="Email Verified"
                icon="check"
                :variant="$user->email_verified_at ? 'success' : 'warning'"
            />
        </div>

        <x-ui::card>
            <x-slot name="header">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium">
                        {{ $user->name }}
                        @if($user->isOnline())
                            <x-ui::badge variant="success" size="sm">Online</x-ui::badge>
                        @else
                            <span class="text-xs text-gray-400 dark:text-gray-500 font-normal ml-2">{{ $user->lastActivity() ?? 'Never' }}</span>
                        @endif
                    </h3>
                    <div class="flex gap-2">
                        <x-ui::button href="{{ url('users/' . $user->id . '/edit') }}" variant="info" size="sm" icon="edit">Edit</x-ui::button>
                        <x-ui::button href="{{ route('users') }}" variant="secondary" size="sm" outline icon="arrow-left">Back</x-ui::button>
                    </div>
                </div>
            </x-slot>

            <div class="flex flex-col md:flex-row gap-8">
                {{-- Avatar --}}
                <div class="flex-shrink-0">
                    <x-avatar :src="$user->profile?->avatar ?? null" :alt="$user->name" size="2xl" />
                </div>

                {{-- User details --}}
                <div class="flex-1">
                    <dl class="space-y-3">
                        <div class="flex items-center gap-2">
                            <dt class="w-32 text-sm font-medium text-gray-500">ID</dt>
                            <dd class="text-sm">{{ $user->id }}</dd>
                        </div>
                        <div class="flex items-center gap-2">
                            <dt class="w-32 text-sm font-medium text-gray-500">Username</dt>
                            <dd class="text-sm font-medium">{{ $user->name }}</dd>
                        </div>
                        <div class="flex items-center gap-2">
                            <dt class="w-32 text-sm font-medium text-gray-500">Email</dt>
                            <dd class="text-sm"><a href="mailto:{{ $user->email }}" class="text-blue-600 hover:underline">{{ $user->email }}</a></dd>
                        </div>
                        <div class="flex items-center gap-2">
                            <dt class="w-32 text-sm font-medium text-gray-500">First Name</dt>
                            <dd class="text-sm">{{ $user->first_name }}</dd>
                        </div>
                        <div class="flex items-center gap-2">
                            <dt class="w-32 text-sm font-medium text-gray-500">Last Name</dt>
                            <dd class="text-sm">{{ $user->last_name }}</dd>
                        </div>
                        <div class="flex items-center gap-2">
                            <dt class="w-32 text-sm font-medium text-gray-500">Role(s)</dt>
                            <dd class="text-sm flex gap-1">
                                @foreach($user->roles as $role)
                                    <x-ui::badge :variant="$role->name === 'Admin' ? 'warning' : ($role->name === 'Unverified' ? 'danger' : 'primary')">{{ $role->name }}</x-ui::badge>
                                @endforeach
                            </dd>
                        </div>
                        <div class="flex items-center gap-2">
                            <dt class="w-32 text-sm font-medium text-gray-500">Status</dt>
                            <dd class="text-sm flex gap-1">
                                @if($user->activated)
                                    <x-ui::badge variant="success" dot>Activated</x-ui::badge>
                                @else
                                    <x-ui::badge variant="danger" dot>Not Activated</x-ui::badge>
                                @endif
                                @if($user->two_factor_secret)
                                    <x-ui::badge variant="info">2FA Enabled</x-ui::badge>
                                @endif
                                @if($user->chat_enabled)
                                    <x-ui::badge variant="primary">Chat Enabled</x-ui::badge>
                                @endif
                            </dd>
                        </div>
                        <div class="flex items-center gap-2">
                            <dt class="w-32 text-sm font-medium text-gray-500">Created</dt>
                            <dd class="text-sm text-gray-500">{{ $user->created_at->format('M d, Y g:i A') }}</dd>
                        </div>
                        <div class="flex items-center gap-2">
                            <dt class="w-32 text-sm font-medium text-gray-500">Updated</dt>
                            <dd class="text-sm text-gray-500">{{ $user->updated_at->format('M d, Y g:i A') }}</dd>
                        </div>
                        @if($user->email_verified_at)
                        <div class="flex items-center gap-2">
                            <dt class="w-32 text-sm font-medium text-gray-500">Verified</dt>
                            <dd class="text-sm text-gray-500">{{ $user->email_verified_at->format('M d, Y g:i A') }}</dd>
                        </div>
                        @endif
                        @if($user->signup_ip_address)
                        <div class="flex items-center gap-2">
                            <dt class="w-32 text-sm font-medium text-gray-500">Signup IP</dt>
                            <dd class="text-sm text-gray-500">{{ $user->signup_ip_address }}</dd>
                        </div>
                        @endif
                        @if($user->last_login_ip_address)
                        <div class="flex items-center gap-2">
                            <dt class="w-32 text-sm font-medium text-gray-500">Last Login IP</dt>
                            <dd class="text-sm text-gray-500">{{ $user->last_login_ip_address }}</dd>
                        </div>
                        @endif
                    </dl>
                </div>
            </div>

        </x-ui::card>

        {{-- Notification History --}}
        @php
            $userNotifications = $user->notifications()->latest()->limit(10)->get();
        @endphp
        @if($userNotifications->isNotEmpty())
        <x-ui::card title="Recent Notifications" class="mt-6">
            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($userNotifications as $notification)
                    <div class="py-2.5 flex items-start justify-between gap-4">
                        <div class="flex-1 min-w-0">
                            @if(isset($notification->data['title']))
                                <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $notification->data['title'] }}</p>
                            @endif
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $notification->data['message'] ?? class_basename($notification->type) }}</p>
                        </div>
                        <div class="flex items-center gap-2 flex-shrink-0">
                            @if($notification->read_at)
                                <x-ui::badge variant="secondary" size="sm">Read</x-ui::badge>
                            @else
                                <x-ui::badge variant="primary" size="sm">Unread</x-ui::badge>
                            @endif
                            <span class="text-xs text-gray-400 dark:text-gray-500 whitespace-nowrap">{{ $notification->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </x-ui::card>
        @endif

        {{-- Recent Activity --}}
        @php
            $activities = \Illuminate\Support\Facades\DB::table('laravel_logger_activity')
                ->where('userId', $user->id)
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();
        @endphp
        @if($activities->isNotEmpty())
        <x-ui::card title="Recent Activity" class="mt-6">
            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($activities as $activity)
                    <div class="py-2 flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-900 dark:text-gray-100">{{ $activity->description }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $activity->route }} &middot; {{ $activity->ipAddress }}</p>
                        </div>
                        <div class="text-right">
                            <x-ui::badge :variant="$activity->methodType === 'GET' ? 'info' : ($activity->methodType === 'POST' ? 'success' : 'warning')" size="sm">{{ $activity->methodType }}</x-ui::badge>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </x-ui::card>
        @endif

        {{-- Active Sessions --}}
        @php
            $userSessions = \Illuminate\Support\Facades\DB::table('sessions')
                ->where('user_id', $user->id)
                ->orderBy('last_activity', 'desc')
                ->get();
        @endphp
        @if($userSessions->isNotEmpty())
        <x-ui::card title="Active Sessions" class="mt-6">
            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($userSessions as $session)
                    @php
                        $agent = new Jenssegers\Agent\Agent();
                        $agent->setUserAgent($session->user_agent ?? '');
                        $isActive = (now()->timestamp - $session->last_activity) < 300;
                    @endphp
                    <div class="py-2.5 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="inline-flex items-center justify-center h-8 w-8 rounded-full {{ $isActive ? 'bg-green-100 dark:bg-green-900/30' : 'bg-gray-100 dark:bg-gray-800' }}">
                                @if($agent->isDesktop())
                                    <svg class="h-4 w-4 {{ $isActive ? 'text-green-600 dark:text-green-400' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a9 9 0 11-18 0V5.25" /></svg>
                                @elseif($agent->isMobile())
                                    <svg class="h-4 w-4 {{ $isActive ? 'text-green-600 dark:text-green-400' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" /></svg>
                                @else
                                    <svg class="h-4 w-4 {{ $isActive ? 'text-green-600 dark:text-green-400' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418" /></svg>
                                @endif
                            </span>
                            <div>
                                <p class="text-sm text-gray-900 dark:text-gray-100">{{ $agent->browser() }} on {{ $agent->platform() }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $session->ip_address }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ \Illuminate\Support\Carbon::createFromTimestamp($session->last_activity)->diffForHumans() }}</p>
                            @if($isActive)
                                <x-ui::badge variant="success" size="sm">Active</x-ui::badge>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </x-ui::card>
        @endif
    </div>

    <div class="max-w-4xl mx-auto mt-6">
        <x-ui::card>
            <x-slot name="footerSlot">
                <div class="flex items-center justify-between">
                    <div class="flex gap-2">
                        <x-ui::button href="{{ url('users/' . $user->id . '/edit') }}" variant="info" size="sm" icon="edit">Edit User</x-ui::button>
                        @if($user->level() < 5 && Auth::id() !== $user->id && !session('impersonator_id'))
                            <form method="POST" action="{{ route('impersonate.start', $user) }}">
                                @csrf
                                <x-ui::button type="submit" variant="warning" size="sm" icon="eye">Impersonate</x-ui::button>
                            </form>
                        @endif
                    </div>
                    <form method="POST" action="{{ url('users/' . $user->id) }}" id="delete-user-form">
                        @csrf
                        @method('DELETE')
                        <x-ui::button type="button" variant="danger" size="sm" icon="trash" x-data @click="$dispatch('open-confirm', { title: 'Delete User', message: 'Are you sure you want to delete {{ $user->name }}?', variant: 'danger', formId: 'delete-user-form' })">Delete User</x-ui::button>
                    </form>
                </div>
            </x-slot>
        </x-ui::card>
    </div>
    <x-ui::confirm variant="danger" confirm-text="Delete" />
@endsection
