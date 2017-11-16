<?php

namespace Fieldtrip\Mail;

use Fieldtrip\Trip;
use Fieldtrip\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use function Fieldtrip\Services\serialEncode;

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
    public function __construct(Trip $trip, User $user)
    {
        $this->trip = $trip;

        $this->user = $user;

        $this->url = serialEncode($this->trip->id, $this->user->id);

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('RE: Field Trip # ' . $this->trip->field_trip_number)
            ->markdown('email.trip');
    }
}
