@extends(config('laravelblocker.laravelBlockerBladeExtended'))

@section(config('laravelblocker.laravelBlockerTitleExtended'))
    {!! trans('laravelblocker::laravelblocker.titles.create-blocked') !!}
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
    @if(config('laravelblocker.blockerEnableFontAwesomeCDN'))
        <link rel="stylesheet" type="text/css" href="{{ config('laravelblocker.blockerFontAwesomeCDN') }}">
    @endif
    @include('laravelblocker::partials.styles')
    @include('laravelblocker::partials.bs-visibility-css')
@endsection

@section('content')

    @include('laravelblocker::partials.flash-messages')

    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="{{ $containerClass }} {{ $blockerBootstrapCardClasses }}">
                    <div class="{{ $containerHeaderClass }}">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! trans('laravelblocker::laravelblocker.titles.create-blocked') !!}
                            <div class="pull-right">
                                <a href="{{ url('blocker') }}" class="btn btn-warning btn-sm float-right text-white" data-toggle="tooltip" data-placement="left" title="{{ trans('laravelblocker::laravelblocker.tooltips.back-blocked') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    {!! trans('laravelblocker::laravelblocker.buttons.back-to-blocked') !!}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="{{ $containerBodyClass }}">
                        @include('laravelblocker::forms.create-new')
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section(config('laravelblocker.blockerBladePlacementJs'))
    @if(config('laravelblocker.enablejQueryCDN'))
        <script type="text/javascript" src="{{ config('laravelblocker.JQueryCDN') }}"></script>
    @endif
    @if(config('laravelblocker.tooltipsEnabled'))
        @include('laravelblocker::scripts.tooltips')
    @endif
    @include('laravelblocker::scripts.blocked-form')
@endsection

@yield('inline_template_linked_css')
@yield('inline_footer_scripts')
