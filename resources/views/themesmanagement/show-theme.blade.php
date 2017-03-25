@extends('layouts.app')

@section('template_title')
  	{{ trans('themes.showHeadTitle') . ' ' . $theme->name }}
@endsection

@section('template_fastload_css')

	.list-group-responsive span:not(.label) {
		display: block;
		overflow-y: auto;
	}
	.list-group-responsive span.label {
		margin-left: 7.25em;
	}

	.theme-details-list strong {
		width: 5.5em;
		display: inline-block;
		position: absolute;
	}

	.theme-details-list span {
	  	margin-left: 5.5em;
	}

@endsection

@php
    $themeStatus = [
        'name'  => trans('themes.statusDisabled'),
        'class' => 'danger'
    ];
    if($theme->status == 1) {
        $themeStatus = [
            'name'  => trans('themes.statusEnabled'),
            'class' => 'success'
        ];
    }
@endphp

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					{{ trans('themes.showTitle') }}
					<a href="/themes/" class="btn btn-primary btn-xs pull-right">
					  <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
					  {{ trans('themes.showBackBtn') }}
					</a>
				</div>
				<div class="panel-body">
					<div class="well well-sm">
					    <h1 class="text-center">
					        {{ $theme->name }}
					    </h1>

					    <h4 class="text-center margin-bottom-2">
					        <span class="badge">{{ count($themeUsers) }}</span> {{ trans('themes.showUsers') }}
					    </h4>

						<ul class="list-group list-group-responsive theme-details-list margin-bottom-3">

							<li class="list-group-item">
								<strong>{{ trans('themes.showStatus') }}</strong>
							    <span class="label label-{{ $themeStatus['class'] }}">
							        {{ $themeStatus['name'] }}
							    </span>
							</li>

							<li class="list-group-item"><strong>Id</strong> <span>{{ $theme->id }}</span></li>

							@if($theme->link != null)
								<li class="list-group-item"><strong>{{ trans('themes.showLink') }}</strong> <span> <a href="{{$theme->link}}" target="_blank" data-toggle="tooltip" title="Go to Link">{{$theme->link}}</a></span></li>
							@endif

							@if($theme->notes != null)
								<li class="list-group-item"><strong>{{ trans('themes.showNotes') }}</strong> <span>{{ $theme->notes }}</span></li>
							@endif

							<li class="list-group-item"><strong>{{ trans('themes.showAdded') }}</strong> <span>{{ $theme->created_at }}</span></li>
							<li class="list-group-item"><strong>{{ trans('themes.showUpdated') }}</strong> <span>{{ $theme->updated_at }}</span></li>
						</ul>

						@if(count($themeUsers) > 0)
							<h4 class="text-center margin-bottom-2">
							   	<i class="fa fa-users fa-fw" aria-hidden="true"></i> Theme Users
							</h4>

							<ul class="list-group">
								@foreach ($themeUsers as $themeUser)
								    <li class="list-group-item"><i class="fa fa-user fa-fw margin-right-1" aria-hidden="true"></i> {{ $themeUser->name }}</li>
								@endforeach
							</ul>
						@endif
					</div>
				</div>
				<div class="panel-footer">
					<div class="row">
						<div class="col-xs-6">
							<a href="/themes/{{$theme->id}}/edit" class="btn btn-small btn-info btn-block">
								<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> Edit<span class="hidden-xs hidden-sm"> this</span><span class="hidden-xs"> Theme</span>
							</a>
						</div>
						{!! Form::open(array('url' => 'themes/' . $theme->id, 'class' => 'col-xs-6')) !!}
							{!! Form::hidden('_method', 'DELETE') !!}
							{!! Form::button('<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i> Delete<span class="hidden-xs hidden-sm"> this</span><span class="hidden-xs"> Theme</span>', array('class' => 'btn btn-danger btn-block btn-flat','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => trans('themes.confirmDeleteHdr'), 'data-message' => trans('themes.confirmDelete'))) !!}
						{!! Form::close() !!}
					</div>
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