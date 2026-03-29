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
        <p><em>Thank you</em> for checking this project out. <strong>Please remember to star it!</strong> <svg class="inline h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg></p>

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
