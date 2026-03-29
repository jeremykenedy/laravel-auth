<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Language Lines - Global
    |--------------------------------------------------------------------------
    */
    'userTypes' => [
        'guest'      => 'Anonyme',
        'registered' => 'Membre',
        'crawler'    => 'Robot', //extracteur
    ],

    'verbTypes' => [
        'created'    => 'Créé',
        'edited'     => 'Édition',
        'deleted'    => 'Supprimé',
        'viewed'     => 'Vu',
        'crawled'    => 'Visité', //trainé
    ],

    'tooltips' => [
        'viewRecord' => 'Voir les détails de cet Enregistrement',
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Admin Dashboard Language Lines
    |--------------------------------------------------------------------------
    */
    'dashboard' => [
        'title'     => 'Journal des Activités',
        'subtitle'  => 'Événements',
        'labels'    => [
            'id'            => 'Événement Id',
            'time'          => 'Temps',
            'description'   => 'Description',
            'user'          => 'Utilisateur',
            'method'        => 'Méthode',
            'route'         => 'Route',
            'ipAddress'     => '<span class="hidden-sm hidden-xs">Adresse </span>Ip',
            'agent'         => 'Agent<span class="hidden-sm hidden-xs"> Utilisateur</span>',
            'deleteDate'    => 'Supprimé<span class="hidden-sm hidden-xs"> le</span> ',
        ],

        'menu'      => [
            'alt'           => 'Menu du Journal des Activités',
            'clear'         => 'Éffacer le jounal',
            'show'          => 'Afficher les journaux effacés',
            'back'          => 'Retour au Journal des Activités',
        ],

        'search'    => [
            'all'           => 'Tous',
            'search'        => 'Chercher',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Admin Drilldown Language Lines
    |--------------------------------------------------------------------------
    */

    'drilldown' => [
        'title'                 => 'Activité',
        'title-details'         => 'Détails',
        'title-ip-details'      => 'Adresse Ip',
        'title-user-details'    => 'Utilisateur',
        'title-user-activity'   => 'Activité Utilisateur supplémentaire',
        'buttons'               => [
            'back'      => '<span class="hidden-xs hidden-sm">Retour au </span><span class="hidden-xs"> Journal des Activitées</span>',
        ],

        'labels' => [
            'userRoles'      => 'Rôles',
            'userNiveau'     => 'Niveau',
        ],

        'list-group' => [
            'labels'    => [
                'id'            => 'Activité Id :',
                'ip'            => 'Adresse Ip',
                'description'   => 'Description',
                'details'       => 'Détails',
                'userType'      => 'Type Utilisateur',
                'userId'        => 'Id Utilisateur',
                'route'         => 'Route',
                'agent'         => 'Agent utilisateur',
                'locale'        => 'Lieu',
                'referer'       => 'Référant',

                'methodType'    => 'Type de méthode',
                'createdAt'     => 'Événement', //Event Time
                'updatedAt'     => 'Actualisé le',
                'deletedAt'     => 'Éffacé le',
                'timePassed'    => 'Temps écoulé',
                'userName'      => 'Pseudonyme',
                'userFirstName' => 'Prénom',
                'userLastName'  => 'Nom de famille',
                'userFulltName' => 'Nom complet',
                'userEmail'     => 'Courriel',
                'userSignupIp'  => 'Inscription Ip',
                'userCreatedAt' => 'Créé le',
                'userUpdatedAt' => 'Actualisé le',
            ],

            'fields' => [
                'none' => 'Aucun',
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
            'btnCancel'     => 'Annuler',
            'btnConfirm'    => 'Confirmer',
        ],
        'clearLog' => [
            'title'     => 'Effacer le Journal des Activités',
            'message'   => 'Êtes-vous sûr de vouloir effacer le journal des activités ?',
        ],
        'deleteLog' => [
            'title'     => 'Supprimer définitivement le journal des activités',
            'message'   => 'Êtes-vous sûr de vouloir SUPPRIMER de façon permanente le journal des activités ?',
        ],
        'restoreLog' => [
            'title'     => 'Restaurer le journal des activités effacé',
            'message'   => 'Êtes-vous sûr de vouloir restaurer le journal des activités effacés ?',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Flash Messages
    |--------------------------------------------------------------------------
    */

    'messages' => [
        'logClearedSuccessfuly'   => 'Activité effacé avec succès',
        'logDestroyedSuccessfuly' => 'Activité supprimé avec succès',
        'logRestoredSuccessfuly'  => 'Activité restauré avec succès',
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Cleared Dashboard Language Lines
    |--------------------------------------------------------------------------
    */

    'dashboardCleared' => [
        'title'     => 'Journal des activités effacées',
        'subtitle'  => 'Événements effacés',

        'menu'      => [
            'deleteAll'  => 'Supprimer tous les Journaux des activitéss',
            'restoreAll' => 'Restaurer tous les journaux des activités',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Pagination Language Lines
    |--------------------------------------------------------------------------
    */
    'pagination' => [
        'countText' => 'Affichage de :firstItem - :lastItem sur :total resultats <small>(:perPage par page)</small>',
    ],

];
