@extends(config('laravelblocker.laravelBlockerBladeExtended'))

@section(config('laravelblocker.laravelBlockerTitleExtended'))
    {!! trans('laravelblocker::laravelblocker.titles.show-blocked') !!}
@endsection

@php
    switch (config('laravelblocker.blockerBootstapVersion')) {
        case '4':
            $containerClass = 'card';
            $containerHeaderClass = 'card-header bg-warning text-white';
            $containerBodyClass = 'card-body';
            break;
        case '3':
        default:
            $containerClass = 'panel panel-warning';
            $containerHeaderClass = 'panel-heading';
            $containerBodyClass = 'panel-body';
    }
    $blockerBootstrapCardClasses = (is_null(config('laravelblocker.blockerBootstrapCardClasses')) ? '' : config('laravelblocker.blockerBootstrapCardClasses'));
@endphp

@section(config('laravelblocker.blockerBladePlacementCss'))
    @if(config('laravelblocker.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('laravelblocker.datatablesCssCDN') }}">
    @endif
    @if(config('laravelblocker.blockerEnableFontAwesomeCDN'))
        <link rel="stylesheet" type="text/css" href="{{ config('laravelblocker.blockerFontAwesomeCDN') }}">
    @endif
    @include('laravelblocker::partials.styles')
    @include('laravelblocker::partials.bs-visibility-css')
@endsection

@section('content')

    @include('laravelblocker::partials.flash-messages')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="{{ $containerClass }} {{ $blockerBootstrapCardClasses }}">
                    <div class="{{ $containerHeaderClass }}">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {!! trans('laravelblocker::laravelblocker.blocked-items-title') !!}
                            </span>
                            <div class="btn-group pull-right btn-group-xs">
                                <button type="button" class="btn btn-warning text-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v fa-fw" aria-hidden="true"></i>
                                    <span class="sr-only">
                                        {!! trans('laravelblocker::laravelblocker.users-menu-alt') !!}
                                    </span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('laravelblocker::blocker.create') }}">
                                        <i class="fa fa-fw fa-plus" aria-hidden="true"></i>
                                        {!! trans('laravelblocker::laravelblocker.buttons.create-new-blocked') !!}
                                    </a>
                                    @if($deletedBlockedItems->count() > 0)
                                        <a class="dropdown-item" href="{{ url('/blocker-deleted') }}">
                                            <i class="fa fa-fw fa-trash-o" aria-hidden="true"></i>
                                            {!! trans('laravelblocker::laravelblocker.buttons.show-deleted-blocked') !!}
                                            <span class="badge-pill badge badge-warning">
                                                {{ $deletedBlockedItems->count() }}
                                            </span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="{{ $containerBodyClass }}">
                        @if(config('laravelblocker.enableSearchBlocked'))
                            @include('laravelblocker::forms.search-blocked')
                        @endif

                        @include('laravelblocker::partials.blocked-items-table', ['tabletype' => 'normal'])

                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('laravelblocker::modals.confirm-modal',[
        'formTrigger' => 'confirmDelete',
        'modalClass' => 'danger',
        'actionBtnIcon' => 'fa-trash-o'
    ])

@endsection

@section(config('laravelblocker.blockerBladePlacementJs'))
    @if(config('laravelblocker.enablejQueryCDN'))
        <script type="text/javascript" src="{{ config('laravelblocker.JQueryCDN') }}"></script>
    @endif
    @if (config('laravelblocker.enabledDatatablesJs'))
        @include('laravelblocker::scripts.datatables')
    @endif
    @include('laravelblocker::scripts.confirm-modal', ['formTrigger' => '#confirmDelete'])
    @if(config('laravelblocker.tooltipsEnabled'))
        @include('laravelblocker::scripts.tooltips')
    @endif
    @if(config('laravelblocker.enableSearchBlocked'))
        @include('laravelblocker::scripts.search-blocked', ['searchtype' => 'normal'])
    @endif
@endsection

@yield('inline_template_linked_css')
@yield('inline_footer_scripts')
