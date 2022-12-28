<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class Authenticate extends Middleware
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

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
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if (! $this->auth->check()) {
            return redirect()->to('/login')
                ->with('status', 'success')
                ->with('message', 'Please login.');
        }

        return $next($request);
    }

    /**
     * Log a termination.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $response
     * @return void
     */
    public function terminate($request, $response)
    {
        $user = Auth::user();
        $currentRoute = Route::currentRouteName();
        // Log::info('Authenticate middleware was used: '.$currentRoute.'. ', [$user]);
    }
}
