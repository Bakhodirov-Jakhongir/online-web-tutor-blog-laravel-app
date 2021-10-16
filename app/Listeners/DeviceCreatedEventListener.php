<?php

namespace App\Listeners;

use App\Events\DeviceCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class DeviceCreatedEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  DeviceCreatedEvent  $event
     * @return void
     */
    public function handle(DeviceCreatedEvent $event)
    {
        Log::info("Device created successfully!" . $event->device);
    }
}
