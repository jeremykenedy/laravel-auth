@extends(config('laravelblocker.laravelBlockerBladeExtended'))

@section(config('laravelblocker.laravelBlockerTitleExtended'))
    {!! trans('laravelblocker::laravelblocker.titles.show-blocked-item') !!}
@endsection

@php
    switch (config('laravelblocker.blockerBootstapVersion')) {
        case '4':
            $containerClass = 'card';
            $containerHeaderClass = 'card-header bg-warning text-white';
            if(isset($typeDeleted)) {
                $containerHeaderClass = 'card-header bg-danger text-white';
            }
            $containerBodyClass = 'card-body';
            break;
        case '3':
        default:
            $containerClass = 'panel panel-warning';
            if(isset($typeDeleted)) {
                $containerClass = 'panel panel-danger';
            }
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
            <div class="col-md-12 col-lg-10 offset-lg-1">
                <div class="{{ $containerClass }} {{ $blockerBootstrapCardClasses }}">
                    <div class="{{ $containerHeaderClass }}">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                @isset($typeDeleted)
                                    {!! trans('laravelblocker::laravelblocker.blocked-item-deleted-title', ['name' => $item->value]) !!}
                                @else
                                    {!! trans('laravelblocker::laravelblocker.blocked-item-title', ['name' => $item->value]) !!}
                                @endisset
                            </span>
                            <div class="pull-right">
                                @isset($typeDeleted)
                                    <a href="{{ url('blocker-deleted') }}" class="btn btn-danger text-white btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('laravelblocker::laravelblocker.tooltips.back-blocked-deleted') }}">
                                        <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                        {!! trans('laravelblocker::laravelblocker.buttons.back-to-blocked-deleted') !!}
                                    </a>
                                @else
                                    <a href="{{ url('blocker') }}" class="btn btn-warning text-white btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('laravelblocker::laravelblocker.tooltips.back-blocked') }}">
                                        <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                        {!! trans('laravelblocker::laravelblocker.buttons.back-to-blocked') !!}
                                    </a>
                                @endisset
                            </div>
                        </div>
                    </div>
                    <div class="{{ $containerBodyClass }}">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                ID
                                <span class="badge badge-pill">
                                    {{ $item->id }}
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                TypeId
                                <span class="badge badge-pill">
                                    {{ $item->typeId }}
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Slug
                                <span class="badge badge-pill">
                                    {!! $item->blockedType->slug !!}
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Value
                                <span class="badge badge-pill">
                                    {{ $item->value }}
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Note
                                <span class="badge badge-pill">
                                    {{ $item->note }}
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                UserId
                                <span class="badge badge-pill">
                                    @if ($item->userId)
                                        {!! $item->userId !!}
                                    @else
                                        <span class="disabled">
                                            {!! trans('laravelblocker::laravelblocker.none') !!}
                                        </span>
                                    @endif
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Created At
                                <span class="badge badge-pill">
                                    {!! $item->created_at->format('m/d/Y H:ia') !!}
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Updated At
                                <span class="badge badge-pill">
                                    {!! $item->updated_at->format('m/d/Y H:ia') !!}
                                </span>
                            </li>
                            @if ($item->deleted_at)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Deleted At
                                    <span class="badge badge-pill">
                                        {!! $item->deleted_at->format('m/d/Y H:ia') !!}
                                    </span>
                                </li>
                            @endif
                        </ul>
                        <div class="row">
                            <div class="col-sm-6 mt-3">
                                @isset($typeDeleted)
                                    @include('laravelblocker::forms.restore-item', ['restoreType' => 'full'])
                                @else
                                    <a class="btn btn-sm btn-info btn-block text-white" href="/blocker/{{ $item->id }}/edit" data-toggle="tooltip" title="{{ trans("laravelblocker::laravelblocker.tooltips.edit") }}">
                                        {!! trans("laravelblocker::laravelblocker.buttons.edit-larger") !!}
                                    </a>
                                @endisset
                            </div>
                            <div class="col-sm-6 mt-3">
                                @isset($typeDeleted)
                                    @include('laravelblocker::forms.destroy-full')
                                @else
                                    @include('laravelblocker::forms.delete-item')
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('laravelblocker::modals.confirm-modal',[
        'formTrigger' => 'confirmRestore',
        'modalClass' => 'success',
        'actionBtnIcon' => 'fa-check'
    ])

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
    @include('laravelblocker::scripts.confirm-modal', ['formTrigger' => '#confirmDelete'])
    @include('laravelblocker::scripts.confirm-modal', ['formTrigger' => '#confirmRestore'])
    @if(config('laravelblocker.tooltipsEnabled'))
        @include('laravelblocker::scripts.tooltips')
    @endif
@endsection

@yield('inline_template_linked_css')
@yield('inline_footer_scripts')
