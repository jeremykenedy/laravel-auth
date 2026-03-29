@extends('layouts.app')
@section('content')
<div class="container py-5" style="max-width:700px">
    <h1 class="h2 mb-4">Face Authentication</h1>
    <div class="card mb-4"><div class="card-header">Enroll Your Face</div><div class="card-body">
        <p class="text-muted mb-3">Position your face in the camera frame.</p>
        <video id="face-video" autoplay muted playsinline class="w-100 rounded" style="max-height:400px;background:#000"></video>
        <div class="mt-3"><button id="btn-enroll" class="btn btn-primary mr-2">Enroll</button><button id="btn-verify" class="btn btn-secondary">Verify</button></div>
    </div></div>
</div>
@endsection
