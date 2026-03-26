@extends('layouts.app')

@section('template_title')
    {{ $user->name }}
@endsection

@section('content')
    <div class="max-w-4xl mx-auto">
        <x-ui::card>
            <x-slot name="header">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium">{{ $user->name }}</h3>
                    <div class="flex gap-2">
                        <x-ui::button href="{{ url('users/' . $user->id . '/edit') }}" variant="info" size="sm" icon="edit">Edit</x-ui::button>
                        <x-ui::button href="{{ route('users') }}" variant="secondary" size="sm" outline icon="arrow-left">Back</x-ui::button>
                    </div>
                </div>
            </x-slot>

            <div class="flex flex-col md:flex-row gap-8">
                {{-- Avatar --}}
                <div class="flex-shrink-0">
                    <x-ui::avatar :src="$user->profile?->avatar ?? null" :alt="$user->name" size="2xl" />
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
                            <dd class="text-sm">
                                @if($user->activated)
                                    <x-ui::badge variant="success" dot>Activated</x-ui::badge>
                                @else
                                    <x-ui::badge variant="danger" dot>Not Activated</x-ui::badge>
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
                        @if($user->signup_ip_address)
                        <div class="flex items-center gap-2">
                            <dt class="w-32 text-sm font-medium text-gray-500">Signup IP</dt>
                            <dd class="text-sm text-gray-500">{{ $user->signup_ip_address }}</dd>
                        </div>
                        @endif
                    </dl>
                </div>
            </div>

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
                    <form method="POST" action="{{ url('users/' . $user->id) }}" x-data @submit.prevent="if(confirm('Are you sure you want to delete this user?')) $el.submit()">
                        @csrf
                        @method('DELETE')
                        <x-ui::button type="submit" variant="danger" size="sm" icon="trash">Delete User</x-ui::button>
                    </form>
                </div>
            </x-slot>
        </x-ui::card>
    </div>
@endsection
