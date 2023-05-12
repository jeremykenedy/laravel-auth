@extends('layouts.app')

@section('template_title')
	Routing Information
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				@include('partials.form-status')

				<div class="card">
					<div class="card-header">
						Routing Information
						<span class="badge badge-primary pull-right">{{ count($routes) }} routes</span>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-striped table-sm data-table">
								<thead>
									<tr class="success">
                                        @if(config('settings.showRouteHttpMethod'))
                                            <th>Request Method</th>
                                        @endif
					                    <th>URI</th>
					                    <th>Name</th>
					                    <th>Type</th>
					                    <th>Method</th>
									</tr>
								</thead>
								<tbody>
							        @foreach ($routes as $route)
										<tr>
                                            @if(config('settings.showRouteHttpMethod'))
                                                <td>
                                                    @foreach ($route->methods as $method)
                                                        <span class="badge badge-primary">{{strtolower($method)}}</span>
                                                    @endforeach
                                                </td>
                                            @endif
				                        <td>{{$route->uri}}</td>
				                        <td>{{$route->getName()}}</td>
				                        <td>{{$route->getPrefix()}}</td>
				                        <td>{{$route->getActionMethod()}}</td>
										</tr>
							        @endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
