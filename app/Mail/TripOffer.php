<?php

namespace Fieldtrip\Mail;

use Fieldtrip\Trip;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TripOffer extends Mailable
{
    use Queueable, SerializesModels;

    public $trip;

    public $user;

    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Trip $trip, $user)
    {
        $this->trip = $trip;

        $this->user = $user;

        $string = serialize([$this->trip->id, $this->user->id]);

        $this->url = strtr(base64_encode($string ), '+/=', '._-');
//        $this->url = serialize([$this->trip->id, $this->user->id]);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.trip');
    }
}
