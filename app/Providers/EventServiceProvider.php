<?php

namespace App\Providers;

use App\BadgeSubscriber;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use App\Events\ModelCreated;
use App\Listeners\ModelCreated as ModelCreatedListener;

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
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            // add your listeners (aka providers) here
            'SocialiteProviders\\Facebook\\FacebookExtendSocialite@handle',
            'SocialiteProviders\\Google\\GoogleExtendSocialite@handle',
            'SocialiteProviders\\Twitter\\TwitterExtendSocialite@handle',
            'SocialiteProviders\\Steam\\SteamExtendSocialite@handle',
            'SocialiteProviders\\Discord\\DiscordExtendSocialite@handle',
        ],

        \Illuminate\Auth\Events\Failed::class => [
            \App\Listeners\RecordFailedLoginAttempt::class,
        ],
    ];

    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $subscribe = [
        BadgeSubscriber::class
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
