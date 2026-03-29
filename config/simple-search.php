<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Searchable Models
    |--------------------------------------------------------------------------
    |
    | The 'permission' key controls who can search this model type:
    |   - null: anyone authenticated can search
    |   - 'level:5': requires level 5+ (admin)
    |   - 'permission:view.users': requires specific permission
    |
    */

    'models' => [
        'users' => [
            'model' => 'App\\Models\\User',
            'columns' => ['id', 'name', 'email', 'first_name', 'last_name'],
            'with' => ['roles'],
            'permission' => 'level:5',
            'display' => [
                'title' => 'name',
                'subtitle' => 'email',
                'url' => '/users/{id}',
            ],
        ],
    ],

    'route_prefix' => 'search',

    'middleware' => ['web', 'auth'],

    'min_characters' => 2,

    'max_results' => 25,

    'debounce_ms' => 300,

];
