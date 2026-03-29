<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Language Lines - Global
    |--------------------------------------------------------------------------
    */
    'userTypes' => [
        'guest'      => 'Misafir',
        'registered' => 'Kayıtlı',
        'crawler'    => 'Yancı',
    ],

    'verbTypes' => [
        'created'    => 'Oluşturuldu',
        'edited'     => 'Düzenlendi',
        'deleted'    => 'Silindi',
        'viewed'     => 'Gösterildi',
        'crawled'    => 'crawled',
    ],

    'tooltips' => [
        'viewRecord' => 'Ayrıntıları Görüntüle',
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Admin Dashboard Language Lines
    |--------------------------------------------------------------------------
    */
    'dashboard' => [
        'title'     => 'Aktivite Kayıtları',
        'subtitle'  => 'Etkinlik',

        'labels'    => [
            'id'            => 'NO',
            'time'          => 'Zaman',
            'description'   => 'Tanım',
            'user'          => 'Kullanıcı',
            'method'        => 'Method',
            'route'         => 'Yönlendirme',
            'ipAddress'     => 'IP <span class="hidden-sm hidden-xs">Adresi</span>',
            'agent'         => '<span class="hidden-sm hidden-xs">Kullanıcı </span>Tarayıcısı',
            'deleteDate'    => '<span class="hidden-sm hidden-xs">Silinme </span>Zamanı',
        ],

        'menu'      => [
            'alt'           => 'Aktivite kayıt menüsü',
            'clear'         => 'Aktivite kayıtlarını temizle',
            'show'          => 'Temizlenen kayıtları göster',
            'back'          => 'Aktivite kayıtlarına geri dön',
        ],

        'search'    => [
            'all'           => 'Hepsi',
            'search'        => 'Ara',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Admin Drilldown Language Lines
    |--------------------------------------------------------------------------
    */

    'drilldown' => [
        'title'                 => 'Aktivite NO: :id',
        'title-details'         => 'Aktivite detayı',
        'title-ip-details'      => 'IP Adres Detayı',
        'title-user-details'    => 'Kullanıcı Detayı',
        'title-user-activity'   => 'Ek Kullanıcı Etkinliği',

        'buttons'   => [
            'back'      => '<span class="hidden-xs hidden-sm">Aktivite Kayıtlarına </span><span class="hidden-xs">geri dön</span>',
        ],

        'labels' => [
            'userRoles'     => 'Kullanıcı Rolleri',
            'userLevel'     => 'Seviye',
        ],

        'list-group' => [
            'labels'    => [
                'id'            => 'Aktivite Kayıt NO:',
                'ip'            => 'IP Adresi',
                'description'   => 'Tanım',
                'details'       => 'Detay',
                'userType'      => 'Kullanıcı Türü',
                'userId'        => 'Kullanıcı NO',
                'route'         => 'Yönlendirme',
                'agent'         => 'Tarayıcı',
                'locale'        => 'Yerel',
                'referer'       => 'Yönlendirilen',

                'methodType'    => 'Yöntem Türü',
                'createdAt'     => 'Etkinlik Zamanı',
                'updatedAt'     => 'Güncellenme',
                'deletedAt'     => 'Silinme',
                'timePassed'    => 'Zaman geçti',
                'userName'      => 'Kullanıcı adı',
                'userFirstName' => 'AD',
                'userLastName'  => 'SOYAD',
                'userFulltName' => 'TAM AD',
                'userEmail'     => 'E-Posta',
                'userSignupIp'  => 'Kayıt Olduğu IP',
                'userCreatedAt' => 'Oluşturuldu',
                'userUpdatedAt' => 'Güncellendi',
            ],

            'fields' => [
                'none' => 'Yok',
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
            'btnCancel'     => 'Vazgeç',
            'btnConfirm'    => 'Onayla',
        ],
        'clearLog' => [
            'title'     => 'Etkinlik Günlüğünü Temizle',
            'message'   => 'Etkinlik günlüğünü temizlemek istediğinizden emin misiniz?',
        ],
        'deleteLog' => [
            'title'     => 'Etkinlik Günlüğünü Kalıcı Olarak Sil',
            'message'   => 'Etkinlik günlüğünü kalıcı olarak SİLMEK istediğinizden emin misiniz?',
        ],
        'restoreLog' => [
            'title'     => 'Temizlenen Etkinlik Günlüğünü Geri Yükle',
            'message'   => 'Temizlenen etkinlik günlüklerini geri yüklemek istediğinizden emin misiniz?',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Flash Messages
    |--------------------------------------------------------------------------
    */

    'messages' => [
        'logClearedSuccessfuly'   => 'Aktivite kayıtları başarıyla temizlendi',
        'logDestroyedSuccessfuly' => 'Aktivite kaydı başarıyla temizlendi',
        'logRestoredSuccessfuly'  => 'Aktivite kaydı başarıyla yüklendi',
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Cleared Dashboard Language Lines
    |--------------------------------------------------------------------------
    */

    'dashboardCleared' => [
        'title'     => 'Etkinlik kayıtları temizlendi',
        'subtitle'  => 'Etkinlikler temizlendi',

        'menu'      => [
            'deleteAll'  => 'Tüm aktivite kayıtlarını sil',
            'restoreAll' => 'Tüm aktivite kayıtlarını yedekle',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Pagination Language Lines
    |--------------------------------------------------------------------------
    */
    'pagination' => [
        'countText' => 'Gösteriliyor: :firstItem - :lastItem / :total kayıt <small>(sayfa başına :perPage)</small>',
    ],

];
