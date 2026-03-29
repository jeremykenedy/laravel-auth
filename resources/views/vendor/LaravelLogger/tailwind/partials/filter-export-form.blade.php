{{-- Date Filtering and Export Form --}}
<x-ui::card class="mb-6">
    <x-slot:header>
        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            <svg class="inline-block w-5 h-5 mr-1 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" /></svg>
            {{ trans('LaravelLogger::laravel-logger.filterAndExport') }}
        </h3>
    </x-slot:header>

    <form method="GET" action="{{ route('activity') }}" class="space-y-4">
        <div class="flex flex-wrap items-end gap-4">
            {{-- Date Range Filtering --}}
            @if(config('LaravelLogger.enableDateFiltering'))
                <div>
                    <label for="date_from" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        {{ trans('LaravelLogger::laravel-logger.fromDate') }}:
                    </label>
                    <x-ui::input type="date" name="date_from" id="date_from" :value="request('date_from')" />
                </div>

                <div>
                    <label for="date_to" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        {{ trans('LaravelLogger::laravel-logger.toDate') }}:
                    </label>
                    <x-ui::input type="date" name="date_to" id="date_to" :value="request('date_to')" />
                </div>

                <div>
                    <label for="period" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        {{ trans('LaravelLogger::laravel-logger.quickPeriod') }}:
                    </label>
                    <select
                        name="period"
                        id="period"
                        class="block w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 px-4 py-2.5 text-sm text-gray-900 dark:text-gray-100 transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                        <option value="">{{ trans('LaravelLogger::laravel-logger.allTime') }}</option>
                        <option value="today" {{ request('period') == 'today' ? 'selected' : '' }}>{{ trans('LaravelLogger::laravel-logger.today') }}</option>
                        <option value="yesterday" {{ request('period') == 'yesterday' ? 'selected' : '' }}>{{ trans('LaravelLogger::laravel-logger.yesterday') }}</option>
                        <option value="last_7_days" {{ request('period') == 'last_7_days' ? 'selected' : '' }}>{{ trans('LaravelLogger::laravel-logger.last7Days') }}</option>
                        <option value="last_30_days" {{ request('period') == 'last_30_days' ? 'selected' : '' }}>{{ trans('LaravelLogger::laravel-logger.last30Days') }}</option>
                        <option value="last_3_months" {{ request('period') == 'last_3_months' ? 'selected' : '' }}>{{ trans('LaravelLogger::laravel-logger.last3Months') }}</option>
                        <option value="last_6_months" {{ request('period') == 'last_6_months' ? 'selected' : '' }}>{{ trans('LaravelLogger::laravel-logger.last6Months') }}</option>
                        <option value="last_year" {{ request('period') == 'last_year' ? 'selected' : '' }}>{{ trans('LaravelLogger::laravel-logger.lastYear') }}</option>
                    </select>
                </div>
            @endif

            {{-- Search Fields --}}
            @if(config('LaravelLogger.enableSearch'))
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        {{ trans('LaravelLogger::laravel-logger.description') }}:
                    </label>
                    <x-ui::input
                        type="text"
                        name="description"
                        id="description"
                        :value="request('description')"
                        :placeholder="trans('LaravelLogger::laravel-logger.searchDescription')"
                    />
                </div>

                <div>
                    <label for="user" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        {{ trans('LaravelLogger::laravel-logger.user') }}:
                    </label>
                    <select
                        name="user"
                        id="user"
                        class="block w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 px-4 py-2.5 text-sm text-gray-900 dark:text-gray-100 transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                        <option value="">{{ trans('LaravelLogger::laravel-logger.allUsers') }}</option>
                        @foreach($users as $user)
                            <option value="{{ $user->{config('LaravelLogger.defaultUserIDField')} }}" {{ request('user') == $user->{config('LaravelLogger.defaultUserIDField')} ? 'selected' : '' }}>
                                {{ $user->email }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif

            <div class="flex gap-2">
                <x-ui::button type="submit" variant="primary" size="sm" icon="search">
                    {{ trans('LaravelLogger::laravel-logger.filter') }}
                </x-ui::button>
                <x-ui::button href="{{ route('activity') }}" variant="secondary" size="sm">
                    {{ trans('LaravelLogger::laravel-logger.clearFilters') }}
                </x-ui::button>
            </div>
        </div>
    </form>

    {{-- Export Buttons --}}
    @if(config('LaravelLogger.enableExport'))
        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
            <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">{{ trans('LaravelLogger::laravel-logger.exportData') }}:</h4>
            <div class="flex gap-2">
                <x-ui::button
                    href="{{ route('export-activity', array_merge(request()->query(), ['format' => 'csv'])) }}"
                    variant="success"
                    size="sm"
                >
                    {{ trans('LaravelLogger::laravel-logger.exportCSV') }}
                </x-ui::button>
                <x-ui::button
                    href="{{ route('export-activity', array_merge(request()->query(), ['format' => 'json'])) }}"
                    variant="info"
                    size="sm"
                >
                    {{ trans('LaravelLogger::laravel-logger.exportJSON') }}
                </x-ui::button>
                <x-ui::button
                    href="{{ route('export-activity', array_merge(request()->query(), ['format' => 'excel'])) }}"
                    variant="warning"
                    size="sm"
                >
                    {{ trans('LaravelLogger::laravel-logger.exportExcel') }}
                </x-ui::button>
            </div>
        </div>
    @endif
</x-ui::card>
