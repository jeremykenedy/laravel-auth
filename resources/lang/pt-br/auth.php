<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed'   => 'Suas credencias não correspodem!',
    'throttle' => 'Muitas tentativas de Login. Por favor espere alguns segundos.',

    // Activation items
    'sentEmail'        => 'Enviamos um email para: ',
    'clickInEmail'     => 'Por favor clique no link para a ativação de sua conta.',
    'anEmailWasSent'   => 'Um email foi enviado para :email na :data.',
    'clickHereResend'  => 'Clique aqui para reenviar o email.',
    'successActivated' => 'Sua conta foi ativada com sucesso.',
    'unsuccessful'     => 'Sua conta não foi ativada; Por favor tente novamente.',
    'notCreated'       => 'Sua conta não foi criada; Por favor tente novamente.',
    'tooManyEmails'    => 'Muitos emails de ativação foram enviados para :email. <br />Tente novamente em <span class="label label-danger">:hours hours</span>.',
    'regThanks'        => 'Muito obrigado por se registrar, ',
    'invalidToken'     => 'A ativação do token não e valida. ',
    'activationSent'   => 'A ativação do email foi enviada. ',
    'alreadyActivated' => 'Já ativado. ',

    // Labels
    'whoops'          => 'Ops! ',
    'someProblems'    => 'Houve um problema (s) com sua (s) entrada (s)',
    'email'           => 'Endereço de email:',
    'password'        => 'Senha',
    'rememberMe'      => ' Lembre-me',
    'login'           => 'Login',
    'forgot'          => 'Esqueceu sua senha?',
    'forgot_message'  => 'Problemas com sua senha',
    'name'            => 'Nome do usuário',
    'first_name'      => 'Nome',
    'last_name'       => 'Sobrenome',
    'confirmPassword' => 'Confirme sua senha',
    'register'        => 'Registrar',

    // Placeholders
    'ph_name'          => 'Nome do usuário',
    'ph_email'         => 'Endereço de email',
    'ph_firstname'     => 'Nome',
    'ph_lastname'      => 'Sobrenome',
    'ph_password'      => 'Senha',
    'ph_password_conf' => 'Confirme sua senha',

    // User flash messages
    'sendResetLink' => 'Enviado o link para a redefinição de senha',
    'resetPassword' => 'Sua senha foi redefinida',
    'loggedIn'      => 'Você está logado!',

    // email links
    'pleaseActivate'    => 'Por favor ative sua conta.',
    'clickHereReset'    => 'Clique no link para redefinir sua senha: ',
    'clickHereActivate' => 'Clique no link para ativar sua conta: ',

    // Validators
    'userNameTaken'    => 'Nome do usuário não está disponível',
    'userNameRequired' => 'Nome do usuário é um campo obrigatório',
    'fNameRequired'    => 'Nome é um campo obrigatório',
    'lNameRequired'    => 'Sobrenome é um campo obrigatório',
    'emailRequired'    => 'Email é um campo obrigatório',
    'emailInvalid'     => 'Email é inválido',
    'passwordRequired' => 'Senha é um campo obrigatório',
    'PasswordMin'      => 'Senha deve ter pelo menos 6 caracteres',
    'PasswordMax'      => 'Senha deve ter um tamanho maximo de 20 caracteres',
    'captchaRequire'   => 'Captcha é obrigatório',
    'CaptchaWrong'     => 'Erro captcha, Por favor tente novamente.',
    'roleRequired'     => 'O campo usuário e obrigatória',

];
