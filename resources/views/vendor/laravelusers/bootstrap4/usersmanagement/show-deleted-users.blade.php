@extends('layouts.app')

@section('template_title')
    Deleted Users
@endsection

@section('content')
    <x-ui::breadcrumbs :items="[
        ['label' => 'Users', 'url' => url('/users')],
        ['label' => 'Deleted Users'],
    ]" />
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">Deleted Users</h3>
            <a href="{{ route('users') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fa fa-arrow-left mr-1"></i>Back to Users
            </a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th class="d-none d-sm-table-cell">Email</th>
                            <th>Role</th>
                            <th class="d-none d-md-table-cell">Deleted</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td class="font-weight-bold">{{ $user->name }}</td>
                                <td class="d-none d-sm-table-cell">{{ $user->email }}</td>
                                <td>
                                    @foreach($user->roles as $role)
                                        <x-ui::badge :variant="$role->name === 'Admin' ? 'warning' : 'primary'" size="sm">{{ $role->name }}</x-ui::badge>
                                    @endforeach
                                </td>
                                <td class="d-none d-md-table-cell text-muted">{{ $user->deleted_at->format('M d, Y') }}</td>
                                <td class="text-right">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ url('users/deleted/' . $user->id) }}" class="btn btn-info"><i class="fa fa-eye"></i> Show</a>
                                        <form method="POST" action="{{ url('users/deleted/' . $user->id) }}" class="d-inline">
                                            @csrf @method('PUT')
                                            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Restore</button>
                                        </form>
                                        <form method="POST" action="{{ url('users/deleted/' . $user->id) }}" class="d-inline" onsubmit="return confirm('Permanently delete this user?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Destroy</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($users->isEmpty())
                <div class="text-center py-5">
                    <i class="fa fa-users fa-3x text-muted d-block mb-3"></i>
                    <h5>No deleted users</h5>
                    <p class="text-muted">Deleted users will appear here for recovery.</p>
                    <a href="{{ route('users') }}" class="btn btn-primary btn-sm">Back to Users</a>
                </div>
            @endif
        </div>
    </div>
@endsection
