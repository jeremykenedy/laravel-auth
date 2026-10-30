<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Role;
use App\Models\Social;
use App\Models\User;
use App\Traits\ActivationTrait;
use App\Traits\CaptureIpTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    use ActivationTrait;

    private $redirectSuccessLogin = 'home';

    /**
     * Gets the social redirect.
     *
     * @param  string  $provider  The provider
     * @return Response
     */
    public function getSocialRedirect($provider, Request $request)
    {
        $providerKey = Config::get('services.'.$provider);

        if (empty($providerKey)) {
            return view('pages.status')
                ->with('error', trans('socials.noProvider'));
        }

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Gets the social handle.
     *
     * @param  string  $provider  The provider
     * @return Response
     */
    public function getSocialHandle($provider, Request $request)
    {
        if ($this->wasSocialLoginDenied($request)) {
            return redirect()->to('login')
                ->with('status', 'danger')
                ->with('message', trans('socials.denied'));
        }

        $socialUserObject = Socialite::driver($provider)->user();

        // 1. A social account already linked to a local user: log that user in.
        $linkedUser = $this->findLinkedUser($provider, $socialUserObject);

        if (! empty($linkedUser)) {
            auth()->login($linkedUser, true);

            return redirect($this->redirectSuccessLogin);
        }

        // 2. No link yet, but a local user has the same email address.
        $existingUser = $this->findUserByEmail($socialUserObject->email);

        if (! empty($existingUser)) {
            if (! $this->providerVerifiedEmail($provider, $socialUserObject)) {
                return redirect()->to('login')
                    ->with('status', 'danger')
                    ->with('message', trans('socials.existingAccount'));
            }

            $this->linkSocialAccount($existingUser, $provider, $socialUserObject);

            auth()->login($existingUser, true);

            return redirect($this->redirectSuccessLogin);
        }

        // 3. Brand new user.
        $socialUser = $this->createUserFromSocialProfile($provider, $socialUserObject);

        auth()->login($socialUser, true);

        return redirect($this->redirectSuccessLogin)->with('success', trans('socials.registerSuccess'));
    }

    /**
     * Find the local user already linked to this provider account, if any.
     *
     * @param  string  $provider
     * @return User|null
     */
    private function findLinkedUser($provider, $socialUserObject)
    {
        if ($socialUserObject->id === null || $socialUserObject->id === '') {
            return null;
        }

        $social = Social::where('social_id', '=', $socialUserObject->id)
            ->where('provider', '=', $provider)
            ->first();

        if (empty($social)) {
            return null;
        }

        return $social->user;
    }

    /**
     * Find a local user by email address. A missing email never matches anyone.
     *
     * @param  string|null  $email
     * @return User|null
     */
    private function findUserByEmail($email)
    {
        if (! is_string($email) || trim($email) === '') {
            return null;
        }

        return User::where('email', '=', $email)->first();
    }

    /**
     * Determine whether the provider positively confirmed that the email address is verified.
     *
     * Only providers that expose an explicit verification claim in their raw user payload
     * are trusted. Anything else is treated as unverified.
     *
     * @param  string  $provider
     * @return bool
     */
    private function providerVerifiedEmail($provider, $socialUserObject)
    {
        $raw = is_array($socialUserObject->user) ? $socialUserObject->user : [];

        switch ($provider) {
            case 'google':
                // Google OpenID Connect userinfo: "email_verified" boolean claim.
                return $this->isTrue($raw['email_verified'] ?? null);

            case 'github':
                // GitHub exposes no verified flag on the user object. Socialite only resolves the
                // email through /user/emails (primary and verified) when the "user:email" scope is
                // requested; without that scope the address is the user-settable public email.
                return ! empty($raw['email'])
                    && in_array('user:email', Socialite::driver($provider)->getScopes(), true);

            case 'twitter':
                // X (Twitter) OAuth 2 user object: "confirmed_email" is the confirmed address.
                // OAuth 1 (the default for this app) exposes no verification claim.
                return ! empty($raw['confirmed_email']);

            default:
                // Facebook, LinkedIn (v2 profile API), Twitch, YouTube, Instagram and 37signals
                // expose no email verification claim.
                return false;
        }
    }

    /**
     * Normalize a provider boolean claim.
     *
     * @param  mixed  $value
     * @return bool
     */
    private function isTrue($value)
    {
        return $value === true || $value === 1 || $value === '1' || $value === 'true';
    }

    /**
     * Link a provider account to an existing local user.
     *
     * @param  string  $provider
     * @return void
     */
    private function linkSocialAccount(User $user, $provider, $socialUserObject)
    {
        $socialData = new Social;
        $socialData->social_id = $socialUserObject->id;
        $socialData->provider = $provider;

        $user->social()->save($socialData);
    }

    /**
     * Determine whether the social provider denied the login attempt.
     *
     * @return bool
     */
    private function wasSocialLoginDenied(Request $request)
    {
        $denied = $request->denied ? $request->denied : null;

        return $denied != null || $denied != '';
    }

    /**
     * Create and fully populate a new user from a social profile.
     *
     * @param  string  $provider
     * @return User
     */
    private function createUserFromSocialProfile($provider, $socialUserObject)
    {
        $email = $this->resolveSocialEmail($socialUserObject);
        $fullname = $this->splitFullName($socialUserObject->name);
        $username = $this->resolveUsername($socialUserObject->nickname, $fullname, $email);
        $ipAddress = new CaptureIpTrait;

        $user = User::create([
            'name'                 => $username,
            'first_name'           => $fullname[0],
            'last_name'            => $fullname[1],
            'email'                => $email,
            'password'             => bcrypt(str_random(40)),
            'token'                => str_random(64),
            'activated'            => true,
            'signup_sm_ip_address' => $ipAddress->getClientIp(),
        ]);

        $this->attachSocialProfile($user, $provider, $socialUserObject);

        return $user;
    }

    /**
     * Resolve the email to use, generating a placeholder if the provider gave none.
     *
     * @return string
     */
    private function resolveSocialEmail($socialUserObject)
    {
        if ($socialUserObject->email) {
            return $socialUserObject->email;
        }

        return 'missing'.str_random(10).'@'.str_random(10).'.example.org';
    }

    /**
     * Split a full name into [firstName, lastName].
     *
     * @param  string  $name
     * @return array
     */
    private function splitFullName($name)
    {
        $fullname = explode(' ', $name);

        if (count($fullname) == 1) {
            $fullname[1] = '';
        }

        return $fullname;
    }

    /**
     * Resolve a unique username from the provider's nickname, falling back to the full name.
     *
     * @param  string|null  $nickname
     * @param  string  $email
     * @return string
     */
    private function resolveUsername($nickname, array $fullname, $email)
    {
        $username = $nickname;

        if ($username == null) {
            foreach ($fullname as $name) {
                $username .= $name;
            }
        }

        return $this->checkUserName($username, $email);
    }

    /**
     * Link the social account, role, and profile to a newly created user.
     *
     * @param  string  $provider
     * @return void
     */
    private function attachSocialProfile(User $user, $provider, $socialUserObject)
    {
        $socialData = new Social;
        $socialData->social_id = $socialUserObject->id;
        $socialData->provider = $provider;

        $role = Role::where('slug', '=', 'user')->first();

        $user->social()->save($socialData);
        $user->attachRole($role);
        $user->activated = true;

        $profile = new Profile;
        $user->profile()->save($profile);
        $user->save();

        $this->applyProviderProfileFields($user, $provider, $socialUserObject);

        $user->profile->save();
    }

    /**
     * Apply any provider-specific profile fields.
     *
     * @param  string  $provider
     * @return void
     */
    private function applyProviderProfileFields(User $user, $provider, $socialUserObject)
    {
        if ($provider == 'github') {
            $user->profile->github_username = $socialUserObject->nickname;
        }

        // Twitter User Object details: https://developer.twitter.com/en/docs/tweets/data-dictionary/overview/user-object
        if ($provider == 'twitter') {
            // $user->profile()->twitter_username = $socialUserObject->screen_name;
            // If the above fails try (The documentation shows screen_name however so Twitters docs may be out of date.):
            $user->profile()->twitter_username = $socialUserObject->nickname;
        }
    }

    /**
     * Check if username against database and return valid username.
     * If username is not in the DB return the username
     * else generate, check, and return the username.
     *
     * @param  string  $username
     * @param  string  $email
     * @return string
     */
    public function checkUserName($username, $email)
    {
        $userNameCheck = User::where('name', '=', $username)->first();

        if ($userNameCheck) {
            $i = 1;
            do {
                $username = $this->generateUserName($username);
                $newCheck = User::where('name', '=', $username)->first();

                if ($newCheck == null) {
                    $newCheck = 0;
                } else {
                    $newCheck = count($newCheck);
                }
            } while ($newCheck != 0);
        }

        return $username;
    }

    /**
     * Generate Username.
     *
     * @param  string  $username
     * @return string
     */
    public function generateUserName($username)
    {
        return $username.'_'.str_random(10);
    }
}
