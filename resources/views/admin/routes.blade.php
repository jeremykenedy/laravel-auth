@extends('layouts.app')

@section('template_title', 'Routes')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Application Routes</h1>
        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $routes->count() }} routes</span>
    </div>

    <x-ui::card>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Method</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">URI</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider hidden lg:table-cell">Name</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider hidden xl:table-cell">Action</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider hidden xl:table-cell">Middleware</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
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
                            <td class="px-4 py-2.5 text-xs text-gray-500 dark:text-gray-400 hidden lg:table-cell">{{ $route['name'] }}</td>
                            <td class="px-4 py-2.5 text-xs text-gray-500 dark:text-gray-400 max-w-xs truncate hidden xl:table-cell" title="{{ $route['action'] }}">{{ $route['action'] }}</td>
                            <td class="px-4 py-2.5 text-xs text-gray-400 dark:text-gray-500 max-w-xs truncate hidden xl:table-cell" title="{{ $route['middleware'] }}">{{ $route['middleware'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-ui::card>
</div>
@endsection
