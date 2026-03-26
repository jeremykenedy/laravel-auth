@extends('layouts.app')

@section('template_title')
    {{ trans('usersmanagement.create-new-user') }}
@endsection

@section('content')
    <div class="max-w-3xl mx-auto">
        <x-ui::card>
            <x-slot name="header">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium">{{ trans('usersmanagement.create-new-user') }}</h3>
                    <x-ui::button href="{{ route('users') }}" variant="secondary" size="sm" outline icon="arrow-left">
                        Back to Users
                    </x-ui::button>
                </div>
            </x-slot>

            <form method="POST" action="{{ route('users.store') }}">
                @csrf

                <div class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-ui::input name="email" type="email" label="Email" :value="old('email')" required placeholder="user@example.com" autocomplete="email" />
                        <x-ui::input name="name" label="Username" :value="old('name')" required placeholder="username" autocomplete="username" />
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-ui::input name="first_name" label="First Name" :value="old('first_name')" placeholder="First name" autocomplete="given-name" />
                        <x-ui::input name="last_name" label="Last Name" :value="old('last_name')" placeholder="Last name" autocomplete="family-name" />
                    </div>

                    <x-ui::select name="role" label="Role" :options="$roles->pluck('name', 'id')->toArray()" placeholder="Select a role" required />

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-ui::password-input name="password" label="Password" required :strength-meter="true" />
                        <x-ui::password-input name="password_confirmation" label="Confirm Password" required :strength-meter="false" :show-hide="false" />
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <x-ui::button type="submit" variant="success" icon="plus">
                        Create User
                    </x-ui::button>
                </div>
            </form>
        </x-ui::card>
    </div>
@endsection
