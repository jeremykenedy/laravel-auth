<?php

return [
    'enabled' => env('OBSERVABILITY_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Backend Error & APM Providers
    |--------------------------------------------------------------------------
    | Auto-detected when their composer package is installed.
    | Set enabled=true and provide credentials to activate.
    |
    */

    'providers' => [

        // --- Error Tracking ---

        'sentry' => [
            'enabled' => env('SENTRY_ENABLED', false),
            'type' => 'backend',
            'dsn' => env('SENTRY_LARAVEL_DSN'),
            'traces_sample_rate' => env('SENTRY_TRACES_RATE', 0.1),
            'package' => 'sentry/sentry-laravel',
            'docs' => 'https://docs.sentry.io/platforms/php/guides/laravel/',
        ],

        'bugsnag' => [
            'enabled' => env('BUGSNAG_ENABLED', false),
            'type' => 'backend',
            'api_key' => env('BUGSNAG_API_KEY'),
            'package' => 'bugsnag/bugsnag-laravel',
            'docs' => 'https://docs.bugsnag.com/platforms/php/laravel/',
        ],

        'flare' => [
            'enabled' => env('FLARE_ENABLED', false),
            'type' => 'backend',
            'key' => env('FLARE_KEY'),
            'package' => 'spatie/laravel-ignition',
            'docs' => 'https://flareapp.io/docs/general/projects',
        ],

        'rollbar' => [
            'enabled' => env('ROLLBAR_ENABLED', false),
            'type' => 'both',
            'access_token' => env('ROLLBAR_TOKEN'),
            'package' => 'rollbar/rollbar-laravel',
            'docs' => 'https://docs.rollbar.com/docs/laravel',
        ],

        'raygun' => [
            'enabled' => env('RAYGUN_ENABLED', false),
            'type' => 'both',
            'api_key' => env('RAYGUN_API_KEY'),
            'package' => 'mindscape/raygun4php',
            'docs' => 'https://raygun.com/documentation/language-guides/php/crash-reporting/laravel/',
        ],

        'exception_notifier' => [
            'enabled' => env('EXCEPTION_NOTIFIER_ENABLED', false),
            'type' => 'backend',
            'package' => 'jeremykenedy/laravel-exception-notifier',
            'docs' => 'https://github.com/jeremykenedy/laravel-exception-notifier',
            'note' => 'Sends email notifications when exceptions occur. No external service needed.',
        ],

        'honeybadger' => [
            'enabled' => env('HONEYBADGER_ENABLED', false),
            'type' => 'both',
            'api_key' => env('HONEYBADGER_API_KEY'),
            'package' => 'honeybadger-io/honeybadger-laravel',
            'docs' => 'https://docs.honeybadger.io/lib/php/integration/laravel/',
        ],

        'airbrake' => [
            'enabled' => env('AIRBRAKE_ENABLED', false),
            'type' => 'backend',
            'project_id' => env('AIRBRAKE_PROJECT_ID'),
            'project_key' => env('AIRBRAKE_PROJECT_KEY'),
            'package' => 'airbrake/phpbrake',
            'docs' => 'https://docs.airbrake.io/docs/platforms/framework/php/laravel/',
        ],

        // --- APM & Performance ---

        'new_relic' => [
            'enabled' => env('NEW_RELIC_ENABLED', false),
            'type' => 'backend',
            'license_key' => env('NEW_RELIC_LICENSE_KEY'),
            'app_name' => env('NEW_RELIC_APP_NAME'),
            'package' => null,
            'docs' => 'https://docs.newrelic.com/docs/apm/agents/php-agent/getting-started/introduction-new-relic-php/',
        ],

        'datadog' => [
            'enabled' => env('DATADOG_ENABLED', false),
            'type' => 'both',
            'api_key' => env('DATADOG_API_KEY'),
            'app_key' => env('DATADOG_APP_KEY'),
            'package' => null,
            'docs' => 'https://docs.datadoghq.com/tracing/trace_collection/dd_libraries/php/',
        ],

        'appsignal' => [
            'enabled' => env('APPSIGNAL_ENABLED', false),
            'type' => 'backend',
            'push_api_key' => env('APPSIGNAL_PUSH_API_KEY'),
            'app_name' => env('APPSIGNAL_APP_NAME'),
            'package' => 'appsignal/appsignal-laravel',
            'docs' => 'https://docs.appsignal.com/ruby/integrations/laravel.html',
        ],

        // --- Log Management ---

        'loggly' => [
            'enabled' => env('LOGGLY_ENABLED', false),
            'type' => 'backend',
            'token' => env('LOGGLY_TOKEN'),
            'tag' => env('LOGGLY_TAG', 'laravel'),
            'package' => null,
            'docs' => 'https://documentation.solarwinds.com/en/success_center/loggly/content/admin/php-logging.htm',
        ],

        // --- Frontend-Only Providers ---

        'logrocket' => [
            'enabled' => env('LOGROCKET_ENABLED', false),
            'type' => 'frontend',
            'app_id' => env('LOGROCKET_APP_ID'),
            'package' => null,
            'js_snippet' => "import LogRocket from 'logrocket'; LogRocket.init('{app_id}');",
            'npm_package' => 'logrocket',
            'docs' => 'https://docs.logrocket.com/docs/quickstart',
        ],

        'instabug' => [
            'enabled' => env('INSTABUG_ENABLED', false),
            'type' => 'frontend',
            'token' => env('INSTABUG_TOKEN'),
            'package' => null,
            'js_snippet' => "window.ibAsyncInit = function() { Instabug.init({ token: '{token}' }); };",
            'docs' => 'https://docs.instabug.com/docs/web-integration',
        ],

        'gleap' => [
            'enabled' => env('GLEAP_ENABLED', false),
            'type' => 'frontend',
            'api_key' => env('GLEAP_API_KEY'),
            'package' => null,
            'js_snippet' => "Gleap.initialize('{api_key}');",
            'npm_package' => 'gleap',
            'docs' => 'https://docs.gleap.io/docs/javascript-sdk',
        ],

        'crashlytics' => [
            'enabled' => env('CRASHLYTICS_ENABLED', false),
            'type' => 'frontend',
            'package' => null,
            'docs' => 'https://firebase.google.com/docs/crashlytics',
            'note' => 'Firebase Crashlytics is primarily for mobile apps (iOS/Android). For web, use Firebase Performance Monitoring.',
        ],

        'memfault' => [
            'enabled' => env('MEMFAULT_ENABLED', false),
            'type' => 'frontend',
            'project_key' => env('MEMFAULT_PROJECT_KEY'),
            'package' => null,
            'docs' => 'https://docs.memfault.com/',
            'note' => 'Memfault is primarily for embedded/IoT devices. Integrate via API for device telemetry.',
        ],

        // --- Testing & Quality ---

        'ghost_inspector' => [
            'enabled' => env('GHOST_INSPECTOR_ENABLED', false),
            'type' => 'testing',
            'api_key' => env('GHOST_INSPECTOR_API_KEY'),
            'suite_id' => env('GHOST_INSPECTOR_SUITE_ID'),
            'package' => null,
            'docs' => 'https://ghostinspector.com/docs/api/',
        ],

        'lighthouse' => [
            'enabled' => env('LIGHTHOUSE_ENABLED', false),
            'type' => 'testing',
            'package' => null,
            'docs' => 'https://developer.chrome.com/docs/lighthouse/overview/',
            'note' => 'Run via CI: npx lighthouse <url> --output json --chrome-flags="--headless"',
        ],

        'link_checker' => [
            'enabled' => env('LINK_CHECKER_ENABLED', false),
            'type' => 'testing',
            'package' => 'spatie/laravel-link-checker',
            'docs' => 'https://github.com/spatie/laravel-link-checker',
        ],

        'ssl_checker' => [
            'enabled' => env('SSL_CHECKER_ENABLED', false),
            'type' => 'testing',
            'package' => null,
            'docs' => 'https://www.ssllabs.com/ssltest/',
            'note' => 'Automated via SSL Labs API or certbot.',
        ],

        'visual_tests' => [
            'enabled' => env('VISUAL_TESTS_ENABLED', false),
            'type' => 'testing',
            'service' => env('VISUAL_TESTS_SERVICE', 'buddy'),
            'package' => null,
            'docs' => 'https://buddy.works/docs',
            'note' => 'Buddy.Works provides visual regression testing via CI pipelines.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Uptime Monitoring (API Integration)
    |--------------------------------------------------------------------------
    | External services that ping your app to check uptime.
    | These are configured via their respective dashboards.
    | The package provides webhook endpoints for status updates.
    |
    */

    'uptime' => [
        'uptimerobot' => [
            'enabled' => env('UPTIMEROBOT_ENABLED', false),
            'api_key' => env('UPTIMEROBOT_API_KEY'),
            'monitor_ids' => env('UPTIMEROBOT_MONITOR_IDS'),
            'docs' => 'https://uptimerobot.com/api/',
        ],
        'statuscake' => [
            'enabled' => env('STATUSCAKE_ENABLED', false),
            'api_key' => env('STATUSCAKE_API_KEY'),
            'docs' => 'https://www.statuscake.com/api/',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Health Checks
    |--------------------------------------------------------------------------
    */

    'health' => [
        'enabled' => true,
        'route' => '/health',
        'checks' => ['database', 'cache', 'storage', 'queue'],
        'middleware' => [],
    ],

    /*
    |--------------------------------------------------------------------------
    | Context Enrichment
    |--------------------------------------------------------------------------
    */

    'context' => [
        'user' => true,
        'request' => true,
        'git_commit' => env('OBSERVABILITY_GIT_COMMIT'),
        'environment' => true,
    ],
];
