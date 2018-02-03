@extends(config('laravelPhpInfo.laravelPhpInfoBladeExtended'))

@section('title')
    @lang('laravelPhpInfo::laravel-phpinfo.title')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @lang('laravelPhpInfo::laravel-phpinfo.title')
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
