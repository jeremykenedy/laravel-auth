<?php

return [
    'enabled' => env('NATIVE_KIT_ENABLED', false),

    'platform' => env('NATIVE_KIT_PLATFORM', 'electron'),

    'window' => [
        'width' => env('NATIVE_KIT_WINDOW_WIDTH', 1200),
        'height' => env('NATIVE_KIT_WINDOW_HEIGHT', 800),
        'min_width' => 800,
        'min_height' => 600,
        'title' => env('NATIVE_KIT_TITLE', config('app.name', 'Laravel')),
        'resizable' => true,
        'fullscreen' => false,
        'always_on_top' => false,
    ],

    'menu' => [
        'show_default' => true,
    ],

    'tray' => [
        'enabled' => env('NATIVE_KIT_TRAY', false),
        'tooltip' => env('NATIVE_KIT_TRAY_TOOLTIP', config('app.name', 'Laravel')),
    ],

    'updates' => [
        'enabled' => env('NATIVE_KIT_UPDATES', false),
        'provider' => env('NATIVE_KIT_UPDATE_PROVIDER', 'github'),
        'repo' => env('NATIVE_KIT_UPDATE_REPO'),
    ],

    'deep_links' => [
        'enabled' => env('NATIVE_KIT_DEEP_LINKS', false),
        'scheme' => env('NATIVE_KIT_DEEP_LINK_SCHEME', 'laravel-auth'),
    ],
];
