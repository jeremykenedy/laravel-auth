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

    'activationSubject'  => 'Ativação obrigatória',
    'activationGreeting' => 'Bem-vindo!',
    'activationMessage'  => 'Você precisa ativar o seu email para poder usufluir de todos os novos serviços',
    'activationButton'   => 'Ativado',
    'activationThanks'   => 'Obrigado por utilizar nosso sistema',

    /*
     * Goobye email.
     *
     */
    'goodbyeSubject'  => 'Lamentamos você ir',
    'goodbyeGreeting' => 'Olá :username,',
    'goodbyeMessage'  => 'Lamentamos ver você ir. Sua conta foi excluída. Agradecemos o tempo que compartilhamos '.config('settings.restoreUserCutoff').' alguns dias para restaurar sua conta.',
    'goodbyeButton'   => 'Sua conta foi recuperada!',
    'goodbyeThanks'   => 'Esperamos vê-lo novamente!',

];
