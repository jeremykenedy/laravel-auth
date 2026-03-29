<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Language Lines - Global
    |--------------------------------------------------------------------------
    */
    'userTypes' => [
        'guest'      => 'Não-registrado',
        'registered' => 'Registrado',
        'crawler'    => 'Rastreador',
    ],

    'verbTypes' => [
        'created'    => 'Criou',
        'edited'     => 'Editou',
        'deleted'    => 'Excluiu',
        'viewed'     => 'Visualizou',
        'crawled'    => 'Rastreou',
    ],

    'listenerTypes' => [
        'auth'       => 'Ação de Autenticação',
        'attempt'    => 'Tentativa de Autenticação',
        'failed'     => 'Falhou na Tentativa de Login',
        'lockout'    => 'Bloqueado',
        'reset'      => 'Redefiniu Senha',
        'login'      => 'Acessou o sistema',
        'logout'     => 'Saiu do sistema',
    ],

    'tooltips' => [
        'viewRecord' => 'Ver Detalhes do Registro',
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Admin Dashboard Language Lines
    |--------------------------------------------------------------------------
    */
    'dashboard' => [
        'title'     => 'Registro de Ações',
        'subtitle'  => 'Eventos',

        'labels'    => [
            'id'            => 'Id',
            'time'          => 'Tempo',
            'description'   => 'Descrição',
            'user'          => 'Usuário',
            'method'        => 'Método HTTP',
            'route'         => 'Rota',
            'ipAddress'     => 'Endereço <span class="hidden-sm hidden-xs">IP</span>',
            'agent'         => '<span class="hidden-sm hidden-xs">Agente de </span>Usuário',
            'deleteDate'    => '<span class="hidden-sm hidden-xs">Data de </span>Exclusão',
        ],

        'menu'      => [
            'alt'           => 'Menu do Registro de Ações',
            'clear'         => 'Remover Registros de Ações',
            'show'          => 'Mostrar Registros Removidos',
            'back'          => 'Voltar para o Registro de Ações',
        ],

        'search'    => [
            'all'           => 'Todos',
            'search'        => 'Pesquisar',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Admin Drilldown Language Lines
    |--------------------------------------------------------------------------
    */

    'drilldown' => [
        'title'                 => 'Registro de Ações :id',
        'title-details'         => 'Detalhes de Ações',
        'title-ip-details'      => 'Detalhes de Endereço de IP',
        'title-user-details'    => 'Detalhes de Usuário',
        'title-user-activity'   => 'Ações Adicionais de Usuário',

        'buttons'   => [
            'back'      => '<span class="hidden-xs hidden-sm">Voltar para </span><span class="hidden-xs">Registro de Ações</span>',
        ],

        'labels' => [
            'userRoles'     => 'Funções de Usuário',
            'userLevel'     => 'Nível',
        ],

        'list-group' => [
            'labels'    => [
                'id'            => 'Registro de Ações ID:',
                'ip'            => 'Endereço IP',
                'description'   => 'Descrição',
                'details'       => 'Detalhes',
                'userType'      => 'Tipo de Usuário',
                'userId'        => 'Id de Usuário',
                'route'         => 'Rota',
                'agent'         => 'Agente de Usuário',
                'locale'        => 'Local',
                'referer'       => 'Referenciador',

                'methodType'    => 'Tipo de Método',
                'createdAt'     => 'Criado Em',
                'updatedAt'     => 'Atualizado Em',
                'deletedAt'     => 'Excluído Em',
                'timePassed'    => 'Tempo passado',
                'userName'      => 'Nome de Usuário',
                'userFirstName' => 'Primeiro Nome',
                'userLastName'  => 'Sobrenome',
                'userFulltName' => 'Nome Completo',
                'userEmail'     => 'Email de Usuário',
                'userSignupIp'  => 'Ip de Inscrição',
                'userCreatedAt' => 'Criado',
                'userUpdatedAt' => 'Atualizado',
            ],

            'fields' => [
                'none' => 'Nenhum',
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
            'btnCancel'     => 'Cancelar',
            'btnConfirm'    => 'Confirmar',
        ],
        'clearLog' => [
            'title'     => 'Remover registros de Ações',
            'message'   => 'Você tem certeza que deseja remover os registros de ações?',
        ],
        'deleteLog' => [
            'title'     => 'Excluir permanentemente o Registro de Ações',
            'message'   => 'Você tem certeza que deseja EXCLUIR PERMANENTEMENTE o registro de ações?',
        ],
        'restoreLog' => [
            'title'     => 'Restaurar registros de ações removidos',
            'message'   => 'Você tem certeza que deseja restaurar os registros de ações removidos?',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Flash Messages
    |--------------------------------------------------------------------------
    */

    'messages' => [
        'logClearedSuccessfuly'   => 'Registros de ações removidos com sucesso',
        'logDestroyedSuccessfuly' => 'Registros de ações excluídos com sucesso',
        'logRestoredSuccessfuly'  => 'Registros de ações restaurados com sucesso',
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Cleared Dashboard Language Lines
    |--------------------------------------------------------------------------
    */

    'dashboardCleared' => [
        'title'     => 'Registros de Ações Removidos',
        'subtitle'  => 'Eventos Removidos',

        'menu'      => [
            'deleteAll'  => 'Remover Todos os Registros de Ações',
            'restoreAll' => 'Restaurar Todos os Registros de Ações',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Pagination Language Lines
    |--------------------------------------------------------------------------
    */
    'pagination' => [
        'countText' => 'Mostrando :firstItem - :lastItem de :total resultados <small>(:perPage por página)</small>',
    ],

];
