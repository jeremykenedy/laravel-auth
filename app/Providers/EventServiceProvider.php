<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
        ],
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            'SocialiteProviders\\YouTube\\YouTubeExtendSocialite@handle',
            'SocialiteProviders\\Twitch\\TwitchExtendSocialite@handle',
            'SocialiteProviders\\Instagram\\InstagramExtendSocialite@handle',
            'SocialiteProviders\\ThirtySevenSignals\\ThirtySevenSignalsExtendSocialite@handle',
            'SocialiteProviders\\LinkedIn\\LinkedInExtendSocialite@handle',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
