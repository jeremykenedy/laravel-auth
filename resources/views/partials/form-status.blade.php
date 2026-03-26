@if (session('message'))
    <x-ui::alert :variant="session('status', 'info')" :dismissible="true" class="mb-4">
        {{ session('message') }}
    </x-ui::alert>
@endif

@if (session('success'))
    <x-ui::alert variant="success" :dismissible="true" title="Success" class="mb-4">
        {{ session('success') }}
    </x-ui::alert>
@endif

@if (session('status') === 'wrong')
    <x-ui::alert variant="danger" :dismissible="true" class="mb-4">
        {{ session('message') }}
    </x-ui::alert>
@endif

@if (session('error'))
    <x-ui::alert variant="danger" :dismissible="true" title="Error" class="mb-4">
        {{ session('error') }}
    </x-ui::alert>
@endif

@if (session('errors') && count($errors) > 0)
    <x-ui::alert variant="danger" :dismissible="true" title="Validation Error" class="mb-4">
        <ul class="mt-1 list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </x-ui::alert>
@endif
