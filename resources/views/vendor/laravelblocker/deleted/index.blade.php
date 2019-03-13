@extends(config('laravelblocker.laravelBlockerBladeExtended'))

@section(config('laravelblocker.laravelBlockerTitleExtended'))
    {!! trans('laravelblocker::laravelblocker.titles.show-blocked') !!}
@endsection

@php
    switch (config('laravelblocker.blockerBootstapVersion')) {
        case '4':
            $containerClass = 'card';
            $containerHeaderClass = 'card-header bg-danger text-white';
            $containerBodyClass = 'card-body';
            break;
        case '3':
        default:
            $containerClass = 'panel panel-danger';
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
                                {!! trans('laravelblocker::laravelblocker.blocked-items-deleted-title') !!}
                            </span>
                            <div class="btn-group pull-right btn-group-xs">
                                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v fa-fw" aria-hidden="true"></i>
                                    <span class="sr-only">
                                        {!! trans('laravelblocker::laravelblocker.users-menu-alt') !!}
                                    </span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{ url('blocker') }}" class="dropdown-item">
                                        <i class="fa fa-fw fa-reply" aria-hidden="true"></i>
                                        {!! trans('laravelblocker::laravelblocker.buttons.back-to-blocked') !!}
                                    </a>
                                    @if($blocked->count() > 0)
                                        @include('laravelblocker::forms.destroy-all')
                                        @include('laravelblocker::forms.restore-all')
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="{{ $containerBodyClass }}">
                        @if(config('laravelblocker.enableSearchBlocked'))
                            @include('laravelblocker::forms.search-blocked')
                        @endif
                        @include('laravelblocker::partials.blocked-items-table', ['tabletype' => 'deleted'])
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('laravelblocker::modals.confirm-modal', [
        'formTrigger' => 'confirmDelete',
        'modalClass' => 'danger',
        'actionBtnIcon' => 'fa-trash-o'
    ])

    @include('laravelblocker::modals.confirm-modal',[
        'formTrigger' => 'confirmRestore',
        'modalClass' => 'success',
        'actionBtnIcon' => 'fa-check'
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
    @include('laravelblocker::scripts.confirm-modal', ['formTrigger' => '#confirmRestore'])

    @if(config('laravelblocker.tooltipsEnabled'))
        @include('laravelblocker::scripts.tooltips')
    @endif
    @if(config('laravelblocker.enableSearchBlocked'))
        @include('laravelblocker::scripts.search-blocked', ['searchtype' => 'deleted'])
    @endif
@endsection

@yield('inline_template_linked_css')
@yield('inline_footer_scripts')
