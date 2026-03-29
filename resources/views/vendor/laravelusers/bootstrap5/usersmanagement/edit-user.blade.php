@extends('layouts.app')

@section('template_title')
    Editing {{ $user->name }}
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <x-ui::breadcrumbs :items="[
                    ['label' => 'Users', 'url' => url('/users')],
                    ['label' => $user->name, 'url' => url('users/' . $user->id)],
                    ['label' => 'Edit'],
                ]" />

                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Editing {{ $user->name }}</h5>
                        <x-ui::button href="{{ url('users/' . $user->id) }}" variant="secondary" size="sm" outline icon="arrow-left">
                            Back to User
                        </x-ui::button>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('users/' . $user->id) }}">
                            @csrf
                            @method('PATCH')

                            <div class="row mb-3">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <x-ui::input name="name" label="Username" :value="old('name', $user->name)" required autocomplete="username" />
                                </div>
                                <div class="col-md-6">
                                    <x-ui::input name="email" type="email" label="Email" :value="old('email', $user->email)" required autocomplete="email" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <x-ui::input name="first_name" label="First Name" :value="old('first_name', $user->first_name)" autocomplete="given-name" />
                                </div>
                                <div class="col-md-6">
                                    <x-ui::input name="last_name" label="Last Name" :value="old('last_name', $user->last_name)" autocomplete="family-name" />
                                </div>
                            </div>

                            <div class="mb-3">
                                <x-ui::select name="role" label="Role" :options="$roles->pluck('name', 'id')->toArray()" :value="old('role', $currentRole->id ?? '')" required />
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <x-ui::password-input name="password" label="Password (leave blank to keep current)" :required="false" :strength-meter="true" />
                                </div>
                                <div class="col-md-6">
                                    <x-ui::password-input name="password_confirmation" label="Confirm Password" :required="false" :strength-meter="false" :show-hide="false" />
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <x-ui::button type="submit" variant="success" icon="save">
                                    Update User
                                </x-ui::button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
