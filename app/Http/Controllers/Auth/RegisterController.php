<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use App\Traits\ActivationTrait;
use App\Traits\CaptchaTrait;
use App\Traits\CaptureIpTrait;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use jeremykenedy\LaravelRoles\Models\Role;

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
                'name'                  => 'required|max:255|unique:users|alpha_dash',
                'first_name'            => 'alpha_dash',
                'last_name'             => 'alpha_dash',
                'email'                 => 'required|email|max:255|unique:users',
                'password'              => 'required|min:6|max:30|confirmed',
                'password_confirmation' => 'required|same:password',
                'g-recaptcha-response'  => '',
                'captcha'               => 'required|min:1',
            ],
            [
                'name.unique'                   => trans('auth.userNameTaken'),
                'name.required'                 => trans('auth.userNameRequired'),
                'first_name.required'           => trans('auth.fNameRequired'),
                'last_name.required'            => trans('auth.lNameRequired'),
                'email.required'                => trans('auth.emailRequired'),
                'email.email'                   => trans('auth.emailInvalid'),
                'password.required'             => trans('auth.passwordRequired'),
                'password.min'                  => trans('auth.PasswordMin'),
                'password.max'                  => trans('auth.PasswordMax'),
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
            $role = Role::where('slug', '=', 'unverified')->first();
            $activated = false;
        } else {
            $role = Role::where('slug', '=', 'user')->first();
            $activated = true;
        }

        $user = User::create([
            'name'              => strip_tags($data['name']),
            'first_name'        => strip_tags($data['first_name']),
            'last_name'         => strip_tags($data['last_name']),
            'email'             => $data['email'],
            'password'          => Hash::make($data['password']),
            'token'             => str_random(64),
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
