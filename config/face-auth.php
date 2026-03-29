<?php

return [
    'enabled' => env('FACE_AUTH_ENABLED', false),

    'as_primary' => env('FACE_AUTH_PRIMARY', false),
    'as_mfa' => env('FACE_AUTH_MFA', false),

    'liveness' => [
        'enabled' => env('FACE_AUTH_LIVENESS', true),
        'challenge_types' => ['blink', 'smile', 'turn_left', 'turn_right'],
        'timeout_seconds' => env('FACE_AUTH_LIVENESS_TIMEOUT', 30),
    ],

    'multi_enrollment' => [
        'enabled' => env('FACE_AUTH_MULTI_ENROLL', true),
        'max_faces' => env('FACE_AUTH_MAX_FACES', 3),
    ],

    'matching' => [
        'threshold' => env('FACE_AUTH_THRESHOLD', 0.6),
        'descriptor_size' => 128,
    ],

    'models_cdn' => env('FACE_AUTH_MODELS_CDN', 'https://cdn.jsdelivr.net/npm/@vladmandic/face-api/model/'),

    'routes' => [
        'enabled' => true,
        'prefix' => 'face-auth',
        'middleware' => ['web', 'auth'],
    ],
];
