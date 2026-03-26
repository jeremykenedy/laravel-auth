@extends('layouts.app')

@section('template_title')
    Deleted User: {{ $user->name }}
@endsection

@section('content')
    <div class="max-w-4xl mx-auto">
        <x-ui::card>
            <x-slot name="header">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium">
                        <x-ui::badge variant="danger" class="mr-2">Deleted</x-ui::badge>
                        {{ $user->name }}
                    </h3>
                    <x-ui::button href="{{ url('/users/deleted') }}" variant="secondary" size="sm" outline>
                        Back
                    </x-ui::button>
                </div>
            </x-slot>

            <div class="flex flex-col md:flex-row gap-8">
                <div class="flex-shrink-0">
                    <x-ui::avatar :alt="$user->name" size="2xl" />
                </div>
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
                            <dd class="text-sm">{{ $user->email }}</dd>
                        </div>
                        <div class="flex items-center gap-2">
                            <dt class="w-32 text-sm font-medium text-gray-500">Name</dt>
                            <dd class="text-sm">{{ $user->first_name }} {{ $user->last_name }}</dd>
                        </div>
                        <div class="flex items-center gap-2">
                            <dt class="w-32 text-sm font-medium text-gray-500">Role(s)</dt>
                            <dd class="text-sm flex gap-1">
                                @foreach($user->roles as $role)
                                    <x-ui::badge :variant="$role->name === 'Admin' ? 'warning' : 'primary'">{{ $role->name }}</x-ui::badge>
                                @endforeach
                            </dd>
                        </div>
                        <div class="flex items-center gap-2">
                            <dt class="w-32 text-sm font-medium text-gray-500">Deleted</dt>
                            <dd class="text-sm text-red-600">{{ $user->deleted_at->format('M d, Y g:i A') }}</dd>
                        </div>
                        <div class="flex items-center gap-2">
                            <dt class="w-32 text-sm font-medium text-gray-500">Created</dt>
                            <dd class="text-sm text-gray-500">{{ $user->created_at->format('M d, Y g:i A') }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <x-slot name="footerSlot">
                <div class="flex items-center justify-between">
                    <form method="POST" action="{{ url('users/deleted/' . $user->id) }}">
                        @csrf
                        @method('PUT')
                        <x-ui::button type="submit" variant="success" size="sm">Restore User</x-ui::button>
                    </form>
                    <form method="POST" action="{{ url('users/deleted/' . $user->id) }}" x-data @submit.prevent="if(confirm('This will permanently delete this user. Continue?')) $el.submit()">
                        @csrf
                        @method('DELETE')
                        <x-ui::button type="submit" variant="danger" size="sm">Permanently Delete</x-ui::button>
                    </form>
                </div>
            </x-slot>
        </x-ui::card>
    </div>
@endsection
