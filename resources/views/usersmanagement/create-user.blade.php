@extends('layouts.app')

@section('template_title')
    {!! trans('usersmanagement.create-new-user') !!}
@endsection

@section('template_fastload_css')
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! trans('usersmanagement.create-new-user') !!}
                            <div class="pull-right">
                                <a href="{{ route('users') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('usersmanagement.tooltips.back-users') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    {!! trans('usersmanagement.buttons.back-to-users') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {{ html()->form('POST', route('users.store'))
                                ->attribute('role', 'form')
                                ->class('needs-validation')
                                ->open() }}

                            @csrf

                            <div class="form-group has-feedback row {{ $errors->has('email') ? ' has-error ' : '' }}">
                                {{ html()->label('email', trans('forms.create_user_label_email'))->class('col-md-3 control-label') }}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {{ html()->email('email')->id('email')->class('form-control')->placeholder(trans('forms.create_user_ph_email')) }}
                                        <div class="input-group-append">
                                            <label for="email" class="input-group-text">
                                                <i class="fa fa-fw {{ trans('forms.create_user_icon_email') }}" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                                {{ html()->label('name', trans('forms.create_user_label_username'))->class('col-md-3 control-label') }}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {{ html()->text('name')->id('name')->class('form-control')->placeholder(trans('forms.create_user_ph_username')) }}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="name">
                                                <i class="fa fa-fw {{ trans('forms.create_user_icon_username') }}" aria-hidden="true"></i>
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

                            <div class="form-group has-feedback row {{ $errors->has('first_name') ? ' has-error ' : '' }}">
                                {{ html()->label('first_name', trans('forms.create_user_label_firstname'))->class('col-md-3 control-label') }}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {{ html()->text('first_name')->id('first_name')->class('form-control')->placeholder(trans('forms.create_user_ph_firstname')) }}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="first_name">
                                                <i class="fa fa-fw {{ trans('forms.create_user_icon_firstname') }}" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('first_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('last_name') ? ' has-error ' : '' }}">
                                {{ html()->label('last_name', trans('forms.create_user_label_lastname'))->class('col-md-3 control-label') }}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {{ html()->text('last_name')->id('last_name')->class('form-control')->placeholder(trans('forms.create_user_ph_lastname')) }}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="last_name">
                                                <i class="fa fa-fw {{ trans('forms.create_user_icon_lastname') }}" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('last_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('role') ? ' has-error ' : '' }}">
                                {{ html()->label('role', trans('forms.create_user_label_role'))->class('col-md-3 control-label') }}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="custom-select form-control" name="role" id="role">
                                            <option value="">{{ trans('forms.create_user_ph_role') }}</option>
                                            @if ($roles)
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="role">
                                                <i class="{{ trans('forms.create_user_icon_role') }}" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('role'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('role') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('password') ? ' has-error ' : '' }}">
                                {{ html()->label('password', trans('forms.create_user_label_password'))->class('col-md-3 control-label') }}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {{ html()->password('password')->id('password')->class('form-control ')->placeholder(trans('forms.create_user_ph_password')) }}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="password">
                                                <i class="fa fa-fw {{ trans('forms.create_user_icon_password') }}" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group has-feedback row {{ $errors->has('password_confirmation') ? ' has-error ' : '' }}">
                                {{ html()->label('password_confirmation', trans('forms.create_user_label_pw_confirmation'))->class('col-md-3 control-label') }}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {{ html()->password('password_confirmation')->id('password_confirmation')->class('form-control')->placeholder(trans('forms.create_user_ph_pw_confirmation')) }}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="password_confirmation">
                                                <i class="fa fa-fw {{ trans('forms.create_user_icon_pw_confirmation') }}" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {{ html()->button(trans('forms.create_user_button_text'))
                                ->class('btn btn-success margin-bottom-1 mb-1 float-right')
                                ->type('submit') }}
                        {{ html()->form()->close() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
@endsection
