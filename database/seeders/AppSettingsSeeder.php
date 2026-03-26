<?php

namespace Database\Seeders;

use App\Models\AppSetting;
use Illuminate\Database\Seeder;

class AppSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            [
                'key' => 'app.name',
                'value' => 'Laravel Auth',
                'type' => 'string',
                'group' => 'general',
                'label' => 'Application Name',
                'description' => 'The name displayed in the browser title and navigation.',
            ],
            [
                'key' => 'app.registration_enabled',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'auth',
                'label' => 'Registration Enabled',
                'description' => 'Allow new users to register.',
            ],
            [
                'key' => 'app.email_verification_required',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'auth',
                'label' => 'Email Verification Required',
                'description' => 'Require users to verify their email address after registration.',
            ],
            [
                'key' => 'app.default_user_role',
                'value' => 'user',
                'type' => 'string',
                'group' => 'auth',
                'label' => 'Default User Role',
                'description' => 'The role assigned to new users upon registration.',
            ],
            [
                'key' => 'app.max_login_attempts',
                'value' => '5',
                'type' => 'integer',
                'group' => 'auth',
                'label' => 'Max Login Attempts',
                'description' => 'Number of failed login attempts before lockout.',
            ],
            [
                'key' => 'app.google_analytics_id',
                'value' => '',
                'type' => 'string',
                'group' => 'integrations',
                'label' => 'Google Analytics ID',
                'description' => 'Google Analytics measurement ID (e.g. G-XXXXXXXXXX).',
            ],
            [
                'key' => 'app.footer_text',
                'value' => 'Built with Laravel',
                'type' => 'string',
                'group' => 'general',
                'label' => 'Footer Text',
                'description' => 'Text displayed in the application footer.',
            ],
        ];

        foreach ($settings as $setting) {
            AppSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting,
            );
        }
    }
}
