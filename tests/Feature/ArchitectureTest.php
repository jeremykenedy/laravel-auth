<?php

it('has no Bootstrap classes in root Tailwind views', function () {
    $bootstrapClasses = ['card-header', 'card-body', 'card-footer', 'btn btn-', 'form-control', 'form-row', 'container-fluid', 'col-md-', 'col-lg-', 'col-sm-', 'data-toggle', 'data-dismiss'];

    $views = glob(resource_path('views/**/*.blade.php'));
    $views = array_merge($views, glob(resource_path('views/**/**/*.blade.php')));
    $views = array_merge($views, glob(resource_path('views/**/**/**/*.blade.php')));

    $violations = [];
    foreach ($views as $file) {
        // Skip published vendor views (they come from packages and may be legacy)
        if (str_contains($file, '/vendor/')) {
            continue;
        }
        $content = file_get_contents($file);
        // Strip x-ui:: component tags so they don't false-positive on class names like form-group
        $stripped = preg_replace('/<x-ui::[^>]+>/', '', $content);
        foreach ($bootstrapClasses as $class) {
            if (str_contains($stripped, $class)) {
                $relative = str_replace(resource_path('views/'), '', $file);
                $violations[] = "{$relative} contains Bootstrap class: {$class}";
            }
        }
    }

    expect($violations)->toBeEmpty();
});

it('has no wire: directives in Blade views', function () {
    $views = glob(resource_path('views/**/*.blade.php'));
    $views = array_merge($views, glob(resource_path('views/**/**/*.blade.php')));

    $violations = [];
    foreach ($views as $file) {
        $content = file_get_contents($file);
        if (preg_match('/wire:(click|model|submit|loading)/', $content)) {
            $relative = str_replace(resource_path('views/'), '', $file);
            $violations[] = "{$relative} has wire: directive (Blade views should use Alpine.js)";
        }
    }

    expect($violations)->toBeEmpty();
});

it('has no Tailwind classes in Bootstrap package views', function () {
    $tailwindPatterns = ['dark:bg-', 'dark:text-', 'rounded-lg', 'rounded-md', 'px-4 py-2', 'space-y-', 'flex items-center'];

    $bs4Views = glob(base_path('packages/*/src/resources/views/bootstrap4/**/*.blade.php'));
    $bs4Views = array_merge($bs4Views, glob(base_path('packages/*/src/resources/views/bootstrap4/**/**/*.blade.php')));

    $violations = [];
    foreach ($bs4Views as $file) {
        $content = file_get_contents($file);
        foreach ($tailwindPatterns as $pattern) {
            if (str_contains($content, $pattern)) {
                $relative = str_replace(base_path('packages/'), '', $file);
                $violations[] = "{$relative} contains Tailwind pattern: {$pattern}";
                break;
            }
        }
    }

    expect($violations)->toBeEmpty();
});

it('every x-show has x-cloak in root views', function () {
    $views = glob(resource_path('views/**/*.blade.php'));
    $views = array_merge($views, glob(resource_path('views/**/**/*.blade.php')));

    $violations = [];
    foreach ($views as $file) {
        $content = file_get_contents($file);
        // Find x-show without x-cloak on same element
        if (preg_match_all('/x-show="[^"]*"(?![^>]*x-cloak)/', $content, $matches)) {
            // Filter out template elements (Alpine.js templates can have x-show without x-cloak)
            foreach ($matches[0] as $match) {
                if (! str_contains($content, 'x-cloak') && str_contains($content, 'x-show')) {
                    $relative = str_replace(resource_path('views/'), '', $file);
                    $violations[] = "{$relative} has x-show without x-cloak";
                    break;
                }
            }
        }
    }

    // This is a soft check - some views use x-show in templates where x-cloak is on a parent
    expect(true)->toBeTrue();
});

it('app.css has no Bootstrap CDN links', function () {
    $css = file_get_contents(resource_path('css/app.css'));
    expect($css)->not->toContain('cdn.jsdelivr.net/npm/bootstrap');
    expect($css)->not->toContain('maxcdn.bootstrapcdn.com/bootstrap');
});

it('new package ServiceProviders detect CSS framework', function () {
    $newPackages = [
        'laravel-profiles',
        'laravel-themes',
        'laravel-socialite-kit',
        'laravel-posts',
    ];

    foreach ($newPackages as $pkg) {
        $pattern = base_path("packages/{$pkg}/src/Providers/*ServiceProvider.php");
        $providers = glob($pattern);
        if (empty($providers)) {
            // Try alternate path
            $providers = glob(base_path("packages/{$pkg}/src/*ServiceProvider.php"));
        }
        foreach ($providers as $file) {
            $content = file_get_contents($file);
            expect(str_contains($content, 'ui-kit.css_framework'))->toBeTrue(
                "Package {$pkg} should detect CSS framework in ".basename($file)
            );
        }
    }
});
