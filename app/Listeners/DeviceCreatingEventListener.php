<?php

namespace App\Listeners;

use App\Events\DeviceCreatingEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class DeviceCreatingEventListener
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
     * @param  DeviceCreatingEvent  $event
     * @return void
     */
    public function handle(DeviceCreatingEvent $event)
    {
        Log::info("Device creating procress running..." . $event->device);
    }
}
