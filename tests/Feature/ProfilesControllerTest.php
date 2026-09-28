<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfilesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_cannot_load_another_users_edit_form(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();

        $response = $this->actingAs($otherUser)->get('profile/'.$owner->name.'/edit');

        $response->assertRedirect('profile/'.$otherUser->name.'/edit');
    }
}
