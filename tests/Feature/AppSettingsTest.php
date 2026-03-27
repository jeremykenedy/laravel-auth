<?php

use App\Models\AppSetting;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\AppSettingsSeeder;
use Database\Seeders\PermissionsTableSeeder;
use Database\Seeders\RolesTableSeeder;
use Illuminate\Support\Facades\Cache;

beforeEach(function () {
    $this->seed(RolesTableSeeder::class);
    $this->seed(PermissionsTableSeeder::class);
    $this->seed(AppSettingsSeeder::class);

    $this->admin = User::factory()->create();
    $this->admin->attachRole(Role::where('slug', 'admin')->first());
});

it('renders the settings page', function () {
    $this->actingAs($this->admin)
        ->get('/settings')
        ->assertOk()
        ->assertSee('Application Name');
});

it('can update settings', function () {
    $this->actingAs($this->admin)
        ->put('/settings', [
            'settings' => [
                'app.name' => 'Updated App Name',
                'app.footer_text' => 'Updated Footer',
            ],
        ])
        ->assertRedirect();

    Cache::flush();
    expect(AppSetting::get('app.name'))->toBe('Updated App Name');
    expect(AppSetting::get('app.footer_text'))->toBe('Updated Footer');
});

it('can toggle boolean settings', function () {
    $this->actingAs($this->admin)
        ->put('/settings', [
            'settings' => [
                'app.registration_enabled' => '0',
            ],
        ])
        ->assertRedirect();

    expect(AppSetting::get('app.registration_enabled'))->toBeFalse();
});

it('caches settings', function () {
    AppSetting::set('app.name', 'Cached Name');
    expect(AppSetting::get('app.name'))->toBe('Cached Name');

    AppSetting::set('app.name', 'New Name');
    expect(AppSetting::get('app.name'))->toBe('New Name');
});
