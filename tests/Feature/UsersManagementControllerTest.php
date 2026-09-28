<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersManagementControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_search_users(): void
    {
        $admin = User::factory()->create();
        $role = Role::create([
            'name'  => 'Administrator',
            'slug'  => 'admin',
            'level' => 1,
        ]);
        $admin->attachRole($role);

        $target = User::factory()->create(['name' => 'findable-user']);

        $response = $this->actingAs($admin)->post('search-users', [
            'user_search_box' => 'findable-user',
        ]);

        $response->assertOk();
        $response->assertSee($target->email);
    }
}
