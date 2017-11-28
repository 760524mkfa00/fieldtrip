<?php

namespace Fieldtrip\Listeners;

use Fieldtrip\Events\tripResponse;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class gotTripResponse
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
     * @param  tripResponse  $event
     * @return void
     */
    public function handle(tripResponse $event)
    {
        //
    }
}
