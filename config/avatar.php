<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Avatar Provider
    |--------------------------------------------------------------------------
    |
    | The fallback avatar when no image is uploaded.
    | Supported: "initials", "gravatar", "ui-avatars", "dicebear", "icon"
    |
    */

    'default_provider' => env('AVATAR_DEFAULT_PROVIDER', 'gravatar'),

    /*
    |--------------------------------------------------------------------------
    | Provider Priority
    |--------------------------------------------------------------------------
    |
    | When resolving an avatar URL, providers are checked in this order.
    | "upload" is always checked first. The first provider that returns
    | a URL wins.
    |
    */

    'provider_priority' => ['upload', 'gravatar', 'initials'],

    /*
    |--------------------------------------------------------------------------
    | Upload Settings
    |--------------------------------------------------------------------------
    */

    'upload' => [
        'disk' => env('AVATAR_UPLOAD_DISK', 'local'),
        'path' => env('AVATAR_UPLOAD_PATH', 'users/id/{user_id}/uploads/images/avatar'),
        'max_size_kb' => env('AVATAR_MAX_SIZE', 1024),
        'resize_width' => env('AVATAR_RESIZE_WIDTH', 300),
        'resize_height' => env('AVATAR_RESIZE_HEIGHT', 300),
        'accepted_types' => ['jpeg', 'jpg', 'png', 'gif', 'webp'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Gravatar Settings
    |--------------------------------------------------------------------------
    */

    'gravatar' => [
        'enabled' => env('AVATAR_GRAVATAR_ENABLED', true),
        'size' => env('AVATAR_GRAVATAR_SIZE', 80),
        'fallback' => env('AVATAR_GRAVATAR_FALLBACK', 'mp'),
        'secure' => true,
        'max_rating' => 'g',
    ],

    /*
    |--------------------------------------------------------------------------
    | UI Avatars (Initials) Settings
    |--------------------------------------------------------------------------
    | Uses https://ui-avatars.com API for generating initials-based avatars.
    |
    */

    'initials' => [
        'enabled' => env('AVATAR_INITIALS_ENABLED', true),
        'background' => env('AVATAR_INITIALS_BG', '6366f1'),
        'color' => env('AVATAR_INITIALS_COLOR', 'ffffff'),
        'size' => 128,
        'rounded' => true,
        'bold' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | DiceBear Settings
    |--------------------------------------------------------------------------
    | Uses https://api.dicebear.com for generating unique avatars.
    | Styles: adventurer, avataaars, bottts, croodles, fun-emoji,
    |         identicon, initials, lorelei, micah, miniavs, etc.
    |
    */

    'dicebear' => [
        'enabled' => env('AVATAR_DICEBEAR_ENABLED', false),
        'style' => env('AVATAR_DICEBEAR_STYLE', 'initials'),
        'size' => 128,
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Icon
    |--------------------------------------------------------------------------
    | A generic user silhouette icon used when all providers fail.
    |
    */

    'icon' => [
        'enabled' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | CSS Framework
    |--------------------------------------------------------------------------
    */

    'css_framework' => null,

    /*
    |--------------------------------------------------------------------------
    | Component Settings
    |--------------------------------------------------------------------------
    */

    'prefix' => 'avatar',

    /*
    |--------------------------------------------------------------------------
    | Routes
    |--------------------------------------------------------------------------
    */

    'routes' => [
        'enabled' => true,
        'prefix' => 'avatar',
        'middleware' => ['web', 'auth'],
    ],

];
