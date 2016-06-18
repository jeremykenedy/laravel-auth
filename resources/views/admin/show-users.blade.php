@extends('app')

@section('template_title')
	Show Users
@endsection

@section('template_linked_css')
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css">
@endsection

@section('template_fastload_css')
@endsection

@section('content')

	<div class="container">

		<h2>
			Showing Users
		</h2>

		<div class="table-responsive">

			<table id="user_table" class="table table-striped table-hover table-condensed">
				<thead>
					<tr class="success">
						<th>ID</th>
						<th>Name</th>
						<th>Email</th>
						<th>Created</th>
						<th>Updated</th>
					</tr>
				</thead>
				<tbody>

			        @foreach ($users as $a_user)

						<tr>
							<td><a href="{{ URL::to('users/' . $a_user->id) }}">{{$a_user->id}}</a></td>
							<td><a href="{{ URL::to('users/' . $a_user->id) }}">{{$a_user->name}} </a></td>
							<td><a href="{{ URL::to('users/' . $a_user->id) }}">{{$a_user->email}} </a></td>
							<td><a href="{{ URL::to('users/' . $a_user->id) }}">{{$a_user->created_at}} </a></td>
							<td><a href="{{ URL::to('users/' . $a_user->id) }}">{{$a_user->updated_at}} </a></td>
						</tr>

			        @endforeach

				</tbody>
			</table>

		</div>
	</div>

@endsection

@section('template_scripts')

	<script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js"></script>

	<script type="text/javascript">
		$(function () {
			$('#user_table').DataTable({
				"paging": true,
				"lengthChange": true,
				"searching": true,
				"ordering": true,
				"info": true,
				"autoWidth": true
			});
		});
    </script>

@endsection