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

    // Switch Between bootstrap 3 `panel` and bootstrap 4 `card` classes
    'bootstapVersion'               => '4',

    // Additional Card classes for styling -
    // See: https://getbootstrap.com/docs/4.0/components/card/#background-and-color
    // Example classes: 'text-white bg-primary mb-3'
    'bootstrapCardClasses'          => '',

    // Inline CSS
    'usePHPinfoCSS'                 => true,

];
