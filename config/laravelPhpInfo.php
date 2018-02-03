<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel PHP Info settings
    |--------------------------------------------------------------------------
    */

    // The parent blade file
    'laravelPhpInfoBladeExtended'   => 'layouts.app',

    // Enable `auth` middleware
    'authEnabled'                   => true,

    // Enable Optional Roles Middleware
    'rolesEnabled'                  => true,

    // Optional Roles Middleware
    'rolesMiddlware'                => ['activated', 'role:admin', 'activity', 'twostep'],

];
