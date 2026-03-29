@extends('layouts.app')
@section('content')
<div class="container py-5" style="max-width:700px">
    <h1 class="h2 mb-4">Face Authentication</h1>
    <div class="card mb-4"><div class="card-header"><h5 class="mb-0">Enroll Your Face</h5></div><div class="card-body">
        <p class="text-muted mb-3">Position your face in the camera frame and click enroll.</p>
        <video id="face-video" autoplay muted playsinline class="w-100 rounded bg-dark mb-3" style="max-height:400px"></video>
        <div class="d-flex gap-2">
            <button id="btn-enroll" class="btn btn-primary">Enroll Face</button>
            <button id="btn-verify" class="btn btn-secondary">Verify Face</button>
        </div>
    </div></div>
    <div class="card"><div class="card-header">Enrolled Faces</div><div class="card-body"><div id="enrollments-list"><p class="text-muted">Loading...</p></div></div></div>
</div>
@endsection
