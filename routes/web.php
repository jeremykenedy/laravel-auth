<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Page Routes
Route::get('/', function () {
    return view('welcome');
})->name('landing');
Route::get('/home', 'HomeController@index')->name('home');

// Authentication Routes
Auth::routes();

// Registration and Activation Routes
Route::group(['middleware' => 'auth'], function () {
	Route::get('/activation', 'Auth\RegisterController@activation')->name('activation');
	Route::get('/activate/{code}', 'Auth\RegisterController@activateAccount')->name('resendEmail');
	Route::get('/unactivated', 'Auth\RegisterController@unactivated')->name('unactivated');
});



