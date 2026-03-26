@extends('layouts.guest')

@section('content')
    <x-ui::card>
        <div class="text-center py-8">
            <h1 class="text-6xl font-bold text-gray-300 dark:text-gray-600 mb-4">500</h1>
            <h2 class="text-xl font-medium text-gray-900 dark:text-gray-100 mb-2">500 Server Error</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Something went wrong on our end. Please try again later.</p>
            <x-ui::button href="{{ url('/') }}" variant="primary">
                Return Home
            </x-ui::button>
        </div>
    </x-ui::card>
@endsection
