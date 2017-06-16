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
						<div class="table-responsive php-info">
							@php
								ob_start();
								phpinfo();
								$pinfo = ob_get_contents();
								ob_end_clean();
								$pinfo = preg_replace( '%^.*<body>(.*)</body>.*$%ms','$1',$pinfo);
								echo $pinfo;
							@endphp
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection