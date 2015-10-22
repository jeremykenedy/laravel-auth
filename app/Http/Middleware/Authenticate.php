<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Authenticate {

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
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{

		if ($this->auth->guest())
		{
			if ($request->ajax())
			{
				return response('Unauthorized.', 401);
				//abort(403);
			}
			else
			{
				return redirect()->guest('auth/login');
			}
		}

		if (!\Auth::user()->active) {
			//\Session::flash('message', 'Please activate your account to proceed.');
			//return redirect()->guest('auth.guest_activate');
			return view('auth.guest_activate')
				->with( 'email', \Auth::user()->email )
				->with( 'date', \Auth::user()->created_at->format('Y-m-d') );
		}

		return $next($request);
	}

}
