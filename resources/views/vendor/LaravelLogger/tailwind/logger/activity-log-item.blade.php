@php
    $userIdField = config('LaravelLogger.defaultUserIDField')
@endphp

@extends(config('LaravelLogger.loggerBladeExtended'))

@if(config('LaravelLogger.bladePlacement') == 'yield')
    @section(config('LaravelLogger.bladePlacementCss'))
@elseif (config('LaravelLogger.bladePlacement') == 'stack')
    @push(config('LaravelLogger.bladePlacementCss'))
@endif

    @include('LaravelLogger::partials.styles')

@if(config('LaravelLogger.bladePlacement') == 'yield')
    @endsection
@elseif (config('LaravelLogger.bladePlacement') == 'stack')
    @endpush
@endif

@if(config('LaravelLogger.bladePlacement') == 'yield')
    @section(config('LaravelLogger.bladePlacementJs'))
@elseif (config('LaravelLogger.bladePlacement') == 'stack')
    @push(config('LaravelLogger.bladePlacementJs'))
@endif

    @include('LaravelLogger::partials.scripts', ['activities' => $userActivities])

@if(config('LaravelLogger.bladePlacement') == 'yield')
    @endsection
@elseif (config('LaravelLogger.bladePlacement') == 'stack')
    @endpush
@endif

@section('template_title')
    {{ trans('LaravelLogger::laravel-logger.drilldown.title', ['id' => $activity->id]) }}
@endsection

@php
    switch ($activity->userType) {
        case trans('LaravelLogger::laravel-logger.userTypes.registered'):
            $userTypeClass = 'success';
            break;
        case trans('LaravelLogger::laravel-logger.userTypes.crawler'):
            $userTypeClass = 'danger';
            break;
        case trans('LaravelLogger::laravel-logger.userTypes.guest'):
        default:
            $userTypeClass = 'warning';
            break;
    }

    switch (strtolower($activity->methodType)) {
        case 'get':
            $methodClass = 'info';
            break;
        case 'post':
            $methodClass = 'primary';
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

    $platform       = $userAgentDetails['platform'];
    $browser        = $userAgentDetails['browser'];
    $browserVersion = $userAgentDetails['version'];
@endphp

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    @if(config('LaravelLogger.enablePackageFlashMessageBlade'))
        @include('LaravelLogger::partials.form-status')
    @endif

    <x-ui::card>
        <x-slot:header>
            <div class="flex items-center justify-between">
                <span class="text-lg font-medium {{ $isClearedEntry ? 'text-red-700 dark:text-red-400' : 'text-gray-900 dark:text-gray-100' }}">
                    {!! trans('LaravelLogger::laravel-logger.drilldown.title', ['id' => $activity->id]) !!}
                </span>
                <x-ui::button
                    href="{{ $isClearedEntry ? route('cleared') : route('activity') }}"
                    :variant="$isClearedEntry ? 'secondary' : 'info'"
                    size="sm"
                >
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" /></svg>
                    {!! trans('LaravelLogger::laravel-logger.drilldown.buttons.back') !!}
                </x-ui::button>
            </div>
        </x-slot:header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            {{-- Activity Details --}}
            <div class="rounded-lg border {{ $isClearedEntry ? 'border-red-300 dark:border-red-700' : 'border-gray-200 dark:border-gray-700' }} overflow-hidden">
                <div class="px-4 py-3 text-sm font-medium {{ $isClearedEntry ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300' : 'bg-blue-600 text-white dark:bg-blue-700' }}">
                    {!! trans('LaravelLogger::laravel-logger.drilldown.title-details') !!}
                </div>
                <div class="px-4 py-3 space-y-3">
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">{!! trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.id') !!}</dt>
                        <dd class="mt-0.5 text-sm text-gray-900 dark:text-gray-100">{{ $activity->id }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">{!! trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.description') !!}</dt>
                        <dd class="mt-0.5 text-sm text-gray-900 dark:text-gray-100">{{ $activity->description }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">{!! trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.details') !!}</dt>
                        <dd class="mt-0.5 text-sm text-gray-900 dark:text-gray-100">
                            @if($activity->details)
                                {{ $activity->details }}
                            @else
                                <span class="italic text-gray-400 dark:text-gray-500">{!! trans('LaravelLogger::laravel-logger.drilldown.list-group.fields.none') !!}</span>
                            @endif
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">{!! trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.route') !!}</dt>
                        <dd class="mt-0.5 text-sm">
                            <a href="@if($activity->route != '/')/@endif{{ $activity->route }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                                {{ $activity->route }}
                            </a>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">{!! trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.agent') !!}</dt>
                        <dd class="mt-0.5 text-sm text-gray-900 dark:text-gray-100">
                            {{ $platform }} / {{ $browser }} <span class="text-xs text-gray-400 dark:text-gray-500">{{ $browserVersion }}</span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">{!! trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.locale') !!}</dt>
                        <dd class="mt-0.5 text-sm text-gray-900 dark:text-gray-100">{{ $langDetails }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">{!! trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.referer') !!}</dt>
                        <dd class="mt-0.5 text-sm">
                            @if($activity->referer)
                                <a href="{{ $activity->referer }}" class="text-blue-600 dark:text-blue-400 hover:underline break-all">
                                    {{ $activity->referer }}
                                </a>
                            @else
                                <span class="italic text-gray-400 dark:text-gray-500">{!! trans('LaravelLogger::laravel-logger.drilldown.list-group.fields.none') !!}</span>
                            @endif
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">{!! trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.methodType') !!}</dt>
                        <dd class="mt-0.5">
                            <x-ui::badge :variant="$methodClass">{{ $activity->methodType }}</x-ui::badge>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">{!! trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.timePassed') !!}</dt>
                        <dd class="mt-0.5 text-sm text-gray-900 dark:text-gray-100">{{ $timePassed }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">{!! trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.createdAt') !!}</dt>
                        <dd class="mt-0.5 text-sm text-gray-900 dark:text-gray-100">{{ $activity->created_at }}</dd>
                    </div>
                </div>
            </div>

            {{-- IP Address Details --}}
            <div class="rounded-lg border {{ $isClearedEntry ? 'border-red-300 dark:border-red-700' : 'border-gray-200 dark:border-gray-700' }} overflow-hidden">
                <div class="px-4 py-3 text-sm font-medium {{ $isClearedEntry ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300' : 'bg-blue-600 text-white dark:bg-blue-700' }}">
                    {!! trans('LaravelLogger::laravel-logger.drilldown.title-ip-details') !!}
                </div>
                <div class="px-4 py-3 space-y-3">
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">{!! trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.ip') !!}</dt>
                        <dd class="mt-0.5 text-sm text-gray-900 dark:text-gray-100">{{ $activity->ipAddress }}</dd>
                    </div>
                    @if($ipAddressDetails)
                        @foreach($ipAddressDetails as $ipAddressDetailKey => $ipAddressDetailValue)
                            <div>
                                <dt class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">{{ $ipAddressDetailKey }}</dt>
                                <dd class="mt-0.5 text-sm text-gray-900 dark:text-gray-100">{{ $ipAddressDetailValue }}</dd>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center text-sm text-gray-400 dark:text-gray-500 italic py-4">
                            Additional Ip Address Data Not Available.
                        </p>
                    @endif
                </div>
            </div>

            {{-- User Details --}}
            <div class="rounded-lg border {{ $isClearedEntry ? 'border-red-300 dark:border-red-700' : 'border-gray-200 dark:border-gray-700' }} overflow-hidden">
                <div class="px-4 py-3 text-sm font-medium {{ $isClearedEntry ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300' : 'bg-blue-600 text-white dark:bg-blue-700' }}">
                    {!! trans('LaravelLogger::laravel-logger.drilldown.title-user-details') !!}
                </div>
                <div class="px-4 py-3 space-y-3">
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">{!! trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.userType') !!}</dt>
                        <dd class="mt-0.5">
                            <x-ui::badge :variant="$userTypeClass">{{ $activity->userType }}</x-ui::badge>
                        </dd>
                    </div>
                    @if($userDetails)
                        <div>
                            <dt class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">{!! trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.userId') !!}</dt>
                            <dd class="mt-0.5 text-sm text-gray-900 dark:text-gray-100">{{ $userDetails->$userIdField }}</dd>
                        </div>
                        @if(config('LaravelLogger.rolesEnabled'))
                            <div>
                                <dt class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">{!! trans('LaravelLogger::laravel-logger.drilldown.labels.userRoles') !!}</dt>
                                <dd class="mt-0.5 flex flex-wrap gap-1">
                                    @foreach ($userDetails->roles as $user_role)
                                        @php
                                            if ($user_role->name == 'User') {
                                                $labelClass = 'primary';
                                            } elseif ($user_role->name == 'Admin') {
                                                $labelClass = 'warning';
                                            } elseif ($user_role->name == 'Unverified') {
                                                $labelClass = 'danger';
                                            } else {
                                                $labelClass = 'secondary';
                                            }
                                        @endphp
                                        <x-ui::badge :variant="$labelClass">
                                            {{ $user_role->name }} - {!! trans('LaravelLogger::laravel-logger.drilldown.labels.userLevel') !!} {{ $user_role->level }}
                                        </x-ui::badge>
                                    @endforeach
                                </dd>
                            </div>
                        @endif
                        <div>
                            <dt class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">{!! trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.userName') !!}</dt>
                            <dd class="mt-0.5 text-sm text-gray-900 dark:text-gray-100">{{ $userDetails->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">{!! trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.userEmail') !!}</dt>
                            <dd class="mt-0.5 text-sm">
                                <a href="mailto:{{ $userDetails->email }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                                    {{ $userDetails->email }}
                                </a>
                            </dd>
                        </div>
                        @if($userDetails->last_name || $userDetails->first_name)
                            <div>
                                <dt class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">{!! trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.userFulltName') !!}</dt>
                                <dd class="mt-0.5 text-sm text-gray-900 dark:text-gray-100">{{ $userDetails->last_name }}, {{ $userDetails->first_name }}</dd>
                            </div>
                        @endif
                        @if($userDetails->signup_ip_address)
                            <div>
                                <dt class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">{!! trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.userSignupIp') !!}</dt>
                                <dd class="mt-0.5 text-sm text-gray-900 dark:text-gray-100">{{ $userDetails->signup_ip_address }}</dd>
                            </div>
                        @endif
                        <div>
                            <dt class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">{!! trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.userCreatedAt') !!}</dt>
                            <dd class="mt-0.5 text-sm text-gray-900 dark:text-gray-100">{{ $userDetails->created_at }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">{!! trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.userUpdatedAt') !!}</dt>
                            <dd class="mt-0.5 text-sm text-gray-900 dark:text-gray-100">{{ $userDetails->updated_at }}</dd>
                        </div>
                    @endif
                </div>
            </div>

        </div>

        {{-- User Activity Table --}}
        @if(!$isClearedEntry)
            <div class="mt-6 rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="px-4 py-3 bg-cyan-100 dark:bg-cyan-900/30 text-cyan-800 dark:text-cyan-300 text-sm font-medium flex items-center justify-between">
                    <span>{!! trans('LaravelLogger::laravel-logger.drilldown.title-user-activity') !!}</span>
                    @if(! config('LaravelLogger.loggerCursorPaginationEnabled'))
                        <x-ui::badge variant="info" size="sm">
                            {{ $totalUserActivities }} {!! trans('LaravelLogger::laravel-logger.dashboard.subtitle') !!}
                        </x-ui::badge>
                    @endif
                </div>
                <div class="p-0">
                    @include('LaravelLogger::logger.partials.activity-table', ['activities' => $userActivities])
                </div>
            </div>
        @endif

    </x-ui::card>

</div>

@endsection
