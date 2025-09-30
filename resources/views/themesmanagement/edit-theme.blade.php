@extends('layouts.app')

@section('template_title')
    {{ trans('themes.themeTitle', ['name' => $theme->name]) }}
@endsection

@section('template_fastload_css')

@endsection

@php
    $themeActive = [
        'checked' => '',
        'value' => 0,
        'true'  => '',
        'false' => 'checked'
    ];
    if($theme->status == 1) {
        $themeActive = [
            'checked' => 'checked',
            'value' => 1,
            'true'  => 'checked',
            'false' => ''
        ];
    }
@endphp

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 col-xl-10 offset-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <strong>{{ trans('themes.editTitle') }}</strong> {{ $theme->name }}
                        </div>
                        <div class="float-right">
                            <a href="{{ url('/themes/' . $theme->id) }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="top" title="{{ trans('themes.backToThemeTt') }}">
                                <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                {!! trans('themes.backToThemeBtn') !!}
                            </a>
                            <a href="{{ url('/themes/') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('themes.backToThemesTt') }}">
                                <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                {!! trans('themes.backToThemesBtn') !!}
                            </a>
                        </div>
                    </div>

                    {{ html()->model($theme) }}
                    {{ html()->form('POST', action([App\Http\Controllers\ThemesManagementController::class, 'update'], $theme->id))
                            ->open() }}

                        @csrf
                        @method('PUT')

                        <div class="card-body">

                            <div class="form-group has-feedback row {{ $errors->has('status') ? ' has-error ' : '' }} @if($theme->id == 1) disabled @endif ">
                                {{ html()->label('status', trans('themes.statusLabel'))->class('col-md-3 control-label') }}
                                <div class="col-md-9">
                                    <label class="switch {{ $themeActive['checked'] }}" for="status">
                                        <span class="active"><i class="fa fa-toggle-on fa-2x"></i> {{ trans('themes.statusEnabled') }}</span>
                                        <span class="inactive"><i class="fa fa-toggle-on fa-2x fa-rotate-180"></i> {{ trans('themes.statusDisabled') }}</span>
                                        <input type="radio" name="status" value="1" {{ $themeActive['true'] }}>
                                        <input type="radio" name="status" value="0" {{ $themeActive['false'] }}>
                                    </label>

                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                                {{ html()->label('name', trans('themes.nameLabel'))->class('col-md-3 control-label') }}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {{ html()->text('name')->id('name')->class('form-control')->placeholder(trans('themes.namePlaceholder')) }}
                                        <div class="input-group-append">
                                            <label for="name" class="input-group-text">
                                                <i class="fa fa-fw fa-pencil" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('link') ? ' has-error ' : '' }}">
                                {{ html()->label('link', trans('themes.linkLabel'))->class('col-md-3 control-label') }}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {{ html()->text('link')->id('link')->class('form-control')->placeholder(trans('themes.linkPlaceholder')) }}
                                        <div class="input-group-append">
                                            <label for="link" class="input-group-text">
                                                <i class="fa fa-fw fa-link fa-rotate-90" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('link'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('link') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('notes') ? ' has-error ' : '' }}">
                                {{ html()->label('notes', trans('themes.notesLabel'))->class('col-md-3 control-label') }}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {{ html()->textarea('notes')->id('notes')->class('form-control')->placeholder(trans('themes.notesPlaceholder')) }}
                                        <div class="input-group-append">
                                            <label for="notes" class="input-group-text">
                                                <i class="fa fa-fw fa-pencil" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('notes'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('notes') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        </div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-6">
                                    {{ html()->button('<i class="fa fa-fw fa-save" aria-hidden="true"></i> ' . trans('themes.editSave'))
                                        ->class('btn btn-success btn-block mb-0 btn-save')
                                        ->type('button')
                                        ->attribute('data-toggle', 'modal')
                                        ->attribute('data-target', '#confirmSave')
                                        ->attribute('data-title', trans('modals.edit_user__modal_text_confirm_title'))
                                        ->attribute('data-message', trans('modals.edit_user__modal_text_confirm_message')) }}
                                </div>
                            </div>
                        </div>

                    {{ html()->form()->close() }}
                    {{ html()->endModel() }}

                </div>
            </div>
        </div>
    </div>

    @include('modals.modal-save')
    @include('modals.modal-delete')

@endsection

@section('footer_scripts')

    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @include('scripts.check-changed')
    @include('scripts.toggleStatus')

@endsection
