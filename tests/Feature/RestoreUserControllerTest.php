<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class RestoreUserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_deleted_user_can_reactivate_their_account_with_a_valid_token(): void
    {
        config(['settings.restoreKey' => 'test-restore-key-1234567890123456']);
        Notification::fake();

        $user = User::factory()->create();

        $this->actingAs($user)->delete('profile/'.$user->id.'/deleteUserAccount', [
            'checkConfirmDelete' => true,
        ]);

        $user->refresh();
        $this->assertTrue($user->trashed());

        $response = $this->get('/re-activate/'.$user->token);

        $response->assertRedirect('/login');
        $this->assertFalse($user->fresh()->trashed());
    }
}
