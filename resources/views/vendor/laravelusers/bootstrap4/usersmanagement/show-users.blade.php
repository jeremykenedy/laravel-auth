@extends(config('laravelusers.laravelUsersBladeExtended'))

@section('template_title')
    {!! trans('laravelusers::laravelusers.showing-all-users') !!}
@endsection

@section('template_linked_css')
    @if(config('laravelusers.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('laravelusers.datatablesCssCDN') }}">
    @endif
    @if(config('laravelusers.fontAwesomeEnabled'))
        <link rel="stylesheet" type="text/css" href="{{ config('laravelusers.fontAwesomeCdn') }}">
    @endif
    @include('laravelusers::partials.styles')
    @include('laravelusers::partials.bs-visibility-css')
@endsection

@section('content')
    <div class="container">
        @if(config('laravelusers.enablePackageBootstapAlerts'))
            <div class="row">
                <div class="col-sm-12">
                    @include('laravelusers::partials.form-status')
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {!! trans('laravelusers::laravelusers.showing-all-users') !!}
                            </span>

                            <div class="btn-group pull-right btn-group-xs">
                                @if(config('laravelusers.softDeletedEnabled'))
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v fa-fw" aria-hidden="true"></i>
                                        <span class="sr-only">
                                            {!! trans('laravelusers::laravelusers.users-menu-alt') !!}
                                        </span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('users.create') }}">
                                                @if(config('laravelusers.fontAwesomeEnabled'))
                                                    <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                                @endif
                                                {!! trans('laravelusers::laravelusers.buttons.create-new') !!}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/users/deleted">
                                                @if(config('laravelusers.fontAwesomeEnabled'))
                                                    <i class="fa fa-fw fa-group" aria-hidden="true"></i>
                                                @endif
                                                {!! trans('laravelusers::laravelusers.show-deleted-users') !!}
                                            </a>
                                        </li>
                                    </ul>
                                @else
                                    <a href="{{ route('users.create') }}" class="btn btn-default btn-sm pull-right" data-toggle="tooltip" data-placement="left" title="{!! trans('laravelusers::laravelusers.tooltips.create-new') !!}">
                                        @if(config('laravelusers.fontAwesomeEnabled'))
                                            <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                        @endif
                                        {!! trans('laravelusers::laravelusers.buttons.create-new') !!}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        @if(config('laravelusers.enableSearchUsers'))
                            @include('laravelusers::partials.search-users-form')
                        @endif

                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="user_count">
                                    {!! trans_choice('laravelusers::laravelusers.users-table.caption', 1, ['userscount' => $users->count()]) !!}
                                </caption>
                                <thead class="thead">
                                    <tr>
                                        <th>{!! trans('laravelusers::laravelusers.users-table.id') !!}</th>
                                        <th>{!! trans('laravelusers::laravelusers.users-table.name') !!}</th>
                                        <th class="hidden-xs">{!! trans('laravelusers::laravelusers.users-table.email') !!}</th>
                                        @if(config('laravelusers.rolesEnabled'))
                                            <th class="hidden-sm hidden-xs">{!! trans('laravelusers::laravelusers.users-table.role') !!}</th>
                                        @endif
                                        <th class="hidden-sm hidden-xs hidden-md">{!! trans('laravelusers::laravelusers.users-table.created') !!}</th>
                                        <th class="hidden-sm hidden-xs hidden-md">{!! trans('laravelusers::laravelusers.users-table.updated') !!}</th>
                                        <th class="no-search no-sort">{!! trans('laravelusers::laravelusers.users-table.actions') !!}</th>
                                        <th class="no-search no-sort"></th>
                                        <th class="no-search no-sort"></th>
                                    </tr>
                                </thead>
                                <tbody id="users_table">
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{$user->id}}</td>
                                            <td>{{$user->name}}</td>
                                            <td class="hidden-xs">{{$user->email}}</td>
                                            @if(config('laravelusers.rolesEnabled'))
                                                <td class="hidden-sm hidden-xs">
                                                    @foreach ($user->roles as $user_role)
                                                        @if ($user_role->name == 'User')
                                                            @php $badgeClass = 'primary' @endphp
                                                        @elseif ($user_role->name == 'Admin')
                                                            @php $badgeClass = 'warning' @endphp
                                                        @elseif ($user_role->name == 'Unverified')
                                                            @php $badgeClass = 'danger' @endphp
                                                        @else
                                                            @php $badgeClass = 'dark' @endphp
                                                        @endif
                                                        <span class="badge badge-{{$badgeClass}}">{{ $user_role->name }}</span>
                                                    @endforeach
                                                </td>
                                            @endif
                                            <td class="hidden-sm hidden-xs hidden-md">{{$user->created_at}}</td>
                                            <td class="hidden-sm hidden-xs hidden-md">{{$user->updated_at}}</td>
                                            <td>
                                                <form method="POST" action="{{ url('users/' . $user->id) }}" data-toggle="tooltip" title="{{ trans('laravelusers::laravelusers.tooltips.delete') }}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="button" class="btn btn-danger btn-sm" style="width: 100%;" data-toggle="modal" data-target="#confirmDelete" data-title="{{ trans('laravelusers::modals.delete_user_title') }}" data-message="{{ trans('laravelusers::modals.delete_user_message', ['user' => $user->name]) }}">
                                                        {!! trans('laravelusers::laravelusers.buttons.delete') !!}
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-success btn-block" href="{{ URL::to('users/' . $user->id) }}" data-toggle="tooltip" title="{!! trans('laravelusers::laravelusers.tooltips.show') !!}">
                                                    {!! trans('laravelusers::laravelusers.buttons.show') !!}
                                                </a>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('users/' . $user->id . '/edit') }}" data-toggle="tooltip" title="{!! trans('laravelusers::laravelusers.tooltips.edit') !!}">
                                                    {!! trans('laravelusers::laravelusers.buttons.edit') !!}
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                @if(config('laravelusers.enableSearchUsers'))
                                    <tbody id="search_results"></tbody>
                                @endif
                            </table>

                            @if($pagintaionEnabled)
                                {{ $users->links() }}
                            @endif

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('laravelusers::modals.modal-delete')

@endsection

@section('template_scripts')
    @if ((count($users) > config('laravelusers.datatablesJsStartCount')) && config('laravelusers.enabledDatatablesJs'))
        @include('laravelusers::scripts.datatables')
    @endif
    @include('laravelusers::scripts.delete-modal-script')
    @include('laravelusers::scripts.save-modal-script')
    @if(config('laravelusers.tooltipsEnabled'))
        @include('laravelusers::scripts.tooltips')
    @endif
    @if(config('laravelusers.enableSearchUsers'))
        @include('laravelusers::scripts.search-users')
    @endif

@endsection
