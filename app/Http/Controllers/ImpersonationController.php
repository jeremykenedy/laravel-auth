<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ImpersonationController extends Controller
{
    public function start(Request $request, User $user): RedirectResponse
    {
        $admin = $request->user();

        if ($admin->level() < 5) {
            abort(403);
        }

        if ($user->level() >= 5) {
            return back()->with('error', 'You cannot impersonate another admin.');
        }

        if ($admin->id === $user->id) {
            return back()->with('error', 'You cannot impersonate yourself.');
        }

        Session::put('impersonator_id', $admin->id);
        Session::put('impersonator_name', $admin->name);

        Auth::login($user);

        return redirect()->route('home')->with('success', "Now impersonating {$user->name}.");
    }

    public function stop(Request $request): RedirectResponse
    {
        $impersonatorId = Session::pull('impersonator_id');
        Session::forget('impersonator_name');

        if ($impersonatorId) {
            $admin = User::findOrFail($impersonatorId);
            Auth::login($admin);

            return redirect()->route('home')->with('success', 'Impersonation ended.');
        }

        return redirect()->route('home');
    }
}
