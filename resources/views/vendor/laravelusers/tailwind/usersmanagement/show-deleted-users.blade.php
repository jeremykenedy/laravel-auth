@extends('layouts.app')

@section('template_title')
    Deleted Users
@endsection

@section('content')
    <x-ui::breadcrumbs :items="[
        ['label' => 'Users', 'url' => url('/users')],
        ['label' => 'Deleted Users'],
    ]" />
    <x-ui::card>
        <x-slot name="header">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium">Deleted Users</h3>
                <x-ui::button href="{{ route('users') }}" variant="secondary" size="sm" outline icon="arrow-left">
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
                                    <x-ui::button href="{{ url('users/deleted/' . $user->id) }}" variant="info" size="xs" icon="eye">Show</x-ui::button>
                                    <form method="POST" action="{{ url('users/deleted/' . $user->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <x-ui::button type="submit" variant="success" size="xs" icon="check">Restore</x-ui::button>
                                    </form>
                                    <form method="POST" action="{{ url('users/deleted/' . $user->id) }}" x-data @submit.prevent="if(confirm('Permanently delete this user?')) $el.submit()">
                                        @csrf
                                        @method('DELETE')
                                        <x-ui::button type="submit" variant="danger" size="xs" icon="trash">Destroy</x-ui::button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($users->isEmpty())
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-300 dark:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
                <p class="mt-3 text-sm font-medium text-gray-900 dark:text-gray-100">No deleted users</p>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Deleted users will appear here for recovery.</p>
                <div class="mt-4">
                    <x-ui::button href="{{ route('users') }}" variant="primary" size="sm">Back to Users</x-ui::button>
                </div>
            </div>
        @endif
    </x-ui::card>
@endsection
