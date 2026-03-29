@extends('layouts.app')

@section('template_title')
    {{ trans('usersmanagement.showing-all-users') }}
@endsection

@section('content')
    @include('laravelusers::partials.search-users-form')

    <div x-data="bulkActions()">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ trans('usersmanagement.showing-all-users') }}</h5>
                    <div class="d-flex gap-2">
                        <x-ui::button href="{{ url('/users/create') }}" variant="primary" size="sm" icon="plus">
                            Create New User
                        </x-ui::button>
                        <x-ui::button href="{{ route('users.export') }}" variant="secondary" size="sm" outline icon="download">
                            Export CSV
                        </x-ui::button>
                        <x-ui::button href="{{ url('/users/deleted') }}" variant="secondary" size="sm" outline icon="trash">
                            Deleted Users
                        </x-ui::button>
                    </div>
                </div>
            </div>
            <div class="card-body">

                {{-- Bulk action bar --}}
                <div x-show="selected.length > 0" x-cloak x-transition class="alert alert-info d-flex align-items-center justify-content-between mb-3">
                    <span class="fw-medium" x-text="selected.length + ' user(s) selected'"></span>
                    <div class="d-flex align-items-center gap-2">
                        <form method="POST" action="{{ route('users.bulk') }}" id="bulk-action-form">
                            @csrf
                            <template x-for="id in selected" :key="id">
                                <input type="hidden" name="user_ids[]" :value="id">
                            </template>
                            <div class="d-flex align-items-center gap-2">
                                <select name="action" x-ref="bulkAction" @change="if($el.value === 'change_role') $refs.bulkRole.classList.remove('d-none'); else $refs.bulkRole.classList.add('d-none');" class="form-select form-select-sm" style="width: auto;">
                                    <option value="">Choose action...</option>
                                    <option value="delete">Delete Selected</option>
                                    <option value="activate">Activate</option>
                                    <option value="deactivate">Deactivate</option>
                                    <option value="change_role">Change Role</option>
                                </select>
                                <select name="role" x-ref="bulkRole" class="d-none form-select form-select-sm" style="width: auto;">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <x-ui::button type="submit" variant="primary" size="sm" @click.prevent="if(!$refs.bulkAction.value) return; if($refs.bulkAction.value === 'delete' && !confirm('Delete ' + selected.length + ' user(s)?')) return; $el.closest('form').submit();">Apply</x-ui::button>
                            </div>
                        </form>
                        <button @click="selected = []; document.querySelectorAll('.bulk-check').forEach(c => c.checked = false); document.getElementById('select-all').checked = false;" class="btn btn-sm btn-link text-muted text-decoration-none">Clear</button>
                    </div>
                </div>

                <div class="table-responsive" id="users_table">
                    <table class="table table-hover align-middle mb-0">
                        <caption>
                            {{ trans_choice('usersmanagement.users-table.caption', 1, ['userscount' => $users->count()]) }}
                        </caption>
                        <thead class="table-light">
                            <tr>
                                <th style="width: 40px;">
                                    <input type="checkbox" id="select-all" @change="toggleAll($event)" class="form-check-input">
                                </th>
                                <th>ID</th>
                                <th>Name</th>
                                <th class="d-none d-sm-table-cell">Email</th>
                                <th class="d-none d-md-table-cell">First</th>
                                <th class="d-none d-md-table-cell">Last</th>
                                <th>Role</th>
                                <th class="d-none d-lg-table-cell">Created</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr :class="{ 'table-active': selected.includes({{ $user->id }}) }">
                                    <td>
                                        @if($user->id !== Auth::id())
                                            <input type="checkbox" class="bulk-check form-check-input" value="{{ $user->id }}" @change="toggleUser({{ $user->id }}, $event)">
                                        @endif
                                    </td>
                                    <td>{{ $user->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="position-relative">
                                                <x-avatar :src="$user->getAvatarUrl(32)" :alt="$user->name" size="xs" />
                                                <span class="position-absolute bottom-0 end-0 d-block rounded-circle border border-2 border-white {{ $user->isOnline() ? 'bg-success' : 'bg-secondary' }}" style="width: 8px; height: 8px;" title="{{ $user->isOnline() ? 'Online' : ($user->lastActivity() ?? 'Offline') }}"></span>
                                            </div>
                                            <a href="{{ url('users/' . $user->id) }}" class="text-decoration-none fw-medium">{{ $user->name }}</a>
                                        </div>
                                    </td>
                                    <td class="d-none d-sm-table-cell"><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                    <td class="d-none d-md-table-cell">{{ $user->first_name }}</td>
                                    <td class="d-none d-md-table-cell">{{ $user->last_name }}</td>
                                    <td>
                                        @foreach($user->roles as $role)
                                            <x-ui::badge :variant="$role->name === 'Admin' ? 'warning' : ($role->name === 'Unverified' ? 'danger' : 'primary')" size="sm">{{ $role->name }}</x-ui::badge>
                                        @endforeach
                                    </td>
                                    <td class="d-none d-lg-table-cell text-muted small">{{ $user->created_at->format('M d, Y') }}</td>
                                    <td class="text-end">
                                        <div class="d-flex align-items-center justify-content-end gap-1">
                                            <x-ui::button href="{{ url('users/' . $user->id) }}" variant="success" size="xs" icon="eye">Show</x-ui::button>
                                            <x-ui::button href="{{ url('users/' . $user->id . '/edit') }}" variant="info" size="xs" icon="edit">Edit</x-ui::button>
                                            <form method="POST" action="{{ url('users/' . $user->id) }}" id="delete-user-{{ $user->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <x-ui::button type="button" variant="danger" size="xs" data-bs-toggle="modal" data-bs-target="#confirmModal" data-confirm-title="Delete User" data-confirm-message="Are you sure you want to delete {{ $user->name }}? This action can be reversed from the deleted users page." data-confirm-form="delete-user-{{ $user->id }}">Delete</x-ui::button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if(config('laravelusers.enablePagination'))
                    <div class="mt-3">{{ $users->links() }}</div>
                @endif

            </div>
        </div>
    </div>

    <div id="search_results" class="d-none mt-3">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="search_results_body">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <x-ui::confirm variant="danger" confirm-text="Delete" />
@endsection

@section('footer_scripts')
<script>
function bulkActions() {
    return {
        selected: [],
        toggleAll(event) {
            if (event.target.checked) {
                this.selected = Array.from(document.querySelectorAll('.bulk-check')).map(c => { c.checked = true; return parseInt(c.value); });
            } else {
                this.selected = [];
                document.querySelectorAll('.bulk-check').forEach(c => c.checked = false);
            }
        },
        toggleUser(id, event) {
            if (event.target.checked) {
                if (!this.selected.includes(id)) this.selected.push(id);
            } else {
                this.selected = this.selected.filter(i => i !== id);
                document.getElementById('select-all').checked = false;
            }
        }
    };
}

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
            searchResults.classList.add('d-none');
            usersTable.closest('.table-responsive')?.parentElement?.classList.remove('d-none');
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
                usersTable.closest('.table-responsive')?.parentElement?.classList.add('d-none');
                searchResults.classList.remove('d-none');

                if (data.length === 0) {
                    searchBody.innerHTML = '<tr><td colspan="5" class="text-center text-muted py-4">No users found.</td></tr>';
                    return;
                }

                searchBody.innerHTML = data.map(user => {
                    const roles = (user.roles || []).map(r => '<span class="badge bg-primary">' + r.name + '</span>').join(' ');
                    return '<tr>' +
                        '<td>' + user.id + '</td>' +
                        '<td class="fw-medium">' + user.name + '</td>' +
                        '<td>' + user.email + '</td>' +
                        '<td>' + roles + '</td>' +
                        '<td class="text-end">' +
                            '<a href="/users/' + user.id + '" class="btn btn-success btn-sm me-1">Show</a>' +
                            '<a href="/users/' + user.id + '/edit" class="btn btn-info btn-sm">Edit</a>' +
                        '</td></tr>';
                }).join('');
            })
            .catch(() => {});
        }, 300);
    });
});
</script>
@endsection
