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

        // Check if email is already registered
        $existingUser = User::where('email', '=', $socialUserObject->email)->first();

        if (! empty($existingUser)) {
            auth()->login($existingUser, true);

            return redirect($this->redirectSuccessLogin);
        }

        $socialUser = $this->resolveSocialUser($provider, $socialUserObject);

        auth()->login($socialUser, true);

        return redirect($this->redirectSuccessLogin)->with('success', trans('socials.registerSuccess'));
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
     * Resolve the user for an existing social link, or create a new one.
     *
     * @param  string  $provider
     * @return User
     */
    private function resolveSocialUser($provider, $socialUserObject)
    {
        $sameSocialId = Social::where('social_id', '=', $socialUserObject->id)
            ->where('provider', '=', $provider)
            ->first();

        if (! empty($sameSocialId)) {
            return $sameSocialId->user;
        }

        return $this->createUserFromSocialProfile($provider, $socialUserObject);
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
