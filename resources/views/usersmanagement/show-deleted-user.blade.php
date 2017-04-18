@extends('layouts.app')

@section('template_title')
  Showing User {{ $user->name }}
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
      <div class="col-md-12">

        <div class="panel panel-danger">

          <div class="panel-heading">
            <a href="/users/deleted/" class="btn btn-primary btn-xs pull-right">
              <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
              <span class="hidden-xs">{{ trans('usersmanagement.usersBackDelBtn') }}</span>
            </a>
            {{ trans('usersmanagement.usersDeletedPanelTitle') }}
          </div>
          <div class="panel-body">

            <div class="well">
              <div class="row">
                <div class="col-sm-6">
                  <img src="@if ($user->profile->avatar_status == 1) {{ $user->profile->avatar }} @else {{ Gravatar::get($user->email) }} @endif" alt="{{ $user->name }}" id="" class="img-circle center-block margin-bottom-2 margin-top-1 user-image">
                </div>

                <div class="col-sm-6">
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
                    <div class="text-center text-left-tablet margin-bottom-1">

                      {!! Form::model($user, array('action' => array('SoftDeletesController@update', $user->id), 'method' => 'PUT', 'class' => 'form-inline')) !!}
                          {!! Form::button('<i class="fa fa-refresh fa-fw" aria-hidden="true"></i> Restore User', array('class' => 'btn btn-success btn-block btn-sm', 'type' => 'submit', 'data-toggle' => 'tooltip', 'title' => 'Restore User')) !!}
                      {!! Form::close() !!}

                      {!! Form::model($user, array('action' => array('SoftDeletesController@destroy', $user->id), 'method' => 'DELETE', 'class' => 'form-inline', 'data-toggle' => 'tooltip', 'title' => 'Permanently Delete User')) !!}
                          {!! Form::hidden('_method', 'DELETE') !!}
                          {!! Form::button('<i class="fa fa-user-times fa-fw" aria-hidden="true"></i> Delete User', array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Permanently Delete User', 'data-message' => 'Are you sure you want to permanently delete this user?')) !!}
                      {!! Form::close() !!}

                    </div>
                  @endif

                </div>
              </div>
            </div>

            <div class="clearfix"></div>
            <div class="border-bottom"></div>

            @if ($user->deleted_at)

              <div class="col-sm-5 col-xs-6 text-larger text-warning">
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

              <div class="col-sm-5 col-xs-6 text-larger text-warning">
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
                  @php $labelClass = 'primary' @endphp

                @elseif ($user_role->name == 'Admin')
                  @php $labelClass = 'warning' @endphp

                @elseif ($user_role->name == 'Unverified')
                  @php $labelClass = 'danger' @endphp

                @else
                  @php $labelClass = 'default' @endphp

                @endif

                <span class="label label-{{$labelClass}}">{{ $user_role->name }}</span>

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
                <span class="label label-success">
                  Activated
                </span>
              @else
                <span class="label label-danger">
                  Not-Activated
                </span>
              @endif
            </div>

            <div class="clearfix"></div>
            <div class="border-bottom"></div>

            <div class="col-sm-5 col-xs-6 text-larger">
              <strong>
                Access {{ trans('usersmanagement.labelAccessLevel')}} {{ $levelAmount }}:
              </strong>
            </div>

            <div class="col-sm-7">

              @if($user->level() >= 5)
                <span class="label label-primary margin-half margin-left-0">5</span>
              @endif

              @if($user->level() >= 4)
                 <span class="label label-info margin-half margin-left-0">4</span>
              @endif

              @if($user->level() >= 3)
                <span class="label label-success margin-half margin-left-0">3</span>
              @endif

              @if($user->level() >= 2)
                <span class="label label-warning margin-half margin-left-0">2</span>
              @endif

              @if($user->level() >= 1)
                <span class="label label-default margin-half margin-left-0">1</span>
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
                <span class="label label-primary margin-half margin-left-0"">
                  {{ trans('permsandroles.permissionView') }}
                </span>
              @endif

              @if($user->canCreateUsers())
                <span class="label label-info margin-half margin-left-0"">
                  {{ trans('permsandroles.permissionCreate') }}
                </span>
              @endif

              @if($user->canEditUsers())
                <span class="label label-warning margin-half margin-left-0"">
                  {{ trans('permsandroles.permissionEdit') }}
                </span>
              @endif

              @if($user->canDeleteUsers())
                <span class="label label-danger margin-half margin-left-0"">
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
                {{ $user->signup_ip_address }}
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
                {{ $user->signup_confirmation_ip_address }}
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
                {{ $user->signup_sm_ip_address }}
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
                {{ $user->admin_ip_address }}
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
                {{ $user->updated_ip_address }}
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
