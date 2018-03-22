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


@if(config('laravelPhpInfo.usePHPinfoCSS'))
    <style type="text/css" media="screen">
        .php-info pre {
            margin: 0;
            font-family: monospace;
        }
        .php-info a:link {
            color: #009;
            text-decoration: none;
            background-color: #ffffff;
        }
        .php-info a:hover {
            text-decoration: underline;
        }
        .php-info table {
            border-collapse: collapse;
            border: 0;
            width: 100%;
            box-shadow: 1px 2px 3px #ccc;
        }
        .php-info .center {
            text-align: center;
        }
        .php-info .center table {
            margin: 1em auto;
            text-align: left;
        }
        .php-info .center th {
            text-align: center !important;
        }
        .php-info td {
            border: 1px solid #666;
            font-size: 75%;
            vertical-align: baseline;
            padding: 4px 5px;
        }
        .php-info th {
            border: 1px solid #666;
            font-size: 75%;
            vertical-align: baseline;
            padding: 4px 5px;
        }
        .php-info h1 {
            font-size: 150%;
        }
        .php-info h2 {
            font-size: 125%;
        }
        .php-info .p {
            text-align: left;
        }
        .php-info .e {
            background-color: #ccf;
            width: 50px;
            font-weight: bold;
        }
        .php-info .h {
            background-color: #99c;
            font-weight: bold;
        }
        .php-info .v {
            background-color: #ddd;
            max-width: 50px;
            overflow-x: auto;
            word-wrap: break-word;
        }
        .php-info .v i {
            color: #999;
        }
        .php-info img {
            float: right;
            border: 0;
        }
        .php-info hr {
            width: 100%;
            background-color: #ccc;
            border: 0;
            height: 1px;
        }
    </style>
@endif

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="{{ $containerClass }} {{ $bootstrapCardClasses }}">
                    <div class="{{ $containerHeaderClass }}">
                        @lang('laravelPhpInfo::laravel-phpinfo.title')
                    </div>
                    <div class="{{ $containerBodyClass }}">
                        <div class="php-info">
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
