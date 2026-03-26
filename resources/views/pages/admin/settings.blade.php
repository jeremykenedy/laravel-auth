@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-3xl px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Application Settings</h1>

    @if(session('success'))
        <x-ui::alert variant="success" class="mb-6">{{ session('success') }}</x-ui::alert>
    @endif

    <form method="POST" action="{{ route('admin.settings.update') }}">
        @csrf
        @method('PUT')

        @foreach($groups as $groupName => $settings)
            <x-ui::card title="{{ ucfirst($groupName) }}" class="mb-6">
                <div class="space-y-5">
                    @foreach($settings as $setting)
                        <div>
                            @if($setting->type === 'boolean')
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="hidden" name="settings[{{ $setting->key }}]" value="0">
                                    <input
                                        type="checkbox"
                                        name="settings[{{ $setting->key }}]"
                                        value="1"
                                        @checked(filter_var($setting->value, FILTER_VALIDATE_BOOLEAN))
                                        class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800"
                                    >
                                    <div>
                                        <span class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $setting->label }}</span>
                                        @if($setting->description)
                                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $setting->description }}</p>
                                        @endif
                                    </div>
                                </label>
                            @elseif($setting->type === 'integer')
                                <x-ui::input
                                    type="number"
                                    name="settings[{{ $setting->key }}]"
                                    label="{{ $setting->label }}"
                                    hint="{{ $setting->description }}"
                                    :value="$setting->value"
                                />
                            @else
                                <x-ui::input
                                    type="text"
                                    name="settings[{{ $setting->key }}]"
                                    label="{{ $setting->label }}"
                                    hint="{{ $setting->description }}"
                                    :value="$setting->value"
                                />
                            @endif
                        </div>
                    @endforeach
                </div>
            </x-ui::card>
        @endforeach

        <div class="flex justify-end">
            <x-ui::button type="submit" variant="primary">Save Settings</x-ui::button>
        </div>
    </form>
</div>
@endsection
