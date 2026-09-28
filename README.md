<p align="center">
    <picture>
        <source media="(prefers-color-scheme: dark)" srcset="art/banner-dark.svg">
        <source media="(prefers-color-scheme: light)" srcset="art/banner-light.svg">
        <img src="art/banner-light.svg" alt="Laravel Auth" width="800">
    </picture>
</p>

<p align="center">Laravel Auth is a Complete Build of Laravel 12 with Email Registration Verification, Social Authentication, User Roles and Permissions, User Profiles, and Admin restricted user management system. Built on Bootstrap 4.</p>

<p align="center">
    <a href="https://github.com/jeremykenedy/laravel-auth/actions/workflows/laravel.yml"><img src="https://github.com/jeremykenedy/laravel-auth/actions/workflows/laravel.yml/badge.svg" alt="Tests"></a>
    <a href="https://styleci.io/repos/44714043"><img src="https://styleci.io/repos/44714043/shield?branch=master" alt="StyleCI"></a>
    <a href="https://dashboard.gitguardian.com"><img src="https://github.com/jeremykenedy/laravel-auth/actions/workflows/gitguardian.yml/badge.svg" alt="GitGuardian scan"></a>
    <a href="https://sonarcloud.io/summary/new_code?id=jeremykenedy_laravel-auth"><img src="https://sonarcloud.io/api/project_badges/measure?project=jeremykenedy_laravel-auth&metric=alert_status" alt="Quality Gate Status"></a>
    <a href="https://www.codefactor.io/repository/github/jeremykenedy/laravel-auth"><img src="https://www.codefactor.io/repository/github/jeremykenedy/laravel-auth/badge" alt="CodeFactor"></a>
    <a href="https://app.codacy.com/gh/jeremykenedy/laravel-auth/dashboard"><img src="https://app.codacy.com/project/badge/Grade/014f2e900f26447f852f547dbd7ac3bd" alt="Codacy Badge"></a>
    <a href="https://scrutinizer-ci.com/g/jeremykenedy/laravel-auth/build-status/master"><img src="https://scrutinizer-ci.com/g/jeremykenedy/laravel-auth/badges/build.png?b=master" alt="Scrutinizer Build Status"></a>
    <a href="https://scrutinizer-ci.com/g/jeremykenedy/laravel-auth/?branch=master"><img src="https://scrutinizer-ci.com/g/jeremykenedy/laravel-auth/badges/quality-score.png?b=master" alt="Scrutinizer Code Quality"></a>
    <a href="https://scrutinizer-ci.com/code-intelligence"><img src="https://scrutinizer-ci.com/g/jeremykenedy/laravel-auth/badges/code-intelligence.svg?b=master" alt="Code Intelligence Status"></a>
    <a href="#contributors"><img src="https://img.shields.io/badge/all_contributors-23-orange.svg?style=flat-square" alt="All Contributors"></a>
    <a href="https://madewithlaravel.com/p/laravel-auth/shield-link"><img src="https://madewithlaravel.com/storage/repo-shields/1342-shield.svg" alt="MadeWithLaravel.com shield"></a>
    <a href="https://opensource.org/licenses/MIT"><img src="https://img.shields.io/badge/License-MIT-yellow.svg" alt="License: MIT"></a>
</p>

<p align="center">
    <a href="https://app.aikido.dev/repositories/3224660"><img src="https://app.aikido.dev/assets/badges/full-light-theme.svg" alt="Secured by Aikido" height="32"></a>
</p>

<p align="center">
    <a href="https://github.com/sponsors/jeremykenedy"><img src="https://img.shields.io/static/v1?label=Sponsor&message=%E2%9D%A4&logo=GitHub&color=%23fe8e86" alt="Sponsor me on GitHub"></a>
    <a href="https://github.com/jeremykenedy/laravel-auth/stargazers"><img src="https://img.shields.io/github/stars/jeremykenedy/laravel-auth?style=social" alt="GitHub Stars"></a>
    <a href="https://github.com/jeremykenedy"><img src="https://img.shields.io/github/followers/jeremykenedy?style=social" alt="Follow on GitHub"></a>
</p>

### Note

If you like this, you will love [Laravel Auth Spa](https://github.com/jeremykenedy/laravel-spa) with configurable providers from an admin panel.

#### Table of contents

- [About](#about)
- [Features](#features)
- [Installation Instructions](#installation-instructions)
    - [Full Installation Guide](INSTALLATION.md)
    - [Build the Front End Assets with Mix](#build-the-front-end-assets-with-mix)
  -   [Optionally Build Cache](#optionally-build-cache)
- [Seeds](docs/seeds.md)
- [Routes](docs/routes.md)
- [Socialite](docs/socialite.md)
- [Environment File](docs/environment.md)
- [Updates](docs/updates.md)
- [Screenshots](#screenshots)
- [File Tree](docs/file-tree.md)
- [Opening an Issue](#opening-an-issue)
- [License](#license)
-   [Contributors](#contributors)

### About

Laravel 12 with user authentication, registration with email confirmation, social media authentication, password recovery, and captcha protection. Uses official [Bootstrap 4](https://getbootstrap.com). This also makes full use of Controllers for the routes, templates for the views, and makes use of middleware for routing. Project can be stood up in minutes.

### Features

#### A [Laravel](https://laravel.com/) 12 with [Bootstrap](https://getbootstrap.com) 4.x project

- Built on [Laravel](https://laravel.com/) 12 and [Bootstrap](https://getbootstrap.com/) 4
- Uses [MySQL](https://github.com/mysql) Database (can be changed)
- Uses [Artisan](https://laravel.com/docs/master/artisan) to manage database migration, schema creations, and create/publish page controller templates
- Dependencies are managed with [COMPOSER](https://getcomposer.org/)
- Laravel Scaffolding **User** and **Administrator Authentication**
- User [Socialite Logins](https://github.com/laravel/socialite) ready to go - See API list used below
- [Google Maps API v3](https://developers.google.com/maps/documentation/javascript/) for User Location lookup and Geocoding
- CRUD (Create, Read, Update, Delete) Themes Management
- CRUD (Create, Read, Update, Delete) User Management
- Robust [Laravel Logging](https://laravel.com/docs/master/errors#logging) with admin UI using MonoLog
- Google [reCaptcha Protection with Google API](https://developers.google.com/recaptcha/)
-   User Registration with email verification
-   Makes use of Laravel [Mix](https://laravel.com/docs/master/mix) to compile assets
-   Makes use of [Language Localization Files](https://laravel.com/docs/master/localization)
-   Active Nav states using [Laravel Requests](https://laravel.com/docs/master/requests)
-   Restrict User Email Activation Attempts
-   Capture IP to users table upon signup
-   Uses [Laravel Debugger](https://github.com/barryvdh/laravel-debugbar) for development
-   Makes use of [Password Strength Meter](https://github.com/elboletaire/password-strength-meter)
-   Makes use of [hideShowPassword](https://github.com/cloudfour/hideShowPassword)
-   User Avatar Image AJAX Upload with [Dropzone.js](https://www.dropzonejs.com/#configuration)
-   User Gravatar using [Gravatar API](https://github.com/creativeorange/gravatar)
-   User Password Reset via Email Token
-   User Login with remember password
-   User [Roles/ACL Implementation](https://github.com/jeremykenedy/laravel-roles) with a Roles and Permissions GUI
-   Makes use of [Laravel's Soft Delete Structure](https://laravel.com/docs/master/eloquent#soft-deleting)
-   Soft Deleted Users Management System: restore, permanently delete, and view soft deleted users
-   Captures Soft Delete Date and Soft Delete IP
-   User Delete Account with Goodbye email
-   User Restore Deleted Account Token
-   Admin Routing Details UI
-   Admin PHP Information UI
-   Eloquent user profiles
-   User Themes
-   404 and 403 Pages
-   Configurable Email Notification via [Laravel-Exception-Notifier](https://github.com/jeremykenedy/laravel-exception-notifier)
-   Activity Logging using [Laravel-logger](https://github.com/jeremykenedy/laravel-logger)
-   Optional 2-step account login verfication with [Laravel 2-Step Verification](https://github.com/jeremykenedy/laravel2step)
-   Uses [Laravel PHP Info](https://github.com/jeremykenedy/laravel-phpinfo) package
-   Uses [Laravel Blocker](https://github.com/jeremykenedy/laravel-blocker) package

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

1. From the projects root folder run `sudo chmod -R 755 ../laravel-auth`
2. From the projects root folder run `php artisan key:generate`
3. From the projects root folder run `php artisan migrate`
4. From the projects root folder run `composer dump-autoload`
5. From the projects root folder run `php artisan db:seed`
6. Compile the front end assets with [npm steps](#using-npm) or [yarn steps](#using-yarn).

#### Build the Front End Assets with Vite

##### Using Yarn

1. Install yarn (dependent on your distribution)
2. From the projects root folder run `yarn install`
3. From the projects root folder run `yarn run dev` or `yarn run build`

##### Using NPM

1. From the projects root folder run `npm install`
2. From the projects root folder run `npm run dev` or `npm run build`

#### Optionally Build Cache

1. From the projects root folder run `php artisan config:cache`

### Seeds

Seeded roles, permissions, users, themes, and blocker lists: see [docs/seeds.md](docs/seeds.md).

### Routes

Full route list: see [docs/routes.md](docs/routes.md).

### Socialite

Socialite API key setup and adding more providers: see [docs/socialite.md](docs/socialite.md).

### Environment File

Full example `.env` file and Laravel documentation references: see [docs/environment.md](docs/environment.md).

### Updates

Changelog: see [docs/updates.md](docs/updates.md).

### Screenshots

<table>
    <tr>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/1laravel-auth2-login.jpg" alt="Login" width="400"></td>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/2laravel-auth2-register.jpg" alt="Register" width="400"></td>
    </tr>
    <tr>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/3laravel-auth2-account-req-activation.jpg" alt="Registration Confirmation" width="400"></td>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/4laravel-auth2-activation-email.jpg" alt="Registration Email" width="400"></td>
    </tr>
    <tr>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/5laravel-auth2-userhome-with-flash-success.jpg" alt="Registration Complete" width="400"></td>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/6laravel-auth2-profile-mapless.jpg" alt="Intial User Profile" width="400"></td>
    </tr>
    <tr>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/7laravel-auth2-profile-edit.jpg" alt="Edit User Profile" width="400"></td>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/8laravel-auth2-edit-profile-lookup.jpg" alt="Find Location Using Google Maps API v3" width="400"></td>
    </tr>
    <tr>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/9laravel-auth2-flash-success.jpg" alt="Profile Updated" width="400"></td>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/10laravel-auth2-profile-with-map.jpg" alt="Profile Semi-completed" width="400"></td>
    </tr>
</table>

<table>
    <tr>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/11laravel-auth2-users-list.jpg" alt="Admin Panel Users List" width="400"></td>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/12laravel-auth2-modal-delete.jpg" alt="Admin Panel Delete User" width="400"></td>
    </tr>
    <tr>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/13laravel-auth2-flash-error.jpg" alt="Admin Panel Flash Error" width="400"></td>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/14laravel-auth2-show-edit.jpg" alt="Admin Panel Show User" width="400"></td>
    </tr>
    <tr>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/15laravel-auth2-edit-user.jpg" alt="Admin Panel Edit User" width="400"></td>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/16laravel-auth2-modal-save.jpg" alt="Admin Panel Save Edits" width="400"></td>
    </tr>
    <tr>
        <td valign="top" width="100%" colspan="2"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-auth/17laravel-auth-create-user.jpg" alt="Admin Panel Create User" width="400"></td>
    </tr>
</table>

<table>
    <tr>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-logger/1-dashboard.jpg" alt="dashboard" width="400"></td>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-logger/2-drilldown.jpg" alt="drilldown" width="400"></td>
    </tr>
    <tr>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-logger/3-confirm-clear.jpg" alt="confirm-clear" width="400"></td>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-logger/4-log-cleared-msg.jpg" alt="log-cleared-msg" width="400"></td>
    </tr>
    <tr>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-logger/5-cleared-log.jpg" alt="cleared-log" width="400"></td>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-logger/5-confirm-restore.jpg" alt="confirm-restore" width="400"></td>
    </tr>
    <tr>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-logger/6-confirm-destroy.jpg" alt="confirm-destroy" width="400"></td>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-logger/7-success-destroy.jpg" alt="success-destroy" width="400"></td>
    </tr>
    <tr>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-logger/8-success-restored.jpg" alt="success-restored" width="400"></td>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-logger/9-cleared-drilldown.jpg" alt="cleared-drilldown" width="400"></td>
    </tr>
</table>

<table>
    <tr>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel2step/1-verification-page.jpeg" alt="Verification Page" width="400"></td>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel2step/2-verification-email-resent.jpeg" alt="Resent Email Modal" width="400"></td>
    </tr>
    <tr>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel2step/3-lock-warning.jpeg" alt="Lock Warning Modal" width="400"></td>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel2step/4-lock-screen.jpeg" alt="Locked Page" width="400"></td>
    </tr>
    <tr>
        <td valign="top" width="100%" colspan="2"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel2step/5-verification-email.jpeg" alt="Verification Email" width="400"></td>
    </tr>
</table>

<table>
    <tr>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-blocker/blocker0.jpg" alt="Laravel Blocker Dashboard" width="400"></td>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-blocker/blocker1.jpg" alt="Laravel Blocker Search" width="400"></td>
    </tr>
    <tr>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-blocker/blocker2.jpg" alt="Laravel Blocker Create" width="400"></td>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-blocker/blocker3.jpg" alt="Laravel Blocker View" width="400"></td>
    </tr>
    <tr>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-blocker/blocker4.jpg" alt="Laravel Blocker Edit" width="400"></td>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-blocker/blocker5.jpg" alt="Laravel Blocker Delete Modal" width="400"></td>
    </tr>
    <tr>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-blocker/blocker6.jpg" alt="Laravel Blocker Deleted Dashboard" width="400"></td>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-blocker/blocker7.jpg" alt="Laravel Blocker Destroy Modal" width="400"></td>
    </tr>
    <tr>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-blocker/blocker8.jpg" alt="Laravel Blocker Flash Message" width="400"></td>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-blocker/blocker9.jpg" alt="Laravel Blocker Restore Modal" width="400"></td>
    </tr>
    <tr>
        <td valign="top" width="100%" colspan="2"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-blocker/blocker10.jpg" alt="Laravel Blocker Restore Flash Message" width="400"></td>
    </tr>
</table>

<table>
    <tr>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-1.png" alt="Laravel Roles GUI Dashboard" width="400"></td>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-2.png" alt="Laravel Roles GUI Create New Role" width="400"></td>
    </tr>
    <tr>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-3.png" alt="Laravel Roles GUI Edit Role" width="400"></td>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-4.png" alt="Laravel Roles GUI Show Role" width="400"></td>
    </tr>
    <tr>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-5.png" alt="Laravel Roles GUI Delete Role" width="400"></td>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-6.png" alt="Laravel Roles GUI Success Deleted" width="400"></td>
    </tr>
    <tr>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-7.png" alt="Laravel Roles GUI Deleted Role Show" width="400"></td>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-8.png" alt="Laravel Roles GUI Restore Role" width="400"></td>
    </tr>
    <tr>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-9.png" alt="Laravel Roles GUI Delete Permission" width="400"></td>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-10.png" alt="Laravel Roles GUI Show Permission" width="400"></td>
    </tr>
    <tr>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-11.png" alt="Laravel Roles GUI Permissions Dashboard" width="400"></td>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-12.png" alt="Laravel Roles GUI Create New Permission" width="400"></td>
    </tr>
    <tr>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-13.png" alt="Laravel Roles GUI Roles Soft Deletes Dashboard" width="400"></td>
        <td valign="top" width="50%"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-14.png" alt="Laravel Roles GUI Permissions Soft Deletes Dashboard" width="400"></td>
    </tr>
    <tr>
        <td valign="top" width="100%" colspan="2"><img src="https://s3-us-west-2.amazonaws.com/github-project-images/laravel-roles/screenshots/roles-gui-15.png" alt="Laravel Roles GUI Success Restore" width="400"></td>
    </tr>
</table>


### File Tree

See [docs/file-tree.md](docs/file-tree.md).

### Opening an Issue

Before opening an issue there are a couple of considerations:

-   You are all awesome!
-   **Please Read the instructions** and make sure all steps were _followed correctly_.
-   **Please Check** that the issue is not _specific to the development environment_ setup.
-   **Please Provide** _duplication steps_.
-   **Please Attempt to look into the issue**, and if you _have a solution, make a pull request_.
-   **Please Show that you have made an attempt** to _look into the issue_.
-   **Please Check** to see if the issue you are _reporting is a duplicate_ of a previous reported issue.

### License

This package is open-sourced software licensed under the [MIT license](LICENSE).

### Contributors

-   Thanks goes to these [wonderful people](https://github.com/jeremykenedy/laravel-auth/graphs/contributors):
-   Please feel free to contribute and make pull requests!
