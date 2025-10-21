## Laravel Auth

#### Laravel Auth is a Complete Build of Laravel 12 with Email Registration Verification, Social Authentication, User Roles and Permissions, User Profiles, and Admin restricted user management system. Built on Bootstrap 4.

[![StyleCI](https://styleci.io/repos/44714043/shield?branch=master)](https://styleci.io/repos/44714043)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/jeremykenedy/laravel-auth/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/jeremykenedy/laravel-auth/?branch=master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/jeremykenedy/laravel-auth/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
[![All Contributors](https://img.shields.io/badge/all_contributors-23-orange.svg?style=flat-square)](#contributors)
[![MadeWithLaravel.com shield](https://madewithlaravel.com/storage/repo-shields/1342-shield.svg)](https://madewithlaravel.com/p/laravel-auth/shield-link)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

[![Sponsor me on GitHub](https://img.shields.io/static/v1?label=Sponsor&message=%E2%9D%A4&logo=GitHub&color=%23fe8e86)](https://github.com/sponsors/jeremykenedy)
[![Sponsor me on Patreon](https://img.shields.io/static/v1?label=patreon&message=%E2%9D%A4&logo=Patreon&color=F35B49&style=flat)](https://patreon.com/jeremykenedy)
[![Buy me a Coffee](https://img.shields.io/badge/Buy_Me_A_Coffee-FFDD00?style=flat&logo=buy-me-a-coffee&logoColor=black)](https://www.buymeacoffee.com/jeremykenedy)
[![Vultr](https://img.shields.io/badge/Vultr-007BFC.svg?style=flat&logo=vultr)](https://www.vultr.com/?ref=9338425-8H)
[![GitHub Stars](https://img.shields.io/github/stars/jeremykenedy/laravel-auth?style=social)](https://github.com/jeremykenedy/laravel-auth/stargazers)
[![Follow on GitHub](https://img.shields.io/github/followers/jeremykenedy?style=social)](https://github.com/jeremykenedy)
[![Follow on Twitter](https://img.shields.io/twitter/follow/developernator?style=social&logo=twitter)](https://twitter.com/intent/follow?screen_name=developernator)

> This project costs me $22/month to be hosted on [Vultr](https://www.vultr.com/?ref=9338425-8H).<br>
> Please consider [supporting my work](https://patreon.com/jeremykenedy) if you use & find it useful. ❤️

### Note

If you like this, you will love [Laravel Auth Spa](https://github.com/jeremykenedy/laravel-spa) with configurable providers from an admin panel.

#### Table of contents

-   [About](#about)
-   [Features](#features)
-   [Installation Instructions](#installation-instructions)
    -   [Build the Front End Assets with Mix](#build-the-front-end-assets-with-mix)
    -   [Optionally Build Cache](#optionally-build-cache)
-   [Seeds](#seeds)
    -   [Seeded Roles](#seeded-roles)
    -   [Seeded Permissions](#seeded-permissions)
    -   [Seeded Users](#seeded-users)
    -   [Themes Seed List](#themes-seed-list)
-   [Routes](#routes)
-   [Socialite](#socialite)
    -   [Get Socialite Login API Keys](#get-socialite-login-api-keys)
    -   [Add More Socialite Logins](#add-more-socialite-logins)
-   [Other API keys](#other-api-keys)
-   [Environment File](#environment-file)
-   [Updates](#updates)
-   [Screenshots](#screenshots)
-   [File Tree](#file-tree)
-   [Opening an Issue](#opening-an-issue)
-   [Laravel Auth License](#laravel-auth-license)
-   [Contributors](#Contributors)

### About

Laravel 12 with user authentication, registration with email confirmation, social media authentication, password recovery, and captcha protection. Uses official [Bootstrap 4](https://getbootstrap.com). This also makes full use of Controllers for the routes, templates for the views, and makes use of middleware for routing. Project can be stood up in minutes.

### Features

#### A [Laravel](https://laravel.com/) 12 with [Bootstrap](https://getbootstrap.com) 4.x project.

| Laravel Auth Features                                                                                                                                |
| :--------------------------------------------------------------------------------------------------------------------------------------------------- |
| Built on [Laravel](https://laravel.com/) 12                                                                                                          |
| Built on [Bootstrap](https://getbootstrap.com/) 4                                                                                                    |
| Uses [MySQL](https://github.com/mysql) Database (can be changed)                                                                                     |
| Uses [Artisan](https://laravel.com/docs/master/artisan) to manage database migration, schema creations, and create/publish page controller templates |
| Dependencies are managed with [COMPOSER](https://getcomposer.org/)                                                                                   |
| Laravel Scaffolding **User** and **Administrator Authentication**.                                                                                   |
| User [Socialite Logins](https://github.com/laravel/socialite) ready to go - See API list used below                                                  |
| [Google Maps API v3](https://developers.google.com/maps/documentation/javascript/) for User Location lookup and Geocoding                            |
| CRUD (Create, Read, Update, Delete) Themes Management                                                                                                |
| CRUD (Create, Read, Update, Delete) User Management                                                                                                  |
| Robust [Laravel Logging](https://laravel.com/docs/master/errors#logging) with admin UI using MonoLog                                                 |
| Google [reCaptcha Protection with Google API](https://developers.google.com/recaptcha/)                                                              |
| User Registration with email verification                                                                                                            |
| Makes use of Laravel [Mix](https://laravel.com/docs/master/mix) to compile assets                                                                    |
| Makes use of [Language Localization Files](https://laravel.com/docs/master/localization)                                                             |
| Active Nav states using [Laravel Requests](https://laravel.com/docs/master/requests)                                                                 |
| Restrict User Email Activation Attempts                                                                                                              |
| Capture IP to users table upon signup                                                                                                                |
| Uses [Laravel Debugger](https://github.com/barryvdh/laravel-debugbar) for development                                                                |
| Makes use of [Password Strength Meter](https://github.com/elboletaire/password-strength-meter)                                                       |
| Makes use of [hideShowPassword](https://github.com/cloudfour/hideShowPassword)                                                                       |
| User Avatar Image AJAX Upload with [Dropzone.js](https://www.dropzonejs.com/#configuration)                                                          |
| User Gravatar using [Gravatar API](https://github.com/creativeorange/gravatar)                                                                       |
| User Password Reset via Email Token                                                                                                                  |
| User Login with remember password                                                                                                                    |
| User [Roles/ACL Implementation](https://github.com/jeremykenedy/laravel-roles)                                                                       |
| Roles and Permissions GUI                                                                                                                            |
| Makes use of [Laravel's Soft Delete Structure](https://laravel.com/docs/master/eloquent#soft-deleting)                                               |
| Soft Deleted Users Management System                                                                                                                 |
| Permanently Delete Soft Deleted Users                                                                                                                |
| User Delete Account with Goodbye email                                                                                                               |
| User Restore Deleted Account Token                                                                                                                   |
| Restore Soft Deleted Users                                                                                                                           |
| View Soft Deleted Users                                                                                                                              |
| Captures Soft Delete Date                                                                                                                            |
| Captures Soft Delete IP                                                                                                                              |
| Admin Routing Details UI                                                                                                                             |
| Admin PHP Information UI                                                                                                                             |
| Eloquent user profiles                                                                                                                               |
| User Themes                                                                                                                                          |
| 404 Page                                                                                                                                             |
| 403 Page                                                                                                                                             |
| Configurable Email Notification via [Laravel-Exception-Notifier](https://github.com/jeremykenedy/laravel-exception-notifier)                         |
| Activity Logging using [Laravel-logger](https://github.com/jeremykenedy/laravel-logger)                                                              |
| Optional 2-step account login verfication with [Laravel 2-Step Verification](https://github.com/jeremykenedy/laravel2step)                           |
| Uses [Laravel PHP Info](https://github.com/jeremykenedy/laravel-phpinfo) package                                                                     |
| Uses [Laravel Blocker](https://github.com/jeremykenedy/laravel-blocker) package                                                                      |

### Installation Instructions

1. Run `git clone https://github.com/jeremykenedy/laravel-auth.git laravel-auth`
2. Create a MySQL database for the project
    - `mysql -u root -p`, if using Vagrant: `mysql -u homestead -psecret`
    - `create database laravelAuth;`
    - `\q`
3. From the projects root run `cp .env.example .env`
4. Configure your `.env` file
5. Install composer, php-mysql, php-ext and php-dom (dependent on your distrubtion, For Debian run `apt install composer php-mysql php-ext php-dom`)
6. Run `composer update` from the projects root folder
7. From the projects root folder run:

```
php artisan vendor:publish --tag=laravelroles &&
php artisan vendor:publish --tag=laravel2step &&
php artisan vendor:publish --tag=laravel-email-database-log-migration
```

7. From the projects root folder run `sudo chmod -R 755 ../laravel-auth`
8. From the projects root folder run `php artisan key:generate`
9. From the projects root folder run `php artisan migrate`
10. From the projects root folder run `composer dump-autoload`
11. From the projects root folder run `php artisan db:seed`
12. Compile the front end assets with [npm steps](#using-npm) or [yarn steps](#using-yarn).

#### Build the Front End Assets with Vite

##### Using Yarn:

1. Install yarn (dependent on your distribution)
2. From the projects root folder run `yarn install`
3. From the projects root folder run `yarn run dev` or `yarn run build`

##### Using NPM:

1. From the projects root folder run `npm install`
2. From the projects root folder run `npm run dev` or `npm run build`

#### Optionally Build Cache

1. From the projects root folder run `php artisan config:cache`

###### And thats it with the caveat of setting up and configuring your development environment. I recommend [Laravel Homestead](https://laravel.com/docs/master/homestead)

### Seeds

##### Seeded Roles

-   Unverified - Level 0
-   User - Level 1
-   Administrator - Level 5

##### Seeded Permissions

-   view.users
-   create.users
-   edit.users
-   delete.users

##### Seeded Users

| Email           | Password | Access       |
| :-------------- | :------- | :----------- |
| user@user.com   | password | User Access  |
| admin@user.com | password | Admin Access |

##### Themes Seed List

-   [ThemesTableSeeder](https://github.com/jeremykenedy/laravel-auth/blob/master/database/seeders/ThemesTableSeeder.php)
-   NOTE: A lot of themes render incorrectly on Bootstrap 4 since their core was built to override Bootstrap 4. These will be updated soon and ones that do not render correctly will be removed from the seed. In the mean time you can remove them from the seed or manaully from the UI or database.

##### Blocked Types Seed List

-   [BlockedTypeTableSeeder.php](https://github.com/jeremykenedy/laravel-auth/blob/master/database/seeders/BlockedTypeTableSeeder.php)

| Slug        | Name         |
| :---------- | :----------- |
| email       | E-mail       |
| ipAddress   | IP Address   |
| domain      | Domain Name  |
| user        | User         |
| city        | City         |
| state       | State        |
| country     | Country      |
| countryCode | Country Code |
| continent   | Continent    |
| region      | Region       |

##### Blocked Items Seed List

-   [BlockedItemsTableSeeder.php](https://github.com/jeremykenedy/laravel-auth/blob/master/database/seeders/BlockedItemsTableSeeder.php)

| Type   | Value          | Note                                     |
| :----- | :------------- | :--------------------------------------- |
| domain | test.com       | Block all domains/emails @test.com       |
| domain | test.ca        | Block all domains/emails @test.ca        |
| domain | fake.com       | Block all domains/emails @fake.com       |
| domain | example.com    | Block all domains/emails @example.com    |
| domain | mailinator.com | Block all domains/emails @mailinator.com |

### Routes

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
  GET|HEAD        roles/create ....................................................... laravelroles::roles.create › jeremykenedy\LaravelRoles › LaravelRolesController@create
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

### Socialite

#### Get Socialite Login API Keys:

-   [Google Captcha API](https://www.google.com/recaptcha/admin#list)
-   [Facebook API](https://developers.facebook.com/)
-   [Twitter API](https://apps.twitter.com/)
-   [Google &plus; API](https://console.developers.google.com/)
-   [GitHub API](https://github.com/settings/applications/new)
-   [YouTube API](https://developers.google.com/youtube/v3/getting-started)
-   [Twitch TV API](https://www.twitch.tv/kraken/oauth2/clients/new)
-   [Instagram API](https://instagram.com/developer/register/)
-   [37 Signals API](https://github.com/basecamp/basecamp-classic-api)

#### Add More Socialite Logins

-   See full list of providers: [https://socialiteproviders.github.io](https://socialiteproviders.github.io/#providers)

###### **Steps**:

1. Go to [https://socialiteproviders.github.io](https://socialiteproviders.github.io/providers/twitch/) and select the provider to be added.
2. From the projects root folder, in the terminal, run composer to get the needed package.

    - Example:

    ```
       composer require socialiteproviders/twitch
    ```

3. From the projects root folder run `composer update`
4. Add the service provider to `/config/services.php`

    - Example:

    ```
       'twitch' => [
           'client_id'   => env('TWITCH_KEY'),
           'client_secret' => env('TWITCH_SECRET'),
           'redirect'    => env('TWITCH_REDIRECT_URI'),
       ],
    ```

5. Add the API credentials to `/.env `

    - Example:

    ```
       TWITCH_KEY=YOURKEYHERE
       TWITCH_SECRET=YOURSECRETHERE
       TWITCH_REDIRECT_URI=http://YOURWEBSITEURL.COM/social/handle/twitch
    ```

6. Add the social media login link:

    - Example:
      In file `/resources/views/auth/login.blade.php` add ONE of the following:

        - Conventional HTML:

        ```
        <a href="{{ route('social.redirect', ['provider' => 'twitch']) }}" class="btn btn-lg btn-primary btn-block twitch">Twitch</a>
        ```

        - Use Laravel HTML Facade with [Laravel Collective](https://laravelcollective.com/):

        ```
        {!! html()->a(route('social.redirect', ['provider' => 'twitch']), 'Twitch', array('class' => 'btn btn-lg btn-primary btn-block twitch')) !!}
        ```

### Other API keys

-   [Google Maps API v3 Key](https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key)

### Environment File

Example `.env` file:

```bash
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000
APP_PROJECT_VERSION=12

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=pusher
CACHE_DRIVER=file
SESSION_DRIVER=file
SESSION_LIFETIME=120
QUEUE_DRIVER=sync

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"

EMAIL_EXCEPTION_ENABLED=false
EMAIL_EXCEPTION_FROM="${MAIL_FROM_ADDRESS}"
EMAIL_EXCEPTION_TO='email1@gmail.com, email2@gmail.com'
EMAIL_EXCEPTION_CC=''
EMAIL_EXCEPTION_BCC=''
EMAIL_EXCEPTION_SUBJECT=''

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

ACTIVATION=true
ACTIVATION_LIMIT_TIME_PERIOD=24
ACTIVATION_LIMIT_MAX_ATTEMPTS=3
NULL_IP_ADDRESS=0.0.0.0

DEBUG_BAR_ENVIRONMENT=local

USER_RESTORE_CUTOFF_DAYS=31
USER_RESTORE_ENCRYPTION_KEY=
USER_LIST_PAGINATION_SIZE=50

LARAVEL_2STEP_ENABLED=false
LARAVEL_2STEP_DATABASE_CONNECTION=mysql
LARAVEL_2STEP_DATABASE_TABLE=laravel2step
LARAVEL_2STEP_USER_MODEL=App\Models\User
LARAVEL_2STEP_EMAIL_FROM=
LARAVEL_2STEP_EMAIL_FROM_NAME="Laravel 2 Step Verification"
LARAVEL_2STEP_EMAIL_SUBJECT='Laravel 2 Step Verification'
LARAVEL_2STEP_EXCEEDED_COUNT=3
LARAVEL_2STEP_EXCEEDED_COUNTDOWN_MINUTES=1440
LARAVEL_2STEP_VERIFIED_LIFETIME_MINUTES=360
LARAVEL_2STEP_RESET_BUFFER_IN_SECONDS=300
LARAVEL_2STEP_CSS_FILE="css/laravel2step/app.css"
LARAVEL_2STEP_APP_CSS_ENABLED=false
LARAVEL_2STEP_APP_CSS="css/app.css"
LARAVEL_2STEP_BOOTSTRAP_CSS_CDN_ENABLED=true
LARAVEL_2STEP_BOOTSTRAP_CSS_CDN="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"

DEFAULT_GRAVATAR_SIZE=80
DEFAULT_GRAVATAR_FALLBACK=http://c1940652.r52.cf0.rackcdn.com/51ce28d0fb4f442061000000/Screen-Shot-2013-06-28-at-5.22.23-PM.png
DEFAULT_GRAVATAR_SECURE=false
DEFAULT_GRAVATAR_MAX_RATING=g
DEFAULT_GRAVATAR_FORCE_DEFAULT=false
DEFAULT_GRAVATAR_FORCE_EXTENSION=jpg

DROPZONE_JS_CDN=https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js

LARAVEL_LOGGER_DATABASE_CONNECTION=mysql
LARAVEL_LOGGER_DATABASE_TABLE=laravel_logger_activity
LARAVEL_LOGGER_ROLES_ENABLED=true
LARAVEL_LOGGER_ROLES_MIDDLWARE=role:admin
LARAVEL_LOGGER_MIDDLEWARE_ENABLED=true
LARAVEL_LOGGER_USER_MODEL=App\Models\User
LARAVEL_LOGGER_PAGINATION_ENABLED=true
LARAVEL_LOGGER_PAGINATION_PER_PAGE=25
LARAVEL_LOGGER_DATATABLES_ENABLED=false
LARAVEL_LOGGER_DASHBOARD_MENU_ENABLED=true
LARAVEL_LOGGER_DASHBOARD_DRILLABLE=true
LARAVEL_LOGGER_LOG_RECORD_FAILURES_TO_FILE=true
LARAVEL_LOGGER_FLASH_MESSAGE_BLADE_ENABLED=false
LARAVEL_LOGGER_JQUERY_CDN_ENABLED=false
LARAVEL_LOGGER_JQUERY_CDN_URL=https://code.jquery.com/jquery-2.2.4.min.js
LARAVEL_LOGGER_BLADE_CSS_PLACEMENT_ENABLED=true
LARAVEL_LOGGER_BLADE_JS_PLACEMENT_ENABLED=true
LARAVEL_LOGGER_BOOTSTRAP_JS_CDN_ENABLED=false
LARAVEL_LOGGER_BOOTSTRAP_JS_CDN_URL=https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js
LARAVEL_LOGGER_FONT_AWESOME_CDN_ENABLED=false
LARAVEL_LOGGER_FONT_AWESOME_CDN_URL=https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css
LARAVEL_LOGGER_BOOTSTRAP_CSS_CDN_ENABLED=false
LARAVEL_LOGGER_BOOTSTRAP_CSS_CDN_URL=https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css

LARAVEL_BLOCKER_USER_MODEL=App\Models\User
LARAVEL_BLOCKER_AUTH_ENABLED=true
LARAVEL_BLOCKER_ROLES_ENABLED=true
LARAVEL_BLOCKER_FLASH_MESSAGES_ENABLED=false
LARAVEL_BLOCKER_JQUERY_CDN_ENABLED=false
LARAVEL_BLOCKER_BLADE_PLACEMENT_CSS='template_linked_css'
LARAVEL_BLOCKER_BLADE_PLACEMENT_JS='footer_scripts'
LARAVEL_BLOCKER_USE_TYPES_SEED_PUBLISHED=true
LARAVEL_BLOCKER_USE_ITEMS_SEED_PUBLISHED=true

# Roles database information
ROLES_DATABASE_CONNECTION=null

# Roles Misc Settings
ROLES_DEFAULT_SEPARATOR='.'

# Roles GUI Settings
ROLES_GUI_ENABLED=true
ROLES_GUI_AUTH_ENABLED=true
ROLES_GUI_MIDDLEWARE_ENABLED=true
ROLES_GUI_MIDDLEWARE='role:admin'
ROLES_GUI_BLADE_EXTENDED='layouts.app'
ROLES_GUI_TITLE_EXTENDED='template_title'
ROLES_GUI_LARAVEL_ROLES_ENABLED=true
ROLES_GUI_DATATABLES_JS_ENABLED=false
ROLES_GUI_FLASH_MESSAGES_ENABLED=false
ROLES_GUI_BLADE_PLACEMENT_CSS=template_linked_css
ROLES_GUI_BLADE_PLACEMENT_JS=footer_scripts

# Google Analytics - If blank it will not render, default is false
GOOGLE_ANALYTICS_ID=
#GOOGLE_ANALYTICS_ID='UA-XXXXXXXX-X'

# NOTE: YOU CAN REMOVE THE KEY CALL IN app.blade.php IF YOU GET A POP UP AND DO NOT WANT TO SETUP A KEY FOR DEV
# Google Maps API v3 Key - https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key
GOOGLEMAPS_API_STATUS=true
GOOGLEMAPS_API_KEY=YOURGOOGLEMAPSkeyHERE

# https://www.google.com/recaptcha/admin#list
ENABLE_RECAPTCHA=true
RE_CAP_SITE=YOURGOOGLECAPTCHAsitekeyHERE
RE_CAP_SECRET=YOURGOOGLECAPTCHAsecretHERE

# https://console.developers.google.com/ - NEED OAUTH CREDS
GOOGLE_ID=YOURGOOGLEPLUSidHERE
GOOGLE_SECRET=YOURGOOGLEPLUSsecretHERE
GOOGLE_REDIRECT=https://YOURWEBURLHERE.COM/social/handle/google

# https://developers.facebook.com/
FB_ID=YOURFACEBOOKidHERE
FB_SECRET=YOURFACEBOOKsecretHERE
FB_REDIRECT=https://YOURWEBURLHERE.COM/social/handle/facebook

# https://apps.twitter.com/
TW_ID=YOURTWITTERidHERE
TW_SECRET=YOURTWITTERkeyHERE
TW_REDIRECT=https://YOURWEBURLHERE.COM/social/handle/twitter

# https://github.com/settings/applications/new
GITHUB_ID=YOURIDHERE
GITHUB_SECRET=YOURSECRETHERE
GITHUB_URL=https://YOURWEBURLHERE.COM/social/handle/github

# https://developers.google.com/youtube/v3/getting-started
YOUTUBE_KEY=YOURKEYHERE
YOUTUBE_SECRET=YOURSECRETHERE
YOUTUBE_REDIRECT_URI=https://YOURWEBURLHERE.COM/social/handle/youtube

# https://dev.twitch.tv/docs/authentication/
TWITCH_KEY=YOURKEYHERE
TWITCH_SECRET=YOURSECRETHERE
TWITCH_REDIRECT_URI=https://YOURWEBURLHERE.COM/social/handle/twitch

# https://instagram.com/developer/register/
INSTAGRAM_KEY=YOURKEYHERE
INSTAGRAM_SECRET=YOURSECRETHERE
INSTAGRAM_REDIRECT_URI=https://YOURWEBURLHERE.COM/social/handle/instagram

# https://basecamp.com/
# https://github.com/basecamp/basecamp-classic-api
37SIGNALS_KEY=YOURKEYHERE
37SIGNALS_SECRET=YOURSECRETHERE
37SIGNALS_REDIRECT_URI=https://YOURWEBURLHERE.COM/social/handle/37signals

```

#### Laravel Developement Packages Used References

-   https://laravel.com/docs/master/authentication
-   https://laravel.com/docs/master/authorization
-   https://laravel.com/docs/master/routing
-   https://laravel.com/docs/master/migrations
-   https://laravel.com/docs/master/queries
-   https://laravel.com/docs/master/views
-   https://laravel.com/docs/master/eloquent
-   https://laravel.com/docs/master/eloquent-relationships
-   https://laravel.com/docs/master/requests
-   https://laravel.com/docs/master/errors

###### Updates:

-   Update to Laravel 12
-   Update to Laravel 10 (Major Changes)
-   Update to Laravel 9
-   Update to Laravel 8
-   Update to Laravel 7 [See changes in this PR](https://github.com/jeremykenedy/laravel-auth/pull/348/files)
-   Update to Laravel 6
-   Update to Laravel 5.8
-   Added [Laravel Blocker Package](https://github.com/jeremykenedy/laravel-blocker)
-   Added [PHP Info Package](https://github.com/jeremykenedy/laravel-phpinfo)
-   Update to Bootstrap 4
-   Update to Laravel 5.7
-   Added optional 2-step account login verfication with [Laravel 2-Step Verification](https://github.com/jeremykenedy/laravel2step)
-   Added activity logging using [Laravel-logger](https://github.com/jeremykenedy/laravel-logger)
-   Added Configurable Email Notification using [Laravel-Exception-Notifier](https://github.com/jeremykenedy/laravel-exception-notifier)
-   Update to Laravel 5.5
-   Added User Delete with Goodbye email
-   Added User Restore Deleted Account from email with secure token
-   Added [Soft Deletes](https://laravel.com/docs/master/eloquent#soft-deleting) and Soft Deletes Management panel
-   Added User Account Settings to Profile Edit
-   Added User Change Password to Profile Edit
-   Added User Delete Account to Profile Edit
-   Added [Password Strength Meter](https://github.com/elboletaire/password-strength-meter)
-   Added [hideShowPassword](https://github.com/cloudfour/hideShowPassword)
-   Added Admin Routing Details
-   Admin PHP Information
-   Added Robust [Laravel Logging](https://laravel.com/docs/master/errors#logging) with admin UI using MonoLog
-   Added Active Nav states using [Laravel Requests](https://laravel.com/docs/master/requests)
-   Added [Laravel Debugger](https://github.com/barryvdh/laravel-debugbar) with Service Provider to manage status in `.env` file.
-   Updated Capture IP not found IP address
-   Added User Avatar Image AJAX Upload with [Dropzone.js](http://www.dropzonejs.com/#configuration)
-   Added User Gravatar using Gravatar API
-   Added Themes Management.
-   Add user profiles with seeded list and global view
-   Major overhaul on Laravel 5.4
-   Update from Laravel 5.1 to 5.2
-   Added eloquent editable user profile
-   Added IP Capture
-   Added Google Maps API v3 for User Location lookup
-   Added Google Maps API v3 for User Location Input Geocoding
-   Added Google Maps API v3 for User Location Map with Options
-   Added CRUD(Create, Read, Update, Delete) User Management

### Screenshots

![Login](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/1laravel-auth2-login.jpg)
![Register](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/2laravel-auth2-register.jpg)
![Registration Confirmation](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/3laravel-auth2-account-req-activation.jpg)
![Registration Email](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/4laravel-auth2-activation-email.jpg)
![Registration Complete](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/5laravel-auth2-userhome-with-flash-success.jpg)
![Intial User Profile](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/6laravel-auth2-profile-mapless.jpg)
![Edit User Profile](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/7laravel-auth2-profile-edit.jpg)
![Find Location Using Google Maps API v3](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/8laravel-auth2-edit-profile-lookup.jpg)
![Profile Updated](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/9laravel-auth2-flash-success.jpg)
![Profile Semi-completed](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/10laravel-auth2-profile-with-map.jpg)

![Admin Panel Users List](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/11laravel-auth2-users-list.jpg)
![Admin Panel Delete User](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/12laravel-auth2-modal-delete.jpg)
![Admin Panel Flash Error](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/13laravel-auth2-flash-error.jpg)
![Admin Panel Show User](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/14laravel-auth2-show-edit.jpg)
![Admin Panel Edit User](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/15laravel-auth2-edit-user.jpg)
![Admin Panel Save Edits](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/16laravel-auth2-modal-save.jpg)
![Admin Panel Create User](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/17laravel-auth-create-user.jpg)

![dashboard](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-logger/1-dashboard.jpg)
![drilldown](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-logger/2-drilldown.jpg)
![confirm-clear](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-logger/3-confirm-clear.jpg)
![log-cleared-msg](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-logger/4-log-cleared-msg.jpg)
![cleared-log](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-logger/5-cleared-log.jpg)
![confirm-restore](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-logger/5-confirm-restore.jpg)
![confirm-destroy](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-logger/6-confirm-destroy.jpg)
![success-destroy](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-logger/7-success-destroy.jpg)
![success-restored](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-logger/8-success-restored.jpg)
![cleared-drilldown](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-logger/9-cleared-drilldown.jpg)

![Verification Page](https://s3-us-west-2.amazonaws.com/github-project-images/laravel2step/1-verification-page.jpeg)
![Resent Email Modal](https://s3-us-west-2.amazonaws.com/github-project-images/laravel2step/2-verification-email-resent.jpeg)
![Lock Warning Modal](https://s3-us-west-2.amazonaws.com/github-project-images/laravel2step/3-lock-warning.jpeg)
![Locked Page](https://s3-us-west-2.amazonaws.com/github-project-images/laravel2step/4-lock-screen.jpeg)
![Verification Email](https://s3-us-west-2.amazonaws.com/github-project-images/laravel2step/5-verification-email.jpeg)

![Laravel Blocker Dashboard](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-blocker/blocker0.jpg)
![Laravel Blocker Search](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-blocker/blocker1.jpg)
![Laravel Blocker Create](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-blocker/blocker2.jpg)
![Laravel Blocker View](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-blocker/blocker3.jpg)
![Laravel Blocker Edit](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-blocker/blocker4.jpg)
![Laravel Blocker Delete Modal](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-blocker/blocker5.jpg)
![Laravel Blocker Deleted Dashboard](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-blocker/blocker6.jpg)
![Laravel Blocker Destroy Modal](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-blocker/blocker7.jpg)
![Laravel Blocker Flash Message](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-blocker/blocker8.jpg)
![Laravel Blocker Restore Modal](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-blocker/blocker9.jpg)
![Laravel Blocker Restore Flash Message](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-blocker/blocker10.jpg)

![Laravel Roles GUI Dashboard](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-1.png)
![Laravel Roles GUI Create New Role](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-2.png)
![Laravel Roles GUI Edit Role](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-3.png)
![Laravel Roles GUI Show Role](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-4.png)
![Laravel Roles GUI Delete Role](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-5.png)
![Laravel Roles GUI Success Deleted](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-6.png)
![Laravel Roles GUI Deleted Role Show](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-7.png)
![Laravel Roles GUI Restore Role](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-8.png)
![Laravel Roles GUI Delete Permission](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-9.png)
![Laravel Roles GUI Show Permission](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-10.png)
![Laravel Roles GUI Permissions Dashboard](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-11.png)
![Laravel Roles GUI Create New Permission](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-12.png)
![Laravel Roles GUI Roles Soft Deletes Dashboard](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-13.png)
![Laravel Roles GUI Permissions Soft Deletes Dashboard](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-14.png)
![Laravel Roles GUI Success Restore](https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-15.png)

### File Tree

```bash
laravel-auth
├── .editorconfig
├── .env
├── .env.example
├── .env.travis
├── .gitattributes
├── .github
│   ├── FUNDING.yml
│   ├── ISSUE_TEMPLATE
│   │   ├── bug_report.md
│   │   ├── feature_request.md
│   │   └── project-questions-and-help.md
│   ├── dependabot.yml
│   ├── labeler.yml
│   └── workflows
│       ├── changelog.yml
│       ├── codeql.yml
│       ├── dependency-review.yml
│       ├── deploy.yml
│       ├── gitguardian.yml
│       ├── greetings.yml
│       ├── labeler.yml
│       ├── laravel.yml
│       ├── node.js.yml
│       ├── php.yml
│       ├── sentry.yml
│       └── stale.yml
├── .gitignore
├── .scripts
│   └── deploy.sh
├── .styleci.yml
├── .travis.yml
├── CODE_OF_CONDUCT.md
├── LICENSE
├── README.md
├── _config.yml
├── app
│   ├── Console
│   │   ├── Commands
│   │   │   └── DeleteExpiredActivations.php
│   │   └── Kernel.php
│   ├── Exceptions
│   │   ├── Handler.php
│   │   └── SocialProviderDeniedException.php
│   ├── Http
│   │   ├── Controllers
│   │   │   ├── AdminDetailsController.php
│   │   │   ├── Auth
│   │   │   │   ├── ActivateController.php
│   │   │   │   ├── AuthenticatedSessionController.php
│   │   │   │   ├── ConfirmablePasswordController.php
│   │   │   │   ├── ForgotPasswordController.php
│   │   │   │   ├── LoginController.php
│   │   │   │   ├── NewPasswordController.php
│   │   │   │   ├── PasswordController.php
│   │   │   │   ├── PasswordResetLinkController.php
│   │   │   │   ├── RegisterController.php
│   │   │   │   ├── RegisteredUserController.php
│   │   │   │   ├── ResetPasswordController.php
│   │   │   │   └── SocialController.php
│   │   │   ├── Controller.php
│   │   │   ├── ProfilesController.php
│   │   │   ├── RestoreUserController.php
│   │   │   ├── SoftDeletesController.php
│   │   │   ├── TermsController.php
│   │   │   ├── ThemesManagementController.php
│   │   │   ├── UserController.php
│   │   │   ├── UsersManagementController.php
│   │   │   └── WelcomeController.php
│   │   ├── Kernel.php
│   │   ├── Middleware
│   │   │   ├── Authenticate.php
│   │   │   ├── CheckCurrentUser.php
│   │   │   ├── CheckIsUserActivated.php
│   │   │   ├── EncryptCookies.php
│   │   │   ├── PreventRequestsDuringMaintenance.php
│   │   │   ├── RedirectIfAuthenticated.php
│   │   │   ├── TrimStrings.php
│   │   │   ├── TrustHosts.php
│   │   │   ├── TrustProxies.php
│   │   │   ├── ValidateSignature.php
│   │   │   └── VerifyCsrfToken.php
│   │   ├── Requests
│   │   │   ├── Auth
│   │   │   │   └── LoginRequest.php
│   │   │   ├── DeleteUserAccount.php
│   │   │   ├── UpdateUserPasswordRequest.php
│   │   │   └── UpdateUserProfile.php
│   │   └── ViewComposers
│   │       └── ThemeComposer.php
│   ├── Logic
│   │   ├── Activation
│   │   │   └── ActivationRepository.php
│   │   └── Macros
│   │       └── HtmlMacros.php
│   ├── Mail
│   │   └── ExceptionOccured.php
│   ├── Models
│   │   ├── Activation.php
│   │   ├── Permission.php
│   │   ├── Profile.php
│   │   ├── Role.php
│   │   ├── Social.php
│   │   ├── Theme.php
│   │   └── User.php
│   ├── Notifications
│   │   ├── ResetPasswordNotification.php
│   │   ├── SendActivationEmail.php
│   │   └── SendGoodbyeEmail.php
│   ├── Providers
│   │   ├── AppServiceProvider.php
│   │   ├── AuthServiceProvider.php
│   │   ├── BroadcastServiceProvider.php
│   │   ├── ComposerServiceProvider.php
│   │   ├── EventServiceProvider.php
│   │   ├── LocalEnvironmentServiceProvider.php
│   │   ├── MacroServiceProvider.php
│   │   └── RouteServiceProvider.php
│   ├── Traits
│   │   ├── ActivationTrait.php
│   │   ├── CaptchaTrait.php
│   │   └── CaptureIpTrait.php
│   └── View
│       └── Components
│           ├── AppLayout.php
│           └── GuestLayout.php
├── artisan
├── bootstrap
│   ├── app.php
│   └── cache
│       ├── .gitignore
│       ├── packages.php
│       └── services.php
├── composer.json
├── composer.lock
├── config
│   ├── app.php
│   ├── auth.php
│   ├── broadcasting.php
│   ├── cache.php
│   ├── cors.php
│   ├── database.php
│   ├── debugbar.php
│   ├── exceptions.php
│   ├── filesystems.php
│   ├── gravatar.php
│   ├── hashing.php
│   ├── laravel2step.php
│   ├── laravelPhpInfo.php
│   ├── laravelblocker.php
│   ├── logging.php
│   ├── mail.php
│   ├── queue.php
│   ├── roles.php
│   ├── sanctum.php
│   ├── services.php
│   ├── session.php
│   ├── settings.php
│   ├── usersmanagement.php
│   └── view.php
├── database
│   ├── .gitignore
│   ├── factories
│   │   └── UserFactory.php
│   ├── migrations
│   │   ├── 2014_10_12_000000_create_users_table.php
│   │   ├── 2014_10_12_100000_create_password_resets_table.php
│   │   ├── 2016_01_15_105324_create_roles_table.php
│   │   ├── 2016_01_15_114412_create_role_user_table.php
│   │   ├── 2016_01_26_115212_create_permissions_table.php
│   │   ├── 2016_01_26_115523_create_permission_role_table.php
│   │   ├── 2016_02_09_132439_create_permission_user_table.php
│   │   ├── 2017_03_09_082449_create_social_logins_table.php
│   │   ├── 2017_03_09_082526_create_activations_table.php
│   │   ├── 2017_03_20_213554_create_themes_table.php
│   │   ├── 2017_03_21_042918_create_profiles_table.php
│   │   ├── 2017_12_09_070937_create_two_step_auth_table.php
│   │   ├── 2019_02_19_032636_create_laravel_blocker_types_table.php
│   │   ├── 2019_02_19_045158_create_laravel_blocker_table.php
│   │   ├── 2019_08_19_000000_create_failed_jobs_table.php
│   │   ├── 2019_12_14_000001_create_personal_access_tokens_table.php
│   │   └── 2023_02_26_001638_create_email_log.php
│   └── seeders
│       ├── BlockedItemsTableSeeder.php
│       ├── BlockedTypeTableSeeder.php
│       ├── ConnectRelationshipsSeeder.php
│       ├── DatabaseSeeder.php
│       ├── PermissionsTableSeeder.php
│       ├── RolesTableSeeder.php
│       ├── ThemesTableSeeder.php
│       └── UsersTableSeeder.php
├── eslint.config.mjs
├── license.svg
├── package-lock.json
├── package.json
├── phpunit.xml
├── postcss.config.js
├── public
│   ├── .htaccess
│   ├── build
│   │   ├── .vite
│   │   │   └── manifest.json
│   │   └── assets
│   │       ├── app-B7vS8Mbm.css
│   │       ├── app-BG0_vVbD.js
│   │       ├── app-BG0_vVbD.js.map
│   │       ├── app-WPGwnzyH.css
│   │       ├── app-legacy-DDUFYwBY.js
│   │       ├── app-legacy-DDUFYwBY.js.map
│   │       ├── app-legacy-Mb7mMJCE.js
│   │       ├── app-legacy-Mb7mMJCE.js.map
│   │       ├── fa-brands-400-D1LuMI3I.ttf
│   │       ├── fa-brands-400-D_cYUPeE.woff2
│   │       ├── fa-regular-400-BjRzuEpd.woff2
│   │       ├── fa-regular-400-DZaxPHgR.ttf
│   │       ├── fa-solid-900-CTAAxXor.woff2
│   │       ├── fa-solid-900-D0aA9rwL.ttf
│   │       ├── fa-v4compatibility-C9RhG_FT.woff2
│   │       ├── fa-v4compatibility-CCth-dXg.ttf
│   │       ├── fontawesome-webfont-B-jkhYfk.woff2
│   │       ├── fontawesome-webfont-CDK5bt4p.woff
│   │       ├── fontawesome-webfont-CQDK8MU3.ttf
│   │       ├── fontawesome-webfont-D13rzr4g.svg
│   │       ├── fontawesome-webfont-G5YE5S7X.eot
│   │       ├── polyfills-legacy-Ci8jmAHT.js
│   │       ├── polyfills-legacy-Ci8jmAHT.js.map
│   │       ├── wink.png
│   │       └── wink.svg
│   ├── css
│   │   └── app.css
│   ├── favicon.ico
│   ├── fonts
│   │   ├── fontawesome-webfont.eot
│   │   ├── fontawesome-webfont.svg
│   │   ├── fontawesome-webfont.ttf
│   │   ├── fontawesome-webfont.woff
│   │   ├── fontawesome-webfont.woff2
│   │   ├── glyphicons-halflings-regular.eot
│   │   ├── glyphicons-halflings-regular.svg
│   │   ├── glyphicons-halflings-regular.ttf
│   │   ├── glyphicons-halflings-regular.woff
│   │   └── glyphicons-halflings-regular.woff2
│   ├── images
│   │   ├── wink.png
│   │   └── wink.svg
│   ├── index.php
│   ├── robots.txt
│   └── web.config
├── resources
│   ├── assets
│   │   ├── js
│   │   │   ├── app.js
│   │   │   ├── bootstrap.js
│   │   │   └── components
│   │   │       ├── ExampleComponent.vue
│   │   │       └── UsersCount.vue
│   │   ├── sass
│   │   │   ├── _avatar.scss
│   │   │   ├── _badges.scss
│   │   │   ├── _bootstrap-social.scss
│   │   │   ├── _buttons.scss
│   │   │   ├── _forms.scss
│   │   │   ├── _helpers.scss
│   │   │   ├── _hideShowPassword.scss
│   │   │   ├── _lists.scss
│   │   │   ├── _logs.scss
│   │   │   ├── _margins.scss
│   │   │   ├── _mixins.scss
│   │   │   ├── _modals.scss
│   │   │   ├── _panels.scss
│   │   │   ├── _password.scss
│   │   │   ├── _socials.scss
│   │   │   ├── _typography.scss
│   │   │   ├── _user-profile.scss
│   │   │   ├── _variables.scss
│   │   │   ├── _visibility.scss
│   │   │   ├── _wells.scss
│   │   │   └── app.scss
│   │   └── scss
│   │       └── .gitkeep
│   ├── lang
│   │   ├── en
│   │   │   ├── auth.php
│   │   │   ├── emails.php
│   │   │   ├── forms.php
│   │   │   ├── modals.php
│   │   │   ├── pagination.php
│   │   │   ├── passwords.php
│   │   │   ├── permsandroles.php
│   │   │   ├── profile.php
│   │   │   ├── socials.php
│   │   │   ├── terms.php
│   │   │   ├── themes.php
│   │   │   ├── titles.php
│   │   │   ├── usersmanagement.php
│   │   │   └── validation.php
│   │   ├── fr
│   │   │   ├── auth.php
│   │   │   ├── emails.php
│   │   │   ├── forms.php
│   │   │   ├── modals.php
│   │   │   ├── pagination.php
│   │   │   ├── passwords.php
│   │   │   ├── permsandroles.php
│   │   │   ├── profile.php
│   │   │   ├── socials.php
│   │   │   ├── titles.php
│   │   │   ├── usersmanagement.php
│   │   │   └── validation.php
│   │   └── pt-br
│   │       ├── auth.php
│   │       ├── emails.php
│   │       ├── forms.php
│   │       ├── modals.php
│   │       ├── pagination.php
│   │       ├── passwords.php
│   │       ├── permsandroles.php
│   │       ├── profile.php
│   │       ├── socials.php
│   │       ├── themes.php
│   │       ├── titles.php
│   │       ├── usersmanagement.php
│   │       └── validation.php
│   └── views
│       ├── auth
│       │   ├── activation.blade.php
│       │   ├── exceeded.blade.php
│       │   ├── login.blade.php
│       │   ├── passwords
│       │   │   ├── email.blade.php
│       │   │   └── reset.blade.php
│       │   └── register.blade.php
│       ├── emails
│       │   └── exception.blade.php
│       ├── errors
│       │   ├── 401.blade.php
│       │   ├── 403.blade.php
│       │   ├── 404.blade.php
│       │   ├── 500.blade.php
│       │   └── 503.blade.php
│       ├── home.blade.php
│       ├── layouts
│       │   ├── app.blade.php
│       │   ├── guest.blade.php
│       │   └── navigation.blade.php
│       ├── modals
│       │   ├── modal-delete.blade.php
│       │   ├── modal-form.blade.php
│       │   └── modal-save.blade.php
│       ├── pages
│       │   ├── admin
│       │   │   ├── active-users.blade.php
│       │   │   ├── home.blade.php
│       │   │   └── route-details.blade.php
│       │   ├── public
│       │   │   └── terms.blade.php
│       │   ├── status.blade.php
│       │   └── user
│       │       └── home.blade.php
│       ├── panels
│       │   └── welcome-panel.blade.php
│       ├── partials
│       │   ├── errors.blade.php
│       │   ├── form-status.blade.php
│       │   ├── nav.blade.php
│       │   ├── search-users-form.blade.php
│       │   ├── socials-icons.blade.php
│       │   ├── socials.blade.php
│       │   ├── status-panel.blade.php
│       │   └── status.blade.php
│       ├── profiles
│       │   ├── edit.blade.php
│       │   └── show.blade.php
│       ├── scripts
│       │   ├── check-changed.blade.php
│       │   ├── datatables.blade.php
│       │   ├── delete-modal-script.blade.php
│       │   ├── form-modal-script.blade.php
│       │   ├── ga-analytics.blade.php
│       │   ├── gmaps-address-lookup-api3.blade.php
│       │   ├── google-maps-geocode-and-map.blade.php
│       │   ├── save-modal-script.blade.php
│       │   ├── search-users.blade.php
│       │   ├── toggleStatus.blade.php
│       │   ├── tooltips.blade.php
│       │   └── user-avatar-dz.blade.php
│       ├── themesmanagement
│       │   ├── add-theme.blade.php
│       │   ├── edit-theme.blade.php
│       │   ├── show-theme.blade.php
│       │   └── show-themes.blade.php
│       ├── usersmanagement
│       │   ├── create-user.blade.php
│       │   ├── edit-user.blade.php
│       │   ├── show-deleted-user.blade.php
│       │   ├── show-deleted-users.blade.php
│       │   ├── show-user.blade.php
│       │   └── show-users.blade.php
│       └── welcome.blade.php
├── routes
│   ├── api.php
│   ├── channels.php
│   ├── console.php
│   └── web.php
├── tailwind.config.js
├── tailwindcss-perspective.js
└── vite.config.js
```

-   Tree command can be installed using brew: `brew install tree`
-   File tree generated using command `tree -a -I '.git|node_modules|vendor|storage|tests'`

### Opening an Issue

Before opening an issue there are a couple of considerations:

-   You are all awesome!
-   **Please Read the instructions** and make sure all steps were _followed correctly_.
-   **Please Check** that the issue is not _specific to the development environment_ setup.
-   **Please Provide** _duplication steps_.
-   **Please Attempt to look into the issue**, and if you _have a solution, make a pull request_.
-   **Please Show that you have made an attempt** to _look into the issue_.
-   **Please Check** to see if the issue you are _reporting is a duplicate_ of a previous reported issue.

### Laravel Auth License

Licensed under the [MIT license](https://opensource.org/licenses/MIT). Enjoy!

### Contributors

-   Thanks goes to these [wonderful people](https://github.com/jeremykenedy/laravel-auth/graphs/contributors):
-   Please feel free to contribute and make pull requests!
