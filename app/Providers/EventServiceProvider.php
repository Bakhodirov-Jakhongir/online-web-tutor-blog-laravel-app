<?php

namespace App\Providers;

use App\Events\DeviceCreatedEvent;
use App\Events\DeviceCreatingEvent;
use App\Listeners\DeviceCreatedEventListener;
use App\Listeners\DeviceCreatingEventListener;
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
        DeviceCreatingEvent::class => [
            DeviceCreatingEventListener::class,
        ],
        DeviceCreatedEvent::class => [
            DeviceCreatedEventListener::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
