@extends('layouts.app')

@section('template_title')
    Deleted Users
@endsection

@section('content')
    <x-ui::card>
        <x-slot name="header">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium">Deleted Users</h3>
                <x-ui::button href="{{ route('users') }}" variant="secondary" size="sm" outline>
                    Back to Users
                </x-ui::button>
            </div>
        </x-slot>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Email</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Deleted</th>
                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($users as $user)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
                            <td class="px-4 py-3 text-sm">{{ $user->id }}</td>
                            <td class="px-4 py-3 text-sm font-medium">{{ $user->name }}</td>
                            <td class="px-4 py-3 text-sm hidden sm:table-cell">{{ $user->email }}</td>
                            <td class="px-4 py-3 text-sm">
                                @foreach($user->roles as $role)
                                    <x-ui::badge :variant="$role->name === 'Admin' ? 'warning' : 'primary'" size="sm">{{ $role->name }}</x-ui::badge>
                                @endforeach
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-500 hidden md:table-cell">{{ $user->deleted_at->format('M d, Y') }}</td>
                            <td class="px-4 py-3 text-sm text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <x-ui::button href="{{ url('users/deleted/' . $user->id) }}" variant="info" size="xs">Show</x-ui::button>
                                    <form method="POST" action="{{ url('users/deleted/' . $user->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <x-ui::button type="submit" variant="success" size="xs">Restore</x-ui::button>
                                    </form>
                                    <form method="POST" action="{{ url('users/deleted/' . $user->id) }}" x-data @submit.prevent="if(confirm('Permanently delete this user?')) $el.submit()">
                                        @csrf
                                        @method('DELETE')
                                        <x-ui::button type="submit" variant="danger" size="xs">Destroy</x-ui::button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($users->isEmpty())
            <div class="text-center py-8 text-gray-500">No deleted users.</div>
        @endif
    </x-ui::card>
@endsection
