<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
| http://laravel.com/docs/5.1/authentication
| http://laravel.com/docs/5.1/authorization
| http://laravel.com/docs/5.1/routing
| http://laravel.com/docs/5.0/schema
| http://socialiteproviders.github.io/
|
*/

// ALL AUTHENTICATION ROUTES - HANDLED IN THE CONTROLLERS
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

// REGISTRATION EMAIL CONFIRMATION ROUTES
Route::get('/resendEmail', 'Auth\AuthController@resendEmail');
Route::get('/activate/{code}', 'Auth\AuthController@activateAccount');

// LARAVEL SOCIALITE AUTHENTICATION ROUTES
Route::get('/social/redirect/{provider}',   ['as' => 'social.redirect',   'uses' => 'Auth\AuthController@getSocialRedirect']);
Route::get('/social/handle/{provider}',     ['as' => 'social.handle',     'uses' => 'Auth\AuthController@getSocialHandle']);

// AUTHENTICATION ALIASES/REDIRECTS
Route::get('login', function () {
    return redirect('auth/login');
});
Route::get('logout', function () {
    return redirect('auth/logout');
});
Route::get('register', function () {
    return redirect('auth/register');
});
Route::get('reset', function () {
    return redirect('password/email');
});

// USER PAGE ROUTES - RUNNING THROUGH AUTH MIDDLEWARE
Route::group(['middleware' => 'auth'], function () {

	// HOMEPAGE ROUTE
	Route::get('/', [
	    'as' 			=> 'user',
	    'uses' 			=> 'UserController@index'
	]);

});





// PAGE ROUTE ALIASES
Route::get('home', function () {
    return redirect('/');
});
Route::get('app', function () {
    return redirect('/');
});



// USER PROFILE ROUTES - MAKE SURE LAST
//Route::get('/{profile}', 'ProfilesController@show');
Route::get('profile/{profile}', [
    'as' 			=> 'user',
    'uses' 			=> 'ProfilesController@show'
]);



//***************************************************************************************//
//***************************** USER ROUTING EXAMPLES BELOW *****************************//
//***************************************************************************************//

// //** OPTION - ALL FOLLOWING ROUTES RUN THROUGH AUTHETICATION VIA MIDDLEWARE **//
// Route::group(['middleware' => 'auth'], function () {

// 	// OPTION - GO DIRECTLY TO TEMPLATE
// 	Route::get('/', function () {
// 	    return view('pages.home');
// 	});

// 	// OPTION - USE CONTROLLER
// 	Route::get('/', [
// 	    'as' 			=> 'user',
// 	    'uses' 			=> 'UsersController@index'
// 	]);

// });

// //** OPTION - SINGLE ROUTE USING A CONTROLLER AND AUTHENTICATION VIA MIDDLEWARE **//
// Route::get('/', [
//     'middleware' 	=> 'auth',
//     'as' 			=> 'user',
//     'uses' 			=> 'UsersController@index'
// ]);