<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_users_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('/');
    }

    public function test_logout_invalidates_the_session(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->withSession(['a-session-value' => 'kept-until-logout'])
            ->post('/logout');

        $this->assertGuest();
        $this->assertNull(session('a-session-value'));
    }
}
