<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class CheckCurrentUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! $request->user()) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }

    public function terminate($request, $response)
    {
        $user = Auth::user();
        $currentRoute = Route::currentRouteName();
        Log::info('CheckCurrentUser middlware was used: '.$currentRoute.'. ', [$user]);
    }
}
