@extends(config('laravelPhpInfo.laravelPhpInfoBladeExtended'))

@section('title')
    @lang('laravelPhpInfo::laravel-phpinfo.title')
@endsection

@php
    switch (config('laravelPhpInfo.bootstapVersion')) {
        case '4':
            $containerClass = 'card';
            $containerHeaderClass = 'card-header';
            $containerBodyClass = 'card-body';
            break;
        case '3':
        default:
            $containerClass = 'panel panel-default';
            $containerHeaderClass = 'panel-heading';
            $containerBodyClass = 'panel-body';
    }
    $bootstrapCardClasses = (is_null(config('laravelPhpInfo.bootstrapCardClasses')) ? '' : config('laravelPhpInfo.bootstrapCardClasses'));
@endphp

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="{{ $containerClass }} {{ $bootstrapCardClasses }}">
                    <div class="{{ $containerHeaderClass }}">
                        @lang('laravelPhpInfo::laravel-phpinfo.title')
                    </div>
                    <div class="{{ $containerBodyClass }}">
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
