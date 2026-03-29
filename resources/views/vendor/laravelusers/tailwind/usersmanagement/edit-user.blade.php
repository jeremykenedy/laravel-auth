@extends('layouts.app')

@section('template_title')
    Editing {{ $user->name }}
@endsection

@section('content')
    <div class="max-w-3xl mx-auto">
        <x-ui::breadcrumbs :items="[
            ['label' => 'Users', 'url' => url('/users')],
            ['label' => $user->name, 'url' => url('users/' . $user->id)],
            ['label' => 'Edit'],
        ]" />
        <x-ui::card>
            <x-slot name="header">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium">Editing {{ $user->name }}</h3>
                    <x-ui::button href="{{ url('users/' . $user->id) }}" variant="secondary" size="sm" outline icon="arrow-left">
                        Back to User
                    </x-ui::button>
                </div>
            </x-slot>

            <form method="POST" action="{{ url('users/' . $user->id) }}">
                @csrf
                @method('PATCH')

                <div class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-ui::input name="name" label="Username" :value="old('name', $user->name)" required autocomplete="username" />
                        <x-ui::input name="email" type="email" label="Email" :value="old('email', $user->email)" required autocomplete="email" />
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-ui::input name="first_name" label="First Name" :value="old('first_name', $user->first_name)" autocomplete="given-name" />
                        <x-ui::input name="last_name" label="Last Name" :value="old('last_name', $user->last_name)" autocomplete="family-name" />
                    </div>

                    <x-ui::select name="role" label="Role" :options="$roles->pluck('name', 'id')->toArray()" :value="old('role', $currentRole->id ?? '')" required />

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-ui::password-input name="password" label="Password (leave blank to keep current)" :required="false" :strength-meter="true" />
                        <x-ui::password-input name="password_confirmation" label="Confirm Password" :required="false" :strength-meter="false" :show-hide="false" />
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <x-ui::button type="submit" variant="success" icon="save">
                        Update User
                    </x-ui::button>
                </div>
            </form>
        </x-ui::card>
    </div>
@endsection
