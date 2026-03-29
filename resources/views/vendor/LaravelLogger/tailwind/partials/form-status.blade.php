@if (session('message'))
    <x-ui::alert :variant="Session::get('status', 'info')" dismissible class="mb-4">
        {{ session('message') }}
    </x-ui::alert>
@endif

@if (session('success'))
    <x-ui::alert variant="success" dismissible class="mb-4">
        {{ session('success') }}
    </x-ui::alert>
@endif

@if(session()->has('status'))
    @if(session()->get('status') == 'wrong')
        <x-ui::alert variant="danger" dismissible class="mb-4">
            {{ session('message') }}
        </x-ui::alert>
    @endif
@endif

@if (session('error'))
    <x-ui::alert variant="danger" dismissible class="mb-4">
        {{ session('error') }}
    </x-ui::alert>
@endif

@if (count($errors) > 0)
    <x-ui::alert variant="danger" dismissible class="mb-4">
        <ul class="list-disc list-inside space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </x-ui::alert>
@endif
