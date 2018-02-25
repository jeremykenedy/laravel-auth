#### Laravel-Auth is a Complete Build of Laravel 5.6 with Email Registration Verification, Social Authentication, User Roles and Permissions, User Profiles, and Admin restricted user management system.
[![Build Status](https://travis-ci.org/jeremykenedy/laravel-auth.svg?branch=master)](https://travis-ci.org/jeremykenedy/laravel-auth)
[![StyleCI](https://styleci.io/repos/44714043/shield?branch=master)](https://styleci.io/repos/44714043)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/jeremykenedy/laravel-auth/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/jeremykenedy/laravel-auth/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/jeremykenedy/laravel-auth/badges/build.png?b=master)](https://scrutinizer-ci.com/g/jeremykenedy/laravel-auth/build-status/master)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

#### READY FOR USE!
- [About](#about)
- [Features](#features)
- [Installation Instructions](#installation-instructions)
    - [Build the Front End Assets with Mix](#rebuild-front-end-assets-with-mix)
    - [Optionally Build Cache](#optionally-build-cache)
- [Seeds](#seeds)
    - [Seeded Roles](#seeded-roles)
    - [Seeded Permissions](#seeded-permissions)
    - [Seeded Users](#seeded-users)
    - [Themes Seed List](#themes-seed-list)
- [Routes](#routes)
    - [Authentication Routes](#authentication-routes)
    - [Profile Routes](#profile-routes)
    - [Admin Routes](#admin-routes)
- [Socialite](#socialite)
    - [Get Socialite Login API Keys](#get-socialite-login-api-keys)
    - [Add More Socialite Logins](#add-more-socialite-logins)
- [Other API keys](#other-api-keys)
- [Environment File](#environment-file)
- [Updates](#updates)
- [Screenshots](#screenshots)
- [File Tree](#file-tree)
- [Opening an Issue](#opening-an-issue)
- [Laravel Auth License](#laravel-auth-license)

### About
Laravel 5.6 with user authentication, registration with email confirmation, social media authentication, password recovery, and captcha protection. This also makes full use of Controllers for the routes, templates for the views, and makes use of middleware for routing. Project can be stood up in minutes.

### Features
#### A [Laravel](http://laravel.com/) 5.6.x with minimal [Bootstrap](http://getbootstrap.com) 3.7.x project.

| Laravel-Auth Features  |
| :------------ |
|Built on [Laravel](http://laravel.com/) 5.6|
|Uses [MySQL](https://github.com/mysql) Database|
|Uses [Artisan](http://laravel.com/docs/5.6/artisan) to manage database migration, schema creations, and create/publish page controller templates|
|Dependencies are managed with [COMPOSER](https://getcomposer.org/)|
|Laravel Scaffolding **User** and **Administrator Authentication**.|
|User [Socialite Logins](https://github.com/laravel/socialite) ready to go - See API list used below|
|[Google Maps API v3](https://developers.google.com/maps/documentation/javascript/) for User Location lookup and Geocoding|
|CRUD (Create, Read, Update, Delete) Themes Management|
|CRUD (Create, Read, Update, Delete) User Management|
|Robust [Laravel Logging](https://laravel.com/docs/5.6/errors#logging) with admin UI using MonoLog|
|Google [reCaptcha Protection with Google API](https://developers.google.com/recaptcha/)|
|User Registration with email verification|
|Makes us of Laravel [Mix](https://laravel.com/docs/5.6/mix) to compile assets|
|Makes use of [Language Localization Files](https://laravel.com/docs/5.6/localization)|
|Active Nav states using [Laravel Requests](https://laravel.com/docs/5.6/requests)|
|Restrict User Email Activation Attempts|
|Capture IP to users table upon signup|
|Uses [Laravel Debugger](https://github.com/barryvdh/laravel-debugbar) for development|
|Makes us of [Password Strength Meter](https://github.com/elboletaire/password-strength-meter)|
|Makes use of [hideShowPassword](https://github.com/cloudfour/hideShowPassword)|
|User Avatar Image AJAX Upload with [Dropzone.js](http://www.dropzonejs.com/#configuration)|
|User Gravatar using [Gravatar API](https://github.com/creativeorange/gravatar)|
|User Password Reset via Email Token|
|User Login with remember password|
|User [Roles/ACL Implementation](https://github.com/jeremykenedy/laravel-roles)|
|Makes of [Laravel's Soft Delete Structure](https://laravel.com/docs/5.6/eloquent#soft-deleting)|
|Soft Deleted Users Management System|
|Permanently Delete Soft Deleted Users|
|User Delete Account with Goodbye email|
|User Restore Deleted Account Token|
|Restore Soft Deleted Users|
|View Soft Deleted Users|
|Captures Soft Delete Date|
|Captures Soft Delete IP|
|Admin Routing Details UI|
|Admin PHP Information UI|
|Eloquent user profiles|
|User Themes|
|404 Page|
|403 Page|
|Configurable Email Notification via [Laravel-Exception-Notifier](https://github.com/jeremykenedy/laravel-exception-notifier)|
|User Delete with Goodby email|
|User Restore Deleted Account|
|Activity Logging using [Laravel-logger](https://github.com/jeremykenedy/laravel-logger)|
|Optional 2-step account login verfication with [Laravel 2-Step Verification](https://github.com/jeremykenedy/laravel2step)|
|Uses [Laravel PHP Info](https://github.com/jeremykenedy/laravel-phpinfo) package|

### Installation Instructions
1. Run `git clone https://github.com/jeremykenedy/laravel-auth.git laravel-auth`
2. Create a MySQL database for the project
    * ```mysql -u root -p```, if using Vagrant: ```mysql -u homestead -psecret```
    * ```create database laravelAuth;```
    * ```\q```
3. From the projects root run `cp .env.example .env`
4. Configure your `.env` file
5. Run `composer update` from the projects root folder
6. From the projects root folder run:
```
php artisan vendor:publish --tag=laravelroles &&
php artisan vendor:publish --tag=laravel2step
```
7. From the projects root folder run `sudo chmod -R 755 ../laravel-auth`
8. From the projects root folder run `php artisan key:generate`
9. From the projects root folder run `php artisan migrate`
10. From the projects root folder run `composer dump-autoload`
11. From the projects root folder run `php artisan db:seed`
12. Compile the front end assets with [npm steps](#using-npm) or [yarn steps](#using-yarn).

#### Build the Front End Assets with Mix
##### Using NPM:
1. From the projects root folder run `npm install`
2. From the projects root folder run `npm run dev` or `npm run production`
  * You can watch assets with `npm run watch`

##### Using Yarn:
1. From the projects root folder run `yarn install`
2. From the projects root folder run `yarn run dev` or `yarn run production`
  * You can watch assets with `yarn run watch`

#### Optionally Build Cache
1. From the projects root folder run `php artisan config:cache`

###### And thats it with the caveat of setting up and configuring your development environment. I recommend [Laravel Homestead](https://laravel.com/docs/5.6/homestead)

### Seeds
##### Seeded Roles
  * Unverified - Level 0
  * User  - Level 1
  * Administrator - Level 5

##### Seeded Permissions
  * view.users
  * create.users
  * edit.users
  * delete.users

##### Seeded Users

|Email|Password|Access|
|:------------|:------------|:------------|
|user@user.com|password|User Access|
|admin@admin.com|password|Admin Access|

##### Themes Seed List
  * [ThemesTableSeeder](https://github.com/jeremykenedy/laravel-auth/blob/master/database/seeds/ThemesTableSeeder.php)

### Routes

#### Authentication Routes
* ```/login```
* ```/logout```
* ```/register```
* ```/password/email```
* ```/password/reset```
* ```/activate```
* ```/activate/{token}```
* ```/activation-required```
* ```/re-activate/{token}```

#### Profile Routes
* ```/profile/{username}```
* ```/profile/{username}/edit``` <- Editing in this view is limited to current user only.

#### Admin User Management Routes
* ```/users```
* ```/users/create```
* ```/users/{user_id}```
* ```/users{user_id}/edit```

#### Admin Theme Routes
* ```/themes```
* ```/themes/create```
* ```/themes/{theme_id}```
* ```/themes/{theme_id}/edit```

#### Admin Tools Routes
* ```/logs```
* ```/phpinfo```
* ```/routes```

#### Admin Soft Deleted Users Management Routes
* ```/users/deleted```
* ```/users/deleted/{user_id}```

#### Activity Log Routes
* ```/activity```
* ```/activity/cleared```
* ```/activity/log/{id}```
* ```/activity/cleared/log/{id}```

#### 2-Step Verfication Routes (disabled by default in .env.example file)
* ```/verification/needed```
* ```/verification/verify```
* ```/verification/resend```

### Socialite

#### Get Socialite Login API Keys:
* [Google Captcha API](https://www.google.com/recaptcha/admin#list)
* [Facebook API](https://developers.facebook.com/)
* [Twitter API](https://apps.twitter.com/)
* [Google &plus; API](https://console.developers.google.com/)
* [GitHub API](https://github.com/settings/applications/new)
* [YouTube API](https://developers.google.com/youtube/v3/getting-started)
* [Twitch TV API](http://www.twitch.tv/kraken/oauth2/clients/new)
* [Instagram API](https://instagram.com/developer/register/)
* [37 Signals API](https://github.com/basecamp/basecamp-classic-api)

#### Add More Socialite Logins
* See full list of providers: [http://socialiteproviders.github.io](http://socialiteproviders.github.io/#providers)
###### **Steps**:
  1. Go to [http://socialiteproviders.github.io](http://socialiteproviders.github.io/providers/twitch/) and select the provider to be added.
  2. From the projects root folder in terminal run composer command to get the needed package.
     * Example:

      ```
         composer require socialiteproviders/twitch
      ```

  3. From the projects root folder run ```composer update```
  4. Add the service provider to ```/config/services.php```
     * Example:

     ```
        'twitch' => [
            'client_id'   => env('TWITCH_KEY'),
            'client_secret' => env('TWITCH_SECRET'),
            'redirect'    => env('TWITCH_REDIRECT_URI'),
        ],
     ```

  5. Add the API credentials to ``` /.env  ```
     * Example:

      ```
         TWITCH_KEY=YOURKEYHERE
         TWITCH_SECRET=YOURSECRETHERE
         TWITCH_REDIRECT_URI=http://YOURWEBSITEURL.COM/social/handle/twitch
      ```

  6. Add the social media login link:
      * Example:
      In file ```/resources/views/auth/login.blade.php``` add ONE of the following:
         * Conventional HTML:
        ```
        <a href="{{ route('social.redirect', ['provider' => 'twitch']) }}" class="btn btn-lg btn-primary btn-block twitch">Twitch</a>
        ```
         * Use Laravel HTML Facade with [Laravel Collective](https://laravelcollective.com/):

        ```
        {!! HTML::link(route('social.redirect', ['provider' => 'twitch']), 'Twitch', array('class' => 'btn btn-lg btn-primary btn-block twitch')) !!}
        ```

### Other API keys
* [Google Maps API v3 Key](https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key)


### Environment File

Example `.env` file:

```bash

APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravelAuth
DB_USERNAME=homestead
DB_PASSWORD=secret

BROADCAST_DRIVER=pusher
CACHE_DRIVER=file
SESSION_DRIVER=file
SESSION_LIFETIME=120
QUEUE_DRIVER=sync

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

MAIL_FROM_ADDRESS=
MAIL_FROM_NAME=''

EMAIL_EXCEPTION_ENABLED=false
EMAIL_EXCEPTION_FROM=email@email.com
EMAIL_EXCEPTION_TO='email1@gmail.com, email2@gmail.com'
EMAIL_EXCEPTION_CC=''
EMAIL_EXCEPTION_BCC=''
EMAIL_EXCEPTION_SUBJECT=''

# You will also need to update the pusher credentials in /resources/assets/js/bootstrap.js - lines 64 - 66
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
LARAVEL_2STEP_USER_MODEL=App\User
LARAVEL_2STEP_EMAIL_FROM="jeremykenedy@gmail.com"
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
LARAVEL_2STEP_BOOTSTRAP_CSS_CDN="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"

DEFAULT_GRAVATAR_SIZE=80
DEFAULT_GRAVATAR_FALLBACK=http://c1940652.r52.cf0.rackcdn.com/51ce28d0fb4f442061000000/Screen-Shot-2013-06-28-at-5.22.23-PM.png
DEFAULT_GRAVATAR_SECURE=false
DEFAULT_GRAVATAR_MAX_RATING=g
DEFAULT_GRAVATAR_FORCE_DEFAULT=false
DEFAULT_GRAVATAR_FORCE_EXTENSION=jpg

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
LARAVEL_LOGGER_BOOTSTRAP_JS_CDN_URL=https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js
LARAVEL_LOGGER_FONT_AWESOME_CDN_ENABLED=false
LARAVEL_LOGGER_FONT_AWESOME_CDN_URL=https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css
LARAVEL_LOGGER_BOOTSTRAP_CSS_CDN_ENABLED=false
LARAVEL_LOGGER_BOOTSTRAP_CSS_CDN_URL=https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css

// NOTE: YOU CAN REMOVE THE KEY CALL IN app.blade.php IF YOU GET A POP UP AND DO NOT WANT TO SETUP A KEY FOR DEV
# Google Maps API v3 Key - https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key
GOOGLEMAPS_API_STATUS=true
GOOGLEMAPS_API_KEY=YOURGOOGLEMAPSkeyHERE

# https://console.developers.google.com/ - NEED OAUTH CREDS
GOOGLE_ID=YOURGOOGLEPLUSidHERE
GOOGLE_SECRET=YOURGOOGLEPLUSsecretHERE
GOOGLE_REDIRECT=http://yourwebsiteURLhere.com/social/handle/google

# https://www.google.com/recaptcha/admin#list
ENABLE_RECAPTCHA=true
RE_CAP_SITE=YOURGOOGLECAPTCHAsitekeyHERE
RE_CAP_SECRET=YOURGOOGLECAPTCHAsecretHERE

# https://developers.facebook.com/
FB_ID=YOURFACEBOOKidHERE
FB_SECRET=YOURFACEBOOKsecretHERE
FB_REDIRECT=http://yourwebsiteURLhere.com/social/handle/facebook

# https://apps.twitter.com/
TW_ID=YOURTWITTERidHERE
TW_SECRET=YOURTWITTERkeyHERE
TW_REDIRECT=http://yourwebsiteURLhere.com/social/handle/twitter

# https://github.com/settings/applications/new
GITHUB_ID=YOURIDHERE
GITHUB_SECRET=YOURSECRETHERE
GITHUB_URL=https://larablog.io/social/handle/github

# https://developers.google.com/youtube/v3/getting-started
YOUTUBE_KEY=YOURKEYHERE
YOUTUBE_SECRET=YOURSECRETHERE
YOUTUBE_REDIRECT_URI=https://larablog.io/social/handle/youtube

# http://www.twitch.tv/kraken/oauth2/clients/new
TWITCH_KEY=YOURKEYHERE
TWITCH_SECRET=YOURSECRETHERE
TWITCH_REDIRECT_URI=http://laravel-authentication.local/social/handle/twitch

# https://instagram.com/developer/register/
INSTAGRAM_KEY=YOURKEYHERE
INSTAGRAM_SECRET=YOURSECRETHERE
INSTAGRAM_REDIRECT_URI=http://laravel-authentication.local/social/handle/instagram

# https://basecamp.com/
# https://github.com/basecamp/basecamp-classic-api
37SIGNALS_KEY=YOURKEYHERE
37SIGNALS_SECRET=YOURSECRETHERE
37SIGNALS_REDIRECT_URI=http://laravel-authentication.local/social/handle/37signals

```

#### Laravel Developement Packages Used References
* http://laravel.com/docs/5.6/authentication
* http://laravel.com/docs/5.6/authorization
* http://laravel.com/docs/5.6/routing
* https://laravel.com/docs/5.6/migrations
* https://laravel.com/docs/5.6/queries
* https://laravel.com/docs/5.6/views
* https://laravel.com/docs/5.6/eloquent
* https://laravel.com/docs/5.6/eloquent-relationships
* https://laravel.com/docs/5.6/requests
* https://laravel.com/docs/5.6/errors

###### Updates:
* Update to Laravel 5.6
* Added optional 2-step account login verfication with [Laravel 2-Step Verification](https://github.com/jeremykenedy/laravel2step)
* Added activity logging using [Laravel-logger](https://github.com/jeremykenedy/laravel-logger)
* Added Configurable Email Notification using [Laravel-Exception-Notifier](https://github.com/jeremykenedy/laravel-exception-notifier)
* Update to Laravel 5.5
* Added User Delete with Goodbye email
* Added User Restore Deleted Account from email with secure token
* Added [Soft Deletes](https://laravel.com/docs/5.6/eloquent#soft-deleting) and Soft Deletes Management panel
* Added User Account Settings to Profile Edit
* Added User Change Password to Profile Edit
* Added User Delete Account to Profile Edit
* Added [Password Strength Meter](https://github.com/elboletaire/password-strength-meter)
* Added [hideShowPassword](https://github.com/cloudfour/hideShowPassword)
* Added Admin Routing Details
* Admin PHP Information
* Added Robust [Laravel Logging](https://laravel.com/docs/5.6/errors#logging) with admin UI using MonoLog
* Added Active Nav states using [Laravel Requests](https://laravel.com/docs/5.6/requests)
* Added [Laravel Debugger](https://github.com/barryvdh/laravel-debugbar) with Service Provider to manage status in `.env` file.
* Updated Capture IP not found IP address
* Added User Avatar Image AJAX Upload with [Dropzone.js](http://www.dropzonejs.com/#configuration)
* Added User Gravatar using Gravatar API
* Added Themes Management.
* Add user profiles with seeded list and global view
* Major overhaul on Laravel 5.4
* Update from Laravel 5.1 to 5.2
* Added eloquent editable user profile
* Added IP Capture
* Added Google Maps API v3 for User Location lookup
* Added Google Maps API v3 for User Location Input Geocoding
* Added Google Maps API v3 for User Location Map with Options
* Added CRUD(Create, Read, Update, Delete) User Management

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

### File Tree
```
laravel-auth
├── .circleci
│   └── config.yml
├── .env
├── .env.example
├── .env.travis
├── .gitattributes
├── .gitignore
├── .travis.yml
├── CODE_OF_CONDUCT.md
├── LICENSE
├── README.md
├── app
│   ├── Console
│   │   ├── Commands
│   │   │   └── DeleteExpiredActivations.php
│   │   └── Kernel.php
│   ├── Exceptions
│   │   └── Handler.php
│   ├── Http
│   │   ├── Controllers
│   │   │   ├── AdminDetailsController.php
│   │   │   ├── Auth
│   │   │   │   ├── ActivateController.php
│   │   │   │   ├── ForgotPasswordController.php
│   │   │   │   ├── LoginController.php
│   │   │   │   ├── RegisterController.php
│   │   │   │   ├── ResetPasswordController.php
│   │   │   │   └── SocialController.php
│   │   │   ├── Controller.php
│   │   │   ├── ProfilesController.php
│   │   │   ├── RestoreUserController.php
│   │   │   ├── SoftDeletesController.php
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
│   │   │   ├── RedirectIfAuthenticated.php
│   │   │   ├── TrimStrings.php
│   │   │   └── VerifyCsrfToken.php
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
│   │   ├── Profile.php
│   │   ├── Social.php
│   │   ├── Theme.php
│   │   └── User.php
│   ├── Notifications
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
│   └── Traits
│       ├── ActivationTrait.php
│       ├── CaptchaTrait.php
│       └── CaptureIpTrait.php
├── artisan
├── bootstrap
│   ├── app.php
│   ├── autoload.php
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
│   ├── database.php
│   ├── debugbar.php
│   ├── exceptions.php
│   ├── filesystems.php
│   ├── gravatar.php
│   ├── laravel2step.php
│   ├── laravelPhpInfo.php
│   ├── mail.php
│   ├── queue.php
│   ├── roles.php
│   ├── services.php
│   ├── session.php
│   ├── settings.php
│   └── view.php
├── database
│   ├── .gitignore
│   ├── factories
│   │   └── ModelFactory.php
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
│   │   └── 2017_12_09_070937_create_two_step_auth_table.php
│   └── seeds
│       ├── ConnectRelationshipsSeeder.php
│       ├── DatabaseSeeder.php
│       ├── PermissionsTableSeeder.php
│       ├── RolesTableSeeder.php
│       ├── ThemesTableSeeder.php
│       └── UsersTableSeeder.php
├── license.svg
├── package.json
├── packages
│   └── jeremykenedy
│       ├── laravel-https
│       │   ├── .gitignore
│       │   ├── LICENSE
│       │   ├── README.md
│       │   ├── composer.json
│       │   └── src
│       │       ├── LaravelHttpsServiceProvider.php
│       │       ├── app
│       │       │   └── Http
│       │       │       └── Middleware
│       │       │           ├── CheckHTTPS.php
│       │       │           └── ForceHTTPS.php
│       │       ├── config
│       │       │   └── laravel-https.php
│       │       └── resources
│       │           ├── lang
│       │           │   └── en
│       │           │       └── laravel-https.php
│       │           └── views
│       │               └── errors
│       │                   └── 403.blade.php
│       ├── laravel-logger
│       │   ├── .gitignore
│       │   ├── CODE_OF_CONDUCT.md
│       │   ├── LICENSE
│       │   ├── README.md
│       │   ├── composer.json
│       │   └── src
│       │       ├── .env.example
│       │       ├── LaravelLoggerServiceProvider.php
│       │       ├── app
│       │       │   ├── Http
│       │       │   │   ├── Controllers
│       │       │   │   │   └── LaravelLoggerController.php
│       │       │   │   ├── Middleware
│       │       │   │   │   └── LogActivity.php
│       │       │   │   └── Traits
│       │       │   │       ├── ActivityLogger.php
│       │       │   │       ├── IpAddressDetails.php
│       │       │   │       └── UserAgentDetails.php
│       │       │   ├── Listeners
│       │       │   │   ├── LogAuthenticated.php
│       │       │   │   ├── LogAuthenticationAttempt.php
│       │       │   │   ├── LogFailedLogin.php
│       │       │   │   ├── LogLockout.php
│       │       │   │   ├── LogPasswordReset.php
│       │       │   │   ├── LogSuccessfulLogin.php
│       │       │   │   └── LogSuccessfulLogout.php
│       │       │   ├── Logic
│       │       │   │   └── helpers.php
│       │       │   └── Models
│       │       │       └── Activity.php
│       │       ├── config
│       │       │   └── laravel-logger.php
│       │       ├── database
│       │       │   └── migrations
│       │       │       └── 2017_11_04_103444_create_laravel_logger_activity_table.php
│       │       ├── resources
│       │       │   ├── lang
│       │       │   │   └── en
│       │       │   │       └── laravel-logger.php
│       │       │   └── views
│       │       │       ├── forms
│       │       │       │   ├── clear-activity-log.blade.php
│       │       │       │   ├── delete-activity-log.blade.php
│       │       │       │   └── restore-activity-log.blade.php
│       │       │       ├── logger
│       │       │       │   ├── activity-log-cleared.blade.php
│       │       │       │   ├── activity-log-item.blade.php
│       │       │       │   ├── activity-log.blade.php
│       │       │       │   └── partials
│       │       │       │       └── activity-table.blade.php
│       │       │       ├── modals
│       │       │       │   └── confirm-modal.blade.php
│       │       │       ├── partials
│       │       │       │   ├── form-status.blade.php
│       │       │       │   └── styles.blade.php
│       │       │       └── scripts
│       │       │           ├── clickable-row.blade.php
│       │       │           ├── confirm-modal.blade.php
│       │       │           ├── datatables.blade.php
│       │       │           └── tooltip.blade.php
│       │       └── routes
│       │           └── web.php
│       └── laravel-pages
│           ├── .gitignore
│           ├── LICENSE.LICENSE
│           ├── README.md
│           ├── composer.json
│           └── src
│               └── LaravelPagesServiceProvider.php
├── phpunit.xml
├── public
│   ├── .htaccess
│   ├── css
│   │   ├── app.css
│   │   └── laravel2step
│   │       ├── app.css
│   │       └── app.min.css
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
│   ├── js
│   │   ├── app.99230f42ad184f498ce6.js
│   │   └── app.js
│   ├── mix-manifest.json
│   ├── robots.txt
│   └── web.config
├── resources
│   ├── assets
│   │   ├── js
│   │   │   ├── app.js
│   │   │   ├── bootstrap.js
│   │   │   └── components
│   │   │       ├── Example.vue
│   │   │       └── UsersCount.vue
│   │   ├── sass
│   │   │   ├── _avatar.scss
│   │   │   ├── _badges.scss
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
│   │   │   ├── _php-info.scss
│   │   │   ├── _socials.scss
│   │   │   ├── _typography.scss
│   │   │   ├── _variables.scss
│   │   │   ├── _wells.scss
│   │   │   └── app.scss
│   │   └── scss
│   │       └── laravel2step
│   │           ├── _animations.scss
│   │           ├── _mixins.scss
│   │           ├── _modals.scss
│   │           ├── _variables.scss
│   │           ├── _verification.scss
│   │           └── app.scss
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
│   │   │   ├── themes.php
│   │   │   ├── titles.php
│   │   │   ├── usersmanagement.php
│   │   │   └── validation.php
│   │   └── fr
│   │       ├── auth.php
│   │       ├── emails.php
│   │       ├── forms.php
│   │       ├── modals.php
│   │       ├── pagination.php
│   │       ├── passwords.php
│   │       ├── permsandroles.php
│   │       ├── profile.php
│   │       ├── socials.php
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
│       │   ├── 403.blade.php
│       │   ├── 404.blade.php
│       │   ├── 500.blade.php
│       │   └── 503.blade.php
│       ├── home.blade.php
│       ├── layouts
│       │   └── app.blade.php
│       ├── modals
│       │   ├── modal-delete.blade.php
│       │   ├── modal-form.blade.php
│       │   └── modal-save.blade.php
│       ├── pages
│       │   ├── admin
│       │   │   ├── active-users.blade.php
│       │   │   ├── home.blade.php
│       │   │   └── route-details.blade.php
│       │   ├── status.blade.php
│       │   └── user
│       │       └── home.blade.php
│       ├── panels
│       │   └── welcome-panel.blade.php
│       ├── partials
│       │   ├── errors.blade.php
│       │   ├── form-status.blade.php
│       │   ├── nav.blade.php
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
│       │   ├── gmaps-address-lookup-api3.blade.php
│       │   ├── google-maps-geocode-and-map.blade.php
│       │   ├── save-modal-script.blade.php
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
├── server.php
├── webpack.mix.js
└── yarn.lock
```

* Tree command can be installed using brew: `brew install tree`
* File tree generated using command `tree -a -I '.git|node_modules|vendor|storage|tests`

### Opening an Issue
Before opening an issue there are a couple of considerations:
* Read the instructions and make sure all steps were followed correctly.
* Check that the issue is not specific to your development environment setup.
* Provide duplication steps.
* Attempt to look into the issue, and if you have a solution, make a pull request.
* Show that you have made an attempt to look into the issue.
* Check to see if the issue you are reporting is a duplicate of a previous reported issue.
* If you did not star this repo I will close your issue immediatly without consideration. My time is valuable.

Open source projects are a the community’s responsibility to use, contribute, and debug.

### Laravel Auth License
Laravel-auth is licensed under the [MIT license](https://opensource.org/licenses/MIT). Enjoy!
