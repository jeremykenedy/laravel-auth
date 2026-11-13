<?php

namespace Tests\Feature;

use App\Models\Profile;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfilesControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Profiles default to theme_id 1. The id is set explicitly because MySQL keeps
        // auto-increment counters across rolled back tests.
        Theme::forceCreate([
            'id'            => 1,
            'name'          => 'Default',
            'link'          => 'null',
            'notes'         => 'Test Default Theme.',
            'status'        => 1,
            'taggable_id'   => 0,
            'taggable_type' => 'theme',
        ]);
    }

    public function test_a_user_cannot_load_another_users_edit_form(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();

        $response = $this->actingAs($otherUser)->get('profile/'.$owner->name.'/edit');

        $response->assertRedirect('profile/'.$otherUser->name.'/edit');
    }

    public function test_a_user_cannot_update_another_users_profile(): void
    {
        $owner = $this->userWithProfile(['bio' => 'Original bio', 'location' => 'Portland']);
        $attacker = $this->userWithProfile();

        $response = $this->actingAs($attacker)->put('profile/'.$owner->name, [
            'bio'              => 'changed',
            'location'         => 'elsewhere',
            'twitter_username' => 'attacker',
        ]);

        $response->assertRedirect('profile/'.$attacker->name.'/edit');
        $response->assertSessionHas('error', trans('profile.notYourProfile'));

        $owner->profile->refresh();
        $this->assertSame('Original bio', $owner->profile->bio);
        $this->assertSame('Portland', $owner->profile->location);
        $this->assertNull($owner->profile->twitter_username);
    }

    public function test_a_user_can_update_their_own_profile(): void
    {
        $user = $this->userWithProfile(['bio' => 'Original bio']);

        $response = $this->actingAs($user)->put('profile/'.$user->name, [
            'bio'      => 'Updated bio',
            'location' => 'Portland',
        ]);

        $response->assertRedirect('profile/'.$user->name.'/edit');
        $response->assertSessionHas('success', trans('profile.updateSuccess'));

        $user->profile->refresh();
        $this->assertSame('Updated bio', $user->profile->bio);
        $this->assertSame('Portland', $user->profile->location);
    }

    public function test_social_usernames_are_escaped_on_the_profile_page(): void
    {
        $payload = '"><script>alert(1)</script>';
        $user = $this->userWithProfile([
            'twitter_username' => $payload,
            'github_username'  => $payload,
        ]);

        $response = $this->actingAs($user)->get('profile/'.$user->name);

        $response->assertOk();
        $response->assertDontSee('<script>alert(1)</script>', false);
        $response->assertSee('&lt;script&gt;alert(1)&lt;/script&gt;', false);
    }

    /**
     * Create a user with a profile row.
     *
     * @return User
     */
    private function userWithProfile(array $attributes = [])
    {
        $user = User::factory()->create();
        $user->profile()->save(new Profile($attributes));

        return $user->fresh('profile');
    }
}
