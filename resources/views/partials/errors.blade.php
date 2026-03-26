@if(session()->has('errors'))
    <x-ui::alert variant="danger" :dismissible="true" title="Following errors occurred">
        <ul class="mt-1 list-disc list-inside text-sm">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </x-ui::alert>
@endif
