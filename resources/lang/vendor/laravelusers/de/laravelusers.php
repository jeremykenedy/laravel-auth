<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel Users Blades Language Lines
    |--------------------------------------------------------------------------
    */

    'showing-all-users'     => 'Alle Benutzer',
    'users-menu-alt'        => 'Benutzerverwaltung anzeigen',
    'create-new-user'       => 'Neuen Benutzer anlegen',
    'show-deleted-users'    => 'Gelöschte Benutzer anzeigen',
    'editing-user'          => 'Bearbeite Benutzer :name',
    'showing-user'          => 'Zeige Nutzer :name',
    'showing-user-title'    => ':name\'s Information',

    'users-table' => [
        'caption'   => '{1} :userscount Benutzer insgesamt|[2,*] :userscount Benutzer insgesamt',
        'id'        => 'ID',
        'name'      => 'Name',
        'email'     => 'E-Mail',
        'role'      => 'Rolle',
        'created'   => 'Erstellt',
        'updated'   => 'Aktualisiert',
        'actions'   => 'Aktionen',
    ],

    'buttons' => [
        'create-new'    => '<span class="hidden-xs hidden-sm">Neuer Benutzer</span>',
        'delete'        => '<i class="far fa-trash-alt fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Löschen</span>',
        'show'          => '<i class="fas fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Anzeigen</span>',
        'edit'          => '<i class="fas fa-pencil-alt fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Bearbeiten</span>',
        'back-to-users' => '<span class="hidden-sm hidden-xs">Zurück zur </span><span class="hidden-xs">Benutzerliste</span>',
        'back-to-user'  => 'Zurück zum <span class="hidden-xs">Benutzer</span>',
        'delete-user'   => '<i class="far fa-trash-alt fa-fw" aria-hidden="true"></i>  <span class="hidden-xs">Löschen</span>',
        'edit-user'     => '<i class="fas fa-pencil-alt fa-fw" aria-hidden="true"></i> <span class="hidden-xs">Bearbeiten</span>',
    ],

    'tooltips' => [
        'delete'        => 'Löschen',
        'show'          => 'Anzeigen',
        'edit'          => 'Bearbeiten',
        'create-new'    => 'Neuen Benutzer anlegen',
        'back-user'     => 'Zurück zum Benutzer',
        'back-users'    => 'Zurück zur Benutzerliste',
        'email-user'    => 'E-Mail :user',
        'submit-search' => 'Suchen',
        'clear-search'  => 'Suche zurücksetzen',
    ],

    'messages' => [
        'userNameTaken'          => 'Benutzername ist bereits vergeben',
        'userNameRequired'       => 'Benutzername ist ein Pflichtfeld',
        'fNameRequired'          => 'Vorname ist ein Pflichtfeld',
        'lNameRequired'          => 'Nachname ist ein Pflichtfeld',
        'emailRequired'          => 'E-Mail ist ein Pflichtfeld',
        'emailInvalid'           => 'E-Mail is invalid',
        'passwordRequired'       => 'Passwort ist ein Pflichtfeld',
        'PasswordMin'            => 'Das Passwort muss mindestens 6 Zeichen lang sein',
        'PasswordMax'            => 'Das Passwort darf maximal 20 Zeichen lang sein',
        'captchaRequire'         => 'Captcha ist ein Pflichtfeld',
        'CaptchaWrong'           => 'Captcha falsch, bitte noch einmal versuchen',
        'roleRequired'           => 'Benutzerrolle ist ein Pflichtfeld',
        'user-creation-success'  => 'Benutzer erfolgreich angelegt!',
        'update-user-success'    => 'Benutzer erfolgreich aktualisiert!',
        'delete-success'         => 'Benutzer erfolgreich gelöscht!',
        'cannot-delete-yourself' => 'Du kannst dich nicht selbst löschen.',
    ],

    'show-user' => [
        'id'                => 'Benutzer ID',
        'name'              => 'Benutzername',
        'email'             => '<span class="hidden-xs">User </span>Email',
        'role'              => 'Benutzerrolle',
        'created'           => 'Angelegt <span class="hidden-xs">am</span>',
        'updated'           => 'Aktualisiert <span class="hidden-xs">am</span>',
        'labelRole'         => 'Benutzerrolle',
        'labelAccessLevel'  => '<span class="hidden-xs">Benutzer</span> Stufe|<span class="hidden-xs">Benutzer</span> Stufe',
    ],

    'search'  => [
        'title'         => 'Zeige Suchergebnisse',
        'found-footer'  => ' Treffer gefunden',
        'no-results'    => 'Keine Treffer',
    ],
];
