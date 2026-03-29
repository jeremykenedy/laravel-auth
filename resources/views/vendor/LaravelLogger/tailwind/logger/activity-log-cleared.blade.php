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
    @include('LaravelLogger::scripts.confirm-modal', ['formTrigger' => '#confirmRestore'])

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
    {{ trans('LaravelLogger::laravel-logger.dashboardCleared.title') }}
@endsection

@section('content')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

        @if(config('LaravelLogger.enablePackageFlashMessageBlade'))
            @include('LaravelLogger::partials.form-status')
        @endif

        <x-ui::card>
            <x-slot:header>
                <div class="flex items-center justify-between">
                    <span class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {!! trans('LaravelLogger::laravel-logger.dashboardCleared.title') !!}
                        @if(! config('LaravelLogger.loggerCursorPaginationEnabled'))
                            <x-ui::badge variant="secondary" size="sm" class="ml-2">
                                {{ $totalActivities }} {!! trans('LaravelLogger::laravel-logger.dashboardCleared.subtitle') !!}
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
                        <a href="{{ route('activity') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-blue-600 dark:text-blue-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" /></svg>
                            {!! trans('LaravelLogger::laravel-logger.dashboard.menu.back') !!}
                        </a>
                        @if($totalActivities)
                            @include('LaravelLogger::forms.delete-activity-log')
                            @include('LaravelLogger::forms.restore-activity-log')
                        @endif
                    </x-ui::dropdown>
                </div>
            </x-slot:header>

            @include('LaravelLogger::logger.partials.activity-table', ['activities' => $activities, 'hoverable' => true])
        </x-ui::card>
    </div>

    @include('LaravelLogger::modals.confirm-modal', ['formTrigger' => 'confirmDelete', 'modalClass' => 'danger', 'actionBtnIcon' => 'fa-trash-o'])
    @include('LaravelLogger::modals.confirm-modal', ['formTrigger' => 'confirmRestore', 'modalClass' => 'success', 'actionBtnIcon' => 'fa-check'])

@endsection
