<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class CheckCurrentUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * 
     * @return \Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next)
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
    }
}
