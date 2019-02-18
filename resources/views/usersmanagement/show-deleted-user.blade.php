@extends('layouts.app')

@section('template_title')
    {!!trans('usersmanagement.showing-user-deleted')!!} {{ $user->name }}
@endsection

@php
    $levelAmount = 'Level:';
    if ($user->level() >= 2) {
        $levelAmount = 'Levels:';
    }
@endphp

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">

                    <div class="card-header bg-danger text-white">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! trans('usersmanagement.usersDeletedPanelTitle') !!}
                            <div class="float-right">
                                <a href="/users/deleted/" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('usersmanagement.usersBackDelBtn') }}">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    <span class="sr-only">
                                        {!! trans('usersmanagement.usersBackDelBtn') !!}
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4 offset-sm-2 col-md-2 offset-md-3">
                                <img src="@if ($user->profile->avatar_status == 1) {{ $user->profile->avatar }} @else {{ Gravatar::get($user->email) }} @endif" alt="{{ $user->name }}" id="" class="rounded-circle center-block mb-3 mt-4 user-image">
                            </div>
                            <div class="col-sm-4 col-md-6">
                                <h4 class="text-muted margin-top-sm-1 text-center text-left-tablet">
                                    {{ $user->name }}
                                </h4>
                                <p class="text-center text-left-tablet">
                                    <strong>
                                    {{ $user->first_name }} {{ $user->last_name }}
                                    </strong>
                                    <br />
                                    {{ HTML::mailto($user->email, $user->email) }}
                                </p>
                                @if ($user->profile)
                                <div class="text-center text-left-tablet mb-4">
                                    {!! Form::model($user, array('action' => array('SoftDeletesController@update', $user->id), 'method' => 'PUT', 'class' => 'form-inline')) !!}
                                        {!! Form::button('<i class="fa fa-refresh fa-fw" aria-hidden="true"></i> Restore User', array('class' => 'btn btn-success btn-block btn-sm mt-1 mb-1', 'type' => 'submit', 'data-toggle' => 'tooltip', 'title' => 'Restore User')) !!}
                                        {!! Form::close() !!}
                                        {!! Form::model($user, array('action' => array('SoftDeletesController@destroy', $user->id), 'method' => 'DELETE', 'class' => 'form-inline', 'data-toggle' => 'tooltip', 'title' => 'Permanently Delete User')) !!}
                                        {!! Form::hidden('_method', 'DELETE') !!}
                                        {!! Form::button('<i class="fa fa-user-times fa-fw" aria-hidden="true"></i> Delete User', array('class' => 'btn btn-danger btn-sm ','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Permanently Delete User', 'data-message' => 'Are you sure you want to permanently delete this user?')) !!}
                                    {!! Form::close() !!}
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        @if ($user->deleted_at)
                            <div class="col-sm-5 col-xs-6 text-larger">
                                <strong>
                                    {{ trans('usersmanagement.labelDeletedAt') }}
                                </strong>
                            </div>
                            <div class="col-sm-7 text-warning">
                                {{ $user->deleted_at }}
                            </div>

                            <div class="clearfix"></div>
                            <div class="border-bottom"></div>
                        @endif

                        @if ($user->deleted_ip_address)
                            <div class="col-sm-5 col-xs-6 text-larger">
                                <strong>
                                {{ trans('usersmanagement.labelIpDeleted') }}
                                </strong>
                            </div>
                            <div class="col-sm-7 text-warning">
                                {{ $user->deleted_ip_address }}
                            </div>

                            <div class="clearfix"></div>
                            <div class="border-bottom"></div>
                        @endif

                        @if ($user->name)
                            <div class="col-sm-5 col-xs-6 text-larger">
                                <strong>
                                {{ trans('usersmanagement.labelUserName') }}
                                </strong>
                            </div>
                            <div class="col-sm-7">
                                {{ $user->name }}
                            </div>

                            <div class="clearfix"></div>
                            <div class="border-bottom"></div>
                        @endif

                        @if ($user->email)
                            <div class="col-sm-5 col-xs-6 text-larger">
                                <strong>
                                {{ trans('usersmanagement.labelEmail') }}
                                </strong>
                            </div>
                            <div class="col-sm-7">
                                {{ HTML::mailto($user->email, $user->email) }}
                            </div>

                            <div class="clearfix"></div>
                            <div class="border-bottom"></div>
                        @endif

                        @if ($user->first_name)
                            <div class="col-sm-5 col-xs-6 text-larger">
                                <strong>
                                {{ trans('usersmanagement.labelFirstName') }}
                                </strong>
                            </div>
                            <div class="col-sm-7">
                                {{ $user->first_name }}
                            </div>

                            <div class="clearfix"></div>
                            <div class="border-bottom"></div>
                        @endif

                        @if ($user->last_name)
                            <div class="col-sm-5 col-xs-6 text-larger">
                                <strong>
                                {{ trans('usersmanagement.labelLastName') }}
                                </strong>
                            </div>
                            <div class="col-sm-7">
                                {{ $user->last_name }}
                            </div>

                            <div class="clearfix"></div>
                            <div class="border-bottom"></div>
                        @endif

                        <div class="col-sm-5 col-xs-6 text-larger">
                            <strong>
                                {{ trans('usersmanagement.labelRole') }}
                            </strong>
                        </div>
                        <div class="col-sm-7">
                            @foreach ($user->roles as $user_role)
                                @if ($user_role->name == 'User')
                                    @php $badgeClass = 'primary' @endphp
                                @elseif ($user_role->name == 'Admin')
                                    @php $badgeClass = 'warning' @endphp
                                @elseif ($user_role->name == 'Unverified')
                                    @php $badgeClass = 'danger' @endphp
                                @else
                                    @php $badgeClass = 'default' @endphp
                                @endif
                                <span class="badge badge-{{$badgeClass}}">{{ $user_role->name }}</span>
                            @endforeach
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="col-sm-5 col-xs-6 text-larger">
                            <strong>
                                {{ trans('usersmanagement.labelStatus') }}
                            </strong>
                        </div>
                        <div class="col-sm-7">
                            @if ($user->activated == 1)
                                <span class="badge badge-success">
                                    Activated
                                </span>
                            @else
                                <span class="badge badge-danger">
                                    Not-Activated
                                </span>
                            @endif
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="col-sm-5 col-xs-6 text-larger">
                            <strong>
                                {{ trans('usersmanagement.labelAccessLevel')}} {{ $levelAmount }}
                            </strong>
                        </div>
                        <div class="col-sm-7">
                            @if($user->level() >= 5)
                                <span class="badge badge-primary margin-half ml-0">5</span>
                            @endif

                            @if($user->level() >= 4)
                                <span class="badge badge-info margin-half ml-0">4</span>
                            @endif

                            @if($user->level() >= 3)
                                <span class="badge badge-success margin-half ml-0">3</span>
                            @endif

                            @if($user->level() >= 2)
                                <span class="badge badge-warning margin-half ml-0">2</span>
                            @endif

                            @if($user->level() >= 1)
                                <span class="badge badge-default margin-half ml-0">1</span>
                            @endif
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="col-sm-5 col-xs-6 text-larger">
                            <strong>
                                {{ trans('usersmanagement.labelPermissions') }}
                            </strong>
                        </div>
                        <div class="col-sm-7">
                            @if($user->canViewUsers())
                                <span class="badge badge-primary margin-half margin-left-0">
                                    {{ trans('permsandroles.permissionView') }}
                                </span>
                            @endif

                            @if($user->canCreateUsers())
                                <span class="badge badge-info margin-half margin-left-0">
                                    {{ trans('permsandroles.permissionCreate') }}
                                </span>
                            @endif

                            @if($user->canEditUsers())
                                <span class="badge badge-warning margin-half margin-left-0">
                                    {{ trans('permsandroles.permissionEdit') }}
                                </span>
                            @endif

                            @if($user->canDeleteUsers())
                                <span class="badge badge-danger margin-half margin-left-0">
                                    {{ trans('permsandroles.permissionDelete') }}
                                </span>
                            @endif
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        @if ($user->created_at)
                            <div class="col-sm-5 col-xs-6 text-larger">
                                <strong>
                                {{ trans('usersmanagement.labelCreatedAt') }}
                                </strong>
                            </div>
                            <div class="col-sm-7">
                                {{ $user->created_at }}
                            </div>

                            <div class="clearfix"></div>
                            <div class="border-bottom"></div>
                        @endif

                        @if ($user->updated_at)
                            <div class="col-sm-5 col-xs-6 text-larger">
                                <strong>
                                {{ trans('usersmanagement.labelUpdatedAt') }}
                                </strong>
                            </div>
                            <div class="col-sm-7">
                                {{ $user->updated_at }}
                            </div>

                            <div class="clearfix"></div>
                            <div class="border-bottom"></div>
                        @endif

                        @if ($user->signup_ip_address)
                            <div class="col-sm-5 col-xs-6 text-larger">
                                <strong>
                                {{ trans('usersmanagement.labelIpEmail') }}
                                </strong>
                            </div>
                            <div class="col-sm-7">
                                <code>
                                {{ $user->signup_ip_address }}
                                </code>
                            </div>

                            <div class="clearfix"></div>
                            <div class="border-bottom"></div>
                        @endif

                        @if ($user->signup_confirmation_ip_address)
                            <div class="col-sm-5 col-xs-6 text-larger">
                                <strong>
                                {{ trans('usersmanagement.labelIpConfirm') }}
                                </strong>
                            </div>
                            <div class="col-sm-7">
                                <code>
                                {{ $user->signup_confirmation_ip_address }}
                                </code>
                            </div>

                            <div class="clearfix"></div>
                            <div class="border-bottom"></div>
                        @endif

                        @if ($user->signup_sm_ip_address)
                            <div class="col-sm-5 col-xs-6 text-larger">
                                <strong>
                                {{ trans('usersmanagement.labelIpSocial') }}
                                </strong>
                            </div>
                            <div class="col-sm-7">
                                <code>
                                {{ $user->signup_sm_ip_address }}
                                </code>
                            </div>

                            <div class="clearfix"></div>
                            <div class="border-bottom"></div>

                        @endif

                        @if ($user->admin_ip_address)
                            <div class="col-sm-5 col-xs-6 text-larger">
                                <strong>
                                {{ trans('usersmanagement.labelIpAdmin') }}
                                </strong>
                            </div>
                            <div class="col-sm-7">
                                <code>
                                {{ $user->admin_ip_address }}
                                </code>
                            </div>

                            <div class="clearfix"></div>
                            <div class="border-bottom"></div>
                        @endif

                        @if ($user->updated_ip_address)
                            <div class="col-sm-5 col-xs-6 text-larger">
                                <strong>
                                {{ trans('usersmanagement.labelIpUpdate') }}
                                </strong>
                            </div>
                            <div class="col-sm-7">
                                <code>
                                {{ $user->updated_ip_address }}
                                </code>
                            </div>

                            <div class="clearfix"></div>
                            <div class="border-bottom"></div>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('modals.modal-delete')

@endsection

@section('footer_scripts')
    @include('scripts.delete-modal-script')
    @include('scripts.tooltips')
@endsection
