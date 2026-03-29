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

    @include('LaravelLogger::partials.scripts', ['activities' => $activities])
    @include('LaravelLogger::scripts.confirm-modal', ['formTrigger' => '#confirmDelete'])

    @if(config('LaravelLogger.enableDrillDown'))
        @include('LaravelLogger::scripts.clickable-row')
        @include('LaravelLogger::scripts.tooltip')
    @endif

@if(config('LaravelLogger.bladePlacement') == 'yield')
    @endsection
@elseif (config('LaravelLogger.bladePlacement') == 'stack')
    @endpush
@endif

@section('template_title')
    {{ trans('LaravelLogger::laravel-logger.dashboard.title') }}
@endsection

@section('content')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

        @if(config('LaravelLogger.enableLiveSearch'))
            @include('LaravelLogger::partials.form-live-search')
        @endif

        @if(config('LaravelLogger.enableSearch'))
            @include('LaravelLogger::partials.form-search')
        @endif

        @if(config('LaravelLogger.enablePackageFlashMessageBlade'))
            @include('LaravelLogger::partials.form-status')
        @endif

        <x-ui::card>
            <x-slot:header>
                <div class="flex items-center justify-between">
                    @if(config('LaravelLogger.enableSubMenu'))
                        <span class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {!! trans('LaravelLogger::laravel-logger.dashboard.title') !!}
                            @if(! config('LaravelLogger.loggerCursorPaginationEnabled'))
                                <x-ui::badge variant="secondary" size="sm" class="ml-2">
                                    {{ $totalActivities }} {!! trans('LaravelLogger::laravel-logger.dashboard.subtitle') !!}
                                </x-ui::badge>
                            @endif
                        </span>

                        <x-ui::dropdown align="right">
                            <x-slot:trigger>
                                <button type="button" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" /></svg>
                                    <span class="sr-only">{!! trans('LaravelLogger::laravel-logger.dashboard.menu.alt') !!}</span>
                                </button>
                            </x-slot:trigger>
                            @include('LaravelLogger::forms.clear-activity-log')
                            <a href="{{ route('cleared') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                {!! trans('LaravelLogger::laravel-logger.dashboard.menu.show') !!}
                            </a>
                        </x-ui::dropdown>
                    @else
                        <span class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {!! trans('LaravelLogger::laravel-logger.dashboard.title') !!}
                        </span>
                        @if(! config('LaravelLogger.loggerCursorPaginationEnabled'))
                            <x-ui::badge variant="secondary" size="sm">
                                {{ $totalActivities }} {!! trans('LaravelLogger::laravel-logger.dashboard.subtitle') !!}
                            </x-ui::badge>
                        @endif
                    @endif
                </div>
            </x-slot:header>

            @include('LaravelLogger::logger.partials.activity-table', ['activities' => $activities, 'hoverable' => true])
        </x-ui::card>
    </div>

    @if(config('LaravelLogger.enableLiveSearch'))
        @include('LaravelLogger::scripts.live-search-script')
    @endif

    @include('LaravelLogger::modals.confirm-modal', ['formTrigger' => 'confirmDelete', 'modalClass' => 'danger', 'actionBtnIcon' => 'fa-trash-o'])

@endsection
