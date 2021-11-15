<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AbonnementNotConf extends Mailable
{
    use Queueable, SerializesModels;
    public $client;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Nouveau abonnement")
            ->markdown("emails.client.abonnement-not-conf")
            ->with([
                'client' => $this->client,
            ]);
    }
}
