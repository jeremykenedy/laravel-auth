@extends('layouts.app')

@section('template_title')
  Showing User {{ $user->name }}
@endsection

@php
  $levelAmount = 'Level';

  if ($user->level() >= 2) {
      $levelAmount = 'Levels';

  }
@endphp

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-12">

        <div class="panel @if ($user->activated == 1) panel-success @else panel-danger @endif">

          <div class="panel-heading">
            <a href="/users/" class="btn btn-primary btn-xs pull-right">
              <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
              <span class="hidden-xs">Back to Users</span>
            </a>
            User Information
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
                      {!! HTML::link(url('/profile/'.$user->name), trans('usersmanagement.viewProfile'), ['class' => 'btn btn-info btn-sm']) !!}
                    </div>
                  @endif

                </div>
              </div>
            </div>

            <div class="clearfix"></div>
            <div class="border-bottom"></div>

            @if ($user->name)

              <div class="col-sm-5 col-xs-6 text-larger">
                <strong>
                  Username:
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
                Email:
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
                  First Name:
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
                  Last Name:
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
                Role:
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
                Status:
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
                Access {{ $levelAmount }}:
              </strong>
            </div>

            <div class="col-sm-7">

              @level(5)
                  <span class="label label-primary margin-half margin-left-0">5</span>
              @endlevel

              @level(4)
                  <span class="label label-info margin-half margin-left-0">4</span>
              @endlevel

              @level(3)
                  <span class="label label-success margin-half margin-left-0">3</span>
              @endlevel

              @level(2)
                  <span class="label label-warning margin-half margin-left-0">2</span>
              @endlevel

              @level(1)
                  <span class="label label-default margin-half margin-left-0">1</span>
              @endlevel

            </div>

            <div class="clearfix"></div>
            <div class="border-bottom"></div>

            <div class="col-sm-5 col-xs-6 text-larger">
              <strong>
                Permissions:
              </strong>
            </div>

            <div class="col-sm-7">
              @permission('view.users')
                  <span class="label label-primary margin-half margin-left-0"">
                      View
                  </span>
              @endpermission

              @permission('create.users')
                  <span class="label label-info margin-half margin-left-0"">
                      Create
                  </span>
              @endpermission

              @permission('edit.users')
                  <span class="label label-warning margin-half margin-left-0"">
                      Edit
                  </span>
              @endpermission

              @permission('delete.users')
                  <span class="label label-danger margin-half margin-left-0"">
                      Delete
                  </span>
              @endpermission
            </div>

            <div class="clearfix"></div>
            <div class="border-bottom"></div>

            @if ($user->created_at)

              <div class="col-sm-5 col-xs-6 text-larger">
                <strong>
                  Created At:
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
                  Updated At:
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
                  Email Signup IP:
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
                  Confirmation IP:
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
                  Socialite Signup IP:
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
                  Admin Signup IP:
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
                  Last Update IP:
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

@endsection
