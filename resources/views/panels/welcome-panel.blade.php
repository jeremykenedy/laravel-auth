@php
    $levelAmount = Auth::user()->level() >= 2 ? 'levels' : 'level';
@endphp

<x-ui::card>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Welcome {{ Auth::user()->name }}
            </h3>
            @level(5)
                <x-ui::badge variant="primary">Admin Access</x-ui::badge>
            @else
                <x-ui::badge variant="warning">User Access</x-ui::badge>
            @endlevel
        </div>
    </x-slot>

    <div class="space-y-4 text-sm text-gray-700 dark:text-gray-300">
        <p class="text-base">{{ trans('auth.loggedIn') }}</p>
        <p><em>Thank you</em> for checking this project out. <strong>Please remember to star it!</strong></p>

        <hr class="border-gray-200 dark:border-gray-700">

        <p>
            You have
            <strong>
                @level(5) Admin @else User @endlevel
            </strong>
            Access
        </p>

        <hr class="border-gray-200 dark:border-gray-700">

        <p>
            You have access to {{ $levelAmount }}:
            @level(5) <x-ui::badge variant="primary">5</x-ui::badge> @endlevel
            @level(4) <x-ui::badge variant="info">4</x-ui::badge> @endlevel
            @level(3) <x-ui::badge variant="success">3</x-ui::badge> @endlevel
            @level(2) <x-ui::badge variant="warning">2</x-ui::badge> @endlevel
            @level(1) <x-ui::badge variant="secondary">1</x-ui::badge> @endlevel
        </p>

        @level(5)
            <hr class="border-gray-200 dark:border-gray-700">
            <p>
                You have permissions:
                @permission('view.users') <x-ui::badge variant="primary">View</x-ui::badge> @endpermission
                @permission('create.users') <x-ui::badge variant="info">Create</x-ui::badge> @endpermission
                @permission('edit.users') <x-ui::badge variant="warning">Edit</x-ui::badge> @endpermission
                @permission('delete.users') <x-ui::badge variant="danger">Delete</x-ui::badge> @endpermission
            </p>
        @endlevel
    </div>
</x-ui::card>
