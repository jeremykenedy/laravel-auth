@extends('layouts.app')

@section('template_title')
	PHP Information
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						PHP Information
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							@php
								phpinfo();
							@endphp
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection