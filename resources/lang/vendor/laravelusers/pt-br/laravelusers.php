<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel Users Blades Language Lines
    |--------------------------------------------------------------------------
    */

    'showing-all-users'     => 'Mostrar Todos os Usuários',
    'users-menu-alt'        => 'Show Users Management Menu',
    'create-new-user'       => 'Criar Novo Usuário',
    'show-deleted-users'    => 'Mostrar Usuários Deletados',
    'editing-user'          => 'Editar Usuário :name',
    'showing-user'          => 'Mostrar Usuáriod :name',
    'showing-user-title'    => ':name\'s Informação',

    'users-table' => [
        'caption'   => '{1} :userscount user total|[2,*] :userscount Total de Usuários',
        'id'        => 'ID',
        'name'      => 'Nome',
        'email'     => 'Email',
        'role'      => 'Nivel',
        'created'   => 'Criando em:',
        'updated'   => 'Atualizado em:',
        'actions'   => 'Acões',
        'updated'   => 'Atualizado em:',
    ],

    'buttons' => [
        'create-new'    => '<span class="hidden-xs hidden-sm">Novo Usuário</span>',
        'delete'        => '<i class="far fa-trash-alt fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Apagar</span><span class="hidden-xs hidden-sm hidden-md"> Usuário</span>',
        'show'          => '<i class="fas fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Show</span><span class="hidden-xs hidden-sm hidden-md"> Usuário</span>',
        'edit'          => '<i class="fas fa-pencil-alt fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Editar</span><span class="hidden-xs hidden-sm hidden-md"> Usuário</span>',
        'back-to-users' => '<span class="hidden-sm hidden-xs">Voltar para </span><span class="hidden-xs">Usuários</span>',
        'back-to-user'  => 'Back  <span class="hidden-xs">to Usuário</span>',
        'delete-user'   => '<i class="far fa-trash-alt fa-fw" aria-hidden="true"></i>  <span class="hidden-xs">Delete</span><span class="hidden-xs"> Usuário</span>',
        'edit-user'     => '<i class="fas fa-pencil-alt fa-fw" aria-hidden="true"></i> <span class="hidden-xs">Edit</span><span class="hidden-xs"> Usuário</span>',
    ],

    'tooltips' => [
        'delete'        => 'Deletar',
        'show'          => 'Mostrar',
        'edit'          => 'Editar',
        'create-new'    => 'Criar Novo Usuário',
        'back-user'     => 'Voltar para Usuário',
        'back-users'    => 'Voltar para Usuários',
        'email-user'    => 'Email :user',
        'submit-search' => 'Buscar Usuários',
        'clear-search'  => 'Limpar Resultados',
    ],

    'messages' => [
        'userNameTaken'          => 'Apelido já existe',
        'userNameRequired'       => 'Username é Obrigatório',
        'fNameRequired'          => 'Nome é Obrigatório ',
        'lNameRequired'          => 'Sobrenome é Obrigatório',
        'emailRequired'          => 'Email é Obrigatório',
        'emailInvalid'           => 'Email é inválido',
        'passwordRequired'       => 'Senha é Obrigatório',
        'PasswordMin'            => 'Senha com no minímo 6 caracteres',
        'PasswordMax'            => 'Senha com tamanho maxímo de 20 caracteres',
        'captchaRequire'         => 'Captcha é Obrigatório',
        'CaptchaWrong'           => 'Captcha inválido, Por favor tente novamente.',
        'roleRequired'           => 'Nível de Usuário é Obrigatório.',
        'user-creation-success'  => 'Sucesso usuário criado created user!',
        'update-user-success'    => 'Sucesso usuário atualizado!',
        'delete-success'         => 'Sucesso usuário deletado  !',
        'cannot-delete-yourself' => 'Você não pode se apagar!',
    ],

    'show-user' => [
        'id'                => 'User ID',
        'name'              => 'Username',
        'email'             => '<span class="hidden-xs">Usuário </span>Email',
        'role'              => 'Nível de Acesso',
        'created'           => 'Criado <span class="hidden-xs">em</span>',
        'updated'           => 'Atualizado <span class="hidden-xs">em</span>',
        'labelRole'         => 'Tipo de Usuário',
        'labelAccessLevel'  => '<span class="hidden-xs">User</span> Nível de Acesso|<span class="hidden-xs">User</span> Níveis de Acesso',
    ],

    'search'  => [
        'title'         => 'Mostrar Resultados da Pesquisa',
        'found-footer'  => ' Registro(s) encontrado(s)',
        'no-results'    => 'Não a Resultados',
    ],
];
