<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $recentNotifications = $user->unreadNotifications()->take(5)->get();
        $notificationCount = $user->unreadNotifications()->count();

        $sessionCount = DB::table(config('session.table', 'sessions'))
            ->where('user_id', $user->id)
            ->count();

        $accountAge = $user->created_at->diffForHumans(syntax: true);
        $profileCompletion = $user->profileCompleteness();

        return view('home', compact(
            'recentNotifications',
            'notificationCount',
            'sessionCount',
            'accountAge',
            'profileCompletion',
        ));
    }
}
