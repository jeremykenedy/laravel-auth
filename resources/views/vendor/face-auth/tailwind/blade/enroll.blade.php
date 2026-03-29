@extends('layouts.app')
@section('content')
<div class="container mx-auto max-w-2xl px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Face Authentication</h1>
    <x-ui::card title="Enroll Your Face" class="mb-6">
        <p class="text-sm text-gray-500 mb-4">Position your face in the camera frame and click enroll. Only a mathematical descriptor is stored, not your image.</p>
        <div id="face-auth-container">
            <video id="face-video" autoplay muted playsinline class="w-full rounded-lg bg-gray-900 mb-4" style="max-height:400px"></video>
            <div class="flex gap-3">
                <x-ui::button id="btn-enroll" variant="primary">Enroll Face</x-ui::button>
                <x-ui::button id="btn-verify" variant="secondary">Verify Face</x-ui::button>
            </div>
        </div>
    </x-ui::card>
    <x-ui::card title="Enrolled Faces">
        <div id="enrollments-list" class="space-y-2">
            <p class="text-sm text-gray-500">Loading enrollments...</p>
        </div>
    </x-ui::card>
</div>
<script src="{{ config('face-auth.models_cdn') }}../dist/face-api.min.js"></script>
@endsection
