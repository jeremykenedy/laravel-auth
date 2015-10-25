<?php namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		'event.name' => [
			'EventListener',
		],
	    'SocialiteProviders\Manager\SocialiteWasCalled' => [
	        'SocialiteProviders\YouTube\YouTubeExtendSocialite@handle',
	        'SocialiteProviders\Twitch\TwitchExtendSocialite@handle',
	        'SocialiteProviders\Instagram\InstagramExtendSocialite@handle',
	        'SocialiteProviders\ThirtySevenSignals\ThirtySevenSignalsExtendSocialite@handle',
	    ],

	];

	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
	public function boot(DispatcherContract $events)
	{
		parent::boot($events);

		//
	}

}
