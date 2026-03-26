@if(Session::has('message'))
    <x-ui::alert :variant="Session::get('status', 'info')" :dismissible="true" class="mb-4">
        {{ Session::get('message') }}
    </x-ui::alert>
@endif
