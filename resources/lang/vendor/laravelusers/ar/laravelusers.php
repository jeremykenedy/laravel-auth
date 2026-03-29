<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel Users Blades Language Lines
    |--------------------------------------------------------------------------
    */

    'showing-all-users'     => 'عرض جميع المستخدمين',
    'users-menu-alt'        => 'عرض قائمة ادارة المستخدمين',
    'create-new-user'       => 'اضافة مستخدم جديد',
    'show-deleted-users'    => 'عرض المستخدمين المحذوفين',
    'editing-user'          => 'تعديل المستخدم :name',
    'showing-user'          => 'عرض المستخدم :name',
    'showing-user-title'    => 'بيانات المستخدم :name',

    'users-table' => [
        'caption'   => '{1} :userscount مستخدم وجد|[2,*] :userscount اجمالي المستخدمين',
        'id'        => 'الكود',
        'name'      => 'الاسم',
        'email'     => 'البريد الإليكتروني',
        'role'      => 'الدور',
        'created'   => 'تاريخ الاضافة',
        'updated'   => 'تاريخ التعديل',
        'actions'   => 'اجراءات',
        'updated'   => 'تاريخ التعديل',
    ],

    'buttons' => [
        'create-new'    => '<span class="hidden-xs hidden-sm">اضافة مستخدم جديد</span>',
        'delete'        => '<i class="far fa-trash-alt fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">حذف</span>',
        'show'          => '<i class="fas fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">عرض</span>',
        'edit'          => '<i class="fas fa-pencil-alt fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">تعديل</span>',
        'back-to-users' => '<span class="hidden-xs">عرض </span><span class="hidden-sm hidden-xs">المستخدمين</span>',
        'back-to-user'  => '<span class="hidden-xs">عرض  </span>المستخدم',
        'delete-user'   => '<i class="far fa-trash-alt fa-fw" aria-hidden="true"></i>  <span class="hidden-xs">حذف</span><span class="hidden-xs"> المستخدم</span>',
        'edit-user'     => '<i class="fas fa-pencil-alt fa-fw" aria-hidden="true"></i> <span class="hidden-xs">تعديل</span><span class="hidden-xs"> المستخدم</span>',
    ],

    'tooltips' => [
        'delete'        => 'حذف',
        'show'          => 'عرض',
        'edit'          => 'تعديل',
        'create-new'    => 'اضافة مستخدم جديد',
        'back-user'     => 'عرض المستخدم',
        'back-users'    => 'عرض المستخدمين',
        'email-user'    => 'مراسلة :user',
        'submit-search' => 'القيام بالبحث',
        'clear-search'  => 'حذف نتائج البحث',
    ],

    'messages' => [
        'userNameTaken'          => 'اسم المستخدم غير متاح',
        'userNameRequired'       => 'اسم المستخدم مطلوب',
        'fNameRequired'          => 'الاسم الأول مطلوب',
        'lNameRequired'          => 'الاسم الأخير مطلوب',
        'emailRequired'          => 'البريد الإليكتروني مطلوب',
        'emailInvalid'           => 'البريد الإليكتروني غير صحيح',
        'passwordRequired'       => 'كلمة المرور مطلوبة',
        'PasswordMin'            => 'كلمة المرور لابد ان تكون 6 حروف علي الأقل',
        'PasswordMax'            => 'أقصي طول لكلمة المرور هو 20 حرف',
        'captchaRequire'         => 'كلمة التحقق مطلوبة',
        'CaptchaWrong'           => 'كلمة التحقق غير صحيحة، يرجي اعادة المحاولة.',
        'roleRequired'           => 'برجاء اختيار دور المستخدم',
        'user-creation-success'  => 'تمت اضافة المستخدم بنجاح!',
        'update-user-success'    => 'تم تعديل المستخدم بنجاح!',
        'delete-success'         => 'تم حذف المستخدم بنجاح!',
        'cannot-delete-yourself' => 'لا يمكن حذف حسابك الشخصي بنفسك!',
    ],

    'show-user' => [
        'id'                => 'كود المستخدم',
        'name'              => 'اسم المستخدم',
        'email'             => 'البريد<span class="hidden-xs"> الإليكتروني</span>',
        'role'              => 'الدور',
        'created'           => 'اضيف <span class="hidden-xs">بتاريخ</span>',
        'updated'           => 'عُدل <span class="hidden-xs">بتاريخ</span>',
        'labelRole'         => 'الدور',
        'labelAccessLevel'  => 'صلاحيات<span class="hidden-xs"> العضو</span>|صلاحيات<span class="hidden-xs"> العضو</span>',
    ],

    'search'  => [
        'title'         => 'عرض نتائج البحث',
        'found-footer'  => ' سجل وُجد',
        'no-results'    => 'لا يوجد سجلات مطابقة',
    ],
];
