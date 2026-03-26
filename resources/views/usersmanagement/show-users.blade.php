@extends('layouts.app')

@section('template_title')
    {{ trans('usersmanagement.showing-all-users') }}
@endsection

@section('content')
    @include('partials.search-users-form')

    <x-ui::card>
        <x-slot name="header">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium">{{ trans('usersmanagement.showing-all-users') }}</h3>
                <div class="flex gap-2">
                    <x-ui::button href="{{ url('/users/create') }}" variant="primary" size="sm" icon="plus">
                        Create New User
                    </x-ui::button>
                    <x-ui::button href="{{ url('/users/deleted') }}" variant="secondary" size="sm" outline icon="trash">
                        Deleted Users
                    </x-ui::button>
                </div>
            </div>
        </x-slot>

        <div class="overflow-x-auto" id="users_table">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <caption class="py-2 text-sm text-gray-500 text-left">
                    {{ trans_choice('usersmanagement.users-table.caption', 1, ['userscount' => $users->count()]) }}
                </caption>
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Email</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">First</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Last</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden lg:table-cell">Created</th>
                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($users as $user)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
                            <td class="px-4 py-3 text-sm">{{ $user->id }}</td>
                            <td class="px-4 py-3 text-sm font-medium">
                                <div class="flex items-center gap-2">
                                    <x-ui::avatar :src="$user->getAvatarUrl(32)" :alt="$user->name" size="xs" />
                                    <a href="{{ url('users/' . $user->id) }}" class="hover:text-blue-600 dark:hover:text-blue-400">{{ $user->name }}</a>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm hidden sm:table-cell"><a href="mailto:{{ $user->email }}" class="text-blue-600 hover:underline">{{ $user->email }}</a></td>
                            <td class="px-4 py-3 text-sm hidden md:table-cell">{{ $user->first_name }}</td>
                            <td class="px-4 py-3 text-sm hidden md:table-cell">{{ $user->last_name }}</td>
                            <td class="px-4 py-3 text-sm">
                                @foreach($user->roles as $role)
                                    <x-ui::badge :variant="$role->name === 'Admin' ? 'warning' : ($role->name === 'Unverified' ? 'danger' : 'primary')" size="sm">{{ $role->name }}</x-ui::badge>
                                @endforeach
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-500 hidden lg:table-cell">{{ $user->created_at->format('M d, Y') }}</td>
                            <td class="px-4 py-3 text-sm text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <x-ui::button href="{{ url('users/' . $user->id) }}" variant="success" size="xs" icon="eye">Show</x-ui::button>
                                    <x-ui::button href="{{ url('users/' . $user->id . '/edit') }}" variant="info" size="xs" icon="edit">Edit</x-ui::button>
                                    <form method="POST" action="{{ url('users/' . $user->id) }}" x-data @submit.prevent="if(confirm('Are you sure you want to delete this user?')) $el.submit()">
                                        @csrf
                                        @method('DELETE')
                                        <x-ui::button type="submit" variant="danger" size="xs">Delete</x-ui::button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if(config('usersmanagement.enablePagination'))
            <div class="mt-4">{{ $users->links() }}</div>
        @endif
    </x-ui::card>

    <div id="search_results" class="hidden mt-4">
        <x-ui::card>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="search_results_body" class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                    </tbody>
                </table>
            </div>
        </x-ui::card>
    </div>

@endsection

@section('footer_scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('user_search_box');
    const usersTable = document.getElementById('users_table');
    const searchResults = document.getElementById('search_results');
    const searchBody = document.getElementById('search_results_body');

    if (!searchInput) return;

    let debounceTimer;

    searchInput.addEventListener('input', function() {
        clearTimeout(debounceTimer);
        const query = this.value.trim();

        if (query.length < 2) {
            searchResults.classList.add('hidden');
            usersTable.closest('.overflow-x-auto')?.parentElement?.classList.remove('hidden');
            return;
        }

        debounceTimer = setTimeout(function() {
            fetch('{{ route("search-users") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ user_search_box: query })
            })
            .then(response => response.json())
            .then(data => {
                usersTable.closest('.overflow-x-auto')?.parentElement?.classList.add('hidden');
                searchResults.classList.remove('hidden');

                if (data.length === 0) {
                    searchBody.innerHTML = '<tr><td colspan="5" class="px-4 py-8 text-center text-gray-500">No users found.</td></tr>';
                    return;
                }

                searchBody.innerHTML = data.map(user => {
                    const roles = (user.roles || []).map(r => '<span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">' + r.name + '</span>').join(' ');
                    return '<tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50">' +
                        '<td class="px-4 py-3 text-sm">' + user.id + '</td>' +
                        '<td class="px-4 py-3 text-sm font-medium">' + user.name + '</td>' +
                        '<td class="px-4 py-3 text-sm">' + user.email + '</td>' +
                        '<td class="px-4 py-3 text-sm">' + roles + '</td>' +
                        '<td class="px-4 py-3 text-sm text-right">' +
                            '<a href="/users/' + user.id + '" class="text-green-600 hover:underline text-xs mr-2">Show</a>' +
                            '<a href="/users/' + user.id + '/edit" class="text-blue-600 hover:underline text-xs">Edit</a>' +
                        '</td></tr>';
                }).join('');
            })
            .catch(() => {});
        }, 300);
    });
});
</script>
@endsection
