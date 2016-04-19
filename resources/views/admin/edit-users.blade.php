@extends('app')

@section('template_title')
	Edit Users
@endsection

@section('template_fastload_css')
@endsection

@section('content')

	    <div class="container">

			<h2>
				Edit Users
			</h2>

			@if (session('status'))
				<div class="alert alert-success alert-dismissable flat">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<h4><i class="icon fa fa-check"></i> Success</h4>
					{{ session('status') }}
				</div>
			@endif

			@if (session('anError'))
				<div class="alert alert-danger alert-dismissable flat">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<h4>
						<i class="icon fa fa-warning"></i>
						Success
					</h4>
					{{ session('anError') }}
				</div>
			@endif

			@if (count($errors) > 0)
				<div class="alert alert-danger alert-dismissable flat">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<h4>
						<i class="icon fa fa-warning"></i>
						<strong>{{ Lang::get('auth.whoops') }}</strong> {{ Lang::get('auth.someProblems') }}
					</h4>
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif

			<div class="table-responsive">
				<table id="users_table" class="table table-striped table-hover">
					<thead>
						<tr class="success">
							<th>ID</th>
							<th>Username</th>
							<th>Email</th>
							<th colspan="3">Actions</th>

						</tr>
					</thead>
					<tbody>
						@foreach($users as $key => $value)
							<tr>
								<td>{{ $value->id }}</td>
								<td>{{ $value->name }}

								</td>
								<td>
									<a href="mailto:{{ $value->email }}" title="Send email to {{ $value->email }}">
										{{ $value->email }}
									</a>
								</td>
								<td>
									{!! Form::open(array('url' => 'users/' . $value->id, 'class' => 'pull-right')) !!}
										{!! Form::hidden('_method', 'DELETE') !!}
										{!! Form::button('<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i> Delete this User', array('class' => 'btn btn-danger btn-block btn-flat','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete User', 'data-message' => 'Are you sure you want to delete this user ?')) !!}
									{!! Form::close() !!}
								</td>
								<td>
									<a class="btn btn-small btn-success btn-block btn-flat" href="{{ URL::to('users/' . $value->id) }}">Show this User</a>
								</td>
								<td>
									<a class="btn btn-small btn-info btn-block btn-flat" href="{{ URL::to('users/' . $value->id . '/edit') }}">Edit this User</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>

			<div class="modal fade modal-danger" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Confirm Delete</h4>
						</div>
						<div class="modal-body">
							<p>One fine body&hellip;</p>
						</div>
						<div class="modal-footer">
							{!! Form::button('<i class="fa fa-fw fa-close" aria-hidden="true"></i> Cancel', array('class' => 'btn btn-outline pull-left btn-flat', 'type' => 'button', 'data-dismiss' => 'modal' )) !!}
							{!! Form::button('<i class="fa fa-fw fa-trash-o" aria-hidden="true"></i> Delete this User', array('class' => 'btn btn-outline pull-right btn-flat', 'type' => 'button', 'id' => 'confirm' )) !!}
						</div>
					</div>
				</div>
			</div>

			<div class="row margin-top-1">
{{-- 				<div class="col-md-3">
					{!! HTML::icon_link( "/users/create", 'fa-fw fa '.Lang::get('sidebar-nav.link_icon_user_create'), Lang::get('sidebar-nav.link_title_user_create'), array('class' =>'btn btn-primary btn-flat btn-block')) !!}
				</div> --}}
			</div>

	    </div>

@endsection

@section('template_scripts')


	<script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js"></script>

	<script type="text/javascript">
		$(function () {
			$('#users_table').DataTable({
		        "columnDefs": [
		            {
		                "targets": [ 3, 4, 5 ],
		                "searchable": false,
		                'bSortable': false,
		            }
		        ],
				"paging": true,
				"lengthChange": false,
				"searching": true,
				"ordering": true,
				"info": true,
				"autoWidth": false
			});
		});
    </script>

	<script type="text/javascript">

		// CONFIRMATION SAVE MODEL
		$('#confirmSave').on('show.bs.modal', function (e) {
			var message = $(e.relatedTarget).attr('data-message');
			var title = $(e.relatedTarget).attr('data-title');
			var form = $(e.relatedTarget).closest('form');
			$(this).find('.modal-body p').text(message);
			$(this).find('.modal-title').text(title);
			$(this).find('.modal-footer #confirm').data('form', form);
		});
		$('#confirmSave').find('.modal-footer #confirm').on('click', function(){
		  	$(this).data('form').submit();
		});

		// CONFIRMATION DELETE MODAL
		$('#confirmDelete').on('show.bs.modal', function (e) {
			var message = $(e.relatedTarget).attr('data-message');
			var title = $(e.relatedTarget).attr('data-title');
			var form = $(e.relatedTarget).closest('form');
			$(this).find('.modal-body p').text(message);
			$(this).find('.modal-title').text(title);
			$(this).find('.modal-footer #confirm').data('form', form);
		});
		$('#confirmDelete').find('.modal-footer #confirm').on('click', function(){
		  	$(this).data('form').submit();
		});

	</script>

@endsection