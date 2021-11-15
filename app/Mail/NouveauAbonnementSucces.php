<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NouveauAbonnementSucces extends Mailable
{
    use Queueable, SerializesModels;
    public $client;
    public $profile;
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
        return $this->subject("Nouveau abonnement sur Sencompte")
            ->markdown("emails.client.nouveau-abonnement")
            ->with([
                "client" => $this->client,
                "profile" => $this->profile
            ]);
    }
}
