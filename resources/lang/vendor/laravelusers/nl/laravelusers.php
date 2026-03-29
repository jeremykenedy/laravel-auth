<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel Users Blades Language Lines
    |--------------------------------------------------------------------------
    */

    'showing-all-users'     => 'Toon Alle Gebruikers',
    'users-menu-alt'        => 'Toon Gebruikersbeheer Menu',
    'create-new-user'       => 'Nieuwe Gebruiker Aanmaken',
    'show-deleted-users'    => 'Toon Verwijderde Gebuikers',
    'editing-user'          => 'Wijzigen Gebruiker :name',
    'showing-user'          => 'Tonen Gebruiker :name',
    'showing-user-title'    => ':name\'s Informatie',

    'users-table' => [
        'caption'   => '{1} :userscount gebruiker in totaal|[2,*] :userscount gebruikers in totaal',
        'id'        => 'ID',
        'name'      => 'Naam',
        'email'     => 'Email',
        'role'      => 'Rol',
        'created'   => 'Aangemaakt',
        'updated'   => 'Gewijzigd',
        'actions'   => 'Acties',
        'updated'   => 'Gewijzigd',
    ],

    'buttons' => [
        'create-new'    => '<span class="hidden-xs hidden-sm">Nieuwe Gebruiker</span>',
        'delete'        => '<i class="far fa-trash-alt fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm hidden-md">Gebruiker </span><span class="hidden-xs hidden-sm">Verwijderen</span>',
        'show'          => '<i class="fas fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm hidden-md">Gebruiker </span><span class="hidden-xs hidden-sm">Tonen</span>',
        'edit'          => '<i class="fas fa-pencil-alt fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm hidden-md">Gebruiker </span><span class="hidden-xs hidden-sm">Wijzigen</span>',
        'back-to-users' => '<span class="hidden-sm hidden-xs">Terug naar </span><span class="hidden-xs">Gebruikers</span>',
        'back-to-user'  => 'Terug <span class="hidden-xs">naar Gebruiker</span>',
        'delete-user'   => '<i class="far fa-trash-alt fa-fw" aria-hidden="true"></i> <span class="hidden-xs">Gebruiker </span><span class="hidden-xs">Verwijderen</span>',
        'edit-user'     => '<i class="fas fa-pencil-alt fa-fw" aria-hidden="true"></i> <span class="hidden-xs">Gebruiker </span><span class="hidden-xs">Wijzigen</span>',
    ],

    'tooltips' => [
        'delete'        => 'Verwijderen',
        'show'          => 'Tonen',
        'edit'          => 'Wijzigen',
        'create-new'    => 'Nieuwe Gebruiker Aanmaken',
        'back-user'     => 'Terug naar Gebruiker',
        'back-users'    => 'Terug naar Gebruikers',
        'email-user'    => 'Email :user',
        'submit-search' => 'Zoekterm Toepassen',
        'clear-search'  => 'Zoekresultaten Wissen',
    ],

    'messages' => [
        'userNameTaken'          => 'Gebruikersnaam is in gebruik',
        'userNameRequired'       => 'Gebruikersnaam is verplicht',
        'fNameRequired'          => 'Voornaam is verplicht',
        'lNameRequired'          => 'Achternaam is verplicht',
        'emailRequired'          => 'Email is verplicht',
        'emailInvalid'           => 'Email is onjuist',
        'passwordRequired'       => 'Wachtwoord is verplicht',
        'PasswordMin'            => 'Wachtwoord moet uit ten minste 6 tekens bestaan',
        'PasswordMax'            => 'Wachtwoord mag niet langer dan 20 tekens zijn',
        'captchaRequire'         => 'Captcha is verplicht',
        'CaptchaWrong'           => 'Foute captcha, probeer het opnieuw.',
        'roleRequired'           => 'Gebruikersrol is verplicht.',
        'user-creation-success'  => 'Gebruiker succesvol aangemaakt!',
        'update-user-success'    => 'Gebruiker succesvol gewijzigd!',
        'delete-success'         => 'Gebruiker succesvol verwijderd!',
        'cannot-delete-yourself' => 'U kunt uw eigen gebruiker niet verwijderen!',
    ],

    'show-user' => [
        'id'                => 'Gebruiker ID',
        'name'              => 'Gebruikersnaam',
        'email'             => '<span class="hidden-xs">Gebruiker </span>Email',
        'role'              => 'Gebruikersrol',
        'created'           => 'Aangemaakt <span class="hidden-xs">op</span>',
        'updated'           => 'Gewijzigd <span class="hidden-xs">op</span>',
        'labelRole'         => 'Gebruikersrol',
        'labelAccessLevel'  => '<span class="hidden-xs">Gebruiker </span>Toegangsniveau|<span class="hidden-xs">Gebruiker </span>Toegangsniveaus',
    ],

    'search'  => [
        'title'         => 'Tonen Zoekresultaten',
        'found-footer'  => ' Item(s) gevonden',
        'no-results'    => 'Geen Resultaten',
    ],
];
