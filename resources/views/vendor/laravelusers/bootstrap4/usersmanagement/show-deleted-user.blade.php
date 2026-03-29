@extends('layouts.app')

@section('template_title')
    Deleted User: {{ $user->name }}
@endsection

@section('content')
    <x-ui::breadcrumbs :items="[
        ['label' => 'Users', 'url' => url('/users')],
        ['label' => 'Deleted', 'url' => url('/users/deleted')],
        ['label' => $user->name],
    ]" />
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">
                <span class="badge badge-danger mr-2">Deleted</span>
                {{ $user->name }}
            </h3>
            <a href="{{ url('/users/deleted') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fa fa-arrow-left mr-1"></i>Back to Deleted Users
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 text-center mb-3">
                    <x-avatar :src="$user->profile?->avatar ?? null" :alt="$user->name" size="2xl" />
                </div>
                <div class="col-md-9">
                    <dl class="row mb-0">
                        <dt class="col-sm-3 text-muted">ID</dt>
                        <dd class="col-sm-9">{{ $user->id }}</dd>
                        <dt class="col-sm-3 text-muted">Username</dt>
                        <dd class="col-sm-9 font-weight-bold">{{ $user->name }}</dd>
                        <dt class="col-sm-3 text-muted">Email</dt>
                        <dd class="col-sm-9">{{ $user->email }}</dd>
                        <dt class="col-sm-3 text-muted">Role(s)</dt>
                        <dd class="col-sm-9">
                            @foreach($user->roles as $role)
                                <x-ui::badge :variant="$role->name === 'Admin' ? 'warning' : 'primary'">{{ $role->name }}</x-ui::badge>
                            @endforeach
                        </dd>
                        <dt class="col-sm-3 text-muted">Created</dt>
                        <dd class="col-sm-9">{{ $user->created_at->format('M d, Y g:i A') }}</dd>
                        <dt class="col-sm-3 text-muted">Deleted</dt>
                        <dd class="col-sm-9 text-danger">{{ $user->deleted_at->format('M d, Y g:i A') }}</dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <form method="POST" action="{{ url('users/deleted/' . $user->id) }}">
                @csrf @method('PUT')
                <button type="submit" class="btn btn-success"><i class="fa fa-check mr-1"></i>Restore User</button>
            </form>
            <form method="POST" action="{{ url('users/deleted/' . $user->id) }}" onsubmit="return confirm('Permanently delete this user? This cannot be undone.')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Permanently Delete</button>
            </form>
        </div>
    </div>
@endsection
