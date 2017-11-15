<?php

namespace Fieldtrip\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use function Fieldtrip\Services\serialEncode;

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

        $this->url = serialEncode($this->trip->id, $this->trip->user->first()->id);

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
