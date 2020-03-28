<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }

    /**
     * Log a termination.
     * @param \Illuminate\Http\Request $request
     * @param $response
     *
     * @return void
     */
    public function terminate($request, $response)
    {
        $user = Auth::user();
        $currentRoute = Route::currentRouteName();
        Log::info('Authenticate middleware was used: '.$currentRoute.'. ', [$user]);
    }
}
