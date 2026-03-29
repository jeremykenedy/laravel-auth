@extends('layouts.app')

@section('template_title')
    {{ $user->name }}
@endsection

@section('content')
    <div class="container">
        <x-ui::breadcrumbs :items="[
            ['label' => 'Users', 'url' => url('/users')],
            ['label' => $user->name],
        ]" />

        {{-- User Quick Stats --}}
        <div class="row g-3 mb-4">
            <div class="col-6 col-sm-3">
                <x-ui::stat-card
                    :value="$user->notifications()->count()"
                    label="Notifications"
                    icon="bell"
                    variant="info"
                />
            </div>
            <div class="col-6 col-sm-3">
                <x-ui::stat-card
                    :value="\Illuminate\Support\Facades\DB::table('sessions')->where('user_id', $user->id)->count()"
                    label="Active Sessions"
                    icon="globe"
                    variant="primary"
                />
            </div>
            <div class="col-6 col-sm-3">
                <x-ui::stat-card
                    :value="$user->created_at->diffForHumans(syntax: true)"
                    label="Account Age"
                    icon="clock"
                    variant="success"
                />
            </div>
            <div class="col-6 col-sm-3">
                <x-ui::stat-card
                    :value="$user->email_verified_at ? 'Yes' : 'No'"
                    label="Email Verified"
                    icon="check"
                    :variant="$user->email_verified_at ? 'success' : 'warning'"
                />
            </div>
        </div>

        {{-- User Detail Card --}}
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">
                    {{ $user->name }}
                    @if($user->isOnline())
                        <x-ui::badge variant="success" size="sm">Online</x-ui::badge>
                    @else
                        <small class="text-muted fw-normal ms-2">{{ $user->lastActivity() ?? 'Never' }}</small>
                    @endif
                </h5>
                <div class="d-flex gap-2">
                    <x-ui::button href="{{ url('users/' . $user->id . '/edit') }}" variant="info" size="sm" icon="edit">Edit</x-ui::button>
                    <x-ui::button href="{{ route('users') }}" variant="secondary" size="sm" outline icon="arrow-left">Back</x-ui::button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    {{-- Avatar --}}
                    <div class="col-md-3 text-center mb-3 mb-md-0">
                        <x-avatar :src="$user->profile?->avatar ?? null" :alt="$user->name" size="2xl" />
                    </div>

                    {{-- User Details Table --}}
                    <div class="col-md-9">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <th class="text-muted" style="width: 140px;">ID</th>
                                    <td>{{ $user->id }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Username</th>
                                    <td class="fw-semibold">{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Email</th>
                                    <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                </tr>
                                <tr>
                                    <th class="text-muted">First Name</th>
                                    <td>{{ $user->first_name }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Last Name</th>
                                    <td>{{ $user->last_name }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Role(s)</th>
                                    <td>
                                        @foreach($user->roles as $role)
                                            <x-ui::badge :variant="$role->name === 'Admin' ? 'warning' : ($role->name === 'Unverified' ? 'danger' : 'primary')">{{ $role->name }}</x-ui::badge>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Status</th>
                                    <td>
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
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Created</th>
                                    <td class="text-muted">{{ $user->created_at->format('M d, Y g:i A') }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Updated</th>
                                    <td class="text-muted">{{ $user->updated_at->format('M d, Y g:i A') }}</td>
                                </tr>
                                @if($user->email_verified_at)
                                <tr>
                                    <th class="text-muted">Verified</th>
                                    <td class="text-muted">{{ $user->email_verified_at->format('M d, Y g:i A') }}</td>
                                </tr>
                                @endif
                                @if($user->signup_ip_address)
                                <tr>
                                    <th class="text-muted">Signup IP</th>
                                    <td class="text-muted">{{ $user->signup_ip_address }}</td>
                                </tr>
                                @endif
                                @if($user->last_login_ip_address)
                                <tr>
                                    <th class="text-muted">Last Login IP</th>
                                    <td class="text-muted">{{ $user->last_login_ip_address }}</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Notification History --}}
        @php
            $userNotifications = $user->notifications()->latest()->limit(10)->get();
        @endphp
        @if($userNotifications->isNotEmpty())
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Recent Notifications</h5>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @foreach($userNotifications as $notification)
                        <li class="list-group-item d-flex align-items-start justify-content-between">
                            <div class="me-3">
                                @if(isset($notification->data['title']))
                                    <p class="mb-0 fw-semibold">{{ $notification->data['title'] }}</p>
                                @endif
                                <p class="mb-0 text-muted small">{{ $notification->data['message'] ?? class_basename($notification->type) }}</p>
                            </div>
                            <div class="d-flex align-items-center gap-2 flex-shrink-0">
                                @if($notification->read_at)
                                    <x-ui::badge variant="secondary" size="sm">Read</x-ui::badge>
                                @else
                                    <x-ui::badge variant="primary" size="sm">Unread</x-ui::badge>
                                @endif
                                <small class="text-muted text-nowrap">{{ $notification->created_at->diffForHumans() }}</small>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
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
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Recent Activity</h5>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @foreach($activities as $activity)
                        <li class="list-group-item d-flex align-items-center justify-content-between">
                            <div>
                                <p class="mb-0">{{ $activity->description }}</p>
                                <small class="text-muted">{{ $activity->route }} &middot; {{ $activity->ipAddress }}</small>
                            </div>
                            <div class="text-end">
                                <x-ui::badge :variant="$activity->methodType === 'GET' ? 'info' : ($activity->methodType === 'POST' ? 'success' : 'warning')" size="sm">{{ $activity->methodType }}</x-ui::badge>
                                <br>
                                <small class="text-muted">{{ \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}</small>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        {{-- Active Sessions --}}
        @php
            $userSessions = \Illuminate\Support\Facades\DB::table('sessions')
                ->where('user_id', $user->id)
                ->orderBy('last_activity', 'desc')
                ->get();
        @endphp
        @if($userSessions->isNotEmpty())
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Active Sessions</h5>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @foreach($userSessions as $session)
                        @php
                            $agent = new Jenssegers\Agent\Agent();
                            $agent->setUserAgent($session->user_agent ?? '');
                            $isActive = (now()->timestamp - $session->last_activity) < 300;
                        @endphp
                        <li class="list-group-item d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle {{ $isActive ? 'bg-success bg-opacity-10' : 'bg-light' }}" style="width: 36px; height: 36px;">
                                    @if($agent->isDesktop())
                                        <i class="bi bi-display {{ $isActive ? 'text-success' : 'text-muted' }}"></i>
                                    @elseif($agent->isMobile())
                                        <i class="bi bi-phone {{ $isActive ? 'text-success' : 'text-muted' }}"></i>
                                    @else
                                        <i class="bi bi-globe {{ $isActive ? 'text-success' : 'text-muted' }}"></i>
                                    @endif
                                </span>
                                <div>
                                    <p class="mb-0">{{ $agent->browser() }} on {{ $agent->platform() }}</p>
                                    <small class="text-muted">{{ $session->ip_address }}</small>
                                </div>
                            </div>
                            <div class="text-end">
                                <small class="text-muted">{{ \Illuminate\Support\Carbon::createFromTimestamp($session->last_activity)->diffForHumans() }}</small>
                                @if($isActive)
                                    <br>
                                    <x-ui::badge variant="success" size="sm">Active</x-ui::badge>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        {{-- Footer Actions --}}
        <div class="card mb-4">
            <div class="card-footer d-flex align-items-center justify-content-between">
                <div class="d-flex gap-2">
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
        </div>
    </div>
    <x-ui::confirm variant="danger" confirm-text="Delete" />
@endsection
