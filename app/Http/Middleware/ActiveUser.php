<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ActiveUser {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{

		if (Auth::user() && !$request->active && Route::currentRouteName() != 'unactivated' && Route::currentRouteName() != 'logout' && Route::currentRouteName() != 'activation' && Route::currentRouteName() != 'landing') {

			return redirect('unactivated');

		}

		return $next($request);
	}

}