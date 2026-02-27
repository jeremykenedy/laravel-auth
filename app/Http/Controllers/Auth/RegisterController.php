<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use App\Traits\ActivationTrait;
use App\Traits\CaptchaTrait;
use App\Traits\CaptureIpTrait;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use ActivationTrait;
    use CaptchaTrait;
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/activate';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', [
            'except' => 'logout',
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * Enforces strong password policy:
     *   - Minimum 8 characters
     *   - At least one uppercase and one lowercase letter
     *   - At least one number
     *   - At least one symbol
     *   - Cannot be a commonly-used password (uncompromised check)
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $data['captcha'] = $this->captchaCheck();

        if (! config('settings.reCaptchStatus')) {
            $data['captcha'] = true;
        }

        return Validator::make(
            $data,
            [
                'name'                  => 'required|string|max:255|unique:users|alpha_dash',
                'first_name'            => 'nullable|string|max:255|alpha_dash',
                'last_name'             => 'nullable|string|max:255|alpha_dash',
                'email'                 => 'required|string|email:rfc,dns|max:255|unique:users',
                'password'              => [
                    'required',
                    'confirmed',
                    Password::min(8)
                        ->mixedCase()
                        ->numbers()
                        ->symbols()
                        ->uncompromised(),
                ],
                'password_confirmation' => 'required|same:password',
                'g-recaptcha-response'  => '',
                'captcha'               => 'required|min:1',
            ],
            [
                'name.unique'                   => trans('auth.userNameTaken'),
                'name.required'                 => trans('auth.userNameRequired'),
                'name.alpha_dash'               => __('Username may only contain letters, numbers, dashes, and underscores.'),
                'first_name.alpha_dash'         => __('First name may only contain letters, numbers, dashes, and underscores.'),
                'last_name.alpha_dash'          => __('Last name may only contain letters, numbers, dashes, and underscores.'),
                'email.required'                => trans('auth.emailRequired'),
                'email.email'                   => trans('auth.emailInvalid'),
                'email.unique'                  => __('This email address is already registered. Please login or use a different email.'),
                'password.required'             => trans('auth.passwordRequired'),
                'g-recaptcha-response.required' => trans('auth.captchaRequire'),
                'captcha.min'                   => trans('auth.CaptchaWrong'),
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $ipAddress = new CaptureIpTrait();

        if (config('settings.activation')) {
            $role      = Role::where('slug', '=', 'unverified')->first();
            $activated = false;
        } else {
            $role      = Role::where('slug', '=', 'user')->first();
            $activated = true;
        }

        $user = User::create([
            'name'              => strip_tags($data['name']),
            'first_name'        => strip_tags($data['first_name'] ?? ''),
            'last_name'         => strip_tags($data['last_name'] ?? ''),
            'email'             => strtolower(trim($data['email'])),
            'password'          => Hash::make($data['password']),
            'token'             => Str::random(64),
            'signup_ip_address' => $ipAddress->getClientIp(),
            'activated'         => $activated,
        ]);

        $user->attachRole($role);
        $this->initiateEmailActivation($user);

        $profile = new Profile();
        $user->profile()->save($profile);
        $user->save();

        return $user;
    }
}
