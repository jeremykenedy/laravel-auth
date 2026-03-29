<?php

return [
    'enabled' => env('AUTH_API_ENABLED', true),

    'prefix' => env('AUTH_API_PREFIX', 'api/v1'),

    'middleware' => ['api'],

    'auth_middleware' => ['api', 'auth:sanctum'],

    'rate_limit' => env('AUTH_API_RATE_LIMIT', 60),

    'token_name' => env('AUTH_API_TOKEN_NAME', 'api-token'),

    'features' => [
        'register' => env('AUTH_API_REGISTER', true),
        'login' => env('AUTH_API_LOGIN', true),
        'logout' => env('AUTH_API_LOGOUT', true),
        'refresh' => env('AUTH_API_REFRESH', false),
        'forgot_password' => env('AUTH_API_FORGOT_PASSWORD', true),
        'reset_password' => env('AUTH_API_RESET_PASSWORD', true),
        'email_verification' => env('AUTH_API_EMAIL_VERIFY', true),
        'two_factor' => env('AUTH_API_TWO_FACTOR', false),
    ],
];
