@extends('layouts.app')

@section('template_title')
    {{ trans('usersmanagement.create-new-user') }}
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <x-ui::breadcrumbs :items="[
                    ['label' => 'Users', 'url' => url('/users')],
                    ['label' => 'Create New User'],
                ]" />

                <x-ui::card>
                    <x-slot name="header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h3 class="card-title mb-0">{{ trans('usersmanagement.create-new-user') }}</h3>
                            <x-ui::button href="{{ route('users') }}" variant="secondary" size="sm" outline icon="arrow-left">
                                Back to Users
                            </x-ui::button>
                        </div>
                    </x-slot>

                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <x-ui::input name="email" type="email" label="Email" :value="old('email')" required placeholder="user@example.com" autocomplete="email" />
                            </div>
                            <div class="col-md-6">
                                <x-ui::input name="name" label="Username" :value="old('name')" required placeholder="username" autocomplete="username" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <x-ui::input name="first_name" label="First Name" :value="old('first_name')" placeholder="First name" autocomplete="given-name" />
                            </div>
                            <div class="col-md-6">
                                <x-ui::input name="last_name" label="Last Name" :value="old('last_name')" placeholder="Last name" autocomplete="family-name" />
                            </div>
                        </div>

                        <div class="mb-3">
                            <x-ui::select name="role" label="Role" :options="$roles->pluck('name', 'id')->toArray()" placeholder="Select a role" required />
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <x-ui::password-input name="password" label="Password" required :strength-meter="true" />
                            </div>
                            <div class="col-md-6">
                                <x-ui::password-input name="password_confirmation" label="Confirm Password" required :strength-meter="false" :show-hide="false" />
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <x-ui::button type="submit" variant="success" icon="plus">
                                Create User
                            </x-ui::button>
                        </div>
                    </form>
                </x-ui::card>
            </div>
        </div>
    </div>
@endsection
