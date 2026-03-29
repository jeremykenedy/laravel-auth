@extends('layouts.app')

@section('template_title')
    Deleted Users
@endsection

@section('content')
    <div class="container">
        <x-ui::breadcrumbs :items="[
            ['label' => 'Users', 'url' => url('/users')],
            ['label' => 'Deleted Users'],
        ]" />

        <x-ui::card>
            <x-slot name="header">
                <div class="d-flex align-items-center justify-content-between">
                    <h3 class="card-title mb-0">Deleted Users</h3>
                    <x-ui::button href="{{ route('users') }}" variant="secondary" size="sm" outline icon="arrow-left">
                        Back to Users
                    </x-ui::button>
                </div>
            </x-slot>

            @if($users->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th class="d-none d-sm-table-cell">Email</th>
                                <th>Role</th>
                                <th class="d-none d-md-table-cell">Deleted</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td class="fw-medium">{{ $user->name }}</td>
                                    <td class="d-none d-sm-table-cell">{{ $user->email }}</td>
                                    <td>
                                        @foreach($user->roles as $role)
                                            <x-ui::badge :variant="$role->name === 'Admin' ? 'warning' : 'primary'" size="sm">{{ $role->name }}</x-ui::badge>
                                        @endforeach
                                    </td>
                                    <td class="d-none d-md-table-cell text-muted">{{ $user->deleted_at->format('M d, Y') }}</td>
                                    <td class="text-end">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <x-ui::button href="{{ url('users/deleted/' . $user->id) }}" variant="info" size="sm" icon="eye">
                                                Show
                                            </x-ui::button>
                                            <form method="POST" action="{{ url('users/deleted/' . $user->id) }}" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <x-ui::button type="submit" variant="success" size="sm" icon="check">
                                                    Restore
                                                </x-ui::button>
                                            </form>
                                            <form method="POST" action="{{ url('users/deleted/' . $user->id) }}" class="d-inline" x-data @submit.prevent="if(confirm('Permanently delete this user?')) $el.submit()">
                                                @csrf
                                                @method('DELETE')
                                                <x-ui::button type="submit" variant="danger" size="sm" icon="trash">
                                                    Destroy
                                                </x-ui::button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" class="text-secondary mb-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                    <p class="fw-medium mb-1">No deleted users</p>
                    <p class="text-muted small mb-3">Deleted users will appear here for recovery.</p>
                    <x-ui::button href="{{ route('users') }}" variant="primary" size="sm">
                        Back to Users
                    </x-ui::button>
                </div>
            @endif
        </x-ui::card>
    </div>
@endsection
