<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Jeremykenedy\LaravelCaptcha\Traits\ValidatesCaptcha;

class RegisteredUserController extends Controller
{
    use ValidatesCaptcha;

    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $rules = [
            'name' => ['required', 'string', 'max:255', 'unique:users', 'alpha_dash'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];

        $request->validate(array_merge($rules, $this->captchaRules()));

        $role = Role::where('slug', '=', 'user')->first();

        $user = User::create([
            'name' => strip_tags($request->name),
            'first_name' => strip_tags($request->first_name ?? ''),
            'last_name' => strip_tags($request->last_name ?? ''),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'token' => Str::random(64),
            'activated' => true,
        ]);

        if (method_exists($user, 'setSignupIp')) {
            $user->setSignupIp()->save();
        }

        if ($role) {
            $user->attachRole($role);
        }

        if (method_exists($user, 'ensureProfile')) {
            $user->ensureProfile();
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
