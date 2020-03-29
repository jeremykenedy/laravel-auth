<?php

namespace App\Http\Middleware;

use App\Models\Activation;
use Auth;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class CheckIsUserActivated
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (config('settings.activation')) {
            $user = Auth::user();
            $currentRoute = Route::currentRouteName();
            $routesAllowed = [
                'activation-required',
                'activate/{token}',
                'activate',
                'activation',
                'exceeded',
                'authenticated.activate',
                'authenticated.activation-resend',
                'social/redirect/{provider}',
                'social/handle/{provider}',
                'logout',
                'welcome',
            ];

            if (!in_array($currentRoute, $routesAllowed)) {
                if ($user && $user->activated != 1) {
                    Log::info('Non-activated user attempted to visit '.$currentRoute.'. ', [$user]);

                    return redirect()->route('activation-required')
                        ->with([
                            'message' => 'Activation is required. ',
                            'status'  => 'danger',
                        ]);
                }
            }

            if ($user && $user->activated != 1) {
                $activationsCount = Activation::where('user_id', $user->id)
                    ->where('created_at', '>=', Carbon::now()->subHours(config('settings.timePeriod')))
                    ->count();

                if ($activationsCount >= config('settings.maxAttempts')) {
                    return redirect()->route('exceeded');
                }
            }

            if (in_array($currentRoute, $routesAllowed)) {
                if ($user && $user->activated == 1) {
                    // Log::info('Activated user attempted to visit '.$currentRoute.'. ', [$user]);

                    if ($user->isAdmin()) {
                        return redirect('home');
                    }

                    return redirect('home');
                }

                if (!$user) {
                    Log::info('Non registered visit to '.$currentRoute.'. ');

                    return redirect()->route('welcome');
                }
            }
        }

        return $next($request);
    }
}
