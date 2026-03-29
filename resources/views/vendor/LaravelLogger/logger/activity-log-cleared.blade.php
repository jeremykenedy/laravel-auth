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

@php
    switch (config('LaravelLogger.bootstapVersion')) {
        case '4':
            $containerClass = 'card';
            $containerHeaderClass = 'card-header';
            $containerBodyClass = 'card-body';
            break;
        case '3':
        default:
            $containerClass = 'panel panel-default';
            $containerHeaderClass = 'panel-heading';
            $containerBodyClass = 'panel-body';
    }
    $bootstrapCardClasses = (is_null(config('LaravelLogger.bootstrapCardClasses')) ? '' : config('LaravelLogger.bootstrapCardClasses'));
@endphp

@section('content')

    <div class="container-fluid">

        @if(config('LaravelLogger.enablePackageFlashMessageBlade'))
            @include('LaravelLogger::partials.form-status')
        @endif

        <div class="row">
            <div class="col-sm-12">
                <div class="{{ $containerClass }} {{ $bootstrapCardClasses }}">
                    <div class="{{ $containerHeaderClass }}">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span>
                                {!! trans('LaravelLogger::laravel-logger.dashboardCleared.title') !!}
                                @if(! config('LaravelLogger.loggerCursorPaginationEnabled'))
                                    <sup class="label">
                                        {{ $totalActivities }} {!! trans('LaravelLogger::laravel-logger.dashboardCleared.subtitle') !!}
                                    </sup>
                                @endif
                            </span>
                            <div class="btn-group pull-right btn-group-xs">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v fa-fw" aria-hidden="true"></i>
                                    <span class="sr-only">
                                        {!! trans('LaravelLogger::laravel-logger.dashboard.menu.alt') !!}
                                    </span>
                                </button>
                                @if(config('LaravelLogger.bootstapVersion') == '4')
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="{{route('activity')}}" class="dropdown-item">
                                            <span class="text-primary">
                                                <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                                {!! trans('LaravelLogger::laravel-logger.dashboard.menu.back') !!}
                                            </span>
                                        </a>
                                        @if($totalActivities)
                                            @include('LaravelLogger::forms.delete-activity-log')
                                            @include('LaravelLogger::forms.restore-activity-log')
                                        @endif
                                    </div>
                                @else
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{route('activity')}}">
                                                <span class="text-primary">
                                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                                    {!! trans('LaravelLogger::laravel-logger.dashboard.menu.back') !!}
                                                </span>
                                            </a>
                                        </li>
                                        @if($totalActivities)
                                            <li>
                                                @include('LaravelLogger::forms.delete-activity-log')
                                            </li>
                                            <li>
                                                @include('LaravelLogger::forms.restore-activity-log')
                                            </li>
                                        @endif
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @include('LaravelLogger::logger.partials.activity-table', ['activities' => $activities, 'hoverable' => true])
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('LaravelLogger::modals.confirm-modal', ['formTrigger' => 'confirmDelete', 'modalClass' => 'danger', 'actionBtnIcon' => 'fa-trash-o'])
    @include('LaravelLogger::modals.confirm-modal', ['formTrigger' => 'confirmRestore', 'modalClass' => 'success', 'actionBtnIcon' => 'fa-check'])

@endsection
