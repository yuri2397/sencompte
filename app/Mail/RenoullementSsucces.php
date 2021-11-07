<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RenoullementSsucces extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($client, $profile)
    {
        $this->client = $client;
        $this->profile = $profile;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Renouvellement d'un abonnement")
        ->markdown("emails.client.renouvellement-success")
        ->with([
            "client" => $this->client,
            "profile" => $this->profile
        ]);
    }
}
