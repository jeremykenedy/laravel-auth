@extends('layouts.app')

@section('template_title')
    Log Viewer
@endsection

@section('head')
    {{-- Log Viewer CSS --}}
    @if ($assetsPublished)
        <link href="{{ asset(mix('app.css', config('log-viewer.assets_path'))) }}" rel="stylesheet">
    @else
        {!! \Opcodes\LogViewer\Facades\LogViewer::css() !!}
    @endif

    <style>
        /* Let the log viewer fill the available content area */
        #log-viewer {
            min-height: calc(100vh - 10rem);
        }
        /* Override log viewer's background to be transparent so it inherits from the app layout */
        #log-viewer .bg-gray-100 { background-color: transparent; }
        #log-viewer .dark\:bg-gray-900 { background-color: transparent; }
    </style>
@endsection

@section('content')
    <x-ui::breadcrumbs :items="[
        ['label' => 'Admin'],
        ['label' => 'Log Viewer'],
    ]" />

    <div id="log-viewer" class="flex max-w-full -mx-4 sm:-mx-6 lg:-mx-8">
        <router-view></router-view>
    </div>
@endsection

@section('footer_scripts')
    {{-- Global LogViewer Object --}}
    <script>
        window.LogViewer = @json($logViewerScriptVariables);
    </script>
    @if ($assetsPublished)
        <script src="{{ asset(mix('app.js', config('log-viewer.assets_path'))) }}"></script>
    @else
        {!! \Opcodes\LogViewer\Facades\LogViewer::js() !!}
    @endif
@endsection
