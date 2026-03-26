@extends('layouts.app')

@section('template_title', 'Routes')

@section('content')
<div class="container mx-auto max-w-7xl px-4 py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Application Routes</h1>
        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $routes->count() }} routes</span>
    </div>

    <x-ui::card>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <th class="px-4 py-3 text-left font-medium text-gray-500 dark:text-gray-400">Method</th>
                        <th class="px-4 py-3 text-left font-medium text-gray-500 dark:text-gray-400">URI</th>
                        <th class="px-4 py-3 text-left font-medium text-gray-500 dark:text-gray-400">Name</th>
                        <th class="px-4 py-3 text-left font-medium text-gray-500 dark:text-gray-400">Action</th>
                        <th class="px-4 py-3 text-left font-medium text-gray-500 dark:text-gray-400">Middleware</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @foreach($routes as $route)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
                            <td class="px-4 py-2.5 whitespace-nowrap">
                                @foreach(explode('|', $route['methods']) as $method)
                                    @php
                                        $color = match($method) {
                                            'GET', 'HEAD' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
                                            'POST' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
                                            'PUT', 'PATCH' => 'bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400',
                                            'DELETE' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400',
                                            default => 'bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400',
                                        };
                                    @endphp
                                    <span class="inline-block px-1.5 py-0.5 text-xs font-mono font-medium rounded {{ $color }}">{{ $method }}</span>
                                @endforeach
                            </td>
                            <td class="px-4 py-2.5 font-mono text-xs text-gray-900 dark:text-gray-100">{{ $route['uri'] }}</td>
                            <td class="px-4 py-2.5 text-xs text-gray-500 dark:text-gray-400">{{ $route['name'] }}</td>
                            <td class="px-4 py-2.5 text-xs text-gray-500 dark:text-gray-400 max-w-xs truncate" title="{{ $route['action'] }}">{{ $route['action'] }}</td>
                            <td class="px-4 py-2.5 text-xs text-gray-400 dark:text-gray-500 max-w-xs truncate" title="{{ $route['middleware'] }}">{{ $route['middleware'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-ui::card>
</div>
@endsection
