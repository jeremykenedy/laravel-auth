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
							<th class="hidden-xs">ID</th>
							<th>Username</th>
							<th class="hidden-sm hidden-xs">Email</th>
							<th colspan="3">Actions</th>

						</tr>
					</thead>
					<tbody>
						@foreach($users as $key => $value)
							<tr>
								<td class="hidden-xs">{{ $value->id }}</td>
								<td>{{ $value->name }}

								</td>
								<td class="hidden-sm hidden-xs">
									<a href="mailto:{{ $value->email }}" title="Send email to {{ $value->email }}">
										{{ $value->email }}
									</a>
								</td>
								<td>
									{!! Form::open(array('url' => 'users/' . $value->id, 'class' => 'pull-right')) !!}
										{!! Form::hidden('_method', 'DELETE') !!}
										{!! Form::button('<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i><span class="hidden-xs">Delete</span> <span class="hidden-md hidden-sm hidden-xs">this User</span></a>', array('class' => 'btn btn-danger btn-raised btn-block btn-flat','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete User', 'data-message' => 'Are you sure you want to delete this user ?')) !!}
									{!! Form::close() !!}
								</td>
								<td>
									<a class="btn btn-small btn-raised btn-success btn-block btn-flat" href="{{ URL::to('users/' . $value->id) }}">
										<i class="fa fa-eye fa-fw" aria-hidden="true"></i>
										<span class="hidden-xs">Show</span>
										<span class="hidden-md hidden-sm hidden-xs">this User</span>
									</a>
									</a>
								</td>
								<td>
									<a class="btn btn-small btn-raised btn-info btn-block btn-flat" href="{{ URL::to('users/' . $value->id . '/edit') }}">
										<i class="fa fa-cog fa-fw" aria-hidden="true"></i>
										<span class="hidden-xs">Edit</span>
										<span class="hidden-md hidden-sm hidden-xs">this User</span>
									</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>

			@include('modals.modal-delete')

			<div class="row margin-top-1">

				<div class="col-md-3">
					{!! HTML::icon_link( "/users/create", 'fa-fw fa '.Lang::get('links-and-buttons.link_icon_user_create'), Lang::get('links-and-buttons.link_title_user_create'), array('class' =>'btn btn-primary btn-flat btn-block btn-raised')) !!}
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