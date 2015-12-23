<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Stripe, Mailgun, Mandrill, and others. This file provides a sane
	| default location for this type of information, allowing packages
	| to have a conventional place to find your various credentials.
	|
	| # http://socialiteproviders.github.io/
	|
	*/

	'mailgun' => [
		'domain' => '',
		'secret' => '',
	],

	'mandrill' => [
		'secret' => '',
	],

	'ses' => [
		'key' => '',
		'secret' => '',
		'region' => 'us-east-1',
	],

	'stripe' => [
		'model'  => 'App\Models\User',
		'key'    => '',
		'secret' => '',
	],

    'facebook' => [
        'client_id'     => env('FB_ID'),
        'client_secret' => env('FB_SECRET'),
        'redirect'      => env('FB_REDIRECT')
    ],

    'twitter' => [
        'client_id'     => env('TW_ID'),
        'client_secret' => env('TW_SECRET'),
        'redirect'      => env('TW_REDIRECT')
    ],

    'google' => [
        'client_id'     => env('GOOGLE_ID'),
        'client_secret' => env('GOOGLE_SECRET'),
        'redirect'      => env('GOOGLE_REDIRECT')
    ],

	'github' => [
	    'client_id' 	=> env('GITHUB_ID'),
	    'client_secret' => env('GITHUB_SECRET'),
	    'redirect' 		=> env('GITHUB_URL'),
	],

	'youtube' => [
	    'client_id' 	=> env('YOUTUBE_KEY'),
	    'client_secret' => env('YOUTUBE_SECRET'),
	    'redirect' 		=> env('YOUTUBE_REDIRECT_URI'),
	],

	'twitch' => [
	    'client_id' 	=> env('TWITCH_KEY'),
	    'client_secret' => env('TWITCH_SECRET'),
	    'redirect' 		=> env('TWITCH_REDIRECT_URI'),
	],

	'instagram' => [
	    'client_id' 	=> env('INSTAGRAM_KEY'),
	    'client_secret' => env('INSTAGRAM_SECRET'),
	    'redirect' 		=> env('INSTAGRAM_REDIRECT_URI'),
	],

	'37signals' => [
	    'client_id' 	=> env('37SIGNALS_KEY'),
	    'client_secret' => env('37SIGNALS_SECRET'),
	    'redirect' 		=> env('37SIGNALS_REDIRECT_URI'),
	],

];
