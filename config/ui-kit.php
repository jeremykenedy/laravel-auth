<?php

return [

    /*
    |--------------------------------------------------------------------------
    | CSS Framework
    |--------------------------------------------------------------------------
    |
    | The CSS framework to use for rendering components.
    | Supported: "tailwind", "bootstrap5", "bootstrap4"
    |
    */

    'css_framework' => env('UI_KIT_CSS', 'tailwind'),

    /*
    |--------------------------------------------------------------------------
    | Frontend Framework
    |--------------------------------------------------------------------------
    |
    | The frontend JavaScript framework to use for interactive components.
    | Supported: "blade", "vue", "react", "svelte"
    |
    */

    'frontend' => env('UI_KIT_FRONTEND', 'blade'),

    /*
    |--------------------------------------------------------------------------
    | Component Prefix
    |--------------------------------------------------------------------------
    |
    | The prefix used for Blade components. With the default "ui" prefix,
    | components are rendered as <x-ui::button>, <x-ui::card>, etc.
    |
    */

    'prefix' => env('UI_KIT_PREFIX', 'ui'),

    /*
    |--------------------------------------------------------------------------
    | Icon Set
    |--------------------------------------------------------------------------
    |
    | The icon set to use for icon components and icon references.
    | Supported: "lucide", "heroicons", "fontawesome"
    |
    */

    'icons' => env('UI_KIT_ICONS', 'lucide'),

    /*
    |--------------------------------------------------------------------------
    | Dark Mode
    |--------------------------------------------------------------------------
    */

    'dark_mode' => [
        'enabled' => env('UI_KIT_DARK_MODE', true),
        'default' => env('UI_KIT_DARK_MODE_DEFAULT', 'system'),
        'toggle' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Confirmation Modals
    |--------------------------------------------------------------------------
    */

    'confirm' => [
        'default_title' => 'Confirm Action',
        'default_message' => 'Are you sure you want to proceed?',
        'cancel_text' => 'Cancel',
        'confirm_text' => 'Confirm',
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Input
    |--------------------------------------------------------------------------
    */

    'password' => [
        'strength_meter' => true,
        'show_hide' => true,
        'min_length' => 8,
        'messages' => [
            'short' => 'Too short',
            'weak' => 'Weak',
            'medium' => 'Medium',
            'strong' => 'Strong',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | DataTable Defaults
    |--------------------------------------------------------------------------
    */

    'datatable' => [
        'per_page' => 25,
        'searchable' => true,
        'sortable' => true,
        'exportable' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Toast Defaults
    |--------------------------------------------------------------------------
    */

    'toast' => [
        'position' => 'top-right',
        'duration' => 5000,
        'max_visible' => 5,
    ],

];
