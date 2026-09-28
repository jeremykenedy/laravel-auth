<?php

namespace App\Http\Middleware;

use App\Models\Activation;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class CheckIsUserActivated
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! config('settings.activation')) {
            return $next($request);
        }

        $user = Auth::user();
        $currentRoute = Route::currentRouteName();
        $routesAllowed = $this->activationExemptRoutes();

        return $this->redirectIfActivationRequired($user, $currentRoute, $routesAllowed)
            ?? $this->redirectIfActivationAttemptsExceeded($user)
            ?? $this->redirectFromExemptRoute($user, $currentRoute, $routesAllowed)
            ?? $next($request);
    }

    /**
     * Routes that a non-activated (or unauthenticated) user is allowed to visit.
     *
     * @return array<int, string>
     */
    private function activationExemptRoutes(): array
    {
        return [
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
    }

    /**
     * Redirect a non-activated user away from a route they are not allowed to visit.
     *
     * @param  array<int, string>  $routesAllowed
     */
    private function redirectIfActivationRequired($user, ?string $currentRoute, array $routesAllowed): ?Response
    {
        if (in_array($currentRoute, $routesAllowed)) {
            return null;
        }

        if (! $user || $user->activated == 1) {
            return null;
        }

        Log::info('Non-activated user attempted to visit '.$currentRoute.'. ', [$user]);

        return redirect()->route('activation-required')
            ->with([
                'message' => 'Activation is required. ',
                'status'  => 'danger',
            ]);
    }

    /**
     * Redirect a non-activated user who has exceeded their activation attempts.
     */
    private function redirectIfActivationAttemptsExceeded($user): ?Response
    {
        if (! $user || $user->activated == 1) {
            return null;
        }

        $activationsCount = Activation::where('user_id', $user->id)
            ->where('created_at', '>=', Carbon::now()->subHours(config('settings.timePeriod')))
            ->count();

        if ($activationsCount < config('settings.maxAttempts')) {
            return null;
        }

        return redirect()->route('exceeded');
    }

    /**
     * Redirect an activated user, or a guest, away from an activation-exempt route
     * they no longer need to be on.
     *
     * @param  array<int, string>  $routesAllowed
     */
    private function redirectFromExemptRoute($user, ?string $currentRoute, array $routesAllowed): ?Response
    {
        if (! in_array($currentRoute, $routesAllowed)) {
            return null;
        }

        if ($user && $user->activated == 1) {
            return redirect('home');
        }

        if (! $user) {
            Log::info('Non registered visit to '.$currentRoute.'. ');

            return redirect()->route('welcome');
        }

        return null;
    }
}
