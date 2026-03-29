@php
    $drilldownStatus = config('LaravelLogger.enableDrillDown');
    $prependUrl = '/activity/log/';

    if (isset($hoverable) && $hoverable === true) {
        $hoverable = true;
    } else {
        $hoverable = false;
    }

    if (request()->is('activity/cleared')) {
        $prependUrl = '/activity/cleared/log/';
    }
@endphp

<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-50 dark:bg-gray-800">
            <tr>
                <th class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                    <span class="hidden sm:inline">{!! trans('LaravelLogger::laravel-logger.dashboard.labels.id') !!}</span>
                    <span class="sm:hidden">#</span>
                </th>
                <th class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                    {!! trans('LaravelLogger::laravel-logger.dashboard.labels.time') !!}
                </th>
                <th class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                    {!! trans('LaravelLogger::laravel-logger.dashboard.labels.description') !!}
                </th>
                <th class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                    {!! trans('LaravelLogger::laravel-logger.dashboard.labels.user') !!}
                </th>
                <th class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                    <span class="hidden sm:inline">{!! trans('LaravelLogger::laravel-logger.dashboard.labels.method') !!}</span>
                    <span class="sm:hidden">M</span>
                </th>
                <th class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                    {!! trans('LaravelLogger::laravel-logger.dashboard.labels.route') !!}
                </th>
                <th class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                    {!! trans('LaravelLogger::laravel-logger.dashboard.labels.ipAddress') !!}
                </th>
                <th class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                    {!! trans('LaravelLogger::laravel-logger.dashboard.labels.agent') !!}
                </th>
                @if(request()->is('activity/cleared'))
                    <th class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                        {!! trans('LaravelLogger::laravel-logger.dashboard.labels.deleteDate') !!}
                    </th>
                @endif
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-900">
            @foreach($activities as $activity)
                <tr
                    @if($drilldownStatus && $hoverable)
                        class="cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors"
                        x-data
                        x-on:click="window.location='{{ url($prependUrl . $activity->id) }}'"
                        title="{{ trans('LaravelLogger::laravel-logger.tooltips.viewRecord') }}"
                    @else
                        class="hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors"
                    @endif
                >
                    <td class="px-3 py-3 text-sm text-gray-500 dark:text-gray-400 whitespace-nowrap">
                        @if($hoverable)
                            {{ $activity->id }}
                        @else
                            <a href="{{ url($prependUrl . $activity->id) }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                                {{ $activity->id }}
                            </a>
                        @endif
                    </td>
                    <td class="px-3 py-3 text-sm text-gray-700 dark:text-gray-300 whitespace-nowrap" title="{{ $activity->created_at }}">
                        {{ $activity->timePassed }}
                    </td>
                    <td class="px-3 py-3 text-sm text-gray-700 dark:text-gray-300 max-w-xs truncate">
                        {{ $activity->description }}
                    </td>
                    <td class="px-3 py-3 whitespace-nowrap">
                        @php
                            switch ($activity->userType) {
                                case trans('LaravelLogger::laravel-logger.userTypes.registered'):
                                    $userTypeClass = 'success';
                                    $userLabel = $activity->userDetails['name'];
                                    break;
                                case trans('LaravelLogger::laravel-logger.userTypes.crawler'):
                                    $userTypeClass = 'danger';
                                    $userLabel = $activity->userType;
                                    break;
                                case trans('LaravelLogger::laravel-logger.userTypes.guest'):
                                default:
                                    $userTypeClass = 'warning';
                                    $userLabel = $activity->userType;
                                    break;
                            }
                        @endphp
                        <x-ui::badge :variant="$userTypeClass">{{ $userLabel }}</x-ui::badge>
                    </td>
                    <td class="px-3 py-3 whitespace-nowrap">
                        @php
                            switch (strtolower($activity->methodType)) {
                                case 'get':
                                    $methodClass = 'info';
                                    break;
                                case 'post':
                                    $methodClass = 'warning';
                                    break;
                                case 'put':
                                    $methodClass = 'warning';
                                    break;
                                case 'delete':
                                    $methodClass = 'danger';
                                    break;
                                default:
                                    $methodClass = 'info';
                                    break;
                            }
                        @endphp
                        <x-ui::badge :variant="$methodClass">{{ $activity->methodType }}</x-ui::badge>
                    </td>
                    <td class="px-3 py-3 text-sm text-gray-700 dark:text-gray-300 max-w-xs truncate">
                        @if($hoverable)
                            {{ showCleanRoutUrl($activity->route) }}
                        @else
                            <a href="{{ $activity->route }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                                {{ $activity->route }}
                            </a>
                        @endif
                    </td>
                    <td class="px-3 py-3 text-sm text-gray-500 dark:text-gray-400 whitespace-nowrap">
                        {{ $activity->ipAddress }}
                    </td>
                    <td class="px-3 py-3 text-sm text-gray-500 dark:text-gray-400 whitespace-nowrap">
                        @php
                            $platform       = $activity->userAgentDetails['platform'];
                            $browser        = $activity->userAgentDetails['browser'];
                            $browserVersion = $activity->userAgentDetails['version'];
                        @endphp
                        <span title="{{ $browser }} {{ $browserVersion }}">{{ $browser }}</span>
                        <span class="text-xs text-gray-400 dark:text-gray-500">{{ $browserVersion }}</span>
                        <span class="text-xs text-gray-400 dark:text-gray-500" title="{{ $platform }}">/ {{ $platform }}</span>
                        <span class="text-xs text-gray-400 dark:text-gray-500">{{ $activity->langDetails }}</span>
                    </td>
                    @if(request()->is('activity/cleared'))
                        <td class="px-3 py-3 text-sm text-gray-500 dark:text-gray-400 whitespace-nowrap">
                            {{ $activity->deleted_at }}
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@if(config('LaravelLogger.loggerCursorPaginationEnabled'))
    <div class="mt-4 flex justify-center">
        {!! $activities->links() !!}
    </div>
@elseif(config('LaravelLogger.loggerPaginationEnabled'))
    <div class="mt-4">
        <div class="flex justify-center">
            {!! $activities->links() !!}
        </div>
        <p class="mt-2 text-center text-sm text-gray-500 dark:text-gray-400">
            {!! trans('LaravelLogger::laravel-logger.pagination.countText', ['firstItem' => $activities->firstItem(), 'lastItem' => $activities->lastItem(), 'total' => $activities->total(), 'perPage' => $activities->perPage()]) !!}
        </p>
    </div>
@endif
