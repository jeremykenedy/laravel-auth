@extends('layouts.app')

@section('template_title')
    Deleted User: {{ $user->name }}
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <x-ui::breadcrumbs :items="[
                    ['label' => 'Users', 'url' => url('/users')],
                    ['label' => 'Deleted', 'url' => url('/users/deleted')],
                    ['label' => $user->name],
                ]" />

                <x-ui::card>
                    <x-slot name="header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h3 class="card-title mb-0">
                                <x-ui::badge variant="danger" class="me-2">Deleted</x-ui::badge>
                                {{ $user->name }}
                            </h3>
                            <x-ui::button href="{{ url('/users/deleted') }}" variant="secondary" size="sm" outline>
                                Back
                            </x-ui::button>
                        </div>
                    </x-slot>

                    <div class="row g-4">
                        <div class="col-md-3 text-center">
                            <x-avatar :alt="$user->name" size="2xl" />
                        </div>
                        <div class="col-md-9">
                            <dl class="row mb-0">
                                <dt class="col-sm-3 text-muted">ID</dt>
                                <dd class="col-sm-9">{{ $user->id }}</dd>

                                <dt class="col-sm-3 text-muted">Username</dt>
                                <dd class="col-sm-9 fw-medium">{{ $user->name }}</dd>

                                <dt class="col-sm-3 text-muted">Email</dt>
                                <dd class="col-sm-9">{{ $user->email }}</dd>

                                <dt class="col-sm-3 text-muted">Name</dt>
                                <dd class="col-sm-9">{{ $user->first_name }} {{ $user->last_name }}</dd>

                                <dt class="col-sm-3 text-muted">Role(s)</dt>
                                <dd class="col-sm-9">
                                    @foreach($user->roles as $role)
                                        <x-ui::badge :variant="$role->name === 'Admin' ? 'warning' : 'primary'">{{ $role->name }}</x-ui::badge>
                                    @endforeach
                                </dd>

                                <dt class="col-sm-3 text-muted">Deleted</dt>
                                <dd class="col-sm-9 text-danger">{{ $user->deleted_at->format('M d, Y g:i A') }}</dd>

                                <dt class="col-sm-3 text-muted">Created</dt>
                                <dd class="col-sm-9 text-muted">{{ $user->created_at->format('M d, Y g:i A') }}</dd>
                            </dl>
                        </div>
                    </div>

                    <x-slot name="footerSlot">
                        <div class="d-flex align-items-center justify-content-between">
                            <form method="POST" action="{{ url('users/deleted/' . $user->id) }}">
                                @csrf
                                @method('PUT')
                                <x-ui::button type="submit" variant="success" size="sm" icon="check">Restore User</x-ui::button>
                            </form>
                            <form method="POST" action="{{ url('users/deleted/' . $user->id) }}" x-data @submit.prevent="if(confirm('This will permanently delete this user. Continue?')) $el.submit()">
                                @csrf
                                @method('DELETE')
                                <x-ui::button type="submit" variant="danger" size="sm" icon="trash">Permanently Delete</x-ui::button>
                            </form>
                        </div>
                    </x-slot>
                </x-ui::card>
            </div>
        </div>
    </div>
@endsection
