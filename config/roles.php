<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Package Connection
    |--------------------------------------------------------------------------
    |
    | You can set a different database connection for this package. It will set
    | new connection for models Role and Permission. When this option is null,
    | it will connect to the main database, which is set up in database.php
    |
    */

    'connection'            => env('ROLES_DATABASE_CONNECTION', null),
    'rolesTable'            => env('ROLES_ROLES_DATABASE_TABLE', 'roles'),
    'roleUserTable'         => env('ROLES_ROLE_USER_DATABASE_TABLE', 'role_user'),
    'permissionsTable'      => env('ROLES_PERMISSIONS_DATABASE_TABLE', 'permissions'),
    'permissionsRoleTable'  => env('ROLES_PERMISSION_ROLE_DATABASE_TABLE', 'permission_role'),
    'permissionsUserTable'  => env('ROLES_PERMISSION_USER_DATABASE_TABLE', 'permission_user'),

    /*
    |--------------------------------------------------------------------------
    | Slug Separator
    |--------------------------------------------------------------------------
    |
    | Here you can change the slug separator. This is very important in matter
    | of magic method __call() and also a `Slugable` trait. The default value
    | is a dot.
    |
    */

    'separator' => env('ROLES_DEFAULT_SEPARATOR', '.'),

    /*
    |--------------------------------------------------------------------------
    | Models
    |--------------------------------------------------------------------------
    |
    | If you want, you can replace default models from this package by models
    | you created. Have a look at `jeremykenedy\LaravelRoles\Models\Role` model and
    | `jeremykenedy\LaravelRoles\Models\Permission` model.
    |
    */

    'models' => [
        'role'          => env('ROLES_DEFAULT_ROLE_MODEL', jeremykenedy\LaravelRoles\Models\Role::class),
        'permission'    => env('ROLES_DEFAULT_PERMISSION_MODEL', jeremykenedy\LaravelRoles\Models\Permission::class),
        'defaultUser'   => env('ROLES_DEFAULT_USER_MODEL', config('auth.providers.users.model')),
    ],

    /*
    |--------------------------------------------------------------------------
    | Roles, Permissions and Allowed "Pretend"
    |--------------------------------------------------------------------------
    |
    | You can pretend or simulate package behavior no matter what is in your
    | database. It is really useful when you are testing you application.
    | Set up what will methods hasRole(), hasPermission() and allowed() return.
    |
    */

    'pretend' => [
        'enabled' => false,
        'options' => [
            'hasRole'       => true,
            'hasPermission' => true,
            'allowed'       => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Seeds
    |--------------------------------------------------------------------------
    |
    | These are the default package seeds. You can seed the package built
    | in seeds without having to seed them. These seed directly from
    | the package. These are not the published seeds.
    |
    */

    'defaultSeeds' => [
        'PermissionsTableSeeder'        => env('ROLES_SEED_DEFAULT_PERMISSIONS', true),
        'RolesTableSeeder'              => env('ROLES_SEED_DEFAULT_ROLES', true),
        'ConnectRelationshipsSeeder'    => env('ROLES_SEED_DEFAULT_RELATIONSHIPS', true),
        'UsersTableSeeder'              => env('ROLES_SEED_DEFAULT_USERS', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Roles GUI Settings
    |--------------------------------------------------------------------------
    |
    | This is the GUI for Laravel Roles to be able to CRUD them
    | easily and fast. This is optional and is not needed
    | for your application.
    |
    */

    // Enable Optional Roles Gui
    'rolesGuiEnabled'               => env('ROLES_GUI_ENABLED', false),

    // Enable `auth` middleware
    'rolesGuiAuthEnabled'           => env('ROLES_GUI_AUTH_ENABLED', true),

    // Enable Roles GUI middleware
    'rolesGuiMiddlewareEnabled'     => env('ROLES_GUI_MIDDLEWARE_ENABLED', true),

    // Optional Roles GUI Middleware
    'rolesGuiMiddleware'            => env('ROLES_GUI_MIDDLEWARE', 'role:admin'),

    // User Permissions or Role needed to create a new role
    'rolesGuiCreateNewRolesMiddlewareType'   => env('ROLES_GUI_CREATE_ROLE_MIDDLEWARE_TYPE', 'role'), //permissions or roles
    'rolesGuiCreateNewRolesMiddleware'       => env('ROLES_GUI_CREATE_ROLE_MIDDLEWARE_TYPE', 'admin'), // admin, XXX. ... or perms.XXX

    // User Permissions or Role needed to create a new permission
    'rolesGuiCreateNewPermissionMiddlewareType'  => env('ROLES_GUI_CREATE_PERMISSION_MIDDLEWARE_TYPE', 'role'), //permissions or roles
    'rolesGuiCreateNewPermissionsMiddleware'     => env('ROLES_GUI_CREATE_PERMISSION_MIDDLEWARE_TYPE', 'admin'), // admin, XXX. ... or perms.XXX

    // The parent blade file
    'bladeExtended'                 => env('ROLES_GUI_BLADE_EXTENDED', 'layouts.app'),

    // Blade Extension Placement
    'bladePlacement'                => env('ROLES_GUI_BLADE_PLACEMENT', 'yield'),
    'bladePlacementCss'             => env('ROLES_GUI_BLADE_PLACEMENT_CSS', 'inline_template_linked_css'),
    'bladePlacementJs'              => env('ROLES_GUI_BLADE_PLACEMENT_JS', 'inline_footer_scripts'),

    // Titles placement extend
    'titleExtended'                 => env('ROLES_GUI_TITLE_EXTENDED', 'template_title'),

    // Switch Between bootstrap 3 `panel` and bootstrap 4 `card` classes
    'bootstapVersion'               => env('ROLES_GUI_BOOTSTRAP_VERSION', '4'),

    // Additional Card classes for styling -
    // See: https://getbootstrap.com/docs/4.0/components/card/#background-and-color
    // Example classes: 'text-white bg-primary mb-3'
    'bootstrapCardClasses'          => env('ROLES_GUI_CARD_CLASSES', ''),

    // Bootstrap Tooltips
    'tooltipsEnabled'               => env('ROLES_GUI_TOOLTIPS_ENABLED', true),

    // jQuery
    'enablejQueryCDN'               => env('ROLES_GUI_JQUERY_CDN_ENABLED', true),
    'JQueryCDN'                     => env('ROLES_GUI_JQUERY_CDN_URL', 'https://code.jquery.com/jquery-3.3.1.min.js'),

    // Selectize JS
    'enableSelectizeJsCDN'          => env('ROLES_GUI_SELECTIZEJS_CDN_ENABLED', true),
    'SelectizeJsCDN'                => env('ROLES_GUI_SELECTIZEJS_CDN_URL', 'https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js'),
    'enableSelectizeJs'             => env('ROLES_GUI_SELECTIZEJS_ENABLED', true),
    'enableSelectizeJsCssCDN'       => env('ROLES_GUI_SELECTIZEJS_CSS_CDN_ENABLED', true),
    'SelectizeJsCssCDN'             => env('ROLES_GUI_SELECTIZEJS_CSS_CDN_URL', 'https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.min.css'),

    // Font Awesome
    'enableFontAwesomeCDN'          => env('ROLES_GUI_FONT_AWESOME_CDN_ENABLED', true),
    'fontAwesomeCDN'                => env('ROLES_GUI_FONT_AWESOME_CDN_URL', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'),

    // Flash Messaging
    'builtInFlashMessagesEnabled'   => env('ROLES_GUI_FLASH_MESSAGES_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Laravel Roles API Settings
    |--------------------------------------------------------------------------
    |
    | This is the API for Laravel Roles to be able to CRUD them
    | easily and fast via an API. This is optional and is
    | not needed for your application.
    |
    */
    'rolesApiEnabled'               => env('ROLES_API_ENABLED', false),

    // Enable `auth` middleware
    'rolesAPIAuthEnabled'           => env('ROLES_API_AUTH_ENABLED', true),

    // Enable Roles API middleware
    'rolesAPIMiddlewareEnabled'     => env('ROLES_API_MIDDLEWARE_ENABLED', true),

    // Optional Roles API Middleware
    'rolesAPIMiddleware'            => env('ROLES_API_MIDDLEWARE', 'role:admin'),

    // User Permissions or Role needed to create a new role
    'rolesAPICreateNewRolesMiddlewareType'   => env('ROLES_API_CREATE_ROLE_MIDDLEWARE_TYPE', 'role'), //permissions or roles
    'rolesAPICreateNewRolesMiddleware'       => env('ROLES_API_CREATE_ROLE_MIDDLEWARE_TYPE', 'admin'), // admin, XXX. ... or perms.XXX

    // User Permissions or Role needed to create a new permission
    'rolesAPICreateNewPermissionMiddlewareType'  => env('ROLES_API_CREATE_PERMISSION_MIDDLEWARE_TYPE', 'role'), //permissions or roles
    'rolesAPICreateNewPermissionsMiddleware'     => env('ROLES_API_CREATE_PERMISSION_MIDDLEWARE_TYPE', 'admin'), // admin, XXX. ... or perms.XXX

    /*
    |--------------------------------------------------------------------------
    | Laravel Roles GUI Datatables Settings
    |--------------------------------------------------------------------------
    */

    'enabledDatatablesJs'           => env('ROLES_GUI_DATATABLES_JS_ENABLED', false),
    'datatablesJsStartCount'        => env('ROLES_GUI_DATATABLES_JS_START_COUNT', 25),
    'datatablesCssCDN'              => env('ROLES_GUI_DATATABLES_CSS_CDN', 'https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css'),
    'datatablesJsCDN'               => env('ROLES_GUI_DATATABLES_JS_CDN', 'https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js'),
    'datatablesJsPresetCDN'         => env('ROLES_GUI_DATATABLES_JS_PRESET_CDN', 'https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js'),

    /*
    |--------------------------------------------------------------------------
    | Laravel Roles Package Integration Settings
    |--------------------------------------------------------------------------
    */

    'laravelUsersEnabled'           => env('ROLES_GUI_LARAVEL_ROLES_ENABLED', false),
];
