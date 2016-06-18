@extends('app')

@section('template_title')
	Edit Users
@endsection

@section('template_linked_css')
	{!! HTML::style(asset('https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css'), array('type' => 'text/css', 'rel' => 'stylesheet')) !!}
@endsection

@section('template_fastload_css')
@endsection

@section('content')

	    <div class="container">

			<h2>
				Edit Users
			</h2>

			@include('partials.form-status')

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

			@include('modals.modal-delete')

			<div class="row margin-top-1">

				<div class="col-md-3">
					{!! HTML::icon_link( "/users/create", 'fa-fw fa '.Lang::get('links-and-buttons.link_icon_user_create'), Lang::get('links-and-buttons.link_title_user_create'), array('class' =>'btn btn-primary btn-flat btn-block')) !!}
				</div>

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

	@include('scripts.delete-modal-script')
	@include('scripts.save-modal-script')

@endsection