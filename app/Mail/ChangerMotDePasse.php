<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\URL;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ChangerMotDePasse extends Mailable
{
    use Queueable, SerializesModels;
    public $accounts;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($accounts)
    {
        $this->accounts = $accounts;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $base_url = URL::to('/');
        return $this->subject("Changement de mot de passe")
            ->markdown("admin.emails.changement-motdepasse", [
                "accounts" => $this->accounts,
                "base_url" => $base_url
            ]);
    }
}
