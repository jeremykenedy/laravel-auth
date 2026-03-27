<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

use function Laravel\Prompts\confirm;
use function Laravel\Prompts\info;
use function Laravel\Prompts\select;
use function Laravel\Prompts\warning;

class AuthSetup extends Command
{
    protected $signature = 'auth:setup';

    protected $description = 'Interactive setup for Laravel Auth - pick your CSS framework, frontend, and which packages to enable';

    public function handle(): int
    {
        info('Laravel Auth Setup');
        info('==================');
        info('This will configure your CSS framework, frontend framework, and enabled packages.');
        $this->newLine();

        $css = select(
            label: 'Which CSS framework?',
            options: [
                'tailwind' => 'Tailwind v4 (recommended)',
                'bootstrap5' => 'Bootstrap 5',
                'bootstrap4' => 'Bootstrap 4 (legacy)',
            ],
            default: 'tailwind',
        );

        $frontend = select(
            label: 'Which frontend framework?',
            options: [
                'blade' => 'Blade + Alpine.js (default)',
                'livewire' => 'Livewire 3',
                'vue' => 'Vue 3 + Inertia.js',
                'react' => 'React + Inertia.js',
                'svelte' => 'Svelte + Inertia.js',
            ],
            default: 'blade',
        );

        $features = [];
        $features['socialite'] = confirm('Enable social authentication (Google, GitHub, Facebook, etc.)?', true);
        $features['two_step'] = confirm('Enable two-step verification?', true);
        $features['face_auth'] = confirm('Enable face authentication?', false);
        $features['captcha'] = confirm('Enable reCAPTCHA on registration?', false);
        $features['chat'] = confirm('Enable real-time chat?', false);

        $this->newLine();
        info('Configuration Summary:');
        info("  CSS Framework: {$css}");
        info("  Frontend: {$frontend}");
        info('  Social Auth: '.($features['socialite'] ? 'Yes' : 'No'));
        info('  Two-Step: '.($features['two_step'] ? 'Yes' : 'No'));
        info('  Face Auth: '.($features['face_auth'] ? 'Yes' : 'No'));
        info('  reCAPTCHA: '.($features['captcha'] ? 'Yes' : 'No'));
        info('  Chat: '.($features['chat'] ? 'Yes' : 'No'));
        $this->newLine();

        if (! confirm('Apply this configuration?', true)) {
            warning('Setup cancelled.');

            return self::SUCCESS;
        }

        $this->updateEnv('UI_KIT_CSS', $css);
        $this->updateEnv('UI_KIT_FRONTEND', $frontend);
        $this->updateEnv('SOCIALITE_KIT_ENABLED', $features['socialite'] ? 'true' : 'false');
        $this->updateEnv('LARAVEL_2STEP_ENABLED', $features['two_step'] ? 'true' : 'false');
        $this->updateEnv('FACE_AUTH_ENABLED', $features['face_auth'] ? 'true' : 'false');
        $this->updateEnv('CAPTCHA_ENABLED', $features['captcha'] ? 'true' : 'false');

        if ($features['socialite']) {
            $this->updateEnv('SOCIALITE_GOOGLE_ENABLED', 'true');
            $this->updateEnv('SOCIALITE_GITHUB_ENABLED', 'true');
            $this->updateEnv('SOCIALITE_FACEBOOK_ENABLED', 'true');
            $this->updateEnv('SOCIALITE_TWITTER_ENABLED', 'true');
        }

        Artisan::call('config:clear');
        Artisan::call('view:clear');

        info('Configuration applied successfully!');

        $runMigrate = confirm('Run database migrations now?', true);
        if ($runMigrate) {
            Artisan::call('migrate', ['--force' => true]);
            info('Migrations complete.');

            $runSeed = confirm('Seed the database with demo data?', true);
            if ($runSeed) {
                Artisan::call('db:seed', ['--force' => true]);
                info('Database seeded.');
            }
        }

        $runBuild = confirm('Build frontend assets now?', true);
        if ($runBuild) {
            exec('npm run build', $output, $code);
            if ($code === 0) {
                info('Assets built successfully.');
            } else {
                warning('Asset build failed. Run manually: npm run build');
            }
        }

        if ($frontend === 'vue' || $frontend === 'react' || $frontend === 'svelte') {
            warning('Install Inertia.js: composer require inertiajs/inertia-laravel');
        }

        $this->newLine();
        info('Laravel Auth is ready!');
        info('Default login: admin@user.com / password');
        info('URL: '.config('app.url'));

        return self::SUCCESS;
    }

    protected function updateEnv(string $key, string $value): void
    {
        $path = base_path('.env');
        if (! file_exists($path)) {
            return;
        }

        $content = file_get_contents($path);

        if (str_contains($content, "{$key}=")) {
            $content = preg_replace("/^{$key}=.*/m", "{$key}={$value}", $content);
        } else {
            $content .= "\n{$key}={$value}";
        }

        file_put_contents($path, $content);
    }
}
