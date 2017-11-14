<?php

namespace Fieldtrip\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TripResponse extends Mailable
{
    use Queueable, SerializesModels;

    public $trip;

    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($trip)
    {

        $this->trip = $trip;

        $string = serialize([$this->trip->id, $trip->user->first()->id]);

        $this->url = strtr(base64_encode($string ), '+/=', '._-');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.response');
    }
}
