@if(session()->has('status'))
    <x-ui::alert :variant="session('status') === 'wrong' ? 'danger' : 'success'" :dismissible="true" class="mb-4">
        {{ session('message') }}
    </x-ui::alert>
@endif
