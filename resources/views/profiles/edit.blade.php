@extends('layouts.app')

@section('template_title')
    {{ trans('profile.templateTitle') }}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card border-0">
                    <div class="card-body p-0">
                        @if ($user->profile)
                            @if (Auth::user()->id == $user->id)
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 col-sm-4 col-md-3 profile-sidebar text-white rounded-left-sm-up">
                                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            <a class="nav-link active" data-toggle="pill" href=".edit-profile-tab" role="tab" aria-controls="edit-profile-tab" aria-selected="true">
                                                {{ trans('profile.editProfileTitle') }}
                                            </a>
                                            <a class="nav-link" data-toggle="pill" href=".edit-settings-tab" role="tab" aria-controls="edit-settings-tab" aria-selected="false">
                                                {{ trans('profile.editAccountTitle') }}
                                            </a>
                                            <a class="nav-link" data-toggle="pill" href=".edit-account-tab" role="tab" aria-controls="edit-settings-tab" aria-selected="false">
                                                {{ trans('profile.editAccountAdminTitle') }}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-8 col-md-9">
                                        <div class="tab-content" id="v-pills-tabContent">
                                            <div class="tab-pane fade show active edit-profile-tab" role="tabpanel" aria-labelledby="edit-profile-tab">
                                                <div class="row mb-1">
                                                    <div class="col-sm-12">
                                                        <div id="avatar_container">
                                                            <div class="collapseOne card-collapse collapse @if($user->profile->avatar_status == 0) show @endif">
                                                                <div class="card-body">
                                                                    <img src="{{  Gravatar::get($user->email) }}" alt="{{ $user->name }}" class="user-avatar">
                                                                </div>
                                                            </div>
                                                            <div class="collapseTwo card-collapse collapse @if($user->profile->avatar_status == 1) show @endif">
                                                                <div class="card-body">
                                                                    <div class="dz-preview"></div>
                                                                    {{ html()->form('POST', route('avatar.upload'))
                                                                            ->name('avatarDropzone')
                                                                            ->id('avatarDropzone')
                                                                            ->class('form single-dropzone dropzone single')
                                                                            ->acceptsFiles()
                                                                            ->open() }}
                                                                        @csrf
                                                                        <img id="user_selected_avatar" class="user-avatar" src="@if ($user->profile->avatar != NULL) {{ $user->profile->avatar }} @endif" alt="{{ $user->name }}">
                                                                    {{ html()->form()->close() }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @php( html()->model($user->profile) )
                                                {{ html()->form('POST', route('profile.update', $user->name))
                                                        ->id('user_profile_form')
                                                        ->class('form-horizontal')
                                                        ->attribute('role', 'form')
                                                        ->acceptsFiles()
                                                        ->open() }}
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="row">
                                                        <div class="col-10 offset-1 col-sm-10 offset-sm-1 mb-1">
                                                            <div class="row" data-toggle="buttons">
                                                                <div class="col-6 col-xs-6 right-btn-container">
                                                                    <label class="btn btn-primary @if($user->profile->avatar_status == 0) active @endif btn-block btn-sm" data-toggle="collapse" data-target=".collapseOne:not(.show), .collapseTwo.show">
                                                                        <input type="radio" name="avatar_status" id="option1" autocomplete="off" value="0" @if($user->profile->avatar_status == 0) checked @endif> Use Gravatar
                                                                    </label>
                                                                </div>
                                                                <div class="col-6 col-xs-6 left-btn-container">
                                                                    <label class="btn btn-primary @if($user->profile->avatar_status == 1) active @endif btn-block btn-sm" data-toggle="collapse" data-target=".collapseOne.show, .collapseTwo:not(.show)">
                                                                        <input type="radio" name="avatar_status" id="option2" autocomplete="off" value="1" @if($user->profile->avatar_status == 1) checked @endif> Use My Image
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-feedback {{ $errors->has('theme') ? ' has-error ' : '' }}">
                                                        {{ html()->label('theme_id', trans('profile.label-theme'))->class('col-12 control-label') }}
                                                        <div class="col-12">
                                                            <select class="form-control" name="theme_id" id="theme_id">
                                                                @if ($themes->count())
                                                                    @foreach($themes as $theme)
                                                                      <option value="{{ $theme->id }}"{{ $currentTheme->id == $theme->id ? 'selected="selected"' : '' }}>{{ $theme->name }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                            <span class="glyphicon {{ $errors->has('theme') ? ' glyphicon-asterisk ' : ' ' }} form-control-feedback" aria-hidden="true"></span>
                                                            @if ($errors->has('theme'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('theme') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-feedback {{ $errors->has('location') ? ' has-error ' : '' }}">
                                                        {{ html()->label('location', trans('profile.label-location'))->class('col-12 control-label') }}
                                                        <div class="col-12">
                                                            {{ html()->text('location')->id('location')->class('form-control')->placeholder(trans('profile.ph-location')) }}
                                                            <span class="glyphicon {{ $errors->has('location') ? ' glyphicon-asterisk ' : ' glyphicon-pencil ' }} form-control-feedback" aria-hidden="true"></span>
                                                            @if ($errors->has('location'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('location') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-feedback {{ $errors->has('bio') ? ' has-error ' : '' }}">
                                                        {{ html()->label('bio', trans('profile.label-bio'))->class('col-12 control-label') }}
                                                        <div class="col-12">
                                                            {{ html()->textarea('bio')->id('bio')->class('form-control')->placeholder(trans('profile.ph-bio')) }}
                                                            <span class="glyphicon glyphicon-pencil form-control-feedback" aria-hidden="true"></span>
                                                            @if ($errors->has('bio'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('bio') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-feedback {{ $errors->has('twitter_username') ? ' has-error ' : '' }}">
                                                        {{ html()->label('twitter_username', trans('profile.label-twitter_username'))->class('col-12 control-label') }}
                                                        <div class="col-12">
                                                            {{ html()->text('twitter_username')->id('twitter_username')->class('form-control')->placeholder(trans('profile.ph-twitter_username')) }}
                                                            <span class="glyphicon glyphicon-pencil form-control-feedback" aria-hidden="true"></span>
                                                            @if ($errors->has('twitter_username'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('twitter_username') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="margin-bottom-2 form-group has-feedback {{ $errors->has('github_username') ? ' has-error ' : '' }}">
                                                        {{ html()->label('github_username', trans('profile.label-github_username'))->class('col-12 control-label') }}
                                                        <div class="col-12">
                                                            {{ html()->text('github_username')->id('github_username')->class('form-control')->placeholder(trans('profile.ph-github_username')) }}
                                                            <span class="glyphicon glyphicon-pencil form-control-feedback" aria-hidden="true"></span>
                                                            @if ($errors->has('github_username'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('github_username') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group margin-bottom-2">
                                                        <div class="col-12">
                                                            {{ html()->button('<i class="fa fa-fw fa-save" aria-hidden="true"></i> ' . trans('profile.submitButton'))
                                                                ->id('confirmFormSave')
                                                                ->class('btn btn-success disabled')
                                                                ->type('button')
                                                                ->attribute('data-target', '#confirmForm')
                                                                ->attribute('data-modalClass', 'modal-success')
                                                                ->attribute('data-toggle', 'modal')
                                                                ->attribute('data-title', trans('modals.edit_user__modal_text_confirm_title'))
                                                                ->attribute('data-message', trans('modals.edit_user__modal_text_confirm_message')) }}

                                                        </div>
                                                    </div>
                                                {{ html()->form()->close() }}
                                                @php( html()->endModel() )
                                            </div>

                                            <div class="tab-pane fade edit-settings-tab" role="tabpanel" aria-labelledby="edit-settings-tab">
                                                @php( html()->model($user) )
                                                {{ html()->form('POST', action([App\Http\Controllers\ProfilesController::class, 'updateUserAccount'], $user->id))
                                                        ->id('user_basics_form')
                                                        ->open() }}

                                                    @csrf
                                                    @method('PUT')

                                                    <div class="pt-4 pr-3 pl-2 form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
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
                                                            @if($errors->has('name'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('name') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="pr-3 pl-2 form-group has-feedback row {{ $errors->has('email') ? ' has-error ' : '' }}">
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

                                                    <div class="pr-3 pl-2 form-group has-feedback row {{ $errors->has('first_name') ? ' has-error ' : '' }}">
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
                                                            @if($errors->has('first_name'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('first_name') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="pr-3 pl-2 form-group has-feedback row {{ $errors->has('last_name') ? ' has-error ' : '' }}">
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
                                                            @if($errors->has('last_name'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('last_name') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-md-9 offset-md-3">
                                                            {{ html()->button('<i class="fa fa-fw fa-save" aria-hidden="true"></i> ' . trans('profile.submitProfileButton'))
                                                                ->class('btn btn-success disabled')
                                                                ->id('account_save_trigger')
                                                                ->disabled()
                                                                ->type('button')
                                                                ->attribute('data-submit', trans('profile.submitProfileButton'))
                                                                ->attribute('data-target', '#confirmForm')
                                                                ->attribute('data-modalClass', 'modal-success')
                                                                ->attribute('data-toggle', 'modal')
                                                                ->attribute('data-title', trans('modals.edit_user__modal_text_confirm_title'))
                                                                ->attribute('data-message', trans('modals.edit_user__modal_text_confirm_message')) }}
                                                        </div>
                                                    </div>
                                                {{ html()->form()->close() }}
                                                @php( html()->endModel() )
                                            </div>

                                            <div class="tab-pane fade edit-account-tab" role="tabpanel" aria-labelledby="edit-account-tab">
                                                <ul class="account-admin-subnav nav nav-pills nav-justified margin-bottom-3 margin-top-1">
                                                    <li class="nav-item bg-info">
                                                        <a data-toggle="pill" href="#changepw" class="nav-link warning-pill-trigger text-white active" aria-selected="true">
                                                            {{ trans('profile.changePwPill') }}
                                                        </a>
                                                    </li>
                                                    <li class="nav-item bg-info">
                                                        <a data-toggle="pill" href="#deleteAccount" class="nav-link danger-pill-trigger text-white">
                                                            {{ trans('profile.deleteAccountPill') }}
                                                        </a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content">

                                                    <div id="changepw" class="tab-pane fade show active">

                                                        <h3 class="margin-bottom-1 text-center text-warning">
                                                            {{ trans('profile.changePwTitle') }}
                                                        </h3>

                                                        @php( html()->model($user) )
                                                        {{ html()->form('POST', action([App\Http\Controllers\ProfilesController::class, 'updateUserPassword'], $user->id))
                                                                ->attribute('autocomplete', 'new-password')
                                                                ->open() }}

                                                            @csrf
                                                            @method('PUT')

                                                            <div class="pw-change-container margin-bottom-2">

                                                                <div class="form-group has-feedback row {{ $errors->has('password') ? ' has-error ' : '' }}">
                                                                    {{ html()->label('password', trans('forms.create_user_label_password'))->class('col-md-3 control-label') }}
                                                                    <div class="col-md-9">
                                                                        {{ html()->password('password')->id('password')->class('form-control ')->placeholder(trans('forms.create_user_ph_password'))->attribute('autocomplete', 'new-password') }}
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
                                                                        {{ html()->password('password_confirmation')->id('password_confirmation')->class('form-control')->placeholder(trans('forms.create_user_ph_pw_confirmation')) }}
                                                                        <span id="pw_status"></span>
                                                                        @if ($errors->has('password_confirmation'))
                                                                            <span class="help-block">
                                                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-9 offset-md-3">
                                                                    {{ html()->button('<i class="fa fa-fw fa-save" aria-hidden="true"></i> ' . trans('profile.submitPWButton'))
                                                                        ->class('btn btn-warning')
                                                                        ->id('pw_save_trigger')
                                                                        ->disabled()
                                                                        ->type('button')
                                                                        ->attribute('data-submit', trans('profile.submitButton'))
                                                                        ->attribute('data-target', '#confirmForm')
                                                                        ->attribute('data-modalClass', 'modal-warning')
                                                                        ->attribute('data-toggle', 'modal')
                                                                        ->attribute('data-title', trans('modals.edit_user__modal_text_confirm_title'))
                                                                        ->attribute('data-message', trans('modals.edit_user__modal_text_confirm_message')) }}
                                                                </div>
                                                            </div>
                                                        {{ html()->form()->close() }}
                                                        @php( html()->endModel() )

                                                    </div>

                                                    <div id="deleteAccount" class="tab-pane fade">
                                                        <h3 class="margin-bottom-1 text-center text-danger">
                                                            {{ trans('profile.deleteAccountTitle') }}
                                                        </h3>
                                                        <p class="margin-bottom-2 text-center">
                                                            <i class="fa fa-exclamation-triangle fa-fw" aria-hidden="true"></i>
                                                                <strong>Deleting</strong> your account is <u><strong>permanent</strong></u> and <u><strong>cannot</strong></u> be undone.
                                                            <i class="fa fa-exclamation-triangle fa-fw" aria-hidden="true"></i>
                                                        </p>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm-6 offset-sm-3 margin-bottom-3 text-center">

                                                                @php( html()->model($user) )
                                                                {{ html()->form('POST', action([App\Http\Controllers\ProfilesController::class, 'deleteUserAccount'], $user->id))
                                                                        ->open() }}

                                                                    @csrf
                                                                    @method('DELETE')

                                                                    <div class="btn-group btn-group-vertical margin-bottom-2 custom-checkbox-fa" data-toggle="buttons">
                                                                        <label class="btn no-shadow" for="checkConfirmDelete" >
                                                                            <input type="checkbox" name='checkConfirmDelete' id="checkConfirmDelete">
                                                                            <i class="fa fa-square-o fa-fw fa-2x"></i>
                                                                            <i class="fa fa-check-square-o fa-fw fa-2x"></i>
                                                                            <span class="margin-left-2"> Confirm Account Deletion</span>
                                                                        </label>
                                                                    </div>

                                                                    {{ html()->button('<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>' . trans('profile.deleteAccountBtn'))
                                                                        ->class('btn btn-block btn-danger')
                                                                        ->id('delete_account_trigger')
                                                                        ->disabled()
                                                                        ->type('button')
                                                                        ->attribute('data-toggle', 'modal')
                                                                        ->attribute('data-submit', trans('profile.deleteAccountBtnConfirm'))
                                                                        ->attribute('data-target', '#confirmForm')
                                                                        ->attribute('data-modalClass', 'modal-danger')
                                                                        ->attribute('data-title', trans('profile.deleteAccountConfirmTitle'))
                                                                        ->attribute('data-message', trans('profile.deleteAccountConfirmMsg')) }}

                                                                {{ html()->form()->close() }}
                                                                @php( html()->endModel() )

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                                <p>{{ trans('profile.notYourProfile') }}</p>
                            @endif
                        @else
                            <p>{{ trans('profile.noProfileYet') }}</p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('modals.modal-form')

@endsection

@section('footer_scripts')

    @include('scripts.form-modal-script')

    @if(config('settings.googleMapsAPIStatus'))
        @include('scripts.gmaps-address-lookup-api3')
    @endif

    @include('scripts.user-avatar-dz')

    <script type="text/javascript">

        $('.dropdown-menu li a').click(function() {
            $('.dropdown-menu li').removeClass('active');
        });

        $('.profile-trigger').click(function() {
            $('.panel').alterClass('card-*', 'card-default');
        });

        $('.settings-trigger').click(function() {
            $('.panel').alterClass('card-*', 'card-info');
        });

        $('.admin-trigger').click(function() {
            $('.panel').alterClass('card-*', 'card-warning');
            $('.edit_account .nav-pills li, .edit_account .tab-pane').removeClass('active');
            $('#changepw')
                .addClass('active')
                .addClass('in');
            $('.change-pw').addClass('active');
        });

        $('.warning-pill-trigger').click(function() {
            $('.panel').alterClass('card-*', 'card-warning');
        });

        $('.danger-pill-trigger').click(function() {
            $('.panel').alterClass('card-*', 'card-danger');
        });

        $('#user_basics_form').on('keyup change', 'input, select, textarea', function(){
            $('#account_save_trigger').attr('disabled', false).removeClass('disabled').show();
        });

        $('#user_profile_form').on('keyup change', 'input, select, textarea', function(){
            $('#confirmFormSave').attr('disabled', false).removeClass('disabled').show();
        });

        $('#checkConfirmDelete').change(function() {
            var submitDelete = $('#delete_account_trigger');
            var self = $(this);

            if (self.is(':checked')) {
                submitDelete.attr('disabled', false);
            }
            else {
                submitDelete.attr('disabled', true);
            }
        });

        $("#password_confirmation").keyup(function() {
            checkPasswordMatch();
        });

        $("#password, #password_confirmation").keyup(function() {
            enableSubmitPWCheck();
        });

        $('#password, #password_confirmation').hidePassword(true);

        $('#password').password({
            shortPass: 'The password is too short',
            badPass: 'Weak - Try combining letters & numbers',
            goodPass: 'Medium - Try using special charecters',
            strongPass: 'Strong password',
            containsUsername: 'The password contains the username',
            enterPass: false,
            showPercent: false,
            showText: true,
            animate: true,
            animateSpeed: 50,
            username: false, // select the username field (selector or jQuery instance) for better password checks
            usernamePartialMatch: true,
            minimumLength: 6
        });

        function checkPasswordMatch() {
            var password = $("#password").val();
            var confirmPassword = $("#password_confirmation").val();
            if (password != confirmPassword) {
                $("#pw_status").html("Passwords do not match!");
            }
            else {
                $("#pw_status").html("Passwords match.");
            }
        }

        function enableSubmitPWCheck() {
            var password = $("#password").val();
            var confirmPassword = $("#password_confirmation").val();
            var submitChange = $('#pw_save_trigger');
            if (password != confirmPassword) {
                submitChange.attr('disabled', true);
            }
            else {
                submitChange.attr('disabled', false);
            }
        }

    </script>

@endsection
