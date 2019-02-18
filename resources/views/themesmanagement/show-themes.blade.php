@extends('layouts.app')

@section('template_title')
    Showing Themes
@endsection

@section('template_linked_css')
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <style type="text/css" media="screen">
        .themes-table {
            border: 0;
        }
        .themes-table tr td:first-child {
            padding-left: 15px;
        }
        .themes-table tr td:last-child {
            padding-right: 15px;
        }
        .themes-table.table-responsive,
        .themes-table.table-responsive table {
            margin-bottom: 0;
        }

    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">

                {{ trans('themes.themesTitle') }} <strong>{{ count($themes) }}</strong> {{ trans('themes.themes') }}

                <a href="/themes/create" class="btn btn-outline-secondary btn-sm pull-right mb-2">
                    <i class="fa fa-fw fa-plus" aria-hidden="true"></i>
                    {{ trans('themes.btnAddTheme') }}
                </a>

                <div class="table-responsive themes-table">
                    <table class="table table-striped table-sm data-table">
                        <thead class="thead-dark">
                            <tr>
                                {{-- <th>ID</th> --}}
                                <th>{{ trans('themes.themesStatus') }}</th>
                                <th>{{ trans('themes.themesUsers') }}</th>
                                <th>{{ trans('themes.themesName') }}</th>
                                <th class="hidden-xs hidden-sm hidden-md">{{ trans('themes.themesLink') }}</th>
                                <th>{{ trans('themes.themesActions') }}</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($themes as $aTheme)
                                @php
                                    $themeStatus = [
                                        'name'  => trans('themes.statusDisabled'),
                                        'class' => 'danger'
                                    ];
                                    if($aTheme->status == 1) {
                                        $themeStatus = [
                                            'name'  => trans('themes.statusEnabled'),
                                            'class' => 'success'
                                        ];
                                    }

                                    $themeUsers = 0;
                                    $themeCountClass = 'primary';
                                    foreach($users as $user) {
                                        if($user->profile && $user->profile->theme_id === $aTheme->id) {
                                           $themeUsers += 1;
                                        }
                                    }
                                    if($themeUsers === 1) {
                                        $themeCountClass = 'info';
                                    } elseif($themeUsers >= 2) {
                                        $themeCountClass = 'warning';
                                    } elseif($themeUsers === 5) {
                                        $themeCountClass = 'success';
                                    } elseif($themeUsers === 10) {
                                        $themeCountClass = 'danger';
                                    }
                                @endphp
                                <tr>
                                    {{-- <td>{{$aTheme->id}}</td> --}}
                                    <td>
                                        <span class="label label-{{ $themeStatus['class'] }}">
                                            {{ $themeStatus['name'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="label label-{{ $themeCountClass }}" style="margin-left: 6px">
                                            {{ $themeUsers }}
                                        </span>
                                    </td>
                                    <td>{{$aTheme->name}}</td>
                                    <td class="hidden-xs hidden-sm hidden-md">
                                        <a href="{{$aTheme->link}}" target="_blank" data-toggle="tooltip" title="Go to Link">
                                            {{$aTheme->link}}
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-success btn-block" href="{{ URL::to('themes/' . $aTheme->id) }}" data-toggle="tooltip" title="{{ trans('themes.themesBtnShow') }}">
                                            <i class="fa fa-eye fa-fw" aria-hidden="true"></i>
                                            <span class="sr-only">{{ trans('themes.themesBtnShow') }}</span>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('themes/' . $aTheme->id . '/edit') }}" data-toggle="tooltip" title="{{ trans('themes.themesBtnEdit') }}">
                                            <i class="fa fa-pencil fa-fw" aria-hidden="true"></i>
                                            <span class="sr-only">{{ trans('themes.themesBtnEdit') }}</span>
                                        </a>
                                    </td>
                                    <td>
                                        {!! Form::open(array('url' => 'themes/' . $aTheme->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete Theme')) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::button('<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i> <span class="sr-only">Delete Theme</span>', array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => trans('themes.confirmDeleteHdr'), 'data-message' => trans('themes.confirmDelete'))) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    @include('modals.modal-delete')

@endsection

@section('footer_scripts')

    @if (count($themes) > 50)
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @include('scripts.tooltips')

@endsection
