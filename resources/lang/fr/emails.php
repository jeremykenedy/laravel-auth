<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Emails Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used for various emails that
    | we need to display to the user. You are free to modify these
    | language lines according to your application's requirements.
    |
    */

    /*
     * Activate new user account email.
     *
     */

    'activationSubject'  => 'Activation requise !',
    'activationGreeting' => 'Bienvenue',
    'activationMessage'  => 'Vous devez valider adresse mail avant de pouvoir utiliser nos services.',
    'activationButton'   => 'Valider !',
    'activationThanks'   => 'Merci d\'utiliser notre site Internet.',

    /*
     * Goobye email.
     *
     */
    'goodbyeSubject'  => 'Désolé de vous voir partir...',
    'goodbyeGreeting' => 'Bonjour :username,',
    'goodbyeMessage'  => 'Nous vous confirmons la suppression de votre compte.'.
                           'Nous sommes désolés de vous voir partir.'.
                           'Merci pour le temps que nous avons passé ensemble.'.
                           'Vous pouvez récupérer votre compte dans les '.config('settings.restoreUserCutoff').' jours à venir.',
    'goodbyeButton' => 'Récupérer votre compte',
    'goodbyeThanks' => 'Nous espérons vous revoir bientôt.',

];
