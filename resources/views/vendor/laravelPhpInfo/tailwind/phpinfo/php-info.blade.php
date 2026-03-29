@extends(config('laravelPhpInfo.laravelPhpInfoBladeExtended'))

@section('title')
    {!! trans('laravelPhpInfo::laravel-phpinfo.title') !!}
@endsection

@section('template_linked_css')
@if(config('laravelPhpInfo.usePHPinfoCSS'))
    <style type="text/css" media="screen">
        .php-info pre { margin: 0; font-family: monospace; }
        .php-info a:link { color: #60a5fa; text-decoration: none; }
        .php-info a:hover { text-decoration: underline; }
        .php-info table { border-collapse: collapse; border: 0; width: 100%; }
        .php-info .center { text-align: center; }
        .php-info .center table { margin: 1em auto; text-align: left; }
        .php-info .center th { text-align: center; }
        .php-info td, .php-info th { font-size: 75%; vertical-align: baseline; padding: 4px 8px; }
        .php-info h1 { font-size: 150%; }
        .php-info h2 { font-size: 125%; }
        .php-info .p { text-align: left; }
        html.dark .php-info .e { background-color: #1e3a5f; color: #e5e7eb; font-weight: bold; width: 50px; }
        html.dark .php-info .h { background-color: #1e3a5f; color: #f3f4f6; font-weight: bold; }
        html.dark .php-info .v { background-color: #374151; color: #e5e7eb; max-width: 50px; overflow-x: auto; word-wrap: break-word; }
        html.dark .php-info td, html.dark .php-info th { border: 1px solid #4b5563; }
        html:not(.dark) .php-info .e { background-color: #dbeafe; font-weight: bold; width: 50px; }
        html:not(.dark) .php-info .h { background-color: #bfdbfe; font-weight: bold; }
        html:not(.dark) .php-info .v { background-color: #f3f4f6; max-width: 50px; overflow-x: auto; word-wrap: break-word; }
        html:not(.dark) .php-info td, html:not(.dark) .php-info th { border: 1px solid #d1d5db; }
        .php-info .v i { color: #9ca3af; }
        .php-info img { float: right; border: 0; }
        .php-info hr { width: 100%; background-color: #6b7280; border: 0; height: 1px; }
    </style>
@endif
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <x-ui::card title="{!! trans('laravelPhpInfo::laravel-phpinfo.title') !!}">
        <div class="php-info overflow-x-auto">
            @php
                ob_start();
                phpinfo();
                $pinfo = ob_get_contents();
                ob_end_clean();
                $pinfo = preg_replace('%^.*<body>(.*)</body>.*$%ms', '$1', $pinfo);
                echo $pinfo;
            @endphp
        </div>
    </x-ui::card>
</div>
@endsection
