<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Language Lines - Global
    |--------------------------------------------------------------------------
    */
    'userTypes' => [
        'guest'      => 'Gast',
        'registered' => 'Registriert',
        'crawler'    => 'Suchmaschine',
    ],

    'verbTypes' => [
        'created'    => 'Erstellt',
        'edited'     => 'Bearbeitet',
        'deleted'    => 'Gelöscht',
        'viewed'     => 'Angesehen',
        'crawled'    => 'Gesucht (Crwaler)',
    ],

    'tooltips' => [
        'viewRecord' => 'Details anzeigen',
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Admin Dashboard Language Lines
    |--------------------------------------------------------------------------
    */
    'dashboard' => [
        'title'     => 'Aktivitätslog',
        'subtitle'  => 'Ereignisse',

        'labels'    => [
            'id'            => 'ID',
            'time'          => 'Zeit',
            'description'   => 'Beschreibung',
            'user'          => 'Nutzer',
            'method'        => 'Methode',
            'route'         => 'Route',
            'ipAddress'     => 'IP <span class="hidden-sm hidden-xs">Adresse</span>',
            'agent'         => '<span class="hidden-sm hidden-xs">User </span>Agent',
            'deleteDate'    => 'Deleted <span class="hidden-sm hidden-xs">am</span>',
        ],

        'menu'      => [
            'alt'           => 'Aktivitätslog Menü',
            'clear'         => 'Lösche Aktivitätslog',
            'show'          => 'Zeige gelöschte Logs',
            'back'          => 'Zurück zum Log',
        ],

        'search'    => [
            'all'           => 'All',
            'search'        => 'Suche',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Admin Drilldown Language Lines
    |--------------------------------------------------------------------------
    */

    'drilldown' => [
        'title'                 => 'Aktivitätslog :id',
        'title-details'         => 'Aktivitätsdetails',
        'title-ip-details'      => 'IP Informationen',
        'title-user-details'    => 'Nutzer Informationen',
        'title-user-activity'   => 'Nutzer Aktivität',

        'buttons'   => [
            'back'      => '<span class="hidden-xs hidden-sm">Zurück zum </span><span class="hidden-xs">Aktivitätslog</span>',
        ],

        'labels' => [
            'userRoles'     => 'Nutzerrolle',
            'userLevel'     => 'Level',
        ],

        'list-group' => [
            'labels'    => [
                'id'            => 'Aktivitätslog ID:',
                'ip'            => 'IP Adresse',
                'description'   => 'Beschreibung',
                'details'       => 'Einzelheiten',
                'userType'      => 'Nutzertyp',
                'userId'        => 'Nutzer ID',
                'route'         => 'Route',
                'agent'         => 'User Agent',
                'locale'        => 'Sprache',
                'referer'       => 'Referer (Ursprung)',

                'methodType'    => 'Methoden Typus',
                'createdAt'     => 'Ereignisausführung',
                'updatedAt'     => 'Bearbeitet am',
                'deletedAt'     => 'Gelöscht am',
                'timePassed'    => 'Letzte Aktivität',
                'userName'      => 'Nutzer',
                'userFirstName' => 'Vorname',
                'userLastName'  => 'Nachname',
                'userFulltName' => 'Name',
                'userEmail'     => 'Email',
                'userSignupIp'  => 'Anmelde Ip',
                'userCreatedAt' => 'Erstellt',
                'userUpdatedAt' => 'Bearbeitet',
            ],

            'fields' => [
                'none' => 'Keiner',
            ],
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Modals
    |--------------------------------------------------------------------------
    */

    'modals' => [
        'shared' => [
            'btnCancel'     => 'Abbrechen',
            'btnConfirm'    => 'Bestätigen',
        ],
        'clearLog' => [
            'title'     => 'Lösche Aktivitätslog',
            'message'   => 'Sind Sie sicher, dass Sie das Aktivitätslog löschen möchten?',
        ],
        'deleteLog' => [
            'title'     => 'Unwiederbringliches Löschen des Aktivitätslogs',
            'message'   => 'Sind Sie sicher, dass Sie das Aktivitätslog löschen möchten?',
        ],
        'restoreLog' => [
            'title'     => 'Wiederherstellen des Aktivitätslogs',
            'message'   => 'Sind Sie sicher, dass Sie das Aktivitätslog wiederherstellen möchten?',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Flash Messages
    |--------------------------------------------------------------------------
    */

    'messages' => [
        'logClearedSuccessfuly'   => 'Aktivitätslog erfolgreich geleert',
        'logDestroyedSuccessfuly' => 'Aktivitätslog erfolgreich gelöscht',
        'logRestoredSuccessfuly'  => 'Aktivitätslog erfolgreich wiederhergestellt',
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Cleared Dashboard Language Lines
    |--------------------------------------------------------------------------
    */

    'dashboardCleared' => [
        'title'     => 'Gelöschte Aktivitäten',
        'subtitle'  => 'Gelöschte Ereignisse',

        'menu'      => [
            'deleteAll'  => 'Lösche alle Aktivitäten',
            'restoreAll' => 'Aktivitäten wiederherstellen',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Pagination Language Lines
    |--------------------------------------------------------------------------
    */
    'pagination' => [
        'countText' => 'Zeige :firstItem - :lastItem von :total Einträgen <small>(:perPage je Seite)</small>',
    ],

];
