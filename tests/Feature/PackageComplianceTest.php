<?php

use Illuminate\Support\Facades\Artisan;

// ========================================================================
// Every package has required files
// ========================================================================

it('every package has a LICENSE file', function () {
    $packages = glob(base_path('packages/*/'));

    foreach ($packages as $dir) {
        $pkg = basename($dir);
        expect(file_exists($dir.'LICENSE'))->toBeTrue("Missing LICENSE in {$pkg}");
    }
});

it('every package has a README.md with TOC', function () {
    $packages = glob(base_path('packages/*/'));

    foreach ($packages as $dir) {
        $pkg = basename($dir);
        $readme = $dir.'README.md';
        expect(file_exists($readme))->toBeTrue("Missing README.md in {$pkg}");

        $content = file_get_contents($readme);
        expect(str_contains($content, 'Table of') || str_contains($content, '#### Table'))->toBeTrue(
            "README.md in {$pkg} missing Table of Contents"
        );
    }
});

it('every package has a .gitignore with system files', function () {
    $packages = glob(base_path('packages/*/'));

    foreach ($packages as $dir) {
        $pkg = basename($dir);
        $gi = $dir.'.gitignore';
        expect(file_exists($gi))->toBeTrue("Missing .gitignore in {$pkg}");

        $content = file_get_contents($gi);
        expect(str_contains($content, '.DS_Store') || str_contains($content, 'DS_Store'))->toBeTrue(
            ".gitignore in {$pkg} missing .DS_Store"
        );
        expect(str_contains($content, 'Thumbs.db') || str_contains($content, 'Thumbs'))->toBeTrue(
            ".gitignore in {$pkg} missing Thumbs.db"
        );
    }
});

it('every package has a composer.json', function () {
    $packages = glob(base_path('packages/*/'));

    foreach ($packages as $dir) {
        $pkg = basename($dir);
        expect(file_exists($dir.'composer.json'))->toBeTrue("Missing composer.json in {$pkg}");
    }
});

// ========================================================================
// Every package has publishable assets
// ========================================================================

it('every package service provider has publishes method', function () {
    $packages = glob(base_path('packages/*/'));

    foreach ($packages as $dir) {
        $pkg = basename($dir);
        // Search all PHP files in src/ root and Providers/ for publishes calls
        $phpFiles = glob($dir.'src/*.php');
        $phpFiles = array_merge($phpFiles, glob($dir.'src/Providers/*.php'));

        $hasPublish = false;
        foreach ($phpFiles as $file) {
            if (str_contains(file_get_contents($file), 'publishes')) {
                $hasPublish = true;
                break;
            }
        }

        expect($hasPublish)->toBeTrue("No publishable assets in {$pkg}");
    }
});

// ========================================================================
// Frontend packages have all 3 CSS frameworks
// ========================================================================

it('frontend packages have tailwind bootstrap5 and bootstrap4 directories', function () {
    $frontendPackages = [];
    $packages = glob(base_path('packages/*/'));

    foreach ($packages as $dir) {
        $hasTw = ! empty(glob($dir.'*/views/tailwind', GLOB_ONLYDIR)) || ! empty(glob($dir.'*/*/views/tailwind', GLOB_ONLYDIR));
        if ($hasTw) {
            $frontendPackages[] = $dir;
        }
    }

    foreach ($frontendPackages as $dir) {
        $pkg = basename($dir);
        $hasBs5 = ! empty(glob($dir.'*/views/bootstrap5', GLOB_ONLYDIR)) || ! empty(glob($dir.'*/*/views/bootstrap5', GLOB_ONLYDIR));
        $hasBs4 = ! empty(glob($dir.'*/views/bootstrap4', GLOB_ONLYDIR)) || ! empty(glob($dir.'*/*/views/bootstrap4', GLOB_ONLYDIR));

        expect($hasBs5)->toBeTrue("Missing bootstrap5/ views in {$pkg}");
        expect($hasBs4)->toBeTrue("Missing bootstrap4/ views in {$pkg}");
    }
});

// ========================================================================
// Every package has an install command
// ========================================================================

it('every package has an install command registered', function () {
    $expectedCommands = [
        '2step:install', 'auth-api:install', 'avatar:install', 'blocker:install',
        'captcha:install', 'chat:install', 'darkmode:install', 'email-log:install',
        'exception-notifier:install', 'face-auth:install', 'logger:install',
        'native-kit:install', 'notifications:install', 'observability:install',
        'phpinfo:install', 'posts:install', 'profiles:install', 'roles:install',
        'simple-search:install', 'socialite-kit:install', 'themes:install',
        'toast:install', 'ui-kit:install', 'users:install',
    ];

    $registered = array_keys(Artisan::all());

    foreach ($expectedCommands as $cmd) {
        expect($registered)->toContain($cmd);
    }
});
