@php
    $userIdField = config('LaravelLogger.defaultUserIDField')
@endphp

<form action="{{ route('activity') }}" method="get">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-3 mb-4">
        @if(in_array('description', explode(',', config('LaravelLogger.searchFields'))))
            <div>
                <x-ui::input
                    type="text"
                    name="description"
                    :value="request()->get('description')"
                    :placeholder="trans('LaravelLogger::laravel-logger.dashboard.labels.description')"
                />
            </div>
        @endif
        @if(in_array('user', explode(',', config('LaravelLogger.searchFields'))))
            <div>
                <select
                    name="user"
                    id="user_select"
                    class="block w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 px-4 py-2.5 text-sm text-gray-900 dark:text-gray-100 transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
                    <option value="">{{ trans('LaravelLogger::laravel-logger.dashboard.search.all') }}</option>
                    @foreach($users as $user)
                        <option value="{{ $user->$userIdField }}" {{ request()->get('user') && request()->get('user') == $user->$userIdField ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        @endif
        @if(in_array('method', explode(',', config('LaravelLogger.searchFields'))))
            <div>
                <select
                    name="method"
                    class="block w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 px-4 py-2.5 text-sm text-gray-900 dark:text-gray-100 transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
                    <option value="">{{ trans('LaravelLogger::laravel-logger.dashboard.search.all') }}</option>
                    @foreach(explode(' ', 'CONNECT DELETE GET OPTIONS PATCH POST PUT TRACE') as $val)
                        <option value="{{ $val }}" {{ request()->get('method') && request()->get('method') == $val ? 'selected' : '' }}>{{ $val }}</option>
                    @endforeach
                </select>
            </div>
        @endif
        @if(in_array('route', explode(',', config('LaravelLogger.searchFields'))))
            <div>
                <x-ui::input
                    type="text"
                    name="route"
                    :value="request()->get('route')"
                    :placeholder="trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.route')"
                />
            </div>
        @endif
        @if(in_array('ip', explode(',', config('LaravelLogger.searchFields'))))
            <div>
                <x-ui::input
                    type="text"
                    name="ip_address"
                    :value="request()->get('ip_address')"
                    :placeholder="trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.ip')"
                />
            </div>
        @endif
        @if(in_array('description', explode(',', config('LaravelLogger.searchFields'))) || in_array('user', explode(',', config('LaravelLogger.searchFields'))) || in_array('method', explode(',', config('LaravelLogger.searchFields'))) || in_array('route', explode(',', config('LaravelLogger.searchFields'))) || in_array('ip', explode(',', config('LaravelLogger.searchFields'))))
            <div>
                <x-ui::button type="submit" variant="primary" block>
                    {{ trans('LaravelLogger::laravel-logger.dashboard.search.search') }}
                </x-ui::button>
            </div>
        @endif
    </div>
</form>
