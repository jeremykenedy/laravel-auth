<?php

namespace Tests\Feature\Auth;

use App\Models\Role;
use App\Models\Social;
use App\Models\Theme;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\User as SocialiteUser;
use Mockery;
use Tests\TestCase;

class SocialLoginTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Role::create([
            'name'  => 'User',
            'slug'  => 'user',
            'level' => 1,
        ]);

        // New social users get a profile whose theme_id defaults to 1.
        Theme::create([
            'name'          => 'Default',
            'link'          => 'null',
            'notes'         => 'Test Default Theme.',
            'status'        => 1,
            'taggable_id'   => 0,
            'taggable_type' => 'theme',
        ]);
    }

    public function test_linked_social_account_logs_in_the_linked_user(): void
    {
        $user = User::factory()->create();
        Social::create([
            'user_id'   => $user->id,
            'provider'  => 'google',
            'social_id' => 'google-123',
        ]);
        $other = User::factory()->create();

        $this->mockSocialite('google', [
            'sub'            => 'google-123',
            'name'           => 'Linked Person',
            'email'          => $other->email,
            'email_verified' => false,
        ]);

        $response = $this->get('/social/handle/google');

        $response->assertRedirect(RouteServiceProvider::HOME);
        $this->assertAuthenticatedAs($user);
    }

    public function test_unverified_email_matching_an_existing_user_is_refused(): void
    {
        $user = User::factory()->create();

        $this->mockSocialite('google', [
            'sub'            => 'google-456',
            'name'           => 'Attacker',
            'email'          => $user->email,
            'email_verified' => false,
        ]);

        $response = $this->get('/social/handle/google');

        $this->assertGuest();
        $response->assertRedirect('login');
        $response->assertSessionHas('status', 'danger');
        $response->assertSessionHas('message', trans('socials.existingAccount'));
        $this->assertDatabaseMissing('social_logins', [
            'provider'  => 'google',
            'social_id' => 'google-456',
        ]);
        $this->assertDatabaseCount('users', 1);
    }

    public function test_provider_without_a_verification_claim_is_treated_as_unverified(): void
    {
        $user = User::factory()->create();

        $this->mockSocialite('facebook', [
            'id'       => 'fb-789',
            'name'     => 'Attacker',
            'email'    => $user->email,
            'verified' => true,
        ]);

        $response = $this->get('/social/handle/facebook');

        $this->assertGuest();
        $response->assertRedirect('login');
        $this->assertDatabaseMissing('social_logins', [
            'provider'  => 'facebook',
            'social_id' => 'fb-789',
        ]);
    }

    public function test_verified_email_matching_an_existing_user_links_and_logs_in(): void
    {
        $user = User::factory()->create();

        $this->mockSocialite('google', [
            'sub'            => 'google-456',
            'name'           => 'Same Person',
            'email'          => $user->email,
            'email_verified' => true,
        ]);

        $response = $this->get('/social/handle/google');

        $response->assertRedirect(RouteServiceProvider::HOME);
        $this->assertAuthenticatedAs($user);
        $this->assertDatabaseHas('social_logins', [
            'user_id'   => $user->id,
            'provider'  => 'google',
            'social_id' => 'google-456',
        ]);
        $this->assertDatabaseCount('users', 1);
    }

    public function test_github_email_resolved_through_the_user_email_scope_links_and_logs_in(): void
    {
        $user = User::factory()->create();

        $this->mockSocialite('github', [
            'id'    => 4242,
            'login' => 'octocat',
            'name'  => 'Same Person',
            'email' => $user->email,
        ], ['user:email']);

        $response = $this->get('/social/handle/github');

        $response->assertRedirect(RouteServiceProvider::HOME);
        $this->assertAuthenticatedAs($user);
        $this->assertDatabaseHas('social_logins', [
            'user_id'   => $user->id,
            'provider'  => 'github',
            'social_id' => '4242',
        ]);
    }

    public function test_github_email_without_the_user_email_scope_is_refused(): void
    {
        $user = User::factory()->create();

        $this->mockSocialite('github', [
            'id'    => 4242,
            'login' => 'octocat',
            'name'  => 'Attacker',
            'email' => $user->email,
        ], []);

        $response = $this->get('/social/handle/github');

        $this->assertGuest();
        $response->assertRedirect('login');
    }

    public function test_null_email_from_the_provider_never_matches_an_existing_user(): void
    {
        $existing = User::factory()->create();

        $this->mockSocialite('google', [
            'sub'            => 'google-999',
            'name'           => 'No Email',
            'email'          => null,
            'email_verified' => true,
        ]);

        $response = $this->get('/social/handle/google');

        $response->assertRedirect(RouteServiceProvider::HOME);
        $this->assertAuthenticated();
        $this->assertNotEquals($existing->id, auth()->id());
        $this->assertDatabaseCount('users', 2);
        $this->assertDatabaseHas('social_logins', [
            'user_id'   => auth()->id(),
            'provider'  => 'google',
            'social_id' => 'google-999',
        ]);
    }

    public function test_brand_new_social_user_is_created_and_logged_in(): void
    {
        $this->mockSocialite('google', [
            'sub'            => 'google-111',
            'name'           => 'New Person',
            'email'          => 'new.person@example.com',
            'email_verified' => true,
        ]);

        $response = $this->get('/social/handle/google');

        $response->assertRedirect(RouteServiceProvider::HOME);
        $response->assertSessionHas('success', trans('socials.registerSuccess'));
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email'      => 'new.person@example.com',
            'first_name' => 'New',
            'last_name'  => 'Person',
        ]);
        $this->assertDatabaseHas('social_logins', [
            'user_id'   => auth()->id(),
            'provider'  => 'google',
            'social_id' => 'google-111',
        ]);
    }

    /**
     * Mock the Socialite driver so the callback returns the given raw provider payload.
     *
     * @param  string  $provider
     * @return void
     */
    private function mockSocialite($provider, array $raw, array $scopes = [])
    {
        $socialiteUser = (new SocialiteUser)->setRaw($raw)->map([
            'id'       => $raw['sub'] ?? $raw['id'] ?? null,
            'nickname' => $raw['login'] ?? null,
            'name'     => $raw['name'] ?? null,
            'email'    => $raw['email'] ?? null,
        ]);

        $driver = Mockery::mock(AbstractProvider::class);
        $driver->shouldReceive('user')->andReturn($socialiteUser);
        $driver->shouldReceive('getScopes')->andReturn($scopes);

        Socialite::shouldReceive('driver')->with($provider)->andReturn($driver);
    }
}
