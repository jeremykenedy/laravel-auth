@extends('layouts.guest')

@section('content')
    <x-ui::card>
        <div class="text-center py-8">
            <h1 class="text-6xl font-bold text-gray-300 dark:text-gray-600 mb-4">404</h1>
            <h2 class="text-xl font-medium text-gray-900 dark:text-gray-100 mb-2">404 Not Found</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">The page you are looking for could not be found.</p>
            <x-ui::button href="{{ url('/') }}" variant="primary">
                Return Home
            </x-ui::button>
        </div>
    </x-ui::card>
@endsection
