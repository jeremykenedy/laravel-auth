# Routes

[Back to README](../README.md)

```bash
  GET|HEAD        / ..................................................................................................................... welcome › WelcomeController@welcome
  POST            _ignition/execute-solution .................................................. ignition.executeSolution › Spatie\LaravelIgnition › ExecuteSolutionController
  GET|HEAD        _ignition/health-check .............................................................. ignition.healthCheck › Spatie\LaravelIgnition › HealthCheckController
  POST            _ignition/update-config ........................................................... ignition.updateConfig › Spatie\LaravelIgnition › UpdateConfigController
  GET|HEAD        activate ....................................................................................................... activate › Auth\ActivateController@initial
  GET|HEAD        activate/{token} ................................................................................ authenticated.activate › Auth\ActivateController@activate
  GET|HEAD        activation ............................................................................... authenticated.activation-resend › Auth\ActivateController@resend
  GET|HEAD        activation-required ...................................................................... activation-required › Auth\ActivateController@activationRequired
  GET|HEAD        activity .................................................................... activity › jeremykenedy\LaravelLogger › LaravelLoggerController@showAccessLog
  DELETE          activity/clear-activity ............................................ clear-activity › jeremykenedy\LaravelLogger › LaravelLoggerController@clearActivityLog
  GET|HEAD        activity/cleared .................................................... cleared › jeremykenedy\LaravelLogger › LaravelLoggerController@showClearedActivityLog
  GET|HEAD        activity/cleared/log/{id} .................................................. jeremykenedy\LaravelLogger › LaravelLoggerController@showClearedAccessLogEntry
  DELETE          activity/destroy-activity ...................................... destroy-activity › jeremykenedy\LaravelLogger › LaravelLoggerController@destroyActivityLog
  POST            activity/live-search ......................................................... liveSearch › jeremykenedy\LaravelLogger › LaravelLoggerController@liveSearch
  GET|HEAD        activity/log/{id} ................................................................. jeremykenedy\LaravelLogger › LaravelLoggerController@showAccessLogEntry
  POST            activity/restore-log .................................... restore-activity › jeremykenedy\LaravelLogger › LaravelLoggerController@restoreClearedActivityLog
  POST            avatar/upload ................................................................................................... avatar.upload › ProfilesController@upload
  GET|HEAD        blocker ................................... laravelblocker::blocker.index › jeremykenedy\LaravelBlocker\App\Http\Controllers\LaravelBlockerController@index
  POST            blocker ................................... laravelblocker::blocker.store › jeremykenedy\LaravelBlocker\App\Http\Controllers\LaravelBlockerController@store
  GET|HEAD        blocker-deleted .................. laravelblocker::blocker-deleted › jeremykenedy\LaravelBlocker\App\Http\Controllers\LaravelBlockerDeletedController@index
  DELETE          blocker-deleted-destroy-all laravelblocker::destroy-all-blocked › jeremykenedy\LaravelBlocker\App\Http\Controllers\LaravelBlockerDeletedController@destroy…
  POST            blocker-deleted-restore-all laravelblocker::blocker-deleted-restore-all › jeremykenedy\LaravelBlocker\App\Http\Controllers\LaravelBlockerDeletedController…
  GET|HEAD        blocker-deleted/{id} .... laravelblocker::blocker-item-show-deleted › jeremykenedy\LaravelBlocker\App\Http\Controllers\LaravelBlockerDeletedController@show
  PUT             blocker-deleted/{id} laravelblocker::blocker-item-restore › jeremykenedy\LaravelBlocker\App\Http\Controllers\LaravelBlockerDeletedController@restoreBlocke…
  DELETE          blocker-deleted/{id} ...... laravelblocker::blocker-item-destroy › jeremykenedy\LaravelBlocker\App\Http\Controllers\LaravelBlockerDeletedController@destroy
  GET|HEAD        blocker/create .......................... laravelblocker::blocker.create › jeremykenedy\LaravelBlocker\App\Http\Controllers\LaravelBlockerController@create
  GET|HEAD        blocker/{blocker} ........................... laravelblocker::blocker.show › jeremykenedy\LaravelBlocker\App\Http\Controllers\LaravelBlockerController@show
  PUT|PATCH       blocker/{blocker} ....................... laravelblocker::blocker.update › jeremykenedy\LaravelBlocker\App\Http\Controllers\LaravelBlockerController@update
  DELETE          blocker/{blocker} ..................... laravelblocker::blocker.destroy › jeremykenedy\LaravelBlocker\App\Http\Controllers\LaravelBlockerController@destroy
  GET|HEAD        blocker/{blocker}/edit ...................... laravelblocker::blocker.edit › jeremykenedy\LaravelBlocker\App\Http\Controllers\LaravelBlockerController@edit
  GET|POST|HEAD   broadcasting/auth .............................................................................. Illuminate\Broadcasting › BroadcastController@authenticate
  GET|HEAD        exceeded ...................................................................................................... exceeded › Auth\ActivateController@exceeded
  GET|HEAD        home ................................................................................................................... public.home › UserController@index
  GET|HEAD        images/profile/{id}/avatar/{image} ................................................................................... ProfilesController@userProfileAvatar
  GET|HEAD        login .......................................................................................................... login › Auth\LoginController@showLoginForm
  POST            login .......................................................................................................................... Auth\LoginController@login
  POST            logout ............................................................................................................... logout › Auth\LoginController@logout
  GET|HEAD        logs ............................................................................................. Rap2hpoutre\LaravelLogViewer › LogViewerController@index
  POST            password/email .......................................................................... password.email › Auth\ForgotPasswordController@sendResetLinkEmail
  GET|HEAD        password/reset ....................................................................... password.request › Auth\ForgotPasswordController@showLinkRequestForm
  POST            password/reset ....................................................................................... password.update › Auth\ResetPasswordController@reset
  GET|HEAD        password/reset/{token} ........................................................................ password.reset › Auth\ResetPasswordController@showResetForm
  GET|HEAD        permission-deleted/{id} ...................... laravelroles::permission-show-deleted › jeremykenedy\LaravelRoles › LaravelpermissionsDeletedController@show
  DELETE          permission-destroy/{id} ................... laravelroles::permission-item-destroy › jeremykenedy\LaravelRoles › LaravelpermissionsDeletedController@destroy
  PUT             permission-restore/{id} .............. laravelroles::permission-restore › jeremykenedy\LaravelRoles › LaravelpermissionsDeletedController@restorePermission
  GET|HEAD        permissions .............................................. laravelroles::permissions.index › jeremykenedy\LaravelRoles › LaravelPermissionsController@index
  POST            permissions .............................................. laravelroles::permissions.store › jeremykenedy\LaravelRoles › LaravelPermissionsController@store
  GET|HEAD        permissions-deleted ............................. laravelroles::permissions-deleted › jeremykenedy\LaravelRoles › LaravelpermissionsDeletedController@index
  DELETE          permissions-deleted-destroy-all laravelroles::destroy-all-deleted-permissions › jeremykenedy\LaravelRoles › LaravelpermissionsDeletedController@destroyAll…
  POST            permissions-deleted-restore-all laravelroles::permissions-deleted-restore-all › jeremykenedy\LaravelRoles › LaravelpermissionsDeletedController@restoreAll…
  GET|HEAD        permissions/create ..................................... laravelroles::permissions.create › jeremykenedy\LaravelRoles › LaravelPermissionsController@create
  GET|HEAD        permissions/{permission} ................................... laravelroles::permissions.show › jeremykenedy\LaravelRoles › LaravelPermissionsController@show
  PUT|PATCH       permissions/{permission} ............................... laravelroles::permissions.update › jeremykenedy\LaravelRoles › LaravelPermissionsController@update
  DELETE          permissions/{permission} ............................. laravelroles::permissions.destroy › jeremykenedy\LaravelRoles › LaravelPermissionsController@destroy
  GET|HEAD        permissions/{permission}/edit .............................. laravelroles::permissions.edit › jeremykenedy\LaravelRoles › LaravelPermissionsController@edit
  ANY             php ............................................................................................................... Illuminate\Routing › RedirectController
  GET|HEAD        phpinfo .......................................................... laravelPhpInfo::phpinfo › jeremykenedy\LaravelPhpInfo › LaravelPhpInfoController@phpinfo
  GET|HEAD        profile/create ................................................................................................. profile.create › ProfilesController@create
  GET|HEAD        profile/{profile} .................................................................................................. profile.show › ProfilesController@show
  PUT|PATCH       profile/{profile} .............................................................................................. profile.update › ProfilesController@update
  GET|HEAD        profile/{profile}/edit ............................................................................................. profile.edit › ProfilesController@edit
  GET|HEAD        profile/{username} ................................................................................................... {username} › ProfilesController@show
  DELETE          profile/{username}/deleteUserAccount ..................................................... profile.deleteUserAccount › ProfilesController@deleteUserAccount
  PUT             profile/{username}/updateUserAccount ..................................................... profile.updateUserAccount › ProfilesController@updateUserAccount
  PUT             profile/{username}/updateUserPassword .................................................. profile.updateUserPassword › ProfilesController@updateUserPassword
  GET|HEAD        re-activate/{token} ................................................................................ user.reactivate › RestoreUserController@userReActivate
  GET|HEAD        register .......................................................................................... register › Auth\RegisterController@showRegistrationForm
  POST            register ................................................................................................................. Auth\RegisterController@register
  GET|HEAD        role-deleted/{id} ........................................ laravelroles::role-show-deleted › jeremykenedy\LaravelRoles › LaravelRolesDeletedController@show
  DELETE          role-destroy/{id} ..................................... laravelroles::role-item-destroy › jeremykenedy\LaravelRoles › LaravelRolesDeletedController@destroy
  PUT             role-restore/{id} ...................................... laravelroles::role-restore › jeremykenedy\LaravelRoles › LaravelRolesDeletedController@restoreRole
  GET|HEAD        roles ................................................................ laravelroles::roles.index › jeremykenedy\LaravelRoles › LaravelRolesController@index
  POST            roles ................................................................ laravelroles::roles.store › jeremykenedy\LaravelRoles › LaravelRolesController@store
  GET|HEAD        roles-deleted ............................................... laravelroles::roles-deleted › jeremykenedy\LaravelRoles › LaravelRolesDeletedController@index
  DELETE          roles-deleted-destroy-all ...... laravelroles::destroy-all-deleted-roles › jeremykenedy\LaravelRoles › LaravelRolesDeletedController@destroyAllDeletedRoles
  POST            roles-deleted-restore-all ...... laravelroles::roles-deleted-restore-all › jeremykenedy\LaravelRoles › LaravelRolesDeletedController@restoreAllDeletedRoles
  GET|HEAD        roles/create ....................................................................... laravelroles::roles.create › jeremykenedy\LaravelRoles › LaravelRolesController@create
  GET|HEAD        roles/{role} ........................................................... laravelroles::roles.show › jeremykenedy\LaravelRoles › LaravelRolesController@show
  PUT|PATCH       roles/{role} ....................................................... laravelroles::roles.update › jeremykenedy\LaravelRoles › LaravelRolesController@update
  DELETE          roles/{role} ..................................................... laravelroles::roles.destroy › jeremykenedy\LaravelRoles › LaravelRolesController@destroy
  GET|HEAD        roles/{role}/edit ...................................................... laravelroles::roles.edit › jeremykenedy\LaravelRoles › LaravelRolesController@edit
  GET|HEAD        routes .................................................................................................................. AdminDetailsController@listRoutes
  GET|HEAD        sanctum/csrf-cookie ..................................................................... sanctum.csrf-cookie › Laravel\Sanctum › CsrfCookieController@show
  POST            search-blocked .......................... laravelblocker::search-blocked › jeremykenedy\LaravelBlocker\App\Http\Controllers\LaravelBlockerController@search
  POST            search-blocked-deleted ... laravelblocker::search-blocked-deleted › jeremykenedy\LaravelBlocker\App\Http\Controllers\LaravelBlockerDeletedController@search
  POST            search-users .............................................................................................. search-users › UsersManagementController@search
  GET|HEAD        social/handle/{provider} ............................................................................ social.handle › Auth\SocialController@getSocialHandle
  GET|HEAD        social/redirect/{provider} ...................................................................... social.redirect › Auth\SocialController@getSocialRedirect
  GET|HEAD        terms ....................................................................................................................... terms › TermsController@terms
  GET|HEAD        themes .......................................................................................................... themes › ThemesManagementController@index
  POST            themes .................................................................................................... themes.store › ThemesManagementController@store
  GET|HEAD        themes/create ........................................................................................... themes.create › ThemesManagementController@create
  GET|HEAD        themes/{theme} .............................................................................................. themes.show › ThemesManagementController@show
  PUT|PATCH       themes/{theme} .......................................................................................... themes.update › ThemesManagementController@update
  DELETE          themes/{theme} ........................................................................................ themes.destroy › ThemesManagementController@destroy
  GET|HEAD        themes/{theme}/edit ......................................................................................... themes.edit › ThemesManagementController@edit
  GET|HEAD        users ............................................................................................................. users › UsersManagementController@index
  POST            users ....................................................................................................... users.store › UsersManagementController@store
  GET|HEAD        users/create .............................................................................................. users.create › UsersManagementController@create
  GET|HEAD        users/deleted ................................................................................................. deleted.index › SoftDeletesController@index
  GET|HEAD        users/deleted/{deleted} ......................................................................................... deleted.show › SoftDeletesController@show
  PUT|PATCH       users/deleted/{deleted} ..................................................................................... deleted.update › SoftDeletesController@update
  DELETE          users/deleted/{deleted} ................................................................................... deleted.destroy › SoftDeletesController@destroy
  GET|HEAD        users/{user} .................................................................................................. users.show › UsersManagementController@show
  PUT|PATCH       users/{user} .............................................................................................. users.update › UsersManagementController@update
  DELETE          users/{user} ............................................................................................. user.destroy › UsersManagementController@destroy
  GET|HEAD        users/{user}/edit ............................................................................................. users.edit › UsersManagementController@edit
  GET|HEAD        verification/needed .................. laravel2step::verificationNeeded › jeremykenedy\laravel2step\App\Http\Controllers\TwoStepController@showVerification
  POST            verification/resend ........................................ laravel2step::resend › jeremykenedy\laravel2step\App\Http\Controllers\TwoStepController@resend
  POST            verification/verify ........................................ laravel2step::verify › jeremykenedy\laravel2step\App\Http\Controllers\TwoStepController@verify
```
